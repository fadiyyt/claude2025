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