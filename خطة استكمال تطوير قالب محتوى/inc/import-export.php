<?php
/**
 * نظام الاستيراد والتصدير
 * 
 * @package Muhtawaa
 * @since 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة الاستيراد والتصدير
 */
class MuhtawaaImportExport {
    
    /**
     * أنواع المحتوى المدعومة
     */
    private static $supported_types = array(
        'posts' => 'المقالات',
        'pages' => 'الصفحات',
        'solutions' => 'الحلول',
        'categories' => 'التصنيفات',
        'tags' => 'الوسوم',
        'comments' => 'التعليقات',
        'users' => 'المستخدمين',
        'media' => 'الوسائط',
        'menus' => 'القوائم',
        'widgets' => 'الويدجت',
        'theme_options' => 'إعدادات القالب',
        'customizer' => 'إعدادات التخصيص',
    );
    
    /**
     * صيغ التصدير المدعومة
     */
    private static $export_formats = array(
        'json' => 'JSON',
        'xml' => 'XML',
        'csv' => 'CSV',
        'sql' => 'SQL',
    );
    
    /**
     * تهيئة النظام
     */
    public static function init() {
        // إضافة قائمة في لوحة التحكم
        add_action('admin_menu', array(__CLASS__, 'add_menu'));
        
        // معالجات AJAX
        add_action('wp_ajax_muhtawaa_export_content', array(__CLASS__, 'ajax_export_content'));
        add_action('wp_ajax_muhtawaa_import_content', array(__CLASS__, 'ajax_import_content'));
        add_action('wp_ajax_muhtawaa_get_export_progress', array(__CLASS__, 'ajax_get_export_progress'));
        add_action('wp_ajax_muhtawaa_get_import_progress', array(__CLASS__, 'ajax_get_import_progress'));
        
        // جدولة النسخ الاحتياطية التلقائية
        add_action('muhtawaa_auto_backup', array(__CLASS__, 'run_auto_backup'));
        if (!wp_next_scheduled('muhtawaa_auto_backup')) {
            wp_schedule_event(time(), 'weekly', 'muhtawaa_auto_backup');
        }
    }
    
    /**
     * إضافة قائمة في لوحة التحكم
     */
    public static function add_menu() {
        add_submenu_page(
            'tools.php',
            __('استيراد وتصدير محتوى', 'muhtawaa'),
            __('استيراد/تصدير', 'muhtawaa'),
            'manage_options',
            'muhtawaa-import-export',
            array(__CLASS__, 'render_page')
        );
    }
    
    /**
     * عرض صفحة الاستيراد والتصدير
     */
    public static function render_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('استيراد وتصدير المحتوى', 'muhtawaa'); ?></h1>
            
            <div class="muhtawaa-import-export-container">
                <!-- تبويبات -->
                <h2 class="nav-tab-wrapper">
                    <a href="#export" class="nav-tab nav-tab-active" data-tab="export">
                        <?php _e('تصدير', 'muhtawaa'); ?>
                    </a>
                    <a href="#import" class="nav-tab" data-tab="import">
                        <?php _e('استيراد', 'muhtawaa'); ?>
                    </a>
                    <a href="#backup" class="nav-tab" data-tab="backup">
                        <?php _e('النسخ الاحتياطي', 'muhtawaa'); ?>
                    </a>
                    <a href="#history" class="nav-tab" data-tab="history">
                        <?php _e('السجل', 'muhtawaa'); ?>
                    </a>
                </h2>
                
                <!-- محتوى التبويبات -->
                <div class="tab-content">
                    <!-- تبويب التصدير -->
                    <div id="export-tab" class="tab-pane active">
                        <?php self::render_export_tab(); ?>
                    </div>
                    
                    <!-- تبويب الاستيراد -->
                    <div id="import-tab" class="tab-pane" style="display:none;">
                        <?php self::render_import_tab(); ?>
                    </div>
                    
                    <!-- تبويب النسخ الاحتياطي -->
                    <div id="backup-tab" class="tab-pane" style="display:none;">
                        <?php self::render_backup_tab(); ?>
                    </div>
                    
                    <!-- تبويب السجل -->
                    <div id="history-tab" class="tab-pane" style="display:none;">
                        <?php self::render_history_tab(); ?>
                    </div>
                </div>
            </div>
            
            <style>
            .muhtawaa-import-export-container {
                background: #fff;
                border: 1px solid #ccd0d4;
                box-shadow: 0 1px 1px rgba(0,0,0,.04);
                margin-top: 20px;
            }
            
            .tab-content {
                padding: 20px;
            }
            
            .export-options,
            .import-options {
                margin: 20px 0;
            }
            
            .option-group {
                margin-bottom: 20px;
                padding: 15px;
                background: #f1f1f1;
                border-radius: 4px;
            }
            
            .option-group h3 {
                margin-top: 0;
            }
            
            .option-group label {
                display: block;
                margin-bottom: 10px;
            }
            
            .progress-container {
                display: none;
                margin: 20px 0;
            }
            
            .progress-bar {
                width: 100%;
                height: 30px;
                background: #f0f0f0;
                border-radius: 4px;
                overflow: hidden;
            }
            
            .progress-fill {
                height: 100%;
                background: #0073aa;
                width: 0;
                transition: width 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: bold;
            }
            
            .status-message {
                margin-top: 10px;
                padding: 10px;
                border-radius: 4px;
            }
            
            .status-message.success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            
            .status-message.error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            
            .status-message.info {
                background: #d1ecf1;
                color: #0c5460;
                border: 1px solid #bee5eb;
            }
            
            .backup-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
            
            .backup-item:last-child {
                border-bottom: none;
            }
            
            .backup-info {
                flex: 1;
            }
            
            .backup-actions {
                display: flex;
                gap: 10px;
            }
            
            .history-table {
                width: 100%;
                border-collapse: collapse;
            }
            
            .history-table th,
            .history-table td {
                padding: 10px;
                text-align: right;
                border-bottom: 1px solid #ddd;
            }
            
            .history-table th {
                background: #f5f5f5;
                font-weight: bold;
            }
            </style>
            
            <script>
            jQuery(document).ready(function($) {
                // تبديل التبويبات
                $('.nav-tab').click(function(e) {
                    e.preventDefault();
                    var tab = $(this).data('tab');
                    
                    $('.nav-tab').removeClass('nav-tab-active');
                    $(this).addClass('nav-tab-active');
                    
                    $('.tab-pane').hide();
                    $('#' + tab + '-tab').show();
                });
                
                // معالج التصدير
                $('#start-export').click(function() {
                    var selectedTypes = [];
                    $('input[name="export_types[]"]:checked').each(function() {
                        selectedTypes.push($(this).val());
                    });
                    
                    if (selectedTypes.length === 0) {
                        alert('<?php _e('يرجى اختيار نوع واحد على الأقل للتصدير', 'muhtawaa'); ?>');
                        return;
                    }
                    
                    var format = $('select[name="export_format"]').val();
                    startExport(selectedTypes, format);
                });
                
                // معالج الاستيراد
                $('#import-file').change(function() {
                    var file = this.files[0];
                    if (file) {
                        $('#import-info').show();
                        $('#file-name').text(file.name);
                        $('#file-size').text(formatFileSize(file.size));
                        $('#start-import').prop('disabled', false);
                    }
                });
                
                $('#start-import').click(function() {
                    var file = $('#import-file')[0].files[0];
                    if (!file) {
                        alert('<?php _e('يرجى اختيار ملف للاستيراد', 'muhtawaa'); ?>');
                        return;
                    }
                    
                    startImport(file);
                });
                
                // وظائف التصدير
                function startExport(types, format) {
                    $('#export-progress').show();
                    $('#export-status').removeClass('error success').addClass('info').text('<?php _e('جاري التصدير...', 'muhtawaa'); ?>');
                    
                    $.post(ajaxurl, {
                        action: 'muhtawaa_export_content',
                        types: types,
                        format: format,
                        nonce: '<?php echo wp_create_nonce('muhtawaa_import_export'); ?>'
                    }, function(response) {
                        if (response.success) {
                            $('#export-progress .progress-fill').css('width', '100%').text('100%');
                            $('#export-status').removeClass('info error').addClass('success').html(
                                '<?php _e('تم التصدير بنجاح!', 'muhtawaa'); ?> ' +
                                '<a href="' + response.data.download_url + '" class="button button-primary"><?php _e('تحميل الملف', 'muhtawaa'); ?></a>'
                            );
                        } else {
                            $('#export-status').removeClass('info success').addClass('error').text(response.data.message);
                        }
                    });
                    
                    // تحديث شريط التقدم
                    updateExportProgress();
                }
                
                function updateExportProgress() {
                    var interval = setInterval(function() {
                        $.get(ajaxurl, {
                            action: 'muhtawaa_get_export_progress',
                            nonce: '<?php echo wp_create_nonce('muhtawaa_import_export'); ?>'
                        }, function(response) {
                            if (response.success) {
                                var progress = response.data.progress;
                                $('#export-progress .progress-fill').css('width', progress + '%').text(progress + '%');
                                
                                if (progress >= 100) {
                                    clearInterval(interval);
                                }
                            }
                        });
                    }, 1000);
                }
                
                // وظائف الاستيراد
                function startImport(file) {
                    var formData = new FormData();
                    formData.append('action', 'muhtawaa_import_content');
                    formData.append('import_file', file);
                    formData.append('nonce', '<?php echo wp_create_nonce('muhtawaa_import_export'); ?>');
                    
                    $('#import-progress').show();
                    $('#import-status').removeClass('error success').addClass('info').text('<?php _e('جاري الاستيراد...', 'muhtawaa'); ?>');
                    
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                $('#import-progress .progress-fill').css('width', '100%').text('100%');
                                $('#import-status').removeClass('info error').addClass('success').text(response.data.message);
                            } else {
                                $('#import-status').removeClass('info success').addClass('error').text(response.data.message);
                            }
                        }
                    });
                    
                    // تحديث شريط التقدم
                    updateImportProgress();
                }
                
                function updateImportProgress() {
                    var interval = setInterval(function() {
                        $.get(ajaxurl, {
                            action: 'muhtawaa_get_import_progress',
                            nonce: '<?php echo wp_create_nonce('muhtawaa_import_export'); ?>'
                        }, function(response) {
                            if (response.success) {
                                var progress = response.data.progress;
                                $('#import-progress .progress-fill').css('width', progress + '%').text(progress + '%');
                                
                                if (progress >= 100) {
                                    clearInterval(interval);
                                }
                            }
                        });
                    }, 1000);
                }
                
                // وظائف مساعدة
                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    var k = 1024;
                    var sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    var i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }
            });
            </script>
        </div>
        <?php
    }
    
    /**
     * عرض تبويب التصدير
     */
    private static function render_export_tab() {
        ?>
        <div class="export-options">
            <div class="option-group">
                <h3><?php _e('اختر المحتوى للتصدير', 'muhtawaa'); ?></h3>
                <?php foreach (self::$supported_types as $type => $label) : ?>
                    <label>
                        <input type="checkbox" name="export_types[]" value="<?php echo esc_attr($type); ?>" checked>
                        <?php echo esc_html($label); ?>
                        <?php
                        $count = self::get_content_count($type);
                        if ($count > 0) {
                            echo '<span style="color:#666;"> (' . number_format($count) . ')</span>';
                        }
                        ?>
                    </label>
                <?php endforeach; ?>
            </div>
            
            <div class="option-group">
                <h3><?php _e('صيغة التصدير', 'muhtawaa'); ?></h3>
                <select name="export_format" class="regular-text">
                    <?php foreach (self::$export_formats as $format => $label) : ?>
                        <option value="<?php echo esc_attr($format); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="button" id="start-export" class="button button-primary button-large">
                <?php _e('بدء التصدير', 'muhtawaa'); ?>
            </button>
            
            <div id="export-progress" class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill">0%</div>
                </div>
                <div id="export-status" class="status-message"></div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض تبويب الاستيراد
     */
    private static function render_import_tab() {
        ?>
        <div class="import-options">
            <div class="option-group">
                <h3><?php _e('اختر ملف للاستيراد', 'muhtawaa'); ?></h3>
                <input type="file" id="import-file" accept=".json,.xml,.csv,.sql">
                <p class="description">
                    <?php _e('الصيغ المدعومة: JSON, XML, CSV, SQL', 'muhtawaa'); ?>
                </p>
                
                <div id="import-info" style="display:none;margin-top:20px;">
                    <p><strong><?php _e('معلومات الملف:', 'muhtawaa'); ?></strong></p>
                    <p><?php _e('الاسم:', 'muhtawaa'); ?> <span id="file-name"></span></p>
                    <p><?php _e('الحجم:', 'muhtawaa'); ?> <span id="file-size"></span></p>
                </div>
            </div>
            
            <div class="option-group">
                <h3><?php _e('خيارات الاستيراد', 'muhtawaa'); ?></h3>
                <label>
                    <input type="checkbox" name="import_media" value="1">
                    <?php _e('استيراد ملفات الوسائط', 'muhtawaa'); ?>
                </label>
                <label>
                    <input type="checkbox" name="overwrite_existing" value="1">
                    <?php _e('استبدال المحتوى الموجود', 'muhtawaa'); ?>
                </label>
                <label>
                    <input type="checkbox" name="import_users" value="1">
                    <?php _e('استيراد المستخدمين', 'muhtawaa'); ?>
                </label>
            </div>
            
            <button type="button" id="start-import" class="button button-primary button-large" disabled>
                <?php _e('بدء الاستيراد', 'muhtawaa'); ?>
            </button>
            
            <div id="import-progress" class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill">0%</div>
                </div>
                <div id="import-status" class="status-message"></div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض تبويب النسخ الاحتياطي
     */
    private static function render_backup_tab() {
        $backups = self::get_backups_list();
        ?>
        <div class="backup-options">
            <div class="option-group">
                <h3><?php _e('النسخ الاحتياطي التلقائي', 'muhtawaa'); ?></h3>
                <?php
                $auto_backup = get_option('muhtawaa_auto_backup', array(
                    'enabled' => false,
                    'frequency' => 'weekly',
                    'types' => array('posts', 'pages', 'theme_options'),
                ));
                ?>
                <label>
                    <input type="checkbox" id="enable-auto-backup" <?php checked($auto_backup['enabled']); ?>>
                    <?php _e('تفعيل النسخ الاحتياطي التلقائي', 'muhtawaa'); ?>
                </label>
                
                <div id="auto-backup-settings" style="<?php echo $auto_backup['enabled'] ? '' : 'display:none;'; ?>margin-top:15px;">
                    <label>
                        <?php _e('التكرار:', 'muhtawaa'); ?>
                        <select id="backup-frequency">
                            <option value="daily" <?php selected($auto_backup['frequency'], 'daily'); ?>><?php _e('يومياً', 'muhtawaa'); ?></option>
                            <option value="weekly" <?php selected($auto_backup['frequency'], 'weekly'); ?>><?php _e('أسبوعياً', 'muhtawaa'); ?></option>
                            <option value="monthly" <?php selected($auto_backup['frequency'], 'monthly'); ?>><?php _e('شهرياً', 'muhtawaa'); ?></option>
                        </select>
                    </label>
                </div>
            </div>
            
            <button type="button" id="create-backup" class="button button-primary">
                <?php _e('إنشاء نسخة احتياطية الآن', 'muhtawaa'); ?>
            </button>
            
            <div class="option-group" style="margin-top:30px;">
                <h3><?php _e('النسخ الاحتياطية المتوفرة', 'muhtawaa'); ?></h3>
                <?php if (empty($backups)) : ?>
                    <p><?php _e('لا توجد نسخ احتياطية متوفرة', 'muhtawaa'); ?></p>
                <?php else : ?>
                    <div class="backup-list">
                        <?php foreach ($backups as $backup) : ?>
                            <div class="backup-item">
                                <div class="backup-info">
                                    <strong><?php echo esc_html($backup['name']); ?></strong><br>
                                    <small>
                                        <?php echo esc_html($backup['date']); ?> | 
                                        <?php echo esc_html($backup['size']); ?>
                                    </small>
                                </div>
                                <div class="backup-actions">
                                    <a href="<?php echo esc_url($backup['download_url']); ?>" class="button button-small">
                                        <?php _e('تحميل', 'muhtawaa'); ?>
                                    </a>
                                    <button type="button" class="button button-small restore-backup" data-backup="<?php echo esc_attr($backup['file']); ?>">
                                        <?php _e('استعادة', 'muhtawaa'); ?>
                                    </button>
                                    <button type="button" class="button button-small delete-backup" data-backup="<?php echo esc_attr($backup['file']); ?>">
                                        <?php _e('حذف', 'muhtawaa'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض تبويب السجل
     */
    private static function render_history_tab() {
        $history = self::get_import_export_history();
        ?>
        <div class="history-content">
            <h3><?php _e('سجل الاستيراد والتصدير', 'muhtawaa'); ?></h3>
            
            <?php if (empty($history)) : ?>
                <p><?php _e('لا توجد عمليات سابقة', 'muhtawaa'); ?></p>
            <?php else : ?>
                <table class="history-table">
                    <thead>
                        <tr>
                            <th><?php _e('التاريخ', 'muhtawaa'); ?></th>
                            <th><?php _e('النوع', 'muhtawaa'); ?></th>
                            <th><?php _e('الحالة', 'muhtawaa'); ?></th>
                            <th><?php _e('التفاصيل', 'muhtawaa'); ?></th>
                            <th><?php _e('المستخدم', 'muhtawaa'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $entry) : ?>
                            <tr>
                                <td><?php echo esc_html($entry['date']); ?></td>
                                <td><?php echo esc_html($entry['type']); ?></td>
                                <td>
                                    <span class="status-<?php echo esc_attr($entry['status']); ?>">
                                        <?php echo esc_html($entry['status_text']); ?>
                                    </span>
                                </td>
                                <td><?php echo esc_html($entry['details']); ?></td>
                                <td><?php echo esc_html($entry['user']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <style>
            .status-success { color: #46b450; }
            .status-error { color: #dc3232; }
            .status-pending { color: #ffb900; }
            </style>
        </div>
        <?php
    }
    
    /**
     * الحصول على عدد المحتوى
     */
    private static function get_content_count($type) {
        global $wpdb;
        
        switch ($type) {
            case 'posts':
                $count = wp_count_posts('post');
                return isset($count->publish) ? $count->publish : 0;
                
            case 'pages':
                $count = wp_count_posts('page');
                return isset($count->publish) ? $count->publish : 0;
                
            case 'solutions':
                $count = wp_count_posts('solution');
                return isset($count->publish) ? $count->publish : 0;
                
            case 'categories':
                return wp_count_terms('category');
                
            case 'tags':
                return wp_count_terms('post_tag');
                
            case 'comments':
                $count = wp_count_comments();
                return isset($count->approved) ? $count->approved : 0;
                
            case 'users':
                $result = count_users();
                return isset($result['total_users']) ? $result['total_users'] : 0;
                
            case 'media':
                $count = wp_count_posts('attachment');
                return isset($count->inherit) ? $count->inherit : 0;
                
            case 'menus':
                return count(wp_get_nav_menus());
                
            default:
                return 0;
        }
    }
    
    /**
     * معالج AJAX للتصدير
     */
    public static function ajax_export_content() {
        check_ajax_referer('muhtawaa_import_export', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die(__('ليس لديك صلاحية لتنفيذ هذا الإجراء', 'muhtawaa'));
        }
        
        $types = isset($_POST['types']) ? (array) $_POST['types'] : array();
        $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : 'json';
        
        // بدء جلسة التصدير
        $export_id = uniqid('export_');
        set_transient('muhtawaa_export_' . $export_id, array('progress' => 0), HOUR_IN_SECONDS);
        
        try {
            $export_data = array();
            $total_items = 0;
            $processed_items = 0;
            
            // حساب إجمالي العناصر
            foreach ($types as $type) {
                $total_items += self::get_content_count($type);
            }
            
            // تصدير كل نوع
            foreach ($types as $type) {
                $export_data[$type] = self::export_content_type($type, $export_id, $processed_items, $total_items);
            }
            
            // إنشاء الملف
            $filename = 'muhtawaa-export-' . date('Y-m-d-His') . '.' . $format;
            $file_path = self::create_export_file($export_data, $format, $filename);
            
            // حفظ في السجل
            self::add_to_history('export', 'success', sprintf(__('تم تصدير %d عنصر', 'muhtawaa'), $total_items));
            
            // تحديث التقدم إلى 100%
            set_transient('muhtawaa_export_' . $export_id, array('progress' => 100), HOUR_IN_SECONDS);
            
            wp_send_json_success(array(
                'message' => __('تم التصدير بنجاح', 'muhtawaa'),
                'download_url' => self::get_download_url($filename),
            ));
            
        } catch (Exception $e) {
            self::add_to_history('export', 'error', $e->getMessage());
            wp_send_json_error(array('message' => $e->getMessage()));
        }
    }
    
    /**
     * تصدير نوع محتوى معين
     */
    private static function export_content_type($type, $export_id, &$processed_items, $total_items) {
        global $wpdb;
        $data = array();
        
        switch ($type) {
            case 'posts':
                $posts = get_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'post_status' => 'any',
                ));
                
                foreach ($posts as $post) {
                    $data[] = self::prepare_post_data($post);
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'pages':
                $pages = get_pages(array('post_status' => 'any'));
                foreach ($pages as $page) {
                    $data[] = self::prepare_post_data($page);
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'solutions':
                $solutions = get_posts(array(
                    'post_type' => 'solution',
                    'posts_per_page' => -1,
                    'post_status' => 'any',
                ));
                
                foreach ($solutions as $solution) {
                    $data[] = self::prepare_post_data($solution);
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'categories':
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $category) {
                    $data[] = array(
                        'term_id' => $category->term_id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'description' => $category->description,
                        'parent' => $category->parent,
                        'count' => $category->count,
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'tags':
                $tags = get_tags(array('hide_empty' => false));
                foreach ($tags as $tag) {
                    $data[] = array(
                        'term_id' => $tag->term_id,
                        'name' => $tag->name,
                        'slug' => $tag->slug,
                        'description' => $tag->description,
                        'count' => $tag->count,
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'comments':
                $comments = get_comments(array('status' => 'all'));
                foreach ($comments as $comment) {
                    $data[] = array(
                        'comment_ID' => $comment->comment_ID,
                        'comment_post_ID' => $comment->comment_post_ID,
                        'comment_author' => $comment->comment_author,
                        'comment_author_email' => $comment->comment_author_email,
                        'comment_author_url' => $comment->comment_author_url,
                        'comment_content' => $comment->comment_content,
                        'comment_date' => $comment->comment_date,
                        'comment_approved' => $comment->comment_approved,
                        'comment_parent' => $comment->comment_parent,
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'users':
                $users = get_users();
                foreach ($users as $user) {
                    $data[] = array(
                        'ID' => $user->ID,
                        'user_login' => $user->user_login,
                        'user_email' => $user->user_email,
                        'display_name' => $user->display_name,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'user_registered' => $user->user_registered,
                        'roles' => $user->roles,
                        'meta' => get_user_meta($user->ID),
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'media':
                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'post_status' => 'any',
                ));
                
                foreach ($attachments as $attachment) {
                    $data[] = array(
                        'ID' => $attachment->ID,
                        'title' => $attachment->post_title,
                        'caption' => $attachment->post_excerpt,
                        'description' => $attachment->post_content,
                        'mime_type' => $attachment->post_mime_type,
                        'url' => wp_get_attachment_url($attachment->ID),
                        'meta' => wp_get_attachment_metadata($attachment->ID),
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'menus':
                $menus = wp_get_nav_menus();
                foreach ($menus as $menu) {
                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                    $data[] = array(
                        'menu' => array(
                            'term_id' => $menu->term_id,
                            'name' => $menu->name,
                            'slug' => $menu->slug,
                        ),
                        'items' => $menu_items,
                    );
                    $processed_items++;
                    self::update_export_progress($export_id, $processed_items, $total_items);
                }
                break;
                
            case 'widgets':
                $data = array(
                    'sidebars' => wp_get_sidebars_widgets(),
                    'widgets' => array(),
                );
                
                foreach ($data['sidebars'] as $sidebar => $widgets) {
                    foreach ($widgets as $widget) {
                        $widget_base = _get_widget_id_base($widget);
                        if (!isset($data['widgets'][$widget_base])) {
                            $data['widgets'][$widget_base] = get_option('widget_' . $widget_base);
                        }
                    }
                }
                $processed_items++;
                self::update_export_progress($export_id, $processed_items, $total_items);
                break;
                
            case 'theme_options':
                $theme = get_option('stylesheet');
                $data = array(
                    'theme' => $theme,
                    'mods' => get_theme_mods(),
                    'options' => array(),
                );
                
                // جمع خيارات القالب المخصصة
                $option_keys = array(
                    'muhtawaa_settings',
                    'muhtawaa_performance',
                    'muhtawaa_security',
                    'muhtawaa_seo',
                );
                
                foreach ($option_keys as $key) {
                    $data['options'][$key] = get_option($key);
                }
                
                $processed_items++;
                self::update_export_progress($export_id, $processed_items, $total_items);
                break;
                
            case 'customizer':
                $data = get_theme_mods();
                $processed_items++;
                self::update_export_progress($export_id, $processed_items, $total_items);
                break;
        }
        
        return $data;
    }
    
    /**
     * تحضير بيانات المقال للتصدير
     */
    private static function prepare_post_data($post) {
        return array(
            'ID' => $post->ID,
            'post_title' => $post->post_title,
            'post_content' => $post->post_content,
            'post_excerpt' => $post->post_excerpt,
            'post_status' => $post->post_status,
            'post_type' => $post->post_type,
            'post_author' => $post->post_author,
            'post_date' => $post->post_date,
            'post_modified' => $post->post_modified,
            'post_parent' => $post->post_parent,
            'menu_order' => $post->menu_order,
            'post_mime_type' => $post->post_mime_type,
            'guid' => $post->guid,
            'post_name' => $post->post_name,
            'meta' => get_post_meta($post->ID),
            'terms' => wp_get_object_terms($post->ID, get_object_taxonomies($post->post_type)),
            'thumbnail_id' => get_post_thumbnail_id($post->ID),
        );
    }
    
    /**
     * تحديث تقدم التصدير
     */
    private static function update_export_progress($export_id, $processed, $total) {
        $progress = ($total > 0) ? round(($processed / $total) * 100) : 0;
        set_transient('muhtawaa_export_' . $export_id, array('progress' => $progress), HOUR_IN_SECONDS);
    }
    
    /**
     * إنشاء ملف التصدير
     */
    private static function create_export_file($data, $format, $filename) {
        $upload_dir = wp_upload_dir();
        $export_dir = $upload_dir['basedir'] . '/muhtawaa-exports/';
        
        // إنشاء المجلد إذا لم يكن موجوداً
        if (!file_exists($export_dir)) {
            wp_mkdir_p($export_dir);
        }
        
        $file_path = $export_dir . $filename;
        
        switch ($format) {
            case 'json':
                $json_data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                file_put_contents($file_path, $json_data);
                break;
                
            case 'xml':
                $xml = self::array_to_xml($data);
                file_put_contents($file_path, $xml->asXML());
                break;
                
            case 'csv':
                self::create_csv_files($data, $export_dir);
                // ضغط ملفات CSV في ملف واحد
                $zip = new ZipArchive();
                $zip_path = str_replace('.csv', '.zip', $file_path);
                $zip->open($zip_path, ZipArchive::CREATE);
                
                foreach (glob($export_dir . '*.csv') as $csv_file) {
                    $zip->addFile($csv_file, basename($csv_file));
                }
                $zip->close();
                
                // حذف ملفات CSV المؤقتة
                array_map('unlink', glob($export_dir . '*.csv'));
                $file_path = $zip_path;
                break;
                
            case 'sql':
                $sql = self::generate_sql($data);
                file_put_contents($file_path, $sql);
                break;
        }
        
        return $file_path;
    }
    
    /**
     * تحويل مصفوفة إلى XML
     */
    private static function array_to_xml($data, $xml = null) {
        if ($xml === null) {
            $xml = new SimpleXMLElement('<muhtawaa_export/>');
        }
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item_' . $key;
                }
                $subnode = $xml->addChild($key);
                self::array_to_xml($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
        
        return $xml;
    }
    
    /**
     * إنشاء ملفات CSV
     */
    private static function create_csv_files($data, $dir) {
        foreach ($data as $type => $items) {
            if (!is_array($items) || empty($items)) continue;
            
            $csv_file = $dir . $type . '.csv';
            $fp = fopen($csv_file, 'w');
            
            // كتابة العناوين
            if (is_array($items[0])) {
                fputcsv($fp, array_keys($items[0]));
            }
            
            // كتابة البيانات
            foreach ($items as $item) {
                if (is_array($item)) {
                    // تحويل المصفوفات المتداخلة إلى JSON
                    foreach ($item as $key => $value) {
                        if (is_array($value) || is_object($value)) {
                            $item[$key] = json_encode($value);
                        }
                    }
                    fputcsv($fp, $item);
                }
            }
            
            fclose($fp);
        }
    }
    
    /**
     * توليد SQL
     */
    private static function generate_sql($data) {
        global $wpdb;
        $sql = "-- Muhtawaa Export SQL\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($data as $type => $items) {
            if ($type == 'posts' || $type == 'pages' || $type == 'solutions') {
                foreach ($items as $item) {
                    $sql .= $wpdb->prepare(
                        "INSERT INTO {$wpdb->posts} (post_title, post_content, post_excerpt, post_status, post_type, post_author, post_date, post_name) VALUES (%s, %s, %s, %s, %s, %d, %s, %s);\n",
                        $item['post_title'],
                        $item['post_content'],
                        $item['post_excerpt'],
                        $item['post_status'],
                        $item['post_type'],
                        $item['post_author'],
                        $item['post_date'],
                        $item['post_name']
                    );
                }
            }
        }
        
        return $sql;
    }
    
    /**
     * الحصول على رابط التحميل
     */
    private static function get_download_url($filename) {
        $upload_dir = wp_upload_dir();
        return $upload_dir['baseurl'] . '/muhtawaa-exports/' . $filename;
    }
    
    /**
     * معالج AJAX للاستيراد
     */
    public static function ajax_import_content() {
        check_ajax_referer('muhtawaa_import_export', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die(__('ليس لديك صلاحية لتنفيذ هذا الإجراء', 'muhtawaa'));
        }
        
        if (!isset($_FILES['import_file'])) {
            wp_send_json_error(array('message' => __('لم يتم رفع أي ملف', 'muhtawaa')));
        }
        
        $file = $_FILES['import_file'];
        $import_id = uniqid('import_');
        
        try {
            // التحقق من نوع الملف
            $file_type = wp_check_filetype($file['name']);
            $allowed_types = array('json', 'xml', 'csv', 'sql');
            
            if (!in_array($file_type['ext'], $allowed_types)) {
                throw new Exception(__('نوع الملف غير مدعوم', 'muhtawaa'));
            }
            
            // قراءة محتوى الملف
            $content = file_get_contents($file['tmp_name']);
            $data = self::parse_import_file($content, $file_type['ext']);
            
            // بدء الاستيراد
            $imported = self::import_data($data, $import_id);
            
            // حفظ في السجل
            self::add_to_history('import', 'success', sprintf(__('تم استيراد %d عنصر', 'muhtawaa'), $imported));
            
            wp_send_json_success(array(
                'message' => sprintf(__('تم استيراد %d عنصر بنجاح', 'muhtawaa'), $imported),
            ));
            
        } catch (Exception $e) {
            self::add_to_history('import', 'error', $e->getMessage());
            wp_send_json_error(array('message' => $e->getMessage()));
        }
    }
    
    /**
     * تحليل ملف الاستيراد
     */
    private static function parse_import_file($content, $type) {
        $data = array();
        
        switch ($type) {
            case 'json':
                $data = json_decode($content, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception(__('خطأ في تحليل ملف JSON', 'muhtawaa'));
                }
                break;
                
            case 'xml':
                $xml = simplexml_load_string($content);
                if ($xml === false) {
                    throw new Exception(__('خطأ في تحليل ملف XML', 'muhtawaa'));
                }
                $data = json_decode(json_encode($xml), true);
                break;
                
            case 'csv':
                // CSV يحتاج معالجة خاصة
                throw new Exception(__('استيراد CSV غير مدعوم حالياً', 'muhtawaa'));
                break;
                
            case 'sql':
                // SQL يحتاج معالجة خاصة
                throw new Exception(__('استيراد SQL غير مدعوم حالياً', 'muhtawaa'));
                break;
        }
        
        return $data;
    }
    
    /**
     * استيراد البيانات
     */
    private static function import_data($data, $import_id) {
        $imported = 0;
        $total = 0;
        
        foreach ($data as $type => $items) {
            if (!is_array($items)) continue;
            
            $total += count($items);
        }
        
        foreach ($data as $type => $items) {
            if (!is_array($items)) continue;
            
            switch ($type) {
                case 'posts':
                case 'pages':
                case 'solutions':
                    foreach ($items as $item) {
                        $post_id = self::import_post($item);
                        if ($post_id) {
                            $imported++;
                            self::update_import_progress($import_id, $imported, $total);
                        }
                    }
                    break;
                    
                case 'categories':
                case 'tags':
                    foreach ($items as $item) {
                        $term_id = self::import_term($item, $type);
                        if ($term_id) {
                            $imported++;
                            self::update_import_progress($import_id, $imported, $total);
                        }
                    }
                    break;
                    
                case 'theme_options':
                    if (isset($items['mods'])) {
                        foreach ($items['mods'] as $key => $value) {
                            set_theme_mod($key, $value);
                        }
                    }
                    if (isset($items['options'])) {
                        foreach ($items['options'] as $key => $value) {
                            update_option($key, $value);
                        }
                    }
                    $imported++;
                    break;
            }
        }
        
        return $imported;
    }
    
    /**
     * استيراد مقال
     */
    private static function import_post($data) {
        $post_data = array(
            'post_title' => $data['post_title'],
            'post_content' => $data['post_content'],
            'post_excerpt' => $data['post_excerpt'],
            'post_status' => $data['post_status'],
            'post_type' => $data['post_type'],
            'post_author' => get_current_user_id(),
            'post_date' => $data['post_date'],
            'post_name' => $data['post_name'],
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id) && $post_id) {
            // استيراد البيانات الوصفية
            if (isset($data['meta']) && is_array($data['meta'])) {
                foreach ($data['meta'] as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
            }
            
            // استيراد التصنيفات
            if (isset($data['terms']) && is_array($data['terms'])) {
                foreach ($data['terms'] as $term) {
                    wp_set_object_terms($post_id, $term['name'], $term['taxonomy'], true);
                }
            }
        }
        
        return $post_id;
    }
    
    /**
     * استيراد تصنيف
     */
    private static function import_term($data, $taxonomy) {
        $term = wp_insert_term(
            $data['name'],
            $taxonomy == 'categories' ? 'category' : 'post_tag',
            array(
                'description' => $data['description'],
                'slug' => $data['slug'],
                'parent' => isset($data['parent']) ? $data['parent'] : 0,
            )
        );
        
        return !is_wp_error($term) ? $term['term_id'] : false;
    }
    
    /**
     * تحديث تقدم الاستيراد
     */
    private static function update_import_progress($import_id, $processed, $total) {
        $progress = ($total > 0) ? round(($processed / $total) * 100) : 0;
        set_transient('muhtawaa_import_' . $import_id, array('progress' => $progress), HOUR_IN_SECONDS);
    }
    
    /**
     * الحصول على تقدم التصدير
     */
    public static function ajax_get_export_progress() {
        check_ajax_referer('muhtawaa_import_export', 'nonce');
        
        $export_id = isset($_GET['export_id']) ? sanitize_text_field($_GET['export_id']) : '';
        $progress_data = get_transient('muhtawaa_export_' . $export_id);
        
        if ($progress_data) {
            wp_send_json_success(array('progress' => $progress_data['progress']));
        } else {
            wp_send_json_success(array('progress' => 0));
        }
    }
    
    /**
     * الحصول على تقدم الاستيراد
     */
    public static function ajax_get_import_progress() {
        check_ajax_referer('muhtawaa_import_export', 'nonce');
        
        $import_id = isset($_GET['import_id']) ? sanitize_text_field($_GET['import_id']) : '';
        $progress_data = get_transient('muhtawaa_import_' . $import_id);
        
        if ($progress_data) {
            wp_send_json_success(array('progress' => $progress_data['progress']));
        } else {
            wp_send_json_success(array('progress' => 0));
        }
    }
    
    /**
     * النسخ الاحتياطي التلقائي
     */
    public static function run_auto_backup() {
        $settings = get_option('muhtawaa_auto_backup', array());
        
        if (!empty($settings['enabled']) && !empty($settings['types'])) {
            try {
                // تصدير الأنواع المحددة
                $export_data = array();
                foreach ($settings['types'] as $type) {
                    $export_data[$type] = self::export_content_type($type, '', 0, 0);
                }
                
                // إنشاء ملف النسخة الاحتياطية
                $filename = 'auto-backup-' . date('Y-m-d-His') . '.json';
                self::create_export_file($export_data, 'json', $filename);
                
                // حفظ في السجل
                self::add_to_history('backup', 'success', __('نسخة احتياطية تلقائية', 'muhtawaa'));
                
                // حذف النسخ الاحتياطية القديمة
                self::cleanup_old_backups();
                
            } catch (Exception $e) {
                self::add_to_history('backup', 'error', $e->getMessage());
            }
        }
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private static function cleanup_old_backups() {
        $upload_dir = wp_upload_dir();
        $backup_dir = $upload_dir['basedir'] . '/muhtawaa-exports/';
        
        $max_backups = 10; // الحد الأقصى للنسخ الاحتياطية
        $backups = glob($backup_dir . 'auto-backup-*.json');
        
        if (count($backups) > $max_backups) {
            // ترتيب حسب التاريخ
            usort($backups, function($a, $b) {
                return filemtime($a) - filemtime($b);
            });
            
            // حذف الأقدم
            $to_delete = array_slice($backups, 0, count($backups) - $max_backups);
            foreach ($to_delete as $file) {
                unlink($file);
            }
        }
    }
    
    /**
     * الحصول على قائمة النسخ الاحتياطية
     */
    private static function get_backups_list() {
        $upload_dir = wp_upload_dir();
        $backup_dir = $upload_dir['basedir'] . '/muhtawaa-exports/';
        $backup_url = $upload_dir['baseurl'] . '/muhtawaa-exports/';
        
        $backups = array();
        $files = glob($backup_dir . '*.{json,xml,csv,sql,zip}', GLOB_BRACE);
        
        foreach ($files as $file) {
            $backups[] = array(
                'file' => basename($file),
                'name' => basename($file),
                'date' => date_i18n(get_option('date_format') . ' ' . get_option('time_format'), filemtime($file)),
                'size' => size_format(filesize($file)),
                'download_url' => $backup_url . basename($file),
            );
        }
        
        // ترتيب حسب التاريخ (الأحدث أولاً)
        usort($backups, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return $backups;
    }
    
    /**
     * إضافة إلى السجل
     */
    private static function add_to_history($type, $status, $details) {
        $history = get_option('muhtawaa_import_export_history', array());
        
        $history[] = array(
            'date' => current_time('mysql'),
            'type' => $type,
            'status' => $status,
            'details' => $details,
            'user_id' => get_current_user_id(),
        );
        
        // الاحتفاظ بآخر 100 سجل فقط
        if (count($history) > 100) {
            $history = array_slice($history, -100);
        }
        
        update_option('muhtawaa_import_export_history', $history);
    }
    
    /**
     * الحصول على سجل الاستيراد والتصدير
     */
    private static function get_import_export_history() {
        $history = get_option('muhtawaa_import_export_history', array());
        $formatted = array();
        
        foreach ($history as $entry) {
            $user = get_user_by('id', $entry['user_id']);
            $formatted[] = array(
                'date' => date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($entry['date'])),
                'type' => $entry['type'] == 'export' ? __('تصدير', 'muhtawaa') : ($entry['type'] == 'import' ? __('استيراد', 'muhtawaa') : __('نسخ احتياطي', 'muhtawaa')),
                'status' => $entry['status'],
                'status_text' => $entry['status'] == 'success' ? __('نجح', 'muhtawaa') : __('فشل', 'muhtawaa'),
                'details' => $entry['details'],
                'user' => $user ? $user->display_name : __('مستخدم محذوف', 'muhtawaa'),
            );
        }
        
        return array_reverse($formatted);
    }
}

// تهيئة النظام
MuhtawaaImportExport::init();