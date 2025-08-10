<?php
/**
 * Title: Hero Section
 * Slug: practical-solutions/hero-section
 * Description: قسم البطل الرئيسي للصفحة الرئيسية مع دعوة للعمل وشريط البحث
 * Categories: featured, hero
 * Keywords: hero, banner, search, call-to-action
 * Block Types: core/group
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|xx-large"},"blockGap":"var:preset|spacing|large"},"background":{"backgroundImage":{"url":"<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg","source":"file"},"backgroundSize":"cover","backgroundPosition":"50% 50%","backgroundRepeat":"no-repeat"}},"backgroundColor":"primary","textColor":"background","className":"hero-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hero-section has-primary-background-color has-background-color has-background has-text-color" style="padding-top:var(--wp--preset--spacing--xx-large);padding-bottom:var(--wp--preset--spacing--xx-large)">
    
    <!-- طبقة التراكب للخلفية -->
    <!-- wp:html -->
    <div class="hero-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0, 124, 186, 0.85) 0%, rgba(44, 62, 80, 0.75) 100%); z-index: 1;"></div>
    <!-- /wp:html -->
    
    <!-- محتوى القسم الرئيسي -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-large"},"position":{"type":"relative","all":true}},"layout":{"type":"constrained","contentSize":"900px"},"className":"hero-content"} -->
    <div class="wp-block-group hero-content" style="position: relative; z-index: 2;">
        
        <!-- العنوان الرئيسي والوصف -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"},"className":"hero-text"} -->
        <div class="wp-block-group hero-text">
            
            <!-- العنوان الرئيسي -->
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontWeight":"800","fontSize":"clamp(2.5rem, 6vw, 4rem)","lineHeight":"1.1"},"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}},"textColor":"background","className":"hero-title"} -->
            <h1 class="wp-block-heading hero-title has-text-align-center has-background-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2.5rem, 6vw, 4rem);font-weight:800;line-height:1.1">
                حلول عملية لحياة أفضل
            </h1>
            <!-- /wp:heading -->
            
            <!-- العنوان الفرعي -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.125rem, 3vw, 1.5rem)","lineHeight":"1.5","fontWeight":"400"},"spacing":{"margin":{"bottom":"var:preset|spacing|large"}}},"textColor":"background","className":"hero-subtitle"} -->
            <p class="hero-subtitle has-text-align-center has-background-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--large);font-size:clamp(1.125rem, 3vw, 1.5rem);font-weight:400;line-height:1.5">
                اكتشف آلاف النصائح والحلول الذكية لتسهيل حياتك اليومية في المنزل والمطبخ وكل مكان. نحن هنا لنجعل حياتك أسهل وأكثر تنظيماً.
            </p>
            <!-- /wp:paragraph -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- شريط البحث الرئيسي -->
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained","contentSize":"600px"},"className":"hero-search"} -->
        <div class="wp-block-group hero-search" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:var(--wp--preset--spacing--large)">
            
            <!-- wp:template-part {"slug":"search-form","className":"hero-search-form"} /-->
            
        </div>
        <!-- /wp:group -->
        
        <!-- الإحصائيات السريعة -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"className":"hero-stats"} -->
        <div class="wp-block-group hero-stats">
            
            <!-- إحصائية الحلول -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"},"className":"stat-item"} -->
            <div class="wp-block-group stat-item">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"2.5rem","lineHeight":"1"}},"textColor":"background","className":"stat-number"} -->
                <h3 class="wp-block-heading stat-number has-text-align-center has-background-color has-text-color" style="font-size:2.5rem;font-weight:700;line-height:1">
                    +500
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"background","className":"stat-label"} -->
                <p class="stat-label has-text-align-center has-background-color has-text-color" style="font-size:1rem;font-weight:500">
                    حل عملي
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- إحصائية المستخدمين -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"},"className":"stat-item"} -->
            <div class="wp-block-group stat-item">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"2.5rem","lineHeight":"1"}},"textColor":"background","className":"stat-number"} -->
                <h3 class="wp-block-heading stat-number has-text-align-center has-background-color has-text-color" style="font-size:2.5rem;font-weight:700;line-height:1">
                    +10K
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"background","className":"stat-label"} -->
                <p class="stat-label has-text-align-center has-background-color has-text-color" style="font-size:1rem;font-weight:500">
                    مستخدم سعيد
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- إحصائية التقييم -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"constrained"},"className":"stat-item"} -->
            <div class="wp-block-group stat-item">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"2.5rem","lineHeight":"1"}},"textColor":"background","className":"stat-number"} -->
                <h3 class="wp-block-heading stat-number has-text-align-center has-background-color has-text-color" style="font-size:2.5rem;font-weight:700;line-height:1">
                    4.9★
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","fontWeight":"500"}},"textColor":"background","className":"stat-label"} -->
                <p class="stat-label has-text-align-center has-background-color has-text-color" style="font-size:1rem;font-weight:500">
                    تقييم المستخدمين
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- أزرار الدعوة للعمل -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"className":"hero-cta"} -->
        <div class="wp-block-group hero-cta" style="margin-top:var(--wp--preset--spacing--large)">
            
            <!-- زر استكشاف الحلول -->
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                
                <!-- wp:button {"style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|x-large","right":"var:preset|spacing|x-large"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"}},"className":"hero-primary-btn"} -->
                <div class="wp-block-button hero-primary-btn">
                    <a class="wp-block-button__link wp-element-button" href="/solutions" style="border-radius:50px;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--x-large);font-size:1.125rem;font-weight:600">
                        🚀 استكشف الحلول
                    </a>
                </div>
                <!-- /wp:button -->
                
                <!-- wp:button {"style":{"border":{"radius":"50px","width":"2px","color":"var:preset|color|background"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|x-large","right":"var:preset|spacing|x-large"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"},"color":{"background":"transparent","text":"var:preset|color|background"}},"className":"hero-secondary-btn"} -->
                <div class="wp-block-button hero-secondary-btn">
                    <a class="wp-block-button__link wp-element-button has-background-color has-text-color has-background" style="border-color:var(--wp--preset--color--background);border-width:2px;border-radius:50px;color:var(--wp--preset--color--background);background-color:transparent;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--x-large);font-size:1.125rem;font-weight:600">
                        📚 تصفح المدونة
                    </a>
                </div>
                <!-- /wp:button -->
                
            </div>
            <!-- /wp:buttons -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- مؤشر التمرير لأسفل -->
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"scroll-indicator"} -->
        <div class="wp-block-group scroll-indicator" style="margin-top:var(--wp--preset--spacing--x-large)">
            
            <!-- wp:html -->
            <div class="scroll-arrow" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; animation: bounce 2s infinite;">
                <span style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.8); font-weight: 500;">اكتشف المزيد</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255, 255, 255, 0.8)" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
            <!-- /wp:html -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
    <!-- عناصر ديكورية -->
    <!-- wp:html -->
    <div class="hero-decorations">
        <!-- دوائر ديكورية -->
        <div class="decoration-circle circle-1" style="position: absolute; top: 10%; left: 10%; width: 100px; height: 100px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); z-index: 1; animation: float 6s ease-in-out infinite;"></div>
        <div class="decoration-circle circle-2" style="position: absolute; top: 20%; right: 15%; width: 60px; height: 60px; border-radius: 50%; background: rgba(255, 255, 255, 0.08); z-index: 1; animation: float 8s ease-in-out infinite reverse;"></div>
        <div class="decoration-circle circle-3" style="position: absolute; bottom: 15%; left: 20%; width: 80px; height: 80px; border-radius: 50%; background: rgba(255, 255, 255, 0.05); z-index: 1; animation: float 7s ease-in-out infinite;"></div>
        
        <!-- خطوط ديكورية -->
        <div class="decoration-line line-1" style="position: absolute; top: 30%; right: 5%; width: 2px; height: 100px; background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3), transparent); z-index: 1; animation: pulse 4s ease-in-out infinite;"></div>
        <div class="decoration-line line-2" style="position: absolute; bottom: 25%; left: 8%; width: 2px; height: 80px; background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.2), transparent); z-index: 1; animation: pulse 5s ease-in-out infinite;"></div>
    </div>
    <!-- /wp:html -->
    
</div>
<!-- /wp:group -->

<!-- أنماط CSS مخصصة للقسم -->
<!-- wp:html -->
<style>
/* أنماط القسم الرئيسي */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-overlay {
    pointer-events: none;
}

.hero-content {
    z-index: 2;
    position: relative;
    width: 100%;
}

/* تأثيرات النص */
.hero-title {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    animation: fadeInUp 1s ease-out 0.2s both;
}

/* تأثيرات الإحصائيات */
.hero-stats {
    animation: fadeInUp 1s ease-out 0.4s both;
}

.stat-item {
    padding: 1rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease, background 0.3s ease;
    min-width: 120px;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.stat-number {
    background: linear-gradient(45deg, #ffffff, #f8f9fa);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    text-shadow: none;
}

/* تأثيرات الأزرار */
.hero-cta {
    animation: fadeInUp 1s ease-out 0.6s both;
}

.hero-primary-btn .wp-block-button__link {
    background: linear-gradient(45deg, #ffffff, #f8f9fa);
    color: var(--wp--preset--color--primary);
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.hero-primary-btn .wp-block-button__link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4);
}

.hero-secondary-btn .wp-block-button__link {
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.hero-secondary-btn .wp-block-button__link:hover {
    background: rgba(255, 255, 255, 0.1) !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
}

/* مؤشر التمرير */
.scroll-indicator {
    animation: fadeInUp 1s ease-out 0.8s both;
}

/* الرسوم المتحركة */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 0.3;
        transform: scaleY(1);
    }
    50% {
        opacity: 1;
        transform: scaleY(1.2);
    }
}

/* الاستجابة للأجهزة */
@media (max-width: 768px) {
    .hero-section {
        min-height: 80vh;
        padding-top: var(--wp--preset--spacing--x-large);
        padding-bottom: var(--wp--preset--spacing--x-large);
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }
    
    .stat-item {
        width: 100%;
        text-align: center;
    }
    
    .hero-cta .wp-block-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-cta .wp-block-button {
        width: 100%;
    }
    
    .hero-cta .wp-block-button__link {
        justify-content: center;
        width: 100%;
    }
    
    /* إخفاء العناصر الديكورية على الجوال */
    .hero-decorations {
        display: none;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: clamp(2rem, 8vw, 2.5rem) !important;
    }
    
    .hero-subtitle {
        font-size: clamp(1rem, 4vw, 1.25rem) !important;
    }
    
    .stat-number {
        font-size: 2rem !important;
    }
    
    .hero-primary-btn .wp-block-button__link,
    .hero-secondary-btn .wp-block-button__link {
        padding: 1rem 2rem !important;
        font-size: 1rem !important;
    }
}

/* تحسينات إضافية */
.hero-search-form .search-form {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.hero-search-form .search-input-wrapper:focus-within {
    box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
}

/* تأثيرات تفاعلية إضافية */
.hero-content > * {
    transition: transform 0.3s ease;
}

.hero-section:hover .decoration-circle {
    animation-play-state: paused;
}

.hero-section:hover .decoration-line {
    animation-duration: 2s;
}

/* تحسينات الأداء */
.hero-section * {
    will-change: transform;
}

.hero-section .wp-block-group {
    contain: layout style paint;
}
</style>
<!-- /wp:html -->