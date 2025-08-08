<?php
/**
 * صفحة خطأ 404 - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<div class="app-container error-404-container" id="appContainer">
    
    <!-- رأس صفحة الخطأ -->
    <header class="error-header">
        <div class="error-header-content">
            <button class="back-button" onclick="window.location.href='<?php echo home_url(); ?>'" aria-label="العودة للرئيسية">
                ←
            </button>
            <div class="error-info">
                <h1 class="error-title">صفحة غير موجودة</h1>
                <p class="error-subtitle">404 - Page Not Found</p>
            </div>
        </div>
    </header>

    <!-- محتوى صفحة الخطأ -->
    <main class="error-content" id="main">
        
        <div class="error-message">
            <div class="error-icon">🔍</div>
            <h2>عذراً، لم نجد هذه الصفحة!</h2>
            <p>الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر.</p>
        </div>

        <!-- شريط البحث -->
        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" 
                       class="search-input" 
                       id="searchInput"
                       placeholder="ابحث عن الحلول العملية..."
                       autocomplete="off">
                <button class="voice-search-btn" id="voiceSearchBtn" aria-label="البحث الصوتي">
                    🎤
                </button>
                <button class="search-submit-btn" id="searchSubmitBtn" aria-label="بحث">
                    🔍
                </button>
            </div>
        </div>

        <!-- اقتراحات للمساعدة -->
        <div class="helpful-suggestions">
            <h3>يمكنك تجربة:</h3>
            <ul class="suggestions-list">
                <li>🏠 <a href="<?php echo home_url(); ?>">العودة إلى الصفحة الرئيسية</a></li>
                <li>🔍 البحث عن الحل الذي تحتاجه</li>
                <li>📋 تصفح الفئات المختلفة أدناه</li>
                <li>📞 <a href="<?php echo home_url('/contact'); ?>">التواصل معنا</a> للمساعدة</li>
            </ul>
        </div>

        <!-- فئات شائعة -->
        <div class="popular-categories">
            <h3>الفئات الشائعة</h3>
            <div class="categories-grid">
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'category',
                    'hide_empty' => true,
                    'number' => 6,
                    'orderby' => 'count',
                    'order' => 'DESC'
                ));
                
                $icons = array('🏠', '👨‍🍳', '🧹', '🔧', '💡', '🌱');
                $icon_index = 0;
                
                foreach($categories as $category): ?>
                <a href="<?php echo get_category_link($category->term_id); ?>" class="category-card">
                    <div class="category-icon">
                        <?php echo $icons[$icon_index % count($icons)]; ?>
                    </div>
                    <div class="category-info">
                        <h4><?php echo $category->name; ?></h4>
                        <span class="category-count"><?php echo $category->count; ?> حل</span>
                    </div>
                </a>
                <?php $icon_index++; endforeach; ?>
            </div>
        </div>

        <!-- أحدث الحلول -->
        <div class="recent-solutions">
            <h3>أحدث الحلول العملية</h3>
            <div class="solutions-list">
                <?php
                $recent_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($recent_posts->have_posts()):
                    while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                    <article class="solution-item">
                        <a href="<?php the_permalink(); ?>" class="solution-link">
                            <?php if (has_post_thumbnail()): ?>
                            <div class="solution-thumbnail">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" 
                                     alt="<?php the_title(); ?>" loading="lazy">
                            </div>
                            <?php endif; ?>
                            <div class="solution-content">
                                <h4 class="solution-title"><?php the_title(); ?></h4>
                                <p class="solution-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
                                <div class="solution-meta">
                                    <span class="solution-date"><?php echo get_the_date('j M'); ?></span>
                                    <span class="solution-views">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php endwhile; wp_reset_postdata();
                endif; ?>
            </div>
        </div>

    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // البحث
    const searchInput = document.getElementById('searchInput');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    const voiceSearchBtn = document.getElementById('voiceSearchBtn');
    
    // إرسال البحث
    function performSearch() {
        const query = searchInput.value.trim();
        if (query.length > 0) {
            window.location.href = `/?s=${encodeURIComponent(query)}`;
        }
    }
    
    searchSubmitBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // البحث الصوتي
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        recognition.lang = 'ar-SA';
        recognition.continuous = false;
        recognition.interimResults = false;

        voiceSearchBtn.addEventListener('click', function() {
            if (this.classList.contains('recording')) {
                recognition.stop();
                this.classList.remove('recording');
                this.textContent = '🎤';
            } else {
                recognition.start();
                this.classList.add('recording');
                this.textContent = '🔴';
            }
        });

        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            searchInput.value = transcript;
            performSearch();
        };

        recognition.onerror = function() {
            voiceSearchBtn.classList.remove('recording');
            voiceSearchBtn.textContent = '🎤';
        };

        recognition.onend = function() {
            voiceSearchBtn.classList.remove('recording');
            voiceSearchBtn.textContent = '🎤';
        };
    } else {
        voiceSearchBtn.style.display = 'none';
    }
    
    // تأثيرات الحركة
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    });

    document.querySelectorAll('.category-card, .solution-item').forEach(item => {
        observer.observe(item);
    });
    
    // تتبع 404
    if (typeof gtag !== 'undefined') {
        gtag('event', '404_error', {
            'page_title': document.title,
            'page_location': window.location.href
        });
    }
    
});
</script>

<style>
/* تنسيقات صفحة خطأ 404 */
.error-404-container {
    max-width: 100%;
}

.error-header {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    padding: 20px;
}

.error-header-content {
    display: flex;
    align-items: center;
    gap: 15px;
    max-width: 800px;
    margin: 0 auto;
}

.error-info h1 {
    font-size: 24px;
    margin-bottom: 5px;
}

.error-subtitle {
    font-size: 14px;
    opacity: 0.9;
}

.error-content {
    padding: 0;
    max-width: 800px;
    margin: 0 auto;
}

.error-message {
    text-align: center;
    padding: 40px 20px;
    background: white;
    margin: 20px;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.error-icon {
    font-size: 80px;
    margin-bottom: 20px;
    opacity: 0.6;
}

.error-message h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: var(--dark-color);
}

.error-message p {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
}

.search-container {
    margin: 20px;
    padding: 20px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.search-wrapper {
    display: flex;
    gap: 10px;
}

.search-input {
    flex: 1;
    padding: 15px 20px;
    border: 2px solid #e1e8ed;
    border-radius: 25px;
    font-size: 16px;
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(74,144,226,0.1);
}

.voice-search-btn, .search-submit-btn {
    width: 50px;
    height: 50px;
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
}

.voice-search-btn {
    background: var(--primary-color);
}

.search-submit-btn {
    background: var(--success-color);
}

.voice-search-btn:hover, .search-submit-btn:hover {
    transform: scale(1.05);
}

.helpful-suggestions {
    margin: 20px;
    padding: 25px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.helpful-suggestions h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: var(--dark-color);
}

.suggestions-list {
    list-style: none;
    padding: 0;
}

.suggestions-list li {
    padding: 10px 0;
    font-size: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.suggestions-list li:last-child {
    border-bottom: none;
}

.suggestions-list a {
    color: var(--primary-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.suggestions-list a:hover {
    color: var(--dark-color);
}

.popular-categories {
    margin: 20px;
    padding: 25px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.popular-categories h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: var(--dark-color);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.category-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: var(--light-color);
    border-radius: var(--border-radius);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
}

.category-card.fade-in {
    opacity: 1;
    transform: translateY(0);
}

.category-card:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
}

.category-icon {
    font-size: 32px;
    width: 50px;
    text-align: center;
}

.category-info h4 {
    font-size: 16px;
    margin-bottom: 5px;
}

.category-count {
    font-size: 12px;
    opacity: 0.8;
}

.recent-solutions {
    margin: 20px;
    padding: 25px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.recent-solutions h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: var(--dark-color);
}

.solutions-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.solution-item {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.solution-item.fade-in {
    opacity: 1;
    transform: translateY(0);
}

.solution-link {
    display: flex;
    gap: 15px;
    padding: 15px;
    background: var(--light-color);
    border-radius: var(--border-radius);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.solution-link:hover {
    background: #e8f4fd;
    transform: translateX(-5px);
}

.solution-thumbnail {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.solution-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.solution-content {
    flex: 1;
}

.solution-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    color: var(--dark-color);
}

.solution-excerpt {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.4;
}

.solution-meta {
    display: flex;
    gap: 15px;
    font-size: 12px;
    color: #7f8c8d;
}

/* الاستجابة للشاشات الصغيرة */
@media (max-width: 768px) {
    .categories-grid {
        grid-template-columns: 1fr;
    }
    
    .solution-link {
        flex-direction: column;
        text-align: center;
    }
    
    .solution-thumbnail {
        width: 100%;
        height: 120px;
        margin: 0 auto;
    }
    
    .error-message {
        margin: 15px;
        padding: 30px 20px;
    }
    
    .error-icon {
        font-size: 60px;
    }
    
    .error-message h2 {
        font-size: 24px;
    }
    
    .search-container,
    .helpful-suggestions,
    .popular-categories,
    .recent-solutions {
        margin: 15px;
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .search-wrapper {
        flex-direction: column;
        gap: 15px;
    }
    
    .voice-search-btn, .search-submit-btn {
        width: 100%;
        border-radius: 25px;
    }
    
    .category-card {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
}

/* تأثيرات الحركة */
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

.fade-in {
    animation: fadeInUp 0.5s ease-out forwards;
}
</style>

<?php get_footer(); ?>