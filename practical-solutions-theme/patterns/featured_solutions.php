<?php
/**
 * Title: Featured Solutions
 * Slug: practical-solutions/featured-solutions
 * Description: عرض الحلول والنصائح المميزة في تخطيط جذاب ومتجاوب
 * Categories: featured, solutions
 * Keywords: solutions, tips, featured, grid, cards
 * Block Types: core/query, core/group
 */
?>

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-large"}},"className":"featured-solutions-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group featured-solutions-section">
    
    <!-- Query للحلول المميزة -->
    <!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"solution","order":"desc","orderBy":"meta_value_num","metaKey":"featured_order","author":"","search":"","exclude":[],"sticky":"","inherit":false,"meta_query":[{"key":"is_featured","value":"1","compare":"="}]},"layout":{"type":"constrained"}} -->
    <div class="wp-block-query">
        
        <!-- Template للحلول -->
        <!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"320px"}} -->
        
            <!-- بطاقة الحل المميز -->
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"background","className":"solution-card featured-card","layout":{"type":"constrained"},"shadow":"natural"} -->
            <div class="wp-block-group solution-card featured-card has-border-color has-base-border-color has-background-background-color has-background has-shadow" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:16px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                
                <!-- الصورة المميزة مع شارة "مميز" -->
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"position":{"type":"relative"}},"className":"solution-image-container","layout":{"type":"constrained"}} -->
                <div class="wp-block-group solution-image-container" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                    
                    <!-- wp:post-featured-image {"aspectRatio":"16/9","style":{"border":{"radius":{"topLeft":"16px","topRight":"16px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"bottom":"0"}}},"className":"solution-featured-image"} /-->
                    
                    <!-- شارة "مميز" -->
                    <!-- wp:html -->
                    <div class="featured-badge" style="position: absolute; top: 1rem; right: 1rem; background: linear-gradient(45deg, var(--wp--preset--color--accent), #ff6b6b); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; z-index: 2; box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);">
                        ⭐ مميز
                    </div>
                    <!-- /wp:html -->
                    
                    <!-- تراكب للتفاعل -->
                    <!-- wp:html -->
                    <div class="image-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(0, 124, 186, 0.8), rgba(231, 76, 60, 0.8)); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center; border-radius: 16px 16px 0 0;">
                        <div style="color: white; text-align: center; transform: translateY(20px); transition: transform 0.3s ease;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 0.5rem;">
                                <circle cx="12" cy="12" r="10"/>
                                <polygon points="10 8 16 12 10 16 10 8"/>
                            </svg>
                            <div style="font-weight: 600; font-size: 0.9rem;">مشاهدة الحل</div>
                        </div>
                    </div>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
                <!-- محتوى البطاقة -->
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"className":"solution-content","layout":{"type":"constrained"}} -->
                <div class="wp-block-group solution-content" style="padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)">
                    
                    <!-- معلومات التصنيف والصعوبة -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"},"className":"solution-meta-top"} -->
                    <div class="wp-block-group solution-meta-top">
                        
                        <!-- wp:post-terms {"term":"solution_category","style":{"typography":{"fontSize":"0.8rem","fontWeight":"500","textTransform":"uppercase"}},"textColor":"primary","className":"solution-category"} /-->
                        
                        <!-- wp:html -->
                        <div class="difficulty-badge" style="display: flex; align-items: center; gap: 0.25rem; background: var(--wp--preset--color--success); color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500;">
                            <span>🟢</span>
                            <span>سهل</span>
                        </div>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- عنوان الحل -->
                    <!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontWeight":"700","lineHeight":"1.3","fontSize":"1.25rem"},"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"}}},"textColor":"foreground","className":"solution-title"} /-->
                    
                    <!-- وصف مختصر -->
                    <!-- wp:post-excerpt {"moreText":"","excerptLength":20,"style":{"typography":{"fontSize":"0.95rem","lineHeight":"1.6"}},"textColor":"contrast","className":"solution-excerpt"} /-->
                    
                    <!-- معلومات إضافية -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"},"className":"solution-meta-bottom"} -->
                    <div class="wp-block-group solution-meta-bottom" style="margin-top:var(--wp--preset--spacing--medium)">
                        
                        <!-- وقت التطبيق -->
                        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"implementation-time"} -->
                        <div class="wp-block-group implementation-time">
                            
                            <!-- wp:html -->
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <!-- /wp:html -->
                            
                            <!-- wp:html -->
                            <span style="font-size: 0.85rem; color: var(--wp--preset--color--contrast); font-weight: 500;">
                                15 دقيقة
                            </span>
                            <!-- /wp:html -->
                            
                        </div>
                        <!-- /wp:group -->
                        
                        <!-- تقييم الحل -->
                        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"solution-rating"} -->
                        <div class="wp-block-group solution-rating">
                            
                            <!-- wp:html -->
                            <div class="star-rating" style="display: flex; gap: 0.125rem;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#f39c12" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#f39c12" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#f39c12" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#f39c12" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#f39c12" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            </div>
                            <!-- /wp:html -->
                            
                            <!-- wp:html -->
                            <span style="font-size: 0.85rem; color: var(--wp--preset--color--contrast); margin-right: 0.25rem;">
                                (4.8)
                            </span>
                            <!-- /wp:html -->
                            
                        </div>
                        <!-- /wp:group -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- شريط الإجراءات -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|medium"},"padding":{"top":"var:preset|spacing|small"}},"border":{"top":{"color":"var:preset|color|base","width":"1px","style":"solid"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"},"className":"solution-actions"} -->
                    <div class="wp-block-group solution-actions" style="border-top-color:var(--wp--preset--color--base);border-top-style:solid;border-top-width:1px;margin-top:var(--wp--preset--spacing--medium);padding-top:var(--wp--preset--spacing--small)">
                        
                        <!-- إحصائيات سريعة -->
                        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"},"className":"solution-stats"} -->
                        <div class="wp-block-group solution-stats">
                            
                            <!-- عدد المشاهدات -->
                            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
                            <div class="wp-block-group">
                                
                                <!-- wp:html -->
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <!-- /wp:html -->
                                
                                <!-- wp:html -->
                                <span style="font-size: 0.8rem; color: var(--wp--preset--color--contrast);">
                                    1.2K
                                </span>
                                <!-- /wp:html -->
                                
                            </div>
                            <!-- /wp:group -->
                            
                            <!-- عدد المشاركات -->
                            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
                            <div class="wp-block-group">
                                
                                <!-- wp:html -->
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.84 4.61C20.3292 4.099 19.7228 3.69364 19.0554 3.41708C18.3879 3.14052 17.6725 2.99817 16.95 2.99817C16.2275 2.99817 15.5121 3.14052 14.8446 3.41708C14.1772 3.69364 13.5708 4.099 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.5783 8.50903 2.9987 7.05 2.9987C5.59096 2.9987 4.19169 3.5783 3.16 4.61C2.1283 5.6417 1.5487 7.041 1.5487 8.5C1.5487 9.959 2.1283 11.3583 3.16 12.39L12 21.23L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6053C22.3095 9.93789 22.4518 9.22248 22.4518 8.5C22.4518 7.77752 22.3095 7.06211 22.0329 6.39467C21.7563 5.72723 21.351 5.1208 20.84 4.61V4.61Z"/>
                                </svg>
                                <!-- /wp:html -->
                                
                                <!-- wp:html -->
                                <span style="font-size: 0.8rem; color: var(--wp--preset--color--contrast);">
                                    89
                                </span>
                                <!-- /wp:html -->
                                
                            </div>
                            <!-- /wp:group -->
                            
                        </div>
                        <!-- /wp:group -->
                        
                        <!-- أزرار سريعة -->
                        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"solution-quick-actions"} -->
                        <div class="wp-block-group solution-quick-actions">
                            
                            <!-- زر الحفظ -->
                            <!-- wp:html -->
                            <button class="save-solution-btn" data-solution-id="" style="background: none; border: 1px solid var(--wp--preset--color--base); border-radius: 8px; padding: 0.5rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;" title="حفظ الحل">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"/>
                                </svg>
                            </button>
                            <!-- /wp:html -->
                            
                            <!-- زر المشاركة -->
                            <!-- wp:html -->
                            <button class="share-solution-btn" data-solution-id="" style="background: none; border: 1px solid var(--wp--preset--color--base); border-radius: 8px; padding: 0.5rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;" title="مشاركة الحل">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="5" r="3"/>
                                    <circle cx="6" cy="12" r="3"/>
                                    <circle cx="18" cy="19" r="3"/>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                </svg>
                            </button>
                            <!-- /wp:html -->
                            
                        </div>
                        <!-- /wp:group -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        <!-- /wp:post-template -->
        
        <!-- لا توجد نتائج -->
        <!-- wp:query-no-results -->
        
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"}},"textColor":"contrast"} -->
                <h3 class="wp-block-heading has-text-align-center has-contrast-color has-text-color" style="font-weight:600">
                    لا توجد حلول مميزة حالياً
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","textColor":"contrast"} -->
                <p class="has-text-align-center has-contrast-color has-text-color">
                    نعمل على إضافة المزيد من الحلول المميزة. تابعنا للحصول على آخر التحديثات.
                </p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
                <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--medium)">
                    
                    <!-- wp:button {"style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link wp-element-button" href="/solutions" style="border-radius:50px;padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--large)">
                            تصفح جميع الحلول
                        </a>
                    </div>
                    <!-- /wp:button -->
                    
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
            
        <!-- /wp:query-no-results -->
        
    </div>
    <!-- /wp:query -->
    
</div>
<!-- /wp:group -->

<!-- أنماط CSS مخصصة للحلول المميزة -->
<!-- wp:html -->
<style>
/* أنماط الحلول المميزة */
.featured-solutions-section {
    position: relative;
}

.solution-card {
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.solution-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15) !important;
}

.solution-card:hover .image-overlay {
    opacity: 1;
}

.solution-card:hover .image-overlay > div {
    transform: translateY(0);
}

/* الصورة المميزة */
.solution-image-container {
    position: relative;
    overflow: hidden;
}

.solution-featured-image img {
    transition: transform 0.3s ease;
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.solution-card:hover .solution-featured-image img {
    transform: scale(1.05);
}

/* شارة المميز */
.featured-badge {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* محتوى البطاقة */
.solution-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.solution-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.solution-title a:hover {
    color: var(--wp--preset--color--primary);
}

.solution-excerpt {
    flex: 1;
    margin-bottom: auto;
}

/* شارات الصعوبة */
.difficulty-badge {
    font-size: 0.75rem !important;
    animation: fadeInLeft 0.6s ease-out;
}

/* التقييم */
.solution-rating .star-rating {
    transition: transform 0.3s ease;
}

.solution-rating:hover .star-rating {
    transform: scale(1.1);
}

/* الأزرار السريعة */
.solution-quick-actions button {
    transition: all 0.3s ease;
}

.solution-quick-actions button:hover {
    background-color: var(--wp--preset--color--primary);
    border-color: var(--wp--preset--color--primary);
    color: white;
    transform: scale(1.1);
}

.solution-quick-actions button:hover svg {
    stroke: white;
}

.solution-quick-actions button.saved {
    background-color: var(--wp--preset--color--success);
    border-color: var(--wp--preset--color--success);
    color: white;
}

.solution-quick-actions button.saved svg {
    fill: white;
    stroke: white;
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

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.solution-card {
    animation: fadeInUp 0.6s ease-out;
}

.solution-card:nth-child(1) { animation-delay: 0.1s; }
.solution-card:nth-child(2) { animation-delay: 0.2s; }
.solution-card:nth-child(3) { animation-delay: 0.3s; }
.solution-card:nth-child(4) { animation-delay: 0.4s; }
.solution-card:nth-child(5) { animation-delay: 0.5s; }
.solution-card:nth-child(6) { animation-delay: 0.6s; }

/* الاستجابة للأجهزة */
@media (max-width: 768px) {
    .solution-meta-top,
    .solution-meta-bottom,
    .solution-actions {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .solution-quick-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .solution-stats {
        width: 100%;
        justify-content: space-around;
    }
    
    .featured-badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
}

@media (max-width: 480px) {
    .solution-card {
        margin-bottom: 1.5rem;
    }
    
    .solution-featured-image img {
        height: 150px;
    }
    
    .solution-title {
        font-size: 1.1rem !important;
    }
    
    .solution-excerpt {
        font-size: 0.9rem !important;
    }
    
    .solution-quick-actions button {
        padding: 0.625rem;
    }
}

/* تحسينات إضافية للبطاقات */
.solution-card.featured-card {
    border: 2px solid transparent;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(45deg, var(--wp--preset--color--primary), var(--wp--preset--color--accent)) border-box;
}

.solution-card.featured-card:hover {
    background: linear-gradient(white, white) padding-box,
                linear-gradient(45deg, var(--wp--preset--color--accent), var(--wp--preset--color--primary)) border-box;
}

/* تأثيرات إضافية */
.solution-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--wp--preset--color--primary), var(--wp--preset--color--accent));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.solution-card:hover .solution-content::before {
    transform: scaleX(1);
}

/* تحسينات الأداء */
.solution-card {
    contain: layout style paint;
}

.solution-card * {
    will-change: transform;
}

/* إضافات للوصول */
.solution-quick-actions button:focus {
    outline: 2px solid var(--wp--preset--color--primary);
    outline-offset: 2px;
    border-radius: 8px;
}

.solution-title a:focus {
    outline: 2px solid var(--wp--preset--color--primary);
    outline-offset: 2px;
    border-radius: 4px;
}

/* تخصيصات للطباعة */
@media print {
    .solution-quick-actions,
    .image-overlay,
    .featured-badge {
        display: none !important;
    }
    
    .solution-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
        break-inside: avoid;
    }
    
    .solution-featured-image img {
        height: auto !important;
    }
}
</style>
<!-- /wp:html -->