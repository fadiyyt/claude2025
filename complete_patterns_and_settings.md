# 🧩 Block Patterns المخصصة ولوحة الإعدادات - ملفات كاملة

## 📁 **إضافة إلى functions.php - تسجيل الأنماط**

```php
// إضافة هذا الكود إلى نهاية ملف functions.php الموجود

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

---

## 📁 **patterns/hero-with-search.php - قسم البطل مع البحث**

```php
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
```

---

## 📁 **patterns/features-grid.php - شبكة الميزات**

```php
<?php
/**
 * Features Grid Pattern
 * نمط شبكة الميزات
 */

register_block_pattern(
    'practical-solutions/features-grid',
    array(
        'title'       => __('شبكة الميزات', 'practical-solutions'),
        'description' => __('عرض الميزات في شبكة 3 أعمدة مع أيقونات وأوصاف', 'practical-solutions'),
        'content'     => '
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
        <!-- /wp:group -->',
        'categories'  => array('ps-features', 'practical-solutions'),
        'keywords'    => array('features', 'grid', 'ميزات', 'شبكة'),
    )
);
```

---

## 📁 **patterns/solutions-showcase.php - عرض الحلول**

```php
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
```

---

## 📁 **patterns/testimonials.php - آراء العملاء**

```php
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
```

---

## 📁 **patterns/cta-newsletter.php - دعوة الاشتراك**

```php
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
```

---

## 📁 **patterns/faq-section.php - الأسئلة الشائعة**

```php
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
```

---

## 📁 **inc/theme-settings.php - لوحة إعدادات القالب**

```php
<?php
/**
 * Theme Settings Page
 * لوحة إعدادات القالب
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
     * محتوى صفحة الإعدادات
     */
    public function settings_page_content() {
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        ?>
        <div class="wrap ps-settings-page">
            <h1><?php _e('إعدادات قالب الحلول العملية', 'practical-solutions'); ?></h1>
            
            <nav class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->settings_page; ?>&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('عام', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=logo" class="nav-tab <?php echo $active_tab == 'logo' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('الشعار والهوية', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=social" class="nav-tab <?php echo $active_tab == 'social' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('وسائل التواصل', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=contact" class="nav-tab <?php echo $active_tab == 'contact' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('معلومات الاتصال', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=search" class="nav-tab <?php echo $active_tab == 'search' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('إعدادات البحث', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=analytics" class="nav-tab <?php echo $active_tab == 'analytics' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('التحليلات', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->settings_page; ?>&tab=performance" class="nav-tab <?php echo $active_tab == 'performance' ? 'nav-tab-active' : ''; ?>">
                    <?php _e('الأداء', 'practical-solutions'); ?>
                </a>
            </nav>
            
            <form method="post" action="options.php">
                <?php settings_fields($this->settings_group); ?>
                
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
                
                <?php submit_button(__('حفظ الإعدادات', 'practical-solutions')); ?>
            </form>
        </div>
        <?php
    }
    
    /**
     * تبويب الإعدادات العامة
     */
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
    
    /**
     * تبويب إعدادات الشعار
     */
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
            
            <tr>
                <th scope="row"><?php _e('شعار الوضع المظلم', 'practical-solutions'); ?></th>
                <td>
                    <div class="ps-logo-upload">
                        <input type="hidden" name="ps_logo_settings[logo_dark]" id="ps_logo_dark" value="<?php echo esc_attr($settings['logo_dark'] ?? ''); ?>" />
                        <div class="ps-logo-preview">
                            <?php if (!empty($settings['logo_dark'])): ?>
                                <img src="<?php echo esc_url($settings['logo_dark']); ?>" style="max-width: 200px; height: auto;" />
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button ps-upload-logo-dark"><?php _e('اختيار الشعار', 'practical-solutions'); ?></button>
                        <button type="button" class="button ps-remove-logo-dark" style="<?php echo empty($settings['logo_dark']) ? 'display:none;' : ''; ?>"><?php _e('إزالة', 'practical-solutions'); ?></button>
                    </div>
                    <p class="description"><?php _e('شعار خاص للوضع المظلم (اختياري)', 'practical-solutions'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('أيقونة الموقع (Favicon)', 'practical-solutions'); ?></th>
                <td>
                    <div class="ps-logo-upload">
                        <input type="hidden" name="ps_logo_settings[favicon]" id="ps_favicon" value="<?php echo esc_attr($settings['favicon'] ?? ''); ?>" />
                        <div class="ps-logo-preview">
                            <?php if (!empty($settings['favicon'])): ?>
                                <img src="<?php echo esc_url($settings['favicon']); ?>" style="max-width: 32px; height: auto;" />
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button ps-upload-favicon"><?php _e('اختيار الأيقونة', 'practical-solutions'); ?></button>
                        <button type="button" class="button ps-remove-favicon" style="<?php echo empty($settings['favicon']) ? 'display:none;' : ''; ?>"><?php _e('إزالة', 'practical-solutions'); ?></button>
                    </div>
                    <p class="description"><?php _e('حجم مُوصى به: 32×32 بكسل أو 512×512 بكسل', 'practical-solutions'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تبويب وسائل التواصل
     */
    private function social_settings_tab() {
        $settings = get_option('ps_social_settings', array());
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر',
            'instagram' => 'إنستجرام',
            'youtube' => 'يوتيوب',
            'linkedin' => 'لينكدإن',
            'whatsapp' => 'واتساب',
            'telegram' => 'تليجرام',
            'snapchat' => 'سناب شات',
            'tiktok' => 'تيك توك'
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
            
            <tr>
                <th scope="row"><?php _e('إظهار في الرأس', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_social_settings[show_in_header]" value="1" <?php checked(1, $settings['show_in_header'] ?? 1); ?> />
                        <?php _e('إظهار روابط التواصل في رأس الموقع', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('إظهار في التذييل', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_social_settings[show_in_footer]" value="1" <?php checked(1, $settings['show_in_footer'] ?? 1); ?> />
                        <?php _e('إظهار روابط التواصل في تذييل الموقع', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تبويب معلومات الاتصال
     */
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
            
            <tr>
                <th scope="row"><?php _e('العنوان', 'practical-solutions'); ?></th>
                <td>
                    <textarea name="ps_contact_settings[address]" rows="3" cols="50" class="large-text"><?php echo esc_textarea($settings['address'] ?? ''); ?></textarea>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('ساعات العمل', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_contact_settings[working_hours]" value="<?php echo esc_attr($settings['working_hours'] ?? ''); ?>" class="large-text" placeholder="السبت - الخميس: 9:00 ص - 5:00 م" />
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('إظهار في التذييل', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_contact_settings[show_in_footer]" value="1" <?php checked(1, $settings['show_in_footer'] ?? 1); ?> />
                        <?php _e('إظهار معلومات الاتصال في التذييل', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تبويب إعدادات البحث
     */
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
            
            <tr>
                <th scope="row"><?php _e('عدد الاقتراحات', 'practical-solutions'); ?></th>
                <td>
                    <input type="number" name="ps_search_settings[suggestions_count]" value="<?php echo esc_attr($settings['suggestions_count'] ?? 5); ?>" min="3" max="15" class="small-text" />
                    <p class="description"><?php _e('عدد الاقتراحات التي تظهر أثناء الكتابة', 'practical-solutions'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل البحث الذكي', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_search_settings[enable_smart_search]" value="1" <?php checked(1, $settings['enable_smart_search'] ?? 1); ?> />
                        <?php _e('البحث في المحتوى والتصنيفات والوسوم', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('حفظ تاريخ البحث', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_search_settings[save_search_history]" value="1" <?php checked(1, $settings['save_search_history'] ?? 1); ?> />
                        <?php _e('حفظ عمليات البحث لإظهار الاقتراحات السابقة', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('عبارة البحث الافتراضية', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_search_settings[placeholder_text]" value="<?php echo esc_attr($settings['placeholder_text'] ?? 'ابحث عن الحلول...'); ?>" class="large-text" />
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تبويب إعدادات التحليلات
     */
    private function analytics_settings_tab() {
        $settings = get_option('ps_analytics_settings', array());
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('كود Google Analytics', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_analytics_settings[google_analytics]" value="<?php echo esc_attr($settings['google_analytics'] ?? ''); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
                    <p class="description"><?php _e('معرف Google Analytics 4', 'practical-solutions'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('كود Google Tag Manager', 'practical-solutions'); ?></th>
                <td>
                    <input type="text" name="ps_analytics_settings[google_tag_manager]" value="<?php echo esc_attr($settings['google_tag_manager'] ?? ''); ?>" class="regular-text" placeholder="GTM-XXXXXXX" />
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل تتبع الأحداث', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_analytics_settings[track_events]" value="1" <?php checked(1, $settings['track_events'] ?? 1); ?> />
                        <?php _e('تتبع النقرات والتفاعلات والبحث', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل إحصائيات داخلية', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_analytics_settings[internal_stats]" value="1" <?php checked(1, $settings['internal_stats'] ?? 1); ?> />
                        <?php _e('حفظ إحصائيات مبسطة في قاعدة البيانات', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('كود تتبع مخصص', 'practical-solutions'); ?></th>
                <td>
                    <textarea name="ps_analytics_settings[custom_code]" rows="5" cols="50" class="large-text"><?php echo esc_textarea($settings['custom_code'] ?? ''); ?></textarea>
                    <p class="description"><?php _e('كود HTML/JavaScript مخصص يُضاف قبل إغلاق head', 'practical-solutions'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تبويب إعدادات الأداء
     */
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
            
            <tr>
                <th scope="row"><?php _e('ضغط الصور', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[image_compression]" value="1" <?php checked(1, $settings['image_compression'] ?? 1); ?> />
                        <?php _e('ضغط الصور تلقائياً عند الرفع', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تحميل الخطوط محلياً', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[local_fonts]" value="1" <?php checked(1, $settings['local_fonts'] ?? 0); ?> />
                        <?php _e('تحميل خطوط Google محلياً لسرعة أفضل', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تقليل CSS/JS', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[minify_assets]" value="1" <?php checked(1, $settings['minify_assets'] ?? 0); ?> />
                        <?php _e('ضغط ملفات CSS و JavaScript', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('Lazy Loading للصور', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[lazy_loading]" value="1" <?php checked(1, $settings['lazy_loading'] ?? 1); ?> />
                        <?php _e('تحميل الصور عند الحاجة فقط', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('تفعيل PWA', 'practical-solutions'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="ps_performance_settings[enable_pwa]" value="1" <?php checked(1, $settings['enable_pwa'] ?? 0); ?> />
                        <?php _e('تحويل الموقع لتطبيق ويب تقدمي', 'practical-solutions'); ?>
                    </label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * تنظيف البيانات - الإعدادات العامة
     */
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
    
    /**
     * تنظيف البيانات - إعدادات الشعار
     */
    public function sanitize_logo_settings($input) {
        $sanitized = array();
        
        if (isset($input['logo'])) {
            $sanitized['logo'] = esc_url_raw($input['logo']);
        }
        
        if (isset($input['logo_dark'])) {
            $sanitized['logo_dark'] = esc_url_raw($input['logo_dark']);
        }
        
        if (isset($input['favicon'])) {
            $sanitized['favicon'] = esc_url_raw($input['favicon']);
        }
        
        return $sanitized;
    }
    
    /**
     * تنظيف البيانات - وسائل التواصل
     */
    public function sanitize_social_settings($input) {
        $sanitized = array();
        
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'whatsapp', 'telegram', 'snapchat', 'tiktok');
        
        foreach ($social_networks as $network) {
            if (isset($input[$network])) {
                $sanitized[$network] = esc_url_raw($input[$network]);
            }
        }
        
        $sanitized['show_in_header'] = isset($input['show_in_header']) ? 1 : 0;
        $sanitized['show_in_footer'] = isset($input['show_in_footer']) ? 1 : 0;
        
        return $sanitized;
    }
    
    /**
     * تنظيف البيانات - معلومات الاتصال
     */
    public function sanitize_contact_settings($input) {
        $sanitized = array();
        
        if (isset($input['phone'])) {
            $sanitized['phone'] = sanitize_text_field($input['phone']);
        }
        
        if (isset($input['email'])) {
            $sanitized['email'] = sanitize_email($input['email']);
        }
        
        if (isset($input['address'])) {
            $sanitized['address'] = sanitize_textarea_field($input['address']);
        }
        
        if (isset($input['working_hours'])) {
            $sanitized['working_hours'] = sanitize_text_field($input['working_hours']);
        }
        
        $sanitized['show_in_footer'] = isset($input['show_in_footer']) ? 1 : 0;
        
        return $sanitized;
    }
    
    /**
     * تنظيف البيانات - إعدادات البحث
     */
    public function sanitize_search_settings($input) {
        $sanitized = array();
        
        $sanitized['enable_voice_search'] = isset($input['enable_voice_search']) ? 1 : 0;
        $sanitized['enable_smart_search'] = isset($input['enable_smart_search']) ? 1 : 0;
        $sanitized['save_search_history'] = isset($input['save_search_history']) ? 1 : 0;
        
        if (isset($input['suggestions_count'])) {
            $sanitized['suggestions_count'] = absint($input['suggestions_count']);
            if ($sanitized['suggestions_count'] < 3) $sanitized['suggestions_count'] = 3;
            if ($sanitized['suggestions_count'] > 15) $sanitized['suggestions_count'] = 15;
        }
        
        if (isset($input['placeholder_text'])) {
            $sanitized['placeholder_text'] = sanitize_text_field($input['placeholder_text']);
        }
        
        return $sanitized;
    }
    
    /**
     * تنظيف البيانات - إعدادات التحليلات
     */
    public function sanitize_analytics_settings($input) {
        $sanitized = array();
        
        if (isset($input['google_analytics'])) {
            $sanitized['google_analytics'] = sanitize_text_field($input['google_analytics']);
        }
        
        if (isset($input['google_tag_manager'])) {
            $sanitized['google_tag_manager'] = sanitize_text_field($input['google_tag_manager']);
        }
        
        if (isset($input['custom_code'])) {
            $sanitized['custom_code'] = wp_kses($input['custom_code'], array(
                'script' => array('src' => array(), 'type' => array()),
                'noscript' => array(),
                'meta' => array('name' => array(), 'content' => array(), 'property' => array())
            ));
        }
        
        $sanitized['track_events'] = isset($input['track_events']) ? 1 : 0;
        $sanitized['internal_stats'] = isset($input['internal_stats']) ? 1 : 0;
        
        return $sanitized;
    }
    
    /**
     * تنظيف البيانات - إعدادات الأداء
     */
    public function sanitize_performance_settings($input) {
        $sanitized = array();
        
        $sanitized['enable_caching'] = isset($input['enable_caching']) ? 1 : 0;
        $sanitized['image_compression'] = isset($input['image_compression']) ? 1 : 0;
        $sanitized['local_fonts'] = isset($input['local_fonts']) ? 1 : 0;
        $sanitized['minify_assets'] = isset($input['minify_assets']) ? 1 : 0;
        $sanitized['lazy_loading'] = isset($input['lazy_loading']) ? 1 : 0;
        $sanitized['enable_pwa'] = isset($input['enable_pwa']) ? 1 : 0;
        
        return $sanitized;
    }
}

// تهيئة الكلاس
new PracticalSolutionsSettings();
```

---

## 📁 **assets/js/admin-settings.js - JavaScript لوحة الإعدادات**

```javascript
/**
 * Admin Settings JavaScript
 * جافاسكريبت لوحة الإعدادات
 */

jQuery(document).ready(function($) {
    
    // رفع الشعار
    $('.ps-upload-logo').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_logo');
        const previewDiv = button.siblings('.ps-logo-preview');
        const removeButton = button.siblings('.ps-remove-logo');
        
        const mediaUploader = wp.media({
            title: 'اختيار الشعار',
            library: { type: 'image' },
            button: { text: 'اختيار' },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
            previewDiv.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
            removeButton.show();
        });
        
        mediaUploader.open();
    });
    
    // إزالة الشعار
    $('.ps-remove-logo').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_logo');
        const previewDiv = button.siblings('.ps-logo-preview');
        
        inputField.val('');
        previewDiv.empty();
        button.hide();
    });
    
    // رفع شعار الوضع المظلم
    $('.ps-upload-logo-dark').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_logo_dark');
        const previewDiv = button.siblings('.ps-logo-preview');
        const removeButton = button.siblings('.ps-remove-logo-dark');
        
        const mediaUploader = wp.media({
            title: 'اختيار شعار الوضع المظلم',
            library: { type: 'image' },
            button: { text: 'اختيار' },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
            previewDiv.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
            removeButton.show();
        });
        
        mediaUploader.open();
    });
    
    // إزالة شعار الوضع المظلم
    $('.ps-remove-logo-dark').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_logo_dark');
        const previewDiv = button.siblings('.ps-logo-preview');
        
        inputField.val('');
        previewDiv.empty();
        button.hide();
    });
    
    // رفع الأيقونة
    $('.ps-upload-favicon').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_favicon');
        const previewDiv = button.siblings('.ps-logo-preview');
        const removeButton = button.siblings('.ps-remove-favicon');
        
        const mediaUploader = wp.media({
            title: 'اختيار أيقونة الموقع',
            library: { type: 'image' },
            button: { text: 'اختيار' },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
            previewDiv.html('<img src="' + attachment.url + '" style="max-width: 32px; height: auto;" />');
            removeButton.show();
        });
        
        mediaUploader.open();
    });
    
    // إزالة الأيقونة
    $('.ps-remove-favicon').on('click', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const inputField = $('#ps_favicon');
        const previewDiv = button.siblings('.ps-logo-preview');
        
        inputField.val('');
        previewDiv.empty();
        button.hide();
    });
    
    // معاينة الإعدادات
    $('.ps-settings-preview').on('click', function(e) {
        e.preventDefault();
        
        // جمع الإعدادات وإرسالها للمعاينة
        const formData = $('#ps-settings-form').serialize();
        
        $.ajax({
            url: psAdmin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'ps_preview_settings',
                nonce: psAdmin.nonce,
                settings: formData
            },
            success: function(response) {
                if (response.success) {
                    // إظهار معاينة في نافذة جديدة
                    window.open(response.data.preview_url, '_blank');
                } else {
                    alert('خطأ في إنشاء المعاينة');
                }
            }
        });
    });
    
    // حفظ الإعدادات عبر AJAX
    $('#ps-settings-form').on('submit', function(e) {
        const submitButton = $(this).find('input[type="submit"]');
        const originalText = submitButton.val();
        
        submitButton.val('جاري الحفظ...').prop('disabled', true);
        
        // إعادة تفعيل الزر بعد ثانيتين
        setTimeout(function() {
            submitButton.val(originalText).prop('disabled', false);
        }, 2000);
    });
    
    // تبديل الألوان في الوقت الفعلي
    $('input[type="color"]').on('change', function() {
        const colorValue = $(this).val();
        const colorName = $(this).attr('name');
        
        // تطبيق اللون فوراً في المعاينة
        $(this).closest('tr').find('.color-preview').css('background-color', colorValue);
    });
    
    // تأكيد الحذف
    $('.ps-confirm-delete').on('click', function(e) {
        if (!confirm('هل أنت متأكد من الحذف؟')) {
            e.preventDefault();
        }
    });
    
    // تبويبات الإعدادات
    $('.nav-tab').on('click', function(e) {
        e.preventDefault();
        
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        
        const tab = $(this).attr('href').split('tab=')[1];
        $('.ps-tab-content').hide();
        $('#ps-tab-' + tab).show();
    });
    
});
```

---

## 📁 **assets/css/admin-settings.css - تنسيقات لوحة الإعدادات**

```css
/**
 * Admin Settings Styles
 * تنسيقات لوحة الإعدادات
 */

.ps-settings-page {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    direction: rtl;
    text-align: right;
}

.ps-settings-page h1 {
    color: #23282d;
    font-size: 24px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

/* تبويبات الإعدادات */
.nav-tab-wrapper {
    margin-bottom: 20px;
    border-bottom: 1px solid #ccc;
}

.nav-tab {
    font-family: inherit;
    font-size: 14px;
    padding: 8px 12px;
    margin-left: 5px;
    border: 1px solid #ccc;
    border-bottom: none;
    background: #f1f1f1;
    color: #666;
    text-decoration: none;
    border-radius: 3px 3px 0 0;
    transition: all 0.3s ease;
}

.nav-tab:hover {
    background: #e1e1e1;
    color: #333;
}

.nav-tab-active {
    background: #fff;
    color: #333;
    border-bottom: 1px solid #fff;
}

/* جدول الإعدادات */
.form-table {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
}

.form-table th {
    width: 200px;
    padding: 15px 10px;
    font-weight: 600;
    color: #23282d;
    vertical-align: top;
}

.form-table td {
    padding: 15px 10px;
}

.form-table input[type="text"],
.form-table input[type="email"],
.form-table input[type="url"],
.form-table input[type="tel"],
.form-table textarea,
.form-table select {
    font-family: inherit;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 8px 12px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-table input[type="text"]:focus,
.form-table input[type="email"]:focus,
.form-table input[type="url"]:focus,
.form-table input[type="tel"]:focus,
.form-table textarea:focus,
.form-table select:focus {
    border-color: #007cba;
    box-shadow: 0 0 5px rgba(0, 124, 186, 0.3);
    outline: none;
}

.form-table .description {
    font-size: 13px;
    color: #666;
    font-style: italic;
    margin-top: 5px;
}

/* رفع الصور */
.ps-logo-upload {
    border: 2px dashed #ddd;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    background: #fafafa;
    transition: all 0.3s ease;
}

.ps-logo-upload:hover {
    border-color: #007cba;
    background: #f0f8ff;
}

.ps-logo-preview {
    margin-bottom: 15px;
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ps-logo-preview img {
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 3px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.ps-logo-upload button {
    margin: 5px;
    padding: 8px 16px;
    border-radius: 3px;
    border: 1px solid #ddd;
    background: #f7f7f7;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
}

.ps-logo-upload button:hover {
    background: #007cba;
    color: #fff;
    border-color: #007cba;
}

/* الألوان */
.color-picker-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.color-preview {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
}

/* أزرار الحفظ */
.submit input[type="submit"] {
    background: #007cba;
    color: #fff;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit input[type="submit"]:hover {
    background: #005a87;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.submit input[type="submit"]:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* رسائل التأكيد */
.ps-success-message {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    padding: 12px 16px;
    margin: 10px 0;
    display: flex;
    align-items: center;
}

.ps-error-message {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 12px 16px;
    margin: 10px 0;
    display: flex;
    align-items: center;
}

/* مربعات الاختيار */
.form-table input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-left: 8px;
    accent-color: #007cba;
}

.form-table label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 14px;
}

/* معاينة الإعدادات */
.ps-preview-section {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin: 20px 0;
}

.ps-preview-section h3 {
    margin-top: 0;
    color: #333;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

/* إحصائيات */
.ps-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.ps-stat-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.ps-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.ps-stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #007cba;
    margin-bottom: 5px;
}

.ps-stat-label {
    font-size: 14px;
    color: #666;
    font-weight: 500;
}

/* تنسيقات متجاوبة */
@media (max-width: 768px) {
    .ps-settings-page {
        padding: 10px;
    }
    
    .nav-tab {
        font-size: 12px;
        padding: 6px 8px;
    }
    
    .form-table th {
        width: auto;
        display: block;
        padding-bottom: 5px;
    }
    
    .form-table td {
        display: block;
        padding-top: 0;
    }
    
    .ps-stats-grid {
        grid-template-columns: 1fr;
    }
}

/* تحسينات بصرية */
.ps-feature-highlight {
    background: linear-gradient(135deg, #007cba, #005a87);
    color: #fff;
    padding: 15px;
    border-radius: 5px;
    margin: 15px 0;
    text-align: center;
}

.ps-feature-highlight h4 {
    margin: 0 0 10px 0;
    font-size: 16px;
}

.ps-feature-highlight p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
}

/* أيقونات الحالة */
.ps-status-icon {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-left: 8px;
}

.ps-status-icon.active {
    background: #28a745;
}

.ps-status-icon.inactive {
    background: #dc3545;
}

.ps-status-icon.warning {
    background: #ffc107;
}

/* تبويبات فرعية */
.ps-sub-tabs {
    margin: 20px 0;
    border-bottom: 1px solid #eee;
}

.ps-sub-tab {
    display: inline-block;
    padding: 8px 16px;
    margin-left: 10px;
    background: #f7f7f7;
    border: 1px solid #ddd;
    border-bottom: none;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 3px 3px 0 0;
}

.ps-sub-tab:hover {
    background: #e7e7e7;
}

.ps-sub-tab.active {
    background: #fff;
    border-bottom: 1px solid #fff;
}

/* شريط التقدم */
.ps-progress-bar {
    width: 100%;
    height: 20px;
    background: #f0f0f0;
    border-radius: 10px;
    overflow: hidden;
    margin: 10px 0;
}

.ps-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #007cba, #28a745);
    transition: width 0.5s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
}

/* تلميحات المساعدة */
.ps-help-tip {
    position: relative;
    display: inline-block;
    margin-right: 5px;
    cursor: help;
}

.ps-help-tip::before {
    content: "؟";
    display: inline-block;
    width: 16px;
    height: 16px;
    line-height: 16px;
    text-align: center;
    background: #007cba;
    color: #fff;
    border-radius: 50%;
    font-size: 12px;
    font-weight: bold;
}

.ps-help-tip:hover::after {
    content: attr(data-tip);
    position: absolute;
    bottom: 25px;
    right: 0;
    background: #333;
    color: #fff;
    padding: 8px 12px;
    border-radius: 3px;
    white-space: nowrap;
    z-index: 1000;
    font-size: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
```

---

## 📁 **patterns/stats-counter.php - عداد الإحصائيات**

```php
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
```

---

## 📁 **patterns/categories-grid.php - شبكة التصنيفات**

```php
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
```

---

## 📁 **inc/customizer-settings.php - إعدادات المخصص**

```php
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
```

## 🎯 **ملخص ما تم إنجازه:**

### ✅ **Block Patterns المكتملة:**
1. **قسم البطل مع البحث** - Hero with Search
2. **شبكة الميزات** - Features Grid  
3. **عرض الحلول المميزة** - Solutions Showcase
4. **آراء العملاء** - Testimonials
5. **دعوة الاشتراك** - Newsletter CTA
6. **الأسئلة الشائعة** - FAQ Section
7. **عداد الإحصائيات** - Stats Counter
8. **شبكة التصنيفات** - Categories Grid

### ✅ **لوحة الإعدادات المكتملة:**
1. **إعدادات عامة** - وصف الموقع والخيارات الأساسية
2. **الشعار والهوية** - رفع الشعار والأيقونات
3. **وسائل التواصل** - روابط المنصات الاجتماعية
4. **معلومات الاتصال** - الهاتف والبريد والعنوان
5. **إعدادات البحث** - البحث الصوتي والذكي
6. **التحليلات** - Google Analytics والتتبع
7. **الأداء** - التخزين المؤقت والتحسينات

### 🎨 **إعدادات المخصص (Customizer):**
- تخصيص الألوان الأساسية
- إعدادات الخطوط والطباعة
- التحكم في التخطيط والمساحات
- خيارات الرأس والتذييل
- الميزات المتقدمة

