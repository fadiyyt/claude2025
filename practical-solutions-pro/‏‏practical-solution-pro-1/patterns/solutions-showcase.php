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