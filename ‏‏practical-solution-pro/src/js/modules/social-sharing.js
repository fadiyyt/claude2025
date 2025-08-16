/**
 * Social Sharing Module
 * وحدة المشاركة الاجتماعية
 */

export function initSocialSharing() {
    console.log('🔗 تم تفعيل وحدة المشاركة الاجتماعية');
    
    // البحث عن أزرار المشاركة
    const shareButtons = document.querySelectorAll('.ps-social-share .share-btn');
    
    if (shareButtons.length === 0) {
        console.log('لا توجد أزرار مشاركة للتفعيل');
        return;
    }
    
    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const platform = this.dataset.platform;
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            const description = encodeURIComponent(
                document.querySelector('meta[name="description"]')?.content || ''
            );
            
            let shareUrl = '';
            
            switch (platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                    break;
                
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
                
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                    break;
                
                case 'email':
                    shareUrl = `mailto:?subject=${title}&body=${description}%0A%0A${url}`;
                    break;
                
                default:
                    console.warn(`منصة غير مدعومة: ${platform}`);
                    return;
            }
            
            if (shareUrl) {
                if (platform === 'email') {
                    window.location.href = shareUrl;
                } else {
                    openShareWindow(shareUrl, platform);
                }
                
                // تتبع المشاركة
                trackShare(platform);
            }
        });
    });
    
    // إضافة أزرار المشاركة تلقائياً إذا لم تكن موجودة
    autoAddShareButtons();
    
    // تفعيل Web Share API إذا كان مدعوماً
    initWebShareAPI();
}

function openShareWindow(url, platform) {
    const windowFeatures = 'width=600,height=400,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, `share-${platform}`, windowFeatures);
    
    if (newWindow) {
        newWindow.focus();
    }
}

function trackShare(platform) {
    // تتبع المشاركة مع Google Analytics إذا كان متاحاً
    if (typeof gtag === 'function') {
        gtag('event', 'share', {
            method: platform,
            content_type: 'article',
            content_id: window.location.pathname
        });
    }
    
    // إرسال حدث مخصص
    const shareEvent = new CustomEvent('ps-social-share', {
        detail: {
            platform: platform,
            url: window.location.href,
            title: document.title
        }
    });
    
    document.dispatchEvent(shareEvent);
    
    console.log(`تم مشاركة المحتوى عبر ${platform}`);
}

function autoAddShareButtons() {
    // البحث عن العناصر التي تحتاج أزرار مشاركة
    const postsContent = document.querySelectorAll('.wp-block-post-content, article.post');
    
    postsContent.forEach(post => {
        if (!post.querySelector('.ps-social-share')) {
            const shareContainer = createShareButtons();
            
            // إضافة الأزرار في نهاية المحتوى
            post.appendChild(shareContainer);
        }
    });
}

function createShareButtons() {
    const shareContainer = document.createElement('div');
    shareContainer.className = 'ps-social-share';
    shareContainer.innerHTML = `
        <h4 class="share-title">شارك هذا المقال:</h4>
        <div class="share-buttons">
            <button class="share-btn share-btn--facebook" data-platform="facebook" aria-label="مشاركة في فيسبوك">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                فيسبوك
            </button>
            
            <button class="share-btn share-btn--twitter" data-platform="twitter" aria-label="مشاركة في تويتر">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
                تويتر
            </button>
            
            <button class="share-btn share-btn--whatsapp" data-platform="whatsapp" aria-label="مشاركة في واتساب">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.085"/>
                </svg>
                واتساب
            </button>
            
            <button class="share-btn share-btn--email" data-platform="email" aria-label="مشاركة بالبريد الإلكتروني">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                إيميل
            </button>
        </div>
    `;
    
    // إضافة الأنماط
    addShareButtonStyles();
    
    return shareContainer;
}

function addShareButtonStyles() {
    if (document.getElementById('ps-share-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'ps-share-styles';
    styles.textContent = `
        .ps-social-share {
            margin: 2rem 0;
            padding: 1.5rem;
            background: var(--ps-bg-light, #f9fafb);
            border-radius: var(--ps-radius, 8px);
            border: 1px solid var(--ps-border, #e5e7eb);
        }
        
        .ps-social-share .share-title {
            margin: 0 0 1rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ps-text, #1a1a1a);
        }
        
        .share-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        
        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: var(--ps-radius, 8px);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }
        
        .share-btn--facebook {
            background: #1877f2;
        }
        
        .share-btn--twitter {
            background: #1da1f2;
        }
        
        .share-btn--whatsapp {
            background: #25d366;
        }
        
        .share-btn--email {
            background: #6b7280;
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .share-btn svg {
            flex-shrink: 0;
        }
        
        @media (max-width: 768px) {
            .share-buttons {
                justify-content: center;
            }
            
            .share-btn {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }
        }
    `;
    
    document.head.appendChild(styles);
}

function initWebShareAPI() {
    if ('share' in navigator) {
        // إضافة زر Web Share API للأجهزة المدعومة
        const shareContainer = document.querySelector('.ps-social-share .share-buttons');
        
        if (shareContainer) {
            const webShareBtn = document.createElement('button');
            webShareBtn.className = 'share-btn share-btn--native';
            webShareBtn.style.background = 'var(--ps-primary, #007cba)';
            webShareBtn.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92z"/>
                </svg>
                مشاركة
            `;
            
            webShareBtn.addEventListener('click', async function() {
                try {
                    await navigator.share({
                        title: document.title,
                        text: document.querySelector('meta[name="description"]')?.content || '',
                        url: window.location.href
                    });
                    
                    trackShare('native');
                } catch (err) {
                    console.log('مشاركة ملغاة أو فشلت:', err);
                }
            });
            
            shareContainer.appendChild(webShareBtn);
        }
    }
}

// تصدير الدوال للاستخدام الخارجي
export { trackShare, createShareButtons };

export default { 
    initSocialSharing, 
    trackShare, 
    createShareButtons 
};