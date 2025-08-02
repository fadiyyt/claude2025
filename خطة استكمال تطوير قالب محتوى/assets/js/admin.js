/**
 * ملف لوحة الإدارة المتقدمة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة لوحة الإدارة المتقدمة
     */
    class MuhtawaaAdmin {
        constructor() {
            this.charts = {};
            this.notifications = [];
            this.autoSaveTimer = null;
            this.analyticsData = {};
            this.isLoading = false;
            
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة النظام
         */
        init() {
            if (!this.isAdminPage()) return;
            
            this.initDashboard();
            this.initThemeSettings();
            this.initPostEditor();
            this.initMediaLibrary();
            this.initUserInterface();
            this.initAnalytics();
            this.initSecurity();
            this.initPerformance();
            this.initBackup();
            this.initNotifications();
            this.initAutoSave();
            this.initShortcuts();
            this.initColorScheme();
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // أحداث لوحة التحكم
            $(document).on('click', '.muhtawaa-admin-tab', this.handleTabSwitch.bind(this));
            $(document).on('click', '.muhtawaa-toggle-section', this.handleSectionToggle.bind(this));
            
            // أحداث الإعدادات
            $(document).on('change', '.muhtawaa-setting-field', this.handleSettingChange.bind(this));
            $(document).on('click', '.muhtawaa-reset-settings', this.handleSettingsReset.bind(this));
            $(document).on('click', '.muhtawaa-save-settings', this.handleSettingsSave.bind(this));
            
            // أحداث المحرر
            $(document).on('input', '.muhtawaa-editor-field', this.handleEditorChange.bind(this));
            $(document).on('click', '.muhtawaa-insert-shortcode', this.handleShortcodeInsert.bind(this));
            
            // أحداث الإحصائيات
            $(document).on('click', '.muhtawaa-refresh-stats', this.handleStatsRefresh.bind(this));
            $(document).on('change', '.muhtawaa-stats-period', this.handleStatsPeriodChange.bind(this));
            
            // أحداث الأمان
            $(document).on('click', '.muhtawaa-security-scan', this.handleSecurityScan.bind(this));
            $(document).on('click', '.muhtawaa-clear-logs', this.handleClearLogs.bind(this));
            
            // أحداث النسخ الاحتياطي
            $(document).on('click', '.muhtawaa-create-backup', this.handleCreateBackup.bind(this));
            $(document).on('click', '.muhtawaa-restore-backup', this.handleRestoreBackup.bind(this));
            $(document).on('click', '.muhtawaa-delete-backup', this.handleDeleteBackup.bind(this));
            
            // أحداث عامة
            $(document).on('muhtawaa:admin-notification', this.handleNotification.bind(this));
            $(window).on('beforeunload', this.handleBeforeUnload.bind(this));
            
            // أحداث الإشعارات
            $(document).on('click', '.notifications-toggle', this.handleNotificationsToggle.bind(this));
            $(document).on('click', '.mark-all-read', this.markAllNotificationsRead.bind(this));
            $(document).on('click', '.mark-read', this.handleMarkNotificationRead.bind(this));
            $(document).on('click', '.dismiss-notification', this.handleDismissNotification.bind(this));
        }

        /**
         * تهيئة لوحة التحكم
         */
        initDashboard() {
            // إنشاء لوحة التحكم المخصصة
            const dashboardWidget = `
                <div id="muhtawaa-dashboard-widget" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>إحصائيات قالب محتوى</span>
                        </h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">تبديل لوحة: إحصائيات قالب محتوى</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="inside">
                        <div class="muhtawaa-dashboard-stats">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-edit-page"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-posts">-</span>
                                    <span class="stat-label">إجمالي المقالات</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-visibility"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-views">-</span>
                                    <span class="stat-label">المشاهدات الشهرية</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-admin-comments"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-comments">-</span>
                                    <span class="stat-label">التعليقات</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-performance"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="performance-score">-</span>
                                    <span class="stat-label">نقاط الأداء</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="muhtawaa-charts-container">
                            <div class="chart-wrapper">
                                <canvas id="views-chart" width="400" height="200"></canvas>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="posts-chart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        
                        <div class="muhtawaa-quick-actions">
                            <a href="admin.php?page=muhtawaa-settings" class="button button-primary muhtawaa-theme-settings">
                                <i class="dashicons dashicons-admin-generic"></i>
                                إعدادات القالب
                            </a>
                            <button class="button muhtawaa-performance-check" data-action="performance-check">
                                <i class="dashicons dashicons-performance"></i>
                                فحص الأداء
                            </button>
                            <button class="button muhtawaa-security-check" data-action="security-scan">
                                <i class="dashicons dashicons-shield"></i>
                                فحص الأمان
                            </button>
                            <button class="button muhtawaa-backup-now" data-action="backup-now">
                                <i class="dashicons dashicons-backup"></i>
                                نسخة احتياطية
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // إضافة الويدجت للوحة التحكم
            if ($('#dashboard-widgets-wrap').length) {
                $('#normal-sortables').prepend(dashboardWidget);
                this.loadDashboardStats();
            }
        }

        /**
         * تحميل إحصائيات لوحة التحكم
         */
        async loadDashboardStats() {
            if (this.isLoading) return;
            this.isLoading = true;
            
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_dashboard_stats',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    const stats = response.data;
                    
                    // تحديث الإحصائيات بحركة متدرجة
                    this.animateNumber('#total-posts', 0, stats.total_posts || 0, 1000);
                    this.animateNumber('#total-views', 0, stats.total_views || 0, 1500);
                    this.animateNumber('#total-comments', 0, stats.total_comments || 0, 1200);
                    this.animateNumber('#performance-score', 0, stats.performance_score || 0, 2000, '%');
                    
                    // تحديث الرسوم البيانية
                    setTimeout(() => {
                        this.updateDashboardCharts(stats);
                    }, 500);
                }
            } catch (error) {
                console.error('خطأ في تحميل إحصائيات لوحة التحكم:', error);
                this.showNotification('فشل في تحميل الإحصائيات', 'error');
            } finally {
                this.isLoading = false;
            }
        }

        /**
         * تحريك الأرقام تدريجياً
         */
        animateNumber(selector, start, end, duration, suffix = '') {
            const element = $(selector);
            const startTime = performance.now();
            
            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // تطبيق دالة تسارع
                const easedProgress = this.easeOutQuart(progress);
                const current = Math.floor(start + (end - start) * easedProgress);
                
                element.text(this.formatNumber(current) + suffix);
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };
            
            requestAnimationFrame(animate);
        }

        /**
         * دالة تسارع
         */
        easeOutQuart(t) {
            return 1 - (--t) * t * t * t;
        }

        /**
         * تحديث الرسوم البيانية
         */
        updateDashboardCharts(stats) {
            // رسم بياني للمشاهدات
            if (stats.views_chart_data && typeof Chart !== 'undefined') {
                this.createChart('views-chart', 'line', stats.views_chart_data, {
                    title: 'المشاهدات اليومية',
                    color: '#007cba',
                    borderColor: '#007cba',
                    backgroundColor: 'rgba(0, 124, 186, 0.1)'
                });
            }
            
            // رسم بياني للمقالات
            if (stats.posts_chart_data && typeof Chart !== 'undefined') {
                this.createChart('posts-chart', 'bar', stats.posts_chart_data, {
                    title: 'المقالات الشهرية',
                    color: '#00a32a',
                    borderColor: '#00a32a',
                    backgroundColor: 'rgba(0, 163, 42, 0.8)'
                });
            }
        }

        /**
         * إنشاء رسم بياني
         */
        createChart(elementId, type, data, options = {}) {
            const canvas = document.getElementById(elementId);
            if (!canvas || typeof Chart === 'undefined') return;
            
            const ctx = canvas.getContext('2d');
            
            // مسح الرسم السابق
            if (this.charts[elementId]) {
                this.charts[elementId].destroy();
            }
            
            // إعداد البيانات
            const chartData = {
                labels: data.labels || [],
                datasets: [{
                    label: options.title || '',
                    data: data.values || [],
                    borderColor: options.borderColor || options.color || '#007cba',
                    backgroundColor: options.backgroundColor || 'rgba(0, 124, 186, 0.1)',
                    borderWidth: 2,
                    fill: type === 'line',
                    tension: 0.4
                }]
            };
            
            // إنشاء رسم جديد
            this.charts[elementId] = new Chart(ctx, {
                type: type,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: options.title || '',
                            font: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif',
                                size: 14,
                                weight: 'bold'
                            },
                            color: '#1d2327'
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                            },
                            bodyFont: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                            },
                            rtl: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                font: {
                                    family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                                },
                                color: '#646970'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                font: {
                                    family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                                },
                                color: '#646970'
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }

        /**
         * تهيئة إعدادات القالب
         */
        initThemeSettings() {
            // إنشاء صفحة إعدادات القالب
            if ($('.muhtawaa-theme-settings-page').length) {
                this.setupColorPicker();
                this.setupFontSelector();
                this.setupLayoutOptions();
                this.setupCustomCSS();
                this.setupImportExport();
                this.setupLivePreview();
            }
        }

        /**
         * إعداد منتقي الألوان
         */
        setupColorPicker() {
            $('.muhtawaa-color-picker').each(function() {
                const picker = $(this);
                
                if (typeof picker.wpColorPicker === 'function') {
                    picker.wpColorPicker({
                        change: function(event, ui) {
                            const color = ui.color.toString();
                            const setting = picker.data('setting');
                            
                            // تحديث المعاينة المباشرة
                            if (setting) {
                                $('body').trigger('muhtawaa:color-changed', [setting, color]);
                            }
                        },
                        clear: function() {
                            const setting = picker.data('setting');
                            $('body').trigger('muhtawaa:color-cleared', [setting]);
                        }
                    });
                }
            });
        }

        /**
         * إعداد منتقي الخطوط
         */
        setupFontSelector() {
            $('.muhtawaa-font-selector').each(function() {
                const selector = $(this);
                
                if (typeof selector.select2 === 'function') {
                    selector.select2({
                        placeholder: 'اختر خط...',
                        dir: 'rtl',
                        width: '100%',
                        templateResult: function(font) {
                            if (!font.id) return font.text;
                            
                            return $(`<span style="font-family: ${font.id}">${font.text}</span>`);
                        },
                        templateSelection: function(font) {
                            if (!font.id) return font.text;
                            
                            return $(`<span style="font-family: ${font.id}">${font.text}</span>`);
                        }
                    });
                }
                
                selector.on('change', function() {
                    const font = $(this).val();
                    const setting = $(this).data('setting');
                    
                    if (setting && font) {
                        $('body').trigger('muhtawaa:font-changed', [setting, font]);
                    }
                });
            });
        }

        /**
         * إعداد خيارات التخطيط
         */
        setupLayoutOptions() {
            $('.muhtawaa-layout-option').on('click', function() {
                const option = $(this);
                const layout = option.data('layout');
                const group = option.data('group');
                
                // إزالة التحديد من الخيارات الأخرى في نفس المجموعة
                $(`.muhtawaa-layout-option[data-group="${group}"]`).removeClass('selected');
                
                // تحديد الخيار الحالي
                option.addClass('selected');
                
                // تحديث المعاينة
                $('body').trigger('muhtawaa:layout-changed', [group, layout]);
            });
        }

        /**
         * إعداد CSS المخصص
         */
        setupCustomCSS() {
            const cssEditor = $('.muhtawaa-custom-css-editor');
            
            if (cssEditor.length && typeof CodeMirror !== 'undefined') {
                const editor = CodeMirror.fromTextArea(cssEditor[0], {
                    mode: 'css',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 2,
                    tabSize: 2,
                    direction: 'ltr',
                    rtlMoveVisually: true
                });
                
                // حفظ تلقائي
                let saveTimeout;
                editor.on('change', function() {
                    clearTimeout(saveTimeout);
                    saveTimeout = setTimeout(() => {
                        $('body').trigger('muhtawaa:css-changed', [editor.getValue()]);
                    }, 1000);
                });
                
                // إضافة اختصارات لوحة المفاتيح
                editor.setOption('extraKeys', {
                    'Ctrl-S': function() {
                        $('body').trigger('muhtawaa:save-css', [editor.getValue()]);
                    },
                    'Ctrl-Z': function() {
                        editor.undo();
                    },
                    'Ctrl-Y': function() {
                        editor.redo();
                    },
                    'F11': function() {
                        // تبديل وضع ملء الشاشة
                        const wrapper = editor.getWrapperElement();
                        if (wrapper.classList.contains('CodeMirror-fullscreen')) {
                            wrapper.classList.remove('CodeMirror-fullscreen');
                        } else {
                            wrapper.classList.add('CodeMirror-fullscreen');
                        }
                        editor.refresh();
                    }
                });
                
                // حفظ مرجع المحرر
                this.cssEditor = editor;
            }
        }

        /**
         * إعداد الاستيراد والتصدير
         */
        setupImportExport() {
            // تصدير الإعدادات
            $('.muhtawaa-export-settings').on('click', async function(e) {
                e.preventDefault();
                
                const button = $(this);
                button.addClass('loading').text('جاري التصدير...');
                
                try {
                    const response = await $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'muhtawaa_export_settings',
                            nonce: muhtawaaData.nonce
                        }
                    });
                    
                    if (response.success) {
                        // تحميل ملف JSON
                        const dataStr = JSON.stringify(response.data, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = `muhtawaa-settings-${new Date().toISOString().split('T')[0]}.json`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        
                        URL.revokeObjectURL(url);
                        
                        window.MuhtawaaAdmin.showNotification('تم تصدير الإعدادات بنجاح', 'success');
                    }
                } catch (error) {
                    console.error('خطأ في تصدير الإعدادات:', error);
                    window.MuhtawaaAdmin.showNotification('حدث خطأ في تصدير الإعدادات', 'error');
                } finally {
                    button.removeClass('loading').text('تصدير الإعدادات');
                }
            });
            
            // استيراد الإعدادات
            $('.muhtawaa-import-settings').on('change', function() {
                const file = this.files[0];
                if (!file) return;
                
                const reader = new FileReader();
                reader.onload = async function(e) {
                    try {
                        const settings = JSON.parse(e.target.result);
                        
                        const response = await $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'muhtawaa_import_settings',
                                settings: JSON.stringify(settings),
                                nonce: muhtawaaData.nonce
                            }
                        });
                        
                        if (response.success) {
                            window.MuhtawaaAdmin.showNotification('تم استيراد الإعدادات بنجاح', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            window.MuhtawaaAdmin.showNotification('فشل في استيراد الإعدادات', 'error');
                        }
                    } catch (error) {
                        console.error('خطأ في استيراد الإعدادات:', error);
                        window.MuhtawaaAdmin.showNotification('ملف الإعدادات غير صحيح', 'error');
                    }
                };
                reader.readAsText(file);
            });
        }

        /**
         * إعداد المعاينة المباشرة
         */
        setupLivePreview() {
            // تحديث المعاينة عند تغيير الألوان
            $('body').on('muhtawaa:color-changed', (e, setting, color) => {
                this.updateLivePreview(setting, color);
            });
            
            // تحديث المعاينة عند تغيير الخطوط
            $('body').on('muhtawaa:font-changed', (e, setting, font) => {
                this.updateLivePreview(setting, font);
            });
        }

        /**
         * تحديث المعاينة المباشرة
         */
        updateLivePreview(setting, value) {
            const preview = $('#live-preview-frame');
            if (preview.length) {
                const previewDoc = preview.contents();
                
                switch(setting) {
                    case 'primary_color':
                        previewDoc.find('body').css('--primary-color', value);
                        break;
                    case 'secondary_color':
                        previewDoc.find('body').css('--secondary-color', value);
                        break;
                    case 'body_font':
                        previewDoc.find('body').css('font-family', value);
                        break;
                    case 'heading_font':
                        previewDoc.find('h1, h2, h3, h4, h5, h6').css('font-family', value);
                        break;
                }
            }
        }

        /**
         * تهيئة محرر المقالات
         */
        initPostEditor() {
            if (!$('#post').length) return;
            
            this.setupMetaBoxes();
            this.setupShortcodeButtons();
            this.setupImageOptimization();
            this.setupSEOHelper();
            this.setupReadabilityChecker();
            this.setupAutoSave();
        }

        /**
         * إعداد صناديق البيانات الوصفية
         */
        setupMetaBoxes() {
            // صندوق إعدادات المقال
            const postSettingsBox = `
                <div id="muhtawaa-post-settings" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>إعدادات المقال المتقدمة</span>
                        </h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">تبديل لوحة: إعدادات المقال المتقدمة</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="inside">
                        <table class="form-table">
                            <tr>
                                <th><label for="muhtawaa_featured_video">فيديو مميز</label></th>
                                <td>
                                    <input type="url" id="muhtawaa_featured_video" name="muhtawaa_featured_video" class="widefat" placeholder="رابط الفيديو (YouTube, Vimeo)">
                                    <p class="description">سيتم عرض الفيديو في أعلى المقال</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_reading_time">وقت القراءة</label></th>
                                <td>
                                    <input type="number" id="muhtawaa_reading_time" name="muhtawaa_reading_time" min="1" max="999" placeholder="بالدقائق">
                                    <p class="description">سيتم حسابه تلقائياً إذا ترك فارغاً</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_difficulty_level">مستوى الصعوبة</label></th>
                                <td>
                                    <select id="muhtawaa_difficulty_level" name="muhtawaa_difficulty_level">
                                        <option value="">اختر المستوى</option>
                                        <option value="beginner">مبتدئ</option>
                                        <option value="intermediate">متوسط</option>
                                        <option value="advanced">متقدم</option>
                                        <option value="expert">خبير</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_custom_css">CSS مخصص للمقال</label></th>
                                <td>
                                    <textarea id="muhtawaa_custom_css" name="muhtawaa_custom_css" rows="5" class="widefat" placeholder="/* CSS مخصص لهذا المقال فقط */"></textarea>
                                    <p class="description">سيتم تطبيق هذا CSS على هذا المقال فقط</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_hide_sidebar">إخفاء الشريط الجانبي</label></th>
                                <td>
                                    <label>
                                        <input type="checkbox" id="muhtawaa_hide_sidebar" name="muhtawaa_hide_sidebar" value="1">
                                        إخفاء الشريط الجانبي في هذا المقال
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            `;
            
            if ($('#normal-sortables').length) {
                $('#normal-sortables').append(postSettingsBox);
            }
        }

        /**
         * إعداد أزرار الاختصارات
         */
        setupShortcodeButtons() {
            const shortcodePanel = `
                <div id="muhtawaa-shortcodes-panel" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>اختصارات قالب محتوى</span>
                        </h2>
                    </div>
                    <div class="inside">
                        <div class="muhtawaa-shortcode-buttons">
                            <div class="shortcode-group">
                                <h4>المحتوى</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="alert">
                                    <i class="dashicons dashicons-warning"></i> تنبيه
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="highlight">
                                    <i class="dashicons dashicons-edit"></i> تمييز
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="quote">
                                    <i class="dashicons dashicons-format-quote"></i> اقتباس
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>التفاعل</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="button">
                                    <i class="dashicons dashicons-button"></i> زر
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="download">
                                    <i class="dashicons dashicons-download"></i> تحميل
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="contact">
                                    <i class="dashicons dashicons-email"></i> نموذج اتصال
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>التخطيط</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="columns">
                                    <i class="dashicons dashicons-columns"></i> أعمدة
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="tabs">
                                    <i class="dashicons dashicons-index-card"></i> تبويبات
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="accordion">
                                    <i class="dashicons dashicons-list-view"></i> أكورديون
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>الوسائط</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="gallery">
                                    <i class="dashicons dashicons-format-gallery"></i> معرض
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="video">
                                    <i class="dashicons dashicons-format-video"></i> فيديو
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="audio">
                                    <i class="dashicons dashicons-format-audio"></i> صوت
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if ($('#side-sortables').length) {
                $('#side-sortables').append(shortcodePanel);
            }
        }

        /**
         * تهيئة مكتبة الوسائط
         */
        initMediaLibrary() {
            // تحسين رفع الصور
            if (typeof wp !== 'undefined' && wp.media) {
                const originalFrame = wp.media.view.MediaFrame.Post;
                
                wp.media.view.MediaFrame.Post = originalFrame.extend({
                    initialize: function() {
                        originalFrame.prototype.initialize.apply(this, arguments);
                        this.on('insert', this.onInsert, this);
                    },
                    
                    onInsert: function() {
                        // تحسين الصور المرفوعة تلقائياً
                        setTimeout(() => {
                            this.optimizeUploadedImages();
                        }, 1000);
                    },
                    
                    optimizeUploadedImages: function() {
                        // تشغيل تحسين الصور في الخلفية
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'muhtawaa_optimize_images',
                                nonce: muhtawaaData.nonce
                            }
                        });
                    }
                });
            }
        }

        /**
         * تهيئة واجهة المستخدم
         */
        initUserInterface() {
            this.enhanceAdminMenus();
            this.addQuickActions();
            this.improveNotifications();
            this.addKeyboardShortcuts();
            this.setupDragAndDrop();
        }

        /**
         * تحسين قوائم الإدارة
         */
        enhanceAdminMenus() {
            // إضافة أيقونات للقوائم
            const menuIcons = {
                'muhtawaa-settings': 'dashicons-admin-generic',
                'muhtawaa-analytics': 'dashicons-chart-area',
                'muhtawaa-security': 'dashicons-shield',
                'muhtawaa-performance': 'dashicons-performance',
                'muhtawaa-backup': 'dashicons-backup'
            };
            
            Object.keys(menuIcons).forEach(menuId => {
                const menuItem = $(`#menu-${menuId}`);
                if (menuItem.length) {
                    menuItem.find('.wp-menu-image').addClass(menuIcons[menuId]);
                }
            });
            
            // إضافة عدادات للقوائم
            this.updateMenuCounters();
        }

        /**
         * تحديث عدادات القوائم
         */
        async updateMenuCounters() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_menu_counters',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    const counters = response.data;
                    
                    // تحديث عدادات مختلفة
                    if (counters.pending_comments > 0) {
                        $('#menu-comments .wp-menu-name').append(`<span class="update-plugins count-${counters.pending_comments}"><span class="update-count">${counters.pending_comments}</span></span>`);
                    }
                    
                    if (counters.security_issues > 0) {
                        $('#menu-muhtawaa-security .wp-menu-name').append(`<span class="update-plugins count-${counters.security_issues}"><span class="update-count">${counters.security_issues}</span></span>`);
                    }
                    
                    if (counters.updates_available > 0) {
                        $('#menu-plugins .wp-menu-name').append(`<span class="update-plugins count-${counters.updates_available}"><span class="update-count">${counters.updates_available}</span></span>`);
                    }
                }
            } catch (error) {
                console.error('خطأ في تحديث عدادات القوائم:', error);
            }
        }

        /**
         * إضافة إجراءات سريعة
         */
        addQuickActions() {
            // شريط إجراءات سريع
            const quickActionsBar = `
                <div id="muhtawaa-quick-actions" class="muhtawaa-quick-bar">
                    <div class="quick-actions-container">
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="clear-cache" title="مسح التخزين المؤقت">
                                <i class="dashicons dashicons-update"></i>
                                <span>مسح التخزين المؤقت</span>
                            </button>
                            <button type="button" class="quick-action" data-action="optimize-db" title="تحسين قاعدة البيانات">
                                <i class="dashicons dashicons-database"></i>
                                <span>تحسين قاعدة البيانات</span>
                            </button>
                        </div>
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="security-scan" title="فحص أمني سريع">
                                <i class="dashicons dashicons-shield"></i>
                                <span>فحص أمني</span>
                            </button>
                            <button type="button" class="quick-action" data-action="backup-now" title="إنشاء نسخة احتياطية">
                                <i class="dashicons dashicons-backup"></i>
                                <span>نسخة احتياطية</span>
                            </button>
                        </div>
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="check-updates" title="فحص التحديثات">
                                <i class="dashicons dashicons-update"></i>
                                <span>فحص التحديثات</span>
                            </button>
                            <button type="button" class="quick-action" data-action="health-check" title="فحص صحة الموقع">
                                <i class="dashicons dashicons-heart"></i>
                                <span>فحص الصحة</span>
                            </button>
                        </div>
                    </div>
                    <div class="quick-actions-toggle">
                        <button type="button" class="toggle-quick-actions" title="إظهار/إخفاء الإجراءات السريعة">
                            <i class="dashicons dashicons-arrow-up-alt2"></i>
                        </button>
                    </div>
                </div>
            `;
            
            if ($('#wpbody-content').length) {
                $('#wpbody-content').prepend(quickActionsBar);
                
                // معالج تبديل إظهار الشريط
                $('.toggle-quick-actions').on('click', function() {
                    const bar = $('#muhtawaa-quick-actions');
                    const icon = $(this).find('i');
                    
                    bar.toggleClass('collapsed');
                    
                    if (bar.hasClass('collapsed')) {
                        icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
                    } else {
                        icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                    }
                });
                
                // معالج الإجراءات السريعة
                $('.quick-action').on('click', this.handleQuickAction.bind(this));
            }
        }

        /**
         * تحسين الإشعارات
         */
        improveNotifications() {
            // استبدال إشعارات ووردبريس الافتراضية
            $('.notice').each(function() {
                const notice = $(this);
                const type = notice.hasClass('notice-error') ? 'error' : 
                           notice.hasClass('notice-warning') ? 'warning' : 
                           notice.hasClass('notice-success') ? 'success' : 'info';
                
                notice.addClass(`muhtawaa-notice muhtawaa-notice-${type}`);
                
                // إضافة أيقونة
                const icon = notice.find('.dashicons').first();
                if (!icon.length) {
                    const iconClass = type === 'error' ? 'dashicons-dismiss' :
                                    type === 'warning' ? 'dashicons-warning' :
                                    type === 'success' ? 'dashicons-yes-alt' : 'dashicons-info';
                    
                    notice.prepend(`<i class="dashicons ${iconClass}"></i>`);
                }
                
                // إضافة زر إغلاق
                if (!notice.find('.notice-dismiss').length && !notice.hasClass('notice-alt')) {
                    notice.append('<button type="button" class="notice-dismiss"><span class="screen-reader-text">إغلاق هذا الإشعار</span></button>');
                }
            });
        }

        /**
         * تهيئة التحليلات
         */
        initAnalytics() {
            if (!$('.muhtawaa-analytics-page').length) return;
            
            this.loadAnalyticsData();
            this.setupAnalyticsCharts();
            this.setupAnalyticsFilters();
            this.setupRealTimeStats();
        }

        /**
         * تحميل بيانات التحليلات
         */
        async loadAnalyticsData() {
            const period = $('.muhtawaa-stats-period').val() || '7days';
            
            try {
                this.showAnalyticsLoader(true);
                
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_analytics',
                        period: period,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.analyticsData = response.data;
                    this.updateAnalyticsDisplay();
                }
            } catch (error) {
                console.error('خطأ في تحميل بيانات التحليلات:', error);
                this.showNotification('فشل في تحميل بيانات التحليلات', 'error');
            } finally {
                this.showAnalyticsLoader(false);
            }
        }

        /**
         * إظهار/إخفاء مُحمل التحليلات
         */
        showAnalyticsLoader(show) {
            const loader = $('.analytics-loader');
            if (show) {
                if (!loader.length) {
                    $('.muhtawaa-analytics-page').append('<div class="analytics-loader"><div class="loader-spinner"></div><p>جاري تحميل البيانات...</p></div>');
                }
                $('.analytics-loader').show();
            } else {
                loader.hide();
            }
        }

        /**
         * تحديث عرض التحليلات
         */
        updateAnalyticsDisplay() {
            const data = this.analyticsData;
            
            // تحديث الإحصائيات الرئيسية مع الحركة
            this.animateNumber('.total-pageviews', 0, data.total_pageviews || 0, 1500);
            this.animateNumber('.unique-visitors', 0, data.unique_visitors || 0, 1800);
            $('.bounce-rate').text((data.bounce_rate || 0) + '%');
            $('.avg-session-duration').text(this.formatDuration(data.avg_session_duration || 0));
            
            // تحديث النمو/التراجع
            this.updateGrowthIndicators(data);
            
            // تحديث الرسوم البيانية
            if (data.pageviews_chart && typeof Chart !== 'undefined') {
                this.createChart('pageviews-chart', 'line', data.pageviews_chart, {
                    title: 'المشاهدات اليومية',
                    color: '#007cba'
                });
            }
            
            if (data.top_pages) {
                this.updateTopPagesTable(data.top_pages);
            }
            
            if (data.traffic_sources && typeof Chart !== 'undefined') {
                this.createChart('traffic-sources-chart', 'doughnut', data.traffic_sources, {
                    title: 'مصادر الزيارات'
                });
            }
            
            if (data.device_breakdown && typeof Chart !== 'undefined') {
                this.createChart('devices-chart', 'pie', data.device_breakdown, {
                    title: 'أنواع الأجهزة'
                });
            }
        }

        /**
         * تحديث مؤشرات النمو
         */
        updateGrowthIndicators(data) {
            $('.growth-indicator').each(function() {
                const indicator = $(this);
                const metric = indicator.data('metric');
                const growth = data.growth && data.growth[metric] ? data.growth[metric] : 0;
                
                indicator.removeClass('positive negative neutral');
                
                if (growth > 0) {
                    indicator.addClass('positive');
                    indicator.html(`<i class="dashicons dashicons-arrow-up-alt"></i> +${growth}%`);
                } else if (growth < 0) {
                    indicator.addClass('negative');
                    indicator.html(`<i class="dashicons dashicons-arrow-down-alt"></i> ${growth}%`);
                } else {
                    indicator.addClass('neutral');
                    indicator.html(`<i class="dashicons dashicons-minus"></i> 0%`);
                }
            });
        }

        /**
         * تحديث جدول الصفحات الأكثر زيارة
         */
        updateTopPagesTable(pages) {
            const tbody = $('.top-pages-table tbody');
            tbody.empty();
            
            if (pages && pages.length > 0) {
                pages.forEach((page, index) => {
                    const row = `
                        <tr>
                            <td class="rank">${index + 1}</td>
                            <td class="page-title">
                                <a href="${page.url}" target="_blank" title="عرض الصفحة">
                                    ${page.title}
                                </a>
                                <div class="page-url">${page.url}</div>
                            </td>
                            <td class="pageviews">${this.formatNumber(page.pageviews)}</td>
                            <td class="unique-pageviews">${this.formatNumber(page.unique_pageviews)}</td>
                            <td class="bounce-rate">${page.bounce_rate}%</td>
                            <td class="avg-time">${this.formatDuration(page.avg_time_on_page)}</td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                tbody.append('<tr><td colspan="6" class="no-data">لا توجد بيانات متاحة</td></tr>');
            }
        }

        /**
         * تهيئة الأمان
         */
        initSecurity() {
            if (!$('.muhtawaa-security-page').length) return;
            
            this.loadSecurityStatus();
            this.setupSecurityScanner();
            this.setupLoginProtection();
            this.setupSecuritySettings();
        }

        /**
         * تحميل حالة الأمان
         */
        async loadSecurityStatus() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_security_status',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.updateSecurityDisplay(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل حالة الأمان:', error);
                this.showNotification('فشل في تحميل حالة الأمان', 'error');
            }
        }

        /**
         * تحديث عرض الأمان
         */
        updateSecurityDisplay(data) {
            // نقاط الأمان مع حركة تدريجية
            this.animateNumber('.security-score', 0, data.security_score || 0, 2000, '%');
            
            // شريط النقاط مع حركة
            $('.security-score-bar').animate({
                width: (data.security_score || 0) + '%'
            }, 1500);
            
            // تحديث لون الشريط حسب النقاط
            const scoreBar = $('.security-score-bar');
            scoreBar.removeClass('low medium high');
            
            if (data.security_score >= 80) {
                scoreBar.addClass('high');
            } else if (data.security_score >= 60) {
                scoreBar.addClass('medium');
            } else {
                scoreBar.addClass('low');
            }
            
            // التهديدات المكتشفة
            $('.threats-detected').text(data.threats_detected || 0);
            
            // آخر فحص
            $('.last-scan-date').text(data.last_scan_date || 'لم يتم الفحص بعد');
            
            // حالة الحماية
            $('.protection-status').text(data.protection_enabled ? 'مفعلة' : 'معطلة');
            $('.protection-status').removeClass('enabled disabled').addClass(data.protection_enabled ? 'enabled' : 'disabled');
            
            // التوصيات
            this.updateSecurityRecommendations(data.recommendations || []);
            
            // السجلات الأمنية
            this.updateSecurityLogs(data.recent_logs || []);
        }

        /**
         * تحديث التوصيات الأمنية
         */
        updateSecurityRecommendations(recommendations) {
            const recommendationsList = $('.security-recommendations');
            recommendationsList.empty();
            
            if (recommendations.length > 0) {
                recommendations.forEach(recommendation => {
                    const priority = recommendation.priority || 'medium';
                    const item = `
                        <li class="recommendation-item priority-${priority}">
                            <div class="recommendation-icon">
                                <i class="dashicons dashicons-${recommendation.icon || 'warning'}"></i>
                            </div>
                            <div class="recommendation-content">
                                <h4>${recommendation.title}</h4>
                                <p>${recommendation.message}</p>
                                ${recommendation.action ? `<button class="button button-small security-action" data-action="${recommendation.action}">إصلاح</button>` : ''}
                            </div>
                            <div class="recommendation-priority">
                                <span class="priority-badge priority-${priority}">${this.getPriorityText(priority)}</span>
                            </div>
                        </li>
                    `;
                    recommendationsList.append(item);
                });
            } else {
                recommendationsList.append('<li class="no-recommendations">✅ لا توجد توصيات أمنية في الوقت الحالي. موقعك محمي بشكل جيد!</li>');
            }
        }

        /**
         * الحصول على نص الأولوية
         */
        getPriorityText(priority) {
            const priorities = {
                low: 'منخفضة',
                medium: 'متوسطة',
                high: 'عالية',
                critical: 'حرجة'
            };
            return priorities[priority] || 'متوسطة';
        }

        /**
         * تحديث السجلات الأمنية
         */
        updateSecurityLogs(logs) {
            const logsList = $('.security-logs-list');
            logsList.empty();
            
            if (logs.length > 0) {
                logs.forEach(log => {
                    const severity = log.severity || 'info';
                    const item = `
                        <div class="log-item severity-${severity}">
                            <div class="log-time">${log.time}</div>
                            <div class="log-content">
                                <div class="log-message">${log.message}</div>
                                <div class="log-details">${log.ip} - ${log.user_agent}</div>
                            </div>
                            <div class="log-severity">
                                <span class="severity-badge severity-${severity}">${this.getSeverityText(severity)}</span>
                            </div>
                        </div>
                    `;
                    logsList.append(item);
                });
            } else {
                logsList.append('<div class="no-logs">لا توجد سجلات أمنية حديثة</div>');
            }
        }

        /**
         * الحصول على نص الخطورة
         */
        getSeverityText(severity) {
            const severities = {
                info: 'معلومات',
                warning: 'تحذير',
                error: 'خطأ',
                critical: 'حرج'
            };
            return severities[severity] || 'معلومات';
        }

        /**
         * تهيئة الأداء
         */
        initPerformance() {
            if (!$('.muhtawaa-performance-page').length) return;
            
            this.loadPerformanceData();
            this.setupPerformanceOptimizer();
            this.setupPerformanceMonitoring();
        }

        /**
         * تحميل بيانات الأداء
         */
        async loadPerformanceData() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_performance_data',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.updatePerformanceDisplay(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل بيانات الأداء:', error);
                this.showNotification('فشل في تحميل بيانات الأداء', 'error');
            }
        }

        /**
         * تحديث عرض الأداء
         */
        updatePerformanceDisplay(data) {
            // نقاط الأداء مع حركة تدريجية
            this.animateNumber('.performance-score', 0, data.performance_score || 0, 2000, '%');
            
            // شريط الأداء
            $('.performance-score-bar').animate({
                width: (data.performance_score || 0) + '%'
            }, 1500);
            
            // تحديث لون الشريط حسب النقاط
            const scoreBar = $('.performance-score-bar');
            scoreBar.removeClass('poor average good excellent');
            
            if (data.performance_score >= 90) {
                scoreBar.addClass('excellent');
            } else if (data.performance_score >= 70) {
                scoreBar.addClass('good');
            } else if (data.performance_score >= 50) {
                scoreBar.addClass('average');
            } else {
                scoreBar.addClass('poor');
            }
            
            // البيانات التفصيلية
            $('.page-load-time').text((data.page_load_time || 0) + ' ثانية');
            $('.page-size').text(this.formatBytes(data.page_size || 0));
            $('.total-requests').text(data.total_requests || 0);
            $('.time-to-first-byte').text((data.ttfb || 0) + ' ms');
            $('.first-contentful-paint').text((data.fcp || 0) + ' ms');
            $('.largest-contentful-paint').text((data.lcp || 0) + ' ms');
            
            // تحسينات مقترحة
            this.updatePerformanceOptimizations(data.optimizations || []);
            
            // رسم بياني لأوقات التحميل
            if (data.load_times_chart && typeof Chart !== 'undefined') {
                this.createChart('load-times-chart', 'line', data.load_times_chart, {
                    title: 'أوقات التحميل (آخر 30 يوم)',
                    color: '#00a32a'
                });
            }
        }

        /**
         * تحديث تحسينات الأداء
         */
        updatePerformanceOptimizations(optimizations) {
            const optimizationsList = $('.performance-optimizations');
            optimizationsList.empty();
            
            if (optimizations.length > 0) {
                optimizations.forEach(optimization => {
                    const impact = optimization.impact || 'medium';
                    const item = `
                        <li class="optimization-item impact-${impact}">
                            <div class="optimization-icon">
                                <i class="dashicons dashicons-${optimization.icon || 'performance'}"></i>
                            </div>
                            <div class="optimization-content">
                                <h4>${optimization.title}</h4>
                                <p>${optimization.message}</p>
                                <div class="optimization-details">
                                    <span class="current-value">الحالي: ${optimization.current}</span>
                                    <span class="potential-savings">توفير محتمل: ${optimization.savings}</span>
                                </div>
                                ${optimization.action ? `<button class="button button-small optimization-action" data-action="${optimization.action}">تطبيق</button>` : ''}
                            </div>
                            <div class="optimization-impact">
                                <span class="impact-badge impact-${impact}">${this.getImpactText(impact)}</span>
                            </div>
                        </li>
                    `;
                    optimizationsList.append(item);
                });
            } else {
                optimizationsList.append('<li class="no-optimizations">🚀 الموقع محسن بالفعل! أداء ممتاز.</li>');
            }
        }

/**
         * الحصول على نص التأثير
         */
        getImpactText(impact) {
            const impacts = {
                low: 'تأثير منخفض',
                medium: 'تأثير متوسط',
                high: 'تأثير عالي',
                critical: 'تأثير حرج'
            };
            return impacts[impact] || 'تأثير متوسط';
        }

        /**
         * تهيئة النسخ الاحتياطي
         */
        initBackup() {
            if (!$('.muhtawaa-backup-page').length) return;
            
            this.loadBackupHistory();
            this.setupAutomaticBackup();
            this.setupBackupSchedule();
        }

        /**
         * تحميل تاريخ النسخ الاحتياطية
         */
        async loadBackupHistory() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_backup_history',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.updateBackupHistory(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل تاريخ النسخ الاحتياطية:', error);
                this.showNotification('فشل في تحميل تاريخ النسخ الاحتياطية', 'error');
            }
        }

        /**
         * تحديث تاريخ النسخ الاحتياطية
         */
        updateBackupHistory(backups) {
            const tbody = $('.backup-history-table tbody');
            tbody.empty();
            
            if (backups && backups.length > 0) {
                backups.forEach(backup => {
                    const statusClass = backup.status === 'completed' ? 'success' : 
                                      backup.status === 'failed' ? 'error' : 
                                      backup.status === 'running' ? 'warning' : 'info';
                    
                    const statusText = backup.status === 'completed' ? 'مكتملة' : 
                                     backup.status === 'failed' ? 'فشلت' : 
                                     backup.status === 'running' ? 'قيد التشغيل' : 'معلقة';
                    
                    const row = `
                        <tr>
                            <td>
                                <div class="backup-info">
                                    <strong>${backup.date}</strong>
                                    <div class="backup-time">${backup.time}</div>
                                </div>
                            </td>
                            <td>
                                <span class="backup-type-badge type-${backup.type}">${this.getBackupTypeText(backup.type)}</span>
                            </td>
                            <td>${this.formatBytes(backup.size)}</td>
                            <td>
                                <span class="backup-status backup-status-${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="backup-actions">
                                    ${backup.status === 'completed' ? `
                                        <button class="button button-small muhtawaa-restore-backup" data-backup-id="${backup.id}" title="استعادة النسخة">
                                            <i class="dashicons dashicons-backup"></i> استعادة
                                        </button>
                                        <button class="button button-small muhtawaa-download-backup" data-backup-id="${backup.id}" title="تحميل النسخة">
                                            <i class="dashicons dashicons-download"></i> تحميل
                                        </button>
                                    ` : ''}
                                    <button class="button button-small button-link-delete muhtawaa-delete-backup" data-backup-id="${backup.id}" title="حذف النسخة">
                                        <i class="dashicons dashicons-trash"></i> حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                tbody.append('<tr><td colspan="5" class="no-backups">لا توجد نسخ احتياطية</td></tr>');
            }
        }

        /**
         * الحصول على نص نوع النسخة الاحتياطية
         */
        getBackupTypeText(type) {
            const types = {
                full: 'كاملة',
                files: 'ملفات',
                database: 'قاعدة بيانات',
                automatic: 'تلقائية',
                manual: 'يدوية'
            };
            return types[type] || 'غير محدد';
        }

        /**
         * تهيئة الإشعارات
         */
        initNotifications() {
            this.createNotificationSystem();
            this.loadNotifications();
            this.setupNotificationSettings();
        }

        /**
         * إنشاء نظام الإشعارات
         */
        createNotificationSystem() {
            if ($('#muhtawaa-notifications').length) return;
            
            const notificationContainer = `
                <div id="muhtawaa-notifications" class="muhtawaa-notifications-container">
                    <div class="notifications-header">
                        <h3>الإشعارات</h3>
                        <button class="notifications-toggle" title="عرض الإشعارات">
                            <i class="dashicons dashicons-bell"></i>
                            <span class="notification-count">0</span>
                        </button>
                    </div>
                    <div class="notifications-dropdown">
                        <div class="notifications-header-dropdown">
                            <h4>الإشعارات</h4>
                            <div class="notifications-controls">
                                <button class="button button-small mark-all-read" title="تعيين الكل كمقروء">
                                    <i class="dashicons dashicons-yes"></i> تعيين الكل كمقروء
                                </button>
                                <button class="button button-small notifications-settings" title="إعدادات الإشعارات">
                                    <i class="dashicons dashicons-admin-generic"></i>
                                </button>
                            </div>
                        </div>
                        <div class="notifications-list"></div>
                        <div class="notifications-footer">
                            <a href="admin.php?page=muhtawaa-notifications" class="view-all-notifications">عرض جميع الإشعارات</a>
                        </div>
                    </div>
                </div>
            `;
            
            if ($('#adminmenuwrap').length) {
                $('#adminmenuwrap').after(notificationContainer);
            } else {
                $('body').append(notificationContainer);
            }
            
            // إغلاق الإشعارات عند النقر خارجها
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#muhtawaa-notifications').length) {
                    $('.notifications-dropdown').hide();
                }
            });
        }

        /**
         * تحميل الإشعارات
         */
        async loadNotifications() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_notifications',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.notifications = response.data;
                    this.displayNotifications(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل الإشعارات:', error);
            }
        }

        /**
         * عرض الإشعارات
         */
        displayNotifications(notifications) {
            const notificationsList = $('.notifications-list');
            const notificationCount = $('.notification-count');
            
            notificationsList.empty();
            
            if (notifications && notifications.length > 0) {
                notifications.slice(0, 10).forEach(notification => { // عرض أحدث 10 إشعارات
                    const item = `
                        <div class="notification-item ${notification.read ? 'read' : 'unread'}" data-id="${notification.id}">
                            <div class="notification-icon">
                                <i class="dashicons dashicons-${notification.icon || 'bell'}"></i>
                            </div>
                            <div class="notification-content">
                                <h4>${notification.title}</h4>
                                <p>${notification.message}</p>
                                <div class="notification-meta">
                                    <span class="notification-time">${notification.time}</span>
                                    <span class="notification-type">${notification.type}</span>
                                </div>
                            </div>
                            <div class="notification-actions">
                                ${!notification.read ? `
                                    <button class="mark-read" data-id="${notification.id}" title="تعيين كمقروء">
                                        <i class="dashicons dashicons-yes"></i>
                                    </button>
                                ` : ''}
                                <button class="dismiss-notification" data-id="${notification.id}" title="إغلاق">
                                    <i class="dashicons dashicons-dismiss"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    notificationsList.append(item);
                });
                
                // تحديث العداد
                const unreadCount = notifications.filter(n => !n.read).length;
                notificationCount.text(unreadCount);
                
                if (unreadCount > 0) {
                    notificationCount.addClass('has-notifications');
                } else {
                    notificationCount.removeClass('has-notifications');
                }
            } else {
                notificationsList.append('<div class="no-notifications"><i class="dashicons dashicons-bell"></i><p>لا توجد إشعارات</p></div>');
                notificationCount.text('0').removeClass('has-notifications');
            }
        }

        /**
         * تهيئة الحفظ التلقائي
         */
        initAutoSave() {
            // حفظ تلقائي للإعدادات
            $('.muhtawaa-setting-field').on('change input', () => {
                clearTimeout(this.autoSaveTimer);
                this.autoSaveTimer = setTimeout(() => {
                    this.autoSaveSettings();
                }, 2000);
            });
            
            // حفظ الأصل للنماذج
            $('.muhtawaa-settings-form :input').each(function() {
                $(this).data('original-value', $(this).val());
            });
        }

        /**
         * حفظ تلقائي للإعدادات
         */
        async autoSaveSettings() {
            const form = $('.muhtawaa-settings-form');
            if (!form.length) return;
            
            const formData = form.serialize();
            
            try {
                await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData + '&action=muhtawaa_auto_save_settings&nonce=' + muhtawaaData.nonce
                });
                
                this.showAutoSaveIndicator();
            } catch (error) {
                console.error('خطأ في الحفظ التلقائي:', error);
            }
        }

        /**
         * إظهار مؤشر الحفظ التلقائي
         */
        showAutoSaveIndicator() {
            const indicator = $('.auto-save-indicator');
            if (indicator.length) {
                indicator.addClass('saved').text('تم الحفظ تلقائياً');
                setTimeout(() => {
                    indicator.removeClass('saved').text('');
                }, 2000);
            } else {
                // إنشاء مؤشر إذا لم يكن موجوداً
                const newIndicator = $('<div class="auto-save-indicator saved">تم الحفظ تلقائياً</div>');
                $('.muhtawaa-settings-form').append(newIndicator);
                setTimeout(() => {
                    newIndicator.removeClass('saved').text('');
                }, 2000);
            }
        }

        /**
         * تهيئة اختصارات لوحة المفاتيح
         */
        initShortcuts() {
            $(document).on('keydown', (e) => {
                // Ctrl/Cmd + S للحفظ
                if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
                    e.preventDefault();
                    this.handleSaveShortcut();
                }
                
                // Ctrl/Cmd + Shift + C لمسح التخزين المؤقت
                if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 67) {
                    e.preventDefault();
                    this.handleQuickAction({ target: { dataset: { action: 'clear-cache' } } });
                }
                
                // Ctrl/Cmd + Shift + N للإشعارات
                if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 78) {
                    e.preventDefault();
                    $('.notifications-toggle').click();
                }
                
                // Ctrl/Cmd + Shift + B لنسخة احتياطية
                if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 66) {
                    e.preventDefault();
                    this.handleQuickAction({ target: { dataset: { action: 'backup-now' } } });
                }
                
                // Escape لإغلاق النوافذ المنبثقة
                if (e.keyCode === 27) {
                    $('.notifications-dropdown').hide();
                    $('.muhtawaa-modal.active').removeClass('active');
                }
            });
        }

        /**
         * تهيئة نظام الألوان
         */
        initColorScheme() {
            // تطبيق نظام الألوان المخصص
            this.applyCustomColorScheme();
            
            // مراقبة تغييرات نظام الألوان
            if (window.matchMedia) {
                const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');
                darkModeQuery.addListener(() => {
                    this.handleColorSchemeChange();
                });
            }
        }

        /**
         * تطبيق نظام الألوان المخصص
         */
        applyCustomColorScheme() {
            // قراءة الألوان المخصصة من الإعدادات
            const adminColors = muhtawaaData.adminColors || {};
            
            if (Object.keys(adminColors).length > 0) {
                const style = document.createElement('style');
                style.id = 'muhtawaa-admin-colors';
                
                let css = ':root {';
                Object.keys(adminColors).forEach(key => {
                    css += `--muhtawaa-${key}: ${adminColors[key]};`;
                });
                css += '}';
                
                style.textContent = css;
                document.head.appendChild(style);
            }
        }

        /**
         * معالج تغيير نظام الألوان
         */
        handleColorSchemeChange() {
            // إعادة تطبيق الألوان المخصصة
            this.applyCustomColorScheme();
            
            // تحديث الرسوم البيانية
            this.refreshCharts();
        }

        /**
         * إعداد السحب والإفلات
         */
        setupDragAndDrop() {
            // تمكين السحب والإفلات للملفات
            $('.muhtawaa-file-upload-area').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('dragover');
            });
            
            $('.muhtawaa-file-upload-area').on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
            });
            
            $('.muhtawaa-file-upload-area').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
                
                const files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    window.MuhtawaaAdmin.handleFileUpload(files, $(this));
                }
            });
        }

        /**
         * معالجات الأحداث
         */
        
        handleTabSwitch(e) {
            e.preventDefault();
            
            const tab = $(e.target).closest('.muhtawaa-admin-tab');
            const targetTab = tab.data('tab');
            
            if (!targetTab) return;
            
            // إزالة النشط من جميع التبويبات
            $('.muhtawaa-admin-tab').removeClass('active');
            $('.muhtawaa-tab-content').removeClass('active');
            
            // تفعيل التبويب المحدد
            tab.addClass('active');
            $(`#${targetTab}`).addClass('active');
            
            // تحميل محتوى التبويب إذا لزم الأمر
            this.loadTabContent(targetTab);
            
            // حفظ التبويب النشط
            localStorage.setItem('muhtawaa_active_tab', targetTab);
        }

        handleSectionToggle(e) {
            e.preventDefault();
            
            const toggle = $(e.target).closest('.muhtawaa-toggle-section');
            const section = toggle.closest('.muhtawaa-settings-section');
            const content = section.find('.section-content');
            const icon = toggle.find('i');
            
            section.toggleClass('collapsed');
            content.slideToggle(300);
            
            // تغيير الأيقونة
            if (section.hasClass('collapsed')) {
                icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
            } else {
                icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
            }
        }

        handleSettingChange(e) {
            const field = $(e.target);
            const setting = field.attr('name');
            const value = field.val();
            
            // إطلاق حدث مخصص للتغيير
            $('body').trigger('muhtawaa:setting-changed', [setting, value]);
            
            // معاينة مباشرة إذا كان متاحاً
            if (field.hasClass('live-preview')) {
                this.updateLivePreview(setting, value);
            }
            
            // إضافة مؤشر التغيير
            field.addClass('changed');
            
            // تحديث حالة الحفظ
            this.updateSaveButtonState();
        }

        handleSettingsReset(e) {
            e.preventDefault();
            
            if (confirm('هل أنت متأكد من إعادة تعيين جميع الإعدادات؟ سيتم فقدان جميع التخصيصات الحالية.')) {
                this.resetSettings();
            }
        }

        handleSettingsSave(e) {
            e.preventDefault();
            
            const button = $(e.target);
            const form = button.closest('form');
            
            this.saveSettings(form, button);
        }

        handleEditorChange(e) {
            const editor = $(e.target);
            const content = editor.val();
            
            // تحديث العداد
            const wordCount = content.trim() ? content.trim().split(/\s+/).length : 0;
            const charCount = content.length;
            
            const counter = editor.siblings('.editor-counter');
            if (counter.length) {
                counter.html(`الكلمات: ${wordCount} | الأحرف: ${charCount}`);
            } else {
                editor.after(`<div class="editor-counter">الكلمات: ${wordCount} | الأحرف: ${charCount}</div>`);
            }
            
            // تحديث معاينة SEO
            this.updateSEOPreview(content);
            
            // تحقق من طول المحتوى
            this.checkContentLength(editor, content);
        }

        handleShortcodeInsert(e) {
            e.preventDefault();
            
            const button = $(e.target).closest('.muhtawaa-insert-shortcode');
            const shortcode = button.data('shortcode');
            
            if (shortcode) {
                this.insertShortcode(shortcode);
            }
        }

        handleStatsRefresh(e) {
            e.preventDefault();
            
            const button = $(e.target);
            const originalText = button.text();
            
            button.addClass('loading').text('جاري التحديث...');
            
            this.loadAnalyticsData().finally(() => {
                button.removeClass('loading').text(originalText);
            });
        }

        handleStatsPeriodChange(e) {
            const period = $(e.target).val();
            this.loadAnalyticsData();
        }

        handleSecurityScan(e) {
            e.preventDefault();
            
            const button = $(e.target);
            const originalText = button.text();
            
            button.addClass('loading').text('جاري الفحص...');
            
            this.performSecurityScan().finally(() => {
                button.removeClass('loading').text(originalText);
            });
        }

        handleClearLogs(e) {
            e.preventDefault();
            
            if (confirm('هل أنت متأكد من مسح جميع السجلات الأمنية؟ لا يمكن التراجع عن هذا الإجراء.')) {
                this.clearSecurityLogs();
            }
        }

        handleCreateBackup(e) {
            e.preventDefault();
            
            const button = $(e.target);
            const originalText = button.text();
            
            button.addClass('loading').text('جاري إنشاء النسخة...');
            
            this.createBackup().finally(() => {
                button.removeClass('loading').text(originalText);
            });
        }

        handleRestoreBackup(e) {
            e.preventDefault();
            
            const backupId = $(e.target).data('backup-id');
            
            if (confirm('هل أنت متأكد من استعادة هذه النسخة الاحتياطية؟ سيتم استبدال الموقع الحالي بالكامل.')) {
                this.restoreBackup(backupId);
            }
        }

        handleDeleteBackup(e) {
            e.preventDefault();
            
            const backupId = $(e.target).data('backup-id');
            
            if (confirm('هل أنت متأكد من حذف هذه النسخة الاحتياطية؟ لا يمكن التراجع عن هذا الإجراء.')) {
                this.deleteBackup(backupId);
            }
        }

        async handleQuickAction(e) {
            e.preventDefault();
            
            const action = e.target.dataset.action;
            const button = $(e.target);
            const originalText = button.text();
            
            button.addClass('loading').prop('disabled', true);
            
            // تحديث نص الزر حسب الإجراء
            const loadingTexts = {
                'clear-cache': 'جاري المسح...',
                'optimize-db': 'جاري التحسين...',
                'security-scan': 'جاري الفحص...',
                'backup-now': 'جاري النسخ...',
                'check-updates': 'جاري الفحص...',
                'health-check': 'جاري الفحص...'
            };
            
            button.text(loadingTexts[action] || 'جاري المعالجة...');
            
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: `muhtawaa_quick_${action.replace('-', '_')}`,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification(response.data.message || 'تم تنفيذ الإجراء بنجاح', 'success');
                    
                    // تحديث البيانات ذات الصلة
                    if (action === 'security-scan') {
                        this.loadSecurityStatus();
                    } else if (action === 'backup-now') {
                        this.loadBackupHistory();
                    }
                } else {
                    this.showNotification(response.data.message || 'فشل في تنفيذ الإجراء', 'error');
                }
            } catch (error) {
                this.showNotification('حدث خطأ في تنفيذ الإجراء', 'error');
                console.error('خطأ في الإجراء السريع:', error);
            } finally {
                button.removeClass('loading').prop('disabled', false).text(originalText);
            }
        }

        handleNotification(e, notification) {
            this.addNotification(notification);
        }

        handleBeforeUnload(e) {
            // التحقق من وجود تغييرات غير محفوظة
            if (this.hasUnsavedChanges()) {
                const message = 'لديك تغييرات غير محفوظة. هل أنت متأكد من مغادرة الصفحة؟';
                e.returnValue = message;
                return message;
            }
        }

        handleNotificationsToggle(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdown = $('.notifications-dropdown');
            dropdown.toggle();
            
            // تحديث الإشعارات عند الفتح
            if (dropdown.is(':visible')) {
                this.loadNotifications();
            }
        }

        handleMarkNotificationRead(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const notificationId = $(e.target).closest('.mark-read').data('id');
            this.markNotificationRead(notificationId);
        }

        handleDismissNotification(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const notificationId = $(e.target).closest('.dismiss-notification').data('id');
            this.dismissNotification(notificationId);
        }

        /**
         * دوال المساعدة
         */
        
        /**
         * التحقق من صفحة الإدارة
         */
        isAdminPage() {
            return $('body').hasClass('wp-admin');
        }

        /**
         * تنسيق الأرقام
         */
        formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'م';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'ك';
            }
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        /**
         * تنسيق الوقت
         */
        formatDuration(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = Math.floor(seconds % 60);
            
            if (hours > 0) {
                return `${hours}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            } else if (minutes > 0) {
                return `${minutes}:${secs.toString().padStart(2, '0')}`;
            } else {
                return `${secs}ث`;
            }
        }

        /**
         * تنسيق حجم الملفات
         */
        formatBytes(bytes) {
            if (bytes === 0) return '0 بايت';
            
            const k = 1024;
            const sizes = ['بايت', 'كيلوبايت', 'ميجابايت', 'جيجابايت'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        /**
         * عرض إشعار
         */
        showNotification(message, type = 'info', duration = 5000) {
            const notification = $(`
                <div class="muhtawaa-admin-notification muhtawaa-notification-${type}">
                    <div class="notification-content">
                        <i class="dashicons dashicons-${this.getNotificationIcon(type)}"></i>
                        <span>${message}</span>
                    </div>
                    <button class="notification-close">
                        <i class="dashicons dashicons-dismiss"></i>
                    </button>
                </div>
            `);
            
            // إضافة الإشعار
            if (!$('#muhtawaa-admin-notifications').length) {
                $('body').append('<div id="muhtawaa-admin-notifications"></div>');
            }
            
            $('#muhtawaa-admin-notifications').append(notification);
            
            // إظهار الإشعار
            setTimeout(() => notification.addClass('show'), 100);
            
            // إخفاء الإشعار تلقائياً
            if (duration > 0) {
                setTimeout(() => {
                    notification.removeClass('show');
                    setTimeout(() => notification.remove(), 300);
                }, duration);
            }
            
            // معالج الإغلاق اليدوي
            notification.find('.notification-close').on('click', () => {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            });
        }

        /**
         * الحصول على أيقونة الإشعار
         */
        getNotificationIcon(type) {
            const icons = {
                success: 'yes-alt',
                error: 'dismiss',
                warning: 'warning',
                info: 'info-outline'
            };
            
            return icons[type] || 'info-outline';
        }

        /**
         * التحقق من وجود تغييرات غير محفوظة
         */
        hasUnsavedChanges() {
            return $('.muhtawaa-settings-form').find(':input').filter(function() {
                const current = $(this).val();
                const original = $(this).data('original-value');
                return original !== undefined && original !== current;
            }).length > 0;
        }

        /**
         * تحديث حالة زر الحفظ
         */
        updateSaveButtonState() {
            const hasChanges = this.hasUnsavedChanges();
            const saveButton = $('.muhtawaa-save-settings');
            
            if (hasChanges) {
                saveButton.removeClass('button-secondary').addClass('button-primary');
                saveButton.prop('disabled', false);
            } else {
                saveButton.removeClass('button-primary').addClass('button-secondary');
            }
        }

        /**
         * تحميل محتوى التبويب
         */
        async loadTabContent(tabId) {
            const tabContent = $(`#${tabId}`);
            
            if (tabContent.hasClass('loaded')) return;
            
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: `muhtawaa_load_tab_${tabId}`,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    tabContent.html(response.data.html);
                    tabContent.addClass('loaded');
                    
                    // تهيئة العناصر الجديدة
                    this.initTabElements(tabContent);
                } else {
                    tabContent.html('<div class="error-message">فشل في تحميل المحتوى</div>');
                }
            } catch (error) {
                console.error('خطأ في تحميل محتوى التبويب:', error);
                tabContent.html('<div class="error-message">حدث خطأ في تحميل المحتوى</div>');
            }
        }

        /**
         * تهيئة عناصر التبويب
         */
        initTabElements(container) {
            // إعادة تهيئة منتقي الألوان
            container.find('.muhtawaa-color-picker').each(function() {
                if (typeof $(this).wpColorPicker === 'function') {
                    $(this).wpColorPicker();
                }
            });
            
            // إعادة تهيئة منتقي الخطوط
            container.find('.muhtawaa-font-selector').each(function() {
                if (typeof $(this).select2 === 'function') {
                    $(this).select2();
                }
            });
        }

        /**
         * إدراج اختصار في المحرر
         */
        insertShortcode(shortcode) {
            const shortcuts = {
                alert: '[muhtawaa_alert type="info"]محتوى التنبيه[/muhtawaa_alert]',
                highlight: '[muhtawaa_highlight color="yellow"]النص المميز[/muhtawaa_highlight]',
                quote: '[muhtawaa_quote author="المؤلف"]نص الاقتباس[/muhtawaa_quote]',
                button: '[muhtawaa_button url="#" style="primary" size="medium"]نص الزر[/muhtawaa_button]',
                download: '[muhtawaa_download url="#" title="ملف للتحميل"]رابط التحميل[/muhtawaa_download]',
                contact: '[muhtawaa_contact_form id="1"]',
                columns: '[muhtawaa_columns]\n[muhtawaa_column width="6"]المحتوى الأول[/muhtawaa_column]\n[muhtawaa_column width="6"]المحتوى الثاني[/muhtawaa_column]\n[/muhtawaa_columns]',
                tabs: '[muhtawaa_tabs]\n[muhtawaa_tab title="التبويب الأول"]المحتوى الأول[/muhtawaa_tab]\n[muhtawaa_tab title="التبويب الثاني"]المحتوى الثاني[/muhtawaa_tab]\n[/muhtawaa_tabs]',
                accordion: '[muhtawaa_accordion]\n[muhtawaa_accordion_item title="العنوان الأول"]المحتوى الأول[/muhtawaa_accordion_item]\n[muhtawaa_accordion_item title="العنوان الثاني"]المحتوى الثاني[/muhtawaa_accordion_item]\n[/muhtawaa_accordion]',
                gallery: '[muhtawaa_gallery ids="1,2,3" columns="3"]',
                video: '[muhtawaa_video url="https://www.youtube.com/watch?v=VIDEO_ID"]',
                audio: '[muhtawaa_audio url="audio-file.mp3"]'
            };
            
            const shortcodeText = shortcuts[shortcode] || `[muhtawaa_${shortcode}]`;
            
            // إدراج في المحرر النشط
            if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
                tinyMCE.activeEditor.insertContent(shortcodeText);
            } else {
                const textarea = $('#content');
                if (textarea.length) {
                    const cursorPos = textarea[0].selectionStart;
                    const textBefore = textarea.val().substring(0, cursorPos);
                    const textAfter = textarea.val().substring(cursorPos);
                    
                    textarea.val(textBefore + shortcodeText + textAfter);
                    textarea[0].setSelectionRange(cursorPos + shortcodeText.length, cursorPos + shortcodeText.length);
                    textarea.focus();
                }
            }
            
            this.showNotification(`تم إدراج اختصار ${shortcode} بنجاح`, 'success', 2000);
        }

        /**
         * معالج اختصار الحفظ
         */
        handleSaveShortcut() {
            if ($('.muhtawaa-settings-form').length) {
                $('.muhtawaa-save-settings').click();
            } else if ($('#post').length) {
                $('#publish, #save-post').click();
            } else if ($('.submit input[type="submit"]').length) {
                $('.submit input[type="submit"]').first().click();
            }
        }

        /**
         * حفظ الإعدادات
         */
        async saveSettings(form, button) {
            const originalText = button.text();
            button.addClass('loading').text('جاري الحفظ...').prop('disabled', true);
            
            try {
                const formData = form.serialize();
                
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData + '&action=muhtawaa_save_settings&nonce=' + muhtawaaData.nonce
                });
                
                if (response.success) {
                    this.showNotification('تم حفظ الإعدادات بنجاح', 'success');
                    
                    // تحديث القيم الأصلية
                    form.find(':input').each(function() {
                        $(this).data('original-value', $(this).val());
                        $(this).removeClass('changed');
                    });
                    
                    this.updateSaveButtonState();
                } else {
                    this.showNotification(response.data.message || 'فشل في حفظ الإعدادات', 'error');
                }
            } catch (error) {
                console.error('خطأ في حفظ الإعدادات:', error);
                this.showNotification('حدث خطأ في حفظ الإعدادات', 'error');
            } finally {
                button.removeClass('loading').text(originalText).prop('disabled', false);
            }
        }

        /**
         * إعادة تعيين الإعدادات
         */
        async resetSettings() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_reset_settings',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم إعادة تعيين الإعدادات بنجاح', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    this.showNotification('فشل في إعادة تعيين الإعدادات', 'error');
                }
            } catch (error) {
                console.error('خطأ في إعادة تعيين الإعدادات:', error);
                this.showNotification('حدث خطأ في إعادة تعيين الإعدادات', 'error');
            }
        }

        /**
         * تحديث معاينة SEO
         */
        updateSEOPreview(content) {
            if (!content) return;
            
            const seoPreview = $('.seo-preview');
            if (!seoPreview.length) return;
            
            // حساب كثافة الكلمات المفتاحية
            const focusKeyword = $('#muhtawaa_focus_keyword').val();
            if (focusKeyword) {
                const regex = new RegExp(focusKeyword, 'gi');
                const matches = content.match(regex);
                const density = matches ? (matches.length / content.split(' ').length * 100).toFixed(1) : 0;
                
                $('.keyword-density').text(density + '%');
                
                // تحديث حالة الكثافة
                $('.keyword-density').removeClass('low good high');
                if (density < 0.5) {
                    $('.keyword-density').addClass('low');
                } else if (density <= 2.5) {
                    $('.keyword-density').addClass('good');
                } else {
                    $('.keyword-density').addClass('high');
                }
            }
            
            // تحديث عدد الكلمات
            const wordCount = content.trim().split(/\s+/).length;
            $('.content-word-count').text(wordCount);
            
            // تحديث وقت القراءة المقدر
            const readingTime = Math.ceil(wordCount / 200); // 200 كلمة في الدقيقة
            $('.estimated-reading-time').text(readingTime + ' دقيقة');
        }

        /**
         * فحص طول المحتوى
         */
        checkContentLength(editor, content) {
            const wordCount = content.trim() ? content.trim().split(/\s+/).length : 0;
            const minWords = 300;
            const maxWords = 2000;
            
            let status = 'good';
            let message = '';
            
            if (wordCount < minWords) {
                status = 'warning';
                message = `المحتوى قصير جداً. يُنصح بـ ${minWords} كلمة على الأقل.`;
            } else if (wordCount > maxWords) {
                status = 'info';
                message = `المحتوى طويل. فكر في تقسيمه إلى عدة مقالات.`;
            } else {
                status = 'good';
                message = 'طول المحتوى مناسب.';
            }
            
            // عرض الرسالة
            let indicator = editor.siblings('.content-length-indicator');
            if (!indicator.length) {
                indicator = $(`<div class="content-length-indicator"></div>`);
                editor.after(indicator);
            }
            
            indicator.removeClass('good warning info error')
                     .addClass(status)
                     .text(message);
        }

        /**
         * تنفيذ فحص أمني
         */
        async performSecurityScan() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_security_scan',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم إكمال الفحص الأمني بنجاح', 'success');
                    this.updateSecurityDisplay(response.data);
                } else {
                    this.showNotification('فشل في إجراء الفحص الأمني', 'error');
                }
            } catch (error) {
                console.error('خطأ في الفحص الأمني:', error);
                this.showNotification('حدث خطأ أثناء الفحص الأمني', 'error');
            }
        }

        /**
         * مسح السجلات الأمنية
         */
        async clearSecurityLogs() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_clear_security_logs',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم مسح السجلات الأمنية بنجاح', 'success');
                    this.updateSecurityLogs([]);
                } else {
                    this.showNotification('فشل في مسح السجلات الأمنية', 'error');
                }
            } catch (error) {
                console.error('خطأ في مسح السجلات الأمنية:', error);
                this.showNotification('حدث خطأ في مسح السجلات الأمنية', 'error');
            }
        }

        /**
         * إنشاء نسخة احتياطية
         */
        async createBackup() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_create_backup',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم إنشاء النسخة الاحتياطية بنجاح', 'success');
                    this.loadBackupHistory();
                } else {
                    this.showNotification('فشل في إنشاء النسخة الاحتياطية', 'error');
                }
            } catch (error) {
                console.error('خطأ في إنشاء النسخة الاحتياطية:', error);
                this.showNotification('حدث خطأ في إنشاء النسخة الاحتياطية', 'error');
            }
        }

        /**
         * استعادة نسخة احتياطية
         */
        async restoreBackup(backupId) {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_restore_backup',
                        backup_id: backupId,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم استعادة النسخة الاحتياطية بنجاح', 'success');
                    // إعادة تحميل الصفحة بعد الاستعادة
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    this.showNotification('فشل في استعادة النسخة الاحتياطية', 'error');
                }
            } catch (error) {
                console.error('خطأ في استعادة النسخة الاحتياطية:', error);
                this.showNotification('حدث خطأ في استعادة النسخة الاحتياطية', 'error');
            }
        }

        /**
         * حذف نسخة احتياطية
         */
        async deleteBackup(backupId) {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_delete_backup',
                        backup_id: backupId,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.showNotification('تم حذف النسخة الاحتياطية بنجاح', 'success');
                    this.loadBackupHistory();
                } else {
                    this.showNotification('فشل في حذف النسخة الاحتياطية', 'error');
                }
            } catch (error) {
                console.error('خطأ في حذف النسخة الاحتياطية:', error);
                this.showNotification('حدث خطأ في حذف النسخة الاحتياطية', 'error');
            }
        }

        /**
         * معالجة رفع الملفات
         */
        async handleFileUpload(files, container) {
            const formData = new FormData();
            
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            
            formData.append('action', 'muhtawaa_upload_files');
            formData.append('nonce', muhtawaaData.nonce);
            
            try {
                container.addClass('uploading');
                
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false
                });
                
                if (response.success) {
                    this.showNotification('تم رفع الملفات بنجاح', 'success');
                    
                    // تحديث العرض
                    if (response.data.uploaded_files) {
                        this.displayUploadedFiles(response.data.uploaded_files, container);
                    }
                } else {
                    this.showNotification('فشل في رفع الملفات', 'error');
                }
            } catch (error) {
                console.error('خطأ في رفع الملفات:', error);
                this.showNotification('حدث خطأ في رفع الملفات', 'error');
            } finally {
                container.removeClass('uploading');
            }
        }

        /**
         * عرض الملفات المرفوعة
         */
        displayUploadedFiles(files, container) {
            let filesList = container.find('.uploaded-files-list');
            
            if (!filesList.length) {
                filesList = $('<div class="uploaded-files-list"></div>');
                container.append(filesList);
            }
            
            files.forEach(file => {
                const fileItem = $(`
                    <div class="uploaded-file-item">
                        <div class="file-icon">
                            <i class="dashicons dashicons-media-default"></i>
                        </div>
                        <div class="file-info">
                            <div class="file-name">${file.name}</div>
                            <div class="file-size">${this.formatBytes(file.size)}</div>
                        </div>
                        <div class="file-actions">
                            <button class="button button-small copy-file-url" data-url="${file.url}">
                                <i class="dashicons dashicons-admin-links"></i> نسخ الرابط
                            </button>
                        </div>
                    </div>
                `);
                
                filesList.append(fileItem);
            });
        }

        /**
         * تعيين إشعار كمقروء
         */
        async markNotificationRead(notificationId) {
            try {
                await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_mark_notification_read',
                        notification_id: notificationId,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                // تحديث العرض
                $(`.notification-item[data-id="${notificationId}"]`).addClass('read').removeClass('unread');
                $(`.notification-item[data-id="${notificationId}"] .mark-read`).remove();
                
                // تحديث العداد
                this.updateNotificationCount();
                
            } catch (error) {
                console.error('خطأ في تعيين الإشعار كمقروء:', error);
            }
        }

        /**
         * إغلاق إشعار
         */
        async dismissNotification(notificationId) {
            try {
                await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_dismiss_notification',
                        notification_id: notificationId,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                // إزالة الإشعار من العرض
                $(`.notification-item[data-id="${notificationId}"]`).fadeOut(300, function() {
                    $(this).remove();
                });
                
                // تحديث العداد
                this.updateNotificationCount();
                
            } catch (error) {
                console.error('خطأ في إغلاق الإشعار:', error);
            }
        }

        /**
         * تحديث عداد الإشعارات
         */
        updateNotificationCount() {
            const unreadCount = $('.notification-item.unread').length;
            const countElement = $('.notification-count');
            
            countElement.text(unreadCount);
            
            if (unreadCount > 0) {
                countElement.addClass('has-notifications');
            } else {
                countElement.removeClass('has-notifications');
            }
        }

        /**
         * تعيين جميع الإشعارات كمقروءة
         */
        async markAllNotificationsRead() {
            try {
                await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_mark_all_notifications_read',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                // تحديث العرض
                $('.notification-item.unread').addClass('read').removeClass('unread');
                $('.notification-item .mark-read').remove();
                
                // تحديث العداد
                this.updateNotificationCount();
                
                this.showNotification('تم تعيين جميع الإشعارات كمقروءة', 'success', 2000);
                
            } catch (error) {
                console.error('خطأ في تعيين الإشعارات كمقروءة:', error);
                this.showNotification('حدث خطأ في تعيين الإشعارات', 'error');
            }
        }

        /**
         * API عامة للإدارة
         */
        
        /**
         * إضافة إشعار للنظام
         */
        addNotification(notification) {
            this.notifications.unshift(notification);
            this.displayNotifications(this.notifications);
        }

        /**
         * مسح جميع الإشعارات
         */
        clearNotifications() {
            this.notifications = [];
            this.displayNotifications([]);
        }

        /**
         * تحديث الرسوم البيانية
         */
        refreshCharts() {
            Object.values(this.charts).forEach(chart => {
                if (chart && typeof chart.update === 'function') {
                    chart.update();
                }
            });
        }

        /**
         * تصدير البيانات
         */
        async exportData(type) {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: `muhtawaa_export_${type}`,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    // تحميل الملف
                    const dataStr = JSON.stringify(response.data, null, 2);
                    const dataBlob = new Blob([dataStr], {type: 'application/json'});
                    const url = URL.createObjectURL(dataBlob);
                    
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = `muhtawaa-${type}-${new Date().toISOString().split('T')[0]}.json`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    URL.revokeObjectURL(url);
                    
                    this.showNotification(`تم تصدير ${type} بنجاح`, 'success');
                } else {
                    this.showNotification(`فشل في تصدير ${type}`, 'error');
                }
            } catch (error) {
                console.error('خطأ في تصدير البيانات:', error);
                this.showNotification('فشل في تصدير البيانات', 'error');
            }
        }

        /**
         * إعادة تحميل البيانات
         */
        reloadData() {
            // إعادة تحميل البيانات المختلفة
            if ($('.muhtawaa-analytics-page').length) {
                this.loadAnalyticsData();
            }
            
            if ($('.muhtawaa-security-page').length) {
                this.loadSecurityStatus();
            }
            
            if ($('.muhtawaa-performance-page').length) {
                this.loadPerformanceData();
            }
            
            if ($('.muhtawaa-backup-page').length) {
                this.loadBackupHistory();
            }
            
            if ($('#muhtawaa-dashboard-widget').length) {
                this.loadDashboardStats();
            }
            
            this.loadNotifications();
        }

        /**
         * تنظيف الموارد
         */
        cleanup() {
            // مسح المؤقتات
            if (this.autoSaveTimer) {
                clearTimeout(this.autoSaveTimer);
            }
            
            // تدمير الرسوم البيانية
            Object.values(this.charts).forEach(chart => {
                if (chart && typeof chart.destroy === 'function') {
                    chart.destroy();
                }
            });
            
            // إزالة مستمعي الأحداث
            $(document).off('.muhtawaa-admin');
            $(window).off('.muhtawaa-admin');
        }
    }

    /**
     * تهيئة النظام عند تحميل الصفحة
     */
    $(document).ready(function() {
        // التحقق من صفحة الإدارة
        if ($('body').hasClass('wp-admin')) {
            window.MuhtawaaAdmin = new MuhtawaaAdmin();
            
            // إتاحة API للاستخدام الخارجي
            window.muhtawaaAdmin = {
                showNotification: (message, type, duration) => window.MuhtawaaAdmin.showNotification(message, type, duration),
                addNotification: (notification) => window.MuhtawaaAdmin.addNotification(notification),
                exportData: (type) => window.MuhtawaaAdmin.exportData(type),
                refreshCharts: () => window.MuhtawaaAdmin.refreshCharts(),
                reloadData: () => window.MuhtawaaAdmin.reloadData(),
                cleanup: () => window.MuhtawaaAdmin.cleanup()
            };
            
            // تنظيف الموارد عند مغادرة الصفحة
            $(window).on('beforeunload', () => {
                if (window.MuhtawaaAdmin) {
                    window.MuhtawaaAdmin.cleanup();
                }
            });
        }
    });

})(jQuery);/**
 * ملف لوحة الإدارة المتقدمة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة لوحة الإدارة المتقدمة
     */
    class MuhtawaaAdmin {
        constructor() {
            this.charts = {};
            this.notifications = [];
            this.autoSaveTimer = null;
            this.analyticsData = {};
            this.isLoading = false;
            
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة النظام
         */
        init() {
            if (!this.isAdminPage()) return;
            
            this.initDashboard();
            this.initThemeSettings();
            this.initPostEditor();
            this.initMediaLibrary();
            this.initUserInterface();
            this.initAnalytics();
            this.initSecurity();
            this.initPerformance();
            this.initBackup();
            this.initNotifications();
            this.initAutoSave();
            this.initShortcuts();
            this.initColorScheme();
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // أحداث لوحة التحكم
            $(document).on('click', '.muhtawaa-admin-tab', this.handleTabSwitch.bind(this));
            $(document).on('click', '.muhtawaa-toggle-section', this.handleSectionToggle.bind(this));
            
            // أحداث الإعدادات
            $(document).on('change', '.muhtawaa-setting-field', this.handleSettingChange.bind(this));
            $(document).on('click', '.muhtawaa-reset-settings', this.handleSettingsReset.bind(this));
            $(document).on('click', '.muhtawaa-save-settings', this.handleSettingsSave.bind(this));
            
            // أحداث المحرر
            $(document).on('input', '.muhtawaa-editor-field', this.handleEditorChange.bind(this));
            $(document).on('click', '.muhtawaa-insert-shortcode', this.handleShortcodeInsert.bind(this));
            
            // أحداث الإحصائيات
            $(document).on('click', '.muhtawaa-refresh-stats', this.handleStatsRefresh.bind(this));
            $(document).on('change', '.muhtawaa-stats-period', this.handleStatsPeriodChange.bind(this));
            
            // أحداث الأمان
            $(document).on('click', '.muhtawaa-security-scan', this.handleSecurityScan.bind(this));
            $(document).on('click', '.muhtawaa-clear-logs', this.handleClearLogs.bind(this));
            
            // أحداث النسخ الاحتياطي
            $(document).on('click', '.muhtawaa-create-backup', this.handleCreateBackup.bind(this));
            $(document).on('click', '.muhtawaa-restore-backup', this.handleRestoreBackup.bind(this));
            $(document).on('click', '.muhtawaa-delete-backup', this.handleDeleteBackup.bind(this));
            
            // أحداث عامة
            $(document).on('muhtawaa:admin-notification', this.handleNotification.bind(this));
            $(window).on('beforeunload', this.handleBeforeUnload.bind(this));
            
            // أحداث الإشعارات
            $(document).on('click', '.notifications-toggle', this.handleNotificationsToggle.bind(this));
            $(document).on('click', '.mark-all-read', this.markAllNotificationsRead.bind(this));
            $(document).on('click', '.mark-read', this.handleMarkNotificationRead.bind(this));
            $(document).on('click', '.dismiss-notification', this.handleDismissNotification.bind(this));
        }

        /**
         * تهيئة لوحة التحكم
         */
        initDashboard() {
            // إنشاء لوحة التحكم المخصصة
            const dashboardWidget = `
                <div id="muhtawaa-dashboard-widget" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>إحصائيات قالب محتوى</span>
                        </h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">تبديل لوحة: إحصائيات قالب محتوى</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="inside">
                        <div class="muhtawaa-dashboard-stats">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-edit-page"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-posts">-</span>
                                    <span class="stat-label">إجمالي المقالات</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-visibility"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-views">-</span>
                                    <span class="stat-label">المشاهدات الشهرية</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-admin-comments"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="total-comments">-</span>
                                    <span class="stat-label">التعليقات</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="dashicons dashicons-performance"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-number" id="performance-score">-</span>
                                    <span class="stat-label">نقاط الأداء</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="muhtawaa-charts-container">
                            <div class="chart-wrapper">
                                <canvas id="views-chart" width="400" height="200"></canvas>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="posts-chart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        
                        <div class="muhtawaa-quick-actions">
                            <a href="admin.php?page=muhtawaa-settings" class="button button-primary muhtawaa-theme-settings">
                                <i class="dashicons dashicons-admin-generic"></i>
                                إعدادات القالب
                            </a>
                            <button class="button muhtawaa-performance-check" data-action="performance-check">
                                <i class="dashicons dashicons-performance"></i>
                                فحص الأداء
                            </button>
                            <button class="button muhtawaa-security-check" data-action="security-scan">
                                <i class="dashicons dashicons-shield"></i>
                                فحص الأمان
                            </button>
                            <button class="button muhtawaa-backup-now" data-action="backup-now">
                                <i class="dashicons dashicons-backup"></i>
                                نسخة احتياطية
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // إضافة الويدجت للوحة التحكم
            if ($('#dashboard-widgets-wrap').length) {
                $('#normal-sortables').prepend(dashboardWidget);
                this.loadDashboardStats();
            }
        }

        /**
         * تحميل إحصائيات لوحة التحكم
         */
        async loadDashboardStats() {
            if (this.isLoading) return;
            this.isLoading = true;
            
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_dashboard_stats',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    const stats = response.data;
                    
                    // تحديث الإحصائيات بحركة متدرجة
                    this.animateNumber('#total-posts', 0, stats.total_posts || 0, 1000);
                    this.animateNumber('#total-views', 0, stats.total_views || 0, 1500);
                    this.animateNumber('#total-comments', 0, stats.total_comments || 0, 1200);
                    this.animateNumber('#performance-score', 0, stats.performance_score || 0, 2000, '%');
                    
                    // تحديث الرسوم البيانية
                    setTimeout(() => {
                        this.updateDashboardCharts(stats);
                    }, 500);
                }
            } catch (error) {
                console.error('خطأ في تحميل إحصائيات لوحة التحكم:', error);
                this.showNotification('فشل في تحميل الإحصائيات', 'error');
            } finally {
                this.isLoading = false;
            }
        }

        /**
         * تحريك الأرقام تدريجياً
         */
        animateNumber(selector, start, end, duration, suffix = '') {
            const element = $(selector);
            const startTime = performance.now();
            
            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // تطبيق دالة تسارع
                const easedProgress = this.easeOutQuart(progress);
                const current = Math.floor(start + (end - start) * easedProgress);
                
                element.text(this.formatNumber(current) + suffix);
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };
            
            requestAnimationFrame(animate);
        }

        /**
         * دالة تسارع
         */
        easeOutQuart(t) {
            return 1 - (--t) * t * t * t;
        }

        /**
         * تحديث الرسوم البيانية
         */
        updateDashboardCharts(stats) {
            // رسم بياني للمشاهدات
            if (stats.views_chart_data && typeof Chart !== 'undefined') {
                this.createChart('views-chart', 'line', stats.views_chart_data, {
                    title: 'المشاهدات اليومية',
                    color: '#007cba',
                    borderColor: '#007cba',
                    backgroundColor: 'rgba(0, 124, 186, 0.1)'
                });
            }
            
            // رسم بياني للمقالات
            if (stats.posts_chart_data && typeof Chart !== 'undefined') {
                this.createChart('posts-chart', 'bar', stats.posts_chart_data, {
                    title: 'المقالات الشهرية',
                    color: '#00a32a',
                    borderColor: '#00a32a',
                    backgroundColor: 'rgba(0, 163, 42, 0.8)'
                });
            }
        }

        /**
         * إنشاء رسم بياني
         */
        createChart(elementId, type, data, options = {}) {
            const canvas = document.getElementById(elementId);
            if (!canvas || typeof Chart === 'undefined') return;
            
            const ctx = canvas.getContext('2d');
            
            // مسح الرسم السابق
            if (this.charts[elementId]) {
                this.charts[elementId].destroy();
            }
            
            // إعداد البيانات
            const chartData = {
                labels: data.labels || [],
                datasets: [{
                    label: options.title || '',
                    data: data.values || [],
                    borderColor: options.borderColor || options.color || '#007cba',
                    backgroundColor: options.backgroundColor || 'rgba(0, 124, 186, 0.1)',
                    borderWidth: 2,
                    fill: type === 'line',
                    tension: 0.4
                }]
            };
            
            // إنشاء رسم جديد
            this.charts[elementId] = new Chart(ctx, {
                type: type,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: options.title || '',
                            font: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif',
                                size: 14,
                                weight: 'bold'
                            },
                            color: '#1d2327'
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                            },
                            bodyFont: {
                                family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                            },
                            rtl: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                font: {
                                    family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                                },
                                color: '#646970'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                font: {
                                    family: 'Cairo, -apple-system, BlinkMacSystemFont, sans-serif'
                                },
                                color: '#646970'
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }

        /**
         * تهيئة إعدادات القالب
         */
        initThemeSettings() {
            // إنشاء صفحة إعدادات القالب
            if ($('.muhtawaa-theme-settings-page').length) {
                this.setupColorPicker();
                this.setupFontSelector();
                this.setupLayoutOptions();
                this.setupCustomCSS();
                this.setupImportExport();
                this.setupLivePreview();
            }
        }

        /**
         * إعداد منتقي الألوان
         */
        setupColorPicker() {
            $('.muhtawaa-color-picker').each(function() {
                const picker = $(this);
                
                if (typeof picker.wpColorPicker === 'function') {
                    picker.wpColorPicker({
                        change: function(event, ui) {
                            const color = ui.color.toString();
                            const setting = picker.data('setting');
                            
                            // تحديث المعاينة المباشرة
                            if (setting) {
                                $('body').trigger('muhtawaa:color-changed', [setting, color]);
                            }
                        },
                        clear: function() {
                            const setting = picker.data('setting');
                            $('body').trigger('muhtawaa:color-cleared', [setting]);
                        }
                    });
                }
            });
        }

        /**
         * إعداد منتقي الخطوط
         */
        setupFontSelector() {
            $('.muhtawaa-font-selector').each(function() {
                const selector = $(this);
                
                if (typeof selector.select2 === 'function') {
                    selector.select2({
                        placeholder: 'اختر خط...',
                        dir: 'rtl',
                        width: '100%',
                        templateResult: function(font) {
                            if (!font.id) return font.text;
                            
                            return $(`<span style="font-family: ${font.id}">${font.text}</span>`);
                        },
                        templateSelection: function(font) {
                            if (!font.id) return font.text;
                            
                            return $(`<span style="font-family: ${font.id}">${font.text}</span>`);
                        }
                    });
                }
                
                selector.on('change', function() {
                    const font = $(this).val();
                    const setting = $(this).data('setting');
                    
                    if (setting && font) {
                        $('body').trigger('muhtawaa:font-changed', [setting, font]);
                    }
                });
            });
        }

        /**
         * إعداد خيارات التخطيط
         */
        setupLayoutOptions() {
            $('.muhtawaa-layout-option').on('click', function() {
                const option = $(this);
                const layout = option.data('layout');
                const group = option.data('group');
                
                // إزالة التحديد من الخيارات الأخرى في نفس المجموعة
                $(`.muhtawaa-layout-option[data-group="${group}"]`).removeClass('selected');
                
                // تحديد الخيار الحالي
                option.addClass('selected');
                
                // تحديث المعاينة
                $('body').trigger('muhtawaa:layout-changed', [group, layout]);
            });
        }

        /**
         * إعداد CSS المخصص
         */
        setupCustomCSS() {
            const cssEditor = $('.muhtawaa-custom-css-editor');
            
            if (cssEditor.length && typeof CodeMirror !== 'undefined') {
                const editor = CodeMirror.fromTextArea(cssEditor[0], {
                    mode: 'css',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 2,
                    tabSize: 2,
                    direction: 'ltr',
                    rtlMoveVisually: true
                });
                
                // حفظ تلقائي
                let saveTimeout;
                editor.on('change', function() {
                    clearTimeout(saveTimeout);
                    saveTimeout = setTimeout(() => {
                        $('body').trigger('muhtawaa:css-changed', [editor.getValue()]);
                    }, 1000);
                });
                
                // إضافة اختصارات لوحة المفاتيح
                editor.setOption('extraKeys', {
                    'Ctrl-S': function() {
                        $('body').trigger('muhtawaa:save-css', [editor.getValue()]);
                    },
                    'Ctrl-Z': function() {
                        editor.undo();
                    },
                    'Ctrl-Y': function() {
                        editor.redo();
                    },
                    'F11': function() {
                        // تبديل وضع ملء الشاشة
                        const wrapper = editor.getWrapperElement();
                        if (wrapper.classList.contains('CodeMirror-fullscreen')) {
                            wrapper.classList.remove('CodeMirror-fullscreen');
                        } else {
                            wrapper.classList.add('CodeMirror-fullscreen');
                        }
                        editor.refresh();
                    }
                });
                
                // حفظ مرجع المحرر
                this.cssEditor = editor;
            }
        }

        /**
         * إعداد الاستيراد والتصدير
         */
        setupImportExport() {
            // تصدير الإعدادات
            $('.muhtawaa-export-settings').on('click', async function(e) {
                e.preventDefault();
                
                const button = $(this);
                button.addClass('loading').text('جاري التصدير...');
                
                try {
                    const response = await $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'muhtawaa_export_settings',
                            nonce: muhtawaaData.nonce
                        }
                    });
                    
                    if (response.success) {
                        // تحميل ملف JSON
                        const dataStr = JSON.stringify(response.data, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = `muhtawaa-settings-${new Date().toISOString().split('T')[0]}.json`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        
                        URL.revokeObjectURL(url);
                        
                        window.MuhtawaaAdmin.showNotification('تم تصدير الإعدادات بنجاح', 'success');
                    }
                } catch (error) {
                    console.error('خطأ في تصدير الإعدادات:', error);
                    window.MuhtawaaAdmin.showNotification('حدث خطأ في تصدير الإعدادات', 'error');
                } finally {
                    button.removeClass('loading').text('تصدير الإعدادات');
                }
            });
            
            // استيراد الإعدادات
            $('.muhtawaa-import-settings').on('change', function() {
                const file = this.files[0];
                if (!file) return;
                
                const reader = new FileReader();
                reader.onload = async function(e) {
                    try {
                        const settings = JSON.parse(e.target.result);
                        
                        const response = await $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'muhtawaa_import_settings',
                                settings: JSON.stringify(settings),
                                nonce: muhtawaaData.nonce
                            }
                        });
                        
                        if (response.success) {
                            window.MuhtawaaAdmin.showNotification('تم استيراد الإعدادات بنجاح', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            window.MuhtawaaAdmin.showNotification('فشل في استيراد الإعدادات', 'error');
                        }
                    } catch (error) {
                        console.error('خطأ في استيراد الإعدادات:', error);
                        window.MuhtawaaAdmin.showNotification('ملف الإعدادات غير صحيح', 'error');
                    }
                };
                reader.readAsText(file);
            });
        }

        /**
         * إعداد المعاينة المباشرة
         */
        setupLivePreview() {
            // تحديث المعاينة عند تغيير الألوان
            $('body').on('muhtawaa:color-changed', (e, setting, color) => {
                this.updateLivePreview(setting, color);
            });
            
            // تحديث المعاينة عند تغيير الخطوط
            $('body').on('muhtawaa:font-changed', (e, setting, font) => {
                this.updateLivePreview(setting, font);
            });
        }

        /**
         * تحديث المعاينة المباشرة
         */
        updateLivePreview(setting, value) {
            const preview = $('#live-preview-frame');
            if (preview.length) {
                const previewDoc = preview.contents();
                
                switch(setting) {
                    case 'primary_color':
                        previewDoc.find('body').css('--primary-color', value);
                        break;
                    case 'secondary_color':
                        previewDoc.find('body').css('--secondary-color', value);
                        break;
                    case 'body_font':
                        previewDoc.find('body').css('font-family', value);
                        break;
                    case 'heading_font':
                        previewDoc.find('h1, h2, h3, h4, h5, h6').css('font-family', value);
                        break;
                }
            }
        }

        /**
         * تهيئة محرر المقالات
         */
        initPostEditor() {
            if (!$('#post').length) return;
            
            this.setupMetaBoxes();
            this.setupShortcodeButtons();
            this.setupImageOptimization();
            this.setupSEOHelper();
            this.setupReadabilityChecker();
            this.setupAutoSave();
        }

        /**
         * إعداد صناديق البيانات الوصفية
         */
        setupMetaBoxes() {
            // صندوق إعدادات المقال
            const postSettingsBox = `
                <div id="muhtawaa-post-settings" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>إعدادات المقال المتقدمة</span>
                        </h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">تبديل لوحة: إعدادات المقال المتقدمة</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="inside">
                        <table class="form-table">
                            <tr>
                                <th><label for="muhtawaa_featured_video">فيديو مميز</label></th>
                                <td>
                                    <input type="url" id="muhtawaa_featured_video" name="muhtawaa_featured_video" class="widefat" placeholder="رابط الفيديو (YouTube, Vimeo)">
                                    <p class="description">سيتم عرض الفيديو في أعلى المقال</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_reading_time">وقت القراءة</label></th>
                                <td>
                                    <input type="number" id="muhtawaa_reading_time" name="muhtawaa_reading_time" min="1" max="999" placeholder="بالدقائق">
                                    <p class="description">سيتم حسابه تلقائياً إذا ترك فارغاً</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_difficulty_level">مستوى الصعوبة</label></th>
                                <td>
                                    <select id="muhtawaa_difficulty_level" name="muhtawaa_difficulty_level">
                                        <option value="">اختر المستوى</option>
                                        <option value="beginner">مبتدئ</option>
                                        <option value="intermediate">متوسط</option>
                                        <option value="advanced">متقدم</option>
                                        <option value="expert">خبير</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_custom_css">CSS مخصص للمقال</label></th>
                                <td>
                                    <textarea id="muhtawaa_custom_css" name="muhtawaa_custom_css" rows="5" class="widefat" placeholder="/* CSS مخصص لهذا المقال فقط */"></textarea>
                                    <p class="description">سيتم تطبيق هذا CSS على هذا المقال فقط</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="muhtawaa_hide_sidebar">إخفاء الشريط الجانبي</label></th>
                                <td>
                                    <label>
                                        <input type="checkbox" id="muhtawaa_hide_sidebar" name="muhtawaa_hide_sidebar" value="1">
                                        إخفاء الشريط الجانبي في هذا المقال
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            `;
            
            if ($('#normal-sortables').length) {
                $('#normal-sortables').append(postSettingsBox);
            }
        }

        /**
         * إعداد أزرار الاختصارات
         */
        setupShortcodeButtons() {
            const shortcodePanel = `
                <div id="muhtawaa-shortcodes-panel" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">
                            <span>اختصارات قالب محتوى</span>
                        </h2>
                    </div>
                    <div class="inside">
                        <div class="muhtawaa-shortcode-buttons">
                            <div class="shortcode-group">
                                <h4>المحتوى</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="alert">
                                    <i class="dashicons dashicons-warning"></i> تنبيه
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="highlight">
                                    <i class="dashicons dashicons-edit"></i> تمييز
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="quote">
                                    <i class="dashicons dashicons-format-quote"></i> اقتباس
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>التفاعل</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="button">
                                    <i class="dashicons dashicons-button"></i> زر
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="download">
                                    <i class="dashicons dashicons-download"></i> تحميل
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="contact">
                                    <i class="dashicons dashicons-email"></i> نموذج اتصال
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>التخطيط</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="columns">
                                    <i class="dashicons dashicons-columns"></i> أعمدة
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="tabs">
                                    <i class="dashicons dashicons-index-card"></i> تبويبات
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="accordion">
                                    <i class="dashicons dashicons-list-view"></i> أكورديون
                                </button>
                            </div>
                            <div class="shortcode-group">
                                <h4>الوسائط</h4>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="gallery">
                                    <i class="dashicons dashicons-format-gallery"></i> معرض
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="video">
                                    <i class="dashicons dashicons-format-video"></i> فيديو
                                </button>
                                <button type="button" class="button muhtawaa-insert-shortcode" data-shortcode="audio">
                                    <i class="dashicons dashicons-format-audio"></i> صوت
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if ($('#side-sortables').length) {
                $('#side-sortables').append(shortcodePanel);
            }
        }

        /**
         * تهيئة مكتبة الوسائط
         */
        initMediaLibrary() {
            // تحسين رفع الصور
            if (typeof wp !== 'undefined' && wp.media) {
                const originalFrame = wp.media.view.MediaFrame.Post;
                
                wp.media.view.MediaFrame.Post = originalFrame.extend({
                    initialize: function() {
                        originalFrame.prototype.initialize.apply(this, arguments);
                        this.on('insert', this.onInsert, this);
                    },
                    
                    onInsert: function() {
                        // تحسين الصور المرفوعة تلقائياً
                        setTimeout(() => {
                            this.optimizeUploadedImages();
                        }, 1000);
                    },
                    
                    optimizeUploadedImages: function() {
                        // تشغيل تحسين الصور في الخلفية
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'muhtawaa_optimize_images',
                                nonce: muhtawaaData.nonce
                            }
                        });
                    }
                });
            }
        }

        /**
         * تهيئة واجهة المستخدم
         */
        initUserInterface() {
            this.enhanceAdminMenus();
            this.addQuickActions();
            this.improveNotifications();
            this.addKeyboardShortcuts();
            this.setupDragAndDrop();
        }

        /**
         * تحسين قوائم الإدارة
         */
        enhanceAdminMenus() {
            // إضافة أيقونات للقوائم
            const menuIcons = {
                'muhtawaa-settings': 'dashicons-admin-generic',
                'muhtawaa-analytics': 'dashicons-chart-area',
                'muhtawaa-security': 'dashicons-shield',
                'muhtawaa-performance': 'dashicons-performance',
                'muhtawaa-backup': 'dashicons-backup'
            };
            
            Object.keys(menuIcons).forEach(menuId => {
                const menuItem = $(`#menu-${menuId}`);
                if (menuItem.length) {
                    menuItem.find('.wp-menu-image').addClass(menuIcons[menuId]);
                }
            });
            
            // إضافة عدادات للقوائم
            this.updateMenuCounters();
        }

        /**
         * تحديث عدادات القوائم
         */
        async updateMenuCounters() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_menu_counters',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    const counters = response.data;
                    
                    // تحديث عدادات مختلفة
                    if (counters.pending_comments > 0) {
                        $('#menu-comments .wp-menu-name').append(`<span class="update-plugins count-${counters.pending_comments}"><span class="update-count">${counters.pending_comments}</span></span>`);
                    }
                    
                    if (counters.security_issues > 0) {
                        $('#menu-muhtawaa-security .wp-menu-name').append(`<span class="update-plugins count-${counters.security_issues}"><span class="update-count">${counters.security_issues}</span></span>`);
                    }
                    
                    if (counters.updates_available > 0) {
                        $('#menu-plugins .wp-menu-name').append(`<span class="update-plugins count-${counters.updates_available}"><span class="update-count">${counters.updates_available}</span></span>`);
                    }
                }
            } catch (error) {
                console.error('خطأ في تحديث عدادات القوائم:', error);
            }
        }

        /**
         * إضافة إجراءات سريعة
         */
        addQuickActions() {
            // شريط إجراءات سريع
            const quickActionsBar = `
                <div id="muhtawaa-quick-actions" class="muhtawaa-quick-bar">
                    <div class="quick-actions-container">
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="clear-cache" title="مسح التخزين المؤقت">
                                <i class="dashicons dashicons-update"></i>
                                <span>مسح التخزين المؤقت</span>
                            </button>
                            <button type="button" class="quick-action" data-action="optimize-db" title="تحسين قاعدة البيانات">
                                <i class="dashicons dashicons-database"></i>
                                <span>تحسين قاعدة البيانات</span>
                            </button>
                        </div>
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="security-scan" title="فحص أمني سريع">
                                <i class="dashicons dashicons-shield"></i>
                                <span>فحص أمني</span>
                            </button>
                            <button type="button" class="quick-action" data-action="backup-now" title="إنشاء نسخة احتياطية">
                                <i class="dashicons dashicons-backup"></i>
                                <span>نسخة احتياطية</span>
                            </button>
                        </div>
                        <div class="quick-action-group">
                            <button type="button" class="quick-action" data-action="check-updates" title="فحص التحديثات">
                                <i class="dashicons dashicons-update"></i>
                                <span>فحص التحديثات</span>
                            </button>
                            <button type="button" class="quick-action" data-action="health-check" title="فحص صحة الموقع">
                                <i class="dashicons dashicons-heart"></i>
                                <span>فحص الصحة</span>
                            </button>
                        </div>
                    </div>
                    <div class="quick-actions-toggle">
                        <button type="button" class="toggle-quick-actions" title="إظهار/إخفاء الإجراءات السريعة">
                            <i class="dashicons dashicons-arrow-up-alt2"></i>
                        </button>
                    </div>
                </div>
            `;
            
            if ($('#wpbody-content').length) {
                $('#wpbody-content').prepend(quickActionsBar);
                
                // معالج تبديل إظهار الشريط
                $('.toggle-quick-actions').on('click', function() {
                    const bar = $('#muhtawaa-quick-actions');
                    const icon = $(this).find('i');
                    
                    bar.toggleClass('collapsed');
                    
                    if (bar.hasClass('collapsed')) {
                        icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
                    } else {
                        icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                    }
                });
                
                // معالج الإجراءات السريعة
                $('.quick-action').on('click', this.handleQuickAction.bind(this));
            }
        }

        /**
         * تحسين الإشعارات
         */
        improveNotifications() {
            // استبدال إشعارات ووردبريس الافتراضية
            $('.notice').each(function() {
                const notice = $(this);
                const type = notice.hasClass('notice-error') ? 'error' : 
                           notice.hasClass('notice-warning') ? 'warning' : 
                           notice.hasClass('notice-success') ? 'success' : 'info';
                
                notice.addClass(`muhtawaa-notice muhtawaa-notice-${type}`);
                
                // إضافة أيقونة
                const icon = notice.find('.dashicons').first();
                if (!icon.length) {
                    const iconClass = type === 'error' ? 'dashicons-dismiss' :
                                    type === 'warning' ? 'dashicons-warning' :
                                    type === 'success' ? 'dashicons-yes-alt' : 'dashicons-info';
                    
                    notice.prepend(`<i class="dashicons ${iconClass}"></i>`);
                }
                
                // إضافة زر إغلاق
                if (!notice.find('.notice-dismiss').length && !notice.hasClass('notice-alt')) {
                    notice.append('<button type="button" class="notice-dismiss"><span class="screen-reader-text">إغلاق هذا الإشعار</span></button>');
                }
            });
        }

        /**
         * تهيئة التحليلات
         */
        initAnalytics() {
            if (!$('.muhtawaa-analytics-page').length) return;
            
            this.loadAnalyticsData();
            this.setupAnalyticsCharts();
            this.setupAnalyticsFilters();
            this.setupRealTimeStats();
        }

        /**
         * تحميل بيانات التحليلات
         */
        async loadAnalyticsData() {
            const period = $('.muhtawaa-stats-period').val() || '7days';
            
            try {
                this.showAnalyticsLoader(true);
                
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_analytics',
                        period: period,
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.analyticsData = response.data;
                    this.updateAnalyticsDisplay();
                }
            } catch (error) {
                console.error('خطأ في تحميل بيانات التحليلات:', error);
                this.showNotification('فشل في تحميل بيانات التحليلات', 'error');
            } finally {
                this.showAnalyticsLoader(false);
            }
        }

        /**
         * إظهار/إخفاء مُحمل التحليلات
         */
        showAnalyticsLoader(show) {
            const loader = $('.analytics-loader');
            if (show) {
                if (!loader.length) {
                    $('.muhtawaa-analytics-page').append('<div class="analytics-loader"><div class="loader-spinner"></div><p>جاري تحميل البيانات...</p></div>');
                }
                $('.analytics-loader').show();
            } else {
                loader.hide();
            }
        }

        /**
         * تحديث عرض التحليلات
         */
        updateAnalyticsDisplay() {
            const data = this.analyticsData;
            
            // تحديث الإحصائيات الرئيسية مع الحركة
            this.animateNumber('.total-pageviews', 0, data.total_pageviews || 0, 1500);
            this.animateNumber('.unique-visitors', 0, data.unique_visitors || 0, 1800);
            $('.bounce-rate').text((data.bounce_rate || 0) + '%');
            $('.avg-session-duration').text(this.formatDuration(data.avg_session_duration || 0));
            
            // تحديث النمو/التراجع
            this.updateGrowthIndicators(data);
            
            // تحديث الرسوم البيانية
            if (data.pageviews_chart && typeof Chart !== 'undefined') {
                this.createChart('pageviews-chart', 'line', data.pageviews_chart, {
                    title: 'المشاهدات اليومية',
                    color: '#007cba'
                });
            }
            
            if (data.top_pages) {
                this.updateTopPagesTable(data.top_pages);
            }
            
            if (data.traffic_sources && typeof Chart !== 'undefined') {
                this.createChart('traffic-sources-chart', 'doughnut', data.traffic_sources, {
                    title: 'مصادر الزيارات'
                });
            }
            
            if (data.device_breakdown && typeof Chart !== 'undefined') {
                this.createChart('devices-chart', 'pie', data.device_breakdown, {
                    title: 'أنواع الأجهزة'
                });
            }
        }

        /**
         * تحديث مؤشرات النمو
         */
        updateGrowthIndicators(data) {
            $('.growth-indicator').each(function() {
                const indicator = $(this);
                const metric = indicator.data('metric');
                const growth = data.growth && data.growth[metric] ? data.growth[metric] : 0;
                
                indicator.removeClass('positive negative neutral');
                
                if (growth > 0) {
                    indicator.addClass('positive');
                    indicator.html(`<i class="dashicons dashicons-arrow-up-alt"></i> +${growth}%`);
                } else if (growth < 0) {
                    indicator.addClass('negative');
                    indicator.html(`<i class="dashicons dashicons-arrow-down-alt"></i> ${growth}%`);
                } else {
                    indicator.addClass('neutral');
                    indicator.html(`<i class="dashicons dashicons-minus"></i> 0%`);
                }
            });
        }

        /**
         * تحديث جدول الصفحات الأكثر زيارة
         */
        updateTopPagesTable(pages) {
            const tbody = $('.top-pages-table tbody');
            tbody.empty();
            
            if (pages && pages.length > 0) {
                pages.forEach((page, index) => {
                    const row = `
                        <tr>
                            <td class="rank">${index + 1}</td>
                            <td class="page-title">
                                <a href="${page.url}" target="_blank" title="عرض الصفحة">
                                    ${page.title}
                                </a>
                                <div class="page-url">${page.url}</div>
                            </td>
                            <td class="pageviews">${this.formatNumber(page.pageviews)}</td>
                            <td class="unique-pageviews">${this.formatNumber(page.unique_pageviews)}</td>
                            <td class="bounce-rate">${page.bounce_rate}%</td>
                            <td class="avg-time">${this.formatDuration(page.avg_time_on_page)}</td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                tbody.append('<tr><td colspan="6" class="no-data">لا توجد بيانات متاحة</td></tr>');
            }
        }

        /**
         * تهيئة الأمان
         */
        initSecurity() {
            if (!$('.muhtawaa-security-page').length) return;
            
            this.loadSecurityStatus();
            this.setupSecurityScanner();
            this.setupLoginProtection();
            this.setupSecuritySettings();
        }

        /**
         * تحميل حالة الأمان
         */
        async loadSecurityStatus() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_security_status',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.updateSecurityDisplay(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل حالة الأمان:', error);
                this.showNotification('فشل في تحميل حالة الأمان', 'error');
            }
        }

        /**
         * تحديث عرض الأمان
         */
        updateSecurityDisplay(data) {
            // نقاط الأمان مع حركة تدريجية
            this.animateNumber('.security-score', 0, data.security_score || 0, 2000, '%');
            
            // شريط النقاط مع حركة
            $('.security-score-bar').animate({
                width: (data.security_score || 0) + '%'
            }, 1500);
            
            // تحديث لون الشريط حسب النقاط
            const scoreBar = $('.security-score-bar');
            scoreBar.removeClass('low medium high');
            
            if (data.security_score >= 80) {
                scoreBar.addClass('high');
            } else if (data.security_score >= 60) {
                scoreBar.addClass('medium');
            } else {
                scoreBar.addClass('low');
            }
            
            // التهديدات المكتشفة
            $('.threats-detected').text(data.threats_detected || 0);
            
            // آخر فحص
            $('.last-scan-date').text(data.last_scan_date || 'لم يتم الفحص بعد');
            
            // حالة الحماية
            $('.protection-status').text(data.protection_enabled ? 'مفعلة' : 'معطلة');
            $('.protection-status').removeClass('enabled disabled').addClass(data.protection_enabled ? 'enabled' : 'disabled');
            
            // التوصيات
            this.updateSecurityRecommendations(data.recommendations || []);
            
            // السجلات الأمنية
            this.updateSecurityLogs(data.recent_logs || []);
        }

        /**
         * تحديث التوصيات الأمنية
         */
        updateSecurityRecommendations(recommendations) {
            const recommendationsList = $('.security-recommendations');
            recommendationsList.empty();
            
            if (recommendations.length > 0) {
                recommendations.forEach(recommendation => {
                    const priority = recommendation.priority || 'medium';
                    const item = `
                        <li class="recommendation-item priority-${priority}">
                            <div class="recommendation-icon">
                                <i class="dashicons dashicons-${recommendation.icon || 'warning'}"></i>
                            </div>
                            <div class="recommendation-content">
                                <h4>${recommendation.title}</h4>
                                <p>${recommendation.message}</p>
                                ${recommendation.action ? `<button class="button button-small security-action" data-action="${recommendation.action}">إصلاح</button>` : ''}
                            </div>
                            <div class="recommendation-priority">
                                <span class="priority-badge priority-${priority}">${this.getPriorityText(priority)}</span>
                            </div>
                        </li>
                    `;
                    recommendationsList.append(item);
                });
            } else {
                recommendationsList.append('<li class="no-recommendations">✅ لا توجد توصيات أمنية في الوقت الحالي. موقعك محمي بشكل جيد!</li>');
            }
        }

        /**
         * الحصول على نص الأولوية
         */
        getPriorityText(priority) {
            const priorities = {
                low: 'منخفضة',
                medium: 'متوسطة',
                high: 'عالية',
                critical: 'حرجة'
            };
            return priorities[priority] || 'متوسطة';
        }

        /**
         * تحديث السجلات الأمنية
         */
        updateSecurityLogs(logs) {
            const logsList = $('.security-logs-list');
            logsList.empty();
            
            if (logs.length > 0) {
                logs.forEach(log => {
                    const severity = log.severity || 'info';
                    const item = `
                        <div class="log-item severity-${severity}">
                            <div class="log-time">${log.time}</div>
                            <div class="log-content">
                                <div class="log-message">${log.message}</div>
                                <div class="log-details">${log.ip} - ${log.user_agent}</div>
                            </div>
                            <div class="log-severity">
                                <span class="severity-badge severity-${severity}">${this.getSeverityText(severity)}</span>
                            </div>
                        </div>
                    `;
                    logsList.append(item);
                });
            } else {
                logsList.append('<div class="no-logs">لا توجد سجلات أمنية حديثة</div>');
            }
        }

        /**
         * الحصول على نص الخطورة
         */
        getSeverityText(severity) {
            const severities = {
                info: 'معلومات',
                warning: 'تحذير',
                error: 'خطأ',
                critical: 'حرج'
            };
            return severities[severity] || 'معلومات';
        }

        /**
         * تهيئة الأداء
         */
        initPerformance() {
            if (!$('.muhtawaa-performance-page').length) return;
            
            this.loadPerformanceData();
            this.setupPerformanceOptimizer();
            this.setupPerformanceMonitoring();
        }

        /**
         * تحميل بيانات الأداء
         */
        async loadPerformanceData() {
            try {
                const response = await $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_get_performance_data',
                        nonce: muhtawaaData.nonce
                    }
                });
                
                if (response.success) {
                    this.updatePerformanceDisplay(response.data);
                }
            } catch (error) {
                console.error('خطأ في تحميل بيانات الأداء:', error);
                this.showNotification('فشل في تحميل بيانات الأداء', 'error');
            }
        }

        /**
         * تحديث عرض الأداء
         */
        updatePerformanceDisplay(data) {
            // نقاط الأداء مع حركة تدريجية
            this.animateNumber('.performance-score', 0, data.performance_score || 0, 2000, '%');
            
            // شريط الأداء
            $('.performance-score-bar').animate({
                width: (data.performance_score || 0) + '%'
            }, 1500);
            
            // تحديث لون الشريط حسب النقاط
            const scoreBar = $('.performance-score-bar');
            scoreBar.removeClass('poor average good excellent');
            
            if (data.performance_score >= 90) {
                scoreBar.addClass('excellent');
            } else if (data.performance_score >= 70) {
                scoreBar.addClass('good');
            } else if (data.performance_score >= 50) {
                scoreBar.addClass('average');
            } else {
                scoreBar.addClass('poor');
            }
            
            // البيانات التفصيلية
            $('.page-load-time').text((data.page_load_time || 0) + ' ثانية');
            $('.page-size').text(this.formatBytes(data.page_size || 0));
            $('.total-requests').text(data.total_requests || 0);
            $('.time-to-first-byte').text((data.ttfb || 0) + ' ms');
            $('.first-contentful-paint').text((data.fcp || 0) + ' ms');
            $('.largest-contentful-paint').text((data.lcp || 0) + ' ms');
            
            // تحسينات مقترحة
            this.updatePerformanceOptimizations(data.optimizations || []);
            
            // رسم بياني لأوقات التحميل
            if (data.load_times_chart && typeof Chart !== 'undefined') {
                this.createChart('load-times-chart', 'line', data.load_times_chart, {
                    title: 'أوقات التحميل (آخر 30 يوم)',
                    color: '#00a32a'
                });
            }
        }

        /**
         * تحديث تحسينات الأداء
         */
        updatePerformanceOptimizations(optimizations) {
            const optimizationsList = $('.performance-optimizations');
            optimizationsList.empty();
            
            if (optimizations.length > 0) {
                optimizations.forEach(optimization => {
                    const impact = optimization.impact || 'medium';
                    const item = `
                        <li class="optimization-item impact-${impact}">
                            <div class="optimization-icon">
                                <i class="dashicons dashicons-${optimization.icon || 'performance'}"></i>
                            </div>
                            <div class="optimization-content">
                                <h4>${optimization.title}</h4>
                                <p>${optimization.message}</p>
                                <div class="optimization-details">
                                    <span class="current-value">الحالي: ${optimization.current}</span>
                                    <span class="potential-savings">توفير محتمل: ${optimization.savings}</span>
                                </div>
                                ${optimization.action ? `<button class="button button-small optimization-action" data-action="${optimization.action}">تطبيق</button>` : ''}
                            </div>
                            <div class="optimization-impact">
                                <span class="impact-badge impact-${impact}">${this.getImpactText(impact)}</span>
                            </div>
                        </li>
                    `;
                    optimizationsList.append(item);
                });
            } else {
                optimizationsList.append('<li class="no-optimizations">🚀 الموقع محسن بالفعل! أداء ممتاز.</li>');
            }
        }

        /**
         * الحصول على نص التأثير
         */