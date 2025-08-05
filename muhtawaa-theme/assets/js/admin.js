/**
 * JavaScript للوحة التحكم - قالب محتوى
 * Admin JavaScript for Muhtawaa Theme
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

(function($) {
    'use strict';

    // كائن إدارة القالب
    var MuhtawaaAdmin = {
        // الإعدادات
        settings: {
            confirmMessages: {
                delete: muhtawaa_admin.strings.confirm || 'هل أنت متأكد من الحذف؟',
                reset: 'هل تريد إعادة تعيين جميع الإعدادات؟',
                unsaved: muhtawaa_admin.strings.unsaved_changes || 'لديك تغييرات غير محفوظة. هل تريد المتابعة؟'
            }
        },

        // التهيئة
        init: function() {
            this.bindEvents();
            this.initTabs();
            this.initMediaUploader();
            this.initColorPicker();
            this.initCharts();
            this.initSortable();
            this.initAjaxForms();
            this.initNotifications();
            this.trackChanges();
        },

        // ربط الأحداث
        bindEvents: function() {
            var self = this;

            // تبديل الأقسام
            $(document).on('click', '.toggle-section', function(e) {
                e.preventDefault();
                self.toggleSection($(this));
            });

            // حفظ الإعدادات
            $(document).on('submit', '.muhtawaa-settings-form', function(e) {
                e.preventDefault();
                self.saveSettings($(this));
            });

            // إعادة تعيين الإعدادات
            $(document).on('click', '.reset-settings', function(e) {
                e.preventDefault();
                self.resetSettings();
            });

            // تصدير/استيراد
            $(document).on('click', '.export-settings', function(e) {
                e.preventDefault();
                self.exportSettings();
            });

            $(document).on('change', '.import-settings-file', function(e) {
                self.importSettings(e.target.files[0]);
            });
        },

        // التبويبات
        initTabs: function() {
            $('.muhtawaa-tabs').each(function() {
                var $tabs = $(this);
                var $navItems = $tabs.find('.tab-nav-item');
                var $panels = $tabs.find('.tab-panel');

                $navItems.on('click', function(e) {
                    e.preventDefault();
                    var target = $(this).data('tab');

                    $navItems.removeClass('active');
                    $(this).addClass('active');

                    $panels.removeClass('active');
                    $('#' + target).addClass('active');

                    // حفظ التبويب النشط
                    if (window.localStorage) {
                        localStorage.setItem('muhtawaa_active_tab_' + $tabs.attr('id'), target);
                    }
                });

                // استعادة التبويب النشط
                if (window.localStorage) {
                    var activeTab = localStorage.getItem('muhtawaa_active_tab_' + $tabs.attr('id'));
                    if (activeTab) {
                        $navItems.filter('[data-tab="' + activeTab + '"]').click();
                    }
                }
            });
        },

        // رافع الوسائط
        initMediaUploader: function() {
            $(document).on('click', '.upload-media-button', function(e) {
                e.preventDefault();

                var $button = $(this);
                var $input = $button.siblings('.media-url-input');
                var $preview = $button.siblings('.media-preview');

                var frame = wp.media({
                    title: 'اختر صورة',
                    button: {
                        text: 'استخدم هذه الصورة'
                    },
                    multiple: false
                });

                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $input.val(attachment.url).trigger('change');
                    
                    if ($preview.length) {
                        $preview.html('<img src="' + attachment.url + '" alt="">');
                    }
                });

                frame.open();
            });

            // إزالة الصورة
            $(document).on('click', '.remove-media-button', function(e) {
                e.preventDefault();
                var $button = $(this);
                $button.siblings('.media-url-input').val('').trigger('change');
                $button.siblings('.media-preview').empty();
            });
        },

        // منتقي الألوان
        initColorPicker: function() {
            if ($.fn.wpColorPicker) {
                $('.color-picker').each(function() {
                    $(this).wpColorPicker({
                        change: function(event, ui) {
                            $(this).trigger('change');
                        }
                    });
                });
            }
        },

        // الرسوم البيانية
        initCharts: function() {
            if (typeof Chart === 'undefined') return;

            // رسم بياني للمشاهدات
            var viewsCanvas = document.getElementById('views-chart');
            if (viewsCanvas) {
                this.createViewsChart(viewsCanvas);
            }

            // رسم بياني للتعليقات
            var commentsCanvas = document.getElementById('comments-chart');
            if (commentsCanvas) {
                this.createCommentsChart(commentsCanvas);
            }
        },

        // إنشاء رسم بياني للمشاهدات
        createViewsChart: function(canvas) {
            var ctx = canvas.getContext('2d');
            
            // بيانات تجريبية - يجب استبدالها ببيانات حقيقية
            var data = {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                datasets: [{
                    label: 'المشاهدات',
                    data: [1200, 1900, 3000, 5000, 4000, 3500],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4
                }]
            };

            new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },

        // إنشاء رسم بياني للتعليقات
        createCommentsChart: function(canvas) {
            var ctx = canvas.getContext('2d');
            
            var data = {
                labels: ['مقبولة', 'في الانتظار', 'مرفوضة'],
                datasets: [{
                    data: [120, 30, 10],
                    backgroundColor: ['#48bb78', '#ed8936', '#f56565']
                }]
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        },

        // الترتيب بالسحب والإفلات
        initSortable: function() {
            if ($.fn.sortable) {
                $('.sortable-list').sortable({
                    handle: '.drag-handle',
                    placeholder: 'sortable-placeholder',
                    update: function(event, ui) {
                        MuhtawaaAdmin.updateOrder($(this));
                    }
                });
            }
        },

        // تحديث الترتيب
        updateOrder: function($list) {
            var order = [];
            $list.find('.sortable-item').each(function(index) {
                order.push({
                    id: $(this).data('id'),
                    order: index + 1
                });
            });

            // إرسال الترتيب الجديد
            $.post(muhtawaa_admin.ajax_url, {
                action: 'muhtawaa_update_order',
                nonce: muhtawaa_admin.nonce,
                order: order
            });
        },

        // نماذج AJAX
        initAjaxForms: function() {
            // إضافة معالج عام لجميع النماذج مع class ajax-form
            $(document).on('submit', '.ajax-form', function(e) {
                e.preventDefault();
                MuhtawaaAdmin.submitAjaxForm($(this));
            });
        },

        // إرسال نموذج AJAX
        submitAjaxForm: function($form) {
            var self = this;
            var $submitButton = $form.find('[type="submit"]');
            var originalText = $submitButton.text();

            // تعطيل النموذج
            $form.addClass('loading');
            $submitButton.prop('disabled', true).text(muhtawaa_admin.strings.loading);

            // جمع البيانات
            var formData = new FormData($form[0]);
            formData.append('action', $form.data('action') || 'muhtawaa_save_settings');
            formData.append('nonce', muhtawaa_admin.nonce);

            // إرسال البيانات
            $.ajax({
                url: muhtawaa_admin.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        self.showNotification('success', response.data.message || muhtawaa_admin.strings.success);
                        
                        // إعادة تعيين حالة التغييرات
                        $form.data('changed', false);
                        
                        // تنفيذ callback إن وجد
                        if (response.data.callback) {
                            window[response.data.callback](response.data);
                        }
                    } else {
                        self.showNotification('error', response.data.message || muhtawaa_admin.strings.error);
                    }
                },
                error: function() {
                    self.showNotification('error', muhtawaa_admin.strings.error);
                },
                complete: function() {
                    $form.removeClass('loading');
                    $submitButton.prop('disabled', false).text(originalText);
                }
            });
        },

        // حفظ الإعدادات
        saveSettings: function($form) {
            this.submitAjaxForm($form);
        },

        // إعادة تعيين الإعدادات
        resetSettings: function() {
            if (!confirm(this.settings.confirmMessages.reset)) {
                return;
            }

            var self = this;
            
            $.post(muhtawaa_admin.ajax_url, {
                action: 'muhtawaa_reset_settings',
                nonce: muhtawaa_admin.nonce
            }, function(response) {
                if (response.success) {
                    self.showNotification('success', 'تمت إعادة تعيين الإعدادات بنجاح');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        },

        // تصدير الإعدادات
        exportSettings: function() {
            window.location.href = muhtawaa_admin.ajax_url + '?action=muhtawaa_export_settings&nonce=' + muhtawaa_admin.nonce;
        },

        // استيراد الإعدادات
        importSettings: function(file) {
            if (!file) return;

            var self = this;
            var reader = new FileReader();

            reader.onload = function(e) {
                try {
                    var settings = JSON.parse(e.target.result);
                    
                    $.post(muhtawaa_admin.ajax_url, {
                        action: 'muhtawaa_import_settings',
                        nonce: muhtawaa_admin.nonce,
                        settings: settings
                    }, function(response) {
                        if (response.success) {
                            self.showNotification('success', 'تم استيراد الإعدادات بنجاح');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            self.showNotification('error', response.data.message);
                        }
                    });
                } catch (error) {
                    self.showNotification('error', 'ملف الإعدادات غير صالح');
                }
            };

            reader.readAsText(file);
        },

        // نظام الإشعارات
        initNotifications: function() {
            // إنشاء حاوية الإشعارات إن لم تكن موجودة
            if (!$('.admin-notifications').length) {
                $('body').append('<div class="admin-notifications"></div>');
            }
        },

        // عرض إشعار
        showNotification: function(type, message) {
            var $notification = $('<div/>', {
                'class': 'admin-notification ' + type,
                'html': '<p>' + message + '</p><button class="close">&times;</button>'
            });

            $('.admin-notifications').append($notification);

            setTimeout(function() {
                $notification.addClass('show');
            }, 100);

            // إغلاق تلقائي
            setTimeout(function() {
                $notification.removeClass('show');
                setTimeout(function() {
                    $notification.remove();
                }, 300);
            }, 5000);

            // إغلاق يدوي
            $notification.find('.close').on('click', function() {
                $notification.removeClass('show');
                setTimeout(function() {
                    $notification.remove();
                }, 300);
            });
        },

        // تتبع التغييرات
        trackChanges: function() {
            $(document).on('change', '.muhtawaa-settings-form :input', function() {
                $(this).closest('form').data('changed', true);
            });

            // تحذير عند مغادرة الصفحة مع وجود تغييرات
            $(window).on('beforeunload', function() {
                if ($('.muhtawaa-settings-form').data('changed')) {
                    return muhtawaa_admin.strings.unsaved_changes;
                }
            });
        },

        // تبديل القسم
        toggleSection: function($toggle) {
            var $section = $toggle.closest('.toggle-section-wrapper');
            var $content = $section.find('.toggle-section-content');

            $toggle.toggleClass('active');
            $content.slideToggle(300);

            // حفظ حالة القسم
            if (window.localStorage) {
                var sectionId = $section.attr('id');
                if (sectionId) {
                    localStorage.setItem('muhtawaa_section_' + sectionId, $toggle.hasClass('active'));
                }
            }
        }
    };

    // تهيئة عند تحميل الصفحة
    $(document).ready(function() {
        MuhtawaaAdmin.init();
    });

    // تعريض الكائن للاستخدام العام
    window.MuhtawaaAdmin = MuhtawaaAdmin;

})(jQuery);