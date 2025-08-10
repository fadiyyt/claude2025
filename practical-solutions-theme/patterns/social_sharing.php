<?php
/**
 * Title: Social Sharing
 * Slug: practical-solutions/social-sharing
 * Description: أزرار مشاركة وسائل التواصل الاجتماعي مع تصميم متجاوب وجذاب
 * Categories: featured, social
 * Keywords: social, sharing, facebook, twitter, whatsapp
 * Block Types: core/group
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"},"border":{"radius":"12px","width":"1px","color":"var:preset|color|base"}},"backgroundColor":"base","className":"social-sharing-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group social-sharing-section has-border-color has-base-border-color has-base-background-color has-background" style="border-color:var(--wp--preset--color--base);border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)">
    
    <!-- عنوان قسم المشاركة -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"space-between"},"className":"sharing-header"} -->
    <div class="wp-block-group sharing-header">
        
        <!-- العنوان -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"sharing-title-group"} -->
        <div class="wp-block-group sharing-title-group">
            
            <!-- أيقونة المشاركة -->
            <!-- wp:html -->
            <div class="sharing-icon" style="width: 32px; height: 32px; background: linear-gradient(45deg, var(--wp--preset--color--primary), var(--wp--preset--color--accent)); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="5" r="3"/>
                    <circle cx="6" cy="12" r="3"/>
                    <circle cx="18" cy="19" r="3"/>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                </svg>
            </div>
            <!-- /wp:html -->
            
            <!-- wp:heading {"level":4,"style":{"typography":{"fontWeight":"600","fontSize":"1.125rem"}},"textColor":"foreground","className":"sharing-title"} -->
            <h4 class="wp-block-heading sharing-title has-foreground-color has-text-color" style="font-size:1.125rem;font-weight:600">
                شارك هذا المحتوى
            </h4>
            <!-- /wp:heading -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- عداد المشاركات -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"share-count"} -->
        <div class="wp-block-group share-count">
            
            <!-- wp:html -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.84 4.61C20.3292 4.099 19.7228 3.69364 19.0554 3.41708C18.3879 3.14052 17.6725 2.99817 16.95 2.99817C16.2275 2.99817 15.5121 3.14052 14.8446 3.41708C14.1772 3.69364 13.5708 4.099 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.5783 8.50903 2.9987 7.05 2.9987C5.59096 2.9987 4.19169 3.5783 3.16 4.61C2.1283 5.6417 1.5487 7.041 1.5487 8.5C1.5487 9.959 2.1283 11.3583 3.16 12.39L12 21.23L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6053C22.3095 9.93789 22.4518 9.22248 22.4518 8.5C22.4518 7.77752 22.3095 7.06211 22.0329 6.39467C21.7563 5.72723 21.351 5.1208 20.84 4.61V4.61Z"/>
            </svg>
            <!-- /wp:html -->
            
            <!-- wp:html -->
            <span class="total-shares" style="font-size: 0.875rem; font-weight: 500; color: var(--wp--preset--color--contrast);">
                127 مشاركة
            </span>
            <!-- /wp:html -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
    <!-- أزرار المشاركة -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"className":"social-buttons"} -->
    <div class="wp-block-group social-buttons">
        
        <!-- فيسبوك -->
        <!-- wp:html -->
        <button class="social-btn facebook-btn" data-platform="facebook" style="display: flex; align-items: center; gap: 0.5rem; background: #1877f2; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="مشاركة على فيسبوك">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span class="btn-text">فيسبوك</span>
            <span class="share-count-individual">23</span>
        </button>
        <!-- /wp:html -->
        
        <!-- تويتر/X -->
        <!-- wp:html -->
        <button class="social-btn twitter-btn" data-platform="twitter" style="display: flex; align-items: center; gap: 0.5rem; background: #1da1f2; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="مشاركة على تويتر">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
            </svg>
            <span class="btn-text">تويتر</span>
            <span class="share-count-individual">45</span>
        </button>
        <!-- /wp:html -->
        
        <!-- واتساب -->
        <!-- wp:html -->
        <button class="social-btn whatsapp-btn" data-platform="whatsapp" style="display: flex; align-items: center; gap: 0.5rem; background: #25d366; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="مشاركة على واتساب">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.085"/>
            </svg>
            <span class="btn-text">واتساب</span>
            <span class="share-count-individual">59</span>
        </button>
        <!-- /wp:html -->
        
        <!-- لينكد إن -->
        <!-- wp:html -->
        <button class="social-btn linkedin-btn" data-platform="linkedin" style="display: flex; align-items: center; gap: 0.5rem; background: #0a66c2; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="مشاركة على لينكد إن">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
            <span class="btn-text">لينكد إن</span>
            <span class="share-count-individual">8</span>
        </button>
        <!-- /wp:html -->
        
        <!-- تليجرام -->
        <!-- wp:html -->
        <button class="social-btn telegram-btn" data-platform="telegram" style="display: flex; align-items: center; gap: 0.5rem; background: #0088cc; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="مشاركة على تليجرام">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
            </svg>
            <span class="btn-text">تليجرام</span>
            <span class="share-count-individual">12</span>
        </button>
        <!-- /wp:html -->
        
        <!-- نسخ الرابط -->
        <!-- wp:html -->
        <button class="social-btn copy-link-btn" data-platform="copy" style="display: flex; align-items: center; gap: 0.5rem; background: var(--wp--preset--color--contrast); color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; text-decoration: none; min-width: 120px; justify-content: center;" title="نسخ الرابط">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
            </svg>
            <span class="btn-text">نسخ الرابط</span>
        </button>
        <!-- /wp:html -->
        
    </div>
    <!-- /wp:group -->
    
    <!-- رسالة التأكيد لنسخ الرابط -->
    <!-- wp:html -->
    <div class="copy-success-message" style="display: none; background: var(--wp--preset--color--success); color: white; padding: 0.75rem 1rem; border-radius: 8px; text-align: center; font-weight: 600; font-size: 0.9rem; margin-top: 1rem; animation: slideInUp 0.3s ease-out;">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="margin-left: 0.5rem; vertical-align: middle;">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
        تم نسخ الرابط بنجاح! 🎉
    </div>
    <!-- /wp:html -->
    
    <!-- إحصائيات إضافية -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|medium"},"padding":{"top":"var:preset|spacing|small"}},"border":{"top":{"color":"var:preset|color|base","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"},"className":"sharing-stats"} -->
    <div class="wp-block-group sharing-stats" style="border-top-color:var(--wp--preset--color--base);border-top-style:solid;border-top-width:1px;margin-top:var(--wp--preset--spacing--medium);padding-top:var(--wp--preset--spacing--small)">
        
        <!-- منصة الأكثر مشاركة -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"trending-platform"} -->
        <div class="wp-block-group trending-platform">
            
            <!-- wp:html -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--warning)" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
            </svg>
            <!-- /wp:html -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontWeight":"500"}},"textColor":"contrast"} -->
            <p class="has-contrast-color has-text-color" style="font-size:0.85rem;font-weight:500">
                الأكثر مشاركة: واتساب (46%)
            </p>
            <!-- /wp:paragraph -->
            
        </div>
        <!-- /wp:group -->
        
        <!-- آخر مشاركة -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"className":"last-share"} -->
        <div class="wp-block-group last-share">
            
            <!-- wp:html -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--wp--preset--color--contrast)" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <!-- /wp:html -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontWeight":"400"}},"textColor":"contrast"} -->
            <p class="has-contrast-color has-text-color" style="font-size:0.85rem;font-weight:400">
                آخر مشاركة: منذ 5 دقائق
            </p>
            <!-- /wp:paragraph -->
            
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    
</div>
<!-- /wp:group -->

<!-- سكريبت المشاركة الاجتماعية -->
<!-- wp:html -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تهيئة أزرار المشاركة الاجتماعية
    initSocialSharing();
    
    function initSocialSharing() {
        const socialButtons = document.querySelectorAll('.social-btn');
        const copySuccessMessage = document.querySelector('.copy-success-message');
        
        // معلومات الصفحة الحالية
        const pageUrl = encodeURIComponent(window.location.href);
        const pageTitle = encodeURIComponent(document.title);
        const pageDescription = encodeURIComponent(
            document.querySelector('meta[name="description"]')?.content || 
            'اكتشف حلول عملية مفيدة على موقع الحلول العملية'
        );
        
        socialButtons.forEach(button => {
            button.addEventListener('click', function() {
                const platform = this.dataset.platform;
                handleSocialShare(platform, pageUrl, pageTitle, pageDescription);
                
                // تأثير بصري
                animateButton(this);
                
                // تحديث العداد
                updateShareCount(this, platform);
            });
        });
        
        // تهيئة عدادات المشاركة
        loadShareCounts();
    }
    
    function handleSocialShare(platform, url, title, description) {
        let shareUrl = '';
        
        switch (platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                break;
                
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                break;
                
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${title}%20-%20${url}`;
                break;
                
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                break;
                
            case 'telegram':
                shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                break;
                
            case 'copy':
                copyToClipboard(decodeURIComponent(url));
                return;
                
            default:
                return;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');
        }
    }
    
    function copyToClipboard(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => {
                showCopySuccess();
            }).catch(() => {
                fallbackCopyTextToClipboard(text);
            });
        } else {
            fallbackCopyTextToClipboard(text);
        }
    }
    
    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopySuccess();
        } catch (err) {
            console.error('فشل في نسخ النص:', err);
        }
        
        document.body.removeChild(textArea);
    }
    
    function showCopySuccess() {
        const message = document.querySelector('.copy-success-message');
        if (message) {
            message.style.display = 'block';
            setTimeout(() => {
                message.style.display = 'none';
            }, 3000);
        }
    }
    
    function animateButton(button) {
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 150);
        
        // تأثير التموج
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            left: 50%;
            top: 50%;
            width: 20px;
            height: 20px;
            margin-left: -10px;
            margin-top: -10px;
        `;
        
        button.style.position = 'relative';
        button.style.overflow = 'hidden';
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    function updateShareCount(button, platform) {
        const countElement = button.querySelector('.share-count-individual');
        if (countElement) {
            let currentCount = parseInt(countElement.textContent) || 0;
            currentCount++;
            countElement.textContent = currentCount;
            
            // تحديث العداد الإجمالي
            updateTotalShareCount();
            
            // حفظ في التخزين المحلي
            const postId = getPostId();
            const storageKey = `shares_${postId}_${platform}`;
            localStorage.setItem(storageKey, currentCount);
        }
    }
    
    function updateTotalShareCount() {
        const totalElement = document.querySelector('.total-shares');
        const individualCounts = document.querySelectorAll('.share-count-individual');
        
        if (totalElement && individualCounts.length) {
            let total = 0;
            individualCounts.forEach(count => {
                total += parseInt(count.textContent) || 0;
            });
            totalElement.textContent = `${total} مشاركة`;
        }
    }
    
    function loadShareCounts() {
        const postId = getPostId();
        const buttons = document.querySelectorAll('.social-btn[data-platform]');
        
        buttons.forEach(button => {
            const platform = button.dataset.platform;
            const countElement = button.querySelector('.share-count-individual');
            
            if (countElement && platform !== 'copy') {
                const storageKey = `shares_${postId}_${platform}`;
                const savedCount = localStorage.getItem(storageKey);
                
                if (savedCount) {
                    countElement.textContent = savedCount;
                }
            }
        });
        
        updateTotalShareCount();
    }
    
    function getPostId() {
        // محاولة الحصول على معرف المقال من body class أو meta tag
        const body = document.body;
        const postIdMatch = body.className.match(/postid-(\d+)/);
        
        if (postIdMatch) {
            return postIdMatch[1];
        }
        
        const postIdMeta = document.querySelector('meta[name="post-id"]');
        return postIdMeta ? postIdMeta.content : window.location.pathname;
    }
    
    // تحديث إحصائيات الشعبية
    function updatePopularityStats() {
        const platforms = ['facebook', 'twitter', 'whatsapp', 'linkedin', 'telegram'];
        const counts = {};
        let total = 0;
        
        platforms.forEach(platform => {
            const button = document.querySelector(`[data-platform="${platform}"]`);
            const countElement = button?.querySelector('.share-count-individual');
            const count = parseInt(countElement?.textContent) || 0;
            counts[platform] = count;
            total += count;
        });
        
        // العثور على المنصة الأكثر شعبية
        let mostPopular = '';
        let maxCount = 0;
        
        for (const [platform, count] of Object.entries(counts)) {
            if (count > maxCount) {
                maxCount = count;
                mostPopular = platform;
            }
        }
        
        // تحديث نص الشعبية
        if (mostPopular && total > 0) {
            const percentage = Math.round((maxCount / total) * 100);
            const platformNames = {
                'facebook': 'فيسبوك',
                'twitter': 'تويتر',
                'whatsapp': 'واتساب',
                'linkedin': 'لينكد إن',
                'telegram': 'تليجرام'
            };
            
            const trendingElement = document.querySelector('.trending-platform p');
            if (trendingElement) {
                trendingElement.textContent = `الأكثر مشاركة: ${platformNames[mostPopular]} (${percentage}%)`;
            }
        }
    }
    
    // تحديث الإحصائيات كل 30 ثانية
    setInterval(updatePopularityStats, 30000);
    updatePopularityStats();
});

// إضافة أنماط CSS للرسوم المتحركة
const style = document.createElement('style');
style.textContent = `
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
`;
document.head.appendChild(style);
</script>
<!-- /wp:html -->

<!-- أنماط CSS مخصصة للمشاركة الاجتماعية -->
<!-- wp:html -->
<style>
/* أنماط المشاركة الاجتماعية */
.social-sharing-section {
    transition: all 0.3s ease;
}

.social-sharing-section:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.sharing-header {
    margin-bottom: 1rem;
}

.sharing-icon {
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* أزرار المشاركة */
.social-buttons {
    gap: 0.75rem;
}

.social-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.social-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
}

.social-btn:active {
    transform: translateY(-1px);
}

/* أنماط خاصة لكل منصة */
.facebook-btn:hover {
    background: #166fe5 !important;
    box-shadow: 0 8px 25px rgba(24, 119, 242, 0.4);
}

.twitter-btn:hover {
    background: #1a91da !important;
    box-shadow: 0 8px 25px rgba(29, 161, 242, 0.4);
}

.whatsapp-btn:hover {
    background: #20ba5a !important;
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
}

.linkedin-btn:hover {
    background: #095a9b !important;
    box-shadow: 0 8px 25px rgba(10, 102, 194, 0.4);
}

.telegram-btn:hover {
    background: #0077b5 !important;
    box-shadow: 0 8px 25px rgba(0, 136, 204, 0.4);
}

.copy-link-btn:hover {
    background: var(--wp--preset--color--primary) !important;
    box-shadow: 0 8px 25px rgba(0, 124, 186, 0.4);
}

/* عدادات المشاركة */
.share-count-individual {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem !important;
    font-weight: 700;
    margin-right: 0.25rem;
}

/* رسالة النجاح */
.copy-success-message {
    animation: slideInUp 0.3s ease-out;
}

/* الإحصائيات */
.sharing-stats {
    font-size: 0.85rem;
}

.trending-platform,
.last-share {
    padding: 0.5rem 0.75rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 8px;
    transition: background 0.3s ease;
}

.trending-platform:hover,
.last-share:hover {
    background: rgba(0, 0, 0, 0.05);
}

/* الاستجابة للأجهزة */
@media (max-width: 768px) {
    .social-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .social-btn {
        width: 100%;
        justify-content: center;
        min-width: auto;
        margin: 0.25rem 0;
    }
    
    .sharing-header {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        text-align: center;
    }
    
    .sharing-stats {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        text-align: center;
    }
    
    .trending-platform,
    .last-share {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .social-sharing-section {
        padding: 1rem;
    }
    
    .social-btn {
        padding: 0.625rem 0.875rem;
        font-size: 0.85rem;
    }
    
    .social-btn .btn-text {
        display: none;
    }
    
    .social-btn svg {
        margin: 0;
    }
    
    .sharing-title {
        font-size: 1rem !important;
    }
    
    .share-count span {
        font-size: 0.8rem;
    }
}

/* تحسينات إضافية */
.social-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.social-btn:hover::before {
    left: 100%;
}

/* تأثيرات الوصول */
.social-btn:focus {
    outline: 2px solid rgba(255, 255, 255, 0.8);
    outline-offset: 2px;
}

/* خاص بالطباعة */
@media print {
    .social-sharing-section {
        display: none !important;
    }
}

/* تحسينات الأداء */
.social-btn {
    contain: layout style paint;
}

.social-btn * {
    will-change: transform;
}

/* تأثيرات إضافية */
.social-sharing-section::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--wp--preset--color--primary), transparent);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.social-sharing-section:hover::after {
    transform: scaleX(1);
}
</style>
<!-- /wp:html -->