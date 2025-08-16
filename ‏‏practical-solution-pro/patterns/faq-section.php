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