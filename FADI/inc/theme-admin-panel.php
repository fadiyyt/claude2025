<?php
/**
 * لوحة إدارة القالب المخصصة
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إضافة صفحات الإدارة المخصصة
 */
function fadi_admin_menu_setup() {
    // الصفحة الرئيسية
    add_menu_page(
        __('نظام FADI', 'fadi'),
        __('نظام FADI', 'fadi'),
        'manage_options',
        'fadi-dashboard',
        'fadi_admin_dashboard_page',
        'dashicons-admin-multisite',
        3
    );
    
    // عروض الأسعار
    add_submenu_page(
        'fadi-dashboard',
        __('عروض الأسعار', 'fadi'),
        __('عروض الأسعار', 'fadi'),
        'manage_options',
        'fadi-quotes',
        'fadi_quotes_page'
    );
    
    // إدارة المشتريات
    add_submenu_page(
        'fadi-dashboard',
        __('إدارة المشتريات', 'fadi'),
        __('إدارة المشتريات', 'fadi'),
        'manage_options',
        'fadi-purchases',
        'fadi_purchases_page'
    );
    
    // شؤون الموظفين
    add_submenu_page(
        'fadi-dashboard',
        __('شؤون الموظفين', 'fadi'),
        __('شؤون الموظفين', 'fadi'),
        'manage_options',
        'fadi-employees',
        'fadi_employees_page'
    );
    
    // المناقصات
    add_submenu_page(
        'fadi-dashboard',
        __('المناقصات', 'fadi'),
        __('المناقصات', 'fadi'),
        'manage_options',
        'fadi-tenders',
        'fadi_tenders_page'
    );
    
    // الوثائق
    add_submenu_page(
        'fadi-dashboard',
        __('الوثائق الحكومية', 'fadi'),
        __('الوثائق الحكومية', 'fadi'),
        'manage_options',
        'fadi-documents',
        'fadi_documents_page'
    );
    
    // الإعدادات
    add_submenu_page(
        'fadi-dashboard',
        __('إعدادات النظام', 'fadi'),
        __('الإعدادات', 'fadi'),
        'manage_options',
        'fadi-settings',
        'fadi_settings_page'
    );
}
add_action('admin_menu', 'fadi_admin_menu_setup');

/**
 * لوحة التحكم الرئيسية
 */
function fadi_admin_dashboard_page() {
    ?>
    <div class="wrap fadi-admin-page">
        <h1><?php _e('لوحة تحكم نظام FADI', 'fadi'); ?></h1>
        
        <div class="fadi-dashboard-grid">
            <!-- بطاقات سريعة -->
            <div class="fadi-stats-grid">
                <div class="fadi-stat-card">
                    <div class="fadi-stat-icon">📋</div>
                    <div class="fadi-stat-content">
                        <h3><?php echo wp_count_posts('quote')->publish; ?></h3>
                        <p><?php _e('عروض الأسعار', 'fadi'); ?></p>
                        <a href="?page=fadi-quotes" class="button button-primary"><?php _e('إدارة', 'fadi'); ?></a>
                    </div>
                </div>
                
                <div class="fadi-stat-card">
                    <div class="fadi-stat-icon">🛒</div>
                    <div class="fadi-stat-content">
                        <h3><?php echo wp_count_posts('supplier')->publish; ?></h3>
                        <p><?php _e('الموردين', 'fadi'); ?></p>
                        <a href="?page=fadi-purchases" class="button button-primary"><?php _e('إدارة', 'fadi'); ?></a>
                    </div>
                </div>
                
                <div class="fadi-stat-card">
                    <div class="fadi-stat-icon">👥</div>
                    <div class="fadi-stat-content">
                        <h3><?php echo wp_count_posts('employee')->publish; ?></h3>
                        <p><?php _e('الموظفين', 'fadi'); ?></p>
                        <a href="?page=fadi-employees" class="button button-primary"><?php _e('إدارة', 'fadi'); ?></a>
                    </div>
                </div>
                
                <div class="fadi-stat-card">
                    <div class="fadi-stat-icon">🏢</div>
                    <div class="fadi-stat-content">
                        <h3><?php echo wp_count_posts('tender')->publish; ?></h3>
                        <p><?php _e('المناقصات', 'fadi'); ?></p>
                        <a href="?page=fadi-tenders" class="button button-primary"><?php _e('إدارة', 'fadi'); ?></a>
                    </div>
                </div>
            </div>
            
            <!-- الأنشطة الأخيرة -->
            <div class="fadi-recent-activity">
                <h2><?php _e('الأنشطة الأخيرة', 'fadi'); ?></h2>
                <div class="fadi-activity-list">
                    <?php
                    $recent_posts = get_posts(array(
                        'numberposts' => 5,
                        'post_type' => array('quote', 'supplier', 'employee', 'tender'),
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    
                    if ($recent_posts) {
                        foreach ($recent_posts as $post) {
                            $icon = array(
                                'quote' => '📋',
                                'supplier' => '🛒',
                                'employee' => '👥',
                                'tender' => '🏢'
                            );
                            echo '<div class="fadi-activity-item">';
                            echo '<span class="fadi-activity-icon">' . $icon[$post->post_type] . '</span>';
                            echo '<div class="fadi-activity-content">';
                            echo '<strong>' . get_the_title($post) . '</strong>';
                            echo '<span class="fadi-activity-date">' . get_the_date('Y-m-d H:i', $post) . '</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>' . __('لا توجد أنشطة حديثة', 'fadi') . '</p>';
                    }
                    ?>
                </div>
            </div>
            
            <!-- حالة النظام -->
            <div class="fadi-system-status">
                <h2><?php _e('حالة النظام', 'fadi'); ?></h2>
                <div class="fadi-status-grid">
                    <div class="fadi-status-item">
                        <span class="fadi-status-label"><?php _e('إصدار ووردبريس:', 'fadi'); ?></span>
                        <span class="fadi-status-value"><?php echo get_bloginfo('version'); ?></span>
                    </div>
                    <div class="fadi-status-item">
                        <span class="fadi-status-label"><?php _e('إصدار PHP:', 'fadi'); ?></span>
                        <span class="fadi-status-value"><?php echo PHP_VERSION; ?></span>
                    </div>
                    <div class="fadi-status-item">
                        <span class="fadi-status-label"><?php _e('إصدار القالب:', 'fadi'); ?></span>
                        <span class="fadi-status-value">1.0</span>
                    </div>
                    <div class="fadi-status-item">
                        <span class="fadi-status-label"><?php _e('حالة النظام:', 'fadi'); ?></span>
                        <span class="fadi-status-value fadi-status-active"><?php _e('نشط', 'fadi'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    .fadi-admin-page {
        margin: 20px 0;
    }
    
    .fadi-dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }
    
    .fadi-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .fadi-stat-card {
        background: #fff;
        border: 1px solid #c3c4c7;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }
    
    .fadi-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }
    
    .fadi-stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    
    .fadi-stat-content h3 {
        font-size: 2rem;
        margin: 10px 0 5px;
        color: #1d2327;
    }
    
    .fadi-stat-content p {
        color: #646970;
        margin-bottom: 15px;
    }
    
    .fadi-recent-activity,
    .fadi-system-status {
        background: #fff;
        border: 1px solid #c3c4c7;
        border-radius: 8px;
        padding: 20px;
    }
    
    .fadi-activity-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .fadi-activity-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f1;
    }
    
    .fadi-activity-item:last-child {
        border-bottom: none;
    }
    
    .fadi-activity-icon {
        font-size: 1.5rem;
        margin-left: 15px;
    }
    
    .fadi-activity-content {
        flex: 1;
    }
    
    .fadi-activity-date {
        display: block;
        font-size: 0.9rem;
        color: #646970;
    }
    
    .fadi-status-grid {
        display: grid;
        gap: 10px;
    }
    
    .fadi-status-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f1;
    }
    
    .fadi-status-item:last-child {
        border-bottom: none;
    }
    
    .fadi-status-label {
        font-weight: 600;
        color: #1d2327;
    }
    
    .fadi-status-value {
        color: #646970;
    }
    
    .fadi-status-active {
        color: #00a32a !important;
        font-weight: 600;
    }
    
    @media (max-width: 1024px) {
        .fadi-dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
    <?php
}

/**
 * صفحة عروض الأسعار
 */
function fadi_quotes_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إدارة عروض الأسعار', 'fadi'); ?></h1>
        
        <div class="fadi-page-actions">
            <a href="#" class="button button-primary" onclick="fadi_create_new_quote()"><?php _e('إنشاء عرض جديد', 'fadi'); ?></a>
            <a href="#" class="button"><?php _e('تصدير البيانات', 'fadi'); ?></a>
        </div>
        
        <div class="fadi-quotes-list">
            <h2><?php _e('عروض الأسعار الحالية', 'fadi'); ?></h2>
            <!-- سيتم إضافة قائمة العروض هنا -->
            <p><?php _e('سيتم تطوير هذا القسم في الإصدارات القادمة لعرض وإدارة عروض الأسعار.', 'fadi'); ?></p>
        </div>
    </div>
    
    <script>
    function fadi_create_new_quote() {
        alert('سيتم فتح نموذج إنشاء عرض سعر جديد');
        // هنا سيتم إضافة وظيفة إنشاء عرض سعر جديد
    }
    </script>
    <?php
}

/**
 * صفحة إدارة المشتريات
 */
function fadi_purchases_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إدارة المشتريات', 'fadi'); ?></h1>
        <p><?php _e('إدارة الموردين والمنتجات وأسعارها', 'fadi'); ?></p>
        <!-- محتوى الصفحة سيتم تطويره لاحقاً -->
    </div>
    <?php
}

/**
 * صفحة شؤون الموظفين
 */
function fadi_employees_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('شؤون الموظفين', 'fadi'); ?></h1>
        <p><?php _e('إدارة ملفات الموظفين والعهد والمهام', 'fadi'); ?></p>
        <!-- محتوى الصفحة سيتم تطويره لاحقاً -->
    </div>
    <?php
}

/**
 * صفحة المناقصات
 */
function fadi_tenders_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إدارة المناقصات', 'fadi'); ?></h1>
        <p><?php _e('تسجيل ومتابعة المناقصات مع نظام التنبيهات', 'fadi'); ?></p>
        <!-- محتوى الصفحة سيتم تطويره لاحقاً -->
    </div>
    <?php
}

/**
 * صفحة الوثائق
 */
function fadi_documents_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('الوثائق الحكومية', 'fadi'); ?></h1>
        <p><?php _e('تخزين وإدارة الوثائق الرسمية مع تنبيهات التجديد', 'fadi'); ?></p>
        <!-- محتوى الصفحة سيتم تطويره لاحقاً -->
    </div>
    <?php
}

/**
 * صفحة الإعدادات
 */
function fadi_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إعدادات نظام FADI', 'fadi'); ?></h1>
        
        <form method="post" action="options.php">
            <?php
            settings_fields('fadi_settings');
            do_settings_sections('fadi_settings');
            ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('اسم الشركة', 'fadi'); ?></th>
                    <td>
                        <input type="text" name="fadi_company_name" value="<?php echo esc_attr(get_option('fadi_company_name')); ?>" class="regular-text" />
                        <p class="description"><?php _e('اسم الشركة الذي سيظهر في عروض الأسعار', 'fadi'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('عنوان الشركة', 'fadi'); ?></th>
                    <td>
                        <textarea name="fadi_company_address" class="large-text" rows="3"><?php echo esc_textarea(get_option('fadi_company_address')); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('رقم الهاتف', 'fadi'); ?></th>
                    <td>
                        <input type="text" name="fadi_company_phone" value="<?php echo esc_attr(get_option('fadi_company_phone')); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('البريد الإلكتروني', 'fadi'); ?></th>
                    <td>
                        <input type="email" name="fadi_company_email" value="<?php echo esc_attr(get_option('fadi_company_email')); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('نسبة الضريبة المضافة (%)', 'fadi'); ?></th>
                    <td>
                        <input type="number" name="fadi_vat_rate" value="<?php echo esc_attr(get_option('fadi_vat_rate', '15')); ?>" min="0" max="100" step="0.01" class="small-text" />
                        <p class="description"><?php _e('النسبة الافتراضية للضريبة المضافة', 'fadi'); ?></p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * تسجيل الإعدادات
 */
function fadi_register_settings() {
    register_setting('fadi_settings', 'fadi_company_name');
    register_setting('fadi_settings', 'fadi_company_address');
    register_setting('fadi_settings', 'fadi_company_phone');
    register_setting('fadi_settings', 'fadi_company_email');
    register_setting('fadi_settings', 'fadi_vat_rate');
}
add_action('admin_init', 'fadi_register_settings');

/**
 * تحسين شريط الإدارة
 */
function fadi_customize_admin_interface() {
    // إضافة ستايل مخصص لشريط الإدارة
    echo '<style>
    #adminmenu #toplevel_page_fadi-dashboard .wp-menu-image:before {
        content: "\f319";
    }
    #adminmenu #toplevel_page_fadi-dashboard:hover .wp-menu-image:before,
    #adminmenu #toplevel_page_fadi-dashboard.wp-has-current-submenu .wp-menu-image:before {
        color: #00a0d2;
    }
    </style>';
}
add_action('admin_head', 'fadi_customize_admin_interface');