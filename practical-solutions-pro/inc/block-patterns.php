<?php
/**
 * Block Patterns Registration - Fixed and Enhanced Version
 * تسجيل أنماط الكتل المُصححة والمحسنة
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Block_Patterns_Registry {

    public function __construct() {
        add_action('init', [$this, 'register_categories_and_patterns'], 9);
    }

    public function register_categories_and_patterns() {
        // تسجيل الفئات أولاً
        $this->register_pattern_categories();
        
        // ثم تسجيل الأنماط
        $this->register_all_patterns();
    }

    private function register_pattern_categories() {
        if (!function_exists('register_block_pattern_category')) {
            return;
        }

        $categories = [
            'practical-solutions' => [
                'label' => __('الحلول العملية', 'practical-solutions'),
                'description' => __('أنماط خاصة بقالب الحلول العملية', 'practical-solutions')
            ],
            'ps-heroes' => [
                'label' => __('أقسام البطل', 'practical-solutions'),
                'description' => __('أقسام رئيسية جذابة للصفحة الرئيسية', 'practical-solutions')
            ],
            'ps-features' => [
                'label' => __('عرض الميزات', 'practical-solutions'),
                'description' => __('أقسام لعرض الميزات والخدمات', 'practical-solutions')
            ],
            'ps-testimonials' => [
                'label' => __('آراء العملاء', 'practical-solutions'),
                'description' => __('أقسام عرض آراء وتقييمات العملاء', 'practical-solutions')
            ],
            'ps-cta' => [
                'label' => __('دعوات العمل', 'practical-solutions'),
                'description' => __('أقسام دعوة المستخدم للعمل', 'practical-solutions')
            ],
            'ps-content' => [
                'label' => __('أقسام المحتوى', 'practical-solutions'),
                'description' => __('أقسام متنوعة لعرض المحتوى', 'practical-solutions')
            ]
        ];

        foreach ($categories as $slug => $args) {
            register_block_pattern_category($slug, $args);
        }
    }

    private function register_all_patterns() {
        // نمط قسم البطل الرئيسي
        register_block_pattern('ps/hero-section', [
            'title' => __('قسم البطل الرئيسي', 'practical-solutions'),
            'description' => __('قسم رئيسي جذاب مع عنوان ووصف وأزرار', 'practical-solutions'),
            'categories' => ['ps-heroes'],
            'keywords' => [__('بطل', 'practical-solutions'), __('رئيسي', 'practical-solutions'), __('عنوان', 'practical-solutions')],
            'content' => '
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}}},"backgroundColor":"primary","textColor":"white","layout":{"type":"constrained"}} -->
                <div class="wp-block-group has-white-color has-primary-background-color has-text-color has-background" style="padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
                    
                    <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"x-large"} -->
                    <h1 class="wp-block-heading has-text-align-center has-x-large-font-size">🏠 حلول عملية لحياة أفضل</h1>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem","bottom":"2rem"}}},"fontSize":"medium"} -->
                    <p class="has-text-align-center has-medium-font-size" style="margin-top:1rem;margin-bottom:2rem">اكتشف أفضل الحلول العملية لتحسين حياتك اليومية وزيادة الإنتاجية في البيت والعمل</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"accent","textColor":"white","className":"is-style-ps-primary-button"} -->
                        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link has-white-color has-accent-background-color has-text-color has-background wp-element-button">ابدأ الآن</a></div>
                        <!-- /wp:button -->
                        
                        <!-- wp:button {"textColor":"white","className":"is-style-ps-outline-button"} -->
                        <div class="wp-block-button is-style-ps-outline-button"><a class="wp-block-button__link has-white-color has-text-color wp-element-button">تعرف أكثر</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                    
                </div>
                <!-- /wp:group -->
            '
        ]);

        // نمط عرض الميزات
        register_block_pattern('ps/features-grid', [
            'title' => __('شبكة الميزات', 'practical-solutions'),
            'description' => __('عرض الميزات في شكل شبكة منظمة', 'practical-solutions'),
            'categories' => ['ps-features'],
            'keywords' => [__('ميزات', 'practical-solutions'), __('خدمات', 'practical-solutions'), __('شبكة', 'practical-solutions')],
            'content' => '
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
                    
                    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
                    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:3rem">✨ لماذا تختار حلولنا العملية؟</h2>
                    <!-- /wp:heading -->
                    
                    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
                    <div class="wp-block-columns">
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"className":"ps-feature-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group ps-feature-card has-light-gray-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                                <p class="has-text-align-center" style="font-size:3rem">🎯</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"1rem"}}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:1rem">حلول مخصصة</h3>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center">نقدم حلول مخصصة تناسب احتياجاتك الفردية وظروف حياتك الخاصة</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"className":"ps-feature-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group ps-feature-card has-light-gray-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                                <p class="has-text-align-center" style="font-size:3rem">⚡</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"1rem"}}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:1rem">سرعة التطبيق</h3>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center">حلول سريعة وعملية يمكن تطبيقها فوراً دون تعقيدات أو متطلبات صعبة</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"className":"ps-feature-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group ps-feature-card has-light-gray-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3rem"}}} -->
                                <p class="has-text-align-center" style="font-size:3rem">🔄</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"1rem"}}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:1rem">تحديث مستمر</h3>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center">نحرص على تحديث الحلول باستمرار لتواكب أحدث التطورات والاحتياجات</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                    </div>
                    <!-- /wp:columns -->
                    
                </div>
                <!-- /wp:group -->
            '
        ]);

        // نمط دعوة للعمل
        register_block_pattern('ps/cta-section', [
            'title' => __('دعوة للعمل', 'practical-solutions'),
            'description' => __('قسم دعوة المستخدم لاتخاذ إجراء', 'practical-solutions'),
            'categories' => ['ps-cta'],
            'keywords' => [__('دعوة', 'practical-solutions'), __('إجراء', 'practical-solutions'), __('زر', 'practical-solutions')],
            'content' => '
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}},"backgroundColor":"accent","textColor":"white","layout":{"type":"constrained"}} -->
                <div class="wp-block-group has-white-color has-accent-background-color has-text-color has-background" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
                    
                    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} -->
                    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:1rem">🚀 جاهز لتغيير حياتك؟</h2>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}},"fontSize":"medium"} -->
                    <p class="has-text-align-center has-medium-font-size" style="margin-bottom:2rem">انضم إلى آلاف الأشخاص الذين حسنوا حياتهم باستخدام حلولنا العملية</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"accent","className":"is-style-ps-primary-button"} -->
                        <div class="wp-block-button is-style-ps-primary-button"><a class="wp-block-button__link has-accent-color has-white-background-color has-text-color has-background wp-element-button">ابدأ رحلتك الآن</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                    
                </div>
                <!-- /wp:group -->
            '
        ]);

        // نمط آراء العملاء
        register_block_pattern('ps/testimonials-section', [
            'title' => __('آراء العملاء', 'practical-solutions'),
            'description' => __('قسم عرض آراء وتقييمات العملاء', 'practical-solutions'),
            'categories' => ['ps-testimonials'],
            'keywords' => [__('آراء', 'practical-solutions'), __('تقييمات', 'practical-solutions'), __('عملاء', 'practical-solutions')],
            'content' => '
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                <div class="wp-block-group has-light-gray-background-color has-background" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
                    
                    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
                    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:3rem">💬 ماذا يقول عملاؤنا؟</h2>
                    <!-- /wp:heading -->
                    
                    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
                    <div class="wp-block-columns">
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group has-white-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem;margin-bottom:1.5rem">"الحلول العملية التي وجدتها هنا ساعدتني كثيراً في تنظيم منزلي وحياتي. أنصح الجميع بتجربتها!"</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:group {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-group">
                                    <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"is-style-rounded"} -->
                                    <figure class="wp-block-image size-thumbnail is-resized is-style-rounded"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiM2Yjc2ODAiLz4KPHN2ZyB4PSIxNSIgeT0iMTIiIHdpZHRoPSIzMCIgaGVpZ2h0PSIzNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMTIgMTJDMTQuNDg1MyAxMiAxNi41IDkuOTg1MjggMTYuNSA3LjVDMTYuNSA1LjAxNDcyIDE0LjQ4NTMgMyAxMiAzQzkuNTE0NzIgMyA3LjUgNS4wMTQ3MiA3LjUgNy41QzcuNSA5Ljk4NTI4IDkuNTE0NzIgMTIgMTIgMTJaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMTIuMDAwMiAxNC4yNUM2LjYyNTI0IDE0LjI1IDIuMjUwMjQgMTguNjI1IDIuMjUwMjQgMjRIMjEuNzUwMkMyMS43NTAyIDE4LjYyNSAxNy4zNzUyIDE0LjI1IDEyLjAwMDIgMTQuMjVaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4KPC9zdmc+" alt="صورة العميل" width="60" height="60"/></figure>
                                    <!-- /wp:image -->
                                </div>
                                <!-- /wp:group -->
                                
                                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                                <h4 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">فاطمة أحمد</h4>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                                <p class="has-text-align-center has-tertiary-color has-text-color" style="font-size:0.9rem">ربة منزل</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group has-white-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem;margin-bottom:1.5rem">"تطبيق النصائح المقدمة هنا ساعدني في تحسين إنتاجيتي في العمل بشكل ملحوظ. محتوى ممتاز!"</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:group {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-group">
                                    <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"is-style-rounded"} -->
                                    <figure class="wp-block-image size-thumbnail is-resized is-style-rounded"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiMyNTYzZWIiLz4KPHN2ZyB4PSIxNSIgeT0iMTIiIHdpZHRoPSIzMCIgaGVpZ2h0PSIzNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMTIgMTJDMTQuNDg1MyAxMiAxNi41IDkuOTg1MjggMTYuNSA3LjVDMTYuNSA1LjAxNDcyIDE0LjQ4NTMgMyAxMiAzQzkuNTE0NzIgMyA3LjUgNS4wMTQ3MiA3LjUgNy41QzcuNSA5Ljk4NTI4IDkuNTE0NzIgMTIgMTIgMTJaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMTIuMDAwMiAxNC4yNUM2LjYyNTI0IDE0LjI1IDIuMjUwMjQgMTguNjI1IDIuMjUwMjQgMjRIMjEuNzUwMkMyMS43NTAyIDE4LjYyNSAxNy4zNzUyIDE0LjI1IDEyLjAwMDIgMTQuMjVaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4KPC9zdmc+" alt="صورة العميل" width="60" height="60"/></figure>
                                    <!-- /wp:image -->
                                </div>
                                <!-- /wp:group -->
                                
                                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                                <h4 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">محمد السالم</h4>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                                <p class="has-text-align-center has-tertiary-color has-text-color" style="font-size:0.9rem">مدير مشاريع</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"10px"}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group has-white-background-color has-background" style="border-radius:10px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem;margin-bottom:1.5rem">"موقع رائع يقدم حلول عملية وسهلة التطبيق. استفدت كثيراً من النصائح المالية المقدمة."</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:group {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-group">
                                    <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"is-style-rounded"} -->
                                    <figure class="wp-block-image size-thumbnail is-resized is-style-rounded"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiNmNTllMGIiLz4KPHN2ZyB4PSIxNSIgeT0iMTIiIHdpZHRoPSIzMCIgaGVpZ2h0PSIzNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMTIgMTJDMTQuNDg1MyAxMiAxNi41IDkuOTg1MjggMTYuNSA3LjVDMTYuNSA1LjAxNDcyIDE0LjQ4NTMgMyAxMiAzQzkuNTE0NzIgMyA3LjUgNS4wMTQ3MiA3LjUgNy41QzcuNSA5Ljk4NTI4IDkuNTE0NzIgMTIgMTIgMTJaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMTIuMDAwMiAxNC4yNUM2LjYyNTI0IDE0LjI1IDIuMjUwMjQgMTguNjI1IDIuMjUwMjQgMjRIMjEuNzUwMkMyMS43NTAyIDE4LjYyNSAxNy4zNzUyIDE0LjI1IDEyLjAwMDIgMTQuMjVaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4KPC9zdmc+" alt="صورة العميل" width="60" height="60"/></figure>
                                    <!-- /wp:image -->
                                </div>
                                <!-- /wp:group -->
                                
                                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}}}} -->
                                <h4 class="wp-block-heading has-text-align-center" style="margin-top:1rem;margin-bottom:0.5rem">سارة الخالد</h4>
                                <!-- /wp:heading -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem"}},"textColor":"tertiary"} -->
                                <p class="has-text-align-center has-tertiary-color has-text-color" style="font-size:0.9rem">مستشارة مالية</p>
                                <!-- /wp:paragraph -->
                                
                                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"}}} -->
                                <p class="has-text-align-center" style="font-size:1.2rem">⭐⭐⭐⭐⭐</p>
                                <!-- /wp:paragraph -->
                                
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:column -->
                        
                    </div>
                    <!-- /wp:columns -->
                    
                </div>
                <!-- /wp:group -->
            '
        ]);

        // نمط قسم الأسئلة الشائعة
        register_block_pattern('ps/faq-section', [
            'title' => __('الأسئلة الشائعة', 'practical-solutions'),
            'description' => __('قسم الأسئلة والأجوبة المتكررة', 'practical-solutions'),
            'categories' => ['ps-content'],
            'keywords' => [__('أسئلة', 'practical-solutions'), __('أجوبة', 'practical-solutions'), __('مساعدة', 'practical-solutions')],
            'content' => '
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
                <div class="wp-block-group" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
                    
                    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
                    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:3rem">❓ الأسئلة الشائعة</h2>
                    <!-- /wp:heading -->
                    
                    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-light-gray-background-color has-background" style="border-radius:8px;margin-bottom:1.5rem">
                        
                        <!-- wp:details {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}}} -->
                        <details class="wp-block-details" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                            <!-- wp:summary -->
                            <summary>كيف يمكنني تطبيق الحلول العملية في حياتي اليومية؟</summary>
                            <!-- /wp:summary -->
                            
                            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"1rem"}}}} -->
                            <p style="margin-top:1rem">نقدم خطوات بسيطة وواضحة لتطبيق كل حل عملي. ابدأ بحل واحد فقط وطبقه لمدة أسبوع قبل الانتقال للحل التالي. هذا يضمن تكوين عادات إيجابية دائمة.</p>
                            <!-- /wp:paragraph -->
                        </details>
                        <!-- /wp:details -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-light-gray-background-color has-background" style="border-radius:8px;margin-bottom:1.5rem">
                        
                        <!-- wp:details {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}}} -->
                        <details class="wp-block-details" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                            <!-- wp:summary -->
                            <summary>هل الحلول المقدمة مناسبة للجميع؟</summary>
                            <!-- /wp:summary -->
                            
                            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"1rem"}}}} -->
                            <p style="margin-top:1rem">نعم، نحرص على تقديم حلول متنوعة تناسب مختلف الأعمار والظروف والاحتياجات. كما نقدم بدائل وتعديلات لكل حل حسب الظروف الفردية.</p>
                            <!-- /wp:paragraph -->
                        </details>
                        <!-- /wp:details -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"margin":{"bottom":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-light-gray-background-color has-background" style="border-radius:8px;margin-bottom:1.5rem">
                        
                        <!-- wp:details {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}}} -->
                        <details class="wp-block-details" style="padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
                            <!-- wp:summary -->
                            <summary>كم من الوقت أحتاج لرؤية النتائج؟</summary>
                            <!-- /wp:summary -->
                            
                            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"1rem"}}}} -->
                            <p style="margin-top:1rem">يختلف الوقت حسب نوع الحل المطبق. الحلول البسيطة قد تظهر نتائجها خلال أيام، بينما التغييرات الكبيرة قد تحتاج 2-4 أسابيع. المهم هو الثبات والاستمرارية.</p>
                            <!-- /wp:paragraph -->
                        </details>
                        <!-- /wp:details -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
            '
        ]);
    }
}

// تشغيل تسجيل أنماط الكتل
new PS_Block_Patterns_Registry();
?>