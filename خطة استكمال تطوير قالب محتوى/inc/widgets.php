<?php
/**
 * إعدادات الويدجت ومناطق الشريط الجانبي
 * 
 * @package Muhtawaa
 * @since 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة إدارة الويدجت
 */
class MuhtawaaWidgets {
    
    /**
     * تسجيل مناطق الويدجت (الشريط الجانبي)
     */
    public static function register_sidebars() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name'          => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
            'id'            => 'main-sidebar',
            'description'   => __('يظهر في معظم صفحات الموقع', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // شريط جانبي للحلول
        register_sidebar(array(
            'name'          => __('شريط الحلول الجانبي', 'muhtawaa'),
            'id'            => 'solutions-sidebar',
            'description'   => __('يظهر في صفحات الحلول والأرشيف', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="widget solutions-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><i class="fas fa-lightbulb"></i> ',
            'after_title'   => '</h3>',
        ));
        
        // شريط جانبي للصفحات
        register_sidebar(array(
            'name'          => __('شريط الصفحات الجانبي', 'muhtawaa'),
            'id'            => 'pages-sidebar',
            'description'   => __('يظهر في الصفحات الثابتة', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="widget page-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // منطقة الهيدر العلوية
        register_sidebar(array(
            'name'          => __('منطقة الهيدر العلوية', 'muhtawaa'),
            'id'            => 'header-top',
            'description'   => __('تظهر أعلى الهيدر', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<span class="widget-title">',
            'after_title'   => '</span>',
        ));
        
        // منطقة أسفل المحتوى
        register_sidebar(array(
            'name'          => __('أسفل المحتوى', 'muhtawaa'),
            'id'            => 'after-content',
            'description'   => __('تظهر بعد المحتوى الرئيسي', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="after-content-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // مناطق التذييل (4 أعمدة)
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name'          => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
                'id'            => 'footer-' . $i,
                'description'   => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>',
            ));
        }
        
        // منطقة المتجر (WooCommerce)
        if (class_exists('WooCommerce')) {
            register_sidebar(array(
                'name'          => __('شريط المتجر الجانبي', 'muhtawaa'),
                'id'            => 'shop-sidebar',
                'description'   => __('يظهر في صفحات المتجر', 'muhtawaa'),
                'before_widget' => '<div id="%1$s" class="widget shop-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
        }
        
        // منطقة قبل المقال
        register_sidebar(array(
            'name'          => __('قبل المقال', 'muhtawaa'),
            'id'            => 'before-post',
            'description'   => __('تظهر قبل محتوى المقال', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="before-post-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // منطقة بعد المقال
        register_sidebar(array(
            'name'          => __('بعد المقال', 'muhtawaa'),
            'id'            => 'after-post',
            'description'   => __('تظهر بعد محتوى المقال', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="after-post-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // منطقة للإعلانات
        register_sidebar(array(
            'name'          => __('منطقة الإعلانات', 'muhtawaa'),
            'id'            => 'ads-area',
            'description'   => __('لعرض الإعلانات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="ads-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        // منطقة للنشرة الإخبارية
        register_sidebar(array(
            'name'          => __('النشرة الإخبارية', 'muhtawaa'),
            'id'            => 'newsletter-area',
            'description'   => __('لنموذج الاشتراك في النشرة', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="newsletter-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="newsletter-title">',
            'after_title'   => '</h2>',
        ));
        
        // منطقة للإحصائيات
        register_sidebar(array(
            'name'          => __('الإحصائيات', 'muhtawaa'),
            'id'            => 'stats-area',
            'description'   => __('لعرض إحصائيات الموقع', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="stats-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="stats-title">',
            'after_title'   => '</h2>',
        ));
        
        // منطقة للشهادات والآراء
        register_sidebar(array(
            'name'          => __('الشهادات والآراء', 'muhtawaa'),
            'id'            => 'testimonials-area',
            'description'   => __('لعرض آراء المستخدمين', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="testimonials-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="testimonials-title">',
            'after_title'   => '</h2>',
        ));
    }
    
    /**
     * إضافة فئات CSS مخصصة للويدجت
     */
    public static function widget_custom_classes($params) {
        global $wp_registered_widgets;
        
        $widget_id = $params[0]['widget_id'];
        $widget_obj = $wp_registered_widgets[$widget_id];
        $widget_opt = get_option($widget_obj['callback'][0]->option_name);
        $widget_num = $widget_obj['params'][0]['number'];
        
        if (isset($widget_opt[$widget_num]['custom_class']) && !empty($widget_opt[$widget_num]['custom_class'])) {
            $params[0]['before_widget'] = str_replace(
                'class="widget ',
                'class="widget ' . $widget_opt[$widget_num]['custom_class'] . ' ',
                $params[0]['before_widget']
            );
        }
        
        return $params;
    }
    
    /**
     * إضافة حقل فئة CSS مخصصة لنموذج الويدجت
     */
    public static function widget_form_extend($widget, $return, $instance) {
        // التحقق من أن $instance مصفوفة
        if (!is_array($instance)) {
            $instance = array();
        }
        
        $custom_class = isset($instance['custom_class']) ? $instance['custom_class'] : '';
        ?>
        <p>
            <label for="<?php echo $widget->get_field_id('custom_class'); ?>">
                <?php _e('فئة CSS مخصصة:', 'muhtawaa'); ?>
            </label>
            <input type="text" 
                   class="widefat" 
                   id="<?php echo $widget->get_field_id('custom_class'); ?>" 
                   name="<?php echo $widget->get_field_name('custom_class'); ?>" 
                   value="<?php echo esc_attr($custom_class); ?>" />
            <small><?php _e('أضف فئات CSS مخصصة للويدجت (اختياري)', 'muhtawaa'); ?></small>
        </p>
        <?php
        
        return null;
    }
    
    /**
     * حفظ فئة CSS المخصصة
     */
    public static function widget_update_extend($instance, $new_instance, $old_instance, $widget) {
        if (isset($new_instance['custom_class'])) {
            $instance['custom_class'] = sanitize_text_field($new_instance['custom_class']);
        }
        return $instance;
    }
    
    /**
     * إضافة أيقونات للويدجت
     */
    public static function add_widget_icons() {
        ?>
        <style>
        .widget-top .widget-title-action {
            position: relative;
        }
        
        .widget[id*="recent-posts"] .widget-top:before,
        .widget[id*="archives"] .widget-top:before,
        .widget[id*="categories"] .widget-top:before,
        .widget[id*="tag_cloud"] .widget-top:before,
        .widget[id*="calendar"] .widget-top:before,
        .widget[id*="search"] .widget-top:before,
        .widget[id*="text"] .widget-top:before,
        .widget[id*="custom_html"] .widget-top:before,
        .widget[id*="nav_menu"] .widget-top:before,
        .widget[id*="rss"] .widget-top:before {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-left: 8px;
            background-size: 16px 16px;
            vertical-align: text-top;
        }
        
        .widget[id*="recent-posts"] .widget-top:before { content: "📝"; }
        .widget[id*="archives"] .widget-top:before { content: "📁"; }
        .widget[id*="categories"] .widget-top:before { content: "🏷️"; }
        .widget[id*="tag_cloud"] .widget-top:before { content: "☁️"; }
        .widget[id*="calendar"] .widget-top:before { content: "📅"; }
        .widget[id*="search"] .widget-top:before { content: "🔍"; }
        .widget[id*="text"] .widget-top:before { content: "📄"; }
        .widget[id*="custom_html"] .widget-top:before { content: "🔧"; }
        .widget[id*="nav_menu"] .widget-top:before { content: "🔗"; }
        .widget[id*="rss"] .widget-top:before { content: "📡"; }
        </style>
        <?php
    }
    
    /**
     * إضافة خيارات عرض للويدجت
     */
    public static function add_widget_display_options($widget, $return, $instance) {
        // التحقق من أن $instance مصفوفة
        if (!is_array($instance)) {
            $instance = array();
        }
        
        $hide_on_mobile = isset($instance['hide_on_mobile']) ? $instance['hide_on_mobile'] : false;
        $hide_on_desktop = isset($instance['hide_on_desktop']) ? $instance['hide_on_desktop'] : false;
        $show_only_logged_in = isset($instance['show_only_logged_in']) ? $instance['show_only_logged_in'] : false;
        ?>
        <p><strong><?php _e('خيارات العرض:', 'muhtawaa'); ?></strong></p>
        <p>
            <input type="checkbox" 
                   id="<?php echo $widget->get_field_id('hide_on_mobile'); ?>" 
                   name="<?php echo $widget->get_field_name('hide_on_mobile'); ?>" 
                   value="1" <?php checked($hide_on_mobile); ?> />
            <label for="<?php echo $widget->get_field_id('hide_on_mobile'); ?>">
                <?php _e('إخفاء على الجوال', 'muhtawaa'); ?>
            </label>
        </p>
        <p>
            <input type="checkbox" 
                   id="<?php echo $widget->get_field_id('hide_on_desktop'); ?>" 
                   name="<?php echo $widget->get_field_name('hide_on_desktop'); ?>" 
                   value="1" <?php checked($hide_on_desktop); ?> />
            <label for="<?php echo $widget->get_field_id('hide_on_desktop'); ?>">
                <?php _e('إخفاء على سطح المكتب', 'muhtawaa'); ?>
            </label>
        </p>
        <p>
            <input type="checkbox" 
                   id="<?php echo $widget->get_field_id('show_only_logged_in'); ?>" 
                   name="<?php echo $widget->get_field_name('show_only_logged_in'); ?>" 
                   value="1" <?php checked($show_only_logged_in); ?> />
            <label for="<?php echo $widget->get_field_id('show_only_logged_in'); ?>">
                <?php _e('إظهار للمستخدمين المسجلين فقط', 'muhtawaa'); ?>
            </label>
        </p>
        <?php
        
        return null;
    }
    
    /**
     * معالجة خيارات العرض
     */
    public static function widget_display_callback($params) {
        global $wp_registered_widgets;
        
        if (!isset($params[0]['widget_id'])) {
            return $params;
        }
        
        $widget_id = $params[0]['widget_id'];
        
        if (!isset($wp_registered_widgets[$widget_id])) {
            return $params;
        }
        
        $widget_obj = $wp_registered_widgets[$widget_id];
        
        // التحقق من وجود callback و option_name
        if (!isset($widget_obj['callback'][0]) || !is_object($widget_obj['callback'][0]) || !isset($widget_obj['callback'][0]->option_name)) {
            return $params;
        }
        
        $widget_opt = get_option($widget_obj['callback'][0]->option_name);
        
        if (!isset($widget_obj['params'][0]['number'])) {
            return $params;
        }
        
        $widget_num = $widget_obj['params'][0]['number'];
        
        if (isset($widget_opt[$widget_num]) && is_array($widget_opt[$widget_num])) {
            $instance = $widget_opt[$widget_num];
            
            // إخفاء على الجوال
            if (isset($instance['hide_on_mobile']) && $instance['hide_on_mobile'] && wp_is_mobile()) {
                return false;
            }
            
            // إخفاء على سطح المكتب
            if (isset($instance['hide_on_desktop']) && $instance['hide_on_desktop'] && !wp_is_mobile()) {
                return false;
            }
            
            // إظهار للمستخدمين المسجلين فقط
            if (isset($instance['show_only_logged_in']) && $instance['show_only_logged_in'] && !is_user_logged_in()) {
                return false;
            }
        }
        
        return $params;
    }
}

// تفعيل الخطافات
add_filter('dynamic_sidebar_params', array('MuhtawaaWidgets', 'widget_custom_classes'));
add_action('in_widget_form', array('MuhtawaaWidgets', 'widget_form_extend'), 10, 3);
add_filter('widget_update_callback', array('MuhtawaaWidgets', 'widget_update_extend'), 10, 4);
add_action('admin_head-widgets.php', array('MuhtawaaWidgets', 'add_widget_icons'));
add_action('in_widget_form', array('MuhtawaaWidgets', 'add_widget_display_options'), 10, 3);
add_filter('dynamic_sidebar_params', array('MuhtawaaWidgets', 'widget_display_callback'));
