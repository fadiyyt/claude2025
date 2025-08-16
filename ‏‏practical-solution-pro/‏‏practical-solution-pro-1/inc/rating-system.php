<?php
/**
 * Rating System - Nonce & Performance Fixed Version
 * نظام التقييمات - نسخة مُصلحة للـ Nonce والأداء
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Rating_System {
    
    private $table_name;
    
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'ps_ratings';
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        add_action('after_switch_theme', array($this, 'create_rating_table'));
        
        add_action('wp_ajax_ps_set_rating', array($this, 'handle_set_rating'));
        add_action('wp_ajax_nopriv_ps_set_rating', array($this, 'handle_set_rating'));
        
        add_action('wp_ajax_ps_get_rating', array($this, 'handle_get_rating'));
        add_action('wp_ajax_nopriv_ps_get_rating', array($this, 'handle_get_rating'));
        
        add_filter('the_content', array($this, 'add_rating_to_content'));
        add_action('wp_head', array($this, 'add_rating_schema'));
    }
    
    public function create_rating_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE {$this->table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT NULL,
            user_ip varchar(100) NOT NULL,
            rating tinyint(1) NOT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            UNIQUE KEY unique_rating (post_id, user_ip, user_id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function handle_set_rating() {
        // **إصلاح:** التحقق من الـ nonce الموحد
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'ps_ajax_nonce')) {
            wp_send_json_error(__('Nonce verification failed', 'practical-solutions'), 403);
            return;
        }
        
        $post_id = intval($_POST['post_id'] ?? 0);
        $rating = intval($_POST['rating'] ?? 0);
        
        if ($post_id <= 0 || $rating < 1 || $rating > 5) {
            wp_send_json_error(__('Invalid data', 'practical-solutions'));
            return;
        }
        
        $user_id = get_current_user_id();
        $user_ip = $this->get_user_ip();
        
        global $wpdb;
        
        // استخدام REPLACE INTO لتبسيط الإدراج والتحديث
        $wpdb->query($wpdb->prepare(
            "REPLACE INTO {$this->table_name} (post_id, user_id, user_ip, rating, created_at) VALUES (%d, %d, %s, %d, %s)",
            $post_id,
            $user_id,
            $user_ip,
            $rating,
            current_time('mysql')
        ));
        
        // تحديث بيانات المقال المجمعة
        $this->update_post_rating_meta($post_id);
        
        wp_send_json_success([
            'message' => __('Thank you for your rating!', 'practical-solutions')
        ]);
    }
    
    public function handle_get_rating() {
        // **إصلاح:** التحقق من الـ nonce الموحد
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'ps_ajax_nonce')) {
            wp_send_json_error(__('Nonce verification failed', 'practical-solutions'), 403);
            return;
        }
        
        $post_id = intval($_POST['post_id'] ?? 0);
        
        if ($post_id <= 0) {
            wp_send_json_error(__('Invalid post ID', 'practical-solutions'));
            return;
        }
        
        $rating_data = $this->get_post_rating_data($post_id);
        wp_send_json_success($rating_data);
    }

    private function update_post_rating_meta($post_id) {
        global $wpdb;
        $stats = $wpdb->get_row($wpdb->prepare(
            "SELECT COUNT(id) as total, AVG(rating) as average FROM {$this->table_name} WHERE post_id = %d",
            $post_id
        ));

        if ($stats) {
            update_post_meta($post_id, 'ps_total_ratings', $stats->total);
            update_post_meta($post_id, 'ps_average_rating', round($stats->average, 2));
        }
    }

    public function get_post_rating_data($post_id) {
        $total = get_post_meta($post_id, 'ps_total_ratings', true) ?: 0;
        $average = get_post_meta($post_id, 'ps_average_rating', true) ?: 0;
        
        return [
            'average' => floatval($average),
            'total'   => intval($total),
            'user_rating' => $this->get_user_rating($post_id)
        ];
    }

    public function get_user_rating($post_id) {
        global $wpdb;
        $user_id = get_current_user_id();
        $user_ip = $this->get_user_ip();

        $sql = $wpdb->prepare(
            "SELECT rating FROM {$this->table_name} WHERE post_id = %d AND user_ip = %s",
            $post_id, $user_ip
        );

        if ($user_id > 0) {
            $sql = $wpdb->prepare(
                "SELECT rating FROM {$this->table_name} WHERE post_id = %d AND (user_ip = %s OR user_id = %d)",
                $post_id, $user_ip, $user_id
            );
        }

        $rating = $wpdb->get_var($sql);
        return $rating ? intval($rating) : 0;
    }

    public function add_rating_to_content($content) {
        if (is_singular('post') && in_the_loop() && is_main_query()) {
            $settings = get_option('ps_general_settings', []);
            if ($settings['rating_system'] ?? true) {
                $content .= $this->render_rating_widget(get_the_ID());
            }
        }
        return $content;
    }

    public function render_rating_widget($post_id) {
        $rating_data = $this->get_post_rating_data($post_id);
        ob_start();
        ?>
        <div class="ps-rating-system-widget" data-post-id="<?php echo esc_attr($post_id); ?>" data-initial-rating="<?php echo esc_attr($rating_data['user_rating']); ?>">
            <h4><?php _e('ما رأيك في هذا المقال؟', 'practical-solutions'); ?></h4>
            <div class="ps-stars" aria-label="<?php _e('Rating', 'practical-solutions'); ?>">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <input type="radio" id="ps-star-<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php checked($i, $rating_data['user_rating']); ?> />
                    <label for="ps-star-<?php echo $i; ?>" title="<?php echo sprintf(__('%d stars', 'practical-solutions'), $i); ?>">★</label>
                <?php endfor; ?>
            </div>
            <div class="ps-rating-summary">
                <?php if ($rating_data['total'] > 0): ?>
                    <?php printf(__('متوسط التقييم: %s (%d تقييم)', 'practical-solutions'), '<strong>' . esc_html($rating_data['average']) . '</strong>', esc_html($rating_data['total'])); ?>
                <?php else: ?>
                    <?php _e('كن أول من يقيم!', 'practical-solutions'); ?>
                <?php endif; ?>
            </div>
            <div class="ps-rating-feedback" style="display:none;"></div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function add_rating_schema() {
        if (!is_singular('post')) return;
        
        $rating_data = $this->get_post_rating_data(get_the_ID());
        if ($rating_data['total'] > 0) {
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'aggregateRating' => [
                    '@type' => 'AggregateRating',
                    'ratingValue' => $rating_data['average'],
                    'ratingCount' => $rating_data['total'],
                    'bestRating' => 5,
                    'worstRating' => 1,
                ],
            ];
            echo '<script type="application/ld+json">' . wp_json_encode($schema ) . '</script>';
        }
    }

    private function get_user_ip() {
        $ip_keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        return $ip;
                    }
                }
            }
        }
        return '0.0.0.0';
    }
}

new PS_Rating_System();
