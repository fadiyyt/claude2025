<?php
/**
 * رأس الموقع - قالب محتوى المطور
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- التحسين لمحركات البحث -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    
    <!-- التصميم المتجاوب -->
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">
    
    <!-- الخطوط المحسنة -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- تحسين الأداء -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <!-- Schema.org للمواقع العربية -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php bloginfo('name'); ?>",
        "description": "<?php bloginfo('description'); ?>",
        "url": "<?php echo esc_url(home_url('/')); ?>",
        "inLanguage": "ar",
        "author": {
            "@type": "Organization",
            "name": "<?php bloginfo('name'); ?>"
        }
    }
    </script>
    
    <?php wp_head(); ?>
    
    <!-- CSS الحرجة المضمنة لتحسين الأداء -->
    <style>
        /* CSS حرجة للتحميل السريع */
        body{font-family:'Cairo',sans-serif;margin:0;padding:0;direction:rtl;text-align:right}
        .site-loading{position:fixed;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);z-index:9999;display:flex;align-items:center;justify-content:center}
        .loading-spinner{width:50px;height:50px;border:3px solid rgba(255,255,255,0.3);border-radius:50%;border-top:3px solid #fff;animation:spin 1s linear infinite}
        @keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
        .skip-link{position:absolute;top:-40px;left:6px;z-index:999999;color:#fff;background:#000;text-decoration:none;padding:8px 16px}
        .skip-link:focus{top:7px}
    </style>
</head>

<body <?php body_class(); ?>>

<!-- إمكانية الوصول -->
<a class="skip-link screen-reader-text" href="#main"><?php _e('تجاوز إلى المحتوى الرئيسي', 'muhtawaa'); ?></a>

<!-- شاشة التحميل -->
<div class="site-loading" id="site-loading">
    <div class="loading-spinner"></div>
</div>

<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <!-- رأس الموقع -->
    <header id="masthead" class="site-header" role="banner">
        
        <!-- شريط علوي للإعلانات أو الروابط المهمة -->
        <?php if (is_active_sidebar('header-top')) : ?>
        <div class="header-top-bar">
            <div class="container">
                <?php dynamic_sidebar('header-top'); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- الهيدر الرئيسي -->
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    
                    <!-- شعار الموقع -->
                    <div class="site-branding">
                        <?php if (has_custom_logo()) : ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <div class="site-title-wrapper">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                                <?php 
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) : ?>
                                    <p class="site-description"><?php echo $description; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- منطقة الهيدر للويدجت -->
                    <?php if (is_active_sidebar('header-widgets')) : ?>
                    <div class="header-widgets">
                        <?php dynamic_sidebar('header-widgets'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- أزرار التفاعل -->
                    <div class="header-actions">
                        
                        <!-- زر البحث -->
                        <button class="search-toggle" aria-label="<?php _e('فتح البحث', 'muhtawaa'); ?>" aria-expanded="false">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </button>
                        
                        <!-- زر القائمة للجوال -->
                        <button class="mobile-menu-toggle" aria-label="<?php _e('القائمة', 'muhtawaa'); ?>" aria-expanded="false">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- شريط التنقل الرئيسي -->
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e('القائمة الرئيسية', 'muhtawaa'); ?>">
            <div class="container">
                <?php
                $nav_args = array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu',
                    'container'      => false,
                    'depth'          => 3,
                    'fallback_cb'    => 'muhtawaa_primary_menu_fallback',
                );

                if (class_exists('Muhtawaa_Walker_Nav_Menu')) {
                    $nav_args['walker'] = new Muhtawaa_Walker_Nav_Menu();
                }

                wp_nav_menu($nav_args);
                ?>
            </div>
        </nav>
        
        <!-- نموذج البحث المخفي -->
        <div class="search-overlay" id="search-overlay">
            <div class="search-overlay-content">
                <button class="search-close" aria-label="<?php _e('إغلاق البحث', 'muhtawaa'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
                
                <div class="search-form-wrapper">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-wrapper">
                            <input type="search" 
                                   class="search-field" 
                                   placeholder="<?php _e('ابحث عن الحلول والمقالات...', 'muhtawaa'); ?>" 
                                   value="<?php echo get_search_query(); ?>" 
                                   name="s" 
                                   autocomplete="off"
                                   aria-label="<?php _e('البحث', 'muhtawaa'); ?>">
                            <button type="submit" class="search-submit" aria-label="<?php _e('إرسال البحث', 'muhtawaa'); ?>">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- اقتراحات البحث -->
                        <div class="search-suggestions" id="search-suggestions"></div>
                        
                        <!-- فلاتر البحث -->
                        <div class="search-filters">
                            <h4><?php _e('فلترة النتائج:', 'muhtawaa'); ?></h4>
                            
                            <!-- فلتر حسب النوع -->
                            <div class="filter-group">
                                <label class="filter-label">
                                    <input type="checkbox" name="post_type[]" value="post" checked>
                                    <span><?php _e('المقالات', 'muhtawaa'); ?></span>
                                </label>
                                <label class="filter-label">
                                    <input type="checkbox" name="post_type[]" value="solution">
                                    <span><?php _e('الحلول', 'muhtawaa'); ?></span>
                                </label>
                            </div>
                            
                            <!-- فلتر حسب التصنيف -->
                            <?php 
                            $categories = get_categories(array('hide_empty' => true, 'number' => 5));
                            if ($categories) : ?>
                            <div class="filter-group">
                                <h5><?php _e('التصنيفات:', 'muhtawaa'); ?></h5>
                                <?php foreach ($categories as $category) : ?>
                                <label class="filter-label">
                                    <input type="checkbox" name="categories[]" value="<?php echo $category->term_id; ?>">
                                    <span><?php echo $category->name; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </header><!-- #masthead -->
    
    <!-- شريط مسار التنقل -->
    <?php if (!is_front_page() && function_exists('muhtawaa_breadcrumb')) : ?>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <?php muhtawaa_breadcrumb(); ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- بداية المحتوى الرئيسي -->
    <main id="main" class="site-main" role="main">
        
        <!-- منطقة قبل المحتوى -->
        <?php if (is_active_sidebar('before-content') && (is_home() || is_front_page())) : ?>
        <section class="before-content-section">
            <div class="container">
                <?php dynamic_sidebar('before-content'); ?>
            </div>
        </section>
        <?php endif; ?>

<script>
// إزالة شاشة التحميل عند اكتمال التحميل
document.addEventListener('DOMContentLoaded', function() {
    const loading = document.getElementById('site-loading');
    if (loading) {
        setTimeout(function() {
            loading.style.opacity = '0';
            setTimeout(function() {
                loading.style.display = 'none';
            }, 300);
        }, 500);
    }
});

// إزالة الفئة no-js
document.documentElement.classList.remove('no-js');
document.documentElement.classList.add('js');
</script>