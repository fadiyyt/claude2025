<?php
/**
 * Title: Newsletter Subscription
 * Slug: practical-solutions/newsletter
 * Description: قسم الاشتراك في النشرة البريدية مع تصميم جذاب ومحفز
 * Categories: featured, call-to-action
 * Keywords: newsletter, subscription, email, cta
 * Block Types: core/group
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|xx-large"}}},"backgroundColor":"primary","textColor":"background","className":"newsletter-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull newsletter-section has-primary-background-color has-background-color has-background has-text-color" style="padding-top:var(--wp--preset--spacing--xx-large);padding-bottom:var(--wp--preset--spacing--xx-large)">
    
    <!-- خلفية ديكورية -->
    <!-- wp:html -->
    <div class="newsletter-background" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden; pointer-events: none;">
        <!-- أشكال ديكورية -->
        <div class="bg-shape shape-1" style="position: absolute; top: 20%; left: 10%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
        <div class="bg-shape shape-2" style="position: absolute; top: 60%; right: 15%; width: 100px; height: 100px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;"></div>
        <div class="bg-shape shape-3" style="position: absolute; bottom: 20%; left: 20%; width: 80px; height: 80px; background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
        
        <!-- خطوط متموجة -->
        <svg class="wave-pattern" style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100px; opacity: 0.1;" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
        </svg>
    </div>
    <!-- /wp:html -->
    
    <!-- محتوى النشرة البريدية -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-large"},"position":{"type":"relative"}},"layout":{"type":"constrained","contentSize":"800px"},"className":"newsletter-content"} -->
    <div class="wp-block-group newsletter-content" style="position: relative; z-index: 2;">
        
        <!-- العنوان والوصف -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"},"className":"newsletter-header"} -->
        <div class="wp-block-group newsletter-header">
            
            <!-- أيقونة النشرة البريدية -->
            <!-- wp:group {"layout":{"type":"flex","justifyContent":"center"},"className":"newsletter-icon"} -->
            <div class="wp-block-group newsletter-icon">
                
                <!-- wp:html -->
                <div class="newsletter-icon-container" style="width: 100px; height: 100px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; position: relative; backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.2); animation: pulse 3s ease-in-out infinite;">
                    <svg width="50" height="50" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"/>
                        <polyline points="22 6 12 13 2 6"/>
                    </svg>
                    
                    <!-- دوائر ديكورية -->
                    <div class="icon-decoration decoration-1" style="position: absolute; top: -10px; right: -10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.3); border-radius: 50%; animation: float 4s ease-in-out infinite;"></div>
                    <div class="icon-decoration decoration-2" style="position: absolute; bottom: -5px; left: -5px; width: 15px; height: 15px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; animation: float 5s ease-in-out infinite reverse;"></div>
                </div>
                <!-- /wp:html -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- العنوان الرئيسي -->
            <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"800","fontSize":"clamp(2rem, 5vw, 3rem)","lineHeight":"1.2"}},"textColor":"background","className":"newsletter-title"} -->
            <h2 class="wp-block-heading newsletter-title has-text-align-center has-background-color has-text-color" style="font-size:clamp(2rem, 5vw, 3rem);font-weight:800;line-height:1.2">
                ابق على اطلاع دائم
            </h2>
            <!-- /wp:heading -->
            
            <!-- العنوان الفرعي -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.125rem, 3vw, 1.5rem)","lineHeight":"1.6","fontWeight":"400"}},"textColor":"background","className":"newsletter-subtitle"} -->
            <p class="newsletter-subtitle has-text-align-center has-background-color has-text-color" style="font-size:clamp(1.125rem, 3vw, 1.5rem);font-weight:400;line-height:1.6">
                احصل على أحدث الحلول العملية والنصائح المفيدة مباشرة في بريدك الإلكتروني
            </p>
            <!-- /wp:paragraph -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- نموذج الاشتراك -->
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained","contentSize":"500px"},"className":"newsletter-form-container"} -->
        <div class="wp-block-group newsletter-form-container" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:var(--wp--preset--spacing--large)">
            
            <!-- wp:html -->
            <form class="newsletter-form" id="newsletter-subscription-form" style="position: relative;">
                
                <!-- حاوي حقل البريد الإلكتروني -->
                <div class="email-input-container" style="display: flex; background: rgba(255, 255, 255, 0.95); border-radius: 50px; padding: 0.5rem; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.3); transition: all 0.3s ease;">
                    
                    <!-- حقل البريد الإلكتروني -->
                    <input type="email" 
                           name="email" 
                           id="newsletter-email"
                           placeholder="أدخل بريدك الإلكتروني هنا..."
                           required
                           style="flex: 1; border: none; outline: none; padding: 1rem 1.5rem; font-size: 1rem; background: transparent; color: var(--wp--preset--color--foreground); font-family: inherit;"
                           aria-label="البريد الإلكتروني للاشتراك في النشرة"
                           autocomplete="email" />
                    
                    <!-- زر الاشتراك -->
                    <button type="submit" 
                            class="newsletter-submit-btn"
                            style="background: linear-gradient(45deg, var(--wp--preset--color--accent), #ff6b6b); color: white; border: none; padding: 1rem 2rem; border-radius: 40px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);"
                            aria-label="اشترك في النشرة البريدية">
                        
                        <span class="btn-text">اشترك الآن</span>
                        
                        <!-- أيقونة السهم -->
                        <svg class="btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="transition: transform 0.3s ease;">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                        
                        <!-- مؤشر التحميل -->
                        <svg class="loading-spinner" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="display: none; animation: spin 1s linear infinite;">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.3"/>
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-dasharray="31.416" stroke-dashoffset="31.416" opacity="1">
                                <animate attributeName="stroke-dasharray" dur="2s" values="0 31.416;15.708 15.708;0 31.416" repeatCount="indefinite"/>
                                <animate attributeName="stroke-dashoffset" dur="2s" values="0;-15.708;-31.416" repeatCount="indefinite"/>
                            </circle>
                        </svg>
                        
                    </button>
                    
                </div>
                
                <!-- رسائل التأكيد والخطأ -->
                <div class="form-messages" style="margin-top: 1rem; text-align: center;">
                    
                    <!-- رسالة النجاح -->
                    <div class="success-message" style="display: none; background: rgba(39, 174, 96, 0.9); color: white; padding: 1rem; border-radius: 12px; font-weight: 600; animation: slideInUp 0.5s ease-out;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-left: 0.5rem; vertical-align: middle;">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        شكراً لك! تم الاشتراك بنجاح في النشرة البريدية 🎉
                    </div>
                    
                    <!-- رسالة الخطأ -->
                    <div class="error-message" style="display: none; background: rgba(231, 76, 60, 0.9); color: white; padding: 1rem; border-radius: 12px; font-weight: 600; animation: slideInUp 0.5s ease-out;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-left: 0.5rem; vertical-align: middle;">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        <span class="error-text">حدث خطأ، يرجى المحاولة مرة أخرى</span>
                    </div>
                    
                </div>
                
            </form>
            <!-- /wp:html -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- المزايا والفوائد -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"className":"newsletter-benefits"} -->
        <div class="wp-block-group newsletter-benefits">
            
            <!-- ميزة 1 -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"benefit-item"} -->
            <div class="wp-block-group benefit-item">
                
                <!-- wp:html -->
                <div class="benefit-icon" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:1rem;font-weight:600">
                    حلول جديدة أسبوعياً
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- ميزة 2 -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"benefit-item"} -->
            <div class="wp-block-group benefit-item">
                
                <!-- wp:html -->
                <div class="benefit-icon" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z"/>
                        <polyline points="2 17 12 22 22 17"/>
                        <polyline points="2 12 12 17 22 12"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:1rem;font-weight:600">
                    محتوى حصري مجاناً
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- ميزة 3 -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"benefit-item"} -->
            <div class="wp-block-group benefit-item">
                
                <!-- wp:html -->
                <div class="benefit-icon" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 11H15M9 15H15M17 21V13.5C17 13.5 17 11 15 11H9C7 11 7 13.5 7 13.5V21L12 19L17 21Z"/>
                        <path d="M12 7.5C13.3807 7.5 14.5 6.38071 14.5 5C14.5 3.61929 13.3807 2.5 12 2.5C10.6193 2.5 9.5 3.61929 9.5 5C9.5 6.38071 10.6193 7.5 12 7.5Z"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:1rem;font-weight:600">
                    إلغاء الاشتراك في أي وقت
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- الإحصائيات والثقة -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large","margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"className":"newsletter-trust"} -->
        <div class="wp-block-group newsletter-trust" style="margin-top:var(--wp--preset--spacing--large)">
            
            <!-- عدد المشتركين -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"trust-stat"} -->
            <div class="wp-block-group trust-stat">
                
                <!-- wp:html -->
                <div class="stat-icon" style="width: 30px; height: 30px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21V19C23 17.9391 22.5786 16.9217 21.8284 16.1716C21.0783 15.4214 20.0609 15 19 15C17.9391 15 16.9217 15.4214 16.1716 16.1716C15.4214 16.9217 15 17.9391 15 19V21"/>
                        <circle cx="16" cy="7" r="4"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:0.9rem;font-weight:600">
                    +5,000 مشترك
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- معدل الفتح -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"trust-stat"} -->
            <div class="wp-block-group trust-stat">
                
                <!-- wp:html -->
                <div class="stat-icon" style="width: 30px; height: 30px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:0.9rem;font-weight:600">
                    معدل فتح 85%
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
            <!-- الخصوصية -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"trust-stat"} -->
            <div class="wp-block-group trust-stat">
                
                <!-- wp:html -->
                <div class="stat-icon" style="width: 30px; height: 30px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22S8 18 8 13V6L12 4L16 6V13C16 18 12 22 12 22Z"/>
                    </svg>
                </div>
                <!-- /wp:html -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem","fontWeight":"600"}},"textColor":"background"} -->
                <p class="has-background-color has-text-color" style="font-size:0.9rem;font-weight:600">
                    خصوصية محمية 100%
                </p>
                <!-- /wp:paragraph -->
                
            </div>
            <!-- /wp:group -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- رسالة الخصوصية -->
        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.85rem","lineHeight":"1.5"}},"textColor":"background","className":"privacy-note"} -->
        <p class="privacy-note has-text-align-center has-background-color has-text-color" style="font-size:0.85rem;line-height:1.5">
            🔒 نحترم خصوصيتك. لن نشارك بريدك الإلكتروني مع أي طرف ثالث. يمكنك إلغاء الاشتراك في أي وقت.
        </p>
        <!-- /wp:paragraph -->
        
    </div>
    <!-- /wp:group -->
    
</div>
<!-- /wp:group -->

<!-- أنماط CSS مخصصة للنشرة البريدية -->
<!-- wp:html -->
<style>
/* أنماط قسم النشرة البريدية */
.newsletter-section {
    position: relative;
    overflow: hidden;
}

.newsletter-background {
    z-index: 1;
}

.newsletter-content {
    z-index: 2;
    position: relative;
}

/* الرسوم المتحركة */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
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

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* نموذج الاشتراك */
.newsletter-form {
    animation: slideInUp 0.8s ease-out 0.3s both;
}

.email-input-container:focus-within {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    border-color: rgba(255, 255, 255, 0.5);
}

.newsletter-email:focus {
    outline: none;
}

.newsletter-email::placeholder {
    color: rgba(44, 62, 80, 0.6);
}

/* زر الاشتراك */
.newsletter-submit-btn:hover {
    background: linear-gradient(45deg, #ff6b6b, var(--wp--preset--color--accent));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.6);
}

.newsletter-submit-btn:hover .btn-icon {
    transform: translateX(5px);
}

.newsletter-submit-btn:active {
    transform: translateY(0);
}

.newsletter-submit-btn.loading .btn-text,
.newsletter-submit-btn.loading .btn-icon {
    display: none;
}

.newsletter-submit-btn.loading .loading-spinner {
    display: block;
}

/* المزايا */
.newsletter-benefits {
    animation: slideInUp 0.8s ease-out 0.5s both;
}

.benefit-item {
    padding: 1rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease;
    margin: 0.5rem;
}

.benefit-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

/* إحصائيات الثقة */
.newsletter-trust {
    animation: slideInUp 0.8s ease-out 0.7s both;
}

.trust-stat {
    padding: 0.75rem 1rem;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.trust-stat:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

/* رسالة الخصوصية */
.privacy-note {
    animation: slideInUp 0.8s ease-out 0.9s both;
    opacity: 0.9;
}

/* الاستجابة للأجهزة */
@media (max-width: 768px) {
    .newsletter-section {
        padding-top: var(--wp--preset--spacing--x-large);
        padding-bottom: var(--wp--preset--spacing--x-large);
    }
    
    .email-input-container {
        flex-direction: column;
        border-radius: 16px;
        padding: 1rem;
    }
    
    .newsletter-email {
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .newsletter-submit-btn {
        border-radius: 12px;
        width: 100%;
        justify-content: center;
    }
    
    .newsletter-benefits {
        flex-direction: column;
        align-items: center;
    }
    
    .benefit-item {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .newsletter-trust {
        flex-direction: column;
        align-items: center;
    }
    
    .trust-stat {
        margin: 0.25rem 0;
    }
    
    .bg-shape {
        display: none;
    }
}

@media (max-width: 480px) {
    .newsletter-title {
        font-size: clamp(1.5rem, 8vw, 2rem) !important;
    }
    
    .newsletter-subtitle {
        font-size: clamp(1rem, 4vw, 1.25rem) !important;
    }
    
    .newsletter-icon-container {
        width: 80px !important;
        height: 80px !important;
    }
    
    .newsletter-icon-container svg {
        width: 40px !important;
        height: 40px !important;
    }
    
    .newsletter-email {
        font-size: 0.9rem;
        padding: 0.875rem 1.25rem;
    }
    
    .newsletter-submit-btn {
        font-size: 0.9rem;
        padding: 0.875rem 1.5rem;
    }
    
    .benefit-item,
    .trust-stat {
        margin: 0.375rem;
        padding: 0.625rem 0.875rem;
    }
}

/* تحسينات إضافية */
.newsletter-form-container {
    max-width: 100%;
}

.form-messages > div {
    border-radius: 12px;
    margin: 0.5rem 0;
}

/* تأثيرات بصرية إضافية */
.newsletter-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        var(--wp--preset--color--primary) 0%, 
        var(--wp--preset--color--accent) 50%, 
        var(--wp--preset--color--primary) 100%);
    z-index: 0;
}

.newsletter-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="rgba(255,255,255,0.05)" fill-opacity="0.1"><circle cx="36" cy="24" r="5"/></g></g></svg>');
    z-index: 1;
    opacity: 0.3;
}

/* تحسينات الأداء */
.newsletter-section * {
    will-change: transform;
}

.newsletter-section .wp-block-group {
    contain: layout style paint;
}

/* إضافات للوصول */
.newsletter-email:focus,
.newsletter-submit-btn:focus {
    outline: 2px solid rgba(255, 255, 255, 0.8);
    outline-offset: 2px;
}

/* خاص بالطباعة */
@media print {
    .newsletter-section {
        background: #f8f9fa !important;
        color: #333 !important;
    }
    
    .bg-shape,
    .wave-pattern,
    .newsletter-background {
        display: none !important;
    }
    
    .newsletter-form {
        border: 2px solid #333 !important;
        padding: 1rem !important;
    }
}
</style>
<!-- /wp:html -->