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
│   ├── js/
│   │   └── unified.js ← جميع الوظائف موحدة
│   ├── images/
│   └── fonts/
├── inc/
│   ├── theme-settings.php
│   ├── customizer-settings.php
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
 * قالب الحلول العملية الاحترافي - الوظائف المحسنة
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تعريف ثوابت القالب
define('PS_THEME_VERSION', '2.1.0');
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
        'assets/css/editor-styles.css',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * تحميل الأصول المحسنة (CSS/JS)
 */
function practical_solutions_enqueue_assets() {
    // CSS موحد
    wp_enqueue_style(
        'ps-unified-styles',
        PS_THEME_URI . '/assets/css/unified.css',
        array(),
        PS_THEME_VERSION
    );
    
    // JavaScript موحد
    wp_enqueue_script(
        'ps-unified-script',
        PS_THEME_URI . '/assets/js/unified.js',
        array(),
        PS_THEME_VERSION,
        array('strategy' => 'defer', 'in_footer' => true)
    );
    
    // إعدادات JavaScript
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
    ));
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_assets');

/**
 * تسجيل Block Styles المخصصة
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
    
    // أنماط للأزرار
    register_block_style('core/button', array(
        'name' => 'ps-primary-button',
        'label' => __('زر أساسي', 'practical-solutions')
    ));
    
    register_block_style('core/button', array(
        'name' => 'ps-outline-button',
        'label' => __('زر مخطط', 'practical-solutions')
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
}
add_action('init', 'practical_solutions_register_block_styles');

/**
 * AJAX للبحث المحسن - موحد
 */
function practical_solutions_ajax_search() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(__('غير مصرح', 'practical-solutions'));
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = sanitize_text_field($_POST['search_type']) ?? 'suggestions';
    
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
add_action('wp_ajax_ps_search_enhanced', 'practical_solutions_ajax_search');
add_action('wp_ajax_nopriv_ps_search_enhanced', 'practical_solutions_ajax_search');

/**
 * دالة البحث المحسنة - موحدة
 */
function ps_get_search_suggestions($search_term) {
    $posts = get_posts(array(
        's' => $search_term,
        'post_type' => 'post',
        'posts_per_page' => 5,
        'post_status' => 'publish'
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

/**
 * إنشاء Breadcrumbs ديناميكي
 */
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

/**
 * Shortcode للـ Breadcrumbs
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
            $output .= '<li class="breadcrumb-separator" aria-hidden="true">/</li>';
        }
    }
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    return $output;
}
add_shortcode('ps_breadcrumbs', 'ps_breadcrumbs_shortcode');

/**
 * تحسينات الأداء
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
}
add_action('init', 'practical_solutions_performance_optimizations');

/**
 * إضافة كلاسات مخصصة للـ body
 */
function practical_solutions_body_classes($classes) {
    $classes[] = 'ps-theme';
    $classes[] = 'block-theme-enhanced';
    
    if (is_home() || is_front_page()) {
        $classes[] = 'ps-homepage';
    }
    
    if (is_single()) {
        $classes[] = 'ps-single-post';
        
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
    
    return $classes;
}
add_filter('body_class', 'practical_solutions_body_classes');

/**
 * إضافة structured data محسن
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
        
        if (has_post_thumbnail()) {
            $thumbnail_url = get_the_post_thumbnail_url($post, 'large');
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $thumbnail_url,
                'width' => 1200,
                'height' => 800
            );
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_structured_data');

/**
 * تحميل الملفات المساعدة
 */
require_once PS_THEME_DIR . '/inc/theme-settings.php';
require_once PS_THEME_DIR . '/inc/customizer-settings.php';
require_once PS_THEME_DIR . '/inc/block-patterns.php';

📁 اسم الملف: assets/js/unified.js
/**
 * Practical Solutions Pro - Unified JavaScript
 * جافاسكريبت موحد للحلول العملية الاحترافية
 */

// متغيرات عامة
const psSettings = window.psSettings || {};

/**
 * الكلاس الرئيسي للقالب
 */
class PracticalSolutionsTheme {
    constructor() {
        this.searchTimeout = null;
        this.voiceRecognition = null;
        this.isVoiceListening = false;
        this.searchHistory = this.loadSearchHistory();
        this.currentFocus = -1;
        
        this.init();
    }
    
    /**
     * تهيئة القالب
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
        });
        
        window.addEventListener('load', () => {
            this.initServiceWorker();
            this.initOfflineMode();
            document.body.classList.add('ps-loaded');
        });
    }
    
    /**
     * تبديل الوضع المظلم/الفاتح
     */
    initThemeToggle() {
        const themeToggle = document.querySelector('.ps-theme-toggle');
        if (!themeToggle) return;
        
        // تحميل الوضع المحفوظ
        const savedTheme = localStorage.getItem('ps-theme-mode') || 
                          (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        this.applyTheme(savedTheme);
        this.updateThemeToggleIcon(savedTheme);
        
        // مستمع التبديل
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            this.applyTheme(newTheme);
            this.updateThemeToggleIcon(newTheme);
            localStorage.setItem('ps-theme-mode', newTheme);
            
            this.showNotification(
                newTheme === 'dark' ? 'تم تفعيل الوضع المظلم' : 'تم تفعيل الوضع الفاتح',
                'info'
            );
        });
    }
    
    /**
     * تطبيق الوضع
     */
    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
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
    updateThemeToggleIcon(theme) {
        const themeToggle = document.querySelector('.ps-theme-toggle');
        if (themeToggle) {
            themeToggle.innerHTML = theme === 'dark' ? '☀️' : '🌙';
            themeToggle.setAttribute('aria-label', 
                theme === 'dark' ? 'تبديل للوضع الفاتح' : 'تبديل للوضع المظلم'
            );
        }
    }
    
    /**
     * تهيئة البحث الموحد
     */
    initSearch() {
        const searchInputs = document.querySelectorAll('.ps-search-input, .ps-hero-search-input, #search-input');
        
        searchInputs.forEach(searchInput => {
            let suggestionsContainer = this.getSuggestionsContainer(searchInput);
            
            // مستمع الإدخال
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.trim();
                
                clearTimeout(this.searchTimeout);
                
                if (query.length < 2) {
                    this.hideSuggestions(suggestionsContainer);
                    return;
                }
                
                this.searchTimeout = setTimeout(() => {
                    this.fetchSearchSuggestions(query, suggestionsContainer, searchInput);
                }, 300);
            });
            
            // التنقل بلوحة المفاتيح
            searchInput.addEventListener('keydown', (e) => {
                this.handleKeyboardNavigation(e, suggestionsContainer);
            });
            
            // إخفاء عند النقر خارجها
            document.addEventListener('click', (e) => {
                if (!searchInput.parentNode.contains(e.target)) {
                    this.hideSuggestions(suggestionsContainer);
                }
            });
        });
    }
    
    /**
     * البحث الصوتي
     */
    initVoiceSearch() {
        const voiceButtons = document.querySelectorAll('.ps-voice-btn, .ps-hero-voice-btn, #voice-search');
        
        if (voiceButtons.length === 0) return;
        
        // فحص دعم البحث الصوتي
        if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
            voiceButtons.forEach(btn => btn.style.display = 'none');
            return;
        }
        
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        this.voiceRecognition = new SpeechRecognition();
        
        // إعدادات التعرف الصوتي
        this.voiceRecognition.continuous = false;
        this.voiceRecognition.interimResults = false;
        this.voiceRecognition.lang = psSettings.locale?.startsWith('ar') ? 'ar-SA' : 'en-US';
        
        voiceButtons.forEach(voiceBtn => {
            voiceBtn.addEventListener('click', (e) => this.handleVoiceSearch(e));
        });
        
        // أحداث التعرف الصوتي
        this.voiceRecognition.onstart = () => {
            this.isVoiceListening = true;
            this.updateVoiceButtonState(true);
        };
        
        this.voiceRecognition.onresult = (event) => {
            const result = event.results[0][0].transcript;
            const searchInput = document.querySelector('.ps-search-input, .ps-hero-search-input, #search-input');
            
            if (searchInput && result) {
                searchInput.value = result;
                setTimeout(() => this.triggerSearch(result), 500);
                this.showNotification(`تم البحث عن: ${result}`, 'success');
            }
        };
        
        this.voiceRecognition.onend = () => {
            this.isVoiceListening = false;
            this.updateVoiceButtonState(false);
        };
        
        this.voiceRecognition.onerror = (event) => {
            this.isVoiceListening = false;
            this.updateVoiceButtonState(false);
            
            let errorMessage = 'حدث خطأ في البحث الصوتي';
            switch (event.error) {
                case 'no-speech':
                    errorMessage = 'لم يتم سماع أي صوت';
                    break;
                case 'not-allowed':
                    errorMessage = 'صلاحية الميكروفون مرفوضة';
                    break;
            }
            
            this.showNotification(errorMessage, 'error');
        };
    }
    
    /**
     * معالج البحث الصوتي
     */
    handleVoiceSearch(event) {
        event.preventDefault();
        
        if (this.isVoiceListening) {
            this.voiceRecognition.stop();
            return;
        }
        
        try {
            this.voiceRecognition.start();
        } catch (error) {
            this.showNotification('فشل في بدء البحث الصوتي', 'error');
        }
    }
    
    /**
     * تحديث حالة زر البحث الصوتي
     */
    updateVoiceButtonState(listening) {
        const voiceButtons = document.querySelectorAll('.ps-voice-btn, .ps-hero-voice-btn, #voice-search');
        
        voiceButtons.forEach(btn => {
            if (listening) {
                btn.classList.add('listening');
                btn.innerHTML = '🔴';
            } else {
                btn.classList.remove('listening');
                btn.innerHTML = '🎤';
            }
        });
    }
    
    /**
     * جلب اقتراحات البحث
     */
    async fetchSearchSuggestions(query, container, searchInput) {
        if (!psSettings.ajaxUrl) return;
        
        const formData = new FormData();
        formData.append('action', 'ps_search_enhanced');
        formData.append('search_term', query);
        formData.append('search_type', 'suggestions');
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
                this.showSuggestions(data.data, container, searchInput);
            } else {
                this.showNoResults(container);
            }
        } catch (error) {
            console.error('خطأ في البحث:', error);
            this.hideSuggestions(container);
        }
    }
    
    /**
     * عرض الاقتراحات
     */
    showSuggestions(suggestions, container, searchInput) {
        const suggestionsList = suggestions.map(item => `
            <div class="ps-suggestion-item" data-url="${item.url}" data-title="${item.title}">
                ${item.thumbnail ? `<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail" loading="lazy">` : ''}
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">${this.highlightSearchTerm(item.title, searchInput.value)}</div>
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
            item.addEventListener('click', () => {
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');
                
                if (title) this.saveSearchHistory(title);
                window.location.href = url;
            });
        });
    }
    
    /**
     * التنقل بلوحة المفاتيح
     */
    handleKeyboardNavigation(event, container) {
        const suggestions = container.querySelectorAll('.ps-suggestion-item');
        if (suggestions.length === 0) return;
        
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this.currentFocus = Math.min(this.currentFocus + 1, suggestions.length - 1);
                this.highlightSuggestion(suggestions, this.currentFocus);
                break;
                
            case 'ArrowUp':
                event.preventDefault();
                this.currentFocus = Math.max(this.currentFocus - 1, -1);
                if (this.currentFocus >= 0) {
                    this.highlightSuggestion(suggestions, this.currentFocus);
                }
                break;
                
            case 'Enter':
                event.preventDefault();
                if (this.currentFocus >= 0 && suggestions[this.currentFocus]) {
                    suggestions[this.currentFocus].click();
                } else {
                    const form = event.target.closest('form');
                    if (form) form.submit();
                }
                break;
                
            case 'Escape':
                this.hideSuggestions(container);
                event.target.blur();
                this.currentFocus = -1;
                break;
        }
    }
    
    /**
     * باقي الوظائف المساعدة
     */
    getSuggestionsContainer(input) {
        let container = input.parentNode.querySelector('.ps-search-suggestions');
        
        if (!container) {
            container = document.createElement('div');
            container.className = 'ps-search-suggestions';
            input.parentNode.appendChild(container);
        }
        
        return container;
    }
    
    showLoadingInSuggestions(container) {
        container.innerHTML = `
            <div class="ps-suggestion-item ps-loading">
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">${psSettings.loadingText || 'جاري التحميل...'}</div>
                </div>
            </div>
        `;
        container.classList.add('show');
    }
    
    showNoResults(container) {
        container.innerHTML = `
            <div class="ps-suggestion-item ps-no-results">
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">${psSettings.noResultsText || 'لا توجد نتائج'}</div>
                </div>
            </div>
        `;
        container.classList.add('show');
    }
    
    hideSuggestions(container) {
        container.classList.remove('show');
        setTimeout(() => container.innerHTML = '', 300);
    }
    
    highlightSearchTerm(text, term) {
        if (!term) return text;
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }
    
    highlightSuggestion(suggestions, activeIndex) {
        suggestions.forEach((item, index) => {
            item.classList.toggle('active', index === activeIndex);
            if (index === activeIndex) {
                item.scrollIntoView({ block: 'nearest' });
            }
        });
    }
    
    triggerSearch(query) {
        const searchForm = document.querySelector('.ps-search-form, .ps-hero-search-form, .search-form');
        if (searchForm) {
            searchForm.submit();
        } else {
            window.location.href = `${psSettings.homeUrl}?s=${encodeURIComponent(query)}`;
        }
    }
    
    saveSearchHistory(searchTerm) {
        try {
            let history = JSON.parse(localStorage.getItem('ps-search-history') || '[]');
            history = history.filter(item => item !== searchTerm);
            history.unshift(searchTerm);
            history = history.slice(0, 10);
            localStorage.setItem('ps-search-history', JSON.stringify(history));
        } catch (error) {
            console.error('خطأ في حفظ تاريخ البحث:', error);
        }
    }
    
    loadSearchHistory() {
        try {
            return JSON.parse(localStorage.getItem('ps-search-history') || '[]');
        } catch {
            return [];
        }
    }
    
    /**
     * التمرير الناعم
     */
    initSmoothScroll() {
        // الروابط الداخلية
        const internalLinks = document.querySelectorAll('a[href^="#"]');
        
        internalLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const targetId = link.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // زر العودة للأعلى
        this.createBackToTopButton();
    }
    
    /**
     * إنشاء زر العودة للأعلى
     */
    createBackToTopButton() {
        const backToTopBtn = document.createElement('button');
        backToTopBtn.className = 'ps-back-to-top';
        backToTopBtn.innerHTML = '⬆️';
        backToTopBtn.setAttribute('aria-label', 'العودة للأعلى');
        document.body.appendChild(backToTopBtn);
        
        // إظهار/إخفاء الزر
        window.addEventListener('scroll', () => {
            backToTopBtn.classList.toggle('show', window.pageYOffset > 300);
        });
        
        // النقر للعودة للأعلى
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    /**
     * الرسوم المتحركة
     */
    initAnimations() {
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
            
            const animatedElements = document.querySelectorAll(
                '.wp-block-group, .wp-block-columns, .wp-block-heading, .wp-block-image'
            );
            
            animatedElements.forEach(el => animationObserver.observe(el));
        }
    }
    
    /**
     * تحسينات إمكانية الوصول
     */
    initAccessibility() {
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
    }
    
    /**
     * تحسينات الأداء
     */
    initPerformanceOptimizations() {
        // تحسين تحميل الصور
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (!img.loading) img.loading = 'lazy';
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
    }
    
    /**
     * Service Worker
     */
    initServiceWorker() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => console.log('SW registered'))
                .catch(error => console.log('SW registration failed'));
        }
    }
    
    /**
     * وضع عدم الاتصال
     */
    initOfflineMode() {
        window.addEventListener('online', () => {
            this.showNotification('تم استعادة الاتصال بالإنترنت', 'success');
            document.body.classList.remove('ps-offline');
        });
        
        window.addEventListener('offline', () => {
            this.showNotification('تم فقدان الاتصال بالإنترنت', 'warning', 5000);
            document.body.classList.add('ps-offline');
        });
    }
    
    /**
     * عرض إشعار
     */
    showNotification(message, type = 'info', duration = 3000) {
        const notification = document.createElement('div');
        notification.className = `ps-notification ps-notification-${type}`;
        notification.setAttribute('role', 'alert');
        
        notification.innerHTML = `
            <div class="ps-notification-content">
                <span class="ps-notification-message">${message}</span>
                <button class="ps-notification-close" aria-label="إغلاق">×</button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => notification.classList.add('show'), 100);
        
        const closeBtn = notification.querySelector('.ps-notification-close');
        closeBtn.addEventListener('click', () => this.hideNotification(notification));
        
        if (duration > 0) {
            setTimeout(() => this.hideNotification(notification), duration);
        }
        
        return notification;
    }
    
    /**
     * إخفاء الإشعار
     */
    hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
}

/**
 * وظائف المشاركة الاجتماعية
 */
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
        window.open(shareUrl, 'facebook-share', 'width=600,height=400');
    }
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
        window.open(shareUrl, 'twitter-share', 'width=600,height=400');
    }
};

window.shareOnWhatsApp = function() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    const shareUrl = `https://api.whatsapp.com/send?text=${title} ${url}`;
    window.open(shareUrl, 'whatsapp-share');
};

window.copyLink = function() {
    const url = window.location.href;
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            window.psTheme.showNotification('تم نسخ الرابط بنجاح!', 'success');
        });
    } else {
        // Fallback
        const textArea = document.createElement('textarea');
        textArea.value = url;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        document.body.appendChild(textArea);
        textArea.select();
        
        try {
            document.execCommand('copy');
            window.psTheme.showNotification('تم نسخ الرابط بنجاح!', 'success');
        } catch (err) {
            window.psTheme.showNotification('فشل في نسخ الرابط', 'error');
        }
        
        document.body.removeChild(textArea);
    }
};

// تهيئة القالب
window.psTheme = new PracticalSolutionsTheme();

// تصدير للاستخدام الخارجي
window.PracticalSolutions = {
    showNotification: window.psTheme.showNotification.bind(window.psTheme),
    applyTheme: window.psTheme.applyTheme.bind(window.psTheme),
    shareOnFacebook,
    shareOnTwitter,
    shareOnWhatsApp,
    copyLink,
    version: '2.1.0'
};

📁 اسم الملف: assets/css/unified.css
/**
 * Practical Solutions Pro - Unified Styles
 * الأنماط الموحدة للحلول العملية الاحترافية
 */

/* الخطوط */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');

/* متغيرات CSS موحدة - من theme.json */
:root {
  /* الألوان من theme.json */
  --ps-color-base: var(--wp--preset--color--base);
  --ps-color-contrast: var(--wp--preset--color--contrast);
  --ps-color-primary: var(--wp--preset--color--primary);
  --ps-color-secondary: var(--wp--preset--color--secondary);
  --ps-color-tertiary: var(--wp--preset--color--tertiary);
  --ps-color-accent: var(--wp--preset--color--accent);
  --ps-color-success: var(--wp--preset--color--success);
  --ps-color-warning: var(--wp--preset--color--warning);
  
  /* المسافات */
  --ps-spacing-xs: 0.5rem;
  --ps-spacing-sm: var(--wp--preset--spacing--small);
  --ps-spacing-md: var(--wp--preset--spacing--medium);
  --ps-spacing-lg: var(--wp--preset--spacing--large);
  --ps-spacing-xl: 4rem;
  
  /* الخطوط */
  --ps-font-family: var(--wp--preset--font-family--noto-arabic);
  --ps-font-size-xs: var(--wp--preset--font-size--x-small);
  --ps-font-size-sm: var(--wp--preset--font-size--small);
  --ps-font-size-base: var(--wp--preset--font-size--medium);
  --ps-font-size-lg: var(--wp--preset--font-size--large);
  --ps-font-size-xl: var(--wp--preset--font-size--x-large);
  --ps-font-size-xxl: var(--wp--preset--font-size--xx-large);
  
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
  border: 1px solid rgba(0,0,0,0.05);
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
  border-radius: var(--ps-radius-lg);
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

/* البحث الموحد */
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
}

.ps-search-form:focus-within,
.ps-hero-search-form:focus-within {
  border-color: var(--ps-color-primary);
  box-shadow: var(--ps-shadow-lg);
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
  transition: background-color var(--ps-transition-fast);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--ps-font-family);
}

.ps-search-btn:hover,
.ps-hero-search-btn:hover,
.ps-voice-btn:hover,
.ps-hero-voice-btn:hover {
  background: var(--ps-color-tertiary);
}

.ps-voice-btn.listening,
.ps-hero-voice-btn.listening {
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

.ps-suggestion-item:hover,
.ps-suggestion-item.active {
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
  flex-wrap: wrap;
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
  margin: 0 4px;
}

/* أزرار المشاركة الاجتماعية */
.ps-social-sharing {
  text-align: center;
  padding: var(--ps-spacing-md) 0;
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
  border: none;
  cursor: pointer;
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
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.ps-notification.show {
  transform: translateX(0);
}

.ps-notification.ps-notification-success { background: var(--ps-color-success); }
.ps-notification.ps-notification-error { background: var(--ps-color-accent); }
.ps-notification.ps-notification-info { background: var(--ps-color-primary); }
.ps-notification.ps-notification-warning { background: var(--ps-color-warning); }

.ps-notification-close {
  background: none;
  border: none;
  color: var(--ps-color-base);
  cursor: pointer;
  font-size: 18px;
  margin-right: 10px;
  padding: 0;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

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

/* الوضع المظلم */
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

/* التصميم المتجاوب */
@media (max-width: 768px) {
  .ps-search-container,
  .ps-hero-search-container {
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
  
  .ps-back-to-top {
    width: 45px;
    height: 45px;
    bottom: 20px;
    right: 20px;
    font-size: 18px;
  }
  
  .ps-notification {
    top: 15px;
    right: 15px;
    left: 15px;
    max-width: none;
  }
  
  .breadcrumb-list {
    gap: 4px;
  }
  
  .ps-sharing-buttons {
    gap: 8px;
  }
  
  .ps-share-btn {
    padding: 8px 12px;
    font-size: var(--ps-font-size-xs);
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
}

/* Print styles */
@media print {
  .ps-theme-toggle,
  .ps-back-to-top,
  .ps-search-suggestions,
  .ps-notification,
  .ps-social-sharing,
  .ps-voice-btn,
  .ps-hero-voice-btn {
    display: none !important;
  }
  
  body {
    background: white !important;
    color: black !important;
  }
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



