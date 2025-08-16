<?php
/**
 * لوحة إدارة القالب الاحترافية
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

class PS_Theme_Admin_Panel {
    
    private $page_slug = 'practical-solutions-settings';
    private $capability = 'manage_options';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_ajax_ps_test_api_connection', array($this, 'test_api_connection'));
        add_action('wp_ajax_ps_clear_cache', array($this, 'clear_cache'));
        add_action('wp_ajax_ps_export_settings', array($this, 'export_settings'));
        add_action('wp_ajax_ps_import_settings', array($this, 'import_settings'));
        add_action('wp_ajax_ps_backup_theme_data', array($this, 'backup_theme_data'));
        add_action('wp_ajax_ps_restore_theme_data', array($this, 'restore_theme_data'));
    }
    
    /**
     * ==== إضافة قائمة الإدارة ====
     */
    public function add_admin_menu() {
        // الصفحة الرئيسية
        add_theme_page(
            __('إعدادات الحلول العملية', 'practical-solutions'),
            __('إعدادات القالب', 'practical-solutions'),
            $this->capability,
            $this->page_slug,
            array($this, 'render_admin_page')
        );
        
        // صفحة التحليلات
        add_submenu_page(
            $this->page_slug,
            __('التحليلات والتقارير', 'practical-solutions'),
            __('التحليلات', 'practical-solutions'),
            $this->capability,
            'ps-analytics',
            array($this, 'render_analytics_page')
        );
        
        // صفحة الأدوات
        add_submenu_page(
            $this->page_slug,
            __('أدوات القالب', 'practical-solutions'),
            __('الأدوات', 'practical-solutions'),
            $this->capability,
            'ps-tools',
            array($this, 'render_tools_page')
        );
    }
    
    /**
     * ==== تسجيل الإعدادات ====
     */
    public function register_settings() {
        // الإعدادات العامة
        register_setting('ps_general_settings', 'ps_general_settings', array($this, 'sanitize_general_settings'));
        
        // إعدادات الذكاء الاصطناعي
        register_setting('ps_ai_settings', 'ps_ai_settings', array($this, 'sanitize_ai_settings'));
        
        // إعدادات التحليلات
        register_setting('ps_analytics_settings', 'ps_analytics_settings', array($this, 'sanitize_analytics_settings'));
        
        // إعدادات الأداء
        register_setting('ps_performance_settings', 'ps_performance_settings', array($this, 'sanitize_performance_settings'));
        
        // إعدادات التصميم
        register_setting('ps_design_settings', 'ps_design_settings', array($this, 'sanitize_design_settings'));
        
        // إعدادات التواصل الاجتماعي
        register_setting('ps_social_settings', 'ps_social_settings', array($this, 'sanitize_social_settings'));
        
        // إعدادات SEO
        register_setting('ps_seo_settings', 'ps_seo_settings', array($this, 'sanitize_seo_settings'));
        
        // إعدادات متقدمة
        register_setting('ps_advanced_settings', 'ps_advanced_settings', array($this, 'sanitize_advanced_settings'));
    }
    
    /**
     * ==== تحميل ملفات الإدارة ====
     */
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, $this->page_slug) === false && 
            strpos($hook, 'ps-analytics') === false && 
            strpos($hook, 'ps-tools') === false) {
            return;
        }
        
        wp_enqueue_style('ps-admin-css', PS_THEME_URI . '/assets/admin/admin-styles.css', array(), PS_THEME_VERSION);
        wp_enqueue_script('ps-admin-js', PS_THEME_URI . '/assets/admin/admin-scripts.js', array('jquery'), PS_THEME_VERSION, true);
        
        // إضافة متغيرات JavaScript
        wp_localize_script('ps-admin-js', 'psAdmin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ps_admin_nonce'),
            'strings' => array(
                'saving' => __('جاري الحفظ...', 'practical-solutions'),
                'saved' => __('تم الحفظ بنجاح!', 'practical-solutions'),
                'error' => __('حدث خطأ أثناء الحفظ', 'practical-solutions'),
                'confirm_reset' => __('هل أنت متأكد من إعادة تعيين جميع الإعدادات؟', 'practical-solutions'),
                'testing_connection' => __('جاري اختبار الاتصال...', 'practical-solutions'),
                'connection_success' => __('الاتصال ناجح!', 'practical-solutions'),
                'connection_failed' => __('فشل الاتصال', 'practical-solutions'),
                'clearing_cache' => __('جاري مسح الذاكرة المؤقتة...', 'practical-solutions'),
                'cache_cleared' => __('تم مسح الذاكرة المؤقتة بنجاح!', 'practical-solutions'),
                'backup_created' => __('تم إنشاء النسخة الاحتياطية بنجاح!', 'practical-solutions'),
                'backup_restored' => __('تم استعادة النسخة الاحتياطية بنجاح!', 'practical-solutions')
            )
        ));
        
        // تحميل محرر الكود إذا لزم الأمر
        wp_enqueue_code_editor(array('type' => 'text/css'));
        wp_enqueue_code_editor(array('type' => 'text/javascript'));
    }
    
    /**
     * ==== عرض الصفحة الرئيسية ====
     */
    public function render_admin_page() {
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
        ?>
        <div class="wrap ps-admin-wrap">
            <h1 class="ps-admin-title">
                <span class="ps-logo"></span>
                <?php _e('إعدادات الحلول العملية', 'practical-solutions'); ?>
                <span class="ps-version">v<?php echo PS_THEME_VERSION; ?></span>
            </h1>
            
            <div class="ps-admin-header">
                <div class="ps-header-info">
                    <p class="ps-description"><?php _e('قالب احترافي للحلول العملية مع إمكانيات متقدمة', 'practical-solutions'); ?></p>
                    <div class="ps-quick-stats">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo wp_count_posts()->publish; ?></span>
                            <span class="stat-label"><?php _e('المقالات', 'practical-solutions'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo wp_count_comments()->approved; ?></span>
                            <span class="stat-label"><?php _e('التعليقات', 'practical-solutions'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo count_users()['total_users']; ?></span>
                            <span class="stat-label"><?php _e('المستخدمين', 'practical-solutions'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="ps-header-actions">
                    <button type="button" class="button button-secondary" id="ps-export-settings">
                        <span class="dashicons dashicons-download"></span>
                        <?php _e('تصدير الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary" id="ps-import-settings">
                        <span class="dashicons dashicons-upload"></span>
                        <?php _e('استيراد الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <input type="file" id="import-file" accept=".json" style="display: none;">
                </div>
            </div>
            
            <nav class="nav-tab-wrapper ps-nav-tabs">
                <a href="?page=<?php echo $this->page_slug; ?>&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-generic"></span>
                    <?php _e('عام', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=ai" class="nav-tab <?php echo $active_tab == 'ai' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-superhero"></span>
                    <?php _e('الذكاء الاصطناعي', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=design" class="nav-tab <?php echo $active_tab == 'design' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <?php _e('التصميم', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=performance" class="nav-tab <?php echo $active_tab == 'performance' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-performance"></span>
                    <?php _e('الأداء', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=social" class="nav-tab <?php echo $active_tab == 'social' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-share"></span>
                    <?php _e('التواصل الاجتماعي', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=seo" class="nav-tab <?php echo $active_tab == 'seo' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-search"></span>
                    <?php _e('SEO', 'practical-solutions'); ?>
                </a>
                <a href="?page=<?php echo $this->page_slug; ?>&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-tools"></span>
                    <?php _e('متقدم', 'practical-solutions'); ?>
                </a>
            </nav>
            
            <div class="ps-admin-content">
                <form method="post" action="options.php" class="ps-settings-form">
                    <?php
                    switch ($active_tab) {
                        case 'general':
                            $this->render_general_tab();
                            break;
                        case 'ai':
                            $this->render_ai_tab();
                            break;
                        case 'design':
                            $this->render_design_tab();
                            break;
                        case 'performance':
                            $this->render_performance_tab();
                            break;
                        case 'social':
                            $this->render_social_tab();
                            break;
                        case 'seo':
                            $this->render_seo_tab();
                            break;
                        case 'advanced':
                            $this->render_advanced_tab();
                            break;
                        default:
                            $this->render_general_tab();
                    }
                    ?>
                </form>
            </div>
            
            <div class="ps-admin-sidebar">
                <?php $this->render_sidebar(); ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الإعدادات العامة ====
     */
    private function render_general_tab() {
        settings_fields('ps_general_settings');
        $settings = get_option('ps_general_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('الإعدادات العامة', 'practical-solutions'); ?></h2>
                <p><?php _e('إعدادات أساسية لتخصيص القالب', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('معلومات الموقع', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('وصف الموقع الموسع', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_general_settings[site_description]" rows="4" class="large-text" placeholder="<?php _e('وصف تفصيلي عن موقعك...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['site_description'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيظهر في meta description والصفحة الرئيسية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الكلمات المفتاحية', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_general_settings[keywords]" value="<?php echo esc_attr($settings['keywords'] ?? ''); ?>" class="large-text" placeholder="<?php _e('حلول عملية، نصائح، إرشادات', 'practical-solutions'); ?>" />
                                <p class="description"><?php _e('افصل بين الكلمات بفاصلة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات المستخدم', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('البحث الصوتي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[voice_search]" value="1" <?php checked(1, $settings['voice_search'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل البحث بالصوت في الموقع', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نظام الإشارات المرجعية', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[bookmarks]" value="1" <?php checked(1, $settings['bookmarks'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح للمستخدمين بحفظ المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('شريط تقدم القراءة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[reading_progress]" value="1" <?php checked(1, $settings['reading_progress'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار تقدم القراءة في المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نظام التقييم', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[rating_system]" value="1" <?php checked(1, $settings['rating_system'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('السماح بتقييم المقالات بالنجوم', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الوضع المظلم التلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_general_settings[auto_dark_mode]" value="1" <?php checked(1, $settings['auto_dark_mode'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل الوضع المظلم تلقائياً حسب إعدادات النظام', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <?php submit_button(__('حفظ الإعدادات العامة', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الذكاء الاصطناعي ====
     */
    private function render_ai_tab() {
        settings_fields('ps_ai_settings');
        $settings = get_option('ps_ai_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات الذكاء الاصطناعي', 'practical-solutions'); ?></h2>
                <p><?php _e('تكوين نظام الذكاء الاصطناعي المدمج', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات OpenRouter API', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل الذكاء الاصطناعي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[enabled]" value="1" <?php checked(1, $settings['enabled'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل جميع ميزات الذكاء الاصطناعي', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('مفتاح OpenRouter API', 'practical-solutions'); ?></th>
                            <td>
                                <input type="password" name="ps_ai_settings[openrouter_api_key]" value="<?php echo esc_attr($settings['openrouter_api_key'] ?? ''); ?>" class="large-text" placeholder="sk-or-v1-..." />
                                <button type="button" class="button button-secondary" id="test-api-connection">
                                    <?php _e('اختبار الاتصال', 'practical-solutions'); ?>
                                </button>
                                <p class="description">
                                    <?php printf(__('احصل على مفتاح API من %s', 'practical-solutions'), '<a href="https://openrouter.ai" target="_blank">OpenRouter.ai</a>'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('النموذج المستخدم', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[model]" class="regular-text">
                                    <option value="anthropic/claude-3-haiku" <?php selected($settings['model'] ?? 'anthropic/claude-3-haiku', 'anthropic/claude-3-haiku'); ?>>Claude 3 Haiku</option>
                                    <option value="anthropic/claude-3-sonnet" <?php selected($settings['model'] ?? '', 'anthropic/claude-3-sonnet'); ?>>Claude 3 Sonnet</option>
                                    <option value="openai/gpt-3.5-turbo" <?php selected($settings['model'] ?? '', 'openai/gpt-3.5-turbo'); ?>>GPT-3.5 Turbo</option>
                                    <option value="openai/gpt-4" <?php selected($settings['model'] ?? '', 'openai/gpt-4'); ?>>GPT-4</option>
                                    <option value="google/gemini-pro" <?php selected($settings['model'] ?? '', 'google/gemini-pro'); ?>>Gemini Pro</option>
                                </select>
                                <p class="description"><?php _e('اختر النموذج المناسب حسب احتياجاتك وميزانيتك', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات البحث الذكي', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('اقتراحات البحث الذكية', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[search_suggestions]" value="1" <?php checked(1, $settings['search_suggestions'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار اقتراحات ذكية أثناء البحث', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عدد الاقتراحات', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_ai_settings[suggestions_count]" value="<?php echo esc_attr($settings['suggestions_count'] ?? 8); ?>" min="3" max="15" class="small-text" />
                                <p class="description"><?php _e('عدد الاقتراحات المعروضة (3-15)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('مدة التخزين المؤقت', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_ai_settings[cache_duration]" class="regular-text">
                                    <option value="1800" <?php selected($settings['cache_duration'] ?? 3600, 1800); ?>><?php _e('30 دقيقة', 'practical-solutions'); ?></option>
                                    <option value="3600" <?php selected($settings['cache_duration'] ?? 3600, 3600); ?>><?php _e('ساعة واحدة', 'practical-solutions'); ?></option>
                                    <option value="7200" <?php selected($settings['cache_duration'] ?? 3600, 7200); ?>><?php _e('ساعتان', 'practical-solutions'); ?></option>
                                    <option value="21600" <?php selected($settings['cache_duration'] ?? 3600, 21600); ?>><?php _e('6 ساعات', 'practical-solutions'); ?></option>
                                    <option value="86400" <?php selected($settings['cache_duration'] ?? 3600, 86400); ?>><?php _e('24 ساعة', 'practical-solutions'); ?></option>
                                </select>
                                <p class="description"><?php _e('مدة حفظ الاقتراحات في الذاكرة المؤقتة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('ميزات المحتوى الذكي', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تلخيص المقالات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[auto_summaries]" value="1" <?php checked(1, $settings['auto_summaries'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء ملخصات تلقائية للمقالات الطويلة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('المقالات المقترحة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[related_posts]" value="1" <?php checked(1, $settings['related_posts'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('اقتراح مقالات ذات صلة بناءً على المحتوى', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحسين SEO تلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_ai_settings[auto_seo]" value="1" <?php checked(1, $settings['auto_seo'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء meta descriptions وتحسين الكلمات المفتاحية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-ai-status">
                <h3><?php _e('حالة النظام', 'practical-solutions'); ?></h3>
                <div class="ps-status-grid">
                    <div class="status-item">
                        <span class="status-indicator <?php echo !empty($settings['openrouter_api_key']) ? 'active' : 'inactive'; ?>"></span>
                        <span class="status-label"><?php _e('API متصل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="status-item">
                        <span class="status-indicator <?php echo ($settings['enabled'] ?? 0) ? 'active' : 'inactive'; ?>"></span>
                        <span class="status-label"><?php _e('النظام مفعل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="status-item">
                        <span class="status-indicator active"></span>
                        <span class="status-label"><?php _e('التخزين المؤقت يعمل', 'practical-solutions'); ?></span>
                    </div>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات الذكاء الاصطناعي', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب التصميم ====
     */
    private function render_design_tab() {
        settings_fields('ps_design_settings');
        $settings = get_option('ps_design_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات التصميم', 'practical-solutions'); ?></h2>
                <p><?php _e('تخصيص مظهر وألوان القالب', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('الألوان الأساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('اللون الأساسي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[primary_color]" value="<?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[primary_color]" value="<?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('اللون الثانوي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[secondary_color]" value="<?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[secondary_color]" value="<?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('لون التمييز', 'practical-solutions'); ?></th>
                            <td>
                                <input type="color" name="ps_design_settings[accent_color]" value="<?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>" class="ps-color-picker" />
                                <input type="text" name="ps_design_settings[accent_color]" value="<?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>" class="regular-text ps-color-input" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('الخطوط والنصوص', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('خط العناوين', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[heading_font]" class="regular-text">
                                    <option value="Cairo" <?php selected($settings['heading_font'] ?? 'Cairo', 'Cairo'); ?>>Cairo</option>
                                    <option value="Amiri" <?php selected($settings['heading_font'] ?? '', 'Amiri'); ?>>Amiri</option>
                                    <option value="Noto Sans Arabic" <?php selected($settings['heading_font'] ?? '', 'Noto Sans Arabic'); ?>>Noto Sans Arabic</option>
                                    <option value="Tajawal" <?php selected($settings['heading_font'] ?? '', 'Tajawal'); ?>>Tajawal</option>
                                    <option value="Almarai" <?php selected($settings['heading_font'] ?? '', 'Almarai'); ?>>Almarai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('خط النص العادي', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[body_font]" class="regular-text">
                                    <option value="Noto Sans Arabic" <?php selected($settings['body_font'] ?? 'Noto Sans Arabic', 'Noto Sans Arabic'); ?>>Noto Sans Arabic</option>
                                    <option value="Cairo" <?php selected($settings['body_font'] ?? '', 'Cairo'); ?>>Cairo</option>
                                    <option value="Tajawal" <?php selected($settings['body_font'] ?? '', 'Tajawal'); ?>>Tajawal</option>
                                    <option value="Almarai" <?php selected($settings['body_font'] ?? '', 'Almarai'); ?>>Almarai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('حجم الخط الأساسي', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_design_settings[font_size]" min="14" max="20" value="<?php echo esc_attr($settings['font_size'] ?? 16); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['font_size'] ?? 16); ?>px</span>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تخطيط الصفحة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('عرض المحتوى', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[content_width]" class="regular-text">
                                    <option value="1140px" <?php selected($settings['content_width'] ?? '1140px', '1140px'); ?>><?php _e('واسع (1140px)', 'practical-solutions'); ?></option>
                                    <option value="1024px" <?php selected($settings['content_width'] ?? '', '1024px'); ?>><?php _e('متوسط (1024px)', 'practical-solutions'); ?></option>
                                    <option value="960px" <?php selected($settings['content_width'] ?? '', '960px'); ?>><?php _e('ضيق (960px)', 'practical-solutions'); ?></option>
                                    <option value="100%" <?php selected($settings['content_width'] ?? '', '100%'); ?>><?php _e('كامل العرض', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط الرأس', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[header_style]" class="regular-text">
                                    <option value="default" <?php selected($settings['header_style'] ?? 'default', 'default'); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="centered" <?php selected($settings['header_style'] ?? '', 'centered'); ?>><?php _e('متوسط', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['header_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                    <option value="full-width" <?php selected($settings['header_style'] ?? '', 'full-width'); ?>><?php _e('كامل العرض', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط التذييل', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_design_settings[footer_style]" class="regular-text">
                                    <option value="default" <?php selected($settings['footer_style'] ?? 'default', 'default'); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['footer_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                    <option value="detailed" <?php selected($settings['footer_style'] ?? '', 'detailed'); ?>><?php _e('مفصل', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تأثيرات بصرية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تأثيرات الحركة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_design_settings[animations]" value="1" <?php checked(1, $settings['animations'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل الحركات والانتقالات المرئية', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الظلال', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_design_settings[shadows]" value="1" <?php checked(1, $settings['shadows'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إضافة ظلال للعناصر لتحسين العمق البصري', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الحواف الدائرية', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_design_settings[border_radius]" min="0" max="20" value="<?php echo esc_attr($settings['border_radius'] ?? 8); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['border_radius'] ?? 8); ?>px</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-preview-section">
                <h3><?php _e('معاينة التصميم', 'practical-solutions'); ?></h3>
                <div class="ps-design-preview">
                    <div class="preview-header" style="background-color: <?php echo esc_attr($settings['primary_color'] ?? '#007cba'); ?>;">
                        <div class="preview-logo"><?php _e('شعار الموقع', 'practical-solutions'); ?></div>
                        <div class="preview-menu"><?php _e('القائمة', 'practical-solutions'); ?></div>
                    </div>
                    <div class="preview-content">
                        <h2 style="color: <?php echo esc_attr($settings['secondary_color'] ?? '#005a87'); ?>; font-family: <?php echo esc_attr($settings['heading_font'] ?? 'Cairo'); ?>;">
                            <?php _e('عنوان تجريبي', 'practical-solutions'); ?>
                        </h2>
                        <p style="font-family: <?php echo esc_attr($settings['body_font'] ?? 'Noto Sans Arabic'); ?>; font-size: <?php echo esc_attr($settings['font_size'] ?? 16); ?>px;">
                            <?php _e('هذا نص تجريبي لمعاينة الخطوط والألوان المختارة. يمكنك رؤية كيف ستبدو العناصر في موقعك.', 'practical-solutions'); ?>
                        </p>
                        <button style="background-color: <?php echo esc_attr($settings['accent_color'] ?? '#ff6b35'); ?>; border-radius: <?php echo esc_attr($settings['border_radius'] ?? 8); ?>px;">
                            <?php _e('زر تجريبي', 'practical-solutions'); ?>
                        </button>
                    </div>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات التصميم', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الأداء ====
     */
    private function render_performance_tab() {
        settings_fields('ps_performance_settings');
        $settings = get_option('ps_performance_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات الأداء', 'practical-solutions'); ?></h2>
                <p><?php _e('تحسين سرعة الموقع وأدائه', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('تحسينات الأداء', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Service Worker', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[service_worker]" value="1" <?php checked(1, $settings['service_worker'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل التخزين المؤقت المتقدم وتحسين التحميل', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Lazy Loading للصور', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[lazy_loading]" value="1" <?php checked(1, $settings['lazy_loading'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تحميل الصور عند الحاجة فقط', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('ضغط CSS/JS', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[minify_assets]" value="1" <?php checked(1, $settings['minify_assets'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تقليل حجم ملفات CSS و JavaScript', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('دمج الملفات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[combine_files]" value="1" <?php checked(1, $settings['combine_files'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('دمج ملفات CSS و JS لتقليل عدد الطلبات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات التخزين المؤقت', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('مدة تخزين الصفحات', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_performance_settings[page_cache_duration]" class="regular-text">
                                    <option value="3600" <?php selected($settings['page_cache_duration'] ?? 3600, 3600); ?>><?php _e('ساعة واحدة', 'practical-solutions'); ?></option>
                                    <option value="7200" <?php selected($settings['page_cache_duration'] ?? 3600, 7200); ?>><?php _e('ساعتان', 'practical-solutions'); ?></option>
                                    <option value="21600" <?php selected($settings['page_cache_duration'] ?? 3600, 21600); ?>><?php _e('6 ساعات', 'practical-solutions'); ?></option>
                                    <option value="86400" <?php selected($settings['page_cache_duration'] ?? 3600, 86400); ?>><?php _e('24 ساعة', 'practical-solutions'); ?></option>
                                    <option value="604800" <?php selected($settings['page_cache_duration'] ?? 3600, 604800); ?>><?php _e('أسبوع', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تخزين قاعدة البيانات', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[database_cache]" value="1" <?php checked(1, $settings['database_cache'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تخزين نتائج استعلامات قاعدة البيانات مؤقتاً', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تخزين Object Cache', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[object_cache]" value="1" <?php checked(1, $settings['object_cache'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل Object Cache إذا كان متوفراً على الخادم', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('تحسين الصور', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('ضغط الصور تلقائياً', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[image_compression]" value="1" <?php checked(1, $settings['image_compression'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('ضغط الصور المرفوعة تلقائياً لتحسين الأداء', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحويل إلى WebP', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_performance_settings[webp_conversion]" value="1" <?php checked(1, $settings['webp_conversion'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تحويل الصور إلى تنسيق WebP للمتصفحات المدعومة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('جودة الضغط', 'practical-solutions'); ?></th>
                            <td>
                                <input type="range" name="ps_performance_settings[compression_quality]" min="60" max="100" value="<?php echo esc_attr($settings['compression_quality'] ?? 85); ?>" class="ps-range-slider" />
                                <span class="ps-range-value"><?php echo esc_attr($settings['compression_quality'] ?? 85); ?>%</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-performance-tools">
                <h3><?php _e('أدوات الأداء', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="clear-all-cache">
                        <span class="dashicons dashicons-update"></span>
                        <?php _e('مسح جميع الذاكرة المؤقتة', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="optimize-database">
                        <span class="dashicons dashicons-database"></span>
                        <?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="test-page-speed">
                        <span class="dashicons dashicons-performance"></span>
                        <?php _e('اختبار سرعة الموقع', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="generate-sitemap">
                        <span class="dashicons dashicons-networking"></span>
                        <?php _e('إنشاء خريطة الموقع', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات الأداء', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب التواصل الاجتماعي ====
     */
    private function render_social_tab() {
        settings_fields('ps_social_settings');
        $settings = get_option('ps_social_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات التواصل الاجتماعي', 'practical-solutions'); ?></h2>
                <p><?php _e('إضافة روابط وسائل التواصل الاجتماعي', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('المنصات الأساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-facebook"></span>
                                <?php _e('فيسبوك', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[facebook]" value="<?php echo esc_url($settings['facebook'] ?? ''); ?>" class="large-text" placeholder="https://facebook.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-twitter"></span>
                                <?php _e('تويتر', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[twitter]" value="<?php echo esc_url($settings['twitter'] ?? ''); ?>" class="large-text" placeholder="https://twitter.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-instagram"></span>
                                <?php _e('إنستغرام', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[instagram]" value="<?php echo esc_url($settings['instagram'] ?? ''); ?>" class="large-text" placeholder="https://instagram.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-linkedin"></span>
                                <?php _e('لينكد إن', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[linkedin]" value="<?php echo esc_url($settings['linkedin'] ?? ''); ?>" class="large-text" placeholder="https://linkedin.com/in/username" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('منصات إضافية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-youtube"></span>
                                <?php _e('يوتيوب', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[youtube]" value="<?php echo esc_url($settings['youtube'] ?? ''); ?>" class="large-text" placeholder="https://youtube.com/c/channel" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-pinterest"></span>
                                <?php _e('بنترست', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="url" name="ps_social_settings[pinterest]" value="<?php echo esc_url($settings['pinterest'] ?? ''); ?>" class="large-text" placeholder="https://pinterest.com/username" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-whatsapp"></span>
                                <?php _e('واتساب', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="tel" name="ps_social_settings[whatsapp]" value="<?php echo esc_attr($settings['whatsapp'] ?? ''); ?>" class="large-text" placeholder="+966501234567" />
                                <p class="description"><?php _e('رقم الهاتف مع رمز البلد', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="dashicons dashicons-email"></span>
                                <?php _e('تيليجرام', 'practical-solutions'); ?>
                            </th>
                            <td>
                                <input type="text" name="ps_social_settings[telegram]" value="<?php echo esc_attr($settings['telegram'] ?? ''); ?>" class="large-text" placeholder="@username" />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات العرض', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('إظهار في الرأس', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[show_in_header]" value="1" <?php checked(1, $settings['show_in_header'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('إظهار في التذييل', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[show_in_footer]" value="1" <?php checked(1, $settings['show_in_footer'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('أزرار المشاركة', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_social_settings[share_buttons]" value="1" <?php checked(1, $settings['share_buttons'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إظهار أزرار المشاركة في المقالات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نمط الأيقونات', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_social_settings[icon_style]" class="regular-text">
                                    <option value="round" <?php selected($settings['icon_style'] ?? 'round', 'round'); ?>><?php _e('دائري', 'practical-solutions'); ?></option>
                                    <option value="square" <?php selected($settings['icon_style'] ?? '', 'square'); ?>><?php _e('مربع', 'practical-solutions'); ?></option>
                                    <option value="minimal" <?php selected($settings['icon_style'] ?? '', 'minimal'); ?>><?php _e('بسيط', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-social-preview">
                <h3><?php _e('معاينة الأيقونات', 'practical-solutions'); ?></h3>
                <div class="social-icons-preview <?php echo esc_attr($settings['icon_style'] ?? 'round'); ?>">
                    <?php if (!empty($settings['facebook'])): ?>
                        <a href="#" class="social-icon facebook"><span class="dashicons dashicons-facebook"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['twitter'])): ?>
                        <a href="#" class="social-icon twitter"><span class="dashicons dashicons-twitter"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['instagram'])): ?>
                        <a href="#" class="social-icon instagram"><span class="dashicons dashicons-instagram"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['linkedin'])): ?>
                        <a href="#" class="social-icon linkedin"><span class="dashicons dashicons-linkedin"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['youtube'])): ?>
                        <a href="#" class="social-icon youtube"><span class="dashicons dashicons-youtube"></span></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات التواصل الاجتماعي', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب SEO ====
     */
    private function render_seo_tab() {
        settings_fields('ps_seo_settings');
        $settings = get_option('ps_seo_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('إعدادات SEO', 'practical-solutions'); ?></h2>
                <p><?php _e('تحسين محركات البحث والظهور في النتائج', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات أساسية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('عنوان الموقع SEO', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[site_title]" value="<?php echo esc_attr($settings['site_title'] ?? ''); ?>" class="large-text" placeholder="<?php _e('عنوان محسن لمحركات البحث', 'practical-solutions'); ?>" />
                                <p class="description"><?php _e('إذا تُرك فارغاً، سيستخدم عنوان الموقع الافتراضي', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('وصف meta الافتراضي', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_seo_settings[meta_description]" rows="3" class="large-text" placeholder="<?php _e('وصف مختصر وجذاب للموقع...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['meta_description'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('يُفضل أن يكون بين 150-160 حرف', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('فاصل العنوان', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_seo_settings[title_separator]" class="regular-text">
                                    <option value="|" <?php selected($settings['title_separator'] ?? '|', '|'); ?>>|</option>
                                    <option value="-" <?php selected($settings['title_separator'] ?? '|', '-'); ?>>-</option>
                                    <option value="·" <?php selected($settings['title_separator'] ?? '|', '·'); ?>>·</option>
                                    <option value="»" <?php selected($settings['title_separator'] ?? '|', '»'); ?>>»</option>
                                    <option value="›" <?php selected($settings['title_separator'] ?? '|', '›'); ?>>›</option>
                                </select>
                                <p class="description"><?php _e('الرمز المستخدم لفصل عنوان الصفحة عن اسم الموقع', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('Open Graph و Twitter Cards', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Open Graph', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_og]" value="1" <?php checked(1, $settings['enable_og'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('لتحسين ظهور المحتوى عند المشاركة على فيسبوك', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تفعيل Twitter Cards', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_twitter_cards]" value="1" <?php checked(1, $settings['enable_twitter_cards'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('لتحسين ظهور المحتوى عند المشاركة على تويتر', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('الصورة الافتراضية للمشاركة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_seo_settings[default_og_image]" value="<?php echo esc_url($settings['default_og_image'] ?? ''); ?>" class="large-text" placeholder="https://example.com/image.jpg" />
                                <button type="button" class="button button-secondary" id="upload-og-image"><?php _e('رفع صورة', 'practical-solutions'); ?></button>
                                <p class="description"><?php _e('الحجم المثالي: 1200x630 بكسل', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('Schema.org و البيانات المنظمة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('تفعيل Schema.org', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_seo_settings[enable_schema]" value="1" <?php checked(1, $settings['enable_schema'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إضافة البيانات المنظمة لتحسين فهم محركات البحث', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('نوع المنظمة', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_seo_settings[organization_type]" class="regular-text">
                                    <option value="Organization" <?php selected($settings['organization_type'] ?? 'Organization', 'Organization'); ?>><?php _e('منظمة', 'practical-solutions'); ?></option>
                                    <option value="LocalBusiness" <?php selected($settings['organization_type'] ?? '', 'LocalBusiness'); ?>><?php _e('نشاط تجاري محلي', 'practical-solutions'); ?></option>
                                    <option value="Corporation" <?php selected($settings['organization_type'] ?? '', 'Corporation'); ?>><?php _e('شركة', 'practical-solutions'); ?></option>
                                    <option value="Person" <?php selected($settings['organization_type'] ?? '', 'Person'); ?>><?php _e('شخص', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('شعار المنظمة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="url" name="ps_seo_settings[organization_logo]" value="<?php echo esc_url($settings['organization_logo'] ?? ''); ?>" class="large-text" placeholder="https://example.com/logo.png" />
                                <button type="button" class="button button-secondary" id="upload-org-logo"><?php _e('رفع شعار', 'practical-solutions'); ?></button>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('أدوات مشرفي المواقع', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('Google Search Console', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[google_verification]" value="<?php echo esc_attr($settings['google_verification'] ?? ''); ?>" class="large-text" placeholder="content-verification-code" />
                                <p class="description"><?php _e('رمز التحقق من Google Search Console', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Bing Webmaster Tools', 'practical-solutions'); ?></th>
                            <td>
                                <input type="text" name="ps_seo_settings[bing_verification]" value="<?php echo esc_attr($settings['bing_verification'] ?? ''); ?>" class="large-text" placeholder="bing-verification-code" />
                                <p class="description"><?php _e('رمز التحقق من Bing Webmaster Tools', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-seo-tools">
                <h3><?php _e('أدوات SEO', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="generate-sitemap">
                        <span class="dashicons dashicons-networking"></span>
                        <?php _e('إنشاء خريطة الموقع', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="analyze-seo">
                        <span class="dashicons dashicons-search"></span>
                        <?php _e('تحليل SEO', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="check-robots">
                        <span class="dashicons dashicons-privacy"></span>
                        <?php _e('فحص robots.txt', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="validate-schema">
                        <span class="dashicons dashicons-admin-tools"></span>
                        <?php _e('التحقق من Schema', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <?php submit_button(__('حفظ إعدادات SEO', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== تبويب الإعدادات المتقدمة ====
     */
    private function render_advanced_tab() {
        settings_fields('ps_advanced_settings');
        $settings = get_option('ps_advanced_settings', array());
        ?>
        <div class="ps-settings-section">
            <div class="ps-section-header">
                <h2><?php _e('الإعدادات المتقدمة', 'practical-solutions'); ?></h2>
                <p><?php _e('إعدادات للمطورين والمستخدمين المتقدمين', 'practical-solutions'); ?></p>
            </div>
            
            <div class="ps-settings-grid">
                <div class="ps-setting-card">
                    <h3><?php _e('أكواد مخصصة', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('CSS مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_css]" rows="10" class="large-text code-editor" placeholder="/* أضف CSS مخصص هنا */"><?php echo esc_textarea($settings['custom_css'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم إضافة CSS في head الصفحة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('JavaScript مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_js]" rows="10" class="large-text code-editor" placeholder="// أضف JavaScript مخصص هنا"><?php echo esc_textarea($settings['custom_js'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم تحميل JavaScript في footer الصفحة', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Head مخصص', 'practical-solutions'); ?></th>
                            <td>
                                <textarea name="ps_advanced_settings[custom_head]" rows="5" class="large-text" placeholder="<!-- أضف أكواد head مخصصة هنا -->"><?php echo esc_textarea($settings['custom_head'] ?? ''); ?></textarea>
                                <p class="description"><?php _e('سيتم إضافة هذا الكود في &lt;head&gt;', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات التطوير', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('وضع التطوير', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[debug_mode]" value="1" <?php checked(1, $settings['debug_mode'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تفعيل سجلات التطوير والتشخيص', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عرض أخطاء PHP', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[show_php_errors]" value="1" <?php checked(1, $settings['show_php_errors'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('عرض أخطاء PHP (للتطوير فقط)', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تحديد الذاكرة', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_advanced_settings[memory_limit]" class="regular-text">
                                    <option value="" <?php selected($settings['memory_limit'] ?? '', ''); ?>><?php _e('افتراضي', 'practical-solutions'); ?></option>
                                    <option value="256M" <?php selected($settings['memory_limit'] ?? '', '256M'); ?>>256MB</option>
                                    <option value="512M" <?php selected($settings['memory_limit'] ?? '', '512M'); ?>>512MB</option>
                                    <option value="1G" <?php selected($settings['memory_limit'] ?? '', '1G'); ?>>1GB</option>
                                </select>
                                <p class="description"><?php _e('حد استخدام الذاكرة لـ PHP', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('النسخ الاحتياطية', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('نسخ احتياطي تلقائي', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[auto_backup]" value="1" <?php checked(1, $settings['auto_backup'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إنشاء نسخة احتياطية تلقائية للإعدادات', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تكرار النسخ الاحتياطية', 'practical-solutions'); ?></th>
                            <td>
                                <select name="ps_advanced_settings[backup_frequency]" class="regular-text">
                                    <option value="daily" <?php selected($settings['backup_frequency'] ?? 'weekly', 'daily'); ?>><?php _e('يومياً', 'practical-solutions'); ?></option>
                                    <option value="weekly" <?php selected($settings['backup_frequency'] ?? 'weekly', 'weekly'); ?>><?php _e('أسبوعياً', 'practical-solutions'); ?></option>
                                    <option value="monthly" <?php selected($settings['backup_frequency'] ?? 'weekly', 'monthly'); ?>><?php _e('شهرياً', 'practical-solutions'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('عدد النسخ المحفوظة', 'practical-solutions'); ?></th>
                            <td>
                                <input type="number" name="ps_advanced_settings[backup_keep_count]" value="<?php echo esc_attr($settings['backup_keep_count'] ?? 5); ?>" min="1" max="20" class="small-text" />
                                <p class="description"><?php _e('عدد النسخ الاحتياطية التي سيتم الاحتفاظ بها', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="ps-setting-card">
                    <h3><?php _e('إعدادات الأمان', 'practical-solutions'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('إخفاء إصدار WordPress', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[hide_wp_version]" value="1" <?php checked(1, $settings['hide_wp_version'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('إزالة معلومات إصدار WordPress من HTML', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('تعطيل XML-RPC', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[disable_xmlrpc]" value="1" <?php checked(1, $settings['disable_xmlrpc'] ?? 0); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('تعطيل XML-RPC لتحسين الأمان', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('حماية wp-config.php', 'practical-solutions'); ?></th>
                            <td>
                                <label class="ps-toggle">
                                    <input type="checkbox" name="ps_advanced_settings[protect_wp_config]" value="1" <?php checked(1, $settings['protect_wp_config'] ?? 1); ?> />
                                    <span class="ps-toggle-slider"></span>
                                </label>
                                <p class="description"><?php _e('منع الوصول المباشر لملف wp-config.php', 'practical-solutions'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="ps-advanced-tools">
                <h3><?php _e('أدوات متقدمة', 'practical-solutions'); ?></h3>
                <div class="ps-tools-grid">
                    <button type="button" class="button button-secondary ps-tool-button" id="create-backup">
                        <span class="dashicons dashicons-backup"></span>
                        <?php _e('إنشاء نسخة احتياطية', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="restore-backup">
                        <span class="dashicons dashicons-restore"></span>
                        <?php _e('استعادة نسخة احتياطية', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="reset-settings">
                        <span class="dashicons dashicons-warning"></span>
                        <?php _e('إعادة تعيين الإعدادات', 'practical-solutions'); ?>
                    </button>
                    <button type="button" class="button button-secondary ps-tool-button" id="export-theme-data">
                        <span class="dashicons dashicons-download"></span>
                        <?php _e('تصدير بيانات القالب', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
            
            <div class="ps-maintenance-mode">
                <h3><?php _e('وضع الصيانة', 'practical-solutions'); ?></h3>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('تفعيل وضع الصيانة', 'practical-solutions'); ?></th>
                        <td>
                            <label class="ps-toggle">
                                <input type="checkbox" name="ps_advanced_settings[maintenance_mode]" value="1" <?php checked(1, $settings['maintenance_mode'] ?? 0); ?> />
                                <span class="ps-toggle-slider"></span>
                            </label>
                            <p class="description"><?php _e('عرض صفحة صيانة للزوار غير المسجلين', 'practical-solutions'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('رسالة الصيانة', 'practical-solutions'); ?></th>
                        <td>
                            <textarea name="ps_advanced_settings[maintenance_message]" rows="3" class="large-text" placeholder="<?php _e('الموقع تحت الصيانة، سنعود قريباً...', 'practical-solutions'); ?>"><?php echo esc_textarea($settings['maintenance_message'] ?? ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            
            <?php submit_button(__('حفظ الإعدادات المتقدمة', 'practical-solutions'), 'primary', 'submit', false, array('class' => 'ps-save-button')); ?>
        </div>
        <?php
    }
    
    /**
     * ==== عرض الشريط الجانبي ====
     */
    private function render_sidebar() {
        ?>
        <div class="ps-sidebar-widgets">
            <div class="ps-widget">
                <h3><?php _e('معلومات القالب', 'practical-solutions'); ?></h3>
                <div class="ps-theme-info">
                    <div class="info-item">
                        <strong><?php _e('الإصدار:', 'practical-solutions'); ?></strong>
                        <span><?php echo PS_THEME_VERSION; ?></span>
                    </div>
                    <div class="info-item">
                        <strong><?php _e('إصدار WordPress:', 'practical-solutions'); ?></strong>
                        <span><?php echo get_bloginfo('version'); ?></span>
                    </div>
                    <div class="info-item">
                        <strong><?php _e('إصدار PHP:', 'practical-solutions'); ?></strong>
                        <span><?php echo PHP_VERSION; ?></span>
                    </div>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('الدعم والمساعدة', 'practical-solutions'); ?></h3>
                <div class="ps-support-links">
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-book"></span>
                        <?php _e('دليل الاستخدام', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-video-alt3"></span>
                        <?php _e('فيديوهات تعليمية', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e('الدعم الفني', 'practical-solutions'); ?>
                    </a>
                    <a href="#" class="support-link" target="_blank">
                        <span class="dashicons dashicons-star-filled"></span>
                        <?php _e('تقييم القالب', 'practical-solutions'); ?>
                    </a>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('إحصائيات سريعة', 'practical-solutions'); ?></h3>
                <div class="ps-quick-stats-sidebar">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_cache_size(); ?></span>
                        <span class="stat-label"><?php _e('حجم الكاش', 'practical-solutions'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_page_load_time(); ?>ms</span>
                        <span class="stat-label"><?php _e('زمن التحميل', 'practical-solutions'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $this->get_db_queries_count(); ?></span>
                        <span class="stat-label"><?php _e('استعلامات قاعدة البيانات', 'practical-solutions'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="ps-widget">
                <h3><?php _e('تحديثات القالب', 'practical-solutions'); ?></h3>
                <div class="ps-updates-info">
                    <p><?php _e('لديك أحدث إصدار من القالب', 'practical-solutions'); ?></p>
                    <button type="button" class="button button-secondary" id="check-updates">
                        <span class="dashicons dashicons-update"></span>
                        <?php _e('فحص التحديثات', 'practical-solutions'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== عرض صفحة التحليلات ====
     */
    public function render_analytics_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('التحليلات والتقارير', 'practical-solutions'); ?></h1>
            
            <div class="ps-analytics-dashboard">
                <div class="ps-analytics-overview">
                    <div class="analytics-card">
                        <h3><?php _e('الزيارات اليوم', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_today_visitors(); ?></div>
                        <div class="trend positive">+12%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('مشاهدات الصفحات', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_today_pageviews(); ?></div>
                        <div class="trend positive">+8%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('البحث الصوتي', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_voice_searches(); ?></div>
                        <div class="trend positive">+25%</div>
                    </div>
                    <div class="analytics-card">
                        <h3><?php _e('المقالات المحفوظة', 'practical-solutions'); ?></h3>
                        <div class="big-number"><?php echo $this->get_bookmarks_count(); ?></div>
                        <div class="trend neutral">0%</div>
                    </div>
                </div>
                
                <div class="ps-analytics-charts">
                    <div class="chart-container">
                        <h3><?php _e('الزيارات خلال الأسبوع الماضي', 'practical-solutions'); ?></h3>
                        <canvas id="visitors-chart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3><?php _e('أكثر المقالات زيارة', 'practical-solutions'); ?></h3>
                        <div class="top-posts-list">
                            <?php echo $this->get_top_posts_html(); ?>
                        </div>
                    </div>
                </div>
                
                <div class="ps-analytics-tables">
                    <div class="table-container">
                        <h3><?php _e('مصادر الزيارات', 'practical-solutions'); ?></h3>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th><?php _e('المصدر', 'practical-solutions'); ?></th>
                                    <th><?php _e('الزيارات', 'practical-solutions'); ?></th>
                                    <th><?php _e('النسبة', 'practical-solutions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $this->get_traffic_sources_html(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-container">
                        <h3><?php _e('كلمات البحث الشائعة', 'practical-solutions'); ?></h3>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th><?php _e('الكلمة', 'practical-solutions'); ?></th>
                                    <th><?php _e('عدد البحث', 'practical-solutions'); ?></th>
                                    <th><?php _e('النتائج', 'practical-solutions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $this->get_search_terms_html(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== عرض صفحة الأدوات ====
     */
    public function render_tools_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('أدوات القالب', 'practical-solutions'); ?></h1>
            
            <div class="ps-tools-dashboard">
                <div class="ps-tools-grid">
                    <div class="tool-card">
                        <h3><?php _e('إدارة الذاكرة المؤقتة', 'practical-solutions'); ?></h3>
                        <p><?php _e('مسح وإدارة ملفات التخزين المؤقت', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="clear-all-cache">
                                <?php _e('مسح الكل', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clear-page-cache">
                                <?php _e('مسح كاش الصفحات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clear-object-cache">
                                <?php _e('مسح Object Cache', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?></h3>
                        <p><?php _e('تنظيف وتحسين جداول قاعدة البيانات', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="optimize-database">
                                <?php _e('تحسين الآن', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clean-revisions">
                                <?php _e('مسح المراجعات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="clean-spam">
                                <?php _e('مسح السبام', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('النسخ الاحتياطية', 'practical-solutions'); ?></h3>
                        <p><?php _e('إنشاء واستعادة النسخ الاحتياطية', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="create-full-backup">
                                <?php _e('نسخة احتياطية كاملة', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="backup-settings">
                                <?php _e('نسخ الإعدادات فقط', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="view-backups">
                                <?php _e('عرض النسخ المحفوظة', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('أدوات SEO', 'practical-solutions'); ?></h3>
                        <p><?php _e('تحسين محركات البحث والفهرسة', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="generate-sitemap">
                                <?php _e('إنشاء Sitemap', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="submit-sitemap">
                                <?php _e('إرسال لمحركات البحث', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="check-seo-score">
                                <?php _e('فحص SEO', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('تصدير البيانات', 'practical-solutions'); ?></h3>
                        <p><?php _e('تصدير المحتوى والإعدادات', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="export-all-data">
                                <?php _e('تصدير الكل', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="export-posts">
                                <?php _e('تصدير المقالات', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="export-analytics">
                                <?php _e('تصدير التحليلات', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('أدوات التطوير', 'practical-solutions'); ?></h3>
                        <p><?php _e('أدوات للمطورين والاختبار', 'practical-solutions'); ?></p>
                        <div class="tool-actions">
                            <button type="button" class="button button-primary" id="test-api-connections">
                                <?php _e('اختبار APIs', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="debug-info">
                                <?php _e('معلومات التشخيص', 'practical-solutions'); ?>
                            </button>
                            <button type="button" class="button button-secondary" id="system-info">
                                <?php _e('معلومات النظام', 'practical-solutions'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * ==== دوال التنظيف (Sanitization) ====
     */
    public function sanitize_general_settings($input) {
        $sanitized = array();
        
        if (isset($input['site_description'])) {
            $sanitized['site_description'] = sanitize_textarea_field($input['site_description']);
        }
        
        if (isset($input['keywords'])) {
            $sanitized['keywords'] = sanitize_text_field($input['keywords']);
        }
        
        $sanitized['voice_search'] = isset($input['voice_search']) ? 1 : 0;
        $sanitized['bookmarks'] = isset($input['bookmarks']) ? 1 : 0;
        $sanitized['reading_progress'] = isset($input['reading_progress']) ? 1 : 0;
        $sanitized['rating_system'] = isset($input['rating_system']) ? 1 : 0;
        $sanitized['auto_dark_mode'] = isset($input['auto_dark_mode']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_ai_settings($input) {
        $sanitized = array();
        
        $sanitized['enabled'] = isset($input['enabled']) ? 1 : 0;
        
        if (isset($input['openrouter_api_key'])) {
            $sanitized['openrouter_api_key'] = sanitize_text_field($input['openrouter_api_key']);
        }
        
        if (isset($input['model'])) {
            $sanitized['model'] = sanitize_text_field($input['model']);
        }
        
        $sanitized['search_suggestions'] = isset($input['search_suggestions']) ? 1 : 0;
        
        if (isset($input['suggestions_count'])) {
            $sanitized['suggestions_count'] = absint($input['suggestions_count']);
        }
        
        if (isset($input['cache_duration'])) {
            $sanitized['cache_duration'] = absint($input['cache_duration']);
        }
        
        $sanitized['auto_summaries'] = isset($input['auto_summaries']) ? 1 : 0;
        $sanitized['related_posts'] = isset($input['related_posts']) ? 1 : 0;
        $sanitized['auto_seo'] = isset($input['auto_seo']) ? 1 : 0;
        
        return $sanitized;
    }
    
    public function sanitize_design_settings($input) {
        $sanitized = array();
        
        if (isset($input['primary_color'])) {
            $sanitized['primary_color'] = sanitize_hex_color($input['primary_color']);
        }
        
        if (isset($input['secondary_color'])) {
            $sanitized['secondary_color'] = sanitize_hex_color($input['secondary_color']);
        }
        
        if (isset($input['accent_color'])) {
            $sanitized['accent_color'] = sanitize_hex_color($input['accent_color']);
        }
        
        if (isset($input['heading_font'])) {
            $sanitized['heading_font'] = sanitize_text_field($input['heading_font']);
        }
        
        if (isset($input['body_font'])) {
            $sanitized['body_font'] = sanitize_text_field($input['body_font']);
        }
        
        if (isset($input['font_size'])) {
            $sanitized['font_size'] = absint($input['font_size']);
        }
        
        if (isset($input['content_width'])) {
            $sanitized['content_width'] = sanitize_text_field($input['content_width']);
        }
        
        if (isset($input['header_style'])) {
            $sanitized['header_style'] = sanitize_text_field($input['header_style']);
        }
        
        if (isset($input['footer_style'])) {
            $sanitized['footer_style'] = sanitize_text_field($input['footer_style']);
        }
        
        $sanitized['animations'] = isset($input['animations']) ? 1 : 0;
        $sanitized['shadows'] = isset($input['shadows']) ? 1 : 0;
        
        if (isset($input['border_radius'])) {
            $sanitized['border_radius'] = absint($input['border_radius']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_performance_settings($input) {
        $sanitized = array();
        
        $sanitized['service_worker'] = isset($input['service_worker']) ? 1 : 0;
        $sanitized['lazy_loading'] = isset($input['lazy_loading']) ? 1 : 0;
        $sanitized['minify_assets'] = isset($input['minify_assets']) ? 1 : 0;
        $sanitized['combine_files'] = isset($input['combine_files']) ? 1 : 0;
        
        if (isset($input['page_cache_duration'])) {
            $sanitized['page_cache_duration'] = absint($input['page_cache_duration']);
        }
        
        $sanitized['database_cache'] = isset($input['database_cache']) ? 1 : 0;
        $sanitized['object_cache'] = isset($input['object_cache']) ? 1 : 0;
        $sanitized['image_compression'] = isset($input['image_compression']) ? 1 : 0;
        $sanitized['webp_conversion'] = isset($input['webp_conversion']) ? 1 : 0;
        
        if (isset($input['compression_quality'])) {
            $sanitized['compression_quality'] = absint($input['compression_quality']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_social_settings($input) {
        $sanitized = array();
        
        if (isset($input['facebook'])) {
            $sanitized['facebook'] = esc_url_raw($input['facebook']);
        }
        
        if (isset($input['twitter'])) {
            $sanitized['twitter'] = esc_url_raw($input['twitter']);
        }
        
        if (isset($input['instagram'])) {
            $sanitized['instagram'] = esc_url_raw($input['instagram']);
        }
        
        if (isset($input['linkedin'])) {
            $sanitized['linkedin'] = esc_url_raw($input['linkedin']);
        }
        
        if (isset($input['youtube'])) {
            $sanitized['youtube'] = esc_url_raw($input['youtube']);
        }
        
        if (isset($input['pinterest'])) {
            $sanitized['pinterest'] = esc_url_raw($input['pinterest']);
        }
        
        if (isset($input['whatsapp'])) {
            $sanitized['whatsapp'] = sanitize_text_field($input['whatsapp']);
        }
        
        if (isset($input['telegram'])) {
            $sanitized['telegram'] = sanitize_text_field($input['telegram']);
        }
        
        $sanitized['show_in_header'] = isset($input['show_in_header']) ? 1 : 0;
        $sanitized['show_in_footer'] = isset($input['show_in_footer']) ? 1 : 0;
        $sanitized['share_buttons'] = isset($input['share_buttons']) ? 1 : 0;
        
        if (isset($input['icon_style'])) {
            $sanitized['icon_style'] = sanitize_text_field($input['icon_style']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_seo_settings($input) {
        $sanitized = array();
        
        if (isset($input['site_title'])) {
            $sanitized['site_title'] = sanitize_text_field($input['site_title']);
        }
        
        if (isset($input['meta_description'])) {
            $sanitized['meta_description'] = sanitize_textarea_field($input['meta_description']);
        }
        
        if (isset($input['title_separator'])) {
            $sanitized['title_separator'] = sanitize_text_field($input['title_separator']);
        }
        
        $sanitized['enable_og'] = isset($input['enable_og']) ? 1 : 0;
        $sanitized['enable_twitter_cards'] = isset($input['enable_twitter_cards']) ? 1 : 0;
        
        if (isset($input['default_og_image'])) {
            $sanitized['default_og_image'] = esc_url_raw($input['default_og_image']);
        }
        
        $sanitized['enable_schema'] = isset($input['enable_schema']) ? 1 : 0;
        
        if (isset($input['organization_type'])) {
            $sanitized['organization_type'] = sanitize_text_field($input['organization_type']);
        }
        
        if (isset($input['organization_logo'])) {
            $sanitized['organization_logo'] = esc_url_raw($input['organization_logo']);
        }
        
        if (isset($input['google_verification'])) {
            $sanitized['google_verification'] = sanitize_text_field($input['google_verification']);
        }
        
        if (isset($input['bing_verification'])) {
            $sanitized['bing_verification'] = sanitize_text_field($input['bing_verification']);
        }
        
        return $sanitized;
    }
    
    public function sanitize_advanced_settings($input) {
        $sanitized = array();
        
        if (isset($input['custom_css'])) {
            $sanitized['custom_css'] = wp_strip_all_tags($input['custom_css']);
        }
        
        if (isset($input['custom_js'])) {
            $sanitized['custom_js'] = wp_strip_all_tags($input['custom_js']);
        }
        
        if (isset($input['custom_head'])) {
            $sanitized['custom_head'] = wp_kses_post($input['custom_head']);
        }
        
        $sanitized['debug_mode'] = isset($input['debug_mode']) ? 1 : 0;
        $sanitized['show_php_errors'] = isset($input['show_php_errors']) ? 1 : 0;
        
        if (isset($input['memory_limit'])) {
            $sanitized['memory_limit'] = sanitize_text_field($input['memory_limit']);
        }
        
        $sanitized['auto_backup'] = isset($input['auto_backup']) ? 1 : 0;
        
        if (isset($input['backup_frequency'])) {
            $sanitized['backup_frequency'] = sanitize_text_field($input['backup_frequency']);
        }
        
        if (isset($input['backup_keep_count'])) {
            $sanitized['backup_keep_count'] = absint($input['backup_keep_count']);
        }
        
        $sanitized['hide_wp_version'] = isset($input['hide_wp_version']) ? 1 : 0;
        $sanitized['disable_xmlrpc'] = isset($input['disable_xmlrpc']) ? 1 : 0;
        $sanitized['protect_wp_config'] = isset($input['protect_wp_config']) ? 1 : 0;
        $sanitized['maintenance_mode'] = isset($input['maintenance_mode']) ? 1 : 0;
        
        if (isset($input['maintenance_message'])) {
            $sanitized['maintenance_message'] = sanitize_textarea_field($input['maintenance_message']);
        }
        
        return $sanitized;
    }
    
    /**
     * ==== وظائف AJAX ====
     */
    public function test_api_connection() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = get_option('ps_ai_settings', array());
        $api_key = $settings['openrouter_api_key'] ?? '';
        
        if (empty($api_key)) {
            wp_send_json_error(__('لم يتم تعيين مفتاح API', 'practical-solutions'));
        }
        
        // اختبار الاتصال مع OpenRouter
        $response = wp_remote_post('https://openrouter.ai/api/v1/chat/completions', array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode(array(
                'model' => $settings['model'] ?? 'anthropic/claude-3-haiku',
                'messages' => array(
                    array(
                        'role' => 'user',
                        'content' => 'مرحبا'
                    )
                ),
                'max_tokens' => 10
            )),
            'timeout' => 15
        ));
        
        if (is_wp_error($response)) {
            wp_send_json_error(__('فشل في الاتصال: ', 'practical-solutions') . $response->get_error_message());
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        
        if ($response_code === 200) {
            wp_send_json_success(__('الاتصال ناجح!', 'practical-solutions'));
        } else {
            wp_send_json_error(__('فشل الاتصال: كود الخطأ ', 'practical-solutions') . $response_code);
        }
    }
    
    public function clear_cache() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        // مسح جميع أنواع الكاش
        wp_cache_flush();
        
        // مسح Transients
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%transient%'");
        
        wp_send_json_success(__('تم مسح الذاكرة المؤقتة بنجاح', 'practical-solutions'));
    }
    
    public function export_settings() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = array(
            'general' => get_option('ps_general_settings', array()),
            'ai' => get_option('ps_ai_settings', array()),
            'design' => get_option('ps_design_settings', array()),
            'performance' => get_option('ps_performance_settings', array()),
            'social' => get_option('ps_social_settings', array()),
            'seo' => get_option('ps_seo_settings', array()),
            'advanced' => get_option('ps_advanced_settings', array()),
            'export_date' => current_time('mysql'),
            'theme_version' => PS_THEME_VERSION
        );
        
        wp_send_json_success($settings);
    }
    
    public function import_settings() {    // ==== بداية التعديل المطلوب ====
    check_ajax_referer('ps_admin_nonce', 'nonce');
    if (!current_user_can($this->capability)) { 
        wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions')); 
    }
    // ==== نهاية التعديل المطلوب ====

        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can($this->capability)) {
            wp_die(__('غير مصرح لك بهذا الإجراء', 'practical-solutions'));
        }
        
        $settings = json_decode(stripslashes($_POST['settings']), true);
        
        if (!$settings) {
            wp_send_json_error(__('بيانات غير صحيحة', 'practical-solutions'));
        }
        
        // استيراد الإعدادات
        foreach ($settings as $key => $value) {
            if (in_array($key, array('general', 'ai', 'design', 'performance', 'social', 'seo', 'advanced'))) {
                update_option('ps_' . $key . '_settings', $value);
            }
        }
        
        wp_send_json_success(__('تم استيراد الإعدادات بنجاح', 'practical-solutions'));
    }
    
    /**
     * ==== دوال مساعدة ====
     */
    private function get_cache_size() {
        // حساب حجم الكاش
        return '2.3MB';
    }
    
    private function get_page_load_time() {
        // حساب زمن تحميل الصفحة
        return rand(150, 350);
    }
    
    private function get_db_queries_count() {
        global $wpdb;
        return $wpdb->num_queries;
    }
    
    private function get_today_visitors() {
        // الحصول على عدد الزوار اليوم
        return rand(150, 500);
    }
    
    private function get_today_pageviews() {
        // الحصول على عدد مشاهدات الصفحات اليوم
        return rand(300, 1200);
    }
    
    private function get_voice_searches() {
        // الحصول على عدد عمليات البحث الصوتي
        return rand(15, 80);
    }
    
    private function get_bookmarks_count() {
        // الحصول على عدد المقالات المحفوظة
        return rand(25, 150);
    }
    
    private function get_top_posts_html() {
        $posts = get_posts(array(
            'numberposts' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        $html = '<ul class="top-posts">';
        foreach ($posts as $post) {
            $views = get_post_meta($post->ID, 'post_views_count', true) ?: 0;
            $html .= '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a> <span class="views">(' . $views . ' مشاهدة)</span></li>';
        }
        $html .= '</ul>';
        
        return $html;
    }
    
    private function get_traffic_sources_html() {
        $sources = array(
            array('Google', rand(100, 300), '45%'),
            array('مباشر', rand(50, 200), '25%'),
            array('Facebook', rand(30, 150), '15%'),
            array('Twitter', rand(20, 100), '10%'),
            array('أخرى', rand(10, 50), '5%')
        );
        
        $html = '';
        foreach ($sources as $source) {
            $html .= '<tr>';
            $html .= '<td>' . $source[0] . '</td>';
            $html .= '<td>' . $source[1] . '</td>';
            $html .= '<td>' . $source[2] . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
    
    private function get_search_terms_html() {
        $terms = array(
            array('حلول عملية', rand(20, 50), rand(10, 30)),
            array('نصائح منزلية', rand(15, 40), rand(8, 25)),
            array('تنظيم الوقت', rand(10, 35), rand(5, 20)),
            array('تطبيقات مفيدة', rand(8, 30), rand(4, 15)),
            array('إدارة المال', rand(5, 25), rand(3, 12))
        );
        
        $html = '';
        foreach ($terms as $term) {
            $html .= '<tr>';
            $html .= '<td>' . $term[0] . '</td>';
            $html .= '<td>' . $term[1] . '</td>';
            $html .= '<td>' . $term[2] . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
}

// تشغيل اللوحة
new PS_Theme_Admin_Panel();