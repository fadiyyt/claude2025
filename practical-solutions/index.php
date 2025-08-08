<?php
/**
 * الصفحة الرئيسية - قالب الحلول العملية
 * 
 * @package PracticalSolutions
 * @version 1.0
 */

get_header(); ?>

<!-- شاشة التحميل -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-spinner"></div>
</div>

<div class="app-container" id="appContainer">
    
    <!-- رأس التطبيق -->
    <header class="app-header">
        <h1><?php bloginfo('name'); ?></h1>
        <div class="subtitle"><?php bloginfo('description'); ?></div>
    </header>

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
        </div>
        <div id="searchResults" class="search-results" style="display: none;"></div>
    </div>

    <!-- أنماط CSS لنتائج البحث -->
    <style>
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        margin-top: 5px;
    }
    
    .search-results-container {
        padding: 10px;
    }
    
    .search-result-item {
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 10px;
        padding-bottom: 10px;
    }
    
    .search-result-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .search-result-link {
        display: flex;
        padding: 10px;
        text-decoration: none;
        color: inherit;
        transition: background 0.2s ease;
        border-radius: 8px;
        gap: 12px;
    }
    
    .search-result-link:hover {
        background: #f8f9fa;
    }
    
    .search-result-content {
        flex: 1;
    }
    
    .search-result-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--dark-color);
        line-height: 1.3;
    }
    
    .search-result-excerpt {
        font-size: 12px;
        color: #7f8c8d;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    
    .search-result-category {
        font-size: 11px;
        background: var(--primary-color);
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        display: inline-block;
    }
    
    .search-result-thumb {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .search-result-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .no-search-results {
        padding: 20px;
        text-align: center;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .dark-mode .search-results {
        background: #3a3a3a;
        color: #e1e1e1;
    }
    
    .dark-mode .search-result-link:hover {
        background: #4a4a4a;
    }
    </style>

    <!-- التنقل السريع -->
    <nav class="quick-nav">
        <?php
        // قائمة فئات الحلول العملية
        $categories = get_categories(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
            'number' => 6
        ));
        
        $icons = array('🏠', '👨‍🍳', '🧹', '🔧', '💡', '🌱');
        $icon_index = 0;
        
        foreach($categories as $category): ?>
        <a href="<?php echo get_category_link($category->term_id); ?>" class="nav-item">
            <div class="nav-icon">
                <?php echo $icons[$icon_index % count($icons)]; ?>
            </div>
            <div class="nav-title"><?php echo $category->name; ?></div>
        </a>
        <?php $icon_index++; endforeach; ?>
    </nav>

    <!-- المحتوى الرئيسي -->
    <main class="main-content">
        
        <!-- الحلول المميزة -->
        <section class="content-section">
            <div class="section-header">
                <h2 class="section-title">🌟 الحلول المميزة</h2>
                <a href="<?php echo home_url('/featured'); ?>" class="view-all">عرض الكل</a>
            </div>
            
            <div class="content-cards">
                <?php
                // استعلام للمقالات المميزة
                $featured_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'meta_query' => array(
                        array(
                            'key' => 'featured_post',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
                ));
                
                if($featured_posts->have_posts()): 
                    while($featured_posts->have_posts()): $featured_posts->the_post();
                ?>
                <article class="content-card fade-in">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                             alt="<?php the_title(); ?>" 
                             class="card-image"
                             loading="lazy">
                        <?php else: ?>
                        <div class="card-image" style="background: linear-gradient(45deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px;">
                            💡
                        </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <div class="card-meta">
                                <span class="card-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if(!empty($categories)) {
                                        echo $categories[0]->name;
                                    }
                                    ?>
                                </span>
                                <span class="card-date">
                                    <?php echo get_the_date('M j'); ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </section>

        <!-- أحدث الحلول -->
        <section class="content-section">
            <div class="section-header">
                <h2 class="section-title">🆕 أحدث الحلول</h2>
                <a href="<?php echo home_url('/latest'); ?>" class="view-all">عرض الكل</a>
            </div>
            
            <div class="content-cards">
                <?php
                // استعلام للمقالات الأحدث
                $latest_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if($latest_posts->have_posts()): 
                    while($latest_posts->have_posts()): $latest_posts->the_post();
                ?>
                <article class="content-card slide-up">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                             alt="<?php the_title(); ?>" 
                             class="card-image"
                             loading="lazy">
                        <?php else: ?>
                        <div class="card-image" style="background: linear-gradient(45deg, #f39c12, #e74c3c); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px;">
                            🔥
                        </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <div class="card-meta">
                                <span class="card-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if(!empty($categories)) {
                                        echo $categories[0]->name;
                                    }
                                    ?>
                                </span>
                                <span class="card-date">
                                    <?php echo get_the_date('M j'); ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </section>

        <!-- الحلول الأكثر مشاهدة -->
        <section class="content-section">
            <div class="section-header">
                <h2 class="section-title">🔥 الأكثر مشاهدة</h2>
                <a href="<?php echo home_url('/popular'); ?>" class="view-all">عرض الكل</a>
            </div>
            
            <div class="content-cards">
                <?php
                // استعلام للمقالات الأكثر مشاهدة
                $popular_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'meta_key' => 'post_views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));
                
                if($popular_posts->have_posts()): 
                    while($popular_posts->have_posts()): $popular_posts->the_post();
                ?>
                <article class="content-card fade-in">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                             alt="<?php the_title(); ?>" 
                             class="card-image"
                             loading="lazy">
                        <?php else: ?>
                        <div class="card-image" style="background: linear-gradient(45deg, #27ae60, #2ecc71); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px;">
                            ⭐
                        </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <div class="card-meta">
                                <span class="card-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if(!empty($categories)) {
                                        echo $categories[0]->name;
                                    }
                                    ?>
                                </span>
                                <span class="card-views">
                                    👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </section>

    </main>

    <!-- الأزرار العائمة -->
    <div class="floating-actions">
        <button class="fab-scroll-top" id="scrollToTopBtn" aria-label="العودة لأعلى">
            ⬆️
        </button>
        <button class="fab-main" id="fabMain" aria-label="القائمة السريعة">
            ⚡
        </button>
    </div>

</div>

<!-- سكريبت التطبيق -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إخفاء شاشة التحميل
    setTimeout(function() {
        document.getElementById('loadingScreen').style.opacity = '0';
        setTimeout(function() {
            document.getElementById('loadingScreen').style.display = 'none';
        }, 500);
    }, 1500);

    // البحث المباشر
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if(query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    function performSearch(query) {
        // إجراء البحث عبر AJAX
        const formData = new FormData();
        formData.append('action', 'live_search');
        formData.append('query', query);
        formData.append('nonce', window.practicalTheme?.nonce || '<?php echo wp_create_nonce('practical_nonce'); ?>');
        
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                let resultsHTML = '<div class="search-results-container">';
                data.data.forEach(item => {
                    resultsHTML += `
                        <div class="search-result-item">
                            <a href="${item.url}" class="search-result-link">
                                <div class="search-result-content">
                                    <h4 class="search-result-title">${item.title}</h4>
                                    <p class="search-result-excerpt">${item.excerpt}</p>
                                    <span class="search-result-category">${item.category}</span>
                                </div>
                                ${item.thumbnail ? `<div class="search-result-thumb"><img src="${item.thumbnail}" alt="${item.title}" loading="lazy"></div>` : ''}
                            </a>
                        </div>
                    `;
                });
                resultsHTML += '</div>';
                searchResults.innerHTML = resultsHTML;
            } else {
                searchResults.innerHTML = '<div class="no-search-results"><p>لا توجد نتائج لهذا البحث</p></div>';
            }
            searchResults.style.display = 'block';
        })
        .catch(error => {
            console.error('خطأ في البحث:', error);
            searchResults.innerHTML = '<div class="no-search-results"><p>حدث خطأ في البحث</p></div>';
            searchResults.style.display = 'block';
        });
    }

    // البحث الصوتي
    const voiceBtn = document.getElementById('voiceSearchBtn');
    let recognition;

    if('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = 'ar-SA';
        recognition.continuous = false;
        recognition.interimResults = false;

        voiceBtn.addEventListener('click', function() {
            if(voiceBtn.classList.contains('recording')) {
                recognition.stop();
                voiceBtn.classList.remove('recording');
            } else {
                recognition.start();
                voiceBtn.classList.add('recording');
            }
        });

        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            searchInput.value = transcript;
            performSearch(transcript);
            voiceBtn.classList.remove('recording');
        };

        recognition.onerror = function() {
            voiceBtn.classList.remove('recording');
        };
    } else {
        voiceBtn.style.display = 'none';
    }

    // تأثيرات التمرير
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    });

    document.querySelectorAll('.scroll-reveal').forEach(el => {
        observer.observe(el);
    });

    // الزر العائم والعودة لأعلى
    const fabMain = document.getElementById('fabMain');
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    
    // إظهار/إخفاء زر العودة لأعلى بناءً على التمرير
    function toggleScrollButton() {
        if (window.pageYOffset > 200) {
            scrollToTopBtn.style.display = 'flex';
            scrollToTopBtn.style.opacity = '1';
            scrollToTopBtn.style.transform = 'scale(1)';
        } else {
            scrollToTopBtn.style.opacity = '0';
            scrollToTopBtn.style.transform = 'scale(0.8)';
            setTimeout(() => {
                if (window.pageYOffset <= 200) {
                    scrollToTopBtn.style.display = 'none';
                }
            }, 300);
        }
    }
    
    // تشغيل الدالة عند التمرير
    window.addEventListener('scroll', toggleScrollButton);
    
    // تشغيل الدالة عند تحميل الصفحة
    toggleScrollButton();
    
    // وظيفة العودة لأعلى - إصلاح المشكلة
    if (scrollToTopBtn) {
        scrollToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('تم النقر على زر العودة لأعلى'); // للتتبع
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
    }
    
    // الزر العائم الرئيسي
    fabMain.addEventListener('click', function() {
        // إنشاء قائمة سريعة
        const quickMenu = document.createElement('div');
        quickMenu.className = 'quick-menu';
        quickMenu.innerHTML = `
            <div class="quick-menu-items">
                <button class="quick-item" onclick="document.getElementById('searchInput').focus()">
                    🔍 بحث سريع
                </button>
                <button class="quick-item" onclick="toggleDarkMode()">
                    🌙 الوضع المظلم
                </button>
                <button class="quick-item" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    ⬆️ العودة لأعلى
                </button>
                <button class="quick-item" onclick="shareWebsite()">
                    📤 مشاركة الموقع
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
    
    window.shareWebsite = function() {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                text: 'موقع رائع للحلول العملية',
                url: window.location.href
            });
        } else {
            // نسخ الرابط
            navigator.clipboard.writeText(window.location.href).then(() => {
                showToast('تم نسخ رابط الموقع');
            });
        }
    };
    
    // دالة احتياطية للعودة لأعلى
    window.scrollToTopFunction = function() {
        console.log('تم استدعاء دالة العودة لأعلى الاحتياطية');
        document.body.scrollTop = 0; // للمتصفحات القديمة
        document.documentElement.scrollTop = 0; // للمتصفحات الحديثة
        window.scrollTo(0, 0); // احتياطي إضافي
    };
    
    // دالة محسنة للعودة لأعلى
    window.smoothScrollToTop = function() {
        const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
            window.requestAnimationFrame(window.smoothScrollToTop);
            window.scrollTo(0, currentScroll - (currentScroll / 8));
        }
    };
    
    // إضافة event listener إضافي
    document.addEventListener('DOMContentLoaded', function() {
        const scrollBtn = document.getElementById('scrollToTopBtn');
        if (scrollBtn) {
            scrollBtn.onclick = function() {
                console.log('تم النقر على زر العودة لأعلى');
                if (window.scrollTo) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    window.scrollToTopFunction();
                }
            };
        }
    });

    // إخفاء نتائج البحث عند النقر خارجها
    document.addEventListener('click', function(e) {
        if(!e.target.closest('.search-container')) {
            searchResults.style.display = 'none';
        }
    });
});
</script>

<?php get_footer(); ?>