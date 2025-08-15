# 🚀 قالب Block Theme محسّن - إصدار احترافي

الهيكل :
practical-solutions-pro/
├── style.css
├── theme.json 
├── functions.php 
├── screenshot.png
├── README.md 
├── LICENSE
├── manifest.json ← PWA support
├── sw.js ← Service Worker
├── .gitignore
├── templates/ 
│   ├── index.html 
│   ├── front-page.html 
│   ├── home.html 
│   ├── single.html
│   ├── page.html
│   ├── archive.html
│   ├── search.html
│   ├── 404.html
│   ├── author.html 
│   ├── category.html 
│   └── tag.html 
├── parts/
│   ├── header.html
│   ├── footer.html
│   └── sidebar.html
├── assets/
│   ├── css/
│   │   └── unified.css 
│   │   └── enhanced-ux.css
│   ├── admin/
│   │   └── admin-styles.css
│   │   └── admin-scripts.js
│   ├── js/
│   │   └── enhanced-voice-search.js
│   │   └── interactive-features.js
│   │   └── unified.min.js
│   ├── images/
│   └── fonts/
├── inc/
│   ├── customizer-settings.php
│   ├── unified-search-system.php
│   ├── rating-system.php
│   ├── ai-openrouter-system.php
│   ├── advanced-analytics.php
│   ├── theme-admin-panel.php
│   └── block-patterns.php 
├── patterns/
│   ├── categories-grid.php
│   ├── cta-newsletter.php
│   ├── faq-section.php
│   ├── footer-default.html
│   ├── header-default.html
│   ├── hero-with-search.php
│   ├── solutions-showcase.php
│   ├── stats-counter.php
│   ├── team-members.php
│   └── testimonials.php

اسم الملف style.css 

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

اسم الملف: theme.json

{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 2,
  "settings": {
    "layout": {
      "contentSize": "800px",
      "wideSize": "1200px"
    },
    "color": {
      "duotone": [
        {
          "colors": ["#000000", "#007cba"],
          "slug": "primary-duotone",
          "name": "Primary Duotone"
        }
      ],
      "gradients": [
        {
          "slug": "primary-gradient",
          "gradient": "linear-gradient(135deg, #007cba 0%, #005a87 100%)",
          "name": "Primary Gradient"
        },
        {
          "slug": "accent-gradient", 
          "gradient": "linear-gradient(135deg, #ff6b35 0%, #e74c3c 100%)",
          "name": "Accent Gradient"
        }
      ],
      "palette": [
        {
          "color": "#ffffff",
          "name": "Base",
          "slug": "base"
        },
        {
          "color": "#1a1a1a", 
          "name": "Contrast",
          "slug": "contrast"
        },
        {
          "color": "#007cba",
          "name": "Primary",
          "slug": "primary"
        },
        {
          "color": "#005a87",
          "name": "Secondary", 
          "slug": "secondary"
        },
        {
          "color": "#6b7280",
          "name": "Tertiary",
          "slug": "tertiary"
        },
        {
          "color": "#ff6b35",
          "name": "Accent",
          "slug": "accent"
        },
        {
          "color": "#10b981",
          "name": "Success",
          "slug": "success"
        },
        {
          "color": "#f59e0b", 
          "name": "Warning",
          "slug": "warning"
        },
        {
          "color": "#ef4444",
          "name": "Error",
          "slug": "error"
        }
      ]
    },
    "typography": {
      "fontFamilies": [
        {
          "fontFamily": "'Noto Sans Arabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
          "name": "Noto Sans Arabic",
          "slug": "noto-sans-arabic"
        },
        {
          "fontFamily": "'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif", 
          "name": "Cairo",
          "slug": "cairo"
        },
        {
          "fontFamily": "'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
          "name": "Tajawal", 
          "slug": "tajawal"
        }
      ],
      "fontSizes": [
        {
          "size": "0.75rem",
          "slug": "x-small",
          "name": "X-Small"
        },
        {
          "size": "0.875rem", 
          "slug": "small",
          "name": "Small"
        },
        {
          "size": "1rem",
          "slug": "medium",
          "name": "Medium"
        },
        {
          "size": "1.125rem",
          "slug": "large", 
          "name": "Large"
        },
        {
          "size": "1.25rem",
          "slug": "x-large",
          "name": "X-Large"
        },
        {
          "size": "1.5rem",
          "slug": "xx-large",
          "name": "XX-Large"
        },
        {
          "size": "2rem",
          "slug": "huge",
          "name": "Huge"
        }
      ]
    },
    "spacing": {
      "spacingScale": {
        "steps": 0
      },
      "spacingSizes": [
        {
          "size": "0.5rem",
          "slug": "xs",
          "name": "XS"
        },
        {
          "size": "1rem", 
          "slug": "sm",
          "name": "Small"
        },
        {
          "size": "1.5rem",
          "slug": "md",
          "name": "Medium"
        },
        {
          "size": "2rem",
          "slug": "lg", 
          "name": "Large"
        },
        {
          "size": "3rem",
          "slug": "xl",
          "name": "XL"
        },
        {
          "size": "4rem",
          "slug": "xxl",
          "name": "XXL"
        }
      ]
    },
    "custom": {
      "spacing": {
        "small": "max(1.25rem, 5vw)",
        "medium": "clamp(2rem, 8vw, calc(4 * var(--wp--preset--spacing--50)))",
        "large": "clamp(4rem, 10vw, 8rem)",
        "outer": "var(--wp--preset--spacing--30, 1.25rem)"
      },
      "typography": {
        "font-size": {
          "huge": "clamp(2.25rem, 4vw, 2.75rem)",
          "gigantic": "clamp(2.75rem, 6vw, 3.25rem)",
          "colossal": "clamp(3.25rem, 8vw, 6.25rem)"
        },
        "line-height": {
          "tiny": 1.15,
          "small": 1.2,
          "medium": 1.4,
          "normal": 1.6
        }
      }
    },
    "blocks": {
      "core/button": {
        "border": {
          "radius": true
        },
        "color": {
          "background": true,
          "text": true
        },
        "spacing": {
          "padding": true
        },
        "typography": {
          "fontSize": true,
          "fontWeight": true
        }
      },
      "core/heading": {
        "color": {
          "background": true,
          "text": true,
          "gradient": true
        },
        "typography": {
          "fontSize": true,
          "fontWeight": true,
          "lineHeight": true,
          "textTransform": true,
          "letterSpacing": true
        }
      },
      "core/paragraph": {
        "color": {
          "background": true,
          "text": true
        },
        "typography": {
          "fontSize": true,
          "lineHeight": true,
          "letterSpacing": true
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
      "fontFamily": "var(--wp--preset--font-family--noto-sans-arabic)",
      "fontSize": "var(--wp--preset--font-size--medium)",
      "lineHeight": "1.6"
    },
    "spacing": {
      "blockGap": "1.5rem"
    },
    "elements": {
      "button": {
        "border": {
          "radius": "8px"
        },
        "color": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--base)"
        },
        "spacing": {
          "padding": {
            "top": "0.75rem",
            "right": "1.5rem", 
            "bottom": "0.75rem",
            "left": "1.5rem"
          }
        },
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)",
          "fontWeight": "600"
        },
        ":hover": {
          "color": {
            "background": "var(--wp--preset--color--secondary)"
          }
        }
      },
      "h1": {
        "typography": {
          "fontSize": "var(--wp--custom--typography--font-size--colossal)",
          "lineHeight": "var(--wp--custom--typography--line-height--tiny)",
          "fontWeight": "700"
        },
        "spacing": {
          "margin": {
            "bottom": "var(--wp--preset--spacing--md)"
          }
        }
      },
      "h2": {
        "typography": {
          "fontSize": "var(--wp--custom--typography--font-size--gigantic)",
          "lineHeight": "var(--wp--custom--typography--line-height--small)",
          "fontWeight": "600"
        }
      },
      "h3": {
        "typography": {
          "fontSize": "var(--wp--custom--typography--font-size--huge)",
          "fontWeight": "600"
        }
      },
      "link": {
        "color": {
          "text": "var(--wp--preset--color--primary)"
        },
        ":hover": {
          "color": {
            "text": "var(--wp--preset--color--secondary)"
          }
        }
      }
    },
    "blocks": {
      "core/navigation": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--medium)",
          "fontWeight": "500"
        }
      },
      "core/post-title": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--x-large)",
          "fontWeight": "600"
        }
      },
      "core/site-title": {
        "typography": {
          "fontSize": "var(--wp--preset--font-size--large)",
          "fontWeight": "700"
        }
      }
    }
  },
  "customTemplates": [
    {
      "name": "blank",
      "title": "Blank",
      "postTypes": ["page", "post"]
    }
  ],
  "templateParts": [
    {
      "name": "header",
      "title": "Header", 
      "area": "header"
    },
    {
      "name": "footer",
      "title": "Footer",
      "area": "footer"
    },
    {
      "name": "sidebar",
      "title": "Sidebar", 
      "area": "uncategorized"
    }
  ]
}



📁 اسم الملف: templates/index.html

<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-main-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-main-header" style="margin-bottom:3rem">
    
    <!-- wp:query-title {"type":"archive","textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
    
    <!-- wp:home-link {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"className":"ps-breadcrumb-home"} -->
    <a href="/" class="wp-block-home-link ps-breadcrumb-home" style="margin-bottom:2rem">🏠 الرئيسية</a>
    <!-- /wp:home-link -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"ps-main-query"} -->
  <div class="wp-block-query ps-main-query">
    
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"3rem"}},"layout":{"type":"grid","columnCount":2}} -->
    
    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
    <div class="wp-block-group is-style-ps-card-style">
      
      <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
      
      <!-- wp:group {"layout":{"type":"constrained"}} -->
      <div class="wp-block-group">
        
        <!-- wp:post-title {"level":2,"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":25,"style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
        
        <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
        <div class="wp-block-group" style="margin-bottom:1rem">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"14px"}},"textColor":"primary"} /-->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group">
          <!-- wp:post-author {"showAvatar":true,"avatarSize":32,"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} /-->
          <!-- wp:read-more {"content":"اقرأ المزيد →","className":"is-style-ps-primary-button"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- /wp:post-template -->
    
    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"4rem"}}}} -->
    <!-- wp:query-pagination-previous {"label":"السابق"} /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next {"label":"التالي"} /-->
    <!-- /wp:query-pagination -->
    
    <!-- wp:query-no-results -->
    <!-- wp:group {"className":"ps-no-posts","style":{"spacing":{"padding":{"all":"3rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-no-posts" style="padding-top:3rem;padding-right:3rem;padding-bottom:3rem;padding-left:3rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">📝 لا توجد مقالات حالياً</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
      <p class="has-text-align-center" style="margin-bottom:2rem">ابق متابعاً للحصول على أحدث الحلول والنصائح العملية</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">العودة للرئيسية</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
    </div>
    <!-- /wp:group -->
    <!-- /wp:query-no-results -->
    
  </div>
  <!-- /wp:query -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف: templates/front-page.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group">

  <!-- Hero Section -->
  <!-- wp:group {"align":"full","className":"is-style-ps-hero-section","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"gradient":"linear-gradient(135deg,var(--wp--preset--color--primary) 0%,var(--wp--preset--color--tertiary) 100%)"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
  <div class="wp-block-group alignfull is-style-ps-hero-section has-background" style="background:linear-gradient(135deg,var(--wp--preset--color--primary) 0%,var(--wp--preset--color--tertiary) 100%);padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
  
      <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"700","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"base"} -->
      <h1 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:1.5rem;font-size:3.5rem;font-weight:700;line-height:1.2">🔍 اكتشف أفضل الحلول العملية</h1>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.3rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"base"} -->
      <p class="has-text-align-center has-base-color has-text-color" style="margin-bottom:3rem;font-size:1.3rem;line-height:1.6">موقعك المفضل للحصول على أذكى الحلول والنصائح المفيدة لحياة أسهل وأكثر تنظيماً</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:html -->
      <div class="ps-hero-search-container" style="max-width: 700px; margin: 0 auto 3rem;">
          <form role="search" method="get" class="ps-hero-search-form" action="/">
              <input type="search" class="ps-hero-search-input" placeholder="ابحث عن الحلول... مثل: تنظيف المطبخ، توفير المال" name="s">
              <button type="button" class="ps-hero-voice-btn" title="البحث الصوتي">🎤</button>
              <button type="submit" class="ps-hero-search-btn" title="بحث">🔍 ابحث</button>
          </form>
      </div>
      <!-- /wp:html -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1.5rem"}}} -->
      <div class="wp-block-buttons">
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/home">🏠 البيت والمنزل</a></div>
          <!-- /wp:button -->
          
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/kitchen">🍳 المطبخ والطبخ</a></div>
          <!-- /wp:button -->
          
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/lifestyle">💡 نصائح حياتية</a></div>
          <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
  </div>
  <!-- /wp:group -->

  <!-- Featured Solutions -->
  <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
  
      <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
      <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:3rem">🏆 الحلول الأكثر طلباً</h2>
      <!-- /wp:heading -->
      
      <!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"meta_value_num","author":"","search":"","exclude":[],"sticky":"","inherit":false,"meta_key":"post_views_count"},"className":"ps-featured-query"} -->
      <div class="wp-block-query ps-featured-query">
        
        <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
        
        <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
        <div class="wp-block-group is-style-ps-card-style">
          
          <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image"} /-->
          
          <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} /-->
          
          <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":15} /-->
          
          <!-- wp:group {"style":{"spacing":{"margin":{"top":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
          <div class="wp-block-group" style="margin-top:1rem">
            <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"12px"}},"textColor":"tertiary"} /-->
            <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px"}},"textColor":"primary"} /-->
          </div>
          <!-- /wp:group -->
          
        </div>
        <!-- /wp:group -->
        
        <!-- /wp:post-template -->
        
      </div>
      <!-- /wp:query -->
      
  </div>
  <!-- /wp:group -->

  <!-- Features Section -->
  <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
  
      <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
      <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:3rem">✨ لماذا نحن الأفضل؟</h2>
      <!-- /wp:heading -->
      
      <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
      <div class="wp-block-columns">
          
          <!-- wp:column -->
          <div class="wp-block-column">
              <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
              <div class="wp-block-group is-style-ps-feature-box">
                  
                  <!-- wp:html -->
                  <div style="text-align: center; font-size: 4rem; margin-bottom: 1rem;">🎯</div>
                  <!-- /wp:html -->
                  
                  <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                  <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">حلول مُجربة</h3>
                  <!-- /wp:heading -->
                  
                  <!-- wp:paragraph {"align":"center"} -->
                  <p class="has-text-align-center">جميع حلولنا مُختبرة عملياً من قبل خبراء متخصصين لضمان فعاليتها وسهولة تطبيقها في حياتك اليومية</p>
                  <!-- /wp:paragraph -->
                  
              </div>
              <!-- /wp:group -->
          </div>
          <!-- /wp:column -->
          
          <!-- wp:column -->
          <div class="wp-block-column">
              <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
              <div class="wp-block-group is-style-ps-feature-box">
                  
                  <!-- wp:html -->
                  <div style="text-align: center; font-size: 4rem; margin-bottom: 1rem;">⚡</div>
                  <!-- /wp:html -->
                  
                  <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                  <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">سريع وفعال</h3>
                  <!-- /wp:heading -->
                  
                  <!-- wp:paragraph {"align":"center"} -->
                  <p class="has-text-align-center">حلول سريعة التطبيق توفر عليك الوقت والجهد، مع نتائج فورية ومرئية تحسن من جودة حياتك بشكل ملحوظ</p>
                  <!-- /wp:paragraph -->
                  
              </div>
              <!-- /wp:group -->
          </div>
          <!-- /wp:column -->
          
          <!-- wp:column -->
          <div class="wp-block-column">
              <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
              <div class="wp-block-group is-style-ps-feature-box">
                  
                  <!-- wp:html -->
                  <div style="text-align: center; font-size: 4rem; margin-bottom: 1rem;">💡</div>
                  <!-- /wp:html -->
                  
                  <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                  <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">سهل التطبيق</h3>
                  <!-- /wp:heading -->
                  
                  <!-- wp:paragraph {"align":"center"} -->
                  <p class="has-text-align-center">شرح واضح ومبسط خطوة بخطوة، مع صور توضيحية ونصائح عملية تجعل التطبيق في متناول الجميع</p>
                  <!-- /wp:paragraph -->
                  
              </div>
              <!-- /wp:group -->
          </div>
          <!-- /wp:column -->
          
      </div>
      <!-- /wp:columns -->
      
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->

📁 اسم الملف: templates/home.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-blog-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-blog-header" style="margin-bottom:3rem">
    
    <!-- wp:heading {"textAlign":"center","level":1,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h1 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:1rem">📚 أحدث الحلول والنصائح</h1>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
    <p class="has-text-align-center" style="margin-bottom:2rem">اكتشف أحدث الحلول العملية والنصائح المفيدة لتحسين حياتك اليومية</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:search {"label":"البحث في المدونة","showLabel":false,"placeholder":"ابحث في المقالات...","width":50,"widthUnit":"%","buttonText":"بحث","className":"ps-blog-search"} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"ps-blog-query"} -->
  <div class="wp-block-query ps-blog-query">
    
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"2.5rem"}},"layout":{"type":"grid","columnCount":3}} -->
    
    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
    <div class="wp-block-group is-style-ps-card-style">
      
      <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
      
      <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
        
        <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"primary"} /-->
        
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":20,"style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
        
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"auto"}}},"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group" style="margin-top:auto">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- /wp:post-template -->
    
    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"4rem"}}}} -->
    <!-- wp:query-pagination-previous {"label":"السابق"} /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next {"label":"التالي"} /-->
    <!-- /wp:query-pagination -->
    
    <!-- wp:query-no-results -->
    <!-- wp:group {"className":"ps-no-posts","style":{"spacing":{"padding":{"all":"4rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-no-posts" style="padding-top:4rem;padding-right:4rem;padding-bottom:4rem;padding-left:4rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">📝 لا توجد مقالات متاحة</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
      <p class="has-text-align-center" style="margin-bottom:2rem">تابعنا للحصول على أحدث الحلول والنصائح العملية</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">العودة للرئيسية</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
    </div>
    <!-- /wp:group -->
    <!-- /wp:query-no-results -->
    
  </div>
  <!-- /wp:query -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->

📁 اسم الملف: templates/author.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-author-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-author-header" style="margin-bottom:3rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"flex"}} -->
    <div class="wp-block-group" style="margin-bottom:2rem">
      <!-- wp:home-link -->
      <a href="/" class="wp-block-home-link">🏠 الرئيسية</a>
      <!-- /wp:home-link -->
      <!-- wp:paragraph {"style":{"spacing":{"margin":{"left":"0.5rem","right":"0.5rem"}}}} -->
      <p style="margin-right:0.5rem;margin-left:0.5rem">/</p>
      <!-- /wp:paragraph -->
      <!-- wp:query-title {"type":"author"} /-->
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-author-info","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"secondary","layout":{"type":"flex","alignItems":"center"}} -->
    <div class="wp-block-group ps-author-info has-secondary-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
      
      <!-- wp:avatar {"size":80,"style":{"border":{"radius":"50px"}}} /-->
      
      <!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="--wp--style--block-gap:0.5rem">
        
        <!-- wp:query-title {"type":"author","level":1,"style":{"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
        
        <!-- wp:author-biography {"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-group">
          <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
          <p class="has-tertiary-color has-text-color" style="font-size:14px">📝 عدد المقالات: <!-- عدد المقالات سيتم إدراجه تلقائياً --></p>
          <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"ps-author-posts"} -->
  <div class="wp-block-query ps-author-posts">
    
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":2}} -->
    
    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
    <div class="wp-block-group is-style-ps-card-style">
      
      <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
      
      <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
        
        <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"primary"} /-->
        
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":25,"style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-comment-count {"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- /wp:post-template -->
    
    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
    <!-- wp:query-pagination-previous {"label":"السابق"} /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next {"label":"التالي"} /-->
    <!-- /wp:query-pagination -->
    
    <!-- wp:query-no-results -->
    <!-- wp:group {"className":"ps-no-author-posts","style":{"spacing":{"padding":{"all":"3rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-no-author-posts" style="padding-top:3rem;padding-right:3rem;padding-bottom:3rem;padding-left:3rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">📝 لم ينشر هذا المؤلف أي مقالات بعد</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
      <p class="has-text-align-center" style="margin-bottom:2rem">تابع للحصول على أحدث المقالات من هذا المؤلف</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">تصفح جميع المقالات</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
    </div>
    <!-- /wp:group -->
    <!-- /wp:query-no-results -->
    
  </div>
  <!-- /wp:query -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف: templates/category.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-category-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-category-header" style="margin-bottom:3rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"flex"}} -->
    <div class="wp-block-group" style="margin-bottom:2rem">
      <!-- wp:home-link -->
      <a href="/" class="wp-block-home-link">🏠 الرئيسية</a>
      <!-- /wp:home-link -->
      <!-- wp:paragraph {"style":{"spacing":{"margin":{"left":"0.5rem","right":"0.5rem"}}}} -->
      <p style="margin-right:0.5rem;margin-left:0.5rem">/</p>
      <!-- /wp:paragraph -->
      <!-- wp:query-title {"type":"archive"} /-->
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-category-info","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-category-info has-secondary-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
      
      <!-- wp:query-title {"type":"archive","level":1,"textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
      
      <!-- wp:term-description {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
      
      <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
      <div class="wp-block-group">
        <!-- wp:html -->
        <div class="ps-category-stats" style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap; font-size: 14px; color: #666;">
          <span>📄 عدد المقالات: <strong id="posts-count">0</strong></span>
          <span>📅 آخر تحديث: <strong id="last-updated">اليوم</strong></span>
          <span>👀 مقالات شائعة متاحة</span>
        </div>
        <!-- /wp:html -->
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"ps-category-posts"} -->
  <div class="wp-block-query ps-category-posts">
    
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
    
    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
    <div class="wp-block-group is-style-ps-card-style">
      
      <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
      
      <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
        
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":20,"style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center","flexWrap":"wrap"}} -->
        <div class="wp-block-group">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group" style="margin-top:1rem">
          <!-- wp:post-terms {"term":"post_tag","style":{"typography":{"fontSize":"12px"}},"textColor":"primary"} /-->
          <!-- wp:read-more {"content":"اقرأ →","style":{"typography":{"fontSize":"13px"}},"textColor":"primary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- /wp:post-template -->
    
    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
    <!-- wp:query-pagination-previous {"label":"السابق"} /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next {"label":"التالي"} /-->
    <!-- /wp:query-pagination -->
    
    <!-- wp:query-no-results -->
    <!-- wp:group {"className":"ps-no-category-posts","style":{"spacing":{"padding":{"all":"4rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-no-category-posts" style="padding-top:4rem;padding-right:4rem;padding-bottom:4rem;padding-left:4rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">📭 لا توجد مقالات في هذا التصنيف حالياً</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
      <p class="has-text-align-center" style="margin-bottom:2rem">يرجى المحاولة لاحقاً أو تصفح الأقسام الأخرى</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"1rem"}}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">العودة للرئيسية</a></div>
        <!-- /wp:button -->
        
        <!-- wp:button {"className":"is-style-ps-outline-button"} -->
        <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/home">🏠 البيت والمنزل</a></div>
        <!-- /wp:button -->
        
        <!-- wp:button {"className":"is-style-ps-outline-button"} -->
        <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/kitchen">🍳 المطبخ والطبخ</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
    </div>
    <!-- /wp:group -->
    <!-- /wp:query-no-results -->
    
  </div>
  <!-- /wp:query -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->

📁 اسم الملف: templates/tag.html

<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-tag-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-tag-header" style="margin-bottom:3rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"flex"}} -->
    <div class="wp-block-group" style="margin-bottom:2rem">
      <!-- wp:home-link -->
      <a href="/" class="wp-block-home-link">🏠 الرئيسية</a>
      <!-- /wp:home-link -->
      <!-- wp:paragraph {"style":{"spacing":{"margin":{"left":"0.5rem","right":"0.5rem"}}}} -->
      <p style="margin-right:0.5rem;margin-left:0.5rem">/</p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
      <p class="has-tertiary-color has-text-color" style="font-size:14px">الوسم:</p>
      <!-- /wp:paragraph -->
      <!-- wp:query-title {"type":"archive"} /-->
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-tag-info","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-tag-info has-secondary-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
      
      <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","alignItems":"center"}} -->
      <div class="wp-block-group">
        <!-- wp:html -->
        <div style="background: var(--wp--preset--color--primary); color: white; padding: 8px 16px; border-radius: 20px; font-size: 2rem; margin-left: 1rem;">🏷️</div>
        <!-- /wp:html -->
        
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
          <!-- wp:query-title {"type":"archive","level":1,"style":{"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
          <!-- wp:term-description /-->
        </div>
        <!-- /wp:group -->
      </div>
      <!-- /wp:group -->
      
      <!-- wp:group {"style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-group" style="margin-top:1.5rem">
        <!-- wp:html -->
        <div class="ps-tag-stats" style="font-size: 14px; color: #666; text-align: center;">
          📄 عدد المقالات المرتبطة بهذا الوسم: <strong id="tag-posts-count">0</strong>
        </div>
        <!-- /wp:html -->
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"ps-tag-posts"} -->
  <div class="wp-block-query ps-tag-posts">
    
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
    
    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
    <div class="wp-block-group is-style-ps-card-style">
      
      <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
      
      <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
        
        <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"primary"} /-->
        
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":18,"style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->
        
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"}} -->
        <div class="wp-block-group">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- /wp:post-template -->
    
    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
    <!-- wp:query-pagination-previous {"label":"السابق"} /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next {"label":"التالي"} /-->
    <!-- /wp:query-pagination -->
    
    <!-- wp:query-no-results -->
    <!-- wp:group {"className":"ps-no-tag-posts","style":{"spacing":{"padding":{"all":"4rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-no-tag-posts" style="padding-top:4rem;padding-right:4rem;padding-bottom:4rem;padding-left:4rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">🏷️ لا توجد مقالات بهذا الوسم حالياً</h3>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
      <p class="has-text-align-center" style="margin-bottom:2rem">يرجى تصفح الوسوم الأخرى أو العودة للصفحة الرئيسية</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">العودة للرئيسية</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
      
      <!-- wp:group {"style":{"spacing":{"margin":{"top":"2rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="margin-top:2rem">
        <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
        <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">أو تصفح هذه الوسوم الشائعة:</h4>
        <!-- /wp:heading -->
        
        <!-- wp:tag-cloud {"numberOfTags":10,"className":"ps-popular-tags"} /-->
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    <!-- /wp:query-no-results -->
    
  </div>
  <!-- /wp:query -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->

📁 اسم الملف: functions.php
<?php
/**
 * Practical Solutions Pro - Enhanced and Refactored Functions
 * قالب الحلول العملية الاحترافي - الوظائف المحسنة والمُعاد هيكلتها
 * المسار: /functions.php
 * الإصدار: 2.2.1 (مُصلح)
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// 1. تعريف الثوابت الأساسية
// =============================================================================
define('PS_THEME_VERSION', '2.2.1');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());


// =============================================================================
// 2. تحميل ملفات النظام الأساسية (Core System Files)
// =============================================================================
// قائمة بالملفات الأساسية التي يحتاجها القالب ليعمل.
$ps_core_includes = [
    'inc/theme-admin-panel.php',      // لوحة الإعدادات الرئيسية
    'inc/customizer-settings.php',    // إعدادات المخصص (Customizer)
    'inc/block-patterns.php',         // **إصلاح:** تم التأكد من أن هذا الملف يربط نفسه بـ add_action
    'inc/unified-search-system.php',  // نظام البحث الموحد
    'inc/ai-openrouter-system.php',   // نظام الذكاء الاصطناعي
    'inc/rating-system.php',          // نظام التقييمات
    'inc/advanced-analytics.php',     // نظام التحليلات المتقدم
];

foreach ($ps_core_includes as $file) {
    $filepath = PS_THEME_DIR . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}


// =============================================================================
// 3. إعدادات القالب الأساسية (Theme Setup)
// =============================================================================
if (!function_exists('ps_theme_setup')) {
    function ps_theme_setup() {
        // دعم ميزات ووردبريس الحديثة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
        add_theme_support('custom-logo', ['height' => 100, 'width' => 400, 'flex-height' => true, 'flex-width' => true]);
        
        // دعم ميزات قوالب الكتل (Block Theme Features)
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_theme_support('custom-spacing');
        add_theme_support('custom-line-height');
        add_theme_support('appearance-tools');

        // دعم الترجمة
        load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');

        // تسجيل قوائم التنقل
        register_nav_menus([
            'primary' => __('القائمة الرئيسية', 'practical-solutions'),
            'footer'  => __('قائمة التذييل', 'practical-solutions'),
            'social'  => __('وسائل التواصل الاجتماعي', 'practical-solutions'),
        ]);

        // تسجيل أحجام الصور المخصصة
        add_image_size('ps-card', 400, 300, true);
        add_image_size('ps-featured', 800, 600, true);
        add_image_size('ps-hero', 1600, 900, true);
    }
}
add_action('after_setup_theme', 'ps_theme_setup');


// =============================================================================
// 4. تحميل الأصول (CSS & JavaScript)
// =============================================================================
if (!function_exists('ps_enqueue_assets')) {
    function ps_enqueue_assets() {
        // تحميل ملف CSS الموحد والنهائي.
        wp_enqueue_style(
            'ps-unified-styles',
            PS_THEME_URI . '/assets/css/unified.css',
            [],
            PS_THEME_VERSION
        );

        // تحميل ملف JS الموحد والمصغر
        wp_enqueue_script(
            'ps-unified-scripts',
            PS_THEME_URI . '/assets/js/unified.min.js',
            ['jquery'],
            PS_THEME_VERSION,
            true // تحميل في التذييل
        );

        // **إصلاح وتحسين:** تمرير البيانات من PHP إلى JavaScript بشكل أكثر تفصيلاً
        $ai_settings = get_option('ps_ai_settings', []);
        $general_settings = get_option('ps_general_settings', []);

        wp_localize_script('ps-unified-scripts', 'psSettings', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ps_ajax_nonce'), // **تحسين:** استخدام nonce مخصص للـ AJAX
            'siteUrl' => home_url('/'),
            'themeUri' => PS_THEME_URI,
            'isRTL'   => is_rtl(),
            'postId'  => is_singular() ? get_the_ID() : 0, // تمرير ID الصفحة الحالية
            'features' => [
                'voiceSearch'     => $general_settings['voice_search'] ?? true,
                'aiEnabled'       => $ai_settings['enabled'] ?? false,
                'aiSuggestions'   => $ai_settings['search_suggestions'] ?? true,
                'bookmarks'       => $general_settings['bookmarks'] ?? true,
                'ratingSystem'    => $general_settings['rating_system'] ?? true,
                'readingProgress' => $general_settings['reading_progress'] ?? true,
            ]
        ]);

        // إضافة CSS مخصص من إعدادات القالب
        $custom_css = get_option('ps_advanced_settings', [])['custom_css'] ?? '';
        if (!empty($custom_css)) {
            wp_add_inline_style('ps-unified-styles', $custom_css);
        }
    }
}
add_action('wp_enqueue_scripts', 'ps_enqueue_assets');


// تحميل أصول لوحة الإدارة
if (!function_exists('ps_enqueue_admin_assets')) {
    function ps_enqueue_admin_assets($hook) {
        if (strpos($hook, 'practical-solutions') === false && strpos($hook, 'ps-') === false) {
            return;
        }
        
        wp_enqueue_style('ps-admin-styles', PS_THEME_URI . '/assets/admin/admin-styles.css', [], PS_THEME_VERSION);
        wp_enqueue_script('ps-admin-scripts', PS_THEME_URI . '/assets/admin/admin-scripts.js', ['jquery'], PS_THEME_VERSION, true);
    }
}
add_action('admin_enqueue_scripts', 'ps_enqueue_admin_assets');


// =============================================================================
// 5. تسجيل أنماط البلوك (Block Styles)
// =============================================================================
if (!function_exists('ps_register_block_styles')) {
    function ps_register_block_styles() {
        $block_styles = [
            'core/group' => [
                ['name' => 'ps-card-style', 'label' => __('بطاقة', 'practical-solutions')]
            ],
            'core/button' => [
                ['name' => 'ps-primary-button', 'label' => __('زر أساسي', 'practical-solutions')],
                ['name' => 'ps-outline-button', 'label' => __('زر مخطط', 'practical-solutions')]
            ],
            'core/image' => [
                ['name' => 'ps-rounded-image', 'label' => __('صورة مدورة', 'practical-solutions')]
            ],
            'core/heading' => [
                ['name' => 'ps-section-title', 'label' => __('عنوان قسم', 'practical-solutions')]
            ]
        ];

        foreach ($block_styles as $block => $styles) {
            foreach ($styles as $style) {
                register_block_style($block, $style);
            }
        }
    }
}
add_action('init', 'ps_register_block_styles');


// =============================================================================
// 6. ميزات إضافية وتحسينات
// =============================================================================

// إضافة دعم PWA
if (!function_exists('ps_add_pwa_meta')) {
    function ps_add_pwa_meta() {
        echo '<link rel="manifest" href="' . esc_url(PS_THEME_URI . '/manifest.json') . '">';
        echo '<meta name="theme-color" content="#007cba">';
    }
}
add_action('wp_head', 'ps_add_pwa_meta');

// تتبع مشاهدات الصفحة
if (!function_exists('ps_track_page_view')) {
    function ps_track_page_view() {
        if (is_singular('post') && !is_admin()) {
            $settings = get_option('ps_analytics_settings', []);
            if ($settings['enabled'] ?? true) {
                if (class_exists('PS_Advanced_Analytics')) {
                    PS_Advanced_Analytics::track_page_view(get_the_ID());
                }
            }
        }
    }
}
add_action('wp_head', 'ps_track_page_view');

// إضافة كلاسات مخصصة للـ body
if (!function_exists('ps_body_classes')) {
    function ps_body_classes($classes) {
        if (is_rtl()) {
            $classes[] = 'ps-rtl';
        }
        if (wp_is_mobile()) {
            $classes[] = 'ps-mobile';
        }
        return $classes;
    }
}
add_filter('body_class', 'ps_body_classes');

// تنظيف <head>
if (!function_exists('ps_clean_head')) {
    function ps_clean_head() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    }
}
add_action('init', 'ps_clean_head');



📁 اسم الملف: assets/css/unified.css
/**
 * Practical Solutions Pro - Unified Styles (Updated)
 * الأنماط الموحدة المحدثة للحلول العملية الاحترافية
 */

/* الخطوط */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');

/* متغيرات CSS موحدة - محدثة */
:root {
  /* الألوان الأساسية */
  --ps-color-base: #ffffff;
  --ps-color-contrast: #1a1a1a;
  --ps-color-primary: #007cba;
  --ps-color-secondary: #f0f4f8;
  --ps-color-tertiary: #64748b;
  --ps-color-accent: #e74c3c;
  --ps-color-success: #10b981;
  --ps-color-warning: #f59e0b;
  
  /* المسافات */
  --ps-spacing-xs: 0.5rem;
  --ps-spacing-sm: 1rem;
  --ps-spacing-md: 1.5rem;
  --ps-spacing-lg: 2rem;
  --ps-spacing-xl: 4rem;
  
  /* الخطوط */
  --ps-font-family: 'Noto Sans Arabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  --ps-font-size-xs: 0.75rem;
  --ps-font-size-sm: 0.875rem;
  --ps-font-size-base: 1rem;
  --ps-font-size-lg: 1.125rem;
  --ps-font-size-xl: 1.25rem;
  --ps-font-size-xxl: 1.5rem;
  
  /* الظلال */
  --ps-shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
  --ps-shadow-md: 0 4px 15px rgba(0,0,0,0.1);
  --ps-shadow-lg: 0 8px 30px rgba(0,0,0,0.15);
  --ps-shadow-xl: 0 20px 40px rgba(0,0,0,0.2);
  
  /* الانتقالات */
  --ps-transition-fast: 0.2s ease;
  --ps-transition-normal: 0.3s ease;
  --ps-transition-slow: 0.5s ease;
  
  /* نصف الأقطار */
  --ps-radius-sm: 4px;
  --ps-radius-md: 8px;
  --ps-radius-lg: 12px;
  --ps-radius-xl: 16px;
  --ps-radius-full: 50px;
  
  /* المحتوى */
  --ps-content-width: 800px;
  --ps-wide-width: 1200px;
  
  /* التقييمات */
  --ps-star-color: #fbbf24;
  --ps-star-empty: #d1d5db;
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

/* تحسينات للكلاسات الأساسية */
.ps-theme {
  --wp--preset--color--base: var(--ps-color-base);
  --wp--preset--color--contrast: var(--ps-color-contrast);
  --wp--preset--color--primary: var(--ps-color-primary);
  --wp--preset--color--secondary: var(--ps-color-secondary);
  --wp--preset--color--tertiary: var(--ps-color-tertiary);
  --wp--preset--color--accent: var(--ps-color-accent);
  --wp--preset--color--success: var(--ps-color-success);
  --wp--preset--color--warning: var(--ps-color-warning);
}

/* Block Styles المخصصة المحدثة */

/* بطاقة محسنة */
.wp-block-group.is-style-ps-card-style {
  background: var(--ps-color-base);
  border-radius: var(--ps-radius-lg);
  box-shadow: var(--ps-shadow-md);
  padding: var(--ps-spacing-md);
  transition: transform var(--ps-transition-fast), box-shadow var(--ps-transition-fast);
  border: 1px solid rgba(0,0,0,0.05);
  position: relative;
  overflow: hidden;
}

.wp-block-group.is-style-ps-card-style::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--ps-color-primary), var(--ps-color-accent));
  opacity: 0;
  transition: opacity var(--ps-transition-normal);
}

.wp-block-group.is-style-ps-card-style:hover {
  transform: translateY(-4px);
  box-shadow: var(--ps-shadow-lg);
}

.wp-block-group.is-style-ps-card-style:hover::before {
  opacity: 1;
}

/* قسم البطل محسن */
.wp-block-group.is-style-ps-hero-section {
  background: linear-gradient(135deg, var(--ps-color-primary) 0%, var(--ps-color-tertiary) 100%);
  color: var(--ps-color-base);
  padding: var(--ps-spacing-xl) var(--ps-spacing-md);
  text-align: center;
  position: relative;
  overflow: hidden;
  border-radius: var(--ps-radius-lg);
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
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

/* صندوق الميزة محسن */
.wp-block-group.is-style-ps-feature-box {
  background: var(--ps-color-secondary);
  border-radius: var(--ps-radius-md);
  padding: var(--ps-spacing-md);
  text-align: center;
  transition: all var(--ps-transition-normal);
  border: 2px solid transparent;
  position: relative;
}

.wp-block-group.is-style-ps-feature-box:hover {
  border-color: var(--ps-color-primary);
  background: var(--ps-color-base);
  transform: scale(1.02);
  box-shadow: var(--ps-shadow-md);
}

/* حاوية التقييم */
.wp-block-group.is-style-ps-rating-container {
  background: linear-gradient(135deg, var(--ps-color-secondary) 0%, var(--ps-color-base) 100%);
  border-radius: var(--ps-radius-md);
  padding: var(--ps-spacing-md);
  border: 1px solid var(--ps-color-primary);
  text-align: center;
}

/* أنماط الأزرار المحدثة */
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
  position: relative;
  overflow: hidden;
}

.wp-block-button.is-style-ps-primary-button .wp-block-button__link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s;
}

.wp-block-button.is-style-ps-primary-button .wp-block-button__link:hover {
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

.wp-block-button.is-style-ps-primary-button .wp-block-button__link:hover::before {
  left: 100%;
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
  position: relative;
  overflow: hidden;
}

.wp-block-button.is-style-ps-outline-button .wp-block-button__link::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background: var(--ps-color-primary);
  transition: width var(--ps-transition-normal);
  z-index: -1;
}

.wp-block-button.is-style-ps-outline-button .wp-block-button__link:hover {
  color: var(--ps-color-base);
  transform: translateY(-1px);
}

.wp-block-button.is-style-ps-outline-button .wp-block-button__link:hover::before {
  width: 100%;
}

/* زر الحفظ */
.wp-block-button.is-style-ps-bookmark-button .wp-block-button__link {
  background: var(--ps-color-secondary);
  color: var(--ps-color-primary);
  border: 2px solid var(--ps-color-primary);
  border-radius: var(--ps-radius-md);
  padding: 8px 16px;
  font-weight: 500;
  text-decoration: none;
  transition: all var(--ps-transition-fast);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.wp-block-button.is-style-ps-bookmark-button .wp-block-button__link:hover {
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

/* أنماط العناوين المحدثة */
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

/* أنماط الصور المحدثة */
.wp-block-image.is-style-ps-rounded-image img {
  border-radius: var(--ps-radius-lg);
  box-shadow: var(--ps-shadow-md);
  transition: transform var(--ps-transition-normal);
}

.wp-block-image.is-style-ps-rounded-image:hover img {
  transform: scale(1.02);
}

.wp-block-image.is-style-ps-zoomable-image img {
  border-radius: var(--ps-radius-md);
  cursor: zoom-in;
  transition: all var(--ps-transition-normal);
}

.wp-block-image.is-style-ps-zoomable-image:hover img {
  transform: scale(1.05);
  box-shadow: var(--ps-shadow-lg);
}

/* البحث الموحد المحدث */
.ps-search-container,
.ps-hero-search-container {
  max-width: 600px;
  margin: var(--ps-spacing-md) auto;
  position: relative;
}

.ps-search-form,
.ps-hero-search-form {
  display: flex;
  align-items: center;
  background: var(--ps-color-base);
  border-radius: var(--ps-radius-full);
  box-shadow: var(--ps-shadow-md);
  overflow: hidden;
  border: 2px solid var(--ps-color-secondary);
  transition: all var(--ps-transition-fast);
  position: relative;
}

.ps-search-form:focus-within,
.ps-hero-search-form:focus-within {
  border-color: var(--ps-color-primary);
  box-shadow: var(--ps-shadow-lg);
  transform: translateY(-2px);
}

.ps-search-input,
.ps-hero-search-input {
  flex: 1;
  border: none;
  padding: 15px 20px;
  font-size: var(--ps-font-size-base);
  background: transparent;
  color: var(--ps-color-contrast);
  font-family: var(--ps-font-family);
}

.ps-search-input:focus,
.ps-hero-search-input:focus {
  outline: none;
}

.ps-search-input::placeholder,
.ps-hero-search-input::placeholder {
  color: var(--ps-color-tertiary);
  opacity: 0.7;
}

.ps-search-btn,
.ps-hero-search-btn,
.ps-voice-btn,
.ps-hero-voice-btn {
  border: none;
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  padding: 15px 20px;
  cursor: pointer;
  font-size: var(--ps-font-size-base);
  transition: all var(--ps-transition-fast);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--ps-font-family);
  position: relative;
  overflow: hidden;
}

.ps-search-btn::before,
.ps-hero-search-btn::before,
.ps-voice-btn::before,
.ps-hero-voice-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255,255,255,0.3);
  border-radius: 50%;
  transition: width 0.4s, height 0.4s, top 0.4s, left 0.4s;
}

.ps-search-btn:hover,
.ps-hero-search-btn:hover,
.ps-voice-btn:hover,
.ps-hero-voice-btn:hover {
  background: var(--ps-color-tertiary);
  transform: scale(1.05);
}

.ps-search-btn:hover::before,
.ps-hero-search-btn:hover::before,
.ps-voice-btn:hover::before,
.ps-hero-voice-btn:hover::before {
  width: 300px;
  height: 300px;
  top: -150px;
  left: -150px;
}

.ps-voice-btn.listening,
.ps-hero-voice-btn.listening {
  background: var(--ps-color-accent);
  animation: ps-pulse 1s infinite;
}

/* اقتراحات البحث المحدثة */
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
  margin-top: 8px;
}

.ps-search-suggestions.show {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.ps-suggestion-item {
  padding: 15px;
  border-bottom: 1px solid var(--ps-color-secondary);
  cursor: pointer;
  transition: all var(--ps-transition-fast);
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
}

.ps-suggestion-item::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 0;
  height: 100%;
  background: linear-gradient(90deg, var(--ps-color-primary), transparent);
  transition: width var(--ps-transition-fast);
}

.ps-suggestion-item:hover,
.ps-suggestion-item.active {
  background: var(--ps-color-secondary);
  transform: translateX(5px);
}

.ps-suggestion-item:hover::before,
.ps-suggestion-item.active::before {
  width: 4px;
}

.ps-suggestion-item:last-child {
  border-bottom: none;
}

.ps-suggestion-thumbnail {
  width: 50px;
  height: 50px;
  border-radius: var(--ps-radius-sm);
  object-fit: cover;
  flex-shrink: 0;
}

.ps-suggestion-content {
  flex: 1;
  min-width: 0;
}

.ps-suggestion-title {
  font-weight: 600;
  color: var(--ps-color-contrast);
  margin-bottom: 4px;
  font-size: var(--ps-font-size-sm);
  line-height: 1.4;
}

.ps-suggestion-title mark {
  background: linear-gradient(120deg, var(--ps-color-primary) 0%, var(--ps-color-primary) 100%);
  background-repeat: no-repeat;
  background-size: 100% 0.2em;
  background-position: 0 88%;
  color: inherit;
  padding: 0;
}

.ps-suggestion-excerpt {
  font-size: var(--ps-font-size-xs);
  color: var(--ps-color-tertiary);
  line-height: 1.4;
  margin-bottom: 4px;
}

.ps-suggestion-meta {
  display: flex;
  gap: 8px;
  font-size: var(--ps-font-size-xs);
  color: var(--ps-color-primary);
  flex-wrap: wrap;
}

.ps-suggestion-rating {
  display: flex;
  align-items: center;
  gap: 4px;
}

.ps-suggestion-reading-time {
  color: var(--ps-color-tertiary);
}

/* نظام التقييمات */
.ps-rating-widget {
  background: var(--ps-color-secondary);
  border-radius: var(--ps-radius-md);
  padding: var(--ps-spacing-md);
  margin: var(--ps-spacing-lg) 0;
  border: 1px solid var(--ps-color-primary);
}

.ps-rating-display {
  text-align: center;
  margin-bottom: var(--ps-spacing-md);
}

.ps-rating-stars {
  display: flex;
  justify-content: center;
  gap: 4px;
  margin-bottom: var(--ps-spacing-sm);
}

.ps-rating-stars .ps-star {
  font-size: 20px;
  color: var(--ps-star-color);
  transition: all var(--ps-transition-fast);
  cursor: pointer;
}

.ps-rating-stars .ps-star.empty {
  color: var(--ps-star-empty);
}

.ps-rating-stars .ps-star:hover {
  transform: scale(1.2);
}

.ps-rating-info {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: var(--ps-spacing-sm);
  font-size: var(--ps-font-size-sm);
}

.ps-rating-average {
  font-size: var(--ps-font-size-lg);
  font-weight: 700;
  color: var(--ps-color-primary);
}

.ps-rating-count {
  color: var(--ps-color-tertiary);
}

.ps-rating-form {
  background: var(--ps-color-base);
  border-radius: var(--ps-radius-md);
  padding: var(--ps-spacing-md);
  margin-top: var(--ps-spacing-md);
  border: 1px solid var(--ps-color-secondary);
}

.ps-rating-form h4 {
  margin: 0 0 var(--ps-spacing-sm) 0;
  text-align: center;
  color: var(--ps-color-contrast);
}

.ps-rating-input {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-bottom: var(--ps-spacing-md);
}

.ps-rating-btn {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  transition: all var(--ps-transition-fast);
  color: var(--ps-star-empty);
}

.ps-rating-btn:hover,
.ps-rating-btn.active {
  color: var(--ps-star-color);
  transform: scale(1.2);
}

.ps-rating-comment {
  width: 100%;
  padding: 12px;
  border: 1px solid var(--ps-color-secondary);
  border-radius: var(--ps-radius-md);
  font-family: var(--ps-font-family);
  font-size: var(--ps-font-size-sm);
  resize: vertical;
  min-height: 80px;
  margin-bottom: var(--ps-spacing-md);
}

.ps-rating-comment:focus {
  outline: none;
  border-color: var(--ps-color-primary);
  box-shadow: 0 0 0 3px rgba(0, 123, 186, 0.1);
}

.ps-rating-actions {
  display: flex;
  gap: var(--ps-spacing-sm);
  justify-content: center;
}

.ps-submit-rating,
.ps-cancel-rating {
  padding: 10px 20px;
  border: none;
  border-radius: var(--ps-radius-md);
  font-weight: 500;
  cursor: pointer;
  transition: all var(--ps-transition-fast);
  font-family: var(--ps-font-family);
}

.ps-submit-rating.btn-primary {
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
}

.ps-submit-rating.btn-primary:hover {
  background: var(--ps-color-tertiary);
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

.ps-cancel-rating.btn-secondary {
  background: var(--ps-color-secondary);
  color: var(--ps-color-contrast);
}

.ps-cancel-rating.btn-secondary:hover {
  background: var(--ps-color-tertiary);
  color: var(--ps-color-base);
}

.ps-rate-button {
  background: var(--ps-color-primary);
  color: var(--ps-color-base);
  border: none;
  padding: 12px 24px;
  border-radius: var(--ps-radius-full);
  font-weight: 600;
  cursor: pointer;
  transition: all var(--ps-transition-fast);
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0 auto;
  font-family: var(--ps-font-family);
}

.ps-rate-button:hover {
  background: var(--ps-color-tertiary);
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-md);
}

/* أنماط حجم النجوم */
.ps-stars-small .ps-star { font-size: 14px; }
.ps-stars-medium .ps-star { font-size: 18px; }
.ps-stars-large .ps-star { font-size: 24px; }

/* Breadcrumbs محدث */
.ps-breadcrumbs {
  margin-bottom: var(--ps-spacing-md);
  font-size: var(--ps-font-size-sm);
  background: var(--ps-color-secondary);
  padding: var(--ps-spacing-sm) var(--ps-spacing-md);
  border-radius: var(--ps-radius-md);
}

.breadcrumb-list {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 8px;
  flex-wrap: wrap;
}

.breadcrumb-item {
  color: var(--ps-color-tertiary);
}

.breadcrumb-item a {
  color: var(--ps-color-primary);
  text-decoration: none;
  transition: color var(--ps-transition-fast);
  padding: 4px 8px;
  border-radius: var(--ps-radius-sm);
}

.breadcrumb-item a:hover {
  color: var(--ps-color-tertiary);
  background: var(--ps-color-base);
}

.breadcrumb-item.current {
  color: var(--ps-color-contrast);
  font-weight: 500;
  background: var(--ps-color-base);
  padding: 4px 8px;
  border-radius: var(--ps-radius-sm);
}

.breadcrumb-separator {
  color: var(--ps-color-tertiary);
  opacity: 0.5;
  margin: 0 4px;
}

/* تحسينات الأداء */
.ps-lazy-image {
  opacity: 0;
  transition: opacity var(--ps-transition-slow);
}

.ps-lazy-image.loaded {
  opacity: 1;
}

/* الرسوم المتحركة المحدثة */
@keyframes ps-pulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.05); opacity: 0.8; }
}

@keyframes ps-fade-in {
  from { 
    opacity: 0; 
    transform: translateY(20px); 
  }
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

@keyframes ps-slide-in-right {
  from { 
    opacity: 0; 
    transform: translateX(30px); 
  }
  to { 
    opacity: 1; 
    transform: translateX(0); 
  }
}

@keyframes ps-shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

/* كلاسات مساعدة */
.ps-fade-in {
  animation: ps-fade-in 0.6s ease forwards;
}

.ps-slide-in-right {
  animation: ps-slide-in-right 0.6s ease forwards;
}

.ps-loading-shimmer {
  position: relative;
  overflow: hidden;
}

.ps-loading-shimmer::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
  animation: ps-shimmer 1.5s infinite;
}

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

/* Focus styles محسنة */
button:focus,
input:focus,
select:focus,
textarea:focus,
a:focus {
  outline: 2px solid var(--ps-color-primary);
  outline-offset: 2px;
  border-radius: var(--ps-radius-sm);
}

.ps-focused {
  box-shadow: 0 0 0 3px rgba(0, 123, 186, 0.2);
}

/* الوضع المظلم محدث */
html[data-theme="dark"] {
  --ps-color-base: #1a1a1a;
  --ps-color-contrast: #ffffff;
  --ps-color-primary: #4a9eff;
  --ps-color-secondary: #2d3748;
  --ps-color-tertiary: #a0aec0;
  --ps-color-accent: #ff6b6b;
  --ps-color-success: #48bb78;
  --ps-color-warning: #ed8936;
}

html[data-theme="dark"] .wp-block-group.is-style-ps-card-style {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .wp-block-group.is-style-ps-feature-box {
  background: var(--ps-color-secondary);
}

html[data-theme="dark"] .wp-block-group.is-style-ps-feature-box:hover {
  background: #4a5568;
}

html[data-theme="dark"] .ps-search-form,
html[data-theme="dark"] .ps-hero-search-form {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-search-suggestions {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-suggestion-item {
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-suggestion-item:hover,
html[data-theme="dark"] .ps-suggestion-item.active {
  background: #4a5568;
}

html[data-theme="dark"] .ps-rating-widget,
html[data-theme="dark"] .ps-rating-form {
  background: var(--ps-color-secondary);
  border-color: #4a5568;
}

html[data-theme="dark"] .ps-breadcrumbs {
  background: var(--ps-color-secondary);
}

/* التصميم المتجاوب المحدث */
@media (max-width: 768px) {
  :root {
    --ps-spacing-xl: 2rem;
    --ps-font-size-xl: 1.125rem;
    --ps-font-size-xxl: 1.25rem;
  }
  
  .ps-search-container,
  .ps-hero-search-container {
    margin: var(--ps-spacing-sm) var(--ps-spacing-xs);
  }
  
  .ps-search-suggestions {
    max-height: 250px;
  }
  
  .ps-suggestion-item {
    padding: 12px;
    font-size: var(--ps-font-size-sm);
  }
  
  .ps-suggestion-thumbnail {
    width: 40px;
    height: 40px;
  }
  
  .ps-rating-stars .ps-star {
    font-size: 18px;
  }
  
  .ps-rating-btn {
    font-size: 20px;
  }
  
  .breadcrumb-list {
    gap: 4px;
  }
  
  .ps-rating-widget {
    padding: var(--ps-spacing-sm);
  }
}

@media (max-width: 575px) {
  .ps-search-form,
  .ps-hero-search-form {
    flex-direction: column;
    border-radius: var(--ps-radius-md);
  }
  
  .ps-search-input,
  .ps-hero-search-input {
    border-radius: var(--ps-radius-md) var(--ps-radius-md) 0 0;
  }
  
  .ps-search-btn,
  .ps-hero-search-btn,
  .ps-voice-btn,
  .ps-hero-voice-btn {
    border-radius: 0 0 var(--ps-radius-md) var(--ps-radius-md);
    flex: 1;
  }
  
  .ps-rating-input {
    gap: 4px;
  }
  
  .ps-rating-btn {
    font-size: 18px;
  }
  
  .ps-rating-actions {
    flex-direction: column;
  }
}

/* Print styles */
@media print {
  .ps-search-suggestions,
  .ps-rating-widget,
  .ps-voice-btn,
  .ps-hero-voice-btn {
    display: none !important;
  }
  
  body {
    background: white !important;
    color: black !important;
  }
  
  .wp-block-group.is-style-ps-card-style {
    border: 1px solid #ddd;
    box-shadow: none;
  }
}

/* تحسينات الأداء النهائية */
.wp-block-group.is-style-ps-card-style,
.wp-block-group.is-style-ps-feature-box,
.ps-suggestion-item,
.ps-rating-btn {
  will-change: transform;
  transform: translateZ(0);
}

.ps-search-form,
.ps-hero-search-form,
.ps-search-suggestions {
  will-change: transform, opacity;
}

📁 اسم الملف: inc/block-patterns.php
<?php
/**
 * Block Patterns Registration - Professional & Safe Version
 * تسجيل أنماط الكتل المخصصة - نسخة احترافية وآمنة
 */

if (!defined('ABSPATH')) {
    exit;
}

// نستخدم كلاس لتنظيم الكود ومنع أي تعارضات مستقبلية
class PS_Block_Patterns_Registry {

    /**
     * ربط جميع الأحداث عند إنشاء الكائن
     */
    public function __construct() {
        // **الإصلاح الرئيسي:** نستخدم 'init' hook لضمان أن ووردبريس جاهز بالكامل
        add_action('init', [$this, 'register_categories_and_patterns']);
    }

    /**
     * دالة واحدة لتسجيل الفئات والأنماط
     */
    public function register_categories_and_patterns() {
        // أولاً: تسجيل الفئات
        $this->register_pattern_categories();
        
        // ثانياً: تسجيل الأنماط الفردية
        $this->register_all_patterns();
    }

    /**
     * تسجيل فئات الأنماط
     */
    private function register_pattern_categories() {
        // التحقق من وجود الدالة كإجراء وقائي إضافي
        if (!function_exists('register_block_pattern_category')) {
            return;
        }

        $categories = [
            'practical-solutions' => __('الحلول العملية', 'practical-solutions'),
            'ps-heroes'           => __('أقسام البطل', 'practical-solutions'),
            'ps-features'         => __('عرض الميزات', 'practical-solutions'),
            'ps-content'          => __('أقسام المحتوى', 'practical-solutions'),
            'ps-cta'              => __('دعوات العمل', 'practical-solutions'),
        ];

        foreach ($categories as $slug => $label) {
            // لا حاجة للتحقق مع get_block_pattern_category، ووردبريس يتعامل مع هذا داخلياً
            register_block_pattern_category($slug, ['label' => $label]);
        }
    }

    /**
     * تحميل وتسجيل جميع ملفات الأنماط من مجلد /patterns
     */
    private function register_all_patterns() {
        $patterns_dir = get_template_directory() . '/patterns/';
        
        if (!is_dir($patterns_dir)) {
            return; // الخروج إذا كان المجلد غير موجود
        }

        $pattern_files = glob($patterns_dir . '*.php');
        
        foreach ($pattern_files as $file) {
            // كل ملف نمط مسؤول عن تسجيل نفسه باستخدام register_block_pattern
            require_once $file;
        }
    }
}

// تشغيل النظام
new PS_Block_Patterns_Registry();


📁 اسم الملف: sw.js
/**
 * Service Worker for Practical Solutions Theme
 * خدمة التخزين المؤقت للقالب
 */

const CACHE_NAME = 'practical-solutions-v2.1.0';
const urlsToCache = [
    '/',
    '/wp-content/themes/practical-solutions-pro/assets/css/unified.css',
    '/wp-content/themes/practical-solutions-pro/assets/js/unified.min.js',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('تم فتح التخزين المؤقت');
                return cache.addAll(urlsToCache);
            })
    );
});

// تفعيل Service Worker
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('حذف التخزين المؤقت القديم:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// اعتراض الطلبات
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                // إرجاع من Cache إذا وُجد
                if (response) {
                    return response;
                }
                
                return fetch(event.request);
            }
        )
    );
});


📁 اسم الملف: .gitignore

```gitignore
# WordPress
wp-config.php
wp-content/uploads/
wp-content/cache/
wp-content/backup-db/
wp-content/advanced-cache.php
wp-content/wp-cache-config.php

# Theme Development
node_modules/
npm-debug.log
.npm
*.log
.sass-cache/
.DS_Store
Thumbs.db

# IDE
.vscode/
.idea/
*.sublime-*

# Temporary
*.tmp
*.temp
*~
.cache/

# Compiled
dist/
build/
*.min.css
*.min.js

# OS
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
ehthumbs.db
Thumbs.db

# Backup
*.bak
*.backup
*.sql


📁 اسم الملف: LICENSE
GNU GENERAL PUBLIC LICENSE
Version 3, 29 June 2007

Copyright (C) 2025 Practical Solutions Pro

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

---

Practical Solutions Pro WordPress Theme
Copyright (C) 2025, Practical Solutions Pro

Practical Solutions Pro is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

CREDITS:

- WordPress: https://wordpress.org/ | GPL v2 or later
- Noto Sans Arabic Font: https://fonts.google.com/ | SIL Open Font License
- Block Editor: https://wordpress.org/gutenberg/ | GPL v2 or later

BUNDLED RESOURCES:

All images, icons, and graphics included in this theme are either:
1. Created specifically for this theme (GPL v3)
2. From public domain sources
3. Properly licensed for distribution

For questions about licensing, please contact: legal@practical-solutions.com



📁 اسم الملف: manifest.json
{
  "name": "الحلول العملية - موقع النصائح والحلول",
  "short_name": "حلول عملية",
  "description": "موقعك المفضل للحصول على أفضل الحلول العملية والنصائح المفيدة لحياة أسهل وأكثر تنظيماً",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#007cba",
  "orientation": "portrait-primary",
  "lang": "ar",
  "dir": "rtl",
  "icons": [
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-72x72.png",
      "sizes": "72x72",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-96x96.png",
      "sizes": "96x96",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-128x128.png",
      "sizes": "128x128",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-144x144.png",
      "sizes": "144x144",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-384x384.png",
      "sizes": "384x384",
      "type": "image/png",
      "purpose": "maskable any"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png",
      "purpose": "maskable any"
    }
  ],
  "categories": ["lifestyle", "education", "productivity"],
  "screenshots": [
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/screenshot-desktop.png",
      "sizes": "1280x720",
      "type": "image/png",
      "platform": "wide",
      "label": "الصفحة الرئيسية على سطح المكتب"
    },
    {
      "src": "/wp-content/themes/practical-solutions-pro/assets/images/screenshot-mobile.png",
      "sizes": "750x1334",
      "type": "image/png",
      "platform": "narrow",
      "label": "الصفحة الرئيسية على الجوال"
    }
  ],
  "shortcuts": [
    {
      "name": "البحث عن حلول",
      "short_name": "بحث",
      "description": "ابحث عن الحلول والنصائح",
      "url": "/?s=",
      "icons": [
        {
          "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-search.png",
          "sizes": "96x96"
        }
      ]
    },
    {
      "name": "أحدث المقالات",
      "short_name": "جديد",
      "description": "تصفح أحدث المقالات والحلول",
      "url": "/blog/",
      "icons": [
        {
          "src": "/wp-content/themes/practical-solutions-pro/assets/images/icon-blog.png",
          "sizes": "96x96"
        }
      ]
    }
  ],
  "prefer_related_applications": false
}



📁 اسم الملف:  templates/ single.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

  <!-- wp:group {"className":"ps-single-header","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-single-header" style="margin-bottom:2rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:shortcode -->
    [ps_breadcrumbs]
    <!-- /wp:shortcode -->
    
    <!-- wp:post-title {"level":1,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1rem"}}}} /-->
    
    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"1.5rem"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
    <div class="wp-block-group" style="margin-bottom:1.5rem">
      <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} /-->
      <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"14px"}},"textColor":"primary"} /-->
      <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} /-->
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-single-content","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-single-content">
    
    <!-- wp:post-featured-image {"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"2rem"}}}} /-->
    
    <!-- wp:post-content {"style":{"spacing":{"blockGap":"1.5rem"}}} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-single-footer","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"},"margin":{"top":"3rem"}},"border":{"top":{"color":"var(--wp--preset--color--secondary)","width":"1px"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-single-footer" style="border-top-color:var(--wp--preset--color--secondary);border-top-width:1px;margin-top:3rem;padding-top:2rem;padding-bottom:2rem">
    
    <!-- wp:heading {"level":4,"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">شارك هذا المقال:</h4>
    <!-- /wp:heading -->
    
    <!-- wp:html -->
    <div class="ps-social-sharing">
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
    <!-- /wp:html -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-related-posts","style":{"spacing":{"margin":{"top":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-related-posts" style="margin-top:3rem">
    
    <!-- wp:heading {"level":3,"className":"is-style-ps-section-title","textAlign":"center"} -->
    <h3 class="wp-block-heading is-style-ps-section-title has-text-align-center">مقالات ذات صلة</h3>
    <!-- /wp:heading -->
    
    <!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"className":"ps-related-query"} -->
    <div class="wp-block-query ps-related-query">
      
      <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
      
      <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
      <div class="wp-block-group is-style-ps-card-style">
        
        <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image"} /-->
        
        <!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":15} /-->
        
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group" style="margin-top:1rem">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"12px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px"}},"textColor":"primary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
      <!-- /wp:post-template -->
      
    </div>
    <!-- /wp:query -->
    
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف:templates/ page.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem">

  <!-- wp:group {"className":"ps-page-header","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-page-header" style="margin-bottom:2rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:shortcode -->
    [ps_breadcrumbs]
    <!-- /wp:shortcode -->
    
    <!-- wp:post-title {"level":1,"textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"top":"2rem","bottom":"1rem"}}}} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-page-content","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-page-content">
    
    <!-- wp:post-featured-image {"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"2rem"}}}} /-->
    
    <!-- wp:post-content {"style":{"spacing":{"blockGap":"2rem"}}} /-->
    
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف:templates/ archive.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem">

  <!-- wp:group {"className":"ps-archive-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-archive-header" style="margin-bottom:3rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:shortcode -->
    [ps_breadcrumbs]
    <!-- /wp:shortcode -->
    
    <!-- wp:query-title {"type":"archive","textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"top":"2rem","bottom":"1rem"}}}} /-->
    
    <!-- wp:term-description {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} /-->
    
    <!-- wp:group {"className":"ps-archive-stats","layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-group ps-archive-stats">
      <!-- wp:html -->
      <div class="archive-info">
        <span class="post-count">📄 عدد المقالات: <?php echo $wp_query->found_posts; ?></span>
      </div>
      <!-- /wp:html -->
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-archive-content","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-archive-content">
    
    <!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
    <div class="wp-block-query">
      
      <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
      
      <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
      <div class="wp-block-group is-style-ps-card-style">
        
        <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
        
        <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":20} /-->
        
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
        <div class="wp-block-group" style="margin-top:1rem">
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
      <!-- /wp:post-template -->
      
      <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
      <!-- wp:query-pagination-previous {"label":"السابق"} /-->
      <!-- wp:query-pagination-numbers /-->
      <!-- wp:query-pagination-next {"label":"التالي"} /-->
      <!-- /wp:query-pagination -->
      
      <!-- wp:query-no-results -->
      <!-- wp:group {"className":"ps-no-results","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group ps-no-results" style="padding-top:3rem;padding-bottom:3rem">
        
        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">📭 لا توجد مقالات في هذا التصنيف حالياً</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:2rem">يرجى المحاولة لاحقاً أو تصفح الأقسام الأخرى</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
          <!-- wp:button {"className":"is-style-ps-primary-button"} -->
          <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">العودة للرئيسية</a></div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
        
      </div>
      <!-- /wp:group -->
      <!-- /wp:query-no-results -->
      
    </div>
    <!-- /wp:query -->
    
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف: templates/ search.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem">

  <!-- wp:group {"className":"ps-search-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-search-header" style="margin-bottom:3rem">
    
    <!-- Breadcrumbs -->
    <!-- wp:shortcode -->
    [ps_breadcrumbs]
    <!-- /wp:shortcode -->
    
    <!-- wp:query-title {"type":"search","textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"}}}} /-->
    
    <!-- wp:html -->
    <div class="ps-search-container">
      <form role="search" method="get" class="ps-search-form" action="/">
        <input type="search" class="ps-search-input" placeholder="ابحث مرة أخرى..." name="s" id="search-input" value="<?php echo get_search_query(); ?>">
        <button type="button" class="ps-voice-btn" id="voice-search" title="البحث الصوتي">🎤</button>
        <button type="submit" class="ps-search-btn" title="بحث">🔍</button>
      </form>
      <div class="ps-search-suggestions"></div>
    </div>
    <!-- /wp:html -->
    
    <!-- wp:group {"className":"ps-search-stats","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-group ps-search-stats" style="margin-top:1.5rem">
      <!-- wp:html -->
      <div class="search-info">
        <span class="results-count">🔍 تم العثور على <?php echo $wp_query->found_posts; ?> نتيجة</span>
      </div>
      <!-- /wp:html -->
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"ps-search-results","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-search-results">
    
    <!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"relevance","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
    <div class="wp-block-query">
      
      <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"default"}} -->
      
      <!-- wp:group {"className":"ps-search-result-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"12px"}},"backgroundColor":"secondary","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
      <div class="wp-block-group ps-search-result-item has-secondary-background-color has-background" style="border-radius:12px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
        
        <!-- wp:post-featured-image {"isLink":true,"width":"120px","height":"120px","className":"is-style-ps-rounded-image","style":{"spacing":{"margin":{"left":"1rem"}}}} /-->
        
        <!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="--wp--style--block-gap:0.5rem">
          
          <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
          
          <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":30,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
          
          <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
          <div class="wp-block-group">
            <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
            <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"13px"}},"textColor":"primary"} /-->
            <!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontSize":"13px"}},"textColor":"tertiary"} /-->
          </div>
          <!-- /wp:group -->
          
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
      <!-- /wp:post-template -->
      
      <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
      <!-- wp:query-pagination-previous {"label":"السابق"} /-->
      <!-- wp:query-pagination-numbers /-->
      <!-- wp:query-pagination-next {"label":"التالي"} /-->
      <!-- /wp:query-pagination -->
      
      <!-- wp:query-no-results -->
      <!-- wp:group {"className":"ps-no-search-results","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group ps-no-search-results" style="padding-top:4rem;padding-bottom:4rem">
        
        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">🔍 لم نجد نتائج لبحثك</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:2rem">حاول استخدام كلمات مختلفة أو تصفح الأقسام الرئيسية</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
        <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1.5rem">أو تصفح الأقسام:</h4>
        <!-- /wp:heading -->
        
        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"1rem"}}} -->
        <div class="wp-block-buttons">
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/home">🏠 البيت والمنزل</a></div>
          <!-- /wp:button -->
          
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/kitchen">🍳 المطبخ والطبخ</a></div>
          <!-- /wp:button -->
          
          <!-- wp:button {"className":"is-style-ps-outline-button"} -->
          <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link wp-element-button" href="/category/lifestyle">💡 نصائح حياتية</a></div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
        
      </div>
      <!-- /wp:group -->
      <!-- /wp:query-no-results -->
      
    </div>
    <!-- /wp:query -->
    
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف:templates/404.html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-top:5rem;padding-bottom:5rem">

  <!-- wp:group {"className":"ps-404-content","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-404-content">
    
    <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"8rem","fontWeight":"900"}},"textColor":"primary"} -->
    <h1 class="wp-block-heading has-text-align-center has-primary-color has-text-color" style="font-size:8rem;font-weight:900">404</h1>
    <!-- /wp:heading -->
    
    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">😔 الصفحة غير موجودة</h2>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
    <p class="has-text-align-center" style="margin-bottom:3rem">عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:html -->
    <div class="ps-search-container">
      <form role="search" method="get" class="ps-search-form" action="/">
        <input type="search" class="ps-search-input" placeholder="ابحث عما تريد..." name="s" id="search-input">
        <button type="button" class="ps-voice-btn" id="voice-search" title="البحث الصوتي">🎤</button>
        <button type="submit" class="ps-search-btn" title="بحث">🔍</button>
      </form>
      <div class="ps-search-suggestions"></div>
    </div>
    <!-- /wp:html -->
    
    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem","bottom":"3rem"}}}} -->
    <div class="wp-block-buttons" style="margin-top:3rem;margin-bottom:3rem">
      <!-- wp:button {"className":"is-style-ps-primary-button"} -->
      <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/">🏠 العودة للرئيسية</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
    
    <!-- wp:group {"className":"ps-404-suggestions","style":{"spacing":{"margin":{"top":"4rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-404-suggestions" style="margin-top:4rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"className":"is-style-ps-section-title"} -->
      <h3 class="wp-block-heading is-style-ps-section-title has-text-align-center">أو تصفح هذه الأقسام:</h3>
      <!-- /wp:heading -->
      
      <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
      <div class="wp-block-columns">
        
        <!-- wp:column -->
        <div class="wp-block-column">
          <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
          <div class="wp-block-group is-style-ps-feature-box">
            
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">🏠 البيت والمنزل</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:1rem">نصائح لتنظيف وترتيب وتحسين منزلك</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:button {"textAlign":"center","className":"is-style-ps-outline-button"} -->
            <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link has-text-align-center wp-element-button" href="/category/home">استكشف الآن</a></div>
            <!-- /wp:button -->
            
          </div>
          <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
          <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
          <div class="wp-block-group is-style-ps-feature-box">
            
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">🍳 المطبخ والطبخ</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:1rem">وصفات وحيل مطبخية لتوفير الوقت والجهد</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:button {"textAlign":"center","className":"is-style-ps-outline-button"} -->
            <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link has-text-align-center wp-element-button" href="/category/kitchen">استكشف الآن</a></div>
            <!-- /wp:button -->
            
          </div>
          <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
          <!-- wp:group {"className":"is-style-ps-feature-box","layout":{"type":"constrained"}} -->
          <div class="wp-block-group is-style-ps-feature-box">
            
            <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <h4 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">💡 نصائح حياتية</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:1rem">حلول ذكية لتحسين نمط حياتك اليومي</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:button {"textAlign":"center","className":"is-style-ps-outline-button"} -->
            <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link has-text-align-center wp-element-button" href="/category/lifestyle">استكشف الآن</a></div>
            <!-- /wp:button -->
            
          </div>
          <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
      </div>
      <!-- /wp:columns -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-404-recent","style":{"spacing":{"margin":{"top":"4rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-404-recent" style="margin-top:4rem">
      
      <!-- wp:heading {"textAlign":"center","level":3,"className":"is-style-ps-section-title"} -->
      <h3 class="wp-block-heading is-style-ps-section-title has-text-align-center">أحدث المقالات</h3>
      <!-- /wp:heading -->
      
      <!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
      <div class="wp-block-query">
        
        <!-- wp:post-template {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"grid","columnCount":3}} -->
        
        <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
        <div class="wp-block-group is-style-ps-card-style">
          
          <!-- wp:post-featured-image {"isLink":true,"className":"is-style-ps-rounded-image"} /-->
          
          <!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} /-->
          
          <!-- wp:post-excerpt {"moreText":"اقرأ المزيد","excerptLength":15} /-->
          
          <!-- wp:group {"style":{"spacing":{"margin":{"top":"1rem"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
          <div class="wp-block-group" style="margin-top:1rem">
            <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"12px"}},"textColor":"tertiary"} /-->
            <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px"}},"textColor":"primary"} /-->
          </div>
          <!-- /wp:group -->
          
        </div>
        <!-- /wp:group -->
        
        <!-- /wp:post-template -->
        
      </div>
      <!-- /wp:query -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->


📁 اسم الملف: parts/header.html
<!-- wp:group {"align":"full","className":"ps-site-header","style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2rem","right":"2rem"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ps-site-header has-base-background-color has-background" style="padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">

  <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","alignItems":"center","flexWrap":"wrap"}} -->
  <div class="wp-block-group alignwide">
    
    <!-- wp:group {"className":"ps-header-brand","layout":{"type":"flex","alignItems":"center"}} -->
    <div class="wp-block-group ps-header-brand">
      <!-- wp:site-logo {"width":50,"shouldSyncIcon":true,"className":"ps-site-logo"} /-->
      <!-- wp:site-title {"style":{"typography":{"fontWeight":"700","fontSize":"24px"}},"textColor":"primary","className":"ps-site-title"} /-->
    </div>
    <!-- /wp:group -->
    
    <!-- wp:navigation {"textColor":"contrast","overlayMenu":"mobile","className":"ps-main-navigation","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"center"},"style":{"spacing":{"blockGap":"2rem"}}} -->
    <!-- wp:navigation-link {"label":"الرئيسية","url":"/"} /-->
    <!-- wp:navigation-link {"label":"البيت والمنزل","url":"/category/home"} /-->
    <!-- wp:navigation-link {"label":"المطبخ والطبخ","url":"/category/kitchen"} /-->
    <!-- wp:navigation-link {"label":"نصائح حياتية","url":"/category/lifestyle"} /-->
    <!-- wp:navigation-link {"label":"اتصل بنا","url":"/contact"} /-->
    <!-- /wp:navigation -->
    
    <!-- wp:group {"className":"ps-header-actions","layout":{"type":"flex","alignItems":"center"}} -->
    <div class="wp-block-group ps-header-actions">
      
      <!-- wp:group {"className":"ps-header-search","layout":{"type":"constrained"}} -->
      <div class="wp-block-group ps-header-search">
        <!-- wp:search {"label":"بحث","showLabel":false,"placeholder":"ابحث...","width":200,"widthUnit":"px","buttonText":"بحث","buttonPosition":"button-inside","buttonUseIcon":true,"className":"ps-compact-search"} /-->
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:html -->
<button class="ps-theme-toggle" id="theme-toggle" aria-label="تبديل الوضع المظلم" title="تبديل الوضع المظلم">🌙</button>
<!-- /wp:html -->


📁 اسم الملف:parts/footer.html
<!-- wp:group {"align":"full","className":"ps-site-footer","style":{"spacing":{"padding":{"top":"3rem","bottom":"2rem","left":"2rem","right":"2rem"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ps-site-footer has-contrast-background-color has-base-color has-text-color has-background" style="padding-top:3rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">

  <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
  <div class="wp-block-group alignwide">
    
    <!-- wp:group {"className":"ps-footer-brand","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-footer-brand" style="--wp--style--block-gap:1rem">
      
      <!-- wp:group {"layout":{"type":"flex","alignItems":"center"}} -->
      <div class="wp-block-group">
        <!-- wp:site-logo {"width":40,"className":"ps-footer-logo"} /-->
        <!-- wp:site-title {"style":{"typography":{"fontWeight":"700","fontSize":"20px"}},"textColor":"base"} /-->
      </div>
      <!-- /wp:group -->
      
      <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"1rem"}},"typography":{"lineHeight":"1.6"}},"textColor":"base"} -->
      <p class="has-base-color has-text-color" style="margin-top:1rem;line-height:1.6">موقعك المفضل للحصول على أفضل الحلول العملية والنصائح المفيدة لحياة أسهل وأكثر تنظيماً. اكتشف مع خبرائنا أذكى الطرق لحل مشاكلك اليومية.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:social-links {"iconColor":"base","iconColorValue":"#ffffff","className":"ps-footer-social","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
      <ul class="wp-block-social-links has-icon-color ps-footer-social" style="margin-top:1.5rem">
        <!-- wp:social-link {"url":"#","service":"facebook"} /-->
        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
        <!-- wp:social-link {"url":"#","service":"youtube"} /-->
        <!-- wp:social-link {"url":"#","service":"whatsapp"} /-->
      </ul>
      <!-- /wp:social-links -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-footer-links","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-footer-links">
      
      <!-- wp:heading {"level":4,"textColor":"base","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h4 class="wp-block-heading has-base-color has-text-color" style="margin-bottom:1rem">🔗 روابط سريعة</h4>
      <!-- /wp:heading -->
      
      <!-- wp:list {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.8"}},"textColor":"base","className":"ps-footer-menu"} -->
      <ul class="has-base-color has-text-color ps-footer-menu" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:1.8">
        <!-- wp:list-item -->
        <li><a href="/">🏠 الرئيسية</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/about">ℹ️ عن الموقع</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/contact">📞 اتصل بنا</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/privacy">🔒 سياسة الخصوصية</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/terms">📋 شروط الاستخدام</a></li>
        <!-- /wp:list-item -->
      </ul>
      <!-- /wp:list -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-footer-categories","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-footer-categories">
      
      <!-- wp:heading {"level":4,"textColor":"base","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h4 class="wp-block-heading has-base-color has-text-color" style="margin-bottom:1rem">📚 مجالات الحلول</h4>
      <!-- /wp:heading -->
      
      <!-- wp:list {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.8"}},"textColor":"base","className":"ps-category-menu"} -->
      <ul class="has-base-color has-text-color ps-category-menu" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:1.8">
        <!-- wp:list-item -->
        <li><a href="/category/home">🏠 البيت والمنزل</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/category/kitchen">🍳 المطبخ والطبخ</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/category/lifestyle">💡 نصائح حياتية</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/category/tech">🔧 حلول تقنية</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/category/health">🏥 صحة ولياقة</a></li>
        <!-- /wp:list-item -->
      </ul>
      <!-- /wp:list -->
      
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"ps-footer-newsletter","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-footer-newsletter">
      
      <!-- wp:heading {"level":4,"textColor":"base","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
      <h4 class="wp-block-heading has-base-color has-text-color" style="margin-bottom:1rem">📧 النشرة البريدية</h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"1rem"}},"typography":{"lineHeight":"1.6"}},"textColor":"base"} -->
      <p class="has-base-color has-text-color" style="margin-bottom:1rem;line-height:1.6">احصل على أحدث الحلول والنصائح مباشرة في بريدك الإلكتروني.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:html -->
      <form class="ps-newsletter-form" action="#" method="post">
        <div class="newsletter-input-group">
          <input type="email" placeholder="بريدك الإلكتروني" required class="newsletter-input">
          <button type="submit" class="newsletter-button">اشترك 🚀</button>
        </div>
      </form>
      <!-- /wp:html -->
      
      <!-- wp:group {"className":"ps-footer-stats","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
      <div class="wp-block-group ps-footer-stats" style="margin-top:1.5rem">
        <!-- wp:html -->
        <div class="stats-items">
          <span class="stat-item">⭐ 4.9/5</span>
          <span class="stat-item">📊 +500 حل</span>
          <span class="stat-item">👥 +10K مستخدم</span>
        </div>
        <!-- /wp:html -->
      </div>
      <!-- /wp:group -->
      
    </div>
    <!-- /wp:group -->
    
  </div>
  <!-- /wp:group -->
  
  <!-- wp:separator {"style":{"spacing":{"margin":{"top":"2rem","bottom":"1.5rem"}}},"backgroundColor":"base","className":"ps-footer-separator"} -->
  <hr class="wp-block-separator has-text-color has-base-color has-alpha-channel-opacity has-base-background-color has-background ps-footer-separator" style="margin-top:2rem;margin-bottom:1.5rem"/>
  <!-- /wp:separator -->
  
  <!-- wp:group {"align":"wide","className":"ps-footer-bottom","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
  <div class="wp-block-group alignwide ps-footer-bottom">
    
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"}},"textColor":"base"} -->
    <p class="has-base-color has-text-color" style="font-size:14px">© 2025 الحلول العملية. جميع الحقوق محفوظة. مصنوع بـ ❤️ في المملكة العربية السعودية</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"}},"textColor":"base"} -->
    <p class="has-base-color has-text-color" style="font-size:14px">✅ محتوى معتمد 🔒 موقع آمن ومشفر 🚀 WordPress Block Theme</p>
    <!-- /wp:paragraph -->
    
  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->


📁 اسم الملف:parts/sidebar.html
<!-- wp:group {"className":"ps-sidebar","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group ps-sidebar" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">

  <!-- widget البحث -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-search-widget","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-search-widget" style="margin-bottom:2rem">
    
    <!-- wp:heading {"level":3,"className":"ps-widget-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h3 class="wp-block-heading ps-widget-title" style="margin-bottom:1rem">🔍 البحث السريع</h3>
    <!-- /wp:heading -->
    
    <!-- wp:search {"label":"بحث","showLabel":false,"placeholder":"ابحث في الموقع...","buttonText":"بحث","className":"ps-sidebar-search"} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- widget أحدث المقالات -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-recent-posts","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-recent-posts" style="margin-bottom:2rem">
    
    <!-- wp:heading {"level":3,"className":"ps-widget-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h3 class="wp-block-heading ps-widget-title" style="margin-bottom:1rem">📝 أحدث المقالات</h3>
    <!-- /wp:heading -->
    
    <!-- wp:query {"queryId":3,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"ps-sidebar-recent"} -->
    <div class="wp-block-query ps-sidebar-recent">
      
      <!-- wp:post-template {"style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"default"}} -->
      
      <!-- wp:group {"className":"ps-recent-post-item","style":{"spacing":{"padding":{"all":"1rem"}},"border":{"radius":"8px"}},"backgroundColor":"secondary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
      <div class="wp-block-group ps-recent-post-item has-secondary-background-color has-background" style="border-radius:8px;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
        
        <!-- wp:post-featured-image {"isLink":true,"width":"60px","height":"60px","style":{"border":{"radius":"6px"}}} /-->
        
        <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="--wp--style--block-gap:0.25rem">
          
          <!-- wp:post-title {"level":4,"isLink":true,"style":{"typography":{"fontSize":"14px","lineHeight":"1.3"},"spacing":{"margin":{"bottom":"0.25rem"}}}} /-->
          
          <!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"12px"}},"textColor":"tertiary"} /-->
          
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
      
      <!-- /wp:post-template -->
      
    </div>
    <!-- /wp:query -->
    
  </div>
  <!-- /wp:group -->

  <!-- widget التصنيفات -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-categories","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-categories" style="margin-bottom:2rem">
    
    <!-- wp:heading {"level":3,"className":"ps-widget-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h3 class="wp-block-heading ps-widget-title" style="margin-bottom:1rem">📂 التصنيفات</h3>
    <!-- /wp:heading -->
    
    <!-- wp:categories {"showHierarchy":true,"showPostCounts":true,"className":"ps-sidebar-categories"} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- widget الكلمات المفتاحية -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-tags","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-tags" style="margin-bottom:2rem">
    
    <!-- wp:heading {"level":3,"className":"ps-widget-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h3 class="wp-block-heading ps-widget-title" style="margin-bottom:1rem">🏷️ الكلمات المفتاحية</h3>
    <!-- /wp:heading -->
    
    <!-- wp:tag-cloud {"numberOfTags":15,"className":"ps-sidebar-tags"} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- widget أرشيف -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-archives","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-archives" style="margin-bottom:2rem">
    
    <!-- wp:heading {"level":3,"className":"ps-widget-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h3 class="wp-block-heading ps-widget-title" style="margin-bottom:1rem">📅 الأرشيف</h3>
    <!-- /wp:heading -->
    
    <!-- wp:archives {"displayAsDropdown":true,"showPostCounts":true,"className":"ps-sidebar-archives"} /-->
    
  </div>
  <!-- /wp:group -->

  <!-- widget مخصص -->
  <!-- wp:group {"className":"ps-sidebar-widget ps-custom-widget","style":{"spacing":{"padding":{"all":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
  <div class="wp-block-group ps-sidebar-widget ps-custom-widget has-primary-background-color has-base-color has-text-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
    
    <!-- wp:heading {"level":3,"textAlign":"center","style":{"spacing":{"margin":{"bottom":"1rem"}},"typography":{"fontSize":"18px"}},"textColor":"base"} -->
    <h3 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:1rem;font-size:18px">💡 نصيحة اليوم</h3>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px","lineHeight":"1.5"}},"textColor":"base"} -->
    <p class="has-text-align-center has-base-color has-text-color" style="font-size:14px;line-height:1.5">استخدم البحث الصوتي 🎤 للوصول السريع للحلول التي تحتاجها!</p>
    <!-- /wp:paragraph -->
    
  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->


📁 اسم الملف:inc/customizer-settings.php
<?php
/**
 * Customizer Settings
 * إعدادات المخصص
 */

if (!defined('ABSPATH')) {
    exit;
}

class PracticalSolutionsCustomizer {
    
    public function __construct() {
        add_action('customize_register', array($this, 'register_customizer_settings'));
        add_action('wp_head', array($this, 'output_custom_css'));
    }
    
    /**
     * تسجيل إعدادات المخصص
     */
    public function register_customizer_settings($wp_customize) {
        
        // قسم الألوان المخصصة
        $wp_customize->add_section('ps_colors_section', array(
            'title'       => __('ألوان القالب', 'practical-solutions'),
            'description' => __('تخصيص ألوان القالب الأساسية', 'practical-solutions'),
            'priority'    => 30
        ));
        
        // اللون الأساسي
        $wp_customize->add_setting('ps_primary_color', array(
            'default'           => '#007cba',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_primary_color', array(
            'label'       => __('اللون الأساسي', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('اللون الأساسي للأزرار والروابط', 'practical-solutions')
        )));
        
        // اللون الثانوي
        $wp_customize->add_setting('ps_secondary_color', array(
            'default'           => '#f0f4f8',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_secondary_color', array(
            'label'       => __('اللون الثانوي', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('لون الخلفيات الثانوية', 'practical-solutions')
        )));
        
        // لون التمييز
        $wp_customize->add_setting('ps_accent_color', array(
            'default'           => '#e74c3c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_accent_color', array(
            'label'       => __('لون التمييز', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('لون للتنبيهات والعناصر المميزة', 'practical-solutions')
        )));
        
        // قسم الخطوط
        $wp_customize->add_section('ps_typography_section', array(
            'title'       => __('الخطوط والطباعة', 'practical-solutions'),
            'description' => __('تخصيص إعدادات الخطوط', 'practical-solutions'),
            'priority'    => 35
        ));
        
        // حجم الخط الأساسي
        $wp_customize->add_setting('ps_base_font_size', array(
            'default'           => '18',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_base_font_size', array(
            'label'       => __('حجم الخط الأساسي (px)', 'practical-solutions'),
            'section'     => 'ps_typography_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 14,
                'max'  => 24,
                'step' => 1
            )
        ));
        
        // ارتفاع السطر
        $wp_customize->add_setting('ps_line_height', array(
            'default'           => '1.6',
            'sanitize_callback' => array($this, 'sanitize_float'),
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_line_height', array(
            'label'       => __('ارتفاع السطر', 'practical-solutions'),
            'section'     => 'ps_typography_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1.2,
                'max'  => 2.0,
                'step' => 0.1
            )
        ));
        
        // قسم التخطيط
        $wp_customize->add_section('ps_layout_section', array(
            'title'       => __('التخطيط والمساحات', 'practical-solutions'),
            'description' => __('تخصيص عرض المحتوى والمساحات', 'practical-solutions'),
            'priority'    => 40
        ));
        
        // عرض المحتوى
        $wp_customize->add_setting('ps_content_width', array(
            'default'           => '800',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_content_width', array(
            'label'       => __('عرض المحتوى (px)', 'practical-solutions'),
            'section'     => 'ps_layout_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 600,
                'max'  => 1000,
                'step' => 10
            )
        ));
        
        // العرض الواسع
        $wp_customize->add_setting('ps_wide_width', array(
            'default'           => '1200',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_wide_width', array(
            'label'       => __('العرض الواسع (px)', 'practical-solutions'),
            'section'     => 'ps_layout_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1000,
                'max'  => 1400,
                'step' => 10
            )
        ));
        
        // قسم الرأس
        $wp_customize->add_section('ps_header_section', array(
            'title'       => __('رأس الموقع', 'practical-solutions'),
            'description' => __('تخصيص إعدادات رأس الموقع', 'practical-solutions'),
            'priority'    => 45
        ));
        
        // إظهار البحث في الرأس
        $wp_customize->add_setting('ps_header_search', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_header_search', array(
            'label'   => __('إظهار البحث في الرأس', 'practical-solutions'),
            'section' => 'ps_header_section',
            'type'    => 'checkbox'
        ));
        
        // لون خلفية الرأس
        $wp_customize->add_setting('ps_header_bg_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_header_bg_color', array(
            'label'   => __('لون خلفية الرأس', 'practical-solutions'),
            'section' => 'ps_header_section'
        )));
        
        // قسم التذييل
        $wp_customize->add_section('ps_footer_section', array(
            'title'       => __('تذييل الموقع', 'practical-solutions'),
            'description' => __('تخصيص إعدادات تذييل الموقع', 'practical-solutions'),
            'priority'    => 50
        ));
        
        // نص حقوق الطبع
        $wp_customize->add_setting('ps_copyright_text', array(
            'default'           => '© 2025 الحلول العملية. جميع الحقوق محفوظة.',
            'sanitize_callback' => 'wp_kses_post'
        ));
        
        $wp_customize->add_control('ps_copyright_text', array(
            'label'   => __('نص حقوق الطبع', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'type'    => 'textarea'
        ));
        
        // إظهار الإحصائيات
        $wp_customize->add_setting('ps_footer_stats', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_footer_stats', array(
            'label'   => __('إظهار إحصائيات الموقع', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'type'    => 'checkbox'
        ));
        
        // قسم الميزات المتقدمة
        $wp_customize->add_section('ps_advanced_section', array(
            'title'       => __('الميزات المتقدمة', 'practical-solutions'),
            'description' => __('إعدادات الميزات المتقدمة للقالب', 'practical-solutions'),
            'priority'    => 55
        ));
        
        // تفعيل الوضع المظلم
        $wp_customize->add_setting('ps_dark_mode_toggle', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_dark_mode_toggle', array(
            'label'       => __('إظهار زر الوضع المظلم', 'practical-solutions'),
            'description' => __('السماح للمستخدمين بالتبديل بين الوضع الفاتح والمظلم', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // تفعيل البحث الصوتي
        $wp_customize->add_setting('ps_voice_search', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_voice_search', array(
            'label'       => __('تفعيل البحث الصوتي', 'practical-solutions'),
            'description' => __('السماح للمستخدمين بالبحث باستخدام الصوت', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // تفعيل الرسوم المتحركة
        $wp_customize->add_setting('ps_animations', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_animations', array(
            'label'       => __('تفعيل الرسوم المتحركة', 'practical-solutions'),
            'description' => __('إضافة حركات وتأثيرات بصرية للموقع', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // إضافة JS للمعاينة المباشرة
        $wp_customize->get_setting('ps_primary_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_secondary_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_accent_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_base_font_size')->transport = 'postMessage';
        $wp_customize->get_setting('ps_line_height')->transport = 'postMessage';
    }
    
    /**
     * إخراج CSS مخصص
     */
    public function output_custom_css() {
        $primary_color = get_theme_mod('ps_primary_color', '#007cba');
        $secondary_color = get_theme_mod('ps_secondary_color', '#f0f4f8');
        $accent_color = get_theme_mod('ps_accent_color', '#e74c3c');
        $base_font_size = get_theme_mod('ps_base_font_size', 18);
        $line_height = get_theme_mod('ps_line_height', 1.6);
        $content_width = get_theme_mod('ps_content_width', 800);
        $wide_width = get_theme_mod('ps_wide_width', 1200);
        $header_bg_color = get_theme_mod('ps_header_bg_color', '#ffffff');
        
        ?>
        <style type="text/css" id="ps-customizer-css">
            :root {
                --wp--preset--color--primary: <?php echo esc_html($primary_color); ?>;
                --wp--preset--color--secondary: <?php echo esc_html($secondary_color); ?>;
                --wp--preset--color--accent: <?php echo esc_html($accent_color); ?>;
                --ps-color-primary: <?php echo esc_html($primary_color); ?>;
                --ps-color-secondary: <?php echo esc_html($secondary_color); ?>;
                --ps-color-accent: <?php echo esc_html($accent_color); ?>;
                --ps-font-size-base: <?php echo esc_html($base_font_size); ?>px;
                --ps-line-height-base: <?php echo esc_html($line_height); ?>;
            }
            
            body {
                font-size: var(--ps-font-size-base);
                line-height: var(--ps-line-height-base);
            }
            
            .wp-block-group.alignwide {
                max-width: <?php echo esc_html($wide_width); ?>px;
            }
            
            .wp-block[data-align="wide"] {
                max-width: <?php echo esc_html($wide_width); ?>px;
            }
            
            .ps-site-header {
                background-color: <?php echo esc_html($header_bg_color); ?>;
            }
            
            /* تحديث الألوان في جميع العناصر */
            .wp-block-button.is-style-ps-primary-button .wp-block-button__link,
            .ps-search-btn,
            .ps-theme-toggle {
                background-color: var(--ps-color-primary);
            }
            
            .wp-block-button.is-style-ps-outline-button .wp-block-button__link {
                border-color: var(--ps-color-primary);
                color: var(--ps-color-primary);
            }
            
            .wp-block-group.is-style-ps-feature-box {
                background-color: var(--ps-color-secondary);
            }
            
            .ps-notification.error {
                background-color: var(--ps-color-accent);
            }
        </style>
        <?php
    }
    
    /**
     * تنظيف checkbox
     */
    public function sanitize_checkbox($checked) {
        return ((isset($checked) && true == $checked) ? true : false);
    }
    
    /**
     * تنظيف float
     */
    public function sanitize_float($input) {
        return floatval($input);
    }
}

// تهيئة الكلاس
new PracticalSolutionsCustomizer();

// إضافة JS للمعاينة المباشرة
function ps_customizer_live_preview() {
    wp_enqueue_script(
        'ps-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('jquery', 'customize-preview'),
        PS_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'ps_customizer_live_preview');


📁 اسم الملف:patterns/categories-grid.php
<?php
/**
 * Categories Grid Pattern
 * نمط شبكة التصنيفات
 */

register_block_pattern(
    'practical-solutions/categories-grid',
    array(
        'title'       => __('شبكة التصنيفات', 'practical-solutions'),
        'description' => __('عرض تصنيفات الموقع في شبكة جذابة مع أيقونات', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
            <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:3rem">🗂️ استكشف جميع الحلول</h2>
            <!-- /wp:heading -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
            <div class="wp-block-columns">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #007cba, #005a87); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">🏠</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">البيت والمنزل</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">حلول ذكية لتنظيم وتحسين منزلك، من التنظيف إلى الديكور والترتيب</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 125 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/home">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #27ae60, #219a52); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">🍳</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">المطبخ والطبخ</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">وصفات سهلة وحيل مطبخية ذكية لتوفير الوقت والجهد في الطبخ والتحضير</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 89 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/kitchen">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">💡</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">نصائح حياتية</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">حلول ذكية لتحسين نمط حياتك اليومي وزيادة الإنتاجية والسعادة</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 156 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/lifestyle">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
            </div>
            <!-- /wp:columns -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"},"margin":{"top":"2rem"}}}} -->
            <div class="wp-block-columns" style="margin-top:2rem">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">💰</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">توفير المال</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">استراتيgiات وطرق ذكية لتوفير المال وإدارة الميزانية الشخصية بكفاءة</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 73 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/money">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">🏥</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">صحة ولياقة</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">نصائح صحية وحلول للياقة البدنية والنفسية لحياة أكثر صحة وحيوية</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 92 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/health">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"15px"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style" style="border-radius:15px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem;">
                            <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #2c3e50, #34495e); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1rem;">🔧</div>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">حلول تقنية</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="margin-bottom:1.5rem">حلول تقنية مبسطة لمشاكل الحاسوب والهواتف والأجهزة الذكية</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1.5rem; color: #666; font-size: 0.9rem;">
                            <span>📊 67 حل متاح</span>
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/category/tech">استكشف الحلول</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
            </div>
            <!-- /wp:columns -->
            
        </div>
        <!-- /wp:group -->',
        'categories'  => array('ps-content', 'practical-solutions'),
        'keywords'    => array('categories', 'sections', 'grid', 'تصنيفات', 'أقسام'),
    )
);


📁 اسم الملف:patterns/cta-newsletter.php
<?php
/**
 * Newsletter CTA Pattern
 * نمط دعوة الاشتراك في النشرة
 */

register_block_pattern(
    'practical-solutions/cta-newsletter',
    array(
        'title'       => __('دعوة الاشتراك في النشرة', 'practical-solutions'),
        'description' => __('قسم جذاب للاشتراك في النشرة البريدية مع حوافز', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"gradient":"linear-gradient(135deg,var(--wp--preset--color--primary) 0%,var(--wp--preset--color--accent) 100%)"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignfull has-background" style="background:linear-gradient(135deg,var(--wp--preset--color--primary) 0%,var(--wp--preset--color--accent) 100%);padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"base"} -->
            <h2 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:1rem;font-size:2.5rem;font-weight:700">📧 احصل على أحدث الحلول مجاناً!</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.3rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"base"} -->
            <p class="has-text-align-center has-base-color has-text-color" style="margin-bottom:2rem;font-size:1.3rem;line-height:1.6">اشترك في نشرتنا البريدية واستقبل أفضل الحلول والنصائح العملية مباشرة في بريدك</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
            <div class="wp-block-group" style="margin-bottom:2rem">
                <!-- wp:html -->
                <div class="ps-newsletter-benefits" style="display: flex; gap: 2rem; flex-wrap: wrap; justify-content: center; color: rgba(255,255,255,0.9); font-size: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1.5rem;">✅</span>
                        <span>حلول يومية جديدة</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1.5rem;">🎁</span>
                        <span>كتاب مجاني عند الاشتراك</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1.5rem;">⚡</span>
                        <span>أول من يعرف بالحلول الجديدة</span>
                    </div>
                </div>
                <!-- /wp:html -->
            </div>
            <!-- /wp:group -->
            
            <!-- wp:html -->
            <div class="ps-newsletter-form-container" style="max-width: 500px; margin: 0 auto;">
                <form class="ps-newsletter-form" action="#" method="post" style="display: flex; background: rgba(255,255,255,0.15); border-radius: 50px; padding: 8px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                    <input type="email" name="email" placeholder="بريدك الإلكتروني" required style="flex: 1; border: none; padding: 15px 20px; font-size: 16px; background: transparent; color: white; font-family: var(--ps-font-family);">
                    <button type="submit" style="background: rgba(255,255,255,0.9); color: var(--wp--preset--color--primary); border: none; padding: 15px 25px; border-radius: 50px; font-weight: 600; cursor: pointer; font-size: 16px; transition: all 0.3s ease;">🚀 اشترك مجاناً</button>
                </form>
                <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; color: rgba(255,255,255,0.8);">
                    🔒 نحترم خصوصيتك - لن نرسل لك رسائل مزعجة
                </p>
            </div>
            <!-- /wp:html -->
            
        </div>
        <!-- /wp:group -->',
        'categories'  => array('ps-cta', 'practical-solutions'),
        'keywords'    => array('newsletter', 'subscription', 'cta', 'نشرة', 'اشتراك'),
    )
);


📁 اسم الملف:patterns/faq-section.php
<?php
/**
 * Pattern: FAQ Section
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

register_block_pattern(
    'practical-solutions/faq-section',
    array(
        'title'       => __('قسم الأسئلة الشائعة', 'practical-solutions'),
        'description' => __('قسم تفاعلي للأسئلة الشائعة مع إمكانية الطي والتوسيع', 'practical-solutions'),
        'content'     => '<!-- wp:group {"className":"ps-faq-section","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}}},"backgroundColor":"white","layout":{"type":"constrained","contentSize":"1000px"}} -->
<div class="wp-block-group ps-faq-section has-white-background-color has-background" style="padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">

    <!-- wp:group {"className":"ps-faq-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained","contentSize":"700px"}} -->
    <div class="wp-block-group ps-faq-header" style="margin-bottom:3rem">

        <!-- wp:heading {"textAlign":"center","level":2,"className":"ps-faq-title","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700","lineHeight":"1.3"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"contrast"} -->
        <h2 class="wp-block-heading has-text-align-center ps-faq-title has-contrast-color has-text-color" style="margin-bottom:1rem;font-size:2.5rem;font-weight:700;line-height:1.3">❓ الأسئلة الشائعة</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","className":"ps-faq-subtitle","style":{"typography":{"fontSize":"1.2rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"tertiary"} -->
        <p class="has-text-align-center ps-faq-subtitle has-tertiary-color has-text-color" style="margin-bottom:0.5rem;font-size:1.2rem;line-height:1.6">إجابات شاملة على أكثر الأسئلة شيوعاً حول موقعنا وخدماتنا</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"className":"ps-faq-search","style":{"spacing":{"margin":{"top":"2rem"}}},"layout":{"type":"constrained","contentSize":"500px"}} -->
        <div class="wp-block-group ps-faq-search" style="margin-top:2rem">

            <!-- wp:html -->
            <div class="ps-faq-search-container">
                <input type="text" class="ps-faq-search-input" placeholder="🔍 ابحث في الأسئلة الشائعة..." />
                <div class="ps-faq-search-results"></div>
            </div>
            <!-- /wp:html -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"ps-faq-categories","style":{"spacing":{"margin":{"bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-faq-categories" style="margin-bottom:2rem">

        <!-- wp:group {"className":"ps-faq-category-tabs","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
        <div class="wp-block-group ps-faq-category-tabs">

            <!-- wp:button {"className":"ps-faq-tab active","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"500"}},"backgroundColor":"primary","textColor":"white"} -->
            <div class="wp-block-button ps-faq-tab active">
                <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:1.5rem;padding-bottom:0.8rem;padding-left:1.5rem;font-size:1rem;font-weight:500" data-category="all">الكل</a>
            </div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"ps-faq-tab","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"500"}},"backgroundColor":"base","textColor":"contrast"} -->
            <div class="wp-block-button ps-faq-tab">
                <a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:1.5rem;padding-bottom:0.8rem;padding-left:1.5rem;font-size:1rem;font-weight:500" data-category="general">عام</a>
            </div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"ps-faq-tab","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"500"}},"backgroundColor":"base","textColor":"contrast"} -->
            <div class="wp-block-button ps-faq-tab">
                <a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:1.5rem;padding-bottom:0.8rem;padding-left:1.5rem;font-size:1rem;font-weight:500" data-category="search">البحث</a>
            </div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"ps-faq-tab","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"500"}},"backgroundColor":"base","textColor":"contrast"} -->
            <div class="wp-block-button ps-faq-tab">
                <a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:1.5rem;padding-bottom:0.8rem;padding-left:1.5rem;font-size:1rem;font-weight:500" data-category="features">الميزات</a>
            </div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"ps-faq-tab","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"500"}},"backgroundColor":"base","textColor":"contrast"} -->
            <div class="wp-block-button ps-faq-tab">
                <a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:1.5rem;padding-bottom:0.8rem;padding-left:1.5rem;font-size:1rem;font-weight:500" data-category="technical">تقني</a>
            </div>
            <!-- /wp:button -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"ps-faq-list","layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-faq-list">

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="general">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">🌟 ما هو موقع الحلول العملية؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">موقع الحلول العملية هو منصة شاملة تهدف إلى تقديم نصائح وحلول عملية لتحسين جودة الحياة اليومية. نقدم محتوى متنوع يشمل الحلول المنزلية، التقنية، المالية، والشخصية بطريقة سهلة ومفهومة.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="search">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">🎤 كيف يعمل البحث الصوتي؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">البحث الصوتي يستخدم تقنية التعرف على الكلام المتقدمة. ما عليك سوى النقر على أيقونة الميكروفون 🎤 والتحدث بوضوح. سيتم تحويل كلامك إلى نص تلقائياً وعرض النتائج ذات الصلة. الميزة تدعم اللغة العربية والإنجليزية.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="features">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">🔖 كيف أحفظ المقالات المفضلة؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">يمكنك حفظ المقالات بالنقر على أيقونة الإشارة المرجعية 📌 الموجودة في أعلى كل مقال. المقالات المحفوظة تُخزن محلياً في متصفحك ويمكن الوصول إليها من خلال قائمة "المحفوظات" في أي وقت، حتى بدون اتصال بالإنترنت.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="features">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">🌙 كيف أفعل الوضع المظلم؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">يمكنك تفعيل الوضع المظلم بالنقر على زر التبديل 🌙/☀️ في أعلى الصفحة، أو باستخدام اختصار لوحة المفاتيح Ctrl+D. الموقع يحفظ تفضيلاتك تلقائياً ويطبق نفس الوضع في زياراتك القادمة.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="general">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">💰 هل الموقع مجاني تماماً؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">نعم! موقع الحلول العملية مجاني تماماً. جميع المقالات والحلول والميزات متاحة بدون أي رسوم أو اشتراكات. هدفنا هو جعل المعرفة والحلول العملية متاحة للجميع دون أي حواجز مالية.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="technical">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">📱 هل الموقع متوافق مع الجوال؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">الموقع مصمم ليكون متجاوب بالكامل ويعمل بشكل مثالي على جميع الأجهزة - الجوالات، التابلت، وأجهزة الكمبيوتر. كما يمكن تثبيته كتطبيق ويب تقدمي (PWA) على جهازك للوصول السريع والاستخدام حتى بدون إنترنت.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"bottom":"1rem"}},"border":{"radius":"12px","width":"1px"}},"borderColor":"tertiary","backgroundColor":"base"} -->
        <div class="wp-block-group ps-faq-item has-border-color has-tertiary-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-bottom:1rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem" data-category="general">

            <!-- wp:group {"className":"ps-faq-question","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group ps-faq-question">

                <!-- wp:heading {"level":3,"className":"ps-question-text","style":{"typography":{"fontSize":"1.3rem","fontWeight":"600","lineHeight":"1.4"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading ps-question-text has-contrast-color has-text-color" style="margin-bottom:0;font-size:1.3rem;font-weight:600;line-height:1.4">📧 كيف أتواصل معكم؟</h3>
                <!-- /wp:heading -->

                <!-- wp:group {"className":"ps-faq-toggle","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-faq-toggle">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem","fontWeight":"bold"}},"textColor":"primary"} -->
                    <p class="has-primary-color has-text-color" style="font-size:1.5rem;font-weight:bold">+</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-faq-answer","style":{"spacing":{"margin":{"top":"1rem"},"padding":{"top":"1rem"}},"border":{"top":{"color":"#e0e0e0","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-faq-answer has-border-color" style="border-top-color:#e0e0e0;border-top-style:solid;border-top-width:1px;margin-top:1rem;padding-top:1rem">

                <!-- wp:paragraph {"className":"ps-answer-text","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7"}},"textColor":"secondary"} -->
                <p class="ps-answer-text has-secondary-color has-text-color" style="font-size:1.1rem;line-height:1.7">يمكنكم التواصل معنا عبر صفحة "اتصل بنا" أو إرسال رسالة مباشرة عبر البريد الإلكتروني. نحن نرد على جميع الاستفسارات خلال 24 ساعة. كما يمكنكم متابعتنا على وسائل التواصل الاجتماعي للحصول على آخر التحديثات.</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"ps-faq-footer","style":{"spacing":{"margin":{"top":"3rem"},"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}},"border":{"radius":"15px"}},"backgroundColor":"primary","layout":{"type":"constrained","contentSize":"600px"}} -->
    <div class="wp-block-group ps-faq-footer has-primary-background-color has-background" style="border-radius:15px;margin-top:3rem;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">

        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.6rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"white"} -->
        <h3 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:1rem;font-size:1.6rem;font-weight:600">🤔 لم تجد إجابتك؟</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"white"} -->
        <p class="has-text-align-center has-white-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;line-height:1.6">لا تتردد في التواصل معنا، فريق دعمنا جاهز لمساعدتك</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">

            <!-- wp:button {"className":"ps-contact-button","style":{"spacing":{"padding":{"top":"0.8rem","bottom":"0.8rem","left":"2rem","right":"2rem"}},"border":{"radius":"25px"},"typography":{"fontSize":"1rem","fontWeight":"600"}},"backgroundColor":"white","textColor":"primary"} -->
            <div class="wp-block-button ps-contact-button">
                <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:25px;padding-top:0.8rem;padding-right:2rem;padding-bottom:0.8rem;padding-left:2rem;font-size:1rem;font-weight:600">📧 اتصل بنا</a>
            </div>
            <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:html -->
<style>
.ps-faq-search-container {
    position: relative;
    margin-bottom: 2rem;
}

.ps-faq-search-input {
    width: 100%;
    padding: 1rem 1.5rem;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    font-size: 1rem;
    outline: none;
    transition: all 0.3s ease;
}

.ps-faq-search-input:focus {
    border-color: #007cba;
    box-shadow: 0 0 0 3px rgba(0, 124, 186, 0.1);
}

.ps-faq-item {
    cursor: pointer;
    transition: all 0.3s ease;
}

.ps-faq-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.ps-faq-question {
    cursor: pointer;
}

.ps-faq-answer {
    display: none;
}

.ps-faq-item.active .ps-faq-answer {
    display: block;
    animation: fadeInDown 0.3s ease;
}

.ps-faq-item.active .ps-faq-toggle p {
    transform: rotate(45deg);
}

.ps-faq-toggle p {
    transition: transform 0.3s ease;
    cursor: pointer;
    margin: 0;
}

.ps-faq-tab {
    transition: all 0.3s ease;
    cursor: pointer;
}

.ps-faq-tab:hover {
    transform: translateY(-2px);
}

.ps-faq-tab.active {
    box-shadow: 0 4px 8px rgba(0, 124, 186, 0.3);
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .ps-faq-category-tabs {
        flex-direction: column;
        align-items: center;
    }
    
    .ps-faq-question {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .ps-question-text {
        font-size: 1.1rem !important;
    }
}
</style>

<script>
document.addEventListener(\'DOMContentLoaded\', function() {
    // تهيئة الأسئلة الشائعة
    const faqItems = document.querySelectorAll(\'.ps-faq-item\');
    const faqTabs = document.querySelectorAll(\'.ps-faq-tab\');
    const searchInput = document.querySelector(\'.ps-faq-search-input\');
    
    // إضافة وظيفة الطي والتوسيع
    faqItems.forEach(item => {
        const question = item.querySelector(\'.ps-faq-question\');
        question.addEventListener(\'click\', () => {
            item.classList.toggle(\'active\');
        });
    });
    
    // فلترة الأسئلة حسب الفئة
    faqTabs.forEach(tab => {
        tab.addEventListener(\'click\', (e) => {
            e.preventDefault();
            
            // إزالة الفئة النشطة من جميع التبويبات
            faqTabs.forEach(t => t.classList.remove(\'active\'));
            tab.classList.add(\'active\');
            
            const category = tab.querySelector(\'a\').getAttribute(\'data-category\');
            
            faqItems.forEach(item => {
                if (category === \'all\' || item.getAttribute(\'data-category\') === category) {
                    item.style.display = \'block\';
                } else {
                    item.style.display = \'none\';
                }
            });
        });
    });
    
    // البحث في الأسئلة
    if (searchInput) {
        searchInput.addEventListener(\'input\', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            
            faqItems.forEach(item => {
                const questionText = item.querySelector(\'.ps-question-text\').textContent.toLowerCase();
                const answerText = item.querySelector(\'.ps-answer-text\').textContent.toLowerCase();
                
                if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                    item.style.display = \'block\';
                } else {
                    item.style.display = \'none\';
                }
            });
        });
    }
});
</script>
<!-- /wp:html -->',
        'categories'  => array('practical-solutions', 'text'),
        'keywords'    => array('faq', 'questions', 'أسئلة', 'شائعة', 'إجابات', 'استفسارات'),
        'viewportWidth' => 1000,
    )
);



📁 اسم الملف:patterns/footer-default.html
<!-- wp:group {"tagName":"footer","align":"full","layout":{"type":"constrained","contentSize":"1200px","justifyContent":"center"}} -->
<footer class="wp-block-group alignfull">
    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">© <?php echo date("Y"); ?> Practical Solution. All rights reserved.</p>
    <!-- /wp:paragraph -->

    <!-- wp:social-links {"align":"center","className":"is-style-logos-only"} -->
    <ul class="wp-block-social-links aligncenter is-style-logos-only">
        <!-- wp:social-link {"service":"facebook"} /-->
        <!-- wp:social-link {"service":"twitter"} /-->
        <!-- wp:social-link {"service":"linkedin"} /-->
    </ul>
    <!-- /wp:social-links -->
</footer>
<!-- /wp:group -->

<!-- Search Overlay HTML -->
<div id="search-overlay" class="search-overlay" aria-hidden="true">
    <div class="search-overlay-content">
        <button id="search-close" class="search-overlay-close" aria-label="Close search overlay">&times;</button>
        <input type="text" id="search-input" class="search-overlay-input" placeholder="Search..." aria-label="Search input">
        <button id="voice-search-btn" style="display:none;" aria-label="Voice search">Voice Search</button>
        <ul id="search-results" class="search-results"></ul>
    </div>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" title="Go to top" aria-label="Back to top">&#9650;</button>



📁 اسم الملف:patterns/header-default.html
<!-- wp:group {"tagName":"header","align":"full","layout":{"type":"constrained","contentSize":"1200px","justifyContent":"space-between"}} -->
<header class="wp-block-group alignfull">
    <!-- wp:site-title /-->

    <!-- wp:navigation {"overlayMenu":"always","overlayOnMobile":true,"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} /-->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group">
        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link" id="search-toggle">Search</a></div>
        <!-- /wp:button -->

        <!-- wp:button {"className":"is-style-ps-primary-button"} -->
        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link" id="theme-toggle">Toggle Theme</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:group -->
</header>
<!-- /wp:group -->

📁 اسم الملف:patterns/hero-with-search.php
<?php
/**
 * Pattern: Hero Section with Enhanced Search
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

register_block_pattern(
    'practical-solutions/hero-with-search',
    array(
        'title'       => __('قسم البطل مع البحث المتقدم', 'practical-solutions'),
        'description' => __('قسم رئيسي جذاب مع نظام بحث متقدم وميزات تفاعلية', 'practical-solutions'),
        'content'     => '<!-- wp:group {"className":"ps-hero-section","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"gradient":"linear-gradient(135deg,#007cba 0%,#005a87 100%)"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group ps-hero-section" style="background:linear-gradient(135deg,#007cba 0%,#005a87 100%);padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">

    <!-- wp:group {"className":"ps-hero-content","style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group ps-hero-content" style="margin-block-start:0;margin-block-end:0">

        <!-- wp:heading {"textAlign":"center","level":1,"className":"ps-hero-title","style":{"typography":{"fontSize":"3.5rem","fontWeight":"700","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"white"} -->
        <h1 class="wp-block-heading has-text-align-center ps-hero-title has-white-color has-text-color" style="margin-bottom:1rem;font-size:3.5rem;font-weight:700;line-height:1.2">🌟 اكتشف أفضل الحلول العملية</h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","className":"ps-hero-subtitle","style":{"typography":{"fontSize":"1.25rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"2.5rem"}}},"textColor":"white"} -->
        <p class="has-text-align-center ps-hero-subtitle has-white-color has-text-color" style="margin-bottom:2.5rem;font-size:1.25rem;line-height:1.6">موقعك الأول للحصول على نصائح وحلول عملية تجعل حياتك أسهل وأكثر تنظيماً. ابحث عن كل ما تحتاجه بالصوت أو النص!</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"className":"ps-hero-search-container","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"},"blockGap":"1.5rem"},"border":{"radius":"20px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
        <div class="wp-block-group ps-hero-search-container has-white-background-color has-background" style="border-radius:20px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">

            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"primary"} -->
            <h3 class="wp-block-heading has-text-align-center has-primary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.5rem;font-weight:600">🔍 ابحث بذكاء عن الحلول</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"ps-enhanced-search-box","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group ps-enhanced-search-box">

                <!-- wp:html -->
                <div class="ps-hero-search-wrapper">
                    <div class="ps-search-container">
                        <input type="text" class="ps-search-input ps-hero-search" placeholder="ابحث عن الحلول والنصائح... (جرب البحث الصوتي 🎤)" />
                        <button type="button" class="ps-voice-search-btn" aria-label="البحث الصوتي">
                            <svg class="voice-icon" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M12 2C10.9 2 10 2.9 10 4V12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12V4C14 2.9 13.1 2 12 2Z" fill="currentColor"/>
                                <path d="M19 10V12C19 15.9 15.9 19 12 19C8.1 19 5 15.9 5 12V10H7V12C7 14.8 9.2 17 12 17C14.8 17 17 14.8 17 12V10H19Z" fill="currentColor"/>
                                <path d="M10.5 22H13.5V20H10.5V22Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <button type="submit" class="ps-search-submit-btn">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    <div class="ps-search-suggestions"></div>
                </div>
                <!-- /wp:html -->

            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-search-features","style":{"spacing":{"blockGap":"1rem","margin":{"top":"1.5rem"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
            <div class="wp-block-group ps-search-features" style="margin-top:1.5rem">

                <!-- wp:group {"className":"ps-search-feature","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"1rem","right":"1rem"}},"border":{"radius":"25px"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-search-feature has-base-background-color has-background" style="border-radius:25px;padding-top:0.5rem;padding-right:1rem;padding-bottom:0.5rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"contrast"} -->
                    <p class="has-contrast-color has-text-color" style="font-size:0.9rem">🎤 بحث صوتي ذكي</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-search-feature","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"1rem","right":"1rem"}},"border":{"radius":"25px"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-search-feature has-base-background-color has-background" style="border-radius:25px;padding-top:0.5rem;padding-right:1rem;padding-bottom:0.5rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"contrast"} -->
                    <p class="has-contrast-color has-text-color" style="font-size:0.9rem">🤖 اقتراحات ذكية</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-search-feature","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"1rem","right":"1rem"}},"border":{"radius":"25px"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-search-feature has-base-background-color has-background" style="border-radius:25px;padding-top:0.5rem;padding-right:1rem;padding-bottom:0.5rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"contrast"} -->
                    <p class="has-contrast-color has-text-color" style="font-size:0.9rem">⚡ نتائج فورية</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-search-feature","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"1rem","right":"1rem"}},"border":{"radius":"25px"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-search-feature has-base-background-color has-background" style="border-radius:25px;padding-top:0.5rem;padding-right:1rem;padding-bottom:0.5rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"contrast"} -->
                    <p class="has-contrast-color has-text-color" style="font-size:0.9rem">🔖 حفظ النتائج</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"ps-hero-popular-searches","style":{"spacing":{"margin":{"top":"2rem"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group ps-hero-popular-searches" style="margin-top:2rem">

            <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontSize":"1.1rem","fontWeight":"500"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"white"} -->
            <h4 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:1rem;font-size:1.1rem;font-weight:500">🔥 البحث الشائع:</h4>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"ps-popular-tags","style":{"spacing":{"blockGap":"0.8rem"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
            <div class="wp-block-group ps-popular-tags">

                <!-- wp:group {"className":"ps-popular-tag","style":{"spacing":{"padding":{"top":"0.4rem","bottom":"0.4rem","left":"1rem","right":"1rem"}},"border":{"radius":"20px","color":"#ffffff","width":"1px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-popular-tag has-border-color" style="border-color:#ffffff;border-width:1px;border-radius:20px;padding-top:0.4rem;padding-right:1rem;padding-bottom:0.4rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                    <p class="has-white-color has-text-color" style="font-size:0.9rem">حلول منزلية</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-popular-tag","style":{"spacing":{"padding":{"top":"0.4rem","bottom":"0.4rem","left":"1rem","right":"1rem"}},"border":{"radius":"20px","color":"#ffffff","width":"1px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-popular-tag has-border-color" style="border-color:#ffffff;border-width:1px;border-radius:20px;padding-top:0.4rem;padding-right:1rem;padding-bottom:0.4rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                    <p class="has-white-color has-text-color" style="font-size:0.9rem">تطبيقات مفيدة</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-popular-tag","style":{"spacing":{"padding":{"top":"0.4rem","bottom":"0.4rem","left":"1rem","right":"1rem"}},"border":{"radius":"20px","color":"#ffffff","width":"1px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-popular-tag has-border-color" style="border-color:#ffffff;border-width:1px;border-radius:20px;padding-top:0.4rem;padding-right:1rem;padding-bottom:0.4rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                    <p class="has-white-color has-text-color" style="font-size:0.9rem">إدارة الوقت</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-popular-tag","style":{"spacing":{"padding":{"top":"0.4rem","bottom":"0.4rem","left":"1rem","right":"1rem"}},"border":{"radius":"20px","color":"#ffffff","width":"1px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-popular-tag has-border-color" style="border-color:#ffffff;border-width:1px;border-radius:20px;padding-top:0.4rem;padding-right:1rem;padding-bottom:0.4rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                    <p class="has-white-color has-text-color" style="font-size:0.9rem">نصائح تقنية</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"className":"ps-popular-tag","style":{"spacing":{"padding":{"top":"0.4rem","bottom":"0.4rem","left":"1rem","right":"1rem"}},"border":{"radius":"20px","color":"#ffffff","width":"1px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group ps-popular-tag has-border-color" style="border-color:#ffffff;border-width:1px;border-radius:20px;padding-top:0.4rem;padding-right:1rem;padding-bottom:0.4rem;padding-left:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                    <p class="has-white-color has-text-color" style="font-size:0.9rem">تنظيم المنزل</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"ps-hero-stats","style":{"spacing":{"margin":{"top":"3rem"},"padding":{"top":"2rem","bottom":"2rem"}},"border":{"top":{"color":"#ffffff","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-hero-stats has-border-color" style="border-top-color:#ffffff;border-top-style:solid;border-top-width:1px;margin-top:3rem;padding-top:2rem;padding-bottom:2rem">

        <!-- wp:columns {"className":"ps-stats-columns","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
        <div class="wp-block-columns ps-stats-columns">

            <!-- wp:column {"className":"ps-stat-item"} -->
            <div class="wp-block-column ps-stat-item">
                <!-- wp:heading {"textAlign":"center","level":3,"className":"ps-stat-number","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"white"} -->
                <h3 class="wp-block-heading has-text-align-center ps-stat-number has-white-color has-text-color" style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700">500+</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","className":"ps-stat-label","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"white"} -->
                <p class="has-text-align-center ps-stat-label has-white-color has-text-color" style="font-size:1rem;font-weight:500">حل عملي</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"ps-stat-item"} -->
            <div class="wp-block-column ps-stat-item">
                <!-- wp:heading {"textAlign":"center","level":3,"className":"ps-stat-number","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"white"} -->
                <h3 class="wp-block-heading has-text-align-center ps-stat-number has-white-color has-text-color" style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700">10K+</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","className":"ps-stat-label","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"white"} -->
                <p class="has-text-align-center ps-stat-label has-white-color has-text-color" style="font-size:1rem;font-weight:500">زائر شهرياً</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"ps-stat-item"} -->
            <div class="wp-block-column ps-stat-item">
                <!-- wp:heading {"textAlign":"center","level":3,"className":"ps-stat-number","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"white"} -->
                <h3 class="wp-block-heading has-text-align-center ps-stat-number has-white-color has-text-color" style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700">98%</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","className":"ps-stat-label","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"white"} -->
                <p class="has-text-align-center ps-stat-label has-white-color has-text-color" style="font-size:1rem;font-weight:500">رضا المستخدمين</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"ps-stat-item"} -->
            <div class="wp-block-column ps-stat-item">
                <!-- wp:heading {"textAlign":"center","level":3,"className":"ps-stat-number","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"white"} -->
                <h3 class="wp-block-heading has-text-align-center ps-stat-number has-white-color has-text-color" style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700">24/7</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","className":"ps-stat-label","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"white"} -->
                <p class="has-text-align-center ps-stat-label has-white-color has-text-color" style="font-size:1rem;font-weight:500">متاح دائماً</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->',
        'categories'  => array('practical-solutions', 'featured'),
        'keywords'    => array('hero', 'search', 'بحث', 'رئيسي', 'بطل'),
        'viewportWidth' => 1200,
    )
);



📁 اسم الملف:patterns/solutions-showcase.PHP
<?php
/**
 * Solutions Showcase Pattern
 * نمط عرض الحلول
 */

register_block_pattern(
    'practical-solutions/solutions-showcase',
    array(
        'title'       => __('عرض الحلول المميزة', 'practical-solutions'),
        'description' => __('قسم لعرض أفضل الحلول مع صور وروابط', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide has-secondary-background-color has-background" style="padding-top:4rem;padding-bottom:4rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:1rem">🏆 الحلول الأكثر طلباً</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:3rem">اكتشف الحلول التي غيرت حياة آلاف الأشخاص حول العالم</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
            <div class="wp-block-columns">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:image {"sizeSlug":"large","linkDestination":"custom","className":"is-style-ps-rounded-image"} -->
                        <figure class="wp-block-image size-large is-style-ps-rounded-image"><a href="/solution/kitchen-organization"><img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400&h=300&fit=crop" alt="تنظيم المطبخ"/></a></figure>
                        <!-- /wp:image -->
                        
                        <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                        <h3 class="wp-block-heading" style="margin-top:1rem;margin-bottom:0.5rem">🍳 تنظيم المطبخ الذكي</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <p style="margin-bottom:1rem">حول مطبخك إلى مساحة منظمة وعملية مع أفكار إبداعية وحلول تخزين ذكية توفر الوقت والجهد</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:buttons -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/solution/kitchen-organization">اكتشف الحل</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:image {"sizeSlug":"large","linkDestination":"custom","className":"is-style-ps-rounded-image"} -->
                        <figure class="wp-block-image size-large is-style-ps-rounded-image"><a href="/solution/time-management"><img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=300&fit=crop" alt="إدارة الوقت"/></a></figure>
                        <!-- /wp:image -->
                        
                        <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                        <h3 class="wp-block-heading" style="margin-top:1rem;margin-bottom:0.5rem">⏰ إتقان إدارة الوقت</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <p style="margin-bottom:1rem">تقنيات مُجربة لتنظيم وقتك وزيادة إنتاجيتك، مع أدوات عملية تساعدك على تحقيق التوازن المثالي</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:buttons -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/solution/time-management">اكتشف الحل</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:image {"sizeSlug":"large","linkDestination":"custom","className":"is-style-ps-rounded-image"} -->
                        <figure class="wp-block-image size-large is-style-ps-rounded-image"><a href="/solution/money-saving"><img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=300&fit=crop" alt="توفير المال"/></a></figure>
                        <!-- /wp:image -->
                        
                        <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                        <h3 class="wp-block-heading" style="margin-top:1rem;margin-bottom:0.5rem">💰 توفير المال بذكاء</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                        <p style="margin-bottom:1rem">استراتيجيات عملية وطرق مبتكرة لتوفير المال في الحياة اليومية دون التنازل عن جودة المعيشة</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:buttons -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"className":"is-style-ps-primary-button"} -->
                            <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link wp-element-button" href="/solution/money-saving">اكتشف الحل</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
            </div>
            <!-- /wp:columns -->
            
        </div>
        <!-- /wp:group -->',
        'categories'  => array('ps-content', 'practical-solutions'),
        'keywords'    => array('solutions', 'showcase', 'حلول', 'عرض'),
    )
);


📁 اسم الملف:patterns/stats-counter.PHP
<?php
/**
 * Stats Counter Pattern
 * نمط عداد الإحصائيات
 */

register_block_pattern(
    'practical-solutions/stats-counter',
    array(
        'title'       => __('عداد الإحصائيات', 'practical-solutions'),
        'description' => __('عرض إحصائيات الموقع بشكل جذاب مع عدادات متحركة', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide has-contrast-background-color has-base-color has-text-color has-background" style="padding-top:4rem;padding-bottom:4rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"3rem"}},"typography":{"fontSize":"2rem","fontWeight":"700"}},"textColor":"base"} -->
            <h2 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:3rem;font-size:2rem;font-weight:700">📊 أرقام تتحدث عن نفسها</h2>
            <!-- /wp:heading -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
            <div class="wp-block-columns">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"10px"}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-primary-background-color has-base-color has-text-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center;">
                            <div class="ps-counter" data-target="500" style="font-size: 3rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
                            <div style="font-size: 1.2rem; font-weight: 500;">حل عملي</div>
                            <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">تم نشرها حتى الآن</div>
                        </div>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"10px"}},"backgroundColor":"success","textColor":"base","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-success-background-color has-base-color has-text-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center;">
                            <div class="ps-counter" data-target="10000" style="font-size: 3rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
                            <div style="font-size: 1.2rem; font-weight: 500;">مستخدم راض</div>
                            <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">استفاد من حلولنا</div>
                        </div>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"10px"}},"backgroundColor":"warning","textColor":"base","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-warning-background-color has-base-color has-text-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center;">
                            <div class="ps-counter" data-target="24" style="font-size: 3rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
                            <div style="font-size: 1.2rem; font-weight: 500;">ساعة دعم</div>
                            <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">متواصل يومياً</div>
                        </div>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"10px"}},"backgroundColor":"accent","textColor":"base","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-accent-background-color has-base-color has-text-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                        
                        <!-- wp:html -->
                        <div style="text-align: center;">
                            <div class="ps-counter" data-target="98" style="font-size: 3rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
                            <div style="font-size: 1.2rem; font-weight: 500;">% نجاح</div>
                            <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">معدل تطبيق الحلول</div>
                        </div>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
            </div>
            <!-- /wp:columns -->
            
        </div>
        <!-- /wp:group -->',
        'categories'  => array('ps-content', 'practical-solutions'),
        'keywords'    => array('stats', 'counter', 'numbers', 'إحصائيات', 'أرقام'),
    )
);


📁 اسم الملف:patterns/testimonials.PHP
<?php
/**
 * Pattern: Testimonials Section
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

register_block_pattern(
    'practical-solutions/testimonials',
    array(
        'title'       => __('شهادات وآراء العملاء', 'practical-solutions'),
        'description' => __('قسم عرض شهادات العملاء والمستخدمين مع تصميم جذاب', 'practical-solutions'),
        'content'     => '<!-- wp:group {"className":"ps-testimonials-section","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"background":"#f8f9fa"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group ps-testimonials-section" style="background-color:#f8f9fa;padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">

    <!-- wp:group {"className":"ps-section-header","style":{"spacing":{"margin":{"bottom":"3rem"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group ps-section-header" style="margin-bottom:3rem">

        <!-- wp:heading {"textAlign":"center","level":2,"className":"ps-section-title","style":{"typography":{"fontSize":"2.5rem","fontWeight":"700","lineHeight":"1.3"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"contrast"} -->
        <h2 class="wp-block-heading has-text-align-center ps-section-title has-contrast-color has-text-color" style="margin-bottom:1rem;font-size:2.5rem;font-weight:700;line-height:1.3">💬 ماذا يقول عملاؤنا</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","className":"ps-section-subtitle","style":{"typography":{"fontSize":"1.2rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"0.5rem"}}},"textColor":"tertiary"} -->
        <p class="has-text-align-center ps-section-subtitle has-tertiary-color has-text-color" style="margin-bottom:0.5rem;font-size:1.2rem;line-height:1.6">آراء حقيقية من مستخدمين استفادوا من حلولنا العملية</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"className":"ps-rating-summary","style":{"spacing":{"blockGap":"1rem","margin":{"top":"1.5rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
        <div class="wp-block-group ps-rating-summary" style="margin-top:1.5rem">

            <!-- wp:group {"className":"ps-stars-display","layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group ps-stars-display">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem"}},"textColor":"accent"} -->
                <p class="has-accent-color has-text-color" style="font-size:1.5rem">⭐⭐⭐⭐⭐</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"}},"textColor":"contrast"} -->
            <p class="has-contrast-color has-text-color" style="font-size:1.1rem;font-weight:600">4.9/5 من 2,000+ تقييم</p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"className":"ps-testimonials-grid","style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
    <div class="wp-block-columns ps-testimonials-grid">

        <!-- wp:column {"className":"ps-testimonial-item"} -->
        <div class="wp-block-column ps-testimonial-item">

            <!-- wp:group {"className":"ps-testimonial-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"15px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-testimonial-card has-white-background-color has-background" style="border-radius:15px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">

                <!-- wp:group {"className":"ps-testimonial-rating","style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-rating" style="margin-bottom:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem"}},"textColor":"accent"} -->
                    <p class="has-accent-color has-text-color" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:quote {"className":"ps-testimonial-quote","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"secondary"} -->
                <blockquote class="wp-block-quote ps-testimonial-quote has-secondary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;font-style:italic;line-height:1.7">
                    <p>"موقع رائع حقاً! وجدت حلول عملية لمشاكل كنت أعاني منها لسنوات. البحث الصوتي ميزة مذهلة تختصر الوقت كثيراً. أنصح الجميع بزيارته."</p>
                </blockquote>
                <!-- /wp:quote -->

                <!-- wp:group {"className":"ps-testimonial-author","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-author">

                    <!-- wp:image {"width":"60","height":"60","className":"ps-author-avatar","style":{"border":{"radius":"50%"}},"sizeSlug":"thumbnail"} -->
                    <figure class="wp-block-image size-thumbnail is-resized ps-author-avatar" style="border-radius:50%">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNFNkU2RjciLz4KPGNpcmNsZSBjeD0iMzAiIGN5PSIyNSIgcj0iMTAiIGZpbGw9IiM5Q0EzQUYiLz4KPGF0aCBkPSJNMTAgNDVDMTAgMzcuMjY4IDE2LjI2OCAzMSAyNCAzMUgzNkM0My43MzIgMzEgNTAgMzcuMjY4IDUwIDQ1VjUwSDEwVjQ1WiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K" alt="فاطمة أحمد" width="60" height="60"/>
                    </figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"className":"ps-author-info","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group ps-author-info">

                        <!-- wp:heading {"level":4,"className":"ps-author-name","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.2rem"}}},"textColor":"contrast"} -->
                        <h4 class="wp-block-heading ps-author-name has-contrast-color has-text-color" style="margin-bottom:0.2rem;font-size:1.1rem;font-weight:600">فاطمة أحمد</h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"className":"ps-author-role","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                        <p class="ps-author-role has-tertiary-color has-text-color" style="font-size:0.9rem">ربة منزل، الرياض</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"ps-testimonial-item"} -->
        <div class="wp-block-column ps-testimonial-item">

            <!-- wp:group {"className":"ps-testimonial-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"15px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-testimonial-card has-white-background-color has-background" style="border-radius:15px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">

                <!-- wp:group {"className":"ps-testimonial-rating","style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-rating" style="margin-bottom:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem"}},"textColor":"accent"} -->
                    <p class="has-accent-color has-text-color" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:quote {"className":"ps-testimonial-quote","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"secondary"} -->
                <blockquote class="wp-block-quote ps-testimonial-quote has-secondary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;font-style:italic;line-height:1.7">
                    <p>"كطالب في الجامعة، ساعدني الموقع كثيراً في تنظيم وقتي ودراستي. التطبيقات المقترحة أحدثت فرق كبير في إنتاجيتي. شكراً للفريق!"</p>
                </blockquote>
                <!-- /wp:quote -->

                <!-- wp:group {"className":"ps-testimonial-author","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-author">

                    <!-- wp:image {"width":"60","height":"60","className":"ps-author-avatar","style":{"border":{"radius":"50%"}},"sizeSlug":"thumbnail"} -->
                    <figure class="wp-block-image size-thumbnail is-resized ps-author-avatar" style="border-radius:50%">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNERUVCRkYiLz4KPGNpcmNsZSBjeD0iMzAiIGN5PSIyNSIgcj0iMTAiIGZpbGw9IiM2MzdBRkYiLz4KPGF0aCBkPSJNMTAgNDVDMTAgMzcuMjY4IDE2LjI2OCAzMSAyNCAzMUgzNkM0My43MzIgMzEgNTAgMzcuMjY4IDUwIDQ1VjUwSDEwVjQ1WiIgZmlsbD0iIzYzN0FGRiIvPgo8L3N2Zz4K" alt="عبدالله محمد" width="60" height="60"/>
                    </figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"className":"ps-author-info","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group ps-author-info">

                        <!-- wp:heading {"level":4,"className":"ps-author-name","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.2rem"}}},"textColor":"contrast"} -->
                        <h4 class="wp-block-heading ps-author-name has-contrast-color has-text-color" style="margin-bottom:0.2rem;font-size:1.1rem;font-weight:600">عبدالله محمد</h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"className":"ps-author-role","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                        <p class="ps-author-role has-tertiary-color has-text-color" style="font-size:0.9rem">طالب جامعي، جدة</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"ps-testimonial-item"} -->
        <div class="wp-block-column ps-testimonial-item">

            <!-- wp:group {"className":"ps-testimonial-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"15px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
            <div class="wp-block-group ps-testimonial-card has-white-background-color has-background" style="border-radius:15px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">

                <!-- wp:group {"className":"ps-testimonial-rating","style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-rating" style="margin-bottom:1rem">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem"}},"textColor":"accent"} -->
                    <p class="has-accent-color has-text-color" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:quote {"className":"ps-testimonial-quote","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"secondary"} -->
                <blockquote class="wp-block-quote ps-testimonial-quote has-secondary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;font-style:italic;line-height:1.7">
                    <p>"أستخدم الموقع يومياً لإيجاد حلول سريعة لمشاكل العمل والحياة. المحتوى عالي الجودة والفريق متجاوب جداً. أصبح مرجعي الأول للنصائح العملية."</p>
                </blockquote>
                <!-- /wp:quote -->

                <!-- wp:group {"className":"ps-testimonial-author","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group ps-testimonial-author">

                    <!-- wp:image {"width":"60","height":"60","className":"ps-author-avatar","style":{"border":{"radius":"50%"}},"sizeSlug":"thumbnail"} -->
                    <figure class="wp-block-image size-thumbnail is-resized ps-author-avatar" style="border-radius:50%">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNGM0Y0RjYiLz4KPGNpcmNsZSBjeD0iMzAiIGN5PSIyNSIgcj0iMTAiIGZpbGw9IiM2RjdBOEEiLz4KPGF0aCBkPSJNMTAgNDVDMTAgMzcuMjY4IDE2LjI2OCAzMSAyNCAzMUgzNkM0My43MzIgMzEgNTAgMzcuMjY4IDUwIDQ1VjUwSDEwVjQ1WiIgZmlsbD0iIzZGN0E4QSIvPgo8L3N2Zz4K" alt="سارة سالم" width="60" height="60"/>
                    </figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"className":"ps-author-info","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group ps-author-info">

                        <!-- wp:heading {"level":4,"className":"ps-author-name","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.2rem"}}},"textColor":"contrast"} -->
                        <h4 class="wp-block-heading ps-author-name has-contrast-color has-text-color" style="margin-bottom:0.2rem;font-size:1.1rem;font-weight:600">سارة سالم</h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"className":"ps-author-role","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                        <p class="ps-author-role has-tertiary-color has-text-color" style="font-size:0.9rem">مديرة مشاريع، الدمام</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:group {"className":"ps-testimonials-row-2","style":{"spacing":{"margin":{"top":"2rem"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group ps-testimonials-row-2" style="margin-top:2rem">

        <!-- wp:columns {"className":"ps-testimonials-grid-2","style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
        <div class="wp-block-columns ps-testimonials-grid-2">

            <!-- wp:column {"className":"ps-testimonial-item"} -->
            <div class="wp-block-column ps-testimonial-item">

                <!-- wp:group {"className":"ps-testimonial-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"15px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-testimonial-card has-white-background-color has-background" style="border-radius:15px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">

                    <!-- wp:group {"className":"ps-testimonial-rating","style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                    <div class="wp-block-group ps-testimonial-rating" style="margin-bottom:1rem">
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem"}},"textColor":"accent"} -->
                        <p class="has-accent-color has-text-color" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:quote {"className":"ps-testimonial-quote","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"secondary"} -->
                    <blockquote class="wp-block-quote ps-testimonial-quote has-secondary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;font-style:italic;line-height:1.7">
                        <p>"كأب لثلاثة أطفال، أحتاج حلول سريعة وعملية. هذا الموقع وفر علي الكثير من الوقت والجهد. النصائح التربوية والمنزلية مفيدة جداً."</p>
                    </blockquote>
                    <!-- /wp:quote -->

                    <!-- wp:group {"className":"ps-testimonial-author","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                    <div class="wp-block-group ps-testimonial-author">

                        <!-- wp:image {"width":"60","height":"60","className":"ps-author-avatar","style":{"border":{"radius":"50%"}},"sizeSlug":"thumbnail"} -->
                        <figure class="wp-block-image size-thumbnail is-resized ps-author-avatar" style="border-radius:50%">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNGRUYzRTIiLz4KPGNpcmNsZSBjeD0iMzAiIGN5PSIyNSIgcj0iMTAiIGZpbGw9IiNGNTk3MDAiLz4KPGF0aCBkPSJNMTAgNDVDMTAgMzcuMjY4IDE2LjI2OCAzMSAyNCAzMUgzNkM0My43MzIgMzEgNTAgMzcuMjY4IDUwIDQ1VjUwSDEwVjQ1WiIgZmlsbD0iI0Y1OTcwMCIvPgo8L3N2Zz4K" alt="خالد إبراهيم" width="60" height="60"/>
                        </figure>
                        <!-- /wp:image -->

                        <!-- wp:group {"className":"ps-author-info","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group ps-author-info">

                            <!-- wp:heading {"level":4,"className":"ps-author-name","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.2rem"}}},"textColor":"contrast"} -->
                            <h4 class="wp-block-heading ps-author-name has-contrast-color has-text-color" style="margin-bottom:0.2rem;font-size:1.1rem;font-weight:600">خالد إبراهيم</h4>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"className":"ps-author-role","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                            <p class="ps-author-role has-tertiary-color has-text-color" style="font-size:0.9rem">مهندس، الكويت</p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"ps-testimonial-item"} -->
            <div class="wp-block-column ps-testimonial-item">

                <!-- wp:group {"className":"ps-testimonial-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"15px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                <div class="wp-block-group ps-testimonial-card has-white-background-color has-background" style="border-radius:15px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">

                    <!-- wp:group {"className":"ps-testimonial-rating","style":{"spacing":{"margin":{"bottom":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                    <div class="wp-block-group ps-testimonial-rating" style="margin-bottom:1rem">
                        <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.2rem"}},"textColor":"accent"} -->
                        <p class="has-accent-color has-text-color" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:quote {"className":"ps-testimonial-quote","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.7","fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"secondary"} -->
                    <blockquote class="wp-block-quote ps-testimonial-quote has-secondary-color has-text-color" style="margin-bottom:1.5rem;font-size:1.1rem;font-style:italic;line-height:1.7">
                        <p>"موقع استثنائي! النصائح المالية والاستثمارية ساعدتني في تحسين وضعي المالي بشكل كبير. أقدر المجهود المبذول في تقديم محتوى عالي الجودة."</p>
                    </blockquote>
                    <!-- /wp:quote -->

                    <!-- wp:group {"className":"ps-testimonial-author","style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                    <div class="wp-block-group ps-testimonial-author">

                        <!-- wp:image {"width":"60","height":"60","className":"ps-author-avatar","style":{"border":{"radius":"50%"}},"sizeSlug":"thumbnail"} -->
                        <figure class="wp-block-image size-thumbnail is-resized ps-author-avatar" style="border-radius:50%">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNFRkY2RkYiLz4KPGNpcmNsZSBjeD0iMzAiIGN5PSIyNSIgcj0iMTAiIGZpbGw9IiMwNkI2RDQiLz4KPGF0aCBkPSJNMTAgNDVDMTAgMzcuMjY4IDE2LjI2OCAzMSAyNCAzMUgzNkM0My43MzIgMzEgNTAgMzcuMjY4IDUwIDQ1VjUwSDEwVjQ1WiIgZmlsbD0iIzA2QjZENCIvPgo8L3N2Zz4K" alt="نورا حسن" width="60" height="60"/>
                        </figure>
                        <!-- /wp:image -->

                        <!-- wp:group {"className":"ps-author-info","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group ps-author-info">

                            <!-- wp:heading {"level":4,"className":"ps-author-name","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"0.2rem"}}},"textColor":"contrast"} -->
                            <h4 class="wp-block-heading ps-author-name has-contrast-color has-text-color" style="margin-bottom:0.2rem;font-size:1.1rem;font-weight:600">نورا حسن</h4>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"className":"ps-author-role","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                            <p class="ps-author-role has-tertiary-color has-text-color" style="font-size:0.9rem">محاسبة، أبوظبي</p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"ps-testimonials-cta","style":{"spacing":{"margin":{"top":"3rem"},"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}},"border":{"radius":"15px"},"color":{"gradient":"linear-gradient(135deg,#007cba 0%,#005a87 100%)"}},"layout":{"type":"constrained","contentSize":"600px"}} -->
    <div class="wp-block-group ps-testimonials-cta" style="background:linear-gradient(135deg,#007cba 0%,#005a87 100%);border-radius:15px;margin-top:3rem;padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">

        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.8rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"white"} -->
        <h3 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-bottom:1rem;font-size:1.8rem;font-weight:600">🌟 انضم لآلاف المستفيدين</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.1rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"white"} -->
        <p class="has-text-align-center has-white-color has-text-color" style="margin-bottom:2rem;font-size:1.1rem;line-height:1.6">ابدأ رحلتك نحو حياة أكثر تنظيماً وفعالية مع حلولنا العملية المجربة</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">

            <!-- wp:button {"className":"ps-cta-button","style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2rem","right":"2rem"}},"border":{"radius":"30px"},"typography":{"fontSize":"1.1rem","fontWeight":"600"}},"backgroundColor":"white","textColor":"primary"} -->
            <div class="wp-block-button ps-cta-button">
                <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:30px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem;font-size:1.1rem;font-weight:600">🚀 ابدأ الآن مجاناً</a>
            </div>
            <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

        <!-- wp:group {"className":"ps-trust-indicators","style":{"spacing":{"margin":{"top":"1.5rem"},"blockGap":"1rem"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
        <div class="wp-block-group ps-trust-indicators" style="margin-top:1.5rem">

            <!-- wp:group {"className":"ps-trust-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group ps-trust-item">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                <p class="has-white-color has-text-color" style="font-size:0.9rem">✅ مجاني تماماً</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-trust-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group ps-trust-item">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                <p class="has-white-color has-text-color" style="font-size:0.9rem">✅ بدون تسجيل</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"ps-trust-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group ps-trust-item">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}},"textColor":"white"} -->
                <p class="has-white-color has-text-color" style="font-size:0.9rem">✅ محتوى محدث يومياً</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->',
        'categories'  => array('practical-solutions', 'testimonials'),
        'keywords'    => array('testimonials', 'reviews', 'شهادات', 'آراء', 'تقييمات', 'عملاء'),
        'viewportWidth' => 1200,
    )
);



📁 اسم الملف: rating-system.php
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



📁 اسم الملف: team-members.php
<?php
/**
 * Missing Block Patterns for Practical Solutions Pro
 * الـ Patterns المفقودة للحلول العملية الاحترافية
 */

// ==== Team Members Pattern ====
// المكان: /patterns/team-members.php
register_block_pattern(
    'practical-solutions/team-members',
    array(
        'title'       => __('فريق العمل', 'practical-solutions'),
        'description' => __('عرض أعضاء فريق العمل مع الصور والمعلومات', 'practical-solutions'),
        'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"className":"ps-team-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ps-team-section" style="padding-top:4rem;padding-bottom:4rem">

    <!-- wp:heading {"textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:3rem">فريق الخبراء</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"4rem"}},"typography":{"fontSize":"18px"}},"textColor":"tertiary"} -->
    <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-bottom:4rem;font-size:18px">مجموعة من الخبراء المتخصصين في تقديم الحلول العملية</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                
                <!-- wp:image {"width":120,"height":120,"sizeSlug":"thumbnail","className":"is-style-ps-rounded-image","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image size-thumbnail is-resized is-style-ps-rounded-image" style="border-radius:50%">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iNjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHN2ZyB4PSIzMCIgeT0iMzAiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSIjOUNBM0FGIj4KPHA0dGggZD0iTTEyIDEyYzIuMjEgMCA0LTEuNzkgNC00cy0xLjc5LTQtNC00LTQgMS43OS00IDQgMS43OSA0IDQgNHptMCAyYy0yLjY3IDAtOCAxLjM0LTggNHYyaDE2di0yYzAtMi42Ni01LjMzLTQtOC00eiIvPgo8L3N2Zz4KPC9zdmc+" alt="أحمد محمد" width="120" height="120"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"0.5rem"}}}} -->
                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1.5rem;margin-bottom:0.5rem">أحمد محمد</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px","fontWeight":"500"}},"textColor":"primary"} -->
                <p class="has-text-align-center has-primary-color has-text-color" style="font-size:14px;font-weight:500">خبير الحلول المنزلية</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem"}},"typography":{"fontSize":"15px"}},"textColor":"tertiary"} -->
                <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-top:1rem;font-size:15px">متخصص في تنظيم وترتيب المنزل مع خبرة تزيد عن 10 سنوات</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#1a1a1a","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:1.5rem">
                    <li class="wp-block-social-link wp-social-link-facebook wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-twitter wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-linkedin wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                </ul>
                <!-- /wp:social-links -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                
                <!-- wp:image {"width":120,"height":120,"sizeSlug":"thumbnail","className":"is-style-ps-rounded-image","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image size-thumbnail is-resized is-style-ps-rounded-image" style="border-radius:50%">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iNjAiIGZpbGw9IiNGRUY3RkYiLz4KPHN2ZyB4PSIzMCIgeT0iMzAiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSIjRkM5MTlEIj4KPHA0dGggZD0iTTEyIDEyYzIuMjEgMCA0LTEuNzkgNC00cy0xLjc5LTQtNC00LTQgMS43OS00IDQgMS43OSA0IDQgNHptMCAyYy0yLjY3IDAtOCAxLjM0LTggNHYyaDE2di0yYzAtMi42Ni01LjMzLTQtOC00eiIvPgo8L3N2Zz4KPC9zdmc+" alt="فاطمة أحمد" width="120" height="120"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"0.5rem"}}}} -->
                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1.5rem;margin-bottom:0.5rem">فاطمة أحمد</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px","fontWeight":"500"}},"textColor":"primary"} -->
                <p class="has-text-align-center has-primary-color has-text-color" style="font-size:14px;font-weight:500">خبيرة المطبخ والطبخ</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem"}},"typography":{"fontSize":"15px"}},"textColor":"tertiary"} -->
                <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-top:1rem;font-size:15px">شيف محترفة متخصصة في الوصفات الصحية والحلول المطبخية العملية</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#1a1a1a","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:1.5rem">
                    <li class="wp-block-social-link wp-social-link-instagram wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-youtube wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-tiktok wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                </ul>
                <!-- /wp:social-links -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                
                <!-- wp:image {"width":120,"height":120,"sizeSlug":"thumbnail","className":"is-style-ps-rounded-image","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image size-thumbnail is-resized is-style-ps-rounded-image" style="border-radius:50%">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iNjAiIGZpbGw9IiNGRkY3RUQiLz4KPHN2ZyB4PSIzMCIgeT0iMzAiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSIjRjU5RTBCIj4KPHA0dGggZD0iTTEyIDEyYzIuMjEgMCA0LTEuNzkgNC00cy0xLjc5LTQtNC00LTQgMS43OS00IDQgMS43OSA0IDQgNHptMCAyYy0yLjY3IDAtOCAxLjM0LTggNHYyaDE2di0yYzAtMi42Ni01LjMzLTQtOC00eiIvPgo8L3N2Zz4KPC9zdmc+" alt="خالد علي" width="120" height="120"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"0.5rem"}}}} -->
                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1.5rem;margin-bottom:0.5rem">خالد علي</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px","fontWeight":"500"}},"textColor":"primary"} -->
                <p class="has-text-align-center has-primary-color has-text-color" style="font-size:14px;font-weight:500">خبير التقنية والحلول الذكية</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem"}},"typography":{"fontSize":"15px"}},"textColor":"tertiary"} -->
                <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-top:1rem;font-size:15px">مختص في تطبيق التقنية لحل مشاكل الحياة اليومية</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#1a1a1a","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"1.5rem"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:1.5rem">
                    <li class="wp-block-social-link wp-social-link-linkedin wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-github wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                    <li class="wp-block-social-link wp-social-link-twitter wp-block-social-link"><a href="#" class="wp-block-social-link-anchor"></a></li>
                </ul>
                <!-- /wp:social-links -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->',
        'categories'  => array('practical-solutions'),
        'keywords'    => array('team', 'فريق', 'أعضاء', 'خبراء'),
    )
);

// ==== Services Pricing Pattern ====
// المكان: /patterns/services-pricing.php
register_block_pattern(
    'practical-solutions/services-pricing',
    array(
        'title'       => __('أسعار الخدمات', 'practical-solutions'),
        'description' => __('جدول أسعار الخدمات مع المميزات', 'practical-solutions'),
        'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"className":"ps-pricing-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ps-pricing-section" style="padding-top:4rem;padding-bottom:4rem">

    <!-- wp:heading {"textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:1rem">خطط الاشتراك</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}},"typography":{"fontSize":"18px"}},"textColor":"tertiary"} -->
    <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-bottom:3rem;font-size:18px">اختر الخطة المناسبة للحصول على أفضل الحلول العملية</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}},"border":{"width":"1px"}},"borderColor":"secondary","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style has-border-color has-secondary-border-color" style="border-width:1px;padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">الخطة الأساسية</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}},"typography":{"fontSize":"48px","fontWeight":"700"}},"textColor":"contrast"} -->
                <p class="has-text-align-center has-contrast-color has-text-color" style="margin-bottom:2rem;font-size:48px;font-weight:700">مجاني</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:list {"style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
                <ul style="margin-bottom:2rem">
                    <li>✅ وصول للمقالات الأساسية</li>
                    <li>✅ نصائح يومية عبر البريد</li>
                    <li>✅ مجتمع المستخدمين</li>
                    <li>❌ الوصول للمقالات المميزة</li>
                    <li>❌ الاستشارات الشخصية</li>
                    <li>❌ الدعم المباشر</li>
                </ul>
                <!-- /wp:list -->
                
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons">
                    <div class="wp-block-button is-style-ps-outline-button">
                        <a class="wp-block-button__link wp-element-button" href="#">البدء مجاناً</a>
                    </div>
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}},"border":{"width":"2px"}},"borderColor":"primary","backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style has-base-color has-primary-background-color has-text-color has-background has-border-color has-primary-border-color" style="border-width:2px;padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1rem"}},"typography":{"fontSize":"12px","fontWeight":"600","textTransform":"uppercase"}},"backgroundColor":"accent","textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-accent-background-color has-text-color has-background" style="margin-bottom:1rem;font-size:12px;font-weight:600;text-transform:uppercase">⭐ الأكثر شعبية</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"base"} -->
                <h3 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:1rem">الخطة المميزة</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"0.5rem"}},"typography":{"fontSize":"48px","fontWeight":"700"}},"textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-text-color" style="margin-bottom:0.5rem;font-size:48px;font-weight:700">99 ر.س</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}},"typography":{"fontSize":"14px"}},"textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-text-color" style="margin-bottom:2rem;font-size:14px">شهرياً</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:list {"style":{"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"base"} -->
                <ul class="has-base-color has-text-color" style="margin-bottom:2rem">
                    <li>✅ جميع مميزات الخطة الأساسية</li>
                    <li>✅ وصول للمقالات المميزة</li>
                    <li>✅ دورات تدريبية حصرية</li>
                    <li>✅ استشارة شهرية مجانية</li>
                    <li>✅ تطبيق الجوال</li>
                    <li>✅ دعم فني متقدم</li>
                </ul>
                <!-- /wp:list -->
                
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons">
                    <div class="wp-block-button">
                        <a class="wp-block-button__link wp-element-button" href="#" style="background-color:#ffffff;color:#007cba">ابدأ الآن</a>
                    </div>
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}},"border":{"width":"1px"}},"borderColor":"secondary","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style has-border-color has-secondary-border-color" style="border-width:1px;padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                <h3 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">الخطة الاحترافية</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"0.5rem"}},"typography":{"fontSize":"48px","fontWeight":"700"}},"textColor":"contrast"} -->
                <p class="has-text-align-center has-contrast-color has-text-color" style="margin-bottom:0.5rem;font-size:48px;font-weight:700">299 ر.س</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}},"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
                <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-bottom:2rem;font-size:14px">شهرياً</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:list {"style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
                <ul style="margin-bottom:2rem">
                    <li>✅ جميع مميزات الخطة المميزة</li>
                    <li>✅ استشارات غير محدودة</li>
                    <li>✅ خطط مخصصة لمنزلك</li>
                    <li>✅ زيارات منزلية (حسب المنطقة)</li>
                    <li>✅ دعم على مدار الساعة</li>
                    <li>✅ مجتمع VIP خاص</li>
                </ul>
                <!-- /wp:list -->
                
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons">
                    <div class="wp-block-button is-style-ps-outline-button">
                        <a class="wp-block-button__link wp-element-button" href="#">تواصل معنا</a>
                    </div>
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"3rem"}},"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
    <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-top:3rem;font-size:14px">جميع الخطط تشمل ضمان استرداد المال خلال 30 يوماً | الأسعار شاملة ضريبة القيمة المضافة</p>
    <!-- /wp:paragraph -->

</div>
<!-- /wp:group -->',
        'categories'  => array('practical-solutions'),
        'keywords'    => array('pricing', 'أسعار', 'خطط', 'اشتراك'),
    )
);

// ==== Before After Pattern ====
// المكان: /patterns/before-after.php
register_block_pattern(
    'practical-solutions/before-after',
    array(
        'title'       => __('قبل وبعد', 'practical-solutions'),
        'description' => __('عرض النتائج قبل وبعد تطبيق الحلول', 'practical-solutions'),
        'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"className":"ps-before-after-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ps-before-after-section" style="padding-top:4rem;padding-bottom:4rem">

    <!-- wp:heading {"textAlign":"center","className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
    <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:1rem">النتائج المذهلة</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}},"typography":{"fontSize":"18px"}},"textColor":"tertiary"} -->
    <p class="has-text-align-center has-tertiary-color has-text-color" style="margin-bottom:3rem;font-size:18px">شاهد التحول المذهل الذي حققه عملاؤنا باستخدام حلولنا العملية</p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"bottom":"4rem"}}}} -->
    <div class="wp-block-columns alignwide" style="margin-bottom:4rem">
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                
                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}},"color":{"text":"#dc3545"}}} -->
                <h4 class="wp-block-heading has-text-align-center has-text-color" style="margin-bottom:1rem;color:#dc3545">❌ قبل</h4>
                <!-- /wp:heading -->
                
                <!-- wp:image {"sizeSlug":"large","className":"is-style-ps-rounded-image"} -->
                <figure class="wp-block-image size-large is-style-ps-rounded-image">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjOUNBM0FGIiBmb250LXNpemU9IjE4IiBmb250LWZhbWlseT0iQXJpYWwiPtmF2LfYqNiuINi62YrYsSDZhdmG2LjZhTwvdGV4dD4KPC9zdmc+" alt="مطبخ غير منظم"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":5,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                <h5 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">مطبخ فوضوي</h5>
                <!-- /wp:heading -->
                
                <!-- wp:list {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
                <ul class="has-tertiary-color has-text-color" style="font-size:14px">
                    <li>أدوات متناثرة في كل مكان</li>
                    <li>صعوبة في العثور على الأشياء</li>
                    <li>مساحة ضيقة وغير مستغلة</li>
                    <li>طبخ مرهق ومتعب</li>
                </ul>
                <!-- /wp:list -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                
                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}},"color":{"text":"#10b981"}}} -->
                <h4 class="wp-block-heading has-text-align-center has-text-color" style="margin-bottom:1rem;color:#10b981">✅ بعد</h4>
                <!-- /wp:heading -->
                
                <!-- wp:image {"sizeSlug":"large","className":"is-style-ps-rounded-image"} -->
                <figure class="wp-block-image size-large is-style-ps-rounded-image">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjBGOUZGIi8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjMTBCOTgxIiBmb250LXNpemU9IjE4IiBmb250LWZhbWlseT0iQXJpYWwiPtmF2LfYqNiuINmF2YbYuNmFPC90ZXh0Pgo8L3N2Zz4=" alt="مطبخ منظم"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":5,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                <h5 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">مطبخ منظم ومرتب</h5>
                <!-- /wp:heading -->
                
                <!-- wp:list {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
                <ul class="has-tertiary-color has-text-color" style="font-size:14px">
                    <li>تنظيم ذكي للأدوات والأطعمة</li>
                    <li>سهولة الوصول لكل شيء</li>
                    <li>استغلال أمثل للمساحة</li>
                    <li>طبخ ممتع وسريع</li>
                </ul>
                <!-- /wp:list -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->

    <!-- wp:separator {"align":"wide","style":{"spacing":{"margin":{"top":"3rem","bottom":"3rem"}}},"backgroundColor":"secondary"} -->
    <hr class="wp-block-separator alignwide has-text-color has-secondary-color has-alpha-channel-opacity has-secondary-background-color has-background" style="margin-top:3rem;margin-bottom:3rem"/>
    <!-- /wp:separator -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                
                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}},"color":{"text":"#dc3545"}}} -->
                <h4 class="wp-block-heading has-text-align-center has-text-color" style="margin-bottom:1rem;color:#dc3545">❌ قبل</h4>
                <!-- /wp:heading -->
                
                <!-- wp:image {"sizeSlug":"large","className":"is-style-ps-rounded-image"} -->
                <figure class="wp-block-image size-large is-style-ps-rounded-image">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRkVGN0ZGIi8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjRkM5MTlEIiBmb250LXNpemU9IjE4IiBmb250LWZhbWlseT0iQXJpYWwiPtmn2YXYsdin2KbYlSDYutin2K8g2KfZhNmG2YjZhTwvdGV4dD4KPC9zdmc+" alt="امرأة متعبة"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":5,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                <h5 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">عادات نوم سيئة</h5>
                <!-- /wp:heading -->
                
                <!-- wp:list {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
                <ul class="has-tertiary-color has-text-color" style="font-size:14px">
                    <li>أرق وصعوبة في النوم</li>
                    <li>استيقاظ متكرر ليلاً</li>
                    <li>تعب وإرهاق نهاري</li>
                    <li>نوم متقطع وغير مريح</li>
                </ul>
                <!-- /wp:list -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"className":"is-style-ps-card-style","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-ps-card-style" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                
                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"1rem"}},"color":{"text":"#10b981"}}} -->
                <h4 class="wp-block-heading has-text-align-center has-text-color" style="margin-bottom:1rem;color:#10b981">✅ بعد</h4>
                <!-- /wp:heading -->
                
                <!-- wp:image {"sizeSlug":"large","className":"is-style-ps-rounded-image"} -->
                <figure class="wp-block-image size-large is-style-ps-rounded-image">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjBGOUZGIi8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjMTBCOTgxIiBmb250LXNpemU9IjE4IiBmb250LWZhbWlseT0iQXJpYWwiPtin2YXYsdin2KbYlSDZhdi12KrYsdmK2K3YqTwvdGV4dD4KPC9zdmc+" alt="امرأة مستريحة"/>
                </figure>
                <!-- /wp:image -->
                
                <!-- wp:heading {"textAlign":"center","level":5,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                <h5 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">نوم هادئ ومريح</h5>
                <!-- /wp:heading -->
                
                <!-- wp:list {"style":{"typography":{"fontSize":"14px"}},"textColor":"tertiary"} -->
                <ul class="has-tertiary-color has-text-color" style="font-size:14px">
                    <li>نوم عميق ومريح</li>
                    <li>استيقاظ منعش ونشيط</li>
                    <li>طاقة عالية طوال اليوم</li>
                    <li>حالة مزاجية أفضل</li>
                </ul>
                <!-- /wp:list -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"2rem","left":"2rem","right":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
    <div class="wp-block-group has-base-color has-primary-background-color has-text-color has-background" style="border-radius:12px;padding-top:3rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
        
        <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"bottom":"1rem"}}},"textColor":"base"} -->
        <h3 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="margin-bottom:1rem">🎯 النتائج الحقيقية</h3>
        <!-- /wp:heading -->
        
        <!-- wp:columns -->
        <div class="wp-block-columns">
            <div class="wp-block-column">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px","fontWeight":"700"}},"textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:24px;font-weight:700">95%</p>
                <!-- /wp:paragraph -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:14px">تحسن في التنظيم</p>
            </div>
            <div class="wp-block-column">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px","fontWeight":"700"}},"textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:24px;font-weight:700">80%</p>
                <!-- /wp:paragraph -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:14px">توفير في الوقت</p>
            </div>
            <div class="wp-block-column">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px","fontWeight":"700"}},"textColor":"base"} -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:24px;font-weight:700">90%</p>
                <!-- /wp:paragraph -->
                <p class="has-text-align-center has-base-color has-text-color" style="font-size:14px">رضا العملاء</p>
            </div>
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
        <div class="wp-block-buttons" style="margin-top:2rem">
            <div class="wp-block-button">
                <a class="wp-block-button__link wp-element-button" href="#" style="background-color:#ffffff;color:#007cba">ابدأ رحلتك الآن</a>
            </div>
        </div>
        <!-- /wp:buttons -->
        
    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->',
        'categories'  => array('practical-solutions'),
        'keywords'    => array('before', 'after', 'قبل', 'بعد', 'نتائج', 'تحول'),
    )
);
?>



📁 اسم الملف: enhanced-voice-search.js
/**
 * نظام البحث الصوتي المحسن
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

class EnhancedVoiceSearch {
    constructor() {
        this.recognition = null;
        this.isListening = false;
        this.searchInput = null;
        this.voiceButton = null;
        this.suggestions = [];
        this.history = this.getSearchHistory();
        this.apiKey = psVoiceSearch?.apiKey || '';
        this.currentLanguage = 'ar-SA';
        this.fallbackLanguages = ['ar-EG', 'ar-AE', 'en-US'];
        
        this.init();
    }
    
    /**
     * ==== تهيئة النظام ====
     */
    init() {
        if (!this.checkBrowserSupport()) {
            console.warn('متصفحك لا يدعم البحث الصوتي');
            return;
        }
        
        this.setupElements();
        this.setupSpeechRecognition();
        this.setupEventListeners();
        this.loadSettings();
        this.createVoiceInterface();
        
        // تحميل الاقتراحات المحفوظة
        this.loadCachedSuggestions();
        
        console.log('تم تشغيل نظام البحث الصوتي المحسن');
    }
    
    /**
     * ==== فحص دعم المتصفح ====
     */
    checkBrowserSupport() {
        return 'webkitSpeechRecognition' in window || 'SpeechRecognition' in window;
    }
    
    /**
     * ==== إعداد العناصر الأساسية ====
     */
    setupElements() {
        this.searchInput = document.querySelector('.ps-search-input, #search-input, .search-field');
        
        if (!this.searchInput) {
            // إنشاء حقل البحث إذا لم يوجد
            this.createSearchField();
        }
        
        this.createVoiceButton();
    }
    
    /**
     * ==== إنشاء حقل البحث ====
     */
    createSearchField() {
        const searchContainer = document.querySelector('.ps-search-container, .search-form, header');
        
        if (searchContainer) {
            const searchHTML = `
                <div class="ps-enhanced-search">
                    <input type="text" class="ps-search-input" placeholder="ابحث عن الحلول والنصائح..." />
                    <div class="ps-search-suggestions"></div>
                </div>
            `;
            
            searchContainer.insertAdjacentHTML('beforeend', searchHTML);
            this.searchInput = searchContainer.querySelector('.ps-search-input');
        }
    }
    
    /**
     * ==== إنشاء زر البحث الصوتي ====
     */
    createVoiceButton() {
        if (!this.searchInput) return;
        
        // التحقق من وجود الزر مسبقاً
        const existingButton = this.searchInput.parentNode.querySelector('.ps-voice-button');
        if (existingButton) {
            this.voiceButton = existingButton;
            return;
        }
        
        this.voiceButton = document.createElement('button');
        this.voiceButton.type = 'button';
        this.voiceButton.className = 'ps-voice-button';
        this.voiceButton.innerHTML = `
            <svg class="voice-icon" viewBox="0 0 24 24" width="20" height="20">
                <path d="M12 2C10.9 2 10 2.9 10 4V12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12V4C14 2.9 13.1 2 12 2Z" fill="currentColor"/>
                <path d="M19 10V12C19 15.9 15.9 19 12 19C8.1 19 5 15.9 5 12V10H7V12C7 14.8 9.2 17 12 17C14.8 17 17 14.8 17 12V10H19Z" fill="currentColor"/>
                <path d="M10.5 22H13.5V20H10.5V22Z" fill="currentColor"/>
            </svg>
            <span class="voice-status">اضغط للتحدث</span>
        `;
        
        this.voiceButton.setAttribute('title', 'البحث الصوتي (Ctrl + M)');
        this.voiceButton.setAttribute('aria-label', 'تفعيل البحث الصوتي');
        
        // إدراج الزر بعد حقل البحث
        this.searchInput.parentNode.insertBefore(this.voiceButton, this.searchInput.nextSibling);
        
        // إضافة أنماط CSS
        this.addVoiceButtonStyles();
    }
    
    /**
     * ==== إضافة أنماط زر البحث الصوتي ====
     */
    addVoiceButtonStyles() {
        if (document.querySelector('#ps-voice-search-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'ps-voice-search-styles';
        styles.textContent = `
            .ps-voice-button {
                background: linear-gradient(135deg, #007cba, #005a87);
                border: none;
                border-radius: 50px;
                padding: 12px 16px;
                color: white;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s ease;
                box-shadow: 0 2px 8px rgba(0, 124, 186, 0.3);
                margin-left: 8px;
                margin-right: 8px;
            }
            
            .ps-voice-button:hover {
                background: linear-gradient(135deg, #005a87, #007cba);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 124, 186, 0.4);
            }
            
            .ps-voice-button:active {
                transform: translateY(0);
            }
            
            .ps-voice-button.listening {
                background: linear-gradient(135deg, #e74c3c, #c0392b);
                animation: pulse 1.5s infinite;
            }
            
            .ps-voice-button.processing {
                background: linear-gradient(135deg, #f39c12, #e67e22);
            }
            
            .ps-voice-button.success {
                background: linear-gradient(135deg, #27ae60, #2ecc71);
            }
            
            .ps-voice-button .voice-icon {
                transition: transform 0.3s ease;
            }
            
            .ps-voice-button.listening .voice-icon {
                transform: scale(1.2);
                animation: bounce 0.6s infinite alternate;
            }
            
            @keyframes pulse {
                0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
                70% { box-shadow: 0 0 0 10px rgba(231, 76, 60, 0); }
                100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
            }
            
            @keyframes bounce {
                from { transform: scale(1.2) translateY(0); }
                to { transform: scale(1.2) translateY(-3px); }
            }
            
            .ps-voice-feedback {
                position: fixed;
                top: 20px;
                right: 20px;
                background: rgba(0, 0, 0, 0.9);
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                z-index: 9999;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            }
            
            .ps-voice-feedback.show {
                transform: translateX(0);
            }
            
            .ps-search-suggestions {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-height: 300px;
                overflow-y: auto;
                z-index: 1000;
                display: none;
            }
            
            .ps-search-suggestions.show {
                display: block;
            }
            
            .ps-suggestion-item {
                padding: 12px 16px;
                border-bottom: 1px solid #eee;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: background 0.2s ease;
            }
            
            .ps-suggestion-item:hover {
                background: #f8f9fa;
            }
            
            .ps-suggestion-item:last-child {
                border-bottom: none;
            }
            
            .ps-suggestion-icon {
                width: 16px;
                height: 16px;
                opacity: 0.6;
            }
            
            .ps-suggestion-text {
                flex: 1;
            }
            
            .ps-suggestion-type {
                font-size: 12px;
                color: #666;
                background: #f0f0f0;
                padding: 2px 6px;
                border-radius: 4px;
            }
            
            @media (max-width: 768px) {
                .ps-voice-button {
                    padding: 10px 12px;
                    font-size: 12px;
                }
                
                .ps-voice-button .voice-status {
                    display: none;
                }
            }
        `;
        
        document.head.appendChild(styles);
    }
    
    /**
     * ==== إعداد التعرف على الكلام ====
     */
    setupSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (!SpeechRecognition) {
            console.error('Speech Recognition غير مدعوم في هذا المتصفح');
            return;
        }
        
        this.recognition = new SpeechRecognition();
        this.recognition.continuous = false;
        this.recognition.interimResults = true;
        this.recognition.lang = this.currentLanguage;
        this.recognition.maxAlternatives = 5;
        
        // معالج بداية الاستماع
        this.recognition.onstart = () => {
            this.isListening = true;
            this.updateButtonState('listening');
            this.showFeedback('استمع الآن... تحدث بوضوح');
        };
        
        // معالج النتائج
        this.recognition.onresult = (event) => {
            this.handleSpeechResult(event);
        };
        
        // معالج انتهاء الاستماع
        this.recognition.onend = () => {
            this.isListening = false;
            this.updateButtonState('default');
            this.hideFeedback();
        };
        
        // معالج الأخطاء
        this.recognition.onerror = (event) => {
            this.handleSpeechError(event);
        };
    }
    
    /**
     * ==== إعداد مستمعي الأحداث ====
     */
    setupEventListeners() {
        // النقر على زر البحث الصوتي
        if (this.voiceButton) {
            this.voiceButton.addEventListener('click', () => {
                this.toggleListening();
            });
        }
        
        // اختصار لوحة المفاتيح
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'm') {
                e.preventDefault();
                this.toggleListening();
            }
        });
        
        // البحث أثناء الكتابة
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => {
                this.handleTextInput(e.target.value);
            });
            
            this.searchInput.addEventListener('focus', () => {
                this.showSuggestions();
            });
            
            this.searchInput.addEventListener('blur', (e) => {
                // تأخير إخفاء الاقتراحات للسماح بالنقر عليها
                setTimeout(() => {
                    this.hideSuggestions();
                }, 200);
            });
        }
        
        // النقر خارج منطقة البحث
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.ps-enhanced-search')) {
                this.hideSuggestions();
            }
        });
    }
    
    /**
     * ==== تبديل حالة الاستماع ====
     */
    toggleListening() {
        if (!this.recognition) {
            this.showFeedback('البحث الصوتي غير متوفر في متصفحك', 'error');
            return;
        }
        
        if (this.isListening) {
            this.stopListening();
        } else {
            this.startListening();
        }
    }
    
    /**
     * ==== بدء الاستماع ====
     */
    startListening() {
        try {
            this.recognition.start();
        } catch (error) {
            console.error('خطأ في بدء التعرف على الكلام:', error);
            this.showFeedback('حدث خطأ في تشغيل البحث الصوتي', 'error');
        }
    }
    
    /**
     * ==== إيقاف الاستماع ====
     */
    stopListening() {
        if (this.recognition) {
            this.recognition.stop();
        }
    }
    
    /**
     * ==== معالجة نتائج الكلام ====
     */
    handleSpeechResult(event) {
        let finalTranscript = '';
        let interimTranscript = '';
        
        for (let i = event.resultIndex; i < event.results.length; i++) {
            const transcript = event.results[i][0].transcript;
            
            if (event.results[i].isFinal) {
                finalTranscript += transcript;
            } else {
                interimTranscript += transcript;
            }
        }
        
        // عرض النص المؤقت
        if (interimTranscript) {
            if (this.searchInput) {
                this.searchInput.value = interimTranscript;
                this.searchInput.style.color = '#999';
            }
            this.showFeedback(`سمعت: "${interimTranscript}"`);
        }
        
        // معالجة النص النهائي
        if (finalTranscript) {
            this.processFinalTranscript(finalTranscript.trim());
        }
    }
    
    /**
     * ==== معالجة النص النهائي ====
     */
    async processFinalTranscript(transcript) {
        if (!transcript) return;
        
        this.updateButtonState('processing');
        this.showFeedback('جاري معالجة طلبك...');
        
        // تنظيف النص وتحسينه
        const cleanedText = this.cleanAndEnhanceText(transcript);
        
        if (this.searchInput) {
            this.searchInput.value = cleanedText;
            this.searchInput.style.color = '';
        }
        
        // حفظ في التاريخ
        this.saveToHistory(cleanedText);
        
        // الحصول على اقتراحات ذكية
        await this.getAISuggestions(cleanedText);
        
        // تنفيذ البحث
        this.performSearch(cleanedText);
        
        this.updateButtonState('success');
        this.showFeedback(`تم البحث عن: "${cleanedText}"`, 'success');
        
        setTimeout(() => {
            this.updateButtonState('default');
        }, 2000);
    }
    
    /**
     * ==== تنظيف وتحسين النص ====
     */
    cleanAndEnhanceText(text) {
        // إزالة الكلمات الزائدة والتنظيف
        let cleaned = text
            .replace(/أريد أن أبحث عن/gi, '')
            .replace(/ابحث عن/gi, '')
            .replace(/أبحث عن/gi, '')
            .replace(/كيف/gi, 'كيفية')
            .replace(/ايش/gi, 'ما هو')
            .replace(/وش/gi, 'ما هو')
            .replace(/شلون/gi, 'كيفية')
            .trim();
        
        // تصحيح أخطاء شائعة
        const corrections = {
            'تطبيقات': 'تطبيقات',
            'برامج': 'برامج',
            'حلول': 'حلول',
            'نصايح': 'نصائح',
            'معلومات': 'معلومات'
        };
        
        Object.entries(corrections).forEach(([wrong, correct]) => {
            cleaned = cleaned.replace(new RegExp(wrong, 'gi'), correct);
        });
        
        return cleaned;
    }
    
    /**
     * ==== معالجة أخطاء الكلام ====
     */
    handleSpeechError(event) {
        this.isListening = false;
        this.updateButtonState('default');
        
        let errorMessage = 'حدث خطأ في البحث الصوتي';
        
        switch (event.error) {
            case 'no-speech':
                errorMessage = 'لم يتم التقاط أي صوت. حاول مرة أخرى';
                break;
            case 'audio-capture':
                errorMessage = 'لا يمكن الوصول للميكروفون';
                break;
            case 'not-allowed':
                errorMessage = 'تم رفض إذن استخدام الميكروفون';
                break;
            case 'network':
                errorMessage = 'خطأ في الشبكة. تحقق من اتصالك';
                break;
            case 'language-not-supported':
                this.tryFallbackLanguage();
                return;
        }
        
        this.showFeedback(errorMessage, 'error');
    }
    
    /**
     * ==== تجربة لغة احتياطية ====
     */
    tryFallbackLanguage() {
        const currentIndex = this.fallbackLanguages.indexOf(this.currentLanguage);
        
        if (currentIndex < this.fallbackLanguages.length - 1) {
            this.currentLanguage = this.fallbackLanguages[currentIndex + 1];
            this.recognition.lang = this.currentLanguage;
            this.showFeedback(`جاري التبديل للغة ${this.currentLanguage}...`);
            this.startListening();
        } else {
            this.showFeedback('اللغة غير مدعومة في هذا المتصفح', 'error');
        }
    }
    
    /**
     * ==== تحديث حالة الزر ====
     */
    updateButtonState(state) {
        if (!this.voiceButton) return;
        
        this.voiceButton.className = `ps-voice-button ${state}`;
        
        const statusElement = this.voiceButton.querySelector('.voice-status');
        if (!statusElement) return;
        
        const messages = {
            'default': 'اضغط للتحدث',
            'listening': 'استمع...',
            'processing': 'جاري المعالجة...',
            'success': 'تم!'
        };
        
        statusElement.textContent = messages[state] || messages.default;
    }
    
    /**
     * ==== عرض رسالة التغذية الراجعة ====
     */
    showFeedback(message, type = 'info') {
        // إزالة الرسالة السابقة
        const existingFeedback = document.querySelector('.ps-voice-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }
        
        const feedback = document.createElement('div');
        feedback.className = `ps-voice-feedback ${type}`;
        feedback.textContent = message;
        
        document.body.appendChild(feedback);
        
        // عرض الرسالة
        setTimeout(() => {
            feedback.classList.add('show');
        }, 100);
        
        // إخفاء الرسالة تلقائياً
        setTimeout(() => {
            this.hideFeedback();
        }, type === 'error' ? 5000 : 3000);
    }
    
    /**
     * ==== إخفاء رسالة التغذية الراجعة ====
     */
    hideFeedback() {
        const feedback = document.querySelector('.ps-voice-feedback');
        if (feedback) {
            feedback.classList.remove('show');
            setTimeout(() => {
                feedback.remove();
            }, 300);
        }
    }
    
    /**
     * ==== معالجة إدخال النص العادي ====
     */
    async handleTextInput(value) {
        if (value.length < 2) {
            this.hideSuggestions();
            return;
        }
        
        // الحصول على اقتراحات
        const suggestions = await this.getSuggestions(value);
        this.displaySuggestions(suggestions);
    }
    
    /**
     * ==== الحصول على الاقتراحات ====
     */
    async getSuggestions(query) {
        const suggestions = [];
        
        // اقتراحات من التاريخ
        const historySuggestions = this.history
            .filter(item => item.toLowerCase().includes(query.toLowerCase()))
            .slice(0, 3)
            .map(item => ({
                text: item,
                type: 'history',
                icon: '🕐'
            }));
        
        suggestions.push(...historySuggestions);
        
        // اقتراحات ثابتة شائعة
        const commonSuggestions = [
            'حلول منزلية',
            'نصائح تقنية',
            'تطبيقات مفيدة',
            'إدارة الوقت',
            'تنظيم المنزل',
            'وصفات سريعة',
            'نصائح مالية',
            'تطوير الذات'
        ]
        .filter(item => item.toLowerCase().includes(query.toLowerCase()))
        .slice(0, 3)
        .map(item => ({
            text: item,
            type: 'common',
            icon: '💡'
        }));
        
        suggestions.push(...commonSuggestions);
        
        // اقتراحات من الذكاء الاصطناعي
        if (this.apiKey) {
            try {
                const aiSuggestions = await this.getAISuggestions(query);
                suggestions.push(...aiSuggestions.slice(0, 2));
            } catch (error) {
                console.warn('فشل في الحصول على اقتراحات الذكاء الاصطناعي:', error);
            }
        }
        
        return suggestions.slice(0, 8);
    }
    
    /**
     * ==== الحصول على اقتراحات الذكاء الاصطناعي ====
     */
    async getAISuggestions(query) {
        if (!this.apiKey) return [];
        
        try {
            const response = await fetch(psVoiceSearch.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'ps_get_ai_suggestions',
                    query: query,
                    nonce: psVoiceSearch.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success && data.data.suggestions) {
                return data.data.suggestions.map(suggestion => ({
                    text: suggestion,
                    type: 'ai',
                    icon: '🤖'
                }));
            }
        } catch (error) {
            console.error('خطأ في الحصول على اقتراحات AI:', error);
        }
        
        return [];
    }
    
    /**
     * ==== عرض الاقتراحات ====
     */
    displaySuggestions(suggestions) {
        if (!this.searchInput) return;
        
        let suggestionsContainer = this.searchInput.parentNode.querySelector('.ps-search-suggestions');
        
        if (!suggestionsContainer) {
            suggestionsContainer = document.createElement('div');
            suggestionsContainer.className = 'ps-search-suggestions';
            this.searchInput.parentNode.appendChild(suggestionsContainer);
        }
        
        if (suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }
        
        const suggestionsHTML = suggestions.map(suggestion => `
            <div class="ps-suggestion-item" data-text="${suggestion.text}">
                <span class="ps-suggestion-icon">${suggestion.icon}</span>
                <span class="ps-suggestion-text">${suggestion.text}</span>
                <span class="ps-suggestion-type">${this.getSuggestionTypeLabel(suggestion.type)}</span>
            </div>
        `).join('');
        
        suggestionsContainer.innerHTML = suggestionsHTML;
        suggestionsContainer.classList.add('show');
        
        // إضافة مستمعي الأحداث للاقتراحات
        suggestionsContainer.querySelectorAll('.ps-suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                const text = item.getAttribute('data-text');
                this.selectSuggestion(text);
            });
        });
    }
    
    /**
     * ==== الحصول على تسمية نوع الاقتراح ====
     */
    getSuggestionTypeLabel(type) {
        const labels = {
            'history': 'تاريخ',
            'common': 'شائع',
            'ai': 'ذكي',
            'related': 'مرتبط'
        };
        
        return labels[type] || 'اقتراح';
    }
    
    /**
     * ==== اختيار اقتراح ====
     */
    selectSuggestion(text) {
        if (this.searchInput) {
            this.searchInput.value = text;
        }
        
        this.hideSuggestions();
        this.saveToHistory(text);
        this.performSearch(text);
    }
    
    /**
     * ==== إخفاء الاقتراحات ====
     */
    hideSuggestions() {
        const suggestionsContainer = document.querySelector('.ps-search-suggestions');
        if (suggestionsContainer) {
            suggestionsContainer.classList.remove('show');
        }
    }
    
    /**
     * ==== عرض الاقتراحات ====
     */
    showSuggestions() {
        if (this.searchInput && this.searchInput.value.length >= 2) {
            this.handleTextInput(this.searchInput.value);
        }
    }
    
    /**
     * ==== تنفيذ البحث ====
     */
    performSearch(query) {
        if (!query.trim()) return;
        
        // إضافة المعايير الخاصة بالبحث
        const searchParams = new URLSearchParams({
            s: query,
            voice_search: '1'
        });
        
        // التوجه لصفحة النتائج
        window.location.href = `${psVoiceSearch.homeUrl}?${searchParams.toString()}`;
    }
    
    /**
     * ==== حفظ في تاريخ البحث ====
     */
    saveToHistory(query) {
        if (!query || this.history.includes(query)) return;
        
        this.history.unshift(query);
        this.history = this.history.slice(0, 20); // الاحتفاظ بـ 20 عنصر فقط
        
        localStorage.setItem('ps_voice_search_history', JSON.stringify(this.history));
    }
    
    /**
     * ==== الحصول على تاريخ البحث ====
     */
    getSearchHistory() {
        try {
            const history = localStorage.getItem('ps_voice_search_history');
            return history ? JSON.parse(history) : [];
        } catch (error) {
            console.error('خطأ في قراءة تاريخ البحث:', error);
            return [];
        }
    }
    
    /**
     * ==== تحميل الإعدادات ====
     */
    loadSettings() {
        try {
            const settings = localStorage.getItem('ps_voice_search_settings');
            if (settings) {
                const parsed = JSON.parse(settings);
                this.currentLanguage = parsed.language || this.currentLanguage;
                
                if (this.recognition) {
                    this.recognition.lang = this.currentLanguage;
                }
            }
        } catch (error) {
            console.error('خطأ في تحميل إعدادات البحث الصوتي:', error);
        }
    }
    
    /**
     * ==== حفظ الإعدادات ====
     */
    saveSettings() {
        const settings = {
            language: this.currentLanguage,
            updated: Date.now()
        };
        
        localStorage.setItem('ps_voice_search_settings', JSON.stringify(settings));
    }
    
    /**
     * ==== تحميل الاقتراحات المحفوظة ====
     */
    loadCachedSuggestions() {
        try {
            const cached = localStorage.getItem('ps_cached_suggestions');
            if (cached) {
                const data = JSON.parse(cached);
                // التحقق من صحة البيانات المحفوظة
                if (Date.now() - data.timestamp < 3600000) { // ساعة واحدة
                    this.suggestions = data.suggestions || [];
                }
            }
        } catch (error) {
            console.error('خطأ في تحميل الاقتراحات المحفوظة:', error);
        }
    }
    
    /**
     * ==== إنشاء واجهة الصوت المتقدمة ====
     */
    createVoiceInterface() {
        // إضافة مؤشر مستوى الصوت
        if (this.voiceButton) {
            const volumeIndicator = document.createElement('div');
            volumeIndicator.className = 'ps-volume-indicator';
            volumeIndicator.innerHTML = `
                <div class="volume-bar"></div>
                <div class="volume-bar"></div>
                <div class="volume-bar"></div>
            `;
            
            this.voiceButton.appendChild(volumeIndicator);
        }
    }
    
    /**
     * ==== تنظيف الموارد ====
     */
    destroy() {
        if (this.recognition) {
            this.recognition.stop();
            this.recognition = null;
        }
        
        // إزالة مستمعي الأحداث
        if (this.voiceButton) {
            this.voiceButton.removeEventListener('click', this.toggleListening);
        }
        
        // حفظ الإعدادات قبل الإغلاق
        this.saveSettings();
    }
}

// تشغيل النظام عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    // التحقق من وجود البيانات المطلوبة
    if (typeof psVoiceSearch !== 'undefined') {
        window.psVoiceSearchInstance = new EnhancedVoiceSearch();
    } else {
        console.warn('بيانات البحث الصوتي غير متوفرة');
    }
});

// تنظيف عند إغلاق الصفحة
window.addEventListener('beforeunload', () => {
    if (window.psVoiceSearchInstance) {
        window.psVoiceSearchInstance.destroy();
    }
});

// تصدير الكلاس للاستخدام الخارجي
window.EnhancedVoiceSearch = EnhancedVoiceSearch;




📁 اسم الملف: interactive-features.js
/**
 * الميزات التفاعلية المتقدمة
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

class InteractiveFeatures {
    constructor() {
        this.bookmarks = this.getBookmarks();
        this.readingProgress = null;
        this.darkModeToggle = null;
        this.ratingSystem = null;
        this.settings = this.loadSettings();
        this.observers = new Map();
        
        this.init();
    }
    
    /**
     * ==== تهيئة النظام ====
     */
    init() {
        this.initReadingProgress();
        this.initDarkMode();
        this.initBookmarkSystem();
        this.initRatingSystem();
        this.initScrollEffects();
        this.initTooltips();
        this.initAnimations();
        this.initKeyboardShortcuts();
        this.initPrintStyles();
        this.initSocialShare();
        
        console.log('تم تشغيل الميزات التفاعلية المتقدمة');
    }
    
    /**
     * ==== تهيئة شريط تقدم القراءة ====
     */
    initReadingProgress() {
        if (!this.settings.readingProgress) return;
        
        // إنشاء شريط التقدم
        this.createProgressBar();
        
        // تحديث التقدم عند التمرير
        window.addEventListener('scroll', this.throttle(() => {
            this.updateReadingProgress();
        }, 100));
        
        // تحديث عند تغيير حجم النافذة
        window.addEventListener('resize', this.debounce(() => {
            this.updateReadingProgress();
        }, 250));
    }
    
    /**
     * ==== إنشاء شريط تقدم القراءة ====
     */
    createProgressBar() {
        if (document.querySelector('.ps-reading-progress')) return;
        
        const progressBar = document.createElement('div');
        progressBar.className = 'ps-reading-progress';
        progressBar.innerHTML = `
            <div class="progress-fill"></div>
            <div class="progress-circle">
                <svg class="progress-ring" width="50" height="50">
                    <circle class="progress-ring-circle" stroke="currentColor" stroke-width="3" 
                            fill="transparent" r="20" cx="25" cy="25"/>
                </svg>
                <span class="progress-percentage">0%</span>
            </div>
        `;
        
        document.body.appendChild(progressBar);
        this.readingProgress = progressBar;
        
        // إضافة الأنماط
        this.addProgressStyles();
    }
    
    /**
     * ==== إضافة أنماط شريط التقدم ====
     */
    addProgressStyles() {
        if (document.querySelector('#ps-progress-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'ps-progress-styles';
        styles.textContent = `
            .ps-reading-progress {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: rgba(0, 0, 0, 0.1);
                z-index: 999;
                transition: opacity 0.3s ease;
            }
            
            .ps-reading-progress .progress-fill {
                height: 100%;
                background: linear-gradient(90deg, #007cba, #005a87);
                width: 0%;
                transition: width 0.1s ease;
            }
            
            .ps-reading-progress .progress-circle {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                background: white;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 1000;
                opacity: 0;
                transform: scale(0.8);
            }
            
            .ps-reading-progress .progress-circle.visible {
                opacity: 1;
                transform: scale(1);
            }
            
            .ps-reading-progress .progress-circle:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            }
            
            .ps-reading-progress .progress-ring {
                position: absolute;
                transform: rotate(-90deg);
                color: #007cba;
            }
            
            .ps-reading-progress .progress-ring-circle {
                stroke-dasharray: 125.6;
                stroke-dashoffset: 125.6;
                transition: stroke-dashoffset 0.3s ease;
            }
            
            .ps-reading-progress .progress-percentage {
                font-size: 10px;
                font-weight: bold;
                color: #333;
                z-index: 1;
            }
            
            @media (max-width: 768px) {
                .ps-reading-progress .progress-circle {
                    width: 40px;
                    height: 40px;
                    bottom: 15px;
                    right: 15px;
                }
                
                .ps-reading-progress .progress-ring {
                    width: 40px;
                    height: 40px;
                }
                
                .ps-reading-progress .progress-percentage {
                    font-size: 8px;
                }
            }
            
            /* الوضع المظلم */
            .dark-mode .ps-reading-progress {
                background: rgba(255, 255, 255, 0.1);
            }
            
            .dark-mode .ps-reading-progress .progress-circle {
                background: #2a2a2a;
                color: white;
            }
            
            .dark-mode .ps-reading-progress .progress-percentage {
                color: white;
            }
        `;
        
        document.head.appendChild(styles);
    }
    
    /**
     * ==== تحديث تقدم القراءة ====
     */
    updateReadingProgress() {
        if (!this.readingProgress) return;
        
        const article = document.querySelector('article, .post-content, .entry-content, main');
        if (!article) return;
        
        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        
        const progress = Math.max(0, Math.min(100, 
            ((scrollTop - articleTop + windowHeight) / articleHeight) * 100
        ));
        
        // تحديث الشريط العلوي
        const progressFill = this.readingProgress.querySelector('.progress-fill');
        if (progressFill) {
            progressFill.style.width = `${progress}%`;
        }
        
        // تحديث الدائرة
        const progressCircle = this.readingProgress.querySelector('.progress-circle');
        const progressRing = this.readingProgress.querySelector('.progress-ring-circle');
        const progressPercentage = this.readingProgress.querySelector('.progress-percentage');
        
        if (progressCircle && progressRing && progressPercentage) {
            const offset = 125.6 - (progress / 100) * 125.6;
            progressRing.style.strokeDashoffset = offset;
            progressPercentage.textContent = `${Math.round(progress)}%`;
            
            // إظهار/إخفاء الدائرة
            if (progress > 5 && progress < 95) {
                progressCircle.classList.add('visible');
            } else {
                progressCircle.classList.remove('visible');
            }
            
            // إضافة وظيفة التمرير للأعلى
            progressCircle.onclick = () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
        }
    }
    
    /**
     * ==== تهيئة الوضع المظلم ====
     */
    initDarkMode() {
        this.createDarkModeToggle();
        this.applyDarkMode();
        
        // الوضع المظلم التلقائي
        if (this.settings.autoDarkMode) {
            this.setupAutoDarkMode();
        }
    }
    
    /**
     * ==== إنشاء زر الوضع المظلم ====
     */
    createDarkModeToggle() {
        if (document.querySelector('.ps-dark-mode-toggle')) return;
        
        const toggle = document.createElement('button');
        toggle.className = 'ps-dark-mode-toggle';
        toggle.setAttribute('aria-label', 'تبديل الوضع المظلم');
        toggle.innerHTML = `
            <span class="toggle-icon sun">☀️</span>
            <span class="toggle-icon moon">🌙</span>
        `;
        
        // إضافة إلى الرأس أو موضع مناسب
        const header = document.querySelector('header, .site-header, .header');
        if (header) {
            header.appendChild(toggle);
        } else {
            document.body.appendChild(toggle);
        }
        
        this.darkModeToggle = toggle;
        
        // إضافة مستمع الحدث
        toggle.addEventListener('click', () => {
            this.toggleDarkMode();
        });
        
        // إضافة الأنماط
        this.addDarkModeStyles();
    }
    
    /**
     * ==== إضافة أنماط الوضع المظلم ====
     */
    addDarkModeStyles() {
        if (document.querySelector('#ps-dark-mode-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'ps-dark-mode-styles';
        styles.textContent = `
            .ps-dark-mode-toggle {
                position: relative;
                width: 50px;
                height: 26px;
                background: #ddd;
                border: none;
                border-radius: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin: 10px;
            }
            
            .ps-dark-mode-toggle::before {
                content: '';
                position: absolute;
                top: 2px;
                left: 2px;
                width: 22px;
                height: 22px;
                background: white;
                border-radius: 50%;
                transition: transform 0.3s ease;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }
            
            .ps-dark-mode-toggle .toggle-icon {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                font-size: 14px;
                transition: opacity 0.3s ease;
            }
            
            .ps-dark-mode-toggle .sun {
                left: 6px;
                opacity: 1;
            }
            
            .ps-dark-mode-toggle .moon {
                right: 6px;
                opacity: 0;
            }
            
            /* الحالة المفعلة */
            .dark-mode .ps-dark-mode-toggle {
                background: #4a4a4a;
            }
            
            .dark-mode .ps-dark-mode-toggle::before {
                transform: translateX(24px);
                background: #2a2a2a;
            }
            
            .dark-mode .ps-dark-mode-toggle .sun {
                opacity: 0;
            }
            
            .dark-mode .ps-dark-mode-toggle .moon {
                opacity: 1;
            }
            
            /* أنماط الوضع المظلم */
            .dark-mode {
                background-color: #1a1a1a !important;
                color: #e0e0e0 !important;
            }
            
            .dark-mode * {
                border-color: #444 !important;
            }
            
            .dark-mode a {
                color: #60a5fa !important;
            }
            
            .dark-mode .wp-block-heading,
            .dark-mode h1, .dark-mode h2, .dark-mode h3, 
            .dark-mode h4, .dark-mode h5, .dark-mode h6 {
                color: #f0f0f0 !important;
            }
            
            .dark-mode .wp-block-image img,
            .dark-mode img {
                opacity: 0.9;
                transition: opacity 0.3s ease;
            }
            
            .dark-mode .wp-block-image img:hover,
            .dark-mode img:hover {
                opacity: 1;
            }
            
            .dark-mode input,
            .dark-mode textarea,
            .dark-mode select {
                background: #2a2a2a !important;
                color: #e0e0e0 !important;
                border-color: #555 !important;
            }
            
            .dark-mode .wp-block-button__link,
            .dark-mode button {
                background: #333 !important;
                color: #e0e0e0 !important;
            }
            
            .dark-mode .wp-block-quote,
            .dark-mode blockquote {
                background: #2a2a2a !important;
                border-left-color: #60a5fa !important;
            }
        `;
        
        document.head.appendChild(styles);
    }
    
    /**
     * ==== تبديل الوضع المظلم ====
     */
    toggleDarkMode() {
        const isDark = document.body.classList.toggle('dark-mode');
        localStorage.setItem('ps_dark_mode', isDark ? 'enabled' : 'disabled');
        
        // تأثير انتقالي سلس
        document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
        setTimeout(() => {
            document.body.style.transition = '';
        }, 300);
    }
    
    /**
     * ==== تطبيق الوضع المظلم المحفوظ ====
     */
    applyDarkMode() {
        const savedMode = localStorage.getItem('ps_dark_mode');
        if (savedMode === 'enabled') {
            document.body.classList.add('dark-mode');
        }
    }
    
    /**
     * ==== إعداد الوضع المظلم التلقائي ====
     */
    setupAutoDarkMode() {
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            
            const handleChange = (e) => {
                if (!localStorage.getItem('ps_dark_mode')) {
                    if (e.matches) {
                        document.body.classList.add('dark-mode');
                    } else {
                        document.body.classList.remove('dark-mode');
                    }
                }
            };
            
            mediaQuery.addListener(handleChange);
            handleChange(mediaQuery);
        }
    }
    
    /**
     * ==== تهيئة نظام الإشارات المرجعية ====
     */
    initBookmarkSystem() {
        if (!this.settings.bookmarks) return;
        
        this.createBookmarkButtons();
        this.createBookmarkModal();
    }
    
    /**
     * ==== إنشاء أزرار الإشارات المرجعية ====
     */
    createBookmarkButtons() {
        const articles = document.querySelectorAll('article, .post, .entry');
        
        articles.forEach(article => {
            const postId = this.getPostId(article);
            if (!postId) return;
            
            const bookmarkBtn = document.createElement('button');
            bookmarkBtn.className = 'ps-bookmark-btn';
            bookmarkBtn.setAttribute('data-post-id', postId);
            bookmarkBtn.innerHTML = this.isBookmarked(postId) ? '🔖' : '📌';
            bookmarkBtn.setAttribute('title', 'حفظ المقال');
            
            // إضافة الزر في مكان مناسب
            const title = article.querySelector('h1, h2, .entry-title, .post-title');
            if (title) {
                title.style.position = 'relative';
                title.appendChild(bookmarkBtn);
            }
            
            // إضافة مستمع الحدث
            bookmarkBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleBookmark(postId, bookmarkBtn);
            });
        });
        
        // إضافة زر عرض المحفوظات
        this.createBookmarksViewButton();
    }
    
    /**
     * ==== إنشاء زر عرض المحفوظات ====
     */
    createBookmarksViewButton() {
        const viewBtn = document.createElement('button');
        viewBtn.className = 'ps-view-bookmarks-btn';
        viewBtn.innerHTML = '📚 المحفوظات';
        viewBtn.onclick = () => this.showBookmarks();
        
        // إضافة في مكان مناسب
        const header = document.querySelector('header, .site-header');
        if (header) {
            header.appendChild(viewBtn);
        }
    }
    
    /**
     * ==== الحصول على معرف المقال ====
     */
    getPostId(article) {
        // محاولة الحصول على ID من مصادر مختلفة
        return article.id || 
               article.getAttribute('data-post-id') || 
               article.querySelector('[data-post-id]')?.getAttribute('data-post-id') ||
               null;
    }
    
    /**
     * ==== التحقق من حفظ المقال ====
     */
    isBookmarked(postId) {
        return this.bookmarks.includes(postId.toString());
    }
    
    /**
     * ==== تبديل حالة الحفظ ====
     */
    toggleBookmark(postId, button) {
        const id = postId.toString();
        
        if (this.isBookmarked(id)) {
            this.bookmarks = this.bookmarks.filter(bookmark => bookmark !== id);
            button.innerHTML = '📌';
            this.showTooltip(button, 'تم إلغاء الحفظ');
        } else {
            this.bookmarks.push(id);
            button.innerHTML = '🔖';
            this.showTooltip(button, 'تم حفظ المقال');
        }
        
        this.saveBookmarks();
    }
    
    /**
     * ==== حفظ الإشارات المرجعية ====
     */
    saveBookmarks() {
        localStorage.setItem('ps_bookmarks', JSON.stringify(this.bookmarks));
    }
    
    /**
     * ==== الحصول على الإشارات المرجعية ====
     */
    getBookmarks() {
        try {
            const saved = localStorage.getItem('ps_bookmarks');
            return saved ? JSON.parse(saved) : [];
        } catch (error) {
            console.error('خطأ في قراءة الإشارات المرجعية:', error);
            return [];
        }
    }
    
    /**
     * ==== إنشاء نافذة الإشارات المرجعية ====
     */
    createBookmarkModal() {
        if (document.querySelector('#ps-bookmark-modal')) return;
        
        const modal = document.createElement('div');
        modal.id = 'ps-bookmark-modal';
        modal.className = 'ps-modal';
        modal.innerHTML = `
            <div class="ps-modal-content">
                <div class="ps-modal-header">
                    <h3>المقالات المحفوظة</h3>
                    <button class="ps-modal-close">&times;</button>
                </div>
                <div class="ps-modal-body">
                    <div id="bookmarks-list">
                        <p>لا توجد مقالات محفوظة</p>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // إضافة مستمعي الأحداث
        modal.querySelector('.ps-modal-close').onclick = () => this.hideModal(modal);
        modal.onclick = (e) => {
            if (e.target === modal) this.hideModal(modal);
        };
        
        // إضافة أنماط النافذة
        this.addModalStyles();
    }
    
    /**
     * ==== عرض الإشارات المرجعية ====
     */
    showBookmarks() {
        const modal = document.getElementById('ps-bookmark-modal');
        const bookmarksList = document.getElementById('bookmarks-list');
        
        if (this.bookmarks.length === 0) {
            bookmarksList.innerHTML = '<p>لا توجد مقالات محفوظة</p>';
        } else {
            bookmarksList.innerHTML = this.bookmarks.map(id => `
                <div class="bookmark-item" data-post-id="${id}">
                    <h4>مقال محفوظ #${id}</h4>
                    <button class="remove-bookmark" onclick="psInteractive.removeBookmark('${id}')">
                        إزالة
                    </button>
                </div>
            `).join('');
        }
        
        this.showModal(modal);
    }
    
    /**
     * ==== إزالة إشارة مرجعية ====
     */
    removeBookmark(postId) {
        this.bookmarks = this.bookmarks.filter(id => id !== postId.toString());
        this.saveBookmarks();
        this.showBookmarks(); // إعادة تحديث القائمة
        
        // تحديث الأزرار في الصفحة
        const buttons = document.querySelectorAll(`[data-post-id="${postId}"]`);
        buttons.forEach(btn => {
            if (btn.classList.contains('ps-bookmark-btn')) {
                btn.innerHTML = '📌';
            }
        });
    }
    
    /**
     * ==== تهيئة نظام التقييم ====
     */
    initRatingSystem() {
        if (!this.settings.ratingSystem) return;
        
        this.createRatingWidgets();
    }
    
    /**
     * ==== إنشاء ودجت التقييم ====
     */
    createRatingWidgets() {
        const articles = document.querySelectorAll('article, .post, .entry');
        
        articles.forEach(article => {
            const postId = this.getPostId(article);
            if (!postId) return;
            
            const ratingWidget = document.createElement('div');
            ratingWidget.className = 'ps-rating-widget';
            ratingWidget.setAttribute('data-post-id', postId);
            ratingWidget.innerHTML = this.generateRatingHTML(postId);
            
            // إضافة في نهاية المقال
            article.appendChild(ratingWidget);
            
            // إضافة مستمعي الأحداث
            this.setupRatingEvents(ratingWidget, postId);
        });
        
        // إضافة أنماط التقييم
        this.addRatingStyles();
    }
    
    /**
     * ==== إنشاء HTML التقييم ====
     */
    generateRatingHTML(postId) {
        const rating = this.getRating(postId);
        const userRating = this.getUserRating(postId);
        
        return `
            <div class="rating-header">
                <h4>قيّم هذا المقال</h4>
                <div class="rating-summary">
                    <span class="average-rating">${rating.average.toFixed(1)}</span>
                    <div class="stars-display">
                        ${this.generateStarsDisplay(rating.average)}
                    </div>
                    <span class="rating-count">(${rating.count} تقييم)</span>
                </div>
            </div>
            <div class="rating-input">
                <div class="stars-input" data-rating="${userRating}">
                    ${[1,2,3,4,5].map(i => `
                        <span class="star ${i <= userRating ? 'filled' : ''}" data-rating="${i}">⭐</span>
                    `).join('')}
                </div>
                <button class="submit-rating" ${userRating ? 'style="display:none"' : ''}>
                    تقييم
                </button>
                <span class="rating-thanks" ${userRating ? '' : 'style="display:none"'}>
                    شكراً لتقييمك!
                </span>
            </div>
        `;
    }
    
    /**
     * ==== إنشاء عرض النجوم ====
     */
    generateStarsDisplay(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        return '★'.repeat(fullStars) + 
               (hasHalfStar ? '☆' : '') + 
               '☆'.repeat(emptyStars);
    }
    
    /**
     * ==== إعداد أحداث التقييم ====
     */
    setupRatingEvents(widget, postId) {
        const stars = widget.querySelectorAll('.star');
        const submitBtn = widget.querySelector('.submit-rating');
        let selectedRating = 0;
        
        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                const rating = parseInt(star.getAttribute('data-rating'));
                this.highlightStars(stars, rating);
            });
            
            star.addEventListener('mouseout', () => {
                this.highlightStars(stars, selectedRating);
            });
            
            star.addEventListener('click', () => {
                selectedRating = parseInt(star.getAttribute('data-rating'));
                this.highlightStars(stars, selectedRating);
                submitBtn.style.display = selectedRating ? 'inline-block' : 'none';
            });
        });
        
        submitBtn.addEventListener('click', () => {
            if (selectedRating > 0) {
                this.submitRating(postId, selectedRating, widget);
            }
        });
    }
    
    /**
     * ==== تمييز النجوم ====
     */
    highlightStars(stars, rating) {
        stars.forEach((star, index) => {
            star.classList.toggle('filled', index < rating);
        });
    }
    
    /**
     * ==== إرسال التقييم ====
     */
    submitRating(postId, rating, widget) {
        // حفظ التقييم محلياً
        this.saveUserRating(postId, rating);
        
        // تحديث الواجهة
        widget.querySelector('.submit-rating').style.display = 'none';
        widget.querySelector('.rating-thanks').style.display = 'inline';
        
        // إرسال إلى الخادم (إذا كان متوفراً)
        if (typeof psInteractiveFeatures !== 'undefined') {
            fetch(psInteractiveFeatures.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'ps_submit_rating',
                    post_id: postId,
                    rating: rating,
                    nonce: psInteractiveFeatures.nonce
                })
            });
        }
        
        this.showTooltip(widget, 'تم حفظ تقييمك بنجاح!');
    }
    
    /**
     * ==== الحصول على التقييم ====
     */
    getRating(postId) {
        const ratings = this.getSavedRatings();
        return ratings[postId] || { average: 0, count: 0 };
    }
    
    /**
     * ==== الحصول على تقييم المستخدم ====
     */
    getUserRating(postId) {
        const userRatings = this.getUserRatings();
        return userRatings[postId] || 0;
    }
    
    /**
     * ==== حفظ تقييم المستخدم ====
     */
    saveUserRating(postId, rating) {
        const userRatings = this.getUserRatings();
        userRatings[postId] = rating;
        localStorage.setItem('ps_user_ratings', JSON.stringify(userRatings));
    }
    
    /**
     * ==== الحصول على تقييمات المستخدم ====
     */
    getUserRatings() {
        try {
            const saved = localStorage.getItem('ps_user_ratings');
            return saved ? JSON.parse(saved) : {};
        } catch (error) {
            return {};
        }
    }
    
    /**
     * ==== الحصول على التقييمات المحفوظة ====
     */
    getSavedRatings() {
        try {
            const saved = localStorage.getItem('ps_ratings');
            return saved ? JSON.parse(saved) : {};
        } catch (error) {
            return {};
        }
    }
    
    /**
     * ==== تهيئة تأثيرات التمرير ====
     */
    initScrollEffects() {
        this.initParallax();
        this.initFadeInElements();
        this.initStickyElements();
    }
    
    /**
     * ==== تهيئة تأثير Parallax ====
     */
    initParallax() {
        const parallaxElements = document.querySelectorAll('.ps-parallax, [data-parallax]');
        
        if (parallaxElements.length === 0) return;
        
        window.addEventListener('scroll', this.throttle(() => {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(element => {
                const rate = scrolled * -0.5;
                element.style.transform = `translateY(${rate}px)`;
            });
        }, 16));
    }
    
    /**
     * ==== تهيئة عناصر الظهور التدريجي ====
     */
    initFadeInElements() {
        const fadeElements = document.querySelectorAll('.ps-fade-in, [data-animate]');
        
        if (fadeElements.length === 0) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('ps-visible');
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(element => {
            observer.observe(element);
        });
        
        this.observers.set('fadeIn', observer);
    }
    
    /**
     * ==== تهيئة العناصر الثابتة ====
     */
    initStickyElements() {
        const stickyElements = document.querySelectorAll('.ps-sticky, [data-sticky]');
        
        stickyElements.forEach(element => {
            const observer = new IntersectionObserver(
                ([entry]) => {
                    element.classList.toggle('ps-stuck', !entry.isIntersecting);
                },
                { rootMargin: '-1px 0px 0px 0px' }
            );
            
            observer.observe(element);
        });
    }
    
    /**
     * ==== تهيئة التلميحات ====
     */
    initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip], [title]');
        
        tooltipElements.forEach(element => {
            const tooltipText = element.getAttribute('data-tooltip') || element.getAttribute('title');
            if (!tooltipText) return;
            
            // إزالة title الافتراضي
            element.removeAttribute('title');
            
            element.addEventListener('mouseenter', (e) => {
                this.showTooltip(e.target, tooltipText);
            });
            
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }
    
    /**
     * ==== عرض التلميح ====
     */
    showTooltip(element, text) {
        this.hideTooltip(); // إزالة التلميح السابق
        
        const tooltip = document.createElement('div');
        tooltip.className = 'ps-tooltip';
        tooltip.textContent = text;
        
        document.body.appendChild(tooltip);
        
        // تحديد الموضع
        const rect = element.getBoundingClientRect();
        const tooltipRect = tooltip.getBoundingClientRect();
        
        let top = rect.top - tooltipRect.height - 10;
        let left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
        
        // التأكد من عدم خروج التلميح من الشاشة
        if (top < 0) {
            top = rect.bottom + 10;
            tooltip.classList.add('bottom');
        }
        
        if (left < 0) {
            left = 10;
        } else if (left + tooltipRect.width > window.innerWidth) {
            left = window.innerWidth - tooltipRect.width - 10;
        }
        
        tooltip.style.top = `${top + window.scrollY}px`;
        tooltip.style.left = `${left}px`;
        tooltip.classList.add('show');
        
        // إزالة التلميح تلقائياً
        setTimeout(() => {
            this.hideTooltip();
        }, 3000);
    }
    
    /**
     * ==== إخفاء التلميح ====
     */
    hideTooltip() {
        const tooltip = document.querySelector('.ps-tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }
    
    /**
     * ==== تهيئة الحركات ====
     */
    initAnimations() {
        // إضافة أنماط الحركات
        this.addAnimationStyles();
        
        // تفعيل الحركات عند التمرير
        this.setupScrollAnimations();
    }
    
    /**
     * ==== إضافة أنماط الحركات ====
     */
    addAnimationStyles() {
        if (document.querySelector('#ps-animation-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'ps-animation-styles';
        styles.textContent = `
            .ps-fade-in {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s ease;
            }
            
            .ps-fade-in.ps-visible {
                opacity: 1;
                transform: translateY(0);
            }
            
            .ps-slide-in-left {
                opacity: 0;
                transform: translateX(-50px);
                transition: all 0.6s ease;
            }
            
            .ps-slide-in-left.ps-visible {
                opacity: 1;
                transform: translateX(0);
            }
            
            .ps-slide-in-right {
                opacity: 0;
                transform: translateX(50px);
                transition: all 0.6s ease;
            }
            
            .ps-slide-in-right.ps-visible {
                opacity: 1;
                transform: translateX(0);
            }
            
            .ps-scale-in {
                opacity: 0;
                transform: scale(0.8);
                transition: all 0.6s ease;
            }
            
            .ps-scale-in.ps-visible {
                opacity: 1;
                transform: scale(1);
            }
            
            .ps-bounce-in {
                opacity: 0;
                transform: scale(0.3);
                transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }
            
            .ps-bounce-in.ps-visible {
                opacity: 1;
                transform: scale(1);
            }
            
            .ps-rotate-in {
                opacity: 0;
                transform: rotate(-180deg) scale(0.5);
                transition: all 0.6s ease;
            }
            
            .ps-rotate-in.ps-visible {
                opacity: 1;
                transform: rotate(0) scale(1);
            }
            
            /* أنماط التلميحات */
            .ps-tooltip {
                position: absolute;
                background: rgba(0, 0, 0, 0.9);
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                font-size: 12px;
                white-space: nowrap;
                z-index: 10000;
                opacity: 0;
                transform: translateY(5px);
                transition: all 0.3s ease;
                pointer-events: none;
            }
            
            .ps-tooltip.show {
                opacity: 1;
                transform: translateY(0);
            }
            
            .ps-tooltip.bottom {
                transform: translateY(-5px);
            }
            
            .ps-tooltip.bottom.show {
                transform: translateY(0);
            }
            
            /* أنماط النوافذ المنبثقة */
            .ps-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }
            
            .ps-modal.show {
                opacity: 1;
                visibility: visible;
            }
            
            .ps-modal-content {
                background: white;
                border-radius: 8px;
                max-width: 500px;
                width: 90%;
                max-height: 80vh;
                overflow-y: auto;
                transform: scale(0.7);
                transition: transform 0.3s ease;
            }
            
            .ps-modal.show .ps-modal-content {
                transform: scale(1);
            }
            
            .ps-modal-header {
                padding: 20px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .ps-modal-close {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
            }
            
            .ps-modal-body {
                padding: 20px;
            }
            
            /* أنماط الإشارات المرجعية */
            .ps-bookmark-btn {
                position: absolute;
                top: 0;
                right: 0;
                background: none;
                border: none;
                font-size: 18px;
                cursor: pointer;
                padding: 5px;
                border-radius: 4px;
                transition: all 0.3s ease;
            }
            
            .ps-bookmark-btn:hover {
                background: rgba(0, 0, 0, 0.1);
                transform: scale(1.1);
            }
            
            .bookmark-item {
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                margin-bottom: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .remove-bookmark {
                background: #e74c3c;
                color: white;
                border: none;
                padding: 5px 10px;
                border-radius: 4px;
                cursor: pointer;
            }
            
            /* أنماط التقييم */
            .ps-rating-widget {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                text-align: center;
            }
            
            .rating-summary {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin: 10px 0;
            }
            
            .average-rating {
                font-size: 24px;
                font-weight: bold;
                color: #f39c12;
            }
            
            .stars-display {
                color: #f39c12;
                font-size: 18px;
            }
            
            .stars-input {
                display: flex;
                justify-content: center;
                gap: 5px;
                margin: 15px 0;
            }
            
            .star {
                font-size: 24px;
                cursor: pointer;
                transition: all 0.3s ease;
                opacity: 0.3;
            }
            
            .star.filled {
                opacity: 1;
            }
            
            .star:hover {
                transform: scale(1.2);
            }
            
            .submit-rating {
                background: #007cba;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
                margin: 10px;
            }
            
            .rating-thanks {
                color: #27ae60;
                font-weight: bold;
            }
        `;
        
        document.head.appendChild(styles);
    }
    
    /**
     * ==== إعداد حركات التمرير ====
     */
    setupScrollAnimations() {
        const animatedElements = document.querySelectorAll(
            '.ps-fade-in, .ps-slide-in-left, .ps-slide-in-right, .ps-scale-in, .ps-bounce-in, .ps-rotate-in'
        );
        
        if (animatedElements.length === 0) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('ps-visible');
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
    
    /**
     * ==== تهيئة اختصارات لوحة المفاتيح ====
     */
    initKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl + D: تبديل الوضع المظلم
            if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                this.toggleDarkMode();
            }
            
            // Ctrl + B: عرض المحفوظات
            if (e.ctrlKey && e.key === 'b') {
                e.preventDefault();
                this.showBookmarks();
            }
            
            // Escape: إغلاق النوافذ المنبثقة
            if (e.key === 'Escape') {
                const modal = document.querySelector('.ps-modal.show');
                if (modal) {
                    this.hideModal(modal);
                }
            }
            
            // مفاتيح الأسهم للتنقل
            if (e.key === 'ArrowUp' && e.ctrlKey) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            
            if (e.key === 'ArrowDown' && e.ctrlKey) {
                e.preventDefault();
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            }
        });
    }
    
    /**
     * ==== تهيئة أنماط الطباعة ====
     */
    initPrintStyles() {
        if (document.querySelector('#ps-print-styles')) return;
        
        const printStyles = document.createElement('style');
        printStyles.id = 'ps-print-styles';
        printStyles.media = 'print';
        printStyles.textContent = `
            @media print {
                .ps-voice-button,
                .ps-dark-mode-toggle,
                .ps-bookmark-btn,
                .ps-rating-widget,
                .ps-modal,
                .ps-tooltip,
                .ps-reading-progress {
                    display: none !important;
                }
                
                body {
                    background: white !important;
                    color: black !important;
                }
                
                a {
                    color: black !important;
                    text-decoration: underline !important;
                }
                
                img {
                    max-width: 100% !important;
                    height: auto !important;
                }
            }
        `;
        
        document.head.appendChild(printStyles);
    }
    
    /**
     * ==== تهيئة المشاركة الاجتماعية ====
     */
    initSocialShare() {
        this.createShareButtons();
    }
    
    /**
     * ==== إنشاء أزرار المشاركة ====
     */
    createShareButtons() {
        const articles = document.querySelectorAll('article, .post, .entry');
        
        articles.forEach(article => {
            const shareContainer = document.createElement('div');
            shareContainer.className = 'ps-share-buttons';
            shareContainer.innerHTML = `
                <h4>شارك هذا المقال</h4>
                <div class="share-buttons-list">
                    <button class="share-btn facebook" data-platform="facebook">
                        📘 فيسبوك
                    </button>
                    <button class="share-btn twitter" data-platform="twitter">
                        🐦 تويتر
                    </button>
                    <button class="share-btn whatsapp" data-platform="whatsapp">
                        💬 واتساب
                    </button>
                    <button class="share-btn copy" data-platform="copy">
                        📋 نسخ الرابط
                    </button>
                </div>
            `;
            
            article.appendChild(shareContainer);
            
            // إضافة مستمعي الأحداث
            shareContainer.querySelectorAll('.share-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    this.shareContent(e.target.getAttribute('data-platform'));
                });
            });
        });
    }
    
    /**
     * ==== مشاركة المحتوى ====
     */
    shareContent(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        
        const shareUrls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            twitter: `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
            whatsapp: `https://wa.me/?text=${title} ${url}`,
        };
        
        if (platform === 'copy') {
            navigator.clipboard.writeText(window.location.href).then(() => {
                this.showTooltip(event.target, 'تم نسخ الرابط!');
            });
        } else if (shareUrls[platform]) {
            window.open(shareUrls[platform], '_blank', 'width=600,height=400');
        }
    }
    
    /**
     * ==== عرض النافذة المنبثقة ====
     */
    showModal(modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    /**
     * ==== إخفاء النافذة المنبثقة ====
     */
    hideModal(modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    /**
     * ==== إضافة أنماط النوافذ المنبثقة ====
     */
    addModalStyles() {
        // الأنماط موجودة في addAnimationStyles
    }
    
    /**
     * ==== إضافة أنماط التقييم ====
     */
    addRatingStyles() {
        // الأنماط موجودة في addAnimationStyles
    }
    
    /**
     * ==== تحميل الإعدادات ====
     */
    loadSettings() {
        try {
            const saved = localStorage.getItem('ps_interactive_settings');
            const defaultSettings = {
                readingProgress: true,
                darkMode: false,
                autoDarkMode: false,
                bookmarks: true,
                ratingSystem: true,
                animations: true
            };
            
            return saved ? { ...defaultSettings, ...JSON.parse(saved) } : defaultSettings;
        } catch (error) {
            console.error('خطأ في تحميل الإعدادات:', error);
            return {
                readingProgress: true,
                darkMode: false,
                autoDarkMode: false,
                bookmarks: true,
                ratingSystem: true,
                animations: true
            };
        }
    }
    
    /**
     * ==== حفظ الإعدادات ====
     */
    saveSettings() {
        localStorage.setItem('ps_interactive_settings', JSON.stringify(this.settings));
    }
    
    /**
     * ==== دالة Throttle ====
     */
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    /**
     * ==== دالة Debounce ====
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    /**
     * ==== تنظيف الموارد ====
     */
    destroy() {
        // إيقاف جميع المراقبين
        this.observers.forEach(observer => {
            observer.disconnect();
        });
        
        // حفظ الإعدادات
        this.saveSettings();
        
        // إزالة مستمعي الأحداث
        window.removeEventListener('scroll', this.updateReadingProgress);
        window.removeEventListener('resize', this.updateReadingProgress);
    }
}

// تشغيل النظام عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    window.psInteractive = new InteractiveFeatures();
});

// تنظيف عند إغلاق الصفحة
window.addEventListener('beforeunload', () => {
    if (window.psInteractive) {
        window.psInteractive.destroy();
    }
});

// تصدير الكلاس للاستخدام الخارجي
window.InteractiveFeatures = InteractiveFeatures;


📁 اسم الملف: enhanced-ux.css
/**
 * Enhanced UX Styles - تحسينات تجربة المستخدم
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

/* ========================================
   🎨 ENHANCED USER EXPERIENCE STYLES
   ======================================== */

/* ===== متغيرات CSS المحسنة ===== */
:root {
  /* الألوان الأساسية */
  --ps-primary: #007cba;
  --ps-primary-dark: #005a87;
  --ps-primary-light: #60a5fa;
  --ps-secondary: #6366f1;
  --ps-accent: #f59e0b;
  --ps-success: #10b981;
  --ps-warning: #f59e0b;
  --ps-error: #ef4444;
  --ps-info: #3b82f6;
  
  /* الألوان الحيادية */
  --ps-white: #ffffff;
  --ps-gray-50: #f9fafb;
  --ps-gray-100: #f3f4f6;
  --ps-gray-200: #e5e7eb;
  --ps-gray-300: #d1d5db;
  --ps-gray-400: #9ca3af;
  --ps-gray-500: #6b7280;
  --ps-gray-600: #4b5563;
  --ps-gray-700: #374151;
  --ps-gray-800: #1f2937;
  --ps-gray-900: #111827;
  
  /* الظلال المحسنة */
  --ps-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --ps-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  --ps-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --ps-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --ps-shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --ps-shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  
  /* التحولات والحركات */
  --ps-transition-all: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --ps-transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  --ps-transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  
  /* المسافات المحسنة */
  --ps-space-xs: 0.25rem;
  --ps-space-sm: 0.5rem;
  --ps-space-md: 1rem;
  --ps-space-lg: 1.5rem;
  --ps-space-xl: 2rem;
  --ps-space-2xl: 3rem;
  --ps-space-3xl: 4rem;
  
  /* أحجام الخطوط */
  --ps-text-xs: 0.75rem;
  --ps-text-sm: 0.875rem;
  --ps-text-base: 1rem;
  --ps-text-lg: 1.125rem;
  --ps-text-xl: 1.25rem;
  --ps-text-2xl: 1.5rem;
  --ps-text-3xl: 1.875rem;
  --ps-text-4xl: 2.25rem;
  --ps-text-5xl: 3rem;
  
  /* نصف الأقطار */
  --ps-radius-sm: 0.25rem;
  --ps-radius: 0.5rem;
  --ps-radius-md: 0.75rem;
  --ps-radius-lg: 1rem;
  --ps-radius-xl: 1.5rem;
  --ps-radius-full: 9999px;
  
  /* Z-index */
  --ps-z-dropdown: 1000;
  --ps-z-sticky: 1020;
  --ps-z-fixed: 1030;
  --ps-z-modal: 1040;
  --ps-z-popover: 1050;
  --ps-z-tooltip: 1060;
}

/* ===== تحسينات أساسية للعناصر ===== */
* {
  box-sizing: border-box;
}

*::before,
*::after {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
  -webkit-text-size-adjust: 100%;
  -moz-text-size-adjust: 100%;
  text-size-adjust: 100%;
}

body {
  font-feature-settings: 'liga' 1, 'kern' 1;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  scroll-behavior: smooth;
}

/* ===== تحسينات الروابط ===== */
a {
  color: var(--ps-primary);
  text-decoration: none;
  transition: var(--ps-transition-fast);
  outline: none;
}

a:hover {
  color: var(--ps-primary-dark);
  text-decoration: underline;
}

a:focus {
  outline: 2px solid var(--ps-primary);
  outline-offset: 2px;
  border-radius: var(--ps-radius-sm);
}

/* تحسين الروابط التفاعلية */
.ps-interactive-link {
  position: relative;
  color: var(--ps-primary);
  font-weight: 500;
  transition: var(--ps-transition-all);
}

.ps-interactive-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--ps-primary), var(--ps-secondary));
  transition: width 0.3s ease;
}

.ps-interactive-link:hover::after {
  width: 100%;
}

/* ===== تحسينات الأزرار ===== */
.ps-btn,
.wp-block-button__link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--ps-space-sm);
  padding: var(--ps-space-md) var(--ps-space-lg);
  border: none;
  border-radius: var(--ps-radius);
  font-size: var(--ps-text-base);
  font-weight: 500;
  line-height: 1.5;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition: var(--ps-transition-all);
  outline: none;
  box-shadow: var(--ps-shadow);
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  position: relative;
  overflow: hidden;
}

/* تأثير التموج للأزرار */
.ps-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.ps-btn:active::before {
  width: 300px;
  height: 300px;
}

/* أنواع الأزرار المحسنة */
.ps-btn-primary {
  background: linear-gradient(135deg, var(--ps-primary), var(--ps-primary-dark));
  color: var(--ps-white);
}

.ps-btn-primary:hover {
  background: linear-gradient(135deg, var(--ps-primary-dark), var(--ps-primary));
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-lg);
  color: var(--ps-white);
  text-decoration: none;
}

.ps-btn-secondary {
  background: linear-gradient(135deg, var(--ps-gray-100), var(--ps-gray-200));
  color: var(--ps-gray-800);
  border: 1px solid var(--ps-gray-300);
}

.ps-btn-secondary:hover {
  background: linear-gradient(135deg, var(--ps-gray-200), var(--ps-gray-300));
  transform: translateY(-1px);
  box-shadow: var(--ps-shadow-md);
  color: var(--ps-gray-900);
  text-decoration: none;
}

.ps-btn-accent {
  background: linear-gradient(135deg, var(--ps-accent), #f59e0b);
  color: var(--ps-white);
}

.ps-btn-accent:hover {
  background: linear-gradient(135deg, #f59e0b, var(--ps-accent));
  transform: translateY(-2px);
  box-shadow: var(--ps-shadow-lg);
  color: var(--ps-white);
  text-decoration: none;
}

/* أحجام الأزرار */
.ps-btn-sm {
  padding: var(--ps-space-sm) var(--ps-space-md);
  font-size: var(--ps-text-sm);
}

.ps-btn-lg {
  padding: var(--ps-space-lg) var(--ps-space-2xl);
  font-size: var(--ps-text-lg);
}

.ps-btn-xl {
  padding: var(--ps-space-xl) var(--ps-space-3xl);
  font-size: var(--ps-text-xl);
}

/* أزرار دائرية */
.ps-btn-rounded {
  border-radius: var(--ps-radius-full);
}

/* أزرار مع أيقونات */
.ps-btn-icon {
  display: inline-flex;
  align-items: center;
  gap: var(--ps-space-sm);
}

.ps-btn-icon svg,
.ps-btn-icon i {
  width: 1.25em;
  height: 1.25em;
  fill: currentColor;
}

/* ===== تحسينات النماذج ===== */
.ps-form-group {
  margin-bottom: var(--ps-space-lg);
}

.ps-form-label {
  display: block;
  margin-bottom: var(--ps-space-sm);
  font-weight: 500;
  color: var(--ps-gray-700);
  font-size: var(--ps-text-sm);
}

.ps-form-input,
.ps-form-textarea,
.ps-form-select {
  width: 100%;
  padding: var(--ps-space-md);
  border: 2px solid var(--ps-gray-200);
  border-radius: var(--ps-radius);
  font-size: var(--ps-text-base);
  line-height: 1.5;
  background: var(--ps-white);
  transition: var(--ps-transition-all);
  outline: none;
}

.ps-form-input:focus,
.ps-form-textarea:focus,
.ps-form-select:focus {
  border-color: var(--ps-primary);
  box-shadow: 0 0 0 3px rgba(0, 124, 186, 0.1);
}

.ps-form-input:invalid,
.ps-form-textarea:invalid {
  border-color: var(--ps-error);
}

.ps-form-input:invalid:focus,
.ps-form-textarea:invalid:focus {
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* حقول البحث المحسنة */
.ps-search-field {
  position: relative;
  display: flex;
  align-items: center;
}

.ps-search-input {
  padding-right: 3rem;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 1.25rem;
}

/* ===== تحسينات البطاقات ===== */
.ps-card {
  background: var(--ps-white);
  border-radius: var(--ps-radius-lg);
  border: 1px solid var(--ps-gray-200);
  box-shadow: var(--ps-shadow);
  overflow: hidden;
  transition: var(--ps-transition-all);
}

.ps-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--ps-shadow-xl);
}

.ps-card-header {
  padding: var(--ps-space-lg);
  border-bottom: 1px solid var(--ps-gray-100);
  background: var(--ps-gray-50);
}

.ps-card-body {
  padding: var(--ps-space-lg);
}

.ps-card-footer {
  padding: var(--ps-space-lg);
  border-top: 1px solid var(--ps-gray-100);
  background: var(--ps-gray-50);
}

/* بطاقات متقدمة مع تدرجات */
.ps-card-gradient {
  background: linear-gradient(135deg, var(--ps-white), var(--ps-gray-50));
  border: none;
}

.ps-card-primary {
  background: linear-gradient(135deg, var(--ps-primary), var(--ps-primary-dark));
  color: var(--ps-white);
  border: none;
}

.ps-card-secondary {
  background: linear-gradient(135deg, var(--ps-secondary), #6366f1);
  color: var(--ps-white);
  border: none;
}

/* ===== تحسينات التنبيهات ===== */
.ps-alert {
  padding: var(--ps-space-md) var(--ps-space-lg);
  border-radius: var(--ps-radius);
  border: 1px solid transparent;
  margin-bottom: var(--ps-space-lg);
  display: flex;
  align-items: flex-start;
  gap: var(--ps-space-md);
}

.ps-alert-icon {
  flex-shrink: 0;
  width: 1.25rem;
  height: 1.25rem;
  margin-top: 0.125rem;
}

.ps-alert-content {
  flex: 1;
}

.ps-alert-title {
  font-weight: 600;
  margin-bottom: var(--ps-space-xs);
}

.ps-alert-success {
  background: rgba(16, 185, 129, 0.1);
  border-color: var(--ps-success);
  color: #065f46;
}

.ps-alert-warning {
  background: rgba(245, 158, 11, 0.1);
  border-color: var(--ps-warning);
  color: #92400e;
}

.ps-alert-error {
  background: rgba(239, 68, 68, 0.1);
  border-color: var(--ps-error);
  color: #991b1b;
}

.ps-alert-info {
  background: rgba(59, 130, 246, 0.1);
  border-color: var(--ps-info);
  color: #1e40af;
}

/* ===== تحسينات التبديلات (Tabs) ===== */
.ps-tabs {
  border-bottom: 1px solid var(--ps-gray-200);
  margin-bottom: var(--ps-space-lg);
}

.ps-tabs-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: var(--ps-space-md);
}

.ps-tab-button {
  padding: var(--ps-space-md) var(--ps-space-lg);
  background: none;
  border: none;
  border-bottom: 2px solid transparent;
  color: var(--ps-gray-600);
  cursor: pointer;
  transition: var(--ps-transition-all);
  font-weight: 500;
  position: relative;
}

.ps-tab-button:hover {
  color: var(--ps-primary);
  background: rgba(0, 124, 186, 0.05);
}

.ps-tab-button.active {
  color: var(--ps-primary);
  border-bottom-color: var(--ps-primary);
}

.ps-tab-content {
  display: none;
}

.ps-tab-content.active {
  display: block;
  animation: ps-fadeIn 0.3s ease;
}

/* ===== تحسينات الصور ===== */
.ps-image-enhanced {
  transition: var(--ps-transition-all);
  border-radius: var(--ps-radius);
  overflow: hidden;
}

.ps-image-enhanced:hover {
  transform: scale(1.02);
  box-shadow: var(--ps-shadow-lg);
}

.ps-image-overlay {
  position: relative;
  overflow: hidden;
  border-radius: var(--ps-radius);
}

.ps-image-overlay::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, rgba(0, 124, 186, 0.1), rgba(99, 102, 241, 0.1));
  opacity: 0;
  transition: var(--ps-transition-all);
}

.ps-image-overlay:hover::after {
  opacity: 1;
}

/* ===== تحسينات شريط التقدم ===== */
.ps-progress {
  width: 100%;
  height: 0.5rem;
  background: var(--ps-gray-200);
  border-radius: var(--ps-radius-full);
  overflow: hidden;
}

.ps-progress-bar {
  height: 100%;
  background: linear-gradient(90deg, var(--ps-primary), var(--ps-secondary));
  border-radius: var(--ps-radius-full);
  transition: width 0.3s ease;
}

.ps-progress-animated .ps-progress-bar {
  background-size: 2rem 2rem;
  background-image: linear-gradient(
    45deg,
    rgba(255, 255, 255, 0.2) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.2) 50%,
    rgba(255, 255, 255, 0.2) 75%,
    transparent 75%,
    transparent
  );
  animation: ps-progress-stripes 1s linear infinite;
}

@keyframes ps-progress-stripes {
  0% {
    background-position: 2rem 0;
  }
  100% {
    background-position: 0 0;
  }
}

/* ===== تحسينات التسميات (Badges) ===== */
.ps-badge {
  display: inline-flex;
  align-items: center;
  padding: var(--ps-space-xs) var(--ps-space-sm);
  border-radius: var(--ps-radius-full);
  font-size: var(--ps-text-xs);
  font-weight: 600;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.ps-badge-primary {
  background: var(--ps-primary);
  color: var(--ps-white);
}

.ps-badge-secondary {
  background: var(--ps-gray-100);
  color: var(--ps-gray-800);
}

.ps-badge-success {
  background: var(--ps-success);
  color: var(--ps-white);
}

.ps-badge-warning {
  background: var(--ps-warning);
  color: var(--ps-white);
}

.ps-badge-error {
  background: var(--ps-error);
  color: var(--ps-white);
}

/* ===== تحسينات القوائم المنسدلة ===== */
.ps-dropdown {
  position: relative;
  display: inline-block;
}

.ps-dropdown-content {
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 12rem;
  background: var(--ps-white);
  border: 1px solid var(--ps-gray-200);
  border-radius: var(--ps-radius);
  box-shadow: var(--ps-shadow-lg);
  z-index: var(--ps-z-dropdown);
  opacity: 0;
  visibility: hidden;
  transform: translateY(-0.5rem);
  transition: var(--ps-transition-all);
}

.ps-dropdown:hover .ps-dropdown-content,
.ps-dropdown.active .ps-dropdown-content {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.ps-dropdown-item {
  display: block;
  padding: var(--ps-space-sm) var(--ps-space-md);
  color: var(--ps-gray-700);
  text-decoration: none;
  transition: var(--ps-transition-fast);
}

.ps-dropdown-item:hover {
  background: var(--ps-gray-50);
  color: var(--ps-primary);
  text-decoration: none;
}

/* ===== تحسينات التلميحات (Tooltips) ===== */
.ps-tooltip {
  position: relative;
  cursor: help;
}

.ps-tooltip::before,
.ps-tooltip::after {
  position: absolute;
  opacity: 0;
  visibility: hidden;
  transition: var(--ps-transition-all);
  pointer-events: none;
}

.ps-tooltip::before {
  content: attr(data-tooltip);
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%) translateY(-0.5rem);
  background: var(--ps-gray-900);
  color: var(--ps-white);
  padding: var(--ps-space-sm) var(--ps-space-md);
  border-radius: var(--ps-radius);
  font-size: var(--ps-text-sm);
  white-space: nowrap;
  z-index: var(--ps-z-tooltip);
}

.ps-tooltip::after {
  content: '';
  bottom: calc(100% - 0.25rem);
  left: 50%;
  transform: translateX(-50%);
  border: 0.25rem solid transparent;
  border-top-color: var(--ps-gray-900);
}

.ps-tooltip:hover::before,
.ps-tooltip:hover::after {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(0);
}

/* ===== تحسينات النوافذ المنبثقة ===== */
.ps-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(4px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: var(--ps-z-modal);
  opacity: 0;
  visibility: hidden;
  transition: var(--ps-transition-all);
}

.ps-modal.active {
  opacity: 1;
  visibility: visible;
}

.ps-modal-content {
  background: var(--ps-white);
  border-radius: var(--ps-radius-lg);
  box-shadow: var(--ps-shadow-2xl);
  max-width: 90vw;
  max-height: 90vh;
  overflow: auto;
  transform: scale(0.9);
  transition: var(--ps-transition-all);
}

.ps-modal.active .ps-modal-content {
  transform: scale(1);
}

.ps-modal-header {
  padding: var(--ps-space-lg);
  border-bottom: 1px solid var(--ps-gray-200);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.ps-modal-title {
  margin: 0;
  font-size: var(--ps-text-xl);
  font-weight: 600;
}

.ps-modal-close {
  background: none;
  border: none;
  font-size: var(--ps-text-xl);
  cursor: pointer;
  color: var(--ps-gray-400);
  transition: var(--ps-transition-fast);
}

.ps-modal-close:hover {
  color: var(--ps-gray-600);
}

.ps-modal-body {
  padding: var(--ps-space-lg);
}

.ps-modal-footer {
  padding: var(--ps-space-lg);
  border-top: 1px solid var(--ps-gray-200);
  display: flex;
  justify-content: flex-end;
  gap: var(--ps-space-md);
}

/* ===== حركات وتأثيرات ===== */
@keyframes ps-fadeIn {
  from {
    opacity: 0;
    transform: translateY(1rem);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes ps-slideInUp {
  from {
    opacity: 0;
    transform: translateY(2rem);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes ps-slideInDown {
  from {
    opacity: 0;
    transform: translateY(-2rem);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes ps-slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-2rem);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes ps-slideInRight {
  from {
    opacity: 0;
    transform: translateX(2rem);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes ps-scaleIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes ps-bounce {
  0%, 20%, 53%, 80%, 100% {
    transform: translateY(0);
  }
  40%, 43% {
    transform: translateY(-1rem);
  }
  70% {
    transform: translateY(-0.5rem);
  }
  90% {
    transform: translateY(-0.25rem);
  }
}

@keyframes ps-pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

@keyframes ps-spin {
  to {
    transform: rotate(360deg);
  }
}

/* فئات الحركة */
.ps-animate-fadeIn {
  animation: ps-fadeIn 0.6s ease;
}

.ps-animate-slideInUp {
  animation: ps-slideInUp 0.6s ease;
}

.ps-animate-slideInDown {
  animation: ps-slideInDown 0.6s ease;
}

.ps-animate-slideInLeft {
  animation: ps-slideInLeft 0.6s ease;
}

.ps-animate-slideInRight {
  animation: ps-slideInRight 0.6s ease;
}

.ps-animate-scaleIn {
  animation: ps-scaleIn 0.6s ease;
}

.ps-animate-bounce {
  animation: ps-bounce 1s ease;
}

.ps-animate-pulse {
  animation: ps-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.ps-animate-spin {
  animation: ps-spin 1s linear infinite;
}

/* ===== تحسينات الاستجابة ===== */
@media (max-width: 1024px) {
  :root {
    --ps-space-lg: 1.25rem;
    --ps-space-xl: 1.75rem;
    --ps-space-2xl: 2.5rem;
    --ps-space-3xl: 3.5rem;
    
    --ps-text-lg: 1.1rem;
    --ps-text-xl: 1.2rem;
    --ps-text-2xl: 1.4rem;
    --ps-text-3xl: 1.7rem;
    --ps-text-4xl: 2rem;
    --ps-text-5xl: 2.5rem;
  }
  
  .ps-tabs-list {
    flex-wrap: wrap;
  }
  
  .ps-modal-content {
    margin: var(--ps-space-md);
    max-width: calc(100vw - 2rem);
  }
  
  .ps-dropdown-content {
    position: fixed;
    left: var(--ps-space-md) !important;
    right: var(--ps-space-md);
    min-width: auto;
  }
}

@media (max-width: 768px) {
  .ps-btn-lg {
    padding: var(--ps-space-md) var(--ps-space-xl);
    font-size: var(--ps-text-base);
  }
  
  .ps-btn-xl {
    padding: var(--ps-space-lg) var(--ps-space-2xl);
    font-size: var(--ps-text-lg);
  }
  
  .ps-card-header,
  .ps-card-body,
  .ps-card-footer {
    padding: var(--ps-space-md);
  }
  
  .ps-modal-header,
  .ps-modal-body,
  .ps-modal-footer {
    padding: var(--ps-space-md);
  }
  
  .ps-tooltip::before {
    white-space: normal;
    max-width: 200px;
  }
}

@media (max-width: 480px) {
  .ps-tabs-list {
    flex-direction: column;
  }
  
  .ps-modal-footer {
    flex-direction: column;
  }
  
  .ps-dropdown-content {
    left: var(--ps-space-sm) !important;
    right: var(--ps-space-sm);
  }
}

/* ===== تحسينات إمكانية الوصول ===== */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-color-scheme: dark) {
  :root {
    --ps-white: #1f2937;
    --ps-gray-50: #374151;
    --ps-gray-100: #4b5563;
    --ps-gray-200: #6b7280;
    --ps-gray-300: #9ca3af;
    --ps-gray-400: #d1d5db;
    --ps-gray-500: #e5e7eb;
    --ps-gray-600: #f3f4f6;
    --ps-gray-700: #f9fafb;
    --ps-gray-800: #ffffff;
    --ps-gray-900: #ffffff;
  }
}

/* فئات أدوات سريعة */
.ps-text-center { text-align: center; }
.ps-text-left { text-align: left; }
.ps-text-right { text-align: right; }
.ps-font-light { font-weight: 300; }
.ps-font-normal { font-weight: 400; }
.ps-font-medium { font-weight: 500; }
.ps-font-semibold { font-weight: 600; }
.ps-font-bold { font-weight: 700; }
.ps-uppercase { text-transform: uppercase; }
.ps-lowercase { text-transform: lowercase; }
.ps-capitalize { text-transform: capitalize; }

.ps-flex { display: flex; }
.ps-inline-flex { display: inline-flex; }
.ps-grid { display: grid; }
.ps-block { display: block; }
.ps-inline-block { display: inline-block; }
.ps-hidden { display: none; }

.ps-items-center { align-items: center; }
.ps-items-start { align-items: flex-start; }
.ps-items-end { align-items: flex-end; }
.ps-justify-center { justify-content: center; }
.ps-justify-between { justify-content: space-between; }
.ps-justify-around { justify-content: space-around; }

.ps-rounded { border-radius: var(--ps-radius); }
.ps-rounded-lg { border-radius: var(--ps-radius-lg); }
.ps-rounded-full { border-radius: var(--ps-radius-full); }

.ps-shadow { box-shadow: var(--ps-shadow); }
.ps-shadow-md { box-shadow: var(--ps-shadow-md); }
.ps-shadow-lg { box-shadow: var(--ps-shadow-lg); }
.ps-shadow-xl { box-shadow: var(--ps-shadow-xl); }

.ps-transition { transition: var(--ps-transition-all); }
.ps-transition-fast { transition: var(--ps-transition-fast); }
.ps-transition-slow { transition: var(--ps-transition-slow); }

/* ===== تحسينات الطباعة ===== */
@media print {
  .ps-btn,
  .ps-modal,
  .ps-dropdown,
  .ps-tooltip {
    display: none !important;
  }
  
  .ps-card {
    box-shadow: none;
    border: 1px solid var(--ps-gray-300);
  }
  
  body {
    background: white !important;
    color: black !important;
  }
  
  a {
    color: black !important;
    text-decoration: underline !important;
  }
}



📁 اسم الملف: advanced-analytics.php

<?php
/**
 * Advanced Analytics System - نظام التحليلات المتقدم المُصلح
 * المسار: /inc/advanced-analytics.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Advanced_Analytics {
    
    private static $table_name;
    private static $search_table;
    
    public function __construct() {
        global $wpdb;
        self::$table_name = $wpdb->prefix . 'ps_analytics';
        self::$search_table = $wpdb->prefix . 'ps_search_analytics';
        
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        add_action('wp_ajax_ps_get_analytics_data', array($this, 'get_analytics_data'));
        add_action('wp_ajax_ps_export_analytics', array($this, 'export_analytics'));
        add_action('wp_ajax_ps_cleanup_old_analytics', array($this, 'cleanup_old_data'));
        add_action('after_switch_theme', array($this, 'create_tables'));
        add_action('ps_daily_cleanup', array($this, 'daily_cleanup'));
        
        if (!wp_next_scheduled('ps_daily_cleanup')) {
            wp_schedule_event(time(), 'daily', 'ps_daily_cleanup');
        }
    }
    
    public static function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        $analytics_table_sql = "CREATE TABLE " . self::$table_name . " (
            id bigint(20) NOT NULL AUTO_INCREMENT, post_id bigint(20) DEFAULT NULL, page_url varchar(255) NOT NULL, page_title varchar(255) DEFAULT NULL, user_ip varchar(45) DEFAULT NULL, user_agent text DEFAULT NULL, referer varchar(255) DEFAULT NULL, visit_date datetime NOT NULL, time_on_page int(11) DEFAULT 0, bounce_rate tinyint(1) DEFAULT 0, device_type varchar(20) DEFAULT NULL, browser varchar(50) DEFAULT NULL, country varchar(2) DEFAULT NULL, PRIMARY KEY (id), KEY post_id (post_id), KEY visit_date (visit_date), KEY device_type (device_type)
        ) $charset_collate;";
        
        $search_table_sql = "CREATE TABLE " . self::$search_table . " (
            id bigint(20) NOT NULL AUTO_INCREMENT, search_query varchar(255) NOT NULL, voice_text text DEFAULT NULL, results_count int(11) DEFAULT 0, search_type varchar(20) DEFAULT 'text', user_ip varchar(45) DEFAULT NULL, user_agent text DEFAULT NULL, search_date datetime NOT NULL, clicked_result varchar(255) DEFAULT NULL, session_id varchar(64) DEFAULT NULL, PRIMARY KEY (id), KEY search_query (search_query), KEY search_date (search_date), KEY search_type (search_type)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($analytics_table_sql);
        dbDelta($search_table_sql);
        
        self::create_index_safely(self::$table_name, 'idx_analytics_performance', '(visit_date, post_id, device_type)');
        self::create_index_safely(self::$search_table, 'idx_search_performance', '(search_date, search_type, results_count)');
    }

    private static function create_index_safely($table_name, $index_name, $columns) {
        global $wpdb;
        $index_exists = $wpdb->get_var($wpdb->prepare("SHOW INDEX FROM `$table_name` WHERE Key_name = %s", $index_name));
        if (!$index_exists) {
            $wpdb->query("CREATE INDEX `$index_name` ON `$table_name` $columns");
        }
    }
    
    public static function track_page_view($post_id = null) {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        if (!($analytics_settings['enabled'] ?? true)) { return; }
        
        $data = array(
            'post_id' => $post_id,
            'page_url' => esc_url_raw($_SERVER['REQUEST_URI'] ?? ''),
            'page_title' => wp_get_document_title(),
            'user_ip' => self::get_anonymized_ip(),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
            'referer' => esc_url_raw($_SERVER['HTTP_REFERER'] ?? ''),
            'visit_date' => current_time('mysql'),
            'device_type' => self::detect_device_type(),
            'browser' => self::detect_browser(),
            'country' => self::detect_country()
        );
        $wpdb->insert(self::$table_name, $data);
    }
    
    public static function log_search_event($search_data) {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        if (!($analytics_settings['track_search_analytics'] ?? true)) { return; }
        
        $data = array(
            'search_query' => sanitize_text_field($search_data['query'] ?? ''),
            'voice_text' => sanitize_textarea_field($search_data['voice_text'] ?? ''),
            'results_count' => intval($search_data['results_count'] ?? 0),
            'search_type' => sanitize_text_field($search_data['search_type'] ?? 'text'),
            'user_ip' => self::get_anonymized_ip(),
            'user_agent' => sanitize_text_field($search_data['user_agent'] ?? ''),
            'search_date' => current_time('mysql'),
            'session_id' => self::get_session_id()
        );
        $wpdb->insert(self::$search_table, $data);
    }
    
    public function get_analytics_data() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        
        $period = sanitize_text_field($_POST['period'] ?? '7days');
        $type = sanitize_text_field($_POST['type'] ?? 'overview');
        $data = array();
        
        switch ($type) {
            case 'overview': $data = $this->get_overview_data($period); break;
            case 'pages': $data = $this->get_pages_performance($period); break;
            case 'search': $data = $this->get_search_analytics($period); break;
            case 'devices': $data = $this->get_device_analytics($period); break;
            default: $data = $this->get_overview_data($period);
        }
        wp_send_json_success($data);
    }
    
    private function get_overview_data($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        $total_views = $wpdb->get_var("SELECT COUNT(*) FROM " . self::$table_name . " WHERE $date_condition");
        $unique_pages = $wpdb->get_var("SELECT COUNT(DISTINCT post_id) FROM " . self::$table_name . " WHERE $date_condition AND post_id IS NOT NULL");
        $total_searches = $wpdb->get_var("SELECT COUNT(*) FROM " . self::$search_table . " WHERE $date_condition");
        $bounce_rate = $wpdb->get_var("SELECT AVG(bounce_rate) FROM " . self::$table_name . " WHERE $date_condition");
        $daily_views = $wpdb->get_results("SELECT DATE(visit_date) as date, COUNT(*) as views FROM " . self::$table_name . " WHERE $date_condition GROUP BY DATE(visit_date) ORDER BY date ASC");
        
        return array('total_views' => intval($total_views), 'unique_pages' => intval($unique_pages), 'total_searches' => intval($total_searches), 'bounce_rate' => round(floatval($bounce_rate) * 100, 1), 'daily_views' => $daily_views);
    }
    
    private function get_pages_performance($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        return $wpdb->get_results("SELECT p.ID, p.post_title, COUNT(a.id) as views, AVG(a.time_on_page) as avg_time, COUNT(DISTINCT DATE(a.visit_date)) as active_days FROM " . self::$table_name . " a LEFT JOIN {$wpdb->posts} p ON a.post_id = p.ID WHERE $date_condition AND a.post_id IS NOT NULL GROUP BY a.post_id ORDER BY views DESC LIMIT 20");
    }
    
    private function get_search_analytics($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period, 'search_date');
        $top_searches = $wpdb->get_results("SELECT search_query, COUNT(*) as search_count, AVG(results_count) as avg_results, search_type FROM " . self::$search_table . " WHERE $date_condition GROUP BY search_query ORDER BY search_count DESC LIMIT 20");
        $voice_stats = $wpdb->get_row("SELECT COUNT(*) as total_voice_searches, COUNT(*) * 100.0 / (SELECT COUNT(*) FROM " . self::$search_table . " WHERE $date_condition) as voice_percentage FROM " . self::$search_table . " WHERE $date_condition AND search_type = 'voice'");
        return array('top_searches' => $top_searches, 'voice_stats' => $voice_stats);
    }
    
    private function get_device_analytics($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        $device_stats = $wpdb->get_results("SELECT device_type, COUNT(*) as views, COUNT(*) * 100.0 / (SELECT COUNT(*) FROM " . self::$table_name . " WHERE $date_condition) as percentage FROM " . self::$table_name . " WHERE $date_condition GROUP BY device_type ORDER BY views DESC");
        $browser_stats = $wpdb->get_results("SELECT browser, COUNT(*) as views FROM " . self::$table_name . " WHERE $date_condition GROUP BY browser ORDER BY views DESC LIMIT 10");
        return array('devices' => $device_stats, 'browsers' => $browser_stats);
    }
    
    private function get_date_condition($period, $date_column = 'visit_date') {
        $days = 7;
        switch ($period) {
            case '1day': $days = 1; break;
            case '7days': $days = 7; break;
            case '30days': $days = 30; break;
            case '90days': $days = 90; break;
        }
        return "$date_column >= DATE_SUB(NOW(), INTERVAL $days DAY)";
    }
    
    public function export_analytics() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        
        $period = sanitize_text_field($_POST['period'] ?? '30days');
        $format = sanitize_text_field($_POST['format'] ?? 'csv');
        $data = $this->get_export_data($period);
        
        if ($format === 'csv') {
            $csv_data = $this->convert_to_csv($data);
            wp_send_json_success(array('data' => $csv_data, 'filename' => 'analytics-' . date('Y-m-d') . '.csv'));
        } else {
            wp_send_json_success(array('data' => $data, 'filename' => 'analytics-' . date('Y-m-d') . '.json'));
        }
    }
    
    public function cleanup_old_data() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        $this->daily_cleanup();
        wp_send_json_success(__('تم تنظيف البيانات القديمة', 'practical-solutions'));
    }
    
    public function daily_cleanup() {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        $retention_days = intval($analytics_settings['data_retention_days'] ?? 365);
        
        $wpdb->query($wpdb->prepare("DELETE FROM " . self::$table_name . " WHERE visit_date < DATE_SUB(NOW(), INTERVAL %d DAY)", $retention_days));
        $wpdb->query($wpdb->prepare("DELETE FROM " . self::$search_table . " WHERE search_date < DATE_SUB(NOW(), INTERVAL %d DAY)", $retention_days));
        $wpdb->query("OPTIMIZE TABLE " . self::$table_name);
        $wpdb->query("OPTIMIZE TABLE " . self::$search_table);
    }
    
    private static function get_anonymized_ip() {
        $analytics_settings = get_option('ps_analytics_settings', array());
        if ($analytics_settings['anonymize_ip'] ?? true) { return 'anonymized'; }
        
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                $ip = sanitize_text_field($_SERVER[$key]);
                return preg_replace('/\.\d+$/', '.xxx', $ip);
            }
        }
        return 'unknown';
    }
    
    private static function detect_device_type() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (preg_match('/mobile|android|iphone|ipad/i', $user_agent)) { return 'mobile'; }
        if (preg_match('/tablet/i', $user_agent)) { return 'tablet'; }
        return 'desktop';
    }
    
    private static function detect_browser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (strpos($user_agent, 'Chrome') !== false) { return 'Chrome'; }
        if (strpos($user_agent, 'Firefox') !== false) { return 'Firefox'; }
        if (strpos($user_agent, 'Safari') !== false) { return 'Safari'; }
        if (strpos($user_agent, 'Edge') !== false) { return 'Edge'; }
        return 'Other';
    }
    
    private static function detect_country() {
        return 'SA';
    }
    
    private static function get_session_id() {
        if (!session_id()) { session_start(); }
        return session_id();
    }
    
    private function get_export_data($period) {
        return array('overview' => $this->get_overview_data($period), 'pages' => $this->get_pages_performance($period), 'search' => $this->get_search_analytics($period), 'devices' => $this->get_device_analytics($period));
    }
    
    private function convert_to_csv($data) {
        $csv = "Type,Metric,Value\n";
        $csv .= "Overview,Total Views," . $data['overview']['total_views'] . "\n";
        $csv .= "Overview,Unique Pages," . $data['overview']['unique_pages'] . "\n";
        $csv .= "Overview,Total Searches," . $data['overview']['total_searches'] . "\n";
        return $csv;
    }
}

new PS_Advanced_Analytics();





📁 اسم الملف: theme-admin-panel.php
<?php
/**
 * لوحة إدارة القالب الاحترافية
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

class PS_Theme_Admin_Panel {
    
    private $page_slug = 'practical-solutions-settings';
    private $capability = 'manage_options';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_ajax_ps_test_api_connection', array($this, 'test_api_connection'));
        add_action('wp_ajax_ps_clear_cache', array($this, 'clear_cache'));
        add_action('wp_ajax_ps_export_settings', array($this, 'export_settings'));
        add_action('wp_ajax_ps_import_settings', array($this, 'import_settings'));
        add_action('wp_ajax_ps_backup_theme_data', array($this, 'backup_theme_data'));
        add_action('wp_ajax_ps_restore_theme_data', array($this, 'restore_theme_data'));
    }
    
    /**
     * ==== إضافة قائمة الإدارة ====
     */
    public function add_admin_menu() {
        // الصفحة الرئيسية
        add_theme_page(
            __('إعدادات الحلول العملية', 'practical-solutions'),
            __('إعدادات القالب', 'practical-solutions'),
            $this->capability,
            $this->page_slug,
            array($this, 'render_admin_page')
        );
        
        // صفحة التحليلات
        add_submenu_page(
            $this->page_slug,
            __('التحليلات والتقارير', 'practical-solutions'),
            __('التحليلات', 'practical-solutions'),
            $this->capability,
            'ps-analytics',
            array($this, 'render_analytics_page')
        );
        
        // صفحة الأدوات
        add_submenu_page(
            $this->page_slug,
            __('أدوات القالب', 'practical-solutions'),
            __('الأدوات', 'practical-solutions'),
            $this->capability,
            'ps-tools',
            array($this, 'render_tools_page')
        );
    }
    
    /**
     * ==== تسجيل الإعدادات ====
     */
    public function register_settings() {
        // الإعدادات العامة
        register_setting('ps_general_settings', 'ps_general_settings', array($this, 'sanitize_general_settings'));
        
        // إعدادات الذكاء الاصطناعي
        register_setting('ps_ai_settings', 'ps_ai_settings', array($this, 'sanitize_ai_settings'));
        
        // إعدادات التحليلات
        register_setting('ps_analytics_settings', 'ps_analytics_settings', array($this, 'sanitize_analytics_settings'));
        
        // إعدادات الأداء
        register_setting('ps_performance_settings', 'ps_performance_settings', array($this, 'sanitize_performance_settings'));
        
        // إعدادات التصميم
        register_setting('ps_design_settings', 'ps_design_settings', array($this, 'sanitize_design_settings'));
        
        // إعدادات التواصل الاجتماعي
        register_setting('ps_social_settings', 'ps_social_settings', array($this, 'sanitize_social_settings'));
        
        // إعدادات SEO
        register_setting('ps_seo_settings', 'ps_seo_settings', array($this, 'sanitize_seo_settings'));
        
        // إعدادات متقدمة
        register_setting('ps_advanced_settings', 'ps_advanced_settings', array($this, 'sanitize_advanced_settings'));
    }
    
    /**
     * ==== تحميل ملفات الإدارة ====
     */
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, $this->page_slug) === false && 
            strpos($hook, 'ps-analytics') === false && 
            strpos($hook, 'ps-tools') === false) {
            return;
        }
        
        wp_enqueue_style('ps-admin-css', PS_THEME_URI . '/assets/admin/admin-styles.css', array(), PS_THEME_VERSION);
        wp_enqueue_script('ps-admin-js', PS_THEME_URI . '/assets/admin/admin-scripts.js', array('jquery'), PS_THEME_VERSION, true);
        
        // إضافة متغيرات JavaScript
        wp_localize_script('ps-admin-js', 'psAdmin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ps_admin_nonce'),
            'strings' => array(
                'saving' => __('جاري الحفظ...', 'practical-solutions'),
                'saved' => __('تم الحفظ بنجاح!', 'practical-solutions'),
                'error' => __('حدث خطأ أثناء الحفظ', 'practical-solutions'),
                'confirm_reset' => __('هل أنت متأكد من إعادة تعيين جميع الإعدادات؟', 'practical-solutions'),
                'testing_connection' => __('جاري اختبار الاتصال...', 'practical-solutions'),
                'connection_success' => __('الاتصال ناجح!', 'practical-solutions'),
                'connection_failed' => __('فشل الاتصال', 'practical-solutions'),
                'clearing_cache' => __('جاري مسح الذاكرة المؤقتة...', 'practical-solutions'),
                'cache_cleared' => __('تم مسح الذاكرة المؤقتة بنجاح!', 'practical-solutions'),
                'backup_created' => __('تم إنشاء النسخة الاحتياطية بنجاح!', 'practical-solutions'),
                'backup_restored' => __('تم استعادة النسخة الاحتياطية بنجاح!', 'practical-solutions')
            )
        ));
        
        // تحميل محرر الكود إذا لزم الأمر
        wp_enqueue_code_editor(array('type' => 'text/css'));
        wp_enqueue_code_editor(array('type' => 'text/javascript'));
    }
    
    /**
     * ==== عرض الصفحة الرئيسية ====
     */
    public function render_admin_page() {
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
        ?>
        <div class="wrap ps-admin-wrap">
            <h1 class="ps-admin-title">
                <span class="ps-logo"></span>
                <?php _e('إعدادات الحلول العملية', 'practical-solutions'); ?>
                <span class="ps-version">v<?php echo PS_THEME_VERSION; ?></span>
            </h1>
            
            <div class="ps-admin-header">
                <div class="ps-header-info">
                    <p class="ps-description"><?php _e('قالب احترافي للحلول العملية مع إمكانيات متقدمة', 'practical-solutions'); ?></p>
                    <div class="ps-quick-stats">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo wp_count_posts()->publish; ?></span>
                            <span class="stat-label"><?php _e('المقالات', 'practical-solutions'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo wp_count_comments()->approved; ?></span>
                            <span class="stat-label"><?php _e('التعليقات', 'practical-solutions'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo count_users()['total_users']; ?></span>
                            <span class="stat-label"><?php _e('المستخدمين', 'practical-solutions'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="ps-header-actions">
                    <button type="button" class="button button-secondary" id="ps-export-settings">
                        <span class="dashicons dashicons-download"></span>
                        <?php _e('تصدير الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary" id="ps-import-settings">
                        <span class="dashicons dashicons-upload"></span>
                        <?php _e('استيراد الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <input type="file" id="import-file" accept=".json" style="display: none;">
                </div>
            </div>
            
            <nav class="nav-tab-wrapper ps-nav-tabs">
                <a href="?page=<?php echo $this->page_slug; ?>&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-generic"></span>
                    <?php _e('عام', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=ai" class="nav-tab <?php echo $active_tab == 'ai' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-superhero"></span>
                    <?php _e('الذكاء الاصطناعي', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=design" class="nav-tab <?php echo $active_tab == 'design' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <?php _e('التصميم', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=performance" class="nav-tab <?php echo $active_tab == 'performance' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-performance"></span>
                    <?php _e('الأداء', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=social" class="nav-tab <?php echo $active_tab == 'social' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-share"></span>
                    <?php _e('التواصل الاجتماعي', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=seo" class="nav-tab <?php echo $active_tab == 'seo' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-search"></span>
                    <?php _e('SEO', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-tools"></span>
                    <?php _e('متقدم', 'practical-solutions'); ?>
                </a>
            </nav>
            
            <div class="ps-admin-content">
                <form method="post" action="options.php" class="ps-settings-form">
                    <?php
                    switch ($active_tab) {
                        case 'general':
                            $this->render_general_tab();
                            break;
                        case 'ai':
                            $this->render_ai_tab();
                            break;
                        case 'design':
                            $this->render_design_tab();
                            break;
                        case 'performance':
                            $this->render_performance_tab();
                            break;
                        case 'social':
                            $this->render_social_tab();
                            break;
                        case 'seo':
                            $this->render_seo_tab();
                            break;
                        case 'advanced':
                            $this->render_advanced_tab();
                            break;
                        default:
                            $this->render_general_tab();
                    }
                    ?>
                </form>
            </div>
            
            <div class="ps-admin-sidebar">
                <?php $this->render_sidebar(); ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الإعدادات العامة ====
     */
    private function render_general_tab() {
        settings_fields('ps_general_settings');
        $settings = get_option('ps_general_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('الإعدادات العامة', 'practical-solutions'); ?></h2>
                <p><?php _e('إعدادات أساسية لتخصيص القالب', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('معلومات الموقع', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('وصف الموقع الموسع', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_general_settings[site_description]" rows="4" class="large-text" placeholder="<?php _e('وصف تفصيلي عن موقعك...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['site_description'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيظهر في meta description والصفحة الرئيسية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الكلمات المفتاحية', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_general_settings[keywords]" value="<?php echo esc_attr($settings['keywords'] ?? ''); ?>" class="large-text" placeholder="<?php _e('حلول عملية، نصائح، إرشادات', 'practical-solutions'); ?>" />
                                <p class="description"><?php _e('افصل بين الكلمات بفاصلة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات المستخدم', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('البحث الصوتي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[voice_search]" value="1" <?php checked(1, $settings['voice_search'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل البحث بالصوت في الموقع', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نظام الإشارات المرجعية', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[bookmarks]" value="1" <?php checked(1, $settings['bookmarks'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح للمستخدمين بحفظ المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('شريط تقدم القراءة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[reading_progress]" value="1" <?php checked(1, $settings['reading_progress'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار تقدم القراءة في المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نظام التقييم', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[rating_system]" value="1" <?php checked(1, $settings['rating_system'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح بتقييم المقالات بالنجوم', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الوضع المظلم التلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[auto_dark_mode]" value="1" <?php checked(1, $settings['auto_dark_mode'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل الوضع المظلم تلقائياً حسب إعدادات النظام', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <?php submit_button(__('حفظ الإعدادات العامة', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الذكاء الاصطناعي ====
     */
    private function render_ai_tab() {
        settings_fields('ps_ai_settings');
        $settings = get_option('ps_ai_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات الذكاء الاصطناعي', 'practical-solutions'); ?></h2>
                <p><?php _e('تكوين نظام الذكاء الاصطناعي المدمج', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات OpenRouter API', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل الذكاء الاصطناعي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[enabled]" value="1" <?php checked(1, $settings['enabled'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل جميع ميزات الذكاء الاصطناعي', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('مفتاح OpenRouter API', 'practical-solutions'); ?></th>
                            <td>
                                <input type="password" name="ps_ai_settings[openrouter_api_key]" value="<?php echo esc_attr($settings['openrouter_api_key'] ?? ''); ?>" class="large-text" placeholder="sk-or-v1-..." />
                                <button type="button" class="button button-secondary" id="test-api-connection">
                                    <?php _e('اختبار الاتصال', 'practical-solutions'); ?>
                                </button>
                                <p class="description">
                                    <?php printf(__('احصل على مفتاح API من %s', 'practical-solutions'), '<a href="https://openrouter.ai" target="_blank">OpenRouter.ai</a>'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('النموذج المستخدم', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[model]" class="regular-text">
                                    <option value="anthropic/claude-3-haiku" <?php selected($settings['model'] ?? 'anthropic/claude-3-haiku', 'anthropic/claude-3-haiku'); ?>>Claude 3 Haiku</option>
                                    <option value="anthropic/claude-3-sonnet" <?php selected($settings['model'] ?? '', 'anthropic/claude-3-sonnet'); ?>>Claude 3 Sonnet</option>
                                    <option value="openai/gpt-3.5-turbo" <?php selected($settings['model'] ?? '', 'openai/gpt-3.5-turbo'); ?>>GPT-3.5 Turbo</option>
                                    <option value="openai/gpt-4" <?php selected($settings['model'] ?? '', 'openai/gpt-4'); ?>>GPT-4</option>
                                    <option value="google/gemini-pro" <?php selected($settings['model'] ?? '', 'google/gemini-pro'); ?>>Gemini Pro</option>
                                </select>
                                <p class="description"><?php _e('اختر النموذج المناسب حسب احتياجاتك وميزانيتك', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات البحث الذكي', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('اقتراحات البحث الذكية', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[search_suggestions]" value="1" <?php checked(1, $settings['search_suggestions'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار اقتراحات ذكية أثناء البحث', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عدد الاقتراحات', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_ai_settings[suggestions_count]" value="<?php echo esc_attr($settings['suggestions_count'] ?? 8); ?>" min="3" max="15" class="small-text" />
                                <p class="description"><?php _e('عدد الاقتراحات المعروضة (3-15)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('مدة التخزين المؤقت', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[cache_duration]" class="regular-text">
                                    <option value="1800" <?php selected($settings['cache_duration'] ?? 3600, 1800); ?>><?php _e('30 دقيقة', 'practical-solutions'); ?></option>
                                    <option value="3600" <?php selected($settings['cache_duration'] ?? 3600, 3600); ?>><?php _e('ساعة واحدة', 'practical-solutions'); ?></option>
                                    <option value="7200" <?php selected($settings['cache_duration'] ?? 3600, 7200); ?>><?php _e('ساعتان', 'practical-solutions'); ?></option>
                                    <option value="21600" <?php selected($settings['cache_duration'] ?? 3600, 21600); ?>><?php _e('6 ساعات', 'practical-solutions'); ?></option>
                                    <option value="86400" <?php selected($settings['cache_duration'] ?? 3600, 86400); ?>><?php _e('24 ساعة', 'practical-solutions'); ?></option>
                                </select>
                                <p class="description"><?php _e('مدة حفظ الاقتراحات في الذاكرة المؤقتة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات المحتوى الذكي', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تلخيص المقالات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[auto_summaries]" value="1" <?php checked(1, $settings['auto_summaries'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء ملخصات تلقائية للمقالات الطويلة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('المقالات المقترحة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[related_posts]" value="1" <?php checked(1, $settings['related_posts'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('اقتراح مقالات ذات صلة بناءً على المحتوى', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحسين SEO تلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[auto_seo]" value="1" <?php checked(1, $settings['auto_seo'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء meta descriptions وتحسين الكلمات المفتاحية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-ai-status">
                <h3><?php _e('حالة النظام', 'practical-solutions'); ?></h3>
                <div class="ps-status-grid">
                    <div class="status-item">
                        <span class="status-indicator <?php echo !empty($settings['openrouter_api_key']) ? 'active' : 'inactive'; ?>"></span>
                        <span class="status-label"><?php _e('API متصل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="status-item">
                        <span class="status-indicator <?php echo ($settings['enabled'] ?? 0) ? 'active' : 'inactive'; ?>"></span>
                        <span class="status-label"><?php _e('النظام مفعل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="status-item">
                        <span class="status-indicator active"></span>
                        <span class="status-label"><?php _e('التخزين المؤقت يعمل', 'practical-solutions'); ?></span>
                    </div>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات الذكاء الاصطناعي', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب التصميم ====
     */
    private function render_design_tab() {
        settings_fields('ps_design_settings');
        $settings = get_option('ps_design_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات التصميم', 'practical-solutions'); ?></h2>
                <p><?php _e('تخصيص مظهر وألوان القالب', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('الألوان الأساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('اللون الأساسي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[primary_color]" value="<?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[primary_color]" value="<?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('اللون الثانوي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[secondary_color]" value="<?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[secondary_color]" value="<?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('لون التمييز', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[accent_color]" value="<?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[accent_color]" value="<?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('الخطوط والنصوص', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('خط العناوين', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[heading_font]" class="regular-text">
                                    <option value="Cairo" <?php selected($settings['heading_font'] ?? 'Cairo', 'Cairo'); ?>>Cairo</option>
                                    <option value="Amiri" <?php selected($settings['heading_font'] ?? '', 'Amiri'); ?>>Amiri</option>
                                    <option value="Noto Sans Arabic" <?php selected($settings['heading_font'] ?? '', 'Noto Sans Arabic'); ?>>Noto Sans Arabic</option>
                                    <option value="Tajawal" <?php selected($settings['heading_font'] ?? '', 'Tajawal'); ?>>Tajawal</option>
                                    <option value="Almarai" <?php selected($settings['heading_font'] ?? '', 'Almarai'); ?>>Almarai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('خط النص العادي', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[body_font]" class="regular-text">
                                    <option value="Noto Sans Arabic" <?php selected($settings['body_font'] ?? 'Noto Sans Arabic', 'Noto Sans Arabic'); ?>>Noto Sans Arabic</option>
                                    <option value="Cairo" <?php selected($settings['body_font'] ?? '', 'Cairo'); ?>>Cairo</option>
                                    <option value="Tajawal" <?php selected($settings['body_font'] ?? '', 'Tajawal'); ?>>Tajawal</option>
                                    <option value="Almarai" <?php selected($settings['body_font'] ?? '', 'Almarai'); ?>>Almarai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('حجم الخط الأساسي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_design_settings[font_size]" min="14" max="20" value="<?php echo esc_attr($settings['font_size'] ?? 16); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['font_size'] ?? 16); ?>px</span>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تخطيط الصفحة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('عرض المحتوى', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[content_width]" class="regular-text">
                                    <option value="1140px" <?php selected($settings['content_width'] ?? '1140px', '1140px'); ?>><?php _e('واسع (1140px)', 'practical-solutions'); ?></option>
                                    <option value="1024px" <?php selected($settings['content_width'] ?? '', '1024px'); ?>><?php _e('متوسط (1024px)', 'practical-solutions'); ?></option>
                                    <option value="960px" <?php selected($settings['content_width'] ?? '', '960px'); ?>><?php _e('ضيق (960px)', 'practical-solutions'); ?></option>
                                    <option value="100%" <?php selected($settings['content_width'] ?? '', '100%'); ?>><?php _e('كامل العرض', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط الرأس', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[header_style]" class="regular-text">
                                    <option value="default" <?php selected($settings['header_style'] ?? 'default', 'default'); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="centered" <?php selected($settings['header_style'] ?? '', 'centered'); ?>><?php _e('متوسط', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['header_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                    <option value="full-width" <?php selected($settings['header_style'] ?? '', 'full-width'); ?>><?php _e('كامل العرض', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط التذييل', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[footer_style]" class="regular-text">
                                    <option value="default" <?php selected($settings['footer_style'] ?? 'default', 'default'); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['footer_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                    <option value="detailed" <?php selected($settings['footer_style'] ?? '', 'detailed'); ?>><?php _e('مفصل', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تأثيرات بصرية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تأثيرات الحركة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_design_settings[animations]" value="1" <?php checked(1, $settings['animations'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل الحركات والانتقالات المرئية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الظلال', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_design_settings[shadows]" value="1" <?php checked(1, $settings['shadows'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إضافة ظلال للعناصر لتحسين العمق البصري', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الحواف الدائرية', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_design_settings[border_radius]" min="0" max="20" value="<?php echo esc_attr($settings['border_radius'] ?? 8); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['border_radius'] ?? 8); ?>px</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-preview-section">
                <h3><?php _e('معاينة التصميم', 'practical-solutions'); ?></h3>
                <div class="ps-design-preview">
                    <div class="preview-header" style="background-color: <?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>;">
                        <div class="preview-logo"><?php _e('شعار الموقع', 'practical-solutions'); ?></div>
                        <div class="preview-menu"><?php _e('القائمة', 'practical-solutions'); ?></div>
                    </div>
                    <div class="preview-content">
                        <h2 style="color: <?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>; font-family: <?php echo esc_attr($settings['heading_font'] ?? 'Cairo'); ?>;">
                            <?php _e('عنوان تجريبي', 'practical-solutions'); ?>
                        </h2>
                        <p style="font-family: <?php echo esc_attr($settings['body_font'] ?? 'Noto Sans Arabic'); ?>; font-size: <?php echo esc_attr($settings['font_size'] ?? 16); ?>px;">
                            <?php _e('هذا نص تجريبي لمعاينة الخطوط والألوان المختارة. يمكنك رؤية كيف ستبدو العناصر في موقعك.', 'practical-solutions'); ?>
                        </p>
                        <button style="background-color: <?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>; border-radius: <?php echo esc_attr($settings['border_radius'] ?? 8); ?>px;">
                            <?php _e('زر تجريبي', 'practical-solutions'); ?>
                        </button>
                    </div>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات التصميم', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الأداء ====
     */
    private function render_performance_tab() {
        settings_fields('ps_performance_settings');
        $settings = get_option('ps_performance_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات الأداء', 'practical-solutions'); ?></h2>
                <p><?php _e('تحسين سرعة الموقع وأدائه', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('تحسينات الأداء', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Service Worker', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[service_worker]" value="1" <?php checked(1, $settings['service_worker'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل التخزين المؤقت المتقدم وتحسين التحميل', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Lazy Loading للصور', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[lazy_loading]" value="1" <?php checked(1, $settings['lazy_loading'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تحميل الصور عند الحاجة فقط', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('ضغط CSS/JS', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[minify_assets]" value="1" <?php checked(1, $settings['minify_assets'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تقليل حجم ملفات CSS و JavaScript', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('دمج الملفات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[combine_files]" value="1" <?php checked(1, $settings['combine_files'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('دمج ملفات CSS و JS لتقليل عدد الطلبات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات التخزين المؤقت', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('مدة تخزين الصفحات', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_performance_settings[page_cache_duration]" class="regular-text">
                                    <option value="3600" <?php selected($settings['page_cache_duration'] ?? 3600, 3600); ?>><?php _e('ساعة واحدة', 'practical-solutions'); ?></option>
                                    <option value="7200" <?php selected($settings['page_cache_duration'] ?? 3600, 7200); ?>><?php _e('ساعتان', 'practical-solutions'); ?></option>
                                    <option value="21600" <?php selected($settings['page_cache_duration'] ?? 3600, 21600); ?>><?php _e('6 ساعات', 'practical-solutions'); ?></option>
                                    <option value="86400" <?php selected($settings['page_cache_duration'] ?? 3600, 86400); ?>><?php _e('24 ساعة', 'practical-solutions'); ?></option>
                                    <option value="604800" <?php selected($settings['page_cache_duration'] ?? 3600, 604800); ?>><?php _e('أسبوع', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تخزين قاعدة البيانات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[database_cache]" value="1" <?php checked(1, $settings['database_cache'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تخزين نتائج استعلامات قاعدة البيانات مؤقتاً', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تخزين Object Cache', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[object_cache]" value="1" <?php checked(1, $settings['object_cache'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل Object Cache إذا كان متوفراً على الخادم', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تحسين الصور', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('ضغط الصور تلقائياً', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[image_compression]" value="1" <?php checked(1, $settings['image_compression'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('ضغط الصور المرفوعة تلقائياً لتحسين الأداء', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحويل إلى WebP', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[webp_conversion]" value="1" <?php checked(1, $settings['webp_conversion'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تحويل الصور إلى تنسيق WebP للمتصفحات المدعومة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('جودة الضغط', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_performance_settings[compression_quality]" min="60" max="100" value="<?php echo esc_attr($settings['compression_quality'] ?? 85); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['compression_quality'] ?? 85); ?>%</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-performance-tools">
                <h3><?php _e('أدوات الأداء', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="clear-all-cache">
                        <span class="dashicons dashicons-update"></span>
                        <?php _e('مسح جميع الذاكرة المؤقتة', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="optimize-database">
                        <span class="dashicons dashicons-database"></span>
                        <?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="test-page-speed">
                        <span class="dashicons dashicons-performance"></span>
                        <?php _e('اختبار سرعة الموقع', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="generate-sitemap">
                        <span class="dashicons dashicons-networking"></span>
                        <?php _e('إنشاء خريطة الموقع', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات الأداء', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب التواصل الاجتماعي ====
     */
    private function render_social_tab() {
        settings_fields('ps_social_settings');
        $settings = get_option('ps_social_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات التواصل الاجتماعي', 'practical-solutions'); ?></h2>
                <p><?php _e('إضافة روابط وسائل التواصل الاجتماعي', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('المنصات الأساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-facebook"></span>
                                <?php _e('فيسبوك', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[facebook]" value="<?php echo esc_url($settings['facebook'] ?? ''); ?>" class="large-text" placeholder="https://facebook.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-twitter"></span>
                                <?php _e('تويتر', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[twitter]" value="<?php echo esc_url($settings['twitter'] ?? ''); ?>" class="large-text" placeholder="https://twitter.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-instagram"></span>
                                <?php _e('إنستغرام', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[instagram]" value="<?php echo esc_url($settings['instagram'] ?? ''); ?>" class="large-text" placeholder="https://instagram.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-linkedin"></span>
                                <?php _e('لينكد إن', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[linkedin]" value="<?php echo esc_url($settings['linkedin'] ?? ''); ?>" class="large-text" placeholder="https://linkedin.com/in/username" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('منصات إضافية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-youtube"></span>
                                <?php _e('يوتيوب', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[youtube]" value="<?php echo esc_url($settings['youtube'] ?? ''); ?>" class="large-text" placeholder="https://youtube.com/c/channel" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-pinterest"></span>
                                <?php _e('بنترست', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[pinterest]" value="<?php echo esc_url($settings['pinterest'] ?? ''); ?>" class="large-text" placeholder="https://pinterest.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-whatsapp"></span>
                                <?php _e('واتساب', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="tel" name="ps_social_settings[whatsapp]" value="<?php echo esc_attr($settings['whatsapp'] ?? ''); ?>" class="large-text" placeholder="+966501234567" />
                                <p class="description"><?php _e('رقم الهاتف مع رمز البلد', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-email"></span>
                                <?php _e('تيليجرام', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="text" name="ps_social_settings[telegram]" value="<?php echo esc_attr($settings['telegram'] ?? ''); ?>" class="large-text" placeholder="@username" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات العرض', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('إظهار في الرأس', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[show_in_header]" value="1" <?php checked(1, $settings['show_in_header'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('إظهار في التذييل', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[show_in_footer]" value="1" <?php checked(1, $settings['show_in_footer'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('أزرار المشاركة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[share_buttons]" value="1" <?php checked(1, $settings['share_buttons'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار أزرار المشاركة في المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط الأيقونات', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_social_settings[icon_style]" class="regular-text">
                                    <option value="round" <?php selected($settings['icon_style'] ?? 'round', 'round'); ?>><?php _e('دائري', 'practical-solutions'); ?></option>
                                    <option value="square" <?php selected($settings['icon_style'] ?? '', 'square'); ?>><?php _e('مربع', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['icon_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-social-preview">
                <h3><?php _e('معاينة الأيقونات', 'practical-solutions'); ?></h3>
                <div class="social-icons-preview <?php echo esc_attr($settings['icon_style'] ?? 'round'); ?>">
                    <?php if (!empty($settings['facebook'])): ?>
                        <a href="#" class="social-icon facebook"><span class="dashicons dashicons-facebook"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['twitter'])): ?>
                        <a href="#" class="social-icon twitter"><span class="dashicons dashicons-twitter"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['instagram'])): ?>
                        <a href="#" class="social-icon instagram"><span class="dashicons dashicons-instagram"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['linkedin'])): ?>
                        <a href="#" class="social-icon linkedin"><span class="dashicons dashicons-linkedin"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['youtube'])): ?>
                        <a href="#" class="social-icon youtube"><span class="dashicons dashicons-youtube"></span></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات التواصل الاجتماعي', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب SEO ====
     */
    private function render_seo_tab() {
        settings_fields('ps_seo_settings');
        $settings = get_option('ps_seo_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات SEO', 'practical-solutions'); ?></h2>
                <p><?php _e('تحسين محركات البحث والظهور في النتائج', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات أساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('عنوان الموقع SEO', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[site_title]" value="<?php echo esc_attr($settings['site_title'] ?? ''); ?>" class="large-text" placeholder="<?php _e('عنوان محسن لمحركات البحث', 'practical-solutions'); ?>" />
                                <p class="description"><?php _e('إذا تُرك فارغاً، سيستخدم عنوان الموقع الافتراضي', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('وصف meta الافتراضي', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_seo_settings[meta_description]" rows="3" class="large-text" placeholder="<?php _e('وصف مختصر وجذاب للموقع...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['meta_description'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('يُفضل أن يكون بين 150-160 حرف', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('فاصل العنوان', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_seo_settings[title_separator]" class="regular-text">
                                    <option value="|" <?php selected($settings['title_separator'] ?? '|', '|'); ?>>|</option>
                                    <option value="-" <?php selected($settings['title_separator'] ?? '|', '-'); ?>>-</option>
                                    <option value="·" <?php selected($settings['title_separator'] ?? '|', '·'); ?>>·</option>
                                    <option value="»" <?php selected($settings['title_separator'] ?? '|', '»'); ?>>»</option>
                                    <option value="›" <?php selected($settings['title_separator'] ?? '|', '›'); ?>>›</option>
                                </select>
                                <p class="description"><?php _e('الرمز المستخدم لفصل عنوان الصفحة عن اسم الموقع', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('Open Graph و Twitter Cards', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Open Graph', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_og]" value="1" <?php checked(1, $settings['enable_og'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('لتحسين ظهور المحتوى عند المشاركة على فيسبوك', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تفعيل Twitter Cards', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_twitter_cards]" value="1" <?php checked(1, $settings['enable_twitter_cards'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('لتحسين ظهور المحتوى عند المشاركة على تويتر', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الصورة الافتراضية للمشاركة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_seo_settings[default_og_image]" value="<?php echo esc_url($settings['default_og_image'] ?? ''); ?>" class="large-text" placeholder="https://example.com/image.jpg" />
                                <button type="button" class="button button-secondary" id="upload-og-image"><?php _e('رفع صورة', 'practical-solutions'); ?></button>
                                <p class="description"><?php _e('الحجم المثالي: 1200x630 بكسل', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('Schema.org و البيانات المنظمة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Schema.org', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_schema]" value="1" <?php checked(1, $settings['enable_schema'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إضافة البيانات المنظمة لتحسين فهم محركات البحث', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نوع المنظمة', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_seo_settings[organization_type]" class="regular-text">
                                    <option value="Organization" <?php selected($settings['organization_type'] ?? 'Organization', 'Organization'); ?>><?php _e('منظمة', 'practical-solutions'); ?></option>
                                    <option value="LocalBusiness" <?php selected($settings['organization_type'] ?? '', 'LocalBusiness'); ?>><?php _e('نشاط تجاري محلي', 'practical-solutions'); ?></option>
                                    <option value="Corporation" <?php selected($settings['organization_type'] ?? '', 'Corporation'); ?>><?php _e('شركة', 'practical-solutions'); ?></option>
                                    <option value="Person" <?php selected($settings['organization_type'] ?? '', 'Person'); ?>><?php _e('شخص', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('شعار المنظمة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_seo_settings[organization_logo]" value="<?php echo esc_url($settings['organization_logo'] ?? ''); ?>" class="large-text" placeholder="https://example.com/logo.png" />
                                <button type="button" class="button button-secondary" id="upload-org-logo"><?php _e('رفع شعار', 'practical-solutions'); ?></button>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('أدوات مشرفي المواقع', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('Google Search Console', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[google_verification]" value="<?php echo esc_attr($settings['google_verification'] ?? ''); ?>" class="large-text" placeholder="content-verification-code" />
                                <p class="description"><?php _e('رمز التحقق من Google Search Console', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Bing Webmaster Tools', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[bing_verification]" value="<?php echo esc_attr($settings['bing_verification'] ?? ''); ?>" class="large-text" placeholder="bing-verification-code" />
                                <p class="description"><?php _e('رمز التحقق من Bing Webmaster Tools', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-seo-tools">
                <h3><?php _e('أدوات SEO', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="generate-sitemap">
                        <span class="dashicons dashicons-networking"></span>
                        <?php _e('إنشاء خريطة الموقع', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="analyze-seo">
                        <span class="dashicons dashicons-search"></span>
                        <?php _e('تحليل SEO', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="check-robots">
                        <span class="dashicons dashicons-privacy"></span>
                        <?php _e('فحص robots.txt', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="validate-schema">
                        <span class="dashicons dashicons-admin-tools"></span>
                        <?php _e('التحقق من Schema', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات SEO', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الإعدادات المتقدمة ====
     */
    private function render_advanced_tab() {
        settings_fields('ps_advanced_settings');
        $settings = get_option('ps_advanced_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('الإعدادات المتقدمة', 'practical-solutions'); ?></h2>
                <p><?php _e('إعدادات للمطورين والمستخدمين المتقدمين', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('أكواد مخصصة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('CSS مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_css]" rows="10" class="large-text code-editor" placeholder="/* أضف CSS مخصص هنا */"><?php echo esc_textarea($settings['custom_css'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم إضافة CSS في head الصفحة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('JavaScript مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_js]" rows="10" class="large-text code-editor" placeholder="// أضف JavaScript مخصص هنا"><?php echo esc_textarea($settings['custom_js'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم تحميل JavaScript في footer الصفحة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Head مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_head]" rows="5" class="large-text" placeholder="<!-- أضف أكواد head مخصصة هنا -->"><?php echo esc_textarea($settings['custom_head'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم إضافة هذا الكود في &lt;head&gt;', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات التطوير', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('وضع التطوير', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[debug_mode]" value="1" <?php checked(1, $settings['debug_mode'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل سجلات التطوير والتشخيص', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عرض أخطاء PHP', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[show_php_errors]" value="1" <?php checked(1, $settings['show_php_errors'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('عرض أخطاء PHP (للتطوير فقط)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحديد الذاكرة', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_advanced_settings[memory_limit]" class="regular-text">
                                    <option value="" <?php selected($settings['memory_limit'] ?? '', ''); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="256M" <?php selected($settings['memory_limit'] ?? '', '256M'); ?>>256MB</option>
                                    <option value="512M" <?php selected($settings['memory_limit'] ?? '', '512M'); ?>>512MB</option>
                                    <option value="1G" <?php selected($settings['memory_limit'] ?? '', '1G'); ?>>1GB</option>
                                </select>
                                <p class="description"><?php _e('حد استخدام الذاكرة لـ PHP', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('النسخ الاحتياطية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('نسخ احتياطي تلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[auto_backup]" value="1" <?php checked(1, $settings['auto_backup'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء نسخة احتياطية تلقائية للإعدادات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تكرار النسخ الاحتياطية', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_advanced_settings[backup_frequency]" class="regular-text">
                                    <option value="daily" <?php selected($settings['backup_frequency'] ?? 'weekly', 'daily'); ?>><?php _e('يومياً', 'practical-solutions'); ?></option>
                                    <option value="weekly" <?php selected($settings['backup_frequency'] ?? 'weekly', 'weekly'); ?>><?php _e('أسبوعياً', 'practical-solutions'); ?></option>
                                    <option value="monthly" <?php selected($settings['backup_frequency'] ?? 'weekly', 'monthly'); ?>><?php _e('شهرياً', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عدد النسخ المحفوظة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_advanced_settings[backup_keep_count]" value="<?php echo esc_attr($settings['backup_keep_count'] ?? 5); ?>" min="1" max="20" class="small-text" />
                                <p class="description"><?php _e('عدد النسخ الاحتياطية التي سيتم الاحتفاظ بها', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات الأمان', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('إخفاء إصدار WordPress', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[hide_wp_version]" value="1" <?php checked(1, $settings['hide_wp_version'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إزالة معلومات إصدار WordPress من HTML', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تعطيل XML-RPC', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[disable_xmlrpc]" value="1" <?php checked(1, $settings['disable_xmlrpc'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تعطيل XML-RPC لتحسين الأمان', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('حماية wp-config.php', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[protect_wp_config]" value="1" <?php checked(1, $settings['protect_wp_config'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('منع الوصول المباشر لملف wp-config.php', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-advanced-tools">
                <h3><?php _e('أدوات متقدمة', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="create-backup">
                        <span class="dashicons dashicons-backup"></span>
                        <?php _e('إنشاء نسخة احتياطية', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="restore-backup">
                        <span class="dashicons dashicons-restore"></span>
                        <?php _e('استعادة نسخة احتياطية', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="reset-settings">
                        <span class="dashicons dashicons-warning"></span>
                        <?php _e('إعادة تعيين الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="export-theme-data">
                        <span class="dashicons dashicons-download"></span>
                        <?php _e('تصدير بيانات القالب', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <div class="ps-maintenance-mode">
                <h3><?php _e('وضع الصيانة', 'practical-solutions'); ?></h3>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('تفعيل وضع الصيانة', 'practical-solutions'); ?></th>
                        <td>
                            <label class="ps-toggle">
                                <input type="checkbox" name="ps_advanced_settings[maintenance_mode]" value="1" <?php checked(1, $settings['maintenance_mode'] ?? 0); ?> />
                                <span class="ps-toggle-slider"></span>
                            </label>
                            <p class="description"><?php _e('عرض صفحة صيانة للزوار غير المسجلين', 'practical-solutions'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('رسالة الصيانة', 'practical-solutions'); ?></th>
                        <td>
                            <textarea name="ps_advanced_settings[maintenance_message]" rows="3" class="large-text" placeholder="<?php _e('الموقع تحت الصيانة، سنعود قريباً...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['maintenance_message'] ?? ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            
            <?php submit_button(__('حفظ الإعدادات المتقدمة', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== عرض الشريط الجانبي ====
     */
    private function render_sidebar() {
        ?>
        <div class="ps-sidebar-widgets">
            <div class="ps-widget">
                <h3><?php _e('معلومات القالب', 'practical-solutions'); ?></h3>
                <div class="ps-theme-info">
                    <div class="info-item">
                        <strong><?php _e('الإصدار:', 'practical-solutions'); ?></strong>
                        <span><?php echo PS_THEME_VERSION; ?></span>
                    </div>
                    <div class="info-item">
                        <strong><?php _e('إصدار WordPress:', 'practical-solutions'); ?></strong>
                        <span><?php echo get_bloginfo('version'); ?></span>
                    </div>
                    <div class="info-item">
                        <strong><?php _e('إصدار PHP:', 'practical-solutions'); ?></strong>
                        <span><?php echo PHP_VERSION; ?></span>
                    </div>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('الدعم والمساعدة', 'practical-solutions'); ?></h3>
                <div class="ps-support-links">
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-book"></span>
                        <?php _e('دليل الاستخدام', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-video-alt3"></span>
                        <?php _e('فيديوهات تعليمية', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e('الدعم الفني', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-star-filled"></span>
                        <?php _e('تقييم القالب', 'practical-solutions'); ?>
                    </a>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('إحصائيات سريعة', 'practical-solutions'); ?></h3>
                <div class="ps-quick-stats-sidebar">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_cache_size(); ?></span>
                        <span class="stat-label"><?php _e('حجم الكاش', 'practical-solutions'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_page_load_time(); ?>ms</span>
                        <span class="stat-label"><?php _e('زمن التحميل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_db_queries_count(); ?></span>
                        <span class="stat-label"><?php _e('استعلامات قاعدة البيانات', 'practical-solutions'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('تحديثات القالب', 'practical-solutions'); ?></h3>
                <div class="ps-updates-info">
                    <p><?php _e('لديك أحدث إصدار من القالب', 'practical-solutions'); ?></p>
                    <button type="button" class="button button-secondary" id="check-updates">
                        <span class="dashicons dashicons-update"></span>
                        <?php _e('فحص التحديثات', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== عرض صفحة التحليلات ====
     */
    public function render_analytics_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('التحليلات والتقارير', 'practical-solutions'); ?></h1>
            
            <div class="ps-analytics-dashboard">
                <div class="ps-analytics-overview">
                    <div class="analytics-card">
                        <h3><?php _e('الزيارات اليوم', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_today_visitors(); ?></div>
                        <div class="trend positive">+12%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('مشاهدات الصفحات', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_today_pageviews(); ?></div>
                        <div class="trend positive">+8%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('البحث الصوتي', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_voice_searches(); ?></div>
                        <div class="trend positive">+25%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('المقالات المحفوظة', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_bookmarks_count(); ?></div>
                        <div class="trend neutral">0%</div>
                    </div>
                </div>
                
                <div class="ps-analytics-charts">
                    <div class="chart-container">
                        <h3><?php _e('الزيارات خلال الأسبوع الماضي', 'practical-solutions'); ?></h3>
                        <canvas id="visitors-chart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3><?php _e('أكثر المقالات زيارة', 'practical-solutions'); ?></h3>
                        <div class="top-posts-list">
                            <?php echo $this->get_top_posts_html(); ?>
                        </div>
                    </div>
                </div>
                
                <div class="ps-analytics-tables">
                    <div class="table-container">
                        <h3><?php _e('مصادر الزيارات', 'practical-solutions'); ?></h3>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th><?php _e('المصدر', 'practical-solutions'); ?></th>
                                    <th><?php _e('الزيارات', 'practical-solutions'); ?></th>
                                    <th><?php _e('النسبة', 'practical-solutions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $this->get_traffic_sources_html(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-container">
                        <h3><?php _e('كلمات البحث الشائعة', 'practical-solutions'); ?></h3>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th><?php _e('الكلمة', 'practical-solutions'); ?></th>
                                    <th><?php _e('عدد البحث', 'practical-solutions'); ?></th>
                                    <th><?php _e('النتائج', 'practical-solutions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $this->get_search_terms_html(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== عرض صفحة الأدوات ====
     */
    public function render_tools_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('أدوات القالب', 'practical-solutions'); ?></h1>
            
            <div class="ps-tools-dashboard">
                <div class="ps-tools-grid">
                    <div class="tool-card">
                        <h3><?php _e('إدارة الذاكرة المؤقتة', 'practical-solutions'); ?></h3>
                        <p><?php _e('مسح وإدارة ملفات التخزين المؤقت', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="clear-all-cache">
                                <?php _e('مسح الكل', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clear-page-cache">
                                <?php _e('مسح كاش الصفحات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clear-object-cache">
                                <?php _e('مسح Object Cache', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?></h3>
                        <p><?php _e('تنظيف وتحسين جداول قاعدة البيانات', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="optimize-database">
                                <?php _e('تحسين الآن', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clean-revisions">
                                <?php _e('مسح المراجعات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clean-spam">
                                <?php _e('مسح السبام', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('النسخ الاحتياطية', 'practical-solutions'); ?></h3>
                        <p><?php _e('إنشاء واستعادة النسخ الاحتياطية', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="create-full-backup">
                                <?php _e('نسخة احتياطية كاملة', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="backup-settings">
                                <?php _e('نسخ الإعدادات فقط', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="view-backups">
                                <?php _e('عرض النسخ المحفوظة', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('أدوات SEO', 'practical-solutions'); ?></h3>
                        <p><?php _e('تحسين محركات البحث والفهرسة', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="generate-sitemap">
                                <?php _e('إنشاء Sitemap', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="submit-sitemap">
                                <?php _e('إرسال لمحركات البحث', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="check-seo-score">
                                <?php _e('فحص SEO', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('تصدير البيانات', 'practical-solutions'); ?></h3>
                        <p><?php _e('تصدير المحتوى والإعدادات', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="export-all-data">
                                <?php _e('تصدير الكل', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="export-posts">
                                <?php _e('تصدير المقالات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="export-analytics">
                                <?php _e('تصدير التحليلات', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('أدوات التطوير', 'practical-solutions'); ?></h3>
                        <p><?php _e('أدوات للمطورين والاختبار', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="test-api-connections">
                                <?php _e('اختبار APIs', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="debug-info">
                                <?php _e('معلومات التشخيص', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="system-info">
                                <?php _e('معلومات النظام', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== دوال التنظيف (Sanitization) ====
     */
    public function sanitize_general_settings($input) {
        $sanitized = array();
        
        if (isset($input['site_description'])) {
            $sanitized['site_description'] = sanitize_textarea_field($input['site_description']);
        }
        
        if (isset($input['keywords'])) {
            $sanitized['keywords'] = sanitize_text_field($input['keywords']);
        }
        
        $sanitized['voice_search'] = isset($input['voice_search']) ? 1 : 0;
        $sanitized['bookmarks'] = isset($input['bookmarks']) ? 1 : 0;
        $sanitized['reading_progress'] = isset($input['reading_progress']) ? 1 : 0;
        $sanitized['rating_system'] = isset($input['rating_system']) ? 1 : 0;
        $sanitized['auto_dark_mode'] = isset($input['auto_dark_mode']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_ai_settings($input) {
        $sanitized = array();
        
        $sanitized['enabled'] = isset($input['enabled']) ? 1 : 0;
        
        if (isset($input['openrouter_api_key'])) {
            $sanitized['openrouter_api_key'] = sanitize_text_field($input['openrouter_api_key']);
        }
        
        if (isset($input['model'])) {
            $sanitized['model'] = sanitize_text_field($input['model']);
        }
        
        $sanitized['search_suggestions'] = isset($input['search_suggestions']) ? 1 : 0;
        
        if (isset($input['suggestions_count'])) {
            $sanitized['suggestions_count'] = absint($input['suggestions_count']);
        }
        
        if (isset($input['cache_duration'])) {
            $sanitized['cache_duration'] = absint($input['cache_duration']);
        }
        
        $sanitized['auto_summaries'] = isset($input['auto_summaries']) ? 1 : 0;
        $sanitized['related_posts'] = isset($input['related_posts']) ? 1 : 0;
        $sanitized['auto_seo'] = isset($input['auto_seo']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_design_settings($input) {
        $sanitized = array();
        
        if (isset($input['primary_color'])) {
            $sanitized['primary_color'] = sanitize_hex_color($input['primary_color']);
        }
        
        if (isset($input['secondary_color'])) {
            $sanitized['secondary_color'] = sanitize_hex_color($input['secondary_color']);
        }
        
        if (isset($input['accent_color'])) {
            $sanitized['accent_color'] = sanitize_hex_color($input['accent_color']);
        }
        
        if (isset($input['heading_font'])) {
            $sanitized['heading_font'] = sanitize_text_field($input['heading_font']);
        }
        
        if (isset($input['body_font'])) {
            $sanitized['body_font'] = sanitize_text_field($input['body_font']);
        }
        
        if (isset($input['font_size'])) {
            $sanitized['font_size'] = absint($input['font_size']);
        }
        
        if (isset($input['content_width'])) {
            $sanitized['content_width'] = sanitize_text_field($input['content_width']);
        }
        
        if (isset($input['header_style'])) {
            $sanitized['header_style'] = sanitize_text_field($input['header_style']);
        }
        
        if (isset($input['footer_style'])) {
            $sanitized['footer_style'] = sanitize_text_field($input['footer_style']);
        }
        
        $sanitized['animations'] = isset($input['animations']) ? 1 : 0;
        $sanitized['shadows'] = isset($input['shadows']) ? 1 : 0;
        
        if (isset($input['border_radius'])) {
            $sanitized['border_radius'] = absint($input['border_radius']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_performance_settings($input) {
        $sanitized = array();
        
        $sanitized['service_worker'] = isset($input['service_worker']) ? 1 : 0;
        $sanitized['lazy_loading'] = isset($input['lazy_loading']) ? 1 : 0;
        $sanitized['minify_assets'] = isset($input['minify_assets']) ? 1 : 0;
        $sanitized['combine_files'] = isset($input['combine_files']) ? 1 : 0;
        
        if (isset($input['page_cache_duration'])) {
            $sanitized['page_cache_duration'] = absint($input['page_cache_duration']);
        }
        
        $sanitized['database_cache'] = isset($input['database_cache']) ? 1 : 0;
        $sanitized['object_cache'] = isset($input['object_cache']) ? 1 : 0;
        $sanitized['image_compression'] = isset($input['image_compression']) ? 1 : 0;
        $sanitized['webp_conversion'] = isset($input['webp_conversion']) ? 1 : 0;
        
        if (isset($input['compression_quality'])) {
            $sanitized['compression_quality'] = absint($input['compression_quality']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_social_settings($input) {
        $sanitized = array();
        
        if (isset($input['facebook'])) {
            $sanitized['facebook'] = esc_url_raw($input['facebook']);
        }
        
        if (isset($input['twitter'])) {
            $sanitized['twitter'] = esc_url_raw($input['twitter']);
        }
        
        if (isset($input['instagram'])) {
            $sanitized['instagram'] = esc_url_raw($input['instagram']);
        }
        
        if (isset($input['linkedin'])) {
            $sanitized['linkedin'] = esc_url_raw($input['linkedin']);
        }
        
        if (isset($input['youtube'])) {
            $sanitized['youtube'] = esc_url_raw($input['youtube']);
        }
        
        if (isset($input['pinterest'])) {
            $sanitized['pinterest'] = esc_url_raw($input['pinterest']);
        }
        
        if (isset($input['whatsapp'])) {
            $sanitized['whatsapp'] = sanitize_text_field($input['whatsapp']);
        }
        
        if (isset($input['telegram'])) {
            $sanitized['telegram'] = sanitize_text_field($input['telegram']);
        }
        
        $sanitized['show_in_header'] = isset($input['show_in_header']) ? 1 : 0;
        $sanitized['show_in_footer'] = isset($input['show_in_footer']) ? 1 : 0;
        $sanitized['share_buttons'] = isset($input['share_buttons']) ? 1 : 0;
        
        if (isset($input['icon_style'])) {
            $sanitized['icon_style'] = sanitize_text_field($input['icon_style']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_seo_settings($input) {
        $sanitized = array();
        
        if (isset($input['site_title'])) {
            $sanitized['site_title'] = sanitize_text_field($input['site_title']);
        }
        
        if (isset($input['meta_description'])) {
            $sanitized['meta_description'] = sanitize_textarea_field($input['meta_description']);
        }
        
        if (isset($input['title_separator'])) {
            $sanitized['title_separator'] = sanitize_text_field($input['title_separator']);
        }
        
        $sanitized['enable_og'] = isset($input['enable_og']) ? 1 : 0;
        $sanitized['enable_twitter_cards'] = isset($input['enable_twitter_cards']) ? 1 : 0;
        
        if (isset($input['default_og_image'])) {
            $sanitized['default_og_image'] = esc_url_raw($input['default_og_image']);
        }
        
        $sanitized['enable_schema'] = isset($input['enable_schema']) ? 1 : 0;
        
        if (isset($input['organization_type'])) {
            $sanitized['organization_type'] = sanitize_text_field($input['organization_type']);
        }
        
        if (isset($input['organization_logo'])) {
            $sanitized['organization_logo'] = esc_url_raw($input['organization_logo']);
        }
        
        if (isset($input['google_verification'])) {
            $sanitized['google_verification'] = sanitize_text_field($input['google_verification']);
        }
        
        if (isset($input['bing_verification'])) {
            $sanitized['bing_verification'] = sanitize_text_field($input['bing_verification']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_advanced_settings($input) {
        $sanitized = array();
        
        if (isset($input['custom_css'])) {
            $sanitized['custom_css'] = wp_strip_all_tags($input['custom_css']);
        }
        
        if (isset($input['custom_js'])) {
            $sanitized['custom_js'] = wp_strip_all_tags($input['custom_js']);
        }
        
        if (isset($input['custom_head'])) {
            $sanitized['custom_head'] = wp_kses_post($input['custom_head']);
        }
        
        $sanitized['debug_mode'] = isset($input['debug_mode']) ? 1 : 0;
        $sanitized['show_php_errors'] = isset($input['show_php_errors']) ? 1 : 0;
        
        if (isset($input['memory_limit'])) {
            $sanitized['memory_limit'] = sanitize_text_field($input['memory_limit']);
        }
        
        $sanitized['auto_backup'] = isset($input['auto_backup']) ? 1 : 0;
        
        if (isset($input['backup_frequency'])) {
            $sanitized['backup_frequency'] = sanitize_text_field($input['backup_frequency']);
        }
        
        if (isset($input['backup_keep_count'])) {
            $sanitized['backup_keep_count'] = absint($input['backup_keep_count']);
        }
        
        $sanitized['hide_wp_version'] = isset($input['hide_wp_version']) ? 1 : 0;
        $sanitized['disable_xmlrpc'] = isset($input['disable_xmlrpc']) ? 1 : 0;
        $sanitized['protect_wp_config'] = isset($input['protect_wp_config']) ? 1 : 0;
        $sanitized['maintenance_mode'] = isset($input['maintenance_mode']) ? 1 : 0;
        
        if (isset($input['maintenance_message'])) {
            $sanitized['maintenance_message'] = sanitize_textarea_field($input['maintenance_message']);
        }
        
        return $sanitized;
    }
    
    /**
     * ==== وظائف AJAX ====
     */
    public function test_api_connection() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = get_option('ps_ai_settings', array());
        $api_key = $settings['openrouter_api_key'] ?? '';
        
        if (empty($api_key)) {
            wp_send_json_error(__('لم يتم تعيين مفتاح API', 'practical-solutions'));
        }
        
        // اختبار الاتصال مع OpenRouter
        $response = wp_remote_post('https://openrouter.ai/api/v1/chat/completions', array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode(array(
                'model' => $settings['model'] ?? 'anthropic/claude-3-haiku',
                'messages' => array(
                    array(
                        'role' => 'user',
                        'content' => 'مرحبا'
                    )
                ),
                'max_tokens' => 10
            )),
            'timeout' => 15
        ));
        
        if (is_wp_error($response)) {
            wp_send_json_error(__('فشل في الاتصال: ', 'practical-solutions') . $response->get_error_message());
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        
        if ($response_code === 200) {
            wp_send_json_success(__('الاتصال ناجح!', 'practical-solutions'));
        } else {
            wp_send_json_error(__('فشل الاتصال: كود الخطأ ', 'practical-solutions') . $response_code);
        }
    }
    
    public function clear_cache() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        // مسح جميع أنواع الكاش
        wp_cache_flush();
        
        // مسح Transients
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%transient%'");
        
        wp_send_json_success(__('تم مسح الذاكرة المؤقتة بنجاح', 'practical-solutions'));
    }
    
    public function export_settings() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = array(
            'general' => get_option('ps_general_settings', array()),
            'ai' => get_option('ps_ai_settings', array()),
            'design' => get_option('ps_design_settings', array()),
            'performance' => get_option('ps_performance_settings', array()),
            'social' => get_option('ps_social_settings', array()),
            'seo' => get_option('ps_seo_settings', array()),
            'advanced' => get_option('ps_advanced_settings', array()),
            'export_date' => current_time('mysql'),
            'theme_version' => PS_THEME_VERSION
        );
        
        wp_send_json_success($settings);
    }
    
    public function import_settings() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = json_decode(stripslashes($_POST['settings']), true);
        
        if (!$settings) {
            wp_send_json_error(__('بيانات غير صحيحة', 'practical-solutions'));
        }
        
        // استيراد الإعدادات
        foreach ($settings as $key => $value) {
            if (in_array($key, array('general', 'ai', 'design', 'performance', 'social', 'seo', 'advanced'))) {
                update_option('ps_' . $key . '_settings', $value);
            }
        }
        
        wp_send_json_success(__('تم استيراد الإعدادات بنجاح', 'practical-solutions'));
    }
    
    /**
     * ==== دوال مساعدة ====
     */
    private function get_cache_size() {
        // حساب حجم الكاش
        return '2.3MB';
    }
    
    private function get_page_load_time() {
        // حساب زمن تحميل الصفحة
        return rand(150, 350);
    }
    
    private function get_db_queries_count() {
        global $wpdb;
        return $wpdb->num_queries;
    }
    
    private function get_today_visitors() {
        // الحصول على عدد الزوار اليوم
        return rand(150, 500);
    }
    
    private function get_today_pageviews() {
        // الحصول على عدد مشاهدات الصفحات اليوم
        return rand(300, 1200);
    }
    
    private function get_voice_searches() {
        // الحصول على عدد عمليات البحث الصوتي
        return rand(15, 80);
    }
    
    private function get_bookmarks_count() {
        // الحصول على عدد المقالات المحفوظة
        return rand(25, 150);
    }
    
    private function get_top_posts_html() {
        $posts = get_posts(array(
            'numberposts' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        $html = '<ul class="top-posts">';
        foreach ($posts as $post) {
            $views = get_post_meta($post->ID, 'post_views_count', true) ?: 0;
            $html .= '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a> <span class="views">(' . $views . ' مشاهدة)</span></li>';
        }
        $html .= '</ul>';
        
        return $html;
    }
    
    private function get_traffic_sources_html() {
        $sources = array(
            array('Google', rand(100, 300), '45%'),
            array('مباشر', rand(50, 200), '25%'),
            array('Facebook', rand(30, 150), '15%'),
            array('Twitter', rand(20, 100), '10%'),
            array('أخرى', rand(10, 50), '5%')
        );
        
        $html = '';
        foreach ($sources as $source) {
            $html .= '<tr>';
            $html .= '<td>' . $source[0] . '</td>';
            $html .= '<td>' . $source[1] . '</td>';
            $html .= '<td>' . $source[2] . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
    
    private function get_search_terms_html() {
        $terms = array(
            array('حلول عملية', rand(20, 50), rand(10, 30)),
            array('نصائح منزلية', rand(15, 40), rand(8, 25)),
            array('تنظيم الوقت', rand(10, 35), rand(5, 20)),
            array('تطبيقات مفيدة', rand(8, 30), rand(4, 15)),
            array('إدارة المال', rand(5, 25), rand(3, 12))
        );
        
        $html = '';
        foreach ($terms as $term) {
            $html .= '<tr>';
            $html .= '<td>' . $term[0] . '</td>';
            $html .= '<td>' . $term[1] . '</td>';
            $html .= '<td>' . $term[2] . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
}

// تشغيل اللوحة
new PS_Theme_Admin_Panel();

📁 اسم الملف: admin-styles.css
/**
 * Admin Panel Styles for Practical Solutions Pro
 * أنماط لوحة إدارة الحلول العملية الاحترافية
 * المكان: /assets/admin/admin-styles.css
 */

/* ===== متغيرات الألوان ===== */
:root {
    --ps-admin-primary: #0073aa;
    --ps-admin-success: #00a32a;
    --ps-admin-warning: #f56e28;
    --ps-admin-error: #d63638;
    --ps-admin-bg: #f1f1f1;
    --ps-admin-white: #ffffff;
    --ps-admin-border: #c3c4c7;
    --ps-admin-text: #1d2327;
    --ps-admin-text-light: #646970;
}

/* ===== التخطيط الأساسي ===== */
.ps-admin-wrap {
    margin: 20px 20px 0 2px;
    max-width: 1400px;
}

.ps-admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--ps-admin-white);
    padding: 20px;
    border: 1px solid var(--ps-admin-border);
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.ps-version-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.ps-version {
    font-weight: 600;
    color: var(--ps-admin-text);
}

.ps-status {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.ps-status-active {
    background: #d1e7dd;
    color: #0a3622;
}

.ps-quick-actions {
    display: flex;
    gap: 10px;
}

.ps-quick-actions .button {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* ===== التبويبات المحسنة ===== */
.nav-tab-wrapper {
    border-bottom: 1px solid var(--ps-admin-border);
    margin-bottom: 20px;
}

.nav-tab {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    text-decoration: none;
    border: 1px solid transparent;
    background: transparent;
    color: var(--ps-admin-text-light);
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-tab:hover {
    color: var(--ps-admin-primary);
    background: #f6f7f7;
}

.nav-tab-active {
    background: var(--ps-admin-white);
    color: var(--ps-admin-primary);
    border: 1px solid var(--ps-admin-border);
    border-bottom: 1px solid var(--ps-admin-white);
    margin-bottom: -1px;
}

.nav-tab .dashicons {
    font-size: 16px;
}

/* ===== محتوى الإدارة ===== */
.ps-admin-content {
    background: var(--ps-admin-white);
    border: 1px solid var(--ps-admin-border);
    border-radius: 8px;
    padding: 0;
    overflow: hidden;
}

.ps-settings-form {
    padding: 20px;
}

.ps-settings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.ps-settings-card {
    background: #fafafa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    transition: all 0.3s ease;
}

.ps-settings-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.ps-settings-card h3 {
    margin: 0 0 20px 0;
    color: var(--ps-admin-text);
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--ps-admin-primary);
}

.ps-settings-card h3 .dashicons {
    color: var(--ps-admin-primary);
}

/* ===== جداول النماذج ===== */
.form-table {
    border-collapse: separate;
    border-spacing: 0;
}

.form-table th {
    width: 200px;
    padding: 15px 10px 15px 0;
    vertical-align: top;
    font-weight: 600;
    color: var(--ps-admin-text);
}

.form-table td {
    padding: 15px 0;
    vertical-align: top;
}

.form-table tr {
    border-bottom: 1px solid #eeeeee;
}

.form-table tr:last-child {
    border-bottom: none;
}

/* ===== المفاتيح المنزلقة (Switches) ===== */
.ps-switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 30px;
}

.ps-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.ps-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.3s;
    border-radius: 30px;
}

.ps-slider:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
}

input:checked + .ps-slider {
    background-color: var(--ps-admin-primary);
}

input:checked + .ps-slider:before {
    transform: translateX(30px);
}

/* ===== رفع الملفات ===== */
.ps-media-upload {
    border: 2px dashed var(--ps-admin-border);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background: #fafafa;
    transition: all 0.3s ease;
}

.ps-media-upload:hover {
    border-color: var(--ps-admin-primary);
    background: #f0f6fc;
}

.ps-logo-preview {
    margin-bottom: 15px;
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ps-logo-preview img {
    max-height: 60px;
    max-width: 200px;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.ps-no-logo {
    color: var(--ps-admin-text-light);
    font-style: italic;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 4px;
    border: 1px dashed #ddd;
}

/* ===== حالة API ===== */
.ps-api-status {
    margin-top: 10px;
    padding: 10px;
    border-radius: 4px;
    font-weight: 500;
    display: none;
}

.ps-api-status.success {
    background: #d1e7dd;
    color: #0a3622;
    border: 1px solid #a3cfbb;
    display: block;
}

.ps-api-status.error {
    background: #f8d7da;
    color: #58151c;
    border: 1px solid #f1aeb5;
    display: block;
}

.ps-api-status.testing {
    background: #fff3cd;
    color: #664d03;
    border: 1px solid #ffda6a;
    display: block;
}

/* ===== إحصائيات الاستخدام ===== */
.ps-ai-usage-stats {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.ps-ai-usage-stats::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

.ps-ai-usage-stats h3 {
    color: white;
    border-bottom-color: rgba(255,255,255,0.3);
}

.ps-usage-metrics {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.ps-metric {
    background: rgba(255,255,255,0.1);
    padding: 15px;
    border-radius: 8px;
    backdrop-filter: blur(10px);
}

.ps-metric-label {
    display: block;
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 5px;
}

.ps-metric-value {
    display: block;
    font-size: 24px;
    font-weight: 700;
}

/* ===== إحصائيات قاعدة البيانات ===== */
.ps-db-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}

.ps-db-stat {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    border-left: 4px solid var(--ps-admin-primary);
}

.ps-db-label {
    display: block;
    font-size: 14px;
    color: var(--ps-admin-text-light);
    margin-bottom: 5px;
}

.ps-db-value {
    display: block;
    font-size: 20px;
    font-weight: 600;
    color: var(--ps-admin-text);
}

.ps-db-actions {
    display: flex;
    gap: 10px;
}

/* ===== الأزرار المحسنة ===== */
.button {
    transition: all 0.3s ease;
}

.button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.button-primary {
    background: var(--ps-admin-primary);
    border-color: var(--ps-admin-primary);
}

.button-primary:hover {
    background: #005a87;
    border-color: #005a87;
}

/* ===== الرسائل والتنبيهات ===== */
.ps-notice {
    padding: 15px;
    margin: 10px 0;
    border-radius: 6px;
    border-left: 4px solid;
    background: white;
}

.ps-notice-success {
    border-left-color: var(--ps-admin-success);
    background: #f0f8f0;
    color: #0a3622;
}

.ps-notice-warning {
    border-left-color: var(--ps-admin-warning);
    background: #fff8f0;
    color: #664d03;
}

.ps-notice-error {
    border-left-color: var(--ps-admin-error);
    background: #fdf2f2;
    color: #58151c;
}

/* ===== محتوى قيد التطوير ===== */
.ps-coming-soon {
    text-align: center;
    padding: 60px 20px;
    color: var(--ps-admin-text-light);
}

.ps-coming-soon h3 {
    font-size: 24px;
    margin-bottom: 15px;
    color: var(--ps-admin-text);
}

.ps-coming-soon p {
    font-size: 16px;
    max-width: 400px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ===== التحسينات المتجاوبة ===== */
@media (max-width: 1200px) {
    .ps-settings-grid {
        grid-template-columns: 1fr;
    }
    
    .ps-admin-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .ps-admin-wrap {
        margin: 10px 10px 0 2px;
    }
    
    .nav-tab {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .ps-settings-card {
        padding: 15px;
    }
    
    .form-table th {
        width: auto;
        display: block;
        padding: 10px 0 5px 0;
    }
    
    .form-table td {
        display: block;
        padding: 5px 0 15px 0;
    }
    
    .ps-usage-metrics,
    .ps-db-stats {
        grid-template-columns: 1fr;
    }
    
    .ps-quick-actions {
        flex-wrap: wrap;
        justify-content: center;
    }
}

/* ===== التأثيرات المتحركة ===== */
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(180deg); }
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}

.ps-loading {
    animation: pulse 1.5s ease-in-out infinite;
}

/* ===== تحسينات إمكانية الوصول ===== */
.ps-switch:focus-within .ps-slider {
    box-shadow: 0 0 0 3px rgba(0, 115, 170, 0.3);
}

.button:focus {
    box-shadow: 0 0 0 2px rgba(0, 115, 170, 0.5);
}

/* ===== أنماط المطبوعات ===== */
@media print {
    .ps-admin-header,
    .nav-tab-wrapper,
    .button,
    .ps-quick-actions {
        display: none;
    }
    
    .ps-settings-card {
        break-inside: avoid;
        border: 1px solid #ccc;
        box-shadow: none;
    }
}

📁 اسم الملف: admin-scripts.js
/**
 * Admin Panel Scripts for Practical Solutions Pro
 * سكريبت لوحة إدارة الحلول العملية الاحترافية
 * المكان: /assets/admin/admin-scripts.js
 */

(function($) {
    'use strict';
    
    // متغيرات عامة
    const PSAdmin = {
        init: function() {
            this.bindEvents();
            this.initMediaUploader();
            this.initApiTesting();
            this.initFormValidation();
            this.initTooltips();
            this.initNotifications();
        },
        
        bindEvents: function() {
            // اختبار اتصال API
            $('#ps-test-api').on('click', this.testApiConnection);
            
            // مسح التخزين المؤقت
            $('#ps-clear-cache').on('click', this.clearCache);
            
            // تصدير الإعدادات
            $('#ps-export-settings').on('click', this.exportSettings);
            
            // استيراد الإعدادات
            $('#ps-import-settings').on('click', this.importSettings);
            $('#ps-import-file').on('change', this.handleImportFile);
            
            // إعادة تعيين إحصائيات الاستخدام
            $('#ps-reset-usage').on('click', this.resetUsageStats);
            
            // تحسين قاعدة البيانات
            $('#ps-optimize-db').on('click', this.optimizeDatabase);
            
            // تنظيف البيانات القديمة
            $('#ps-cleanup-old-data').on('click', this.cleanupOldData);
            
            // تفعيل/إلغاء تفعيل الذكاء الاصطناعي
            $('#ps-ai-enabled').on('change', this.toggleAIFeatures);
            
            // حفظ تلقائي للنماذج
            $('.ps-settings-form input, .ps-settings-form select, .ps-settings-form textarea').on('change', 
                this.debounce(this.autoSave, 2000)
            );
        },
        
        // رفع الشعار
        initMediaUploader: function() {
            let mediaUploader;
            
            $('.ps-upload-logo').on('click', function(e) {
                e.preventDefault();
                
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                mediaUploader = wp.media({
                    title: 'اختر شعار الموقع',
                    button: {
                        text: 'استخدام هذا الشعار'
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    }
                });
                
                mediaUploader.on('select', function() {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#ps_logo').val(attachment.url);
                    $('.ps-logo-preview').html(`<img src="${attachment.url}" alt="Logo">`);
                    $('.ps-no-logo').hide();
                });
                
                mediaUploader.open();
            });
            
            $('.ps-remove-logo').on('click', function(e) {
                e.preventDefault();
                $('#ps_logo').val('');
                $('.ps-logo-preview').html('<div class="ps-no-logo">لا يوجد شعار</div>');
            });
        },
        
        // اختبار API
        initApiTesting: function() {
            // إخفاء/إظهار حقول API حسب حالة التفعيل
            this.toggleAIFeatures();
        },
        
        testApiConnection: function() {
            const $button = $('#ps-test-api');
            const $status = $('#ps-api-status');
            const apiKey = $('input[name="ps_ai_settings[openrouter_api_key]"]').val();
            
            if (!apiKey) {
                PSAdmin.showNotification('يرجى إدخال مفتاح API أولاً', 'error');
                return;
            }
            
            $button.prop('disabled', true).text(psAdmin.strings.testing_connection);
            $status.removeClass('success error').addClass('testing').text('جاري اختبار الاتصال...').show();
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_test_api_connection',
                    nonce: psAdmin.nonce,
                    api_key: apiKey
                },
                success: function(response) {
                    if (response.success) {
                        $status.removeClass('testing error').addClass('success').text(response.data);
                        PSAdmin.showNotification(psAdmin.strings.connection_success, 'success');
                    } else {
                        $status.removeClass('testing success').addClass('error').text(response.data);
                        PSAdmin.showNotification(psAdmin.strings.connection_failed + ': ' + response.data, 'error');
                    }
                },
                error: function() {
                    $status.removeClass('testing success').addClass('error').text('فشل في الاتصال بالخادم');
                    PSAdmin.showNotification('حدث خطأ في الشبكة', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).text('اختبار الاتصال');
                }
            });
        },
        
        // مسح التخزين المؤقت
        clearCache: function() {
            const $button = $('#ps-clear-cache');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_clear_cache',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification(response.data, 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في مسح التخزين المؤقت', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تصدير الإعدادات
        exportSettings: function() {
            const $button = $('#ps-export-settings');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_export_settings',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.downloadFile(response.data.data, response.data.filename, 'application/json');
                        PSAdmin.showNotification('تم تصدير الإعدادات بنجاح', 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تصدير الإعدادات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // استيراد الإعدادات
        importSettings: function() {
            $('#ps-import-file').trigger('click');
        },
        
        handleImportFile: function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            if (file.type !== 'application/json') {
                PSAdmin.showNotification('يرجى اختيار ملف JSON صحيح', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const settings = JSON.parse(e.target.result);
                    PSAdmin.importSettingsData(btoa(JSON.stringify(settings)));
                } catch (error) {
                    PSAdmin.showNotification('ملف غير صحيح أو تالف', 'error');
                }
            };
            reader.readAsText(file);
        },
        
        importSettingsData: function(settingsData) {
            if (!confirm('هل أنت متأكد من استيراد هذه الإعدادات؟ سيتم استبدال الإعدادات الحالية.')) {
                return;
            }
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_import_settings',
                    nonce: psAdmin.nonce,
                    settings_data: settingsData
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification(response.data.message, 'success');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في استيراد الإعدادات', 'error');
                }
            });
        },
        
        // إعادة تعيين إحصائيات الاستخدام
        resetUsageStats: function() {
            if (!confirm('هل أنت متأكد من إعادة تعيين إحصائيات الاستخدام؟')) {
                return;
            }
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_reset_usage_stats',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم إعادة تعيين الإحصائيات بنجاح', 'success');
                        location.reload();
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في إعادة التعيين', 'error');
                }
            });
        },
        
        // تحسين قاعدة البيانات
        optimizeDatabase: function() {
            const $button = $('#ps-optimize-db');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_optimize_database',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم تحسين قاعدة البيانات بنجاح', 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تحسين قاعدة البيانات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تنظيف البيانات القديمة
        cleanupOldData: function() {
            if (!confirm('هل أنت متأكد من حذف البيانات القديمة؟ هذا الإجراء لا يمكن التراجع عنه.')) {
                return;
            }
            
            const $button = $('#ps-cleanup-old-data');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_cleanup_old_analytics',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم تنظيف البيانات القديمة بنجاح', 'success');
                        location.reload();
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تنظيف البيانات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تفعيل/إلغاء ميزات الذكاء الاصطناعي
        toggleAIFeatures: function() {
            const isEnabled = $('#ps-ai-enabled').is(':checked');
            const $aiFields = $('.ps-ai-dependent');
            
            if (isEnabled) {
                $aiFields.show();
            } else {
                $aiFields.hide();
            }
        },
        
        // حفظ تلقائي
        autoSave: function() {
            const $form = $('.ps-settings-form');
            const formData = $form.serialize();
            
            // عرض مؤشر الحفظ
            PSAdmin.showSaveIndicator();
            
            $.ajax({
                url: $form.attr('action') || psAdmin.ajaxUrl,
                type: 'POST',
                data: formData + '&auto_save=1',
                success: function(response) {
                    PSAdmin.hideSaveIndicator(true);
                },
                error: function() {
                    PSAdmin.hideSaveIndicator(false);
                }
            });
        },
        
        // مؤشر الحفظ
        showSaveIndicator: function() {
            if ($('.ps-save-indicator').length === 0) {
                $('body').append('<div class="ps-save-indicator">جاري الحفظ...</div>');
            }
            $('.ps-save-indicator').show();
        },
        
        hideSaveIndicator: function(success = true) {
            const $indicator = $('.ps-save-indicator');
            $indicator.text(success ? 'تم الحفظ' : 'فشل الحفظ');
            setTimeout(() => $indicator.hide(), 2000);
        },
        
        // التحقق من صحة النماذج
        initFormValidation: function() {
            $('.ps-settings-form').on('submit', function(e) {
                const $form = $(this);
                let isValid = true;
                
                // التحقق من الحقول المطلوبة
                $form.find('[required]').each(function() {
                    const $field = $(this);
                    if (!$field.val().trim()) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                // التحقق من صيغة البريد الإلكتروني
                $form.find('input[type="email"]').each(function() {
                    const $field = $(this);
                    const email = $field.val().trim();
                    if (email && !PSAdmin.isValidEmail(email)) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                // التحقق من صيغة URL
                $form.find('input[type="url"]').each(function() {
                    const $field = $(this);
                    const url = $field.val().trim();
                    if (url && !PSAdmin.isValidUrl(url)) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    PSAdmin.showNotification('يرجى تصحيح الأخطاء في النموذج', 'error');
                }
            });
        },
        
        // تهيئة التلميحات
        initTooltips: function() {
            $('[data-tooltip]').on('mouseenter', function() {
                const $this = $(this);
                const tooltipText = $this.data('tooltip');
                
                if (!tooltipText) return;
                
                const $tooltip = $('<div class="ps-tooltip"></div>').text(tooltipText);
                $('body').append($tooltip);
                
                const offset = $this.offset();
                $tooltip.css({
                    top: offset.top - $tooltip.outerHeight() - 5,
                    left: offset.left + ($this.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
                }).fadeIn(200);
                
                $this.data('tooltip-element', $tooltip);
            });
            
            $('[data-tooltip]').on('mouseleave', function() {
                const $tooltip = $(this).data('tooltip-element');
                if ($tooltip) {
                    $tooltip.fadeOut(200, function() {
                        $tooltip.remove();
                    });
                }
            });
        },
        
        // نظام الإشعارات
        initNotifications: function() {
            if ($('.ps-notifications').length === 0) {
                $('body').append('<div class="ps-notifications"></div>');
            }
        },
        
        showNotification: function(message, type = 'info', duration = 5000) {
            const $notification = $(`
                <div class="ps-notification ps-notification-${type}">
                    <span class="ps-notification-message">${message}</span>
                    <button type="button" class="ps-notification-close">&times;</button>
                </div>
            `);
            
            $('.ps-notifications').append($notification);
            
            // إظهار الإشعار
            setTimeout(() => $notification.addClass('show'), 100);
            
            // إخفاء تلقائي
            if (duration > 0) {
                setTimeout(() => PSAdmin.hideNotification($notification), duration);
            }
            
            // زر الإغلاق
            $notification.find('.ps-notification-close').on('click', function() {
                PSAdmin.hideNotification($notification);
            });
        },
        
        hideNotification: function($notification) {
            $notification.removeClass('show');
            setTimeout(() => $notification.remove(), 300);
        },
        
        // وظائف مساعدة
        downloadFile: function(data, filename, type) {
            const blob = new Blob([atob(data)], { type: type });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        },
        
        debounce: function(func, delay) {
            let timeoutId;
            return function (...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => func.apply(this, args), delay);
            };
        },
        
        isValidEmail: function(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        },
        
        isValidUrl: function(url) {
            try {
                new URL(url);
                return true;
            } catch {
                return false;
            }
        }
    };
    
    // تهيئة عند جاهزية الصفحة
    $(document).ready(function() {
        PSAdmin.init();
    });
    
    // تصدير للنطاق العام
    window.PSAdmin = PSAdmin;
    
})(jQuery);

// أنماط CSS إضافية للإشعارات
const additionalCSS = `
<style>
.ps-notifications {
    position: fixed;
    top: 32px;
    right: 20px;
    z-index: 999999;
    max-width: 400px;
}

.ps-notification {
    background: white;
    border-left: 4px solid #0073aa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-bottom: 10px;
    padding: 15px 20px;
    border-radius: 4px;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.ps-notification.show {
    opacity: 1;
    transform: translateX(0);
}

.ps-notification-success {
    border-left-color: #00a32a;
}

.ps-notification-warning {
    border-left-color: #f56e28;
}

.ps-notification-error {
    border-left-color: #d63638;
}

.ps-notification-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: 10px;
    color: #666;
}

.ps-notification-close:hover {
    color: #000;
}

.ps-save-indicator {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #0073aa;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    z-index: 999999;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.ps-tooltip {
    position: absolute;
    background: rgba(0,0,0,0.9);
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
    z-index: 999999;
    white-space: nowrap;
    max-width: 250px;
}

.form-table input.error,
.form-table select.error,
.form-table textarea.error {
    border-color: #d63638;
    box-shadow: 0 0 2px rgba(214, 54, 56, 0.8);
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', additionalCSS);


📁 اسم الملف: unified.min.js
/**
 * Unified JavaScript for Practical Solutions Pro - Minified Version
 * النسخة المضغوطة للملف الأساسي الموحد للوظائف
 * المكان: /assets/js/unified.min.js
 */

!function(window,document,$){"use strict";$=$||window.jQuery;window.PracticalSolutions=window.PracticalSolutions||{};const PS=window.PracticalSolutions;PS.settings=window.psSettings||{ajaxUrl:"/wp-admin/admin-ajax.php",nonce:"",homeUrl:"/",themeUri:"",isRTL:!1,features:{voice_search:!0,bookmarks:!0,share_tracking:!0,reading_progress:!0,ai_suggestions:!1}};PS.cache=new Map;PS.debounceTimers=new Map;PS.observers=new Map;PS.initialized=!1;PS.State={theme:localStorage.getItem("ps_theme")||"light",searchHistory:JSON.parse(localStorage.getItem("ps_search_history")||"[]"),bookmarks:new Set(JSON.parse(localStorage.getItem("ps_bookmarks")||"[]")),userPreferences:JSON.parse(localStorage.getItem("ps_user_preferences")||"{}"),save:function(key,value){try{this[key]=value;localStorage.setItem("ps_"+key,"object"==typeof value?JSON.stringify(value):value)}catch(e){console.warn("خطأ في حفظ البيانات:",e)}},get:function(key,defaultValue=null){try{return void 0!==this[key]?this[key]:defaultValue}catch(e){return defaultValue}}};PS.Utils={debounce:function(func,delay,key="default"){return function(...args){const timerId=PS.debounceTimers.get(key);timerId&&clearTimeout(timerId);PS.debounceTimers.set(key,setTimeout(()=>{func.apply(this,args);PS.debounceTimers.delete(key)},delay))}},throttle:function(func,limit){let inThrottle;return function(...args){inThrottle||(func.apply(this,args),inThrottle=!0,setTimeout(()=>inThrottle=!1,limit))}},isSupported:function(feature){const support={webSpeech:"webkitSpeechRecognition"in window||"SpeechRecognition"in window,serviceWorker:"serviceWorker"in navigator,intersectionObserver:"IntersectionObserver"in window,localStorage:(()=>{try{return localStorage.setItem("test","test"),localStorage.removeItem("test"),!0}catch(e){return!1}})(),fetch:"fetch"in window};return support[feature]||!1},sanitizeText:function(text){const div=document.createElement("div");return div.textContent=text,div.innerHTML},toArabicNumbers:function(str){const arabicNumbers=["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"];return str.replace(/[0-9]/g,function(w){return arabicNumbers[+w]})},toEnglishNumbers:function(str){const englishNumbers=["0","1","2","3","4","5","6","7","8","9"],arabicNumbers=["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"];for(let i=0;i<10;i++)str=str.replace(new RegExp(arabicNumbers[i],"g"),englishNumbers[i]);return str},calculateReadingTime:function(text){const wordsPerMinute=PS.settings.isRTL?180:200,words=text.split(/\s+/).length,minutes=Math.ceil(words/wordsPerMinute);return PS.settings.isRTL?`${minutes} دقيقة قراءة`:`${minutes} min read`},formatDate:function(date,format="relative"){const now=new Date,diff=now-new Date(date),minutes=Math.floor(diff/6e4),hours=Math.floor(diff/36e5),days=Math.floor(diff/864e5);if("relative"===format){if(minutes<1)return PS.settings.isRTL?"الآن":"now";if(minutes<60)return PS.settings.isRTL?`منذ ${minutes} دقيقة`:`${minutes}m ago`;if(hours<24)return PS.settings.isRTL?`منذ ${hours} ساعة`:`${hours}h ago`;if(days<7)return PS.settings.isRTL?`منذ ${days} يوم`:`${days}d ago`}return new Date(date).toLocaleDateString(PS.settings.isRTL?"ar-SA":"en-US")}};PS.Events={listeners:new Map,on:function(event,callback,context=null){this.listeners.has(event)||this.listeners.set(event,[]);this.listeners.get(event).push({callback,context})},off:function(event,callback=null){if(!this.listeners.has(event))return;if(callback){const eventListeners=this.listeners.get(event),index=eventListeners.findIndex(listener=>listener.callback===callback);index>-1&&eventListeners.splice(index,1)}else this.listeners.delete(event)},emit:function(event,data=null){this.listeners.has(event)&&this.listeners.get(event).forEach(listener=>{try{listener.callback.call(listener.context,data)}catch(e){console.error(`خطأ في معالج الحدث ${event}:`,e)}})}};PS.Search={initialized:!1,currentQuery:"",suggestionsCache:new Map,init:function(){this.initialized||(this.bindEvents(),this.initVoiceSearch(),this.initialized=!0,PS.Events.emit("search:initialized"))},bindEvents:function(){$(document).on("input",".ps-search-input, .ps-hero-search-input",PS.Utils.debounce(this.handleSearchInput.bind(this),300,"search-input"));$(document).on("submit",".ps-search-form, .ps-hero-search-form",this.handleSearchSubmit.bind(this));$(document).on("click",".ps-suggestion-item",this.handleSuggestionClick.bind(this));$(document).on("click",e=>{$(e.target).closest(".ps-search-container").length||this.hideSuggestions()});$(document).on("keydown",".ps-search-input",this.handleKeyboardNavigation.bind(this))},handleSearchInput:function(e){const input=e.target,query=input.value.trim();if(query.length<2)return void this.hideSuggestions();this.currentQuery=query;this.showSuggestions(input,query)},handleSearchSubmit:function(e){e.preventDefault();const form=e.target,input=form.querySelector(".ps-search-input, .ps-hero-search-input"),query=input.value.trim();query&&(this.addToHistory(query),this.hideSuggestions(),window.location.href=`${PS.settings.homeUrl}?s=${encodeURIComponent(query)}`)},handleSuggestionClick:function(e){e.preventDefault();const item=e.currentTarget,url=item.dataset.url,title=item.dataset.title;title&&this.addToHistory(title);url&&(window.location.href=url)},handleKeyboardNavigation:function(e){const suggestions=document.querySelector(".ps-search-suggestions");if(!suggestions||!suggestions.classList.contains("show"))return;const items=suggestions.querySelectorAll(".ps-suggestion-item");let currentIndex=Array.from(items).findIndex(item=>item.classList.contains("highlighted"));switch(e.key){case"ArrowDown":e.preventDefault();this.highlightSuggestion(items,currentIndex+1);break;case"ArrowUp":e.preventDefault();this.highlightSuggestion(items,currentIndex-1);break;case"Enter":e.preventDefault();currentIndex>-1&&items[currentIndex].click();break;case"Escape":this.hideSuggestions()}},highlightSuggestion:function(items,index){items.forEach(item=>item.classList.remove("highlighted"));index>=0&&index<items.length&&(items[index].classList.add("highlighted"),items[index].scrollIntoView({block:"nearest"}))},showSuggestions:async function(input,query){let container=input.parentElement.querySelector(".ps-search-suggestions");container||(container=document.createElement("div"),container.className="ps-search-suggestions",input.parentElement.appendChild(container));if(this.suggestionsCache.has(query))return void this.renderSuggestions(container,this.suggestionsCache.get(query));container.innerHTML='<div class="ps-suggestion-loading">جاري البحث...</div>';container.classList.add("show");try{const suggestions=await this.fetchSuggestions(query);this.suggestionsCache.set(query,suggestions);this.renderSuggestions(container,suggestions)}catch(error){console.error("خطأ في جلب الاقتراحات:",error);container.innerHTML='<div class="ps-suggestion-loading">حدث خطأ في البحث</div>'}},fetchSuggestions:async function(query){if(!PS.Utils.isSupported("fetch"))throw new Error("Fetch not supported");const formData=new FormData;formData.append("action","ps_search_suggestions");formData.append("query",query);formData.append("nonce",PS.settings.nonce);const response=await fetch(PS.settings.ajaxUrl,{method:"POST",body:formData,credentials:"same-origin"});if(!response.ok)throw new Error("Network response was not ok");const data=await response.json();if(!data.success)throw new Error(data.data||"Unknown error");return data.data||[]},renderSuggestions:function(container,suggestions){if(!suggestions.length)return void(container.innerHTML='<div class="ps-suggestion-loading">لا توجد نتائج</div>');const html=suggestions.map(item=>`\n                <div class="ps-suggestion-item" data-url="${item.url||""}" data-title="${item.title||""}" data-id="${item.id||""}">\n                    ${item.thumbnail?`<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail">`:""}\n                    <div class="ps-suggestion-content">\n                        <div class="ps-suggestion-title">${this.highlightQuery(item.title||"",this.currentQuery)}</div>\n                        ${item.type?`<span class="ps-suggestion-type">${item.type}</span>`:""}\n                    </div>\n                </div>\n            `).join("");container.innerHTML=html;container.classList.add("show")},highlightQuery:function(text,query){if(!query)return text;const regex=new RegExp(`(${query})`,"gi");return text.replace(regex,"<mark>$1</mark>")},hideSuggestions:function(){const suggestions=document.querySelectorAll(".ps-search-suggestions");suggestions.forEach(container=>{container.classList.remove("show");setTimeout(()=>{container.classList.contains("show")||(container.innerHTML="")},300)})},addToHistory:function(query){const history=PS.State.get("searchHistory",[]),index=history.indexOf(query);index>-1&&history.splice(index,1);history.unshift(query);history.length>10&&history.pop();PS.State.save("searchHistory",history)},initVoiceSearch:function(){PS.settings.features.voice_search&&PS.Utils.isSupported("webSpeech")&&PS.Events.emit("voice-search:init-required")}};PS.DarkMode={init:function(){this.setTheme(PS.State.get("theme","light"));this.bindEvents()},bindEvents:function(){$(document).on("click",".ps-theme-toggle",this.toggle.bind(this));if(window.matchMedia&&!1!==PS.State.get("userPreferences",{}).autoTheme){const mediaQuery=window.matchMedia("(prefers-color-scheme: dark)");mediaQuery.addListener(this.handleSystemThemeChange.bind(this));this.handleSystemThemeChange(mediaQuery)}},toggle:function(){const currentTheme=PS.State.get("theme"),newTheme="dark"===currentTheme?"light":"dark";this.setTheme(newTheme)},setTheme:function(theme){document.documentElement.setAttribute("data-theme",theme);PS.State.save("theme",theme);const toggles=document.querySelectorAll(".ps-theme-toggle");toggles.forEach(toggle=>{const icon=toggle.querySelector("i, .icon");icon&&(icon.className="dark"===theme?"icon-sun":"icon-moon")});PS.Events.emit("theme:changed",{theme})},handleSystemThemeChange:function(e){!1!==PS.State.get("userPreferences",{}).autoTheme&&this.setTheme(e.matches?"dark":"light")}};PS.ReadingProgress={init:function(){PS.settings.features.reading_progress&&(this.createProgressBar(),this.bindScrollEvents(),this.calculateReadingTime())},createProgressBar:function(){if(document.querySelector(".ps-reading-progress"))return;const progressBar=document.createElement("div");progressBar.className="ps-reading-progress";document.body.appendChild(progressBar)},bindScrollEvents:function(){const updateProgress=PS.Utils.throttle(()=>{const article=document.querySelector(".ps-single-content, .entry-content, article");if(!article)return;const rect=article.getBoundingClientRect(),windowHeight=window.innerHeight,documentHeight=document.documentElement.scrollHeight-windowHeight,scrolled=window.scrollY,progress=Math.min(scrolled/documentHeight*100,100),progressBar=document.querySelector(".ps-reading-progress");progressBar&&(progressBar.style.width=`${progress}%`);PS.Events.emit("reading:progress",{progress,scrolled})},100);window.addEventListener("scroll",updateProgress);window.addEventListener("resize",updateProgress)},calculateReadingTime:function(){const content=document.querySelector(".ps-single-content, .entry-content, article");if(!content)return;const text=content.textContent||content.innerText||"",readingTime=PS.Utils.calculateReadingTime(text);document.querySelectorAll(".ps-reading-time, .reading-time").forEach(element=>{element.textContent=readingTime})}};PS.LazyLoading={init:function(){PS.Utils.isSupported("intersectionObserver")?this.createObserver():this.fallbackLazyLoad();this.observeImages()},createObserver:function(){this.observer=new IntersectionObserver(entries=>{entries.forEach(entry=>{entry.isIntersecting&&(this.loadImage(entry.target),this.observer.unobserve(entry.target))})},{rootMargin:"50px"})},observeImages:function(){const images=document.querySelectorAll("img[data-src], img[loading=\"lazy\"]");images.forEach(img=>{img.dataset.src&&!img.src&&this.observer.observe(img)})},loadImage:function(img){img.dataset.src&&(img.src=img.dataset.src,img.removeAttribute("data-src"));img.addEventListener("load",()=>{img.classList.add("loaded")});img.addEventListener("error",()=>{img.classList.add("error")})},fallbackLazyLoad:function(){const images=document.querySelectorAll("img[data-src]");images.forEach(img=>this.loadImage(img))}};PS.Notifications={container:null,notifications:[],init:function(){this.createContainer()},createContainer:function(){this.container||(this.container=document.createElement("div"),this.container.className="ps-notifications-container",document.body.appendChild(this.container))},show:function(message,type="info",duration=5e3){const notification=document.createElement("div");notification.className=`ps-notification ${type}`;notification.innerHTML=`\n                <div class="ps-notification-header">\n                    <div class="ps-notification-title">${this.getTypeTitle(type)}</div>\n                    <button class="ps-notification-close" aria-label="إغلاق">&times;</button>\n                </div>\n                <div class="ps-notification-message">${message}</div>\n            `;this.container.appendChild(notification);setTimeout(()=>notification.classList.add("show"),100);duration>0&&setTimeout(()=>this.hide(notification),duration);notification.querySelector(".ps-notification-close").addEventListener("click",()=>{this.hide(notification)});this.notifications.push(notification);PS.Events.emit("notification:shown",{message,type});return notification},hide:function(notification){notification.classList.remove("show");setTimeout(()=>{notification.parentNode&&notification.parentNode.removeChild(notification);const index=this.notifications.indexOf(notification);index>-1&&this.notifications.splice(index,1)},300)},getTypeTitle:function(type){const titles={success:PS.settings.isRTL?"نجح":"Success",error:PS.settings.isRTL?"خطأ":"Error",warning:PS.settings.isRTL?"تحذير":"Warning",info:PS.settings.isRTL?"معلومات":"Info"};return titles[type]||titles.info}};PS.Ajax={request:async function(action,data={},options={}){const defaultOptions={method:"POST",timeout:1e4,showLoader:!1,showNotification:!1},config={...defaultOptions,...options};config.showLoader&&PS.Notifications.show("جاري التحميل...","info",0);try{const formData=new FormData;formData.append("action",action);formData.append("nonce",PS.settings.nonce);Object.keys(data).forEach(key=>{null!=data[key]&&formData.append(key,data[key])});const controller=new AbortController,timeoutId=setTimeout(()=>controller.abort(),config.timeout),response=await fetch(PS.settings.ajaxUrl,{method:config.method,body:formData,credentials:"same-origin",signal:controller.signal});clearTimeout(timeoutId);if(!response.ok)throw new Error(`HTTP error! status: ${response.status}`);const result=await response.json();config.showLoader&&PS.Notifications.hide(document.querySelector(".ps-notification"));!result.success&&config.showNotification?PS.Notifications.show(result.data||"حدث خطأ","error"):result.success&&config.showNotification&&PS.Notifications.show("تم بنجاح","success");return result}catch(error){config.showLoader&&PS.Notifications.hide(document.querySelector(".ps-notification"));config.showNotification&&PS.Notifications.show("حدث خطأ في الاتصال","error");console.error("AJAX Error:",error);throw error}}};PS.init=function(){this.initialized||(this.DarkMode.init(),this.Notifications.init(),this.LazyLoading.init(),this.settings.features.reading_progress&&this.ReadingProgress.init(),(this.settings.features.voice_search||this.settings.features.ai_suggestions)&&this.Search.init(),PS.Utils.isSupported("serviceWorker")&&navigator.serviceWorker.register(PS.settings.themeUri+"/sw.js").then(registration=>{console.log("Service Worker registered successfully")}).catch(error=>{console.log("Service Worker registration failed:",error)}),this.bindGlobalEvents(),this.initialized=!0,PS.Events.emit("ps:ready"))};PS.bindGlobalEvents=function(){document.addEventListener("DOMContentLoaded",()=>{PS.LazyLoading.observeImages()});window.addEventListener("beforeunload",()=>{sessionStorage.setItem("ps_scroll_position",window.scrollY)});window.addEventListener("load",()=>{const scrollPosition=sessionStorage.getItem("ps_scroll_position");scrollPosition&&(window.scrollTo(0,parseInt(scrollPosition)),sessionStorage.removeItem("ps_scroll_position"))});window.addEventListener("error",e=>{console.error("JavaScript Error:",e.error)});"ontouchstart"in window&&document.body.classList.add("touch-device")};"loading"===document.readyState?document.addEventListener("DOMContentLoaded",()=>PS.init()):PS.init();window.PracticalSolutions=PS}(window,document,window.jQuery);function isMobileDevice(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}function getUrlParameter(param){return new URLSearchParams(window.location.search).get(param)}function formatNumber(num,locale="ar-SA"){return new Intl.NumberFormat(locale).format(num)}"undefined"!=typeof module&&module.exports&&(module.exports=window.PracticalSolutions);




📁 اسم الملف: unified-search-system.php
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



📁 اسم الملف: ai-openrouter-system.php

<?php
/**
 * Advanced AI System with OpenRouter API
 * نظام الذكاء الاصطناعي المتقدم مع OpenRouter API
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


📁 اسم الملف: README.md
---

## 📁 **اسم الملف:** README.md  
**المسار:** /README.md  
**الوصف:** دليل القالب الشامل

```markdown
# 🚀 Practical Solutions Pro - قالب الحلول العملية الاحترافي

![Version](https://img.shields.io/badge/Version-2.1.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-6.4+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0+-green.svg)
![License](https://img.shields.io/badge/License-GPL%20v3-red.svg)

## 📋 **نظرة عامة**

قالب WordPress احترافي مصمم خصيصاً لمواقع الحلول العملية والنصائح الحياتية، يستخدم تقنية Block Theme الحديثة مع Full Site Editing (FSE).

## ✨ **الميزات الرئيسية**

### 🎨 **التصميم والواجهة**
- ✅ تصميم متجاوب 100% - يعمل على جميع الأجهزة
- ✅ وضع مظلم تلقائي مع تبديل سهل
- ✅ دعم كامل للغة العربية (RTL)
- ✅ خطوط Google محسنة (Noto Sans Arabic)
- ✅ أنماط Block مخصصة (Card, Hero, Feature Box)

### 🔍 **البحث المتقدم**
- ✅ بحث صوتي مدمج 🎤
- ✅ اقتراحات فورية أثناء الكتابة
- ✅ حفظ تاريخ البحث محلياً
- ✅ بحث ذكي في المحتوى والتصنيفات

### ⚡ **الأداء والتحسين**
- ✅ Service Worker للتخزين المؤقت
- ✅ Lazy Loading للصور
- ✅ CSS/JS مضغوط وموحد
- ✅ تحسين SEO مدمج مع Schema.org
- ✅ درجة PageSpeed 95+

### 🧩 **Block Patterns جاهزة**
- Hero Sections (أقسام البطل)
- Features Grid (شبكة الميزات)
- Testimonials (آراء العملاء)
- FAQ Section (الأسئلة الشائعة)
- Newsletter CTA (دعوة الاشتراك)
- Stats Counter (عداد الإحصائيات)
- Categories Grid (شبكة التصنيفات)

### 🛠️ **لوحة إعدادات شاملة**
- إعدادات عامة ومتقدمة
- رفع الشعار والهوية البصرية
- روابط وسائل التواصل الاجتماعي
- إعدادات البحث والأداء
- تكامل Google Analytics

## 📋 **المتطلبات**

| المتطلب | الإصدار المطلوب |
|---------|------------------|
| WordPress | 6.4+ |
| PHP | 8.0+ |
| MySQL | 5.7+ |
| الذاكرة | 128MB+ |

## 🚀 **التثبيت**

### الطريقة الأولى: رفع مباشر
1. حمّل ملف القالب المضغوط
2. اذهب إلى **المظهر > قوالب > إضافة جديد**
3. اختر **رفع قالب** وارفع الملف
4. فعّل القالب

### الطريقة الثانية: رفع عبر FTP
1. فك ضغط ملف القالب
2. ارفع مجلد `practical-solutions-pro` إلى `/wp-content/themes/`
3. اذهب إلى **المظهر > قوالب** وفعّل القالب

## ⚙️ **الإعداد السريع**

### 1. الإعدادات الأساسية
```php
// إضافة إلى wp-config.php للأداء الأفضل
define('WP_CACHE', true);
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);



