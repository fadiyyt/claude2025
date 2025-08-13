<?php
/**
 * Conflict Checker
 * فحص التضارب في الوظائف
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * فحص التضارب في الوظائف
 * 
 * @since 1.0.0
 */
function practical_solutions_check_function_conflicts() {
    $conflicts = array();
    
    // قائمة الوظائف المطلوب فحصها
    $functions_to_check = array(
        'practical_solutions_setup',
        'practical_solutions_enqueue_scripts',
        'practical_solutions_add_webp_support',
        'practical_solutions_extend_search',
        'practical_solutions_register_block_styles',
        'practical_solutions_excerpt_length',
        'practical_solutions_excerpt_more',
        'practical_solutions_body_classes',
        'practical_solutions_cleanup_head',
        'practical_solutions_add_head_meta',
    );
    
    foreach ($functions_to_check as $function_name) {
        if (function_exists($function_name)) {
            $reflection = new ReflectionFunction($function_name);
            $file = $reflection->getFileName();
            $line = $reflection->getStartLine();
            
            if (!isset($conflicts[$function_name])) {
                $conflicts[$function_name] = array();
            }
            
            $conflicts[$function_name][] = array(
                'file' => str_replace(ABSPATH, '', $file),
                'line' => $line
            );
        }
    }
    
    // عرض تقرير التضارب
    if (!empty($conflicts)) {
        $duplicate_functions = array_filter($conflicts, function($locations) {
            return count($locations) > 1;
        });
        
        if (!empty($duplicate_functions)) {
            add_action('admin_notices', function() use ($duplicate_functions) {
                echo '<div class="notice notice-error"><p><strong>تحذير: وجد تضارب في الوظائف!</strong></p><ul>';
                foreach ($duplicate_functions as $function_name => $locations) {
                    echo '<li><strong>' . $function_name . '</strong> موجودة في:</li>';
                    foreach ($locations as $location) {
                        echo '<li style="margin-right: 20px;">- ' . $location['file'] . ' (السطر ' . $location['line'] . ')</li>';
                    }
                }
                echo '</ul></div>';
            });
        }
    }
}

// تشغيل الفحص في وضع التطوير فقط
if (defined('WP_DEBUG') && WP_DEBUG) {
    add_action('admin_init', 'practical_solutions_check_function_conflicts');
}

/**
 * فحص الملفات المطلوبة
 * 
 * @since 1.0.0
 */
function practical_solutions_check_required_files() {
    $required_files = array(
        '/style.css' => 'ملف CSS الرئيسي',
        '/index.php' => 'ملف القالب الاحتياطي', 
        '/functions.php' => 'ملف الوظائف',
        '/theme.json' => 'ملف إعدادات FSE',
        '/templates/index.html' => 'قالب الصفحة الرئيسية',
        '/parts/header.html' => 'رأس الصفحة',
        '/parts/footer.html' => 'تذييل الصفحة',
    );
    
    $missing_files = array();
    
    foreach ($required_files as $file => $description) {
        $file_path = get_template_directory() . $file;
        if (!file_exists($file_path)) {
            $missing_files[$file] = $description;
        }
    }
    
    if (!empty($missing_files)) {
        add_action('admin_notices', function() use ($missing_files) {
            echo '<div class="notice notice-warning"><p><strong>تحذير: ملفات مطلوبة مفقودة!</strong></p><ul>';
            foreach ($missing_files as $file => $description) {
                echo '<li><strong>' . $file . '</strong> - ' . $description . '</li>';
            }
            echo '</ul></div>';
        });
    }
}

add_action('admin_init', 'practical_solutions_check_required_files');

/**
 * التحقق من متطلبات القالب
 * 
 * @since 1.0.0
 */
function practical_solutions_check_requirements() {
    $requirements = array();
    
    // فحص إصدار PHP
    if (version_compare(PHP_VERSION, '8.0', '<')) {
        $requirements[] = sprintf('القالب يتطلب PHP 8.0 أو أحدث. الإصدار الحالي: %s', PHP_VERSION);
    }
    
    // فحص إصدار WordPress
    if (version_compare(get_bloginfo('version'), '6.4', '<')) {
        $requirements[] = sprintf('القالب يتطلب WordPress 6.4 أو أحدث. الإصدار الحالي: %s', get_bloginfo('version'));
    }
    
    // فحص الوظائف المطلوبة
    $required_functions = array('curl_init', 'json_decode', 'mb_strlen');
    foreach ($required_functions as $function) {
        if (!function_exists($function)) {
            $requirements[] = sprintf('الوظيفة المطلوبة غير متوفرة: %s', $function);
        }
    }
    
    if (!empty($requirements)) {
        add_action('admin_notices', function() use ($requirements) {
            echo '<div class="notice notice-error"><p><strong>خطأ: متطلبات القالب غير مستوفاة!</strong></p><ul>';
            foreach ($requirements as $requirement) {
                echo '<li>' . $requirement . '</li>';
            }
            echo '</ul></div>';
        });
    }
}

add_action('admin_init', 'practical_solutions_check_requirements');

/**
 * تشخيص حالة القالب
 * 
 * @since 1.0.0
 */
function practical_solutions_theme_diagnostics() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // إضافة صفحة تشخيص في قائمة المظاهر
    add_action('admin_menu', function() {
        add_theme_page(
            __('تشخيص القالب', 'practical-solutions'),
            __('تشخيص القالب', 'practical-solutions'),
            'manage_options',
            'theme-diagnostics',
            'practical_solutions_diagnostics_page'
        );
    });
}

add_action('admin_init', 'practical_solutions_theme_diagnostics');

/**
 * صفحة تشخيص القالب
 * 
 * @since 1.0.0
 */
function practical_solutions_diagnostics_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('تشخيص قالب الحلول العملية', 'practical-solutions'); ?></h1>
        
        <div class="card">
            <h2><?php _e('معلومات القالب', 'practical-solutions'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><?php _e('اسم القالب', 'practical-solutions'); ?></th>
                    <td><?php echo wp_get_theme()->get('Name'); ?></td>
                </tr>
                <tr>
                    <th><?php _e('إصدار القالب', 'practical-solutions'); ?></th>
                    <td><?php echo PRACTICAL_SOLUTIONS_VERSION; ?></td>
                </tr>
                <tr>
                    <th><?php _e('مجلد القالب', 'practical-solutions'); ?></th>
                    <td><?php echo get_template_directory(); ?></td>
                </tr>
                <tr>
                    <th><?php _e('دعم FSE', 'practical-solutions'); ?></th>
                    <td><?php echo current_theme_supports('block-templates') ? '✅ مفعل' : '❌ غير مفعل'; ?></td>
                </tr>
            </table>
        </div>
        
        <div class="card">
            <h2><?php _e('معلومات النظام', 'practical-solutions'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><?php _e('إصدار WordPress', 'practical-solutions'); ?></th>
                    <td><?php echo get_bloginfo('version'); ?></td>
                </tr>
                <tr>
                    <th><?php _e('إصدار PHP', 'practical-solutions'); ?></th>
                    <td><?php echo PHP_VERSION; ?></td>
                </tr>
                <tr>
                    <th><?php _e('لغة الموقع', 'practical-solutions'); ?></th>
                    <td><?php echo get_locale(); ?></td>
                </tr>
                <tr>
                    <th><?php _e('اتجاه النص', 'practical-solutions'); ?></th>
                    <td><?php echo is_rtl() ? 'RTL (من اليمين لليسار)' : 'LTR (من اليسار لليمين)'; ?></td>
                </tr>
            </table>
        </div>
        
        <div class="card">
            <h2><?php _e('الملفات المطلوبة', 'practical-solutions'); ?></h2>
            <?php
            $required_files = array(
                '/style.css' => 'ملف CSS الرئيسي',
                '/functions.php' => 'ملف الوظائف',
                '/theme.json' => 'ملف إعدادات FSE',
                '/templates/index.html' => 'قالب الصفحة الرئيسية',
                '/parts/header.html' => 'رأس الصفحة',
                '/parts/footer.html' => 'تذييل الصفحة',
            );
            ?>
            <table class="wp-list-table widefat">
                <thead>
                    <tr>
                        <th><?php _e('الملف', 'practical-solutions'); ?></th>
                        <th><?php _e('الوصف', 'practical-solutions'); ?></th>
                        <th><?php _e('الحالة', 'practical-solutions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($required_files as $file => $description): ?>
                    <tr>
                        <td><code><?php echo $file; ?></code></td>
                        <td><?php echo $description; ?></td>
                        <td>
                            <?php if (file_exists(get_template_directory() . $file)): ?>
                                <span style="color: green;">✅ موجود</span>
                            <?php else: ?>
                                <span style="color: red;">❌ مفقود</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}