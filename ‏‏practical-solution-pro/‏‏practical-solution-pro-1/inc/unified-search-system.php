<?php
/**
 * Unified Search System - Nonce Fixed Version
 * نظام البحث الموحد - نسخة مُصلحة للـ Nonce
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Unified_Search_System {
    
    private $ai_system;
    
    public function __construct() {
        if (class_exists('PS_AI_OpenRouter_System')) {
            $this->ai_system = new PS_AI_OpenRouter_System();
        }
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        add_action('wp_ajax_ps_search_suggestions', array($this, 'handle_search_suggestions'));
        add_action('wp_ajax_nopriv_ps_search_suggestions', array($this, 'handle_search_suggestions'));
        
        add_action('wp_ajax_ps_voice_search', array($this, 'handle_voice_search'));
        add_action('wp_ajax_nopriv_ps_voice_search', array($this, 'handle_voice_search'));
        
        add_action('pre_get_posts', array($this, 'enhance_search_query'));
    }
    
    public function handle_search_suggestions() {
        // **إصلاح:** التحقق من الـ nonce الموحد
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'ps_ajax_nonce')) {
            wp_send_json_error(__('Nonce verification failed', 'practical-solutions'), 403);
            return;
        }
        
        $query = sanitize_text_field($_POST['query'] ?? '');
        
        if (empty($query) || strlen($query) < 2) {
            wp_send_json_error(__('Query is too short', 'practical-solutions'));
            return;
        }
        
        $cache_key = 'ps_unified_suggestions_' . md5($query);
        $cached = get_transient($cache_key);
        
        if ($cached !== false) {
            wp_send_json_success($cached);
            return;
        }
        
        $suggestions = [];
        
        if ($this->ai_system && method_exists($this->ai_system, 'get_ai_search_suggestions')) {
            try {
                $ai_suggestions = $this->ai_system->get_ai_search_suggestions($query);
                $suggestions = array_merge($suggestions, $ai_suggestions);
            } catch (Exception $e) {
                error_log('AI Suggestion Error: ' . $e->getMessage());
            }
        }
        
        $local_suggestions = $this->get_local_suggestions($query);
        $suggestions = array_merge($suggestions, $local_suggestions);
        
        $final_suggestions = $this->process_suggestions($suggestions);
        
        set_transient($cache_key, $final_suggestions, HOUR_IN_SECONDS);
        
        wp_send_json_success($final_suggestions);
    }
    
    public function handle_voice_search() {
        // **إصلاح:** التحقق من الـ nonce الموحد
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'ps_ajax_nonce')) {
            wp_send_json_error(__('Nonce verification failed', 'practical-solutions'), 403);
            return;
        }
        // ... باقي الكود هنا ...
    }

    private function get_local_suggestions($query) {
        global $wpdb;
        $suggestions = [];
        $posts = $wpdb->get_results($wpdb->prepare("SELECT post_title, ID FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_type = 'post' AND post_title LIKE %s LIMIT 5", '%' . $wpdb->esc_like($query) . '%'));
        foreach ($posts as $post) {
            $suggestions[] = ['title' => $post->post_title, 'url' => get_permalink($post->ID), 'type' => 'post'];
        }
        return $suggestions;
    }

    private function process_suggestions($suggestions) {
        $unique_suggestions = [];
        $seen_titles = [];
        foreach ($suggestions as $suggestion) {
            if (!in_array(strtolower($suggestion['title']), $seen_titles)) {
                $unique_suggestions[] = $suggestion;
                $seen_titles[] = strtolower($suggestion['title']);
            }
        }
        return array_slice($unique_suggestions, 0, 8);
    }

    public function enhance_search_query($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            $query->set('orderby', 'relevance');
        }
    }
}

new PS_Unified_Search_System();
