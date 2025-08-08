<?php
/**
 * صفحة الأرشيف - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<div class="app-container archive-container" id="appContainer">
    
    <!-- رأس الأرشيف -->
    <header class="archive-header">
        <div class="archive-header-content">
            <button class="back-button" onclick="window.location.href='<?php echo home_url(); ?>'" aria-label="العودة للرئيسية">
                ←
            </button>
            <div class="archive-info">
                <h1 class="archive-title">
                    <?php
                    if (is_category()) {
                        echo 'فئة: ' . single_cat_title('', false);
                    } elseif (is_tag()) {
                        echo 'وسم: ' . single_tag_title('', false);
                    } elseif (is_author()) {
                        echo 'مؤلف: ' . get_the_author();
                    } elseif (is_date()) {
                        echo 'أرشيف: ' . get_the_date('F Y');
                    } else {
                        echo 'الأرشيف';
                    }
                    ?>
                </h1>
                <?php if (is_category() && category_description()): ?>
                <p class="archive-description"><?php echo category_description(); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- شريط البحث -->
    <div class="search-container">
        <div class="search-wrapper">
            <input type="text" 
                   class="search-input" 
                   id="searchInput"
                   placeholder="ابحث في هذه الفئة..."
                   autocomplete="off">
            <button class="voice-search-btn" id="voiceSearchBtn" aria-label="البحث الصوتي">
                🎤
            </button>
        </div>
    </div>

    <!-- المحتوى الرئيسي -->
    <main class="archive-content" id="main">
        
        <?php if (have_posts()): ?>
        
        <!-- إحصائيات -->
        <div class="archive-stats">
            <p class="posts-count">
                تم العثور على <strong><?php echo $wp_query->found_posts; ?></strong> حل عملي
            </p>
        </div>

        <!-- قائمة المقالات -->
        <div class="posts-grid">
            <?php while (have_posts()): the_post(); ?>
            <article class="post-card fade-in">
                <a href="<?php the_permalink(); ?>" class="post-link">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'card-thumb'); ?>" 
                             alt="<?php the_title(); ?>" 
                             loading="lazy">
                    </div>
                    <?php else: ?>
                    <div class="post-thumbnail placeholder">
                        <div class="placeholder-icon">💡</div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                        <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                        
                        <div class="post-meta">
                            <span class="post-date">📅 <?php echo get_the_date('j M Y'); ?></span>
                            <span class="post-views">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?></span>
                            
                            <?php 
                            $difficulty = get_post_meta(get_the_ID(), 'difficulty_level', true);
                            if ($difficulty): ?>
                            <span class="difficulty-badge difficulty-<?php echo strtolower($difficulty); ?>">
                                <?php echo $difficulty; ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </article>
            <?php endwhile; ?>
        </div>

        <!-- التنقل بين الصفحات -->
        <?php if ($wp_query->max_num_pages > 1): ?>
        <div class="pagination-container">
            <?php
            echo paginate_links(array(
                'total' => $wp_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'format' => '?paged=%#%',
                'show_all' => false,
                'end_size' => 1,
                'mid_size' => 2,
                'prev_next' => true,
                'prev_text' => '← السابق',
                'next_text' => 'التالي →',
                'type' => 'list',
                'add_args' => false,
                'add_fragment' => '',
            ));
            ?>
        </div>
        <?php endif; ?>

        <?php else: ?>
        
        <!-- عدم وجود مقالات -->
        <div class="no-posts">
            <div class="no-posts-icon">📭</div>
            <h2>لا توجد مقالات</h2>
            <p>عذراً، لم نجد أي مقالات في هذه الفئة حالياً.</p>
            <a href="<?php echo home_url(); ?>" class="back-home-btn">العودة للرئيسية</a>
        </div>
        
        <?php endif; ?>
        
    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // البحث في الفئة
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                searchInCategory(query);
            }, 300);
        } else {
            resetSearch();
        }
    });
    
    function searchInCategory(query) {
        const category = '<?php echo is_category() ? get_queried_object()->term_id : 0; ?>';
        const url = new URL(window.location.origin);
        url.searchParams.set('s', query);
        if (category) {
            url.searchParams.set('cat', category);
        }
        
        // تحديث الرابط في المتصفح
        history.pushState(null, '', url.toString());
        
        // تحديث المحتوى
        window.location.href = url.toString();
    }
    
    function resetSearch() {
        // إعادة تعيين إلى صفحة الأرشيف الأصلية
        const currentUrl = new URL(window.location);
        currentUrl.searchParams.delete('s');
        history.replaceState(null, '', currentUrl.toString());
    }
    
    // البحث الصوتي
    const voiceBtn = document.getElementById('voiceSearchBtn');
    
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        recognition.lang = 'ar-SA';
        recognition.continuous = false;
        recognition.interimResults = false;

        voiceBtn.addEventListener('click', function() {
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
            searchInCategory(transcript);
        };

        recognition.onerror = function() {
            voiceBtn.classList.remove('recording');
            voiceBtn.textContent = '🎤';
        };

        recognition.onend = function() {
            voiceBtn.classList.remove('recording');
            voiceBtn.textContent = '🎤';
        };
    } else {
        voiceBtn.style.display = 'none';
    }
    
    // تأثيرات التمرير
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    });

    document.querySelectorAll('.post-card').forEach(card => {
        observer.observe(card);
    });
    
});
</script>

<style>
/* تنسيقات صفحة الأرشيف */
.archive-container {
    max-width: 100%;
}

.archive-header {
    background: var(--gradient-bg);
    color: white;
    padding: 20px;
}

.archive-header-content {
    display: flex;
    align-items: center;
    gap: 15px;
    max-width: 800px;
    margin: 0 auto;
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

.archive-info h1 {
    font-size: 24px;
    margin-bottom: 8px;
}

.archive-description {
    font-size: 14px;
    opacity: 0.9;
    line-height: 1.4;
}

.archive-stats {
    padding: 20px;
    background: var(--light-color);
    text-align: center;
    margin-bottom: 20px;
}

.posts-count {
    font-size: 16px;
    color: var(--dark-color);
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    padding: 0 20px;
    max-width: 800px;
    margin: 0 auto;
}

.post-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(30px);
}

.post-card.visible {
    opacity: 1;
    transform: translateY(0);
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.post-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.post-thumbnail {
    height: 180px;
    position: relative;
    overflow: hidden;
}

.post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-card:hover .post-thumbnail img {
    transform: scale(1.05);
}

.post-thumbnail.placeholder {
    background: var(--gradient-bg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-icon {
    font-size: 48px;
    opacity: 0.8;
}

.post-content {
    padding: 20px;
}

.post-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
    color: var(--dark-color);
}

.post-excerpt {
    font-size: 14px;
    color: #666;
    line-height: 1.5;
    margin-bottom: 15px;
}

.post-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    font-size: 12px;
}

.post-date, .post-views {
    color: #7f8c8d;
}

.difficulty-badge {
    padding: 4px 8px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 500;
}

.difficulty-سهل { background: #d4edda; color: #155724; }
.difficulty-متوسط { background: #fff3cd; color: #856404; }
.difficulty-صعب { background: #f8d7da; color: #721c24; }

.pagination-container {
    padding: 30px 20px;
    display: flex;
    justify-content: center;
}

.pagination-container .page-numbers {
    list-style: none;
    display: flex;
    gap: 5px;
    margin: 0;
    padding: 0;
}

.pagination-container .page-numbers li {
    margin: 0;
}

.pagination-container .page-numbers a,
.pagination-container .page-numbers span {
    display: block;
    padding: 10px 15px;
    background: white;
    color: var(--primary-color);
    text-decoration: none;
    border-radius: 8px;
    border: 2px solid var(--light-color);
    transition: all 0.3s ease;
}

.pagination-container .page-numbers .current {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-container .page-numbers a:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.no-posts {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: var(--border-radius);
    margin: 20px;
    box-shadow: var(--card-shadow);
}

.no-posts-icon {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.6;
}

.no-posts h2 {
    font-size: 24px;
    margin-bottom: 15px;
    color: var(--dark-color);
}

.no-posts p {
    font-size: 16px;
    color: #666;
    margin-bottom: 25px;
}

.back-home-btn {
    display: inline-block;
    padding: 12px 24px;
    background: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.back-home-btn:hover {
    background: #357abd;
    transform: translateY(-2px);
}

/* الاستجابة للشاشات الصغيرة */
@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
        padding: 0 15px;
    }
    
    .archive-header-content {
        padding: 0 15px;
    }
    
    .archive-info h1 {
        font-size: 20px;
    }
    
    .pagination-container .page-numbers {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination-container .page-numbers a,
    .pagination-container .page-numbers span {
        padding: 8px 12px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .post-content {
        padding: 15px;
    }
    
    .post-title {
        font-size: 16px;
    }
    
    .post-excerpt {
        font-size: 13px;
    }
}
</style>

<?php get_footer(); ?>