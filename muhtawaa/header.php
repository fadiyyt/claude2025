<?php
/**
 * رأس الصفحة لقالب محتوى
 * 
 * @package Muhtawaa
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Preconnect لتحسين الأداء -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- معلومات إضافية للموقع -->
    <meta name="author" content="<?php bloginfo('name'); ?>">
    <meta name="robots" content="index, follow">
    
    <?php if (is_home() || is_front_page()): ?>
        <meta name="description" content="<?php bloginfo('description'); ?> - اكتشف آلاف الحلول العملية للمشاكل اليومية">
        <meta name="keywords" content="حلول يومية, نصائح منزلية, حيل عملية, توفير المال, حلول المطبخ">
    <?php endif; ?>
    
    <!-- Schema.org markup للموقع -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php bloginfo('name'); ?>",
        "description": "<?php bloginfo('description'); ?>",
        "url": "<?php echo home_url(); ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo home_url('/?s={search_term_string}'); ?>",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to main content للوصولية -->
<a class="skip-link screen-reader-text" href="#main" style="position: absolute; left: -9999px; top: -9999px; z-index: 999999; display: block; padding: 8px 16px; background: #667eea; color: white; text-decoration: none; border-radius: 3px;"><?php _e('الانتقال إلى المحتوى الرئيسي', 'muhtawaa'); ?></a>

<!-- Header -->
<header class="header" role="banner">
    <div class="container">
        <nav class="nav" role="navigation" aria-label="<?php _e('القائمة الرئيسية', 'muhtawaa'); ?>">
            <!-- Logo and Site Title -->
            <div class="logo-section">
                <?php if (has_custom_logo()): ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
                
                <?php if (get_bloginfo('description')): ?>
                    <div class="tagline"><?php bloginfo('description'); ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Main Navigation Menu -->
            <?php if (has_nav_menu('main-menu')): ?>
                <div class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'menu_class' => 'main-menu',
                        'container' => false,
                        'depth' => 2,
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
            <?php endif; ?>
            
            <!-- Search Bar -->
            <div class="search-bar" role="search">
                <?php get_search_form(); ?>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="<?php _e('فتح القائمة', 'muhtawaa'); ?>" aria-expanded="false" style="display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
        
        <!-- Mobile Menu -->
        <div class="mobile-menu" style="display: none; background: rgba(255,255,255,0.95); position: absolute; top: 100%; left: 0; right: 0; padding: 1rem; border-radius: 0 0 15px 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
            <?php if (has_nav_menu('main-menu')): ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'mobile-menu-list',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => false,
                ));
                ?>
            <?php endif; ?>
            
            <!-- Quick Links في القائمة المحمولة -->
            <div class="mobile-quick-links" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                <h4 style="color: #667eea; margin-bottom: 0.5rem; font-size: 0.9rem;">روابط سريعة</h4>
                <ul style="list-style: none; margin: 0; padding: 0;">
                    <li style="margin-bottom: 0.5rem;">
                        <a href="<?php echo home_url(); ?>" style="color: #333; text-decoration: none; font-size: 0.9rem;">
                            🏠 الرئيسية
                        </a>
                    </li>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'solution_category',
                        'hide_empty' => false,
                        'number' => 4
                    ));
                    
                    if ($categories && !is_wp_error($categories)):
                        foreach ($categories as $category):
                            $icon = muhtawaa_get_category_icon($category->name);
                            ?>
                            <li style="margin-bottom: 0.5rem;">
                                <a href="<?php echo get_term_link($category); ?>" style="color: #333; text-decoration: none; font-size: 0.9rem;">
                                    <?php echo $icon; ?> <?php echo $category->name; ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Breadcrumbs -->
<?php if (!is_front_page()): ?>
    <?php muhtawaa_breadcrumbs(); ?>
<?php endif; ?>

<!-- Main Content -->
<main id="main" class="site-main" role="main">

<style>
/* تحسينات CSS إضافية للهيدر */
.header {
    position: relative;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    position: relative;
}

.logo-section {
    flex-shrink: 0;
}

.custom-logo img {
    max-height: 60px;
    width: auto;
}

.main-navigation {
    flex: 1;
    display: flex;
    justify-content: center;
    margin: 0 2rem;
}

.main-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
}

.main-menu li {
    position: relative;
}

.main-menu a {
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: background-color 0.3s;
}

.main-menu a:hover,
.main-menu a:focus {
    background-color: rgba(255,255,255,0.2);
}

.main-menu .current-menu-item a,
.main-menu .current_page_item a {
    background-color: rgba(255,255,255,0.3);
}

/* القائمة الفرعية */
.main-menu .sub-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.main-menu li:hover .sub-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.main-menu .sub-menu a {
    color: #333;
    display: block;
    padding: 0.75rem 1rem;
    border-radius: 0;
}

.main-menu .sub-menu a:hover {
    background-color: #f8f9fa;
}

.search-bar {
    flex-shrink: 0;
}

/* تحسينات الموبايل */
@media (max-width: 1024px) {
    .main-navigation {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: block !important;
    }
}

@media (max-width: 768px) {
    .nav {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .search-bar {
        margin: 0;
        max-width: 100%;
        order: 3;
    }
    
    .mobile-menu-toggle {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }
    
    .logo-section {
        order: 1;
    }
}

.mobile-menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.mobile-menu-list li {
    border-bottom: 1px solid #eee;
}

.mobile-menu-list li:last-child {
    border-bottom: none;
}

.mobile-menu-list a {
    display: block;
    padding: 0.75rem;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s;
}

.mobile-menu-list a:hover {
    background-color: #f8f9fa;
}

/* تحسين الوصولية */
.skip-link:focus {
    position: static !important;
    left: auto !important;
    top: auto !important;
}

/* تحسين شريط البحث */
.search-bar {
    position: relative;
}

.search-bar .search-form {
    display: flex;
    background: white;
    border-radius: 25px;
    padding: 5px;
    max-width: 400px;
    width: 100%;
}

.search-bar input[type="search"] {
    border: none;
    outline: none;
    padding: 10px 15px;
    border-radius: 20px;
    flex: 1;
    font-size: 14px;
    background: transparent;
}

.search-bar button[type="submit"] {
    background: #667eea;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.search-bar button[type="submit"]:hover {
    background: #5a6fd8;
}

/* تأثيرات التحميل */
.header.loading {
    opacity: 0.8;
}

/* تحسينات الأداء */
.custom-logo img {
    object-fit: contain;
}

/* تحسين RTL */
.main-menu .sub-menu {
    right: 0;
    left: auto;
}

@media (max-width: 768px) {
    .mobile-menu-toggle {
        right: 1rem;
        left: auto;
    }
}
</style>

<script>
// JavaScript للقائمة المحمولة
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isExpanded);
            
            if (isExpanded) {
                mobileMenu.style.display = 'none';
                this.innerHTML = '<i class="fas fa-bars"></i>';
                this.setAttribute('aria-label', 'فتح القائمة');
            } else {
                mobileMenu.style.display = 'block';
                this.innerHTML = '<i class="fas fa-times"></i>';
                this.setAttribute('aria-label', 'إغلاق القائمة');
            }
        });
    }
    
    // إغلاق القائمة عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (mobileMenu && mobileToggle) {
            if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                mobileMenu.style.display = 'none';
                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
                mobileToggle.setAttribute('aria-label', 'فتح القائمة');
            }
        }
    });
    
    // تحسين البحث المباشر
    const searchInput = document.querySelector('.search-bar input[type="search"]');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length >= 2) {
                searchTimeout = setTimeout(() => {
                    showSearchSuggestions(query);
                }, 300);
            } else {
                hideSearchSuggestions();
            }
        });
        
        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 2) {
                showSearchSuggestions(this.value.trim());
            }
        });
    }
    
    function showSearchSuggestions(query) {
        // إزالة الاقتراحات السابقة
        hideSearchSuggestions();
        
        fetch(muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=live_search&search_term=${encodeURIComponent(query)}&nonce=${muhtawaa_ajax.nonce}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                const suggestions = document.createElement('div');
                suggestions.className = 'search-dropdown';
                suggestions.setAttribute('role', 'listbox');
                
                data.data.forEach((item, index) => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.className = 'search-result-item';
                    suggestionItem.setAttribute('role', 'option');
                    suggestionItem.innerHTML = `
                        <a href="${item.url}">
                            <span class="result-title">${item.title}</span>
                            <span class="result-category">${item.category}</span>
                        </a>
                    `;
                    suggestions.appendChild(suggestionItem);
                });
                
                document.querySelector('.search-bar').appendChild(suggestions);
            }
        })
        .catch(error => console.error('Search error:', error));
    }
    
    function hideSearchSuggestions() {
        const dropdown = document.querySelector('.search-dropdown');
        if (dropdown) {
            dropdown.remove();
        }
    }
    
    // إخفاء الاقتراحات عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-bar')) {
            hideSearchSuggestions();
        }
    });
    
    // تحسين الوصولية للقائمة الرئيسية
    const menuItems = document.querySelectorAll('.main-menu li');
    menuItems.forEach(item => {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.sub-menu');
        
        if (submenu) {
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');
            
            item.addEventListener('mouseenter', () => {
                link.setAttribute('aria-expanded', 'true');
            });
            
            item.addEventListener('mouseleave', () => {
                link.setAttribute('aria-expanded', 'false');
            });
            
            // دعم لوحة المفاتيح
            link.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const isExpanded = link.getAttribute('aria-expanded') === 'true';
                    link.setAttribute('aria-expanded', !isExpanded);
                }
            });
        }
    });
});
</script>