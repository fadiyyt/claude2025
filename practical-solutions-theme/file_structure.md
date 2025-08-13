# بنية الملفات والمجلدات - قالب Block Theme للحلول العملية

## 📁 **الهيكل العام للقالب**

```
practical-solutions-theme/
├── 📄 style.css                    # ملف CSS الرئيسي وبيانات القالب
├── 📄 index.php                    # ملف PHP الاحتياطي (مطلوب لووردبريس)
├── 📄 functions.php                # وظائف القالب الرئيسية
├── 📄 theme.json                   # إعدادات FSE الرئيسية
├── 📄 screenshot.png               # صورة معاينة القالب (1200x900px)
├── 📄 README.md                    # دليل استخدام القالب
├── 📄 package.json                 # إعدادات NPM والتبعيات
├── 📄 webpack.config.js            # إعدادات Webpack للبناء
├── 📄 .gitignore                   # ملفات مستبعدة من Git
│
├── 📁 templates/                   # قوالب الصفحات الرئيسية
│   ├── 📄 index.html               # الصفحة الرئيسية
│   ├── 📄 single.html              # صفحة المقال الواحد
│   ├── 📄 archive.html             # صفحة الأرشيف
│   ├── 📄 search.html              # صفحة نتائج البحث
│   ├── 📄 404.html                 # صفحة الخطأ 404
│   ├── 📄 page.html                # الصفحات الثابتة
│   ├── 📄 home.html                # الصفحة الرئيسية للمدونة
│   └── 📄 category.html            # صفحة التصنيفات
│
├── 📁 parts/                       # أجزاء القالب القابلة للإعادة
│   ├── 📄 header.html              # رأس الصفحة
│   ├── 📄 footer.html              # تذييل الصفحة
│   ├── 📄 navigation.html          # القائمة الرئيسية
│   ├── 📄 search-form.html         # نموذج البحث
│   ├── 📄 post-meta.html           # معلومات المقال
│   ├── 📄 sidebar.html             # الشريط الجانبي
│   └── 📄 breadcrumb.html          # مسار التنقل
│
├── 📁 patterns/                    # أنماط الكتل المخصصة
│   ├── 📄 hero-section.php         # قسم البطل الرئيسي
│   ├── 📄 featured-posts.php       # المقالات المميزة
│   ├── 📄 call-to-action.php       # دعوة للعمل
│   ├── 📄 testimonials.php         # آراء العملاء
│   ├── 📄 newsletter.php           # النشرة البريدية
│   └── 📄 social-sharing.php       # مشاركة وسائل التواصل
│
├── 📁 assets/                      # ملفات الموارد
│   ├── 📁 css/                     # ملفات الأنماط
│   │   ├── 📄 style.css            # الأنماط الرئيسية المجمعة
│   │   ├── 📄 style.min.css        # النسخة المضغوطة
│   │   ├── 📄 critical.css         # الأنماط الحرجة
│   │   ├── 📄 rtl.css              # أنماط اللغة العربية
│   │   └── 📄 print.css            # أنماط الطباعة
│   │
│   ├── 📁 scss/                    # ملفات SASS المصدرية
│   │   ├── 📄 main.scss            # الملف الرئيسي
│   │   ├── 📄 _variables.scss      # المتغيرات
│   │   ├── 📄 _mixins.scss         # المكساين
│   │   ├── 📄 _base.scss           # الأنماط الأساسية
│   │   ├── 📄 _layout.scss         # تخطيط الصفحة
│   │   ├── 📄 _components.scss     # مكونات UI
│   │   ├── 📄 _utilities.scss      # كلاسات مساعدة
│   │   └── 📄 _responsive.scss     # استعلامات الاستجابة
│   │
│   ├── 📁 js/                      # ملفات JavaScript
│   │   ├── 📄 main.js              # الملف الرئيسي
│   │   ├── 📄 main.min.js          # النسخة المضغوطة
│   │   ├── 📁 modules/             # وحدات JS منفصلة
│   │   │   ├── 📄 search.js        # وظائف البحث
│   │   │   ├── 📄 voice-search.js  # البحث الصوتي
│   │   │   ├── 📄 lazy-loading.js  # التحميل الكسول
│   │   │   ├── 📄 navigation.js    # وظائف التنقل
│   │   │   └── 📄 utils.js         # وظائف مساعدة
│   │   └── 📁 vendor/              # مكتبات خارجية
│   │       └── 📄 speech-api.js    # مكتبة التعرف الصوتي
│   │
│   ├── 📁 images/                  # الصور والرسوم
│   │   ├── 📄 logo.svg             # شعار الموقع
│   │   ├── 📄 favicon.ico          # أيقونة المتصفح
│   │   ├── 📁 icons/               # الأيقونات
│   │   │   ├── 📄 search.svg       # أيقونة البحث
│   │   │   ├── 📄 voice.svg        # أيقونة الصوت
│   │   │   ├── 📄 menu.svg         # أيقونة القائمة
│   │   │   └── 📄 social/          # أيقونات وسائل التواصل
│   │   └── 📁 placeholders/        # صور نائبة
│   │       ├── 📄 post-thumb.jpg   # صورة المقال الافتراضية
│   │       └── 📄 hero-bg.jpg      # خلفية القسم الرئيسي
│   │
│   └── 📁 fonts/                   # الخطوط
│       ├── 📄 NotoSansArabic-Regular.woff2
│       ├── 📄 NotoSansArabic-Bold.woff2
│       └── 📄 fonts.css            # تعريفات الخطوط
│
├── 📁 inc/                         # ملفات PHP الإضافية
│   ├── 📄 theme-setup.php          # إعدادات القالب الأساسية
│   ├── 📄 enqueue-scripts.php      # تحميل الملفات والأنماط
│   ├── 📄 customizer.php           # إعدادات المخصص
│   ├── 📄 ajax-handlers.php        # معالجات AJAX
│   ├── 📄 search-functions.php     # وظائف البحث المتقدم
│   ├── 📄 performance.php          # تحسينات الأداء
│   ├── 📄 security.php             # إعدادات الأمان
│   └── 📄 seo-functions.php        # وظائف تحسين محركات البحث
│
├── 📁 blocks/                      # كتل مخصصة
│   ├── 📁 search-advanced/         # كتلة البحث المتقدم
│   │   ├── 📄 block.json           # إعدادات الكتلة
│   │   ├── 📄 edit.js              # محرر الكتلة
│   │   ├── 📄 save.js              # حفظ الكتلة
│   │   ├── 📄 style.scss           # أنماط الكتلة
│   │   └── 📄 index.php            # معالج PHP للكتلة
│   │
│   ├── 📁 featured-solutions/      # كتلة الحلول المميزة
│   │   ├── 📄 block.json
│   │   ├── 📄 edit.js
│   │   ├── 📄 save.js
│   │   └── 📄 style.scss
│   │
│   └── 📁 category-grid/           # كتلة شبكة التصنيفات
│       ├── 📄 block.json
│       ├── 📄 edit.js
│       ├── 📄 save.js
│       └── 📄 style.scss
│
├── 📁 languages/                   # ملفات الترجمة
│   ├── 📄 practical-solutions.pot  # ملف الترجمة الأساسي
│   ├── 📄 ar.po                    # الترجمة العربية
│   └── 📄 en_US.po                 # الترجمة الإنجليزية
│
├── 📁 tests/                       # ملفات الاختبار
│   ├── 📄 test-functions.php       # اختبار الوظائف
│   ├── 📄 test-performance.php     # اختبار الأداء
│   └── 📄 test-accessibility.php   # اختبار إمكانية الوصول
│
└── 📁 docs/                        # وثائق المشروع
    ├── 📄 installation.md          # دليل التثبيت
    ├── 📄 customization.md         # دليل التخصيص
    ├── 📄 api-reference.md         # مرجع API
    └── 📄 changelog.md             # سجل التغييرات
```

---

## 📋 **وصف تفصيلي للملفات الرئيسية**

### **الملفات الأساسية**

#### **style.css**
```css
/*
Theme Name: Practical Solutions
Description: قالب ووردبريس عصري للحلول العملية مع تقنية FSE
Version: 1.0.0
Author: Your Name
Text Domain: practical-solutions
Requires at least: 6.4
Tested up to: 6.5
Requires PHP: 8.0
License: GPL v2 or later
*/
```

#### **theme.json**
```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 2,
  "settings": {
    "layout": {
      "contentSize": "800px",
      "wideSize": "1200px"
    },
    "color": {
      "palette": [
        {
          "name": "الأساسي",
          "slug": "primary",
          "color": "#007cba"
        },
        {
          "name": "الثانوي", 
          "slug": "secondary",
          "color": "#f0f4f8"
        }
      ]
    },
    "typography": {
      "fontFamilies": [
        {
          "name": "نوتو عربي",
          "slug": "noto-arabic",
          "fontFamily": "'Noto Sans Arabic', sans-serif"
        }
      ]
    }
  }
}
```

#### **functions.php**
```php
<?php
/**
 * Practical Solutions Theme Functions
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تعريف ثوابت القالب
define('THEME_VERSION', '1.0.0');
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

// تضمين الملفات المطلوبة
require_once THEME_DIR . '/inc/theme-setup.php';
require_once THEME_DIR . '/inc/enqueue-scripts.php';
require_once THEME_DIR . '/inc/customizer.php';
require_once THEME_DIR . '/inc/search-functions.php';
require_once THEME_DIR . '/inc/performance.php';

// تهيئة القالب
function practical_solutions_setup() {
    // دعم ميزات ووردبريس
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'gallery'));
    add_theme_support('responsive-embeds');
    
    // دعم FSE
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    
    // تسجيل قوائم التنقل
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'practical-solutions'),
        'footer' => __('قائمة التذييل', 'practical-solutions'),
    ));
}
add_action('after_setup_theme', 'practical_solutions_setup');
```

---

### **قوالب الصفحات (Templates)**

#### **templates/index.html**
```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<main class="wp-block-group">
    <!-- wp:pattern {"slug":"practical-solutions/hero-section"} /-->
    
    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:query {"queryId":0,"query":{"perPage":6,"pages":0}} -->
        <div class="wp-block-query">
            <!-- wp:post-template -->
            <!-- wp:post-featured-image /-->
            <!-- wp:post-title {"isLink":true} /-->
            <!-- wp:post-excerpt /-->
            <!-- /wp:post-template -->
        </div>
        <!-- /wp:query -->
    </div>
    <!-- /wp:group -->
</main>

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

#### **templates/single.html**
```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<main class="wp-block-group single-post">
    <!-- wp:template-part {"slug":"breadcrumb"} /-->
    
    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:post-title {"level":1} /-->
        <!-- wp:template-part {"slug":"post-meta"} /-->
        <!-- wp:post-featured-image /-->
        <!-- wp:post-content /-->
        
        <!-- wp:pattern {"slug":"practical-solutions/social-sharing"} /-->
    </div>
    <!-- /wp:group -->
</main>

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

### **أجزاء القالب (Template Parts)**

#### **parts/header.html**
```html
<!-- wp:group {"className":"site-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group site-header">
    <!-- wp:site-logo {"width":120} /-->
    
    <!-- wp:template-part {"slug":"search-form"} /-->
    
    <!-- wp:navigation {"layout":{"type":"flex","setCascadingProperties":true}} /-->
</div>
<!-- /wp:group -->
```

#### **parts/search-form.html**
```html
<!-- wp:group {"className":"advanced-search-form"} -->
<div class="wp-block-group advanced-search-form">
    <!-- wp:html -->
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="search-input-wrapper">
            <input type="search" 
                   class="search-field" 
                   placeholder="ابحث عن الحلول..."
                   value="<?php echo get_search_query(); ?>" 
                   name="s" 
                   id="search-input" />
            <button type="button" id="voice-search-btn" class="voice-search-btn">
                <svg><!-- أيقونة الميكروفون --></svg>
            </button>
            <button type="submit" class="search-submit">
                <svg><!-- أيقونة البحث --></svg>
            </button>
        </div>
        <div id="search-suggestions" class="search-suggestions"></div>
    </form>
    <!-- /wp:html -->
</div>
<!-- /wp:group -->
```

---

### **الأنماط المخصصة (Patterns)**

#### **patterns/hero-section.php**
```php
<?php
/**
 * Title: Hero Section
 * Slug: practical-solutions/hero-section
 * Categories: featured
 */
?>

<!-- wp:group {"align":"full","className":"hero-section","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}}} -->
<div class="wp-block-group alignfull hero-section" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large"} -->
        <h1 class="wp-block-heading has-text-align-center has-xx-large-font-size">
            حلول عملية لمشاكلك اليومية
        </h1>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size">
            اكتشف نصائح وحلول ذكية لتسهيل حياتك في المنزل والمطبخ وكل مكان
        </p>
        <!-- /wp:paragraph -->
        
        <!-- wp:template-part {"slug":"search-form"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->
```

---

### **الكتل المخصصة (Custom Blocks)**

#### **blocks/search-advanced/block.json**
```json
{
  "apiVersion": 2,
  "name": "practical-solutions/search-advanced",
  "title": "البحث المتقدم",
  "category": "widgets",
  "icon": "search",
  "description": "كتلة بحث متقدم مع دعم البحث الصوتي",
  "supports": {
    "html": false,
    "color": {
      "background": true,
      "text": true
    }
  },
  "textdomain": "practical-solutions",
  "editorScript": "file:./edit.js",
  "editorStyle": "file:./style.css",
  "style": "file:./style.css"
}
```

---

### **ملفات JavaScript الرئيسية**

#### **assets/js/modules/search.js**
```javascript
/**
 * نظام البحث المتقدم
 */
class AdvancedSearch {
    constructor() {
        this.searchForm = document.querySelector('.search-form');
        this.searchInput = document.getElementById('search-input');
        this.suggestionsContainer = document.getElementById('search-suggestions');
        this.debounceTimer = null;
        
        this.init();
    }
    
    init() {
        if (!this.searchForm || !this.searchInput) return;
        
        this.searchInput.addEventListener('input', this.handleInput.bind(this));
        this.searchInput.addEventListener('focus', this.showSuggestions.bind(this));
        this.searchInput.addEventListener('blur', this.hideSuggestions.bind(this));
        
        // إضافة دعم لوحة المفاتيح
        this.searchInput.addEventListener('keydown', this.handleKeydown.bind(this));
    }
    
    handleInput(event) {
        const query = event.target.value.trim();
        
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            if (query.length >= 2) {
                this.fetchSuggestions(query);
            } else {
                this.clearSuggestions();
            }
        }, 300);
    }
    
    async fetchSuggestions(query) {
        try {
            const response = await fetch(`${wpApiSettings.root}practical-solutions/v1/search-suggestions?query=${encodeURIComponent(query)}`, {
                headers: {
                    'X-WP-Nonce': wpApiSettings.nonce
                }
            });
            
            const suggestions = await response.json();
            this.displaySuggestions(suggestions);
        } catch (error) {
            console.error('خطأ في جلب الاقتراحات:', error);
        }
    }
    
    displaySuggestions(suggestions) {
        if (!suggestions || suggestions.length === 0) {
            this.clearSuggestions();
            return;
        }
        
        const suggestionsList = suggestions.map(suggestion => 
            `<li class="suggestion-item" data-query="${suggestion.title}">
                <span class="suggestion-title">${suggestion.title}</span>
                <span class="suggestion-type">${suggestion.type}</span>
            </li>`
        ).join('');
        
        this.suggestionsContainer.innerHTML = `
            <ul class="suggestions-list">
                ${suggestionsList}
            </ul>
        `;
        
        this.suggestionsContainer.classList.add('active');
        
        // إضافة مستمعي الأحداث للاقتراحات
        this.suggestionsContainer.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', this.selectSuggestion.bind(this));
        });
    }
    
    selectSuggestion(event) {
        const query = event.currentTarget.dataset.query;
        this.searchInput.value = query;
        this.clearSuggestions();
        this.searchForm.submit();
    }
    
    clearSuggestions() {
        this.suggestionsContainer.innerHTML = '';
        this.suggestionsContainer.classList.remove('active');
    }
    
    showSuggestions() {
        if (this.suggestionsContainer.innerHTML.trim() !== '') {
            this.suggestionsContainer.classList.add('active');
        }
    }
    
    hideSuggestions() {
        // تأخير الإخفاء للسماح بالنقر على الاقتراحات
        setTimeout(() => {
            this.suggestionsContainer.classList.remove('active');
        }, 200);
    }
    
    handleKeydown(event) {
        const suggestions = this.suggestionsContainer.querySelectorAll('.suggestion-item');
        if (suggestions.length === 0) return;
        
        let activeIndex = Array.from(suggestions).findIndex(item => 
            item.classList.contains('active')
        );
        
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                activeIndex = (activeIndex + 1) % suggestions.length;
                this.highlightSuggestion(suggestions, activeIndex);
                break;
                
            case 'ArrowUp':
                event.preventDefault();
                activeIndex = activeIndex <= 0 ? suggestions.length - 1 : activeIndex - 1;
                this.highlightSuggestion(suggestions, activeIndex);
                break;
                
            case 'Enter':
                event.preventDefault();
                if (activeIndex >= 0) {
                    suggestions[activeIndex].click();
                } else {
                    this.searchForm.submit();
                }
                break;
                
            case 'Escape':
                this.clearSuggestions();
                this.searchInput.blur();
                break;
        }
    }
    
    highlightSuggestion(suggestions, activeIndex) {
        suggestions.forEach((item, index) => {
            item.classList.toggle('active', index === activeIndex);
        });
    }
}

// تهيئة نظام البحث عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    new AdvancedSearch();
});
```

---

### **ملفات SCSS للأنماط**

#### **assets/scss/main.scss**
```scss
// الواردات الأساسية
@import 'variables';
@import 'mixins';
@import 'base';
@import 'layout';
@import 'components';
@import 'utilities';
@import 'responsive';

// أنماط خاصة بالقالب
.practical-solutions-theme {
  font-family: var(--wp--preset--font-family--noto-arabic);
  direction: rtl;
  text-align: right;
}

// أنماط البحث المتقدم
.advanced-search-form {
  .search-form {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
    
    .search-input-wrapper {
      display: flex;
      align-items: center;
      background: white;
      border-radius: 50px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: box-shadow 0.3s ease;
      
      &:focus-within {
        box-shadow: 0 4px 30px rgba(0, 124, 186, 0.2);
      }
    }
    
    .search-field {
      flex: 1;
      border: none;
      padding: 15px 20px;
      font-size: 16px;
      background: transparent;
      
      &:focus {
        outline: none;
      }
      
      &::placeholder {
        color: #999;
        font-style: italic;
      }
    }
    
    .voice-search-btn,
    .search-submit {
      border: none;
      background: transparent;
      padding: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      
      &:hover {
        background-color: rgba(0, 124, 186, 0.1);
      }
      
      svg {
        width: 20px;
        height: 20px;
        fill: #007cba;
      }
    }
    
    .voice-search-btn {
      &.recording {
        animation: pulse 1s infinite;
        
        svg {
          fill: #e74c3c;
        }
      }
    }
  }
  
  .search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    pointer-events: none;
    
    &.active {
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }
    
    .suggestions-list {
      list-style: none;
      margin: 0;
      padding: 10px 0;
      
      .suggestion-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        cursor: pointer;
        transition: background-color 0.2s ease;
        
        &:hover,
        &.active {
          background-color: #f8f9fa;
        }
        
        .suggestion-title {
          font-weight: 500;
          color: #2c3e50;
        }
        
        .suggestion-type {
          font-size: 12px;
          color: #7f8c8d;
          background: #ecf0f1;
          padding: 4px 8px;
          border-radius: 20px;
        }
      }
    }
  }
}

// أنميشن النبض للبحث الصوتي
@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}
```

هذه هي البنية التفصيلية للملفات والمجلدات. كل ملف له وظيفة محددة ومصمم ليعمل ضمن نظام FSE الحديث لووردبريس. 

هل تريد أن أبدأ في **المرحلة الثانية (التنفيذ)** وأنشئ الملفات الفعلية للقالب؟