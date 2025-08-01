<?php
/**
 * Theme Name: محتوى - الحلول اليومية
 * Functions and definitions - النسخة المُصححة
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// إعداد القالب
function muhtawaa_theme_setup() {
    // دعم اللغة العربية
    load_theme_textdomain('muhtawaa', get_template_directory() . '/languages');
    
    // دعم الصور المميزة
    add_theme_support('post-thumbnails');
    
    // دعم القوائم
    add_theme_support('menus');
    
    // دعم العناوين التلقائية
    add_theme_support('title-tag');
    
    // دعم HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form', 
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // دعم الخلاصات
    add_theme_support('automatic-feed-links');
    
    // دعم شعار مخصص
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 100,
        'flex-height' => true,
        'flex-width' => true,
    ));
    
    // تسجيل القوائم
    register_nav_menus(array(
        'main-menu' => __('القائمة الرئيسية', 'muhtawaa'),
        'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
    ));
    
    // دعم أحجام الصور المخصصة
    add_image_size('solution-thumbnail', 400, 300, true);
    add_image_size('solution-large', 800, 600, true);
}
add_action('after_setup_theme', 'muhtawaa_theme_setup');

// تسجيل وإضافة الـ CSS والـ JS - مُصحح
function muhtawaa_scripts() {
    // الـ CSS الرئيسي
    wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // jQuery (مدمج مع ووردبريس) - التأكد من التحميل
    wp_enqueue_script('jquery');
    
    // الـ JavaScript الرئيسي - مُصحح
    wp_enqueue_script('muhtawaa-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
    
    // تمرير متغيرات لـ JavaScript - مُصحح ومُحسن
    wp_localize_script('muhtawaa-script', 'muhtawaa_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('muhtawaa_nonce'),
        'post_id' => get_the_ID(),
        'is_admin' => current_user_can('manage_options'),
        'home_url' => home_url(),
        'current_user_id' => get_current_user_id(),
        'strings' => array(
            'loading' => __('جاري التحميل...', 'muhtawaa'),
            'error' => __('حدث خطأ', 'muhtawaa'),
            'success' => __('تم بنجاح', 'muhtawaa'),
            'no_results' => __('لا توجد نتائج', 'muhtawaa'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'muhtawaa_scripts');

// تسجيل مناطق الودجات
function muhtawaa_widgets_init() {
    // الشريط الجانبي
    register_sidebar(array(
        'name' => __('الشريط الجانبي', 'muhtawaa'),
        'id' => 'sidebar-1',
        'description' => __('يظهر في الصفحات الفردية', 'muhtawaa'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    // تذييل الموقع 1
    register_sidebar(array(
        'name' => __('تذييل الموقع 1', 'muhtawaa'),
        'id' => 'footer-1',
        'description' => __('العمود الأول في تذييل الموقع', 'muhtawaa'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    // تذييل الموقع 2
    register_sidebar(array(
        'name' => __('تذييل الموقع 2', 'muhtawaa'),
        'id' => 'footer-2',
        'description' => __('العمود الثاني في تذييل الموقع', 'muhtawaa'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    // تذييل الموقع 3
    register_sidebar(array(
        'name' => __('تذييل الموقع 3', 'muhtawaa'),
        'id' => 'footer-3',
        'description' => __('العمود الثالث في تذييل الموقع', 'muhtawaa'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'muhtawaa_widgets_init');

// إضافة تصنيفات مخصصة للحلول
function muhtawaa_create_solution_categories() {
    register_taxonomy('solution_category', 'post', array(  
        'labels' => array(
            'name' => __('فئات الحلول', 'muhtawaa'),
            'singular_name' => __('فئة الحلول', 'muhtawaa'),
            'menu_name' => __('فئات الحلول', 'muhtawaa'),
            'all_items' => __('جميع الفئات', 'muhtawaa'),
            'edit_item' => __('تعديل الفئة', 'muhtawaa'),
            'view_item' => __('مشاهدة الفئة', 'muhtawaa'),
            'update_item' => __('تحديث الفئة', 'muhtawaa'),
            'add_new_item' => __('إضافة فئة جديدة', 'muhtawaa'),
            'new_item_name' => __('اسم الفئة الجديدة', 'muhtawaa'),
            'search_items' => __('البحث في الفئات', 'muhtawaa'),
            'not_found' => __('لم يتم العثور على فئات', 'muhtawaa'),
        ),
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'solutions'),
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'query_var' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'muhtawaa_create_solution_categories');

// إنشاء فئات افتراضية
function muhtawaa_create_default_categories() {
    $categories = array(
        'المنزل والتنظيف' => 'حلول عملية للتنظيف والترتيب المنزلي',
        'المطبخ والطبخ' => 'نصائح وحيل للمطبخ والطبخ',
        'توفير المال' => 'طرق ذكية لتوفير المال في الحياة اليومية',
        'السيارات' => 'نصائح صيانة وحلول لمشاكل السيارات',
        'التكنولوجيا' => 'حلول للمشاكل التقنية والأجهزة الذكية',
        'الطقس والمناخ' => 'حلول للتعامل مع الطقس الحار والبارد'
    );
    
    foreach ($categories as $name => $description) {
        if (!term_exists($name, 'solution_category')) {
            wp_insert_term($name, 'solution_category', array(
                'description' => $description,
                'slug' => sanitize_title($name)
            ));
        }
    }
}

// التأكد من إنشاء الجداول والبيانات الافتراضية
function muhtawaa_ensure_setup() {
    // إنشاء الفئات الافتراضية
    muhtawaa_create_default_categories();
    
    // إنشاء الجداول المطلوبة
    muhtawaa_create_custom_tables();
    
    // إنشاء جداول AJAX
    if (file_exists(get_template_directory() . '/inc/ajax-functions.php')) {
        require_once get_template_directory() . '/inc/ajax-functions.php';
        if (function_exists('muhtawaa_create_ajax_tables')) {
            muhtawaa_create_ajax_tables();
        }
    }
}
add_action('after_switch_theme', 'muhtawaa_ensure_setup');
add_action('init', 'muhtawaa_ensure_setup', 5); // تنفيذ مبكر

// دالة مساعدة للحصول على أيقونة الفئة
function muhtawaa_get_category_icon($category_name) {
    $icons = array(
        'المنزل والتنظيف' => '🏠',
        'المطبخ والطبخ' => '🍳',
        'توفير المال' => '💰',
        'السيارات' => '🚗',
        'التكنولوجيا' => '📱',
        'الطقس والمناخ' => '🌡️'
    );
    
    return isset($icons[$category_name]) ? $icons[$category_name] : '💡';
}

// دالة مساعدة للحصول على لون الصعوبة
function muhtawaa_get_difficulty_color($difficulty) {
    $colors = array(
        'سهل جداً' => '#4caf50',
        'سهل' => '#8bc34a',
        'متوسط' => '#ff9800',
        'صعب' => '#f44336'
    );
    
    return isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
}

// إضافة حقول مخصصة للمقالات
function muhtawaa_add_solution_meta_boxes() {
    add_meta_box(
        'solution_details',
        __('تفاصيل الحل', 'muhtawaa'),
        'muhtawaa_solution_details_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'muhtawaa_add_solution_meta_boxes');

// محتوى صندوق الحقول المخصصة
function muhtawaa_solution_details_callback($post) {
    wp_nonce_field('muhtawaa_save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, '_solution_difficulty', true);
    $time_needed = get_post_meta($post->ID, '_solution_time', true);
    $materials = get_post_meta($post->ID, '_solution_materials', true);
    $cost = get_post_meta($post->ID, '_solution_cost', true);
    
    echo '<table class="form-table">
        <tr>
            <th scope="row"><label for="solution_difficulty">مستوى الصعوبة</label></th>
            <td>
                <select name="solution_difficulty" id="solution_difficulty" style="width: 200px;">
                    <option value="">اختر المستوى</option>
                    <option value="سهل جداً" ' . selected($difficulty, 'سهل جداً', false) . '>سهل جداً</option>
                    <option value="سهل" ' . selected($difficulty, 'سهل', false) . '>سهل</option>
                    <option value="متوسط" ' . selected($difficulty, 'متوسط', false) . '>متوسط</option>
                    <option value="صعب" ' . selected($difficulty, 'صعب', false) . '>صعب</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="solution_time">الوقت المطلوب</label></th>
            <td><input type="text" name="solution_time" id="solution_time" value="' . esc_attr($time_needed) . '" placeholder="مثال: 5 دقائق" style="width: 300px;" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="solution_cost">التكلفة التقريبية</label></th>
            <td><input type="text" name="solution_cost" id="solution_cost" value="' . esc_attr($cost) . '" placeholder="مثال: مجاني أو 10 ريال" style="width: 300px;" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="solution_materials">المواد المطلوبة</label></th>
            <td><textarea name="solution_materials" id="solution_materials" rows="4" cols="60" placeholder="اذكر المواد المطلوبة، كل مادة في سطر جديد">' . esc_textarea($materials) . '</textarea></td>
        </tr>
    </table>';
}

// حفظ البيانات المخصصة
function muhtawaa_save_solution_details($post_id) {
    if (!isset($_POST['solution_details_nonce']) || !wp_verify_nonce($_POST['solution_details_nonce'], 'muhtawaa_save_solution_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['solution_difficulty'])) {
        update_post_meta($post_id, '_solution_difficulty', sanitize_text_field($_POST['solution_difficulty']));
    }

    if (isset($_POST['solution_time'])) {
        update_post_meta($post_id, '_solution_time', sanitize_text_field($_POST['solution_time']));
    }

    if (isset($_POST['solution_cost'])) {
        update_post_meta($post_id, '_solution_cost', sanitize_text_field($_POST['solution_cost']));
    }

    if (isset($_POST['solution_materials'])) {
        update_post_meta($post_id, '_solution_materials', sanitize_textarea_field($_POST['solution_materials']));
    }
}
add_action('save_post', 'muhtawaa_save_solution_details');

// تخصيص excerpt للحلول
function muhtawaa_custom_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'muhtawaa_custom_excerpt_length');

function muhtawaa_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'muhtawaa_excerpt_more');

// إضافة schema markup للحلول
function muhtawaa_add_solution_schema() {
    if (is_single() && get_post_type() == 'post') {
        $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
        $time = get_post_meta(get_the_ID(), '_solution_time', true);
        $materials = get_post_meta(get_the_ID(), '_solution_materials', true);
        
        $schema = array(
            "@context" => "https://schema.org/",
            "@type" => "HowTo",
            "name" => get_the_title(),
            "description" => get_the_excerpt(),
            "totalTime" => $time,
            "difficulty" => $difficulty,
            "supply" => $materials ? explode("\n", $materials) : array(),
            "author" => array(
                "@type" => "Organization", 
                "name" => get_bloginfo('name'),
                "url" => home_url()
            ),
            "publisher" => array(
                "@type" => "Organization",
                "name" => get_bloginfo('name'),
                "url" => home_url()
            ),
            "datePublished" => get_the_date('c'),
            "dateModified" => get_the_modified_date('c'),
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>';
    }
}
add_action('wp_head', 'muhtawaa_add_solution_schema');

// دالة مساعدة للحصول على روابط وسائل التواصل
function muhtawaa_get_social_links() {
    return array(
        'twitter' => '',
        'facebook' => '',
        'instagram' => '',
        'youtube' => '',
        'tiktok' => '',
    );
}

// إنشاء الجداول المطلوبة عند تفعيل القالب
function muhtawaa_create_custom_tables() {
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // جدول المشتركين
    $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
    $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'active',
        source varchar(50) DEFAULT 'website',
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    // جدول البحثات
    $searches_table = $wpdb->prefix . 'muhtawaa_searches';
    $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        search_term varchar(255) NOT NULL,
        results_count int(11) DEFAULT 0,
        user_ip varchar(45),
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY search_term (search_term),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_subscribers);
    dbDelta($sql_searches);
}

// تضمين ملف وظائف AJAX إذا كان موجوداً
if (file_exists(get_template_directory() . '/inc/ajax-functions.php')) {
    require_once get_template_directory() . '/inc/ajax-functions.php';
}

// تحسين الأمان - إزالة معلومات غير ضرورية
function muhtawaa_remove_version() {
    return '';
}
add_filter('the_generator', 'muhtawaa_remove_version');

// إزالة RSD link
remove_action('wp_head', 'rsd_link');

// إزالة wlwmanifest link
remove_action('wp_head', 'wlwmanifest_link');

// إزالة REST API link في head
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// إضافة breadcrumbs
function muhtawaa_breadcrumbs() {
    if (is_front_page()) return;
    
    echo '<nav class="breadcrumbs" style="padding: 1rem 0; color: #666; font-size: 0.9rem;">';
    echo '<div class="container">';
    echo '<a href="' . home_url() . '" style="color: #667eea; text-decoration: none;">🏠 الرئيسية</a>';
    
    if (is_category() || is_single()) {
        if (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                echo ' &larr; <a href="' . get_category_link($category->term_id) . '" style="color: #667eea; text-decoration: none;">' . $category->name . '</a>';
            }
            echo ' &larr; <span>' . get_the_title() . '</span>';
        } elseif (is_category()) {
            echo ' &larr; <span>' . single_cat_title('', false) . '</span>';
        }
    } elseif (is_page()) {
        echo ' &larr; <span>' . get_the_title() . '</span>';
    } elseif (is_search()) {
        echo ' &larr; <span>نتائج البحث عن: "' . get_search_query() . '"</span>';
    }
    
    echo '</div>';
    echo '</nav>';
}

// تحسين عنوان الصفحة
function muhtawaa_custom_title($title) {
    if (is_home() || is_front_page()) {
        return get_bloginfo('name') . ' - ' . get_bloginfo('description');
    } elseif (is_single()) {
        return get_the_title() . ' - ' . get_bloginfo('name');
    } elseif (is_category()) {
        return 'فئة ' . single_cat_title('', false) . ' - ' . get_bloginfo('name');
    } elseif (is_search()) {
        return 'البحث عن: ' . get_search_query() . ' - ' . get_bloginfo('name');
    }
    
    return $title;
}
add_filter('wp_title', 'muhtawaa_custom_title');

// إضافة معلومات إضافية لـ head
function muhtawaa_add_meta_tags() {
    if (is_single()) {
        $description = wp_trim_words(get_the_excerpt(), 20);
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'muhtawaa_add_meta_tags');

// إزالة الـ emoji scripts (تحسين الأداء)
function muhtawaa_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'muhtawaa_disable_emojis');

// تحسين أداء ووردبريس
function muhtawaa_optimize_performance() {
    // إزالة query strings من static resources
    if (!function_exists('remove_query_strings')) {
        function remove_query_strings($src) {
            $parts = explode('?ver', $src);
            return $parts[0];
        }
    }
    add_filter('script_loader_src', 'remove_query_strings', 15, 1);
    add_filter('style_loader_src', 'remove_query_strings', 15, 1);
    
    // تقليل revisions
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
}
add_action('init', 'muhtawaa_optimize_performance');

// دالة مساعدة للحصول على عدد الحلول في كل فئة
function muhtawaa_get_category_count($category_id) {
    $posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'solution_category',
                'field' => 'term_id',
                'terms' => $category_id,
            ),
        ),
    ));
    
    return count($posts);
}

// دالة مساعدة لعرض معلومات الحل
function muhtawaa_display_solution_meta($post_id) {
    $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
    $time = get_post_meta($post_id, '_solution_time', true);
    $cost = get_post_meta($post_id, '_solution_cost', true);
    
    echo '<div class="solution-meta-full">';
    
    if ($difficulty) {
        $color = muhtawaa_get_difficulty_color($difficulty);
        echo '<span class="meta-item difficulty-badge" style="background-color: ' . $color . '; color: white;">🎯 ' . $difficulty . '</span>';
    }
    
    if ($time) {
        echo '<span class="meta-item">⏱️ ' . $time . '</span>';
    }
    
    if ($cost) {
        echo '<span class="meta-item">💰 ' . $cost . '</span>';
    }
    
    echo '<span class="meta-item">📅 ' . get_the_date() . '</span>';
    echo '</div>';
}

// تحسين البحث - إضافة البحث في الحقول المخصصة
function muhtawaa_extend_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key' => '_solution_materials',
                'value' => $query->get('s'),
                'compare' => 'LIKE'
            )
        ));
    }
}
add_action('pre_get_posts', 'muhtawaa_extend_search');

// إضافة RSS للفئات
function muhtawaa_add_category_feeds() {
    add_feed('solutions', 'muhtawaa_solutions_feed');
}
add_action('init', 'muhtawaa_add_category_feeds');

function muhtawaa_solutions_feed() {
    header('Content-Type: application/rss+xml; charset=' . get_option('blog_charset'), true);
    echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '" ?>';
    
    $posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => 10,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    ?>
    <rss version="2.0">
        <channel>
            <title><?php bloginfo('name'); ?> - الحلول اليومية</title>
            <link><?php bloginfo('url'); ?></link>
            <description>أحدث الحلول العملية للحياة اليومية</description>
            <language>ar</language>
            <lastBuildDate><?php echo date('r'); ?></lastBuildDate>
            
            <?php foreach ($posts as $post): ?>
            <item>
                <title><?php echo $post->post_title; ?></title>
                <link><?php echo get_permalink($post->ID); ?></link>
                <description><![CDATA[<?php echo wp_trim_words($post->post_content, 50); ?>]]></description>
                <pubDate><?php echo date('r', strtotime($post->post_date)); ?></pubDate>
                <guid><?php echo get_permalink($post->ID); ?></guid>
            </item>
            <?php endforeach; ?>
        </channel>
    </rss>
    <?php
}

// إضافة عمود التقييمات في إدارة المقالات
function muhtawaa_add_rating_column($columns) {
    $columns['solution_rating'] = 'التقييم';
    $columns['solution_views'] = 'المشاهدات';
    $columns['solution_difficulty'] = 'الصعوبة';
    return $columns;
}
add_filter('manage_posts_columns', 'muhtawaa_add_rating_column');

function muhtawaa_show_rating_column($column, $post_id) {
    switch ($column) {
        case 'solution_rating':
            $helpful = get_post_meta($post_id, '_helpful_count', true) ?: 0;
            $not_helpful = get_post_meta($post_id, '_not_helpful_count', true) ?: 0;
            $total = $helpful + $not_helpful;
            
            if ($total > 0) {
                $percentage = round(($helpful / $total) * 100);
                echo "<div style='color: " . ($percentage >= 70 ? 'green' : ($percentage >= 50 ? 'orange' : 'red')) . ";'>";
                echo "👍 $helpful | 👎 $not_helpful<br>";
                echo "<small>($percentage% إيجابي)</small>";
                echo "</div>";
            } else {
                echo '<span style="color: #999;">لا توجد تقييمات</span>';
            }
            break;
            
        case 'solution_views':
            $views = get_post_meta($post_id, '_total_views', true) ?: 0;
            $reading_time = get_post_meta($post_id, '_avg_reading_time', true) ?: 0;
            
            echo "<strong>$views</strong> مشاهدة<br>";
            if ($reading_time > 0) {
                echo "<small>متوسط القراءة: " . gmdate('i:s', $reading_time) . "</small>";
            }
            break;
            
        case 'solution_difficulty':
            $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
            if ($difficulty) {
                $colors = array(
                    'سهل جداً' => '#4caf50',
                    'سهل' => '#8bc34a',
                    'متوسط' => '#ff9800',
                    'صعب' => '#f44336'
                );
                $color = isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
                echo "<span style='color: $color; font-weight: bold;'>$difficulty</span>";
            } else {
                echo '<span style="color: #999;">غير محدد</span>';
            }
            break;
    }
}
add_action('manage_posts_custom_column', 'muhtawaa_show_rating_column', 10, 2);

// إضافة ويدجت الإحصائيات للوحة التحكم
function muhtawaa_add_dashboard_stats_widget() {
    wp_add_dashboard_widget(
        'muhtawaa_stats_widget',
        '📊 إحصائيات موقع محتوى',
        'muhtawaa_dashboard_stats_widget_content'
    );
}
add_action('wp_dashboard_setup', 'muhtawaa_add_dashboard_stats_widget');

function muhtawaa_dashboard_stats_widget_content() {
    global $wpdb;
    
    // إحصائيات أساسية
    $total_posts = wp_count_posts()->publish;
    $total_categories = wp_count_terms('solution_category');
    $total_comments = wp_count_comments()->approved;
    
    // المقالات الأكثر مشاهدة
    $top_viewed = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_total_views'
        WHERE p.post_status = 'publish' AND p.post_type = 'post'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 5
    ");
    
    echo '<div class="muhtawaa-dashboard-stats">';
    echo '<div class="stats-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px;">';
    
    echo '<div class="stat-card" style="background: #667eea; color: white; padding: 15px; border-radius: 8px; text-align: center;">';
    echo '<h3 style="margin: 0; font-size: 2em;">' . $total_posts . '</h3>';
    echo '<p style="margin: 5px 0 0;">حل منشور</p>';
    echo '</div>';
    
    echo '<div class="stat-card" style="background: #48bb78; color: white; padding: 15px; border-radius: 8px; text-align: center;">';
    echo '<h3 style="margin: 0; font-size: 2em;">' . $total_categories . '</h3>';
    echo '<p style="margin: 5px 0 0;">فئة</p>';
    echo '</div>';
    
    echo '<div class="stat-card" style="background: #ed8936; color: white; padding: 15px; border-radius: 8px; text-align: center;">';
    echo '<h3 style="margin: 0; font-size: 2em;">' . $total_comments . '</h3>';
    echo '<p style="margin: 5px 0 0;">تعليق</p>';
    echo '</div>';
    
    echo '</div>';
    
    if (!empty($top_viewed)) {
        echo '<h4>🔥 أكثر الحلول مشاهدة:</h4>';
        echo '<ul style="margin: 0; padding-left: 20px;">';
        foreach ($top_viewed as $post) {
            $views = $post->views ?: 0;
            echo '<li style="margin-bottom: 8px;">';
            echo '<strong><a href="' . get_edit_post_link($post->ID) . '">' . $post->post_title . '</a></strong><br>';
            echo '<small style="color: #666;">👀 ' . $views . ' مشاهدة</small>';
            echo '</li>';
        }
        echo '</ul>';
    }
    
    echo '<p style="margin-top: 20px; text-align: center;">';
    echo '<a href="' . admin_url('edit.php') . '" class="button button-primary">إدارة المقالات</a> ';
    echo '<a href="' . admin_url('edit-tags.php?taxonomy=solution_category') . '" class="button">إدارة الفئات</a>';
    echo '</p>';
    
    echo '</div>';
}

// تنظيف قاعدة البيانات من البيانات القديمة
function muhtawaa_cleanup_old_data() {
    global $wpdb;
    
    // حذف البحثات الأقدم من 6 أشهر
    $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    
    // حذف transients منتهية الصلاحية
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_rating_%' AND option_value < UNIX_TIMESTAMP()");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_rating_%'");
}

// تشغيل التنظيف يومياً
if (!wp_next_scheduled('muhtawaa_daily_cleanup')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_daily_cleanup');
}
add_action('muhtawaa_daily_cleanup', 'muhtawaa_cleanup_old_data');

// إضافة رسالة ترحيب للمسؤولين الجدد
function muhtawaa_admin_welcome_message() {
    if (current_user_can('manage_options') && get_transient('muhtawaa_welcome_message')) {
        echo '<div class="notice notice-success is-dismissible">
            <h3>🎉 مرحباً بك في قالب محتوى!</h3>
            <p>تم تنشيط القالب بنجاح. يمكنك الآن:</p>
            <ul>
                <li>إنشاء أول مقال في <a href="' . admin_url('post-new.php') . '">المقالات &larr; أضف جديد</a></li>
                <li>إدارة فئات الحلول في <a href="' . admin_url('edit-tags.php?taxonomy=solution_category') . '">فئات الحلول</a></li>
                <li>تخصيص الموقع في <a href="' . admin_url('customize.php') . '">المظهر &larr; تخصيص</a></li>
            </ul>
        </div>';
        delete_transient('muhtawaa_welcome_message');
    }
}
add_action('admin_notices', 'muhtawaa_admin_welcome_message');

// تعيين رسالة الترحيب عند تفعيل القالب
function muhtawaa_set_welcome_message() {
    set_transient('muhtawaa_welcome_message', true, 30 * DAY_IN_SECONDS);
}
add_action('after_switch_theme', 'muhtawaa_set_welcome_message');

// إضافة CSS مخصص لتحسين الأزرار في footer.php
function muhtawaa_add_custom_footer_styles() {
    ?>
    <style>
    /* تحسينات إضافية للأزرار العائمة */
    .quick-tips {
        position: fixed;
        bottom: 90px;
        right: 20px;
        background: #667eea;
        color: white;
        padding: 15px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        border: none;
        animation: pulse-glow 2s infinite;
    }

    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        50% {
            box-shadow: 0 5px 30px rgba(102, 126, 234, 0.4);
        }
    }

    .quick-tips:hover,
    .quick-tips:focus {
        transform: scale(1.1);
        background: #5a6fd8;
        outline: none;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        animation: none;
    }

    .back-to-top {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        z-index: 999;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover,
    .back-to-top:focus {
        background: #5a6fd8;
        transform: translateY(-3px);
        outline: none;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    /* تحسينات الموبايل */
    @media (max-width: 768px) {
        .quick-tips {
            bottom: 80px;
            right: 15px;
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
        
        .back-to-top {
            bottom: 15px;
            left: 15px;
            width: 45px;
            height: 45px;
        }
    }
    </style>
    <?php
}
add_action('wp_footer', 'muhtawaa_add_custom_footer_styles');

// التأكد من تحميل ملف ajax-functions.php بشكل صحيح
function muhtawaa_check_ajax_functions() {
    $ajax_file = get_template_directory() . '/inc/ajax-functions.php';
    if (!file_exists($ajax_file)) {
        // إنشاء ملف مؤقت بوظائف أساسية
        wp_mkdir_p(get_template_directory() . '/inc');
        
        $basic_ajax_content = '<?php
// ملف مؤقت للوظائف الأساسية
function muhtawaa_create_ajax_tables() {
    // وظيفة فارغة مؤقتة
}

// وظيفة أساسية للحصول على نصيحة عشوائية
function muhtawaa_get_random_tip() {
    wp_send_json_success(array(
        "id" => 1,
        "title" => "نصيحة سريعة",
        "content" => "ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!",
        "url" => home_url()
    ));
}
add_action("wp_ajax_get_random_tip", "muhtawaa_get_random_tip");
add_action("wp_ajax_nopriv_get_random_tip", "muhtawaa_get_random_tip");
';
        
        file_put_contents($ajax_file, $basic_ajax_content);
    }
}
add_action('init', 'muhtawaa_check_ajax_functions', 1);


// التأكد من تحميل متغيرات JavaScript بشكل صحيح
function muhtawaa_ensure_ajax_vars() {
    ?>
    <script>
    // التأكد من وجود متغيرات AJAX
    if (typeof muhtawaa_ajax === 'undefined') {
        window.muhtawaa_ajax = {
            ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('muhtawaa_nonce'); ?>',
            post_id: '<?php echo get_the_ID() ?: 0; ?>',
            home_url: '<?php echo home_url(); ?>',
            is_admin: <?php echo current_user_can('manage_options') ? 'true' : 'false'; ?>
        };
    }
    </script>
    <?php
}
add_action('wp_footer', 'muhtawaa_ensure_ajax_vars', 5);

// إصلاح تحميل الـ CSS والـ JS - مُحسن
function muhtawaa_scripts_fixed() {
    // إزالة التحميل القديم أولاً
    wp_deregister_script('muhtawaa-script');
    wp_deregister_style('muhtawaa-style');
    
    // الـ CSS الرئيسي
    wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // jQuery (التأكد من التحميل)
    wp_enqueue_script('jquery');
    
    // الـ JavaScript الرئيسي
    if (file_exists(get_template_directory() . '/js/script.js')) {
        wp_enqueue_script('muhtawaa-script', get_template_directory_uri() . '/js/script.js', array('jquery'), filemtime(get_template_directory() . '/js/script.js'), true);
        
        // تمرير متغيرات لـ JavaScript
        wp_localize_script('muhtawaa-script', 'muhtawaa_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_nonce'),
            'post_id' => get_the_ID() ?: 0,
            'is_admin' => current_user_can('manage_options'),
            'home_url' => home_url(),
            'current_user_id' => get_current_user_id(),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'error' => __('حدث خطأ', 'muhtawaa'),
                'success' => __('تم بنجاح', 'muhtawaa'),
                'no_results' => __('لا توجد نتائج', 'muhtawaa'),
            )
        ));
    }
}
add_action('wp_enqueue_scripts', 'muhtawaa_scripts_fixed', 15);

// إضافة CSS مُحسن للأزرار العائمة مباشرة
function muhtawaa_add_floating_buttons_css() {
    ?>
    <style>
    /* إصلاح الأزرار العائمة */
    .quick-tips {
        position: fixed;
        bottom: 90px;
        right: 20px;
        background: #667eea;
        color: white;
        padding: 15px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        width: 60px;
        height: 60px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        border: none;
        animation: pulse-glow 2s infinite;
    }

    .back-to-top {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        z-index: 999;
        font-size: 1.2rem;
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .back-to-top.show {
        opacity: 1 !important;
        visibility: visible !important;
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
        50% { box-shadow: 0 5px 30px rgba(102, 126, 234, 0.4); }
    }

    .quick-tips:hover, .back-to-top:hover {
        transform: scale(1.1);
        background: #5a6fd8;
    }

    /* إصلاح العرض على الشاشات الكبيرة */
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    /* إصلاحات الموبايل */
    @media (max-width: 768px) {
        .quick-tips {
            bottom: 80px;
            right: 15px;
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
        
        .back-to-top {
            bottom: 15px;
            left: 15px;
            width: 45px;
            height: 45px;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'muhtawaa_add_floating_buttons_css', 20);

// وظيفة بديلة للحصول على نصيحة عشوائية إذا لم تعمل وظائف AJAX
function muhtawaa_basic_random_tip() {
    $tips = array(
        array(
            'id' => 0,
            'title' => 'نصيحة سريعة',
            'content' => 'ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!',
            'url' => home_url()
        ),
        array(
            'id' => 0,
            'title' => 'حيلة ذكية',
            'content' => 'استخدم معجون الأسنان لإزالة خدوش الهاتف البسيطة بفعالية.',
            'url' => home_url()
        ),
        array(
            'id' => 0,
            'title' => 'نصيحة منزلية',
            'content' => 'الليمون يزيل رائحة الثوم من اليدين بفعالية أكثر من الصابون.',
            'url' => home_url()
        )
    );
    
    wp_send_json_success($tips[array_rand($tips)]);
}
add_action('wp_ajax_get_random_tip', 'muhtawaa_basic_random_tip');
add_action('wp_ajax_nopriv_get_random_tip', 'muhtawaa_basic_random_tip');

// إضافة كود JavaScript بديل في حالة عدم تحميل الملف الرئيسي
function muhtawaa_fallback_js() {
    ?>
    <script>
    // JavaScript بديل للأزرار العائمة
    document.addEventListener('DOMContentLoaded', function() {
        // إنشاء زر العودة للأعلى إذا لم يكن موجوداً
        if (!document.getElementById('back-to-top')) {
            const backToTopBtn = document.createElement('button');
            backToTopBtn.id = 'back-to-top';
            backToTopBtn.className = 'back-to-top';
            backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            backToTopBtn.setAttribute('aria-label', 'العودة للأعلى');
            document.body.appendChild(backToTopBtn);
        }
        
        // إنشاء زر النصائح إذا لم يكن موجوداً
        if (!document.querySelector('.quick-tips')) {
            const quickTipsBtn = document.createElement('button');
            quickTipsBtn.className = 'quick-tips';
            quickTipsBtn.innerHTML = '<i class="fas fa-lightbulb"></i>';
            quickTipsBtn.setAttribute('aria-label', 'الحصول على حل سريع');
            quickTipsBtn.setAttribute('title', 'حل سريع - اضغط للحصول على نصيحة عشوائية');
            document.body.appendChild(quickTipsBtn);
        }
        
        // وظائف الأزرار
        const backToTopBtn = document.getElementById('back-to-top');
        const quickTipsBtn = document.querySelector('.quick-tips');
        
        // زر العودة للأعلى
        if (backToTopBtn) {
            function toggleBackToTop() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            }
            
            window.addEventListener('scroll', toggleBackToTop);
            
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
        
        // زر النصائح
        if (quickTipsBtn) {
            quickTipsBtn.addEventListener('click', function() {
                if (window.loadRandomTip) {
                    window.loadRandomTip();
                } else {
                    alert('💡 ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!');
                }
            });
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'muhtawaa_fallback_js', 25);

?>