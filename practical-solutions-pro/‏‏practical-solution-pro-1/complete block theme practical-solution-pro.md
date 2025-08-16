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
│   ├── js/
│   │   └── enhanced-voice-search.js
│   │   └── interactive-features.js
│   │   └── unified.js ← جميع الوظائف موحدة
│   ├── images/
│   └── fonts/
├── inc/
│   ├── theme-settings.php
│   ├── customizer-settings.php
│   ├── ai-search-suggestions.php
│   ├── rating-system.php
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
 * Practical Solutions Pro - Enhanced Functions
 * قالب الحلول العملية الاحترافي - الوظائف المحسنة مع الميزات الجديدة
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تعريف ثوابت القالب
define('PS_THEME_VERSION', '2.2.0');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());

/**
 * إعدادات القالب الأساسية
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
    
    // أحجام الصور المحسنة
    add_image_size('ps-thumbnail', 400, 300, true);
    add_image_size('ps-medium', 800, 600, true);
    add_image_size('ps-large', 1200, 800, true);
    add_image_size('ps-hero', 1600, 900, true);
    
    // دعم الترجمة
    load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');
    
    // أنماط المحرر
    add_editor_style(array(
        'assets/css/unified.css',
        'assets/css/enhanced-ux.css',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * تحميل الأصول المحسنة (CSS/JS) مع الميزات الجديدة
 */
function practical_solutions_enqueue_assets() {
    // CSS موحد
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
    
    // JavaScript موحد
    wp_enqueue_script(
        'ps-unified-script',
        PS_THEME_URI . '/assets/js/unified.js',
        array('jquery'),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // البحث الصوتي المحسن
    wp_enqueue_script(
        'ps-enhanced-voice',
        PS_THEME_URI . '/assets/js/enhanced-voice-search.js',
        array('ps-unified-script'),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // الميزات التفاعلية
    wp_enqueue_script(
        'ps-interactive-features',
        PS_THEME_URI . '/assets/js/interactive-features.js',
        array('ps-unified-script'),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // إعدادات JavaScript المحدثة
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
            'voice_search' => get_option('ps_voice_search_enabled', true),
            'bookmarks' => true,
            'share_tracking' => true,
            'reading_progress' => true,
            'ai_suggestions' => get_option('ps_ai_search_enabled', false)
        )
    ));
    
    // أنماط RTL إضافية
    if (is_rtl()) {
        wp_enqueue_style(
            'ps-rtl-styles',
            PS_THEME_URI . '/assets/css/rtl.css',
            array('ps-enhanced-ux'),
            PS_THEME_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_assets');

/**
 * تحميل الملفات المساعدة الجديدة
 */
function practical_solutions_load_includes() {
    $includes = array(
        'inc/theme-settings.php',
        'inc/customizer-settings.php',
        'inc/block-patterns.php',
        'inc/rating-system.php',
        'inc/ai-search-suggestions.php'
    );
    
    foreach ($includes as $file) {
        $file_path = PS_THEME_DIR . '/' . $file;
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}
add_action('after_setup_theme', 'practical_solutions_load_includes');

/**
 * تسجيل Block Styles المخصصة المحدثة
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
    
    // أنماط للعناوين
    register_block_style('core/heading', array(
        'name' => 'ps-section-title',
        'label' => __('عنوان القسم', 'practical-solutions')
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
}
add_action('init', 'practical_solutions_register_block_styles');

/**
 * AJAX للبحث المحسن - موحد ومطور
 */
function practical_solutions_ajax_search() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(__('غير مصرح', 'practical-solutions'));
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = sanitize_text_field($_POST['search_type']) ?? 'suggestions';
    $user_behavior = json_decode(stripslashes($_POST['user_behavior'] ?? '{}'), true);
    
    if (empty($search_term)) {
        wp_send_json_error(__('لا يوجد مصطلح بحث', 'practical-solutions'));
    }
    
    $results = array();
    
    switch ($search_type) {
        case 'suggestions':
            $results = ps_get_search_suggestions($search_term, $user_behavior);
            break;
        case 'posts':
            $results = ps_get_search_results($search_term);
            break;
        case 'categories':
            $results = ps_get_category_suggestions($search_term);
            break;
        case 'smart':
            $results = ps_get_smart_suggestions($search_term, $user_behavior);
            break;
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_ps_search_enhanced', 'practical_solutions_ajax_search');
add_action('wp_ajax_nopriv_ps_search_enhanced', 'practical_solutions_ajax_search');

/**
 * دالة البحث المحسنة مع الذكاء الاصطناعي
 */
function ps_get_search_suggestions($search_term, $user_behavior = array()) {
    $posts = get_posts(array(
        's' => $search_term,
        'post_type' => 'post',
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_ps_rating_average',
                'value' => 4.0,
                'compare' => '>=',
                'type' => 'DECIMAL'
            ),
            array(
                'key' => '_ps_rating_average',
                'compare' => 'NOT EXISTS'
            )
        )
    ));
    
    $suggestions = array();
    foreach ($posts as $post) {
        $rating_data = ps_get_post_rating($post->ID);
        $suggestions[] = array(
            'id' => $post->ID,
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post), 15),
            'thumbnail' => get_the_post_thumbnail_url($post, 'ps-thumbnail'),
            'category' => get_the_category($post)[0]->name ?? '',
            'date' => get_the_date('j F Y', $post),
            'rating' => $rating_data['average'],
            'rating_count' => $rating_data['count'],
            'reading_time' => ps_calculate_reading_time($post->post_content),
            'is_bookmarked' => ps_is_post_bookmarked($post->ID),
            'popularity_score' => ps_calculate_popularity_score($post->ID)
        );
    }
    
    // ترتيب حسب الشعبية والتقييم
    usort($suggestions, function($a, $b) {
        return $b['popularity_score'] <=> $a['popularity_score'];
    });
    
    return $suggestions;
}

/**
 * حساب وقت القراءة
 */
function ps_calculate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة
    return max(1, $reading_time);
}

/**
 * فحص إذا كان المقال محفوظ
 */
function ps_is_post_bookmarked($post_id) {
    // هذه معلومة من الجانب الأمامي، نرجع false افتراضياً
    return false;
}

/**
 * حساب نقاط الشعبية
 */
function ps_calculate_popularity_score($post_id) {
    $views = get_post_meta($post_id, 'post_views_count', true) ?: 0;
    $rating = get_post_meta($post_id, '_ps_rating_average', true) ?: 0;
    $rating_count = get_post_meta($post_id, '_ps_rating_count', true) ?: 0;
    $shares = get_post_meta($post_id, '_ps_share_count', true) ?: 0;
    
    // حساب النقاط
    $score = ($views * 1) + ($rating * $rating_count * 10) + ($shares * 5);
    
    return $score;
}

/**
 * AJAX للحصول على المقالات المحفوظة
 */
function ps_get_bookmarked_posts() {
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $post_ids = explode(',', sanitize_text_field($_POST['post_ids']));
    $post_ids = array_map('intval', $post_ids);
    $post_ids = array_filter($post_ids);
    
    if (empty($post_ids)) {
        wp_send_json_success(array());
    }
    
    $posts = get_posts(array(
        'include' => $post_ids,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ));
    
    $bookmarked_posts = array();
    foreach ($posts as $post) {
        $bookmarked_posts[] = array(
            'ID' => $post->ID,
            'post_title' => $post->post_title,
            'permalink' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post), 20),
            'date' => get_the_date('j F Y', $post),
            'thumbnail' => get_the_post_thumbnail_url($post, 'ps-thumbnail'),
            'category' => get_the_category($post)[0]->name ?? ''
        );
    }
    
    wp_send_json_success($bookmarked_posts);
}
add_action('wp_ajax_ps_get_bookmarked_posts', 'ps_get_bookmarked_posts');
add_action('wp_ajax_nopriv_ps_get_bookmarked_posts', 'ps_get_bookmarked_posts');

/**
 * AJAX لتتبع المشاركات
 */
function ps_track_share() {
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $post_id = intval($_POST['post_id']);
    $platform = sanitize_text_field($_POST['platform']);
    
    if (!$post_id) {
        wp_send_json_error('معرف المقال مطلوب');
    }
    
    // تحديث عداد المشاركات
    $current_count = get_post_meta($post_id, '_ps_share_count', true) ?: 0;
    update_post_meta($post_id, '_ps_share_count', $current_count + 1);
    
    // تتبع المنصة
    $platform_count = get_post_meta($post_id, "_ps_share_{$platform}", true) ?: 0;
    update_post_meta($post_id, "_ps_share_{$platform}", $platform_count + 1);
    
    wp_send_json_success(array(
        'total_shares' => $current_count + 1,
        'platform_shares' => $platform_count + 1
    ));
}
add_action('wp_ajax_ps_track_share', 'ps_track_share');
add_action('wp_ajax_nopriv_ps_track_share', 'ps_track_share');

/**
 * AJAX لتتبع نشاط المستخدم
 */
function ps_track_activity() {
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $post_id = intval($_POST['post_id']);
    $scroll_depth = floatval($_POST['scroll_depth']);
    $time_on_page = intval($_POST['time_on_page']);
    $interaction_count = intval($_POST['interaction_count']);
    
    if ($post_id) {
        // تحديث مشاهدات المقال
        $views = get_post_meta($post_id, 'post_views_count', true) ?: 0;
        update_post_meta($post_id, 'post_views_count', $views + 1);
        
        // حفظ متوسط عمق التمرير
        $avg_scroll = get_post_meta($post_id, '_ps_avg_scroll_depth', true) ?: 0;
        $new_avg = ($avg_scroll + $scroll_depth) / 2;
        update_post_meta($post_id, '_ps_avg_scroll_depth', $new_avg);
        
        // حفظ متوسط الوقت
        $avg_time = get_post_meta($post_id, '_ps_avg_time_on_page', true) ?: 0;
        $new_avg_time = ($avg_time + $time_on_page) / 2;
        update_post_meta($post_id, '_ps_avg_time_on_page', $new_avg_time);
    }
    
    wp_send_json_success();
}
add_action('wp_ajax_ps_track_activity', 'ps_track_activity');
add_action('wp_ajax_nopriv_ps_track_activity', 'ps_track_activity');

/**
 * إضافة shortcode للتقييم
 */
function ps_rating_shortcode($atts) {
    $atts = shortcode_atts(array(
        'post_id' => get_the_ID(),
        'show_form' => true
    ), $atts);
    
    if (!$atts['post_id']) {
        return '';
    }
    
    $rating_system = new PS_Rating_System();
    return $rating_system->render_rating_block($atts);
}
add_shortcode('ps_rating', 'ps_rating_shortcode');

/**
 * إضافة التقييم تلقائياً للمقالات
 */
function ps_auto_add_rating($content) {
    if (is_single() && is_main_query() && get_post_type() === 'post') {
        $rating_html = do_shortcode('[ps_rating]');
        $content .= $rating_html;
    }
    return $content;
}
add_filter('the_content', 'ps_auto_add_rating');

/**
 * إنشاء Breadcrumbs ديناميكي محدث
 */
function ps_get_breadcrumbs() {
    $breadcrumbs = array();
    
    // الرئيسية
    $breadcrumbs[] = array(
        'title' => __('🏠 الرئيسية', 'practical-solutions'),
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
            'title' => sprintf(__('🔍 نتائج البحث عن: %s', 'practical-solutions'), get_search_query()),
            'url' => '',
            'current' => true
        );
    }
    
    return $breadcrumbs;
}

/**
 * Shortcode للـ Breadcrumbs محدث
 */
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
            $output .= '<li class="breadcrumb-separator" aria-hidden="true"> / </li>';
        }
    }
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    return $output;
}
add_shortcode('ps_breadcrumbs', 'ps_breadcrumbs_shortcode');

/**
 * تحسينات الأداء المطورة
 */
function practical_solutions_performance_optimizations() {
    // إزالة العناصر غير الضرورية
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    
    // إزالة الإيموجي
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // تحسين الاستعلامات
    add_action('pre_get_posts', 'ps_optimize_queries');
}
add_action('init', 'practical_solutions_performance_optimizations');

/**
 * تحسين الاستعلامات
 */
function ps_optimize_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_home()) {
            $query->set('posts_per_page', 12);
        }
        
        if (is_search()) {
            $query->set('posts_per_page', 10);
        }
    }
}

/**
 * إضافة كلاسات مخصصة للـ body محدثة
 */
function practical_solutions_body_classes($classes) {
    $classes[] = 'ps-theme';
    $classes[] = 'block-theme-enhanced';
    $classes[] = 'ps-interactive-enabled';
    
    if (is_home() || is_front_page()) {
        $classes[] = 'ps-homepage';
    }
    
    if (is_single()) {
        $classes[] = 'ps-single-post';
        $classes[] = 'ps-reading-mode';
        
        $categories = get_the_category();
        if (!empty($categories)) {
            $classes[] = 'ps-category-' . $categories[0]->slug;
        }
        
        // إضافة كلاس للمقالات المقيمة
        $rating_count = get_post_meta(get_the_ID(), '_ps_rating_count', true);
        if ($rating_count > 0) {
            $classes[] = 'ps-rated-post';
        }
    }
    
    if (is_search()) {
        $classes[] = 'ps-search-results';
    }
    
    if (is_rtl()) {
        $classes[] = 'ps-rtl';
    }
    
    // إضافة كلاسات للميزات المفعلة
    if (get_option('ps_voice_search_enabled', true)) {
        $classes[] = 'ps-voice-enabled';
    }
    
    if (get_option('ps_ai_search_enabled', false)) {
        $classes[] = 'ps-ai-enabled';
    }
    
    return $classes;
}
add_filter('body_class', 'practical_solutions_body_classes');

/**
 * إضافة structured data محسن مع التقييمات
 */
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
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
                'url' => get_author_posts_url(get_the_author_meta('ID'))
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
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
        
        // إضافة الصورة
        if (has_post_thumbnail()) {
            $thumbnail_url = get_the_post_thumbnail_url($post, 'large');
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $thumbnail_url,
                'width' => 1200,
                'height' => 800
            );
        }
        
        // إضافة التقييمات إذا كانت متوفرة
        $rating_average = get_post_meta($post->ID, '_ps_rating_average', true);
        $rating_count = get_post_meta($post->ID, '_ps_rating_count', true);
        
        if ($rating_average && $rating_count) {
            $schema['aggregateRating'] = array(
                '@type' => 'AggregateRating',
                'ratingValue' => floatval($rating_average),
                'ratingCount' => intval($rating_count),
                'bestRating' => 5,
                'worstRating' => 1
            );
        }
        
        // إضافة وقت القراءة
        $reading_time = ps_calculate_reading_time($post->post_content);
        $schema['timeRequired'] = 'PT' . $reading_time . 'M';
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_structured_data');

/**
 * إضافة meta tags محسنة
 */
function ps_enhanced_meta_tags() {
    if (is_single()) {
        $post_id = get_the_ID();
        $rating_average = get_post_meta($post_id, '_ps_rating_average', true);
        
        if ($rating_average) {
            echo '<meta name="rating" content="' . $rating_average . '">' . "\n";
        }
        
        $reading_time = ps_calculate_reading_time(get_post_field('post_content', $post_id));
        echo '<meta name="reading-time" content="' . $reading_time . ' دقيقة">' . "\n";
        
        $share_count = get_post_meta($post_id, '_ps_share_count', true);
        if ($share_count) {
            echo '<meta name="share-count" content="' . $share_count . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ps_enhanced_meta_tags');

/**
 * تسجيل أنواع المحتوى المخصصة
 */
function ps_register_custom_post_types() {
    // نوع مقال مخصص للحلول
    register_post_type('solution', array(
        'labels' => array(
            'name' => 'الحلول المميزة',
            'singular_name' => 'حل مميز',
            'add_new' => 'إضافة حل جديد',
            'add_new_item' => 'إضافة حل مميز جديد',
            'edit_item' => 'تحرير الحل',
            'new_item' => 'حل جديد',
            'view_item' => 'عرض الحل',
            'search_items' => 'بحث في الحلول',
            'not_found' => 'لم يتم العثور على حلول',
            'not_found_in_trash' => 'لا توجد حلول في المهملات'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-lightbulb',
        'rewrite' => array('slug' => 'solutions'),
        'show_in_rest' => true
    ));
}
add_action('init', 'ps_register_custom_post_types');

/**
 * دالة مساعدة للحصول على تقييم المقال
 */
function ps_get_post_rating($post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    
    $average = get_post_meta($post_id, '_ps_rating_average', true);
    $count = get_post_meta($post_id, '_ps_rating_count', true);
    
    return array(
        'average' => floatval($average ?: 0),
        'count' => intval($count ?: 0)
    );
}

/**
 * عرض نجوم التقييم
 */
function ps_display_rating_stars($rating, $size = 'medium') {
    $size_class = 'ps-stars-' . $size;
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5;
    
    $output = '<div class="ps-rating-stars ' . $size_class . '" data-rating="' . $rating . '">';
    
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $full_stars) {
            $output .= '<span class="ps-star full">⭐</span>';
        } elseif ($i == $full_stars + 1 && $half_star) {
            $output .= '<span class="ps-star half">⭐</span>';
        } else {
            $output .= '<span class="ps-star empty">☆</span>';
        }
    }
    
    $output .= '</div>';
    return $output;
}

/**
 * إضافة PWA manifest link
 */
function ps_add_pwa_manifest() {
    echo '<link rel="manifest" href="' . PS_THEME_URI . '/manifest.json">' . "\n";
    echo '<meta name="theme-color" content="#007cba">' . "\n";
    echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="default">' . "\n";
}
add_action('wp_head', 'ps_add_pwa_manifest');

/**
 * إضافة خصائص أمان إضافية
 */
function ps_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'ps_security_headers');

📁 اسم الملف: assets/js/unified.js
/**
 * Practical Solutions Pro - Unified JavaScript (Updated)
 * جافاسكريبت موحد محدث للحلول العملية الاحترافية
 */

// متغيرات عامة محدثة
const psSettings = window.psSettings || {};

/**
 * الكلاس الرئيسي للقالب المحدث
 */
class PracticalSolutionsTheme {
    constructor() {
        this.searchTimeout = null;
        this.voiceRecognition = null;
        this.isVoiceListening = false;
        this.searchHistory = this.loadSearchHistory();
        this.currentFocus = -1;
        this.userBehavior = this.loadUserBehavior();
        this.features = psSettings.features || {};
        this.cache = new Map();
        
        this.init();
    }
    
    /**
     * تهيئة القالب المحدثة
     */
    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.initThemeToggle();
            this.initSearch();
            this.initVoiceSearch();
            this.initSmoothScroll();
            this.initAnimations();
            this.initAccessibility();
            this.initPerformanceOptimizations();
            this.initRatingSystem();
            this.initUserTracking();
            
            // تحميل الميزات التفاعلية إذا كانت متاحة
            if (window.PSInteractiveFeatures) {
                this.interactiveFeatures = new window.PSInteractiveFeatures();
            }
        });
        
        window.addEventListener('load', () => {
            this.initServiceWorker();
            this.initOfflineMode();
            this.initLazyLoading();
            this.trackPageLoad();
            document.body.classList.add('ps-loaded');
        });
        
        // معالجة الأخطاء الشاملة
        window.addEventListener('error', (e) => this.handleGlobalError(e));
    }
    
    /**
     * تحميل سلوك المستخدم
     */
    loadUserBehavior() {
        try {
            const stored = localStorage.getItem('ps_user_behavior');
            const defaultBehavior = {
                recent_searches: [],
                preferred_categories: {},
                reading_time: {},
                bookmarks: [],
                scroll_patterns: {}
            };
            
            return stored ? { ...defaultBehavior, ...JSON.parse(stored) } : defaultBehavior;
        } catch (error) {
            console.warn('فشل في تحميل سلوك المستخدم:', error);
            return {
                recent_searches: [],
                preferred_categories: {},
                reading_time: {},
                bookmarks: [],
                scroll_patterns: {}
            };
        }
    }
    
    /**
     * حفظ سلوك المستخدم
     */
    saveUserBehavior() {
        try {
            localStorage.setItem('ps_user_behavior', JSON.stringify(this.userBehavior));
        } catch (error) {
            console.warn('فشل في حفظ سلوك المستخدم:', error);
        }
    }
    
    /**
     * تتبع نشاط البحث
     */
    trackSearchActivity(query, resultCount) {
        // إضافة للبحثات الأخيرة
        this.userBehavior.recent_searches = this.userBehavior.recent_searches || [];
        this.userBehavior.recent_searches.unshift(query);
        this.userBehavior.recent_searches = this.userBehavior.recent_searches.slice(0, 10);
        
        // حفظ السلوك
        this.saveUserBehavior();
        
        // إرسال للخادم
        this.sendAnalytics('search', {
            query: query,
            result_count: resultCount,
            timestamp: Date.now()
        });
    }
    
    /**
     * تهيئة البحث المحسن
     */
    initSearch() {
        const searchInputs = document.querySelectorAll('.ps-search-input, .ps-hero-search-input, #search-input');
        
        searchInputs.forEach(searchInput => {
            let suggestionsContainer = this.getSuggestionsContainer(searchInput);
            
            // مستمع الإدخال مع debouncing محسن
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.trim();
                
                clearTimeout(this.searchTimeout);
                
                if (query.length < 2) {
                    this.hideSuggestions(suggestionsContainer);
                    return;
                }
                
                // فحص الكاش أولاً
                const cacheKey = `search_${query}`;
                if (this.cache.has(cacheKey)) {
                    this.showCachedSuggestions(this.cache.get(cacheKey), suggestionsContainer, searchInput);
                    return;
                }
                
                this.searchTimeout = setTimeout(() => {
                    this.fetchSearchSuggestions(query, suggestionsContainer, searchInput);
                }, 300);
            });
            
            // التنقل بلوحة المفاتيح المحسن
            searchInput.addEventListener('keydown', (e) => {
                this.handleKeyboardNavigation(e, suggestionsContainer);
            });
            
            // إخفاء عند النقر خارجها
            document.addEventListener('click', (e) => {
                if (!searchInput.parentNode.contains(e.target)) {
                    this.hideSuggestions(suggestionsContainer);
                }
            });
            
            // إضافة placeholder ديناميكي
            this.setDynamicPlaceholder(searchInput);
        });
    }
    
    /**
     * placeholder ديناميكي مبني على سلوك المستخدم
     */
    setDynamicPlaceholder(input) {
        const placeholders = [
            'ابحث عن حلول تنظيف المطبخ...',
            'نصائح توفير المال...',
            'طرق ترتيب المنزل...',
            'حلول مشاكل الطبخ...'
        ];
        
        // إضافة البحثات الأخيرة للقائمة
        if (this.userBehavior.recent_searches.length > 0) {
            placeholders.unshift(`مثل: ${this.userBehavior.recent_searches[0]}...`);
        }
        
        let currentIndex = 0;
        const rotatePlaceholder = () => {
            input.placeholder = placeholders[currentIndex];
            currentIndex = (currentIndex + 1) % placeholders.length;
        };
        
        // تبديل كل 3 ثوان
        rotatePlaceholder();
        setInterval(rotatePlaceholder, 3000);
    }
    
    /**
     * جلب اقتراحات البحث المحسنة
     */
    async fetchSearchSuggestions(query, container, searchInput) {
        if (!psSettings.ajaxUrl) return;
        
        const formData = new FormData();
        formData.append('action', 'ps_search_enhanced');
        formData.append('search_term', query);
        formData.append('search_type', this.features.ai_suggestions ? 'smart' : 'suggestions');
        formData.append('user_behavior', JSON.stringify(this.userBehavior));
        formData.append('nonce', psSettings.nonce);
        
        this.showLoadingInSuggestions(container);
        
        try {
            const response = await fetch(psSettings.ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });
            
            const data = await response.json();
            
            if (data.success && data.data.length > 0) {
                // حفظ في الكاش
                const cacheKey = `search_${query}`;
                this.cache.set(cacheKey, data.data);
                
                this.showSuggestions(data.data, container, searchInput);
                this.trackSearchActivity(query, data.data.length);
            } else {
                this.showNoResults(container);
            }
        } catch (error) {
            console.error('خطأ في البحث:', error);
            this.hideSuggestions(container);
            this.showNotification('حدث خطأ في البحث', 'error');
        }
    }
    
    /**
     * عرض الاقتراحات المحسنة
     */
    showSuggestions(suggestions, container, searchInput) {
        const suggestionsList = suggestions.map(item => `
            <div class="ps-suggestion-item" data-url="${item.url}" data-title="${item.title}" data-id="${item.id}">
                ${item.thumbnail ? `<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail" loading="lazy">` : ''}
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">${this.highlightSearchTerm(item.title, searchInput.value)}</div>
                    <div class="ps-suggestion-excerpt">${item.excerpt}</div>
                    <div class="ps-suggestion-meta">
                        ${item.category ? `<span class="ps-category">📂 ${item.category}</span>` : ''}
                        ${item.date ? `<span class="ps-date">📅 ${item.date}</span>` : ''}
                        ${item.rating ? `
                            <span class="ps-suggestion-rating">
                                ⭐ ${item.rating} (${item.rating_count})
                            </span>
                        ` : ''}
                        ${item.reading_time ? `<span class="ps-suggestion-reading-time">⏱️ ${item.reading_time} دقيقة</span>` : ''}
                    </div>
                </div>
            </div>
        `).join('');
        
        container.innerHTML = suggestionsList;
        container.classList.add('show');
        
        // إضافة مستمعي الأحداث
        container.querySelectorAll('.ps-suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');
                const id = item.getAttribute('data-id');
                
                if (title) this.saveSearchHistory(title);
                if (id) this.trackInteraction('suggestion_click', { post_id: id, query: searchInput.value });
                
                window.location.href = url;
            });
        });
    }
    
    /**
     * عرض الاقتراحات من الكاش
     */
    showCachedSuggestions(suggestions, container, searchInput) {
        this.showSuggestions(suggestions, container, searchInput);
    }
    
    /**
     * تهيئة نظام التقييمات
     */
    initRatingSystem() {
        const ratingWidgets = document.querySelectorAll('.ps-rating-widget');
        
        ratingWidgets.forEach(widget => {
            this.setupRatingWidget(widget);
        });
    }
    
    /**
     * إعداد widget التقييم
     */
    setupRatingWidget(widget) {
        const postId = widget.getAttribute('data-post-id');
        const rateButton = widget.querySelector('.ps-rate-button');
        const ratingForm = widget.querySelector('.ps-rating-form');
        const submitButton = widget.querySelector('.ps-submit-rating');
        const cancelButton = widget.querySelector('.ps-cancel-rating');
        const ratingButtons = widget.querySelectorAll('.ps-rating-btn');
        
        let selectedRating = 0;
        
        // إظهار نموذج التقييم
        if (rateButton && ratingForm) {
            rateButton.addEventListener('click', () => {
                ratingForm.style.display = 'block';
                rateButton.style.display = 'none';
                this.trackInteraction('rating_form_opened', { post_id: postId });
            });
        }
        
        // إلغاء التقييم
        if (cancelButton && ratingForm && rateButton) {
            cancelButton.addEventListener('click', () => {
                ratingForm.style.display = 'none';
                rateButton.style.display = 'block';
                selectedRating = 0;
                this.resetRatingButtons(ratingButtons);
            });
        }
        
        // تحديد التقييم
        ratingButtons.forEach((button, index) => {
            const rating = index + 1;
            
            button.addEventListener('click', () => {
                selectedRating = rating;
                this.updateRatingButtons(ratingButtons, rating);
            });
            
            button.addEventListener('mouseenter', () => {
                this.previewRating(ratingButtons, rating);
            });
        });
        
        // إعادة تعيين عند الخروج
        widget.addEventListener('mouseleave', () => {
            this.updateRatingButtons(ratingButtons, selectedRating);
        });
        
        // إرسال التقييم
        if (submitButton) {
            submitButton.addEventListener('click', async () => {
                if (selectedRating === 0) {
                    this.showNotification('يرجى اختيار تقييم', 'warning');
                    return;
                }
                
                const comment = widget.querySelector('.ps-rating-comment')?.value || '';
                
                try {
                    await this.submitRating(postId, selectedRating, comment);
                    this.showNotification('تم حفظ تقييمك بنجاح!', 'success');
                    
                    // إخفاء النموذج وتحديث العرض
                    ratingForm.style.display = 'none';
                    this.updateRatingDisplay(widget, selectedRating);
                    
                } catch (error) {
                    console.error('خطأ في إرسال التقييم:', error);
                    this.showNotification('فشل في حفظ التقييم', 'error');
                }
            });
        }
    }
    
    /**
     * إرسال التقييم
     */
    async submitRating(postId, rating, comment) {
        const formData = new FormData();
        formData.append('action', 'ps_submit_rating');
        formData.append('post_id', postId);
        formData.append('rating', rating);
        formData.append('comment', comment);
        formData.append('nonce', psSettings.nonce);
        
        const response = await fetch(psSettings.ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });
        
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.data || 'فشل في إرسال التقييم');
        }
        
        return data.data;
    }
    
    /**
     * تحديث أزرار التقييم
     */
    updateRatingButtons(buttons, rating) {
        buttons.forEach((button, index) => {
            button.classList.toggle('active', index < rating);
        });
    }
    
    /**
     * معاينة التقييم
     */
    previewRating(buttons, rating) {
        buttons.forEach((button, index) => {
            button.style.color = index < rating ? 'var(--ps-star-color)' : 'var(--ps-star-empty)';
        });
    }
    
    /**
     * إعادة تعيين أزرار التقييم
     */
    resetRatingButtons(buttons) {
        buttons.forEach(button => {
            button.classList.remove('active');
            button.style.color = '';
        });
    }
    
    /**
     * تحديث عرض التقييم
     */
    updateRatingDisplay(widget, newRating) {
        const averageElement = widget.querySelector('.ps-rating-average');
        const starsContainer = widget.querySelector('.ps-rating-stars');
        
        if (averageElement) {
            averageElement.textContent = newRating.toFixed(1);
        }
        
        if (starsContainer) {
            const stars = starsContainer.querySelectorAll('.ps-star');
            stars.forEach((star, index) => {
                star.classList.toggle('active', index < newRating);
            });
        }
    }
    
    /**
     * تتبع التفاعلات
     */
    trackInteraction(action, data = {}) {
        this.sendAnalytics('interaction', {
            action: action,
            ...data,
            timestamp: Date.now(),
            url: window.location.href
        });
    }
    
    /**
     * إرسال التحليلات
     */
    sendAnalytics# 🚀 تطوير القالب - الملفات المحدثة والجديدة


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
 * نظام التقييمات المتقدم للحلول العملية
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
        add_action('wp_ajax_ps_submit_rating', array($this, 'submit_rating'));
        add_action('wp_ajax_nopriv_ps_submit_rating', array($this, 'submit_rating'));
        add_action('wp_ajax_ps_get_ratings', array($this, 'get_ratings'));
        add_action('wp_ajax_nopriv_ps_get_ratings', array($this, 'get_ratings'));
        add_action('wp_head', array($this, 'add_rating_schema'));
    }
    
    /**
     * تهيئة النظام
     */
    public function init() {
        $this->create_rating_table();
        $this->register_rating_block();
        add_shortcode('ps_rating', array($this, 'rating_shortcode'));
    }
    
    /**
     * إنشاء جدول التقييمات
     */
    private function create_rating_table() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT NULL,
            user_ip varchar(45) NOT NULL,
            rating tinyint(1) NOT NULL,
            comment text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY user_id (user_id),
            KEY rating (rating)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * تسجيل Block التقييم
     */
    public function register_rating_block() {
        wp_register_script(
            'ps-rating-block',
            PS_THEME_URI . '/assets/js/rating-block.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            PS_THEME_VERSION
        );
        
        register_block_type('practical-solutions/rating', array(
            'editor_script' => 'ps-rating-block',
            'render_callback' => array($this, 'render_rating_block')
        ));
    }
    
    /**
     * عرض block التقييم
     */
    public function render_rating_block($attributes) {
        $post_id = get_the_ID();
        if (!$post_id) return '';
        
        $rating_data = $this->get_post_rating_data($post_id);
        
        ob_start();
        ?>
        <div class="ps-rating-widget" data-post-id="<?php echo esc_attr($post_id); ?>">
            <div class="ps-rating-display">
                <div class="ps-rating-stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="ps-star <?php echo $i <= $rating_data['average'] ? 'active' : ''; ?>" 
                              data-rating="<?php echo $i; ?>">⭐</span>
                    <?php endfor; ?>
                </div>
                <div class="ps-rating-info">
                    <span class="ps-rating-average"><?php echo number_format($rating_data['average'], 1); ?></span>
                    <span class="ps-rating-count">(<?php echo $rating_data['count']; ?> تقييم)</span>
                </div>
            </div>
            
            <div class="ps-rating-form" style="display: none;">
                <h4>قيّم هذا الحل:</h4>
                <div class="ps-rating-input">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <button type="button" class="ps-rating-btn" data-value="<?php echo $i; ?>">
                            <span class="ps-star-icon">⭐</span>
                        </button>
                    <?php endfor; ?>
                </div>
                <textarea class="ps-rating-comment" placeholder="أضف تعليقك (اختياري)..." rows="3"></textarea>
                <div class="ps-rating-actions">
                    <button type="button" class="ps-submit-rating btn-primary">إرسال التقييم</button>
                    <button type="button" class="ps-cancel-rating btn-secondary">إلغاء</button>
                </div>
            </div>
            
            <button class="ps-rate-button" type="button">
                <span class="icon">👍</span>
                <span class="text">قيّم هذا الحل</span>
            </button>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * shortcode التقييم
     */
    public function rating_shortcode($atts) {
        $atts = shortcode_atts(array(
            'post_id' => get_the_ID(),
            'show_form' => true,
            'show_comments' => false
        ), $atts);
        
        // --- السطر الذي تم تعديله ---
        return $this->render_rating_block($atts);
    }
    
    /**
     * إرسال التقييم
     */
    public function submit_rating() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'ps_rating_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        $post_id = intval($_POST['post_id']);
        $rating = intval($_POST['rating']);
        $comment = sanitize_textarea_field($_POST['comment']);
        $user_id = get_current_user_id();
        $user_ip = $this->get_user_ip();
        
        // التحقق من صحة البيانات
        if (!$post_id || $rating < 1 || $rating > 5) {
            wp_send_json_error('بيانات غير صالحة');
        }
        
        // منع التقييم المتكرر
        if ($this->user_already_rated($post_id, $user_id, $user_ip)) {
            wp_send_json_error('لقد قمت بتقييم هذا المحتوى مسبقاً');
        }
        
        // حفظ التقييم
        global $wpdb;
        
        $result = $wpdb->insert(
            $this->table_name,
            array(
                'post_id' => $post_id,
                'user_id' => $user_id ?: null,
                'user_ip' => $user_ip,
                'rating' => $rating,
                'comment' => $comment
            ),
            array('%d', '%d', '%s', '%d', '%s')
        );
        
        if ($result === false) {
            wp_send_json_error('فشل في حفظ التقييم');
        }
        
        // تحديث البيانات الإحصائية
        $this->update_post_rating_meta($post_id);
        
        // إرسال الاستجابة
        $rating_data = $this->get_post_rating_data($post_id);
        wp_send_json_success(array(
            'message' => 'تم حفظ تقييمك بنجاح!',
            'rating_data' => $rating_data
        ));
    }
    
    /**
     * جلب التقييمات
     */
    public function get_ratings() {
        $post_id = intval($_GET['post_id']);
        $page = max(1, intval($_GET['page']));
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        
        global $wpdb;
        
        $ratings = $wpdb->get_results($wpdb->prepare("
            SELECT r.*, u.display_name 
            FROM {$this->table_name} r 
            LEFT JOIN {$wpdb->users} u ON r.user_id = u.ID 
            WHERE r.post_id = %d 
            ORDER BY r.created_at DESC 
            LIMIT %d OFFSET %d
        ", $post_id, $per_page, $offset));
        
        $total = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(*) FROM {$this->table_name} WHERE post_id = %d
        ", $post_id));
        
        wp_send_json_success(array(
            'ratings' => $ratings,
            'total' => intval($total),
            'page' => $page,
            'has_more' => ($offset + $per_page) < $total
        ));
    }
    
    /**
     * جلب بيانات تقييم المقال
     */
    private function get_post_rating_data($post_id) {
        global $wpdb;
        
        $results = $wpdb->get_row($wpdb->prepare("
            SELECT 
                AVG(rating) as average,
                COUNT(*) as count,
                SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
            FROM {$this->table_name} 
            WHERE post_id = %d
        ", $post_id));
        
        return array(
            'average' => $results ? round(floatval($results->average), 1) : 0,
            'count' => $results ? intval($results->count) : 0,
            'distribution' => array(
                5 => $results ? intval($results->five_star) : 0,
                4 => $results ? intval($results->four_star) : 0,
                3 => $results ? intval($results->three_star) : 0,
                2 => $results ? intval($results->two_star) : 0,
                1 => $results ? intval($results->one_star) : 0,
            )
        );
    }
    
    /**
     * تحديث meta data للمقال
     */
    private function update_post_rating_meta($post_id) {
        $rating_data = $this->get_post_rating_data($post_id);
        update_post_meta($post_id, '_ps_rating_average', $rating_data['average']);
        update_post_meta($post_id, '_ps_rating_count', $rating_data['count']);
        update_post_meta($post_id, '_ps_rating_distribution', $rating_data['distribution']);
    }
    
    /**
     * التحقق من تقييم المستخدم السابق
     */
    private function user_already_rated($post_id, $user_id, $user_ip) {
        global $wpdb;
        
        if ($user_id) {
            $count = $wpdb->get_var($wpdb->prepare("
                SELECT COUNT(*) FROM {$this->table_name} 
                WHERE post_id = %d AND user_id = %d
            ", $post_id, $user_id));
        } else {
            $count = $wpdb->get_var($wpdb->prepare("
                SELECT COUNT(*) FROM {$this->table_name} 
                WHERE post_id = %d AND user_ip = %s
            ", $post_id, $user_ip));
        }
        
        return intval($count) > 0;
    }
    
    /**
     * الحصول على IP المستخدم
     */
    private function get_user_ip() {
        $ip_fields = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_fields as $field) {
            if (!empty($_SERVER[$field])) {
                $ips = explode(',', $_SERVER[$field]);
                return trim($ips[0]);
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    /**
     * إضافة Schema للتقييمات
     */
    public function add_rating_schema() {
        if (!is_single()) return;
        
        $post_id = get_the_ID();
        $rating_data = $this->get_post_rating_data($post_id);
        
        if ($rating_data['count'] === 0) return;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'aggregateRating' => array(
                '@type' => 'AggregateRating',
                'ratingValue' => $rating_data['average'],
                'ratingCount' => $rating_data['count'],
                'bestRating' => 5,
                'worstRating' => 1
             )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}

// تهيئة النظام
new PS_Rating_System();

/**
 * Helper functions
 */
if ( ! function_exists( 'ps_get_post_rating' ) ) {
    function ps_get_post_rating($post_id = null) {
        if (!$post_id) $post_id = get_the_ID();
        
        $average = get_post_meta($post_id, '_ps_rating_average', true);
        $count = get_post_meta($post_id, '_ps_rating_count', true);
        
        return array(
            'average' => floatval($average),
            'count' => intval($count)
        );
    }
}

if ( ! function_exists( 'ps_display_rating_stars' ) ) {
    function ps_display_rating_stars($rating, $size = 'medium') {
        $size_class = 'ps-stars-' . $size;
        $full_stars = floor($rating);
        $half_star = ($rating - $full_stars) >= 0.5;
        
        $output = '<div class="ps-rating-stars ' . $size_class . '">';
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $full_stars) {
                $output .= '<span class="ps-star full">⭐</span>';
            } elseif ($i == $full_stars + 1 && $half_star) {
                $output .= '<span class="ps-star half">⭐</span>';
            } else {
                $output .= '<span class="ps-star empty">☆</span>';
            }
        }
        
        $output .= '</div>';
        return $output;
    }
}


📁 اسم الملف: enhanced-voice-search.js
/**
 * Enhanced Voice Search with AI
 * البحث الصوتي المحسن مع الذكاء الاصطناعي
 */

class PSEnhancedVoiceSearch {
    constructor() {
        this.recognition = null;
        this.isListening = false;
        this.finalTranscript = '';
        this.interimTranscript = '';
        this.silenceTimer = null;
        this.confidenceThreshold = 0.7;
        this.maxRecordingTime = 10000; // 10 seconds
        this.commands = new Map();
        this.audioContext = null;
        this.analyser = null;
        this.microphone = null;
        
        this.init();
    }
    
    /**
     * تهيئة البحث الصوتي
     */
    init() {
        if (!this.checkBrowserSupport()) {
            console.warn('البحث الصوتي غير مدعوم في هذا المتصفح');
            return;
        }
        
        this.setupSpeechRecognition();
        this.registerVoiceCommands();
        this.bindEvents();
        this.createVisualization();
    }
    
    /**
     * فحص دعم المتصفح
     */
    checkBrowserSupport() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        return !!SpeechRecognition && !!navigator.mediaDevices && !!navigator.mediaDevices.getUserMedia;
    }
    
    /**
     * إعداد التعرف الصوتي
     */
    setupSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        this.recognition = new SpeechRecognition();
        
        // الإعدادات المتقدمة
        this.recognition.continuous = true;
        this.recognition.interimResults = true;
        this.recognition.maxAlternatives = 3;
        this.recognition.lang = this.detectLanguage();
        
        // الأحداث
        this.recognition.onstart = () => this.onRecognitionStart();
        this.recognition.onresult = (event) => this.onRecognitionResult(event);
        this.recognition.onerror = (event) => this.onRecognitionError(event);
        this.recognition.onend = () => this.onRecognitionEnd();
        this.recognition.onspeechstart = () => this.onSpeechStart();
        this.recognition.onspeechend = () => this.onSpeechEnd();
        this.recognition.onaudiostart = () => this.onAudioStart();
        this.recognition.onaudioend = () => this.onAudioEnd();
    }
    
    /**
     * تسجيل الأوامر الصوتية
     */
    registerVoiceCommands() {
        // الأوامر باللغة العربية
        this.commands.set(/ابحث عن (.+)/, (match) => {
            this.performSearch(match[1]);
        });
        
        this.commands.set(/اذهب إلى (.+)/, (match) => {
            this.navigateTo(match[1]);
        });
        
        this.commands.set(/افتح (.+)/, (match) => {
            this.openSection(match[1]);
        });
        
        this.commands.set(/(توقف|إيقاف|قف)/, () => {
            this.stopListening();
        });
        
        this.commands.set(/(إرسال|أرسل)/, () => {
            this.submitCurrentSearch();
        });
        
        this.commands.set(/(امسح|احذف|مسح)/, () => {
            this.clearSearch();
        });
        
        // الأوامر باللغة الإنجليزية
        this.commands.set(/search for (.+)/, (match) => {
            this.performSearch(match[1]);
        });
        
        this.commands.set(/go to (.+)/, (match) => {
            this.navigateTo(match[1]);
        });
        
        this.commands.set(/open (.+)/, (match) => {
            this.openSection(match[1]);
        });
    }
    
    /**
     * ربط الأحداث
     */
    bindEvents() {
        // أزرار البحث الصوتي
        document.querySelectorAll('.ps-voice-btn, .ps-hero-voice-btn').forEach(btn => {
            btn.addEventListener('click', (e) => this.toggleVoiceSearch(e));
        });
        
        // اختصارات لوحة المفاتيح
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === ' ') {
                e.preventDefault();
                this.toggleVoiceSearch();
            }
            
            if (e.key === 'Escape' && this.isListening) {
                this.stopListening();
            }
        });
        
        // التحكم بالصوت
        document.addEventListener('keydown', (e) => {
            if (e.key === 'F9') {
                e.preventDefault();
                this.toggleVoiceSearch();
            }
        });
    }
    
    /**
     * إنشاء المصور الصوتي
     */
    async createVisualization() {
        try {
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.analyser = this.audioContext.createAnalyser();
            this.analyser.fftSize = 256;
            
            const stream = await navigator.mediaDevices.getUserMedia({ 
                audio: {
                    echoCancellation: true,
                    noiseSuppression: true,
                    autoGainControl: true
                } 
            });
            
            this.microphone = this.audioContext.createMediaStreamSource(stream);
            this.microphone.connect(this.analyser);
            
        } catch (error) {
            console.warn('فشل في إنشاء المصور الصوتي:', error);
        }
    }
    
    /**
     * كشف اللغة التلقائي
     */
    detectLanguage() {
        const htmlLang = document.documentElement.lang;
        const userLang = navigator.language || navigator.userLanguage;
        
        if (htmlLang.startsWith('ar')) {
            return 'ar-SA';
        } else if (htmlLang.startsWith('en')) {
            return 'en-US';
        }
        
        return userLang.startsWith('ar') ? 'ar-SA' : 'en-US';
    }
    
    /**
     * تبديل حالة البحث الصوتي
     */
    toggleVoiceSearch(event = null) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        if (this.isListening) {
            this.stopListening();
        } else {
            this.startListening();
        }
    }
    
    /**
     * بدء الاستماع
     */
    async startListening() {
        if (!this.recognition || this.isListening) return;
        
        try {
            // طلب إذن الميكروفون
            await navigator.mediaDevices.getUserMedia({ audio: true });
            
            this.isListening = true;
            this.finalTranscript = '';
            this.interimTranscript = '';
            
            // بدء التسجيل
            this.recognition.start();
            
            // تايمر الحد الأقصى للتسجيل
            setTimeout(() => {
                if (this.isListening) {
                    this.stopListening();
                }
            }, this.maxRecordingTime);
            
            // إظهار واجهة الاستماع
            this.showListeningUI();
            
        } catch (error) {
            this.handleError(error);
        }
    }
    
    /**
     * إيقاف الاستماع
     */
    stopListening() {
        if (!this.isListening) return;
        
        this.isListening = false;
        
        if (this.recognition) {
            this.recognition.stop();
        }
        
        if (this.silenceTimer) {
            clearTimeout(this.silenceTimer);
            this.silenceTimer = null;
        }
        
        this.hideListeningUI();
    }
    
    /**
     * معالجة نتائج التعرف الصوتي
     */
    onRecognitionResult(event) {
        let interimTranscript = '';
        let finalTranscript = '';
        
        for (let i = event.resultIndex; i < event.results.length; i++) {
            const result = event.results[i];
            const transcript = result[0].transcript;
            const confidence = result[0].confidence;
            
            if (result.isFinal) {
                if (confidence >= this.confidenceThreshold) {
                    finalTranscript += transcript;
                } else {
                    // محاولة تحسين النص باستخدام البدائل
                    const bestAlternative = this.findBestAlternative(result);
                    if (bestAlternative) {
                        finalTranscript += bestAlternative;
                    }
                }
            } else {
                interimTranscript += transcript;
            }
        }
        
        this.finalTranscript += finalTranscript;
        this.interimTranscript = interimTranscript;
        
        // تحديث واجهة المستخدم
        this.updateTranscriptDisplay();
        
        // معالجة النص النهائي
        if (finalTranscript.trim()) {
            this.processFinalTranscript(finalTranscript.trim());
        }
        
        // إعادة تعيين تايمر الصمت
        this.resetSilenceTimer();
    }
    
    /**
     * العثور على أفضل بديل
     */
    findBestAlternative(result) {
        let bestTranscript = '';
        let bestConfidence = 0;
        
        for (let i = 0; i < result.length && i < result.length; i++) {
            const alternative = result[i];
            if (alternative.confidence > bestConfidence) {
                bestConfidence = alternative.confidence;
                bestTranscript = alternative.transcript;
            }
        }
        
        return bestConfidence >= (this.confidenceThreshold - 0.2) ? bestTranscript : null;
    }
    
    /**
     * معالجة النص النهائي
     */
    processFinalTranscript(transcript) {
        const cleanTranscript = this.cleanTranscript(transcript);
        
        // البحث عن أوامر صوتية
        const commandExecuted = this.executeVoiceCommand(cleanTranscript);
        
        if (!commandExecuted) {
            // تحليل النص للبحث
            const searchQuery = this.analyzeSearchIntent(cleanTranscript);
            this.updateSearchInput(searchQuery);
        }
    }
    
    /**
     * تنظيف النص
     */
    cleanTranscript(transcript) {
        return transcript
            .trim()
            .replace(/\s+/g, ' ')
            .replace(/[،,]\s*$/, '')
            .replace(/^(ابحث عن|بحث عن|أريد|أبحث عن)\s+/i, '');
    }
    
    /**
     * تنفيذ الأوامر الصوتية
     */
    executeVoiceCommand(transcript) {
        for (const [pattern, handler] of this.commands) {
            const match = transcript.match(pattern);
            if (match) {
                handler(match);
                return true;
            }
        }
        return false;
    }
    
    /**
     * تحليل نية البحث
     */
    analyzeSearchIntent(transcript) {
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
    }
    
    /**
     * تصحيح الأخطاء الشائعة
     */
    correctCommonMistakes(query) {
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
    }
    
    /**
     * توسيع الاستعلام بالمرادفات
     */
    expandQuery(query) {
        const synonyms = {
            'تنظيف': ['تنظيف', 'تطهير', 'تنضيف', 'غسيل'],
            'ترتيب': ['ترتيب', 'تنظيم', 'تنسيق'],
            'مطبخ': ['مطبخ', 'كيتشن', 'مطابخ'],
            'منزل': ['منزل', 'بيت', 'دار', 'مسكن']
        };
        
        // إضافة المرادفات للكلمات المهمة
        let expandedQuery = query;
        Object.keys(synonyms).forEach(word => {
            if (query.includes(word)) {
                // لا نريد إضافة جميع المرادفات، فقط نحسن الاستعلام
                expandedQuery = query; // نحتفظ بالاستعلام الأصلي
            }
        });
        
        return expandedQuery;
    }
    
    /**
     * تحديث حقل البحث
     */
    updateSearchInput(query) {
        const searchInputs = document.querySelectorAll('.ps-search-input, .ps-hero-search-input, #search-input');
        
        searchInputs.forEach(input => {
            input.value = query;
            
            // تفعيل حدث input للاقتراحات
            const inputEvent = new Event('input', { bubbles: true });
            input.dispatchEvent(inputEvent);
        });
    }
    
    /**
     * إجراءات الأوامر الصوتية
     */
    performSearch(query) {
        this.updateSearchInput(query);
        
        // تنفيذ البحث تلقائياً بعد ثانية
        setTimeout(() => {
            const searchForm = document.querySelector('.ps-search-form, .ps-hero-search-form');
            if (searchForm) {
                searchForm.dispatchEvent(new Event('submit'));
            }
        }, 1000);
        
        this.stopListening();
    }
    
    navigateTo(destination) {
        const routes = {
            'الرئيسية': '/',
            'المنزل': '/category/home',
            'المطبخ': '/category/kitchen',
            'النصائح': '/category/lifestyle',
            'اتصل بنا': '/contact'
        };
        
        const url = routes[destination] || `/?s=${encodeURIComponent(destination)}`;
        window.location.href = url;
        
        this.stopListening();
    }
    
    openSection(section) {
        const selectors = {
            'البحث': '.ps-search-input',
            'القائمة': '.ps-main-navigation',
            'الفئات': '.ps-categories'
        };
        
        const selector = selectors[section];
        if (selector) {
            const element = document.querySelector(selector);
            if (element) {
                element.focus();
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        this.stopListening();
    }
    
    submitCurrentSearch() {
        const searchForm = document.querySelector('.ps-search-form, .ps-hero-search-form');
        if (searchForm) {
            searchForm.dispatchEvent(new Event('submit'));
        }
        this.stopListening();
    }
    
    clearSearch() {
        const searchInputs = document.querySelectorAll('.ps-search-input, .ps-hero-search-input, #search-input');
        searchInputs.forEach(input => {
            input.value = '';
            input.focus();
        });
        this.stopListening();
    }
    
    /**
     * أحداث التعرف الصوتي
     */
    onRecognitionStart() {
        console.log('بدء التعرف الصوتي');
        this.updateVoiceButtons('listening');
    }
    
    onRecognitionEnd() {
        console.log('انتهاء التعرف الصوتي');
        this.isListening = false;
        this.updateVoiceButtons('idle');
        this.hideListeningUI();
    }
    
    onRecognitionError(event) {
        console.error('خطأ في التعرف الصوتي:', event.error);
        this.handleError(event.error);
        this.stopListening();
    }
    
    onSpeechStart() {
        console.log('بدء الكلام');
        this.resetSilenceTimer();
    }
    
    onSpeechEnd() {
        console.log('انتهاء الكلام');
        this.startSilenceTimer();
    }
    
    onAudioStart() {
        console.log('بدء الصوت');
        this.startAudioVisualization();
    }
    
    onAudioEnd() {
        console.log('انتهاء الصوت');
        this.stopAudioVisualization();
    }
    
    /**
     * تايمر الصمت
     */
    resetSilenceTimer() {
        if (this.silenceTimer) {
            clearTimeout(this.silenceTimer);
        }
    }
    
    startSilenceTimer() {
        this.silenceTimer = setTimeout(() => {
            if (this.isListening) {
                this.stopListening();
            }
        }, 3000); // 3 seconds of silence
    }
    
    /**
     * تحديث أزرار الصوت
     */
    updateVoiceButtons(state) {
        const buttons = document.querySelectorAll('.ps-voice-btn, .ps-hero-voice-btn');
        
        buttons.forEach(btn => {
            btn.classList.remove('listening', 'processing', 'error');
            
            switch (state) {
                case 'listening':
                    btn.classList.add('listening');
                    btn.innerHTML = '🔴';
                    btn.title = 'جاري الاستماع - اضغط للإيقاف';
                    break;
                case 'processing':
                    btn.classList.add('processing');
                    btn.innerHTML = '⏳';
                    btn.title = 'جاري المعالجة...';
                    break;
                case 'error':
                    btn.classList.add('error');
                    btn.innerHTML = '❌';
                    btn.title = 'حدث خطأ - اضغط للمحاولة مرة أخرى';
                    break;
                default:
                    btn.innerHTML = '🎤';
                    btn.title = 'البحث الصوتي';
            }
        });
    }
    
    /**
     * إظهار واجهة الاستماع
     */
    showListeningUI() {
        // إنشاء overlay للاستماع إذا لم يكن موجوداً
        if (!document.querySelector('.ps-voice-overlay')) {
            const overlay = document.createElement('div');
            overlay.className = 'ps-voice-overlay';
            overlay.innerHTML = `
                <div class="ps-voice-modal">
                    <div class="ps-voice-header">
                        <h3>🎤 البحث الصوتي نشط</h3>
                        <button class="ps-voice-close" type="button">×</button>
                    </div>
                    <div class="ps-voice-content">
                        <div class="ps-voice-visualizer">
                            <canvas class="ps-voice-canvas" width="300" height="100"></canvas>
                        </div>
                        <div class="ps-voice-transcript">
                            <div class="ps-final-transcript"></div>
                            <div class="ps-interim-transcript"></div>
                        </div>
                        <div class="ps-voice-status">جاري الاستماع...</div>
                        <div class="ps-voice-tips">
                            <p>💡 جرب قول: "ابحث عن تنظيف المطبخ" أو "اذهب إلى النصائح"</p>
                        </div>
                    </div>
                    <div class="ps-voice-controls">
                        <button class="ps-voice-stop" type="button">إيقاف</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(overlay);
            
            // ربط الأحداث
            overlay.querySelector('.ps-voice-close').addEventListener('click', () => this.stopListening());
            overlay.querySelector('.ps-voice-stop').addEventListener('click', () => this.stopListening());
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) this.stopListening();
            });
        }
        
        const overlay = document.querySelector('.ps-voice-overlay');
        overlay.style.display = 'flex';
        
        // تحريك الإظهار
        requestAnimationFrame(() => {
            overlay.classList.add('active');
        });
    }
    
    /**
     * إخفاء واجهة الاستماع
     */
    hideListeningUI() {
        const overlay = document.querySelector('.ps-voice-overlay');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 300);
        }
    }
    
    /**
     * تحديث عرض النص
     */
    updateTranscriptDisplay() {
        const finalElement = document.querySelector('.ps-final-transcript');
        const interimElement = document.querySelector('.ps-interim-transcript');
        
        if (finalElement) {
            finalElement.textContent = this.finalTranscript;
        }
        
        if (interimElement) {
            interimElement.textContent = this.interimTranscript;
        }
    }
    
    /**
     * بدء المصور الصوتي
     */
    startAudioVisualization() {
        if (!this.analyser) return;
        
        const canvas = document.querySelector('.ps-voice-canvas');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        const bufferLength = this.analyser.frequencyBinCount;
        const dataArray = new Uint8Array(bufferLength);
        
        const draw = () => {
            if (!this.isListening) return;
            
            requestAnimationFrame(draw);
            
            this.analyser.getByteFrequencyData(dataArray);
            
            ctx.fillStyle = 'rgba(0, 123, 186, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            const barWidth = (canvas.width / bufferLength) * 2.5;
            let barHeight;
            let x = 0;
            
            for (let i = 0; i < bufferLength; i++) {
                barHeight = dataArray[i] / 255 * canvas.height;
                
                const gradient = ctx.createLinearGradient(0, canvas.height - barHeight, 0, canvas.height);
                gradient.addColorStop(0, '#007cba');
                gradient.addColorStop(1, '#005a87');
                
                ctx.fillStyle = gradient;
                ctx.fillRect(x, canvas.height - barHeight, barWidth, barHeight);
                
                x += barWidth + 1;
            }
        };
        
        draw();
    }
    
    /**
     * إيقاف المصور الصوتي
     */
    stopAudioVisualization() {
        const canvas = document.querySelector('.ps-voice-canvas');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    }
    
    /**
     * معالجة الأخطاء
     */
    handleError(error) {
        let message = 'حدث خطأ في البحث الصوتي';
        
        switch (error) {
            case 'not-allowed':
                message = 'يرجى السماح بالوصول للميكروفون';
                break;
            case 'no-speech':
                message = 'لم يتم سماع أي صوت';
                break;
            case 'audio-capture':
                message = 'لا يمكن الوصول للميكروفون';
                break;
            case 'network':
                message = 'مشكلة في الاتصال بالإنترنت';
                break;
            case 'service-not-allowed':
                message = 'خدمة التعرف الصوتي غير متاحة';
                break;
        }
        
        this.updateVoiceButtons('error');
        
        // إظهار رسالة خطأ
        if (window.psTheme && window.psTheme.showNotification) {
            window.psTheme.showNotification(message, 'error', 3000);
        } else {
            console.error(message);
        }
        
        // إعادة تعيين الحالة بعد 3 ثوان
        setTimeout(() => {
            this.updateVoiceButtons('idle');
        }, 3000);
    }
}

// تهيئة البحث الصوتي المحسن
document.addEventListener('DOMContentLoaded', () => {
    window.psEnhancedVoiceSearch = new PSEnhancedVoiceSearch();
});


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
 * الميزات التفاعلية المتقدمة للحلول العملية
 */

class PSInteractiveFeatures {
    constructor() {
        this.bookmarks = new Set(JSON.parse(localStorage.getItem('ps_bookmarks') || '[]'));
        this.readingProgress = new Map();
        this.userActivity = {
            scrollDepth: 0,
            timeOnPage: 0,
            interactionCount: 0,
            startTime: Date.now()
        };
        this.notifications = [];
        this.shareData = null;
        
        this.init();
    }
    
    /**
     * تهيئة الميزات التفاعلية
     */
    init() {
        this.initReadingProgress();
        this.initBookmarks();
        this.initSocialSharing();
        this.initToolTips();
        this.initModalSystem();
        this.initNotifications();
        this.initUserTracking();
        this.initKeyboardShortcuts();
        this.initContextMenu();
        this.initProgressiveDisclosure();
        this.initInfiniteScroll();
        this.initImageZoom();
        this.initPrintOptimization();
    }
    
    /**
     * شريط تقدم القراءة
     */
    initReadingProgress() {
        // إنشاء شريط التقدم
        const progressBar = document.createElement('div');
        progressBar.className = 'ps-reading-progress';
        progressBar.innerHTML = `
            <div class="ps-progress-fill"></div>
            <div class="ps-progress-info">
                <span class="ps-reading-time">⏱️ <span id="reading-time">0</span> دقيقة</span>
                <span class="ps-progress-percent"><span id="progress-percent">0</span>%</span>
            </div>
        `;
        document.body.appendChild(progressBar);
        
        // تحديث التقدم عند التمرير
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    this.updateReadingProgress();
                    ticking = false;
                });
                ticking = true;
            }
        });
        
        // حساب وقت القراءة المقدر
        this.calculateReadingTime();
    }
    
    /**
     * تحديث شريط تقدم القراءة
     */
    updateReadingProgress() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        
        const progressFill = document.querySelector('.ps-progress-fill');
        const progressPercent = document.getElementById('progress-percent');
        
        if (progressFill) {
            progressFill.style.width = scrolled + '%';
        }
        
        if (progressPercent) {
            progressPercent.textContent = Math.round(scrolled);
        }
        
        // تتبع أقصى عمق تمرير
        this.userActivity.scrollDepth = Math.max(this.userActivity.scrollDepth, scrolled);
        
        // إظهار/إخفاء شريط التقدم
        const progressBar = document.querySelector('.ps-reading-progress');
        if (progressBar) {
            progressBar.classList.toggle('visible', winScroll > 100);
        }
    }
    
    /**
     * حساب وقت القراءة
     */
    calculateReadingTime() {
        const content = document.querySelector('.wp-block-post-content, .ps-single-content, .entry-content');
        if (!content) return;
        
        const text = content.textContent || content.innerText || '';
        const wordsPerMinute = 200; // متوسط سرعة القراءة بالعربية
        const words = text.trim().split(/\s+/).length;
        const readingTime = Math.ceil(words / wordsPerMinute);
        
        const readingTimeElement = document.getElementById('reading-time');
        if (readingTimeElement) {
            readingTimeElement.textContent = readingTime;
        }
    }
    
    /**
     * نظام الإشارات المرجعية
     */
    initBookmarks() {
        // إضافة زر الإشارة المرجعية لكل مقال
        const postContainers = document.querySelectorAll('.ps-single-content, .wp-block-post-content');
        
        postContainers.forEach(container => {
            const postId = this.getPostId();
            if (!postId) return;
            
            const bookmarkBtn = document.createElement('button');
            bookmarkBtn.className = 'ps-bookmark-btn';
            bookmarkBtn.innerHTML = this.bookmarks.has(postId.toString()) ? '💾 محفوظ' : '🔖 حفظ';
            bookmarkBtn.setAttribute('aria-label', 'حفظ المقال');
            
            bookmarkBtn.addEventListener('click', () => this.toggleBookmark(postId, bookmarkBtn));
            
            // إدراج الزر في مكان مناسب
            const header = container.previousElementSibling;
            if (header) {
                header.appendChild(bookmarkBtn);
            }
        });
        
        // إنشاء قائمة المحفوظات
        this.createBookmarksList();
    }
    
    /**
     * تبديل حالة الإشارة المرجعية
     */
    toggleBookmark(postId, button) {
        const postIdStr = postId.toString();
        
        if (this.bookmarks.has(postIdStr)) {
            this.bookmarks.delete(postIdStr);
            button.innerHTML = '🔖 حفظ';
            this.showNotification('تم إلغاء الحفظ', 'info');
        } else {
            this.bookmarks.add(postIdStr);
            button.innerHTML = '💾 محفوظ';
            button.classList.add('saved');
            this.showNotification('تم حفظ المقال', 'success');
        }
        
        // حفظ في التخزين المحلي
        localStorage.setItem('ps_bookmarks', JSON.stringify([...this.bookmarks]));
        
        // تحديث عداد المحفوظات
        this.updateBookmarksCount();
    }
    
    /**
     * إنشاء قائمة المحفوظات
     */
    createBookmarksList() {
        const bookmarksWidget = document.createElement('div');
        bookmarksWidget.className = 'ps-bookmarks-widget';
        bookmarksWidget.innerHTML = `
            <button class="ps-bookmarks-toggle" type="button">
                📚 المحفوظات (<span class="ps-bookmarks-count">${this.bookmarks.size}</span>)
            </button>
            <div class="ps-bookmarks-panel" style="display: none;">
                <div class="ps-bookmarks-header">
                    <h3>📚 مقالاتك المحفوظة</h3>
                    <button class="ps-bookmarks-close">×</button>
                </div>
                <div class="ps-bookmarks-list">
                    <div class="ps-loading">جاري التحميل...</div>
                </div>
            </div>
        `;
        
        document.body.appendChild(bookmarksWidget);
        
        // ربط الأحداث
        const toggle = bookmarksWidget.querySelector('.ps-bookmarks-toggle');
        const panel = bookmarksWidget.querySelector('.ps-bookmarks-panel');
        const close = bookmarksWidget.querySelector('.ps-bookmarks-close');
        
        toggle.addEventListener('click', () => {
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
            if (panel.style.display === 'block') {
                this.loadBookmarksList();
            }
        });
        
        close.addEventListener('click', () => {
            panel.style.display = 'none';
        });
    }
    
    /**
     * تحميل قائمة المحفوظات
     */
    async loadBookmarksList() {
        const listContainer = document.querySelector('.ps-bookmarks-list');
        if (!listContainer || this.bookmarks.size === 0) {
            listContainer.innerHTML = '<div class="ps-empty">لا توجد مقالات محفوظة</div>';
            return;
        }
        
        listContainer.innerHTML = '<div class="ps-loading">جاري التحميل...</div>';
        
        try {
            const bookmarkIds = [...this.bookmarks];
            const response = await fetch(psSettings.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'ps_get_bookmarked_posts',
                    post_ids: bookmarkIds.join(','),
                    nonce: psSettings.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.renderBookmarksList(data.data);
            } else {
                listContainer.innerHTML = '<div class="ps-error">خطأ في تحميل المحفوظات</div>';
            }
        } catch (error) {
            console.error('خطأ في تحميل المحفوظات:', error);
            listContainer.innerHTML = '<div class="ps-error">خطأ في تحميل المحفوظات</div>';
        }
    }
    
    /**
     * عرض قائمة المحفوظات
     */
    renderBookmarksList(posts) {
        const listContainer = document.querySelector('.ps-bookmarks-list');
        
        if (posts.length === 0) {
            listContainer.innerHTML = '<div class="ps-empty">لا توجد مقالات محفوظة</div>';
            return;
        }
        
        const postsHtml = posts.map(post => `
            <div class="ps-bookmark-item" data-post-id="${post.ID}">
                <div class="ps-bookmark-content">
                    <h4><a href="${post.permalink}">${post.post_title}</a></h4>
                    <p>${post.excerpt}</p>
                    <div class="ps-bookmark-meta">
                        <span class="ps-date">${post.date}</span>
                        <button class="ps-remove-bookmark" data-post-id="${post.ID}">🗑️ إزالة</button>
                    </div>
                </div>
            </div>
        `).join('');
        
        listContainer.innerHTML = postsHtml;
        
        // ربط أحداث الإزالة
        listContainer.querySelectorAll('.ps-remove-bookmark').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const postId = btn.getAttribute('data-post-id');
                this.removeBookmark(postId, btn.closest('.ps-bookmark-item'));
            });
        });
    }
    
    /**
     * إزالة إشارة مرجعية
     */
    removeBookmark(postId, itemElement) {
        this.bookmarks.delete(postId.toString());
        localStorage.setItem('ps_bookmarks', JSON.stringify([...this.bookmarks]));
        
        // إزالة العنصر من القائمة
        itemElement.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => {
            itemElement.remove();
            this.updateBookmarksCount();
            
            // إظهار رسالة فارغة إذا لم تعد هناك مقالات
            const remainingItems = document.querySelectorAll('.ps-bookmark-item');
            if (remainingItems.length === 0) {
                document.querySelector('.ps-bookmarks-list').innerHTML = '<div class="ps-empty">لا توجد مقالات محفوظة</div>';
            }
        }, 300);
        
        this.showNotification('تم إلغاء الحفظ', 'info');
    }
    
    /**
     * تحديث عداد المحفوظات
     */
    updateBookmarksCount() {
        const counter = document.querySelector('.ps-bookmarks-count');
        if (counter) {
            counter.textContent = this.bookmarks.size;
        }
    }
    
    /**
     * نظام المشاركة الاجتماعية المحسن
     */
    initSocialSharing() {
        // إضافة أزرار المشاركة اللاصقة
        this.createStickyShareButtons();
        
        // تحسين المشاركة الأصلية
        this.enhanceExistingShareButtons();
        
        // إضافة مشاركة سريعة
        this.initQuickShare();
    }
    
    /**
     * إنشاء أزرار المشاركة اللاصقة
     */
    createStickyShareButtons() {
        if (!document.querySelector('.ps-single-content')) return;
        
        const stickyShare = document.createElement('div');
        stickyShare.className = 'ps-sticky-share';
        stickyShare.innerHTML = `
            <div class="ps-sticky-share-content">
                <div class="ps-share-title">شارك هذا المقال</div>
                <div class="ps-share-buttons">
                    <button class="ps-share-btn facebook" data-platform="facebook" title="مشاركة على فيسبوك">
                        <span class="icon">📘</span>
                    </button>
                    <button class="ps-share-btn twitter" data-platform="twitter" title="مشاركة على تويتر">
                        <span class="icon">🐦</span>
                    </button>
                    <button class="ps-share-btn whatsapp" data-platform="whatsapp" title="مشاركة على واتساب">
                        <span class="icon">💬</span>
                    </button>
                    <button class="ps-share-btn linkedin" data-platform="linkedin" title="مشاركة على لينكد إن">
                        <span class="icon">💼</span>
                    </button>
                    <button class="ps-share-btn copy" data-platform="copy" title="نسخ الرابط">
                        <span class="icon">📋</span>
                    </button>
                    <button class="ps-share-btn native" data-platform="native" title="مشاركة" style="display: none;">
                        <span class="icon">📤</span>
                    </button>
                </div>
                <div class="ps-share-stats">
                    <span class="ps-share-count">0 مشاركة</span>
                </div>
            </div>
        `;
        
        document.body.appendChild(stickyShare);
        
        // إظهار/إخفاء بناءً على التمرير
        window.addEventListener('scroll', () => {
            const shouldShow = window.pageYOffset > 200;
            stickyShare.classList.toggle('visible', shouldShow);
        });
        
        // فحص دعم Native Share API
        if (navigator.share) {
            stickyShare.querySelector('.ps-share-btn.native').style.display = 'flex';
        }
        
        // ربط أحداث المشاركة
        stickyShare.querySelectorAll('.ps-share-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const platform = btn.getAttribute('data-platform');
                this.shareContent(platform);
            });
        });
        
        // تحديث إحصائيات المشاركة
        this.updateShareStats();
    }
    
    /**
     * مشاركة المحتوى
     */
    async shareContent(platform) {
        const shareData = this.getShareData();
        
        try {
            switch (platform) {
                case 'facebook':
                    this.shareOnFacebook(shareData);
                    break;
                case 'twitter':
                    this.shareOnTwitter(shareData);
                    break;
                case 'whatsapp':
                    this.shareOnWhatsApp(shareData);
                    break;
                case 'linkedin':
                    this.shareOnLinkedIn(shareData);
                    break;
                case 'copy':
                    await this.copyToClipboard(shareData.url);
                    break;
                case 'native':
                    await this.shareNatively(shareData);
                    break;
            }
            
            // تتبع المشاركة
            this.trackShare(platform);
            
        } catch (error) {
            console.error('خطأ في المشاركة:', error);
            this.showNotification('فشل في المشاركة', 'error');
        }
    }
    
    /**
     * الحصول على بيانات المشاركة
     */
    getShareData() {
        if (this.shareData) {
            return this.shareData;
        }
        
        const title = document.title;
        const url = window.location.href;
        const description = document.querySelector('meta[name="description"]')?.content || 
                          document.querySelector('.wp-block-post-excerpt, .ps-excerpt')?.textContent || 
                          'اكتشف هذا الحل العملي المفيد';
        
        this.shareData = { title, url, description };
        return this.shareData;
    }
    
    /**
     * مشاركة على منصات مختلفة
     */
    shareOnFacebook(shareData) {
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareData.url)}&quote=${encodeURIComponent(shareData.title)}`;
        this.openShareWindow(shareUrl, 'facebook');
    }
    
    shareOnTwitter(shareData) {
        const text = `${shareData.title}\n\n${shareData.description}`;
        const shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareData.url)}&text=${encodeURIComponent(text)}`;
        this.openShareWindow(shareUrl, 'twitter');
    }
    
    shareOnWhatsApp(shareData) {
        const text = `${shareData.title}\n\n${shareData.description}\n\n${shareData.url}`;
        const shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`;
        window.open(shareUrl, '_blank');
    }
    
    shareOnLinkedIn(shareData) {
        const shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareData.url)}`;
        this.openShareWindow(shareUrl, 'linkedin');
    }
    
    async copyToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            this.showNotification('تم نسخ الرابط بنجاح!', 'success');
        } catch (error) {
            // Fallback للمتصفحات القديمة
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            document.body.appendChild(textArea);
            textArea.select();
            
            try {
                document.execCommand('copy');
                this.showNotification('تم نسخ الرابط بنجاح!', 'success');
            } catch (err) {
                this.showNotification('فشل في نسخ الرابط', 'error');
            }
            
            document.body.removeChild(textArea);
        }
    }
    
    async shareNatively(shareData) {
        if (navigator.share) {
            await navigator.share({
                title: shareData.title,
                text: shareData.description,
                url: shareData.url
            });
        }
    }
    
    /**
     * فتح نافذة المشاركة
     */
    openShareWindow(url, platform) {
        const windowFeatures = 'width=600,height=400,scrollbars=yes,resizable=yes';
        window.open(url, `share-${platform}`, windowFeatures);
    }
    
    /**
     * تتبع المشاركة
     */
    trackShare(platform) {
        // تحديث العداد المحلي
        const currentCount = parseInt(localStorage.getItem('ps_share_count') || '0');
        localStorage.setItem('ps_share_count', (currentCount + 1).toString());
        
        // إرسال إلى الخادم
        fetch(psSettings.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'ps_track_share',
                post_id: this.getPostId(),
                platform: platform,
                nonce: psSettings.nonce
            })
        });
        
        this.updateShareStats();
    }
    
    /**
     * تحديث إحصائيات المشاركة
     */
    updateShareStats() {
        const shareCount = localStorage.getItem('ps_share_count') || '0';
        const statsElement = document.querySelector('.ps-share-count');
        if (statsElement) {
            statsElement.textContent = `${shareCount} مشاركة`;
        }
    }
    
    /**
     * نظام الإشعارات
     */
    initNotifications() {
        // إنشاء حاوية الإشعارات
        const container = document.createElement('div');
        container.className = 'ps-notifications-container';
        document.body.appendChild(container);
    }
    
    /**
     * إظهار إشعار
     */
    showNotification(message, type = 'info', duration = 3000) {
        const notification = document.createElement('div');
        notification.className = `ps-notification ps-notification-${type}`;
        
        const icons = {
            success: '✅',
            error: '❌',
            warning: '⚠️',
            info: 'ℹ️'
        };
        
        notification.innerHTML = `
            <div class="ps-notification-content">
                <span class="ps-notification-icon">${icons[type] || icons.info}</span>
                <span class="ps-notification-message">${message}</span>
                <button class="ps-notification-close" aria-label="إغلاق">×</button>
            </div>
        `;
        
        const container = document.querySelector('.ps-notifications-container');
        container.appendChild(notification);
        
        // تحريك الدخول
        requestAnimationFrame(() => {
            notification.classList.add('show');
        });
        
        // حدث الإغلاق
        const closeBtn = notification.querySelector('.ps-notification-close');
        closeBtn.addEventListener('click', () => this.hideNotification(notification));
        
        // إغلاق تلقائي
        if (duration > 0) {
            setTimeout(() => this.hideNotification(notification), duration);
        }
        
        // إضافة للقائمة
        this.notifications.push(notification);
        
        return notification;
    }
    
    /**
     * إخفاء إشعار
     */
    hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
            
            // إزالة من القائمة
            const index = this.notifications.indexOf(notification);
            if (index > -1) {
                this.notifications.splice(index, 1);
            }
        }, 300);
    }
    
    /**
     * الحصول على ID المقال
     */
    getPostId() {
        // محاولة استخراج ID من أماكن مختلفة
        const body = document.body;
        
        // من كلاسات body
        const classMatch = body.className.match(/postid-(\d+)/);
        if (classMatch) {
            return parseInt(classMatch[1]);
        }
        
        // من data attribute
        const dataId = body.getAttribute('data-post-id');
        if (dataId) {
            return parseInt(dataId);
        }
        
        // من URL
        const urlMatch = window.location.pathname.match(/\/(\d+)\//);
        if (urlMatch) {
            return parseInt(urlMatch[1]);
        }
        
        return null;
    }
    
    /**
     * تتبع نشاط المستخدم
     */
    initUserTracking() {
        // تتبع الوقت على الصفحة
        setInterval(() => {
            this.userActivity.timeOnPage = Date.now() - this.userActivity.startTime;
        }, 1000);
        
        // تتبع التفاعلات
        document.addEventListener('click', () => {
            this.userActivity.interactionCount++;
        });
        
        // إرسال البيانات عند المغادرة
        window.addEventListener('beforeunload', () => {
            this.sendUserActivity();
        });
        
        // إرسال دوري كل 30 ثانية
        setInterval(() => {
            this.sendUserActivity();
        }, 30000);
    }
    
    /**
     * إرسال بيانات النشاط
     */
    sendUserActivity() {
        if (navigator.sendBeacon && psSettings.ajaxUrl) {
            const data = new FormData();
            data.append('action', 'ps_track_activity');
            data.append('post_id', this.getPostId() || 0);
            data.append('scroll_depth', this.userActivity.scrollDepth);
            data.append('time_on_page', this.userActivity.timeOnPage);
            data.append('interaction_count', this.userActivity.interactionCount);
            data.append('nonce', psSettings.nonce);
            
            navigator.sendBeacon(psSettings.ajaxUrl, data);
        }
    }
    
    /**
     * اختصارات لوحة المفاتيح
     */
    initKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // تجاهل إذا كان المستخدم يكتب في حقل
            if (e.target.matches('input, textarea, [contenteditable]')) {
                return;
            }
            
            switch (e.key.toLowerCase()) {
                case 'b':
                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        this.toggleBookmark(this.getPostId(), document.querySelector('.ps-bookmark-btn'));
                    }
                    break;
                    
                case 's':
                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        this.shareContent('native');
                    }
                    break;
                    
                case '/':
                    e.preventDefault();
                    const searchInput = document.querySelector('.ps-search-input, .ps-hero-search-input');
                    if (searchInput) {
                        searchInput.focus();
                    }
                    break;
                    
                case 'escape':
                    // إغلاق النوافذ المفتوحة
                    const openPanels = document.querySelectorAll('.ps-bookmarks-panel[style*="block"]');
                    openPanels.forEach(panel => panel.style.display = 'none');
                    break;
            }
        });
    }
    
    /**
     * القائمة السياقية المخصصة
     */
    initContextMenu() {
        let contextMenu = null;
        
        document.addEventListener('contextmenu', (e) => {
            // إظهار القائمة المخصصة فقط على المحتوى
            if (!e.target.closest('.ps-single-content, .wp-block-post-content')) {
                return;
            }
            
            e.preventDefault();
            
            // إزالة القائمة السابقة
            if (contextMenu) {
                contextMenu.remove();
            }
            
            // إنشاء قائمة جديدة
            contextMenu = document.createElement('div');
            contextMenu.className = 'ps-context-menu';
            contextMenu.innerHTML = `
                <div class="ps-context-item" data-action="copy-text">📋 نسخ النص</div>
                <div class="ps-context-item" data-action="share">📤 مشاركة</div>
                <div class="ps-context-item" data-action="bookmark">🔖 حفظ المقال</div>
                <div class="ps-context-item" data-action="print">🖨️ طباعة</div>
            `;
            
            // تحديد الموقع
            contextMenu.style.left = e.pageX + 'px';
            contextMenu.style.top = e.pageY + 'px';
            
            document.body.appendChild(contextMenu);
            
            // ربط الأحداث
            contextMenu.addEventListener('click', (e) => {
                const action = e.target.getAttribute('data-action');
                this.handleContextAction(action);
                contextMenu.remove();
                contextMenu = null;
            });
        });
        
        // إغلاق القائمة عند النقر خارجها
        document.addEventListener('click', () => {
            if (contextMenu) {
                contextMenu.remove();
                contextMenu = null;
            }
        });
    }
    
    /**
     * معالجة أحداث القائمة السياقية
     */
    handleContextAction(action) {
        switch (action) {
            case 'copy-text':
                const selectedText = window.getSelection().toString();
                if (selectedText) {
                    this.copyToClipboard(selectedText);
                }
                break;
                
            case 'share':
                this.shareContent('native');
                break;
                
            case 'bookmark':
                this.toggleBookmark(this.getPostId(), document.querySelector('.ps-bookmark-btn'));
                break;
                
            case 'print':
                window.print();
                break;
        }
    }
    
    /**
     * الكشف التدريجي للمحتوى
     */
    initProgressiveDisclosure() {
        const expandableSections = document.querySelectorAll('.ps-expandable, .wp-block-details');
        
        expandableSections.forEach(section => {
            if (!section.querySelector('.ps-expand-btn')) {
                const expandBtn = document.createElement('button');
                expandBtn.className = 'ps-expand-btn';
                expandBtn.innerHTML = 'عرض المزيد ▼';
                expandBtn.setAttribute('aria-expanded', 'false');
                
                const content = section.querySelector('.ps-expandable-content, .wp-block-details summary ~ *');
                if (content) {
                    content.style.maxHeight = '100px';
                    content.style.overflow = 'hidden';
                    
                    expandBtn.addEventListener('click', () => {
                        const isExpanded = expandBtn.getAttribute('aria-expanded') === 'true';
                        
                        if (isExpanded) {
                            content.style.maxHeight = '100px';
                            expandBtn.innerHTML = 'عرض المزيد ▼';
                            expandBtn.setAttribute('aria-expanded', 'false');
                        } else {
                            content.style.maxHeight = content.scrollHeight + 'px';
                            expandBtn.innerHTML = 'عرض أقل ▲';
                            expandBtn.setAttribute('aria-expanded', 'true');
                        }
                    });
                    
                    section.appendChild(expandBtn);
                }
            }
        });
    }
    
    /**
     * التمرير اللانهائي
     */
    initInfiniteScroll() {
        if (!document.querySelector('.ps-archive-content, .ps-blog-query')) {
            return;
        }
        
        let loading = false;
        let page = 2;
        
        const loadMore = async () => {
            if (loading) return;
            loading = true;
            
            try {
                const response = await fetch(window.location.href + (window.location.href.includes('?') ? '&' : '?') + 'page=' + page);
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newPosts = doc.querySelectorAll('.wp-block-post-template > *');
                
                if (newPosts.length > 0) {
                    const container = document.querySelector('.wp-block-post-template');
                    newPosts.forEach(post => {
                        container.appendChild(post.cloneNode(true));
                    });
                    
                    page++;
                } else {
                    // لا توجد مقالات أخرى
                    observer.disconnect();
                }
                
            } catch (error) {
                console.error('خطأ في تحميل المقالات:', error);
            } finally {
                loading = false;
            }
        };
        
        // إنشاء عنصر المراقبة
        const sentinel = document.createElement('div');
        sentinel.className = 'ps-infinite-scroll-sentinel';
        sentinel.style.height = '1px';
        
        const container = document.querySelector('.ps-archive-content, .ps-blog-query');
        container.appendChild(sentinel);
        
        // مراقب التقاطع
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadMore();
                }
            });
        }, {
            threshold: 0.1
        });
        
        observer.observe(sentinel);
    }
    
    /**
     * تكبير الصور
     */
    initImageZoom() {
        const images = document.querySelectorAll('.wp-block-image img, .ps-single-content img');
        
        images.forEach(img => {
            img.addEventListener('click', (e) => {
                if (img.naturalWidth > img.offsetWidth) {
                    this.showImageModal(img);
                }
            });
            
            // إضافة مؤشر التكبير
            img.style.cursor = img.naturalWidth > img.offsetWidth ? 'zoom-in' : 'default';
        });
    }
    
    /**
     * عرض مودال الصورة
     */
    showImageModal(img) {
        const modal = document.createElement('div');
        modal.className = 'ps-image-modal';
        modal.innerHTML = `
            <div class="ps-image-modal-backdrop">
                <div class="ps-image-modal-content">
                    <img src="${img.src}" alt="${img.alt}" />
                    <button class="ps-image-modal-close">×</button>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // إظهار تدريجي
        requestAnimationFrame(() => {
            modal.classList.add('show');
        });
        
        // أحداث الإغلاق
        const close = modal.querySelector('.ps-image-modal-close');
        const backdrop = modal.querySelector('.ps-image-modal-backdrop');
        
        const closeModal = () => {
            modal.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(modal);
            }, 300);
        };
        
        close.addEventListener('click', closeModal);
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                closeModal();
            }
        });
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    }
    
    /**
     * تحسين الطباعة
     */
    initPrintOptimization() {
        window.addEventListener('beforeprint', () => {
            // إخفاء العناصر غير الضرورية
            const hideElements = document.querySelectorAll(`
                .ps-sticky-share,
                .ps-reading-progress,
                .ps-notifications-container,
                .ps-bookmarks-widget,
                nav,
                .sidebar,
                .comments-area
            `);
            
            hideElements.forEach(el => {
                el.style.display = 'none';
            });
            
            // تحسين المحتوى للطباعة
            document.body.classList.add('ps-printing');
        });
        
        window.addEventListener('afterprint', () => {
            // إعادة إظهار العناصر
            const hideElements = document.querySelectorAll(`
                .ps-sticky-share,
                .ps-reading-progress,
                .ps-notifications-container,
                .ps-bookmarks-widget,
                nav,
                .sidebar,
                .comments-area
            `);
            
            hideElements.forEach(el => {
                el.style.display = '';
            });
            
            document.body.classList.remove('ps-printing');
        });
    }
    
    /**
     * نظام التلميحات
     */
    initToolTips() {
        const elementsWithTooltips = document.querySelectorAll('[data-tooltip], [title]');
        
        elementsWithTooltips.forEach(element => {
            const tooltipText = element.getAttribute('data-tooltip') || element.getAttribute('title');
            if (!tooltipText) return;
            
            // إزالة title الأصلي لمنع التضارب
            element.removeAttribute('title');
            
            let tooltip = null;
            
            const showTooltip = (e) => {
                tooltip = document.createElement('div');
                tooltip.className = 'ps-tooltip';
                tooltip.textContent = tooltipText;
                
                document.body.appendChild(tooltip);
                
                // تحديد الموقع
                const rect = element.getBoundingClientRect();
                const tooltipRect = tooltip.getBoundingClientRect();
                
                let left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                let top = rect.top - tooltipRect.height - 8;
                
                // التأكد من عدم الخروج من الشاشة
                if (left < 0) left = 8;
                if (left + tooltipRect.width > window.innerWidth) {
                    left = window.innerWidth - tooltipRect.width - 8;
                }
                if (top < 0) {
                    top = rect.bottom + 8;
                    tooltip.classList.add('below');
                }
                
                tooltip.style.left = left + 'px';
                tooltip.style.top = top + 'px';
                
                requestAnimationFrame(() => {
                    tooltip.classList.add('show');
                });
            };
            
            const hideTooltip = () => {
                if (tooltip) {
                    tooltip.classList.remove('show');
                    setTimeout(() => {
                        if (tooltip && tooltip.parentNode) {
                            tooltip.parentNode.removeChild(tooltip);
                        }
                        tooltip = null;
                    }, 200);
                }
            };
            
            element.addEventListener('mouseenter', showTooltip);
            element.addEventListener('mouseleave', hideTooltip);
            element.addEventListener('focus', showTooltip);
            element.addEventListener('blur', hideTooltip);
        });
    }
    
    /**
     * نظام النوافذ المنبثقة
     */
    initModalSystem() {
        // إنشاء نظام نوافذ عام
        window.psModal = {
            show: (content, options = {}) => {
                const modal = document.createElement('div');
                modal.className = 'ps-modal';
                modal.innerHTML = `
                    <div class="ps-modal-backdrop">
                        <div class="ps-modal-dialog ${options.size || 'medium'}">
                            <div class="ps-modal-header">
                                <h3 class="ps-modal-title">${options.title || ''}</h3>
                                <button class="ps-modal-close">×</button>
                            </div>
                            <div class="ps-modal-body">
                                ${content}
                            </div>
                            ${options.footer ? `<div class="ps-modal-footer">${options.footer}</div>` : ''}
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                
                // إظهار تدريجي
                requestAnimationFrame(() => {
                    modal.classList.add('show');
                });
                
                // أحداث الإغلاق
                const closeBtn = modal.querySelector('.ps-modal-close');
                const backdrop = modal.querySelector('.ps-modal-backdrop');
                
                const closeModal = () => {
                    modal.classList.remove('show');
                    setTimeout(() => {
                        if (modal.parentNode) {
                            modal.parentNode.removeChild(modal);
                        }
                        if (options.onClose) {
                            options.onClose();
                        }
                    }, 300);
                };
                
                closeBtn.addEventListener('click', closeModal);
                backdrop.addEventListener('click', (e) => {
                    if (e.target === backdrop && !options.disableBackdropClose) {
                        closeModal();
                    }
                });
                
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !options.disableEscapeClose) {
                        closeModal();
                    }
                });
                
                return {
                    element: modal,
                    close: closeModal
                };
            }
        };
    }
}

// تهيئة الميزات التفاعلية
document.addEventListener('DOMContentLoaded', () => {
    window.psInteractiveFeatures = new PSInteractiveFeatures();
});

// تصدير للاستخدام الخارجي
window.PSInteractiveFeatures = PSInteractiveFeatures;

📁 اسم الملف: enhanced-ux.css
/**
 * Enhanced User Experience Styles
 * أنماط تحسين تجربة المستخدم المتقدمة
 */

/* ========================
   شريط تقدم القراءة
======================== */
.ps-reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-100%);
    transition: all 0.3s ease;
}

.ps-reading-progress.visible {
    opacity: 1;
    transform: translateY(0);
}

.ps-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--ps-color-primary), var(--ps-color-accent));
    width: 0%;
    transition: width 0.3s ease;
    position: relative;
}

.ps-progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3));
    animation: ps-progress-shimmer 2s infinite;
}

.ps-progress-info {
    position: absolute;
    top: 6px;
    right: 20px;
    display: flex;
    gap: 15px;
    font-size: 12px;
    color: var(--ps-color-contrast);
    background: rgba(255, 255, 255, 0.95);
    padding: 4px 8px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.ps-reading-progress:hover .ps-progress-info {
    opacity: 1;
}

/* ========================
   نظام الإشارات المرجعية
======================== */
.ps-bookmark-btn {
    background: var(--ps-color-secondary);
    border: 2px solid var(--ps-color-primary);
    color: var(--ps-color-primary);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.ps-bookmark-btn:hover {
    background: var(--ps-color-primary);
    color: var(--ps-color-base);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 186, 0.3);
}

.ps-bookmark-btn.saved {
    background: var(--ps-color-success);
    border-color: var(--ps-color-success);
    color: white;
}

.ps-bookmarks-widget {
    position: fixed;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    z-index: 999;
}

.ps-bookmarks-toggle {
    background: var(--ps-color-primary);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 25px;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 123, 186, 0.3);
    transition: all 0.3s ease;
    white-space: nowrap;
}

.ps-bookmarks-toggle:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 123, 186, 0.4);
}

.ps-bookmarks-panel {
    position: absolute;
    left: 100%;
    top: 0;
    margin-left: 15px;
    width: 350px;
    max-height: 400px;
    background: var(--ps-color-base);
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--ps-color-secondary);
    overflow: hidden;
    animation: ps-slide-in-right 0.3s ease;
}

.ps-bookmarks-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: var(--ps-color-secondary);
    border-bottom: 1px solid var(--ps-color-tertiary);
}

.ps-bookmarks-header h3 {
    margin: 0;
    font-size: 16px;
    color: var(--ps-color-contrast);
}

.ps-bookmarks-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    transition: color 0.3s ease;
}

.ps-bookmarks-close:hover {
    color: var(--ps-color-accent);
}

.ps-bookmarks-list {
    max-height: 300px;
    overflow-y: auto;
    padding: 0;
}

.ps-bookmark-item {
    padding: 15px 20px;
    border-bottom: 1px solid var(--ps-color-secondary);
    transition: background-color 0.3s ease;
}

.ps-bookmark-item:hover {
    background: var(--ps-color-secondary);
}

.ps-bookmark-item:last-child {
    border-bottom: none;
}

.ps-bookmark-content h4 {
    margin: 0 0 8px 0;
    font-size: 14px;
    line-height: 1.4;
}

.ps-bookmark-content h4 a {
    color: var(--ps-color-contrast);
    text-decoration: none;
    transition: color 0.3s ease;
}

.ps-bookmark-content h4 a:hover {
    color: var(--ps-color-primary);
}

.ps-bookmark-content p {
    margin: 0 0 10px 0;
    font-size: 12px;
    color: var(--ps-color-tertiary);
    line-height: 1.4;
}

.ps-bookmark-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ps-date {
    font-size: 11px;
    color: var(--ps-color-tertiary);
}

.ps-remove-bookmark {
    background: none;
    border: none;
    color: var(--ps-color-accent);
    font-size: 11px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.ps-remove-bookmark:hover {
    color: #c0392b;
}

.ps-empty,
.ps-loading,
.ps-error {
    text-align: center;
    padding: 20px;
    color: var(--ps-color-tertiary);
    font-size: 14px;
}

/* ========================
   المشاركة الاجتماعية المحسنة
======================== */
.ps-sticky-share {
    position: fixed;
    left: 20px;
    top: 70%;
    transform: translateY(-50%);
    z-index: 998;
    opacity: 0;
    transform: translateX(-100%) translateY(-50%);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.ps-sticky-share.visible {
    opacity: 1;
    transform: translateX(0) translateY(-50%);
}

.ps-sticky-share-content {
    background: var(--ps-color-base);
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--ps-color-secondary);
    min-width: 60px;
}

.ps-share-title {
    font-size: 12px;
    font-weight: 600;
    color: var(--ps-color-contrast);
    margin-bottom: 10px;
    text-align: center;
}

.ps-share-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 10px;
}

.ps-share-btn {
    background: none;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.ps-share-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.ps-share-btn:hover::before {
    opacity: 1;
}

.ps-share-btn.facebook::before { background: #1877f2; }
.ps-share-btn.twitter::before { background: #1da1f2; }
.ps-share-btn.whatsapp::before { background: #25d366; }
.ps-share-btn.linkedin::before { background: #0077b5; }
.ps-share-btn.copy::before { background: var(--ps-color-tertiary); }
.ps-share-btn.native::before { background: var(--ps-color-primary); }

.ps-share-btn:hover {
    transform: scale(1.1);
    color: white;
}

.ps-share-btn .icon {
    position: relative;
    z-index: 1;
}

.ps-share-stats {
    text-align: center;
    font-size: 11px;
    color: var(--ps-color-tertiary);
    border-top: 1px solid var(--ps-color-secondary);
    padding-top: 8px;
}

/* ========================
   نظام الإشعارات
======================== */
.ps-notifications-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 350px;
}

.ps-notification {
    background: var(--ps-color-base);
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    transform: translateX(100%);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    border-left: 4px solid;
}

.ps-notification.show {
    transform: translateX(0);
}

.ps-notification-success {
    border-left-color: var(--ps-color-success);
}

.ps-notification-error {
    border-left-color: var(--ps-color-accent);
}

.ps-notification-warning {
    border-left-color: var(--ps-color-warning);
}

.ps-notification-info {
    border-left-color: var(--ps-color-primary);
}

.ps-notification-content {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    gap: 10px;
}

.ps-notification-icon {
    font-size: 16px;
    flex-shrink: 0;
}

.ps-notification-message {
    flex: 1;
    font-size: 14px;
    color: var(--ps-color-contrast);
    line-height: 1.4;
}

.ps-notification-close {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    transition: color 0.3s ease;
    flex-shrink: 0;
}

.ps-notification-close:hover {
    color: var(--ps-color-accent);
}

/* ========================
   القائمة السياقية المخصصة
======================== */
.ps-context-menu {
    position: absolute;
    background: var(--ps-color-base);
    border-radius: 8px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--ps-color-secondary);
    padding: 8px 0;
    min-width: 150px;
    z-index: 10000;
    animation: ps-context-appear 0.2s ease;
}

.ps-context-item {
    padding: 8px 15px;
    font-size: 14px;
    color: var(--ps-color-contrast);
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.ps-context-item:hover {
    background: var(--ps-color-secondary);
}

/* ========================
   مودال الصور
======================== */
.ps-image-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.ps-image-modal.show {
    opacity: 1;
}

.ps-image-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.ps-image-modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.ps-image-modal.show .ps-image-modal-content {
    transform: scale(1);
}

.ps-image-modal-content img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 8px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
}

.ps-image-modal-close {
    position: absolute;
    top: -15px;
    right: -15px;
    background: var(--ps-color-accent);
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.ps-image-modal-close:hover {
    background: #c0392b;
    transform: scale(1.1);
}

/* ========================
   نظام التلميحات
======================== */
.ps-tooltip {
    position: fixed;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    line-height: 1.4;
    max-width: 200px;
    z-index: 10000;
    opacity: 0;
    transform: translateY(-5px);
    transition: all 0.2s ease;
    pointer-events: none;
}

.ps-tooltip.show {
    opacity: 1;
    transform: translateY(0);
}

.ps-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border: 5px solid transparent;
    border-top-color: rgba(0, 0, 0, 0.9);
}

.ps-tooltip.below::after {
    top: -10px;
    border-top-color: transparent;
    border-bottom-color: rgba(0, 0, 0, 0.9);
}

/* ========================
   النوافذ المنبثقة
======================== */
.ps-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.ps-modal.show {
    opacity: 1;
}

.ps-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(3px);
}

.ps-modal-dialog {
    background: var(--ps-color-base);
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-height: 90vh;
    overflow: hidden;
    transform: scale(0.9);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.ps-modal.show .ps-modal-dialog {
    transform: scale(1);
}

.ps-modal-dialog.small { max-width: 400px; }
.ps-modal-dialog.medium { max-width: 600px; }
.ps-modal-dialog.large { max-width: 800px; }
.ps-modal-dialog.full { max-width: 95%; }

.ps-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid var(--ps-color-secondary);
    background: var(--ps-color-secondary);
}

.ps-modal-title {
    margin: 0;
    font-size: 18px;
    color: var(--ps-color-contrast);
}

.ps-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--ps-color-tertiary);
    transition: color 0.3s ease;
}

.ps-modal-close:hover {
    color: var(--ps-color-accent);
}

.ps-modal-body {
    padding: 20px;
    overflow-y: auto;
    flex: 1;
}

.ps-modal-footer {
    padding: 15px 20px;
    border-top: 1px solid var(--ps-color-secondary);
    background: var(--ps-color-secondary);
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* ========================
   الحركات والتأثيرات
======================== */
@keyframes ps-progress-shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes ps-slide-in-right {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes ps-context-appear {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes slideOut {
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
}

/* ========================
   التصميم المتجاوب
======================== */
@media (max-width: 768px) {
    .ps-bookmarks-widget {
        left: 10px;
    }
    
    .ps-bookmarks-panel {
        width: calc(100vw - 40px);
        left: 0;
        margin-left: 0;
        top: 100%;
        margin-top: 10px;
    }
    
    .ps-sticky-share {
        left: 10px;
    }
    
    .ps-sticky-share-content {
        padding: 10px;
    }
    
    .ps-share-btn {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .ps-notifications-container {
        right: 10px;
        left: 10px;
        max-width: none;
    }
    
    .ps-progress-info {
        right: 10px;
    }
    
    .ps-modal-dialog {
        margin: 10px;
        max-width: none;
    }
    
    .ps-modal-body {
        padding: 15px;
    }
    
    .ps-context-menu {
        max-width: calc(100vw - 40px);
    }
}

@media (max-width: 480px) {
    .ps-bookmark-btn {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .ps-bookmarks-toggle {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .ps-share-title {
        font-size: 10px;
    }
    
    .ps-share-btn {
        width: 30px;
        height: 30px;
        font-size: 12px;
    }
    
    .ps-reading-progress {
        height: 3px;
    }
    
    .ps-progress-info {
        display: none;
    }
}

/* ========================
   وضع الطباعة
======================== */
@media print {
    .ps-reading-progress,
    .ps-sticky-share,
    .ps-bookmarks-widget,
    .ps-notifications-container,
    .ps-context-menu,
    .ps-modal,
    .ps-tooltip {
        display: none !important;
    }
    
    .ps-bookmark-btn {
        display: none !important;
    }
}

/* ========================
   الوضع المظلم
======================== */
html[data-theme="dark"] .ps-bookmarks-panel,
html[data-theme="dark"] .ps-sticky-share-content,
html[data-theme="dark"] .ps-notification,
html[data-theme="dark"] .ps-context-menu,
html[data-theme="dark"] .ps-modal-dialog {
    background: var(--ps-color-secondary);
    border-color: #4a5568;
}

html[data-theme="dark"] .ps-modal-backdrop {
    background: rgba(0, 0, 0, 0.8);
}

html[data-theme="dark"] .ps-tooltip {
    background: rgba(255, 255, 255, 0.95);
    color: #1a1a1a;
}

html[data-theme="dark"] .ps-tooltip::after {
    border-top-color: rgba(255, 255, 255, 0.95);
}

html[data-theme="dark"] .ps-tooltip.below::after {
    border-top-color: transparent;
    border-bottom-color: rgba(255, 255, 255, 0.95);
}

/* ========================
   تحسينات الأداء
======================== */
.ps-reading-progress,
.ps-sticky-share,
.ps-bookmarks-widget {
    will-change: transform, opacity;
}

.ps-notification,
.ps-modal-dialog,
.ps-tooltip {
    will-change: transform, opacity;
}

/* استخدام GPU acceleration للحركات السلسة */
.ps-share-btn,
.ps-bookmark-btn,
.ps-bookmark-item {
    will-change: transform;
    transform: translateZ(0);
}


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



