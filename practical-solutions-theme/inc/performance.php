<?php
/**
 * Performance Optimization
 * تحسينات الأداء والسرعة
 *
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تحسين قاعدة البيانات للبحث
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_database() {
    global $wpdb;

    // إضافة فهارس لتحسين البحث
    $indexes = array(
        "CREATE INDEX ps_post_title_idx ON {$wpdb->posts} (post_title)",
        "CREATE INDEX ps_post_content_idx ON {$wpdb->posts} (post_content(100))",
        "CREATE INDEX ps_post_excerpt_idx ON {$wpdb->posts} (post_excerpt)",
        "CREATE INDEX ps_post_status_type_idx ON {$wpdb->posts} (post_status, post_type)",
        "CREATE INDEX ps_meta_key_value_idx ON {$wpdb->postmeta} (meta_key, meta_value(50))"
    );

    foreach ($indexes as $index) {
        $wpdb->query($index);
    }
}
add_action('after_switch_theme', 'practical_solutions_optimize_database');

/**
 * تحسين استعلامات قاعدة البيانات
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_queries() {
    // تقليل عدد الاستعلامات في الصفحة الرئيسية
    if (is_home() || is_front_page()) {
        // تجميع استعلامات التصنيفات
        add_filter('posts_results', function($posts, $query) {
            if ($query->is_main_query() && !is_admin()) {
                // جلب جميع التصنيفات مرة واحدة
                $post_ids = wp_list_pluck($posts, 'ID');
                if (!empty($post_ids)) {
                    practical_solutions_preload_post_terms($post_ids);
                    practical_solutions_preload_post_meta($post_ids);
                }
            }
            return $posts;
        }, 10, 2);
    }
}
add_action('init', 'practical_solutions_optimize_queries');

/**
 * تحميل مسبق للتصنيفات
 *
 * @param array $post_ids قائمة معرفات المقالات
 * @since 1.0.0
 */
function practical_solutions_preload_post_terms($post_ids) {
    $taxonomies = array('category', 'post_tag', 'solution_category', 'tip_category', 'difficulty_level');

    foreach ($taxonomies as $taxonomy) {
        if (taxonomy_exists($taxonomy)) {
            wp_get_object_terms($post_ids, $taxonomy);
        }
    }
}

/**
 * تحميل مسبق للحقول المخصصة
 *
 * @param array $post_ids قائمة معرفات المقالات
 * @since 1.0.0
 */
function practical_solutions_preload_post_meta($post_ids) {
    if (!empty($post_ids)) {
        // تحميل جميع meta للمقالات مرة واحدة
        update_meta_cache('post', $post_ids);
    }
}

/**
 * تحسين الصور والوسائط
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_images() {
    // تفعيل lazy loading للصور
    if (get_theme_mod('practical_solutions_lazy_loading', true)) {
        add_filter('wp_get_attachment_image_attributes', function($attr) {
            if (!is_admin() && !wp_is_json_request()) {
                $attr['loading'] = 'lazy';
                $attr['decoding'] = 'async';
            }
            return $attr;
        });

        // إضافة lazy loading للصور في المحتوى
        add_filter('the_content', function($content) {
            if (!is_admin() && !is_feed()) {
                $content = preg_replace(
                    '/<img([^>]+?)src=/i',
                    '<img$1loading="lazy" decoding="async" src=',
                    $content
                );
            }
            return $content;
        });
    }

    // تحسين جودة الصور
    add_filter('wp_editor_set_quality', function($quality) {
        return 85; // جودة محسنة
    });

    // إنشاء صور WebP تلقائياً
    add_filter('wp_generate_attachment_metadata', 'practical_solutions_create_webp_versions');
}
add_action('init', 'practical_solutions_optimize_images');

/**
 * إنشاء نسخ WebP للصور
 *
 * @param array $metadata بيانات الصورة
 * @return array البيانات المحدثة
 * @since 1.0.0
 */
function practical_solutions_create_webp_versions($metadata) {
    if (!isset($metadata['file'])) {
        return $metadata;
    }

    $upload_dir = wp_upload_dir();
    $image_path = $upload_dir['basedir'] . '/' . $metadata['file'];

    // التحقق من وجود الصورة ودعم WebP
    if (file_exists($image_path) && function_exists('imagewebp')) {
        practical_solutions_convert_to_webp($image_path);

        // تحويل الأحجام المختلفة
        if (isset($metadata['sizes']) && is_array($metadata['sizes'])) {
            foreach ($metadata['sizes'] as $size) {
                $size_path = $upload_dir['basedir'] . '/' . dirname($metadata['file']) . '/' . $size['file'];
                if (file_exists($size_path)) {
                    practical_solutions_convert_to_webp($size_path);
                }
            }
        }
    }

    return $metadata;
}

/**
 * تحويل الصورة لصيغة WebP
 *
 * @param string $image_path مسار الصورة
 * @since 1.0.0
 */
function practical_solutions_convert_to_webp($image_path) {
    $info = pathinfo($image_path);
    $webp_path = $info['dirname'] . '/' . $info['filename'] . '.webp';

    // تجنب التحويل المتكرر
    if (file_exists($webp_path)) {
        return;
    }

    $image = null;

    switch (strtolower($info['extension'])) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($image_path);
            break;
        case 'png':
            $image = imagecreatefrompng($image_path);
            break;
        case 'gif':
            $image = imagecreatefromgif($image_path);
            break;
    }

    if ($image !== null) {
        imagewebp($image, $webp_path, 85);
        imagedestroy($image);
    }
}

/**
 * تحسين CSS و JavaScript
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_assets() {
    // ضغط CSS إذا كان مفعل
    if (get_theme_mod('practical_solutions_minify_css', false)) {
        add_filter('style_loader_tag', function($html, $handle) {
            if (strpos($handle, 'practical-solutions') !== false) {
                // ضغط CSS inline
                $html = preg_replace('/\s+/', ' ', $html);
                $html = str_replace(array('; ', ' {', '{ ', ' }', '} '), array(';', '{', '{', '}', '}'), $html);
            }
            return $html;
        }, 10, 2);
    }

    // تأجيل JavaScript غير الضروري
    add_filter('script_loader_tag', function($tag, $handle, $src) {
        // قائمة السكربتات المهمة التي لا يجب تأجيلها
        $critical_scripts = array(
            'jquery',
            'jquery-core',
            'jquery-migrate',
            'practical-solutions-critical'
        );

        if (!in_array($handle, $critical_scripts) && !is_admin()) {
            // إضافة defer للسكربتات غير المهمة
            $tag = str_replace(' src', ' defer src', $tag);
        }

        return $tag;
    }, 10, 3);
}
add_action('init', 'practical_solutions_optimize_assets');

/**
 * تحسين التخزين المؤقت
 *
 * @since 1.0.0
 */
function practical_solutions_cache_optimization() {
    // تفعيل object cache لجلسة واحدة فقط
    if (!wp_using_ext_object_cache()) {
        // تخزين مؤقت محدود للاستعلامات المعقدة
        add_action('init', function() {
            if (!defined('PS_QUERY_CACHE')) {
                define('PS_QUERY_CACHE', array());
            }
        });

        // تخزين نتائج البحث الشائعة
        add_filter('posts_results', function($posts, $query) {
            if ($query->is_search() && !is_admin()) {
                $cache_key = 'ps_search_' . md5(serialize($query->query_vars));
                wp_cache_set($cache_key, $posts, 'practical_solutions', 3600); // ساعة واحدة
            }
            return $posts;
        }, 10, 2);
    }

    // تحسين عمليات التنظيف
    add_action('wp_scheduled_delete', function() {
        // تنظيف التخزين المؤقت القديم
        practical_solutions_cleanup_old_cache();
    });
}
add_action('init', 'practical_solutions_cache_optimization');

/**
 * تنظيف التخزين المؤقت القديم
 *
 * @since 1.0.0
 */
function practical_solutions_cleanup_old_cache() {
    // تنظيف ملفات التخزين المؤقت القديمة
    $cache_dir = WP_CONTENT_DIR . '/cache/practical-solutions/';

    if (is_dir($cache_dir)) {
        $files = glob($cache_dir . '*');
        $now = time();

        foreach ($files as $file) {
            if (is_file($file) && ($now - filemtime($file)) > 86400) { // 24 ساعة
                unlink($file);
            }
        }
    }

    // تنظيف خيارات البحث القديمة
    $search_log = get_option('ps_search_log', array());
    $cutoff_date = date('Y-m-d', strtotime('-30 days'));

    foreach ($search_log as $date => $queries) {
        if ($date < $cutoff_date) {
            unset($search_log[$date]);
        }
    }

    update_option('ps_search_log', $search_log);
}

/**
 * تحسين قاعدة البيانات دورياً
 *
 * @since 1.0.0
 */
function practical_solutions_schedule_db_optimization() {
    if (!wp_next_scheduled('practical_solutions_db_cleanup')) {
        wp_schedule_event(time(), 'daily', 'practical_solutions_db_cleanup');
    }
}
add_action('init', 'practical_solutions_schedule_db_optimization');

/**
 * تنفيذ تنظيف قاعدة البيانات
 *
 * @since 1.0.0
 */
function practical_solutions_execute_db_cleanup() {
    global $wpdb;

    // تنظيف المراجعات القديمة (أكثر من 30 يوم)
    $wpdb->query("
        DELETE FROM {$wpdb->posts}
        WHERE post_type = 'revision'
        AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
    ");

    // تنظيف المعاينات المسودة القديمة
    $wpdb->query("
        DELETE FROM {$wpdb->posts}
        WHERE post_status = 'auto-draft'
        AND post_date < DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    // تنظيف التعليقات المرفوضة والسبام
    $wpdb->query("
        DELETE FROM {$wpdb->comments}
        WHERE comment_approved IN ('spam', 'trash')
        AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
    ");

    // تنظيف postmeta اليتيمة
    $wpdb->query("
        DELETE pm FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID
        WHERE p.ID IS NULL
    ");

    // تحسين الجداول
    $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->comments}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->commentmeta}");
}
add_action('practical_solutions_db_cleanup', 'practical_solutions_execute_db_cleanup');

/**
 * إضافة headers للتخزين المؤقت
 *
 * @since 1.0.0
 */
function practical_solutions_add_cache_headers() {
    if (!is_admin()) {
        $cache_time = 3600; // ساعة واحدة

        // تحديد مدة التخزين حسب نوع الصفحة
        if (is_front_page() || is_home()) {
            $cache_time = 1800; // 30 دقيقة للصفحة الرئيسية
        } elseif (is_single() || is_page()) {
            $cache_time = 7200; // ساعتين للمقالات والصفحات
        } elseif (is_category() || is_tag() || is_archive()) {
            $cache_time = 3600; // ساعة للأرشيف
        }

        header('Cache-Control: public, max-age=' . $cache_time);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', strtotime(get_lastpostmodified('GMT'))) . ' GMT');
    }
}
add_action('send_headers', 'practical_solutions_add_cache_headers');

/**
 * تحسين استعلام الحلول المميزة
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_featured_query() {
    // تخزين مؤقت للحلول المميزة
    $featured_posts = wp_cache_get('ps_featured_posts', 'practical_solutions');

    if (false === $featured_posts) {
        $featured_posts = get_posts(array(
            'post_type'      => array('post', 'solution', 'tip'),
            'posts_per_page' => 6,
            'meta_key'       => '_ps_featured',
            'meta_value'     => '1',
            'orderby'        => 'menu_order date',
            'order'          => 'DESC'
        ));

        wp_cache_set('ps_featured_posts', $featured_posts, 'practical_solutions', 3600);
    }

    return $featured_posts;
}

/**
 * تحديث التخزين المؤقت عند تحديث المقالات
 *
 * @param int $post_id معرف المقال
 * @since 1.0.0
 */
function practical_solutions_invalidate_cache($post_id) {
    // حذف التخزين المؤقت المرتبط بالمقال
    wp_cache_delete('ps_featured_posts', 'practical_solutions');
    wp_cache_delete('ps_popular_posts', 'practical_solutions');
    wp_cache_delete('ps_recent_posts', 'practical_solutions');

    // حذف تخزين البحث المرتبط
    $cache_group = 'practical_solutions';
    wp_cache_flush_group($cache_group);
}
add_action('save_post', 'practical_solutions_invalidate_cache');
add_action('delete_post', 'practical_solutions_invalidate_cache');

/**
 * تحسين تحميل الخطوط
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_fonts() {
    // إضافة preload للخطوط المهمة
    add_action('wp_head', function() {
        echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
        echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap"></noscript>' . "\n";
    }, 1);

    // تحسين تحميل الخطوط المحلية
    add_filter('style_loader_tag', function($html, $handle) {
        if ($handle === 'practical-solutions-fonts') {
            $html = str_replace("rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html);
        }
        return $html;
    }, 10, 2);
}
add_action('init', 'practical_solutions_optimize_fonts');

/**
 * ضغط HTML output
 *
 * @since 1.0.0
 */
function practical_solutions_compress_html_output() {
    if (!is_admin() && !wp_is_json_request()) {
        ob_start(function($html) {
            // إزالة التعليقات HTML
            $html = preg_replace('//s', '', $html);

            // إزالة المساحات الزائدة
            $html = preg_replace('/\s+/', ' ', $html);

            // إزالة المساحات حول العلامات
            $html = preg_replace('/>\s+</', '><', $html);

            // إزالة المساحات في بداية ونهاية الأسطر
            $html = preg_replace('/^\s+|\s+$/m', '', $html);

            return trim($html);
        });
    }
}
add_action('init', 'practical_solutions_compress_html_output');

/**
 * إنهاء ضغط HTML عند إنهاء الصفحة
 *
 * @since 1.0.0
 */
function practical_solutions_end_html_compression() {
    if (!is_admin() && !wp_is_json_request()) {
        if (ob_get_level()) {
            ob_end_flush();
        }
    }
}
add_action('wp_footer', 'practical_solutions_end_html_compression', 999);

/**
 * تحسين RSS feeds
 *
 * @since 1.0.0
 */
function practical_solutions_optimize_feeds() {
    // إضافة تخزين مؤقت للـ feeds
    add_action('do_feed_rss2', function() {
        header('Cache-Control: public, max-age=3600');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
    }, 1);

    // تحسين محتوى الـ feed
    add_filter('the_excerpt_rss', function($excerpt) {
        return wp_trim_words($excerpt, 50);
    });
}
add_action('init', 'practical_solutions_optimize_feeds');

/**
 * مراقبة الأداء وإرسال تنبيهات
 *
 * @since 1.0.0
 */
function practical_solutions_performance_monitoring() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        add_action('wp_footer', function() {
            if (current_user_can('manage_options')) {
                $queries = get_num_queries();
                $load_time = timer_stop();
                $memory = size_format(memory_get_peak_usage());

                echo "";

                // تنبيه إذا كان الأداء بطيء
                if ($queries > 50 || $load_time > 2) {
                    error_log("Practical Solutions: Performance warning - {$queries} queries, {$load_time}s");
                }
            }
        });
    }
}
add_action('init', 'practical_solutions_performance_monitoring');