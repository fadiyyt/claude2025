<?php
/**
 * Title: Category Grid
 * Slug: practical-solutions/category-grid
 * Description: شبكة تصنيفات المحتوى مع أيقونات جذابة وعدد المقالات
 * Categories: featured, categories
 * Keywords: categories, grid, icons, navigation
 * Block Types: core/group
 */
?>

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"className":"category-grid-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group category-grid-section">
    
    <!-- شبكة التصنيفات -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"280px"},"className":"categories-grid"} -->
    <div class="wp-block-group categories-grid">
        
        <!-- تصنيف البيت والمنزل -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"background","className":"category-card home-solutions","layout":{"type":"constrained"},"shadow":"natural"} -->
        <div class="wp-block-group category-card home-solutions has-border-color has-base-border-color has-background-background-color has-background has-shadow" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)">
            
            <!-- أيقونة التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"},"className":"category-icon-container"} -->
            <div class="wp-block-group category-icon-container">
                
                <!-- wp:html -->
                <div class="category-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; position: relative; overflow: hidden;">
                    <!-- خلفية متحركة -->
                    <div class="icon-bg-animation" style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); animation: rotate 8s linear infinite;"></div>
                    
                    <!-- الأيقونة -->
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                        <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- محتوى التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"},"className":"category-content"} -->
            <div class="wp-block-group category-content">
                
                <!-- عنوان التصنيف -->
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem"}},"textColor":"foreground","className":"category-title"} -->
                <h3 class="wp-block-heading category-title has-text-align-center has-foreground-color has-text-color" style="font-size:1.5rem;font-weight:700">
                    <a href="/category/home-solutions" style="color: inherit; text-decoration: none;">البيت والمنزل</a>
                </h3>
                <!-- /wp:heading -->
                
                <!-- وصف التصنيف -->
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.6"}},"textColor":"contrast","className":"category-description"} -->
                <p class="category-description has-text-align-center has-contrast-color has-text-color" style="font-size:1rem;line-height:1.6">
                    حلول ذكية لتنظيف وترتيب المنزل، نصائح للديكور والصيانة المنزلية البسيطة
                </p>
                <!-- /wp:paragraph -->
                
                <!-- إحصائيات التصنيف -->
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"className":"category-stats"} -->
                <div class="wp-block-group category-stats" style="margin-top:var(--wp--preset--spacing--medium)">
                    
                    <!-- عدد الحلول -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"posts-count"} -->
                    <div class="wp-block-group posts-count">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--primary);">
                            127 حل
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- مستوى الشعبية -->
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"popularity-level"} -->
                    <div class="wp-block-group popularity-level">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--warning)" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--warning);">
                            شائع جداً
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
                
                <!-- زر استكشاف -->
                <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"category-cta"} -->
                <div class="wp-block-group category-cta" style="margin-top:var(--wp--preset--spacing--large)">
                    
                    <!-- wp:html -->
                    <a href="/category/home-solutions" class="category-explore-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #3498db, #2980b9); color: white; padding: 0.75rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);">
                        <span>استكشاف الحلول</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- تصنيف المطبخ والطبخ -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"background","className":"category-card kitchen-solutions","layout":{"type":"constrained"},"shadow":"natural"} -->
        <div class="wp-block-group category-card kitchen-solutions has-border-color has-base-border-color has-background-background-color has-background has-shadow" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)">
            
            <!-- أيقونة التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"},"className":"category-icon-container"} -->
            <div class="wp-block-group category-icon-container">
                
                <!-- wp:html -->
                <div class="category-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e67e22, #d35400); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; position: relative; overflow: hidden;">
                    <div class="icon-bg-animation" style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); animation: rotate 8s linear infinite;"></div>
                    
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                        <path d="M6 2L3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6L18 2H6Z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- محتوى التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"},"className":"category-content"} -->
            <div class="wp-block-group category-content">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem"}},"textColor":"foreground","className":"category-title"} -->
                <h3 class="wp-block-heading category-title has-text-align-center has-foreground-color has-text-color" style="font-size:1.5rem;font-weight:700">
                    <a href="/category/kitchen-solutions" style="color: inherit; text-decoration: none;">المطبخ والطبخ</a>
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.6"}},"textColor":"contrast","className":"category-description"} -->
                <p class="category-description has-text-align-center has-contrast-color has-text-color" style="font-size:1rem;line-height:1.6">
                    وصفات سريعة وسهلة، نصائح لحفظ الطعام وتنظيم المطبخ بطريقة عملية
                </p>
                <!-- /wp:paragraph -->
                
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"className":"category-stats"} -->
                <div class="wp-block-group category-stats" style="margin-top:var(--wp--preset--spacing--medium)">
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"posts-count"} -->
                    <div class="wp-block-group posts-count">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--primary);">
                            89 حل
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"popularity-level"} -->
                    <div class="wp-block-group popularity-level">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--warning)" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--warning);">
                            شائع
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
                
                <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"category-cta"} -->
                <div class="wp-block-group category-cta" style="margin-top:var(--wp--preset--spacing--large)">
                    
                    <!-- wp:html -->
                    <a href="/category/kitchen-solutions" class="category-explore-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #e67e22, #d35400); color: white; padding: 0.75rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);">
                        <span>استكشاف الحلول</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- تصنيف النصائح الحياتية -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"background","className":"category-card life-tips","layout":{"type":"constrained"},"shadow":"natural"} -->
        <div class="wp-block-group category-card life-tips has-border-color has-base-border-color has-background-background-color has-background has-shadow" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)">
            
            <!-- أيقونة التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"},"className":"category-icon-container"} -->
            <div class="wp-block-group category-icon-container">
                
                <!-- wp:html -->
                <div class="category-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #27ae60, #229954); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; position: relative; overflow: hidden;">
                    <div class="icon-bg-animation" style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); animation: rotate 8s linear infinite;"></div>
                    
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15C18.8 15.8 18.8 16.2 19.4 17L21 18.5C21.3 18.8 21.4 19.4 21 19.7L19.7 21C19.4 21.4 18.8 21.3 18.5 21L17 19.4C16.2 18.8 15.8 18.8 15 19.4L13.5 21C13.2 21.3 12.6 21.4 12.3 21L11 19.7C10.6 19.4 10.7 18.8 11 18.5L12.6 17C13.2 16.2 13.2 15.8 12.6 15L11 13.5C10.7 13.2 10.6 12.6 11 12.3L12.3 11C12.6 10.6 13.2 10.7 13.5 11L15 12.6C15.8 13.2 16.2 13.2 17 12.6L18.5 11C18.8 10.7 19.4 10.6 19.7 11L21 12.3C21.4 12.6 21.3 13.2 21 13.5L19.4 15Z"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- محتوى التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"},"className":"category-content"} -->
            <div class="wp-block-group category-content">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem"}},"textColor":"foreground","className":"category-title"} -->
                <h3 class="wp-block-heading category-title has-text-align-center has-foreground-color has-text-color" style="font-size:1.5rem;font-weight:700">
                    <a href="/category/life-tips" style="color: inherit; text-decoration: none;">نصائح حياتية</a>
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.6"}},"textColor":"contrast","className":"category-description"} -->
                <p class="category-description has-text-align-center has-contrast-color has-text-color" style="font-size:1rem;line-height:1.6">
                    نصائح لإدارة الوقت والتوفير والصحة، حلول لتحسين نمط الحياة اليومية
                </p>
                <!-- /wp:paragraph -->
                
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"className":"category-stats"} -->
                <div class="wp-block-group category-stats" style="margin-top:var(--wp--preset--spacing--medium)">
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"posts-count"} -->
                    <div class="wp-block-group posts-count">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--primary);">
                            156 نصيحة
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"popularity-level"} -->
                    <div class="wp-block-group popularity-level">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--warning)" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--warning);">
                            شائع جداً
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
                
                <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"category-cta"} -->
                <div class="wp-block-group category-cta" style="margin-top:var(--wp--preset--spacing--large)">
                    
                    <!-- wp:html -->
                    <a href="/category/life-tips" class="category-explore-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #27ae60, #229954); color: white; padding: 0.75rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);">
                        <span>استكشاف النصائح</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- تصنيف الحلول التقنية -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":"16px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"background","className":"category-card tech-solutions","layout":{"type":"constrained"},"shadow":"natural"} -->
        <div class="wp-block-group category-card tech-solutions has-border-color has-base-border-color has-background-background-color has-background has-shadow" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)">
            
            <!-- أيقونة التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"},"className":"category-icon-container"} -->
            <div class="wp-block-group category-icon-container">
                
                <!-- wp:html -->
                <div class="category-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; position: relative; overflow: hidden;">
                    <div class="icon-bg-animation" style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); animation: rotate 8s linear infinite;"></div>
                    
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                        <rect x="4" y="4" width="16" height="12" rx="2"/>
                        <polyline points="22 6 12 13 2 6"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- محتوى التصنيف -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"},"className":"category-content"} -->
            <div class="wp-block-group category-content">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem"}},"textColor":"foreground","className":"category-title"} -->
                <h3 class="wp-block-heading category-title has-text-align-center has-foreground-color has-text-color" style="font-size:1.5rem;font-weight:700">
                    <a href="/category/tech-solutions" style="color: inherit; text-decoration: none;">حلول تقنية</a>
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.6"}},"textColor":"contrast","className":"category-description"} -->
                <p class="category-description has-text-align-center has-contrast-color has-text-color" style="font-size:1rem;line-height:1.6">
                    حلول تقنية بسيطة، تطبيقات مفيدة ونصائح رقمية لتسهيل الحياة اليومية
                </p>
                <!-- /wp:paragraph -->
                
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"className":"category-stats"} -->
                <div class="wp-block-group category-stats" style="margin-top:var(--wp--preset--spacing--medium)">
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"posts-count"} -->
                    <div class="wp-block-group posts-count">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--primary);">
                            73 حل
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"popularity-level"} -->
                    <div class="wp-block-group popularity-level">
                        
                        <!-- wp:html -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        <!-- /wp:html -->
                        
                        <!-- wp:html -->
                        <span style="font-size: 0.9rem; font-weight: 600; color: var(--wp--preset--color--contrast);">
                            متنامي
                        </span>
                        <!-- /wp:html -->
                        
                    </div>
                    <!-- /wp:group -->
                    
                </div>
                <!-- /wp:group -->
                
                <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"category-cta"} -->
                <div class="wp-block-group category-cta" style="margin-top:var(--wp--preset--spacing--large)">
                    
                    <!-- wp:html -->
                    <a href="/category/tech-solutions" class="category-explore-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #9b59b6, #8e44ad); color: white; padding: 0.75rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(155, 89, 182, 0.3);">
                        <span>استكشاف الحلول</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- بطاقة "عرض جميع التصنيفات" -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":"16px","width":"2px","style":"dashed","color":"var:preset|color|primary"}},"backgroundColor":"secondary","className":"category-card view-all-categories","layout":{"type":"constrained"}} -->
        <div class="wp-block-group category-card view-all-categories has-border-color has-primary-border-color has-secondary-background-color has-background" style="border-color:var(--wp--preset--color--primary);border-style:dashed;border-width:2px;border-radius:16px;padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--medium)">
            
            <!-- أيقونة عرض المزيد -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"},"className":"category-icon-container"} -->
            <div class="wp-block-group category-icon-container">
                
                <!-- wp:html -->
                <div class="category-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--wp--preset--color--primary), var(--wp--preset--color--accent)); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; position: relative; overflow: hidden;">
                    <div class="icon-bg-animation" style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); animation: rotate 8s linear infinite;"></div>
                    
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- محتوى البطاقة -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"},"className":"category-content"} -->
            <div class="wp-block-group category-content">
                
                <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem"}},"textColor":"foreground","className":"category-title"} -->
                <h3 class="wp-block-heading category-title has-text-align-center has-foreground-color has-text-color" style="font-size:1.5rem;font-weight:700">
                    جميع التصنيفات
                </h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.6"}},"textColor":"contrast","className":"category-description"} -->
                <p class="category-description has-text-align-center has-contrast-color has-text-color" style="font-size:1rem;line-height:1.6">
                    استكشف مجموعة شاملة من التصنيفات والمجالات المختلفة لحلولنا العملية
                </p>
                <!-- /wp:paragraph -->
                
                <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"},"className":"category-cta"} -->
                <div class="wp-block-group category-cta" style="margin-top:var(--wp--preset--spacing--large)">
                    
                    <!-- wp:html -->
                    <a href="/categories" class="category-explore-btn view-all-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, var(--wp--preset--color--primary), var(--wp--preset--color--accent)); color: white; padding: 0.75rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 124, 186, 0.3);">
                        <span>عرض الكل</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <!-- /wp:html -->
                    
                </div>
                <!-- /wp:group -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
</div>
<!-- /wp:group -->

<!-- أنماط CSS مخصصة للتصنيفات -->
<!-- wp:html -->
<style>
/* أنماط شبكة التصنيفات */
.category-grid-section {
    position: relative;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.category-card {
    transition: all 0.4s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15) !important;
}

.category-card:hover .category-icon {
    transform: scale(1.1) rotate(5deg);
}

.category-card:hover .category-explore-btn {
    transform: translateX(5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

/* تأثيرات الأيقونة */
.category-icon {
    transition: all 0.4s ease;
    position: relative;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* تأثيرات النص */
.category-title a {
    transition: color 0.3s ease;
}

.category-card:hover .category-title a {
    color: var(--wp--preset--color--primary);
}

.category-description {
    min-height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* الإحصائيات */
.category-stats {
    padding: 1rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 12px;
    margin: 1rem 0;
}

.posts-count,
.popularity-level {
    padding: 0.5rem 0.75rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

/* أزرار الاستكشاف */
.category-explore-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.category-explore-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.category-explore-btn:hover::before {
    left: 100%;
}

.category-explore-btn:hover {
    transform: translateX(5px) translateY(-2px);
}

/* بطاقة "عرض الكل" */
.view-all-categories {
    position: relative;
}

.view-all-categories::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(0, 124, 186, 0.05), transparent);
    animation: shimmer 3s ease-in-out infinite;
    pointer-events: none;
}

@keyframes shimmer {
    0%, 100% { transform: translateX(-100%); }
    50% { transform: translateX(100%); }
}

.view-all-btn {
    position: relative;
    z-index: 2;
}

/* الرسوم المتحركة للظهور */
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

.category-card {
    animation: fadeInUp 0.6s ease-out;
}

.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }

/* الاستجابة للأجهزة */
@media (max-width: 768px) {
    .categories-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .category-stats {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .posts-count,
    .popularity-level {
        justify-content: center;
        width: 100%;
    }
    
    .category-card {
        margin-bottom: 1rem;
    }
}

@media (max-width: 480px) {
    .category-icon {
        width: 60px !important;
        height: 60px !important;
    }
    
    .category-icon svg {
        width: 30px !important;
        height: 30px !important;
    }
    
    .category-title {
        font-size: 1.25rem !important;
    }
    
    .category-description {
        font-size: 0.9rem !important;
        min-height: auto;
    }
    
    .category-explore-btn {
        padding: 0.625rem 1.25rem !important;
        font-size: 0.85rem !important;
    }
}

/* تحسينات إضافية */
.category-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.category-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--wp--preset--color--primary), transparent);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.category-card:hover::after {
    transform: scaleX(1);
}

/* التركيز والوصول */
.category-card:focus-within,
.category-explore-btn:focus {
    outline: 2px solid var(--wp--preset--color--primary);
    outline-offset: 4px;
    border-radius: 16px;
}

.category-title a:focus {
    outline: 2px solid var(--wp--preset--color--primary);
    outline-offset: 2px;
    border-radius: 4px;
}

/* تحسينات الأداء */
.category-card {
    contain: layout style paint;
}

.category-card * {
    will-change: transform;
}

/* خاص بالطباعة */
@media print {
    .category-explore-btn,
    .icon-bg-animation {
        display: none !important;
    }
    
    .category-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
        break-inside: avoid;
    }
    
    .category-icon {
        box-shadow: none !important;
    }
}

/* تأثيرات إضافية للتفاعل */
.category-card:active {
    transform: translateY(-5px) scale(0.98);
}

.category-stats > div:hover {
    background: rgba(0, 124, 186, 0.1);
    border-color: var(--wp--preset--color--primary);
    transform: scale(1.05);
}
</style>
<!-- /wp:html -->