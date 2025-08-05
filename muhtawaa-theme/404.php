<?php
/**
 * قالب صفحة الخطأ 404
 * 404 Error Template
 * 
 * يعرض صفحة خطأ جذابة ومفيدة عند عدم العثور على الصفحة المطلوبة
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

get_header(); ?>

<main class="main-content error-404-page" role="main">
    <div class="container">
        
        <!-- محتوى صفحة الخطأ -->
        <div class="error-content">
            
            <!-- الرسوم المتحركة والأيقونة -->
            <div class="error-animation">
                <div class="error-number">
                    <span class="digit" data-digit="4">4</span>
                    <span class="digit zero" data-digit="0">
                        <div class="search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </span>
                    <span class="digit" data-digit="4">4</span>
                </div>
                
                <!-- عناصر زخرفية متحركة -->
                <div class="floating-elements">
                    <div class="floating-element" style="--delay: 0s; --duration: 3s;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="floating-element" style="--delay: 0.5s; --duration: 4s;">
                        <i class="fas fa-folder"></i>
                    </div>
                    <div class="floating-element" style="--delay: 1s; --duration: 3.5s;">
                        <i class="fas fa-link"></i>
                    </div>
                    <div class="floating-element" style="--delay: 1.5s; --duration: 4.5s;">
                        <i class="fas fa-question"></i>
                    </div>
                </div>
            </div>
            
            <!-- نص الخطأ -->
            <div class="error-text">
                <h1 class="error-title">الصفحة غير موجودة</h1>
                <p class="error-message">
                    عذراً، لم نتمكن من العثور على الصفحة التي تبحث عنها. 
                    قد تكون قد تم نقلها أو حذفها أو أن الرابط غير صحيح.
                </p>
                
                <!-- معلومات تقنية (اختيارية) -->
                <details class="error-details">
                    <summary>معلومات تقنية</summary>
                    <div class="technical-info">
                        <p><strong>كود الخطأ:</strong> 404 - Not Found</p>
                        <p><strong>الرابط المطلوب:</strong> <code><?php echo esc_html($_SERVER['REQUEST_URI']); ?></code></p>
                        <p><strong>الوقت:</strong> <?php echo current_time('Y-m-d H:i:s'); ?></p>
                        <p><strong>المتصفح:</strong> <code><?php echo esc_html($_SERVER['HTTP_USER_AGENT'] ?? 'غير محدد'); ?></code></p>
                    </div>
                </details>
            </div>
            
            <!-- نموذج البحث -->
            <div class="error-search">
                <h3 class="search-title">
                    <i class="fas fa-search"></i>
                    ابحث عما تريد
                </h3>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="error-search-form">
                    <div class="search-input-group">
                        <input type="search" 
                               name="s" 
                               placeholder="ابحث في الموقع..." 
                               class="search-field"
                               autocomplete="off"
                               required>
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                            <span class="sr-only">بحث</span>
                        </button>
                    </div>
                    
                    <!-- اقتراحات البحث السريع -->
                    <div class="quick-suggestions">
                        <span class="suggestions-label">اقتراحات:</span>
                        <?php
                        // الحصول على الكلمات المفتاحية الشائعة
                        $popular_tags = get_tags([
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 5,
                            'hide_empty' => true
                        ]);
                        
                        if (!empty($popular_tags)):
                        ?>
                        <div class="suggestion-tags">
                            <?php foreach ($popular_tags as $tag): ?>
                            <button type="button" class="suggestion-tag" data-term="<?php echo esc_attr($tag->name); ?>">
                                <?php echo esc_html($tag->name); ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            
            <!-- روابط مفيدة -->
            <div class="helpful-links">
                <h3 class="links-title">
                    <i class="fas fa-compass"></i>
                    روابط مفيدة
                </h3>
                
                <div class="links-grid">
                    
                    <!-- الصفحة الرئيسية -->
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">الصفحة الرئيسية</h4>
                            <p class="link-desc">العودة إلى الصفحة الرئيسية</p>
                        </div>
                    </a>
                    
                    <!-- المقالات الحديثة -->
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">المقالات الحديثة</h4>
                            <p class="link-desc">تصفح أحدث المقالات</p>
                        </div>
                    </a>
                    
                    <!-- الفئات -->
                    <?php if (get_categories(['hide_empty' => true])): ?>
                    <a href="<?php echo esc_url(home_url('/categories')); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">تصفح الفئات</h4>
                            <p class="link-desc">استكشف المحتوى حسب الفئة</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <!-- اتصل بنا -->
                    <?php if ($contact_page = get_page_by_path('contact')): ?>
                    <a href="<?php echo esc_url(get_permalink($contact_page)); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">اتصل بنا</h4>
                            <p class="link-desc">تواصل معنا للمساعدة</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <!-- خريطة الموقع -->
                    <?php if ($sitemap_page = get_page_by_path('sitemap')): ?>
                    <a href="<?php echo esc_url(get_permalink($sitemap_page)); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">خريطة الموقع</h4>
                            <p class="link-desc">عرض جميع صفحات الموقع</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <!-- صفحة حول الموقع -->
                    <?php if ($about_page = get_page_by_path('about')): ?>
                    <a href="<?php echo esc_url(get_permalink($about_page)); ?>" class="helpful-link">
                        <div class="link-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="link-content">
                            <h4 class="link-title">حول الموقع</h4>
                            <p class="link-desc">تعرف على موقعنا</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <!-- المحتوى الشائع -->
            <?php
            $popular_posts = get_posts([
                'numberposts' => 3,
                'orderby' => 'comment_count',
                'order' => 'DESC',
                'post_status' => 'publish',
                'meta_query' => [
                    [
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ]
                ]
            ]);
            
            if (!empty($popular_posts)):
            ?>
            <div class="popular-content">
                <h3 class="popular-title">
                    <i class="fas fa-fire"></i>
                    المحتوى الشائع
                </h3>
                
                <div class="popular-posts">
                    <?php foreach ($popular_posts as $post): ?>
                    <article class="popular-post">
                        <div class="post-thumbnail">
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'solution-thumbnail', [
                                    'loading' => 'lazy',
                                    'alt' => get_the_title($post->ID)
                                ]); ?>
                            </a>
                        </div>
                        
                        <div class="post-content">
                            <h4 class="post-title">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <?php echo get_the_title($post->ID); ?>
                                </a>
                            </h4>
                            
                            <div class="post-meta">
                                <span class="post-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo get_the_date('', $post->ID); ?>
                                </span>
                                
                                <span class="post-comments">
                                    <i class="fas fa-comments"></i>
                                    <?php echo get_comments_number($post->ID); ?>
                                </span>
                            </div>
                            
                            <p class="post-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt($post->ID), 15, '...'); ?>
                            </p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- إحصائيات الموقع -->
            <div class="site-stats">
                <h3 class="stats-title">
                    <i class="fas fa-chart-bar"></i>
                    إحصائيات الموقع
                </h3>
                
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php echo wp_count_posts()->publish; ?>
                        </div>
                        <div class="stat-label">مقال منشور</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php echo wp_count_comments()->approved; ?>
                        </div>
                        <div class="stat-label">تعليق</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php echo count(get_categories(['hide_empty' => true])); ?>
                        </div>
                        <div class="stat-label">فئة</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php echo count(get_tags(['hide_empty' => true])); ?>
                        </div>
                        <div class="stat-label">علامة</div>
                    </div>
                </div>
            </div>
            
            <!-- أزرار العمل -->
            <div class="error-actions">
                <button onclick="history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للخلف
                </button>
                
                <button onclick="location.reload()" class="btn btn-outline">
                    <i class="fas fa-redo"></i>
                    إعادة تحميل
                </button>
                
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    الصفحة الرئيسية
                </a>
            </div>
            
        </div>
        
    </div>
</main>

<!-- معلومات منظمة لصفحة الخطأ -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "صفحة غير موجودة - خطأ 404",
    "description": "الصفحة المطلوبة غير موجودة. استخدم البحث أو الروابط المفيدة للعثور على ما تبحث عنه.",
    "url": "<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>",
    "mainEntity": {
        "@type": "Article",
        "headline": "خطأ 404 - الصفحة غير موجودة",
        "description": "الصفحة المطلوبة غير متاحة",
        "author": {
            "@type": "Organization",
            "name": "<?php echo esc_js(get_bloginfo('name')); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url(get_theme_file_uri('/assets/images/logo.png')); ?>"
            }
        }
    }
}
</script>

<style>
/* أنماط خاصة بصفحة 404 */
.error-404-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.error-404-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.error-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

/* رسوم الخطأ المتحركة */
.error-animation {
    position: relative;
    margin-bottom: 3rem;
}

.error-number {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    font-size: 8rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 2rem;
}

.digit {
    display: inline-block;
    animation: bounce 2s infinite;
    text-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

.digit.zero {
    position: relative;
    color: transparent;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 8rem;
    height: 8rem;
}

.search-icon {
    font-size: 3rem;
    color: white;
    animation: searchPulse 2s infinite;
}

/* العناصر العائمة */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.floating-element {
    position: absolute;
    font-size: 2rem;
    color: rgba(255,255,255,0.3);
    animation: float var(--duration) infinite ease-in-out;
    animation-delay: var(--delay);
}

.floating-element:nth-child(1) { top: 20%; left: 10%; }
.floating-element:nth-child(2) { top: 60%; right: 15%; }
.floating-element:nth-child(3) { bottom: 30%; left: 20%; }
.floating-element:nth-child(4) { top: 40%; right: 25%; }

/* نص الخطأ */
.error-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.error-message {
    font-size: 1.25rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.error-details {
    margin: 2rem 0;
    text-align: left;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 1rem;
}

.error-details summary {
    cursor: pointer;
    font-weight: 600;
    padding: 0.5rem;
}

.technical-info {
    margin-top: 1rem;
    font-size: 0.9rem;
    line-height: 1.5;
}

.technical-info code {
    background: rgba(0,0,0,0.2);
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
}

/* نموذج البحث */
.error-search {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 2rem;
    margin: 3rem 0;
}

.search-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: white;
}

.search-input-group {
    display: flex;
    max-width: 500px;
    margin: 0 auto;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.search-field {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    background: white;
    font-size: 1rem;
    outline: none;
}

.search-submit {
    padding: 1rem 1.5rem;
    background: #667eea;
    color: white;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}

.search-submit:hover {
    background: #5a67d8;
}

.quick-suggestions {
    margin-top: 1rem;
    text-align: center;
}

.suggestions-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-right: 0.5rem;
}

.suggestion-tags {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.suggestion-tag {
    background: rgba(255,255,255,0.2);
    color: white;
    border: none;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.suggestion-tag:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-1px);
}

/* الروابط المفيدة */
.helpful-links {
    margin: 3rem 0;
}

.links-title {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: white;
}

.links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.helpful-link {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
}

.helpful-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    background: rgba(255,255,255,0.15);
}

.link-icon {
    font-size: 2rem;
    margin-left: 1rem;
    opacity: 0.8;
}

.link-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
}

.link-desc {
    font-size: 0.9rem;
    opacity: 0.8;
    margin: 0;
}

/* المحتوى الشائع */
.popular-content {
    margin: 3rem 0;
}

.popular-title {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: white;
}

.popular-posts {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.popular-post {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.popular-post:hover {
    transform: translateY(-3px);
}

.popular-post .post-thumbnail img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.popular-post .post-content {
    padding: 1rem;
}

.popular-post .post-title {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.popular-post .post-title a {
    color: white;
    text-decoration: none;
}

.popular-post .post-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.8rem;
    opacity: 0.7;
    margin-bottom: 0.5rem;
}

.popular-post .post-excerpt {
    font-size: 0.9rem;
    opacity: 0.8;
    margin: 0;
}

/* إحصائيات الموقع */
.site-stats {
    margin: 3rem 0;
}

.stats-title {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.stat-item {
    text-align: center;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 1.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* أزرار العمل */
.error-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 3rem;
    flex-wrap: wrap;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: white;
    color: #667eea;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,255,255,0.3);
}

.btn-secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    border-color: rgba(255,255,255,0.3);
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: white;
    border-color: white;
}

.btn-outline:hover {
    background: white;
    color: #667eea;
    transform: translateY(-2px);
}

/* الحركات */
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

@keyframes searchPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(10deg);
    }
}

/* التجاوب */
@media (max-width: 768px) {
    .error-number {
        font-size: 4rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-message {
        font-size: 1rem;
    }
    
    .links-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    'use strict';
    
    // إضافة الحركات التفاعلية
    $('.digit').each(function(index) {
        $(this).css('animation-delay', (index * 0.2) + 's');
    });
    
    // تفعيل الاقتراحات السريعة
    $('.suggestion-tag').on('click', function() {
        const term = $(this).data('term');
        $('.search-field').val(term);
        $('.error-search-form').submit();
    });
    
    // تتبع الأخطاء 404
    function track404Error() {
        const errorData = {
            url: window.location.href,
            referrer: document.referrer,
            timestamp: new Date().toISOString(),
            userAgent: navigator.userAgent
        };
        
        // إرسال البيانات للتحليل (إذا كان متاحاً)
        if (typeof gtag !== 'undefined') {
            gtag('event', '404_error', {
                page_location: errorData.url,
                page_referrer: errorData.referrer
            });
        }
        
        // حفظ محلي للإحصائيات
        try {
            const errors = JSON.parse(localStorage.getItem('404_errors') || '[]');
            errors.push(errorData);
            
            // الاحتفاظ بآخر 10 أخطاء فقط
            if (errors.length > 10) {
                errors.splice(0, errors.length - 10);
            }
            
            localStorage.setItem('404_errors', JSON.stringify(errors));
        } catch (e) {
            console.warn('لا يمكن حفظ إحصائيات 404:', e);
        }
    }
    
    // تشغيل التتبع
    track404Error();
    
    // إضافة حركات عشوائية للعناصر العائمة
    $('.floating-element').each(function() {
        const randomDelay = Math.random() * 2;
        const randomDuration = 3 + Math.random() * 2;
        
        $(this).css({
            '--delay': randomDelay + 's',
            '--duration': randomDuration + 's',
            'top': Math.random() * 70 + '%',
            'left': Math.random() * 80 + '%'
        });
    });
    
    // تأثير تفاعلي للإحصائيات
    $('.stat-number').each(function() {
        const $this = $(this);
        const finalValue = parseInt($this.text());
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 50);
        
        const counter = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(counter);
            }
            $this.text(currentValue.toLocaleString('ar-SA'));
        }, 50);
    });
    
    // تحسين تجربة المستخدم
    
    // التركيز التلقائي على حقل البحث
    setTimeout(() => {
        $('.search-field').focus();
    }, 1000);
    
    // حفظ محاولات البحث من صفحة 404
    $('.error-search-form').on('submit', function() {
        const searchTerm = $('.search-field').val();
        
        if (searchTerm) {
            try {
                const searches = JSON.parse(localStorage.getItem('404_searches') || '[]');
                searches.push({
                    term: searchTerm,
                    timestamp: new Date().toISOString(),
                    originalUrl: window.location.href
                });
                
                localStorage.setItem('404_searches', JSON.stringify(searches.slice(-20)));
            } catch (e) {
                console.warn('لا يمكن حفظ محاولة البحث:', e);
            }
        }
    });
    
    // اقتراحات ذكية بناءً على الرابط المطلوب
    function suggestAlternatives() {
        const currentPath = window.location.pathname;
        const $suggestions = $('.suggestion-tags');
        
        // اقتراحات بناءً على مسار الرابط
        const pathSuggestions = [];
        
        if (currentPath.includes('article') || currentPath.includes('post')) {
            pathSuggestions.push('مقالات', 'أحدث المقالات');
        }
        
        if (currentPath.includes('category')) {
            pathSuggestions.push('فئات', 'تصنيفات');
        }
        
        if (currentPath.includes('tag')) {
            pathSuggestions.push('علامات', 'كلمات مفتاحية');
        }
        
        if (currentPath.includes('author')) {
            pathSuggestions.push('مؤلفين', 'كتّاب');
        }
        
        if (currentPath.includes('search')) {
            pathSuggestions.push('بحث متقدم', 'نتائج البحث');
        }
        
        // إضافة الاقتراحات الذكية
        pathSuggestions.forEach(suggestion => {
            if (!$suggestions.find(`[data-term="${suggestion}"]`).length) {
                $suggestions.append(`
                    <button type="button" class="suggestion-tag" data-term="${suggestion}">
                        ${suggestion}
                    </button>
                `);
            }
        });
    }
    
    suggestAlternatives();
    
    // إضافة تأثيرات صوتية (اختيارية)
    if ('speechSynthesis' in window) {
        const welcomeMessage = "مرحباً! يبدو أن الصفحة التي تبحث عنها غير موجودة. يمكنك استخدام البحث أو الروابط المفيدة للعثور على ما تحتاجه.";
        
        // زر قراءة الرسالة (اختياري)
        const $speakBtn = $(`
            <button class="speak-btn btn btn-outline" style="margin-top: 1rem;">
                <i class="fas fa-volume-up"></i>
                قراءة الرسالة
            </button>
        `);
        
        $speakBtn.on('click', function() {
            const utterance = new SpeechSynthesisUtterance(welcomeMessage);
            utterance.lang = 'ar-SA';
            utterance.rate = 0.9;
            speechSynthesis.speak(utterance);
            
            $(this).html('<i class="fas fa-pause"></i> جاري القراءة...').prop('disabled', true);
            
            utterance.onend = () => {
                $speakBtn.html('<i class="fas fa-volume-up"></i> قراءة الرسالة').prop('disabled', false);
            };
        });
        
        $('.error-actions').append($speakBtn);
    }
    
    // تفعيل خدمة العامل (Service Worker) للتعامل مع 404 مستقبلاً
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.ready.then(registration => {
            // إرسال معلومات الخطأ لخدمة العامل
            registration.active?.postMessage({
                type: '404_ERROR',
                url: window.location.href,
                timestamp: Date.now()
            });
        }).catch(err => {
            console.log('Service Worker غير متاح:', err);
        });
    }
    
    // تحسين إمكانية الوصول
    
    // إضافة تنقل بلوحة المفاتيح للروابط المفيدة
    $('.helpful-link').on('keydown', function(e) {
        const $links = $('.helpful-link');
        const currentIndex = $links.index(this);
        
        switch(e.key) {
            case 'ArrowRight':
                e.preventDefault();
                const nextIndex = (currentIndex + 1) % $links.length;
                $links.eq(nextIndex).focus();
                break;
                
            case 'ArrowLeft':
                e.preventDefault();
                const prevIndex = (currentIndex - 1 + $links.length) % $links.length;
                $links.eq(prevIndex).focus();
                break;
        }
    });
    
    // إعلان حالة الصفحة لقارئات الشاشة
    $('body').attr('aria-live', 'polite');
    
    // إضافة وصف للعناصر التفاعلية
    $('.suggestion-tag').attr('title', 'انقر للبحث عن هذا المصطلح');
    $('.helpful-link').each(function() {
        const title = $(this).find('.link-title').text();
        const desc = $(this).find('.link-desc').text();
        $(this).attr('aria-label', `${title}: ${desc}`);
    });
    
    // تتبع تفاعل المستخدم مع صفحة 404
    const interactionTracker = {
        startTime: Date.now(),
        interactions: [],
        
        track(action, element) {
            this.interactions.push({
                action: action,
                element: element,
                timestamp: Date.now() - this.startTime
            });
        }
    };
    
    // تتبع النقرات
    $('.helpful-link, .suggestion-tag, .btn').on('click', function() {
        const elementType = this.className;
        const elementText = $(this).text().trim();
        interactionTracker.track('click', `${elementType}: ${elementText}`);
    });
    
    // تتبع البحث
    $('.error-search-form').on('submit', function() {
        const searchTerm = $('.search-field').val();
        interactionTracker.track('search', searchTerm);
    });
    
    // إرسال إحصائيات التفاعل عند مغادرة الصفحة
    $(window).on('beforeunload', function() {
        const sessionData = {
            totalTime: Date.now() - interactionTracker.startTime,
            interactions: interactionTracker.interactions,
            finalAction: interactionTracker.interactions[interactionTracker.interactions.length - 1]?.action || 'none'
        };
        
        // إرسال البيانات (إذا كانت الخدمة متاحة)
        if (navigator.sendBeacon && typeof muhtawaa_ajax !== 'undefined') {
            navigator.sendBeacon(muhtawaa_ajax.url, new URLSearchParams({
                action: 'muhtawaa_track_404_interaction',
                data: JSON.stringify(sessionData),
                nonce: muhtawaa_ajax.nonce
            }));
        }
    });
    
    // إضافة رسائل تشجيعية
    const encouragingMessages = [
        "لا تقلق، سنساعدك في العثور على ما تبحث عنه! 😊",
        "كل خطأ هو فرصة لاكتشاف شيء جديد! 🌟",
        "المغامرة تبدأ من هنا! استكشف محتوانا الرائع! 🚀",
        "ربما هذا قدرك لتكتشف صفحة أفضل! ✨"
    ];
    
    const randomMessage = encouragingMessages[Math.floor(Math.random() * encouragingMessages.length)];
    
    // إضافة الرسالة بعد تحميل الصفحة
    setTimeout(() => {
        $('<div class="encouraging-message" style="margin-top: 2rem; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px; font-size: 1.1rem;">')
            .html(randomMessage)
            .hide()
            .appendTo('.error-text')
            .fadeIn(1000);
    }, 2000);
    
    // تحسين أداء الحركات على الأجهزة الضعيفة
    if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
        // تقليل الحركات على الأجهزة الضعيفة
        $('.floating-element').css('animation-duration', '6s');
        $('.digit').css('animation-iteration-count', '3');
    }
    
    // إضافة دعم الضغط المطول على الأجهزة المحمولة
    let pressTimer;
    $('.helpful-link').on('touchstart', function() {
        const $link = $(this);
        pressTimer = setTimeout(() => {
            // إظهار معلومات إضافية عند الضغط المطول
            const title = $link.find('.link-title').text();
            const desc = $link.find('.link-desc').text();
            
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.info(`${title}: ${desc}`, {
                    autoCloseDelay: 3000
                });
            }
        }, 1000);
    });
    
    $('.helpful-link').on('touchend touchcancel', function() {
        clearTimeout(pressTimer);
    });
    
    // إضافة إيماءات التمرير للتنقل
    let startY;
    $(document).on('touchstart', function(e) {
        startY = e.originalEvent.touches[0].clientY;
    });
    
    $(document).on('touchend', function(e) {
        const endY = e.originalEvent.changedTouches[0].clientY;
        const diff = startY - endY;
        
        // إيماءة التمرير لأعلى - العودة للخلف
        if (diff > 50) {
            if (history.length > 1) {
                history.back();
            }
        }
        
        // إيماءة التمرير لأسفل - إعادة تحميل
        if (diff < -50) {
            location.reload();
        }
    });
    
    // تحسين الوصول للبحث الصوتي على الأجهزة المدعومة
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        
        recognition.lang = 'ar-SA';
        recognition.continuous = false;
        recognition.interimResults = false;
        
        // إضافة زر البحث الصوتي
        const $voiceBtn = $('<button type="button" class="voice-search-btn" title="البحث الصوتي" style="position: absolute; left: 60px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #667eea; font-size: 1.2rem;"><i class="fas fa-microphone"></i></button>');
        
        $('.search-input-group').css('position', 'relative').append($voiceBtn);
        
        $voiceBtn.on('click', function() {
            recognition.start();
            $(this).html('<i class="fas fa-microphone-slash"></i>').addClass('listening');
        });
        
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            $('.search-field').val(transcript);
            $voiceBtn.html('<i class="fas fa-microphone"></i>').removeClass('listening');
        };
        
        recognition.onerror = function(event) {
            console.warn('خطأ في التعرف على الصوت:', event.error);
            $voiceBtn.html('<i class="fas fa-microphone"></i>').removeClass('listening');
            
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.error('فشل في التعرف على الصوت. حاول مرة أخرى.');
            }
        };
        
        recognition.onend = function() {
            $voiceBtn.html('<i class="fas fa-microphone"></i>').removeClass('listening');
        };
    }
    
    // إضافة مؤثرات بصرية للتفاعل
    $('.btn').on('mousedown touchstart', function() {
        $(this).addClass('pressed');
    });
    
    $('.btn').on('mouseup touchend mouseleave', function() {
        $(this).removeClass('pressed');
    });
    
    // CSS للمؤثرات الإضافية
    $('<style>').text(`
        .pressed {
            transform: scale(0.95) !important;
            transition: transform 0.1s ease !important;
        }
        
        .listening {
            color: #ef4444 !important;
            animation: pulse 1s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .voice-search-btn {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .voice-search-btn:hover {
            color: #5a67d8 !important;
            transform: translateY(-50%) scale(1.1);
        }
        
        .encouraging-message {
            animation: slideInUp 0.5s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `).appendTo('head');
});
</script>

<?php get_footer(); ?>