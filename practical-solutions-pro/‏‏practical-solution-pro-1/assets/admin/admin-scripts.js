/**
 * Admin Panel Scripts for Practical Solutions Pro
 * سكريبت لوحة إدارة الحلول العملية الاحترافية
 * المكان: /assets/admin/admin-scripts.js
 */

(function($) {
    'use strict';
    
    // متغيرات عامة
    const PSAdmin = {
        init: function() {
            this.bindEvents();
            this.initMediaUploader();
            this.initApiTesting();
            this.initFormValidation();
            this.initTooltips();
            this.initNotifications();
        },
        
        bindEvents: function() {
            // اختبار اتصال API
            $('#ps-test-api').on('click', this.testApiConnection);
            
            // مسح التخزين المؤقت
            $('#ps-clear-cache').on('click', this.clearCache);
            
            // تصدير الإعدادات
            $('#ps-export-settings').on('click', this.exportSettings);
            
            // استيراد الإعدادات
            $('#ps-import-settings').on('click', this.importSettings);
            $('#ps-import-file').on('change', this.handleImportFile);
            
            // إعادة تعيين إحصائيات الاستخدام
            $('#ps-reset-usage').on('click', this.resetUsageStats);
            
            // تحسين قاعدة البيانات
            $('#ps-optimize-db').on('click', this.optimizeDatabase);
            
            // تنظيف البيانات القديمة
            $('#ps-cleanup-old-data').on('click', this.cleanupOldData);
            
            // تفعيل/إلغاء تفعيل الذكاء الاصطناعي
            $('#ps-ai-enabled').on('change', this.toggleAIFeatures);
            
            // حفظ تلقائي للنماذج
            $('.ps-settings-form input, .ps-settings-form select, .ps-settings-form textarea').on('change', 
                this.debounce(this.autoSave, 2000)
            );
        },
        
        // رفع الشعار
        initMediaUploader: function() {
            let mediaUploader;
            
            $('.ps-upload-logo').on('click', function(e) {
                e.preventDefault();
                
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                mediaUploader = wp.media({
                    title: 'اختر شعار الموقع',
                    button: {
                        text: 'استخدام هذا الشعار'
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    }
                });
                
                mediaUploader.on('select', function() {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#ps_logo').val(attachment.url);
                    $('.ps-logo-preview').html(`<img src="${attachment.url}" alt="Logo">`);
                    $('.ps-no-logo').hide();
                });
                
                mediaUploader.open();
            });
            
            $('.ps-remove-logo').on('click', function(e) {
                e.preventDefault();
                $('#ps_logo').val('');
                $('.ps-logo-preview').html('<div class="ps-no-logo">لا يوجد شعار</div>');
            });
        },
        
        // اختبار API
        initApiTesting: function() {
            // إخفاء/إظهار حقول API حسب حالة التفعيل
            this.toggleAIFeatures();
        },
        
        testApiConnection: function() {
            const $button = $('#ps-test-api');
            const $status = $('#ps-api-status');
            const apiKey = $('input[name="ps_ai_settings[openrouter_api_key]"]').val();
            
            if (!apiKey) {
                PSAdmin.showNotification('يرجى إدخال مفتاح API أولاً', 'error');
                return;
            }
            
            $button.prop('disabled', true).text(psAdmin.strings.testing_connection);
            $status.removeClass('success error').addClass('testing').text('جاري اختبار الاتصال...').show();
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_test_api_connection',
                    nonce: psAdmin.nonce,
                    api_key: apiKey
                },
                success: function(response) {
                    if (response.success) {
                        $status.removeClass('testing error').addClass('success').text(response.data);
                        PSAdmin.showNotification(psAdmin.strings.connection_success, 'success');
                    } else {
                        $status.removeClass('testing success').addClass('error').text(response.data);
                        PSAdmin.showNotification(psAdmin.strings.connection_failed + ': ' + response.data, 'error');
                    }
                },
                error: function() {
                    $status.removeClass('testing success').addClass('error').text('فشل في الاتصال بالخادم');
                    PSAdmin.showNotification('حدث خطأ في الشبكة', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).text('اختبار الاتصال');
                }
            });
        },
        
        // مسح التخزين المؤقت
        clearCache: function() {
            const $button = $('#ps-clear-cache');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_clear_cache',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification(response.data, 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في مسح التخزين المؤقت', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تصدير الإعدادات
        exportSettings: function() {
            const $button = $('#ps-export-settings');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_export_settings',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.downloadFile(response.data.data, response.data.filename, 'application/json');
                        PSAdmin.showNotification('تم تصدير الإعدادات بنجاح', 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تصدير الإعدادات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // استيراد الإعدادات
        importSettings: function() {
            $('#ps-import-file').trigger('click');
        },
        
        handleImportFile: function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            if (file.type !== 'application/json') {
                PSAdmin.showNotification('يرجى اختيار ملف JSON صحيح', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const settings = JSON.parse(e.target.result);
                    PSAdmin.importSettingsData(btoa(JSON.stringify(settings)));
                } catch (error) {
                    PSAdmin.showNotification('ملف غير صحيح أو تالف', 'error');
                }
            };
            reader.readAsText(file);
        },
        
        importSettingsData: function(settingsData) {
            if (!confirm('هل أنت متأكد من استيراد هذه الإعدادات؟ سيتم استبدال الإعدادات الحالية.')) {
                return;
            }
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_import_settings',
                    nonce: psAdmin.nonce,
                    settings_data: settingsData
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification(response.data.message, 'success');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في استيراد الإعدادات', 'error');
                }
            });
        },
        
        // إعادة تعيين إحصائيات الاستخدام
        resetUsageStats: function() {
            if (!confirm('هل أنت متأكد من إعادة تعيين إحصائيات الاستخدام؟')) {
                return;
            }
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_reset_usage_stats',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم إعادة تعيين الإحصائيات بنجاح', 'success');
                        location.reload();
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في إعادة التعيين', 'error');
                }
            });
        },
        
        // تحسين قاعدة البيانات
        optimizeDatabase: function() {
            const $button = $('#ps-optimize-db');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_optimize_database',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم تحسين قاعدة البيانات بنجاح', 'success');
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تحسين قاعدة البيانات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تنظيف البيانات القديمة
        cleanupOldData: function() {
            if (!confirm('هل أنت متأكد من حذف البيانات القديمة؟ هذا الإجراء لا يمكن التراجع عنه.')) {
                return;
            }
            
            const $button = $('#ps-cleanup-old-data');
            
            $button.prop('disabled', true).addClass('ps-loading');
            
            $.ajax({
                url: psAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ps_cleanup_old_analytics',
                    nonce: psAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PSAdmin.showNotification('تم تنظيف البيانات القديمة بنجاح', 'success');
                        location.reload();
                    } else {
                        PSAdmin.showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    PSAdmin.showNotification('حدث خطأ في تنظيف البيانات', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('ps-loading');
                }
            });
        },
        
        // تفعيل/إلغاء ميزات الذكاء الاصطناعي
        toggleAIFeatures: function() {
            const isEnabled = $('#ps-ai-enabled').is(':checked');
            const $aiFields = $('.ps-ai-dependent');
            
            if (isEnabled) {
                $aiFields.show();
            } else {
                $aiFields.hide();
            }
        },
        
        // حفظ تلقائي
        autoSave: function() {
            const $form = $('.ps-settings-form');
            const formData = $form.serialize();
            
            // عرض مؤشر الحفظ
            PSAdmin.showSaveIndicator();
            
            $.ajax({
                url: $form.attr('action') || psAdmin.ajaxUrl,
                type: 'POST',
                data: formData + '&auto_save=1',
                success: function(response) {
                    PSAdmin.hideSaveIndicator(true);
                },
                error: function() {
                    PSAdmin.hideSaveIndicator(false);
                }
            });
        },
        
        // مؤشر الحفظ
        showSaveIndicator: function() {
            if ($('.ps-save-indicator').length === 0) {
                $('body').append('<div class="ps-save-indicator">جاري الحفظ...</div>');
            }
            $('.ps-save-indicator').show();
        },
        
        hideSaveIndicator: function(success = true) {
            const $indicator = $('.ps-save-indicator');
            $indicator.text(success ? 'تم الحفظ' : 'فشل الحفظ');
            setTimeout(() => $indicator.hide(), 2000);
        },
        
        // التحقق من صحة النماذج
        initFormValidation: function() {
            $('.ps-settings-form').on('submit', function(e) {
                const $form = $(this);
                let isValid = true;
                
                // التحقق من الحقول المطلوبة
                $form.find('[required]').each(function() {
                    const $field = $(this);
                    if (!$field.val().trim()) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                // التحقق من صيغة البريد الإلكتروني
                $form.find('input[type="email"]').each(function() {
                    const $field = $(this);
                    const email = $field.val().trim();
                    if (email && !PSAdmin.isValidEmail(email)) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                // التحقق من صيغة URL
                $form.find('input[type="url"]').each(function() {
                    const $field = $(this);
                    const url = $field.val().trim();
                    if (url && !PSAdmin.isValidUrl(url)) {
                        $field.addClass('error');
                        isValid = false;
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    PSAdmin.showNotification('يرجى تصحيح الأخطاء في النموذج', 'error');
                }
            });
        },
        
        // تهيئة التلميحات
        initTooltips: function() {
            $('[data-tooltip]').on('mouseenter', function() {
                const $this = $(this);
                const tooltipText = $this.data('tooltip');
                
                if (!tooltipText) return;
                
                const $tooltip = $('<div class="ps-tooltip"></div>').text(tooltipText);
                $('body').append($tooltip);
                
                const offset = $this.offset();
                $tooltip.css({
                    top: offset.top - $tooltip.outerHeight() - 5,
                    left: offset.left + ($this.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
                }).fadeIn(200);
                
                $this.data('tooltip-element', $tooltip);
            });
            
            $('[data-tooltip]').on('mouseleave', function() {
                const $tooltip = $(this).data('tooltip-element');
                if ($tooltip) {
                    $tooltip.fadeOut(200, function() {
                        $tooltip.remove();
                    });
                }
            });
        },
        
        // نظام الإشعارات
        initNotifications: function() {
            if ($('.ps-notifications').length === 0) {
                $('body').append('<div class="ps-notifications"></div>');
            }
        },
        
        showNotification: function(message, type = 'info', duration = 5000) {
            const $notification = $(`
                <div class="ps-notification ps-notification-${type}">
                    <span class="ps-notification-message">${message}</span>
                    <button type="button" class="ps-notification-close">&times;</button>
                </div>
            `);
            
            $('.ps-notifications').append($notification);
            
            // إظهار الإشعار
            setTimeout(() => $notification.addClass('show'), 100);
            
            // إخفاء تلقائي
            if (duration > 0) {
                setTimeout(() => PSAdmin.hideNotification($notification), duration);
            }
            
            // زر الإغلاق
            $notification.find('.ps-notification-close').on('click', function() {
                PSAdmin.hideNotification($notification);
            });
        },
        
        hideNotification: function($notification) {
            $notification.removeClass('show');
            setTimeout(() => $notification.remove(), 300);
        },
        
        // وظائف مساعدة
        downloadFile: function(data, filename, type) {
            const blob = new Blob([atob(data)], { type: type });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        },
        
        debounce: function(func, delay) {
            let timeoutId;
            return function (...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => func.apply(this, args), delay);
            };
        },
        
        isValidEmail: function(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        },
        
        isValidUrl: function(url) {
            try {
                new URL(url);
                return true;
            } catch {
                return false;
            }
        }
    };
    
    // تهيئة عند جاهزية الصفحة
    $(document).ready(function() {
        PSAdmin.init();
    });
    
    // تصدير للنطاق العام
    window.PSAdmin = PSAdmin;
    
})(jQuery);

// أنماط CSS إضافية للإشعارات
const additionalCSS = `
<style>
.ps-notifications {
    position: fixed;
    top: 32px;
    right: 20px;
    z-index: 999999;
    max-width: 400px;
}

.ps-notification {
    background: white;
    border-left: 4px solid #0073aa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-bottom: 10px;
    padding: 15px 20px;
    border-radius: 4px;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.ps-notification.show {
    opacity: 1;
    transform: translateX(0);
}

.ps-notification-success {
    border-left-color: #00a32a;
}

.ps-notification-warning {
    border-left-color: #f56e28;
}

.ps-notification-error {
    border-left-color: #d63638;
}

.ps-notification-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: 10px;
    color: #666;
}

.ps-notification-close:hover {
    color: #000;
}

.ps-save-indicator {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #0073aa;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    z-index: 999999;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.ps-tooltip {
    position: absolute;
    background: rgba(0,0,0,0.9);
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
    z-index: 999999;
    white-space: nowrap;
    max-width: 250px;
}

.form-table input.error,
.form-table select.error,
.form-table textarea.error {
    border-color: #d63638;
    box-shadow: 0 0 2px rgba(214, 54, 56, 0.8);
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', additionalCSS);