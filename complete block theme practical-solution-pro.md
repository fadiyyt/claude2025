# 🚀 قالب Block Theme محسّن - إصدار احترافي

الهيكل :
practical-solutions-pro/
├── style.css
├── theme.json ← موحد ومحسن
├── functions.php ← منظف من التعارضات
├── screenshot.png
├── README.md ← دليل شامل
├── LICENSE
├── manifest.json ← PWA support
├── sw.js ← Service Worker
├── .gitignore
├── templates/ ← جميع القوالب مكتملة
│   ├── index.html ← تم إضافته
│   ├── front-page.html ← جديد
│   ├── home.html ← جديد
│   ├── single.html
│   ├── page.html
│   ├── archive.html
│   ├── search.html
│   ├── 404.html
│   ├── author.html ← جديد
│   ├── category.html ← جديد
│   └── tag.html ← جديد
├── parts/
│   ├── header.html
│   ├── footer.html
│   └── sidebar.html
├── assets/
│   ├── css/
│   │   └── unified.css ← جميع الأنماط موحدة
│   │   └── enhanced-ux.css
│   │   └── rtl.css
│   ├── admin/
│   │   └── admin-styles.css
│   │   └── admin-scripts.js
│   ├── js/
│   │   └── enhanced-voice-search.js
│   │   └── interactive-features.js
│   │   └── unified.min.js
│   │   └── unified.js ← جميع الوظائف موحدة
│   ├── images/
│   └── fonts/
├── inc/
│   ├── theme-settings.php
│   ├── customizer-settings.php
│   ├── ai-search-suggestions.php
│   ├── rating-system.php
│   ├── ai-openrouter-system.php
│   ├── advanced-analytics.php
│   ├── theme-admin-panel.php
│   ├── 
│   ├── 
│   └── block-patterns.php ← منظم
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
 * Practical Solutions Pro - Enhanced Functions (Updated)
 * قالب الحلول العملية الاحترافي - الوظائف المحسنة مع الميزات الجديدة
 * المكان: /functions.php
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تعريف ثوابت القالب المحدثة
define('PS_THEME_VERSION', '2.2.0');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());

/**
 * ==== إعدادات القالب الأساسية المحدثة ====
 */
function practical_solutions_setup() {
    // دعم ميزات WordPress الحديثة
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 
        'gallery', 'caption', 'style', 'script'
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // دعم Block Theme المتقدم
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    add_theme_support('custom-line-height');
    add_theme_support('custom-spacing');
    add_theme_support('link-color');
    add_theme_support('appearance-tools');
    
    // أحجام الصور المحسنة
    add_image_size('ps-thumbnail', 400, 300, true);
    add_image_size('ps-medium', 800, 600, true);
    add_image_size('ps-large', 1200, 800, true);
    add_image_size('ps-hero', 1600, 900, true);
    add_image_size('ps-card', 350, 250, true);
    
    // دعم الترجمة
    load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');
    
    // أنماط المحرر المحدثة
    add_editor_style(array(
        'assets/css/unified.css',
        'assets/css/enhanced-ux.css',
        'assets/css/rtl.css',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
    ));
    
    // إضافة دعم Logo مخصص
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // إضافة قوائم التنقل
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'practical-solutions'),
        'footer'  => __('قائمة التذييل', 'practical-solutions'),
        'social'  => __('وسائل التواصل الاجتماعي', 'practical-solutions'),
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * ==== تحميل الأصول المحسنة مع الميزات الجديدة ====
 */
function practical_solutions_enqueue_assets() {
    // CSS الموحد الأساسي
    wp_enqueue_style(
        'ps-unified-styles',
        PS_THEME_URI . '/assets/css/unified.css',
        array(),
        PS_THEME_VERSION
    );
    
    // CSS تحسينات تجربة المستخدم
    wp_enqueue_style(
        'ps-enhanced-ux',
        PS_THEME_URI . '/assets/css/enhanced-ux.css',
        array('ps-unified-styles'),
        PS_THEME_VERSION
    );
    
    // دعم RTL المحسن
    if (is_rtl()) {
        wp_enqueue_style(
            'ps-rtl-styles',
            PS_THEME_URI . '/assets/css/rtl.css',
            array('ps-enhanced-ux'),
            PS_THEME_VERSION
        );
    }
    
    // JavaScript الموحد الأساسي
    wp_enqueue_script(
        'ps-unified-script',
        PS_THEME_URI . '/assets/js/unified.js',
        array('jquery'),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // البحث الصوتي المحسن (حسب الإعدادات)
    $general_settings = get_option('ps_general_settings', array());
    if ($general_settings['voice_search'] ?? true) {
        wp_enqueue_script(
            'ps-enhanced-voice',
            PS_THEME_URI . '/assets/js/enhanced-voice-search.js',
            array('ps-unified-script'),
            PS_THEME_VERSION,
            array('strategy' => 'defer', 'in_footer' => true)
        );
    }
    
    // الميزات التفاعلية (حسب الإعدادات)
    if ($general_settings['bookmarks'] ?? true || $general_settings['rating_system'] ?? true) {
        wp_enqueue_script(
            'ps-interactive-features',
            PS_THEME_URI . '/assets/js/interactive-features.js',
            array('ps-unified-script'),
            PS_THEME_VERSION,
            array('strategy' => 'defer', 'in_footer' => true)
        );
    }
    
    // إعدادات JavaScript المحدثة والموسعة
    wp_localize_script('ps-unified-script', 'psSettings', array(
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
        'userId' => get_current_user_id(),
        'postId' => get_the_ID(),
        'features' => array(
            'voice_search' => $general_settings['voice_search'] ?? true,
            'bookmarks' => $general_settings['bookmarks'] ?? true,
            'share_tracking' => true,
            'reading_progress' => $general_settings['reading_progress'] ?? true,
            'ai_suggestions' => get_option('ps_ai_settings', array())['enabled'] ?? false,
            'analytics' => get_option('ps_analytics_settings', array())['enabled'] ?? true,
            'rating_system' => $general_settings['rating_system'] ?? true,
            'auto_dark_mode' => $general_settings['auto_dark_mode'] ?? false
        ),
        'strings' => array(
            'bookmarkAdded' => __('تم إضافة للمفضلة', 'practical-solutions'),
            'bookmarkRemoved' => __('تم إزالة من المفضلة', 'practical-solutions'),
            'ratingSubmitted' => __('تم إرسال التقييم', 'practical-solutions'),
            'shareSuccess' => __('تم نسخ الرابط', 'practical-solutions'),
            'voiceNotSupported' => __('البحث الصوتي غير مدعوم في هذا المتصفح', 'practical-solutions'),
            'voiceNoPermission' => __('لم يتم منح إذن الميكروفون', 'practical-solutions')
        )
    ));
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_assets');

/**
 * ==== تحميل الملفات المساعدة الجديدة والمحسنة ====
 */
function practical_solutions_load_includes() {
    $includes = array(
        // الملفات الأساسية
        'inc/theme-settings.php',
        'inc/customizer-settings.php',
        'inc/block-patterns.php',
        
        // الملفات الجديدة المضافة
        'inc/theme-admin-panel.php',
        'inc/ai-openrouter-system.php',
        'inc/advanced-analytics.php',
        'inc/rating-system.php',
        
        // ملفات إضافية محسنة
        'inc/theme-customizer-enhancements.php',
        'inc/search-enhancements.php',
        'inc/performance-optimizations.php'
    );
    
    foreach ($includes as $file) {
        $file_path = PS_THEME_DIR . '/' . $file;
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}
add_action('after_setup_theme', 'practical_solutions_load_includes', 5);

/**
 * ==== تسجيل Block Styles المخصصة المحدثة ====
 */
function practical_solutions_register_block_styles() {
    // أنماط للمجموعات
    register_block_style('core/group', array(
        'name' => 'ps-card-style',
        'label' => __('بطاقة', 'practical-solutions')
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-hero-section',
        'label' => __('قسم البطل', 'practical-solutions')
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-feature-box',
        'label' => __('صندوق ميزة', 'practical-solutions')
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-rating-container',
        'label' => __('حاوية التقييم', 'practical-solutions')
    ));
    
    register_block_style('core/group', array(
        'name' => 'ps-search-suggestions',
        'label' => __('اقتراحات البحث', 'practical-solutions')
    ));
    
    // أنماط للأزرار
    register_block_style('core/button', array(
        'name' => 'ps-primary-button',
        'label' => __('زر أساسي', 'practical-solutions')
    ));
    
    register_block_style('core/button', array(
        'name' => 'ps-outline-button',
        'label' => __('زر مخطط', 'practical-solutions')
    ));
    
    register_block_style('core/button', array(
        'name' => 'ps-bookmark-button',
        'label' => __('زر حفظ', 'practical-solutions')
    ));
    
    register_block_style('core/button', array(
        'name' => 'ps-voice-search-button',
        'label' => __('زر البحث الصوتي', 'practical-solutions')
    ));
    
    // أنماط للعناوين
    register_block_style('core/heading', array(
        'name' => 'ps-section-title',
        'label' => __('عنوان القسم', 'practical-solutions')
    ));
    
    register_block_style('core/heading', array(
        'name' => 'ps-hero-title',
        'label' => __('عنوان البطل', 'practical-solutions')
    ));
    
    // أنماط للصور
    register_block_style('core/image', array(
        'name' => 'ps-rounded-image',
        'label' => __('صورة مدورة', 'practical-solutions')
    ));
    
    register_block_style('core/image', array(
        'name' => 'ps-zoomable-image',
        'label' => __('صورة قابلة للتكبير', 'practical-solutions')
    ));
    
    register_block_style('core/image', array(
        'name' => 'ps-lazy-image',
        'label' => __('صورة محملة تدريجياً', 'practical-solutions')
    ));
}
add_action('init', 'practical_solutions_register_block_styles');

/**
 * ==== AJAX للبحث المحسن والميزات الجديدة ====
 */
function practical_solutions_ajax_search() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(__('غير مصرح', 'practical-solutions'));
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = sanitize_text_field($_POST['search_type']) ?? 'regular';
    $user_behavior = json_decode(stripslashes($_POST['user_behavior'] ?? '{}'), true);
    
    if (empty($search_term)) {
        wp_send_json_error(__('مصطلح البحث مطلوب', 'practical-solutions'));
    }
    
    $results = array();
    
    try {
        // البحث العادي المحسن
        $local_results = practical_solutions_get_local_search_results($search_term);
        
        // اقتراحات الذكاء الاصطناعي (إذا كان مفعلاً)
        $ai_settings = get_option('ps_ai_settings', array());
        if ($ai_settings['enabled'] && $ai_settings['search_suggestions'] && class_exists('PS_AI_OpenRouter_System')) {
            $ai_system = new PS_AI_OpenRouter_System();
            $ai_results = $ai_system->get_ai_search_suggestions($search_term, 'general', $user_behavior);
            $results = array_merge($results, $ai_results);
        }
        
        // دمج النتائج المحلية
        $results = array_merge($results, $local_results);
        
        // ترتيب النتائج حسب الصلة
        usort($results, function($a, $b) {
            $relevance_a = $a['relevance'] ?? 0;
            $relevance_b = $b['relevance'] ?? 0;
            return $relevance_b <=> $relevance_a;
        });
        
        // تحديد النتائج إلى الحد الأقصى
        $max_results = $ai_settings['suggestions_count'] ?? 8;
        $results = array_slice($results, 0, $max_results);
        
        // تتبع البحث (إذا كان مفعلاً)
        if (get_option('ps_analytics_settings', array())['track_search_analytics'] ?? true) {
            practical_solutions_track_search($search_term, $search_type, count($results));
        }
        
        wp_send_json_success($results);
        
    } catch (Exception $e) {
        error_log('Search Error: ' . $e->getMessage());
        wp_send_json_error(__('حدث خطأ في البحث', 'practical-solutions'));
    }
}
add_action('wp_ajax_ps_search_enhanced', 'practical_solutions_ajax_search');
add_action('wp_ajax_nopriv_ps_search_enhanced', 'practical_solutions_ajax_search');

/**
 * ==== النتائج المحلية المحسنة ====
 */
function practical_solutions_get_local_search_results($search_term) {
    global $wpdb;
    
    $posts = $wpdb->get_results($wpdb->prepare("
        SELECT post_title, post_excerpt, ID, post_date
        FROM {$wpdb->posts} 
        WHERE post_status = 'publish' 
        AND post_type = 'post'
        AND (post_title LIKE %s OR post_content LIKE %s OR post_excerpt LIKE %s)
        ORDER BY 
            CASE 
                WHEN post_title LIKE %s THEN 1
                WHEN post_title LIKE %s THEN 2
                WHEN post_excerpt LIKE %s THEN 3
                ELSE 4
            END,
            post_date DESC
        LIMIT 6
    ", 
        '%' . $search_term . '%',
        '%' . $search_term . '%',
        '%' . $search_term . '%',
        $search_term . '%',
        '%' . $search_term . '%',
        '%' . $search_term . '%'
    ));
    
    $results = array();
    foreach ($posts as $post) {
        $relevance = practical_solutions_calculate_relevance($post->post_title, $search_term);
        
        $results[] = array(
            'title' => $post->post_title,
            'excerpt' => wp_trim_words($post->post_excerpt ?: $post->post_title, 15),
            'url' => get_permalink($post->ID),
            'thumbnail' => get_the_post_thumbnail_url($post->ID, 'ps-thumbnail'),
            'type' => 'post',
            'source' => 'local_search',
            'relevance' => $relevance,
            'date' => $post->post_date
        );
    }
    
    return $results;
}

/**
 * ==== حساب مدى الصلة المحسن ====
 */
function practical_solutions_calculate_relevance($title, $query) {
    $title_words = array_filter(explode(' ', strtolower($title)));
    $query_words = array_filter(explode(' ', strtolower($query)));
    
    if (empty($title_words) || empty($query_words)) {
        return 0;
    }
    
    $common_words = array_intersect($title_words, $query_words);
    $relevance = count($common_words) / max(count($query_words), 1);
    
    // زيادة النقاط إذا كان الاستعلام موجود في بداية العنوان
    if (stripos($title, $query) === 0) {
        $relevance += 0.3;
    } elseif (stripos($title, $query) !== false) {
        $relevance += 0.2;
    }
    
    return min(round($relevance * 100), 100);
}

/**
 * ==== تتبع البحث المحسن ====
 */
function practical_solutions_track_search($query, $type, $results_count) {
    if (!class_exists('PS_Advanced_Analytics')) {
        return;
    }
    
    $analytics = new PS_Advanced_Analytics();
    $search_data = array(
        'search_query' => $query,
        'search_type' => $type,
        'results_count' => $results_count,
        'user_id' => get_current_user_id() ?: null,
        'session_id' => $_COOKIE['ps_session_id'] ?? wp_generate_uuid4(),
        'search_success' => $results_count > 0,
        'device_type' => wp_is_mobile() ? 'mobile' : 'desktop'
    );
    
    $analytics->save_search_activity($search_data);
}

/**
 * ==== AJAX لإدارة المفضلة ====
 */
function practical_solutions_ajax_bookmark() {
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(__('غير مصرح', 'practical-solutions'));
    }
    
    $post_id = intval($_POST['post_id']);
    $action = sanitize_text_field($_POST['bookmark_action']); // 'add' أو 'remove'
    
    if (!$post_id) {
        wp_send_json_error(__('معرف المقال مطلوب', 'practical-solutions'));
    }
    
    $user_bookmarks = get_user_meta(get_current_user_id(), 'ps_bookmarks', true) ?: array();
    
    if ($action === 'add') {
        if (!in_array($post_id, $user_bookmarks)) {
            $user_bookmarks[] = $post_id;
            update_user_meta(get_current_user_id(), 'ps_bookmarks', $user_bookmarks);
            
            // تحديث عداد المفضلة للمقال
            $bookmark_count = get_post_meta($post_id, '_ps_bookmark_count', true) ?: 0;
            update_post_meta($post_id, '_ps_bookmark_count', $bookmark_count + 1);
            
            wp_send_json_success(array(
                'message' => __('تم إضافة المقال للمفضلة', 'practical-solutions'),
                'action' => 'added',
                'count' => $bookmark_count + 1
            ));
        }
    } elseif ($action === 'remove') {
        $key = array_search($post_id, $user_bookmarks);
        if ($key !== false) {
            unset($user_bookmarks[$key]);
            update_user_meta(get_current_user_id(), 'ps_bookmarks', array_values($user_bookmarks));
            
            // تحديث عداد المفضلة للمقال
            $bookmark_count = get_post_meta($post_id, '_ps_bookmark_count', true) ?: 0;
            update_post_meta($post_id, '_ps_bookmark_count', max(0, $bookmark_count - 1));
            
            wp_send_json_success(array(
                'message' => __('تم إزالة المقال من المفضلة', 'practical-solutions'),
                'action' => 'removed',
                'count' => max(0, $bookmark_count - 1)
            ));
        }
    }
    
    wp_send_json_error(__('إجراء غير صحيح', 'practical-solutions'));
}
add_action('wp_ajax_ps_bookmark_post', 'practical_solutions_ajax_bookmark');
add_action('wp_ajax_nopriv_ps_bookmark_post', 'practical_solutions_ajax_bookmark');

/**
 * ==== إضافة أنماط إضافية للمحرر ====
 */
function practical_solutions_add_editor_styles() {
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('أساسي', 'practical-solutions'),
            'slug'  => 'primary',
            'color' => '#007cba',
        ),
        array(
            'name'  => __('ثانوي', 'practical-solutions'),
            'slug'  => 'secondary',
            'color' => '#f0f4f8',
        ),
        array(
            'name'  => __('نجاح', 'practical-solutions'),
            'slug'  => 'success',
            'color' => '#10b981',
        ),
        array(
            'name'  => __('تحذير', 'practical-solutions'),
            'slug'  => 'warning',
            'color' => '#f59e0b',
        ),
        array(
            'name'  => __('خطر', 'practical-solutions'),
            'slug'  => 'danger',
            'color' => '#e74c3c',
        ),
    ));
    
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('صغير', 'practical-solutions'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('عادي', 'practical-solutions'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => __('متوسط', 'practical-solutions'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => __('كبير', 'practical-solutions'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => __('كبير جداً', 'practical-solutions'),
            'size' => 32,
            'slug' => 'extra-large'
        ),
    ));
}
add_action('after_setup_theme', 'practical_solutions_add_editor_styles');

/**
 * ==== تحسينات الأداء ====
 */
function practical_solutions_performance_optimizations() {
    // إزالة أنماط WordPress غير المستخدمة
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('classic-theme-styles');
        
        // تأخير تحميل الخطوط
        add_filter('style_loader_tag', function($html, $handle) {
            if ($handle === 'ps-unified-styles') {
                $html = str_replace('rel=\'stylesheet\'', 'rel=\'preload\' as=\'style\' onload=\'this.onload=null;this.rel="stylesheet"\'', $html);
                $html .= '<noscript><link rel="stylesheet" href="' . PS_THEME_URI . '/assets/css/unified.css"></noscript>';
            }
            return $html;
        }, 10, 2);
    }
    
    // ضغط وتنظيف HTML
    if (!is_admin()) {
        ob_start('practical_solutions_compress_html');
    }
}
add_action('init', 'practical_solutions_performance_optimizations');

/**
 * ==== ضغط HTML ====
 */
function practical_solutions_compress_html($html) {
    $html = preg_replace('/<!--(.|\s)*?-->/', '', $html);
    $html = preg_replace('/\s+/', ' ', $html);
    return trim($html);
}

/**
 * ==== إضافة Schema.org للمحتوى ====
 */
function practical_solutions_add_schema() {
    if (is_single()) {
        $post = get_post();
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 25),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author()
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_site_icon_url()
                )
            ),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'url' => get_permalink(),
            'mainEntityOfPage' => get_permalink()
        );
        
        if (has_post_thumbnail()) {
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => get_the_post_thumbnail_url($post, 'full'),
                'width' => 1200,
                'height' => 800
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
add_action('wp_head', 'practical_solutions_add_schema');

/**
 * ==== تحسينات الأمان ====
 */
function practical_solutions_security_enhancements() {
    // إزالة معلومات WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // تأمين wp-config.php
    if (!defined('DISALLOW_FILE_EDIT')) {
        define('DISALLOW_FILE_EDIT', true);
    }
    
    // منع تصفح المجلدات
    add_action('init', function() {
        if (!file_exists(ABSPATH . '.htaccess')) {
            $htaccess_content = "Options -Indexes\n";
            $htaccess_content .= "RewriteEngine On\n";
            $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
            $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
            $htaccess_content .= "RewriteRule . /index.php [L]\n";
            
            file_put_contents(ABSPATH . '.htaccess', $htaccess_content);
        }
    });
}
add_action('init', 'practical_solutions_security_enhancements');

/**
 * ==== Widgets المخصصة ====
 */
function practical_solutions_register_widgets() {
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'practical-solutions'),
        'id'            => 'primary-sidebar',
        'description'   => __('الشريط الجانبي الذي يظهر في المقالات والصفحات', 'practical-solutions'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('تذييل القسم 1', 'practical-solutions'),
        'id'            => 'footer-1',
        'description'   => __('القسم الأول من تذييل الموقع', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('تذييل القسم 2', 'practical-solutions'),
        'id'            => 'footer-2',
        'description'   => __('القسم الثاني من تذييل الموقع', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('تذييل القسم 3', 'practical-solutions'),
        'id'            => 'footer-3',
        'description'   => __('القسم الثالث من تذييل الموقع', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'practical_solutions_register_widgets');

/**
 * ==== Shortcodes مخصصة ====
 */

// Shortcode للبحث المحسن
function practical_solutions_search_shortcode($atts) {
    $atts = shortcode_atts(array(
        'placeholder' => __('ابحث عن الحلول...', 'practical-solutions'),
        'class' => 'ps-search-form',
        'voice' => 'true'
    ), $atts);
    
    $voice_button = '';
    if ($atts['voice'] === 'true' && (get_option('ps_general_settings', array())['voice_search'] ?? true)) {
        $voice_button = '<button type="button" class="ps-voice-search-btn" aria-label="' . __('بحث صوتي', 'practical-solutions') . '">🎤</button>';
    }
    
    return sprintf(
        '<form class="%s" role="search" method="get" action="%s">
            <div class="ps-search-container">
                <input type="search" class="ps-search-input" name="s" placeholder="%s" value="%s" autocomplete="off">
                %s
                <div class="ps-search-suggestions"></div>
            </div>
        </form>',
        esc_attr($atts['class']),
        esc_url(home_url('/')),
        esc_attr($atts['placeholder']),
        esc_attr(get_search_query()),
        $voice_button
    );
}
add_shortcode('ps_search', 'practical_solutions_search_shortcode');

// Shortcode لعرض المقالات الشائعة
function practical_solutions_popular_posts_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 5,
        'show_thumbnail' => 'true',
        'show_date' => 'true',
        'show_excerpt' => 'false'
    ), $atts);
    
    $posts = get_posts(array(
        'numberposts' => intval($atts['count']),
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_status' => 'publish'
    ));
    
    if (empty($posts)) {
        return '<p>' . __('لا توجد مقالات شائعة حالياً', 'practical-solutions') . '</p>';
    }
    
    $output = '<div class="ps-popular-posts">';
    
    foreach ($posts as $post) {
        setup_postdata($post);
        
        $output .= '<article class="ps-popular-post-item">';
        
        if ($atts['show_thumbnail'] === 'true' && has_post_thumbnail($post->ID)) {
            $output .= '<div class="ps-post-thumbnail">';
            $output .= '<a href="' . get_permalink($post->ID) . '">';
            $output .= get_the_post_thumbnail($post->ID, 'ps-thumbnail');
            $output .= '</a>';
            $output .= '</div>';
        }
        
        $output .= '<div class="ps-post-content">';
        $output .= '<h3 class="ps-post-title"><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h3>';
        
        if ($atts['show_date'] === 'true') {
            $output .= '<time class="ps-post-date">' . get_the_date('', $post->ID) . '</time>';
        }
        
        if ($atts['show_excerpt'] === 'true') {
            $output .= '<div class="ps-post-excerpt">' . wp_trim_words(get_the_excerpt($post->ID), 15) . '</div>';
        }
        
        $output .= '</div>';
        $output .= '</article>';
    }
    
    $output .= '</div>';
    
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('ps_popular_posts', 'practical_solutions_popular_posts_shortcode');

/**
 * ==== تسجيل Service Worker ====
 */
function practical_solutions_register_service_worker() {
    echo '<script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function() {
                navigator.serviceWorker.register("' . PS_THEME_URI . '/sw.js")
                    .then(function(registration) {
                        console.log("Service Worker registered successfully");
                    })
                    .catch(function(error) {
                        console.log("Service Worker registration failed:", error);
                    });
            });
        }
    </script>';
}
add_action('wp_footer', 'practical_solutions_register_service_worker');

/**
 * ==== إضافة البيانات الوصفية للـ PWA ====
 */
function practical_solutions_add_pwa_meta() {
    echo '<link rel="manifest" href="' . PS_THEME_URI . '/manifest.json">';
    echo '<meta name="theme-color" content="#007cba">';
    echo '<meta name="apple-mobile-web-app-capable" content="yes">';
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="default">';
    echo '<meta name="apple-mobile-web-app-title" content="' . get_bloginfo('name') . '">';
    
    if (function_exists('get_site_icon_url') && get_site_icon_url()) {
        echo '<link rel="apple-touch-icon" href="' . get_site_icon_url(180) . '">';
    }
}
add_action('wp_head', 'practical_solutions_add_pwa_meta');

/**
 * ==== تشغيل تحليلات الأداء إذا كان مفعلاً ====
 */
if (get_option('ps_analytics_settings', array())['enabled'] ?? true) {
    // تسجيل زيارة الصفحة
    function practical_solutions_track_page_view() {
        if (!is_admin() && !wp_doing_ajax()) {
            $post_id = get_the_ID();
            if ($post_id) {
                $views = get_post_meta($post_id, 'post_views_count', true) ?: 0;
                update_post_meta($post_id, 'post_views_count', $views + 1);
            }
        }
    }
    add_action('wp_head', 'practical_solutions_track_page_view');
}

/**
 * ==== منع تحميل ملفات غير ضرورية على صفحات معينة ====
 */
function practical_solutions_conditional_assets() {
    // عدم تحميل البحث الصوتي في صفحة الإدارة
    if (is_admin()) {
        wp_dequeue_script('ps-enhanced-voice');
    }
    
    // عدم تحميل ميزات تفاعلية في صفحات أرشيف بسيطة
    if (is_archive() && !is_category() && !is_tag()) {
        wp_dequeue_script('ps-interactive-features');
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_conditional_assets', 20);

// تأكد من تحميل الميزات الجديدة عند التفعيل
register_activation_hook(__FILE__, function() {
    // إنشاء جداول التحليلات إذا لم تكن موجودة
    if (class_exists('PS_Advanced_Analytics')) {
        $analytics = new PS_Advanced_Analytics();
        $analytics->create_analytics_tables();
    }
    
    // إعداد الإعدادات الافتراضية
    if (!get_option('ps_general_settings')) {
        update_option('ps_general_settings', array(
            'voice_search' => true,
            'bookmarks' => true,
            'reading_progress' => true,
            'rating_system' => true,
            'auto_dark_mode' => false
        ));
    }
    
    if (!get_option('ps_ai_settings')) {
        update_option('ps_ai_settings', array(
            'enabled' => false,
            'search_suggestions' => true,
            'suggestions_count' => 8,
            'cache_duration' => 3600
        ));
    }
    
    if (!get_option('ps_analytics_settings')) {
        update_option('ps_analytics_settings', array(
            'enabled' => true,
            'track_user_activity' => true,
            'track_search_analytics' => true,
            'track_content_performance' => true,
            'anonymize_ip' => true,
            'data_retention_days' => 365
        ));
    }
    
    // تطبيق قواعد إعادة الكتابة
    flush_rewrite_rules();
});

/**
 * ==== إضافة دعم للتخزين المؤقت المتقدم ====
 */
if (!function_exists('practical_solutions_cache_helper')) {
    function practical_solutions_cache_helper($key, $callback, $expiration = 3600) {
        $cached_value = get_transient($key);
        
        if ($cached_value !== false) {
            return $cached_value;
        }
        
        $value = call_user_func($callback);
        set_transient($key, $value, $expiration);
        
        return $value;
    }
}

// إضافة مساعد للـ debugging
if (defined('WP_DEBUG') && WP_DEBUG) {
    function practical_solutions_debug_log($message, $data = null) {
        if ($data) {
            error_log('PS Theme Debug: ' . $message . ' - ' . print_r($data, true));
        } else {
            error_log('PS Theme Debug: ' . $message);
        }
    }
}

/**
 * ==== تنظيف عند إلغاء التفعيل ====
 */
register_deactivation_hook(__FILE__, function() {
    // إزالة الجدولة
    wp_clear_scheduled_hook('ps_cleanup_analytics');
    
    // تنظيف التخزين المؤقت
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_ps_%' OR option_name LIKE '_transient_timeout_ps_%'");
});

📁 اسم الملف: assets/js/unified.js
/**
 * Unified JavaScript for Practical Solutions Pro
 * الملف الأساسي الموحد للوظائف مع حل التعارضات
 */

(function(window, document, $) {
    'use strict';
    
    // منع التعارضات مع jQuery
    $ = $ || window.jQuery;
    
    // Namespace للقالب لمنع التعارضات
    window.PracticalSolutions = window.PracticalSolutions || {};
    const PS = window.PracticalSolutions;
    
    // إعدادات افتراضية
    PS.settings = window.psSettings || {
        ajaxUrl: '/wp-admin/admin-ajax.php',
        nonce: '',
        homeUrl: '/',
        themeUri: '',
        isRTL: false,
        features: {
            voice_search: true,
            bookmarks: true,
            share_tracking: true,
            reading_progress: true,
            ai_suggestions: false
        }
    };
    
    // متغيرات عامة لمنع التعارضات
    PS.cache = new Map();
    PS.debounceTimers = new Map();
    PS.observers = new Map();
    PS.initialized = false;
    
    /**
     * ==== نظام إدارة الحالة والذاكرة ====
     */
    PS.State = {
        theme: localStorage.getItem('ps_theme') || 'light',
        searchHistory: JSON.parse(localStorage.getItem('ps_search_history') || '[]'),
        bookmarks: new Set(JSON.parse(localStorage.getItem('ps_bookmarks') || '[]')),
        userPreferences: JSON.parse(localStorage.getItem('ps_user_preferences') || '{}'),
        
        // حفظ الحالة
        save: function(key, value) {
            try {
                this[key] = value;
                localStorage.setItem('ps_' + key, typeof value === 'object' ? JSON.stringify(value) : value);
            } catch (e) {
                console.warn('خطأ في حفظ البيانات:', e);
            }
        },
        
        // استرجاع الحالة
        get: function(key, defaultValue = null) {
            try {
                return this[key] !== undefined ? this[key] : defaultValue;
            } catch (e) {
                return defaultValue;
            }
        }
    };
    
    /**
     * ==== نظام المرافق العامة ====
     */
    PS.Utils = {
        // تأخير التنفيذ (Debounce)
        debounce: function(func, delay, key = 'default') {
            return function(...args) {
                const timerId = PS.debounceTimers.get(key);
                if (timerId) clearTimeout(timerId);
                
                PS.debounceTimers.set(key, setTimeout(() => {
                    func.apply(this, args);
                    PS.debounceTimers.delete(key);
                }, delay));
            };
        },
        
        // تقييد التنفيذ (Throttle)
        throttle: function(func, limit) {
            let inThrottle;
            return function(...args) {
                if (!inThrottle) {
                    func.apply(this, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },
        
        // التحقق من دعم الميزات
        isSupported: function(feature) {
            const support = {
                webSpeech: 'webkitSpeechRecognition' in window || 'SpeechRecognition' in window,
                serviceWorker: 'serviceWorker' in navigator,
                intersectionObserver: 'IntersectionObserver' in window,
                localStorage: (() => {
                    try {
                        localStorage.setItem('test', 'test');
                        localStorage.removeItem('test');
                        return true;
                    } catch(e) {
                        return false;
                    }
                })(),
                fetch: 'fetch' in window
            };
            return support[feature] || false;
        },
        
        // تنظيف النصوص
        sanitizeText: function(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },
        
        // تحويل الأرقام للعربية
        toArabicNumbers: function(str) {
            const arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
            return str.replace(/[0-9]/g, function(w) {
                return arabicNumbers[+w];
            });
        },
        
        // تحويل الأرقام للإنجليزية
        toEnglishNumbers: function(str) {
            const englishNumbers = ['0','1','2','3','4','5','6','7','8','9'];
            const arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
            for(let i = 0; i < 10; i++) {
                str = str.replace(new RegExp(arabicNumbers[i], 'g'), englishNumbers[i]);
            }
            return str;
        },
        
        // حساب وقت القراءة
        calculateReadingTime: function(text) {
            const wordsPerMinute = PS.settings.isRTL ? 180 : 200;
            const words = text.split(/\s+/).length;
            const minutes = Math.ceil(words / wordsPerMinute);
            return PS.settings.isRTL ? `${minutes} دقيقة قراءة` : `${minutes} min read`;
        },
        
        // تنسيق التاريخ
        formatDate: function(date, format = 'relative') {
            const now = new Date();
            const diff = now - new Date(date);
            const minutes = Math.floor(diff / 60000);
            const hours = Math.floor(diff / 3600000);
            const days = Math.floor(diff / 86400000);
            
            if (format === 'relative') {
                if (minutes < 1) return PS.settings.isRTL ? 'الآن' : 'now';
                if (minutes < 60) return PS.settings.isRTL ? `منذ ${minutes} دقيقة` : `${minutes}m ago`;
                if (hours < 24) return PS.settings.isRTL ? `منذ ${hours} ساعة` : `${hours}h ago`;
                if (days < 7) return PS.settings.isRTL ? `منذ ${days} يوم` : `${days}d ago`;
            }
            
            return new Date(date).toLocaleDateString(PS.settings.isRTL ? 'ar-SA' : 'en-US');
        }
    };
    
    /**
     * ==== نظام الأحداث المخصص ====
     */
    PS.Events = {
        listeners: new Map(),
        
        // إضافة مستمع
        on: function(event, callback, context = null) {
            if (!this.listeners.has(event)) {
                this.listeners.set(event, []);
            }
            this.listeners.get(event).push({ callback, context });
        },
        
        // إزالة مستمع
        off: function(event, callback = null) {
            if (!this.listeners.has(event)) return;
            
            if (callback) {
                const eventListeners = this.listeners.get(event);
                const index = eventListeners.findIndex(listener => listener.callback === callback);
                if (index > -1) eventListeners.splice(index, 1);
            } else {
                this.listeners.delete(event);
            }
        },
        
        // إطلاق حدث
        emit: function(event, data = null) {
            if (!this.listeners.has(event)) return;
            
            this.listeners.get(event).forEach(listener => {
                try {
                    listener.callback.call(listener.context, data);
                } catch (e) {
                    console.error(`خطأ في معالج الحدث ${event}:`, e);
                }
            });
        }
    };
    
    /**
     * ==== نظام البحث المحسن ====
     */
    PS.Search = {
        initialized: false,
        currentQuery: '',
        suggestionsCache: new Map(),
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.initVoiceSearch();
            this.initialized = true;
            
            PS.Events.emit('search:initialized');
        },
        
        bindEvents: function() {
            // البحث في النماذج
            $(document).on('input', '.ps-search-input, .ps-hero-search-input', 
                PS.Utils.debounce(this.handleSearchInput.bind(this), 300, 'search-input')
            );
            
            // إرسال النماذج
            $(document).on('submit', '.ps-search-form, .ps-hero-search-form', this.handleSearchSubmit.bind(this));
            
            // النقر على الاقتراحات
            $(document).on('click', '.ps-suggestion-item', this.handleSuggestionClick.bind(this));
            
            // إخفاء الاقتراحات عند النقر خارجها
            $(document).on('click', (e) => {
                if (!$(e.target).closest('.ps-search-container').length) {
                    this.hideSuggestions();
                }
            });
            
            // التنقل بالكيبورد في الاقتراحات
            $(document).on('keydown', '.ps-search-input', this.handleKeyboardNavigation.bind(this));
        },
        
        handleSearchInput: function(e) {
            const input = e.target;
            const query = input.value.trim();
            
            if (query.length < 2) {
                this.hideSuggestions();
                return;
            }
            
            this.currentQuery = query;
            this.showSuggestions(input, query);
        },
        
        handleSearchSubmit: function(e) {
            e.preventDefault();
            const form = e.target;
            const input = form.querySelector('.ps-search-input, .ps-hero-search-input');
            const query = input.value.trim();
            
            if (query) {
                this.addToHistory(query);
                this.hideSuggestions();
                window.location.href = `${PS.settings.homeUrl}?s=${encodeURIComponent(query)}`;
            }
        },
        
        handleSuggestionClick: function(e) {
            e.preventDefault();
            const item = e.currentTarget;
            const url = item.dataset.url;
            const title = item.dataset.title;
            
            if (title) this.addToHistory(title);
            if (url) window.location.href = url;
        },
        
        handleKeyboardNavigation: function(e) {
            const suggestions = document.querySelector('.ps-search-suggestions');
            if (!suggestions || !suggestions.classList.contains('show')) return;
            
            const items = suggestions.querySelectorAll('.ps-suggestion-item');
            let currentIndex = Array.from(items).findIndex(item => item.classList.contains('highlighted'));
            
            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    this.highlightSuggestion(items, currentIndex + 1);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    this.highlightSuggestion(items, currentIndex - 1);
                    break;
                case 'Enter':
                    e.preventDefault();
                    if (currentIndex > -1) {
                        items[currentIndex].click();
                    }
                    break;
                case 'Escape':
                    this.hideSuggestions();
                    break;
            }
        },
        
        highlightSuggestion: function(items, index) {
            items.forEach(item => item.classList.remove('highlighted'));
            
            if (index >= 0 && index < items.length) {
                items[index].classList.add('highlighted');
                items[index].scrollIntoView({ block: 'nearest' });
            }
        },
        
        showSuggestions: async function(input, query) {
            let container = input.parentElement.querySelector('.ps-search-suggestions');
            
            if (!container) {
                container = document.createElement('div');
                container.className = 'ps-search-suggestions';
                input.parentElement.appendChild(container);
            }
            
            // البحث في الكاش أولاً
            if (this.suggestionsCache.has(query)) {
                this.renderSuggestions(container, this.suggestionsCache.get(query));
                return;
            }
            
            // إظهار مؤشر التحميل
            container.innerHTML = '<div class="ps-suggestion-loading">جاري البحث...</div>';
            container.classList.add('show');
            
            try {
                const suggestions = await this.fetchSuggestions(query);
                this.suggestionsCache.set(query, suggestions);
                this.renderSuggestions(container, suggestions);
            } catch (error) {
                console.error('خطأ في جلب الاقتراحات:', error);
                container.innerHTML = '<div class="ps-suggestion-loading">حدث خطأ في البحث</div>';
            }
        },
        
        fetchSuggestions: async function(query) {
            if (!PS.Utils.isSupported('fetch')) {
                throw new Error('Fetch not supported');
            }
            
            const formData = new FormData();
            formData.append('action', 'ps_search_suggestions');
            formData.append('query', query);
            formData.append('nonce', PS.settings.nonce);
            
            const response = await fetch(PS.settings.ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.data || 'Unknown error');
            }
            
            return data.data || [];
        },
        
        renderSuggestions: function(container, suggestions) {
            if (!suggestions.length) {
                container.innerHTML = '<div class="ps-suggestion-loading">لا توجد نتائج</div>';
                return;
            }
            
            const html = suggestions.map(item => `
                <div class="ps-suggestion-item" data-url="${item.url || ''}" data-title="${item.title || ''}" data-id="${item.id || ''}">
                    ${item.thumbnail ? `<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail">` : ''}
                    <div class="ps-suggestion-content">
                        <div class="ps-suggestion-title">${this.highlightQuery(item.title || '', this.currentQuery)}</div>
                        ${item.type ? `<span class="ps-suggestion-type">${item.type}</span>` : ''}
                    </div>
                </div>
            `).join('');
            
            container.innerHTML = html;
            container.classList.add('show');
        },
        
        highlightQuery: function(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<mark>$1</mark>');
        },
        
        hideSuggestions: function() {
            const suggestions = document.querySelectorAll('.ps-search-suggestions');
            suggestions.forEach(container => {
                container.classList.remove('show');
                setTimeout(() => {
                    if (!container.classList.contains('show')) {
                        container.innerHTML = '';
                    }
                }, 300);
            });
        },
        
        addToHistory: function(query) {
            const history = PS.State.get('searchHistory', []);
            
            // إزالة النسخة السابقة إن وجدت
            const index = history.indexOf(query);
            if (index > -1) history.splice(index, 1);
            
            // إضافة في المقدمة
            history.unshift(query);
            
            // الاحتفاظ بآخر 10 بحثات
            if (history.length > 10) history.pop();
            
            PS.State.save('searchHistory', history);
        },
        
        initVoiceSearch: function() {
            if (!PS.settings.features.voice_search || !PS.Utils.isSupported('webSpeech')) {
                return;
            }
            
            // سيتم تهيئة البحث الصوتي في ملف منفصل
            PS.Events.emit('voice-search:init-required');
        }
    };
    
    /**
     * ==== نظام الوضع المظلم ====
     */
    PS.DarkMode = {
        init: function() {
            this.setTheme(PS.State.get('theme', 'light'));
            this.bindEvents();
        },
        
        bindEvents: function() {
            // زر تبديل الوضع
            $(document).on('click', '.ps-theme-toggle', this.toggle.bind(this));
            
            // تطبيق الوضع حسب تفضيل النظام
            if (window.matchMedia && PS.State.get('userPreferences', {}).autoTheme !== false) {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                mediaQuery.addListener(this.handleSystemThemeChange.bind(this));
                this.handleSystemThemeChange(mediaQuery);
            }
        },
        
        toggle: function() {
            const currentTheme = PS.State.get('theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            this.setTheme(newTheme);
        },
        
        setTheme: function(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            PS.State.save('theme', theme);
            
            // تحديث أيقونة الزر
            const toggles = document.querySelectorAll('.ps-theme-toggle');
            toggles.forEach(toggle => {
                const icon = toggle.querySelector('i, .icon');
                if (icon) {
                    icon.className = theme === 'dark' ? 'icon-sun' : 'icon-moon';
                }
            });
            
            PS.Events.emit('theme:changed', { theme });
        },
        
        handleSystemThemeChange: function(e) {
            if (PS.State.get('userPreferences', {}).autoTheme !== false) {
                this.setTheme(e.matches ? 'dark' : 'light');
            }
        }
    };
    
    /**
     * ==== نظام تتبع القراءة ====
     */
    PS.ReadingProgress = {
        init: function() {
            if (!PS.settings.features.reading_progress) return;
            
            this.createProgressBar();
            this.bindScrollEvents();
            this.calculateReadingTime();
        },
        
        createProgressBar: function() {
            if (document.querySelector('.ps-reading-progress')) return;
            
            const progressBar = document.createElement('div');
            progressBar.className = 'ps-reading-progress';
            document.body.appendChild(progressBar);
        },
        
        bindScrollEvents: function() {
            const updateProgress = PS.Utils.throttle(() => {
                const article = document.querySelector('.ps-single-content, .entry-content, article');
                if (!article) return;
                
                const rect = article.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight - windowHeight;
                const scrolled = window.scrollY;
                
                // حساب النسبة المئوية
                const progress = Math.min((scrolled / documentHeight) * 100, 100);
                
                const progressBar = document.querySelector('.ps-reading-progress');
                if (progressBar) {
                    progressBar.style.width = `${progress}%`;
                }
                
                PS.Events.emit('reading:progress', { progress, scrolled });
            }, 100);
            
            window.addEventListener('scroll', updateProgress);
            window.addEventListener('resize', updateProgress);
        },
        
        calculateReadingTime: function() {
            const content = document.querySelector('.ps-single-content, .entry-content, article');
            if (!content) return;
            
            const text = content.textContent || content.innerText || '';
            const readingTime = PS.Utils.calculateReadingTime(text);
            
            // البحث عن عنصر وقت القراءة وتحديثه
            const timeElements = document.querySelectorAll('.ps-reading-time, .reading-time');
            timeElements.forEach(element => {
                element.textContent = readingTime;
            });
        }
    };
    
    /**
     * ==== نظام التحميل التدريجي ====
     */
    PS.LazyLoading = {
        init: function() {
            if (!PS.Utils.isSupported('intersectionObserver')) {
                // للمتصفحات القديمة
                this.fallbackLazyLoad();
                return;
            }
            
            this.createObserver();
            this.observeImages();
        },
        
        createObserver: function() {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.loadImage(entry.target);
                        this.observer.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: '50px'
            });
        },
        
        observeImages: function() {
            const images = document.querySelectorAll('img[data-src], img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src && !img.src) {
                    this.observer.observe(img);
                }
            });
        },
        
        loadImage: function(img) {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
            
            img.addEventListener('load', () => {
                img.classList.add('loaded');
            });
            
            img.addEventListener('error', () => {
                img.classList.add('error');
            });
        },
        
        fallbackLazyLoad: function() {
            const images = document.querySelectorAll('img[data-src]');
            images.forEach(img => this.loadImage(img));
        }
    };
    
    /**
     * ==== نظام الإشعارات ====
     */
    PS.Notifications = {
        container: null,
        notifications: [],
        
        init: function() {
            this.createContainer();
        },
        
        createContainer: function() {
            if (this.container) return;
            
            this.container = document.createElement('div');
            this.container.className = 'ps-notifications-container';
            document.body.appendChild(this.container);
        },
        
        show: function(message, type = 'info', duration = 5000) {
            const notification = document.createElement('div');
            notification.className = `ps-notification ${type}`;
            
            notification.innerHTML = `
                <div class="ps-notification-header">
                    <div class="ps-notification-title">${this.getTypeTitle(type)}</div>
                    <button class="ps-notification-close" aria-label="إغلاق">&times;</button>
                </div>
                <div class="ps-notification-message">${message}</div>
            `;
            
            this.container.appendChild(notification);
            
            // إظهار الإشعار
            setTimeout(() => notification.classList.add('show'), 100);
            
            // إخفاء تلقائي
            if (duration > 0) {
                setTimeout(() => this.hide(notification), duration);
            }
            
            // زر الإغلاق
            notification.querySelector('.ps-notification-close').addEventListener('click', () => {
                this.hide(notification);
            });
            
            this.notifications.push(notification);
            PS.Events.emit('notification:shown', { message, type });
            
            return notification;
        },
        
        hide: function(notification) {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
                const index = this.notifications.indexOf(notification);
                if (index > -1) this.notifications.splice(index, 1);
            }, 300);
        },
        
        getTypeTitle: function(type) {
            const titles = {
                success: PS.settings.isRTL ? 'نجح' : 'Success',
                error: PS.settings.isRTL ? 'خطأ' : 'Error',
                warning: PS.settings.isRTL ? 'تحذير' : 'Warning',
                info: PS.settings.isRTL ? 'معلومات' : 'Info'
            };
            return titles[type] || titles.info;
        }
    };
    
    /**
     * ==== نظام AJAX محسن ====
     */
    PS.Ajax = {
        // إرسال طلب AJAX آمن
        request: async function(action, data = {}, options = {}) {
            const defaultOptions = {
                method: 'POST',
                timeout: 10000,
                showLoader: false,
                showNotification: false
            };
            
            const config = { ...defaultOptions, ...options };
            
            if (config.showLoader) {
                PS.Notifications.show('جاري التحميل...', 'info', 0);
            }
            
            try {
                const formData = new FormData();
                formData.append('action', action);
                formData.append('nonce', PS.settings.nonce);
                
                Object.keys(data).forEach(key => {
                    if (data[key] !== null && data[key] !== undefined) {
                        formData.append(key, data[key]);
                    }
                });
                
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), config.timeout);
                
                const response = await fetch(PS.settings.ajaxUrl, {
                    method: config.method,
                    body: formData,
                    credentials: 'same-origin',
                    signal: controller.signal
                });
                
                clearTimeout(timeoutId);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const result = await response.json();
                
                if (config.showLoader) {
                    PS.Notifications.hide(document.querySelector('.ps-notification'));
                }
                
                if (!result.success && config.showNotification) {
                    PS.Notifications.show(result.data || 'حدث خطأ', 'error');
                } else if (result.success && config.showNotification) {
                    PS.Notifications.show('تم بنجاح', 'success');
                }
                
                return result;
                
            } catch (error) {
                if (config.showLoader) {
                    PS.Notifications.hide(document.querySelector('.ps-notification'));
                }
                
                if (config.showNotification) {
                    PS.Notifications.show('حدث خطأ في الاتصال', 'error');
                }
                
                console.error('AJAX Error:', error);
                throw error;
            }
        }
    };
    
    /**
     * ==== تهيئة القالب الرئيسية ====
     */
    PS.init = function() {
        if (this.initialized) return;
        
        // تهيئة الأنظمة الأساسية
        this.DarkMode.init();
        this.Notifications.init();
        this.LazyLoading.init();
        
        // تهيئة الميزات المتقدمة
        if (this.settings.features.reading_progress) {
            this.ReadingProgress.init();
        }
        
        if (this.settings.features.voice_search || this.settings.features.ai_suggestions) {
            this.Search.init();
        }
        
        // تسجيل Service Worker
        if (PS.Utils.isSupported('serviceWorker')) {
            navigator.serviceWorker.register(PS.settings.themeUri + '/sw.js')
                .then(registration => {
                    console.log('Service Worker registered successfully');
                })
                .catch(error => {
                    console.log('Service Worker registration failed:', error);
                });
        }
        
        // معالجة الأحداث العامة
        this.bindGlobalEvents();
        
        this.initialized = true;
        PS.Events.emit('ps:ready');
    };
    
    /**
     * ==== ربط الأحداث العامة ====
     */
    PS.bindGlobalEvents = function() {
        // تحسين الأداء بتأخير تحميل الصور
        document.addEventListener('DOMContentLoaded', () => {
            PS.LazyLoading.observeImages();
        });
        
        // حفظ موضع التمرير
        window.addEventListener('beforeunload', () => {
            sessionStorage.setItem('ps_scroll_position', window.scrollY);
        });
        
        // استعادة موضع التمرير
        window.addEventListener('load', () => {
            const scrollPosition = sessionStorage.getItem('ps_scroll_position');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                sessionStorage.removeItem('ps_scroll_position');
            }
        });
        
        // معالجة أخطاء JavaScript
        window.addEventListener('error', (e) => {
            console.error('JavaScript Error:', e.error);
            // يمكن إرسال التقرير للخادم هنا
        });
        
        // تحسين الأداء للموبايل
        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');
        }
    };
    
    // تشغيل القالب عند جاهزية DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => PS.init());
    } else {
        PS.init();
    }
    
    // تصدير للنطاق العام
    window.PracticalSolutions = PS;
    
})(window, document, window.jQuery);

/**
 * ==== وظائف مساعدة عامة ====
 */

// دالة مساعدة للتحقق من الجهاز
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// دالة مساعدة للحصول على معاملات URL
function getUrlParameter(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// دالة مساعدة لتنسيق الأرقام
function formatNumber(num, locale = 'ar-SA') {
    return new Intl.NumberFormat(locale).format(num);
}

// تصدير للاستخدام في ملفات أخرى
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.PracticalSolutions;
}

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
 * Block Patterns Registration
 * تسجيل أنماط الكتل المخصصة
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * تسجيل فئات الأنماط
 */
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

/**
 * تحميل ملفات الأنماط
 */
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

📁 اسم الملف: sw.js
/**
 * Service Worker for Practical Solutions Theme
 * خدمة التخزين المؤقت للقالب
 */

const CACHE_NAME = 'practical-solutions-v2.1.0';
const urlsToCache = [
    '/',
    '/wp-content/themes/practical-solutions-pro/assets/css/unified.css',
    '/wp-content/themes/practical-solutions-pro/assets/js/unified.js',
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

📁 اسم الملف:inc/ theme-settings.php
<?php
/**
 * Theme Settings Page - Fixed Version
 * لوحة إعدادات القالب - النسخة المُصححة
 */

if (!defined('ABSPATH')) {
    exit;
}

class PracticalSolutionsSettings {
    
    private $settings_group = 'ps_settings_group';
    private $settings_page = 'ps-settings';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    /**
     * إضافة صفحة الإعدادات
     */
    public function add_settings_page() {
        add_theme_page(
            __('إعدادات الحلول العملية', 'practical-solutions'),
            __('إعدادات القالب', 'practical-solutions'),
            'manage_options',
            $this->settings_page,
            array($this, 'settings_page_content')
        );
    }
    
    /**
     * تسجيل الإعدادات
     */
    public function register_settings() {
        // إعدادات عامة
        register_setting($this->settings_group, 'ps_general_settings', array(
            'sanitize_callback' => array($this, 'sanitize_general_settings')
        ));
        
        // إعدادات الشعار
        register_setting($this->settings_group, 'ps_logo_settings', array(
            'sanitize_callback' => array($this, 'sanitize_logo_settings')
        ));
        
        // إعدادات وسائل التواصل
        register_setting($this->settings_group, 'ps_social_settings', array(
            'sanitize_callback' => array($this, 'sanitize_social_settings')
        ));
        
        // إعدادات الاتصال
        register_setting($this->settings_group, 'ps_contact_settings', array(
            'sanitize_callback' => array($this, 'sanitize_contact_settings')
        ));
        
        // إعدادات البحث
        register_setting($this->settings_group, 'ps_search_settings', array(
            'sanitize_callback' => array($this, 'sanitize_search_settings')
        ));
        
        // إعدادات التحليلات
        register_setting($this->settings_group, 'ps_analytics_settings', array(
            'sanitize_callback' => array($this, 'sanitize_analytics_settings')
        ));
        
        // إعدادات الأداء
        register_setting($this->settings_group, 'ps_performance_settings', array(
            'sanitize_callback' => array($this, 'sanitize_performance_settings')
        ));
    }
    
    /**
     * تحميل السكريبت في المدير
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'appearance_page_' . $this->settings_page) {
            return;
        }
        
        wp_enqueue_media();
        wp_enqueue_script('ps-admin-settings', get_template_directory_uri() . '/assets/js/admin-settings.js', array('jquery'), PS_THEME_VERSION, true);
        wp_enqueue_style('ps-admin-settings', get_template_directory_uri() . '/assets/css/admin-settings.css', array(), PS_THEME_VERSION);
        
        wp_localize_script('ps-admin-settings', 'psAdmin', array(
            'nonce' => wp_create_nonce('ps_admin_nonce'),
            'ajaxUrl' => admin_url('admin-ajax.php')
        ));
    }
    
    /**
     * محتوى صفحة الإعدادات - المُصحح
     */
    public function settings_page_content() {
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        
        // حفظ الإعدادات
        if (isset($_POST['submit']) && wp_verify_nonce($_POST['_wpnonce'], $this->settings_group . '-options')) {
            $this->save_settings($_POST);
            echo '<div class="notice notice-success is-dismissible"><p>تم حفظ الإعدادات بنجاح!</p></div>';
        }
        ?>
        <div class="wrap ps-settings-page">
            <h1><?php _e('إعدادات قالب الحلول العملية', 'practical-solutions'); ?></h1>
            
            <nav class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->settings_page; ?>&tab=general" 
                   class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('عام', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=logo" 
                   class="nav-tab <?php echo $active_tab == 'logo' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('الشعار والهوية', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=social" 
                   class="nav-tab <?php echo $active_tab == 'social' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('وسائل التواصل', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=contact" 
                   class="nav-tab <?php echo $active_tab == 'contact' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('معلومات الاتصال', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=search" 
                   class="nav-tab <?php echo $active_tab == 'search' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('إعدادات البحث', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=analytics" 
                   class="nav-tab <?php echo $active_tab == 'analytics' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('التحليلات', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=performance" 
                   class="nav-tab <?php echo $active_tab == 'performance' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('الأداء', 'practical-solutions'); ?>
                </a>
            </nav>
            
            <form method="post" action="" id="ps-settings-form">
                <?php wp_nonce_field($this->settings_group . '-options'); ?>
                
                <div class="ps-tab-content" id="ps-tab-<?php echo $active_tab; ?>">
                    <?php
                    switch ($active_tab) {
                        case 'general':
                            $this->general_settings_tab();
                            break;
                        case 'logo':
                            $this->logo_settings_tab();
                            break;
                        case 'social':
                            $this->social_settings_tab();
                            break;
                        case 'contact':
                            $this->contact_settings_tab();
                            break;
                        case 'search':
                            $this->search_settings_tab();
                            break;
                        case 'analytics':
                            $this->analytics_settings_tab();
                            break;
                        case 'performance':
                            $this->performance_settings_tab();
                            break;
                        default:
                            $this->general_settings_tab();
                    }
                    ?>
                </div>
                
                <?php submit_button(__('حفظ الإعدادات', 'practical-solutions')); ?>
            </form>
        </div>
        <?php
    }
    
    /**
     * حفظ الإعدادات
     */
    private function save_settings($post_data) {
        // حفظ الإعدادات العامة
        if (isset($post_data['ps_general_settings'])) {
            update_option('ps_general_settings', $this->sanitize_general_settings($post_data['ps_general_settings']));
        }
        
        // حفظ إعدادات الشعار
        if (isset($post_data['ps_logo_settings'])) {
            update_option('ps_logo_settings', $this->sanitize_logo_settings($post_data['ps_logo_settings']));
        }
        
        // حفظ إعدادات وسائل التواصل
        if (isset($post_data['ps_social_settings'])) {
            update_option('ps_social_settings', $this->sanitize_social_settings($post_data['ps_social_settings']));
        }
        
        // حفظ إعدادات الاتصال
        if (isset($post_data['ps_contact_settings'])) {
            update_option('ps_contact_settings', $this->sanitize_contact_settings($post_data['ps_contact_settings']));
        }
        
        // حفظ إعدادات البحث
        if (isset($post_data['ps_search_settings'])) {
            update_option('ps_search_settings', $this->sanitize_search_settings($post_data['ps_search_settings']));
        }
        
        // حفظ إعدادات التحليلات
        if (isset($post_data['ps_analytics_settings'])) {
            update_option('ps_analytics_settings', $this->sanitize_analytics_settings($post_data['ps_analytics_settings']));
        }
        
        // حفظ إعدادات الأداء
        if (isset($post_data['ps_performance_settings'])) {
            update_option('ps_performance_settings', $this->sanitize_performance_settings($post_data['ps_performance_settings']));
        }
    }
    
    // باقي الدوال كما هي...
    private function general_settings_tab() {
        $settings = get_option('ps_general_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('وصف الموقع المختصر', 'practical-solutions'); ?></th>
                <td>
                    <textarea name="ps_general_settings[site_description]" rows="3" cols="50" class="large-text"><?php echo esc_textarea($settings['site_description'] ?? ''); ?></textarea>
                    <p class="description"><?php _e('وصف مختصر يظهر في النتائج والشبكات الاجتماعية', 'practical-solutions'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('الكلمات المفتاحية', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_general_settings[keywords]" value="<?php echo esc_attr($settings['keywords'] ?? ''); ?>" class="large-text" />
                    <p class="description"><?php _e('الكلمات المفتاحية مفصولة بفواصل', 'practical-solutions'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل الوضع المظلم تلقائياً', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_general_settings[auto_dark_mode]" value="1" <?php checked(1, $settings['auto_dark_mode'] ?? 0); ?> />
                        <?php _e('تفعيل الوضع المظلم حسب تفضيل النظام', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('عرض إحصائيات الموقع', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_general_settings[show_stats]" value="1" <?php checked(1, $settings['show_stats'] ?? 1); ?> />
                        <?php _e('إظهار عداد المقالات والزوار في التذييل', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل Breadcrumbs', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_general_settings[enable_breadcrumbs]" value="1" <?php checked(1, $settings['enable_breadcrumbs'] ?? 1); ?> />
                        <?php _e('إظهار مسار التنقل في الصفحات', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    private function logo_settings_tab() {
        $settings = get_option('ps_logo_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('شعار الموقع', 'practical-solutions'); ?></th>
                <td>
                    <div class="ps-logo-upload">
                        <input type="hidden" name="ps_logo_settings[logo]" id="ps_logo" value="<?php echo esc_attr($settings['logo'] ?? ''); ?>" />
                        <div class="ps-logo-preview">
                            <?php if (!empty($settings['logo'])): ?>
                                <img src="<?php echo esc_url($settings['logo']); ?>" style="max-width: 200px; height: auto;" />
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button ps-upload-logo"><?php _e('اختيار الشعار', 'practical-solutions'); ?></button>
                        <button type="button" class="button ps-remove-logo" style="<?php echo empty($settings['logo']) ? 'display:none;' : ''; ?>"><?php _e('إزالة', 'practical-solutions'); ?></button>
                    </div>
                    <p class="description"><?php _e('حجم مُوصى به: 200×60 بكسل', 'practical-solutions'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    private function social_settings_tab() {
        $settings = get_option('ps_social_settings', array());
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر', 
            'instagram' => 'إنستجرام',
            'youtube' => 'يوتيوب',
            'whatsapp' => 'واتساب'
        );
        ?>
        <table class="form-table">
            <?php foreach ($social_networks as $network => $label): ?>
            <tr>
                <th scope="row"><?php echo esc_html($label); ?></th>
                <td>
                    <input type="url" name="ps_social_settings[<?php echo $network; ?>]" value="<?php echo esc_attr($settings[$network] ?? ''); ?>" class="large-text" placeholder="https://" />
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php
    }
    
    private function contact_settings_tab() {
        $settings = get_option('ps_contact_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('رقم الهاتف', 'practical-solutions'); ?></th>
                <td>
                    <input type="tel" name="ps_contact_settings[phone]" value="<?php echo esc_attr($settings['phone'] ?? ''); ?>" class="regular-text" />
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('بريد إلكتروني', 'practical-solutions'); ?></th>
                <td>
                    <input type="email" name="ps_contact_settings[email]" value="<?php echo esc_attr($settings['email'] ?? ''); ?>" class="regular-text" />
                </td>
            </tr>
        </table>
        <?php
    }
    
    private function search_settings_tab() {
        $settings = get_option('ps_search_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('تفعيل البحث الصوتي', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_search_settings[enable_voice_search]" value="1" <?php checked(1, $settings['enable_voice_search'] ?? 1); ?> />
                        <?php _e('السماح للمستخدمين بالبحث باستخدام الصوت', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    private function analytics_settings_tab() {
        $settings = get_option('ps_analytics_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('كود Google Analytics', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_analytics_settings[google_analytics]" value="<?php echo esc_attr($settings['google_analytics'] ?? ''); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
                </td>
            </tr>
        </table>
        <?php
    }
    
    private function performance_settings_tab() {
        $settings = get_option('ps_performance_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('تفعيل التخزين المؤقت', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[enable_caching]" value="1" <?php checked(1, $settings['enable_caching'] ?? 1); ?> />
                        <?php _e('تفعيل Service Worker للتخزين المؤقت', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    // دوال التنظيف
    public function sanitize_general_settings($input) {
        $sanitized = array();
        
        if (isset($input['site_description'])) {
            $sanitized['site_description'] = sanitize_textarea_field($input['site_description']);
        }
        
        if (isset($input['keywords'])) {
            $sanitized['keywords'] = sanitize_text_field($input['keywords']);
        }
        
        $sanitized['auto_dark_mode'] = isset($input['auto_dark_mode']) ? 1 : 0;
        $sanitized['show_stats'] = isset($input['show_stats']) ? 1 : 0;
        $sanitized['enable_breadcrumbs'] = isset($input['enable_breadcrumbs']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_logo_settings($input) {
        $sanitized = array();
        
        if (isset($input['logo'])) {
            $sanitized['logo'] = esc_url_raw($input['logo']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_social_settings($input) {
        $sanitized = array();
        
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'whatsapp');
        
        foreach ($social_networks as $network) {
            if (isset($input[$network])) {
                $sanitized[$network] = esc_url_raw($input[$network]);
            }
        }
        
        return $sanitized;
    }
    
    public function sanitize_contact_settings($input) {
        $sanitized = array();
        
        if (isset($input['phone'])) {
            $sanitized['phone'] = sanitize_text_field($input['phone']);
        }
        
        if (isset($input['email'])) {
            $sanitized['email'] = sanitize_email($input['email']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_search_settings($input) {
        $sanitized = array();
        
        $sanitized['enable_voice_search'] = isset($input['enable_voice_search']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_analytics_settings($input) {
        $sanitized = array();
        
        if (isset($input['google_analytics'])) {
            $sanitized['google_analytics'] = sanitize_text_field($input['google_analytics']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_performance_settings($input) {
        $sanitized = array();
        
        $sanitized['enable_caching'] = isset($input['enable_caching']) ? 1 : 0;
        
        return $sanitized;
    }
}

// تهيئة الكلاس
new PracticalSolutionsSettings();

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
 * FAQ Section Pattern
 * نمط قسم الأسئلة الشائعة
 */

register_block_pattern(
    'practical-solutions/faq-section',
    array(
        'title'       => __('الأسئلة الشائعة', 'practical-solutions'),
        'description' => __('قسم الأسئلة الشائعة مع أجوبة قابلة للطي', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
            <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:3rem">❓ الأسئلة الشائعة</h2>
            <!-- /wp:heading -->
            
            <!-- wp:group {"style":{"spacing":{"blockGap":"1rem"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
            <div class="wp-block-group" style="--wp--style--block-gap:1rem">
                
                <!-- wp:details {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"secondary"} -->
                <details class="wp-block-details ps-faq-item has-secondary-background-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                    <summary style="font-weight: 600; font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;">🤔 هل الحلول المعروضة مجربة فعلاً؟</summary>
                    <p>نعم، جميع الحلول التي نعرضها مُختبرة من قبل فريقنا المتخصص ومن قبل مستخدمين حقيقيين. نحرص على التأكد من فعالية كل حل قبل نشره، ونقوم بتحديث الحلول باستمرار بناءً على تجارب المستخدمين.</p>
                </details>
                <!-- /wp:details -->
                
                <!-- wp:details {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"secondary"} -->
                <details class="wp-block-details ps-faq-item has-secondary-background-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                    <summary style="font-weight: 600; font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;">💰 هل هناك رسوم للوصول للحلول؟</summary>
                    <p>معظم حلولنا مجانية تماماً! نؤمن بأن الحلول العملية يجب أن تكون متاحة للجميع. هناك بعض الحلول المتقدمة والدورات التخصصية التي قد تتطلب اشتراكاً، لكن المحتوى الأساسي مجاني دائماً.</p>
                </details>
                <!-- /wp:details -->
                
                <!-- wp:details {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"secondary"} -->
                <details class="wp-block-details ps-faq-item has-secondary-background-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                    <summary style="font-weight: 600; font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;">⏱️ كم من الوقت أحتاج لتطبيق الحلول؟</summary>
                    <p>هذا يعتمد على نوع الحل، لكن معظم حلولنا مصممة لتكون سريعة وسهلة التطبيق. الحلول البسيطة تأخذ دقائق معدودة، بينما المشاريع الأكبر قد تحتاج من ساعة إلى يوم كامل. نذكر دائماً الوقت المتوقع في بداية كل حل.</p>
                </details>
                <!-- /wp:details -->
                
                <!-- wp:details {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"secondary"} -->
                <details class="wp-block-details ps-faq-item has-secondary-background-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                    <summary style="font-weight: 600; font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;">🛠️ هل أحتاج أدوات خاصة لتطبيق الحلول؟</summary>
                    <p>نركز على الحلول التي تستخدم أدوات متوفرة في كل منزل أو يمكن الحصول عليها بسهولة. عندما نحتاج أدوات خاصة، نقترح بدائل متاحة ونذكر أماكن الحصول عليها بأفضل الأسعار.</p>
                </details>
                <!-- /wp:details -->
                
                <!-- wp:details {"className":"ps-faq-item","style":{"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"secondary"} -->
                <details class="wp-block-details ps-faq-item has-secondary-background-color has-background" style="border-radius:10px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                    <summary style="font-weight: 600; font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;">📱 هل يمكنني الوصول للموقع من الهاتف؟</summary>
                    <p>بالطبع! موقعنا مُحسَّن للعمل على جميع الأجهزة - الهواتف والأجهزة اللوحية والحاسوب. كما يمكنك استخدام البحث الصوتي على الهاتف للوصول السريع للحلول التي تحتاجها.</p>
                </details>
                <!-- /wp:details -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->',
        'categories'  => array('ps-content', 'practical-solutions'),
        'keywords'    => array('faq', 'questions', 'help', 'أسئلة', 'مساعدة'),
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
 * Hero Section with Search Pattern
 * نمط قسم البطل مع البحث
 */

register_block_pattern(
    'practical-solutions/hero-with-search',
    array(
        'title'       => __('قسم البطل مع البحث', 'practical-solutions'),
        'description' => __('قسم بطل رئيسي مع شريط بحث محسن وأزرار دعوة للعمل', 'practical-solutions'),
        'content'     => '
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
        <!-- /wp:group -->',
        'categories'  => array('ps-heroes', 'practical-solutions'),
        'keywords'    => array('hero', 'search', 'بحث', 'بطل'),
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
 * Testimonials Pattern
 * نمط آراء العملاء
 */

register_block_pattern(
    'practical-solutions/testimonials',
    array(
        'title'       => __('آراء العملاء', 'practical-solutions'),
        'description' => __('قسم عرض آراء وتجارب العملاء مع التقييمات', 'practical-solutions'),
        'content'     => '
        <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
        
            <!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-ps-section-title","style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
            <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title" style="margin-bottom:1rem">💬 ماذا يقول عملاؤنا؟</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:3rem">تجارب حقيقية من أشخاص حقيقيين غيروا حياتهم معنا</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
            <div class="wp-block-columns">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1rem; color: #f39c12; font-size: 1.5rem;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="font-style:italic;margin-bottom:1.5rem">"حلول رائعة وعملية! تمكنت من تنظيم مطبخي بالكامل في يوم واحد فقط. أنصح الجميع بتجربة هذه الطرق المذهلة"</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:image {"width":"60px","height":"60px","scale":"cover","sizeSlug":"thumbnail","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                            <figure class="wp-block-image size-thumbnail is-resized" style="border-radius:50px"><img src="https://images.unsplash.com/photo-1494790108755-2616b612b789?w=60&h=60&fit=crop&crop=face" alt="سارة أحمد" style="object-fit:cover;width:60px;height:60px"/></figure>
                            <!-- /wp:image -->
                            
                            <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"constrained"}} -->
                            <div class="wp-block-group" style="--wp--style--block-gap:0.25rem">
                                <!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"0"}}}} -->
                                <p style="margin-bottom:0;font-weight:600">سارة أحمد</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"tertiary"} -->
                                <p class="has-tertiary-color has-text-color" style="margin-bottom:0;font-size:14px">ربة منزل، الرياض</p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1rem; color: #f39c12; font-size: 1.5rem;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="font-style:italic;margin-bottom:1.5rem">"أساليب إدارة الوقت التي تعلمتها هنا غيرت حياتي تماماً. أصبحت أكثر إنتاجية وأقل توتراً في العمل والبيت"</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:image {"width":"60px","height":"60px","scale":"cover","sizeSlug":"thumbnail","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                            <figure class="wp-block-image size-thumbnail is-resized" style="border-radius:50px"><img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="محمد علي" style="object-fit:cover;width:60px;height:60px"/></figure>
                            <!-- /wp:image -->
                            
                            <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"constrained"}} -->
                            <div class="wp-block-group" style="--wp--style--block-gap:0.25rem">
                                <!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"0"}}}} -->
                                <p style="margin-bottom:0;font-weight:600">محمد علي</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"tertiary"} -->
                                <p class="has-tertiary-color has-text-color" style="margin-bottom:0;font-size:14px">مهندس، دبي</p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                        
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:group {"className":"is-style-ps-card-style","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group is-style-ps-card-style">
                        
                        <!-- wp:html -->
                        <div style="text-align: center; margin-bottom: 1rem; color: #f39c12; font-size: 1.5rem;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <!-- /wp:html -->
                        
                        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"italic"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                        <p class="has-text-align-center" style="font-style:italic;margin-bottom:1.5rem">"طرق التوفير التي شاركتموها ساعدتني في توفير آلاف الريالات شهرياً. شكراً لكم على هذه النصائح الذهبية"</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:group {"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group">
                            <!-- wp:image {"width":"60px","height":"60px","scale":"cover","sizeSlug":"thumbnail","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                            <figure class="wp-block-image size-thumbnail is-resized" style="border-radius:50px"><img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&h=60&fit=crop&crop=face" alt="فاطمة الزهراني" style="object-fit:cover;width:60px;height:60px"/></figure>
                            <!-- /wp:image -->
                            
                            <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"constrained"}} -->
                            <div class="wp-block-group" style="--wp--style--block-gap:0.25rem">
                                <!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"0"}}}} -->
                                <p style="margin-bottom:0;font-weight:600">فاطمة الزهراني</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"tertiary"} -->
                                <p class="has-tertiary-color has-text-color" style="margin-bottom:0;font-size:14px">أخصائية تغذية، جدة</p>
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
        <!-- /wp:group -->',
        'categories'  => array('ps-content', 'practical-solutions'),
        'keywords'    => array('testimonials', 'reviews', 'آراء', 'تقييمات'),
    )
);


📁 اسم الملف: rating-system.php
<?php
/**
 * Rating System for Practical Solutions Pro
 * نظام التقييمات للحلول العملية الاحترافية
 * المكان: /inc/rating-system.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Rating_System {
    
    private $table_ratings;
    
    public function __construct() {
        global $wpdb;
        $this->table_ratings = $wpdb->prefix . 'ps_ratings';
        
        add_action('init', array($this, 'init'));
    }
    
    /**
     * ==== التهيئة ====
     */
    public function init() {
        // إنشاء جدول التقييمات عند التفعيل
        register_activation_hook(__FILE__, array($this, 'create_ratings_table'));
        
        // AJAX handlers
        add_action('wp_ajax_ps_submit_rating', array($this, 'handle_submit_rating'));
        add_action('wp_ajax_nopriv_ps_submit_rating', array($this, 'handle_submit_rating'));
        
        add_action('wp_ajax_ps_get_rating', array($this, 'handle_get_rating'));
        add_action('wp_ajax_nopriv_ps_get_rating', array($this, 'handle_get_rating'));
        
        // Shortcodes
        add_shortcode('ps_rating', array($this, 'rating_shortcode'));
        add_shortcode('ps_rating_display', array($this, 'rating_display_shortcode'));
        
        // Hook لإضافة التقييم تلقائياً للمقالات
        add_filter('the_content', array($this, 'auto_add_rating_to_content'));
        
        // إضافة meta box في محرر المقالات
        add_action('add_meta_boxes', array($this, 'add_rating_meta_box'));
        
        // إضافة عمود التقييمات في قائمة المقالات
        add_filter('manage_posts_columns', array($this, 'add_rating_column'));
        add_action('manage_posts_custom_column', array($this, 'display_rating_column'), 10, 2);
        
        // إضافة CSS و JS للإدارة
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }
    
    /**
     * ==== إنشاء جدول التقييمات ====
     */
    public function create_ratings_table() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE {$this->table_ratings} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) NULL,
            user_ip varchar(45) NOT NULL,
            rating tinyint(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
            user_agent text NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_user_post (post_id, user_id, user_ip),
            INDEX idx_post_id (post_id),
            INDEX idx_user_id (user_id),
            INDEX idx_rating (rating),
            INDEX idx_created_at (created_at)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // إضافة الإعدادات الافتراضية
        add_option('ps_rating_settings', array(
            'enabled' => true,
            'auto_display' => true,
            'require_login' => false,
            'allow_multiple' => false,
            'show_average' => true,
            'show_count' => true,
            'rating_position' => 'after_content'
        ));
    }
    
    /**
     * ==== معالج إرسال التقييم ====
     */
    public function handle_submit_rating() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $post_id = intval($_POST['post_id']);
        $rating = intval($_POST['rating']);
        $user_id = get_current_user_id();
        $user_ip = $this->get_user_ip();
        
        // التحقق من صحة البيانات
        if (!$post_id || $rating < 1 || $rating > 5) {
            wp_send_json_error(__('بيانات غير صحيحة', 'practical-solutions'));
        }
        
        // التحقق من وجود المقال
        if (!get_post($post_id)) {
            wp_send_json_error(__('المقال غير موجود', 'practical-solutions'));
        }
        
        // التحقق من الإعدادات
        $settings = get_option('ps_rating_settings', array());
        
        if (!empty($settings['require_login']) && !$user_id) {
            wp_send_json_error(__('يجب تسجيل الدخول للتقييم', 'practical-solutions'));
        }
        
        try {
            $result = $this->save_rating($post_id, $rating, $user_id, $user_ip);
            
            if ($result) {
                // حساب المتوسط الجديد
                $stats = $this->get_rating_stats($post_id);
                
                wp_send_json_success(array(
                    'message' => __('تم حفظ التقييم بنجاح', 'practical-solutions'),
                    'newAverage' => round($stats['average'], 1),
                    'totalRatings' => $stats['count'],
                    'userRating' => $rating
                ));
            } else {
                wp_send_json_error(__('حدث خطأ في حفظ التقييم', 'practical-solutions'));
            }
            
        } catch (Exception $e) {
            error_log('Rating submission error: ' . $e->getMessage());
            wp_send_json_error(__('حدث خطأ في النظام', 'practical-solutions'));
        }
    }
    
    /**
     * ==== حفظ التقييم ====
     */
    public function save_rating($post_id, $rating, $user_id = null, $user_ip = null) {
        global $wpdb;
        
        $user_ip = $user_ip ?: $this->get_user_ip();
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        // التحقق من وجود تقييم سابق
        $existing_rating = $this->get_user_rating($post_id, $user_id, $user_ip);
        
        $settings = get_option('ps_rating_settings', array());
        
        if ($existing_rating && empty($settings['allow_multiple'])) {
            // تحديث التقييم الموجود
            $result = $wpdb->update(
                $this->table_ratings,
                array(
                    'rating' => $rating,
                    'updated_at' => current_time('mysql')
                ),
                array(
                    'post_id' => $post_id,
                    'user_id' => $user_id,
                    'user_ip' => $user_ip
                ),
                array('%d', '%s'),
                array('%d', '%d', '%s')
            );
        } else {
            // إدراج تقييم جديد
            $result = $wpdb->insert(
                $this->table_ratings,
                array(
                    'post_id' => $post_id,
                    'user_id' => $user_id,
                    'user_ip' => $user_ip,
                    'rating' => $rating,
                    'user_agent' => $user_agent
                ),
                array('%d', '%d', '%s', '%d', '%s')
            );
        }
        
        if ($result !== false) {
            // تحديث إحصائيات المقال
            $this->update_post_rating_meta($post_id);
            return true;
        }
        
        return false;
    }
    
    /**
     * ==== الحصول على تقييم المستخدم ====
     */
    public function get_user_rating($post_id, $user_id = null, $user_ip = null) {
        global $wpdb;
        
        $user_ip = $user_ip ?: $this->get_user_ip();
        
        if ($user_id) {
            $rating = $wpdb->get_var($wpdb->prepare(
                "SELECT rating FROM {$this->table_ratings} 
                 WHERE post_id = %d AND user_id = %d 
                 ORDER BY created_at DESC LIMIT 1",
                $post_id,
                $user_id
            ));
        } else {
            $rating = $wpdb->get_var($wpdb->prepare(
                "SELECT rating FROM {$this->table_ratings} 
                 WHERE post_id = %d AND user_ip = %s 
                 ORDER BY created_at DESC LIMIT 1",
                $post_id,
                $user_ip
            ));
        }
        
        return $rating ? intval($rating) : null;
    }
    
    /**
     * ==== الحصول على إحصائيات التقييم ====
     */
    public function get_rating_stats($post_id) {
        global $wpdb;
        
        $stats = $wpdb->get_row($wpdb->prepare(
            "SELECT 
                COUNT(*) as count,
                AVG(rating) as average,
                MIN(rating) as min_rating,
                MAX(rating) as max_rating
             FROM {$this->table_ratings} 
             WHERE post_id = %d",
            $post_id
        ), ARRAY_A);
        
        if (!$stats || $stats['count'] == 0) {
            return array(
                'count' => 0,
                'average' => 0,
                'min_rating' => 0,
                'max_rating' => 0
            );
        }
        
        return array(
            'count' => intval($stats['count']),
            'average' => floatval($stats['average']),
            'min_rating' => intval($stats['min_rating']),
            'max_rating' => intval($stats['max_rating'])
        );
    }
    
    /**
     * ==== تحديث meta للمقال ====
     */
    public function update_post_rating_meta($post_id) {
        $stats = $this->get_rating_stats($post_id);
        
        update_post_meta($post_id, '_ps_rating_average', $stats['average']);
        update_post_meta($post_id, '_ps_rating_count', $stats['count']);
        
        // إضافة للبحث والترتيب
        update_post_meta($post_id, '_ps_rating_score', $stats['average'] * $stats['count']);
    }
    
    /**
     * ==== Shortcode للتقييم ====
     */
    public function rating_shortcode($atts) {
        $atts = shortcode_atts(array(
            'post_id' => get_the_ID(),
            'show_average' => 'true',
            'show_count' => 'true',
            'allow_rating' => 'true',
            'size' => 'medium',
            'class' => ''
        ), $atts);
        
        $post_id = intval($atts['post_id']);
        if (!$post_id) return '';
        
        $settings = get_option('ps_rating_settings', array());
        if (empty($settings['enabled'])) return '';
        
        $stats = $this->get_rating_stats($post_id);
        $user_rating = $this->get_user_rating($post_id);
        
        $size_class = 'ps-rating-' . sanitize_html_class($atts['size']);
        $custom_class = sanitize_html_class($atts['class']);
        
        ob_start();
        ?>
        <div class="ps-rating-system <?php echo $size_class; ?> <?php echo $custom_class; ?>" data-post-id="<?php echo $post_id; ?>">
            
            <?php if ($atts['show_average'] === 'true' || $atts['show_count'] === 'true'): ?>
            <div class="ps-rating-info">
                <?php if ($atts['show_average'] === 'true'): ?>
                <span class="ps-rating-average"><?php echo number_format($stats['average'], 1); ?></span>
                <?php endif; ?>
                
                <?php if ($atts['show_count'] === 'true'): ?>
                <span class="ps-rating-count">(<?php echo $stats['count']; ?> <?php echo $stats['count'] == 1 ? 'تقييم' : 'تقييم'; ?>)</span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($atts['allow_rating'] === 'true'): ?>
            <div class="ps-rating-stars" data-user-rating="<?php echo $user_rating ?: 0; ?>">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="ps-star <?php echo ($user_rating && $i <= $user_rating) ? 'active' : ''; ?>" 
                      data-rating="<?php echo $i; ?>" 
                      title="<?php echo $i; ?> <?php echo $i == 1 ? 'نجمة' : 'نجوم'; ?>">
                    ★
                </span>
                <?php endfor; ?>
            </div>
            
            <?php if (!$user_rating): ?>
            <button type="button" class="ps-rating-submit" style="display: none;">
                <?php _e('إرسال التقييم', 'practical-solutions'); ?>
            </button>
            <?php else: ?>
            <div class="ps-rating-submitted">
                <?php _e('شكراً لك على التقييم!', 'practical-solutions'); ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * ==== Shortcode لعرض التقييم فقط ====
     */
    public function rating_display_shortcode($atts) {
        $atts = shortcode_atts(array(
            'post_id' => get_the_ID(),
            'format' => 'stars', // stars, number, both
            'size' => 'small'
        ), $atts);
        
        $post_id = intval($atts['post_id']);
        if (!$post_id) return '';
        
        $stats = $this->get_rating_stats($post_id);
        
        if ($stats['count'] == 0) return '';
        
        $size_class = 'ps-rating-display-' . sanitize_html_class($atts['size']);
        
        ob_start();
        ?>
        <div class="ps-rating-display <?php echo $size_class; ?>">
            <?php if ($atts['format'] === 'stars' || $atts['format'] === 'both'): ?>
            <div class="ps-rating-stars-display">
                <?php 
                $average = $stats['average'];
                for ($i = 1; $i <= 5; $i++): 
                    $class = '';
                    if ($i <= $average) {
                        $class = 'full';
                    } elseif ($i - 0.5 <= $average) {
                        $class = 'half';
                    } else {
                        $class = 'empty';
                    }
                ?>
                <span class="ps-star-display <?php echo $class; ?>">★</span>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($atts['format'] === 'number' || $atts['format'] === 'both'): ?>
            <span class="ps-rating-number">
                <?php echo number_format($average, 1); ?>/5 (<?php echo $stats['count']; ?>)
            </span>
            <?php endif; ?>
        </div>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * ==== إضافة التقييم تلقائياً للمحتوى ====
     */
    public function auto_add_rating_to_content($content) {
        if (!is_single() || !is_main_query()) {
            return $content;
        }
        
        $settings = get_option('ps_rating_settings', array());
        
        if (empty($settings['enabled']) || empty($settings['auto_display'])) {
            return $content;
        }
        
        $rating_html = $this->rating_shortcode(array());
        
        if ($settings['rating_position'] === 'before_content') {
            return $rating_html . $content;
        } else {
            return $content . $rating_html;
        }
    }
    
    /**
     * ==== إضافة Meta Box ====
     */
    public function add_rating_meta_box() {
        add_meta_box(
            'ps_rating_meta_box',
            __('إحصائيات التقييم', 'practical-solutions'),
            array($this, 'rating_meta_box_callback'),
            'post',
            'side',
            'default'
        );
    }
    
    public function rating_meta_box_callback($post) {
        $stats = $this->get_rating_stats($post->ID);
        $recent_ratings = $this->get_recent_ratings($post->ID, 5);
        
        ?>
        <div class="ps-rating-meta-box">
            <table class="form-table">
                <tr>
                    <td><strong><?php _e('متوسط التقييم:', 'practical-solutions'); ?></strong></td>
                    <td><?php echo number_format($stats['average'], 1); ?>/5</td>
                </tr>
                <tr>
                    <td><strong><?php _e('عدد التقييمات:', 'practical-solutions'); ?></strong></td>
                    <td><?php echo $stats['count']; ?></td>
                </tr>
                <?php if ($stats['count'] > 0): ?>
                <tr>
                    <td><strong><?php _e('النطاق:', 'practical-solutions'); ?></strong></td>
                    <td><?php echo $stats['min_rating']; ?> - <?php echo $stats['max_rating']; ?></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <?php if (!empty($recent_ratings)): ?>
            <h4><?php _e('آخر التقييمات:', 'practical-solutions'); ?></h4>
            <ul class="ps-recent-ratings">
                <?php foreach ($recent_ratings as $rating): ?>
                <li>
                    <strong><?php echo str_repeat('★', $rating->rating); ?></strong>
                    <?php echo date_i18n('Y/m/d H:i', strtotime($rating->created_at)); ?>
                    <?php if ($rating->user_id): ?>
                    - <?php echo get_userdata($rating->user_id)->display_name; ?>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            
            <p>
                <button type="button" class="button" onclick="location.reload();">
                    <?php _e('تحديث', 'practical-solutions'); ?>
                </button>
            </p>
        </div>
        
        <style>
        .ps-rating-meta-box .form-table {
            margin: 0;
        }
        .ps-rating-meta-box .form-table td {
            padding: 5px 0;
        }
        .ps-recent-ratings {
            margin: 10px 0;
            font-size: 12px;
        }
        .ps-recent-ratings li {
            margin-bottom: 5px;
            padding: 5px;
            background: #f9f9f9;
            border-radius: 3px;
        }
        </style>
        <?php
    }
    
    /**
     * ==== الحصول على آخر التقييمات ====
     */
    public function get_recent_ratings($post_id, $limit = 10) {
        global $wpdb;
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT rating, user_id, created_at 
             FROM {$this->table_ratings} 
             WHERE post_id = %d 
             ORDER BY created_at DESC 
             LIMIT %d",
            $post_id,
            $limit
        ));
    }
    
    /**
     * ==== إضافة عمود التقييمات ====
     */
    public function add_rating_column($columns) {
        $columns['ps_rating'] = __('التقييم', 'practical-solutions');
        return $columns;
    }
    
    public function display_rating_column($column, $post_id) {
        if ($column === 'ps_rating') {
            $stats = $this->get_rating_stats($post_id);
            
            if ($stats['count'] > 0) {
                echo '<div class="ps-rating-column">';
                echo '<strong>' . number_format($stats['average'], 1) . '/5</strong><br>';
                echo '<small>(' . $stats['count'] . ' تقييم)</small>';
                echo '</div>';
            } else {
                echo '<div class="ps-rating-column">';
                echo '<span class="ps-no-rating">لا يوجد تقييم</span>';
                echo '</div>';
            }
        }
    }
    
    /**
     * ==== تحميل ملفات الإدارة ====
     */
    public function enqueue_admin_assets($hook) {
        if ($hook === 'post.php' || $hook === 'post-new.php' || $hook === 'edit.php') {
            wp_add_inline_style('wp-admin', '
                .ps-rating-column { text-align: center; }
                .ps-rating-column strong { color: #0073aa; }
                .ps-no-rating { color: #999; font-style: italic; }
            ');
        }
    }
    
    /**
     * ==== معالج الحصول على التقييم ====
     */
    public function handle_get_rating() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $post_id = intval($_POST['post_id']);
        
        if (!$post_id) {
            wp_send_json_error(__('معرف المقال مطلوب', 'practical-solutions'));
        }
        
        $stats = $this->get_rating_stats($post_id);
        $user_rating = $this->get_user_rating($post_id);
        
        wp_send_json_success(array(
            'stats' => $stats,
            'user_rating' => $user_rating
        ));
    }
    
    /**
     * ==== الحصول على IP المستخدم ====
     */
    private function get_user_ip() {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    /**
     * ==== API عامة لاستخدام المطورين ====
     */
    
    // الحصول على أفضل المقالات تقييماً
    public function get_top_rated_posts($limit = 10, $min_ratings = 1) {
        global $wpdb;
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT p.ID, p.post_title, 
                    AVG(r.rating) as average_rating,
                    COUNT(r.rating) as rating_count
             FROM {$wpdb->posts} p
             INNER JOIN {$this->table_ratings} r ON p.ID = r.post_id
             WHERE p.post_status = 'publish' AND p.post_type = 'post'
             GROUP BY p.ID
             HAVING rating_count >= %d
             ORDER BY average_rating DESC, rating_count DESC
             LIMIT %d",
            $min_ratings,
            $limit
        ));
    }
    
    // إحصائيات عامة
    public function get_general_stats() {
        global $wpdb;
        
        return $wpdb->get_row(
            "SELECT 
                COUNT(DISTINCT post_id) as total_rated_posts,
                COUNT(*) as total_ratings,
                AVG(rating) as overall_average,
                MIN(rating) as min_rating,
                MAX(rating) as max_rating
             FROM {$this->table_ratings}",
            ARRAY_A
        );
    }
}

// تهيئة النظام
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
 * Enhanced Voice Search for Practical Solutions Pro
 * البحث الصوتي المحسن للحلول العملية الاحترافية
 * المكان: /assets/js/enhanced-voice-search.js
 */

(function(window, document, $) {
    'use strict';
    
    // التحقق من توفر PracticalSolutions
    if (!window.PracticalSolutions) {
        console.error('PracticalSolutions not found. Voice search requires unified.js');
        return;
    }
    
    const PS = window.PracticalSolutions;
    
    /**
     * ==== نظام البحث الصوتي المحسن ====
     */
    PS.VoiceSearch = {
        recognition: null,
        isListening: false,
        isSupported: false,
        currentButton: null,
        currentInput: null,
        interimTranscript: '',
        finalTranscript: '',
        confidence: 0,
        languageCode: 'ar-SA',
        fallbackLanguages: ['ar-EG', 'ar', 'en-US'],
        commandPatterns: new Map(),
        
        // إعدادات الصوت
        settings: {
            continuous: true,
            interimResults: true,
            maxAlternatives: 3,
            timeout: 15000,
            confidenceThreshold: 0.7,
            autoSearch: true,
            commandMode: true
        },
        
        init: function() {
            this.checkSupport();
            if (!this.isSupported) {
                this.handleUnsupported();
                return;
            }
            
            this.setupRecognition();
            this.registerCommands();
            this.bindEvents();
            this.setupUI();
            
            PS.Events.emit('voice-search:ready');
        },
        
        /**
         * ==== التحقق من الدعم ====
         */
        checkSupport: function() {
            this.isSupported = !!(window.SpeechRecognition || window.webkitSpeechRecognition);
            
            if (!this.isSupported) {
                console.warn('Speech Recognition API not supported');
                return;
            }
            
            // التحقق من الأذونات
            if (navigator.permissions) {
                navigator.permissions.query({name: 'microphone'}).then(result => {
                    if (result.state === 'denied') {
                        this.isSupported = false;
                        this.handlePermissionDenied();
                    }
                });
            }
        },
        
        /**
         * ==== إعداد الـ Recognition ====
         */
        setupRecognition: function() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            
            // الإعدادات الأساسية
            this.recognition.continuous = this.settings.continuous;
            this.recognition.interimResults = this.settings.interimResults;
            this.recognition.maxAlternatives = this.settings.maxAlternatives;
            this.recognition.lang = this.languageCode;
            
            // ربط الأحداث
            this.recognition.onstart = this.onStart.bind(this);
            this.recognition.onresult = this.onResult.bind(this);
            this.recognition.onerror = this.onError.bind(this);
            this.recognition.onend = this.onEnd.bind(this);
            this.recognition.onnomatch = this.onNoMatch.bind(this);
            this.recognition.onsoundstart = this.onSoundStart.bind(this);
            this.recognition.onsoundend = this.onSoundEnd.bind(this);
        },
        
        /**
         * ==== تسجيل الأوامر الصوتية ====
         */
        registerCommands: function() {
            // أوامر البحث
            this.commandPatterns.set(/^(ابحث عن|بحث عن|ادور على|دور على)\s+(.+)$/i, (match) => {
                this.performSearch(match[2]);
            });
            
            // أوامر التنقل
            this.commandPatterns.set(/^(اذهب إلى|روح على|انتقل إلى)\s+(الرئيسية|المنزل|المطبخ|النصائح|اتصل بنا)$/i, (match) => {
                this.navigateTo(match[2]);
            });
            
            // أوامر الواجهة
            this.commandPatterns.set(/^(افتح|اظهر|عرض)\s+(البحث|القائمة|المفضلة)$/i, (match) => {
                this.openSection(match[2]);
            });
            
            // أوامر الوضع المظلم
            this.commandPatterns.set(/^(فعل|شغل|إيقاف|أطفئ)\s+(الوضع المظلم|النايت مود)$/i, (match) => {
                this.toggleDarkMode(match[1]);
            });
            
            // أوامر القراءة
            this.commandPatterns.set(/^(اقرأ|قراءة)\s+(المقال|النص|المحتوى)$/i, (match) => {
                this.readContent();
            });
            
            // أوامر المفضلة
            this.commandPatterns.set(/^(احفظ|أضف إلى المفضلة|احفظ في المفضلة)$/i, (match) => {
                this.bookmarkCurrentPage();
            });
        },
        
        /**
         * ==== ربط الأحداث ====
         */
        bindEvents: function() {
            // الزر الصوتي الرئيسي
            $(document).on('click', '.ps-voice-search-btn', this.handleVoiceButtonClick.bind(this));
            
            // اختصارات لوحة المفاتيح
            $(document).on('keydown', this.handleKeyboardShortcuts.bind(this));
            
            // أحداث PracticalSolutions
            PS.Events.on('voice-search:init-required', this.init.bind(this));
            PS.Events.on('voice-search:start', this.startListening.bind(this));
            PS.Events.on('voice-search:stop', this.stopListening.bind(this));
        },
        
        /**
         * ==== إعداد واجهة المستخدم ====
         */
        setupUI: function() {
            // إضافة مؤشر الحالة إذا لم يكن موجوداً
            if (!document.querySelector('.ps-voice-status')) {
                const statusIndicator = document.createElement('div');
                statusIndicator.className = 'ps-voice-status';
                statusIndicator.innerHTML = `
                    <div class="ps-voice-status-content">
                        <div class="ps-voice-icon">🎤</div>
                        <div class="ps-voice-text">أتحدث...</div>
                        <div class="ps-voice-transcript"></div>
                        <button class="ps-voice-cancel" aria-label="إلغاء">×</button>
                    </div>
                `;
                document.body.appendChild(statusIndicator);
                
                // ربط زر الإلغاء
                statusIndicator.querySelector('.ps-voice-cancel').addEventListener('click', () => {
                    this.stopListening();
                });
            }
        },
        
        /**
         * ==== معالج النقر على زر الصوت ====
         */
        handleVoiceButtonClick: function(e) {
            e.preventDefault();
            
            this.currentButton = e.currentTarget;
            this.currentInput = this.findNearestInput(this.currentButton);
            
            if (this.isListening) {
                this.stopListening();
            } else {
                this.startListening();
            }
        },
        
        /**
         * ==== العثور على أقرب حقل إدخال ====
         */
        findNearestInput: function(button) {
            const container = button.closest('.ps-search-container, .ps-hero-search-container, form');
            if (container) {
                const input = container.querySelector('.ps-search-input, .ps-hero-search-input, input[type="search"]');
                if (input) return input;
            }
            
            // البحث في الصفحة كاملة
            return document.querySelector('.ps-search-input, .ps-hero-search-input, input[type="search"]');
        },
        
        /**
         * ==== اختصارات لوحة المفاتيح ====
         */
        handleKeyboardShortcuts: function(e) {
            // Ctrl/Cmd + Shift + S للبحث الصوتي
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'S') {
                e.preventDefault();
                this.currentInput = document.activeElement;
                if (this.currentInput && this.currentInput.type === 'search') {
                    this.currentButton = this.currentInput.parentElement.querySelector('.ps-voice-search-btn');
                    this.toggleListening();
                }
            }
            
            // Escape لإيقاف الاستماع
            if (e.key === 'Escape' && this.isListening) {
                this.stopListening();
            }
        },
        
        /**
         * ==== بدء الاستماع ====
         */
        startListening: function() {
            if (!this.isSupported) {
                this.showError('البحث الصوتي غير مدعوم في هذا المتصفح');
                return;
            }
            
            if (this.isListening) return;
            
            try {
                // إعادة تعيين المتغيرات
                this.interimTranscript = '';
                this.finalTranscript = '';
                this.confidence = 0;
                
                // بدء التسجيل
                this.recognition.start();
                
                // تعيين timeout
                this.recognitionTimeout = setTimeout(() => {
                    if (this.isListening) {
                        this.stopListening();
                        this.showError('انتهت مهلة الاستماع');
                    }
                }, this.settings.timeout);
                
                PS.Events.emit('voice-search:start-listening');
                
            } catch (error) {
                console.error('Voice Search Error:', error);
                this.showError('حدث خطأ في بدء البحث الصوتي');
            }
        },
        
        /**
         * ==== إيقاف الاستماع ====
         */
        stopListening: function() {
            if (!this.isListening) return;
            
            try {
                this.recognition.stop();
                
                if (this.recognitionTimeout) {
                    clearTimeout(this.recognitionTimeout);
                    this.recognitionTimeout = null;
                }
                
                PS.Events.emit('voice-search:stop-listening');
                
            } catch (error) {
                console.error('Voice Search Stop Error:', error);
            }
        },
        
        /**
         * ==== تبديل حالة الاستماع ====
         */
        toggleListening: function() {
            if (this.isListening) {
                this.stopListening();
            } else {
                this.startListening();
            }
        },
        
        /**
         * ==== أحداث Speech Recognition ====
         */
        onStart: function() {
            this.isListening = true;
            this.updateButtonState(true);
            this.showVoiceStatus(true);
            
            PS.Events.emit('voice-search:listening-started');
        },
        
        onResult: function(event) {
            let interimTranscript = '';
            let finalTranscript = '';
            let maxConfidence = 0;
            
            // معالجة النتائج
            for (let i = event.resultIndex; i < event.results.length; i++) {
                const result = event.results[i];
                const transcript = result[0].transcript;
                const confidence = result[0].confidence || 0;
                
                if (result.isFinal) {
                    finalTranscript += transcript;
                    maxConfidence = Math.max(maxConfidence, confidence);
                } else {
                    interimTranscript += transcript;
                }
            }
            
            this.interimTranscript = interimTranscript;
            this.finalTranscript += finalTranscript;
            this.confidence = maxConfidence;
            
            // تحديث واجهة المستخدم
            this.updateTranscriptDisplay();
            
            // إذا انتهى النص النهائي، قم بمعالجته
            if (finalTranscript) {
                this.processFinalTranscript(this.finalTranscript.trim());
            }
        },
        
        onError: function(event) {
            console.error('Speech Recognition Error:', event.error);
            
            const errorMessages = {
                'no-speech': 'لم يتم اكتشاف صوت',
                'audio-capture': 'خطأ في التقاط الصوت',
                'not-allowed': 'لم يتم منح إذن الميكروفون',
                'network': 'خطأ في الشبكة',
                'language-not-supported': 'اللغة غير مدعومة',
                'service-not-allowed': 'الخدمة غير متاحة'
            };
            
            const message = errorMessages[event.error] || 'حدث خطأ في البحث الصوتي';
            this.showError(message);
            
            // إعادة المحاولة بلغة أخرى في حالة عدم دعم اللغة
            if (event.error === 'language-not-supported' && this.fallbackLanguages.length > 0) {
                this.tryFallbackLanguage();
            } else {
                this.stopListening();
            }
        },
        
        onEnd: function() {
            this.isListening = false;
            this.updateButtonState(false);
            this.showVoiceStatus(false);
            
            if (this.recognitionTimeout) {
                clearTimeout(this.recognitionTimeout);
                this.recognitionTimeout = null;
            }
            
            PS.Events.emit('voice-search:listening-ended');
        },
        
        onNoMatch: function() {
            this.showError('لم يتم التعرف على الصوت بوضوح');
        },
        
        onSoundStart: function() {
            this.updateVoiceIcon('listening');
        },
        
        onSoundEnd: function() {
            this.updateVoiceIcon('processing');
        },
        
        /**
         * ==== معالجة النص النهائي ====
         */
        processFinalTranscript: function(transcript) {
            const cleanTranscript = this.cleanTranscript(transcript);
            
            // التحقق من مستوى الثقة
            if (this.confidence < this.settings.confidenceThreshold) {
                this.showWarning(`نسبة الثقة منخفضة (${Math.round(this.confidence * 100)}%). هل تقصد: "${cleanTranscript}"؟`);
                return;
            }
            
            // البحث عن أوامر صوتية
            const commandExecuted = this.executeVoiceCommand(cleanTranscript);
            
            if (!commandExecuted && this.settings.autoSearch) {
                // تحليل النص للبحث
                const searchQuery = this.analyzeSearchIntent(cleanTranscript);
                this.updateSearchInput(searchQuery);
                
                if (this.settings.autoSearch) {
                    this.performAutoSearch(searchQuery);
                }
            }
            
            this.stopListening();
        },
        
        /**
         * ==== تنظيف النص ====
         */
        cleanTranscript: function(transcript) {
            return transcript
                .trim()
                .replace(/\s+/g, ' ')
                .replace(/[،,]\s*$/, '')
                .replace(/^(ابحث عن|بحث عن|أريد|أبحث عن)\s+/i, '');
        },
        
        /**
         * ==== تنفيذ الأوامر الصوتية ====
         */
        executeVoiceCommand: function(transcript) {
            for (const [pattern, handler] of this.commandPatterns) {
                const match = transcript.match(pattern);
                if (match) {
                    try {
                        handler(match);
                        this.showSuccess(`تم تنفيذ الأمر: ${transcript}`);
                        return true;
                    } catch (error) {
                        console.error('Command execution error:', error);
                        this.showError('حدث خطأ في تنفيذ الأمر');
                    }
                }
            }
            return false;
        },
        
        /**
         * ==== تحليل نية البحث ====
         */
        analyzeSearchIntent: function(transcript) {
            // إزالة الكلمات الزائدة
            const stopWords = ['في', 'من', 'إلى', 'على', 'عن', 'مع', 'بدون', 'حول', 'the', 'a', 'an', 'in', 'on', 'at', 'for'];
            
            let cleanQuery = transcript
                .split(' ')
                .filter(word => !stopWords.includes(word.toLowerCase()))
                .join(' ');
            
            // تصحيح الأخطاء الشائعة
            cleanQuery = this.correctCommonMistakes(cleanQuery);
            
            // إضافة مرادفات
            cleanQuery = this.expandQuery(cleanQuery);
            
            return cleanQuery;
        },
        
        /**
         * ==== تصحيح الأخطاء الشائعة ====
         */
        correctCommonMistakes: function(query) {
            const corrections = {
                'تنضيف': 'تنظيف',
                'ترتيب': 'ترتيب',
                'مطبخ': 'مطبخ',
                'كيتشن': 'مطبخ',
                'هوم': 'منزل',
                'لايف ستايل': 'نمط حياة'
            };
            
            let corrected = query;
            Object.keys(corrections).forEach(mistake => {
                const regex = new RegExp(mistake, 'gi');
                corrected = corrected.replace(regex, corrections[mistake]);
            });
            
            return corrected;
        },
        
        /**
         * ==== توسيع الاستعلام بالمرادفات ====
         */
        expandQuery: function(query) {
            // لا نريد إضافة مرادفات كثيرة للبحث الصوتي
            return query;
        },
        
        /**
         * ==== تحديث حقل البحث ====
         */
        updateSearchInput: function(query) {
            if (this.currentInput) {
                this.currentInput.value = query;
                
                // تفعيل حدث input للاقتراحات
                const inputEvent = new Event('input', { bubbles: true });
                this.currentInput.dispatchEvent(inputEvent);
                
                // التركيز على الحقل
                this.currentInput.focus();
            }
        },
        
        /**
         * ==== البحث التلقائي ====
         */
        performAutoSearch: function(query) {
            if (!query.trim()) return;
            
            setTimeout(() => {
                if (this.currentInput) {
                    const form = this.currentInput.closest('form');
                    if (form) {
                        form.dispatchEvent(new Event('submit', { bubbles: true }));
                    } else {
                        // البحث المباشر
                        window.location.href = `${PS.settings.homeUrl}?s=${encodeURIComponent(query)}`;
                    }
                }
            }, 1000);
        },
        
        /**
         * ==== إجراءات الأوامر الصوتية ====
         */
        performSearch: function(query) {
            this.updateSearchInput(query);
            this.performAutoSearch(query);
        },
        
        navigateTo: function(destination) {
            const routes = {
                'الرئيسية': '/',
                'المنزل': '/category/home',
                'المطبخ': '/category/kitchen', 
                'النصائح': '/category/lifestyle',
                'اتصل بنا': '/contact'
            };
            
            const url = routes[destination] || `/?s=${encodeURIComponent(destination)}`;
            window.location.href = url;
        },
        
        openSection: function(section) {
            const selectors = {
                'البحث': '.ps-search-input, .ps-hero-search-input',
                'القائمة': '.ps-main-navigation',
                'المفضلة': '.ps-bookmarks'
            };
            
            const element = document.querySelector(selectors[section]);
            if (element) {
                element.focus();
                element.scrollIntoView({ behavior: 'smooth' });
            }
        },
        
        toggleDarkMode: function(action) {
            const shouldEnable = action === 'فعل' || action === 'شغل';
            const currentTheme = PS.State.get('theme', 'light');
            
            if ((shouldEnable && currentTheme === 'light') || (!shouldEnable && currentTheme === 'dark')) {
                PS.DarkMode.toggle();
            }
        },
        
        readContent: function() {
            // ميزة قراءة المحتوى باستخدام Speech Synthesis
            if ('speechSynthesis' in window) {
                const content = document.querySelector('.ps-single-content, .entry-content, article');
                if (content) {
                    const text = content.textContent.substring(0, 500) + '...';
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'ar-SA';
                    utterance.rate = 0.8;
                    speechSynthesis.speak(utterance);
                }
            }
        },
        
        bookmarkCurrentPage: function() {
            const bookmarkBtn = document.querySelector('.ps-bookmark-btn');
            if (bookmarkBtn) {
                bookmarkBtn.click();
            }
        },
        
        /**
         * ==== إدارة واجهة المستخدم ====
         */
        updateButtonState: function(isListening) {
            if (this.currentButton) {
                this.currentButton.classList.toggle('listening', isListening);
                this.currentButton.classList.toggle('processing', false);
                
                const icon = this.currentButton.querySelector('i, .icon, .emoji');
                if (icon) {
                    icon.textContent = isListening ? '🔴' : '🎤';
                }
            }
            
            // تحديث جميع أزرار البحث الصوتي
            document.querySelectorAll('.ps-voice-search-btn').forEach(btn => {
                btn.classList.toggle('listening', isListening);
                if (btn !== this.currentButton) {
                    btn.disabled = isListening;
                }
            });
        },
        
        updateVoiceIcon: function(state) {
            if (!this.currentButton) return;
            
            const icons = {
                'idle': '🎤',
                'listening': '🔴',
                'processing': '⏳'
            };
            
            const icon = this.currentButton.querySelector('i, .icon, .emoji');
            if (icon) {
                icon.textContent = icons[state] || icons.idle;
            }
        },
        
        showVoiceStatus: function(show) {
            const status = document.querySelector('.ps-voice-status');
            if (status) {
                status.classList.toggle('show', show);
                
                if (show) {
                    status.querySelector('.ps-voice-transcript').textContent = '';
                }
            }
        },
        
        updateTranscriptDisplay: function() {
            const transcriptEl = document.querySelector('.ps-voice-transcript');
            if (transcriptEl) {
                const displayText = this.finalTranscript + (this.interimTranscript ? ` ${this.interimTranscript}` : '');
                transcriptEl.textContent = displayText;
            }
        },
        
        /**
         * ==== إدارة الرسائل ====
         */
        showSuccess: function(message) {
            if (PS.Notifications) {
                PS.Notifications.show(message, 'success', 3000);
            }
        },
        
        showError: function(message) {
            if (PS.Notifications) {
                PS.Notifications.show(message, 'error', 5000);
            }
        },
        
        showWarning: function(message) {
            if (PS.Notifications) {
                PS.Notifications.show(message, 'warning', 4000);
            }
        },
        
        /**
         * ==== معالجة عدم الدعم ====
         */
        handleUnsupported: function() {
            // إخفاء أزرار البحث الصوتي
            document.querySelectorAll('.ps-voice-search-btn').forEach(btn => {
                btn.style.display = 'none';
            });
            
            console.warn('Voice Search not supported in this browser');
        },
        
        handlePermissionDenied: function() {
            this.showError('تم رفض إذن الميكروفون. يرجى السماح بالوصول للميكروفون في إعدادات المتصفح.');
        },
        
        /**
         * ==== تجربة لغة بديلة ====
         */
        tryFallbackLanguage: function() {
            if (this.fallbackLanguages.length > 0) {
                const newLang = this.fallbackLanguages.shift();
                this.recognition.lang = newLang;
                
                setTimeout(() => {
                    this.startListening();
                }, 1000);
            }
        }
    };
    
    // تهيئة عند الاستدعاء
    PS.Events.on('voice-search:init-required', () => {
        PS.VoiceSearch.init();
    });
    
    // تصدير
    window.PSVoiceSearch = PS.VoiceSearch;
    
})(window, document, window.jQuery);

// CSS إضافي للبحث الصوتي
const voiceSearchCSS = `
<style>
.ps-voice-search-btn {
    transition: all 0.3s ease;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    cursor: pointer;
    border: none;
    background: linear-gradient(135deg, #007cba, #0056b3);
    color: white;
    box-shadow: 0 2px 8px rgba(0,123,186,0.3);
}

.ps-voice-search-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0,123,186,0.4);
}

.ps-voice-search-btn.listening {
    animation: pulse-red 1.5s infinite;
    background: linear-gradient(135deg, #dc3545, #c82333);
}

.ps-voice-search-btn.processing {
    animation: spin 1s linear infinite;
    background: linear-gradient(135deg, #f59e0b, #e0a800);
}

.ps-voice-search-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.ps-voice-status {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    max-width: 400px;
    width: 90%;
    text-align: center;
}

.ps-voice-status.show {
    opacity: 1;
    visibility: visible;
    transform: translate(-50%, -50%) scale(1);
}

.ps-voice-status-content {
    position: relative;
}

.ps-voice-icon {
    font-size: 48px;
    margin-bottom: 20px;
    animation: pulse 1.5s infinite;
}

.ps-voice-text {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.ps-voice-transcript {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    min-height: 50px;
    font-size: 16px;
    color: #555;
    border: 2px dashed #dee2e6;
    line-height: 1.5;
}

.ps-voice-cancel {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ps-voice-cancel:hover {
    background: #c82333;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@keyframes pulse-red {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .ps-voice-status {
        padding: 20px;
    }
    
    .ps-voice-icon {
        font-size: 36px;
        margin-bottom: 15px;
    }
    
    .ps-voice-text {
        font-size: 16px;
    }
    
    .ps-voice-transcript {
        padding: 12px;
        font-size: 14px;
    }
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', voiceSearchCSS);

📁 اسم الملف: ai-search-suggestions.php
<?php
/**
 * AI-Powered Search Suggestions
 * نظام الاقتراحات الذكية بالذكاء الاصطناعي
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_AI_Search_Suggestions {
    
    private $api_key;
    private $cache_duration = 86400; // 24 hours
    private $max_suggestions = 8;
    
    public function __construct() {
        $this->api_key = get_option('ps_openai_api_key', '');
        
        add_action('wp_ajax_ps_ai_suggestions', array($this, 'get_ai_suggestions'));
        add_action('wp_ajax_nopriv_ps_ai_suggestions', array($this, 'get_ai_suggestions'));
        add_action('wp_ajax_ps_smart_search', array($this, 'smart_search'));
        add_action('wp_ajax_nopriv_ps_smart_search', array($this, 'smart_search'));
        
        // إضافة إعدادات API
        add_action('admin_init', array($this, 'register_ai_settings'));
    }
    
    /**
     * تسجيل إعدادات الذكاء الاصطناعي
     */
    public function register_ai_settings() {
        register_setting('ps_ai_settings', 'ps_openai_api_key');
        register_setting('ps_ai_settings', 'ps_ai_search_enabled');
        register_setting('ps_ai_settings', 'ps_ai_model');
        register_setting('ps_ai_settings', 'ps_ai_temperature');
        register_setting('ps_ai_settings', 'ps_ai_max_tokens');
    }
    
    /**
     * الحصول على اقتراحات ذكية
     */
    public function get_ai_suggestions() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'ps_ai_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        $query = sanitize_text_field($_POST['query']);
        $context = sanitize_text_field($_POST['context'] ?? '');
        $user_behavior = json_decode(stripslashes($_POST['user_behavior'] ?? '{}'), true);
        
        if (strlen($query) < 2) {
            wp_send_json_error('الاستعلام قصير جداً');
        }
        
        // فحص الكاش أولاً
        $cache_key = 'ps_ai_suggestions_' . md5($query . $context);
        $cached_suggestions = get_transient($cache_key);
        
        if ($cached_suggestions !== false) {
            wp_send_json_success($cached_suggestions);
        }
        
        // إنشاء اقتراحات ذكية
        $suggestions = $this->generate_smart_suggestions($query, $context, $user_behavior);
        
        // حفظ في الكاش
        set_transient($cache_key, $suggestions, $this->cache_duration);
        
        wp_send_json_success($suggestions);
    }
    
    /**
     * إنشاء اقتراحات ذكية
     */
    private function generate_smart_suggestions($query, $context = '', $user_behavior = array()) {
        $suggestions = array();
        
        // 1. اقتراحات محلية سريعة
        $local_suggestions = $this->get_local_suggestions($query);
        
        // 2. اقتراحات مبنية على سلوك المستخدم
        $behavioral_suggestions = $this->get_behavioral_suggestions($query, $user_behavior);
        
        // 3. اقتراحات بالذكاء الاصطناعي (إذا كان متاحاً)
        $ai_suggestions = array();
        if ($this->is_ai_enabled() && !empty($this->api_key)) {
            $ai_suggestions = $this->get_openai_suggestions($query, $context);
        }
        
        // 4. اقتراحات من المحتوى المشابه
        $semantic_suggestions = $this->get_semantic_suggestions($query);
        
        // دمج وترتيب الاقتراحات
        $all_suggestions = array_merge(
            $local_suggestions,
            $behavioral_suggestions,
            $ai_suggestions,
            $semantic_suggestions
        );
        
        // إزالة التكرارات وترتيب حسب الأهمية
        $unique_suggestions = $this->deduplicate_and_rank($all_suggestions, $query);
        
        // تحديد العدد المطلوب
        $suggestions = array_slice($unique_suggestions, 0, $this->max_suggestions);
        
        return array(
            'suggestions' => $suggestions,
            'query' => $query,
            'total_sources' => count($all_suggestions),
            'ai_enabled' => $this->is_ai_enabled()
        );
    }
    
    /**
     * الحصول على اقتراحات محلية
     */
    private function get_local_suggestions($query) {
        global $wpdb;
        
        $suggestions = array();
        
        // البحث في العناوين
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
            LIMIT 15
        ", 
            '%' . $query . '%',
            '%' . $query . '%',
            $query . '%',
            '%' . $query . '%'
        ));
        
        foreach ($posts as $post) {
            $suggestions[] = array(
                'text' => $post->post_title,
                'type' => 'post',
                'url' => get_permalink($post->ID),
                'excerpt' => wp_trim_words($post->post_excerpt, 15),
                'relevance' => $this->calculate_relevance($query, $post->post_title),
                'source' => 'local'
            );
        }
        
        // البحث في التصنيفات
        $categories = get_terms(array(
            'taxonomy' => 'category',
            'search' => $query,
            'number' => 5
        ));
        
        foreach ($categories as $category) {
            $suggestions[] = array(
                'text' => $category->name,
                'type' => 'category',
                'url' => get_category_link($category->term_id),
                'excerpt' => $category->description,
                'relevance' => $this->calculate_relevance($query, $category->name),
                'source' => 'category'
            );
        }
        
        return $suggestions;
    }
    
    /**
     * اقتراحات مبنية على سلوك المستخدم
     */
    private function get_behavioral_suggestions($query, $user_behavior) {
        $suggestions = array();
        
        // إذا كان لدينا بيانات سلوك المستخدم
        if (!empty($user_behavior['recent_searches'])) {
            foreach ($user_behavior['recent_searches'] as $search) {
                if (stripos($search, $query) !== false || stripos($query, $search) !== false) {
                    $suggestions[] = array(
                        'text' => $search,
                        'type' => 'recent',
                        'url' => '/?s=' . urlencode($search),
                        'excerpt' => 'بحث سابق',
                        'relevance' => 0.8,
                        'source' => 'behavior'
                    );
                }
            }
        }
        
        // اقتراحات مبنية على التصنيفات المفضلة
        if (!empty($user_behavior['preferred_categories'])) {
            foreach ($user_behavior['preferred_categories'] as $cat_id => $count) {
                $category = get_category($cat_id);
                if ($category && stripos($category->name, $query) !== false) {
                    $suggestions[] = array(
                        'text' => 'حلول ' . $category->name,
                        'type' => 'preference',
                        'url' => get_category_link($cat_id),
                        'excerpt' => 'من اهتماماتك المفضلة',
                        'relevance' => 0.7,
                        'source' => 'preference'
                    );
                }
            }
        }
        
        return $suggestions;
    }
    
    /**
     * اقتراحات OpenAI
     */
    private function get_openai_suggestions($query, $context = '') {
        if (empty($this->api_key)) {
            return array();
        }
        
        $suggestions = array();
        
        try {
            $prompt = $this->build_ai_prompt($query, $context);
            $response = $this->call_openai_api($prompt);
            
            if ($response && isset($response['choices'][0]['message']['content'])) {
                $ai_text = $response['choices'][0]['message']['content'];
                $parsed_suggestions = $this->parse_ai_response($ai_text, $query);
                
                foreach ($parsed_suggestions as $suggestion) {
                    $suggestions[] = array(
                        'text' => $suggestion,
                        'type' => 'ai',
                        'url' => '/?s=' . urlencode($suggestion),
                        'excerpt' => 'اقتراح ذكي',
                        'relevance' => 0.9,
                        'source' => 'ai'
                    );
                }
            }
            
        } catch (Exception $e) {
            error_log('AI Suggestions Error: ' . $e->getMessage());
        }
        
        return $suggestions;
    }
    
    /**
     * بناء prompt للذكاء الاصطناعي
     */
    private function build_ai_prompt($query, $context) {
        $site_name = get_bloginfo('name');
        $site_description = get_bloginfo('description');
        
        $prompt = "أنت مساعد ذكي متخصص في اقتراح عمليات البحث لموقع '{$site_name}' الذي يقدم {$site_description}.

المستخدم يبحث عن: '{$query}'
السياق: {$context}

قدم 5 اقتراحات بحث ذكية ومفيدة باللغة العربية تساعد المستخدم في العثور على حلول عملية.
الاقتراحات يجب أن تكون:
1. مرتبطة بالاستعلام الأصلي
2. عملية ومفيدة
3. متنوعة في المجالات (منزل، مطبخ، نصائح حياتية، إلخ)
4. واضحة ومباشرة

أرجع الاقتراحات في شكل قائمة مرقمة، كل اقتراح في سطر منفصل:";

        return $prompt;
    }
    
    /**
     * استدعاء OpenAI API
     */
    private function call_openai_api($prompt) {
        $model = get_option('ps_ai_model', 'gpt-3.5-turbo');
        $temperature = floatval(get_option('ps_ai_temperature', 0.7));
        $max_tokens = intval(get_option('ps_ai_max_tokens', 150));
        
        $body = array(
            'model' => $model,
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'temperature' => $temperature,
            'max_tokens' => $max_tokens
        );
        
        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json'
             ),
            'body' => wp_json_encode($body),
            'timeout' => 10
        ));
        
        if (is_wp_error($response)) {
            throw new Exception($response->get_error_message());
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (isset($data['error'])) {
            throw new Exception($data['error']['message']);
        }
        
        return $data;
    }
    
    /**
     * تحليل استجابة الذكاء الاصطناعي
     */
    private function parse_ai_response($ai_text, $original_query) {
        $suggestions = array();
        $lines = explode("\n", $ai_text);
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // إزالة الترقيم
            $line = preg_replace('/^\d+\.\s*/', '', $line);
            $line = preg_replace('/^[-•]\s*/', '', $line);
            
            if (!empty($line) && strlen($line) > 3 && strlen($line) < 100) {
                // تنظيف الاقتراح
                $suggestion = $this->clean_ai_suggestion($line, $original_query);
                if ($suggestion) {
                    $suggestions[] = $suggestion;
                }
            }
        }
        
        return array_slice($suggestions, 0, 5);
    }
    
    /**
     * تنظيف اقتراح الذكاء الاصطناعي
     */
    private function clean_ai_suggestion($suggestion, $original_query) {
        // إزالة العلامات غير المرغوبة
        $suggestion = preg_replace('/[\\\'"`"]/', '', $suggestion);
        $suggestion = trim($suggestion, '.-,');
        
        // التأكد من أنه ليس مطابقاً للاستعلام الأصلي
        if (strtolower($suggestion) === strtolower($original_query)) {
            return null;
        }
        
        // التأكد من الطول المناسب
        if (strlen($suggestion) < 5 || strlen($suggestion) > 80) {
            return null;
        }
        
        return $suggestion;
    }
    
    /**
     * اقتراحات دلالية
     */
    private function get_semantic_suggestions($query) {
        $suggestions = array();
        
        // خريطة الكلمات المرادفة والمصطلحات ذات الصلة
        $semantic_map = array(
            'تنظيف' => array('ترتيب', 'تطهير', 'غسيل', 'تنظيم المنزل'),
            'مطبخ' => array('طبخ', 'وصفات', 'أدوات مطبخ', 'تنظيم المطبخ'),
            'منزل' => array('بيت', 'ديكور', 'ترتيب المنزل', 'تنظيم المنزل'),
            'توفير' => array('اقتصاد', 'خصم', 'عروض', 'ميزانية'),
            'صحة' => array('لياقة', 'رياضة', 'تغذية', 'صحة نفسية')
        );
        
        foreach ($semantic_map as $key => $related_terms) {
            if (stripos($query, $key) !== false) {
                foreach ($related_terms as $term) {
                    $suggestions[] = array(
                        'text' => $term,
                        'type' => 'semantic',
                        'url' => '/?s=' . urlencode($term),
                        'excerpt' => 'مصطلح ذو صلة',
                        'relevance' => 0.6,
                        'source' => 'semantic'
                    );
                }
                break;
            }
        }
        
        return $suggestions;
    }
    
    /**
     * حساب مدى الصلة
     */
    private function calculate_relevance($query, $text) {
        $query = strtolower($query);
        $text = strtolower($text);
        
        // مطابقة تامة
        if ($text === $query) {
            return 1.0;
        }
        
        // يبدأ بنفس الكلمات
        if (strpos($text, $query) === 0) {
            return 0.9;
        }
        
        // يحتوي على الاستعلام
        if (strpos($text, $query) !== false) {
            return 0.8;
        }
        
        // حساب التشابه بالكلمات
        $query_words = explode(' ', $query);
        $text_words = explode(' ', $text);
        $common_words = array_intersect($query_words, $text_words);
        
        if (count($query_words) > 0) {
            return count($common_words) / count($query_words) * 0.7;
        }
        
        return 0.1;
    }
    
    /**
     * إزالة التكرارات والترتيب
     */
    private function deduplicate_and_rank($suggestions, $query) {
        $unique = array();
        $seen = array();
        
        foreach ($suggestions as $suggestion) {
            $key = strtolower($suggestion['text']);
            
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $unique[] = $suggestion;
            }
        }
        
        // ترتيب حسب الصلة
        usort($unique, function($a, $b) {
            return $b['relevance'] <=> $a['relevance'];
        });
        
        return $unique;
    }
    
    /**
     * البحث الذكي
     */
    public function smart_search() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_search_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        $query = sanitize_text_field($_POST['query']);
        $filters = json_decode(stripslashes($_POST['filters'] ?? '{}'), true);
        $user_context = json_decode(stripslashes($_POST['context'] ?? '{}'), true);
        
        // تحليل الاستعلام بالذكاء الاصطناعي
        $analyzed_query = $this->analyze_search_intent($query);
        
        // البحث المحسن
        $results = $this->perform_enhanced_search($analyzed_query, $filters, $user_context);
        
        wp_send_json_success($results);
    }
    
    /**
     * تحليل نية البحث
     */
    private function analyze_search_intent($query) {
        // تحليل نوع الاستعلام
        $intent_patterns = array(
            'how' => '/^(كيف|كيفية|طريقة|how to|how do)/i',
            'what' => '/^(ما هو|ماذا|what is|what are)/i',
            'where' => '/^(أين|where)/i',
            'when' => '/^(متى|when)/i',
            'why' => '/^(لماذا|لم|why)/i',
            'solution' => '/(حل|مشكلة|علاج|solution|problem)/i',
            'tip' => '/(نصيحة|نصائح|tips|advice)/i',
            'recipe' => '/(وصفة|طبخ|recipe|cooking)/i'
        );
        
        $detected_intent = 'general';
        foreach ($intent_patterns as $intent => $pattern) {
            if (preg_match($pattern, $query)) {
                $detected_intent = $intent;
                break;
            }
        }
        
        return array(
            'original_query' => $query,
            'intent' => $detected_intent,
            'keywords' => $this->extract_keywords($query),
            'entities' => $this->extract_entities($query)
        );
    }
    
    /**
     * استخراج الكلمات المفتاحية
     */
    private function extract_keywords($query) {
        // إزالة كلمات الوقف
        $stop_words = array('في', 'من', 'إلى', 'على', 'عن', 'مع', 'هذا', 'هذه', 'التي', 'الذي');
        
        $words = preg_split('/\s+/', strtolower($query));
        $keywords = array_diff($words, $stop_words);
        
        return array_values($keywords);
    }
    
    /**
     * استخراج الكيانات
     */
    private function extract_entities($query) {
        $entities = array(
            'categories' => array(),
            'locations' => array(),
            'tools' => array()
        );
        
        // خريطة الكيانات
        $entity_map = array(
            'categories' => array('مطبخ', 'منزل', 'صحة', 'نصائح'),
            'locations' => array('بيت', 'غرفة', 'حمام', 'مطبخ', 'غرفة نوم'),
            'tools' => array('أدوات', 'جهاز', 'آلة', 'معدات')
        );
        
        foreach ($entity_map as $type => $terms) {
            foreach ($terms as $term) {
                if (stripos($query, $term) !== false) {
                    $entities[$type][] = $term;
                }
            }
        }
        
        return $entities;
    }
    
    /**
     * البحث المحسن
     */
    private function perform_enhanced_search($analyzed_query, $filters, $context) {
        global $wpdb;
        
        $query = $analyzed_query['original_query'];
        $intent = $analyzed_query['intent'];
        $keywords = $analyzed_query['keywords'];
        
        // بناء استعلام SQL محسن
        $sql_parts = array(
            'SELECT' => "p.ID, p.post_title, p.post_excerpt, p.post_date",
            'FROM' => "{$wpdb->posts} p",
            'WHERE' => array("p.post_status = 'publish'", "p.post_type = 'post'"),
            'ORDER' => array(),
            'LIMIT' => 20
        );
        
        // إضافة شروط البحث المتقدم
        $search_conditions = array();
        
        // البحث في العنوان (أولوية عالية)
        $search_conditions[] = $wpdb->prepare("p.post_title LIKE %s", '%' . $query . '%');
        
        // البحث في المحتوى
        $search_conditions[] = $wpdb->prepare("p.post_content LIKE %s", '%' . $query . '%');
        
        // البحث بالكلمات المفتاحية
        foreach ($keywords as $keyword) {
            if (strlen($keyword) > 2) {
                $search_conditions[] = $wpdb->prepare("(p.post_title LIKE %s OR p.post_content LIKE %s)", 
                    '%' . $keyword . '%', '%' . $keyword . '%');
            }
        }
        
        // دمج شروط البحث
        if (!empty($search_conditions)) {
            $sql_parts['WHERE'][] = '(' . implode(' OR ', $search_conditions) . ')';
        }
        
        // ترتيب حسب الصلة والتاريخ
        $sql_parts['ORDER'][] = "CASE 
            WHEN p.post_title LIKE '%" . esc_sql($query) . "%' THEN 1
            WHEN p.post_content LIKE '%" . esc_sql($query) . "%' THEN 2
            ELSE 3
        END";
        $sql_parts['ORDER'][] = "p.post_date DESC";
        
        // بناء الاستعلام النهائي
        $final_sql = $sql_parts['SELECT'] . ' FROM ' . $sql_parts['FROM'] . 
                    ' WHERE ' . implode(' AND ', $sql_parts['WHERE']) . 
                    ' ORDER BY ' . implode(', ', $sql_parts['ORDER']) . 
                    ' LIMIT ' . $sql_parts['LIMIT'];
        
        $results = $wpdb->get_results($final_sql);
        
        // تحسين النتائج
        $enhanced_results = array();
        foreach ($results as $result) {
            $enhanced_results[] = array(
                'id' => $result->ID,
                'title' => $result->post_title,
                'excerpt' => wp_trim_words($result->post_excerpt ?: strip_tags($result->post_content), 25),
                'url' => get_permalink($result->ID),
                'date' => $result->post_date,
                'thumbnail' => get_the_post_thumbnail_url($result->ID, 'medium'),
                'relevance' => $this->calculate_result_relevance($query, $result),
                'intent_match' => $this->check_intent_match($intent, $result)
            );
        }
        
        return array(
            'results' => $enhanced_results,
            'query_analysis' => $analyzed_query,
            'total_found' => count($enhanced_results),
            'search_time' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']
        );
    }
    
    /**
     * حساب صلة النتيجة
     */
    private function calculate_result_relevance($query, $result) {
        $score = 0;
        
        // مطابقة العنوان
        if (stripos($result->post_title, $query) !== false) {
            $score += 0.6;
        }
        
        // مطابقة بداية العنوان
        if (stripos($result->post_title, $query) === 0) {
            $score += 0.3;
        }
        
        // مطابقة المحتوى
        if (stripos($result->post_content, $query) !== false) {
            $score += 0.1;
        }
        
        return min($score, 1.0);
    }
    
    /**
     * فحص مطابقة النية
     */
    private function check_intent_match($intent, $result) {
        $content = strtolower($result->post_title . ' ' . $result->post_content);
        
        $intent_indicators = array(
            'how' => array('كيف', 'طريقة', 'خطوات', 'how', 'step'),
            'what' => array('ما هو', 'تعريف', 'what', 'definition'),
            'solution' => array('حل', 'علاج', 'solution', 'fix'),
            'tip' => array('نصيحة', 'tip', 'advice'),
            'recipe' => array('وصفة', 'مقادير', 'recipe', 'ingredients')
        );
        
        if (isset($intent_indicators[$intent])) {
            foreach ($intent_indicators[$intent] as $indicator) {
                if (strpos($content, $indicator) !== false) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * فحص تفعيل الذكاء الاصطناعي
     */
    private function is_ai_enabled() {
        return get_option('ps_ai_search_enabled', false) && !empty($this->api_key);
    }
}

// تهيئة النظام
new PS_AI_Search_Suggestions();


📁 اسم الملف: interactive-features.js
/**
 * Interactive Features for Practical Solutions Pro
 * الميزات التفاعلية المتقدمة للحلول العملية الاحترافية
 * المكان: /assets/js/interactive-features.js
 */

(function(window, document, $) {
    'use strict';
    
    // التحقق من توفر PracticalSolutions
    if (!window.PracticalSolutions) {
        console.error('PracticalSolutions not found. Interactive features require unified.js');
        return;
    }
    
    const PS = window.PracticalSolutions;
    
    /**
     * ==== نظام المفضلة (Bookmarks) ====
     */
    PS.Bookmarks = {
        bookmarks: new Set(),
        initialized: false,
        
        init: function() {
            if (this.initialized) return;
            
            this.loadBookmarks();
            this.bindEvents();
            this.updateUI();
            this.initialized = true;
            
            PS.Events.emit('bookmarks:ready');
        },
        
        loadBookmarks: function() {
            try {
                const saved = localStorage.getItem('ps_bookmarks');
                if (saved) {
                    this.bookmarks = new Set(JSON.parse(saved));
                }
            } catch (e) {
                console.warn('Error loading bookmarks:', e);
                this.bookmarks = new Set();
            }
        },
        
        saveBookmarks: function() {
            try {
                localStorage.setItem('ps_bookmarks', JSON.stringify([...this.bookmarks]));
            } catch (e) {
                console.warn('Error saving bookmarks:', e);
            }
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-bookmark-btn', this.handleBookmarkClick.bind(this));
            $(document).on('click', '.ps-bookmark-toggle', this.handleBookmarkClick.bind(this));
        },
        
        handleBookmarkClick: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const postId = button.dataset.postId || PS.settings.postId;
            
            if (!postId) {
                this.showNotification('معرف المقال غير موجود', 'error');
                return;
            }
            
            const isBookmarked = this.isBookmarked(postId);
            
            if (isBookmarked) {
                this.removeBookmark(postId, button);
            } else {
                this.addBookmark(postId, button);
            }
        },
        
        addBookmark: function(postId, button = null) {
            this.bookmarks.add(postId);
            this.saveBookmarks();
            
            // تحديث الواجهة
            this.updateBookmarkButton(postId, true, button);
            
            // إرسال للخادم إذا كان المستخدم مسجل الدخول
            if (PS.settings.userId) {
                this.syncBookmarkToServer(postId, 'add');
            }
            
            this.showNotification(PS.settings.strings.bookmarkAdded || 'تم إضافة للمفضلة', 'success');
            PS.Events.emit('bookmark:added', { postId });
        },
        
        removeBookmark: function(postId, button = null) {
            this.bookmarks.delete(postId);
            this.saveBookmarks();
            
            // تحديث الواجهة
            this.updateBookmarkButton(postId, false, button);
            
            // إرسال للخادم إذا كان المستخدم مسجل الدخول
            if (PS.settings.userId) {
                this.syncBookmarkToServer(postId, 'remove');
            }
            
            this.showNotification(PS.settings.strings.bookmarkRemoved || 'تم إزالة من المفضلة', 'info');
            PS.Events.emit('bookmark:removed', { postId });
        },
        
        isBookmarked: function(postId) {
            return this.bookmarks.has(postId.toString());
        },
        
        updateBookmarkButton: function(postId, isBookmarked, specificButton = null) {
            const buttons = specificButton ? [specificButton] : 
                document.querySelectorAll(`[data-post-id="${postId}"].ps-bookmark-btn, [data-post-id="${postId}"].ps-bookmark-toggle`);
            
            buttons.forEach(button => {
                button.classList.toggle('bookmarked', isBookmarked);
                
                const icon = button.querySelector('.ps-bookmark-icon, i');
                if (icon) {
                    icon.textContent = isBookmarked ? '❤️' : '🤍';
                    icon.className = isBookmarked ? 'ps-bookmark-icon bookmarked' : 'ps-bookmark-icon';
                }
                
                const text = button.querySelector('.ps-bookmark-text');
                if (text) {
                    text.textContent = isBookmarked ? 'محفوظ' : 'حفظ';
                }
                
                button.setAttribute('aria-pressed', isBookmarked);
                button.title = isBookmarked ? 'إزالة من المفضلة' : 'إضافة للمفضلة';
            });
        },
        
        updateUI: function() {
            this.bookmarks.forEach(postId => {
                this.updateBookmarkButton(postId, true);
            });
        },
        
        syncBookmarkToServer: function(postId, action) {
            PS.Ajax.request('ps_bookmark_post', {
                post_id: postId,
                bookmark_action: action
            }).catch(error => {
                console.warn('Bookmark sync failed:', error);
            });
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        },
        
        getBookmarks: function() {
            return [...this.bookmarks];
        },
        
        getBookmarksCount: function() {
            return this.bookmarks.size;
        }
    };
    
    /**
     * ==== نظام التقييمات (Rating System) ====
     */
    PS.RatingSystem = {
        initialized: false,
        ratings: new Map(),
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.loadUserRatings();
            this.initialized = true;
            
            PS.Events.emit('rating:ready');
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-star', this.handleStarClick.bind(this));
            $(document).on('mouseenter', '.ps-star', this.handleStarHover.bind(this));
            $(document).on('mouseleave', '.ps-rating-stars', this.handleStarsLeave.bind(this));
            $(document).on('click', '.ps-rating-submit', this.handleRatingSubmit.bind(this));
        },
        
        handleStarClick: function(e) {
            const star = e.currentTarget;
            const rating = parseInt(star.dataset.rating);
            const widget = star.closest('.ps-rating-system');
            
            if (!widget) return;
            
            this.setRating(widget, rating);
        },
        
        handleStarHover: function(e) {
            const star = e.currentTarget;
            const rating = parseInt(star.dataset.rating);
            const widget = star.closest('.ps-rating-system');
            
            if (!widget) return;
            
            this.highlightStars(widget, rating, true);
        },
        
        handleStarsLeave: function(e) {
            const widget = e.currentTarget.closest('.ps-rating-system');
            if (!widget) return;
            
            const currentRating = this.getCurrentRating(widget);
            this.highlightStars(widget, currentRating, false);
        },
        
        handleRatingSubmit: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const widget = button.closest('.ps-rating-system');
            const postId = widget.dataset.postId || PS.settings.postId;
            const rating = this.getCurrentRating(widget);
            
            if (!rating) {
                this.showNotification('يرجى اختيار تقييم أولاً', 'warning');
                return;
            }
            
            this.submitRating(postId, rating, widget);
        },
        
        setRating: function(widget, rating) {
            const postId = widget.dataset.postId || PS.settings.postId;
            
            // تحديث واجهة المستخدم
            this.highlightStars(widget, rating, false);
            widget.dataset.userRating = rating;
            
            // حفظ محلياً
            this.ratings.set(postId, rating);
            this.saveUserRatings();
            
            // إظهار زر الإرسال
            const submitBtn = widget.querySelector('.ps-rating-submit');
            if (submitBtn) {
                submitBtn.style.display = 'inline-block';
            }
            
            PS.Events.emit('rating:selected', { postId, rating });
        },
        
        highlightStars: function(widget, rating, isHover = false) {
            const stars = widget.querySelectorAll('.ps-star');
            
            stars.forEach((star, index) => {
                const starRating = index + 1;
                const isActive = starRating <= rating;
                
                star.classList.toggle('active', isActive);
                star.classList.toggle('hover-effect', isHover && isActive);
                
                // تحديث لون النجمة
                star.style.color = isActive ? 
                    (isHover ? '#ffeb3b' : '#ffc107') : '#ddd';
            });
        },
        
        getCurrentRating: function(widget) {
            return parseInt(widget.dataset.userRating) || 0;
        },
        
        submitRating: function(postId, rating, widget) {
            const submitBtn = widget.querySelector('.ps-rating-submit');
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'جاري الإرسال...';
            }
            
            PS.Ajax.request('ps_submit_rating', {
                post_id: postId,
                rating: rating
            }).then(response => {
                if (response.success) {
                    this.handleRatingSuccess(widget, response.data);
                } else {
                    this.showNotification(response.data || 'حدث خطأ في إرسال التقييم', 'error');
                }
            }).catch(error => {
                this.showNotification('حدث خطأ في الاتصال', 'error');
            }).finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'إرسال التقييم';
                }
            });
        },
        
        handleRatingSuccess: function(widget, data) {
            // إخفاء زر الإرسال وإظهار رسالة النجاح
            const submitBtn = widget.querySelector('.ps-rating-submit');
            if (submitBtn) {
                submitBtn.style.display = 'none';
            }
            
            // إضافة رسالة النجاح
            let successMsg = widget.querySelector('.ps-rating-submitted');
            if (!successMsg) {
                successMsg = document.createElement('div');
                successMsg.className = 'ps-rating-submitted';
                successMsg.textContent = PS.settings.strings.ratingSubmitted || 'شكراً لك على التقييم!';
                widget.appendChild(successMsg);
            }
            
            // تحديث إحصائيات التقييم
            if (data.newAverage) {
                this.updateRatingDisplay(widget, data.newAverage, data.totalRatings);
            }
            
            this.showNotification('تم إرسال التقييم بنجاح', 'success');
            PS.Events.emit('rating:submitted', data);
        },
        
        updateRatingDisplay: function(widget, average, count = null) {
            const averageEl = widget.querySelector('.ps-rating-average');
            const countEl = widget.querySelector('.ps-rating-count');
            
            if (averageEl) {
                averageEl.textContent = average.toFixed(1);
            }
            
            if (countEl && count !== null) {
                countEl.textContent = `(${count} تقييم)`;
            }
        },
        
        loadUserRatings: function() {
            try {
                const saved = localStorage.getItem('ps_user_ratings');
                if (saved) {
                    this.ratings = new Map(JSON.parse(saved));
                }
            } catch (e) {
                console.warn('Error loading ratings:', e);
                this.ratings = new Map();
            }
        },
        
        saveUserRatings: function() {
            try {
                localStorage.setItem('ps_user_ratings', JSON.stringify([...this.ratings]));
            } catch (e) {
                console.warn('Error saving ratings:', e);
            }
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        }
    };
    
    /**
     * ==== نظام المشاركة الاجتماعية ====
     */
    PS.SocialSharing = {
        initialized: false,
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.initialized = true;
            
            PS.Events.emit('sharing:ready');
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-share-btn', this.handleShareClick.bind(this));
            $(document).on('click', '.ps-copy-link', this.handleCopyLink.bind(this));
        },
        
        handleShareClick: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const platform = button.dataset.platform;
            const url = button.dataset.url || window.location.href;
            const title = button.dataset.title || document.title;
            const description = button.dataset.description || '';
            
            this.shareToplatform(platform, url, title, description);
            this.trackShare(platform);
        },
        
        shareToplatform: function(platform, url, title, description) {
            const encodedUrl = encodeURIComponent(url);
            const encodedTitle = encodeURIComponent(title);
            const encodedDescription = encodeURIComponent(description);
            
            const shareUrls = {
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`,
                linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`,
                whatsapp: `https://wa.me/?text=${encodedTitle}%20${encodedUrl}`,
                telegram: `https://t.me/share/url?url=${encodedUrl}&text=${encodedTitle}`,
                email: `mailto:?subject=${encodedTitle}&body=${encodedDescription}%0A%0A${encodedUrl}`
            };
            
            if (shareUrls[platform]) {
                if (platform === 'email') {
                    window.location.href = shareUrls[platform];
                } else {
                    this.openShareWindow(shareUrls[platform], platform);
                }
            }
        },
        
        openShareWindow: function(url, platform) {
            const width = 600;
            const height = 400;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;
            
            const windowFeatures = `width=${width},height=${height},left=${left},top=${top},resizable=yes,scrollbars=yes`;
            
            window.open(url, `share_${platform}`, windowFeatures);
        },
        
        handleCopyLink: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const url = button.dataset.url || window.location.href;
            
            this.copyToClipboard(url).then(() => {
                this.showNotification(PS.settings.strings.shareSuccess || 'تم نسخ الرابط', 'success');
                this.trackShare('copy');
            }).catch(() => {
                this.showNotification('فشل في نسخ الرابط', 'error');
            });
        },
        
        copyToClipboard: function(text) {
            if (navigator.clipboard) {
                return navigator.clipboard.writeText(text);
            } else {
                // للمتصفحات القديمة
                return new Promise((resolve, reject) => {
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    textArea.style.position = 'fixed';
                    textArea.style.opacity = '0';
                    document.body.appendChild(textArea);
                    textArea.select();
                    
                    try {
                        const successful = document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        if (successful) {
                            resolve();
                        } else {
                            reject();
                        }
                    } catch (err) {
                        document.body.removeChild(textArea);
                        reject(err);
                    }
                });
            }
        },
        
        trackShare: function(platform) {
            if (PS.settings.features.share_tracking) {
                PS.Ajax.request('ps_track_share', {
                    post_id: PS.settings.postId,
                    platform: platform
                }).catch(error => {
                    console.warn('Share tracking failed:', error);
                });
            }
            
            PS.Events.emit('share:tracked', { platform });
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        }
    };
    
    /**
     * ==== نظام تتبع نشاط المستخدم ====
     */
    PS.UserActivity = {
        initialized: false,
        sessionData: {
            startTime: Date.now(),
            scrollDepth: 0,
            interactions: 0,
            timeOnPage: 0,
            engagementScore: 0
        },
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.startTracking();
            this.initialized = true;
            
            PS.Events.emit('activity:ready');
        },
        
        bindEvents: function() {
            // تتبع التمرير
            $(window).on('scroll', PS.Utils.throttle(this.trackScroll.bind(this), 250));
            
            // تتبع التفاعلات
            $(document).on('click', this.trackInteraction.bind(this));
            $(document).on('keydown', this.trackInteraction.bind(this));
            
            // إرسال البيانات قبل المغادرة
            $(window).on('beforeunload', this.sendActivityData.bind(this));
            
            // إرسال دوري
            setInterval(this.sendActivityData.bind(this), 30000); // كل 30 ثانية
        },
        
        trackScroll: function() {
            const scrollTop = window.pageYOffset;
            const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollDepth = documentHeight > 0 ? scrollTop / documentHeight : 0;
            
            this.sessionData.scrollDepth = Math.max(this.sessionData.scrollDepth, scrollDepth);
            this.updateEngagementScore();
        },
        
        trackInteraction: function() {
            this.sessionData.interactions++;
            this.updateEngagementScore();
        },
        
        updateEngagementScore: function() {
            const timeWeight = Math.min((Date.now() - this.sessionData.startTime) / 300000, 1); // 5 دقائق كحد أقصى
            const scrollWeight = this.sessionData.scrollDepth;
            const interactionWeight = Math.min(this.sessionData.interactions / 10, 1);
            
            this.sessionData.engagementScore = Math.round(
                (timeWeight * 0.4 + scrollWeight * 0.4 + interactionWeight * 0.2) * 100
            );
        },
        
        startTracking: function() {
            // تتبع الوقت
            this.timeTracker = setInterval(() => {
                this.sessionData.timeOnPage = Math.round((Date.now() - this.sessionData.startTime) / 1000);
            }, 1000);
        },
        
        sendActivityData: function() {
            if (!PS.settings.features.analytics) return;
            
            this.updateEngagementScore();
            
            const data = {
                post_id: PS.settings.postId,
                session_id: this.getSessionId(),
                activity_type: 'page_engagement',
                scroll_depth: this.sessionData.scrollDepth,
                time_on_page: this.sessionData.timeOnPage,
                interactions_count: this.sessionData.interactions,
                engagement_score: this.sessionData.engagementScore
            };
            
            // استخدام sendBeacon إذا كان متاحاً للإرسال الموثوق
            if (navigator.sendBeacon) {
                const formData = new FormData();
                formData.append('action', 'ps_track_user_activity');
                formData.append('nonce', PS.settings.nonce);
                
                Object.keys(data).forEach(key => {
                    formData.append(key, data[key]);
                });
                
                navigator.sendBeacon(PS.settings.ajaxUrl, formData);
            } else {
                PS.Ajax.request('ps_track_user_activity', data).catch(error => {
                    console.warn('Activity tracking failed:', error);
                });
            }
        },
        
        getSessionId: function() {
            let sessionId = sessionStorage.getItem('ps_session_id');
            if (!sessionId) {
                sessionId = 'ps_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                sessionStorage.setItem('ps_session_id', sessionId);
            }
            return sessionId;
        }
    };
    
    /**
     * ==== تهيئة الميزات التفاعلية ====
     */
    PS.InteractiveFeatures = {
        init: function() {
            // تهيئة النظم المختلفة حسب الإعدادات
            if (PS.settings.features.bookmarks) {
                PS.Bookmarks.init();
            }
            
            if (PS.settings.features.rating_system) {
                PS.RatingSystem.init();
            }
            
            if (PS.settings.features.share_tracking) {
                PS.SocialSharing.init();
            }
            
            if (PS.settings.features.analytics) {
                PS.UserActivity.init();
            }
            
            PS.Events.emit('interactive-features:ready');
        }
    };
    
    // تهيئة عند جاهزية النظام
    PS.Events.on('ps:ready', () => {
        PS.InteractiveFeatures.init();
    });
    
    // تصدير للنطاق العام
    window.PSInteractiveFeatures = PS.InteractiveFeatures;
    
})(window, document, window.jQuery);

// CSS إضافي للميزات التفاعلية
const interactiveFeaturesCSS = `
<style>
/* نظام المفضلة */
.ps-bookmark-btn {
    background: none;
    border: 2px solid var(--ps-color-primary, #007cba);
    color: var(--ps-color-primary, #007cba);
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.ps-bookmark-btn:hover {
    background: var(--ps-color-primary, #007cba);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,123,186,0.3);
}

.ps-bookmark-btn.bookmarked {
    background: var(--ps-color-primary, #007cba);
    color: white;
    border-color: var(--ps-color-primary, #007cba);
}

.ps-bookmark-btn.bookmarked:hover {
    background: #0056b3;
    border-color: #0056b3;
}

.ps-bookmark-icon {
    font-size: 16px;
    transition: transform 0.3s ease;
}

.ps-bookmark-btn:hover .ps-bookmark-icon {
    transform: scale(1.1);
}

/* نظام التقييمات */
.ps-rating-system {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.ps-rating-stars {
    display: flex;
    gap: 4px;
}

.ps-star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
    user-select: none;
}

.ps-star:hover,
.ps-star.active {
    color: #ffc107;
    transform: scale(1.1);
}

.ps-star.hover-effect {
    color: #ffeb3b;
    transform: scale(1.2);
}

.ps-rating-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ps-rating-average {
    font-weight: 600;
    font-size: 18px;
    color: var(--ps-color-contrast, #1a1a1a);
}

.ps-rating-count {
    font-size: 14px;
    color: var(--ps-color-tertiary, #64748b);
}

.ps-rating-submit {
    background: var(--ps-color-primary, #007cba);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: none;
}

.ps-rating-submit:hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.ps-rating-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.ps-rating-submitted {
    color: var(--ps-color-success, #10b981);
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.ps-rating-submitted::before {
    content: "✓";
    font-weight: bold;
}

/* نظام المشاركة */
.ps-share-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin: 20px 0;
}

.ps-share-btn {
    padding: 10px 15px;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    min-width: 100px;
    justify-content: center;
}

.ps-share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    color: white;
    text-decoration: none;
}

.ps-share-facebook { background: #1877f2; }
.ps-share-facebook:hover { background: #166fe5; }

.ps-share-twitter { background: #1da1f2; }
.ps-share-twitter:hover { background: #1a91da; }

.ps-share-linkedin { background: #0077b5; }
.ps-share-linkedin:hover { background: #006ba1; }

.ps-share-whatsapp { background: #25d366; }
.ps-share-whatsapp:hover { background: #22c55e; }

.ps-share-telegram { background: #0088cc; }
.ps-share-telegram:hover { background: #007bb5; }

.ps-copy-link { 
    background: var(--ps-color-tertiary, #64748b); 
}
.ps-copy-link:hover { 
    background: #4b5563; 
}

/* تحسينات الاستجابة */
@media (max-width: 768px) {
    .ps-rating-system {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .ps-rating-stars {
        align-self: center;
    }
    
    .ps-share-buttons {
        justify-content: center;
    }
    
    .ps-share-btn {
        min-width: 80px;
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .ps-bookmark-btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}

/* تحسينات إمكانية الوصول */
.ps-bookmark-btn:focus,
.ps-rating-submit:focus,
.ps-share-btn:focus {
    outline: 2px solid var(--ps-color-primary, #007cba);
    outline-offset: 2px;
}

.ps-star:focus {
    outline: 2px solid #ffc107;
    outline-offset: 2px;
    border-radius: 4px;
}

/* تأثيرات التحميل */
.ps-rating-submit.loading::after {
    content: "";
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 8px;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', interactiveFeaturesCSS);

📁 اسم الملف: enhanced-ux.css

/* ===== التأثيرات التفاعلية المحسنة ===== */

/* تأثيرات الحركة الناعمة */
.ps-smooth-transition {
    transition: all var(--ps-transition-normal);
}

/* تأثيرات التحويم المحسنة */
.ps-hover-lift {
    transition: transform var(--ps-transition-fast), box-shadow var(--ps-transition-fast);
}

.ps-hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: var(--ps-shadow-lg);
}

.ps-hover-scale {
    transition: transform var(--ps-transition-fast);
}

.ps-hover-scale:hover {
    transform: scale(1.02);
}

/* ===== البحث الصوتي المحسن ===== */

.ps-voice-search-container {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.ps-voice-search-btn {
    background: linear-gradient(135deg, var(--ps-color-primary), #0056b3);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--ps-transition-fast);
    margin-left: 8px;
    box-shadow: var(--ps-shadow-sm);
}

.ps-voice-search-btn:hover {
    transform: scale(1.05);
    box-shadow: var(--ps-shadow-md);
}

.ps-voice-search-btn.listening {
    animation: pulse-red 1.5s infinite;
    background: linear-gradient(135deg, #dc3545, #c82333);
}

.ps-voice-search-btn.processing {
    animation: spin 1s linear infinite;
    background: linear-gradient(135deg, var(--ps-color-warning), #e0a800);
}

@keyframes pulse-red {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ===== اقتراحات البحث المحسنة ===== */

.ps-search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--ps-color-base);
    border: 1px solid var(--ps-color-secondary);
    border-radius: 8px;
    box-shadow: var(--ps-shadow-lg);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
    margin-top: 4px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all var(--ps-transition-fast);
}

.ps-search-suggestions.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.ps-suggestion-item {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    cursor: pointer;
    transition: background-color var(--ps-transition-fast);
    display: flex;
    align-items: center;
    gap: 12px;
}

.ps-suggestion-item:hover,
.ps-suggestion-item.highlighted {
    background-color: var(--ps-color-secondary);
}

.ps-suggestion-item:last-child {
    border-bottom: none;
}

.ps-suggestion-thumbnail {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    object-fit: cover;
    flex-shrink: 0;
}

.ps-suggestion-content {
    flex: 1;
    min-width: 0;
}

.ps-suggestion-title {
    font-weight: 500;
    font-size: var(--ps-font-size-sm);
    color: var(--ps-color-contrast);
    margin: 0 0 4px 0;
    line-height: 1.3;
}

.ps-suggestion-type {
    font-size: var(--ps-font-size-xs);
    color: var(--ps-color-tertiary);
    background: rgba(0,123,186,0.1);
    padding: 2px 6px;
    border-radius: 3px;
    display: inline-block;
}

.ps-suggestion-loading {
    padding: 16px;
    text-align: center;
    color: var(--ps-color-tertiary);
    font-size: var(--ps-font-size-sm);
}

.ps-suggestion-loading::before {
    content: "";
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid var(--ps-color-secondary);
    border-top: 2px solid var(--ps-color-primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 8px;
}

/* ===== نظام التقييمات ===== */

.ps-rating-system {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 16px 0;
}

.ps-rating-stars {
    display: flex;
    gap: 4px;
}

.ps-star {
    font-size: 20px;
    color: #ddd;
    cursor: pointer;
    transition: all var(--ps-transition-fast);
    user-select: none;
}

.ps-star:hover,
.ps-star.active {
    color: #ffc107;
    transform: scale(1.1);
}

.ps-star.hover-effect {
    color: #ffeb3b;
}

.ps-rating-average {
    font-weight: 600;
    font-size: var(--ps-font-size-lg);
    color: var(--ps-color-contrast);
}

.ps-rating-count {
    font-size: var(--ps-font-size-sm);
    color: var(--ps-color-tertiary);
}

.ps-rating-submit {
    background: var(--ps-color-primary);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: var(--ps-font-size-sm);
    cursor: pointer;
    transition: all var(--ps-transition-fast);
}

.ps-rating-submit:hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.ps-rating-submitted {
    color: var(--ps-color-success);
    font-size: var(--ps-font-size-sm);
    font-weight: 500;
}

/* ===== نظام المفضلة (Bookmarks) ===== */

.ps-bookmark-btn {
    background: none;
    border: 2px solid var(--ps-color-primary);
    color: var(--ps-color-primary);
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: var(--ps-font-size-sm);
    font-weight: 500;
    transition: all var(--ps-transition-fast);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.ps-bookmark-btn:hover {
    background: var(--ps-color-primary);
    color: white;
    transform: translateY(-1px);
}

.ps-bookmark-btn.bookmarked {
    background: var(--ps-color-primary);
    color: white;
}

.ps-bookmark-btn.bookmarked:hover {
    background: #0056b3;
}

.ps-bookmark-icon {
    font-size: 16px;
    transition: transform var(--ps-transition-fast);
}

.ps-bookmark-btn:hover .ps-bookmark-icon {
    transform: scale(1.1);
}

/* ===== شريط تقدم القراءة ===== */

.ps-reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--ps-color-primary), var(--ps-color-accent));
    z-index: 9999;
    transition: width 0.1s ease;
}

.ps-reading-time {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: var(--ps-font-size-sm);
    color: var(--ps-color-tertiary);
    margin: 8px 0;
}

.ps-reading-time-icon {
    font-size: 14px;
}

/* ===== نظام المشاركة المحسن ===== */

.ps-share-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin: 16px 0;
}

.ps-share-btn {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: var(--ps-font-size-sm);
    font-weight: 500;
    transition: all var(--ps-transition-fast);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.ps-share-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--ps-shadow-md);
}

.ps-share-facebook { background: #1877f2; }
.ps-share-twitter { background: #1da1f2; }
.ps-share-linkedin { background: #0077b5; }
.ps-share-whatsapp { background: #25d366; }
.ps-share-telegram { background: #0088cc; }
.ps-share-copy { background: var(--ps-color-tertiary); }

.ps-share-count {
    background: rgba(255,255,255,0.2);
    padding: 2px 6px;
    border-radius: 3px;
    font-size: var(--ps-font-size-xs);
}

/* ===== تلميحات الأدوات (Tooltips) ===== */

.ps-tooltip {
    position: absolute;
    background: rgba(0,0,0,0.9);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: var(--ps-font-size-sm);
    white-space: nowrap;
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(5px);
    transition: all var(--ps-transition-fast);
    pointer-events: none;
    max-width: 250px;
    word-wrap: break-word;
    white-space: normal;
}

.ps-tooltip.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.ps-tooltip.below::before {
    content: "";
    position: absolute;
    top: -5px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid rgba(0,0,0,0.9);
}

.ps-tooltip:not(.below)::after {
    content: "";
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid rgba(0,0,0,0.9);
}

/* ===== النوافذ المنبثقة (Modals) ===== */

.ps-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all var(--ps-transition-normal);
}

.ps-modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.ps-modal {
    background: var(--ps-color-base);
    border-radius: 12px;
    padding: 24px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: var(--ps-shadow-xl);
    transform: translateY(-20px) scale(0.95);
    transition: all var(--ps-transition-normal);
}

.ps-modal-overlay.show .ps-modal {
    transform: translateY(0) scale(1);
}

.ps-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--ps-color-secondary);
}

.ps-modal-title {
    font-size: var(--ps-font-size-xl);
    font-weight: 600;
    color: var(--ps-color-contrast);
    margin: 0;
}

.ps-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    transition: color var(--ps-transition-fast);
}

.ps-modal-close:hover {
    color: var(--ps-color-contrast);
}

.ps-modal-body {
    margin-bottom: 16px;
}

.ps-modal-footer {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    padding-top: 16px;
    border-top: 1px solid var(--ps-color-secondary);
}

/* ===== الإشعارات ===== */

.ps-notifications-container {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 10001;
    max-width: 400px;
}

.ps-notification {
    background: var(--ps-color-base);
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
    box-shadow: var(--ps-shadow-lg);
    border-right: 4px solid var(--ps-color-primary);
    transform: translateX(-100%);
    transition: all var(--ps-transition-normal);
    opacity: 0;
}

.ps-notification.show {
    transform: translateX(0);
    opacity: 1;
}

.ps-notification.success {
    border-right-color: var(--ps-color-success);
}

.ps-notification.warning {
    border-right-color: var(--ps-color-warning);
}

.ps-notification.error {
    border-right-color: var(--ps-color-accent);
}

.ps-notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.ps-notification-title {
    font-weight: 600;
    font-size: var(--ps-font-size-sm);
    color: var(--ps-color-contrast);
}

.ps-notification-close {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    font-size: 18px;
}

.ps-notification-message {
    font-size: var(--ps-font-size-sm);
    color: var(--ps-color-tertiary);
    line-height: 1.4;
}

/* ===== التحسينات للوضع المظلم ===== */

[data-theme="dark"] {
    --ps-color-base: #1a1a1a;
    --ps-color-contrast: #ffffff;
    --ps-color-secondary: #2d2d2d;
    --ps-color-tertiary: #a0a0a0;
}

[data-theme="dark"] .ps-search-suggestions {
    background: var(--ps-color-base);
    border-color: var(--ps-color-secondary);
}

[data-theme="dark"] .ps-suggestion-item:hover,
[data-theme="dark"] .ps-suggestion-item.highlighted {
    background-color: var(--ps-color-secondary);
}

[data-theme="dark"] .ps-modal {
    background: var(--ps-color-base);
}

[data-theme="dark"] .ps-notification {
    background: var(--ps-color-base);
}

/* ===== تحسينات الاستجابة ===== */

@media (max-width: 768px) {
    .ps-voice-search-btn {
        width: 40px;
        height: 40px;
    }
    
    .ps-search-suggestions {
        left: -10px;
        right: -10px;
    }
    
    .ps-share-buttons {
        justify-content: center;
    }
    
    .ps-modal {
        margin: 20px;
        padding: 20px;
    }
    
    .ps-notifications-container {
        left: 10px;
        right: 10px;
        max-width: none;
    }
    
    .ps-notification {
        margin-bottom: 8px;
    }
}

/* ===== تحسينات إمكانية الوصول ===== */

.ps-sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0,0,0,0);
    white-space: nowrap;
    border: 0;
}

.ps-focus-visible:focus-visible {
    outline: 2px solid var(--ps-color-primary);
    outline-offset: 2px;
}

/* ===== تحسينات الطباعة ===== */

@media print {
    .ps-voice-search-container,
    .ps-bookmark-btn,
    .ps-share-buttons,
    .ps-reading-progress,
    .ps-modal-overlay,
    .ps-notifications-container {
        display: none !important;
    }
}

📁 اسم الملف: rtl.css

/**
 * RTL Enhanced Support for Practical Solutions Pro
 * دعم محسن للغة العربية واللغات من اليمين لليسار
 */

/* ===== إعدادات أساسية للغة العربية ===== */

[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

[dir="rtl"] body {
    font-family: 'Noto Sans Arabic', 'Segoe UI', Tahoma, Arial, sans-serif;
    line-height: 1.8; /* تحسين المسافة بين الأسطر للعربية */
}

/* ===== تحسين عرض النصوص العربية ===== */

[dir="rtl"] h1, 
[dir="rtl"] h2, 
[dir="rtl"] h3, 
[dir="rtl"] h4, 
[dir="rtl"] h5, 
[dir="rtl"] h6 {
    font-weight: 600;
    line-height: 1.4;
    word-spacing: 0.1em;
}

[dir="rtl"] p {
    line-height: 1.8;
    word-spacing: 0.05em;
}

/* ===== إعكاس التخطيط ===== */

/* الفليكس */
[dir="rtl"] .wp-block-group.alignwide,
[dir="rtl"] .ps-header-brand,
[dir="rtl"] .ps-main-navigation {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-main-navigation .wp-block-navigation__container {
    flex-direction: row-reverse;
}

/* الشبكات */
[dir="rtl"] .wp-block-columns {
    flex-direction: row-reverse;
}

/* ===== إعدادات البحث للعربية ===== */

[dir="rtl"] .ps-search-form {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-search-input {
    text-align: right;
    padding: 12px 45px 12px 16px;
}

[dir="rtl"] .ps-voice-search-btn {
    margin-left: 0;
    margin-right: 8px;
}

[dir="rtl"] .ps-search-suggestions {
    text-align: right;
}

[dir="rtl"] .ps-suggestion-item {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .ps-suggestion-content {
    text-align: right;
}

/* ===== إعدادات الـ Icons للعربية ===== */

[dir="rtl"] .ps-bookmark-icon,
[dir="rtl"] .ps-rating-stars,
[dir="rtl"] .ps-share-buttons {
    flex-direction: row-reverse;
}

/* تعديل اتجاه الأسهم */
[dir="rtl"] .arrow-right::before {
    content: "←";
}

[dir="rtl"] .arrow-left::before {
    content: "→";
}

/* ===== Navigation Menu للعربية ===== */

[dir="rtl"] .wp-block-navigation .wp-block-navigation__submenu-container {
    right: auto;
    left: 0;
}

[dir="rtl"] .wp-block-navigation .has-child .wp-block-navigation-submenu__toggle {
    transform: rotate(180deg);
}

/* ===== تحسين المسافات والهوامش ===== */

[dir="rtl"] .ps-single-content,
[dir="rtl"] .ps-archive-content {
    margin-right: 0;
    margin-left: auto;
}

[dir="rtl"] .ps-sidebar {
    margin-left: 0;
    margin-right: 2rem;
}

/* ===== تحسين عرض التاريخ والأرقام ===== */

[dir="rtl"] .ps-post-date,
[dir="rtl"] .ps-reading-time {
    direction: ltr;
    text-align: left;
    unicode-bidi: embed;
}

/* الأرقام العربية الهندية (اختياري) */
.arabic-numbers {
    font-feature-settings: "lnum" 0;
}

/* الأرقام الإنجليزية (افتراضي) */
.english-numbers {
    font-feature-settings: "lnum" 1;
}

/* ===== تحسين النماذج للعربية ===== */

[dir="rtl"] input[type="text"],
[dir="rtl"] input[type="email"],
[dir="rtl"] input[type="search"],
[dir="rtl"] textarea {
    text-align: right;
    direction: rtl;
}

[dir="rtl"] input[type="url"],
[dir="rtl"] input[type="email"] {
    direction: ltr;
    text-align: left;
}

/* ===== Labels للنماذج ===== */

[dir="rtl"] label {
    text-align: right;
}

[dir="rtl"] .ps-form-group {
    text-align: right;
}

/* ===== تحسين القوائم ===== */

[dir="rtl"] ul,
[dir="rtl"] ol {
    padding-right: 2rem;
    padding-left: 0;
}

[dir="rtl"] li {
    text-align: right;
}

/* ===== تحسين الجداول ===== */

[dir="rtl"] table {
    direction: rtl;
}

[dir="rtl"] th,
[dir="rtl"] td {
    text-align: right;
}

/* الجداول التي تحتوي أرقام */
[dir="rtl"] .numbers-table th,
[dir="rtl"] .numbers-table td {
    text-align: center;
    direction: ltr;
}

/* ===== تحسين الاقتباسات ===== */

[dir="rtl"] blockquote {
    border-right: 4px solid var(--ps-color-primary);
    border-left: none;
    padding-right: 1.5rem;
    padding-left: 0;
    margin-right: 0;
    margin-left: 2rem;
}

[dir="rtl"] blockquote::before {
    content: """;
    right: -0.5rem;
    left: auto;
}

[dir="rtl"] blockquote::after {
    content: """;
    left: auto;
    right: -0.5rem;
}

/* ===== تحسين الـ Code Blocks ===== */

[dir="rtl"] code,
[dir="rtl"] pre {
    direction: ltr;
    text-align: left;
    font-family: 'Courier New', Consolas, monospace;
}

[dir="rtl"] .wp-block-code {
    direction: ltr;
    text-align: left;
}

/* ===== تحسين Gallery والصور ===== */

[dir="rtl"] .wp-block-gallery {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-image-caption {
    text-align: right;
}

/* ===== تحسين الأزرار ===== */

[dir="rtl"] .wp-block-buttons {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-btn-with-icon {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-btn-icon {
    margin-left: 0;
    margin-right: 8px;
}

/* ===== تحسين التصنيفات والوسوم ===== */

[dir="rtl"] .ps-post-terms {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-post-terms a {
    margin-right: 0;
    margin-left: 8px;
}

/* ===== تحسين التعليقات ===== */

[dir="rtl"] .comment-list {
    padding-right: 0;
    padding-left: 0;
}

[dir="rtl"] .comment-body {
    margin-right: 0;
    margin-left: 60px;
}

[dir="rtl"] .comment-author img {
    float: right;
    margin-left: 0;
    margin-right: 15px;
}

/* ===== تحسين التنقل والصفحات ===== */

[dir="rtl"] .page-numbers {
    flex-direction: row-reverse;
}

[dir="rtl"] .page-numbers .next {
    margin-right: auto;
    margin-left: 0;
}

[dir="rtl"] .page-numbers .prev {
    margin-left: auto;
    margin-right: 0;
}

/* ===== تحسين Breadcrumbs ===== */

[dir="rtl"] .ps-breadcrumbs {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-breadcrumb-item::after {
    content: "‹";
    margin: 0 0.5rem;
}

[dir="rtl"] .ps-breadcrumb-item:last-child::after {
    display: none;
}

/* ===== تحسين الـ Dropdowns ===== */

[dir="rtl"] .ps-dropdown {
    right: 0;
    left: auto;
}

[dir="rtl"] .ps-dropdown-toggle::after {
    transform: rotate(270deg);
}

/* ===== تحسين الـ Modals للعربية ===== */

[dir="rtl"] .ps-modal-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-modal-footer {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-modal-close {
    left: auto;
    right: 24px;
}

/* ===== تحسين الإشعارات ===== */

[dir="rtl"] .ps-notifications-container {
    left: auto;
    right: 20px;
}

[dir="rtl"] .ps-notification {
    border-right: none;
    border-left: 4px solid var(--ps-color-primary);
    transform: translateX(100%);
}

[dir="rtl"] .ps-notification.show {
    transform: translateX(0);
}

[dir="rtl"] .ps-notification-header {
    flex-direction: row-reverse;
}

/* ===== تحسين القوائم الجانبية ===== */

[dir="rtl"] .ps-widget {
    text-align: right;
}

[dir="rtl"] .ps-widget ul {
    list-style-position: inside;
}

/* ===== تحسين Footer ===== */

[dir="rtl"] .ps-footer-content {
    flex-direction: row-reverse;
}

[dir="rtl"] .ps-social-links {
    flex-direction: row-reverse;
}

/* ===== تحسين الخطوط العربية المتقدمة ===== */

/* تحسين عرض النص للقراءة */
[dir="rtl"] .ps-article-content {
    font-size: 18px;
    line-height: 2;
    letter-spacing: 0.025em;
}

/* تحسين العناوين العربية */
[dir="rtl"] .ps-section-title {
    font-weight: 700;
    letter-spacing: -0.025em;
}

/* تحسين النصوص الطويلة */
[dir="rtl"] .ps-long-text {
    hyphens: auto;
    word-break: break-word;
    overflow-wrap: break-word;
}

/* ===== تحسين الكلمات المختلطة (عربي + إنجليزي) ===== */

.mixed-content {
    direction: rtl;
    unicode-bidi: embed;
}

.mixed-content .english {
    direction: ltr;
    unicode-bidi: embed;
    display: inline-block;
}

/* ===== تحسين أرقام الصفحات والتواريخ ===== */

[dir="rtl"] .page-number,
[dir="rtl"] .post-date,
[dir="rtl"] .comment-date {
    direction: ltr;
    unicode-bidi: embed;
    font-feature-settings: "tnum" 1;
}

/* ===== تحسين الاستجابة للشاشات الصغيرة ===== */

@media (max-width: 768px) {
    [dir="rtl"] .ps-mobile-menu {
        right: 0;
        left: auto;
        transform: translateX(100%);
    }
    
    [dir="rtl"] .ps-mobile-menu.open {
        transform: translateX(0);
    }
    
    [dir="rtl"] .ps-search-input {
        padding: 10px 40px 10px 12px;
    }
    
    [dir="rtl"] .ps-voice-search-btn {
        left: 8px;
        right: auto;
    }
}

/* ===== تحسين للوضع المظلم مع RTL ===== */

[dir="rtl"][data-theme="dark"] .ps-notification {
    border-left-color: var(--ps-color-primary);
}

[dir="rtl"][data-theme="dark"] blockquote {
    border-right-color: var(--ps-color-primary);
}

/* ===== تحسين إمكانية الوصول للعربية ===== */

[dir="rtl"] .ps-skip-link {
    right: -9999px;
    left: auto;
}

[dir="rtl"] .ps-skip-link:focus {
    right: 6px;
    left: auto;
}

/* ===== تحسين التحديد النصي ===== */

[dir="rtl"] ::selection {
    background: rgba(0, 123, 186, 0.2);
    direction: rtl;
}

[dir="rtl"] ::-moz-selection {
    background: rgba(0, 123, 186, 0.2);
    direction: rtl;
}

/* ===== تحسين التمرير ===== */

[dir="rtl"] .ps-scroll-indicator {
    right: 0;
    left: auto;
}

/* ===== تحسين خاص بالمتصفحات ===== */

/* Firefox */
@-moz-document url-prefix() {
    [dir="rtl"] input[type="search"] {
        text-align: right;
    }
}

/* Safari */
@supports (-webkit-appearance: none) {
    [dir="rtl"] .ps-search-input {
        -webkit-appearance: none;
        text-align: right;
    }
}

/* ===== تحسين الطباعة للعربية ===== */

@media print {
    [dir="rtl"] {
        direction: rtl;
    }
    
    [dir="rtl"] .ps-article-content {
        font-size: 14pt;
        line-height: 1.6;
    }
    
    [dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3 {
        page-break-after: avoid;
    }
}

📁 اسم الملف: advanced-analytics.php
<?php
/**
 * Advanced Analytics System for Practical Solutions Pro
 * نظام التحليلات المتقدمة للحلول العملية الاحترافية
 * المكان: /inc/advanced-analytics.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Advanced_Analytics {
    
    private $table_analytics;
    private $table_user_activity;
    private $table_search_analytics;
    private $table_content_performance;
    
    public function __construct() {
        global $wpdb;
        $this->table_analytics = $wpdb->prefix . 'ps_analytics';
        $this->table_user_activity = $wpdb->prefix . 'ps_user_activity';
        $this->table_search_analytics = $wpdb->prefix . 'ps_search_analytics';
        $this->table_content_performance = $wpdb->prefix . 'ps_content_performance';
        
        add_action('init', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'create_analytics_tables'));
    }
    
    /**
     * ==== التهيئة ====
     */
    public function init() {
        // AJAX handlers
        add_action('wp_ajax_ps_track_user_activity', array($this, 'handle_track_user_activity'));
        add_action('wp_ajax_nopriv_ps_track_user_activity', array($this, 'handle_track_user_activity'));
        
        add_action('wp_ajax_ps_track_search_activity', array($this, 'handle_track_search_activity'));
        add_action('wp_ajax_nopriv_ps_track_search_activity', array($this, 'handle_track_search_activity'));
        
        add_action('wp_ajax_ps_get_analytics_data', array($this, 'handle_get_analytics_data'));
        add_action('wp_ajax_ps_get_content_performance', array($this, 'handle_get_content_performance'));
        
        // Hooks للتتبع التلقائي
        add_action('wp_footer', array($this, 'inject_tracking_script'));
        add_action('wp_head', array($this, 'inject_tracking_metadata'));
        
        // تتبع أحداث WordPress
        add_action('wp_insert_comment', array($this, 'track_comment_activity'));
        add_action('transition_post_status', array($this, 'track_post_status_change'), 10, 3);
        
        // تنظيف البيانات القديمة
        add_action('ps_cleanup_analytics', array($this, 'cleanup_old_analytics_data'));
        if (!wp_next_scheduled('ps_cleanup_analytics')) {
            wp_schedule_event(time(), 'daily', 'ps_cleanup_analytics');
        }
    }
    
    /**
     * ==== إنشاء جداول التحليلات ====
     */
    public function create_analytics_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول التحليلات العامة
        $sql_analytics = "CREATE TABLE {$this->table_analytics} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            event_type varchar(50) NOT NULL,
            event_action varchar(100) NOT NULL,
            event_value longtext NULL,
            user_id bigint(20) NULL,
            session_id varchar(100) NOT NULL,
            ip_address varchar(45) NOT NULL,
            user_agent text NOT NULL,
            page_url text NOT NULL,
            referrer_url text NULL,
            utm_source varchar(100) NULL,
            utm_medium varchar(100) NULL,
            utm_campaign varchar(100) NULL,
            device_type varchar(20) NOT NULL DEFAULT 'desktop',
            browser varchar(50) NULL,
            operating_system varchar(50) NULL,
            country varchar(5) NULL,
            city varchar(100) NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_event_type (event_type),
            INDEX idx_session_id (session_id),
            INDEX idx_user_id (user_id),
            INDEX idx_created_at (created_at),
            INDEX idx_page_url (page_url(100))
        ) $charset_collate;";
        
        // جدول نشاط المستخدمين
        $sql_user_activity = "CREATE TABLE {$this->table_user_activity} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NULL,
            session_id varchar(100) NOT NULL,
            post_id bigint(20) NULL,
            activity_type varchar(50) NOT NULL,
            scroll_depth float DEFAULT 0,
            time_on_page int DEFAULT 0,
            interactions_count int DEFAULT 0,
            reading_progress float DEFAULT 0,
            mouse_movements int DEFAULT 0,
            clicks_count int DEFAULT 0,
            form_interactions int DEFAULT 0,
            search_interactions int DEFAULT 0,
            social_shares int DEFAULT 0,
            bookmarks_added int DEFAULT 0,
            comments_posted int DEFAULT 0,
            engagement_score float DEFAULT 0,
            bounce_rate float DEFAULT 0,
            return_visitor boolean DEFAULT FALSE,
            device_info text NULL,
            location_data text NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_user_id (user_id),
            INDEX idx_session_id (session_id),
            INDEX idx_post_id (post_id),
            INDEX idx_activity_type (activity_type),
            INDEX idx_created_at (created_at)
        ) $charset_collate;";
        
        // جدول تحليلات البحث
        $sql_search_analytics = "CREATE TABLE {$this->table_search_analytics} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_query varchar(255) NOT NULL,
            search_type varchar(50) NOT NULL DEFAULT 'regular',
            results_count int DEFAULT 0,
            user_id bigint(20) NULL,
            session_id varchar(100) NOT NULL,
            clicked_result_id bigint(20) NULL,
            clicked_result_position int NULL,
            time_to_click int NULL,
            search_refinements int DEFAULT 0,
            voice_search boolean DEFAULT FALSE,
            ai_suggestions_used boolean DEFAULT FALSE,
            search_success boolean DEFAULT FALSE,
            user_satisfaction_score float NULL,
            search_intent varchar(100) NULL,
            search_category varchar(100) NULL,
            geographic_location varchar(100) NULL,
            device_type varchar(20) NOT NULL DEFAULT 'desktop',
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_search_query (search_query),
            INDEX idx_search_type (search_type),
            INDEX idx_user_id (user_id),
            INDEX idx_session_id (session_id),
            INDEX idx_created_at (created_at),
            FULLTEXT idx_search_content (search_query, search_intent, search_category)
        ) $charset_collate;";
        
        // جدول أداء المحتوى
        $sql_content_performance = "CREATE TABLE {$this->table_content_performance} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            date_tracked date NOT NULL,
            views_count int DEFAULT 0,
            unique_views int DEFAULT 0,
            avg_time_on_page float DEFAULT 0,
            avg_scroll_depth float DEFAULT 0,
            bounce_rate float DEFAULT 0,
            engagement_rate float DEFAULT 0,
            social_shares_total int DEFAULT 0,
            facebook_shares int DEFAULT 0,
            twitter_shares int DEFAULT 0,
            linkedin_shares int DEFAULT 0,
            whatsapp_shares int DEFAULT 0,
            telegram_shares int DEFAULT 0,
            email_shares int DEFAULT 0,
            bookmarks_count int DEFAULT 0,
            comments_count int DEFAULT 0,
            ratings_average float DEFAULT 0,
            ratings_count int DEFAULT 0,
            search_impressions int DEFAULT 0,
            search_clicks int DEFAULT 0,
            search_ctr float DEFAULT 0,
            organic_traffic int DEFAULT 0,
            referral_traffic int DEFAULT 0,
            direct_traffic int DEFAULT 0,
            social_traffic int DEFAULT 0,
            conversion_rate float DEFAULT 0,
            revenue_generated decimal(10,2) DEFAULT 0,
            performance_score float DEFAULT 0,
            quality_score float DEFAULT 0,
            user_satisfaction float DEFAULT 0,
            mobile_views_percentage float DEFAULT 0,
            top_referrers text NULL,
            top_search_terms text NULL,
            user_demographics text NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_post_date (post_id, date_tracked),
            INDEX idx_post_id (post_id),
            INDEX idx_date_tracked (date_tracked),
            INDEX idx_performance_score (performance_score),
            INDEX idx_views_count (views_count)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_analytics);
        dbDelta($sql_user_activity);
        dbDelta($sql_search_analytics);
        dbDelta($sql_content_performance);
        
        // إضافة إعدادات افتراضية
        add_option('ps_analytics_version', '1.0');
        add_option('ps_analytics_settings', array(
            'track_user_activity' => true,
            'track_search_analytics' => true,
            'track_content_performance' => true,
            'anonymize_ip' => true,
            'data_retention_days' => 365,
            'real_time_tracking' => true,
            'advanced_metrics' => true
        ));
    }
    
    /**
     * ==== تتبع نشاط المستخدم ====
     */
    public function handle_track_user_activity() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $activity_data = array(
            'user_id' => get_current_user_id() ?: null,
            'session_id' => sanitize_text_field($_POST['session_id'] ?? ''),
            'post_id' => intval($_POST['post_id'] ?? 0),
            'activity_type' => sanitize_text_field($_POST['activity_type'] ?? 'page_view'),
            'scroll_depth' => floatval($_POST['scroll_depth'] ?? 0),
            'time_on_page' => intval($_POST['time_on_page'] ?? 0),
            'interactions_count' => intval($_POST['interactions_count'] ?? 0),
            'reading_progress' => floatval($_POST['reading_progress'] ?? 0),
            'mouse_movements' => intval($_POST['mouse_movements'] ?? 0),
            'clicks_count' => intval($_POST['clicks_count'] ?? 0),
            'engagement_score' => floatval($_POST['engagement_score'] ?? 0),
            'device_info' => json_encode($_POST['device_info'] ?? array()),
            'location_data' => json_encode($_POST['location_data'] ?? array())
        );
        
        try {
            $result = $this->save_user_activity($activity_data);
            if ($result) {
                wp_send_json_success(array('activity_id' => $result));
            } else {
                wp_send_json_error(__('فشل في حفظ النشاط', 'practical-solutions'));
            }
        } catch (Exception $e) {
            error_log('User Activity Tracking Error: ' . $e->getMessage());
            wp_send_json_error(__('حدث خطأ في التتبع', 'practical-solutions'));
        }
    }
    
    /**
     * ==== حفظ نشاط المستخدم ====
     */
    public function save_user_activity($data) {
        global $wpdb;
        
        // التحقق من وجود نشاط سابق في نفس الجلسة
        $existing_activity = $wpdb->get_row($wpdb->prepare(
            "SELECT id FROM {$this->table_user_activity} 
             WHERE session_id = %s AND post_id = %d AND activity_type = %s 
             ORDER BY created_at DESC LIMIT 1",
            $data['session_id'],
            $data['post_id'],
            $data['activity_type']
        ));
        
        if ($existing_activity) {
            // تحديث النشاط الموجود
            return $wpdb->update(
                $this->table_user_activity,
                $data,
                array('id' => $existing_activity->id),
                array('%d', '%s', '%d', '%s', '%f', '%d', '%d', '%f', '%d', '%d', '%f', '%s', '%s'),
                array('%d')
            );
        } else {
            // إنشاء نشاط جديد
            $result = $wpdb->insert(
                $this->table_user_activity,
                $data,
                array('%d', '%s', '%d', '%s', '%f', '%d', '%d', '%f', '%d', '%d', '%f', '%s', '%s')
            );
            
            return $result ? $wpdb->insert_id : false;
        }
    }
    
    /**
     * ==== تتبع نشاط البحث ====
     */
    public function handle_track_search_activity() {
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $search_data = array(
            'search_query' => sanitize_text_field($_POST['search_query'] ?? ''),
            'search_type' => sanitize_text_field($_POST['search_type'] ?? 'regular'),
            'results_count' => intval($_POST['results_count'] ?? 0),
            'user_id' => get_current_user_id() ?: null,
            'session_id' => sanitize_text_field($_POST['session_id'] ?? ''),
            'clicked_result_id' => intval($_POST['clicked_result_id'] ?? 0) ?: null,
            'clicked_result_position' => intval($_POST['clicked_result_position'] ?? 0) ?: null,
            'time_to_click' => intval($_POST['time_to_click'] ?? 0) ?: null,
            'search_refinements' => intval($_POST['search_refinements'] ?? 0),
            'voice_search' => boolval($_POST['voice_search'] ?? false),
            'ai_suggestions_used' => boolval($_POST['ai_suggestions_used'] ?? false),
            'search_success' => boolval($_POST['search_success'] ?? false),
            'search_intent' => sanitize_text_field($_POST['search_intent'] ?? ''),
            'search_category' => sanitize_text_field($_POST['search_category'] ?? ''),
            'device_type' => sanitize_text_field($_POST['device_type'] ?? 'desktop')
        );
        
        try {
            $result = $this->save_search_activity($search_data);
            wp_send_json_success(array('search_id' => $result));
        } catch (Exception $e) {
            error_log('Search Activity Tracking Error: ' . $e->getMessage());
            wp_send_json_error(__('حدث خطأ في تتبع البحث', 'practical-solutions'));
        }
    }
    
    /**
     * ==== حفظ نشاط البحث ====
     */
    public function save_search_activity($data) {
        global $wpdb;
        
        $result = $wpdb->insert(
            $this->table_search_analytics,
            $data,
            array('%s', '%s', '%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%s', '%s')
        );
        
        if ($result) {
            // تحديث إحصائيات البحث الفورية
            $this->update_search_statistics($data['search_query']);
            return $wpdb->insert_id;
        }
        
        return false;
    }
    
    /**
     * ==== تحديث إحصائيات البحث ====
     */
    private function update_search_statistics($query) {
        // زيادة عداد البحثات الشائعة
        $popular_searches = get_option('ps_popular_searches', array());
        
        if (isset($popular_searches[$query])) {
            $popular_searches[$query]++;
        } else {
            $popular_searches[$query] = 1;
        }
        
        // ترتيب وحفظ أفضل 100 بحث
        arsort($popular_searches);
        $popular_searches = array_slice($popular_searches, 0, 100, true);
        update_option('ps_popular_searches', $popular_searches);
    }
    
    /**
     * ==== تتبع أداء المحتوى ====
     */
    public function track_content_performance($post_id, $metrics = array()) {
        global $wpdb;
        
        $today = current_time('Y-m-d');
        
        // البحث عن سجل اليوم
        $existing_record = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM {$this->table_content_performance} 
             WHERE post_id = %d AND date_tracked = %s",
            $post_id,
            $today
        ));
        
        if ($existing_record) {
            // تحديث السجل الموجود
            $update_data = array();
            foreach ($metrics as $metric => $value) {
                if (in_array($metric, array('views_count', 'unique_views', 'social_shares_total', 'bookmarks_count'))) {
                    $update_data[$metric] = $existing_record->$metric + $value;
                } elseif (in_array($metric, array('avg_time_on_page', 'avg_scroll_depth', 'engagement_rate'))) {
                    // حساب المتوسط الجديد
                    $current_views = max($existing_record->views_count, 1);
                    $update_data[$metric] = (($existing_record->$metric * $current_views) + $value) / ($current_views + 1);
                } else {
                    $update_data[$metric] = $value;
                }
            }
            
            if (!empty($update_data)) {
                $wpdb->update(
                    $this->table_content_performance,
                    $update_data,
                    array('id' => $existing_record->id)
                );
            }
        } else {
            // إنشاء سجل جديد
            $default_data = array(
                'post_id' => $post_id,
                'date_tracked' => $today,
                'views_count' => 0,
                'unique_views' => 0,
                'avg_time_on_page' => 0,
                'avg_scroll_depth' => 0,
                'bounce_rate' => 0,
                'engagement_rate' => 0,
                'social_shares_total' => 0,
                'bookmarks_count' => 0,
                'comments_count' => 0,
                'performance_score' => 0
            );
            
            $insert_data = array_merge($default_data, $metrics);
            
            $wpdb->insert(
                $this->table_content_performance,
                $insert_data
            );
        }
        
        // حساب نقاط الأداء
        $this->calculate_performance_score($post_id);
    }
    
    /**
     * ==== حساب نقاط الأداء ====
     */
    private function calculate_performance_score($post_id) {
        global $wpdb;
        
        $metrics = $wpdb->get_row($wpdb->prepare(
            "SELECT AVG(views_count) as avg_views,
                    AVG(avg_time_on_page) as avg_time,
                    AVG(avg_scroll_depth) as avg_scroll,
                    AVG(engagement_rate) as avg_engagement,
                    AVG(social_shares_total) as avg_shares
             FROM {$this->table_content_performance} 
             WHERE post_id = %d AND date_tracked >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)",
            $post_id
        ));
        
        if ($metrics) {
            // معادلة حساب النقاط (من 0 إلى 100)
            $views_score = min(($metrics->avg_views / 100) * 25, 25);
            $time_score = min(($metrics->avg_time / 300) * 20, 20); // 5 دقائق = نقاط كاملة
            $scroll_score = min($metrics->avg_scroll * 20, 20); // 100% تمرير = نقاط كاملة
            $engagement_score = min($metrics->avg_engagement * 25, 25);
            $social_score = min(($metrics->avg_shares / 10) * 10, 10); // 10 مشاركات = نقاط كاملة
            
            $total_score = $views_score + $time_score + $scroll_score + $engagement_score + $social_score;
            
            // تحديث نقاط الأداء
            $wpdb->update(
                $this->table_content_performance,
                array('performance_score' => round($total_score, 2)),
                array('post_id' => $post_id, 'date_tracked' => current_time('Y-m-d'))
            );
            
            // حفظ في meta للوصول السريع
            update_post_meta($post_id, '_ps_performance_score', round($total_score, 2));
        }
    }
    
    /**
     * ==== الحصول على بيانات التحليلات ====
     */
    public function handle_get_analytics_data() {
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $report_type = sanitize_text_field($_POST['report_type'] ?? 'overview');
        $date_range = sanitize_text_field($_POST['date_range'] ?? '30');
        $filters = $_POST['filters'] ?? array();
        
        try {
            $data = $this->get_analytics_report($report_type, $date_range, $filters);
            wp_send_json_success($data);
        } catch (Exception $e) {
            error_log('Analytics Data Error: ' . $e->getMessage());
            wp_send_json_error(__('حدث خطأ في جلب البيانات', 'practical-solutions'));
        }
    }
    
    /**
     * ==== إنشاء تقرير التحليلات ====
     */
    public function get_analytics_report($type, $date_range, $filters = array()) {
        global $wpdb;
        
        $date_condition = $this->build_date_condition($date_range);
        
        switch ($type) {
            case 'overview':
                return $this->get_overview_report($date_condition);
            case 'user_behavior':
                return $this->get_user_behavior_report($date_condition, $filters);
            case 'search_analytics':
                return $this->get_search_analytics_report($date_condition, $filters);
            case 'content_performance':
                return $this->get_content_performance_report($date_condition, $filters);
            case 'real_time':
                return $this->get_real_time_report();
            default:
                return array('error' => 'نوع التقرير غير معروف');
        }
    }
    
    /**
     * ==== تقرير نظرة عامة ====
     */
    private function get_overview_report($date_condition) {
        global $wpdb;
        
        $data = array();
        
        // إحصائيات أساسية
        $data['basic_stats'] = $wpdb->get_row("
            SELECT 
                COUNT(DISTINCT session_id) as total_sessions,
                COUNT(DISTINCT user_id) as total_users,
                COUNT(*) as total_page_views,
                AVG(time_on_page) as avg_session_duration,
                AVG(scroll_depth) as avg_scroll_depth,
                AVG(interactions_count) as avg_interactions
            FROM {$this->table_user_activity} 
            WHERE $date_condition
        ");
        
        // أفضل المحتوى
        $data['top_content'] = $wpdb->get_results("
            SELECT 
                cp.post_id,
                p.post_title,
                cp.views_count,
                cp.avg_time_on_page,
                cp.social_shares_total,
                cp.performance_score
            FROM {$this->table_content_performance} cp
            LEFT JOIN {$wpdb->posts} p ON cp.post_id = p.ID
            WHERE cp.date_tracked >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            ORDER BY cp.performance_score DESC
            LIMIT 10
        ");
        
        // الكلمات المفتاحية الشائعة
        $data['popular_searches'] = $wpdb->get_results("
            SELECT 
                search_query,
                COUNT(*) as search_count,
                AVG(results_count) as avg_results,
                SUM(CASE WHEN search_success THEN 1 ELSE 0 END) as success_count
            FROM {$this->table_search_analytics}
            WHERE $date_condition
            GROUP BY search_query
            ORDER BY search_count DESC
            LIMIT 15
        ");
        
        // إحصائيات الأجهزة
        $data['device_stats'] = $wpdb->get_results("
            SELECT 
                device_type,
                COUNT(*) as count,
                AVG(time_on_page) as avg_time
            FROM {$this->table_user_activity}
            WHERE $date_condition
            GROUP BY device_type
        ");
        
        // الاتجاهات اليومية
        $data['daily_trends'] = $wpdb->get_results("
            SELECT 
                DATE(created_at) as date,
                COUNT(DISTINCT session_id) as sessions,
                COUNT(*) as page_views,
                AVG(time_on_page) as avg_time
            FROM {$this->table_user_activity}
            WHERE $date_condition
            GROUP BY DATE(created_at)
            ORDER BY date DESC
            LIMIT 30
        ");
        
        return $data;
    }
    
    /**
     * ==== تقرير سلوك المستخدمين ====
     */
    private function get_user_behavior_report($date_condition, $filters) {
        global $wpdb;
        
        $data = array();
        
        // معدلات التفاعل
        $data['engagement_metrics'] = $wpdb->get_row("
            SELECT 
                AVG(scroll_depth) as avg_scroll,
                AVG(time_on_page) as avg_time,
                AVG(interactions_count) as avg_interactions,
                AVG(engagement_score) as avg_engagement,
                COUNT(CASE WHEN scroll_depth > 0.7 THEN 1 END) / COUNT(*) * 100 as deep_readers_percent,
                COUNT(CASE WHEN time_on_page > 120 THEN 1 END) / COUNT(*) * 100 as engaged_users_percent
            FROM {$this->table_user_activity}
            WHERE $date_condition
        ");
        
        // مسارات المستخدمين
        $data['user_flows'] = $wpdb->get_results("
            SELECT 
                ua1.post_id as from_post,
                ua2.post_id as to_post,
                p1.post_title as from_title,
                p2.post_title as to_title,
                COUNT(*) as transition_count
            FROM {$this->table_user_activity} ua1
            JOIN {$this->table_user_activity} ua2 ON ua1.session_id = ua2.session_id 
                AND ua2.created_at > ua1.created_at
            LEFT JOIN {$wpdb->posts} p1 ON ua1.post_id = p1.ID
            LEFT JOIN {$wpdb->posts} p2 ON ua2.post_id = p2.ID
            WHERE ua1.$date_condition
                AND ua1.post_id != ua2.post_id
            GROUP BY ua1.post_id, ua2.post_id
            HAVING transition_count > 5
            ORDER BY transition_count DESC
            LIMIT 20
        ");
        
        // أوقات النشاط
        $data['activity_hours'] = $wpdb->get_results("
            SELECT 
                HOUR(created_at) as hour,
                COUNT(*) as activity_count,
                AVG(engagement_score) as avg_engagement
            FROM {$this->table_user_activity}
            WHERE $date_condition
            GROUP BY HOUR(created_at)
            ORDER BY hour
        ");
        
        return $data;
    }
    
    /**
     * ==== حقن سكريبت التتبع ====
     */
    public function inject_tracking_script() {
        if (!get_option('ps_analytics_settings')['track_user_activity']) {
            return;
        }
        
        $session_id = $this->get_or_create_session_id();
        $post_id = get_the_ID() ?: 0;
        
        ?>
        <script>
        (function() {
            'use strict';
            
            // متغيرات التتبع
            const trackingData = {
                sessionId: '<?php echo esc_js($session_id); ?>',
                postId: <?php echo $post_id; ?>,
                startTime: Date.now(),
                scrollDepth: 0,
                interactions: 0,
                mouseMovements: 0,
                clicks: 0,
                lastActivityTime: Date.now()
            };
            
            // تتبع عمق التمرير
            function trackScrollDepth() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollDepth = documentHeight > 0 ? scrollTop / documentHeight : 0;
                
                trackingData.scrollDepth = Math.max(trackingData.scrollDepth, scrollDepth);
                trackingData.lastActivityTime = Date.now();
            }
            
            // تتبع حركات الماوس
            function trackMouseMovement() {
                trackingData.mouseMovements++;
                trackingData.lastActivityTime = Date.now();
            }
            
            // تتبع النقرات
            function trackClicks() {
                trackingData.clicks++;
                trackingData.interactions++;
                trackingData.lastActivityTime = Date.now();
            }
            
            // إرسال البيانات
            function sendTrackingData() {
                const timeOnPage = Math.round((Date.now() - trackingData.startTime) / 1000);
                const engagementScore = calculateEngagementScore();
                
                const data = {
                    action: 'ps_track_user_activity',
                    nonce: psSettings.nonce,
                    session_id: trackingData.sessionId,
                    post_id: trackingData.postId,
                    activity_type: 'page_engagement',
                    scroll_depth: trackingData.scrollDepth,
                    time_on_page: timeOnPage,
                    interactions_count: trackingData.interactions,
                    mouse_movements: trackingData.mouseMovements,
                    clicks_count: trackingData.clicks,
                    engagement_score: engagementScore,
                    device_info: getDeviceInfo()
                };
                
                if (navigator.sendBeacon) {
                    const formData = new FormData();
                    Object.keys(data).forEach(key => formData.append(key, data[key]));
                    navigator.sendBeacon(psSettings.ajaxUrl, formData);
                } else {
                    fetch(psSettings.ajaxUrl, {
                        method: 'POST',
                        body: new URLSearchParams(data),
                        credentials: 'same-origin'
                    }).catch(console.error);
                }
            }
            
            // حساب نقاط التفاعل
            function calculateEngagementScore() {
                const timeWeight = Math.min(trackingData.lastActivityTime - trackingData.startTime, 300000) / 300000; // 5 دقائق كحد أقصى
                const scrollWeight = trackingData.scrollDepth;
                const interactionWeight = Math.min(trackingData.interactions / 10, 1);
                
                return Math.round((timeWeight * 0.4 + scrollWeight * 0.4 + interactionWeight * 0.2) * 100);
            }
            
            // معلومات الجهاز
            function getDeviceInfo() {
                return JSON.stringify({
                    screen: screen.width + 'x' + screen.height,
                    viewport: window.innerWidth + 'x' + window.innerHeight,
                    userAgent: navigator.userAgent,
                    language: navigator.language,
                    platform: navigator.platform,
                    cookieEnabled: navigator.cookieEnabled,
                    onlineStatus: navigator.onLine
                });
            }
            
            // ربط الأحداث
            window.addEventListener('scroll', PS.Utils.throttle(trackScrollDepth, 250));
            document.addEventListener('mousemove', PS.Utils.throttle(trackMouseMovement, 1000));
            document.addEventListener('click', trackClicks);
            
            // إرسال البيانات قبل مغادرة الصفحة
            window.addEventListener('beforeunload', sendTrackingData);
            
            // إرسال دوري للبيانات
            setInterval(sendTrackingData, 30000); // كل 30 ثانية
            
        })();
        </script>
        <?php
    }
    
    /**
     * ==== إنشاء أو الحصول على معرف الجلسة ====
     */
    private function get_or_create_session_id() {
        if (isset($_COOKIE['ps_session_id'])) {
            return sanitize_text_field($_COOKIE['ps_session_id']);
        }
        
        $session_id = wp_generate_uuid4();
        setcookie('ps_session_id', $session_id, time() + (30 * 24 * 60 * 60), '/'); // 30 يوم
        
        return $session_id;
    }
    
    /**
     * ==== إضافة بيانات تعريفية للتتبع ====
     */
    public function inject_tracking_metadata() {
        if (is_single()) {
            $post_id = get_the_ID();
            echo '<meta name="ps-post-id" content="' . $post_id . '">';
            echo '<meta name="ps-post-type" content="' . get_post_type() . '">';
            
            $categories = get_the_category();
            if ($categories) {
                echo '<meta name="ps-post-category" content="' . esc_attr($categories[0]->name) . '">';
            }
        }
    }
    
    /**
     * ==== تنظيف البيانات القديمة ====
     */
    public function cleanup_old_analytics_data() {
        global $wpdb;
        
        $retention_days = get_option('ps_analytics_settings')['data_retention_days'] ?? 365;
        
        $tables = array(
            $this->table_analytics,
            $this->table_user_activity,
            $this->table_search_analytics
        );
        
        foreach ($tables as $table) {
            $wpdb->query($wpdb->prepare(
                "DELETE FROM $table WHERE created_at < DATE_SUB(NOW(), INTERVAL %d DAY)",
                $retention_days
            ));
        }
        
        // تنظيف جدول أداء المحتوى (الاحتفاظ بالبيانات الشهرية فقط بعد سنة)
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$this->table_content_performance} 
             WHERE date_tracked < DATE_SUB(CURDATE(), INTERVAL %d DAY) 
             AND DAY(date_tracked) != 1",
            $retention_days
        ));
    }
    
    /**
     * ==== بناء شرط التاريخ ====
     */
    private function build_date_condition($date_range) {
        $days = intval($date_range);
        return "created_at >= DATE_SUB(NOW(), INTERVAL $days DAY)";
    }
}

// تهيئة نظام التحليلات
new PS_Advanced_Analytics();

📁 اسم الملف: theme-admin-panel.php
<?php
/**
 * Complete Theme Admin Panel for Practical Solutions Pro
 * لوحة إعدادات القالب الكاملة للحلول العملية الاحترافية
 * المكان: /inc/theme-admin-panel.php
 */

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
    }
    
    /**
     * ==== إضافة قائمة الإدارة ====
     */
    public function add_admin_menu() {
        add_theme_page(
            __('إعدادات الحلول العملية', 'practical-solutions'),
            __('إعدادات القالب', 'practical-solutions'),
            $this->capability,
            $this->page_slug,
            array($this, 'render_admin_page')
        );
        
        // إضافة صفحات فرعية للتحليلات والتقارير
        add_submenu_page(
            $this->page_slug,
            __('التحليلات والتقارير', 'practical-solutions'),
            __('التحليلات', 'practical-solutions'),
            $this->capability,
            'ps-analytics',
            array($this, 'render_analytics_page')
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
        
        // إعدادات متقدمة
        register_setting('ps_advanced_settings', 'ps_advanced_settings', array($this, 'sanitize_advanced_settings'));
    }
    
    /**
     * ==== تحميل ملفات الإدارة ====
     */
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, $this->page_slug) === false && strpos($hook, 'ps-analytics') === false) {
            return;
        }
        
        wp_enqueue_style('ps-admin-css', PS_THEME_URI . '/assets/admin/admin-styles.css', array(), PS_THEME_VERSION);
        wp_enqueue_script('ps-admin-js', PS_THEME_URI . '/assets/admin/admin-scripts.js', array('jquery'), PS_THEME_VERSION, true);
        
        // مكتبات للرسوم البيانية
        wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.9.1', true);
        
        wp_localize_script('ps-admin-js', 'psAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ps_admin_nonce'),
            'strings' => array(
                'saving' => __('جاري الحفظ...', 'practical-solutions'),
                'saved' => __('تم الحفظ بنجاح', 'practical-solutions'),
                'error' => __('حدث خطأ', 'practical-solutions'),
                'confirm_reset' => __('هل أنت متأكد من إعادة تعيين الإعدادات؟', 'practical-solutions'),
                'testing_connection' => __('جاري اختبار الاتصال...', 'practical-solutions'),
                'connection_success' => __('الاتصال ناجح', 'practical-solutions'),
                'connection_failed' => __('فشل الاتصال', 'practical-solutions')
            )
        ));
    }
    
    /**
     * ==== عرض صفحة الإدارة الرئيسية ====
     */
    public function render_admin_page() {
        $active_tab = $_GET['tab'] ?? 'general';
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('إعدادات قالب الحلول العملية الاحترافية', 'practical-solutions'); ?></h1>
            
            <div class="ps-admin-header">
                <div class="ps-version-info">
                    <span class="ps-version"><?php _e('الإصدار:', 'practical-solutions'); ?> <?php echo PS_THEME_VERSION; ?></span>
                    <span class="ps-status ps-status-active"><?php _e('نشط', 'practical-solutions'); ?></span>
                </div>
                
                <div class="ps-quick-actions">
                    <button type="button" class="button" id="ps-clear-cache">
                        <i class="dashicons dashicons-update"></i> <?php _e('مسح التخزين المؤقت', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button" id="ps-export-settings">
                        <i class="dashicons dashicons-download"></i> <?php _e('تصدير الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button" id="ps-import-settings">
                        <i class="dashicons dashicons-upload"></i> <?php _e('استيراد الإعدادات', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <nav class="nav-tab-wrapper wp-clearfix">
                <a href="?page=<?php echo $this->page_slug; ?>&tab=general" 
                   class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-admin-generic"></i> <?php _e('عام', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=ai" 
                   class="nav-tab <?php echo $active_tab === 'ai' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-superhero"></i> <?php _e('الذكاء الاصطناعي', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=analytics" 
                   class="nav-tab <?php echo $active_tab === 'analytics' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-chart-line"></i> <?php _e('التحليلات', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=performance" 
                   class="nav-tab <?php echo $active_tab === 'performance' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-performance"></i> <?php _e('الأداء', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=design" 
                   class="nav-tab <?php echo $active_tab === 'design' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-admin-appearance"></i> <?php _e('التصميم', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=advanced" 
                   class="nav-tab <?php echo $active_tab === 'advanced' ? 'nav-tab-active' : ''; ?>">
                    <i class="dashicons dashicons-admin-settings"></i> <?php _e('متقدم', 'practical-solutions'); ?>
                </a>
            </nav>
            
            <div class="ps-admin-content">
                <?php
                switch ($active_tab) {
                    case 'general':
                        $this->render_general_tab();
                        break;
                    case 'ai':
                        $this->render_ai_tab();
                        break;
                    case 'analytics':
                        $this->render_analytics_tab();
                        break;
                    case 'performance':
                        $this->render_performance_tab();
                        break;
                    case 'design':
                        $this->render_design_tab();
                        break;
                    case 'advanced':
                        $this->render_advanced_tab();
                        break;
                    default:
                        $this->render_general_tab();
                }
                ?>
            </div>
        </div>
        
        <input type="file" id="ps-import-file" style="display: none;" accept=".json">
        <?php
    }
    
    /**
     * ==== تبويب الإعدادات العامة ====
     */
    private function render_general_tab() {
        $settings = get_option('ps_general_settings', array());
        ?>
        <form method="post" action="options.php" class="ps-settings-form">
            <?php settings_fields('ps_general_settings'); ?>
            
            <div class="ps-settings-grid">
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-admin-site"></i> <?php _e('معلومات الموقع', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('شعار الموقع', 'practical-solutions'); ?></th>
                            <td>
                                <div class="ps-media-upload">
                                    <input type="hidden" name="ps_general_settings[logo]" id="ps_logo" value="<?php echo esc_attr($settings['logo'] ?? ''); ?>">
                                    <div class="ps-logo-preview">
                                        <?php if (!empty($settings['logo'])): ?>
                                            <img src="<?php echo esc_url($settings['logo']); ?>" alt="Logo">
                                        <?php else: ?>
                                            <div class="ps-no-logo"><?php _e('لا يوجد شعار', 'practical-solutions'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="button ps-upload-logo"><?php _e('رفع شعار', 'practical-solutions'); ?></button>
                                    <button type="button" class="button ps-remove-logo"><?php _e('إزالة', 'practical-solutions'); ?></button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('وصف الموقع', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_general_settings[site_description]" rows="3" class="large-text"><?php echo esc_textarea($settings['site_description'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('وصف مختصر يظهر في النتائج والشبكات الاجتماعية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('الكلمات المفتاحية', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_general_settings[keywords]" value="<?php echo esc_attr($settings['keywords'] ?? ''); ?>" class="large-text">
                                <p class="description"><?php _e('الكلمات المفتاحية مفصولة بفواصل', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-admin-settings"></i> <?php _e('إعدادات الوظائف', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل البحث الصوتي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_general_settings[voice_search]" value="1" <?php checked(1, $settings['voice_search'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح للمستخدمين بالبحث باستخدام الصوت', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تفعيل نظام المفضلة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_general_settings[bookmarks]" value="1" <?php checked(1, $settings['bookmarks'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح للمستخدمين بحفظ المقالات المفضلة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تفعيل شريط تقدم القراءة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_general_settings[reading_progress]" value="1" <?php checked(1, $settings['reading_progress'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('عرض شريط تقدم القراءة في أعلى الصفحة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تفعيل نظام التقييمات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_general_settings[rating_system]" value="1" <?php checked(1, $settings['rating_system'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح للمستخدمين بتقييم المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('الوضع المظلم التلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_general_settings[auto_dark_mode]" value="1" <?php checked(1, $settings['auto_dark_mode'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل الوضع المظلم حسب تفضيل النظام', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-share"></i> <?php _e('وسائل التواصل الاجتماعي', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('فيسبوك', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_general_settings[facebook_url]" value="<?php echo esc_url($settings['facebook_url'] ?? ''); ?>" class="regular-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تويتر', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_general_settings[twitter_url]" value="<?php echo esc_url($settings['twitter_url'] ?? ''); ?>" class="regular-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('إنستغرام', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_general_settings[instagram_url]" value="<?php echo esc_url($settings['instagram_url'] ?? ''); ?>" class="regular-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('يوتيوب', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_general_settings[youtube_url]" value="<?php echo esc_url($settings['youtube_url'] ?? ''); ?>" class="regular-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('لينكدإن', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_general_settings[linkedin_url]" value="<?php echo esc_url($settings['linkedin_url'] ?? ''); ?>" class="regular-text">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <?php submit_button(__('حفظ الإعدادات', 'practical-solutions'), 'primary', 'submit', false); ?>
        </form>
        <?php
    }
    
    /**
     * ==== تبويب إعدادات الذكاء الاصطناعي ====
     */
    private function render_ai_tab() {
        $settings = get_option('ps_ai_settings', array());
        ?>
        <form method="post" action="options.php" class="ps-settings-form">
            <?php settings_fields('ps_ai_settings'); ?>
            
            <div class="ps-settings-grid">
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-superhero"></i> <?php _e('إعدادات OpenRouter API', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل الذكاء الاصطناعي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[enabled]" value="1" <?php checked(1, $settings['enabled'] ?? 0); ?> id="ps-ai-enabled">
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل ميزات الذكاء الاصطناعي', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('مفتاح OpenRouter API', 'practical-solutions'); ?></th>
                            <td>
                                <input type="password" name="ps_ai_settings[openrouter_api_key]" value="<?php echo esc_attr($settings['openrouter_api_key'] ?? ''); ?>" class="regular-text" placeholder="sk-or-...">
                                <button type="button" class="button" id="ps-test-api"><?php _e('اختبار الاتصال', 'practical-solutions'); ?></button>
                                <p class="description">
                                    <?php _e('احصل على مفتاح API من', 'practical-solutions'); ?> 
                                    <a href="https://openrouter.ai" target="_blank">OpenRouter.ai</a>
                                </p>
                                <div id="ps-api-status" class="ps-api-status"></div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('نموذج الذكاء الاصطناعي', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[model]" class="regular-text">
                                    <option value="meta-llama/llama-3.1-8b-instruct:free" <?php selected($settings['model'] ?? '', 'meta-llama/llama-3.1-8b-instruct:free'); ?>>
                                        Llama 3.1 8B (مجاني)
                                    </option>
                                    <option value="microsoft/wizardlm-2-8x22b" <?php selected($settings['model'] ?? '', 'microsoft/wizardlm-2-8x22b'); ?>>
                                        WizardLM 2 8x22B
                                    </option>
                                    <option value="anthropic/claude-3-haiku" <?php selected($settings['model'] ?? '', 'anthropic/claude-3-haiku'); ?>>
                                        Claude 3 Haiku
                                    </option>
                                    <option value="openai/gpt-3.5-turbo" <?php selected($settings['model'] ?? '', 'openai/gpt-3.5-turbo'); ?>>
                                        GPT-3.5 Turbo
                                    </option>
                                    <option value="openai/gpt-4" <?php selected($settings['model'] ?? '', 'openai/gpt-4'); ?>>
                                        GPT-4
                                    </option>
                                </select>
                                <p class="description"><?php _e('اختر النموذج المناسب حسب احتياجاتك وميزانيتك', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('الحد الأقصى للرموز', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_ai_settings[max_tokens]" value="<?php echo esc_attr($settings['max_tokens'] ?? 1500); ?>" min="100" max="4000" class="small-text">
                                <p class="description"><?php _e('الحد الأقصى لطول الاستجابة (100-4000)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-search"></i> <?php _e('اقتراحات البحث الذكية', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل اقتراحات البحث بالـ AI', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[search_suggestions]" value="1" <?php checked(1, $settings['search_suggestions'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('استخدام الذكاء الاصطناعي لتحسين اقتراحات البحث', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('عدد الاقتراحات', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_ai_settings[suggestions_count]" value="<?php echo esc_attr($settings['suggestions_count'] ?? 8); ?>" min="3" max="15" class="small-text">
                                <p class="description"><?php _e('عدد اقتراحات البحث التي سيتم عرضها (3-15)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('مدة التخزين المؤقت', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[cache_duration]">
                                    <option value="1800" <?php selected($settings['cache_duration'] ?? '', '1800'); ?>><?php _e('30 دقيقة', 'practical-solutions'); ?></option>
                                    <option value="3600" <?php selected($settings['cache_duration'] ?? '', '3600'); ?>><?php _e('ساعة واحدة', 'practical-solutions'); ?></option>
                                    <option value="7200" <?php selected($settings['cache_duration'] ?? '', '7200'); ?>><?php _e('ساعتان', 'practical-solutions'); ?></option>
                                    <option value="86400" <?php selected($settings['cache_duration'] ?? '', '86400'); ?>><?php _e('يوم واحد', 'practical-solutions'); ?></option>
                                </select>
                                <p class="description"><?php _e('مدة حفظ اقتراحات البحث في التخزين المؤقت', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-edit"></i> <?php _e('تحليل المحتوى التلقائي', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل التحليل التلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[auto_analysis]" value="1" <?php checked(1, $settings['auto_analysis'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تحليل المحتوى تلقائياً عند النشر', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('اقتراح التصنيفات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[auto_categorization]" value="1" <?php checked(1, $settings['auto_categorization'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('اقتراح التصنيفات المناسبة للمحتوى تلقائياً', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('توليد الوسوم', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[auto_tags]" value="1" <?php checked(1, $settings['auto_tags'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('اقتراح الوسوم المناسبة تلقائياً', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('توليد الملخصات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_ai_settings[auto_summaries]" value="1" <?php checked(1, $settings['auto_summaries'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('توليد ملخصات تلقائية للمحتوى', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card ps-ai-usage-stats">
                    <h3><i class="dashicons dashicons-chart-bar"></i> <?php _e('إحصائيات الاستخدام', 'practical-solutions'); ?></h3>
                    
                    <div class="ps-usage-metrics">
                        <?php
                        $usage_stats = get_option('ps_ai_usage_stats', array(
                            'monthly_requests' => 0,
                            'total_tokens_used' => 0,
                            'last_reset' => date('Y-m-01')
                        ));
                        ?>
                        
                        <div class="ps-metric">
                            <span class="ps-metric-label"><?php _e('الطلبات هذا الشهر:', 'practical-solutions'); ?></span>
                            <span class="ps-metric-value"><?php echo number_format($usage_stats['monthly_requests']); ?></span>
                        </div>
                        
                        <div class="ps-metric">
                            <span class="ps-metric-label"><?php _e('الرموز المستخدمة:', 'practical-solutions'); ?></span>
                            <span class="ps-metric-value"><?php echo number_format($usage_stats['total_tokens_used']); ?></span>
                        </div>
                        
                        <div class="ps-metric">
                            <span class="ps-metric-label"><?php _e('آخر إعادة تعيين:', 'practical-solutions'); ?></span>
                            <span class="ps-metric-value"><?php echo date_i18n('Y/m/d', strtotime($usage_stats['last_reset'])); ?></span>
                        </div>
                    </div>
                    
                    <button type="button" class="button" id="ps-reset-usage"><?php _e('إعادة تعيين الإحصائيات', 'practical-solutions'); ?></button>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات الذكاء الاصطناعي', 'practical-solutions'), 'primary', 'submit', false); ?>
        </form>
        <?php
    }
    
    /**
     * ==== تبويب إعدادات التحليلات ====
     */
    private function render_analytics_tab() {
        $settings = get_option('ps_analytics_settings', array());
        ?>
        <form method="post" action="options.php" class="ps-settings-form">
            <?php settings_fields('ps_analytics_settings'); ?>
            
            <div class="ps-settings-grid">
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-chart-line"></i> <?php _e('إعدادات التتبع', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل التحليلات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[enabled]" value="1" <?php checked(1, $settings['enabled'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل نظام التحليلات المتقدم', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تتبع نشاط المستخدمين', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[track_user_activity]" value="1" <?php checked(1, $settings['track_user_activity'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تتبع سلوك المستخدمين وتفاعلهم مع المحتوى', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تتبع تحليلات البحث', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[track_search_analytics]" value="1" <?php checked(1, $settings['track_search_analytics'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تتبع استعلامات البحث ونتائجها', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تتبع أداء المحتوى', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[track_content_performance]" value="1" <?php checked(1, $settings['track_content_performance'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تتبع أداء المقالات والصفحات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('إخفاء عناوين IP', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[anonymize_ip]" value="1" <?php checked(1, $settings['anonymize_ip'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('إخفاء آخر جزء من عنوان IP للخصوصية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-clock"></i> <?php _e('إعدادات الاحتفاظ بالبيانات', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('مدة الاحتفاظ بالبيانات', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_analytics_settings[data_retention_days]">
                                    <option value="30" <?php selected($settings['data_retention_days'] ?? '', '30'); ?>><?php _e('30 يوماً', 'practical-solutions'); ?></option>
                                    <option value="90" <?php selected($settings['data_retention_days'] ?? '', '90'); ?>><?php _e('90 يوماً', 'practical-solutions'); ?></option>
                                    <option value="180" <?php selected($settings['data_retention_days'] ?? '', '180'); ?>><?php _e('6 أشهر', 'practical-solutions'); ?></option>
                                    <option value="365" <?php selected($settings['data_retention_days'] ?? '', '365'); ?>><?php _e('سنة واحدة', 'practical-solutions'); ?></option>
                                    <option value="730" <?php selected($settings['data_retention_days'] ?? '', '730'); ?>><?php _e('سنتان', 'practical-solutions'); ?></option>
                                </select>
                                <p class="description"><?php _e('مدة الاحتفاظ بالبيانات قبل حذفها تلقائياً', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('التتبع في الوقت الفعلي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[real_time_tracking]" value="1" <?php checked(1, $settings['real_time_tracking'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('إرسال البيانات فوراً (يؤثر على الأداء)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('مقاييس متقدمة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[advanced_metrics]" value="1" <?php checked(1, $settings['advanced_metrics'] ?? 1); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل المقاييس المتقدمة مثل حركات الماوس والنقرات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-google"></i> <?php _e('تكامل Google Analytics', 'practical-solutions'); ?></h3>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('معرف Google Analytics', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_analytics_settings[google_analytics_id]" value="<?php echo esc_attr($settings['google_analytics_id'] ?? ''); ?>" class="regular-text" placeholder="G-XXXXXXXXXX">
                                <p class="description"><?php _e('معرف Google Analytics 4 (اختياري)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?php _e('تفعيل Enhanced Ecommerce', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-switch">
                                    <input type="checkbox" name="ps_analytics_settings[enhanced_ecommerce]" value="1" <?php checked(1, $settings['enhanced_ecommerce'] ?? 0); ?>>
                                    <span class="ps-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل تتبع التجارة الإلكترونية المحسن', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-settings-card">
                    <h3><i class="dashicons dashicons-database"></i> <?php _e('حالة قاعدة البيانات', 'practical-solutions'); ?></h3>
                    
                    <?php
                    global $wpdb;
                    $table_analytics = $wpdb->prefix . 'ps_analytics';
                    $table_user_activity = $wpdb->prefix . 'ps_user_activity';
                    $table_search_analytics = $wpdb->prefix . 'ps_search_analytics';
                    $table_content_performance = $wpdb->prefix . 'ps_content_performance';
                    
                    $analytics_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_analytics");
                    $user_activity_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_user_activity");
                    $search_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_search_analytics");
                    $content_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_content_performance");
                    ?>
                    
                    <div class="ps-db-stats">
                        <div class="ps-db-stat">
                            <span class="ps-db-label"><?php _e('سجلات التحليلات:', 'practical-solutions'); ?></span>
                            <span class="ps-db-value"><?php echo number_format($analytics_count ?: 0); ?></span>
                        </div>
                        
                        <div class="ps-db-stat">
                            <span class="ps-db-label"><?php _e('نشاط المستخدمين:', 'practical-solutions'); ?></span>
                            <span class="ps-db-value"><?php echo number_format($user_activity_count ?: 0); ?></span>
                        </div>
                        
                        <div class="ps-db-stat">
                            <span class="ps-db-label"><?php _e('تحليلات البحث:', 'practical-solutions'); ?></span>
                            <span class="ps-db-value"><?php echo number_format($search_count ?: 0); ?></span>
                        </div>
                        
                        <div class="ps-db-stat">
                            <span class="ps-db-label"><?php _e('أداء المحتوى:', 'practical-solutions'); ?></span>
                            <span class="ps-db-value"><?php echo number_format($content_count ?: 0); ?></span>
                        </div>
                    </div>
                    
                    <div class="ps-db-actions">
                        <button type="button" class="button" id="ps-optimize-db"><?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?></button>
                        <button type="button" class="button button-secondary" id="ps-cleanup-old-data"><?php _e('تنظيف البيانات القديمة', 'practical-solutions'); ?></button>
                    </div>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات التحليلات', 'practical-solutions'), 'primary', 'submit', false); ?>
        </form>
        <?php
    }
    
    /**
     * ==== باقي التبويبات ستكون في التحديث التالي ====
     */
    private function render_performance_tab() {
        echo '<div class="ps-coming-soon">';
        echo '<h3>' . __('تبويب الأداء قيد التطوير', 'practical-solutions') . '</h3>';
        echo '<p>' . __('سيتم إضافة إعدادات التحسين والأداء قريباً', 'practical-solutions') . '</p>';
        echo '</div>';
    }
    
    private function render_design_tab() {
        echo '<div class="ps-coming-soon">';
        echo '<h3>' . __('تبويب التصميم قيد التطوير', 'practical-solutions') . '</h3>';
        echo '<p>' . __('سيتم إضافة إعدادات الألوان والخطوط قريباً', 'practical-solutions') . '</p>';
        echo '</div>';
    }
    
    private function render_advanced_tab() {
        echo '<div class="ps-coming-soon">';
        echo '<h3>' . __('الإعدادات المتقدمة قيد التطوير', 'practical-solutions') . '</h3>';
        echo '<p>' . __('سيتم إضافة إعدادات المطورين والميزات المتقدمة قريباً', 'practical-solutions') . '</p>';
        echo '</div>';
    }
    
    /**
     * ==== معالجات التحقق ====
     */
    public function sanitize_general_settings($input) {
        $sanitized = array();
        
        if (isset($input['logo'])) {
            $sanitized['logo'] = esc_url_raw($input['logo']);
        }
        
        if (isset($input['site_description'])) {
            $sanitized['site_description'] = sanitize_textarea_field($input['site_description']);
        }
        
        if (isset($input['keywords'])) {
            $sanitized['keywords'] = sanitize_text_field($input['keywords']);
        }
        
        // باقي الحقول المنطقية
        $boolean_fields = array('voice_search', 'bookmarks', 'reading_progress', 'rating_system', 'auto_dark_mode');
        foreach ($boolean_fields as $field) {
            $sanitized[$field] = isset($input[$field]) ? 1 : 0;
        }
        
        // روابط وسائل التواصل
        $social_fields = array('facebook_url', 'twitter_url', 'instagram_url', 'youtube_url', 'linkedin_url');
        foreach ($social_fields as $field) {
            if (isset($input[$field])) {
                $sanitized[$field] = esc_url_raw($input[$field]);
            }
        }
        
        return $sanitized;
    }
    
    public function sanitize_ai_settings($input) {
        $sanitized = array();
        
        $sanitized['enabled'] = isset($input['enabled']) ? 1 : 0;
        $sanitized['openrouter_api_key'] = isset($input['openrouter_api_key']) ? sanitize_text_field($input['openrouter_api_key']) : '';
        $sanitized['model'] = isset($input['model']) ? sanitize_text_field($input['model']) : 'meta-llama/llama-3.1-8b-instruct:free';
        $sanitized['max_tokens'] = isset($input['max_tokens']) ? absint($input['max_tokens']) : 1500;
        $sanitized['search_suggestions'] = isset($input['search_suggestions']) ? 1 : 0;
        $sanitized['suggestions_count'] = isset($input['suggestions_count']) ? absint($input['suggestions_count']) : 8;
        $sanitized['cache_duration'] = isset($input['cache_duration']) ? absint($input['cache_duration']) : 3600;
        $sanitized['auto_analysis'] = isset($input['auto_analysis']) ? 1 : 0;
        $sanitized['auto_categorization'] = isset($input['auto_categorization']) ? 1 : 0;
        $sanitized['auto_tags'] = isset($input['auto_tags']) ? 1 : 0;
        $sanitized['auto_summaries'] = isset($input['auto_summaries']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_analytics_settings($input) {
        $sanitized = array();
        
        $sanitized['enabled'] = isset($input['enabled']) ? 1 : 0;
        $sanitized['track_user_activity'] = isset($input['track_user_activity']) ? 1 : 0;
        $sanitized['track_search_analytics'] = isset($input['track_search_analytics']) ? 1 : 0;
        $sanitized['track_content_performance'] = isset($input['track_content_performance']) ? 1 : 0;
        $sanitized['anonymize_ip'] = isset($input['anonymize_ip']) ? 1 : 0;
        $sanitized['data_retention_days'] = isset($input['data_retention_days']) ? absint($input['data_retention_days']) : 365;
        $sanitized['real_time_tracking'] = isset($input['real_time_tracking']) ? 1 : 0;
        $sanitized['advanced_metrics'] = isset($input['advanced_metrics']) ? 1 : 0;
        $sanitized['google_analytics_id'] = isset($input['google_analytics_id']) ? sanitize_text_field($input['google_analytics_id']) : '';
        $sanitized['enhanced_ecommerce'] = isset($input['enhanced_ecommerce']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_performance_settings($input) {
        // ستتم إضافتها لاحقاً
        return $input;
    }
    
    public function sanitize_design_settings($input) {
        // ستتم إضافتها لاحقاً
        return $input;
    }
    
    public function sanitize_advanced_settings($input) {
        // ستتم إضافتها لاحقاً
        return $input;
    }
    
    /**
     * ==== اختبار اتصال API ====
     */
    public function test_api_connection() {
        if (!current_user_can($this->capability)) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        if (!wp_verify_nonce($_POST['nonce'], 'ps_admin_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $api_key = sanitize_text_field($_POST['api_key'] ?? '');
        
        if (empty($api_key)) {
            wp_send_json_error(__('مفتاح API مطلوب', 'practical-solutions'));
        }
        
        try {
            $response = wp_remote_post('https://openrouter.ai/api/v1/chat/completions', array(
                'timeout' => 10,
                'headers' => array(
                    'Authorization' => 'Bearer ' . $api_key,
                    'Content-Type' => 'application/json'
                ),
                'body' => json_encode(array(
                    'model' => 'meta-llama/llama-3.1-8b-instruct:free',
                    'messages' => array(
                        array('role' => 'user', 'content' => 'Hello')
                    ),
                    'max_tokens' => 10
                ))
            ));
            
            if (is_wp_error($response)) {
                wp_send_json_error($response->get_error_message());
            }
            
            $code = wp_remote_retrieve_response_code($response);
            
            if ($code === 200) {
                wp_send_json_success(__('اتصال ناجح بـ OpenRouter API', 'practical-solutions'));
            } else {
                $body = wp_remote_retrieve_body($response);
                $error_data = json_decode($body, true);
                $error_message = $error_data['error']['message'] ?? __('خطأ غير معروف', 'practical-solutions');
                wp_send_json_error($error_message);
            }
            
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }
    
    /**
     * ==== مسح التخزين المؤقت ====
     */
    public function clear_cache() {
        if (!current_user_can($this->capability)) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        if (!wp_verify_nonce($_POST['nonce'], 'ps_admin_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        // مسح transients الخاصة بالقالب
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_ps_%' OR option_name LIKE '_transient_timeout_ps_%'");
        
        // مسح object cache إذا كان متاحاً
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
        
        wp_send_json_success(__('تم مسح التخزين المؤقت بنجاح', 'practical-solutions'));
    }
    
    /**
     * ==== تصدير الإعدادات ====
     */
    public function export_settings() {
        if (!current_user_can($this->capability)) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        if (!wp_verify_nonce($_POST['nonce'], 'ps_admin_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $settings = array(
            'general' => get_option('ps_general_settings', array()),
            'ai' => get_option('ps_ai_settings', array()),
            'analytics' => get_option('ps_analytics_settings', array()),
            'performance' => get_option('ps_performance_settings', array()),
            'design' => get_option('ps_design_settings', array()),
            'advanced' => get_option('ps_advanced_settings', array()),
            'exported_at' => current_time('mysql'),
            'version' => PS_THEME_VERSION
        );
        
        // إزالة البيانات الحساسة
        if (isset($settings['ai']['openrouter_api_key'])) {
            $settings['ai']['openrouter_api_key'] = '';
        }
        
        wp_send_json_success(array(
            'data' => base64_encode(json_encode($settings)),
            'filename' => 'practical-solutions-settings-' . date('Y-m-d-H-i-s') . '.json'
        ));
    }
    
    /**
     * ==== استيراد الإعدادات ====
     */
    public function import_settings() {
        if (!current_user_can($this->capability)) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        if (!wp_verify_nonce($_POST['nonce'], 'ps_admin_nonce')) {
            wp_send_json_error(__('غير مصرح', 'practical-solutions'));
        }
        
        $settings_data = $_POST['settings_data'] ?? '';
        
        if (empty($settings_data)) {
            wp_send_json_error(__('بيانات الإعدادات مطلوبة', 'practical-solutions'));
        }
        
        try {
            $settings = json_decode(base64_decode($settings_data), true);
            
            if (!$settings || !is_array($settings)) {
                wp_send_json_error(__('تنسيق الملف غير صحيح', 'practical-solutions'));
            }
            
            // استيراد الإعدادات
            $imported_sections = array();
            
            if (isset($settings['general'])) {
                update_option('ps_general_settings', $settings['general']);
                $imported_sections[] = __('الإعدادات العامة', 'practical-solutions');
            }
            
            if (isset($settings['ai'])) {
                update_option('ps_ai_settings', $settings['ai']);
                $imported_sections[] = __('إعدادات الذكاء الاصطناعي', 'practical-solutions');
            }
            
            if (isset($settings['analytics'])) {
                update_option('ps_analytics_settings', $settings['analytics']);
                $imported_sections[] = __('إعدادات التحليلات', 'practical-solutions');
            }
            
            if (isset($settings['performance'])) {
                update_option('ps_performance_settings', $settings['performance']);
                $imported_sections[] = __('إعدادات الأداء', 'practical-solutions');
            }
            
            if (isset($settings['design'])) {
                update_option('ps_design_settings', $settings['design']);
                $imported_sections[] = __('إعدادات التصميم', 'practical-solutions');
            }
            
            if (isset($settings['advanced'])) {
                update_option('ps_advanced_settings', $settings['advanced']);
                $imported_sections[] = __('الإعدادات المتقدمة', 'practical-solutions');
            }
            
            wp_send_json_success(array(
                'message' => __('تم استيراد الإعدادات بنجاح', 'practical-solutions'),
                'imported_sections' => $imported_sections
            ));
            
        } catch (Exception $e) {
            wp_send_json_error(__('حدث خطأ أثناء الاستيراد: ', 'practical-solutions') . $e->getMessage());
        }
    }
}

// تهيئة لوحة الإدارة
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


📁 اسم الملف: 




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



