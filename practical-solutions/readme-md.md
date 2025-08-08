# قالب الحلول العملية 🏠
## Practical Solutions WordPress Theme

[![النسخة](https://img.shields.io/badge/النسخة-1.0.0-blue.svg)](https://github.com/practical-solutions/theme)
[![ووردبريس](https://img.shields.io/badge/WordPress-6.0+-green.svg)](https://wordpress.org)
[![الترخيص](https://img.shields.io/badge/الترخيص-GPL--v2-orange.svg)](LICENSE)
[![اللغة](https://img.shields.io/badge/اللغة-العربية-red.svg)](#)

> قالب ووردبريس يشبه التطبيق مصمم خصيصاً لتقديم الحلول العملية للمشاكل اليومية في المنزل والمطبخ والحياة

---

## ✨ المميزات الرئيسية

### 📱 تصميم يشبه التطبيق
- واجهة مستخدم حديثة وسهلة الاستخدام
- تصميم متجاوب يعمل على جميع الأجهزة
- تجربة مستخدم سلسة ومريحة
- دعم كامل للغة العربية (RTL)

### 🔍 بحث متقدم وذكي
- بحث مباشر أثناء الكتابة
- دعم البحث الصوتي
- اقتراحات ذكية
- فلاتر بحث متقدمة
- تمييز نتائج البحث

### 🌙 وضع مظلم قابل للتخصيص
- تبديل سهل بين الوضع الفاتح والمظلم
- حفظ تفضيلات المستخدم
- ألوان محسنة للراحة البصرية

### ⚡ أداء محسن
- سرعة تحميل عالية
- تحسين الصور التلقائي
- تخزين مؤقت ذكي
- كود نظيف ومحسن

### 📊 تتبع وتحليلات
- إحصائيات المشاهدات
- تتبع تفاعل المستخدمين
- تحليلات البحث
- مراقبة الأداء

### 🔧 PWA (Progressive Web App)
- يعمل بدون اتصال إنترنت
- قابل للتثبيت على الهاتف
- إشعارات فورية
- تجربة تطبيق أصلي

---

## 🚀 التثبيت السريع

### المتطلبات الأساسية
- WordPress 6.0 أو أحدث
- PHP 8.0 أو أحدث  
- MySQL 5.7 أو أحدث
- Apache/Nginx مع mod_rewrite

### خطوات التثبيت

1. **تحميل القالب**
   ```bash
   git clone https://github.com/practical-solutions/theme.git
   cd theme
   ```

2. **رفع الملفات**
   ```bash
   # انسخ مجلد القالب إلى ووردبريس
   cp -r practical-solutions/ /wp-content/themes/
   ```

3. **تفعيل القالب**
   - اذهب إلى لوحة تحكم ووردبريس
   - المظهر > القوالب
   - فعل قالب "الحلول العملية"

4. **الإعداد الأولي**
   ```bash
   # إنشاء جداول قاعدة البيانات المطلوبة
   php setup-database.php
   ```

### التهيئة السريعة

```php
// في wp-config.php أضف:
define('PRACTICAL_SOLUTIONS_DEBUG', true);
define('PRACTICAL_SOLUTIONS_CACHE', true);
define('PRACTICAL_SOLUTIONS_PWA', true);
```

---

## 📚 الاستخدام

### إنشاء محتوى جديد

#### 1. إضافة حل عملي جديد
```php
// في functions.php المخصص
add_action('init', function() {
    $post_id = wp_insert_post(array(
        'post_title' => 'حل مشكلة تسريب الصنبور',
        'post_content' => 'محتوى الحل هنا...',
        'post_status' => 'publish',
        'meta_input' => array(
            'difficulty_level' => 'سهل',
            'time_required' => 15,
            'required_materials' => "مفتاح ربط\nشريط عزل\nقطعة قماش"
        )
    ));
});
```

#### 2. تخصيص الألوان
```css
:root {
    --primary-color: #4a90e2;    /* لونك الأساسي */
    --secondary-color: #f39c12;  /* لونك الثانوي */
    --accent-color: #e74c3c;     /* لون التمييز */
}
```

### إضافة مكونات مخصصة

```php
// إنشاء مكون جديد
function render_custom_component($args = array()) {
    $title = $args['title'] ?? 'العنوان الافتراضي';
    $content = $args['content'] ?? 'المحتوى الافتراضي';
    
    echo "<div class='custom-component'>";
    echo "<h3>{$title}</h3>";
    echo "<p>{$content}</p>";
    echo "</div>";
}

// استخدام المكون في القالب
render_custom_component(array(
    'title' => 'نصائح المطبخ',
    'content' => 'نصائح مفيدة لتنظيم المطبخ وتوفير الوقت'
));
```

---

## 🎨 التخصيص

### تخصيص الألوان

اذهب إلى **المظهر > تخصيص > ألوان القالب** لتغيير:
- اللون الأساسي
- اللون الثانوي  
- لون التمييز
- ألوان الوضع المظلم

### تخصيص التخطيط

```php
// في functions.php الخاص بك
function customize_practical_layout() {
    // تغيير عدد البطاقات في الصف
    add_filter('practical_cards_per_row', function() {
        return 4; // بدلاً من 3
    });
    
    // تخصيص الشريط الجانبي
    add_filter('practical_sidebar_position', function() {
        return 'left'; // بدلاً من 'right'
    });
}
add_action('after_setup_theme', 'customize_practical_layout');
```

### إضافة حقول مخصصة

```php
// إضافة حقل جديد للمقالات
function add_custom_solution_fields() {
    add_meta_box(
        'solution-cost',
        'تكلفة الحل',
        'solution_cost_callback',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'add_custom_solution_fields');

function solution_cost_callback($post) {
    $cost = get_post_meta($post->ID, 'solution_cost', true);
    echo '<input type="number" name="solution_cost" value="' . $cost . '" />';
}
```

---

## 🔧 إعدادات متقدمة

### تفعيل البحث الصوتي

```javascript
// في assets/js/custom.js
document.addEventListener('DOMContentLoaded', function() {
    if ('webkitSpeechRecognition' in window) {
        // البحث الصوتي متاح
        enableVoiceSearch();
    } else {
        // إخفاء زر البحث الصوتي
        hideVoiceSearchButton();
    }
});
```

### إعداد التخزين المؤقت

```php
// في wp-config.php
define('WP_CACHE', true);
define('PRACTICAL_CACHE_DURATION', 3600); // ساعة واحدة

// في functions.php
function setup_practical_cache() {
    if (defined('PRACTICAL_CACHE_DURATION')) {
        wp_cache_set_cache_duration(PRACTICAL_CACHE_DURATION);
    }
}
add_action('init', 'setup_practical_cache');
```

### إعداد PWA

```json
// في manifest.json
{
    "name": "اسم موقعك",
    "short_name": "اسم مختصر",
    "start_url": "/",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#4a90e2"
}
```

---

## 📊 الإحصائيات والتحليلات

### مراقبة الأداء

```php
// إضافة مراقبة مخصصة
function track_custom_metrics() {
    $load_time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    
    if ($load_time > 2.0) {
        error_log("صفحة بطيئة: " . $_SERVER['REQUEST_URI'] . " - {$load_time}s");
    }
}
add_action('wp_footer', 'track_custom_metrics');
```

### تحليلات البحث

```php
// عرض إحصائيات البحث
function get_search_analytics() {
    global $wpdb;
    
    $popular_searches = $wpdb->get_results("
        SELECT search_query, COUNT(*) as count 
        FROM {$wpdb->prefix}search_analytics 
        WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY search_query 
        ORDER BY count DESC 
        LIMIT 10
    ");
    
    return $popular_searches;
}
```

---

## 🔒 الأمان

### الحماية من الهجمات

```php
// في functions.php
function practical_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', 'practical_security_headers');
```

### تحديد معدل الطلبات

```php
// منع الإساءة في البحث
function limit_search_requests() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $cache_key = 'search_limit_' . md5($user_ip);
    $requests = wp_cache_get($cache_key);
    
    if ($requests === false) {
        $requests = 0;
    }
    
    if ($requests > 100) { // 100 طلب في الساعة
        wp_die('تم تجاوز حد الطلبات المسموح');
    }
    
    wp_cache_set($cache_key, $requests + 1, '', 3600);
}
```

---

## 🐛 استكشاف الأخطاء

### المشاكل الشائعة

#### 1. البحث لا يعمل
```php
// تحقق من إعدادات قاعدة البيانات
if (!function_exists('practical_search_test')) {
    function practical_search_test() {
        global $wpdb;
        $result = $wpdb->get_results("SHOW TABLES LIKE '{$wpdb->prefix}search_analytics'");
        if (empty($result)) {
            echo "جدول البحث غير موجود - تشغيل setup-database.php";
        }
    }
}
```

#### 2. الصور لا تظهر
```php
// تحقق من مسار الصور
function check_image_paths() {
    $upload_dir = wp_upload_dir();
    if (!is_writable($upload_dir['path'])) {
        echo "مجلد الصور غير قابل للكتابة";
    }
}
```

#### 3. الوضع المظلم لا يعمل
```javascript
// تحقق من دعم localStorage
if (typeof(Storage) === "undefined") {
    console.log("متصفحك لا يدعم localStorage");
} else {
    // الوضع المظلم يعمل
    enableDarkMode();
}
```

### تسجيل الأخطاء

```php
// تفعيل تسجيل مفصل
function practical_debug_log($message) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[Practical Solutions] ' . $message);
    }
}

// استخدام التسجيل
practical_debug_log('تم تحميل البحث الصوتي');
```

---

## 📈 تحسين الأداء

### ضغط الصور

```php
// تحسين جودة الصور تلقائياً
add_filter('jpeg_quality', function() { return 85; });
add_filter('wp_editor_set_quality', function() { return 85; });

// إنشاء أحجام محسنة
add_image_size('practical-mobile', 400, 300, true);
add_image_size('practical-tablet', 600, 400, true);
```

### تحسين CSS و JavaScript

```bash
# ضغط الملفات
npm install -g uglify-js clean-css-cli

# ضغط JavaScript
uglifyjs assets/js/app.js -o assets/js/app.min.js

# ضغط CSS  
cleancss -o assets/css/style.min.css assets/css/style.css
```

### تحسين قاعدة البيانات

```sql
-- تنظيف قاعدة البيانات دورياً
DELETE FROM wp_postmeta WHERE meta_key LIKE '_transient%';
DELETE FROM wp_options WHERE option_name LIKE '_transient%';
OPTIMIZE TABLE wp_posts;
OPTIMIZE TABLE wp_postmeta;
```

---

## 🔄 التحديث

### تحديث تلقائي

```php
// في functions.php
class PracticalThemeUpdater {
    private $theme_slug;
    private $version;
    
    public function __construct() {
        $this->theme_slug = get_template();
        $this->version = wp_get_theme()->get('Version');
        
        add_filter('pre_set_site_transient_update_themes', array($this, 'check_for_update'));
    }
    
    public function check_for_update($transient) {
        // منطق فحص التحديثات
        return $transient;
    }
}

new PracticalThemeUpdater();
```

### تحديث يدوي

```bash
# نسخ احتياطي من القالب الحالي
cp -r wp-content/themes/practical-solutions wp-content/themes/practical-solutions-backup

# تحميل النسخة الجديدة
wget https://github.com/practical-solutions/theme/archive/main.zip
unzip main.zip

# استبدال الملفات
cp -r practical-solutions-main/* wp-content/themes/practical-solutions/
```

---

## 🤝 المساهمة

نرحب بمساهماتكم! إليكم كيفية المساهمة:

### إبلاغ عن خطأ
1. تأكد من أن الخطأ لم يتم الإبلاغ عنه مسبقاً
2. أنشئ issue جديد مع وصف مفصل
3. أرفق screenshots إن أمكن

### اقتراح ميزة جديدة
1. أنشئ feature request
2. اشرح الفائدة من الميزة
3. قدم أمثلة على الاستخدام

### تطوير
```bash
# استنساخ المشروع
git clone https://github.com/practical-solutions/theme.git
cd theme

# إنشاء فرع جديد
git checkout -b feature/new-feature

# إجراء التغييرات
# ...

# إرسال pull request
git push origin feature/new-feature
```

### إرشادات المساهمة
- اتبع معايير الكود المتفق عليها
- أضف تعليقات واضحة
- اختبر التغييرات قبل الإرسال
- حدث التوثيق إذا لزم الأمر

---

## 📞 الدعم

### الحصول على المساعدة

- **التوثيق**: [docs.practical-solutions.com](https://docs.practical-solutions.com)
- **المجتمع**: [community.practical-solutions.com](https://community.practical-solutions.com)
- **GitHub Issues**: [github.com/practical-solutions/theme/issues](https://github.com/practical-solutions/theme/issues)
- **البريد الإلكتروني**: support@practical-solutions.com

### الأسئلة الشائعة

#### س: هل يدعم القالب WooCommerce؟
ج: نعم، يدعم القالب WooCommerce مع تصميم مخصص يتماشى مع شكل التطبيق.

#### س: هل يمكن ترجمة القالب؟
ج: نعم، القالب جاهز للترجمة ويدعم ملفات .po/.mo.

#### س: هل يعمل مع Page Builders؟
ج: يعمل مع Gutenberg بشكل كامل، ودعم محدود لـ Elementor و Beaver Builder.

#### س: كيف أخصص الألوان؟
ج: اذهب إلى المظهر > تخصيص > ألوان القالب، أو عدّل متغيرات CSS في style.css.

---

## 📄 الترخيص

هذا المشروع مرخص تحت رخصة GPL v2 أو أحدث - انظر ملف [LICENSE](LICENSE) للتفاصيل.

```
Copyright (C) 2025 Practical Solutions Theme
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

---

## 🙏 شكر وتقدير

- فريق WordPress لإنشاء منصة رائعة
- مجتمع المطورين العرب للإلهام والدعم
- جميع المساهمين في هذا المشروع
- مستخدمي القالب لملاحظاتهم القيمة

---

## 📚 الموارد الإضافية

### الدروس والشروحات
- [كيفية تخصيص القالب](docs/customization.md)
- [إضافة ميزات جديدة](docs/features.md)
- [تحسين الأداء](docs/performance.md)
- [دليل المطور](docs/developer-guide.md)

### أدوات مفيدة
- [WordPress CLI](https://wp-cli.org/)
- [Query Monitor](https://wordpress.org/plugins/query-monitor/)
- [Debug Bar](https://wordpress.org/plugins/debug-bar/)

### قوالب ذات صلة
- [قوالب عربية أخرى](https://github.com/topics/wordpress-arabic)
- [قوالب متجاوبة](https://github.com/topics/responsive-wordpress-theme)

---

*تم إنشاء هذا القالب بـ ❤️ للمجتمع العربي*

**آخر تحديث**: أغسطس 2025  
**الإصدار**: 1.0.0  
**متوافق مع**: WordPress 6.0+