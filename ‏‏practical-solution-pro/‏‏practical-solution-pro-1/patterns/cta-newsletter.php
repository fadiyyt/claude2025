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