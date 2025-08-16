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