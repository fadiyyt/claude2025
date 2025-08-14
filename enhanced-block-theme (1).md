# 🚀 قالب Block Theme محسّن - إصدار احترافي

## 📁 **1. style.css - معلومات تعريفية فقط**

```css
/*
Theme Name: Practical Solutions Pro
Description: قالب ووردبريس احترافي للحلول العملية مع تقنية Block Theme المتقدمة
Version: 2.1.0
Author: Your Name
Text Domain: practical-solutions
Requires at least: 6.4
Tested up to: 6.5
Requires PHP: 8.0
License: GPL v3 or later
Tags: block-themes, full-site-editing, rtl-language-support, accessibility-ready, custom-colors, custom-logo, custom-menu, featured-images, footer-widgets, sticky-post, theme-options, threaded-comments, translation-ready
*/

/* ملف CSS نظيف - الأنماط منفصلة في ملفات مخصصة */
```

## 📄 **2. theme.json - محسّن مع Global Styles**

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "appearanceTools": true,
    "useRootPaddingAwareAlignments": true,
    "layout": {
      "contentSize": "800px",
      "wideSize": "1200px",
      "allowJustification": false,
      "allowOrientation": false,
      "allowSwitching": true,
      "allowInheriting": true,
      "allowEditing": true,
      "allowCustomContentAndWideSize": true
    },
    "color": {
      "background": true,
      "custom": true,
      "customDuotone": true,
      "customGradient": true,
      "defaultGradients": true,
      "defaultPalette": false,
      "duotone": [
        {
          "colors": ["#000000", "#ffffff"],
          "slug": "black-and-white",
          "name": "أسود وأبيض"
        },
        {
          "colors": ["#007cba", "#ffffff"],
          "slug": "primary-and-white", 
          "name": "أزرق وأبيض"
        }
      ],
      "gradients": [
        {
          "gradient": "linear-gradient(135deg,var(--wp--preset--color--primary) 0%,var(--wp--preset--color--secondary) 100%)",
          "name": "تدرج أساسي",
          "slug": "primary-gradient"
        },
        {
          "gradient": "linear-gradient(135deg,rgba(0,124,186,0.8) 0%,rgba(240,244,248,0.8) 100%)",
          "name": "تدرج شفاف",
          "slug": "transparent-gradient"
        }
      ],
      "palette": [
        {
          "color": "#ffffff",
          "name": "الأساس الأبيض",
          "slug": "base"
        },
        {
          "color": "#1a1a1a",
          "name": "المقابل الداكن",
          "slug": "contrast"
        },
        {
          "color": "#007cba",
          "name": "الأزرق الأساسي",
          "slug": "primary"
        },
        {
          "color": "#f0f4f8",
          "name": "الرمادي الثانوي",
          "slug": "secondary"
        },
        {
          "color": "#2c3e50",
          "name": "الرمادي الثالثي",
          "slug": "tertiary"
        },
        {
          "color": "#e74c3c",
          "name": "أحمر التنبيه",
          "slug": "accent"
        },
        {
          "color": "#27ae60",
          "name": "أخضر النجاح",
          "slug": "success"
        },
        {
          "color": "#f39c12",
          "name": "برتقالي التحذير",
          "slug": "warning"
        }
      ],
      "text": true,
      "link": true
    },
    "typography": {
      "customFontSize": true,
      "dropCap": true,
      "fontStyle": true,
      "fontWeight": true,
      "letterSpacing": true,
      "lineHeight": true,
      "textDecoration": true,
      "textTransform": true,
      "writingMode": true,
      "fontFamilies": [
        {
          "name": "نوتو عربي",
          "slug": "noto-arabic",
          "fontFamily": "'Noto Sans Arabic', -apple-system, BlinkMacSystemFont, sans-serif",
          "fontFace": [
            {
              "fontFamily": "Noto Sans Arabic",
              "fontWeight": "300 700",
              "fontStyle": "normal",
              "fontStretch": "normal",
              "src": ["file:./assets/fonts/NotoSansArabic-VariableFont_wght.woff2"]
            }
          ]
        },
        {
          "name": "تاهوما",
          "slug": "tahoma",
          "fontFamily": "Tahoma, Arial, sans-serif"
        },
        {
          "name": "أمنية",
          "slug": "amiri",
          "fontFamily": "Amiri, serif"
        }
      ],
      "fontSizes": [
        {
          "name": "صغير جداً",
          "slug": "x-small",
          "size": "12px"
        },
        {
          "name": "صغير",
          "slug": "small",
          "size": "14px"
        },
        {
          "name": "متوسط",
          "slug": "medium",
          "size": "18px"
        },
        {
          "name": "كبير",
          "slug": "large",
          "size": "24px"
        },
        {
          "name": "كبير جداً",
          "slug": "x-large",
          "size": "32px"
        },
        {
          "name": "ضخم",
          "slug": "xx-large",
          "size": "48px"
        }
      ]
    },
    "spacing": {
      "blockGap": true,
      "margin": true,
      "padding": true,
      "units": ["px", "em", "rem", "vh", "vw", "%"],
      "spacingScale": {
        "operator": "*",
        "increment": 1.5,
        "steps": 7,
        "mediumStep": 1.5,
        "unit": "rem"
      },
      "spacingSizes": [
        {
          "name": "صغير",
          "slug": "small",
          "size": "1rem"
        },
        {
          "name": "متوسط", 
          "slug": "medium",
          "size": "2rem"
        },
        {
          "name": "كبير",
          "slug": "large",
          "size": "3rem"
        }
      ]
    },
    "border": {
      "color": true,
      "radius": true,
      "style": true,
      "width": true
    },
    "dimensions": {
      "aspectRatio": true,
      "minHeight": true
    },
    "position": {
      "sticky": true
    },
    "custom": {
      "spacing": {
        "outer": "max(1rem, 5vw)"
      },
      "typography": {
        "font-size": {
          "gigantic": "clamp(3rem, 6vw, 8rem)"
        },
        "line-height": {
          "tiny": 1.15,
          "small": 1.2,
          "medium": 1.4,
          "normal": 1.6
        }
      }
    }
  },
  "styles": {
    "color": {
      "background": "var(--wp--preset--color--base)",
      "text": "var(--wp--preset--color--contrast)"
    },
    "typography": {
      "fontFamily": "var(--wp--preset--font-family--noto-arabic)",
      "fontSize": "var(--wp--preset--font-size--medium)",
      "lineHeight": "var(--wp--custom--typography--line-height--normal)"
    },
    "spacing": {
      "blockGap": "var(--wp--preset--spacing--medium)",
      "padding": {
        "top": "0px",
        "right": "var(--wp--custom--spacing--outer)",
        "bottom": "0px", 
        "left": "var(--wp--custom--spacing--outer)"
      }
    },
    "elements": {
      "link": {
        "color": {
          "text": "var(--wp--preset--color--primary)"
        },
        "typography": {
          "textDecoration": "none"
        },
        ":hover": {
          "color": {
            "text": "var(--wp--preset--color--tertiary)"
          },
          "typography": {
            "textDecoration": "underline"
          }
        },
        ":focus": {
          "color": {
            "text": "var(--wp--preset--color--tertiary)"
          },
          "typography": {
            "textDecoration": "underline dashed"
          }
        }
      },
      "h1": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--xx-large)",
          "fontWeight": "700",
          "lineHeight": "var(--wp--custom--typography--line-height--tiny)"
        },
        "spacing": {
          "margin": {
            "bottom": "var(--wp--preset--spacing--medium)"
          }
        }
      },
      "h2": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--x-large)",
          "fontWeight": "600",
          "lineHeight": "var(--wp--custom--typography--line-height--small)"
        }
      },
      "h3": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--large)",
          "fontWeight": "600"
        }
      },
      "h4": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)",
          "fontWeight": "600"
        }
      },
      "h5": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--small)",
          "fontWeight": "600",
          "textTransform": "uppercase",
          "letterSpacing": "0.1em"
        }
      },
      "h6": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--small)",
          "fontWeight": "400",
          "textTransform": "uppercase",
          "letterSpacing": "0.1em"
        }
      },
      "button": {
        "color": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--base)"
        },
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)",
          "fontWeight": "500"
        },
        "spacing": {
          "padding": {
            "top": "0.75rem",
            "right": "1.5rem", 
            "bottom": "0.75rem",
            "left": "1.5rem"
          }
        },
        "border": {
          "radius": "6px"
        },
        ":hover": {
          "color": {
            "background": "var(--wp--preset--color--tertiary)"
          }
        },
        ":focus": {
          "color": {
            "background": "var(--wp--preset--color--tertiary)"
          }
        }
      }
    },
    "blocks": {
      "core/post-title": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--x-large)",
          "fontWeight": "700",
          "lineHeight": "var(--wp--custom--typography--line-height--small)"
        },
        "spacing": {
          "margin": {
            "bottom": "var(--wp--preset--spacing--small)"
          }
        },
        "elements": {
          "link": {
            "color": {
              "text": "var(--wp--preset--color--contrast)"
            },
            ":hover": {
              "color": {
                "text": "var(--wp--preset--color--primary)"
              }
            }
          }
        }
      },
      "core/post-excerpt": {
        "typography": {
          "lineHeight": "var(--wp--custom--typography--line-height--medium)"
        },
        "spacing": {
          "margin": {
            "bottom": "var(--wp--preset--spacing--small)"
          }
        }
      },
      "core/post-date": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--small)",
          "fontWeight": "400"
        },
        "color": {
          "text": "var(--wp--preset--color--tertiary)"
        }
      },
      "core/post-terms": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--small)",
          "fontWeight": "500"
        },
        "color": {
          "text": "var(--wp--preset--color--primary)"
        }
      },
      "core/search": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)"
        },
        "border": {
          "radius": "50px"
        }
      },
      "core/navigation": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)",
          "fontWeight": "500"
        },
        "spacing": {
          "blockGap": "2rem"
        }
      }
    }
  },
  "templateParts": [
    {
      "name": "header",
      "title": "رأس الصفحة",
      "area": "header"
    },
    {
      "name": "footer",
      "title": "تذييل الصفحة", 
      "area": "footer"
    },
    {
      "name": "sidebar",
      "title": "الشريط الجانبي",
      "area": "uncategorized"
    }
  ],
  "customTemplates": [
    {
      "name": "page-no-header",
      "title": "صفحة بدون رأس",
      "postTypes": ["page"]
    },
    {
      "name": "single-featured",
      "title": "مقال مميز",
      "postTypes": ["post"]
    }
  ],
  "patterns": [
    "practical-solutions/hero-section",
    "practical-solutions/featured-posts",
    "practical-solutions/call-to-action",
    "practical-solutions/contact-form"
  ]
}
```

## ⚙️ **3. functions.php - محسّن واحترافي**

```php
<?php
/**
 * Practical Solutions Pro - Enhanced Block Theme
 * قالب الحلول العملية الاحترافي
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تعريف ثوابت القالب
define('PS_THEME_VERSION', '2.1.0');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());

// إعدادات القالب الأساسية
function practical_solutions_setup() {
    // دعم ميزات WordPress الحديثة
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('post-formats', array('aside', 'gallery', 'video', 'audio'));
    
    // دعم Block Theme المتقدم
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    add_theme_support('custom-line-height');
    add_theme_support('custom-spacing');
    add_theme_support('link-color');
    
    // تحديد أحجام الصور المحسنة
    add_image_size('ps-thumbnail', 400, 300, true);
    add_image_size('ps-medium', 800, 600, true);
    add_image_size('ps-large', 1200, 800, true);
    add_image_size('ps-hero', 1600, 900, true);
    
    // دعم الترجمة
    load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');
    
    // إضافة editor styles
    add_editor_style(array(
        'assets/css/editor-styles.css',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');

// تحميل الأنماط والسكريبت المحسنة
function practical_solutions_enqueue_assets() {
    // CSS الرئيسي (منفصل عن style.css)
    wp_enqueue_style(
        'ps-main-styles',
        PS_THEME_URI . '/assets/css/main.css',
        array(),
        PS_THEME_VERSION
    );
    
    // CSS الوضع المظلم
    wp_enqueue_style(
        'ps-dark-mode',
        PS_THEME_URI . '/assets/css/dark-mode.css',
        array('ps-main-styles'),
        PS_THEME_VERSION
    );
    
    // CSS التصميم المتجاوب
    wp_enqueue_style(
        'ps-responsive',
        PS_THEME_URI . '/assets/css/responsive.css',
        array('ps-main-styles'),
        PS_THEME_VERSION
    );
    
    // JavaScript الرئيسي المحسن
    wp_enqueue_script(
        'ps-main-script',
        PS_THEME_URI . '/assets/js/main.js',
        array(),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // JavaScript للبحث المتقدم
    wp_enqueue_script(
        'ps-search-enhanced',
        PS_THEME_URI . '/assets/js/search-enhanced.js',
        array('ps-main-script'),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // تمرير البيانات المحسنة لـ JavaScript
    wp_localize_script('ps-main-script', 'psSettings', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ps_nonce'),
        'homeUrl' => home_url('/'),
        'themeUri' => PS_THEME_URI,
        'isRTL' => is_rtl(),
        'locale' => get_locale(),
        'searchPlaceholder' => __('ابحث عن الحلول...', 'practical-solutions'),
        'voiceSearchText' => __('أتحدث...', 'practical-solutions'),
        'noResultsText' => __('لا توجد نتائج', 'practical-solutions'),
        'loadingText' => __('جاري التحميل...', 'practical-solutions'),
    ));
    
    // خطوط Google المحسنة
    wp_enqueue_style(
        'ps-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_assets');

// تسجيل Block Styles المخصصة
function practical_solutions_register_block_styles() {
    // أنماط للمجموعات
    register_block_style('core/group', array(
        'name' => 'ps-card-style',
        'label' => __('بطاقة', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-hero-section',
        'label' => __('قسم البطل', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-feature-box',
        'label' => __('صندوق ميزة', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    // أنماط للأزرار
    register_block_style('core/button', array(
        'name' => 'ps-primary-button',
        'label' => __('زر أساسي', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    register_block_style('core/button', array(
        'name' => 'ps-outline-button',
        'label' => __('زر مخطط', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    // أنماط للعناوين
    register_block_style('core/heading', array(
        'name' => 'ps-section-title',
        'label' => __('عنوان القسم', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
    
    // أنماط للصور
    register_block_style('core/image', array(
        'name' => 'ps-rounded-image',
        'label' => __('صورة مدورة', 'practical-solutions'),
        'style_handle' => 'ps-main-styles'
    ));
}
add_action('init', 'practical_solutions_register_block_styles');

// تسجيل Block Patterns المخصصة
function practical_solutions_register_block_patterns() {
    // فئة الأنماط
    register_block_pattern_category('practical-solutions', array(
        'label' => __('الحلول العملية', 'practical-solutions'),
    ));
}
add_action('init', 'practical_solutions_register_block_patterns');

// AJAX للبحث المحسن
function practical_solutions_ajax_search_enhanced() {
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(__('غير مصرح', 'practical-solutions'));
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = sanitize_text_field($_POST['search_type']) ?? 'posts';
    
    if (empty($search_term)) {
        wp_send_json_error(__('لا يوجد مصطلح بحث', 'practical-solutions'));
    }
    
    $results = array();
    
    switch ($search_type) {
        case 'suggestions':
            $results = ps_get_search_suggestions($search_term);
            break;
        case 'posts':
            $results = ps_get_search_results($search_term);
            break;
        case 'categories':
            $results = ps_get_category_suggestions($search_term);
            break;
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_ps_search_enhanced', 'practical_solutions_ajax_search_enhanced');
add_action('wp_ajax_nopriv_ps_search_enhanced', 'practical_solutions_ajax_search_enhanced');

// دالة البحث المحسنة
function ps_get_search_suggestions($search_term) {
    $posts = get_posts(array(
        's' => $search_term,
        'post_type' => 'post',
        'posts_per_page' => 5,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS'
            )
        )
    ));
    
    $suggestions = array();
    foreach ($posts as $post) {
        $suggestions[] = array(
            'id' => $post->ID,
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post), 15),
            'thumbnail' => get_the_post_thumbnail_url($post, 'ps-thumbnail'),
            'category' => get_the_category($post)[0]->name ?? '',
            'date' => get_the_date('j F Y', $post)
        );
    }
    
    return $suggestions;
}

// دالة نتائج البحث الكاملة
function ps_get_search_results($search_term) {
    $posts = get_posts(array(
        's' => $search_term,
        'post_type' => 'post',
        'posts_per_page' => 12,
        'post_status' => 'publish'
    ));
    
    $results = array();
    foreach ($posts as $post) {
        $results[] = array(
            'id' => $post->ID,
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post), 25),
            'thumbnail' => get_the_post_thumbnail_url($post, 'ps-medium'),
            'category' => get_the_category($post)[0]->name ?? '',
            'date' => get_the_date('j F Y', $post),
            'author' => get_the_author_meta('display_name', $post->post_author)
        );
    }
    
    return $results;
}

// دالة اقتراحات التصنيفات
function ps_get_category_suggestions($search_term) {
    $categories = get_categories(array(
        'search' => $search_term,
        'number' => 5,
        'hide_empty' => true
    ));
    
    $suggestions = array();
    foreach ($categories as $category) {
        $suggestions[] = array(
            'id' => $category->term_id,
            'name' => $category->name,
            'url' => get_category_link($category->term_id),
            'count' => $category->count,
            'description' => $category->description
        );
    }
    
    return $suggestions;
}

// إنشاء Breadcrumbs ديناميكي
function ps_get_breadcrumbs() {
    $breadcrumbs = array();
    
    // الرئيسية
    $breadcrumbs[] = array(
        'title' => __('الرئيسية', 'practical-solutions'),
        'url' => home_url('/'),
        'current' => false
    );
    
    if (is_single()) {
        // التصنيف
        $categories = get_the_category();
        if (!empty($categories)) {
            $category = $categories[0];
            $breadcrumbs[] = array(
                'title' => $category->name,
                'url' => get_category_link($category->term_id),
                'current' => false
            );
        }
        
        // المقال الحالي
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => '',
            'current' => true
        );
    } elseif (is_page()) {
        // الصفحة الحالية
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => '',
            'current' => true
        );
    } elseif (is_category()) {
        $category = get_queried_object();
        $breadcrumbs[] = array(
            'title' => $category->name,
            'url' => '',
            'current' => true
        );
    } elseif (is_search()) {
        $breadcrumbs[] = array(
            'title' => sprintf(__('نتائج البحث عن: %s', 'practical-solutions'), get_search_query()),
            'url' => '',
            'current' => true
        );
    }
    
    return $breadcrumbs;
}

// Shortcode للـ Breadcrumbs
function ps_breadcrumbs_shortcode($atts) {
    $breadcrumbs = ps_get_breadcrumbs();
    
    if (empty($breadcrumbs)) {
        return '';
    }
    
    $output = '<nav class="ps-breadcrumbs" aria-label="' . __('مسار التنقل', 'practical-solutions') . '">';
    $output .= '<ol class="breadcrumb-list">';
    
    foreach ($breadcrumbs as $breadcrumb) {
        $output .= '<li class="breadcrumb-item' . ($breadcrumb['current'] ? ' current' : '') . '">';
        
        if (!$breadcrumb['current'] && !empty($breadcrumb['url'])) {
            $output .= '<a href="' . esc_url($breadcrumb['url']) . '">' . esc_html($breadcrumb['title']) . '</a>';
        } else {
            $output .= '<span>' . esc_html($breadcrumb['title']) . '</span>';
        }
        
        $output .= '</li>';
        
        if (!$breadcrumb['current']) {
            $output .= '<li class="breadcrumb-separator" aria-hidden="true">/</li>';
        }
    }
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    return $output;
}
add_shortcode('ps_breadcrumbs', 'ps_breadcrumbs_shortcode');

// تحسينات الأداء المتقدمة
function practical_solutions_performance_optimizations() {
    // إزالة الـ emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // إزالة المولدات غير الضرورية
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    
    // تنظيف الـ head
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10);
    remove_action('wp_head', 'start_post_rel_link', 10);
    
    // إزالة version من CSS/JS
    add_filter('style_loader_src', 'ps_remove_version_strings', 9999);
    add_filter('script_loader_src', 'ps_remove_version_strings', 9999);
}
add_action('init', 'practical_solutions_performance_optimizations');

// إزالة version من الملفات
function ps_remove_version_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

// إضافة كلاسات مخصصة للـ body
function practical_solutions_body_classes($classes) {
    $classes[] = 'ps-theme';
    $classes[] = 'block-theme-enhanced';
    
    if (is_home() || is_front_page()) {
        $classes[] = 'ps-homepage';
    }
    
    if (is_single()) {
        $classes[] = 'ps-single-post';
        
        // إضافة كلاس للتصنيف
        $categories = get_the_category();
        if (!empty($categories)) {
            $classes[] = 'ps-category-' . $categories[0]->slug;
        }
    }
    
    if (is_search()) {
        $classes[] = 'ps-search-results';
    }
    
    if (is_rtl()) {
        $classes[] = 'ps-rtl';
    }
    
    // إضافة كلاس للوضع المظلم إذا كان محفوظاً
    if (isset($_COOKIE['ps_theme_mode']) && $_COOKIE['ps_theme_mode'] === 'dark') {
        $classes[] = 'ps-dark-mode';
    }
    
    return $classes;
}
add_filter('body_class', 'practical_solutions_body_classes');

// إضافة structured data محسن
function practical_solutions_structured_data() {
    if (is_single()) {
        global $post;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 25),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'wordCount' => str_word_count(strip_tags(get_the_content())),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
                'url' => get_author_posts_url(get_the_author_meta('ID'))
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'url' => home_url('/'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_site_icon_url(512) ?: PS_THEME_URI . '/assets/images/logo.png'
                )
            ),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => get_permalink()
            )
        );
        
        if (has_post_thumbnail()) {
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = get_the_post_thumbnail_url($post, 'large');
            $thumbnail_meta = wp_get_attachment_metadata($thumbnail_id);
            
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $thumbnail_url,
                'width' => $thumbnail_meta['width'] ?? 1200,
                'height' => $thumbnail_meta['height'] ?? 800
            );
        }
        
        // إضافة تصنيف كـ keywords
        $categories = get_the_category();
        if (!empty($categories)) {
            $schema['keywords'] = array_map(function($cat) {
                return $cat->name;
            }, $categories);
            
            $schema['articleSection'] = $categories[0]->name;
        }
        
        // إضافة tags كـ keywords إضافية
        $tags = get_the_tags();
        if (!empty($tags)) {
            $tag_names = array_map(function($tag) {
                return $tag->name;
            }, $tags);
            
            if (isset($schema['keywords'])) {
                $schema['keywords'] = array_merge($schema['keywords'], $tag_names);
            } else {
                $schema['keywords'] = $tag_names;
            }
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
    
    // Schema للموقع الرئيسي
    if (is_home() || is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url' => home_url('/'),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => array(
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url('/?s={search_term_string}')
                ),
                'query-input' => 'required name=search_term_string'
            )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_structured_data');

// تخصيص طول المقتطف
function practical_solutions_excerpt_length($length) {
    if (is_admin()) {
        return $length;
    }
    
    return 25;
}
add_filter('excerpt_length', 'practical_solutions_excerpt_length');

// تخصيص نص "اقرأ المزيد"
function practical_solutions_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    
    return '... <a href="' . get_permalink() . '" class="ps-read-more">' . __('اقرأ المزيد', 'practical-solutions') . '</a>';
}
add_filter('excerpt_more', 'practical_solutions_excerpt_more');

// إضافة مقاسات صور مخصصة للمحرر
function practical_solutions_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'ps-thumbnail' => __('صورة مصغرة (400×300)', 'practical-solutions'),
        'ps-medium' => __('صورة متوسطة (800×600)', 'practical-solutions'),
        'ps-large' => __('صورة كبيرة (1200×800)', 'practical-solutions'),
        'ps-hero' => __('صورة البطل (1600×900)', 'practical-solutions'),
    ));
}
add_filter('image_size_names_choose', 'practical_solutions_custom_image_sizes');

// حماية من البحث الفارغ
function practical_solutions_redirect_empty_search() {
    if (is_search() && empty(get_search_query())) {
        wp_redirect(home_url('/'));
        exit;
    }
}
add_action('template_redirect', 'practical_solutions_redirect_empty_search');

// دعم Lazy Loading للصور
function practical_solutions_add_lazy_loading($attr, $attachment, $size) {
    if (!is_admin() && !wp_is_mobile()) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'practical_solutions_add_lazy_loading', 10, 3);

// تحسين ملفات CSS/JS
function practical_solutions_optimize_assets() {
    if (!is_admin()) {
        // دمج ملفات CSS إذا أمكن
        wp_enqueue_style('ps-combined-styles', PS_THEME_URI . '/assets/css/combined.min.css', array(), PS_THEME_VERSION);
        
        // إزالة block library CSS غير المستخدمة
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('classic-theme-styles');
        
        // تأجيل تحميل JavaScript غير الضروري
        wp_script_add_data('ps-search-enhanced', 'defer', true);
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_optimize_assets', 100);

// إضافة خيارات متقدمة للمحرر
function practical_solutions_editor_settings($settings) {
    // ألوان مخصصة للمحرر
    $settings['__experimentalFeatures']['color']['palette']['theme'] = array(
        array(
            'color' => '#ffffff',
            'name' => __('الأساس الأبيض', 'practical-solutions'),
            'slug' => 'base'
        ),
        array(
            'color' => '#1a1a1a', 
            'name' => __('المقابل الداكن', 'practical-solutions'),
            'slug' => 'contrast'
        ),
        array(
            'color' => '#007cba',
            'name' => __('الأزرق الأساسي', 'practical-solutions'),
            'slug' => 'primary'
        )
    );
    
    return $settings;
}
add_filter('block_editor_settings_all', 'practical_solutions_editor_settings');
```

/**
 * Block Patterns Registration and Theme Settings
 * تسجيل الأنماط المخصصة ولوحة الإعدادات
 */

// تسجيل فئات الأنماط المخصصة
function practical_solutions_register_pattern_categories() {
    register_block_pattern_category('practical-solutions', array(
        'label' => __('الحلول العملية', 'practical-solutions'),
        'description' => __('أنماط مخصصة لقالب الحلول العملية', 'practical-solutions')
    ));
    
    register_block_pattern_category('ps-heroes', array(
        'label' => __('أقسام البطل', 'practical-solutions'),
        'description' => __('أقسام البطل والعناوين الرئيسية', 'practical-solutions')
    ));
    
    register_block_pattern_category('ps-features', array(
        'label' => __('عرض الميزات', 'practical-solutions'),
        'description' => __('أقسام عرض الميزات والخدمات', 'practical-solutions')
    ));
    
    register_block_pattern_category('ps-content', array(
        'label' => __('أقسام المحتوى', 'practical-solutions'),
        'description' => __('أقسام المحتوى والمقالات', 'practical-solutions')
    ));
    
    register_block_pattern_category('ps-cta', array(
        'label' => __('دعوات العمل', 'practical-solutions'),
        'description' => __('أقسام دعوات العمل والتحويل', 'practical-solutions')
    ));
}
add_action('init', 'practical_solutions_register_pattern_categories');

// تحميل ملفات الأنماط
function practical_solutions_load_patterns() {
    $patterns_dir = get_template_directory() . '/patterns/';
    
    $pattern_files = array(
        'hero-with-search.php',
        'hero-solutions.php',
        'features-grid.php',
        'features-cards.php',
        'solutions-showcase.php',
        'testimonials.php',
        'faq-section.php',
        'cta-newsletter.php',
        'cta-contact.php',
        'recent-posts.php',
        'categories-grid.php',
        'stats-counter.php',
        'team-members.php',
        'services-pricing.php',
        'before-after.php'
    );
    
    foreach ($pattern_files as $file) {
        $file_path = $patterns_dir . $file;
        if (file_exists($file_path)) {
            include $file_path;
        }
    }
}
add_action('init', 'practical_solutions_load_patterns');

// تحميل ملفات الإعدادات
require_once get_template_directory() . '/inc/theme-settings.php';
require_once get_template_directory() . '/inc/customizer-settings.php';
```


## 🎨 **4. assets/css/main.css - الأنماط الرئيسية**

```css
/**
 * Practical Solutions Pro - Main Styles
 * الأنماط الرئيسية للحلول العملية الاحترافية
 */

/* متغيرات CSS العامة */
:root {
  /* الألوان الأساسية */
  --ps-color-base: #ffffff;
  --ps-color-contrast: #1a1a1a;
  --ps-color-primary: #007cba;
  --ps-color-secondary: #f0f4f8;
  --ps-color-tertiary: #2c3e50;
  --ps-color-accent: #e74c3c;
  --ps-color-success: #27ae60;
  --ps-color-warning: #f39c12;
  
  /* المسافات */
  --ps-spacing-xs: 0.5rem;
  --ps-spacing-sm: 1rem;
  --ps-spacing-md: 2rem;
  --ps-spacing-lg: 3rem;
  --ps-spacing-xl: 4rem;
  
  /* الخطوط */
  --ps-font-family: 'Noto Sans Arabic', -apple-system, BlinkMacSystemFont, sans-serif;
  --ps-font-size-xs: 12px;
  --ps-font-size-sm: 14px;
  --ps-font-size-base: 18px;
  --ps-font-size-lg: 24px;
  --ps-font-size-xl: 32px;
  --ps-font-size-xxl: 48px;
  
  /* الظلال */
  --ps-shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
  --ps-shadow-md: 0 4px 15px rgba(0,0,0,0.1);
  --ps-shadow-lg: 0 8px 30px rgba(0,0,0,0.15);
  
  /* الانتقالات */
  --ps-transition-fast: 0.2s ease;
  --ps-transition-normal: 0.3s ease;
  --ps-transition-slow: 0.5s ease;
  
  /* نصف الأقطار */
  --ps-radius-sm: 4px;
  --ps-radius-md: 8px;
  --ps-radius-lg: 12px;
  --ps-radius-full: 50px;
}

/* الأنماط الأساسية */
* {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
  -webkit-text-size-adjust: 100%;
}

body {
  font-family: var(--ps-font-family);
  font-size: var(--ps-font-size-base);
  line-height: 1.6;
  color: var(--ps-color-contrast);
  background-color: var(--ps-color-base);
  direction: rtl;
  text-align: right;
  margin: 0;
  padding: 0;
  transition: background-color var(--ps-transition-normal), color var(--ps-transition-normal);
}

/* Block Styles المخصصة */

/* بطاقة */
.wp-block-group.is-style-ps-card-style {
  background: var(--ps-color-base);
  border-radius: var(--ps-radius-lg);
  box-shadow: var(--ps-shadow-md);
  padding: var(--ps-spacing-md);
  transition: transform var(--ps-transition-fast), box-shadow var(--ps-transition-fast);
}

.wp-block-group.is-style-ps-card-style:hover {
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-lg);
}

/* قسم البطل */
.wp-block-group.is-style-ps-hero-section {
  background: linear-gradient(135deg, var(--ps-color-primary) 0%, var(--ps-color-tertiary) 100%);
  color: var(--ps-color-base);
  padding: var(--ps-spacing-xl) var(--ps-spacing-md);
  text-align: center;
  position: relative;
  overflow: hidden;
}

.wp-block-group.is-style-ps-hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
  opacity: 0.3;
}

.wp-block-group.is-style-ps-hero-section > * {
  position: relative;
  z-index: 1;
}

/* صندوق الميزة */
.wp-block-group.is-style-ps-feature-box {
  background: var(--ps-color-secondary);
  border-radius: var(--ps-radius-md);
  padding: var(--ps-spacing-md);
  text-align: center;
  transition: all var(--ps-transition-normal);
  border: 2px solid transparent;
}

.wp-block-group.is-style-ps-feature-box:hover {
  border-color: var(--ps-color-primary);
  background: var(--ps-color-base);
  transform: scale(1.02);
}

/* أنماط الأزرار */
.wp-block-button.is-style-ps-primary-button .wp-block-button__link {
  background: linear-gradient(135deg, var(--ps-color-primary) 0%, var(--ps-color-tertiary) 100%);
  color: var(--ps-color-base);
  border-radius: var(--ps-radius-full);
  padding: 12px 32px;
  font-weight: 600;
  text-decoration: none;
  transition: all var(--ps-transition-fast);
  box-shadow: var(--ps-shadow-sm);
  border: none;
}

.wp-block-button.is-style-ps-primary-button .wp-block-button__link:hover {
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

.wp-block-button.is-style-ps-outline-button .wp-block-button__link {
  background: transparent;
  color: var(--ps-color-primary);
  border: 2px solid var(--ps-color-primary);
  border-radius: var(--ps-radius-full);
  padding: 10px 30px;
  font-weight: 600;
  text-decoration: none;
  transition: all var(--ps-transition-fast);
}

.wp-block-button.is-style-ps-outline-button .wp-block-button__link:hover {
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  transform: translateY(-1px);
}

/* أنماط العناوين */
.wp-block-heading.is-style-ps-section-title {
  font-size: var(--ps-font-size-xl);
  font-weight: 700;
  text-align: center;
  position: relative;
  padding-bottom: var(--ps-spacing-sm);
  margin-bottom: var(--ps-spacing-md);
}

.wp-block-heading.is-style-ps-section-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(to right, var(--ps-color-primary), var(--ps-color-accent));
  border-radius: var(--ps-radius-sm);
}

/* أنماط الصور */
.wp-block-image.is-style-ps-rounded-image img {
  border-radius: var(--ps-radius-lg);
  box-shadow: var(--ps-shadow-md);
  transition: transform var(--ps-transition-normal);
}

.wp-block-image.is-style-ps-rounded-image:hover img {
  transform: scale(1.02);
}

/* شريط البحث المحسن */
.ps-search-container {
  max-width: 600px;
  margin: var(--ps-spacing-md) auto;
  position: relative;
}

.ps-search-form {
  display: flex;
  align-items: center;
  background: var(--ps-color-base);
  border-radius: var(--ps-radius-full);
  box-shadow: var(--ps-shadow-md);
  overflow: hidden;
  border: 2px solid var(--ps-color-secondary);
  transition: all var(--ps-transition-fast);
}

.ps-search-form:focus-within {
  border-color: var(--ps-color-primary);
  box-shadow: var(--ps-shadow-lg);
}

.ps-search-input {
  flex: 1;
  border: none;
  padding: 15px 20px;
  font-size: var(--ps-font-size-base);
  background: transparent;
  color: var(--ps-color-contrast);
  font-family: var(--ps-font-family);
}

.ps-search-input:focus {
  outline: none;
}

.ps-search-input::placeholder {
  color: var(--ps-color-tertiary);
  opacity: 0.7;
}

.ps-search-btn,
.ps-voice-btn {
  border: none;
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  padding: 15px 20px;
  cursor: pointer;
  font-size: var(--ps-font-size-base);
  transition: background-color var(--ps-transition-fast);
  display: flex;
  align-items: center;
  justify-content: center;
}

.ps-search-btn:hover,
.ps-voice-btn:hover {
  background: var(--ps-color-tertiary);
}

.ps-voice-btn.listening {
  background: var(--ps-color-accent);
  animation: ps-pulse 1s infinite;
}

/* اقتراحات البحث */
.ps-search-suggestions {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: var(--ps-color-base);
  border: 1px solid var(--ps-color-secondary);
  border-radius: var(--ps-radius-md);
  box-shadow: var(--ps-shadow-lg);
  z-index: 1000;
  max-height: 400px;
  overflow-y: auto;
  opacity: 0;
  transform: translateY(-10px);
  transition: all var(--ps-transition-normal);
  pointer-events: none;
}

.ps-search-suggestions.show {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.ps-suggestion-item {
  padding: 12px 15px;
  border-bottom: 1px solid var(--ps-color-secondary);
  cursor: pointer;
  transition: background-color var(--ps-transition-fast);
  display: flex;
  align-items: center;
  gap: 12px;
}

.ps-suggestion-item:hover {
  background: var(--ps-color-secondary);
}

.ps-suggestion-item:last-child {
  border-bottom: none;
}

.ps-suggestion-thumbnail {
  width: 50px;
  height: 50px;
  border-radius: var(--ps-radius-sm);
  object-fit: cover;
}

.ps-suggestion-content {
  flex: 1;
}

.ps-suggestion-title {
  font-weight: 600;
  color: var(--ps-color-contrast);
  margin-bottom: 4px;
  font-size: var(--ps-font-size-sm);
}

.ps-suggestion-excerpt {
  font-size: var(--ps-font-size-xs);
  color: var(--ps-color-tertiary);
  line-height: 1.4;
}

.ps-suggestion-meta {
  display: flex;
  gap: 8px;
  font-size: var(--ps-font-size-xs);
  color: var(--ps-color-primary);
  margin-top: 4px;
}

/* زر تبديل الوضع */
.ps-theme-toggle {
  position: fixed;
  top: 20px;
  left: 20px;
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  border: none;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 20px;
  z-index: 1000;
  transition: all var(--ps-transition-fast);
  box-shadow: var(--ps-shadow-md);
  display: flex;
  align-items: center;
  justify-content: center;
}

.ps-theme-toggle:hover {
  transform: scale(1.1);
  box-shadow: var(--ps-shadow-lg);
}

/* Breadcrumbs */
.ps-breadcrumbs {
  margin-bottom: var(--ps-spacing-md);
  font-size: var(--ps-font-size-sm);
}

.breadcrumb-list {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 8px;
}

.breadcrumb-item {
  color: var(--ps-color-tertiary);
}

.breadcrumb-item a {
  color: var(--ps-color-primary);
  text-decoration: none;
  transition: color var(--ps-transition-fast);
}

.breadcrumb-item a:hover {
  color: var(--ps-color-tertiary);
  text-decoration: underline;
}

.breadcrumb-item.current {
  color: var(--ps-color-contrast);
  font-weight: 500;
}

.breadcrumb-separator {
  color: var(--ps-color-tertiary);
  opacity: 0.5;
}

/* أزرار المشاركة الاجتماعية */
.ps-social-sharing {
  text-align: center;
  padding: var(--ps-spacing-md) 0;
}

.ps-social-sharing h4 {
  margin-bottom: var(--ps-spacing-sm);
  color: var(--ps-color-contrast);
}

.ps-sharing-buttons {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
}

.ps-share-btn {
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  text-decoration: none;
  padding: 8px 16px;
  border-radius: var(--ps-radius-md);
  font-size: var(--ps-font-size-sm);
  font-weight: 500;
  transition: all var(--ps-transition-fast);
  display: flex;
  align-items: center;
  gap: 6px;
}

.ps-share-btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

.ps-share-btn.facebook { background: #1877f2; }
.ps-share-btn.twitter { background: #1da1f2; }
.ps-share-btn.whatsapp { background: #25d366; }
.ps-share-btn.copy { background: var(--ps-color-tertiary); }

/* الإشعارات */
.ps-notification {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 12px 20px;
  border-radius: var(--ps-radius-md);
  color: var(--ps-color-base);
  font-weight: 500;
  box-shadow: var(--ps-shadow-lg);
  z-index: 10000;
  transform: translateX(100%);
  transition: transform var(--ps-transition-normal);
  max-width: 300px;
}

.ps-notification.show {
  transform: translateX(0);
}

.ps-notification.success { background: var(--ps-color-success); }
.ps-notification.error { background: var(--ps-color-accent); }
.ps-notification.info { background: var(--ps-color-primary); }

/* تحسينات الأداء */
.ps-lazy-image {
  opacity: 0;
  transition: opacity var(--ps-transition-slow);
}

.ps-lazy-image.loaded {
  opacity: 1;
}

/* الرسوم المتحركة */
@keyframes ps-pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

@keyframes ps-fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes ps-slide-in-right {
  from { opacity: 0; transform: translateX(30px); }
  to { opacity: 1; transform: translateX(0); }
}

/* كلاسات مساعدة */
.ps-fade-in {
  animation: ps-fade-in 0.6s ease forwards;
}

.ps-slide-in-right {
  animation: ps-slide-in-right 0.6s ease forwards;
}

.ps-text-center { text-align: center; }
.ps-text-left { text-align: left; }
.ps-text-right { text-align: right; }

.ps-mb-sm { margin-bottom: var(--ps-spacing-sm); }
.ps-mb-md { margin-bottom: var(--ps-spacing-md); }
.ps-mb-lg { margin-bottom: var(--ps-spacing-lg); }

.ps-p-sm { padding: var(--ps-spacing-sm); }
.ps-p-md { padding: var(--ps-spacing-md); }
.ps-p-lg { padding: var(--ps-spacing-lg); }

/* تحسينات إمكانية الوصول */
.ps-sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

.ps-skip-link {
  position: absolute;
  top: -40px;
  left: 6px;
  background: var(--ps-color-contrast);
  color: var(--ps-color-base);
  padding: 8px 16px;
  text-decoration: none;
  border-radius: var(--ps-radius-sm);
  z-index: 10000;
  transition: top var(--ps-transition-fast);
}

.ps-skip-link:focus {
  top: 6px;
}

/* Focus styles */
button:focus,
input:focus,
select:focus,
textarea:focus,
a:focus {
  outline: 2px solid var(--ps-color-primary);
  outline-offset: 2px;
}

/* Print styles */
@media print {
  .ps-theme-toggle,
  .ps-search-suggestions,
  .ps-social-sharing,
  .ps-notification {
    display: none !important;
  }
  
  body {
    background: white !important;
    color: black !important;
  }
  
  .ps-search-form {
    border: 1px solid #ddd !important;
    box-shadow: none !important;
  }
}
```

## 🌙 **5. assets/css/dark-mode.css - الوضع المظلم**

```css
/**
 * Dark Mode Styles
 * أنماط الوضع المظلم
 */

/* الوضع المظلم - يطبق على html */
html[data-theme="dark"] {
  /* تحديث المتغيرات للوضع المظلم */
  --ps-color-base: #1a1a1a;
  --ps-color-contrast: #ffffff;
  --ps-color-primary: #4a9eff;
  --ps-color-secondary: #2d3748;
  --ps-color-tertiary: #a0aec0;
  --ps-color-accent: #ff6b6b;
  --ps-color-success: #48bb78;
  --ps-color-warning: #ed8936;
}

html[data-theme="dark"] body {
  background-color: var(--ps-color-base);
  color: var(--ps-color-contrast);
}

/* تحديث أنماط المكونات للوضع المظلم */
html[data-theme="dark"] .wp-block-group.is-style-ps-card-style {
  background: var(--ps-color-secondary);
  border: 1px solid #4a5568;
}

html[data-theme="dark"] .wp-block-group.is-style-ps-feature-box {
  background: var(--ps-color-secondary);
}

html[data-theme="dark"] .wp-block-group.is-style-ps-feature-box:hover {
  background: #4a5568;
  border-color: var(--ps-color-primary);
}

/* تحديث البحث للوضع المظلم */
html[data-theme="dark"] .ps-search-form {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-search-input {
  color: var(--ps-color-contrast);
}

html[data-theme="dark"] .ps-search-input::placeholder {
  color: var(--ps-color-tertiary);
}

/* تحديث الاقتراحات للوضع المظلم */
html[data-theme="dark"] .ps-search-suggestions {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-suggestion-item {
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-suggestion-item:hover {
  background: #4a5568;
}

html[data-theme="dark"] .ps-suggestion-title {
  color: var(--ps-color-contrast);
}

html[data-theme="dark"] .ps-suggestion-excerpt {
  color: var(--ps-color-tertiary);
}

/* تحديث زر التبديل */
html[data-theme="dark"] .ps-theme-toggle {
  background: var(--ps-color-secondary);
  box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

/* تحديث الـ breadcrumbs */
html[data-theme="dark"] .breadcrumb-item {
  color: var(--ps-color-tertiary);
}

html[data-theme="dark"] .breadcrumb-item.current {
  color: var(--ps-color-contrast);
}

/* تحديط أزرار المشاركة */
html[data-theme="dark"] .ps-share-btn {
  opacity: 0.9;
}

html[data-theme="dark"] .ps-share-btn:hover {
  opacity: 1;
}

/* تحديث focus للوضع المظلم */
html[data-theme="dark"] button:focus,
html[data-theme="dark"] input:focus,
html[data-theme="dark"] select:focus,
html[data-theme="dark"] textarea:focus,
html[data-theme="dark"] a:focus {
  outline-color: var(--ps-color-primary);
}

/* تحديث scroll bar للوضع المظلم */
html[data-theme="dark"] ::-webkit-scrollbar {
  width: 8px;
}

html[data-theme="dark"] ::-webkit-scrollbar-track {
  background: var(--ps-color-secondary);
}

html[data-theme="dark"] ::-webkit-scrollbar-thumb {
  background: #4a5568;
  border-radius: 4px;
}

html[data-theme="dark"] ::-webkit-scrollbar-thumb:hover {
  background: #718096;
}

/* انتقال سلس للوضع المظلم */
html {
  transition: background-color 0.3s ease, color 0.3s ease;
}

html * {
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

/* تحديث الصور للوضع المظلم */
html[data-theme="dark"] img {
  opacity: 0.9;
}

html[data-theme="dark"] img:hover {
  opacity: 1;
}

/* تحديث النصوص للوضع المظلم */
html[data-theme="dark"] .wp-block-post-excerpt {
  color: var(--ps-color-tertiary);
}

html[data-theme="dark"] .wp-block-post-date {
  color: var(--ps-color-tertiary);
}

/* تحديث الحدود للوضع المظلم */
html[data-theme="dark"] .wp-block-separator {
  background-color: #4a5568;
}

html[data-theme="dark"] hr {
  border-color: #4a5568;
}

/* تحديث الجداول للوضع المظلم */
html[data-theme="dark"] table {
  background: var(--ps-color-secondary);
}

html[data-theme="dark"] th {
  background: #4a5568;
  color: var(--ps-color-contrast);
}

html[data-theme="dark"] td {
  border-color: #4a5568;
}

/* تحديث النماذج للوضع المظلم */
html[data-theme="dark"] input,
html[data-theme="dark"] textarea,
html[data-theme="dark"] select {
  background: var(--ps-color-secondary);
  color: var(--ps-color-contrast);
  border-color: #4a5568;
}

html[data-theme="dark"] input:focus,
html[data-theme="dark"] textarea:focus,
html[data-theme="dark"] select:focus {
  border-color: var(--ps-color-primary);
}

/* تحديث الـ blockquote للوضع المظلم */
html[data-theme="dark"] blockquote {
  background: var(--ps-color-secondary);
  border-left-color: var(--ps-color-primary);
}

/* تحديث الكود للوضع المظلم */
html[data-theme="dark"] code {
  background: var(--ps-color-secondary);
  color: var(--ps-color-primary);
}

html[data-theme="dark"] pre {
  background: var(--ps-color-secondary);
  color: var(--ps-color-contrast);
}
```

## 💻 **6. assets/js/main.js - JavaScript محسن**

```javascript
/**
 * Practical Solutions Pro - Enhanced JavaScript
 * جافاسكريبت محسن للحلول العملية الاحترافية
 */

// متغيرات عامة
let psSettings = window.psSettings || {};
let searchTimeout;
let voiceRecognition;
let isVoiceListening = false;

// تهيئة عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initThemeToggle();
    initVoiceSearch();
    initSearchEnhanced();
    initSmoothScroll();
    initLazyLoading();
    initAnimations();
    initAccessibility();
    initPerformanceOptimizations();
});

/**
 * تبديل الوضع المظلم/الفاتح المحسن
 */
function initThemeToggle() {
    const themeToggle = document.querySelector('.ps-theme-toggle');
    if (!themeToggle) return;
    
    // تحميل الوضع المحفوظ
    const savedTheme = localStorage.getItem('ps-theme-mode') || 
                      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    applyTheme(savedTheme);
    updateThemeToggleIcon(savedTheme);
    
    // مستمع الحدث للتبديل
    themeToggle.addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        applyTheme(newTheme);
        updateThemeToggleIcon(newTheme);
        localStorage.setItem('ps-theme-mode', newTheme);
        
        // إضافة تأثير بصري
        this.style.transform = 'scale(0.8)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // إشعار التغيير
        showNotification(
            newTheme === 'dark' ? 'تم تفعيل الوضع المظلم' : 'تم تفعيل الوضع الفاتح',
            'info'
        );
    });
    
    // مراقبة تفضيلات النظام
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
        if (!localStorage.getItem('ps-theme-mode')) {
            const systemTheme = e.matches ? 'dark' : 'light';
            applyTheme(systemTheme);
            updateThemeToggleIcon(systemTheme);
        }
    });
}

/**
 * تطبيق الوضع على html
 */
function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    
    // إضافة كلاس للـ body أيضاً للتوافق
    document.body.classList.toggle('ps-dark-mode', theme === 'dark');
    
    // تحديث meta theme-color
    let metaThemeColor = document.querySelector('meta[name="theme-color"]');
    if (!metaThemeColor) {
        metaThemeColor = document.createElement('meta');
        metaThemeColor.name = 'theme-color';
        document.head.appendChild(metaThemeColor);
    }
    
    metaThemeColor.content = theme === 'dark' ? '#1a1a1a' : '#ffffff';
}

/**
 * تحديث أيقونة زر التبديل
 */
function updateThemeToggleIcon(theme) {
    const themeToggle = document.querySelector('.ps-theme-toggle');
    if (themeToggle) {
        themeToggle.innerHTML = theme === 'dark' ? '☀️' : '🌙';
        themeToggle.setAttribute('aria-label', 
            theme === 'dark' ? 'تبديل للوضع الفاتح' : 'تبديل للوضع المظلم'
        );
        themeToggle.setAttribute('title',
            theme === 'dark' ? 'تبديل للوضع الفاتح' : 'تبديل للوضع المظلم'
        );
    }
}

/**
 * البحث الصوتي المحسن
 */
function initVoiceSearch() {
    const voiceButtons = document.querySelectorAll('.ps-voice-btn, #voice-search');
    
    if (voiceButtons.length === 0) return;
    
    // فحص دعم البحث الصوتي
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        voiceButtons.forEach(btn => {
            btn.style.display = 'none';
        });
        return;
    }
    
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    voiceRecognition = new SpeechRecognition();
    
    // إعدادات التعرف الصوتي المحسنة
    voiceRecognition.continuous = false;
    voiceRecognition.interimResults = false;
    voiceRecognition.lang = psSettings.locale?.startsWith('ar') ? 'ar-SA' : 'en-US';
    voiceRecognition.maxAlternatives = 3;
    
    voiceButtons.forEach(voiceBtn => {
        voiceBtn.addEventListener('click', handleVoiceSearch);
    });
    
    // أحداث التعرف الصوتي
    voiceRecognition.onstart = function() {
        isVoiceListening = true;
        updateVoiceButtonState(true);
        updateSearchInputPlaceholder(psSettings.voiceSearchText || 'أتحدث...');
    };
    
    voiceRecognition.onresult = function(event) {
        const results = Array.from(event.results).map(result => result[0].transcript);
        const bestResult = results[0];
        
        if (bestResult) {
            const searchInput = document.querySelector('.ps-search-input, #search-input');
            if (searchInput) {
                searchInput.value = bestResult;
                
                // تشغيل البحث تلقائياً
                setTimeout(() => {
                    triggerSearch(bestResult);
                }, 500);
                
                showNotification(`تم البحث عن: ${bestResult}`, 'success');
            }
        }
    };
    
    voiceRecognition.onend = function() {
        isVoiceListening = false;
        updateVoiceButtonState(false);
        updateSearchInputPlaceholder(psSettings.searchPlaceholder || 'ابحث عن الحلول...');
    };
    
    voiceRecognition.onerror = function(event) {
        isVoiceListening = false;
        updateVoiceButtonState(false);
        updateSearchInputPlaceholder(psSettings.searchPlaceholder || 'ابحث عن الحلول...');
        
        let errorMessage = 'حدث خطأ في البحث الصوتي';
        
        switch (event.error) {
            case 'no-speech':
                errorMessage = 'لم يتم سماع أي صوت. حاول مرة أخرى.';
                break;
            case 'audio-capture':
                errorMessage = 'لا يمكن الوصول للميكروفون';
                break;
            case 'not-allowed':
                errorMessage = 'صلاحية الميكروفون مرفوضة';
                break;
            case 'network':
                errorMessage = 'خطأ في الشبكة';
                break;
        }
        
        showNotification(errorMessage, 'error');
    };
}

/**
 * معالج البحث الصوتي
 */
function handleVoiceSearch(event) {
    event.preventDefault();
    
    if (isVoiceListening) {
        voiceRecognition.stop();
        return;
    }
    
    try {
        voiceRecognition.start();
    } catch (error) {
        console.error('خطأ في بدء البحث الصوتي:', error);
        showNotification('فشل في بدء البحث الصوتي', 'error');
    }
}

/**
 * تحديث حالة زر البحث الصوتي
 */
function updateVoiceButtonState(listening) {
    const voiceButtons = document.querySelectorAll('.ps-voice-btn, #voice-search');
    
    voiceButtons.forEach(btn => {
        if (listening) {
            btn.classList.add('listening');
            btn.innerHTML = '🔴';
            btn.setAttribute('title', 'إيقاف التسجيل');
        } else {
            btn.classList.remove('listening');
            btn.innerHTML = '🎤';
            btn.setAttribute('title', 'البحث الصوتي');
        }
    });
}

/**
 * تحديث placeholder لحقل البحث
 */
function updateSearchInputPlaceholder(text) {
    const searchInputs = document.querySelectorAll('.ps-search-input, #search-input');
    searchInputs.forEach(input => {
        input.placeholder = text;
    });
}

/**
 * تشغيل البحث
 */
function triggerSearch(query) {
    const searchForm = document.querySelector('.ps-search-form, .search-form');
    if (searchForm) {
        searchForm.submit();
    } else {
        // إذا لم يوجد form، انتقل لصفحة البحث
        window.location.href = `${psSettings.homeUrl}?s=${encodeURIComponent(query)}`;
    }
}

/**
 * البحث المحسن مع الاقتراحات
 */
function initSearchEnhanced() {
    const searchInputs = document.querySelectorAll('.ps-search-input, #search-input');
    
    searchInputs.forEach(searchInput => {
        let suggestionsContainer = searchInput.parentNode.querySelector('.ps-search-suggestions');
        
        // إنشاء حاوية الاقتراحات
        if (!suggestionsContainer) {
            suggestionsContainer = document.createElement('div');
            suggestionsContainer.className = 'ps-search-suggestions';
            searchInput.parentNode.appendChild(suggestionsContainer);
        }
        
        // مستمع الإدخال مع debouncing
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                hideSuggestions(suggestionsContainer);
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetchSearchSuggestions(query, suggestionsContainer, searchInput);
            }, 300);
        });
        
        // التنقل بلوحة المفاتيح
        searchInput.addEventListener('keydown', function(e) {
            handleKeyboardNavigation(e, suggestionsContainer);
        });
        
        // إخفاء الاقتراحات عند النقر خارجها
        document.addEventListener('click', function(e) {
            if (!searchInput.parentNode.contains(e.target)) {
                hideSuggestions(suggestionsContainer);
            }
        });
        
        // إظهار الاقتراحات عند focus إذا كان هناك نص
        searchInput.addEventListener('focus', function() {
            if (this.value.length >= 2) {
                fetchSearchSuggestions(this.value.trim(), suggestionsContainer, searchInput);
            }
        });
    });
}

/**
 * التنقل بلوحة المفاتيح في الاقتراحات
 */
function handleKeyboardNavigation(event, container) {
    const suggestions = container.querySelectorAll('.ps-suggestion-item');
    if (suggestions.length === 0) return;
    
    let activeIndex = Array.from(suggestions).findIndex(item => 
        item.classList.contains('active')
    );
    
    switch (event.key) {
        case 'ArrowDown':
            event.preventDefault();
            activeIndex = (activeIndex + 1) % suggestions.length;
            highlightSuggestion(suggestions, activeIndex);
            break;
            
        case 'ArrowUp':
            event.preventDefault();
            activeIndex = activeIndex <= 0 ? suggestions.length - 1 : activeIndex - 1;
            highlightSuggestion(suggestions, activeIndex);
            break;
            
        case 'Enter':
            event.preventDefault();
            if (activeIndex >= 0) {
                suggestions[activeIndex].click();
            } else {
                const form = event.target.closest('form');
                if (form) form.submit();
            }
            break;
            
        case 'Escape':
            hideSuggestions(container);
            event.target.blur();
            break;
            
        case 'Tab':
            hideSuggestions(container);
            break;
    }
}

/**
 * تمييز اقتراح معين
 */
function highlightSuggestion(suggestions, activeIndex) {
    suggestions.forEach((item, index) => {
        item.classList.toggle('active', index === activeIndex);
        
        if (index === activeIndex) {
            item.scrollIntoView({ block: 'nearest' });
        }
    });
}

/**
 * جلب اقتراحات البحث المحسنة
 */
function fetchSearchSuggestions(query, container, searchInput) {
    if (!psSettings.ajaxUrl) return;
    
    const formData = new FormData();
    formData.append('action', 'ps_search_enhanced');
    formData.append('search_term', query);
    formData.append('search_type', 'suggestions');
    formData.append('nonce', psSettings.nonce);
    
    // إضافة مؤشر التحميل
    showLoadingInSuggestions(container);
    
    fetch(psSettings.ajaxUrl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data.length > 0) {
            showSuggestions(data.data, container, searchInput);
        } else {
            showNoResults(container);
        }
    })
    .catch(error => {
        console.error('خطأ في جلب اقتراحات البحث:', error);
        hideSuggestions(container);
    });
}

/**
 * عرض مؤشر التحميل
 */
function showLoadingInSuggestions(container) {
    container.innerHTML = `
        <div class="ps-suggestion-item ps-loading">
            <div class="ps-suggestion-content">
                <div class="ps-suggestion-title">${psSettings.loadingText || 'جاري التحميل...'}</div>
            </div>
        </div>
    `;
    container.classList.add('show');
}

/**
 * عرض الاقتراحات المحسنة
 */
function showSuggestions(suggestions, container, searchInput) {
    const suggestionsList = suggestions.map(item => `
        <div class="ps-suggestion-item" data-url="${item.url}" data-title="${item.title}">
            ${item.thumbnail ? `<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail" loading="lazy">` : ''}
            <div class="ps-suggestion-content">
                <div class="ps-suggestion-title">${highlightSearchTerm(item.title, searchInput.value)}</div>
                <div class="ps-suggestion-excerpt">${item.excerpt}</div>
                ${item.category || item.date ? `
                    <div class="ps-suggestion-meta">
                        ${item.category ? `<span class="ps-category">${item.category}</span>` : ''}
                        ${item.date ? `<span class="ps-date">${item.date}</span>` : ''}
                    </div>
                ` : ''}
            </div>
        </div>
    `).join('');
    
    container.innerHTML = suggestionsList;
    container.classList.add('show');
    
    // إضافة مستمعي الأحداث
    container.querySelectorAll('.ps-suggestion-item').forEach(item => {
        item.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            const title = this.getAttribute('data-title');
            
            // حفظ البحث في التاريخ
            if (title) {
                saveSearchHistory(title);
            }
            
            window.location.href = url;
        });
        
        // إضافة تأثيرات hover
        item.addEventListener('mouseenter', function() {
            this.classList.add('active');
            
            // إزالة active من الآخرين
            container.querySelectorAll('.ps-suggestion-item').forEach(otherItem => {
                if (otherItem !== this) {
                    otherItem.classList.remove('active');
                }
            });
        });
    });
}

/**
 * تمييز مصطلح البحث في النتائج
 */
function highlightSearchTerm(text, term) {
    if (!term) return text;
    
    const regex = new RegExp(`(${term})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
}

/**
 * عرض رسالة عدم وجود نتائج
 */
function showNoResults(container) {
    container.innerHTML = `
        <div class="ps-suggestion-item ps-no-results">
            <div class="ps-suggestion-content">
                <div class="ps-suggestion-title">${psSettings.noResultsText || 'لا توجد نتائج'}</div>
                <div class="ps-suggestion-excerpt">حاول استخدام كلمات مختلفة</div>
            </div>
        </div>
    `;
    container.classList.add('show');
}

/**
 * إخفاء الاقتراحات
 */
function hideSuggestions(container) {
    container.classList.remove('show');
    setTimeout(() => {
        container.innerHTML = '';
    }, 300);
}

/**
 * حفظ تاريخ البحث
 */
function saveSearchHistory(searchTerm) {
    try {
        let history = JSON.parse(localStorage.getItem('ps-search-history') || '[]');
        
        // إزالة التكرار
        history = history.filter(item => item !== searchTerm);
        
        // إضافة في المقدمة
        history.unshift(searchTerm);
        
        // الاحتفاظ بـ 10 عناصر فقط
        history = history.slice(0, 10);
        
        localStorage.setItem('ps-search-history', JSON.stringify(history));
    } catch (error) {
        console.error('خطأ في حفظ تاريخ البحث:', error);
    }
}

/**
 * التمرير الناعم المحسن
 */
function initSmoothScroll() {
    // مستمعي الروابط الداخلية
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                
                const headerOffset = 80; // تعديل للـ header الثابت
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // إضافة focus للوصولية
                targetElement.setAttribute('tabindex', '-1');
                targetElement.focus();
            }
        });
    });
    
    // زر العودة للأعلى
    const backToTopBtn = document.createElement('button');
    backToTopBtn.className = 'ps-back-to-top';
    backToTopBtn.innerHTML = '⬆️';
    backToTopBtn.setAttribute('aria-label', 'العودة للأعلى');
    backToTopBtn.setAttribute('title', 'العودة للأعلى');
    document.body.appendChild(backToTopBtn);
    
    // إظهار/إخفاء زر العودة للأعلى
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    // النقر للعودة للأعلى
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * التحميل الكسول المحسن
 */
function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // تحميل الصورة
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('ps-lazy-image');
                        img.classList.add('loaded');
                        
                        // إزالة المراقبة
                        observer.unobserve(img);
                    }
                }
            });
        }, {
            root: null,
            rootMargin: '50px',
            threshold: 0.1
        });
        
        // مراقبة جميع الصور الكسولة
        document.querySelectorAll('img[data-src], .ps-lazy-image').forEach(img => {
            imageObserver.observe(img);
        });
        
        // مراقبة الصور الجديدة التي تُضاف لاحقاً
        const contentObserver = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        const lazyImages = node.querySelectorAll('img[data-src], .ps-lazy-image');
                        lazyImages.forEach(img => imageObserver.observe(img));
                    }
                });
            });
        });
        
        contentObserver.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
}

/**
 * الرسوم المتحركة عند الظهور
 */
function initAnimations() {
    if ('IntersectionObserver' in window) {
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('ps-fade-in');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        // إضافة الرسوم المتحركة للعناصر المناسبة
        const animatedElements = document.querySelectorAll(
            '.wp-block-group, .wp-block-columns, .wp-block-heading, .wp-block-image'
        );
        
        animatedElements.forEach(el => {
            animationObserver.observe(el);
        });
    }
}

/**
 * تحسينات إمكانية الوصول
 */
function initAccessibility() {
    // إضافة skip link
    const skipLink = document.createElement('a');
    skipLink.href = '#main';
    skipLink.className = 'ps-skip-link';
    skipLink.textContent = 'تخطي إلى المحتوى الرئيسي';
    document.body.insertBefore(skipLink, document.body.firstChild);
    
    // تحسين focus للعناصر التفاعلية
    const focusableElements = document.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    
    focusableElements.forEach(el => {
        el.addEventListener('focus', function() {
            this.classList.add('ps-focused');
        });
        
        el.addEventListener('blur', function() {
            this.classList.remove('ps-focused');
        });
    });
    
    // إضافة ARIA labels للعناصر المفقودة
    const searchInputs = document.querySelectorAll('input[type="search"]');
    searchInputs.forEach(input => {
        if (!input.getAttribute('aria-label')) {
            input.setAttribute('aria-label', 'حقل البحث');
        }
    });
    
    // تحسين أزرار المشاركة
    const shareButtons = document.querySelectorAll('.ps-share-btn');
    shareButtons.forEach(btn => {
        if (!btn.getAttribute('aria-label')) {
            const platform = btn.className.match(/\b(facebook|twitter|whatsapp|copy)\b/)?.[1];
            if (platform) {
                const labels = {
                    facebook: 'مشاركة على فيسبوك',
                    twitter: 'مشاركة على تويتر', 
                    whatsapp: 'مشاركة على واتساب',
                    copy: 'نسخ الرابط'
                };
                btn.setAttribute('aria-label', labels[platform] || 'مشاركة');
            }
        }
    });
}

/**
 * تحسينات الأداء
 */
function initPerformanceOptimizations() {
    // تأجيل تحميل الصور غير المرئية
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        if (!img.loading) {
            img.loading = 'lazy';
        }
    });
    
    // تحسين الخطوط
    if ('fonts' in document) {
        const fontLoadPromises = [
            document.fonts.load('400 1em "Noto Sans Arabic"'),
            document.fonts.load('600 1em "Noto Sans Arabic"'),
            document.fonts.load('700 1em "Noto Sans Arabic"')
        ];
        
        Promise.all(fontLoadPromises).then(() => {
            document.body.classList.add('fonts-loaded');
        });
    }
    
    // تحسين scroll performance
    let ticking = false;
    
    function updateOnScroll() {
        // تحديث متغيرات CSS بناءً على scroll position
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        document.documentElement.style.setProperty('--scroll', scrolled);
        document.documentElement.style.setProperty('--scroll-rate', rate);
        
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    });
}

/**
 * عرض إشعار محسن
 */
function showNotification(message, type = 'info', duration = 3000) {
    // إنشاء الإشعار
    const notification = document.createElement('div');
    notification.className = `ps-notification ps-notification-${type}`;
    notification.setAttribute('role', 'alert');
    notification.setAttribute('aria-live', 'polite');
    
    // إضافة المحتوى
    notification.innerHTML = `
        <div class="ps-notification-content">
            <span class="ps-notification-message">${message}</span>
            <button class="ps-notification-close" aria-label="إغلاق الإشعار">×</button>
        </div>
    `;
    
    // إضافة للصفحة
    document.body.appendChild(notification);
    
    // إظهار مع تأثير
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // إضافة مستمع للإغلاق
    const closeBtn = notification.querySelector('.ps-notification-close');
    closeBtn.addEventListener('click', () => {
        hideNotification(notification);
    });
    
    // إغلاق تلقائي
    if (duration > 0) {
        setTimeout(() => {
            hideNotification(notification);
        }, duration);
    }
    
    return notification;
}

/**
 * إخفاء الإشعار
 */
function hideNotification(notification) {
    notification.classList.remove('show');
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 300);
}

/**
 * وظائف المشاركة الاجتماعية المحسنة
 */

// وظائف عامة - يجب أن تكون في النطاق العام ليتمكن onclick من الوصول إليها
window.shareOnFacebook = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    
    const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`;
    
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        }).catch(console.error);
    } else {
        window.open(shareUrl, 'facebook-share', 'width=600,height=400,scrollbars=yes,resizable=yes');
    }
    
    showNotification('تم فتح نافذة مشاركة فيسبوك', 'success');
};

window.shareOnTwitter = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    
    const shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
    
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        }).catch(console.error);
    } else {
        window.open(shareUrl, 'twitter-share', 'width=600,height=400,scrollbars=yes,resizable=yes');
    }
    
    showNotification('تم فتح نافذة مشاركة تويتر', 'success');
};

window.shareOnWhatsApp = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    
    const shareUrl = `https://api.whatsapp.com/send?text=${title} ${url}`;
    
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        }).catch(console.error);
    } else {
        window.open(shareUrl, 'whatsapp-share');
    }
    
    showNotification('تم فتح واتساب للمشاركة', 'success');
};

window.copyLink = function() {
    const url = window.location.href;
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            showNotification('تم نسخ الرابط بنجاح!', 'success');
        }).catch(() => {
            fallbackCopyText(url);
        });
    } else {
        fallbackCopyText(url);
    }
};

/**
 * نسخ النص - طريقة بديلة
 */
function fallbackCopyText(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const result = document.execCommand('copy');
        if (result) {
            showNotification('تم نسخ الرابط بنجاح!', 'success');
        } else {
            showNotification('فشل في نسخ الرابط', 'error');
        }
    } catch (err) {
        showNotification('فشل في نسخ الرابط', 'error');
    }
    
    document.body.removeChild(textArea);
}

/**
 * مشاركة عامة للمتصفحات الحديثة
 */
window.shareGeneric = function() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            text: document.querySelector('meta[name="description"]')?.content || '',
            url: window.location.href
        }).then(() => {
            showNotification('تم المشاركة بنجاح', 'success');
        }).catch((error) => {
            if (error.name !== 'AbortError') {
                console.error('خطأ في المشاركة:', error);
                showNotification('فشل في المشاركة', 'error');
            }
        });
    } else {
        // عرض قائمة خيارات المشاركة
        showShareModal();
    }
};

/**
 * عرض نافذة خيارات المشاركة
 */
function showShareModal() {
    const modal = document.createElement('div');
    modal.className = 'ps-share-modal';
    modal.innerHTML = `
        <div class="ps-share-modal-content">
            <div class="ps-share-modal-header">
                <h3>مشاركة المقال</h3>
                <button class="ps-share-modal-close" aria-label="إغلاق">×</button>
            </div>
            <div class="ps-share-modal-body">
                <div class="ps-sharing-buttons">
                    <button class="ps-share-btn facebook" onclick="shareOnFacebook()">
                        📘 فيسبوك
                    </button>
                    <button class="ps-share-btn twitter" onclick="shareOnTwitter()">
                        🐦 تويتر
                    </button>
                    <button class="ps-share-btn whatsapp" onclick="shareOnWhatsApp()">
                        💬 واتساب
                    </button>
                    <button class="ps-share-btn copy" onclick="copyLink()">
                        📋 نسخ الرابط
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // إظهار المودال
    setTimeout(() => {
        modal.classList.add('show');
    }, 100);
    
    // إغلاق المودال
    const closeModal = () => {
        modal.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(modal);
        }, 300);
    };
    
    modal.querySelector('.ps-share-modal-close').addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    
    // إغلاق بمفتاح Escape
    const handleEscape = (e) => {
        if (e.key === 'Escape') {
            closeModal();
            document.removeEventListener('keydown', handleEscape);
        }
    };
    document.addEventListener('keydown', handleEscape);
}

/**
 * تهيئة service worker للتخزين المؤقت
 */
function initServiceWorker() {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then((registration) => {
                    console.log('SW registered: ', registration);
                })
                .catch((registrationError) => {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }
}

/**
 * تهيئة وضع عدم الاتصال
 */
function initOfflineMode() {
    window.addEventListener('online', () => {
        showNotification('تم استعادة الاتصال بالإنترنت', 'success');
        document.body.classList.remove('ps-offline');
    });
    
    window.addEventListener('offline', () => {
        showNotification('تم فقدان الاتصال بالإنترنت', 'warning', 5000);
        document.body.classList.add('ps-offline');
    });
}

/**
 * أدوات تطوير إضافية
 */
function initDeveloperTools() {
    // إضافة معلومات للمطورين في console
    if (typeof console !== 'undefined') {
        console.log('%c🚀 Practical Solutions Pro Theme', 'color: #007cba; font-size: 16px; font-weight: bold;');
        console.log('%cVersion: ' + (psSettings.version || '2.1.0'), 'color: #666;');
        console.log('%cDeveloped with ❤️', 'color: #e74c3c;');
        
        // إضافة مساعدات للتطوير في وضع التطوير
        if (psSettings.debug) {
            window.psTheme = {
                settings: psSettings,
                version: '2.1.0',
                showNotification,
                hideNotification,
                triggerSearch,
                applyTheme
            };
            
            console.log('%cDeveloper tools available in window.psTheme', 'color: #27ae60;');
        }
    }
}

// تهيئة إضافية عند تحميل الصفحة
window.addEventListener('load', function() {
    initServiceWorker();
    initOfflineMode();
    initDeveloperTools();
    
    // إضافة كلاس لإشارة اكتمال التحميل
    document.body.classList.add('ps-loaded');
    
    // تحسين الأداء بعد التحميل
    setTimeout(() => {
        // تحميل الموارد غير الحرجة
        const nonCriticalResources = document.querySelectorAll('[data-lazy-load]');
        nonCriticalResources.forEach(resource => {
            if (resource.dataset.src) {
                resource.src = resource.dataset.src;
            }
        });
    }, 1000);
});

// تصدير الوظائف للاستخدام الخارجي
window.PracticalSolutions = {
    showNotification,
    hideNotification,
    applyTheme,
    triggerSearch,
    shareOnFacebook,
    shareOnTwitter,
    shareOnWhatsApp,
    copyLink,
    shareGeneric,
    version: '2.1.0'
};

## 📱 **7. assets/css/responsive.css - التصميم المتجاوب**

```css
/**
 * Responsive Design - التصميم المتجاوب
 * Mobile-First Approach
 */

/* الأجهزة الصغيرة جداً (أقل من 320px) */
@media (max-width: 319px) {
    .ps-search-container {
        margin: var(--ps-spacing-sm) 0;
    }
    
    .ps-search-form {
        flex-direction: column;
        border-radius: var(--ps-radius-md);
    }
    
    .ps-search-input {
        border-radius: var(--ps-radius-md) var(--ps-radius-md) 0 0;
    }
    
    .ps-search-btn,
    .ps-voice-btn {
        border-radius: 0 0 var(--ps-radius-md) var(--ps-radius-md);
        flex: 1;
    }
    
    .ps-sharing-buttons {
        flex-direction: column;
        gap: 8px;
    }
    
    .ps-share-btn {
        width: 100%;
        justify-content: center;
    }
}

/* الأجهزة الصغيرة (320px - 575px) */
@media (min-width: 320px) and (max-width: 575px) {
    :root {
        --ps-spacing-sm: 0.75rem;
        --ps-spacing-md: 1.5rem;
        --ps-spacing-lg: 2rem;
        --ps-spacing-xl: 2.5rem;
    }
    
    .wp-block-group.is-style-ps-hero-section {
        padding: var(--ps-spacing-lg) var(--ps-spacing-sm);
    }
    
    .wp-block-group.is-style-ps-card-style {
        padding: var(--ps-spacing-sm);
    }
    
    .ps-search-container {
        margin: var(--ps-spacing-sm) var(--ps-spacing-xs);
    }
    
    .ps-search-suggestions {
        max-height: 250px;
    }
    
    .ps-suggestion-item {
        padding: 10px 12px;
        font-size: var(--ps-font-size-sm);
    }
    
    .ps-suggestion-thumbnail {
        width: 40px;
        height: 40px;
    }
    
    .ps-theme-toggle {
        width: 45px;
        height: 45px;
        top: 15px;
        left: 15px;
        font-size: 18px;
    }
    
    .ps-notification {
        top: 15px;
        right: 15px;
        left: 15px;
        max-width: none;
    }
    
    .breadcrumb-list {
        flex-wrap: wrap;
        gap: 4px;
    }
    
    .ps-sharing-buttons {
        justify-content: center;
        gap: 8px;
    }
    
    .ps-share-btn {
        padding: 8px 12px;
        font-size: var(--ps-font-size-xs);
    }
}

/* الأجهزة الصغيرة-المتوسطة (576px - 767px) */
@media (min-width: 576px) and (max-width: 767px) {
    .ps-search-form {
        max-width: 500px;
    }
    
    .ps-search-suggestions {
        max-height: 300px;
    }
    
    .wp-block-columns {
        gap: var(--ps-spacing-sm);
    }
    
    .wp-block-group.is-style-ps-feature-box {
        padding: var(--ps-spacing-md);
    }
    
    .ps-sharing-buttons {
        gap: 10px;
    }
    
    .ps-share-btn {
        padding: 10px 16px;
        font-size: var(--ps-font-size-sm);
    }
    
    .ps-back-to-top {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
    }
}

/* الأجهزة المتوسطة (768px - 991px) */
@media (min-width: 768px) and (max-width: 991px) {
    .ps-search-container {
        max-width: 550px;
    }
    
    .ps-search-suggestions {
        max-height: 350px;
    }
    
    .ps-suggestion-item {
        padding: 12px 15px;
    }
    
    .ps-suggestion-thumbnail {
        width: 60px;
        height: 60px;
    }
    
    .wp-block-columns {
        gap: var(--ps-spacing-md);
    }
    
    .ps-theme-toggle {
        top: 25px;
        left: 25px;
    }
    
    .ps-notification {
        top: 25px;
        right: 25px;
        max-width: 350px;
    }
    
    .ps-sharing-buttons {
        gap: 12px;
    }
    
    .ps-back-to-top {
        bottom: 30px;
        right: 30px;
    }
}

/* الأجهزة الكبيرة (992px - 1199px) */
@media (min-width: 992px) and (max-width: 1199px) {
    .ps-search-container {
        max-width: 600px;
    }
    
    .ps-search-suggestions {
        max-height: 400px;
    }
    
    .wp-block-columns {
        gap: var(--ps-spacing-lg);
    }
    
    .wp-block-group.is-style-ps-hero-section {
        padding: var(--ps-spacing-xl) var(--ps-spacing-lg);
    }
    
    .ps-suggestion-item {
        padding: 15px 20px;
    }
    
    .ps-suggestion-thumbnail {
        width: 70px;
        height: 70px;
    }
    
    .ps-sharing-buttons {
        gap: 15px;
    }
    
    .ps-share-btn {
        padding: 12px 20px;
    }
}

/* الأجهزة الكبيرة جداً (1200px وأكثر) */
@media (min-width: 1200px) {
    .ps-search-container {
        max-width: 700px;
    }
    
    .ps-search-suggestions {
        max-height: 450px;
    }
    
    .wp-block-columns {
        gap: var(--ps-spacing-xl);
    }
    
    .ps-suggestion-item {
        padding: 18px 25px;
    }
    
    .ps-suggestion-thumbnail {
        width: 80px;
        height: 80px;
    }
    
    .ps-sharing-buttons {
        gap: 18px;
    }
    
    .ps-share-btn {
        padding: 14px 24px;
        font-size: var(--ps-font-size-base);
    }
    
    .ps-back-to-top {
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        font-size: 24px;
    }
}

/* الشاشات الكبيرة جداً (1400px وأكثر) */
@media (min-width: 1400px) {
    .ps-search-container {
        max-width: 800px;
    }
    
    .wp-block-group.is-style-ps-hero-section {
        padding: 5rem 2rem;
    }
    
    .ps-suggestion-item {
        padding: 20px 30px;
    }
    
    .ps-suggestion-thumbnail {
        width: 90px;
        height: 90px;
    }
}

/* التوجه الأفقي للأجهزة المحمولة */
@media (max-width: 767px) and (orientation: landscape) {
    .wp-block-group.is-style-ps-hero-section {
        padding: var(--ps-spacing-md) var(--ps-spacing-lg);
    }
    
    .ps-search-suggestions {
        max-height: 200px;
    }
    
    .ps-theme-toggle {
        top: 10px;
        left: 10px;
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .ps-notification {
        top: 10px;
        right: 60px;
    }
}

/* الشاشات عالية الدقة */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 2dppx) {
    .ps-theme-toggle,
    .ps-back-to-top {
        box-shadow: var(--ps-shadow-lg);
    }
    
    .ps-search-form {
        box-shadow: var(--ps-shadow-lg);
    }
}

/* تحسينات للطباعة */
@media print {
    .ps-theme-toggle,
    .ps-back-to-top,
    .ps-search-suggestions,
    .ps-notification,
    .ps-social-sharing,
    .ps-voice-btn {
        display: none !important;
    }
    
    .ps-search-form {
        background: white !important;
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    
    .ps-search-input {
        color: black !important;
    }
    
    body {
        font-size: 12pt !important;
        line-height: 1.4 !important;
    }
    
    .wp-block-heading {
        page-break-after: avoid;
    }
    
    .wp-block-image {
        page-break-inside: avoid;
    }
}

/* تحسينات الحركة المنخفضة */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
    
    .ps-fade-in,
    .ps-slide-in-right {
        animation: none !important;
    }
}

/* تحسينات التباين العالي */
@media (prefers-contrast: high) {
    :root {
        --ps-color-primary: #0066cc;
        --ps-color-accent: #cc0000;
        --ps-color-success: #006600;
        --ps-color-warning: #cc6600;
    }
    
    .ps-search-form {
        border: 2px solid var(--ps-color-contrast);
    }
    
    .ps-suggestion-item:hover {
        border: 1px solid var(--ps-color-primary);
    }
    
    .ps-share-btn {
        border: 1px solid var(--ps-color-contrast);
    }
}

/* زر العودة للأعلى */
.ps-back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--ps-color-primary);
    color: var(--ps-color-base);
    border: none;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    box-shadow: var(--ps-shadow-md);
    z-index: 999;
    opacity: 0;
    transform: translateY(100px);
    transition: all var(--ps-transition-normal);
    display: flex;
    align-items: center;
    justify-content: center;
}

.ps-back-to-top.show {
    opacity: 1;
    transform: translateY(0);
}

.ps-back-to-top:hover {
    background: var(--ps-color-tertiary);
    transform: translateY(-2px);
    box-shadow: var(--ps-shadow-lg);
}

/* مودال المشاركة */
.ps-share-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all var(--ps-transition-normal);
}

.ps-share-modal.show {
    opacity: 1;
    visibility: visible;
}

.ps-share-modal-content {
    background: var(--ps-color-base);
    border-radius: var(--ps-radius-lg);
    padding: var(--ps-spacing-lg);
    max-width: 400px;
    width: 90%;
    transform: scale(0.8);
    transition: transform var(--ps-transition-normal);
}

.ps-share-modal.show .ps-share-modal-content {
    transform: scale(1);
}

.ps-share-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--ps-spacing-md);
    padding-bottom: var(--ps-spacing-sm);
    border-bottom: 1px solid var(--ps-color-secondary);
}

.ps-share-modal-header h3 {
    margin: 0;
    color: var(--ps-color-contrast);
}

.ps-share-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all var(--ps-transition-fast);
}

.ps-share-modal-close:hover {
    background: var(--ps-color-secondary);
    color: var(--ps-color-contrast);
}

/* إضافات للوضع المظلم في المودال */
html[data-theme="dark"] .ps-share-modal-content {
    background: var(--ps-color-secondary);
    border: 1px solid #4a5568;
}

html[data-theme="dark"] .ps-share-modal-header {
    border-color: #4a5568;
}

/* تحسينات إضافية للمودال المتجاوب */
@media (max-width: 575px) {
    .ps-share-modal-content {
        width: 95%;
        padding: var(--ps-spacing-md);
    }
    
    .ps-share-modal-header h3 {
        font-size: var(--ps-font-size-lg);
    }
    
    .ps-sharing-buttons {
        gap: 8px;
    }
    
    .ps-share-btn {
        padding: 12px 16px;
        font-size: var(--ps-font-size-sm);
    }
}
```
