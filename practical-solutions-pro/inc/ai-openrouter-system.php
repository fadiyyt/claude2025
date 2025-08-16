<?php
/**
 * Advanced AI System with OpenRouter API
 * نظام الذكاء الاصطناعي المتقدم مع OpenRouter API
 * المكان: /inc/ai-openrouter-system.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_AI_OpenRouter_System {
    
    private $api_key;
    private $base_url = 'https://openrouter.ai/api/v1';
    private $default_model = 'meta-llama/llama-3.1-8b-instruct:free';
    private $cache_duration = 3600; // ساعة واحدة
    private $max_suggestions = 8;
    private $max_tokens = 1500;
    
    public function __construct() {
        $this->api_key = get_option('ps_openrouter_api_key', '');
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        // AJAX handlers
        add_action('wp_ajax_ps_ai_search_suggestions', array($this, 'handle_ai_search_suggestions'));
        add_action('wp_ajax_nopriv_ps_ai_search_suggestions', array($this, 'handle_ai_search_suggestions'));
        
        add_action('wp_ajax_ps_ai_analyze_content', array($this, 'handle_ai_analyze_content'));
        add_action('wp_ajax_ps_ai_categorize_content', array($this, 'handle_ai_categorize_content'));
        
        add_action('wp_ajax_ps_ai_generate_summary', array($this, 'handle_ai_generate_summary'));
        add_action('wp_ajax_ps_ai_suggest_tags', array($this, 'handle_ai_suggest_tags'));
        
        // Hooks للمحتوى التلقائي
        add_action('save_post', array($this, 'auto_analyze_content'), 20, 2);
        add_action('wp_insert_post', array($this, 'auto_suggest_categories'), 10, 3);
    }
    
    /**
     * ==== معالج اقتراحات البحث الذكية ====
     */
    public function handle_ai_search_suggestions() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $query = sanitize_text_field($_POST['query'] ?? '');
        $context = sanitize_text_field($_POST['context'] ?? 'general');
        $user_behavior = json_decode(stripslashes($_POST['user_behavior'] ?? '{}'), true);
        
        if (empty($query)) {
            wp_send_json_error(__('الاستعلام مطلوب', 'practical-solutions'));
        }
        
        try {
            $suggestions = $this->get_ai_search_suggestions($query, $context, $user_behavior);
            wp_send_json_success($suggestions);
        } catch (Exception $e) {
            error_log('AI Search Suggestions Error: ' . $e->getMessage());
            wp_send_json_error(__('حدث خطأ في الذكاء الاصطناعي', 'practical-solutions'));
        }
    }
    
    /**
     * ==== توليد اقتراحات البحث الذكية ====
     */
    public function get_ai_search_suggestions($query, $context = 'general', $user_behavior = array()) {
        if (!$this->is_api_configured()) {
            return $this->get_fallback_suggestions($query);
        }
        
        // التحقق من الكاش
        $cache_key = 'ps_ai_suggestions_' . md5($query . $context . serialize($user_behavior));
        $cached_result = get_transient($cache_key);
        
        if ($cached_result !== false) {
            return $cached_result;
        }
        
        // بناء الـ prompt المحسن
        $prompt = $this->build_search_prompt($query, $context, $user_behavior);
        
        try {
            // طلب الـ AI
            $ai_response = $this->make_ai_request($prompt, array(
                'max_tokens' => 500,
                'temperature' => 0.7,
                'top_p' => 0.9
            ));
            
            // معالجة الاستجابة
            $suggestions = $this->parse_search_suggestions($ai_response, $query);
            
            // دمج مع النتائج المحلية
            $local_suggestions = $this->get_local_search_results($query);
            $combined_suggestions = $this->combine_suggestions($suggestions, $local_suggestions);
            
            // حفظ في الكاش
            set_transient($cache_key, $combined_suggestions, $this->cache_duration);
            
            return $combined_suggestions;
            
        } catch (Exception $e) {
            error_log('OpenRouter AI Error: ' . $e->getMessage());
            return $this->get_fallback_suggestions($query);
        }
    }
    
    /**
     * ==== بناء prompt محسن للبحث ====
     */
    private function build_search_prompt($query, $context, $user_behavior) {
        $site_categories = $this->get_site_categories();
        $popular_content = $this->get_popular_content();
        $recent_searches = $user_behavior['recent_searches'] ?? array();
        
        $prompt = "أنت مساعد ذكي لموقع 'الحلول العملية' باللغة العربية. الموقع يقدم نصائح وحلول عملية للحياة اليومية.\n\n";
        
        $prompt .= "معلومات الموقع:\n";
        $prompt .= "- التصنيفات المتاحة: " . implode('، ', $site_categories) . "\n";
        $prompt .= "- المحتوى الشائع: " . implode('، ', array_slice($popular_content, 0, 5)) . "\n";
        
        if (!empty($recent_searches)) {
            $prompt .= "- البحثات الأخيرة للمستخدم: " . implode('، ', $recent_searches) . "\n";
        }
        
        $prompt .= "\nاستعلام البحث: \"$query\"\n";
        $prompt .= "السياق: $context\n\n";
        
        $prompt .= "المطلوب: اقترح 6-8 اقتراحات بحث ذكية وذات صلة باللغة العربية. يجب أن تكون:\n";
        $prompt .= "1. مفيدة وعملية\n";
        $prompt .= "2. متنوعة (حلول، نصائح، طرق، وصفات)\n";
        $prompt .= "3. مناسبة لجمهور الموقع\n";
        $prompt .= "4. قصيرة ومباشرة (2-6 كلمات)\n\n";
        
        $prompt .= "اكتب كل اقتراح في سطر منفصل بدون ترقيم أو رموز. مثال:\n";
        $prompt .= "طرق تنظيف المطبخ\n";
        $prompt .= "نصائح توفير الكهرباء\n";
        $prompt .= "حلول مشاكل النوم\n\n";
        
        $prompt .= "الاقتراحات:";
        
        return $prompt;
    }
    
    /**
     * ==== إرسال طلب للـ AI ====
     */
    private function make_ai_request($prompt, $options = array()) {
        $default_options = array(
            'model' => get_option('ps_openrouter_model', $this->default_model),
            'max_tokens' => $this->max_tokens,
            'temperature' => 0.7,
            'top_p' => 0.9,
            'frequency_penalty' => 0.1,
            'presence_penalty' => 0.1
        );
        
        $request_options = array_merge($default_options, $options);
        
        $body = array(
            'model' => $request_options['model'],
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => $request_options['max_tokens'],
            'temperature' => $request_options['temperature'],
            'top_p' => $request_options['top_p'],
            'frequency_penalty' => $request_options['frequency_penalty'],
            'presence_penalty' => $request_options['presence_penalty'],
            'stream' => false
        );
        
        $response = wp_remote_post($this->base_url . '/chat/completions', array(
            'timeout' => 30,
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => home_url(),
                'X-Title' => get_bloginfo('name')
            ),
            'body' => json_encode($body)
        ));
        
        if (is_wp_error($response)) {
            throw new Exception('HTTP Error: ' . $response->get_error_message());
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            $error_body = wp_remote_retrieve_body($response);
            throw new Exception("API Error (Code: $response_code): $error_body");
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (!isset($data['choices'][0]['message']['content'])) {
            throw new Exception('Invalid API response structure');
        }
        
        return $data['choices'][0]['message']['content'];
    }
    
    /**
     * ==== معالجة استجابة اقتراحات البحث ====
     */
    private function parse_search_suggestions($ai_response, $original_query) {
        $suggestions = array();
        $lines = explode("\n", trim($ai_response));
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // تنظيف السطر من الترقيم والرموز
            $line = preg_replace('/^\d+\.\s*/', '', $line);
            $line = preg_replace('/^[-•*]\s*/', '', $line);
            $line = trim($line, '"-\'');
            
            // التحقق من صحة الاقتراح
            if (!empty($line) && 
                strlen($line) >= 3 && 
                strlen($line) <= 100 && 
                $line !== $original_query) {
                
                $suggestions[] = array(
                    'title' => $line,
                    'type' => 'ai_suggestion',
                    'url' => home_url('/?s=' . urlencode($line)),
                    'source' => 'openrouter_ai',
                    'relevance' => $this->calculate_relevance($line, $original_query)
                );
            }
            
            // الحد الأقصى للاقتراحات
            if (count($suggestions) >= $this->max_suggestions) {
                break;
            }
        }
        
        return $suggestions;
    }
    
    /**
     * ==== حساب مدى الصلة ====
     */
    private function calculate_relevance($suggestion, $query) {
        $suggestion_words = array_filter(explode(' ', strtolower($suggestion)));
        $query_words = array_filter(explode(' ', strtolower($query)));
        
        $common_words = array_intersect($suggestion_words, $query_words);
        $relevance = count($common_words) / max(count($query_words), 1);
        
        return round($relevance * 100);
    }
    
    /**
     * ==== دمج الاقتراحات مع النتائج المحلية ====
     */
    private function combine_suggestions($ai_suggestions, $local_suggestions) {
        $combined = array();
        $seen_titles = array();
        
        // إضافة اقتراحات الـ AI أولاً
        foreach ($ai_suggestions as $suggestion) {
            $title_key = strtolower($suggestion['title']);
            if (!in_array($title_key, $seen_titles)) {
                $combined[] = $suggestion;
                $seen_titles[] = $title_key;
            }
        }
        
        // إضافة النتائج المحلية
        foreach ($local_suggestions as $suggestion) {
            $title_key = strtolower($suggestion['title']);
            if (!in_array($title_key, $seen_titles) && count($combined) < $this->max_suggestions) {
                $combined[] = $suggestion;
                $seen_titles[] = $title_key;
            }
        }
        
        // ترتيب حسب الصلة
        usort($combined, function($a, $b) {
            $relevance_a = $a['relevance'] ?? 0;
            $relevance_b = $b['relevance'] ?? 0;
            return $relevance_b <=> $relevance_a;
        });
        
        return array_slice($combined, 0, $this->max_suggestions);
    }
    
    /**
     * ==== النتائج المحلية كبديل ====
     */
    private function get_local_search_results($query) {
        global $wpdb;
        
        $posts = $wpdb->get_results($wpdb->prepare("
            SELECT post_title, post_excerpt, ID
            FROM {$wpdb->posts} 
            WHERE post_status = 'publish' 
            AND post_type = 'post'
            AND (post_title LIKE %s OR post_content LIKE %s)
            ORDER BY 
                CASE 
                    WHEN post_title LIKE %s THEN 1
                    WHEN post_title LIKE %s THEN 2
                    ELSE 3
                END,
                post_date DESC
            LIMIT 4
        ", 
            '%' . $query . '%',
            '%' . $query . '%',
            $query . '%',
            '%' . $query . '%'
        ));
        
        $suggestions = array();
        foreach ($posts as $post) {
            $suggestions[] = array(
                'title' => $post->post_title,
                'type' => 'post',
                'url' => get_permalink($post->ID),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'thumbnail'),
                'source' => 'local_search',
                'relevance' => $this->calculate_relevance($post->post_title, $query)
            );
        }
        
        return $suggestions;
    }
    
    /**
     * ==== تحليل المحتوى التلقائي ====
     */
    public function handle_ai_analyze_content() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $post_id = intval($_POST['post_id'] ?? 0);
        $content = wp_kses_post($_POST['content'] ?? '');
        
        if (!$post_id || empty($content)) {
            wp_send_json_error(__('البيانات غير مكتملة', 'practical-solutions'));
        }
        
        try {
            $analysis = $this->analyze_content_with_ai($content);
            
            // حفظ التحليل
            update_post_meta($post_id, '_ps_ai_analysis', $analysis);
            update_post_meta($post_id, '_ps_ai_analysis_date', current_time('mysql'));
            
            wp_send_json_success($analysis);
        } catch (Exception $e) {
            wp_send_json_error(__('حدث خطأ في التحليل', 'practical-solutions'));
        }
    }
    
    /**
     * ==== تحليل المحتوى بالذكاء الاصطناعي ====
     */
    public function analyze_content_with_ai($content) {
        if (!$this->is_api_configured()) {
            return $this->get_basic_content_analysis($content);
        }
        
        $prompt = $this->build_content_analysis_prompt($content);
        
        try {
            $ai_response = $this->make_ai_request($prompt, array(
                'max_tokens' => 800,
                'temperature' => 0.3
            ));
            
            return $this->parse_content_analysis($ai_response);
        } catch (Exception $e) {
            return $this->get_basic_content_analysis($content);
        }
    }
    
    /**
     * ==== بناء prompt تحليل المحتوى ====
     */
    private function build_content_analysis_prompt($content) {
        $word_count = str_word_count(strip_tags($content));
        
        $prompt = "حلل هذا المحتوى العربي من موقع 'الحلول العملية' وأعط تحليلاً شاملاً:\n\n";
        $prompt .= "المحتوى:\n" . substr(strip_tags($content), 0, 3000) . "\n\n";
        
        $prompt .= "المطلوب تحليل:\n";
        $prompt .= "1. الموضوع الرئيسي (في سطر واحد)\n";
        $prompt .= "2. المواضيع الفرعية (قائمة نقطية)\n";
        $prompt .= "3. التصنيف المناسب (من: منزل، مطبخ، صحة، تقنية، مال، نصائح عامة)\n";
        $prompt .= "4. الوسوم المقترحة (5-8 وسوم)\n";
        $prompt .= "5. مستوى الصعوبة (سهل، متوسط، صعب)\n";
        $prompt .= "6. الجمهور المستهدف (الأسرة، المرأة، الرجل، الطلاب، الجميع)\n";
        $prompt .= "7. وقت القراءة التقديري (بالدقائق)\n";
        $prompt .= "8. درجة الفائدة العملية (1-10)\n";
        $prompt .= "9. ملخص في 50 كلمة\n\n";
        
        $prompt .= "قدم الإجابة في تنسيق JSON:\n";
        $prompt .= "{\n";
        $prompt .= '  "main_topic": "...",\n';
        $prompt .= '  "subtopics": [...],\n';
        $prompt .= '  "category": "...",\n';
        $prompt .= '  "tags": [...],\n';
        $prompt .= '  "difficulty": "...",\n';
        $prompt .= '  "target_audience": "...",\n';
        $prompt .= '  "reading_time": ...,\n';
        $prompt .= '  "usefulness_score": ...,\n';
        $prompt .= '  "summary": "..."\n';
        $prompt .= "}";
        
        return $prompt;
    }
    
    /**
     * ==== معالجة تحليل المحتوى ====
     */
    private function parse_content_analysis($ai_response) {
        // محاولة استخراج JSON من الاستجابة
        $json_start = strpos($ai_response, '{');
        $json_end = strrpos($ai_response, '}');
        
        if ($json_start !== false && $json_end !== false) {
            $json_content = substr($ai_response, $json_start, $json_end - $json_start + 1);
            $analysis = json_decode($json_content, true);
            
            if (json_last_error() === JSON_ERROR_NONE && is_array($analysis)) {
                return $this->validate_analysis($analysis);
            }
        }
        
        // إذا فشل parsing JSON، استخدم parsing نصي
        return $this->parse_text_analysis($ai_response);
    }
    
    /**
     * ==== التحقق من صحة التحليل ====
     */
    private function validate_analysis($analysis) {
        $defaults = array(
            'main_topic' => '',
            'subtopics' => array(),
            'category' => 'نصائح عامة',
            'tags' => array(),
            'difficulty' => 'متوسط',
            'target_audience' => 'الجميع',
            'reading_time' => 3,
            'usefulness_score' => 7,
            'summary' => ''
        );
        
        $validated = array_merge($defaults, $analysis);
        
        // التحقق من القيم
        $validated['reading_time'] = max(1, min(20, intval($validated['reading_time'])));
        $validated['usefulness_score'] = max(1, min(10, intval($validated['usefulness_score'])));
        
        if (!in_array($validated['difficulty'], array('سهل', 'متوسط', 'صعب'))) {
            $validated['difficulty'] = 'متوسط';
        }
        
        return $validated;
    }
    
    /**
     * ==== تحليل أساسي للمحتوى (بديل) ====
     */
    private function get_basic_content_analysis($content) {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = max(1, ceil($word_count / 180));
        
        return array(
            'main_topic' => 'تحليل أساسي للمحتوى',
            'subtopics' => array(),
            'category' => 'نصائح عامة',
            'tags' => array(),
            'difficulty' => 'متوسط',
            'target_audience' => 'الجميع',
            'reading_time' => $reading_time,
            'usefulness_score' => 7,
            'summary' => substr(strip_tags($content), 0, 150) . '...'
        );
    }
    
    /**
     * ==== توليد ملخص تلقائي ====
     */
    public function handle_ai_generate_summary() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $content = wp_kses_post($_POST['content'] ?? '');
        $length = intval($_POST['length'] ?? 100);
        
        if (empty($content)) {
            wp_send_json_error(__('المحتوى مطلوب', 'practical-solutions'));
        }
        
        try {
            $summary = $this->generate_summary($content, $length);
            wp_send_json_success(array('summary' => $summary));
        } catch (Exception $e) {
            wp_send_json_error(__('حدث خطأ في توليد الملخص', 'practical-solutions'));
        }
    }
    
    /**
     * ==== توليد الملخص ====
     */
    public function generate_summary($content, $length = 100) {
        if (!$this->is_api_configured()) {
            return $this->get_basic_summary($content, $length);
        }
        
        $prompt = "اكتب ملخصاً مفيداً وجذاباً للمحتوى التالي في حدود $length كلمة:\n\n";
        $prompt .= substr(strip_tags($content), 0, 2000) . "\n\n";
        $prompt .= "الملخص يجب أن يكون:\n";
        $prompt .= "- باللغة العربية\n";
        $prompt .= "- واضح ومفيد\n";
        $prompt .= "- يحفز على القراءة\n";
        $prompt .= "- في حدود $length كلمة تقريباً\n\n";
        $prompt .= "الملخص:";
        
        try {
            $summary = $this->make_ai_request($prompt, array(
                'max_tokens' => $length * 2,
                'temperature' => 0.7
            ));
            
            return trim($summary);
        } catch (Exception $e) {
            return $this->get_basic_summary($content, $length);
        }
    }
    
    /**
     * ==== ملخص أساسي (بديل) ====
     */
    private function get_basic_summary($content, $length) {
        $text = strip_tags($content);
        $sentences = preg_split('/[.!?]+/', $text);
        $summary = '';
        $word_count = 0;
        
        foreach ($sentences as $sentence) {
            $sentence = trim($sentence);
            if (empty($sentence)) continue;
            
            $sentence_words = str_word_count($sentence);
            if ($word_count + $sentence_words <= $length) {
                $summary .= $sentence . '. ';
                $word_count += $sentence_words;
            } else {
                break;
            }
        }
        
        return trim($summary);
    }
    
    /**
     * ==== اقتراح الوسوم التلقائي ====
     */
    public function handle_ai_suggest_tags() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $title = sanitize_text_field($_POST['title'] ?? '');
        $content = wp_kses_post($_POST['content'] ?? '');
        
        if (empty($title) && empty($content)) {
            wp_send_json_error(__('العنوان أو المحتوى مطلوب', 'practical-solutions'));
        }
        
        try {
            $tags = $this->suggest_tags($title, $content);
            wp_send_json_success(array('tags' => $tags));
        } catch (Exception $e) {
            wp_send_json_error(__('حدث خطأ في اقتراح الوسوم', 'practical-solutions'));
        }
    }
    
    /**
     * ==== اقتراح الوسوم ====
     */
    public function suggest_tags($title, $content) {
        if (!$this->is_api_configured()) {
            return $this->get_basic_tags($title, $content);
        }
        
        $existing_tags = $this->get_existing_tags();
        
        $prompt = "اقترح 6-8 وسوم (tags) مناسبة لهذا المحتوى:\n\n";
        $prompt .= "العنوان: $title\n\n";
        $prompt .= "المحتوى: " . substr(strip_tags($content), 0, 1500) . "\n\n";
        
        if (!empty($existing_tags)) {
            $prompt .= "الوسوم الموجودة في الموقع: " . implode('، ', array_slice($existing_tags, 0, 20)) . "\n\n";
        }
        
        $prompt .= "الوسوم يجب أن تكون:\n";
        $prompt .= "- باللغة العربية\n";
        $prompt .= "- قصيرة (1-3 كلمات)\n";
        $prompt .= "- ذات صلة بالمحتوى\n";
        $prompt .= "- مفيدة للبحث\n\n";
        $prompt .= "اكتب كل وسم في سطر منفصل بدون ترقيم:\n";
        $prompt .= "مثال:\nتنظيف المنزل\nنصائح منزلية\nتوفير الوقت\n\nالوسوم:";
        
        try {
            $ai_response = $this->make_ai_request($prompt, array(
                'max_tokens' => 300,
                'temperature' => 0.5
            ));
            
            return $this->parse_suggested_tags($ai_response);
        } catch (Exception $e) {
            return $this->get_basic_tags($title, $content);
        }
    }
    
    /**
     * ==== معالجة الوسوم المقترحة ====
     */
    private function parse_suggested_tags($ai_response) {
        $tags = array();
        $lines = explode("\n", trim($ai_response));
        
        foreach ($lines as $line) {
            $tag = trim($line);
            $tag = preg_replace('/^\d+\.\s*/', '', $tag);
            $tag = preg_replace('/^[-•*]\s*/', '', $tag);
            $tag = trim($tag, '"-\'');
            
            if (!empty($tag) && strlen($tag) >= 2 && strlen($tag) <= 50) {
                $tags[] = $tag;
            }
            
            if (count($tags) >= 8) break;
        }
        
        return array_unique($tags);
    }
    
    /**
     * ==== وسوم أساسية (بديل) ====
     */
    private function get_basic_tags($title, $content) {
        $text = $title . ' ' . strip_tags($content);
        $text = strtolower($text);
        
        $keyword_map = array(
            'تنظيف' => array('تنظيف', 'نظافة', 'تطهير'),
            'مطبخ' => array('مطبخ', 'طبخ', 'طعام'),
            'منزل' => array('منزل', 'بيت', 'ديكور'),
            'صحة' => array('صحة', 'رياضة', 'تغذية'),
            'توفير' => array('توفير', 'اقتصاد', 'مال'),
            'نصائح' => array('نصائح', 'أفكار', 'حلول')
        );
        
        $tags = array();
        foreach ($keyword_map as $tag => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword) !== false) {
                    $tags[] = $tag;
                    break;
                }
            }
        }
        
        return array_unique($tags);
    }
    
    /**
     * ==== الحصول على الوسوم الموجودة ====
     */
    private function get_existing_tags() {
        $tags = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => false,
            'number' => 50,
            'orderby' => 'count',
            'order' => 'DESC'
        ));
        
        return is_array($tags) ? wp_list_pluck($tags, 'name') : array();
    }
    
    /**
     * ==== المعلومات العامة للموقع ====
     */
    private function get_site_categories() {
        $categories = get_categories(array('hide_empty' => false));
        return wp_list_pluck($categories, 'name');
    }
    
    private function get_popular_content() {
        $posts = get_posts(array(
            'numberposts' => 10,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        return wp_list_pluck($posts, 'post_title');
    }
    
    /**
     * ==== التحقق من تكوين API ====
     */
    private function is_api_configured() {
        return !empty($this->api_key) && strlen($this->api_key) > 10;
    }
    
    /**
     * ==== اقتراحات بديلة ====
     */
    private function get_fallback_suggestions($query) {
        $local_suggestions = $this->get_local_search_results($query);
        
        // إضافة اقتراحات عامة
        $general_suggestions = array(
            array(
                'title' => 'نصائح ' . $query,
                'type' => 'general',
                'url' => home_url('/?s=' . urlencode('نصائح ' . $query)),
                'source' => 'fallback'
            ),
            array(
                'title' => 'طرق ' . $query,
                'type' => 'general', 
                'url' => home_url('/?s=' . urlencode('طرق ' . $query)),
                'source' => 'fallback'
            )
        );
        
        return array_merge($local_suggestions, $general_suggestions);
    }
    
    /**
     * ==== معالجة تلقائية للمحتوى الجديد ====
     */
    public function auto_analyze_content($post_id, $post) {
        if (wp_is_post_revision($post_id) || $post->post_type !== 'post') {
            return;
        }
        
        if (!get_option('ps_auto_ai_analysis', false)) {
            return;
        }
        
        // تجنب التحليل المتكرر
        $last_analysis = get_post_meta($post_id, '_ps_ai_analysis_date', true);
        if (!empty($last_analysis)) {
            $last_time = strtotime($last_analysis);
            if ((time() - $last_time) < 3600) { // ساعة واحدة
                return;
            }
        }
        
        try {
            $analysis = $this->analyze_content_with_ai($post->post_content);
            update_post_meta($post_id, '_ps_ai_analysis', $analysis);
            update_post_meta($post_id, '_ps_ai_analysis_date', current_time('mysql'));
        } catch (Exception $e) {
            error_log('Auto AI Analysis Error: ' . $e->getMessage());
        }
    }
    
    /**
     * ==== اقتراح التصنيفات التلقائي ====
     */
    public function auto_suggest_categories($post_id, $post, $update) {
        if ($update || wp_is_post_revision($post_id) || $post->post_type !== 'post') {
            return;
        }
        
        if (!get_option('ps_auto_ai_categorization', false)) {
            return;
        }
        
        // التحقق من وجود تصنيفات
        $categories = wp_get_post_categories($post_id);
        if (!empty($categories)) {
            return; // المقال له تصنيفات بالفعل
        }
        
        try {
            $suggested_category = $this->suggest_category($post->post_title, $post->post_content);
            if ($suggested_category) {
                wp_set_post_categories($post_id, array($suggested_category));
            }
        } catch (Exception $e) {
            error_log('Auto Category Suggestion Error: ' . $e->getMessage());
        }
    }
    
    /**
     * ==== اقتراح التصنيف ====
     */
    private function suggest_category($title, $content) {
        $categories = get_categories(array('hide_empty' => false));
        $category_names = wp_list_pluck($categories, 'name', 'term_id');
        
        if (empty($category_names)) {
            return null;
        }
        
        $text = strtolower($title . ' ' . strip_tags($content));
        
        // خريطة الكلمات المفتاحية للتصنيفات
        $category_keywords = array();
        foreach ($categories as $category) {
            $keywords = array();
            
            switch (strtolower($category->name)) {
                case 'المنزل':
                case 'البيت':
                    $keywords = array('منزل', 'بيت', 'ديكور', 'أثاث', 'ترتيب');
                    break;
                case 'المطبخ':
                    $keywords = array('مطبخ', 'طبخ', 'وصفة', 'طعام', 'أكل');
                    break;
                case 'الصحة':
                    $keywords = array('صحة', 'رياضة', 'تغذية', 'طب', 'علاج');
                    break;
                case 'التقنية':
                    $keywords = array('تقنية', 'تكنولوجيا', 'حاسوب', 'موبايل', 'انترنت');
                    break;
                case 'المال':
                    $keywords = array('مال', 'اقتصاد', 'توفير', 'استثمار', 'دخل');
                    break;
                default:
                    $keywords = array(strtolower($category->name));
                    break;
            }
            
            $category_keywords[$category->term_id] = $keywords;
        }
        
        // العثور على التصنيف الأنسب
        $best_category = null;
        $best_score = 0;
        
        foreach ($category_keywords as $category_id => $keywords) {
            $score = 0;
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword) !== false) {
                    $score++;
                }
            }
            
            if ($score > $best_score) {
                $best_score = $score;
                $best_category = $category_id;
            }
        }
        
        return $best_category;
    }
}

// تهيئة النظام
new PS_AI_OpenRouter_System();