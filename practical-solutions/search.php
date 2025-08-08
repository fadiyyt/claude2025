<?php
/**
 * صفحة نتائج البحث - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<div class="app-container search-results-container" id="appContainer">
    
    <!-- رأس صفحة البحث -->
    <header class="search-header">
        <div class="search-header-content">
            <button class="back-button" onclick="history.back()" aria-label="العودة">
                ←
            </button>
            <div class="search-info">
                <h1 class="search-title">نتائج البحث</h1>
                <p class="search-query">البحث عن: "<span id="searchQuery"><?php echo get_search_query(); ?></span>"</p>
            </div>
        </div>
    </header>

    <!-- شريط البحث المحسن -->
    <div class="search-container enhanced">
        <div class="search-wrapper">
            <input type="text" 
                   class="search-input" 
                   id="searchInput"
                   value="<?php echo get_search_query(); ?>"
                   placeholder="ابحث عن الحلول العملية..."
                   autocomplete="off">
            <button class="voice-search-btn" id="voiceSearchBtn" aria-label="البحث الصوتي">
                🎤
            </button>
            <button class="search-submit-btn" id="searchSubmitBtn" aria-label="بحث">
                🔍
            </button>
        </div>
        
        <!-- فلاتر البحث -->
        <div class="search-filters">
            <button class="filter-btn active" data-filter="all">الكل</button>
            <button class="filter-btn" data-filter="recent">الأحدث</button>
            <button class="filter-btn" data-filter="popular">الأكثر مشاهدة</button>
            <button class="filter-btn" data-filter="featured">مميز</button>
        </div>
    </div>

    <!-- نتائج البحث -->
    <main class="search-results-main" id="main">
        
        <?php if (have_posts()): ?>
        
        <!-- إحصائيات البحث -->
        <div class="search-stats">
            <p class="results-count">
                تم العثور على <strong><?php echo $wp_query->found_posts; ?></strong> نتيجة
                <?php if (get_search_query()): ?>
                للبحث عن "<strong><?php echo get_search_query(); ?></strong>"
                <?php endif; ?>
            </p>
            <div class="search-time">
                <span class="search-duration" id="searchDuration">⏱️ 0.02 ثانية</span>
            </div>
        </div>

        <!-- الاقتراحات الذكية -->
        <?php if (strlen(get_search_query()) > 0): ?>
        <div class="search-suggestions">
            <h3>هل تقصد:</h3>
            <div class="suggestions-list" id="suggestionsList">
                <!-- سيتم ملؤها بواسطة JavaScript -->
            </div>
        </div>
        <?php endif; ?>

        <!-- قائمة النتائج -->
        <div class="search-results-list" id="searchResultsList">
            <?php while (have_posts()): the_post(); ?>
            <article class="search-result-item fade-in" data-post-id="<?php echo get_the_ID(); ?>">
                <div class="result-content">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="result-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'card-thumb'); ?>" 
                             alt="<?php the_title(); ?>" 
                             loading="lazy">
                    </div>
                    <?php endif; ?>
                    
                    <div class="result-details">
                        <div class="result-header">
                            <h2 class="result-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="result-meta">
                                <?php 
                                $categories = get_the_category();
                                if (!empty($categories)): ?>
                                <span class="result-category"><?php echo $categories[0]->name; ?></span>
                                <?php endif; ?>
                                <span class="result-date"><?php echo get_the_date('j M Y'); ?></span>
                                <span class="result-views">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                            </div>
                        </div>
                        
                        <div class="result-excerpt">
                            <?php 
                            $excerpt = get_the_excerpt();
                            $highlighted_excerpt = practical_highlight_search_terms($excerpt, get_search_query());
                            echo $highlighted_excerpt;
                            ?>
                        </div>
                        
                        <div class="result-actions">
                            <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                اقرأ المزيد ←
                            </a>
                            <div class="result-features">
                                <?php 
                                $difficulty = get_post_meta(get_the_ID(), 'difficulty_level', true);
                                if ($difficulty): ?>
                                <span class="difficulty-badge difficulty-<?php echo strtolower($difficulty); ?>">
                                    <?php echo $difficulty; ?>
                                </span>
                                <?php endif; ?>
                                
                                <?php if (get_post_meta(get_the_ID(), 'featured_post', true) == '1'): ?>
                                <span class="featured-badge">مميز ⭐</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <!-- تحميل المزيد -->
        <?php if ($wp_query->max_num_pages > 1): ?>
        <div class="load-more-container">
            <button class="load-more-btn" id="loadMoreBtn" data-page="1" data-max-pages="<?php echo $wp_query->max_num_pages; ?>">
                تحميل المزيد من النتائج
            </button>
            <div class="loading-spinner" id="loadingSpinner" style="display: none;">
                جارٍ التحميل...
            </div>
        </div>
        <?php endif; ?>

        <?php else: ?>
        
        <!-- عدم وجود نتائج -->
        <div class="no-results">
            <div class="no-results-icon">🔍</div>
            <h2>لم نجد أي نتائج</h2>
            <p>عذراً، لم نتمكن من العثور على نتائج للبحث عن "<strong><?php echo get_search_query(); ?></strong>"</p>
            
            <div class="search-suggestions-empty">
                <h3>جرب هذه الاقتراحات:</h3>
                <ul>
                    <li>تأكد من صحة الكتابة</li>
                    <li>استخدم كلمات أكثر عمومية</li>
                    <li>جرب مرادفات مختلفة</li>
                    <li>قلل من عدد الكلمات</li>
                </ul>
            </div>
            
            <!-- الحلول الشائعة كبديل -->
            <div class="popular-alternatives">
                <h3>الحلول الأكثر شعبية:</h3>
                <div class="alternatives-grid">
                    <?php
                    $popular_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'meta_key' => 'post_views',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                    ));
                    
                    if ($popular_posts->have_posts()):
                        while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="alternative-item">
                            <h4><?php the_title(); ?></h4>
                            <span class="views">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                        </a>
                        <?php endwhile; wp_reset_postdata();
                    endif; ?>
                </div>
            </div>
        </div>
        
        <?php endif; ?>
        
    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // متغيرات البحث
    const searchInput = document.getElementById('searchInput');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    const voiceSearchBtn = document.getElementById('voiceSearchBtn');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const searchResultsList = document.getElementById('searchResultsList');
    
    // تسجيل وقت بداية البحث
    const searchStartTime = performance.now();
    
    // حساب وقت البحث
    window.addEventListener('load', function() {
        const searchEndTime = performance.now();
        const searchDuration = ((searchEndTime - searchStartTime) / 1000).toFixed(2);
        const durationElement = document.getElementById('searchDuration');
        if (durationElement) {
            durationElement.textContent = `⏱️ ${searchDuration} ثانية`;
        }
    });
    
    // البحث المباشر
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                generateSuggestions(query);
            }, 300);
        }
    });
    
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
    
    // فلاتر البحث
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // إزالة الفئة النشطة من جميع الأزرار
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            applyFilter(filter);
        });
    });
    
    function applyFilter(filter) {
        const query = searchInput.value.trim();
        let url = `/?s=${encodeURIComponent(query)}`;
        
        switch(filter) {
            case 'recent':
                url += '&orderby=date&order=desc';
                break;
            case 'popular':
                url += '&orderby=meta_value_num&meta_key=post_views&order=desc';
                break;
            case 'featured':
                url += '&meta_key=featured_post&meta_value=1';
                break;
        }
        
        window.location.href = url;
    }
    
    // تحميل المزيد من النتائج
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const currentPage = parseInt(this.dataset.page);
            const maxPages = parseInt(this.dataset.maxPages);
            const nextPage = currentPage + 1;
            
            if (nextPage <= maxPages) {
                loadMoreResults(nextPage);
            }
        });
    }
    
    function loadMoreResults(page) {
        const loadingSpinner = document.getElementById('loadingSpinner');
        loadMoreBtn.style.display = 'none';
        loadingSpinner.style.display = 'block';
        
        const query = searchInput.value.trim();
        const url = `/?s=${encodeURIComponent(query)}&paged=${page}`;
        
        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newResults = doc.querySelectorAll('.search-result-item');
                
                newResults.forEach(result => {
                    searchResultsList.appendChild(result);
                });
                
                loadMoreBtn.dataset.page = page;
                
                if (page < parseInt(loadMoreBtn.dataset.maxPages)) {
                    loadMoreBtn.style.display = 'block';
                } else {
                    loadMoreBtn.style.display = 'none';
                }
                
                loadingSpinner.style.display = 'none';
                
                // تحديث الرابط في التاريخ
                history.pushState(null, '', url);
            })
            .catch(error => {
                console.error('خطأ في تحميل المزيد:', error);
                loadMoreBtn.style.display = 'block';
                loadingSpinner.style.display = 'none';
            });
    }
    
    // إنشاء الاقتراحات الذكية
    function generateSuggestions(query) {
        const suggestionsList = document.getElementById('suggestionsList');
        if (!suggestionsList) return;
        
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=get_search_suggestions&query=${encodeURIComponent(query)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                suggestionsList.innerHTML = '';
                data.data.forEach(suggestion => {
                    const suggestionBtn = document.createElement('button');
                    suggestionBtn.className = 'suggestion-btn';
                    suggestionBtn.textContent = suggestion;
                    suggestionBtn.addEventListener('click', () => {
                        searchInput.value = suggestion;
                        performSearch();
                    });
                    suggestionsList.appendChild(suggestionBtn);
                });
                suggestionsList.parentElement.style.display = 'block';
            } else {
                suggestionsList.parentElement.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('خطأ في الحصول على الاقتراحات:', error);
        });
    }
    
    // تتبع تفاعل المستخدم
    document.querySelectorAll('.search-result-item').forEach(item => {
        item.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const position = Array.from(this.parentNode.children).indexOf(this) + 1;
            
            // إرسال إحصائيات النقر
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=track_search_click&post_id=${postId}&query=${encodeURIComponent(searchInput.value)}&position=${position}`
            });
        });
    });
    
});
</script>

<style>
/* تنسيقات صفحة البحث */
.search-results-container {
    max-width: 800px;
}

.search-header {
    background: var(--gradient-bg);
    color: white;
    padding: 20px;
}

.search-header-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.back-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.2);
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.back-button:hover {
    background: rgba(255,255,255,0.3);
}

.search-info h1 {
    font-size: 20px;
    margin-bottom: 5px;
}

.search-query {
    font-size: 14px;
    opacity: 0.9;
}

.search-container.enhanced {
    padding: 20px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-wrapper {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.search-submit-btn {
    width: 50px;
    height: 50px;
    border: none;
    border-radius: 50%;
    background: var(--success-color);
    color: white;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
}

.search-submit-btn:hover {
    background: #229954;
    transform: scale(1.05);
}

.search-filters {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 5px;
}

.filter-btn {
    padding: 8px 16px;
    border: 2px solid var(--light-color);
    border-radius: 20px;
    background: white;
    color: var(--dark-color);
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.3s ease;
    font-size: 14px;
}

.filter-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.filter-btn:hover {
    border-color: var(--primary-color);
}

.search-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: var(--light-color);
    margin-bottom: 20px;
    border-radius: var(--border-radius);
}

.results-count {
    font-size: 16px;
    color: var(--dark-color);
}

.search-duration {
    font-size: 12px;
    color: #7f8c8d;
}

.search-suggestions {
    padding: 20px;
    background: white;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
    box-shadow: var(--card-shadow);
}

.search-suggestions h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: var(--dark-color);
}

.suggestions-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.suggestion-btn {
    padding: 6px 12px;
    border: 1px solid var(--primary-color);
    border-radius: 15px;
    background: white;
    color: var(--primary-color);
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s ease;
}

.suggestion-btn:hover {
    background: var(--primary-color);
    color: white;
}

.search-results-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 0 20px;
}

.search-result-item {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
    transition: all 0.3s ease;
}

.search-result-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.result-content {
    display: flex;
    gap: 15px;
    padding: 20px;
}

.result-thumbnail {
    flex-shrink: 0;
    width: 120px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
}

.result-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.result-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.result-header {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.result-title {
    font-size: 18px;
    font-weight: 600;
    line-height: 1.3;
}

.result-title a {
    color: var(--dark-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.result-title a:hover {
    color: var(--primary-color);
}

.result-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-size: 12px;
}

.result-category {
    background: var(--primary-color);
    color: white;
    padding: 3px 8px;
    border-radius: 10px;
}

.result-date, .result-views {
    color: #7f8c8d;
}

.result-excerpt {
    font-size: 14px;
    line-height: 1.5;
    color: #555;
}

.result-excerpt mark {
    background: #fff3cd;
    padding: 1px 3px;
    border-radius: 3px;
}

.result-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.read-more-btn {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.3s ease;
}

.read-more-btn:hover {
    color: var(--dark-color);
}

.result-features {
    display: flex;
    gap: 5px;
    align-items: center;
}

.difficulty-badge {
    padding: 2px 6px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 500;
}

.difficulty-سهل { background: #d4edda; color: #155724; }
.difficulty-متوسط { background: #fff3cd; color: #856404; }
.difficulty-صعب { background: #f8d7da; color: #721c24; }

.featured-badge {
    background: var(--secondary-color);
    color: white;
    padding: 2px 6px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 500;
}

.load-more-container {
    text-align: center;
    padding: 30px 20px;
}

.load-more-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.load-more-btn:hover {
    background: #357abd;
    transform: translateY(-2px);
}

.no-results {
    text-align: center;
    padding: 40px 20px;
    background: white;
    border-radius: var(--border-radius);
    margin: 20px;
}

.no-results-icon {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.no-results h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: var(--dark-color);
}

.search-suggestions-empty {
    margin: 30px 0;
    text-align: right;
}

.search-suggestions-empty ul {
    list-style: none;
    padding: 0;
}

.search-suggestions-empty li {
    padding: 5px 0;
    color: #666;
}

.search-suggestions-empty li:before {
    content: '💡 ';
    margin-left: 8px;
}

.popular-alternatives {
    margin-top: 30px;
}

.alternatives-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.alternative-item {
    background: var(--light-color);
    padding: 15px;
    border-radius: var(--border-radius);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.alternative-item:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.alternative-item h4 {
    font-size: 14px;
    margin: 0;
}

.alternative-item .views {
    font-size: 12px;
    opacity: 0.8;
}

/* الاستجابة للشاشات الصغيرة */
@media (max-width: 768px) {
    .result-content {
        flex-direction: column;
        gap: 10px;
    }
    
    .result-thumbnail {
        width: 100%;
        height: 150px;
    }
    
    .search-stats {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .result-actions {
        flex-direction: column;
        gap: 10px;
        align-items: start;
    }
    
    .alternatives-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php 
get_footer();

// جميع الوظائف المطلوبة موجودة في functions.php
?>