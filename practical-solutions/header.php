<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4a90e2">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
    
    <!-- أيقونات التطبيق -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json">
    
    <!-- تحسين محركات البحث -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="keywords" content="حلول عملية, نصائح منزلية, مطبخ, تنظيف, إصلاح">
    <meta name="author" content="<?php echo get_bloginfo('name'); ?>">
    
    <!-- Open Graph للمشاركة الاجتماعية -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:locale" content="ar_SA">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>">
    
    <!-- تحسين الأداء -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    
    <?php wp_head(); ?>
    
    <!-- متغيرات CSS مخصصة -->
    <style>
    :root {
        --primary-color: <?php echo get_theme_mod('primary_color', '#4a90e2'); ?>;
        --secondary-color: <?php echo get_theme_mod('secondary_color', '#f39c12'); ?>;
        --font-arabic: 'Cairo', 'Tajawal', sans-serif;
    }
    
    body {
        font-family: var(--font-arabic);
        <?php if (get_theme_mod('enable_dark_mode', false)): ?>
        background: #1a1a1a;
        color: #e1e1e1;
        <?php endif; ?>
    }
    
    <?php if (get_theme_mod('enable_dark_mode', false)): ?>
    .dark-mode .app-container {
        background: #2c2c2c;
    }
    
    .dark-mode .search-container,
    .dark-mode .content-card {
        background: #3a3a3a;
        color: #e1e1e1;
    }
    
    .dark-mode .search-input {
        background: #4a4a4a;
        border-color: #5a5a5a;
        color: #e1e1e1;
    }
    <?php endif; ?>
    </style>
    
    <!-- Service Worker للتشغيل في وضع عدم الاتصال -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?php echo get_template_directory_uri(); ?>/sw.js')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                })
                .catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }
    
    // متغيرات JavaScript عامة للقالب
    window.practicalTheme = {
        ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
        homeUrl: '<?php echo home_url(); ?>',
        themeUrl: '<?php echo get_template_directory_uri(); ?>',
        nonce: '<?php echo wp_create_nonce('practical_nonce'); ?>',
        isLoggedIn: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>,
        currentUserId: <?php echo get_current_user_id(); ?>,
        strings: {
            loading: 'جارٍ التحميل...',
            error: 'حدث خطأ',
            success: 'تم بنجاح',
            noResults: 'لا توجد نتائج',
            searchPlaceholder: 'ابحث عن الحلول...',
            confirm: 'هل أنت متأكد؟'
        }
    };
    </script>
    
    <!-- Google Analytics (إذا كان مطلوباً) -->
    <?php if (get_option('google_analytics_id')): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option('google_analytics_id'); ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo get_option('google_analytics_id'); ?>');
    </script>
    <?php endif; ?>
</head>

<body <?php body_class(get_theme_mod('enable_dark_mode', false) ? 'dark-mode' : ''); ?>>

<?php wp_body_open(); ?>

<!-- رسالة للمتصفحات القديمة -->
<!--[if lt IE 9]>
<div class="browser-upgrade">
    <p>أنت تستخدم متصفحاً <strong>قديماً</strong>. يرجى <a href="https://browsehappy.com/">تحديث متصفحك</a> لتحسين التجربة.</p>
</div>
<![endif]-->

<!-- Skip to content للوصولية -->
<a class="skip-link screen-reader-text" href="#main"><?php _e('الانتقال إلى المحتوى الرئيسي', 'practical-solutions'); ?></a>