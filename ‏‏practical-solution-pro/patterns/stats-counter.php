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