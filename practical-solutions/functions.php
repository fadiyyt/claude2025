<?php
/**
 * ملف الوظائف الرئيسي - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إعداد القالب
 */
function practical_solutions_setup() {
    // دعم اللغة العربية
    load_theme_textdomain('practical-solutions', get_template_directory() . '/languages');
    
    // دعم الصور المميزة
    add_theme_support('post-thumbnails');
    
    // أحجام الصور المخصصة
    add_image_size('card-thumb', 400, 250, true);
    add_image_size('hero-thumb', 800, 400, true);
    add_image_size('mobile-thumb', 300, 200, true);
    
    // دعم القوائم
    add_theme_support('menus');
    
    // دعم العنوان التلقائي
    add_theme_support('title-tag');
    
    // دعم HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // دعم التخصيص
    add_theme_support('customize-selective-refresh-widgets');
    
    // تسجيل القوائم
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'practical-solutions'),
        'footer' => __('قائمة التذييل', 'practical-solutions'),
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * تحميل الملفات والأنماط
 */
function practical_solutions_enqueue_scripts() {
    // تحميل ملف CSS الرئيسي
    wp_enqueue_style('practical-solutions-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // تحميل خطوط جوجل العربية
    wp_enqueue_style(
        'google-fonts-arabic',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Tajawal:wght@300;400;500;700&display=swap',
        array(),
        null
    );
    
    // تحميل jQuery
    wp_enqueue_script('jquery');
    
    // تمرير بيانات للجافاسكريبت
    wp_localize_script('jquery', 'practicalAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('practical_nonce'),
        'search_placeholder' => __('ابحث عن الحلول...', 'practical-solutions'),
        'loading_text' => __('جارٍ التحميل...', 'practical-solutions'),
        'no_results' => __('لا توجد نتائج', 'practical-solutions'),
        'home_url' => home_url()
    ));
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_scripts');

/**
 * تسجيل مناطق الودجات
 */
function practical_solutions_widgets_init() {
    register_sidebar(array(
        'name' => __('الشريط الجانبي الرئيسي', 'practical-solutions'),
        'id' => 'sidebar-main',
        'description' => __('منطقة الودجات للشريط الجانبي', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('تذييل الموقع', 'practical-solutions'),
        'id' => 'footer-widgets',
        'description' => __('منطقة ودجات التذييل', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'practical_solutions_widgets_init');

/**
 * البحث المباشر عبر AJAX
 */
function practical_solutions_live_search() {
    // التحقق من الأمان - تحسين التحقق من nonce
    $nonce = $_POST['nonce'] ?? $_REQUEST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'practical_nonce')) {
        wp_send_json_error('خطأ في التحقق من الأمان');
        return;
    }
    
    $query = sanitize_text_field($_POST['query'] ?? $_REQUEST['query'] ?? '');
    
    if (strlen($query) < 2) {
        wp_send_json_error('استعلام قصير جداً');
        return;
    }
    
    $search_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        's' => $query,
        'orderby' => 'relevance'
    ));
    
    $results = array();
    
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            
            $categories = get_the_category();
            $category_name = '';
            if (!empty($categories)) {
                $category_name = $categories[0]->name;
            }
            
            $thumbnail = '';
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            }
            
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 10, '...'),
                'category' => $category_name,
                'thumbnail' => $thumbnail
            );
        }
        wp_reset_postdata();
    }
    
    if (empty($results)) {
        wp_send_json_error('لا توجد نتائج');
        return;
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_live_search', 'practical_solutions_live_search');
add_action('wp_ajax_nopriv_live_search', 'practical_solutions_live_search');

/**
 * تقييم المقالات عبر AJAX
 */
function practical_solutions_rate_article() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'practical_nonce')) {
        wp_send_json_error('خطأ في التحقق من الأمان');
        return;
    }
    
    $post_id = intval($_POST['post_id'] ?? 0);
    $rating = sanitize_text_field($_POST['rating'] ?? '');
    
    // التحقق من صحة البيانات
    if (!$post_id || !in_array($rating, ['positive', 'negative'])) {
        wp_send_json_error('بيانات غير صحيحة');
        return;
    }
    
    // التحقق من وجود المقال
    if (!get_post($post_id)) {
        wp_send_json_error('المقال غير موجود');
        return;
    }
    
    // التحقق من عدم تقييم المستخدم مسبقاً
    $user_ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $rated_key = 'rated_' . $post_id . '_' . md5($user_ip);
    
    if (get_transient($rated_key)) {
        wp_send_json_error('لقد قمت بتقييم هذا المقال من قبل');
        return;
    }
    
    // حفظ التقييم
    if ($rating === 'positive') {
        $current = intval(get_post_meta($post_id, 'positive_ratings', true));
        update_post_meta($post_id, 'positive_ratings', $current + 1);
    } else {
        $current = intval(get_post_meta($post_id, 'negative_ratings', true));
        update_post_meta($post_id, 'negative_ratings', $current + 1);
    }
    
    // منع التقييم مرة أخرى لمدة 24 ساعة
    set_transient($rated_key, true, 24 * HOUR_IN_SECONDS);
    
    wp_send_json_success(array(
        'positive_count' => intval(get_post_meta($post_id, 'positive_ratings', true)),
        'negative_count' => intval(get_post_meta($post_id, 'negative_ratings', true)),
        'message' => 'شكراً لتقييمك!'
    ));
}
add_action('wp_ajax_rate_article', 'practical_solutions_rate_article');
add_action('wp_ajax_nopriv_rate_article', 'practical_solutions_rate_article');

/**
 * عداد المشاهدات للمقالات
 */
function practical_solutions_set_post_views($post_id) {
    $key = 'post_views';
    $count = get_post_meta($post_id, $key, true);
    
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $key);
        add_post_meta($post_id, $key, '1');
    } else {
        $count++;
        update_post_meta($post_id, $key, $count);
    }
}

function practical_solutions_track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    practical_solutions_set_post_views($post_id);
}
add_action('wp_head', 'practical_solutions_track_post_views');

/**
 * إضافة حقول مخصصة للمقالات المميزة
 */
function practical_solutions_add_meta_boxes() {
    add_meta_box(
        'featured-post',
        __('إعدادات المقال المميز', 'practical-solutions'),
        'practical_solutions_featured_post_callback',
        'post',
        'side',
        'high'
    );
    
    add_meta_box(
        'solution-details',
        __('تفاصيل الحل', 'practical-solutions'),
        'practical_solutions_solution_details_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'practical_solutions_add_meta_boxes');

function practical_solutions_featured_post_callback($post) {
    wp_nonce_field('save_featured_post', 'featured_post_nonce');
    $featured = get_post_meta($post->ID, 'featured_post', true);
    /**
 * تتبع النقرات في نتائج البحث
 */
function practical_solutions_track_search_click() {
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'practical_nonce')) {
        wp_send_json_error('خطأ في التحقق من الأمان');
        return;
    }
    
    $post_id = intval($_POST['post_id'] ?? 0);
    $query = sanitize_text_field($_POST['query'] ?? '');
    $position = intval($_POST['position'] ?? 0);
    
    // يمكن حفظ هذه البيانات في قاعدة البيانات للتحليل لاحقاً
    // أو استخدام Google Analytics
    
    wp_send_json_success(array('message' => 'تم تسجيل النقرة'));
}
add_action('wp_ajax_track_search_click', 'practical_solutions_track_search_click');
add_action('wp_ajax_nopriv_track_search_click', 'practical_solutions_track_search_click');

?>
    <p>
        <label>
            <input type="checkbox" name="featured_post" value="1" <?php checked($featured, '1'); ?>>
            <?php _e('جعل هذا المقال مميزاً', 'practical-solutions'); ?>
        </label>
    </p>
    <?php
}

function practical_solutions_solution_details_callback($post) {
    wp_nonce_field('save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, 'difficulty_level', true);
    $time_required = get_post_meta($post->ID, 'time_required', true);
    $materials = get_post_meta($post->ID, 'required_materials', true);
    $tips = get_post_meta($post->ID, 'additional_tips', true);
    $warnings = get_post_meta($post->ID, 'safety_warnings', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="difficulty_level">مستوى الصعوبة</label></th>
            <td>
                <select name="difficulty_level" id="difficulty_level">
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="time_required">الوقت المطلوب (بالدقائق)</label></th>
            <td><input type="number" name="time_required" id="time_required" value="<?php echo esc_attr($time_required); ?>" /></td>
        </tr>
        <tr>
            <th><label for="required_materials">المواد المطلوبة</label></th>
            <td><textarea name="required_materials" id="required_materials" rows="4" cols="50"><?php echo esc_textarea($materials); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="additional_tips">نصائح إضافية</label></th>
            <td><textarea name="additional_tips" id="additional_tips" rows="4" cols="50"><?php echo esc_textarea($tips); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="safety_warnings">تحذيرات الأمان</label></th>
            <td><textarea name="safety_warnings" id="safety_warnings" rows="3" cols="50"><?php echo esc_textarea($warnings); ?></textarea></td>
        </tr>
    </table>
    <?php
}

function practical_solutions_save_meta_boxes($post_id) {
    // التحقق من التخزين التلقائي
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // التحقق من الصلاحيات
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // حفظ المقال المميز
    if (isset($_POST['featured_post_nonce']) && wp_verify_nonce($_POST['featured_post_nonce'], 'save_featured_post')) {
        $featured = isset($_POST['featured_post']) ? '1' : '0';
        update_post_meta($post_id, 'featured_post', $featured);
    }
    
    // حفظ تفاصيل الحل
    if (isset($_POST['solution_details_nonce']) && wp_verify_nonce($_POST['solution_details_nonce'], 'save_solution_details')) {
        $fields = ['difficulty_level', 'time_required', 'required_materials', 'additional_tips', 'safety_warnings'];
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'practical_solutions_save_meta_boxes');

/**
 * تخصيص صفحة الإعدادات
 */
function practical_solutions_customizer($wp_customize) {
    // قسم الألوان
    $wp_customize->add_section('practical_colors', array(
        'title' => __('ألوان القالب', 'practical-solutions'),
        'priority' => 30,
    ));
    
    // اللون الأساسي
    $wp_customize->add_setting('primary_color', array(
        'default' => '#4a90e2',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('اللون الأساسي', 'practical-solutions'),
        'section' => 'practical_colors',
        'settings' => 'primary_color',
    )));
    
    // اللون الثانوي
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#f39c12',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('اللون الثانوي', 'practical-solutions'),
        'section' => 'practical_colors',
        'settings' => 'secondary_color',
    )));
}
add_action('customize_register', 'practical_solutions_customizer');

/**
 * إضافة الألوان المخصصة إلى CSS
 */
function practical_solutions_custom_colors() {
    $primary_color = get_theme_mod('primary_color', '#4a90e2');
    $secondary_color = get_theme_mod('secondary_color', '#f39c12');
    
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'practical_solutions_custom_colors');

/**
 * إزالة العناصر غير المرغوب فيها
 */
function practical_solutions_clean_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
}
add_action('init', 'practical_solutions_clean_head');

/**
 * تحسين الأداء
 */
function practical_solutions_optimize_performance() {
    // إزالة ملفات CSS و JS غير المطلوبة
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style');
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_optimize_performance', 100);

/**
 * إعدادات الأمان
 */
function practical_solutions_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'practical_solutions_security_headers');

/**
 * إصلاح مؤقت للأيقونات المفقودة
 */
function practical_solutions_temp_icon_fix() {
    ?>
    <style>
    /* إصلاح مؤقت للأيقونات المفقودة */
    .nav-icon {
        background: var(--gradient-bg) !important;
        color: white !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    /* إخفاء أخطاء الصور المفقودة */
    img[src=""], img:not([src]) {
        display: none;
    }
    
    /* استبدال الأيقونات المفقودة بـ emojis مؤقتاً */
    .nav-icon::before {
        font-size: 24px;
    }
    
    .nav-item:nth-child(1) .nav-icon::before { content: "🏠"; }
    .nav-item:nth-child(2) .nav-icon::before { content: "👨‍🍳"; }
    .nav-item:nth-child(3) .nav-icon::before { content: "🧹"; }
    .nav-item:nth-child(4) .nav-icon::before { content: "🔧"; }
    .nav-item:nth-child(5) .nav-icon::before { content: "💡"; }
    .nav-item:nth-child(6) .nav-icon::before { content: "🌱"; }
    </style>
    
    <script>
    // إخفاء أخطاء الصور المفقودة
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'practical_solutions_temp_icon_fix');

/**
 * دالة مساعدة لحساب وقت القراءة
 */
function practical_solutions_reading_time($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة
    
    return max(1, $reading_time);
}

/**
 * دالة لتمييز كلمات البحث
 */
function practical_highlight_search_terms($text, $search_terms) {
    if (empty($search_terms)) {
        return $text;
    }
    
    $terms = explode(' ', $search_terms);
    foreach ($terms as $term) {
        if (strlen(trim($term)) > 2) {
            $text = preg_replace('/(' . preg_quote(trim($term), '/') . ')/ui', '<mark>$1</mark>', $text);
        }
    }
    
    return $text;
}

/**
 * إضافة اقتراحات البحث
 */
function practical_solutions_get_search_suggestions() {
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'practical_nonce')) {
        wp_send_json_error('خطأ في التحقق من الأمان');
        return;
    }
    
    $query = sanitize_text_field($_POST['query'] ?? '');
    $suggestions = array();
    
    // البحث في العناوين
    $posts = get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        's' => $query
    ));
    
    foreach ($posts as $post) {
        $suggestions[] = $post->post_title;
    }
    
    // إضافة اقتراحات من الكلمات المفتاحية
    $tags = get_tags(array(
        'name__like' => $query,
        'number' => 3
    ));
    
    foreach ($tags as $tag) {
        $suggestions[] = $tag->name;
    }
    
    // إزالة التكرارات
    $suggestions = array_unique($suggestions);
    
    wp_send_json_success(array_slice($suggestions, 0, 5));
}
add_action('wp_ajax_get_search_suggestions', 'practical_solutions_get_search_suggestions');
add_action('wp_ajax_nopriv_get_search_suggestions', 'practical_solutions_get_search_suggestions');

?>