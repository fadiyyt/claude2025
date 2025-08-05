<?php
/**
 * تحسين محركات البحث المتقدم - قالب محتوى
 * Advanced SEO Optimization
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * فئة تحسين محركات البحث
 */
class MuhtawaaSEO {
    
    /**
     * تهيئة الفئة وربط الوظائف
     */
    public static function init() {
        // إضافة علامات Meta الأساسية
        add_action('wp_head', array(__CLASS__, 'add_meta_tags'), 1);
        add_action('wp_head', array(__CLASS__, 'add_open_graph_tags'), 2);
        add_action('wp_head', array(__CLASS__, 'add_twitter_cards'), 3);
        add_action('wp_head', array(__CLASS__, 'add_structured_data'), 4);
        add_action('wp_head', array(__CLASS__, 'add_canonical_url'), 5);
        
        // تحسين العناوين
        add_filter('wp_title', array(__CLASS__, 'optimize_title'), 10, 3);
        add_filter('document_title_separator', array(__CLASS__, 'title_separator'));
        add_filter('document_title_parts', array(__CLASS__, 'modify_title_parts'));
        
        // تحسين الوصف
        add_action('wp_head', array(__CLASS__, 'add_meta_description'));
        
        // إضافة ملف Sitemap
        add_action('init', array(__CLASS__, 'add_sitemap_rewrite'));
        add_action('template_redirect', array(__CLASS__, 'handle_sitemap_request'));
        
        // تحسين الصور
        add_filter('wp_get_attachment_image_attributes', array(__CLASS__, 'optimize_image_attributes'), 10, 3);
        
        // إضافة Breadcrumbs
        add_action('muhtawaa_breadcrumbs', array(__CLASS__, 'display_breadcrumbs'));
        
        // تحسين URL الثابتة
        add_action('init', array(__CLASS__, 'optimize_permalinks'));
        
        // إضافة robots.txt
        add_filter('robots_txt', array(__CLASS__, 'optimize_robots_txt'), 10, 2);
        
        // تحسين الأرشيف
        add_action('pre_get_posts', array(__CLASS__, 'optimize_archive_queries'));
        
        // إضافة Schema markup
        add_action('wp_footer', array(__CLASS__, 'add_website_schema'));
    }
    
    /**
     * إضافة علامات Meta الأساسية
     */
    public static function add_meta_tags() {
        global $post;
        
        // Meta Charset
        echo '<meta charset="' . get_bloginfo('charset') . '">' . "\n";
        
        // Viewport للاستجابة
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "\n";
        
        // X-UA-Compatible
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
        
        // Meta Description
        $description = self::get_meta_description();
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
        
        // Meta Keywords (للمقالات)
        if (is_single() && $post) {
            $keywords = self::get_meta_keywords($post->ID);
            if ($keywords) {
                echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
            }
        }
        
        // Author
        if (is_single() && $post) {
            echo '<meta name="author" content="' . esc_attr(get_the_author_meta('display_name', $post->post_author)) . '">' . "\n";
        }
        
        // Robots
        $robots = self::get_robots_meta();
        if ($robots) {
            echo '<meta name="robots" content="' . esc_attr($robots) . '">' . "\n";
        }
        
        // Language
        echo '<meta name="language" content="ar">' . "\n";
        
        // Theme Color
        echo '<meta name="theme-color" content="#667eea">' . "\n";
        echo '<meta name="msapplication-TileColor" content="#667eea">' . "\n";
        
        // DNS Prefetch للموارد الخارجية
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
        echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
        echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">' . "\n";
    }
    
    /**
     * إضافة علامات Open Graph
     */
    public static function add_open_graph_tags() {
        global $post;
        
        // OG: Type
        $og_type = is_single() ? 'article' : 'website';
        echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
        
        // OG: Title
        $og_title = self::get_page_title();
        echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
        
        // OG: Description
        $og_description = self::get_meta_description();
        if ($og_description) {
            echo '<meta property="og:description" content="' . esc_attr($og_description) . '">' . "\n";
        }
        
        // OG: URL
        $og_url = self::get_canonical_url();
        echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
        
        // OG: Site Name
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        
        // OG: Image
        $og_image = self::get_og_image();
        if ($og_image) {
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
            echo '<meta property="og:image:width" content="1200">' . "\n";
            echo '<meta property="og:image:height" content="630">' . "\n";
            echo '<meta property="og:image:alt" content="' . esc_attr($og_title) . '">' . "\n";
        }
        
        // OG: Locale
        echo '<meta property="og:locale" content="ar_SA">' . "\n";
        
        // Article specific tags
        if (is_single() && $post) {
            echo '<meta property="article:published_time" content="' . esc_attr(get_the_date('c', $post->ID)) . '">' . "\n";
            echo '<meta property="article:modified_time" content="' . esc_attr(get_the_modified_date('c', $post->ID)) . '">' . "\n";
            echo '<meta property="article:author" content="' . esc_attr(get_the_author_meta('display_name', $post->post_author)) . '">' . "\n";
            
            // Article Categories
            $categories = get_the_category($post->ID);
            foreach ($categories as $category) {
                echo '<meta property="article:section" content="' . esc_attr($category->name) . '">' . "\n";
            }
            
            // Article Tags
            $tags = get_the_tags($post->ID);
            if ($tags) {
                foreach ($tags as $tag) {
                    echo '<meta property="article:tag" content="' . esc_attr($tag->name) . '">' . "\n";
                }
            }
        }
    }
    
    /**
     * إضافة Twitter Cards
     */
    public static function add_twitter_cards() {
        // Twitter Card Type
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        
        // Twitter Site
        $twitter_handle = get_theme_mod('twitter_handle');
        if ($twitter_handle) {
            echo '<meta name="twitter:site" content="@' . esc_attr($twitter_handle) . '">' . "\n";
        }
        
        // Twitter Title
        $twitter_title = self::get_page_title();
        echo '<meta name="twitter:title" content="' . esc_attr($twitter_title) . '">' . "\n";
        
        // Twitter Description
        $twitter_description = self::get_meta_description();
        if ($twitter_description) {
            echo '<meta name="twitter:description" content="' . esc_attr($twitter_description) . '">' . "\n";
        }
        
        // Twitter Image
        $twitter_image = self::get_og_image();
        if ($twitter_image) {
            echo '<meta name="twitter:image" content="' . esc_url($twitter_image) . '">' . "\n";
            echo '<meta name="twitter:image:alt" content="' . esc_attr($twitter_title) . '">' . "\n";
        }
        
        // Twitter Creator
        if (is_single()) {
            global $post;
            $author_twitter = get_the_author_meta('twitter', $post->post_author);
            if ($author_twitter) {
                echo '<meta name="twitter:creator" content="@' . esc_attr($author_twitter) . '">' . "\n";
            }
        }
    }
    
    /**
     * إضافة البيانات المنظمة (Structured Data)
     */
    public static function add_structured_data() {
        global $post;
        
        $schema_data = array();
        
        if (is_single() && $post) {
            // Article Schema
            $schema_data = array(
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => get_the_title($post->ID),
                'description' => self::get_meta_description(),
                'image' => self::get_og_image(),
                'datePublished' => get_the_date('c', $post->ID),
                'dateModified' => get_the_modified_date('c', $post->ID),
                'author' => array(
                    '@type' => 'Person',
                    'name' => get_the_author_meta('display_name', $post->post_author),
                    'url' => get_author_posts_url($post->post_author)
                ),
                'publisher' => array(
                    '@type' => 'Organization',
                    'name' => get_bloginfo('name'),
                    'logo' => array(
                        '@type' => 'ImageObject',
                        'url' => self::get_site_logo()
                    )
                ),
                'mainEntityOfPage' => array(
                    '@type' => 'WebPage',
                    '@id' => get_permalink($post->ID)
                ),
                'wordCount' => str_word_count(strip_tags($post->post_content)),
                'articleSection' => self::get_article_categories($post->ID),
                'inLanguage' => 'ar'
            );
            
            // إضافة التقييم إذا كان متوفراً
            $rating = get_post_meta($post->ID, '_muhtawaa_average_rating', true);
            if ($rating) {
                $rating_count = count(get_post_meta($post->ID, '_muhtawaa_ratings', true) ?: array());
                $schema_data['aggregateRating'] = array(
                    '@type' => 'AggregateRating',
                    'ratingValue' => $rating,
                    'ratingCount' => $rating_count,
                    'bestRating' => 5,
                    'worstRating' => 1
                );
            }
            
        } elseif (is_home() || is_front_page()) {
            // Website Schema
            $schema_data = array(
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'url' => home_url('/'),
                'inLanguage' => 'ar',
                'potentialAction' => array(
                    '@type' => 'SearchAction',
                    'target' => array(
                        '@type' => 'EntryPoint',
                        'urlTemplate' => home_url('/?s={search_term_string}')
                    ),
                    'query-input' => 'required name=search_term_string'
                )
            );
        }
        
        if (!empty($schema_data)) {
            echo '<script type="application/ld+json">' . "\n";
            echo wp_json_encode($schema_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            echo "\n" . '</script>' . "\n";
        }
    }
    
    /**
     * إضافة Canonical URL
     */
    public static function add_canonical_url() {
        $canonical_url = self::get_canonical_url();
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
        
        // إضافة العلاقات للصفحات المرقمة
        if (is_paged()) {
            $paged = get_query_var('paged') ?: get_query_var('page') ?: 1;
            
            if ($paged > 1) {
                $prev_link = get_previous_posts_page_link();
                if ($prev_link) {
                    echo '<link rel="prev" href="' . esc_url($prev_link) . '">' . "\n";
                }
            }
            
            $next_link = get_next_posts_page_link();
            if ($next_link) {
                echo '<link rel="next" href="' . esc_url($next_link) . '">' . "\n";
            }
        }
    }
    
    /**
     * تحسين العنوان
     */
    public static function optimize_title($title, $sep, $seplocation) {
        $new_title = self::get_page_title();
        
        if (is_home() || is_front_page()) {
            $new_title = get_bloginfo('name');
            $tagline = get_bloginfo('description');
            if ($tagline) {
                $new_title .= ' ' . $sep . ' ' . $tagline;
            }
        }
        
        return $new_title;
    }
    
    /**
     * تعديل فاصل العنوان
     */
    public static function title_separator($sep) {
        return '|';
    }
    
    /**
     * تعديل أجزاء العنوان
     */
    public static function modify_title_parts($title_parts) {
        if (is_home() || is_front_page()) {
            $title_parts['title'] = get_bloginfo('name');
            if (get_bloginfo('description')) {
                $title_parts['tagline'] = get_bloginfo('description');
            }
        }
        
        return $title_parts;
    }
    
    /**
     * إضافة وصف Meta
     */
    public static function add_meta_description() {
        $description = self::get_meta_description();
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
    }
    
    /**
     * الحصول على عنوان الصفحة
     */
    private static function get_page_title() {
        if (is_single()) {
            return get_the_title();
        } elseif (is_category()) {
            return single_cat_title('', false) . ' - ' . get_bloginfo('name');
        } elseif (is_tag()) {
            return single_tag_title('', false) . ' - ' . get_bloginfo('name');
        } elseif (is_author()) {
            return get_the_author() . ' - ' . get_bloginfo('name');
        } elseif (is_search()) {
            return 'نتائج البحث عن: ' . get_search_query() . ' - ' . get_bloginfo('name');
        } elseif (is_404()) {
            return 'صفحة غير موجودة - ' . get_bloginfo('name');
        } elseif (is_home() || is_front_page()) {
            return get_bloginfo('name') . ' - ' . get_bloginfo('description');
        } else {
            return wp_get_document_title();
        }
    }
    
    /**
     * الحصول على وصف Meta
     */
    private static function get_meta_description() {
        global $post;
        
        if (is_single() && $post) {
            // وصف مخصص من Custom Field
            $custom_description = get_post_meta($post->ID, '_muhtawaa_meta_description', true);
            if ($custom_description) {
                return $custom_description;
            }
            
            // الخلاصة
            $excerpt = get_the_excerpt($post->ID);
            if ($excerpt) {
                return wp_trim_words($excerpt, 25, '...');
            }
            
            // بداية المحتوى
            $content = strip_tags($post->post_content);
            return wp_trim_words($content, 25, '...');
            
        } elseif (is_category()) {
            $category_desc = category_description();
            if ($category_desc) {
                return wp_trim_words(strip_tags($category_desc), 25, '...');
            }
            return 'تصفح مقالات فئة ' . single_cat_title('', false) . ' في ' . get_bloginfo('name');
            
        } elseif (is_tag()) {
            $tag_desc = tag_description();
            if ($tag_desc) {
                return wp_trim_words(strip_tags($tag_desc), 25, '...');
            }
            return 'تصفح مقالات ذات علامة ' . single_tag_title('', false) . ' في ' . get_bloginfo('name');
            
        } elseif (is_author()) {
            $author_desc = get_the_author_meta('description');
            if ($author_desc) {
                return wp_trim_words($author_desc, 25, '...');
            }
            return 'تصفح مقالات الكاتب ' . get_the_author() . ' في ' . get_bloginfo('name');
            
        } elseif (is_search()) {
            return 'نتائج البحث عن "' . get_search_query() . '" في ' . get_bloginfo('name');
            
        } elseif (is_home() || is_front_page()) {
            $site_description = get_bloginfo('description');
            if ($site_description) {
                return $site_description;
            }
            return 'موقع ' . get_bloginfo('name') . ' - مقالات وحلول يومية مفيدة';
        }
        
        return '';
    }
    
    /**
     * الحصول على كلمات مفتاحية
     */
    private static function get_meta_keywords($post_id) {
        // كلمات مفتاحية مخصصة
        $custom_keywords = get_post_meta($post_id, '_muhtawaa_meta_keywords', true);
        if ($custom_keywords) {
            return $custom_keywords;
        }
        
        // تجميع الكلمات من العلامات والفئات
        $keywords = array();
        
        // الفئات
        $categories = get_the_category($post_id);
        foreach ($categories as $category) {
            $keywords[] = $category->name;
        }
        
        // العلامات
        $tags = get_the_tags($post_id);
        if ($tags) {
            foreach ($tags as $tag) {
                $keywords[] = $tag->name;
            }
        }
        
        return implode(', ', array_unique($keywords));
    }
    
    /**
     * الحصول على قيم robots meta
     */
    private static function get_robots_meta() {
        if (is_search() || is_404()) {
            return 'noindex, nofollow';
        } elseif (is_category() || is_tag() || is_author()) {
            return 'index, follow, noarchive';
        } else {
            return 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1';
        }
    }
    
    /**
     * الحصول على رابط canonical
     */
    private static function get_canonical_url() {
        global $wp;
        
        if (is_single() || is_page()) {
            return get_permalink();
        } elseif (is_category()) {
            return get_category_link(get_queried_object_id());
        } elseif (is_tag()) {
            return get_tag_link(get_queried_object_id());
        } elseif (is_author()) {
            return get_author_posts_url(get_queried_object_id());
        } elseif (is_home() || is_front_page()) {
            return home_url('/');
        } else {
            return home_url(add_query_arg(array(), $wp->request));
        }
    }
    
    /**
     * الحصول على صورة Open Graph
     */
    private static function get_og_image() {
        global $post;
        
        if (is_single() && $post) {
            // صورة مخصصة لـ OG
            $og_image = get_post_meta($post->ID, '_muhtawaa_og_image', true);
            if ($og_image) {
                return $og_image;
            }
            
            // الصورة المميزة
            $featured_image = get_the_post_thumbnail_url($post->ID, 'large');
            if ($featured_image) {
                return $featured_image;
            }
        }
        
        // الصورة الافتراضية للموقع
        $default_og_image = get_theme_mod('default_og_image');
        if ($default_og_image) {
            return $default_og_image;
        }
        
        // شعار الموقع
        return self::get_site_logo();
    }
    
    /**
     * الحصول على شعار الموقع
     */
    private static function get_site_logo() {
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
            if ($logo_url) {
                return $logo_url;
            }
        }
        
        // صورة افتراضية
        return get_template_directory_uri() . '/assets/images/logo.png';
    }
    
    /**
     * الحصول على فئات المقال
     */
    private static function get_article_categories($post_id) {
        $categories = get_the_category($post_id);
        $category_names = array();
        
        foreach ($categories as $category) {
            $category_names[] = $category->name;
        }
        
        return $category_names;
    }
    
    /**
     * إضافة قواعد إعادة كتابة Sitemap
     */
    public static function add_sitemap_rewrite() {
        add_rewrite_rule('^sitemap\.xml$', 'index.php?muhtawaa_sitemap=1', 'top');
        add_rewrite_rule('^sitemap-posts\.xml$', 'index.php?muhtawaa_sitemap=posts', 'top');
        add_rewrite_rule('^sitemap-pages\.xml$', 'index.php?muhtawaa_sitemap=pages', 'top');
        add_rewrite_rule('^sitemap-categories\.xml$', 'index.php?muhtawaa_sitemap=categories', 'top');
    }
    
    /**
     * معالجة طلبات Sitemap
     */
    public static function handle_sitemap_request() {
        $sitemap_type = get_query_var('muhtawaa_sitemap');
        
        if ($sitemap_type) {
            header('Content-Type: application/xml; charset=utf-8');
            
            switch ($sitemap_type) {
                case '1':
                    self::generate_sitemap_index();
                    break;
                case 'posts':
                    self::generate_posts_sitemap();
                    break;
                case 'pages':
                    self::generate_pages_sitemap();
                    break;
                case 'categories':
                    self::generate_categories_sitemap();
                    break;
            }
            exit;
        }
    }
    
    /**
     * إنشاء فهرس Sitemap
     */
    private static function generate_sitemap_index() {
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Sitemap المقالات
        echo '<sitemap>' . "\n";
        echo '<loc>' . home_url('/sitemap-posts.xml') . '</loc>' . "\n";
        echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '</sitemap>' . "\n";
        
        // Sitemap الصفحات
        echo '<sitemap>' . "\n";
        echo '<loc>' . home_url('/sitemap-pages.xml') . '</loc>' . "\n";
        echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '</sitemap>' . "\n";
        
        // Sitemap الفئات
        echo '<sitemap>' . "\n";
        echo '<loc>' . home_url('/sitemap-categories.xml') . '</loc>' . "\n";
        echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '</sitemap>' . "\n";
        
        echo '</sitemapindex>' . "\n";
    }
    
    /**
     * إنشاء sitemap المقالات
     */
    private static function generate_posts_sitemap() {
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $posts = get_posts(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'modified',
            'order' => 'DESC'
        ));
        
        foreach ($posts as $post) {
            echo '<url>' . "\n";
            echo '<loc>' . get_permalink($post->ID) . '</loc>' . "\n";
            echo '<lastmod>' . date('c', strtotime($post->post_modified)) . '</lastmod>' . "\n";
            echo '<changefreq>weekly</changefreq>' . "\n";
            echo '<priority>0.8</priority>' . "\n";
            echo '</url>' . "\n";
        }
        
        echo '</urlset>' . "\n";
    }
    
    /**
     * إنشاء sitemap الصفحات
     */
    private static function generate_pages_sitemap() {
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // الصفحة الرئيسية
        echo '<url>' . "\n";
        echo '<loc>' . home_url('/') . '</loc>' . "\n";
        echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '<changefreq>daily</changefreq>' . "\n";
        echo '<priority>1.0</priority>' . "\n";
        echo '</url>' . "\n";
        
        // الصفحات
        $pages = get_pages(array(
            'post_status' => 'publish',
            'sort_column' => 'post_modified'
        ));
        
        foreach ($pages as $page) {
            echo '<url>' . "\n";
            echo '<loc>' . get_permalink($page->ID) . '</loc>' . "\n";
            echo '<lastmod>' . date('c', strtotime($page->post_modified)) . '</lastmod>' . "\n";
            echo '<changefreq>monthly</changefreq>' . "\n";
            echo '<priority>0.6</priority>' . "\n";
            echo '</url>' . "\n";
        }
        
        echo '</urlset>' . "\n";
    }
    
    /**
     * إنشاء sitemap الفئات
     */
    private static function generate_categories_sitemap() {
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $categories = get_categories(array(
            'hide_empty' => true
        ));
        
        foreach ($categories as $category) {
            echo '<url>' . "\n";
            echo '<loc>' . get_category_link($category->term_id) . '</loc>' . "\n";
            echo '<lastmod>' . date('c') . '</lastmod>' . "\n";
            echo '<changefreq>weekly</changefreq>' . "\n";
            echo '<priority>0.7</priority>' . "\n";
            echo '</url>' . "\n";
        }
        
        echo '</urlset>' . "\n";
    }
    
    /**
     * تحسين خصائص الصور
     */
    public static function optimize_image_attributes($attr, $attachment, $size) {
        $attachment_id = $attachment->ID;
        
        // إضافة alt text إذا لم يكن موجوداً
        if (empty($attr['alt'])) {
            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
            if (empty($alt_text)) {
                $alt_text = $attachment->post_title;
            }
            $attr['alt'] = $alt_text;
        }
        
        // إضافة loading="lazy" للصور
        if (!isset($attr['loading'])) {
            $attr['loading'] = 'lazy';
        }
        
        // إضافة decoding="async"
        if (!isset($attr['decoding'])) {
            $attr['decoding'] = 'async';
        }
        
        return $attr;
    }
    
    /**
     * عرض مسار التنقل (Breadcrumbs)
     */
    public static function display_breadcrumbs() {
        if (is_home() || is_front_page()) {
            return;
        }
        
        $breadcrumbs = array();
        $breadcrumbs[] = array(
            'title' => 'الرئيسية',
            'url' => home_url('/')
        );
        
        if (is_category()) {
            $category = get_queried_object();
            $breadcrumbs[] = array(
                'title' => $category->name,
                'url' => get_category_link($category->term_id)
            );
            
        } elseif (is_tag()) {
            $tag = get_queried_object();
            $breadcrumbs[] = array(
                'title' => 'علامة: ' . $tag->name,
                'url' => get_tag_link($tag->term_id)
            );
            
        } elseif (is_author()) {
            $author = get_queried_object();
            $breadcrumbs[] = array(
                'title' => 'الكاتب: ' . $author->display_name,
                'url' => get_author_posts_url($author->ID)
            );
            
        } elseif (is_single()) {
            $post = get_queried_object();
            
            // إضافة الفئة الرئيسية
            $categories = get_the_category($post->ID);
            if (!empty($categories)) {
                $main_category = $categories[0];
                $breadcrumbs[] = array(
                    'title' => $main_category->name,
                    'url' => get_category_link($main_category->term_id)
                );
            }
            
            $breadcrumbs[] = array(
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID)
            );
            
        } elseif (is_page()) {
            $page = get_queried_object();
            
            // إضافة الصفحات الأب
            if ($page->post_parent) {
                $parent_ids = array_reverse(get_post_ancestors($page->ID));
                foreach ($parent_ids as $parent_id) {
                    $breadcrumbs[] = array(
                        'title' => get_the_title($parent_id),
                        'url' => get_permalink($parent_id)
                    );
                }
            }
            
            $breadcrumbs[] = array(
                'title' => get_the_title($page->ID),
                'url' => get_permalink($page->ID)
            );
            
        } elseif (is_search()) {
            $breadcrumbs[] = array(
                'title' => 'نتائج البحث عن: ' . get_search_query(),
                'url' => ''
            );
            
        } elseif (is_404()) {
            $breadcrumbs[] = array(
                'title' => 'صفحة غير موجودة',
                'url' => ''
            );
        }
        
        // عرض مسار التنقل
        if (count($breadcrumbs) > 1) {
            echo '<nav class="breadcrumbs" aria-label="مسار التنقل">';
            echo '<ol class="breadcrumb-list">';
            
            foreach ($breadcrumbs as $index => $breadcrumb) {
                $is_last = ($index === count($breadcrumbs) - 1);
                
                echo '<li class="breadcrumb-item' . ($is_last ? ' active' : '') . '">';
                
                if (!$is_last && !empty($breadcrumb['url'])) {
                    echo '<a href="' . esc_url($breadcrumb['url']) . '">' . esc_html($breadcrumb['title']) . '</a>';
                } else {
                    echo '<span>' . esc_html($breadcrumb['title']) . '</span>';
                }
                
                if (!$is_last) {
                    echo '<span class="breadcrumb-separator"> / </span>';
                }
                
                echo '</li>';
            }
            
            echo '</ol>';
            echo '</nav>';
        }
        
        // إضافة Structured Data للـ breadcrumbs
        $breadcrumb_schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array()
        );
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            if (!empty($breadcrumb['url'])) {
                $breadcrumb_schema['itemListElement'][] = array(
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $breadcrumb['title'],
                    'item' => $breadcrumb['url']
                );
            }
        }
        
        if (!empty($breadcrumb_schema['itemListElement'])) {
            echo '<script type="application/ld+json">';
            echo wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            echo '</script>';
        }
    }
    
    /**
     * تحسين الروابط الثابتة
     */
    public static function optimize_permalinks() {
        // التأكد من أن الروابط الثابتة محسنة
        if (get_option('permalink_structure') === '') {
            update_option('permalink_structure', '/%postname%/');
            flush_rewrite_rules();
        }
        
        // إضافة قواعد إعادة كتابة مخصصة
        add_rewrite_tag('%muhtawaa_sitemap%', '([^&]+)');
    }
    
    /**
     * تحسين robots.txt
     */
    public static function optimize_robots_txt($output, $public) {
        if ($public) {
            $robots_content = "User-agent: *\n";
            $robots_content .= "Disallow: /wp-admin/\n";
            $robots_content .= "Disallow: /wp-includes/\n";
            $robots_content .= "Disallow: /wp-content/plugins/\n";
            $robots_content .= "Disallow: /wp-content/themes/\n";
            $robots_content .= "Disallow: /trackback\n";
            $robots_content .= "Disallow: /feed\n";
            $robots_content .= "Disallow: /comments\n";
            $robots_content .= "Disallow: /search\n";
            $robots_content .= "Disallow: /?s=\n";
            $robots_content .= "Disallow: /author/\n";
            $robots_content .= "Disallow: */trackback\n";
            $robots_content .= "Disallow: */feed\n";
            $robots_content .= "Disallow: */comments\n";
            $robots_content .= "Disallow: /*?*\n";
            $robots_content .= "Disallow: /*#\n";
            $robots_content .= "\n";
            $robots_content .= "Allow: /wp-content/uploads/\n";
            $robots_content .= "\n";
            $robots_content .= "Sitemap: " . home_url('/sitemap.xml') . "\n";
            
            return $robots_content;
        }
        
        return $output;
    }
    
    /**
     * تحسين استعلامات الأرشيف
     */
    public static function optimize_archive_queries($query) {
        if (!is_admin() && $query->is_main_query()) {
            // تحسين صفحات الفئات
            if ($query->is_category()) {
                $query->set('posts_per_page', 12);
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
            }
            
            // تحسين صفحات العلامات
            if ($query->is_tag()) {
                $query->set('posts_per_page', 12);
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
            }
            
            // تحسين صفحات الكاتب
            if ($query->is_author()) {
                $query->set('posts_per_page', 10);
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
            }
            
            // تحسين البحث
            if ($query->is_search()) {
                $query->set('posts_per_page', 10);
                $query->set('orderby', 'relevance');
                
                // البحث في العنوان والمحتوى والخلاصة
                add_filter('posts_search', array(__CLASS__, 'improve_search_query'), 10, 2);
            }
        }
    }
    
    /**
     * تحسين استعلام البحث
     */
    public static function improve_search_query($search, $query) {
        if (empty($search) || !$query->is_search()) {
            return $search;
        }
        
        global $wpdb;
        
        $search_term = $query->query_vars['s'];
        $search_term = $wpdb->esc_like($search_term);
        
        $search = " AND (
            ({$wpdb->posts}.post_title LIKE '%{$search_term}%') 
            OR ({$wpdb->posts}.post_content LIKE '%{$search_term}%')
            OR ({$wpdb->posts}.post_excerpt LIKE '%{$search_term}%')
            OR EXISTS (
                SELECT 1 FROM {$wpdb->postmeta} 
                WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                AND {$wpdb->postmeta}.meta_value LIKE '%{$search_term}%'
            )
        )";
        
        return $search;
    }
    
    /**
     * إضافة Schema للموقع
     */
    public static function add_website_schema() {
        if (is_home() || is_front_page()) {
            $organization_schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'url' => home_url('/'),
                'logo' => self::get_site_logo(),
                'sameAs' => self::get_social_profiles(),
                'contactPoint' => array(
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer service',
                    'areaServed' => 'SA',
                    'availableLanguage' => 'Arabic'
                )
            );
            
            echo '<script type="application/ld+json">';
            echo wp_json_encode($organization_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            echo '</script>';
        }
    }
    
    /**
     * الحصول على ملفات التواصل الاجتماعي
     */
    private static function get_social_profiles() {
        $social_profiles = array();
        
        $social_links = array(
            'facebook_url',
            'twitter_url', 
            'instagram_url',
            'youtube_url',
            'linkedin_url'
        );
        
        foreach ($social_links as $social_link) {
            $url = get_theme_mod($social_link);
            if ($url) {
                $social_profiles[] = $url;
            }
        }
        
        return $social_profiles;
    }
    
    /**
     * إضافة CSS للـ breadcrumbs
     */
    public static function breadcrumbs_styles() {
        echo '<style>
        .breadcrumbs {
            margin: 1rem 0;
            font-size: 0.875rem;
        }
        .breadcrumb-list {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .breadcrumb-item {
            display: flex;
            align-items: center;
        }
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        .breadcrumb-item.active span {
            color: var(--text-muted);
        }
        .breadcrumb-separator {
            margin: 0 0.5rem;
            color: var(--text-muted);
        }
        </style>';
    }
    
    /**
     * إضافة Meta Box للـ SEO في صفحة التحرير
     */
    public static function add_seo_meta_box() {
        add_meta_box(
            'muhtawaa_seo_meta',
            'إعدادات SEO',
            array(__CLASS__, 'seo_meta_box_callback'),
            array('post', 'page'),
            'normal',
            'high'
        );
    }
    
    /**
     * محتوى Meta Box للـ SEO
     */
    public static function seo_meta_box_callback($post) {
        wp_nonce_field('muhtawaa_seo_meta_nonce', 'muhtawaa_seo_meta_nonce');
        
        $meta_description = get_post_meta($post->ID, '_muhtawaa_meta_description', true);
        $meta_keywords = get_post_meta($post->ID, '_muhtawaa_meta_keywords', true);
        $og_image = get_post_meta($post->ID, '_muhtawaa_og_image', true);
        
        echo '<table class="form-table">';
        
        echo '<tr>';
        echo '<th><label for="muhtawaa_meta_description">وصف Meta:</label></th>';
        echo '<td>';
        echo '<textarea id="muhtawaa_meta_description" name="muhtawaa_meta_description" rows="3" cols="50" placeholder="وصف مختصر للصفحة (مُستحسن 150-160 حرف)">' . esc_textarea($meta_description) . '</textarea>';
        echo '<p class="description">وصف يظهر في نتائج البحث. اتركه فارغاً لاستخدام الخلاصة التلقائية.</p>';
        echo '</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<th><label for="muhtawaa_meta_keywords">الكلمات المفتاحية:</label></th>';
        echo '<td>';
        echo '<input type="text" id="muhtawaa_meta_keywords" name="muhtawaa_meta_keywords" value="' . esc_attr($meta_keywords) . '" placeholder="كلمة1, كلمة2, كلمة3">';
        echo '<p class="description">كلمات مفتاحية مفصولة بفواصل. اتركها فارغة لاستخدام الفئات والعلامات.</p>';
        echo '</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<th><label for="muhtawaa_og_image">صورة Open Graph:</label></th>';
        echo '<td>';
        echo '<input type="url" id="muhtawaa_og_image" name="muhtawaa_og_image" value="' . esc_url($og_image) . '" placeholder="رابط الصورة">';
        echo '<p class="description">صورة تظهر عند مشاركة الرابط على وسائل التواصل. اتركها فارغة لاستخدام الصورة المميزة.</p>';
        echo '</td>';
        echo '</tr>';
        
        echo '</table>';
    }
    
    /**
     * حفظ بيانات Meta Box
     */
    public static function save_seo_meta_box($post_id) {
        if (!isset($_POST['muhtawaa_seo_meta_nonce']) || !wp_verify_nonce($_POST['muhtawaa_seo_meta_nonce'], 'muhtawaa_seo_meta_nonce')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // حفظ وصف Meta
        if (isset($_POST['muhtawaa_meta_description'])) {
            $meta_description = sanitize_textarea_field($_POST['muhtawaa_meta_description']);
            update_post_meta($post_id, '_muhtawaa_meta_description', $meta_description);
        }
        
        // حفظ الكلمات المفتاحية
        if (isset($_POST['muhtawaa_meta_keywords'])) {
            $meta_keywords = sanitize_text_field($_POST['muhtawaa_meta_keywords']);
            update_post_meta($post_id, '_muhtawaa_meta_keywords', $meta_keywords);
        }
        
        // حفظ صورة OG
        if (isset($_POST['muhtawaa_og_image'])) {
            $og_image = esc_url_raw($_POST['muhtawaa_og_image']);
            update_post_meta($post_id, '_muhtawaa_og_image', $og_image);
        }
    }
    
    /**
     * إضافة ترميز Schema (لمنع الخطأ)
     */
    public static function add_schema_markup() {
        // يمكنك هنا إضافة ترميز schema.org حسب الحاجة
        // مثال: إضافة بيانات منظمة للمقال أو الصفحة
    }
}

// تهيئة فئة SEO
add_action('init', array('MuhtawaaSEO', 'init'));

// إضافة Meta Box للـ SEO
add_action('add_meta_boxes', array('MuhtawaaSEO', 'add_seo_meta_box'));
add_action('save_post', array('MuhtawaaSEO', 'save_seo_meta_box'));

// إضافة أنماط breadcrumbs
add_action('wp_head', array('MuhtawaaSEO', 'breadcrumbs_styles'));
