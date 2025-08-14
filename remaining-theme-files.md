# 📁 باقي ملفات القالب - Complete File Structure

## 🗂️ **templates/single.html - صفحة المقال**

```html
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
```

## 🗂️ **templates/page.html - الصفحات الثابتة**

```html
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
```

## 🗂️ **templates/archive.html - صفحة الأرشيف**

```html
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
```

## 🗂️ **templates/search.html - نتائج البحث**

```html
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
```

## 🗂️ **templates/404.html - صفحة الخطأ**

```html
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
```

## 🧩 **parts/header.html - رأس الصفحة المحسن**

```html
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
```

## 🧩 **parts/footer.html - تذييل الصفحة المحسن**

```html
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
```

## 🧩 **parts/sidebar.html - الشريط الجانبي**

```html
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
```

## 💻 **assets/js/search-enhanced.js - البحث المحسن**

```javascript
/**
 * Enhanced Search Functionality
 * وظائف البحث المحسنة
 */

class EnhancedSearch {
    constructor() {
        this.searchHistory = this.loadSearchHistory();
        this.searchCache = new Map();
        this.currentFocus = -1;
        this.debounceTime = 300;
        this.minSearchLength = 2;
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.createSearchHistory();
        this.initKeyboardShortcuts();
    }
    
    bindEvents() {
        // البحث في الرأس
        const headerSearch = document.querySelector('.ps-compact-search input');
        if (headerSearch) {
            this.bindSearchInput(headerSearch);
        }
        
        // البحث في الشريط الجانبي
        const sidebarSearch = document.querySelector('.ps-sidebar-search input');
        if (sidebarSearch) {
            this.bindSearchInput(sidebarSearch);
        }
        
        // البحث الرئيسي
        const mainSearchInputs = document.querySelectorAll('.ps-search-input');
        mainSearchInputs.forEach(input => {
            this.bindSearchInput(input);
        });
    }
    
    bindSearchInput(input) {
        let timeout;
        
        input.addEventListener('input', (e) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                this.handleSearch(e.target);
            }, this.debounceTime);
        });
        
        input.addEventListener('focus', () => {
            this.showSearchHistory(input);
        });
        
        input.addEventListener('keydown', (e) => {
            this.handleKeydown(e, input);
        });
        
        input.addEventListener('blur', () => {
            setTimeout(() => {
                this.hideSuggestions(input);
            }, 200);
        });
    }
    
    async handleSearch(input) {
        const query = input.value.trim();
        
        if (query.length < this.minSearchLength) {
            this.hideSuggestions(input);
            return;
        }
        
        // فحص التخزين المؤقت
        if (this.searchCache.has(query)) {
            this.displaySuggestions(input, this.searchCache.get(query));
            return;
        }
        
        // إظهار مؤشر التحميل
        this.showLoading(input);
        
        try {
            const results = await this.fetchSearchResults(query);
            this.searchCache.set(query, results);
            this.displaySuggestions(input, results);
        } catch (error) {
            console.error('خطأ في البحث:', error);
            this.showError(input);
        }
    }
    
    async fetchSearchResults(query) {
        const formData = new FormData();
        formData.append('action', 'ps_search_enhanced');
        formData.append('search_term', query);
        formData.append('search_type', 'suggestions');
        formData.append('nonce', psSettings.nonce);
        
        const response = await fetch(psSettings.ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });
        
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.data || 'فشل في البحث');
        }
        
        return data.data;
    }
    
    showLoading(input) {
        const container = this.getSuggestionsContainer(input);
        container.innerHTML = `
            <div class="ps-suggestion-item ps-loading">
                <div class="ps-loading-spinner"></div>
                <span>جاري البحث...</span>
            </div>
        `;
        container.classList.add('show');
    }
    
    showError(input) {
        const container = this.getSuggestionsContainer(input);
        container.innerHTML = `
            <div class="ps-suggestion-item ps-error">
                <span>❌ حدث خطأ في البحث</span>
            </div>
        `;
        container.classList.add('show');
    }
    
    displaySuggestions(input, results) {
        const container = this.getSuggestionsContainer(input);
        
        if (!results || results.length === 0) {
            this.showNoResults(input);
            return;
        }
        
        const suggestionsHTML = results.map((item, index) => `
            <div class="ps-suggestion-item" data-index="${index}" data-url="${item.url}">
                ${item.thumbnail ? `<img src="${item.thumbnail}" alt="" class="ps-suggestion-thumbnail" loading="lazy">` : ''}
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">${this.highlightQuery(item.title, input.value)}</div>
                    <div class="ps-suggestion-excerpt">${item.excerpt}</div>
                    ${item.category ? `<div class="ps-suggestion-meta">
                        <span class="ps-category">${item.category}</span>
                        ${item.date ? `<span class="ps-date">${item.date}</span>` : ''}
                    </div>` : ''}
                </div>
            </div>
        `).join('');
        
        container.innerHTML = suggestionsHTML;
        container.classList.add('show');
        
        this.bindSuggestionEvents(container, input);
    }
    
    showNoResults(input) {
        const container = this.getSuggestionsContainer(input);
        container.innerHTML = `
            <div class="ps-suggestion-item ps-no-results">
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">لا توجد نتائج</div>
                    <div class="ps-suggestion-excerpt">حاول استخدام كلمات مختلفة</div>
                </div>
            </div>
        `;
        container.classList.add('show');
    }
    
    showSearchHistory(input) {
        if (input.value.length > 0 || this.searchHistory.length === 0) {
            return;
        }
        
        const container = this.getSuggestionsContainer(input);
        const historyHTML = this.searchHistory.map(term => `
            <div class="ps-suggestion-item ps-history-item" data-query="${term}">
                <div class="ps-suggestion-content">
                    <div class="ps-suggestion-title">
                        <span class="ps-history-icon">🕒</span>
                        ${term}
                    </div>
                </div>
            </div>
        `).join('');
        
        container.innerHTML = `
            <div class="ps-search-history-header">البحثات السابقة</div>
            ${historyHTML}
        `;
        container.classList.add('show');
        
        this.bindHistoryEvents(container, input);
    }
    
    bindSuggestionEvents(container, input) {
        const items = container.querySelectorAll('.ps-suggestion-item');
        
        items.forEach(item => {
            item.addEventListener('click', () => {
                const url = item.dataset.url;
                if (url) {
                    this.addToSearchHistory(input.value);
                    window.location.href = url;
                }
            });
            
            item.addEventListener('mouseenter', () => {
                this.setActiveSuggestion(container, item);
            });
        });
    }
    
    bindHistoryEvents(container, input) {
        const items = container.querySelectorAll('.ps-history-item');
        
        items.forEach(item => {
            item.addEventListener('click', () => {
                const query = item.dataset.query;
                input.value = query;
                this.handleSearch(input);
            });
        });
    }
    
    handleKeydown(e, input) {
        const container = this.getSuggestionsContainer(input);
        const items = container.querySelectorAll('.ps-suggestion-item:not(.ps-loading):not(.ps-error)');
        
        if (items.length === 0) return;
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.currentFocus = Math.min(this.currentFocus + 1, items.length - 1);
                this.setActiveSuggestion(container, items[this.currentFocus]);
                break;
                
            case 'ArrowUp':
                e.preventDefault();
                this.currentFocus = Math.max(this.currentFocus - 1, -1);
                if (this.currentFocus >= 0) {
                    this.setActiveSuggestion(container, items[this.currentFocus]);
                } else {
                    this.clearActiveSuggestion(container);
                }
                break;
                
            case 'Enter':
                e.preventDefault();
                if (this.currentFocus >= 0 && items[this.currentFocus]) {
                    items[this.currentFocus].click();
                } else {
                    this.submitSearch(input);
                }
                break;
                
            case 'Escape':
                this.hideSuggestions(input);
                input.blur();
                this.currentFocus = -1;
                break;
        }
    }
    
    setActiveSuggestion(container, activeItem) {
        container.querySelectorAll('.ps-suggestion-item').forEach(item => {
            item.classList.remove('active');
        });
        
        if (activeItem) {
            activeItem.classList.add('active');
            activeItem.scrollIntoView({ block: 'nearest' });
        }
    }
    
    clearActiveSuggestion(container) {
        container.querySelectorAll('.ps-suggestion-item').forEach(item => {
            item.classList.remove('active');
        });
    }
    
    getSuggestionsContainer(input) {
        let container = input.parentNode.querySelector('.ps-search-suggestions');
        
        if (!container) {
            container = document.createElement('div');
            container.className = 'ps-search-suggestions';
            input.parentNode.appendChild(container);
        }
        
        return container;
    }
    
    hideSuggestions(input) {
        const container = this.getSuggestionsContainer(input);
        container.classList.remove('show');
        this.currentFocus = -1;
    }
    
    submitSearch(input) {
        const form = input.closest('form');
        if (form) {
            this.addToSearchHistory(input.value);
            form.submit();
        } else {
            window.location.href = `${psSettings.homeUrl}?s=${encodeURIComponent(input.value)}`;
        }
    }
    
    highlightQuery(text, query) {
        if (!query || query.length < 2) return text;
        
        const regex = new RegExp(`(${this.escapeRegex(query)})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }
    
    escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    addToSearchHistory(query) {
        if (!query || query.length < 2) return;
        
        query = query.trim();
        
        // إزالة التكرار
        this.searchHistory = this.searchHistory.filter(item => item !== query);
        
        // إضافة في المقدمة
        this.searchHistory.unshift(query);
        
        // الاحتفاظ بـ 10 عناصر فقط
        this.searchHistory = this.searchHistory.slice(0, 10);
        
        this.saveSearchHistory();
    }
    
    loadSearchHistory() {
        try {
            return JSON.parse(localStorage.getItem('ps-search-history') || '[]');
        } catch {
            return [];
        }
    }
    
    saveSearchHistory() {
        try {
            localStorage.setItem('ps-search-history', JSON.stringify(this.searchHistory));
        } catch (error) {
            console.error('فشل في حفظ تاريخ البحث:', error);
        }
    }
    
    createSearchHistory() {
        // إضافة رابط لمسح تاريخ البحث
        const clearButton = document.createElement('button');
        clearButton.textContent = 'مسح تاريخ البحث';
        clearButton.className = 'ps-clear-history-btn';
        clearButton.addEventListener('click', () => {
            this.clearSearchHistory();
        });
        
        // إضافة الزر للإعدادات أو مكان مناسب
    }
    
    clearSearchHistory() {
        this.searchHistory = [];
        this.saveSearchHistory();
        
        if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
            window.PracticalSolutions.showNotification('تم مسح تاريخ البحث', 'info');
        }
    }
    
    initKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K للتركيز على البحث
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('.ps-search-input, .ps-compact-search input');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });
    }
}

// تهيئة البحث المحسن عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    new EnhancedSearch();
});
```

## 🎨 **assets/css/editor-styles.css - أنماط المحرر**

```css
/**
 * Editor Styles for Block Editor
 * أنماط محرر الكتل
 */

/* إعدادات الخطوط للمحرر */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');

/* متغيرات للمحرر */
.wp-block {
    --ps-color-primary: #007cba;
    --ps-color-secondary: #f0f4f8;
    --ps-color-tertiary: #2c3e50;
    --ps-font-family: 'Noto Sans Arabic', sans-serif;
}

/* أنماط أساسية للمحرر */
.editor-styles-wrapper {
    font-family: var(--ps-font-family);
    direction: rtl;
    text-align: right;
    line-height: 1.6;
}

/* أنماط العناوين في المحرر */
.editor-styles-wrapper h1,
.editor-styles-wrapper h2,
.editor-styles-wrapper h3,
.editor-styles-wrapper h4,
.editor-styles-wrapper h5,
.editor-styles-wrapper h6 {
    font-family: var(--ps-font-family);
    font-weight: 600;
    color: var(--ps-color-tertiary);
}

.editor-styles-wrapper h1 { font-size: 2.5rem; }
.editor-styles-wrapper h2 { font-size: 2rem; }
.editor-styles-wrapper h3 { font-size: 1.5rem; }
.editor-styles-wrapper h4 { font-size: 1.25rem; }
.editor-styles-wrapper h5 { font-size: 1.1rem; }
.editor-styles-wrapper h6 { font-size: 1rem; }

/* أنماط الفقرات */
.editor-styles-wrapper p {
    font-family: var(--ps-font-family);
    line-height: 1.7;
    margin-bottom: 1rem;
}

/* أنماط الروابط */
.editor-styles-wrapper a {
    color: var(--ps-color-primary);
    text-decoration: none;
}

.editor-styles-wrapper a:hover {
    text-decoration: underline;
}

/* أنماط القوائم */
.editor-styles-wrapper ul,
.editor-styles-wrapper ol {
    padding-right: 2rem;
    padding-left: 0;
}

.editor-styles-wrapper li {
    margin-bottom: 0.5rem;
}

/* أنماط الاقتباسات */
.editor-styles-wrapper blockquote {
    border-right: 4px solid var(--ps-color-primary);
    border-left: none;
    padding-right: 1.5rem;
    padding-left: 0;
    margin: 2rem 0;
    font-style: italic;
    background: var(--ps-color-secondary);
    padding: 1.5rem;
    border-radius: 8px;
}

/* أنماط الكود */
.editor-styles-wrapper code {
    background: var(--ps-color-secondary);
    padding: 2px 6px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
}

.editor-styles-wrapper pre {
    background: var(--ps-color-secondary);
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    direction: ltr;
}

.editor-styles-wrapper pre code {
    background: none;
    padding: 0;
}

/* أنماط الجداول */
.editor-styles-wrapper table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.editor-styles-wrapper th,
.editor-styles-wrapper td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: right;
}

.editor-styles-wrapper th {
    background: var(--ps-color-secondary);
    font-weight: 600;
}

/* أنماط Block Styles في المحرر */
.editor-styles-wrapper .is-style-ps-card-style {
    background: var(--ps-color-secondary);
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.editor-styles-wrapper .is-style-ps-hero-section {
    background: linear-gradient(135deg, var(--ps-color-primary), var(--ps-color-tertiary));
    color: white;
    padding: 3rem 2rem;
    text-align: center;
    border-radius: 12px;
}

.editor-styles-wrapper .is-style-ps-feature-box {
    background: var(--ps-color-secondary);
    padding: 2rem;
    text-align: center;
    border-radius: 12px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.editor-styles-wrapper .is-style-ps-section-title {
    text-align: center;
    position: relative;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.editor-styles-wrapper .is-style-ps-section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--ps-color-primary);
    border-radius: 2px;
}

.editor-styles-wrapper .is-style-ps-rounded-image img {
    border-radius: 12px;
}

/* أنماط الأزرار في المحرر */
.editor-styles-wrapper .is-style-ps-primary-button .wp-block-button__link {
    background: linear-gradient(135deg, var(--ps-color-primary), var(--ps-color-tertiary));
    color: white;
    border-radius: 50px;
    padding: 12px 32px;
    font-weight: 600;
    border: none;
}

.editor-styles-wrapper .is-style-ps-outline-button .wp-block-button__link {
    background: transparent;
    color: var(--ps-color-primary);
    border: 2px solid var(--ps-color-primary);
    border-radius: 50px;
    padding: 10px 30px;
    font-weight: 600;
}

/* تحسينات لمحرر الكتل */
.block-editor-writing-flow {
    font-family: var(--ps-font-family);
}

.block-editor-block-list__layout .wp-block {
    margin-bottom: 1.5rem;
}

/* أنماط placeholder للكتل الفارغة */
.wp-block-paragraph.is-selected:empty::before,
.wp-block-heading.is-selected:empty::before {
    color: #999;
    font-style: italic;
}

/* تحسينات الصور في المحرر */
.wp-block-image {
    margin: 1rem 0;
}

.wp-block-image img {
    max-width: 100%;
    height: auto;
}

/* أنماط المعرض */
.wp-block-gallery {
    margin: 1.5rem 0;
}

/* أنماط الفيديو */
.wp-block-video,
.wp-block-embed {
    margin: 1.5rem 0;
}

/* تحسينات للكتل المخصصة */
.wp-block-separator {
    border: none;
    border-top: 2px solid var(--ps-color-secondary);
    margin: 2rem 0;
}

.wp-block-quote {
    border-right: 4px solid var(--ps-color-primary);
    border-left: none;
    padding-right: 1.5rem;
    padding-left: 0;
    margin: 2rem 0;
}

/* تحسينات Gutenberg محددة */
.components-panel__body-title {
    font-family: var(--ps-font-family);
}

.block-editor-block-inspector {
    font-family: var(--ps-font-family);
}

/* أنماط Dark Mode للمحرر */
.is-dark-theme .editor-styles-wrapper {
    background: #1a1a1a;
    color: #ffffff;
}

.is-dark-theme .editor-styles-wrapper .is-style-ps-card-style {
    background: #2d3748;
}

.is-dark-theme .editor-styles-wrapper blockquote {
    background: #2d3748;
    border-color: #4a9eff;
}

.is-dark-theme .editor-styles-wrapper code {
    background: #2d3748;
    color: #4a9eff;
}

.is-dark-theme .editor-styles-wrapper pre {
    background: #2d3748;
}

/* تحسينات الخط للعربية */
.editor-styles-wrapper {
    font-feature-settings: 'liga' 1, 'calt' 1, 'kern' 1;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* تحسينات المسافات للنص العربي */
.editor-styles-wrapper p,
.editor-styles-wrapper li {
    word-spacing: 0.1em;
    letter-spacing: 0.02em;
}

/* أنماط إضافية للكتل الجديدة */
.wp-block-columns .wp-block-column {
    margin-bottom: 1rem;
}

.wp-block-media-text {
    margin: 2rem 0;
}

.wp-block-cover {
    margin: 2rem 0;
    border-radius: 12px;
    overflow: hidden;
}

/* تحسينات للأيقونات والرموز */
.editor-styles-wrapper .dashicon,
.editor-styles-wrapper .emoji {
    display: inline-block;
    vertical-align: middle;
}
```

## 📁 **ملف Service Worker - sw.js**

```javascript
/**
 * Service Worker for Practical Solutions Theme
 * خدمة التخزين المؤقت للقالب
 */

const CACHE_NAME = 'practical-solutions-v2.1.0';
const urlsToCache = [
    '/',
    '/wp-content/themes/practical-solutions-pro/assets/css/main.css',
    '/wp-content/themes/practical-solutions-pro/assets/css/dark-mode.css',
    '/wp-content/themes/practical-solutions-pro/assets/css/responsive.css',
    '/wp-content/themes/practical-solutions-pro/assets/js/main.js',
    '/wp-content/themes/practical-solutions-pro/assets/js/search-enhanced.js',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('Cache opened');
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
                        console.log('Deleting old cache:', cacheName);
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
```

## 📋 **خطة التنفيذ الكاملة**

### 1. إنشاء هيكل المجلدات:
```bash
practical-solutions-pro/
├── style.css
├── theme.json
├── functions.php
├── sw.js
├── templates/
│   ├── index.html
│   ├── single.html
│   ├── page.html
│   ├── archive.html
│   ├── search.html
│   └── 404.html
├── parts/
│   ├── header.html
│   ├── footer.html
│   └── sidebar.html
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   ├── dark-mode.css
│   │   ├── responsive.css
│   │   └── editor-styles.css
│   ├── js/
│   │   ├── main.js
│   │   └── search-enhanced.js
│   ├── images/
│   └── fonts/
└── languages/
```


