# دليل المطورين - قالب الحلول العملية 
## Practical Solutions WordPress Theme Developer Guide

---

## 📋 جدول المحتويات

1. [نظرة عامة](#نظرة-عامة)
2. [هيكل الملفات](#هيكل-الملفات)
3. [المتغيرات والإعدادات](#المتغيرات-والإعدادات)
4. [الوظائف الأساسية](#الوظائف-الأساسية)
5. [التخصيص والتوسع](#التخصيص-والتوسع)
6. [إضافة ميزات جديدة](#إضافة-ميزات-جديدة)
7. [تحسين الأداء](#تحسين-الأداء)
8. [الأمان](#الأمان)
9. [التحديث والصيانة](#التحديث-والصيانة)
10. [استكشاف الأخطاء](#استكشاف-الأخطاء)

---

## 🌟 نظرة عامة

قالب "الحلول العملية" هو قالب ووردبريس حديث مصمم ليبدو ويعمل مثل تطبيق الهاتف المحمول. يهدف إلى تقديم حلول عملية للمشاكل اليومية في المنزل والمطبخ والحياة.

### الميزات الأساسية:
- 📱 تصميم يشبه التطبيق (App-like Design)
- 🔍 بحث مباشر مع دعم البحث الصوتي
- 🌙 وضع مظلم قابل للتخصيص
- ⚡ أداء محسن وسرعة تحميل عالية
- 📊 تتبع تفاعل المستخدمين
- 🔄 دعم PWA (Progressive Web App)
- 🎨 تخصيص كامل للألوان والتخطيط

---

## 📁 هيكل الملفات

```
practical-solutions/
├── style.css                 # ملف CSS الرئيسي
├── index.php                 # الصفحة الرئيسية
├── header.php                # رأس الصفحة
├── footer.php                # تذييل الصفحة
├── single.php                # صفحة المقال الواحد
├── functions.php             # وظائف القالب
├── archive.php               # صفحة الأرشيف
├── search.php                # صفحة نتائج البحث
├── 404.php                   # صفحة الخطأ 404
├── comments.php              # نموذج التعليقات
├── sidebar.php               # الشريط الجانبي
├── manifest.json             # ملف PWA
├── sw.js                     # Service Worker
├── assets/
│   ├── js/
│   │   ├── app.js           # JavaScript الرئيسي
│   │   ├── search.js        # وظائف البحث
│   │   └── pwa.js           # وظائف PWA
│   ├── css/
│   │   ├── components.css   # تنسيقات المكونات
│   │   ├── responsive.css   # التصميم المتجاوب
│   │   └── dark-mode.css    # تنسيقات الوضع المظلم
│   ├── images/
│   │   ├── logo.png         # شعار الموقع
│   │   ├── placeholder.jpg  # صورة افتراضية
│   │   └── icons/           # أيقونات التطبيق
│   └── fonts/               # الخطوط المخصصة
├── languages/               # ملفات الترجمة
│   ├── ar.po
│   ├── ar.mo
│   └── practical-solutions.pot
├── inc/                     # الملفات المساعدة
│   ├── customizer.php       # إعدادات التخصيص
│   ├── post-types.php       # أنواع المنشورات المخصصة
│   ├── widgets.php          # الودجات المخصصة
│   ├── ajax-handlers.php    # معالجات AJAX
│   ├── security.php         # إعدادات الأمان
│   └── performance.php      # تحسينات الأداء
└── templates/               # قوالب مخصصة
    ├── parts/
    │   ├── header-mobile.php
    │   ├── navigation.php
    │   └── content-card.php
    └── pages/
        ├── about.php
        └── contact.php
```

---

## ⚙️ المتغيرات والإعدادات

### متغيرات CSS الأساسية

```css
:root {
    /* الألوان الأساسية */
    --primary-color: #4a90e2;
    --secondary-color: #f39c12;
    --success-color: #27ae60;
    --danger-color: #e74c3c;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    
    /* التدرجات */
    --gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    
    /* الظلال والحدود */
    --card-shadow: 0 8px 25px rgba(0,0,0,0.1);
    --border-radius: 12px;
    
    /* الخطوط */
    --font-arabic: 'Cairo', 'Tajawal', sans-serif;
    --font-size-base: 16px;
    --line-height-base: 1.6;
    
    /* المسافات */
    --spacing-xs: 5px;
    --spacing-sm: 10px;
    --spacing-md: 20px;
    --spacing-lg: 30px;
    --spacing-xl: 40px;
}
```

### إعدادات PHP

```php
// إعدادات القالب الافتراضية
define('THEME_VERSION', '1.0.0');
define('THEME_TEXTDOMAIN', 'practical-solutions');

// إعدادات الأداء
define('ENABLE_CACHE', true);
define('CACHE_DURATION', 3600); // ساعة واحدة

// إعدادات البحث
define('SEARCH_RESULTS_PER_PAGE', 10);
define('ENABLE_VOICE_SEARCH', true);

// إعدادات PWA
define('ENABLE_PWA', true);
define('PWA_CACHE_NAME', 'practical-solutions-v1');
```

---

## 🔧 الوظائف الأساسية

### 1. إعداد القالب
```php
function practical_solutions_setup() {
    // دعم اللغة العربية
    load_theme_textdomain('practical-solutions', get_template_directory() . '/languages');
    
    // دعم الصور المميزة
    add_theme_support('post-thumbnails');
    
    // أحجام الصور المخصصة
    add_image_size('card-thumb', 400, 250, true);
    add_image_size('hero-thumb', 800, 400, true);
    add_image_size('mobile-thumb', 300, 200, true);
}
```

### 2. البحث المباشر
```php
function practical_solutions_live_search() {
    $query = sanitize_text_field($_POST['query']);
    
    $search_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        's' => $query,
        'orderby' => 'relevance',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'featured_post',
                'value' => '1',
                'compare' => '='
            ),
            array(
                'key' => 'post_views',
                'value' => 100,
                'compare' => '>='
            )
        )
    ));
    
    // إرجاع النتائج بصيغة JSON
    wp_send_json_success($results);
}
```

### 3. تتبع المشاهدات
```php
function practical_solutions_track_views($post_id) {
    $key = 'post_views';
    $count = get_post_meta($post_id, $key, true);
    
    if ($count == '') {
        add_post_meta($post_id, $key, '1');
    } else {
        update_post_meta($post_id, $key, $count + 1);
    }
    
    // إضافة إلى إحصائيات Google Analytics
    if (function_exists('gtag')) {
        gtag('event', 'page_view', array(
            'page_title' => get_the_title($post_id),
            'page_location' => get_permalink($post_id)
        ));
    }
}
```

---

## 🎨 التخصيص والتوسع

### 1. إضافة ألوان جديدة

```php
// في functions.php
function add_custom_color_scheme($wp_customize) {
    $wp_customize->add_setting('accent_color', array(
        'default' => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => __('لون التمييز', 'practical-solutions'),
        'section' => 'practical_colors',
    )));
}
add_action('customize_register', 'add_custom_color_scheme');
```

### 2. إضافة نوع منشور مخصص

```php
// في inc/post-types.php
function register_solutions_post_type() {
    $labels = array(
        'name' => 'الحلول المتقدمة',
        'singular_name' => 'حل متقدم',
        'add_new' => 'إضافة حل جديد',
        'add_new_item' => 'إضافة حل متقدم جديد',
        'edit_item' => 'تحرير الحل',
        'new_item' => 'حل جديد',
        'view_item' => 'عرض الحل',
        'search_items' => 'البحث في الحلول',
        'not_found' => 'لم يتم العثور على حلول',
        'not_found_in_trash' => 'لا توجد حلول في سلة المهملات'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-lightbulb',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'rewrite' => array('slug' => 'advanced-solutions'),
        'show_in_rest' => true, // دعم Gutenberg
    );
    
    register_post_type('advanced_solution', $args);
}
add_action('init', 'register_solutions_post_type');
```

### 3. إضافة حقول مخصصة

```php
// إضافة meta boxes للحقول المخصصة
function add_solution_meta_boxes() {
    add_meta_box(
        'solution-details',
        'تفاصيل الحل',
        'solution_details_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_solution_meta_boxes');

function solution_details_callback($post) {
    wp_nonce_field('save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, 'difficulty_level', true);
    $time_required = get_post_meta($post->ID, 'time_required', true);
    $materials = get_post_meta($post->ID, 'required_materials', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="difficulty_level">مستوى الصعوبة</label></th>
            <td>
                <select name="difficulty_level" id="difficulty_level">
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="time_required">الوقت المطلوب (بالدقائق)</label></th>
            <td><input type="number" name="time_required" id="time_required" value="<?php echo $time_required; ?>" /></td>
        </tr>
        <tr>
            <th><label for="required_materials">المواد المطلوبة</label></th>
            <td><textarea name="required_materials" id="required_materials" rows="5" cols="50"><?php echo $materials; ?></textarea></td>
        </tr>
    </table>
    <?php
}
```

---

## ✨ إضافة ميزات جديدة

### 1. إضافة نظام تقييم متقدم

```javascript
// في assets/js/rating-system.js
class AdvancedRating {
    constructor(postId) {
        this.postId = postId;
        this.init();
    }
    
    init() {
        this.createRatingInterface();
        this.bindEvents();
        this.loadExistingRatings();
    }
    
    createRatingInterface() {
        const ratingHTML = `
            <div class="advanced-rating">
                <h4>قيم هذا الحل</h4>
                <div class="rating-categories">
                    <div class="rating-category">
                        <label>سهولة التطبيق</label>
                        <div class="stars" data-category="ease">
                            ${this.createStars()}
                        </div>
                    </div>
                    <div class="rating-category">
                        <label>فعالية الحل</label>
                        <div class="stars" data-category="effectiveness">
                            ${this.createStars()}
                        </div>
                    </div>
                    <div class="rating-category">
                        <label>وضوح الشرح</label>
                        <div class="stars" data-category="clarity">
                            ${this.createStars()}
                        </div>
                    </div>
                </div>
                <button class="submit-rating">إرسال التقييم</button>
            </div>
        `;
        
        document.querySelector('.article-rating').innerHTML = ratingHTML;
    }
    
    createStars() {
        let starsHTML = '';
        for (let i = 1; i <= 5; i++) {
            starsHTML += `<span class="star" data-rating="${i}">⭐</span>`;
        }
        return starsHTML;
    }
    
    bindEvents() {
        // إضافة أحداث النقر على النجوم
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', (e) => {
                this.selectRating(e.target);
            });
        });
        
        // إرسال التقييم
        document.querySelector('.submit-rating').addEventListener('click', () => {
            this.submitRating();
        });
    }
    
    selectRating(star) {
        const rating = star.dataset.rating;
        const category = star.closest('.stars').dataset.category;
        const stars = star.closest('.stars').querySelectorAll('.star');
        
        // تحديث المظهر
        stars.forEach((s, index) => {
            s.classList.toggle('selected', index < rating);
        });
        
        // حفظ التقييم
        this.ratings = this.ratings || {};
        this.ratings[category] = rating;
    }
    
    async submitRating() {
        if (!this.ratings || Object.keys(this.ratings).length < 3) {
            this.showMessage('يرجى تقييم جميع الفئات', 'warning');
            return;
        }
        
        try {
            const response = await fetch(practicalAjax.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=submit_advanced_rating&post_id=${this.postId}&ratings=${JSON.stringify(this.ratings)}&nonce=${practicalAjax.nonce}`
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showMessage('شكراً لتقييمك!', 'success');
                this.disableRating();
            } else {
                this.showMessage('حدث خطأ أثناء إرسال التقييم', 'error');
            }
        } catch (error) {
            this.showMessage('حدث خطأ في الاتصال', 'error');
        }
    }
}
```

### 2. إضافة نظام الإشعارات

```php
// في inc/notifications.php
class PracticalNotifications {
    
    public function __construct() {
        add_action('wp_ajax_subscribe_notifications', array($this, 'subscribe_user'));
        add_action('wp_ajax_nopriv_subscribe_notifications', array($this, 'subscribe_user'));
        add_action('publish_post', array($this, 'send_new_post_notification'));
    }
    
    public function subscribe_user() {
        $email = sanitize_email($_POST['email']);
        $categories = array_map('sanitize_text_field', $_POST['categories']);
        
        // حفظ الاشتراك في قاعدة البيانات
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'practical_subscriptions';
        
        $result = $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
                'categories' => json_encode($categories),
                'subscribed_at' => current_time('mysql'),
                'status' => 'active'
            )
        );
        
        if ($result) {
            // إرسال إيميل ترحيب
            $this->send_welcome_email($email);
            wp_send_json_success('تم الاشتراك بنجاح');
        } else {
            wp_send_json_error('حدث خطأ أثناء الاشتراك');
        }
    }
    
    public function send_new_post_notification($post_id) {
        $post = get_post($post_id);
        
        if ($post->post_type !== 'post' || $post->post_status !== 'publish') {
            return;
        }
        
        // الحصول على المشتركين المهتمين
        $subscribers = $this->get_interested_subscribers($post_id);
        
        foreach ($subscribers as $subscriber) {
            $this->send_notification_email($subscriber->email, $post_id);
        }
    }
    
    private function send_notification_email($email, $post_id) {
        $post = get_post($post_id);
        $subject = 'حل جديد: ' . $post->post_title;
        
        $message = "
        <html>
        <body style='font-family: Arial, sans-serif; direction: rtl;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #4a90e2;'>حل عملي جديد!</h2>
                <h3>{$post->post_title}</h3>
                <p>" . wp_trim_words($post->post_content, 30) . "</p>
                <a href='" . get_permalink($post_id) . "' style='background: #4a90e2; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>
                    اقرأ الحل كاملاً
                </a>
                <hr style='margin: 30px 0;'>
                <p style='font-size: 12px; color: #666;'>
                    <a href='" . home_url('/unsubscribe?email=' . urlencode($email)) . "'>إلغاء الاشتراك</a>
                </p>
            </div>
        </body>
        </html>
        ";
        
        wp_mail($email, $subject, $message, array('Content-Type: text/html; charset=UTF-8'));
    }
}

new PracticalNotifications();
```

---

## ⚡ تحسين الأداء

### 1. تحسين الصور

```php
// في inc/performance.php
function optimize_images() {
    // تفعيل الضغط
    add_filter('jpeg_quality', function() { return 85; });
    
    // إضافة أحجام مخصصة للشاشات المختلفة
    add_image_size('mobile-retina', 600, 400, true);
    add_image_size('tablet', 768, 512, true);
    add_image_size('desktop', 1200, 800, true);
    
    // تحسين خاصيات الصور
    add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
        return $attr;
    }, 10, 3);
}
add_action('after_setup_theme', 'optimize_images');
```

### 2. تحسين CSS و JavaScript

```php
function optimize_assets() {
    // دمج وضغط ملفات CSS
    if (!is_admin()) {
        add_action('wp_enqueue_scripts', function() {
            // إزالة ملفات CSS غير المطلوبة
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            
            // تحميل ملف CSS مدموج ومضغوط
            wp_enqueue_style('practical-optimized', get_template_directory_uri() . '/assets/css/optimized.min.css', array(), THEME_VERSION);
        }, 100);
    }
}
add_action('init', 'optimize_assets');
```

### 3. التخزين المؤقت

```php
// في inc/cache.php
class PracticalCache {
    
    private $cache_group = 'practical_solutions';
    private $cache_time = 3600; // ساعة واحدة
    
    public function get($key) {
        return wp_cache_get($key, $this->cache_group);
    }
    
    public function set($key, $data, $expiration = null) {
        $expiration = $expiration ?: $this->cache_time;
        return wp_cache_set($key, $data, $this->cache_group, $expiration);
    }
    
    public function delete($key) {
        return wp_cache_delete($key, $this->cache_group);
    }
    
    public function get_popular_posts($limit = 5) {
        $cache_key = 'popular_posts_' . $limit;
        $posts = $this->get($cache_key);
        
        if (false === $posts) {
            $posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => $limit,
                'meta_key' => 'post_views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
            ));
            
            $this->set($cache_key, $posts);
        }
        
        return $posts;
    }
}

// استخدام الكلاس
$practical_cache = new PracticalCache();
```

---

## 🔒 الأمان

### 1. تنظيف البيانات

```php
// في inc/security.php
function sanitize_search_query($query) {
    // إزالة HTML tags
    $query = strip_tags($query);
    
    // إزالة المسافات الزائدة
    $query = trim($query);
    
    // منع SQL injection
    $query = esc_sql($query);
    
    // تحديد طول الاستعلام
    if (strlen($query) > 100) {
        $query = substr($query, 0, 100);
    }
    
    return $query;
}

function validate_rating_data($data) {
    $allowed_categories = array('ease', 'effectiveness', 'clarity');
    $clean_data = array();
    
    foreach ($data as $category => $rating) {
        if (in_array($category, $allowed_categories) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
            $clean_data[$category] = intval($rating);
        }
    }
    
    return $clean_data;
}
```

### 2. الحماية من الهجمات

```php
// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit;
}

// تحديد عدد محاولات البحث لمنع الإساءة
function limit_search_attempts() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $cache_key = 'search_attempts_' . md5($user_ip);
    $attempts = wp_cache_get($cache_key);
    
    if (false === $attempts) {
        $attempts = 0;
    }
    
    if ($attempts > 50) { // 50 محاولة بحث في الساعة
        wp_die('تم تجاوز الحد المسموح لمحاولات البحث');
    }
    
    wp_cache_set($cache_key, $attempts + 1, '', 3600);
}
add_action('wp_ajax_live_search', 'limit_search_attempts', 1);
add_action('wp_ajax_nopriv_live_search', 'limit_search_attempts', 1);
```

---

## 🔄 التحديث والصيانة

### 1. نظام التحديث التلقائي

```php
// في inc/updater.php
class ThemeUpdater {
    
    private $theme_slug;
    private $version;
    private $update_server;
    
    public function __construct() {
        $this->theme_slug = get_template();
        $this->version = wp_get_theme()->get('Version');
        $this->update_server = 'https://updates.your-site.com/';
        
        add_filter('pre_set_site_transient_update_themes', array($this, 'check_for_update'));
    }
    
    public function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        
        $remote_version = $this->get_remote_version();
        
        if (version_compare($this->version, $remote_version, '<')) {
            $transient->response[$this->theme_slug] = array(
                'theme' => $this->theme_slug,
                'new_version' => $remote_version,
                'url' => $this->update_server,
                'package' => $this->get_download_url()
            );
        }
        
        return $transient;
    }
    
    private function get_remote_version() {
        $request = wp_remote_get($this->update_server . 'check-version.php?theme=' . $this->theme_slug);
        
        if (!is_wp_error($request) && wp_remote_retrieve_response_code($request) === 200) {
            return wp_remote_retrieve_body($request);
        }
        
        return false;
    }
}

new ThemeUpdater();
```

### 2. تنظيف قاعدة البيانات

```php
// تنظيف دوري لقاعدة البيانات
function cleanup_database() {
    global $wpdb;
    
    // حذف التقييمات القديمة (أكثر من سنة)
    $wpdb->query("
        DELETE FROM {$wpdb->postmeta} 
        WHERE meta_key LIKE '%_rating%' 
        AND post_id IN (
            SELECT ID FROM {$wpdb->posts} 
            WHERE post_date < DATE_SUB(NOW(), INTERVAL 1 YEAR)
        )
    ");
    
    // حذف البيانات المؤقتة المنتهية الصلاحية
    wp_cache_flush();
    
    // تحسين جداول قاعدة البيانات
    $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
}

// تشغيل التنظيف أسبوعياً
if (!wp_next_scheduled('practical_cleanup')) {
    wp_schedule_event(time(), 'weekly', 'practical_cleanup');
}
add_action('practical_cleanup', 'cleanup_database');
```

---

## 🐛 استكشاف الأخطاء

### 1. تسجيل الأخطاء

```php
// في inc/debug.php
function log_practical_error($message, $context = array()) {
    if (WP_DEBUG && WP_DEBUG_LOG) {
        $log_message = '[Practical Solutions] ' . $message;
        
        if (!empty($context)) {
            $log_message .= ' | Context: ' . json_encode($context);
        }
        
        error_log($log_message);
    }
}

// مثال على الاستخدام
function practical_solutions_ajax_handler() {
    try {
        // كود المعالجة
        $result = perform_complex_operation();
        wp_send_json_success($result);
        
    } catch (Exception $e) {
        log_practical_error('AJAX Error: ' . $e->getMessage(), array(
            'function' => __FUNCTION__,
            'user_id' => get_current_user_id(),
            'post_data' => $_POST
        ));
        
        wp_send_json_error('حدث خطأ أثناء المعالجة');
    }
}
```

### 2. أدوات التشخيص

```php
// إضافة صفحة تشخيص في لوحة التحكم
function add_diagnostic_page() {
    add_theme_page(
        'تشخيص القالب',
        'تشخيص القالب',
        'manage_options',
        'practical-diagnostics',
        'practical_diagnostics_page'
    );
}
add_action('admin_menu', 'add_diagnostic_page');

function practical_diagnostics_page() {
    ?>
    <div class="wrap">
        <h1>تشخيص قالب الحلول العملية</h1>
        
        <div class="card">
            <h2>معلومات النظام</h2>
            <table class="widefat">
                <tr>
                    <td><strong>إصدار القالب:</strong></td>
                    <td><?php echo wp_get_theme()->get('Version'); ?></td>
                </tr>
                <tr>
                    <td><strong>إصدار ووردبريس:</strong></td>
                    <td><?php echo get_bloginfo('version'); ?></td>
                </tr>
                <tr>
                    <td><strong>إصدار PHP:</strong></td>
                    <td><?php echo PHP_VERSION; ?></td>
                </tr>
                <tr>
                    <td><strong>حالة التخزين المؤقت:</strong></td>
                    <td><?php echo wp_using_ext_object_cache() ? 'مفعل' : 'غير مفعل'; ?></td>
                </tr>
            </table>
        </div>
        
        <div class="card">
            <h2>إحصائيات الأداء</h2>
            <?php
            $stats = get_performance_stats();
            ?>
            <table class="widefat">
                <tr>
                    <td><strong>متوسط وقت تحميل الصفحة:</strong></td>
                    <td><?php echo $stats['avg_load_time']; ?> ثانية</td>
                </tr>
                <tr>
                    <td><strong>عدد الاستعلامات في الصفحة:</strong></td>
                    <td><?php echo get_num_queries(); ?></td>
                </tr>
                <tr>
                    <td><strong>استخدام الذاكرة:</strong></td>
                    <td><?php echo size_format(memory_get_usage(true)); ?></td>
                </tr>
            </table>
        </div>
        
        <div class="card">
            <h2>اختبار الوظائف</h2>
            <button type="button" class="button" onclick="testSearchFunction()">اختبار البحث</button>
            <button type="button" class="button" onclick="testCacheSystem()">اختبار التخزين المؤقت</button>
            <button type="button" class="button" onclick="testImageOptimization()">اختبار تحسين الصور</button>
            <div id="test-results"></div>
        </div>
    </div>
    
    <script>
    function testSearchFunction() {
        fetch(ajaxurl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=test_search&query=test'
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('test-results').innerHTML = 
                '<p>نتيجة اختبار البحث: ' + (data.success ? 'نجح' : 'فشل') + '</p>';
        });
    }
    </script>
    <?php
}
```

---

## 🚀 نشر القالب كـ PWA

### 1. ملف Manifest

```json
// manifest.json
{
    "name": "الحلول العملية",
    "short_name": "حلول عملية",
    "description": "تطبيق الحلول العملية للمشاكل اليومية",
    "start_url": "/",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#4a90e2",
    "orientation": "portrait",
    "icons": [
        {
            "src": "assets/icons/icon-72x72.png",
            "sizes": "72x72",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-96x96.png",
            "sizes": "96x96",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-128x128.png",
            "sizes": "128x128",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-144x144.png",
            "sizes": "144x144",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-152x152.png",
            "sizes": "152x152",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-192x192.png",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-384x384.png",
            "sizes": "384x384",
            "type": "image/png"
        },
        {
            "src": "assets/icons/icon-512x512.png",
            "sizes": "512x512",
            "type": "image/png"
        }
    ]
}
```

### 2. Service Worker

```javascript
// sw.js
const CACHE_NAME = 'practical-solutions-v1';
const STATIC_CACHE = 'practical-static-v1';
const DYNAMIC_CACHE = 'practical-dynamic-v1';

const STATIC_FILES = [
    '/',
    '/wp-content/themes/practical-solutions/style.css',
    '/wp-content/themes/practical-solutions/assets/js/app.js',
    '/wp-content/themes/practical-solutions/assets/images/logo.png',
    'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => cache.addAll(STATIC_FILES))
            .then(() => self.skipWaiting())
    );
});

// تفعيل Service Worker
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// اعتراض الطلبات
self.addEventListener('fetch', event => {
    // استراتيجية Cache First للملفات الثابتة
    if (STATIC_FILES.includes(event.request.url)) {
        event.respondWith(
            caches.match(event.request)
                .then(response => response || fetch(event.request))
        );
        return;
    }
    
    // استراتيجية Network First للمحتوى الديناميكي
    event.respondWith(
        fetch(event.request)
            .then(response => {
                const responseClone = response.clone();
                caches.open(DYNAMIC_CACHE)
                    .then(cache => cache.put(event.request, responseClone));
                return response;
            })
            .catch(() => caches.match(event.request))
    );
});

// إضافة دعم للإشعارات
self.addEventListener('push', event => {
    const options = {
        body: event.data ? event.data.text() : 'حل جديد متاح!',
        icon: '/wp-content/themes/practical-solutions/assets/icons/icon-192x192.png',
        badge: '/wp-content/themes/practical-solutions/assets/icons/badge-72x72.png',
        vibrate: [200, 100, 200],
        data: {
            url: '/'
        },
        actions: [
            {
                action: 'view',
                title: 'عرض الحل',
                icon: '/wp-content/themes/practical-solutions/assets/icons/view-icon.png'
            },
            {
                action: 'close',
                title: 'إغلاق',
                icon: '/wp-content/themes/practical-solutions/assets/icons/close-icon.png'
            }
        ]
    };
    
    event.waitUntil(
        self.registration.showNotification('الحلول العملية', options)
    );
});

// التعامل مع النقر على الإشعارات
self.addEventListener('notificationclick', event => {
    event.notification.close();
    
    if (event.action === 'view') {
        event.waitUntil(
            clients.openWindow(event.notification.data.url)
        );
    }
});
```

---

## 📊 مراقبة الأداء والتحليلات

### 1. تتبع الأداء

```javascript
// في assets/js/performance.js
class PerformanceMonitor {
    constructor() {
        this.metrics = {};
        this.init();
    }
    
    init() {
        // قياس أوقات التحميل
        window.addEventListener('load', () => {
            this.measureLoadTimes();
            this.measureCoreWebVitals();
            this.sendMetrics();
        });
    }
    
    measureLoadTimes() {
        const perfData = performance.getEntriesByType('navigation')[0];
        
        this.metrics.loadTime = perfData.loadEventEnd - perfData.loadEventStart;
        this.metrics.domContentLoaded = perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart;
        this.metrics.firstPaint = performance.getEntriesByType('paint')[0]?.startTime || 0;
        this.metrics.firstContentfulPaint = performance.getEntriesByType('paint')[1]?.startTime || 0;
    }
    
    measureCoreWebVitals() {
        // قياس Largest Contentful Paint (LCP)
        new PerformanceObserver((entryList) => {
            const entries = entryList.getEntries();
            const lastEntry = entries[entries.length - 1];
            this.metrics.lcp = lastEntry.startTime;
        }).observe({ entryTypes: ['largest-contentful-paint'] });
        
        // قياس First Input Delay (FID)
        new PerformanceObserver((entryList) => {
            const firstInput = entryList.getEntries()[0];
            this.metrics.fid = firstInput.processingStart - firstInput.startTime;
        }).observe({ entryTypes: ['first-input'] });
        
        // قياس Cumulative Layout Shift (CLS)
        let clsValue = 0;
        new PerformanceObserver((entryList) => {
            for (const entry of entryList.getEntries()) {
                if (!entry.hadRecentInput) {
                    clsValue += entry.value;
                }
            }
            this.metrics.cls = clsValue;
        }).observe({ entryTypes: ['layout-shift'] });
    }
    
    sendMetrics() {
        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=log_performance_metrics&metrics=${JSON.stringify(this.metrics)}`
        });
    }
}

// تشغيل مراقب الأداء
new PerformanceMonitor();
```

### 2. تحليلات الاستخدام

```php
// في inc/analytics.php
class UsageAnalytics {
    
    public function __construct() {
        add_action('wp_ajax_track_user_action', array($this, 'track_action'));
        add_action('wp_ajax_nopriv_track_user_action', array($this, 'track_action'));
        add_action('wp_footer', array($this, 'add_tracking_script'));
    }
    
    public function track_action() {
        $action = sanitize_text_field($_POST['action_type']);
        $data = array_map('sanitize_text_field', $_POST['data']);
        
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'practical_analytics';
        
        $wpdb->insert(
            $table_name,
            array(
                'action_type' => $action,
                'action_data' => json_encode($data),
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'timestamp' => current_time('mysql')
            )
        );
        
        wp_send_json_success();
    }
    
    public function add_tracking_script() {
        ?>
        <script>
        class Analytics {
            static track(action, data = {}) {
                fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=track_user_action&action_type=${action}&data=${JSON.stringify(data)}`
                });
            }
        }
        
        // تتبع النقرات على الحلول
        document.querySelectorAll('.content-card').forEach(card => {
            card.addEventListener('click', () => {
                Analytics.track('solution_click', {
                    title: card.querySelector('.card-title').textContent,
                    category: card.querySelector('.card-category').textContent
                });
            });
        });
        
        // تتبع البحث
        document.getElementById('searchInput').addEventListener('search', (e) => {
            Analytics.track('search_performed', {
                query: e.target.value,
                results_count: document.querySelectorAll('.search-result-item').length
            });
        });
        
        // تتبع وقت البقاء في الصفحة
        let startTime = Date.now();
        window.addEventListener('beforeunload', () => {
            const timeSpent = Date.now() - startTime;
            Analytics.track('page_time', {
                url: window.location.href,
                time_spent: timeSpent
            });
        });
        </script>
        <?php
    }
    
    public function get_analytics_dashboard() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'practical_analytics';
        
        // أكثر الحلول مشاهدة
        $popular_solutions = $wpdb->get_results("
            SELECT action_data, COUNT(*) as views 
            FROM {$table_name} 
            WHERE action_type = 'solution_click' 
            AND timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY action_data 
            ORDER BY views DESC 
            LIMIT 10
        ");
        
        // أكثر كلمات البحث
        $popular_searches = $wpdb->get_results("
            SELECT action_data, COUNT(*) as searches 
            FROM {$table_name} 
            WHERE action_type = 'search_performed' 
            AND timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY action_data 
            ORDER BY searches DESC 
            LIMIT 10
        ");
        
        return array(
            'popular_solutions' => $popular_solutions,
            'popular_searches' => $popular_searches,
            'total_users' => $wpdb->get_var("SELECT COUNT(DISTINCT ip_address) FROM {$table_name} WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY)"),
            'total_actions' => $wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY)")
        );
    }
}

new UsageAnalytics();
```

---

## 🔧 أدوات المطور المفيدة

### 1. سكريبت إنشاء المكونات تلقائياً

```bash
#!/bin/bash
# create-component.sh

COMPONENT_NAME=$1
THEME_DIR="wp-content/themes/practical-solutions"

if [ -z "$COMPONENT_NAME" ]; then
    echo "الاستخدام: ./create-component.sh ComponentName"
    exit 1
fi

# إنشاء ملف PHP للمكون
cat > "$THEME_DIR/templates/parts/component-${COMPONENT_NAME,,}.php" << EOF
<?php
/**
 * مكون: $COMPONENT_NAME
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

\$component_id = uniqid('${COMPONENT_NAME,,}_');
\$component_classes = isset(\$args['classes']) ? \$args['classes'] : '';
\$component_data = isset(\$args['data']) ? \$args['data'] : array();
?>

<div id="<?php echo \$component_id; ?>" class="${COMPONENT_NAME,,}-component <?php echo \$component_classes; ?>">
    <div class="${COMPONENT_NAME,,}-content">
        <!-- محتوى المكون هنا -->
        <h3><?php echo \$component_data['title'] ?? '$COMPONENT_NAME'; ?></h3>
        <p><?php echo \$component_data['description'] ?? 'وصف المكون'; ?></p>
    </div>
</div>

<style>
.${COMPONENT_NAME,,}-component {
    background: white;
    border-radius: var(--border-radius);
    padding: var(--spacing-md);
    box-shadow: var(--card-shadow);
    margin-bottom: var(--spacing-md);
}

.${COMPONENT_NAME,,}-content {
    /* تنسيقات المحتوى */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const component = document.getElementById('<?php echo \$component_id; ?>');
    
    // منطق JavaScript للمكون
    if (component) {
        console.log('$COMPONENT_NAME component loaded');
    }
});
</script>
EOF

# إنشاء دالة مساعدة
cat >> "$THEME_DIR/inc/components.php" << EOF

/**
 * عرض مكون $COMPONENT_NAME
 */
function render_${COMPONENT_NAME,,}_component(\$args = array()) {
    get_template_part('templates/parts/component-${COMPONENT_NAME,,}', null, \$args);
}
EOF

echo "تم إنشاء مكون $COMPONENT_NAME بنجاح!"
echo "ملف المكون: templates/parts/component-${COMPONENT_NAME,,}.php"
echo "دالة العرض: render_${COMPONENT_NAME,,}_component()"
```

### 2. أداة تحسين الصور تلقائياً

```php
// في inc/image-optimizer.php
class ImageOptimizer {
    
    public function __construct() {
        add_filter('wp_handle_upload', array($this, 'optimize_uploaded_image'));
        add_action('admin_menu', array($this, 'add_optimizer_page'));
    }
    
    public function optimize_uploaded_image($upload) {
        if (!$this->is_image($upload['file'])) {
            return $upload;
        }
        
        $this->compress_image($upload['file']);
        $this->generate_webp_version($upload['file']);
        
        return $upload;
    }
    
    private function compress_image($file_path) {
        $image_info = getimagesize($file_path);
        $mime_type = $image_info['mime'];
        
        switch ($mime_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file_path);
                imagejpeg($image, $file_path, 85); // ضغط بجودة 85%
                break;
                
            case 'image/png':
                $image = imagecreatefrompng($file_path);
                imagepng($image, $file_path, 6); // مستوى ضغط 6
                break;
        }
        
        if (isset($image)) {
            imagedestroy($image);
        }
    }
    
    private function generate_webp_version($file_path) {
        if (!function_exists('imagewebp')) {
            return false;
        }
        
        $image_info = getimagesize($file_path);
        $mime_type = $image_info['mime'];
        
        switch ($mime_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file_path);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file_path);
                break;
            default:
                return false;
        }
        
        $webp_path = preg_replace('/\.(jpe?g|png)$/i', '.webp', $file_path);
        imagewebp($image, $webp_path, 80);
        imagedestroy($image);
        
        return $webp_path;
    }
}

new ImageOptimizer();
```

---

## 📚 مراجع إضافية

### الموارد المفيدة:
- [WordPress Developer Handbook](https://developer.wordpress.org/)
- [Arabic Typography Guidelines](https://github.com/mandoura/arabic-typography)
- [PWA Development Guide](https://web.dev/progressive-web-apps/)
- [Performance Optimization](https://developers.google.com/web/fundamentals/performance)

### أدوات التطوير الموصى بها:
- **VS Code** مع إضافات: WordPress Snippets، Arabic Language Pack
- **Local by Flywheel** لتطوير ووردبريس محلياً
- **Chrome DevTools** لاختبار الأداء
- **GTmetrix** لقياس سرعة الموقع
- **Lighthouse** لاختبار جودة الموقع

### مجتمعات المطورين:
- [WordPress Arabic Community](https://ar.wordpress.org/support/)
- [GitHub - WordPress Arabic](https://github.com/topics/wordpress-arabic)
- [Stack Overflow - WordPress](https://stackoverflow.com/questions/tagged/wordpress)

---

## 🎯 خطة التطوير المستقبلية

### المرحلة القادمة (v1.1):
- [ ] إضافة دعم Gutenberg blocks مخصصة
- [ ] تطوير نظام التقييمات المتقدم
- [ ] إضافة دعم WooCommerce للبيع
- [ ] تحسين SEO والبحث المحلي

### المرحلة طويلة المدى (v2.0):
- [ ] تطوير تطبيق الهاتف المحمول
- [ ] إضافة الذكاء الاصطناعي للاقتراحات
- [ ] دعم المحتوى المرئي والفيديو
- [ ] نظام مكافآت للمستخدمين

---

## 📞 الدعم والمساعدة

للحصول على المساعدة أو الإبلاغ عن مشاكل:

- **البريد الإلكتروني**: developer@practical-solutions.com
- **GitHub Issues**: github.com/practical-solutions/theme
- **التوثيق**: docs.practical-solutions.com
- **المجتمع**: community.practical-solutions.com

---

*آخر تحديث: أغسطس 2025*

**ملاحظة**: هذا الدليل يتطور باستمرار. تأكد من مراجعة أحدث إصدار قبل البدء في التطوير.# دليل المطورين - قالب الحلول العملية 
## Practical Solutions WordPress Theme Developer Guide

---

## 📋 جدول المحتويات

1. [نظرة عامة](#نظرة-عامة)
2. [هي