<?php
/**
 * SEO Functions
 * وظائف تحسين محركات البحث
 * * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * إضافة البيانات المنظمة (Schema.org)
 * * @since 1.0.0
 */
function practical_solutions_add_schema_markup() {
    if (is_singular(array('post', 'solution', 'tip'))) {
        global $post;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'Article',
            'headline' => get_the_title(),
            'author'   => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
                'url'   => get_author_posts_url(get_the_author_meta('ID'))
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo('name'),
                'logo'  => array(
                    '@type' => 'ImageObject',
                    'url'   => get_theme_mod('custom_logo') ? 
                              wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : 
                              get_template_directory_uri() . '/assets/images/logo.png'
                )
            ),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'description'   => practical_solutions_get_meta_description(),
            'mainEntityOfPage' => get_permalink(),
            'url'           => get_permalink()
        );
        
        // إضافة الصورة المميزة
        if (has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_url($image_id, 'large');
            $image_meta = wp_get_attachment_metadata($image_id);
            
            $schema['image'] = array(
                '@type'  => 'ImageObject',
                'url'    => $image_url,
                'width'  => $image_meta['width'] ?? 800,
                'height' => $image_meta['height'] ?? 600
            );
        }
        
        // إضافة معلومات خاصة بنوع المحتوى
        if (get_post_type() === 'solution') {
            $schema['@type'] = 'HowTo';
            $schema['name'] = get_the_title();
            $schema['description'] = practical_solutions_get_meta_description();
            
            // إضافة الأدوات المطلوبة
            $tools_needed = get_post_meta(get_the_ID(), '_ps_tools_needed', true);
            if (!empty($tools_needed)) {
                $tools_array = explode(',', $tools_needed);
                $schema['tool'] = array();
                
                foreach ($tools_array as $tool) {
                    $schema['tool'][] = array(
                        '@type' => 'HowToTool',
                        'name'  => trim($tool)
                    );
                }
            }
            
            // إضافة الخطوات
            $steps = practical_solutions_extract_steps_from_content(get_the_content());
            if (!empty($steps)) {
                $schema['step'] = $steps;
            }
            
            // إضافة مستوى الصعوبة
            $difficulty = practical_solutions_get_difficulty_level(get_the_ID());
            if ($difficulty) {
                $schema['difficulty'] = $difficulty;
            }
        }
        
        // إضافة التقييمات إذا وجدت
        $average_rating = get_post_meta(get_the_ID(), '_ps_average_rating', true);
        $total_ratings = get_post_meta(get_the_ID(), '_ps_total_ratings', true);
        
        if ($average_rating && $total_ratings) {
            $schema['aggregateRating'] = array(
                '@type'       => 'AggregateRating',
                'ratingValue' => $average_rating,
                'ratingCount' => $total_ratings,
                'bestRating'  => 5,
                'worstRating' => 1
            );
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
    
    // إضافة schema للموقع
    elseif (is_front_page()) {
        practical_solutions_add_website_schema();
    }
    
    // إضافة schema للأرشيف
    elseif (is_category() || is_archive()) {
        practical_solutions_add_collection_page_schema();
    }
}
add_action('wp_head', 'practical_solutions_add_schema_markup');

/**
 * إضافة schema للموقع الرئيسي
 * * @since 1.0.0
 */
function practical_solutions_add_website_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'WebSite',
        'name'     => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url'      => home_url('/'),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'       => 'EntryPoint',
                'urlTemplate' => home_url('/?s={search_term_string}')
            ),
            'query-input' => 'required name=search_term_string'
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => get_theme_mod('custom_logo') ? 
                          wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : 
                          get_template_directory_uri() . '/assets/images/logo.png'
            )
        )
    );
    
    // إضافة معلومات التواصل الاجتماعي
    $social_links = practical_solutions_get_social_links();
    if (!empty($social_links)) {
        $schema['sameAs'] = $social_links;
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * إضافة schema لصفحات الأرشيف
 * * @since 1.0.0
 */
function practical_solutions_add_collection_page_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'CollectionPage',
        'name'     => wp_get_document_title(),
        'description' => practical_solutions_get_archive_description(),
        'url'      => get_pagenum_link()
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * إضافة meta tags محسنة للSEO
 * * @since 1.0.0
 */
function practical_solutions_add_seo_meta_tags() {
    // Meta Description
    $description = practical_solutions_get_meta_description();
    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
    
    // Open Graph Tags
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">' . "\n";
    
    if (is_singular()) {
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image_url) . '">' . "\n";
            echo '<meta property="og:image:width" content="1200">' . "\n";
            echo '<meta property="og:image:height" content="630">' . "\n";
        }
        
        // Article specific tags
        echo '<meta property="article:published_time" content="' . esc_attr(get_the_date('c')) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr(get_the_modified_date('c')) . '">' . "\n";
        echo '<meta property="article:author" content="' . esc_attr(get_the_author()) . '">' . "\n";
        
        // Article categories
        $categories = get_the_category();
        if ($categories) {
            foreach ($categories as $category) {
                echo '<meta property="article:section" content="' . esc_attr($category->name) . '">' . "\n";
            }
        }
        
        // Article tags
        $tags = get_the_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                echo '<meta property="article:tag" content="' . esc_attr($tag->name) . '">' . "\n";
            }
        }
    } else {
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_pagenum_link()) . '">' . "\n";
    }
    
    // Twitter Card Tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    
    if (is_singular() && has_post_thumbnail()) {
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        echo '<meta name="twitter:image" content="' . esc_url($image_url) . '">' . "\n";
    }
    
    // Canonical URL
    $canonical_url = practical_solutions_get_canonical_url();
    if ($canonical_url) {
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
    }
    
    // Robots meta
    $robots = practical_solutions_get_robots_meta();
    if ($robots) {
        echo '<meta name="robots" content="' . esc_attr($robots) . '">' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_add_seo_meta_tags', 1);

/**
 * الحصول على وصف meta للصفحة
 * * @return string الوصف
 * @since 1.0.0
 */
function practical_solutions_get_meta_description() {
    if (is_singular()) {
        // استخدام meta description مخصص إذا وجد
        $custom_description = get_post_meta(get_the_ID(), '_ps_meta_description', true);
        if ($custom_description) {
            return $custom_description;
        }
        
        // استخدام المقتطف
        if (has_excerpt()) {
            return wp_trim_words(get_the_excerpt(), 25);
        }
        
        // استخدام بداية المحتوى
        return wp_trim_words(get_the_content(), 25);
    }
    
    if (is_category() || is_tag() || is_tax()) {
        $term_description = term_description();
        if ($term_description) {
            return wp_trim_words(strip_tags($term_description), 25);
        }
        
        return sprintf(
            __('تصفح جميع المقالات في %s - موقع الحلول العملية', 'practical-solutions'),
            single_term_title('', false)
        );
    }
    
    if (is_archive()) {
        return practical_solutions_get_archive_description();
    }
    
    if (is_search()) {
        return sprintf(
            __('نتائج البحث عن "%s" في موقع الحلول العملية', 'practical-solutions'),
            get_search_query()
        );
    }
    
    // الوصف الافتراضي للموقع
    return get_bloginfo('description') ?: __('موقع الحلول العملية - نصائح وحلول ذكية للحياة اليومية', 'practical-solutions');
}

/**
 * الحصول على وصف الأرشيف
 * * @return string الوصف
 * @since 1.0.0
 */
function practical_solutions_get_archive_description() {
    if (is_author()) {
        return sprintf(
            __('جميع المقالات بواسطة %s - موقع الحلول العملية', 'practical-solutions'),
            get_the_author()
        );
    }
    
    if (is_date()) {
        return sprintf(
            __('أرشيف المقالات لشهر %s - موقع الحلول العملية', 'practical-solutions'),
            get_the_date('F Y')
        );
    }
    
    if (is_post_type_archive()) {
        $post_type_obj = get_queried_object();
        return $post_type_obj->description ?: sprintf(
            __('جميع %s في موقع الحلول العملية', 'practical-solutions'),
            $post_type_obj->labels->name
        );
    }
    
    return __('أرشيف المقالات - موقع الحلول العملية', 'practical-solutions');
}

/**
 * الحصول على URL الكانونيكال
 * * @return string URL الكانونيكال
 * @since 1.0.0
 */
function practical_solutions_get_canonical_url() {
    if (is_singular()) {
        return get_permalink();
    }
    
    if (is_category() || is_tag() || is_tax()) {
        return get_term_link(get_queried_object());
    }
    
    if (is_archive()) {
        return get_post_type_archive_link(get_post_type());
    }
    
    if (is_search()) {
        return home_url('/?s=' . urlencode(get_search_query()));
    }
    
    return get_pagenum_link();
}

/**
 * الحصول على robots meta
 * * @return string robots meta
 * @since 1.0.0
 */
function practical_solutions_get_robots_meta() {
    // منع فهرسة صفحات البحث
    if (is_search()) {
        return 'noindex, follow';
    }
    
    // منع فهرسة الصفحات المؤرشفة حسب التاريخ
    if (is_date()) {
        return 'noindex, follow';
    }
    
    // منع فهرسة صفحات المؤلفين إذا لم يكن لديهم مقالات كثيرة
    if (is_author()) {
        $author_posts_count = count_user_posts(get_queried_object_id());
        if ($author_posts_count < 3) {
            return 'noindex, follow';
        }
    }
    
    // منع فهرسة الصفحات المخفية
    if (is_singular()) {
        $noindex = get_post_meta(get_the_ID(), '_ps_noindex', true);
        if ($noindex) {
            return 'noindex, follow';
        }
    }
    
    return 'index, follow';
}

/**
 * إضافة sitemap بسيط
 * * @since 1.0.0
 */
function practical_solutions_add_sitemap_link() {
    if (is_front_page()) {
        echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . esc_url(home_url('/sitemap.xml')) . '">' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_add_sitemap_link');

/**
 * إنشاء sitemap XML بسيط
 * * @since 1.0.0
 */
function practical_solutions_generate_sitemap() {
    if (isset($_GET['sitemap']) || $_SERVER['REQUEST_URI'] === '/sitemap.xml') {
        header('Content-Type: application/xml; charset=utf-8');
        
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // الصفحة الرئيسية
        echo '<url>';
        echo '<loc>' . esc_url(home_url('/')) . '</loc>';
        echo '<lastmod>' . date('c', strtotime(get_lastpostmodified())) . '</lastmod>';
        echo '<changefreq>daily</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>' . "\n";
        
        // المقالات والصفحات
        $posts = get_posts(array(
            'post_type'      => array('post', 'page', 'solution', 'tip'),
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'modified',
            'order'          => 'DESC'
        ));
        
        foreach ($posts as $post) {
            // تجاهل الصفحات المخفية من الفهرسة
            if (get_post_meta($post->ID, '_ps_noindex', true)) {
                continue;
            }
            
            echo '<url>';
            echo '<loc>' . esc_url(get_permalink($post->ID)) . '</loc>';
            echo '<lastmod>' . date('c', strtotime($post->post_modified)) . '</lastmod>';
            
            // تحديد أولوية الصفحة
            $priority = '0.7';
            if ($post->post_type === 'page') {
                $priority = '0.8';
            } elseif (get_post_meta($post->ID, '_ps_featured', true)) {
                $priority = '0.9';
            }
            
            echo '<priority>' . $priority . '</priority>';
            echo '</url>' . "\n";
        }
        
        // التصنيفات
        $categories = get_categories(array(
            'hide_empty' => true
        ));
        
        foreach ($categories as $category) {
            echo '<url>';
            echo '<loc>' . esc_url(get_category_link($category->term_id)) . '</loc>';
            echo '<changefreq>weekly</changefreq>';
            echo '<priority>0.6</priority>';
            echo '</url>' . "\n";
        }
        
        echo '</urlset>';
        exit;
    }
}
add_action('init', 'practical_solutions_generate_sitemap');

/**
 * تحسين عناوين الصفحات للSEO
 * * @param array $title أجزاء العنوان
 * @return array العنوان المحسن
 * @since 1.0.0
 */
function practical_solutions_custom_document_title($title) {
    if (is_front_page()) {
        $title['title'] = get_bloginfo('name');
        $title['tagline'] = get_bloginfo('description');
    }
    
    if (is_singular()) {
        // استخدام عنوان SEO مخصص إذا وجد
        $custom_title = get_post_meta(get_the_ID(), '_ps_seo_title', true);
        if ($custom_title) {
            $title['title'] = $custom_title;
        }
    }
    
    if (is_search()) {
        $title['title'] = sprintf(
            __('نتائج البحث عن "%s"', 'practical-solutions'),
            get_search_query()
        );
    }
    
    return $title;
}
add_filter('document_title_parts', 'practical_solutions_custom_document_title');

/**
 * إضافة مربعات meta في محرر المقالات
 * * @since 1.0.0
 */
function practical_solutions_add_seo_meta_boxes() {
    $post_types = array('post', 'page', 'solution', 'tip');
    
    foreach ($post_types as $post_type) {
        add_meta_box(
            'practical_solutions_seo',
            __('إعدادات SEO', 'practical-solutions'),
            'practical_solutions_seo_meta_box_callback',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'practical_solutions_add_seo_meta_boxes');

/**
 * محتوى مربع meta للSEO
 * * @param WP_Post $post المقال الحالي
 * @since 1.0.0
 */
function practical_solutions_seo_meta_box_callback($post) {
    wp_nonce_field('practical_solutions_seo_meta', 'practical_solutions_seo_nonce');
    
    $seo_title = get_post_meta($post->ID, '_ps_seo_title', true);
    $meta_description = get_post_meta($post->ID, '_ps_meta_description', true);
    $keywords = get_post_meta($post->ID, '_ps_keywords', true);
    $noindex = get_post_meta($post->ID, '_ps_noindex', true);
    $featured = get_post_meta($post->ID, '_ps_featured', true);
    
    echo '<table class="form-table">';
    
    // عنوان SEO
    echo '<tr>';
    echo '<th><label for="ps_seo_title">' . __('عنوان SEO', 'practical-solutions') . '</label></th>';
    echo '<td>';
    echo '<input type="text" id="ps_seo_title" name="ps_seo_title" value="' . esc_attr($seo_title) . '" class="large-text" />';
    echo '<p class="description">' . __('عنوان محسن لمحركات البحث (60 حرف أو أقل)', 'practical-solutions') . '</p>';
    echo '</td>';
    echo '</tr>';
    
    // Meta Description
    echo '<tr>';
    echo '<th><label for="ps_meta_description">' . __('وصف Meta', 'practical-solutions') . '</label></th>';
    echo '<td>';
    echo '<textarea id="ps_meta_description" name="ps_meta_description" rows="3" class="large-text">' . esc_textarea($meta_description) . '</textarea>';
    echo '<p class="description">' . __('وصف الصفحة في نتائج البحث (160 حرف أو أقل)', 'practical-solutions') . '</p>';
    echo '</td>';
    echo '</tr>';
    
    // الكلمات المفتاحية
    echo '<tr>';
    echo '<th><label for="ps_keywords">' . __('الكلمات المفتاحية', 'practical-solutions') . '</label></th>';
    echo '<td>';
    echo '<input type="text" id="ps_keywords" name="ps_keywords" value="' . esc_attr($keywords) . '" class="large-text" />';
    echo '<p class="description">' . __('كلمات مفتاحية مفصولة بفواصل', 'practical-solutions') . '</p>';
    echo '</td>';
    '</tr>';
    
    // خيارات إضافية
    echo '<tr>';
    echo '<th>' . __('خيارات إضافية', 'practical-solutions') . '</th>';
    echo '<td>';
    echo '<label><input type="checkbox" name="ps_noindex" value="1" ' . checked($noindex, '1', false) . ' /> ' . __('منع فهرسة هذه الصفحة', 'practical-solutions') . '</label><br>';
    echo '<label><input type="checkbox" name="ps_featured" value="1" ' . checked($featured, '1', false) . ' /> ' . __('محتوى مميز', 'practical-solutions') . '</label>';
    echo '</td>';
    echo '</tr>';
    
    echo '</table>';
}

/**
 * حفظ بيانات SEO meta
 * * @param int $post_id معرف المقال
 * @since 1.0.0
 */
function practical_solutions_save_seo_meta($post_id) {
    if (!isset($_POST['practical_solutions_seo_nonce']) || 
        !wp_verify_nonce($_POST['practical_solutions_seo_nonce'], 'practical_solutions_seo_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // حفظ البيانات
    $fields = array('ps_seo_title', 'ps_meta_description', 'ps_keywords', 'ps_noindex', 'ps_featured');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, '_' . $field);
        }
    }
}
add_action('save_post', 'practical_solutions_save_seo_meta');

/**
 * استخراج الخطوات من محتوى الحل
 * * @param string $content محتوى المقال
 * @return array قائمة الخطوات
 * @since 1.0.0
 */
function practical_solutions_extract_steps_from_content($content) {
    $steps = array();
    
    // البحث عن القوائم المرقمة
    if (preg_match_all('/<ol[^>]*>(.*?)<\/ol>/s', $content, $matches)) {
        foreach ($matches[1] as $list_content) {
            if (preg_match_all('/<li[^>]*>(.*?)<\/li>/s', $list_content, $list_items)) {
                $step_number = 1;
                foreach ($list_items[1] as $item) {
                    $steps[] = array(
                        '@type' => 'HowToStep',
                        'name'  => 'الخطوة ' . $step_number,
                        'text'  => wp_strip_all_tags($item)
                    );
                    $step_number++;
                }
            }
        }
    }
    
    return $steps;
}

/**
 * تحسين breadcrumbs للSEO
 * * @since 1.0.0
 */
function practical_solutions_breadcrumb_schema() {
    if (is_singular() && !is_front_page()) {
        $items = array();
        $position = 1;
        
        // الصفحة الرئيسية
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_bloginfo('name'),
            'item'     => home_url('/')
        );
        
        // التصنيف
        if (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                $items[] = array(
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => $category->name,
                    'item'     => get_category_link($category->term_id)
                );
            }
        }
        
        // الصفحة الحالية
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => get_the_title(),
            'item'     => get_permalink()
        );
        
        $breadcrumb_schema = array(
            '@context'        => 'https://schema.org',
            '@type'          => 'BreadcrumbList',
            'itemListElement' => $items
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_breadcrumb_schema');

/**
 * تحسين RSS للSEO
 * * @since 1.0.0
 */
function practical_solutions_optimize_rss() {
    // إضافة معلومات إضافية للـ RSS
    add_action('rss2_head', function() {
        echo '<language>' . get_bloginfo('language') . '</language>' . "\n";
        echo '<copyright>© ' . date('Y') . ' ' . get_bloginfo('name') . '</copyright>' . "\n";
        echo '<managingEditor>' . get_bloginfo('admin_email') . ' (' . get_bloginfo('name') . ')</managingEditor>' . "\n";
        echo '<webMaster>' . get_bloginfo('admin_email') . ' (' . get_bloginfo('name') . ')</webMaster>' . "\n";
    });
    
    // تحسين محتوى RSS
    add_filter('the_excerpt_rss', function($excerpt) {
        return wp_trim_words($excerpt, 50) . '... <a href="' . get_permalink() . '">اقرأ المزيد</a>';
    });
}
add_action('init', 'practical_solutions_optimize_rss');