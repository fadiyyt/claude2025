<?php
/**
 * صفحة المقال الواحد - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<div class="app-container single-post-container" id="appContainer">
    
    <!-- شريط التنقل العلوي -->
    <header class="article-header">
        <div class="header-controls">
            <button class="back-button" onclick="history.back()" aria-label="العودة">
                ←
            </button>
            <div class="header-actions">
                <button class="bookmark-btn" id="bookmarkBtn" aria-label="إضافة للمفضلة">
                    🔖
                </button>
                <button class="share-btn" id="shareBtn" aria-label="مشاركة">
                    📤
                </button>
            </div>
        </div>
        
        <!-- شريط التقدم في القراءة -->
        <div class="reading-progress-bar">
            <div class="reading-progress" id="readingProgress"></div>
        </div>
    </header>

    <?php if (have_posts()): while (have_posts()): the_post(); ?>
    
    <!-- محتوى المقال -->
    <main class="article-content" id="main">
        
        <!-- صورة المقال الرئيسية -->
        <?php if (has_post_thumbnail()): ?>
        <div class="article-featured-image">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'hero-thumb'); ?>" 
                 alt="<?php the_title(); ?>" 
                 class="featured-image"
                 loading="eager">
            
            <!-- تراكب مع معلومات أساسية -->
            <div class="image-overlay">
                <div class="article-meta-overlay">
                    <?php 
                    $categories = get_the_category();
                    if (!empty($categories)): ?>
                    <span class="article-category"><?php echo $categories[0]->name; ?></span>
                    <?php endif; ?>
                    
                    <div class="article-stats">
                        <span class="reading-time">⏱️ <?php echo practical_solutions_reading_time(get_the_ID()); ?> دقائق</span>
                        <span class="views-count">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- عنوان ومعلومات المقال -->
        <div class="article-header-content">
            <h1 class="article-title"><?php the_title(); ?></h1>
            
            <div class="article-meta">
                <div class="author-info">
                    <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'author-avatar')); ?>
                    <div class="author-details">
                        <span class="author-name"><?php the_author(); ?></span>
                        <span class="publish-date"><?php echo get_the_date('j F Y'); ?></span>
                    </div>
                </div>
                
                <div class="article-actions">
                    <div class="difficulty-level">
                        <?php 
                        $difficulty = get_post_meta(get_the_ID(), 'difficulty_level', true) ?: 'متوسط';
                        $difficulty_icons = array(
                            'سهل' => '🟢',
                            'متوسط' => '🟡', 
                            'صعب' => '🔴'
                        );
                        ?>
                        <span class="difficulty-indicator">
                            <?php echo $difficulty_icons[$difficulty] ?? '🟡'; ?>
                            <?php echo $difficulty; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- محتوى المقال -->
        <article class="article-body">
            <?php 
            // إضافة فهرس المحتويات إذا كان المقال طويلاً
            $content = get_the_content();
            if (str_word_count(strip_tags($content)) > 500): ?>
            <div class="table-of-contents">
                <h3>📋 فهرس المحتويات</h3>
                <div id="tocContainer"></div>
            </div>
            <?php endif; ?>
            
            <div class="content-wrapper">
                <?php 
                the_content();
                
                // رابط الصفحات للمقالات المقسمة
                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . __('الصفحات:', 'practical-solutions') . '</span>',
                    'after'  => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ));
                ?>
            </div>
            
            <!-- المواد والأدوات المطلوبة -->
            <?php 
            $materials = get_post_meta(get_the_ID(), 'required_materials', true);
            if ($materials): ?>
            <div class="materials-section">
                <h3>🛠️ المواد والأدوات المطلوبة</h3>
                <div class="materials-list">
                    <?php 
                    $materials_array = explode("\n", $materials);
                    foreach ($materials_array as $material): 
                        if (trim($material)): ?>
                        <div class="material-item">
                            <span class="material-icon">✓</span>
                            <span class="material-text"><?php echo trim($material); ?></span>
                        </div>
                        <?php endif; 
                    endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- نصائح إضافية -->
            <?php 
            $tips = get_post_meta(get_the_ID(), 'additional_tips', true);
            if ($tips): ?>
            <div class="tips-section">
                <h3>💡 نصائح إضافية</h3>
                <div class="tips-content">
                    <?php echo wpautop($tips); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- تحذيرات الأمان -->
            <?php 
            $warnings = get_post_meta(get_the_ID(), 'safety_warnings', true);
            if ($warnings): ?>
            <div class="warnings-section">
                <h3>⚠️ تحذيرات مهمة</h3>
                <div class="warnings-content">
                    <?php echo wpautop($warnings); ?>
                </div>
            </div>
            <?php endif; ?>
        </article>
        
        <!-- تقييم المقال -->
        <div class="article-rating">
            <h4>هل كان هذا المقال مفيداً؟</h4>
            <div class="rating-buttons">
                <button class="rating-btn positive" data-rating="positive">
                    👍 مفيد (<span id="positiveCount"><?php echo get_post_meta(get_the_ID(), 'positive_ratings', true) ?: '0'; ?></span>)
                </button>
                <button class="rating-btn negative" data-rating="negative">
                    👎 غير مفيد (<span id="negativeCount"><?php echo get_post_meta(get_the_ID(), 'negative_ratings', true) ?: '0'; ?></span>)
                </button>
            </div>
        </div>
        
        <!-- الكلمات المفتاحية -->
        <?php 
        $tags = get_the_tags();
        if ($tags): ?>
        <div class="article-tags">
            <h4>🏷️ الكلمات المفتاحية</h4>
            <div class="tags-list">
                <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-item">
                    #<?php echo $tag->name; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
    </main>
    
    <!-- مقالات ذات صلة -->
    <section class="related-articles">
        <h3>📚 مقالات ذات صلة</h3>
        <div class="related-grid">
            <?php
            $related_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'post__not_in' => array(get_the_ID()),
                'category__in' => wp_get_post_categories(get_the_ID()),
                'orderby' => 'rand'
            ));
            
            if ($related_posts->have_posts()):
                while ($related_posts->have_posts()): $related_posts->the_post(); ?>
                <article class="related-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'card-thumb'); ?>" 
                             alt="<?php the_title(); ?>" 
                             class="related-image"
                             loading="lazy">
                        <?php endif; ?>
                        <div class="related-content">
                            <h4 class="related-title"><?php the_title(); ?></h4>
                            <p class="related-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
                            <div class="related-meta">
                                <span class="related-date"><?php echo get_the_date('M j'); ?></span>
                                <span class="related-views">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); 
            endif; ?>
        </div>
    </section>
    
    <!-- قسم التعليقات -->
    <?php if (comments_open() || get_comments_number()): ?>
    <section class="comments-section">
        <h3>💬 التعليقات والمناقشة</h3>
        <?php comments_template(); ?>
    </section>
    <?php endif; ?>
    
    <?php endwhile; endif; ?>

    <!-- الأزرار العائمة -->
    <div class="floating-actions">
        <button class="fab-main" id="fabMain" aria-label="القائمة السريعة">
            ⚡
        </button>
    </div>

</div>

<!-- نافذة مشاركة المقال -->
<div class="share-article-modal" id="shareArticleModal" style="display: none;">
    <div class="share-modal-content">
        <div class="share-modal-header">
            <h3>مشاركة هذا المقال</h3>
            <button class="close-modal" id="closeShareArticleModal">&times;</button>
        </div>
        <div class="article-share-preview">
            <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" 
                 alt="<?php the_title(); ?>" class="share-preview-image">
            <?php endif; ?>
            <div class="share-preview-content">
                <h4><?php the_title(); ?></h4>
                <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
            </div>
        </div>
        <div class="share-options">
            <button class="share-option" data-platform="whatsapp">
                <span class="share-icon">💬</span>
                <span class="share-text">واتساب</span>
            </button>
            <button class="share-option" data-platform="facebook">
                <span class="share-icon">📘</span>
                <span class="share-text">فيسبوك</span>
            </button>
            <button class="share-option" data-platform="twitter">
                <span class="share-icon">🐦</span>
                <span class="share-text">تويتر</span>
            </button>
            <button class="share-option" data-platform="telegram">
                <span class="share-icon">✈️</span>
                <span class="share-text">تليجرام</span>
            </button>
            <button class="share-option" data-platform="copy">
                <span class="share-icon">📋</span>
                <span class="share-text">نسخ الرابط</span>
            </button>
            <button class="share-option" data-platform="email">
                <span class="share-icon">📧</span>
                <span class="share-text">إيميل</span>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // تتبع التقدم في القراءة
    const progressBar = document.getElementById('readingProgress');
    const article = document.querySelector('.article-body');
    
    function updateReadingProgress() {
        if (!article || !progressBar) return;
        
        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        
        const progress = Math.min(100, Math.max(0, 
            ((scrollTop - articleTop + windowHeight) / articleHeight) * 100
        ));
        
        progressBar.style.width = progress + '%';
        
        // حفظ التقدم في التخزين المحلي
        localStorage.setItem('reading_progress_<?php echo get_the_ID(); ?>', progress);
    }
    
    window.addEventListener('scroll', updateReadingProgress);
    
    // استرجاع التقدم المحفوظ
    const savedProgress = localStorage.getItem('reading_progress_<?php echo get_the_ID(); ?>');
    if (savedProgress && savedProgress > 10) {
        const shouldResume = confirm('هل تريد المتابعة من حيث توقفت في القراءة؟');
        if (shouldResume) {
            const targetScroll = (article.offsetTop + (article.offsetHeight * savedProgress / 100)) - window.innerHeight / 2;
            window.scrollTo({ top: targetScroll, behavior: 'smooth' });
        }
    }
    
    // إنشاء فهرس المحتويات تلقائياً
    const tocContainer = document.getElementById('tocContainer');
    if (tocContainer) {
        const headings = article.querySelectorAll('h2, h3, h4');
        if (headings.length > 0) {
            const tocList = document.createElement('ul');
            tocList.className = 'toc-list';
            
            headings.forEach((heading, index) => {
                const id = 'heading-' + index;
                heading.id = id;
                
                const tocItem = document.createElement('li');
                tocItem.className = 'toc-item toc-' + heading.tagName.toLowerCase();
                
                const tocLink = document.createElement('a');
                tocLink.href = '#' + id;
                tocLink.textContent = heading.textContent;
                tocLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    heading.scrollIntoView({ behavior: 'smooth' });
                });
                
                tocItem.appendChild(tocLink);
                tocList.appendChild(tocItem);
            });
            
            tocContainer.appendChild(tocList);
        } else {
            tocContainer.parentElement.style.display = 'none';
        }
    }
    
    // تقييم المقال
    const ratingButtons = document.querySelectorAll('.rating-btn');
    ratingButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const rating = this.dataset.rating;
            const postId = <?php echo get_the_ID(); ?>;
            
            // التحقق من عدم تقييم المستخدم مسبقاً
            const hasRated = localStorage.getItem('rated_post_' + postId);
            if (hasRated) {
                showToast('لقد قمت بتقييم هذا المقال من قبل', 'warning');
                return;
            }
            
            // تعطيل الأزرار أثناء الإرسال
            ratingButtons.forEach(button => {
                button.disabled = true;
                button.style.opacity = '0.6';
            });
            
            // إرسال التقييم
            const formData = new FormData();
            formData.append('action', 'rate_article');
            formData.append('post_id', postId);
            formData.append('rating', rating);
            formData.append('nonce', window.practicalTheme?.nonce || '<?php echo wp_create_nonce('practical_nonce'); ?>');
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // تحديث العدادات
                    const positiveCount = document.getElementById('positiveCount');
                    const negativeCount = document.getElementById('negativeCount');
                    
                    if (positiveCount) positiveCount.textContent = data.data.positive_count;
                    if (negativeCount) negativeCount.textContent = data.data.negative_count;
                    
                    // حفظ التقييم في التخزين المحلي
                    localStorage.setItem('rated_post_' + postId, rating);
                    
                    showToast(data.data.message || 'شكراً لتقييمك! 🙏', 'success');
                } else {
                    showToast(data.data || 'حدث خطأ أثناء التقييم', 'error');
                    
                    // إعادة تفعيل الأزرار في حالة الخطأ
                    ratingButtons.forEach(button => {
                        button.disabled = false;
                        button.style.opacity = '1';
                    });
                }
            })
            .catch(error => {
                console.error('خطأ في التقييم:', error);
                showToast('حدث خطأ في الاتصال', 'error');
                
                // إعادة تفعيل الأزرار في حالة الخطأ
                ratingButtons.forEach(button => {
                    button.disabled = false;
                    button.style.opacity = '1';
                });
            });
        });
    });
    
    // إدارة المفضلة
    const bookmarkBtn = document.getElementById('bookmarkBtn');
    const postId = <?php echo get_the_ID(); ?>;
    const bookmarks = JSON.parse(localStorage.getItem('bookmarked_posts') || '[]');
    
    // تحديث حالة زر المفضلة
    if (bookmarks.includes(postId)) {
        bookmarkBtn.textContent = '🔖';
        bookmarkBtn.classList.add('bookmarked');
    }
    
    bookmarkBtn.addEventListener('click', function() {
        let bookmarks = JSON.parse(localStorage.getItem('bookmarked_posts') || '[]');
        
        if (bookmarks.includes(postId)) {
            // إزالة من المفضلة
            bookmarks = bookmarks.filter(id => id !== postId);
            this.textContent = '🔖';
            this.classList.remove('bookmarked');
            showToast('تم إزالة المقال من المفضلة', 'success');
        } else {
            // إضافة للمفضلة
            bookmarks.push(postId);
            this.textContent = '🔖';
            this.classList.add('bookmarked');
            showToast('تم إضافة المقال للمفضلة', 'success');
        }
        
        localStorage.setItem('bookmarked_posts', JSON.stringify(bookmarks));
    });
    
    // مشاركة المقال
    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareArticleModal');
    const closeShareModal = document.getElementById('closeShareArticleModal');
    
    if (shareBtn && shareModal) {
        shareBtn.addEventListener('click', function() {
            shareModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
        
        closeShareModal.addEventListener('click', function() {
            shareModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        // إغلاق عند النقر خارج النافذة
        shareModal.addEventListener('click', function(e) {
            if (e.target === shareModal) {
                shareModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    // وظائف المشاركة
    const shareOptions = document.querySelectorAll('#shareArticleModal .share-option');
    shareOptions.forEach(option => {
        option.addEventListener('click', function() {
            const platform = this.dataset.platform;
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('<?php echo addslashes(get_the_title()); ?>');
            const excerpt = encodeURIComponent('<?php echo addslashes(wp_trim_words(get_the_excerpt(), 20, "...")); ?>');
            
            let shareUrl = '';
            
            switch(platform) {
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%0A${excerpt}%0A${url}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${title}&body=${excerpt}%0A%0A${url}`;
                    break;
                case 'copy':
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        showToast('تم نسخ رابط المقال', 'success');
                        shareModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                    return;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
                shareModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    
    // تحسين الصور في المحتوى
    const contentImages = article.querySelectorAll('img');
    contentImages.forEach(img => {
        img.addEventListener('click', function() {
            // إنشاء معرض صور بسيط
            const overlay = document.createElement('div');
            overlay.className = 'image-overlay-viewer';
            overlay.innerHTML = `
                <div class="image-viewer-content">
                    <img src="${this.src}" alt="${this.alt}" class="viewer-image">
                    <button class="close-viewer">&times;</button>
                </div>
            `;
            
            document.body.appendChild(overlay);
            document.body.style.overflow = 'hidden';
            
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay || e.target.classList.contains('close-viewer')) {
                    document.body.removeChild(overlay);
                    document.body.style.overflow = 'auto';
                }
            });
        });
    });
    // الزر العائم في صفحة المقال
    const fabMain = document.getElementById('fabMain');
    
    // الزر العائم الرئيسي
    fabMain.addEventListener('click', function() {
        // إنشاء قائمة سريعة خاصة بصفحة المقال
        const quickMenu = document.createElement('div');
        quickMenu.className = 'quick-menu';
        quickMenu.innerHTML = `
            <div class="quick-menu-items">
                <button class="quick-item" onclick="window.history.back()">
                    ← العودة للخلف
                </button>
                <button class="quick-item" onclick="toggleDarkMode()">
                    🌙 الوضع المظلم
                </button>
                <button class="quick-item" onclick="scrollToTopSingle()">
                    ⬆️ العودة لأعلى
                </button>
                <button class="quick-item" onclick="shareArticle()">
                    📤 مشاركة المقال
                </button>
                <button class="quick-item" onclick="bookmarkArticle()">
                    🔖 إضافة للمفضلة
                </button>
            </div>
        `;
        
        // إضافة القائمة للصفحة
        document.body.appendChild(quickMenu);
        
        // إظهار القائمة
        setTimeout(() => quickMenu.classList.add('show'), 10);
        
        // إخفاء القائمة عند النقر خارجها
        setTimeout(() => {
            document.addEventListener('click', function closeMenu(e) {
                if (!quickMenu.contains(e.target) && e.target !== fabMain) {
                    quickMenu.classList.remove('show');
                    setTimeout(() => {
                        if (quickMenu.parentNode) {
                            document.body.removeChild(quickMenu);
                        }
                    }, 300);
                    document.removeEventListener('click', closeMenu);
                }
            });
        }, 100);
    });
    
    // وظائف مساعدة للقائمة السريعة
    window.toggleDarkMode = function() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark);
        showToast(isDark ? 'تم تفعيل الوضع المظلم' : 'تم إلغاء الوضع المظلم');
    };
    
    window.scrollToTopSingle = function() {
        console.log('تم النقر على العودة لأعلى من القائمة');
        window.scrollTo({ 
            top: 0, 
            behavior: 'smooth' 
        });
    };
    
    window.shareArticle = function() {
        const title = document.querySelector('.article-title').textContent;
        const url = window.location.href;
        
        if (navigator.share) {
            navigator.share({
                title: title,
                text: 'مقال مفيد من موقع الحلول العملية',
                url: url
            });
        } else {
            // فتح نافذة المشاركة
            const shareModal = document.getElementById('shareArticleModal');
            if (shareModal) {
                shareModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }
    };
    
    window.bookmarkArticle = function() {
        const postId = <?php echo get_the_ID(); ?>;
        let bookmarks = JSON.parse(localStorage.getItem('bookmarked_posts') || '[]');
        
        if (bookmarks.includes(postId)) {
            bookmarks = bookmarks.filter(id => id !== postId);
            showToast('تم إزالة المقال من المفضلة');
        } else {
            bookmarks.push(postId);
            showToast('تم إضافة المقال للمفضلة');
        }
        
        localStorage.setItem('bookmarked_posts', JSON.stringify(bookmarks));
        
        // تحديث زر المفضلة في الصفحة
        const bookmarkBtn = document.getElementById('bookmarkBtn');
        if (bookmarkBtn) {
            bookmarkBtn.classList.toggle('bookmarked');
        }
    };
    
    // استرجاع الوضع المظلم المحفوظ
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
    
    // زر العودة لأعلى في صفحة المقال
    const scrollToTopSingle = document.getElementById('scrollToTopSingle');
    
    function toggleScrollButtonSingle() {
        if (window.pageYOffset > 400) {
            scrollToTopSingle.style.display = 'block';
        } else {
            scrollToTopSingle.style.display = 'none';
        }
    }
    
    window.addEventListener('scroll', toggleScrollButtonSingle);
    
    scrollToTopSingle.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
});

// وظيفة إظهار الرسائل التوضيحية
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    const container = document.getElementById('toastContainer') || document.body;
    container.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => container.removeChild(toast), 300);
    }, 3000);
}
</script>

<style>
/* تنسيقات صفحة المقال الواحد */
.single-post-container {
    max-width: 100%;
    margin: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* التأكد من عدم وجود فراغات جانبية */
.article-content {
    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 0;
    flex: 1;
}

.article-header-content,
.article-body,
.article-rating,
.article-tags,
.related-articles,
.comments-section {
    max-width: 100%;
    margin: 0 auto;
    padding-left: 20px;
    padding-right: 20px;
}

/* للكمبيوتر - عرض أفضل للقراءة */
@media (min-width: 768px) {
    .article-header-content,
    .article-body,
    .article-rating,
    .article-tags {
        max-width: 800px;
        padding-left: 40px;
        padding-right: 40px;
    }
    
    .related-articles,
    .comments-section {
        max-width: 900px;
        padding-left: 30px;
        padding-right: 30px;
    }
}

@media (min-width: 1024px) {
    .article-header-content,
    .article-body,
    .article-rating,
    .article-tags {
        max-width: 900px;
        padding-left: 50px;
        padding-right: 50px;
    }
    
    .related-articles,
    .comments-section {
        max-width: 1000px;
        padding-left: 40px;
        padding-right: 40px;
    }
}

/* إزالة الفراغ الأبيض في الأسفل */
.app-footer {
    margin-top: auto;
    width: 100%;
}

/* منع أي فراغات إضافية */
.single-post-container::after,
.article-content::after {
    display: none !important;
}

html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden;
}

/* إزالة أي margins أو paddings غير مرغوب فيها */
.single-post-container > *:last-child {
    margin-bottom: 0 !important;
}

.article-header {
    position: sticky;
    top: 0;
    background: white;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.header-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
}

.back-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: var(--light-color);
    color: var(--dark-color);
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.back-button:hover {
    background: var(--primary-color);
    color: white;
}

.header-actions {
    display: flex;
    gap: 10px;
}

.bookmark-btn, .share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: var(--light-color);
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.bookmark-btn:hover, .share-btn:hover {
    background: var(--primary-color);
    color: white;
}

.bookmark-btn.bookmarked {
    background: var(--secondary-color);
    color: white;
}

.reading-progress-bar {
    height: 4px;
    background: var(--light-color);
    position: relative;
}

.reading-progress {
    height: 100%;
    background: var(--primary-color);
    width: 0%;
    transition: width 0.2s ease;
}

.article-featured-image {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.featured-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 30px 20px 20px;
}

.article-meta-overlay {
    display: flex;
    justify-content: space-between;
    align-items: end;
}

.article-category {
    background: var(--primary-color);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.article-stats {
    display: flex;
    gap: 15px;
    font-size: 12px;
}

.article-header-content {
    padding: 30px 20px 20px;
}

.article-title {
    font-size: 28px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 20px;
    color: var(--dark-color);
}

.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.author-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.author-avatar {
    border-radius: 50%;
}

.author-details {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 600;
    font-size: 14px;
    color: var(--dark-color);
}

.publish-date {
    font-size: 12px;
    color: #7f8c8d;
}

.difficulty-indicator {
    display: flex;
    align-items: center;
    gap: 5px;
    background: var(--light-color);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.article-body {
    padding: 0 20px;
    line-height: 1.8;
    font-size: 16px;
}

.table-of-contents {
    background: var(--light-color);
    padding: 20px;
    border-radius: var(--border-radius);
    margin-bottom: 30px;
}

.table-of-contents h3 {
    margin-bottom: 15px;
    color: var(--dark-color);
}

.toc-list {
    list-style: none;
    padding: 0;
}

.toc-item {
    margin-bottom: 8px;
}

.toc-item a {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.toc-item a:hover {
    color: var(--dark-color);
}

.toc-h3 {
    margin-right: 20px;
}

.toc-h4 {
    margin-right: 40px;
}

.materials-section, .tips-section, .warnings-section {
    background: var(--light-color);
    padding: 20px;
    border-radius: var(--border-radius);
    margin: 30px 0;
}

.materials-section h3, .tips-section h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.warnings-section {
    background: #fff5f5;
    border-right: 4px solid var(--danger-color);
}

.warnings-section h3 {
    color: var(--danger-color);
    margin-bottom: 15px;
}

.materials-list {
    display: grid;
    gap: 10px;
}

.material-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.material-icon {
    color: var(--success-color);
    font-weight: bold;
}

.article-rating {
    background: var(--light-color);
    padding: 20px;
    border-radius: var(--border-radius);
    text-align: center;
    margin: 30px 20px;
}

.rating-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 15px;
}

.rating-btn {
    padding: 12px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.rating-btn.positive {
    background: var(--success-color);
    color: white;
}

.rating-btn.negative {
    background: var(--danger-color);
    color: white;
}

.rating-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--card-shadow);
}

.article-tags {
    padding: 20px;
    margin: 20px 0;
}

.article-tags h4 {
    margin-bottom: 15px;
    color: var(--dark-color);
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-item {
    background: var(--primary-color);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 12px;
    transition: all 0.3s ease;
}

.tag-item:hover {
    background: var(--dark-color);
    transform: translateY(-2px);
}

.related-articles {
    padding: 30px 20px;
    background: var(--light-color);
    margin-top: 30px;
}

.related-articles h3 {
    text-align: center;
    margin-bottom: 20px;
    color: var(--dark-color);
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.related-card {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
}

.related-card a {
    text-decoration: none;
    color: inherit;
    display: block;
}

.related-image {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.related-content {
    padding: 15px;
}

.related-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    line-height: 1.4;
}

.related-excerpt {
    font-size: 12px;
    color: #7f8c8d;
    margin-bottom: 10px;
    line-height: 1.4;
}

.related-meta {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #95a5a6;
}

.comments-section {
    padding: 30px 20px;
    background: white;
}

.comments-section h3 {
    margin-bottom: 20px;
    color: var(--dark-color);
}

/* نافذة مشاركة المقال */
.share-article-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: var(--border-radius);
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    z-index: 2000;
    max-width: 400px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
}

.article-share-preview {
    display: flex;
    gap: 15px;
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.share-preview-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

.share-preview-content h4 {
    font-size: 16px;
    margin-bottom: 8px;
    color: var(--dark-color);
}

.share-preview-content p {
    font-size: 12px;
    color: #7f8c8d;
    line-height: 1.4;
}

/* معرض الصور */
.image-overlay-viewer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 3000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-viewer-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.viewer-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.close-viewer {
    position: absolute;
    top: -40px;
    right: 0;
    background: none;
    border: none;
    color: white;
    font-size: 30px;
    cursor: pointer;
}

/* أزرار الإجراءات العائمة في صفحة المقال */
.floating-actions {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1000;
}

.fab-main {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.8);
    animation: fadeInScale 0.5s ease forwards;
    position: relative;
    z-index: 1001;
    pointer-events: auto;
    background: var(--primary-color);
    animation-delay: 0.2s;
}

.fab-main:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    background: #357abd;
}

.fab-main:active {
    transform: scale(0.95);
}

@keyframes fadeInScale {
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* القائمة السريعة في صفحة المقال */
.quick-menu {
    position: fixed;
    bottom: 100px;
    left: 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    z-index: 999;
    opacity: 0;
    transform: translateY(20px) scale(0.8);
    transition: all 0.3s ease;
    min-width: 220px;
}

.quick-menu.show {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.quick-menu-items {
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.quick-item {
    background: none;
    border: none;
    padding: 12px 15px;
    text-align: right;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    color: var(--dark-color);
    white-space: nowrap;
}

.quick-item:hover {
    background: var(--light-color);
    transform: translateX(-5px);
}

/* الوضع المظلم للقائمة */
.dark-mode .quick-menu {
    background: #3a3a3a;
    color: #e1e1e1;
}

.dark-mode .quick-item {
    color: #e1e1e1;
}

.dark-mode .quick-item:hover {
    background: #4a4a4a;
}

/* زر العودة لأعلى في صفحة المقال */
.scroll-to-top-single {
    position: fixed;
    bottom: 30px;
    left: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    border: none;
    font-size: 18px;
    cursor: pointer;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    z-index: 1000;
}

.scroll-to-top-single:hover {
    background: #357abd;
    transform: scale(1.1);
}

.scroll-to-top-single:active {
    transform: scale(0.95);
}

/* تحسينات للأجهزة المحمولة */
@media (max-width: 768px) {
    .floating-actions {
        bottom: 15px;
        left: 15px;
    }
    
    .fab-main, .fab-scroll-top {
        width: 50px;
        height: 50px;
        font-size: 16px;
    }
    
    .quick-menu {
        bottom: 85px;
        left: 15px;
        min-width: 200px;
    }
    
    .quick-item {
        padding: 10px 12px;
        font-size: 13px;
    }
}

.dark-mode .article-title {
    color: #e1e1e1;
}

.dark-mode .materials-section,
.dark-mode .tips-section,
.dark-mode .article-rating,
.dark-mode .related-articles {
    background: #4a4a4a;
    color: #e1e1e1;
}

.dark-mode .related-card {
    background: #5a5a5a;
    color: #e1e1e1;
}

.dark-mode .share-article-modal {
    background: #3a3a3a;
    color: #e1e1e1;
}

/* الاستجابة للشاشات الصغيرة */
@media (max-width: 768px) {
    .article-title {
        font-size: 24px;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: start;
        gap: 15px;
    }
    
    .rating-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
    
    .article-share-preview {
        flex-direction: column;
    }
    
    .share-preview-image {
        width: 100%;
        height: 150px;
    }
}
</style>

<?php 
get_footer();

// لا نحتاج لإعادة تعريف الدالة لأنها موجودة في functions.php
?><?php
/**
 * صفحة المقال الواحد - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<div class="app-container" id="appContainer">
    
    <!-- شريط التنقل العلوي -->