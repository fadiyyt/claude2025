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