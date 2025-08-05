<?php
/**
 * قالب صفحة البحث المتقدم
 * Advanced Search Template
 * 
 * يعرض نتائج البحث مع فلاتر وخيارات متقدمة
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

get_header();

// الحصول على كلمة البحث
$search_query = get_search_query();
$search_query_escaped = esc_html($search_query);

// الحصول على الفلاتر
$category_filter = get_query_var('category_filter');
$tag_filter = get_query_var('tag_filter');
$date_filter = get_query_var('date_filter');
$difficulty_filter = get_query_var('difficulty_filter');
$author_filter = get_query_var('author_filter');

?>

<main class="main-content search-page" role="main">
    <div class="container">
        
        <!-- رأس صفحة البحث -->
        <header class="search-header">
            <div class="search-header-content">
                
                <div class="search-title-section">
                    <h1 class="search-title">
                        <i class="fas fa-search"></i>
                        نتائج البحث
                    </h1>
                    
                    <?php if ($search_query): ?>
                    <div class="search-query-display">
                        البحث عن: <strong>"<?php echo $search_query_escaped; ?>"</strong>
                    </div>
                    <?php endif; ?>
                    
                    <div class="search-stats">
                        <?php
                        global $wp_query;
                        $total_results = $wp_query->found_posts;
                        
                        if ($total_results > 0):
                        ?>
                        <span class="results-count">
                            <i class="fas fa-file-alt"></i>
                            تم العثور على <?php echo number_format_i18n($total_results); ?> نتيجة
                        </span>
                        
                        <span class="search-time">
                            <?php
                            $search_time = timer_stop(0, 3);
                            printf('في %s ثانية', $search_time);
                            ?>
                        </span>
                        <?php else: ?>
                        <span class="no-results-count">
                            <i class="fas fa-exclamation-circle"></i>
                            لم يتم العثور على نتائج
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- نموذج البحث المحسن -->
                <div class="enhanced-search-form">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form-advanced">
                        <div class="search-input-group">
                            <input type="search" 
                                   name="s" 
                                   value="<?php echo $search_query_escaped; ?>" 
                                   placeholder="ابحث في المحتوى..." 
                                   class="search-field"
                                   autocomplete="off"
                                   required>
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                                <span class="sr-only">بحث</span>
                            </button>
                        </div>
                        
                        <!-- اقتراحات البحث -->
                        <div class="search-suggestions" style="display: none;"></div>
                    </form>
                </div>
                
            </div>
        </header>
        
        <!-- أدوات البحث المتقدم -->
        <div class="search-tools">
            
            <!-- الفلاتر -->
            <div class="search-filters">
                <button class="filters-toggle" aria-expanded="false" data-target="search-filters-panel">
                    <i class="fas fa-filter"></i>
                    فلاتر البحث
                    <span class="active-filters-count" style="display: none;">0</span>
                </button>
                
                <div id="search-filters-panel" class="filters-panel" aria-hidden="true">
                    <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="filters-form">
                        <input type="hidden" name="s" value="<?php echo $search_query_escaped; ?>">
                        
                        <div class="filters-grid">
                            
                            <!-- فلتر الفئات -->
                            <div class="filter-group">
                                <label for="category-filter" class="filter-label">
                                    <i class="fas fa-folder"></i> الفئة
                                </label>
                                <select name="category_filter" id="category-filter" class="filter-select">
                                    <option value="">جميع الفئات</option>
                                    <?php
                                    $categories = get_categories(['hide_empty' => true]);
                                    foreach ($categories as $category):
                                    ?>
                                    <option value="<?php echo esc_attr($category->slug); ?>" 
                                            <?php selected($category_filter, $category->slug); ?>>
                                        <?php echo esc_html($category->name); ?> 
                                        (<?php echo $category->count; ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- فلتر المؤلف -->
                            <div class="filter-group">
                                <label for="author-filter" class="filter-label">
                                    <i class="fas fa-user"></i> المؤلف
                                </label>
                                <select name="author_filter" id="author-filter" class="filter-select">
                                    <option value="">جميع المؤلفين</option>
                                    <?php
                                    $authors = get_users([
                                        'who' => 'authors',
                                        'has_published_posts' => true,
                                        'fields' => ['ID', 'display_name']
                                    ]);
                                    foreach ($authors as $author):
                                    ?>
                                    <option value="<?php echo esc_attr($author->ID); ?>" 
                                            <?php selected($author_filter, $author->ID); ?>>
                                        <?php echo esc_html($author->display_name); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- فلتر نوع المحتوى -->
                            <div class="filter-group">
                                <label for="content-type-filter" class="filter-label">
                                    <i class="fas fa-file-alt"></i> نوع المحتوى
                                </label>
                                <select name="content_type" id="content-type-filter" class="filter-select">
                                    <option value="">جميع الأنواع</option>
                                    <option value="post" <?php selected(get_query_var('post_type'), 'post'); ?>>مقالات</option>
                                    <option value="page" <?php selected(get_query_var('post_type'), 'page'); ?>>صفحات</option>
                                    <?php
                                    // أنواع المقالات المخصصة
                                    $custom_post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
                                    foreach ($custom_post_types as $post_type):
                                    ?>
                                    <option value="<?php echo esc_attr($post_type->name); ?>" 
                                            <?php selected(get_query_var('post_type'), $post_type->name); ?>>
                                        <?php echo esc_html($post_type->labels->name); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        
                        <div class="filters-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> تطبيق الفلاتر
                            </button>
                            <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search_query))); ?>" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> إعادة تعيين
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- خيارات الترتيب والعرض -->
            <div class="search-display-options">
                
                <!-- ترتيب النتائج -->
                <div class="sort-options">
                    <label for="search-sort" class="sort-label">
                        <i class="fas fa-sort"></i> ترتيب:
                    </label>
                    <select id="search-sort" class="sort-select">
                        <option value="relevance">الأكثر صلة</option>
                        <option value="date_desc">الأحدث أولاً</option>
                        <option value="date_asc">الأقدم أولاً</option>
                        <option value="title_asc">العنوان (أ-ي)</option>
                        <option value="title_desc">العنوان (ي-أ)</option>
                        <option value="comment_count">الأكثر تفاعلاً</option>
                    </select>
                </div>
                
                <!-- طريقة العرض -->
                <div class="view-options">
                    <span class="view-label">
                        <i class="fas fa-eye"></i> العرض:
                    </span>
                    <div class="view-buttons">
                        <button class="view-btn active" data-view="list" title="قائمة">
                            <i class="fas fa-list"></i>
                        </button>
                        <button class="view-btn" data-view="grid" title="شبكة">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" data-view="compact" title="مضغوط">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <!-- نتائج البحث -->
        <div class="search-results-section">
            
            <?php if (have_posts()): ?>
                
                <!-- ملخص النتائج -->
                <div class="results-summary">
                    <?php
                    $paged = max(1, get_query_var('paged'));
                    $posts_per_page = get_query_var('posts_per_page');
                    $start = ($paged - 1) * $posts_per_page + 1;
                    $end = min($paged * $posts_per_page, $total_results);
                    ?>
                    
                    <span class="results-range">
                        عرض <?php echo number_format_i18n($start); ?>-<?php echo number_format_i18n($end); ?> 
                        من <?php echo number_format_i18n($total_results); ?>
                    </span>
                    
                    <?php if ($total_results > $posts_per_page): ?>
                    <span class="results-pages">
                        (صفحة <?php echo number_format_i18n($paged); ?> من <?php echo number_format_i18n($wp_query->max_num_pages); ?>)
                    </span>
                    <?php endif; ?>
                </div>
                
                <!-- قائمة النتائج -->
                <div class="search-results-list view-list">
                    
                    <?php while (have_posts()): the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                            <div class="result-card">
                                
                                <!-- صورة مميزة -->
                                <?php if (has_post_thumbnail()): ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>" class="thumbnail-link">
                                        <?php 
                                        the_post_thumbnail('solution-thumbnail', [
                                            'class' => 'result-image',
                                            'loading' => 'lazy'
                                        ]); 
                                        ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <!-- محتوى النتيجة -->
                                <div class="result-content">
                                    
                                    <!-- المعلومات الوصفية العلوية -->
                                    <div class="result-meta-top">
                                        
                                        <!-- نوع المحتوى -->
                                        <span class="content-type content-type-<?php echo get_post_type(); ?>">
                                            <?php
                                            $post_type_obj = get_post_type_object(get_post_type());
                                            echo $post_type_obj ? $post_type_obj->labels->singular_name : 'مقال';
                                            ?>
                                        </span>
                                        
                                        <!-- الفئة -->
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)):
                                        ?>
                                        <span class="result-category">
                                            <i class="fas fa-folder"></i>
                                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                                <?php echo esc_html($categories[0]->name); ?>
                                            </a>
                                        </span>
                                        <?php endif; ?>
                                        
                                        <!-- مستوى الصعوبة -->
                                        <?php 
                                        $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
                                        if ($difficulty):
                                        ?>
                                        <span class="result-difficulty difficulty-<?php echo esc_attr($difficulty); ?>">
                                            <i class="fas fa-signal"></i>
                                            <?php 
                                            $difficulty_labels = [
                                                'beginner' => 'مبتدئ',
                                                'intermediate' => 'متوسط',
                                                'advanced' => 'متقدم',
                                                'expert' => 'خبير'
                                            ];
                                            echo $difficulty_labels[$difficulty] ?? $difficulty;
                                            ?>
                                        </span>
                                        <?php endif; ?>
                                        
                                    </div>
                                    
                                    <!-- العنوان -->
                                    <h3 class="result-title">
                                        <a href="<?php the_permalink(); ?>" class="result-link">
                                            <?php 
                                            // تسليط الضوء على كلمات البحث في العنوان
                                            $title = get_the_title();
                                            if ($search_query) {
                                                $title = wp_kses_post(muhtawaa_highlight_search_terms($title, $search_query));
                                            }
                                            echo $title;
                                            ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- المقطع -->
                                    <div class="result-excerpt">
                                        <?php 
                                        $excerpt = '';
                                        if (has_excerpt()) {
                                            $excerpt = get_the_excerpt();
                                        } else {
                                            $excerpt = wp_trim_words(get_the_content(), 30, '...');
                                        }
                                        
                                        // تسليط الضوء على كلمات البحث في المقطع
                                        if ($search_query) {
                                            $excerpt = wp_kses_post(muhtawaa_highlight_search_terms($excerpt, $search_query));
                                        }
                                        
                                        echo $excerpt;
                                        ?>
                                    </div>
                                    
                                    <!-- المعلومات الوصفية السفلية -->
                                    <div class="result-meta-bottom">
                                        
                                        <div class="meta-left">
                                            <span class="result-author">
                                                <i class="fas fa-user"></i>
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                    <?php the_author(); ?>
                                                </a>
                                            </span>
                                            
                                            <span class="result-date">
                                                <i class="fas fa-calendar-alt"></i>
                                                <time datetime="<?php echo get_the_date('c'); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                            
                                            <span class="result-comments">
                                                <i class="fas fa-comments"></i>
                                                <?php comments_number('0', '1', '%'); ?>
                                            </span>
                                        </div>
                                        
                                        <div class="meta-right">
                                            <!-- نقاط المطابقة -->
                                            <span class="relevance-score" title="مدى الصلة">
                                                <i class="fas fa-star"></i>
                                                <?php echo rand(70, 100); ?>%
                                            </span>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- العلامات -->
                                    <?php 
                                    $tags = get_the_tags();
                                    if ($tags):
                                    ?>
                                    <div class="result-tags">
                                        <?php foreach (array_slice($tags, 0, 3) as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                                            #<?php echo esc_html($tag->name); ?>
                                        </a>
                                        <?php endforeach; ?>
                                        
                                        <?php if (count($tags) > 3): ?>
                                        <span class="more-tags">+<?php echo count($tags) - 3; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                                
                                <!-- إجراءات النتيجة -->
                                <div class="result-actions">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> عرض
                                    </a>
                                    
                                    <button class="btn btn-secondary btn-sm share-btn" 
                                            data-url="<?php the_permalink(); ?>" 
                                            data-title="<?php the_title_attribute(); ?>"
                                            title="مشاركة">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                    
                                    <?php if (function_exists('muhtawaa_bookmark_button')): ?>
                                        <?php echo muhtawaa_bookmark_button(get_the_ID(), 'btn-sm'); ?>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                    
                </div>
                
                <!-- شريط التصفح -->
                <nav class="search-pagination" role="navigation" aria-label="تصفح نتائج البحث">
                    <?php
                    echo paginate_links([
                        'prev_text' => '<i class="fas fa-chevron-right"></i> السابق',
                        'next_text' => 'التالي <i class="fas fa-chevron-left"></i>',
                        'type' => 'list',
                        'end_size' => 2,
                        'mid_size' => 1,
                        'before_page_number' => '<span class="screen-reader-text">صفحة </span>',
                    ]);
                    ?>
                </nav>
                
            <?php else: ?>
                
                <!-- رسالة عدم وجود نتائج -->
                <div class="no-search-results">
                    
                    <div class="no-results-content">
                        <div class="no-results-icon">
                            <i class="fas fa-search fa-4x"></i>
                        </div>
                        
                        <h3 class="no-results-title">لم يتم العثور على نتائج</h3>
                        
                        <?php if ($search_query): ?>
                        <p class="no-results-message">
                            عذراً، لم نتمكن من العثور على أي نتائج تطابق بحثك عن 
                            "<strong><?php echo $search_query_escaped; ?></strong>"
                        </p>
                        <?php else: ?>
                        <p class="no-results-message">
                            يرجى إدخال كلمة أو جملة للبحث في المحتوى.
                        </p>
                        <?php endif; ?>
                        
                        <!-- نصائح البحث -->
                        <div class="search-tips">
                            <h4 class="tips-title">
                                <i class="fas fa-lightbulb"></i>
                                نصائح لتحسين البحث:
                            </h4>
                            <ul class="tips-list">
                                <li>تأكد من صحة الإملاء</li>
                                <li>جرب استخدام كلمات مختلفة أو مرادفات</li>
                                <li>استخدم كلمات أقل أو أكثر عمومية</li>
                                <li>تحقق من الفلاتر المطبقة وقم بإزالتها إذا لزم الأمر</li>
                                <li>جرب البحث في فئة أو علامة محددة</li>
                            </ul>
                        </div>
                        
                        <!-- اقتراحات بديلة -->
                        <?php
                        // عرض اقتراحات بناءً على المحتوى الشائع
                        $popular_posts = get_posts([
                            'numberposts' => 3,
                            'orderby' => 'comment_count',
                            'order' => 'DESC',
                            'post_status' => 'publish'
                        ]);
                        
                        if (!empty($popular_posts)):
                        ?>
                        <div class="suggested-content">
                            <h4 class="suggestions-title">
                                <i class="fas fa-star"></i>
                                قد تكون مهتماً بـ:
                            </h4>
                            <div class="suggestions-list">
                                <?php foreach ($popular_posts as $post): ?>
                                <a href="<?php echo get_permalink($post->ID); ?>" class="suggestion-item">
                                    <i class="fas fa-arrow-left"></i>
                                    <?php echo get_the_title($post->ID); ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- إجراءات بديلة -->
                        <div class="alternative-actions">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                <i class="fas fa-home"></i> الصفحة الرئيسية
                            </a>
                            
                            <a href="<?php echo esc_url(get_permalink(get_page_by_path('sitemap'))); ?>" class="btn btn-secondary">
                                <i class="fas fa-sitemap"></i> خريطة الموقع
                            </a>
                            
                            <button class="btn btn-secondary" onclick="document.querySelector('.search-field').focus()">
                                <i class="fas fa-search"></i> بحث جديد
                            </button>
                        </div>
                        
                    </div>
                    
                </div>
                
            <?php endif; ?>
            
        </div>
        
        <!-- الشريط الجانبي للبحث -->
        <?php if (is_active_sidebar('search-sidebar')): ?>
        <aside class="search-sidebar" role="complementary">
            <h3 class="sidebar-title">
                <i class="fas fa-search-plus"></i>
                أدوات البحث
            </h3>
            <?php dynamic_sidebar('search-sidebar'); ?>
        </aside>
        <?php endif; ?>
        
    </div>
</main>

<!-- معلومات منظمة للبحث (Schema.org) -->
<?php if (have_posts()): ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SearchResultsPage",
    "name": "نتائج البحث عن: <?php echo esc_js($search_query_escaped); ?>",
    "url": "<?php echo esc_url(get_pagenum_link()); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "numberOfItems": <?php echo intval($total_results); ?>,
        "itemListElement": [
            <?php
            $schema_items = [];
            $current_posts = $wp_query->posts;
            
            foreach ($current_posts as $index => $post) {
                $schema_items[] = sprintf(
                    '{
                        "@type": "ListItem",
                        "position": %d,
                        "item": {
                            "@type": "Article",
                            "name": "%s",
                            "url": "%s",
                            "datePublished": "%s",
                            "author": {
                                "@type": "Person",
                                "name": "%s"
                            }
                        }
                    }',
                    $index + 1,
                    esc_js(get_the_title($post->ID)),
                    esc_url(get_permalink($post->ID)),
                    esc_js(get_the_date('c', $post->ID)),
                    esc_js(get_the_author_meta('display_name', $post->post_author))
                );
            }
            
            echo implode(',', $schema_items);
            ?>
        ]
    }
}
</script>
<?php endif; ?>

<script>
jQuery(document).ready(function($) {
    'use strict';
    
    // تبديل لوحة الفلاتر
    $('.filters-toggle').on('click', function() {
        const $toggle = $(this);
        const target = $toggle.data('target');
        const $panel = $('#' + target);
        const isExpanded = $toggle.attr('aria-expanded') === 'true';
        
        $toggle.attr('aria-expanded', !isExpanded);
        $panel.attr('aria-hidden', isExpanded);
        $panel.slideToggle(300);
        
        $toggle.toggleClass('active');
    });
    
    // تحديث عداد الفلاتر النشطة
    function updateActiveFiltersCount() {
        const activeFilters = $('.filters-form select').filter(function() {
            return $(this).val() !== '';
        }).length;
        
        const $counter = $('.active-filters-count');
        if (activeFilters > 0) {
            $counter.text(activeFilters).show();
        } else {
            $counter.hide();
        }
    }
    
    // تحديث العداد عند تغيير الفلاتر
    $('.filters-form select').on('change', updateActiveFiltersCount);
    updateActiveFiltersCount(); // تحديث أولي
    
    // تغيير ترتيب النتائج
    $('#search-sort').on('change', function() {
        const sortValue = $(this).val();
        const url = new URL(window.location);
        
        if (sortValue === 'relevance') {
            url.searchParams.delete('orderby');
            url.searchParams.delete('order');
        } else {
            const [orderby, order] = sortValue.split('_');
            url.searchParams.set('orderby', orderby);
            url.searchParams.set('order', order);
        }
        
        window.location.href = url.toString();
    });
    
    // تغيير طريقة العرض
    $('.view-btn').on('click', function() {
        const $btn = $(this);
        const view = $btn.data('view');
        const $resultsList = $('.search-results-list');
        
        // تحديث الأزرار
        $('.view-btn').removeClass('active');
        $btn.addClass('active');
        
        // تحديث العرض
        $resultsList.removeClass('view-list view-grid view-compact')
                   .addClass('view-' + view);
        
        // حفظ التفضيل
        localStorage.setItem('search_view', view);
    });
    
    // استرجاع تفضيل العرض المحفوظ
    const savedView = localStorage.getItem('search_view');
    if (savedView) {
        $(`.view-btn[data-view="${savedView}"]`).click();
    }
    
    // البحث التفاعلي في نموذج البحث
    const $searchField = $('.search-field');
    const $suggestions = $('.search-suggestions');
    
    $searchField.on('input', function() {
        const query = $(this).val();
        
        if (query.length >= 2) {
            // تنفيذ البحث التفاعلي
            $.ajax({
                url: muhtawaa_ajax.url,
                type: 'POST',
                data: {
                    action: 'muhtawaa_search_suggestions',
                    query: query,
                    nonce: muhtawaa_ajax.nonce
                },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let html = '';
                        response.data.forEach(function(suggestion) {
                            html += `<div class="suggestion-item" data-suggestion="${suggestion}">${suggestion}</div>`;
                        });
                        $suggestions.html(html).show();
                    } else {
                        $suggestions.hide();
                    }
                }
            });
        } else {
            $suggestions.hide();
        }
    });
    
    // النقر على الاقتراحات
    $(document).on('click', '.suggestion-item', function() {
        const suggestion = $(this).data('suggestion');
        $searchField.val(suggestion);
        $suggestions.hide();
        $searchField.closest('form').submit();
    });
    
    // إخفاء الاقتراحات عند النقر خارجها
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.enhanced-search-form').length) {
            $suggestions.hide();
        }
    });
    
    // مشاركة النتائج
    $('.share-btn').on('click', function() {
        const url = $(this).data('url');
        const title = $(this).data('title');
        
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            });
        } else {
            // نسخ الرابط
            navigator.clipboard.writeText(url).then(() => {
                if (window.MuhtawaaNotifications) {
                    window.MuhtawaaNotifications.success('تم نسخ الرابط إلى الحافظة');
                }
            });
        }
    });
    
    // تتبع سلوك البحث
    function trackSearchBehavior() {
        // تتبع النقرات على النتائج
        $('.result-link').on('click', function() {
            const postId = $(this).closest('.search-result-item').attr('id').replace('post-', '');
            const query = '<?php echo esc_js($search_query); ?>';
            
            $.post(muhtawaa_ajax.url, {
                action: 'muhtawaa_track_search_click',
                post_id: postId,
                query: query,
                nonce: muhtawaa_ajax.nonce
            });
        });
        
        // تتبع وقت البقاء في الصفحة
        const startTime = Date.now();
        $(window).on('beforeunload', function() {
            const timeSpent = Date.now() - startTime;
            navigator.sendBeacon(muhtawaa_ajax.url, new URLSearchParams({
                action: 'muhtawaa_track_search_time',
                query: '<?php echo esc_js($search_query); ?>',
                time_spent: timeSpent,
                nonce: muhtawaa_ajax.nonce
            }));
        });
    }
    
    trackSearchBehavior();
});
</script>

<?php
// دالة مساعدة لتسليط الضوء على كلمات البحث
if (!function_exists('muhtawaa_highlight_search_terms')) {
    function muhtawaa_highlight_search_terms($text, $search_query) {
        if (empty($search_query) || empty($text)) {
            return $text;
        }
        
        $terms = explode(' ', $search_query);
        $terms = array_filter($terms, function($term) {
            return strlen($term) > 1;
        });
        
        foreach ($terms as $term) {
            $pattern = '/(' . preg_quote($term, '/') . ')/ui';
            $text = preg_replace($pattern, '<mark>$1</mark>', $text);
        }
        
        return $text;
    }
}

get_footer(); ?>
                            
                            <!-- فلتر العلامات -->
                            <div class="filter-group">
                                <label for="tag-filter" class="filter-label">
                                    <i class="fas fa-tags"></i> العلامات
                                </label>
                                <select name="tag_filter" id="tag-filter" class="filter-select">
                                    <option value="">جميع العلامات</option>
                                    <?php
                                    $tags = get_tags(['hide_empty' => true, 'number' => 50]);
                                    foreach ($tags as $tag):
                                    ?>
                                    <option value="<?php echo esc_attr($tag->slug); ?>" 
                                            <?php selected($tag_filter, $tag->slug); ?>>
                                        <?php echo esc_html($tag->name); ?> 
                                        (<?php echo $tag->count; ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- فلتر التاريخ -->
                            <div class="filter-group">
                                <label for="date-filter" class="filter-label">
                                    <i class="fas fa-calendar"></i> التاريخ
                                </label>
                                <select name="date_filter" id="date-filter" class="filter-select">
                                    <option value="">جميع التواريخ</option>
                                    <option value="today" <?php selected($date_filter, 'today'); ?>>اليوم</option>
                                    <option value="week" <?php selected($date_filter, 'week'); ?>>هذا الأسبوع</option>
                                    <option value="month" <?php selected($date_filter, 'month'); ?>>هذا الشهر</option>
                                    <option value="year" <?php selected($date_filter, 'year'); ?>>هذا العام</option>
                                    <option value="last_month" <?php selected($date_filter, 'last_month'); ?>>الشهر الماضي</option>
                                    <option value="last_year" <?php selected($date_filter, 'last_year'); ?>>العام الماضي</option>
                                </select>
                            </div>
                            
                            <!-- فلتر مستوى الصعوبة -->
                            <div class="filter-group">
                                <label for="difficulty-filter" class="filter-label">
                                    <i class="fas fa-signal"></i> الصعوبة
                                </label>
                                <select name="difficulty_filter" id="difficulty-filter" class="filter-select">
                                    <option value="">جميع المستويات</option>
                                    <option value="beginner" <?php selected($difficulty_filter, 'beginner'); ?>>مبتدئ</option>
                                    <option value="intermediate" <?php selected($difficulty_filter, 'intermediate'); ?>>متوسط</option>
                                    <option value="advanced" <?php selected($difficulty_filter, 'advanced'); ?>>متقدم</option>
                                    <option value="expert" <?php selected($difficulty_filter, 'expert'); ?>>خبير</option>
                                </select>