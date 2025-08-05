<?php
/**
 * نظام البحث المتقدم
 * Advanced Search System
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة البحث المتقدم
 */
class MuhtawaaAdvancedSearch {
    
    /**
     * تهيئة نظام البحث المتقدم
     */
    public static function init() {
        // إضافة خطافات البحث
        add_action('init', array(__CLASS__, 'register_search_endpoints'));
        add_action('pre_get_posts', array(__CLASS__, 'modify_search_query'));
        add_filter('posts_search', array(__CLASS__, 'extend_search_fields'), 10, 2);
        add_filter('posts_join', array(__CLASS__, 'search_join_tables'), 10, 2);
        add_filter('posts_where', array(__CLASS__, 'search_where_clause'), 10, 2);
        add_filter('posts_distinct', array(__CLASS__, 'search_distinct'), 10, 2);
        
        // إضافة AJAX للبحث المباشر
        add_action('wp_ajax_muhtawaa_live_search', array(__CLASS__, 'handle_live_search'));
        add_action('wp_ajax_nopriv_muhtawaa_live_search', array(__CLASS__, 'handle_live_search'));
        
        // إضافة خطافات لاقتراحات البحث
        add_action('wp_ajax_muhtawaa_search_suggestions', array(__CLASS__, 'handle_search_suggestions'));
        add_action('wp_ajax_nopriv_muhtawaa_search_suggestions', array(__CLASS__, 'handle_search_suggestions'));
        
        // إضافة شورت كود للبحث المتقدم
        add_shortcode('muhtawaa_advanced_search', array(__CLASS__, 'render_search_form'));
        
        // تسجيل إحصائيات البحث
        add_action('template_redirect', array(__CLASS__, 'track_search_query'));
    }
    
    /**
     * تسجيل نقاط النهاية للبحث
     */
    public static function register_search_endpoints() {
        // إضافة قواعد إعادة الكتابة للبحث المتقدم
        add_rewrite_tag('%search_category%', '([^&]+)');
        add_rewrite_tag('%search_tag%', '([^&]+)');
        add_rewrite_tag('%search_difficulty%', '([^&]+)');
        add_rewrite_tag('%search_date_from%', '([^&]+)');
        add_rewrite_tag('%search_date_to%', '([^&]+)');
        add_rewrite_tag('%search_author%', '([^&]+)');
        add_rewrite_tag('%search_rating%', '([^&]+)');
        add_rewrite_tag('%search_views%', '([^&]+)');
        
        // قاعدة إعادة كتابة للبحث المتقدم
        add_rewrite_rule(
            'advanced-search/?$',
            'index.php?pagename=advanced-search',
            'top'
        );
    }
    
    /**
     * تعديل استعلام البحث
     */
    public static function modify_search_query($query) {
        if (!is_admin() && $query->is_search() && $query->is_main_query()) {
            // تحسين ترتيب النتائج
            $query->set('orderby', 'relevance');
            $query->set('order', 'DESC');
            
            // إضافة فلاتر الفئة
            if (!empty($_GET['search_category'])) {
                $query->set('category_name', sanitize_text_field($_GET['search_category']));
            }
            
            // إضافة فلاتر الوسوم
            if (!empty($_GET['search_tag'])) {
                $query->set('tag', sanitize_text_field($_GET['search_tag']));
            }
            
            // فلتر التاريخ
            if (!empty($_GET['search_date_from']) || !empty($_GET['search_date_to'])) {
                $date_query = array();
                
                if (!empty($_GET['search_date_from'])) {
                    $date_query['after'] = sanitize_text_field($_GET['search_date_from']);
                }
                
                if (!empty($_GET['search_date_to'])) {
                    $date_query['before'] = sanitize_text_field($_GET['search_date_to']);
                }
                
                $date_query['inclusive'] = true;
                $query->set('date_query', array($date_query));
            }
            
            // فلتر الكاتب
            if (!empty($_GET['search_author'])) {
                $author_id = intval($_GET['search_author']);
                if ($author_id > 0) {
                    $query->set('author', $author_id);
                }
            }
            
            // إضافة meta_query للحقول المخصصة
            $meta_query = array();
            
            // فلتر الصعوبة
            if (!empty($_GET['search_difficulty'])) {
                $meta_query[] = array(
                    'key' => '_solution_difficulty',
                    'value' => sanitize_text_field($_GET['search_difficulty']),
                    'compare' => '='
                );
            }
            
            // فلتر التقييم
            if (!empty($_GET['search_rating'])) {
                $rating = floatval($_GET['search_rating']);
                $meta_query[] = array(
                    'key' => '_average_rating',
                    'value' => $rating,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                );
            }
            
            // فلتر عدد المشاهدات
            if (!empty($_GET['search_views'])) {
                $views = intval($_GET['search_views']);
                $meta_query[] = array(
                    'key' => '_total_views',
                    'value' => $views,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                );
            }
            
            if (!empty($meta_query)) {
                $meta_query['relation'] = 'AND';
                $query->set('meta_query', $meta_query);
            }
            
            // تحديد عدد النتائج
            $posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10;
            $query->set('posts_per_page', $posts_per_page);
        }
    }
    
    /**
     * توسيع حقول البحث
     */
    public static function extend_search_fields($search, $wp_query) {
        if (!is_admin() && $wp_query->is_search() && $wp_query->is_main_query()) {
            global $wpdb;
            
            $search_term = $wp_query->get('s');
            if (empty($search_term)) {
                return $search;
            }
            
            // البحث في العنوان والمحتوى والمقتطف
            $search = '';
            $search_term = '%' . $wpdb->esc_like($search_term) . '%';
            
            $search .= $wpdb->prepare("
                AND (
                    ({$wpdb->posts}.post_title LIKE %s)
                    OR ({$wpdb->posts}.post_content LIKE %s)
                    OR ({$wpdb->posts}.post_excerpt LIKE %s)
                    OR EXISTS (
                        SELECT 1 FROM {$wpdb->postmeta}
                        WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
                        AND {$wpdb->postmeta}.meta_key IN ('_solution_steps', '_solution_tools', '_solution_tips')
                        AND {$wpdb->postmeta}.meta_value LIKE %s
                    )
                )
            ", $search_term, $search_term, $search_term, $search_term);
        }
        
        return $search;
    }
    
    /**
     * إضافة جداول للبحث
     */
    public static function search_join_tables($join, $wp_query) {
        if (!is_admin() && $wp_query->is_search() && $wp_query->is_main_query()) {
            global $wpdb;
            
            // إضافة جدول postmeta للبحث في الحقول المخصصة
            $join .= " LEFT JOIN {$wpdb->postmeta} AS search_meta ON ({$wpdb->posts}.ID = search_meta.post_id) ";
        }
        
        return $join;
    }
    
    /**
     * تعديل شرط WHERE للبحث
     */
    public static function search_where_clause($where, $wp_query) {
        if (!is_admin() && $wp_query->is_search() && $wp_query->is_main_query()) {
            // يمكن إضافة شروط إضافية هنا
        }
        
        return $where;
    }
    
    /**
     * إضافة DISTINCT لتجنب التكرار
     */
    public static function search_distinct($distinct, $wp_query) {
        if (!is_admin() && $wp_query->is_search() && $wp_query->is_main_query()) {
            return 'DISTINCT';
        }
        
        return $distinct;
    }
    
    /**
     * معالج البحث المباشر
     */
    public static function handle_live_search() {
        // التحقق من الأمان
        check_ajax_referer('muhtawaa_ajax_nonce', 'nonce');
        
        $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
        $category = isset($_POST['category']) ? intval($_POST['category']) : 0;
        
        if (strlen($search_query) < 3) {
            wp_send_json_error(array('message' => __('يجب أن يكون البحث 3 أحرف على الأقل', 'muhtawaa')));
        }
        
        // إعداد معاملات البحث
        $args = array(
            's' => $search_query,
            'posts_per_page' => 5,
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => 'relevance date',
            'order' => 'DESC'
        );
        
        if ($category > 0) {
            $args['cat'] = $category;
        }
        
        // تنفيذ البحث
        $query = new WP_Query($args);
        $results = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => wp_trim_words(get_the_excerpt(), 15),
                    'permalink' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                    'category' => get_the_category_list(', '),
                    'date' => get_the_date(),
                    'author' => get_the_author(),
                    'views' => get_post_meta(get_the_ID(), '_total_views', true) ?: 0,
                    'rating' => get_post_meta(get_the_ID(), '_average_rating', true) ?: 0
                );
            }
            
            wp_reset_postdata();
        }
        
        wp_send_json_success(array(
            'results' => $results,
            'total' => $query->found_posts,
            'message' => sprintf(__('تم العثور على %d نتيجة', 'muhtawaa'), $query->found_posts)
        ));
    }
    
    /**
     * معالج اقتراحات البحث
     */
    public static function handle_search_suggestions() {
        // التحقق من الأمان
        check_ajax_referer('muhtawaa_ajax_nonce', 'nonce');
        
        $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
        
        if (strlen($query) < 2) {
            wp_send_json_error();
        }
        
        global $wpdb;
        
        // البحث عن الاقتراحات من العناوين
        $suggestions = $wpdb->get_results($wpdb->prepare("
            SELECT DISTINCT post_title
            FROM {$wpdb->posts}
            WHERE post_type = 'post'
            AND post_status = 'publish'
            AND post_title LIKE %s
            ORDER BY post_date DESC
            LIMIT 10
        ", '%' . $wpdb->esc_like($query) . '%'));
        
        $result = array();
        foreach ($suggestions as $suggestion) {
            $result[] = $suggestion->post_title;
        }
        
        // إضافة اقتراحات من سجل البحث الشائع
        $popular_searches = get_option('muhtawaa_popular_searches', array());
        foreach ($popular_searches as $search => $count) {
            if (stripos($search, $query) !== false && !in_array($search, $result)) {
                $result[] = $search;
            }
        }
        
        // تحديد عدد الاقتراحات
        $result = array_slice($result, 0, 8);
        
        wp_send_json_success($result);
    }
    
    /**
     * عرض نموذج البحث المتقدم
     */
    public static function render_search_form($atts = array()) {
        $atts = shortcode_atts(array(
            'show_filters' => true,
            'show_categories' => true,
            'show_tags' => true,
            'show_date' => true,
            'show_author' => true,
            'show_difficulty' => true,
            'show_rating' => true,
            'placeholder' => __('ابحث عن الحلول...', 'muhtawaa')
        ), $atts);
        
        ob_start();
        ?>
        <div class="muhtawaa-advanced-search" id="muhtawaa-advanced-search">
            <form role="search" method="get" class="search-form advanced-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                
                <!-- حقل البحث الرئيسي -->
                <div class="search-main-field">
                    <div class="search-input-wrapper">
                        <input type="search" 
                               class="search-field" 
                               placeholder="<?php echo esc_attr($atts['placeholder']); ?>" 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" 
                               id="search-field"
                               autocomplete="off">
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                            <span class="screen-reader-text"><?php echo esc_html__('بحث', 'muhtawaa'); ?></span>
                        </button>
                    </div>
                    
                    <!-- اقتراحات البحث -->
                    <div class="search-suggestions" id="search-suggestions" style="display: none;"></div>
                </div>
                
                <?php if ($atts['show_filters']) : ?>
                <!-- زر إظهار/إخفاء الفلاتر -->
                <button type="button" class="toggle-filters" id="toggle-filters">
                    <i class="fas fa-filter"></i>
                    <?php echo esc_html__('خيارات البحث المتقدم', 'muhtawaa'); ?>
                </button>
                
                <!-- الفلاتر المتقدمة -->
                <div class="advanced-filters" id="advanced-filters" style="display: none;">
                    <div class="filters-grid">
                        
                        <?php if ($atts['show_categories']) : ?>
                        <!-- فلتر الفئات -->
                        <div class="filter-group">
                            <label for="search_category"><?php echo esc_html__('الفئة', 'muhtawaa'); ?></label>
                            <?php
                            wp_dropdown_categories(array(
                                'show_option_all' => __('جميع الفئات', 'muhtawaa'),
                                'name' => 'search_category',
                                'id' => 'search_category',
                                'class' => 'filter-select',
                                'hierarchical' => true,
                                'depth' => 2,
                                'selected' => isset($_GET['search_category']) ? intval($_GET['search_category']) : 0
                            ));
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_tags']) : ?>
                        <!-- فلتر الوسوم -->
                        <div class="filter-group">
                            <label for="search_tag"><?php echo esc_html__('الوسم', 'muhtawaa'); ?></label>
                            <select name="search_tag" id="search_tag" class="filter-select">
                                <option value=""><?php echo esc_html__('جميع الوسوم', 'muhtawaa'); ?></option>
                                <?php
                                $tags = get_tags(array('hide_empty' => true));
                                $selected_tag = isset($_GET['search_tag']) ? $_GET['search_tag'] : '';
                                foreach ($tags as $tag) {
                                    printf(
                                        '<option value="%s"%s>%s (%d)</option>',
                                        esc_attr($tag->slug),
                                        selected($selected_tag, $tag->slug, false),
                                        esc_html($tag->name),
                                        $tag->count
                                    );
                                }
                                ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_difficulty']) : ?>
                        <!-- فلتر الصعوبة -->
                        <div class="filter-group">
                            <label for="search_difficulty"><?php echo esc_html__('مستوى الصعوبة', 'muhtawaa'); ?></label>
                            <select name="search_difficulty" id="search_difficulty" class="filter-select">
                                <option value=""><?php echo esc_html__('جميع المستويات', 'muhtawaa'); ?></option>
                                <option value="سهل جداً" <?php selected(isset($_GET['search_difficulty']) ? $_GET['search_difficulty'] : '', 'سهل جداً'); ?>><?php echo esc_html__('سهل جداً', 'muhtawaa'); ?></option>
                                <option value="سهل" <?php selected(isset($_GET['search_difficulty']) ? $_GET['search_difficulty'] : '', 'سهل'); ?>><?php echo esc_html__('سهل', 'muhtawaa'); ?></option>
                                <option value="متوسط" <?php selected(isset($_GET['search_difficulty']) ? $_GET['search_difficulty'] : '', 'متوسط'); ?>><?php echo esc_html__('متوسط', 'muhtawaa'); ?></option>
                                <option value="صعب" <?php selected(isset($_GET['search_difficulty']) ? $_GET['search_difficulty'] : '', 'صعب'); ?>><?php echo esc_html__('صعب', 'muhtawaa'); ?></option>
                            </select>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_author']) : ?>
                        <!-- فلتر الكاتب -->
                        <div class="filter-group">
                            <label for="search_author"><?php echo esc_html__('الكاتب', 'muhtawaa'); ?></label>
                            <?php
                            wp_dropdown_users(array(
                                'show_option_all' => __('جميع الكتاب', 'muhtawaa'),
                                'name' => 'search_author',
                                'id' => 'search_author',
                                'class' => 'filter-select',
                                'who' => 'authors',
                                'selected' => isset($_GET['search_author']) ? intval($_GET['search_author']) : 0
                            ));
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_date']) : ?>
                        <!-- فلتر التاريخ من -->
                        <div class="filter-group">
                            <label for="search_date_from"><?php echo esc_html__('من تاريخ', 'muhtawaa'); ?></label>
                            <input type="date" 
                                   name="search_date_from" 
                                   id="search_date_from" 
                                   class="filter-input" 
                                   value="<?php echo isset($_GET['search_date_from']) ? esc_attr($_GET['search_date_from']) : ''; ?>">
                        </div>
                        
                        <!-- فلتر التاريخ إلى -->
                        <div class="filter-group">
                            <label for="search_date_to"><?php echo esc_html__('إلى تاريخ', 'muhtawaa'); ?></label>
                            <input type="date" 
                                   name="search_date_to" 
                                   id="search_date_to" 
                                   class="filter-input" 
                                   value="<?php echo isset($_GET['search_date_to']) ? esc_attr($_GET['search_date_to']) : ''; ?>">
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_rating']) : ?>
                        <!-- فلتر التقييم -->
                        <div class="filter-group">
                            <label for="search_rating"><?php echo esc_html__('التقييم الأدنى', 'muhtawaa'); ?></label>
                            <select name="search_rating" id="search_rating" class="filter-select">
                                <option value=""><?php echo esc_html__('جميع التقييمات', 'muhtawaa'); ?></option>
                                <option value="1" <?php selected(isset($_GET['search_rating']) ? $_GET['search_rating'] : '', '1'); ?>>⭐ <?php echo esc_html__('فما فوق', 'muhtawaa'); ?></option>
                                <option value="2" <?php selected(isset($_GET['search_rating']) ? $_GET['search_rating'] : '', '2'); ?>>⭐⭐ <?php echo esc_html__('فما فوق', 'muhtawaa'); ?></option>
                                <option value="3" <?php selected(isset($_GET['search_rating']) ? $_GET['search_rating'] : '', '3'); ?>>⭐⭐⭐ <?php echo esc_html__('فما فوق', 'muhtawaa'); ?></option>
                                <option value="4" <?php selected(isset($_GET['search_rating']) ? $_GET['search_rating'] : '', '4'); ?>>⭐⭐⭐⭐ <?php echo esc_html__('فما فوق', 'muhtawaa'); ?></option>
                                <option value="5" <?php selected(isset($_GET['search_rating']) ? $_GET['search_rating'] : '', '5'); ?>>⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>
                        <?php endif; ?>
                        
                        <!-- عدد النتائج في الصفحة -->
                        <div class="filter-group">
                            <label for="posts_per_page"><?php echo esc_html__('النتائج في الصفحة', 'muhtawaa'); ?></label>
                            <select name="posts_per_page" id="posts_per_page" class="filter-select">
                                <option value="10" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : '10', '10'); ?>>10</option>
                                <option value="20" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : '', '20'); ?>>20</option>
                                <option value="30" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : '', '30'); ?>>30</option>
                                <option value="50" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : '', '50'); ?>>50</option>
                            </select>
                        </div>
                        
                    </div>
                    
                    <!-- أزرار التحكم -->
                    <div class="filter-actions">
                        <button type="submit" class="btn-apply-filters">
                            <i class="fas fa-check"></i>
                            <?php echo esc_html__('تطبيق الفلاتر', 'muhtawaa'); ?>
                        </button>
                        <button type="button" class="btn-reset-filters" id="reset-filters">
                            <i class="fas fa-times"></i>
                            <?php echo esc_html__('إعادة تعيين', 'muhtawaa'); ?>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                
            </form>
            
            <!-- نتائج البحث المباشر -->
            <div class="live-search-results" id="live-search-results" style="display: none;">
                <div class="results-header">
                    <h3><?php echo esc_html__('نتائج البحث السريع', 'muhtawaa'); ?></h3>
                    <button type="button" class="close-results" id="close-results">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="results-content" id="results-content">
                    <!-- النتائج ستظهر هنا -->
                </div>
            </div>
        </div>
        
        <style>
        /* أنماط البحث المتقدم */
        .muhtawaa-advanced-search {
            position: relative;
            max-width: 100%;
            margin: 20px 0;
        }
        
        .search-main-field {
            position: relative;
        }
        
        .search-input-wrapper {
            display: flex;
            align-items: center;
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .search-input-wrapper:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .search-field {
            flex: 1;
            padding: 15px 25px;
            border: none;
            outline: none;
            font-size: 16px;
            background: transparent;
        }
        
        .search-submit {
            padding: 15px 25px;
            background: #667eea;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .search-submit:hover {
            background: #5a67d8;
        }
        
        .toggle-filters {
            margin-top: 15px;
            padding: 10px 20px;
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .toggle-filters:hover {
            background: #edf2f7;
        }
        
        .advanced-filters {
            margin-top: 20px;
            padding: 25px;
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .filter-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }
        
        .filter-select,
        .filter-input {
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .filter-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .btn-apply-filters,
        .btn-reset-filters {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-apply-filters {
            background: #667eea;
            color: #fff;
        }
        
        .btn-apply-filters:hover {
            background: #5a67d8;
        }
        
        .btn-reset-filters {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-reset-filters:hover {
            background: #cbd5e0;
        }
        
        /* اقتراحات البحث */
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-top: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .suggestion-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.2s ease;
            border-bottom: 1px solid #f7fafc;
        }
        
        .suggestion-item:last-child {
            border-bottom: none;
        }
        
        .suggestion-item:hover {
            background: #f7fafc;
        }
        
        .suggestion-item strong {
            color: #667eea;
        }
        
        /* نتائج البحث المباشر */
        .live-search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-top: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 999;
            max-height: 500px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f7fafc;
        }
        
        .results-header h3 {
            margin: 0;
            font-size: 16px;
            color: #2d3748;
        }
        
        .close-results {
            background: none;
            border: none;
            font-size: 20px;
            color: #718096;
            cursor: pointer;
            padding: 5px;
        }
        
        .close-results:hover {
            color: #2d3748;
        }
        
        .results-content {
            padding: 20px;
            overflow-y: auto;
            flex: 1;
        }
        
        .search-result-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f7fafc;
            transition: background 0.2s ease;
        }
        
        .search-result-item:last-child {
            border-bottom: none;
        }
        
        .search-result-item:hover {
            background: #f7fafc;
        }
        
        .result-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }
        
        .result-content {
            flex: 1;
        }
        
        .result-title {
            margin: 0 0 5px;
            font-size: 16px;
            font-weight: 600;
        }
        
        .result-title a {
            color: #2d3748;
            text-decoration: none;
        }
        
        .result-title a:hover {
            color: #667eea;
        }
        
        .result-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #718096;
            margin-top: 5px;
        }
        
        .result-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .result-excerpt {
            margin-top: 8px;
            font-size: 14px;
            color: #4a5568;
            line-height: 1.5;
        }
        
        /* تجاوب */
        @media (max-width: 768px) {
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-actions {
                flex-direction: column;
            }
            
            .btn-apply-filters,
            .btn-reset-filters {
                width: 100%;
                justify-content: center;
            }
            
            .search-result-item {
                flex-direction: column;
            }
            
            .result-thumbnail {
                width: 100%;
                height: 200px;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // متغيرات
            var searchField = $('#search-field');
            var searchSuggestions = $('#search-suggestions');
            var toggleFilters = $('#toggle-filters');
            var advancedFilters = $('#advanced-filters');
            var resetFilters = $('#reset-filters');
            var liveSearchResults = $('#live-search-results');
            var resultsContent = $('#results-content');
            var closeResults = $('#close-results');
            var searchTimer;
            var suggestionTimer;
            
            // إظهار/إخفاء الفلاتر المتقدمة
            toggleFilters.on('click', function() {
                advancedFilters.slideToggle();
                $(this).toggleClass('active');
            });
            
            // إعادة تعيين الفلاتر
            resetFilters.on('click', function() {
                $('.filter-select').val('');
                $('.filter-input').val('');
                searchField.val('').focus();
            });
            
            // البحث المباشر
            searchField.on('input', function() {
                clearTimeout(searchTimer);
                var query = $(this).val();
                
                if (query.length >= 3) {
                    searchTimer = setTimeout(function() {
                        performLiveSearch(query);
                    }, 500);
                } else {
                    liveSearchResults.hide();
                }
            });
            
            // اقتراحات البحث
            searchField.on('input', function() {
                clearTimeout(suggestionTimer);
                var query = $(this).val();
                
                if (query.length >= 2) {
                    suggestionTimer = setTimeout(function() {
                        fetchSearchSuggestions(query);
                    }, 300);
                } else {
                    searchSuggestions.hide();
                }
            });
            
            // إغلاق نتائج البحث المباشر
            closeResults.on('click', function() {
                liveSearchResults.hide();
            });
            
            // إغلاق القوائم عند النقر خارجها
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.muhtawaa-advanced-search').length) {
                    searchSuggestions.hide();
                    liveSearchResults.hide();
                }
            });
            
            // وظيفة البحث المباشر
            function performLiveSearch(query) {
                $.ajax({
                    url: muhtawaa_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_live_search',
                        nonce: muhtawaa_ajax.nonce,
                        query: query,
                        category: $('#search_category').val()
                    },
                    beforeSend: function() {
                        resultsContent.html('<div class="loading"><i class="fas fa-spinner fa-spin"></i> جاري البحث...</div>');
                        liveSearchResults.show();
                    },
                    success: function(response) {
                        if (response.success && response.data.results.length > 0) {
                            var html = '';
                            
                            $.each(response.data.results, function(index, result) {
                                html += '<div class="search-result-item">';
                                
                                if (result.thumbnail) {
                                    html += '<img src="' + result.thumbnail + '" alt="' + result.title + '" class="result-thumbnail">';
                                }
                                
                                html += '<div class="result-content">';
                                html += '<h4 class="result-title"><a href="' + result.permalink + '">' + result.title + '</a></h4>';
                                
                                html += '<div class="result-meta">';
                                html += '<span><i class="far fa-calendar"></i> ' + result.date + '</span>';
                                html += '<span><i class="far fa-user"></i> ' + result.author + '</span>';
                                html += '<span><i class="far fa-eye"></i> ' + result.views + '</span>';
                                
                                if (result.rating > 0) {
                                    html += '<span><i class="fas fa-star"></i> ' + result.rating + '</span>';
                                }
                                
                                html += '</div>';
                                
                                if (result.excerpt) {
                                    html += '<p class="result-excerpt">' + result.excerpt + '</p>';
                                }
                                
                                html += '</div>';
                                html += '</div>';
                            });
                            
                            resultsContent.html(html);
                        } else {
                            resultsContent.html('<div class="no-results">لم يتم العثور على نتائج</div>');
                        }
                    },
                    error: function() {
                        resultsContent.html('<div class="error">حدث خطأ أثناء البحث</div>');
                    }
                });
            }
            
            // وظيفة جلب اقتراحات البحث
            function fetchSearchSuggestions(query) {
                $.ajax({
                    url: muhtawaa_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_search_suggestions',
                        nonce: muhtawaa_ajax.nonce,
                        query: query
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            var html = '';
                            
                            $.each(response.data, function(index, suggestion) {
                                var highlighted = suggestion.replace(new RegExp('(' + query + ')', 'gi'), '<strong>$1</strong>');
                                html += '<div class="suggestion-item" data-suggestion="' + suggestion + '">' + highlighted + '</div>';
                            });
                            
                            searchSuggestions.html(html).show();
                            
                            // النقر على اقتراح
                            $('.suggestion-item').on('click', function() {
                                var suggestion = $(this).data('suggestion');
                                searchField.val(suggestion);
                                searchSuggestions.hide();
                                performLiveSearch(suggestion);
                            });
                        } else {
                            searchSuggestions.hide();
                        }
                    }
                });
            }
        });
        </script>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * تتبع استعلامات البحث
     */
    public static function track_search_query() {
        if (is_search() && !is_admin()) {
            $search_query = get_search_query();
            
            if (!empty($search_query)) {
                // الحصول على سجل البحث الحالي
                $search_history = get_option('muhtawaa_search_history', array());
                
                // إضافة البحث الجديد
                $date = current_time('mysql');
                $search_history[] = array(
                    'query' => $search_query,
                    'date' => $date,
                    'results_count' => $GLOBALS['wp_query']->found_posts,
                    'user_ip' => $_SERVER['REMOTE_ADDR']
                );
                
                // الاحتفاظ بآخر 1000 عملية بحث فقط
                if (count($search_history) > 1000) {
                    $search_history = array_slice($search_history, -1000);
                }
                
                update_option('muhtawaa_search_history', $search_history);
                
                // تحديث البحث الشائع
                $popular_searches = get_option('muhtawaa_popular_searches', array());
                
                if (isset($popular_searches[$search_query])) {
                    $popular_searches[$search_query]++;
                } else {
                    $popular_searches[$search_query] = 1;
                }
                
                // ترتيب حسب الشعبية
                arsort($popular_searches);
                
                // الاحتفاظ بأفضل 50 بحث
                $popular_searches = array_slice($popular_searches, 0, 50, true);
                
                update_option('muhtawaa_popular_searches', $popular_searches);
            }
        }
    }
    
    /**
     * الحصول على أشهر عمليات البحث
     */
    public static function get_popular_searches($limit = 10) {
        $popular_searches = get_option('muhtawaa_popular_searches', array());
        return array_slice($popular_searches, 0, $limit, true);
    }
    
    /**
     * الحصول على عمليات البحث الأخيرة
     */
    public static function get_recent_searches($limit = 10) {
        $search_history = get_option('muhtawaa_search_history', array());
        return array_slice(array_reverse($search_history), 0, $limit);
    }
    
    /**
     * عرض ويدجت البحث الشائع
     */
    public static function display_popular_searches_widget() {
        $popular_searches = self::get_popular_searches(8);
        
        if (!empty($popular_searches)) {
            echo '<div class="popular-searches-widget">';
            echo '<h3>' . __('عمليات البحث الشائعة', 'muhtawaa') . '</h3>';
            echo '<div class="search-tags">';
            
            foreach ($popular_searches as $search => $count) {
                $url = add_query_arg('s', urlencode($search), home_url('/'));
                printf(
                    '<a href="%s" class="search-tag">%s <span>(%d)</span></a>',
                    esc_url($url),
                    esc_html($search),
                    $count
                );
            }
            
            echo '</div>';
            echo '</div>';
        }
    }
}

// تهيئة نظام البحث المتقدم
add_action('init', array('MuhtawaaAdvancedSearch', 'init'));
?>