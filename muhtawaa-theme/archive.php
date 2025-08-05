<?php
/**
 * قالب صفحات الأرشيف
 * Archive Template
 * 
 * يعرض قوائم المقالات حسب الفئة، التاريخ، المؤلف، أو العلامات
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

get_header(); ?>

<main class="main-content" role="main">
    <div class="container">
        
        <!-- رأس الأرشيف -->
        <header class="archive-header">
            <div class="archive-header-content">
                
                <?php
                // الحصول على معلومات الأرشيف الحالي
                $archive_title = get_the_archive_title();
                $archive_description = get_the_archive_description();
                $archive_type = '';
                $archive_icon = '';
                $archive_color = '';
                
                // تحديد نوع الأرشيف والأيقونة
                if (is_category()) {
                    $archive_type = 'category';
                    $archive_icon = 'fas fa-folder-open';
                    $archive_color = '#667eea';
                    $category = get_queried_object();
                    $posts_count = $category->count;
                } elseif (is_tag()) {
                    $archive_type = 'tag';
                    $archive_icon = 'fas fa-tag';
                    $archive_color = '#f093fb';
                    $tag = get_queried_object();
                    $posts_count = $tag->count;
                } elseif (is_author()) {
                    $archive_type = 'author';
                    $archive_icon = 'fas fa-user';
                    $archive_color = '#4ade80';
                    $author = get_queried_object();
                    $posts_count = count_user_posts($author->ID);
                } elseif (is_date()) {
                    $archive_type = 'date';
                    $archive_icon = 'fas fa-calendar-alt';
                    $archive_color = '#fb7185';
                    $posts_count = $wp_query->found_posts;
                } else {
                    $archive_type = 'general';
                    $archive_icon = 'fas fa-archive';
                    $archive_color = '#64748b';
                    $posts_count = $wp_query->found_posts;
                }
                ?>
                
                <div class="archive-meta">
                    <div class="archive-icon" style="color: <?php echo esc_attr($archive_color); ?>">
                        <i class="<?php echo esc_attr($archive_icon); ?>"></i>
                    </div>
                    
                    <div class="archive-info">
                        <h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
                        
                        <div class="archive-stats">
                            <span class="posts-count">
                                <i class="fas fa-file-alt"></i>
                                <?php printf(
                                    _n('%s مقال', '%s مقال', $posts_count, 'muhtawaa'),
                                    number_format_i18n($posts_count)
                                ); ?>
                            </span>
                            
                            <?php if (is_category() || is_tag()): ?>
                                <span class="archive-type">
                                    <i class="fas fa-info-circle"></i>
                                    <?php echo is_category() ? 'فئة' : 'علامة'; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($archive_description): ?>
                            <div class="archive-description">
                                <?php echo wp_kses_post($archive_description); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- معلومات إضافية للمؤلف -->
                <?php if (is_author()): ?>
                    <div class="author-details">
                        <div class="author-avatar">
                            <?php echo get_avatar($author->ID, 80); ?>
                        </div>
                        
                        <div class="author-bio">
                            <?php if ($author_bio = get_the_author_meta('description', $author->ID)): ?>
                                <p class="author-description"><?php echo esc_html($author_bio); ?></p>
                            <?php endif; ?>
                            
                            <div class="author-links">
                                <?php if ($website = get_the_author_meta('user_url', $author->ID)): ?>
                                    <a href="<?php echo esc_url($website); ?>" class="author-website" target="_blank" rel="noopener">
                                        <i class="fas fa-globe"></i> الموقع الشخصي
                                    </a>
                                <?php endif; ?>
                                
                                <span class="join-date">
                                    <i class="fas fa-calendar-plus"></i>
                                    انضم في <?php echo date_i18n('F Y', strtotime($author->user_registered)); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </header>
        
        <!-- أدوات الفلترة والترتيب -->
        <div class="archive-tools">
            <div class="archive-filters">
                
                <!-- فلتر الترتيب -->
                <div class="sort-filter">
                    <label for="archive-sort" class="filter-label">
                        <i class="fas fa-sort"></i> ترتيب حسب:
                    </label>
                    <select id="archive-sort" class="filter-select">
                        <option value="date_desc" <?php selected(get_query_var('orderby'), 'date'); ?>>الأحدث أولاً</option>
                        <option value="date_asc">الأقدم أولاً</option>
                        <option value="title_asc">العنوان (أ-ي)</option>
                        <option value="title_desc">العنوان (ي-أ)</option>
                        <option value="comment_count">الأكثر تفاعلاً</option>
                        <option value="menu_order">مخصص</option>
                    </select>
                </div>
                
                <!-- فلتر العرض -->
                <div class="view-filter">
                    <label class="filter-label">
                        <i class="fas fa-eye"></i> طريقة العرض:
                    </label>
                    <div class="view-options">
                        <button class="view-btn active" data-view="grid" title="شبكة">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" data-view="list" title="قائمة">
                            <i class="fas fa-list"></i>
                        </button>
                        <button class="view-btn" data-view="masonry" title="بلاط">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div>
                </div>
                
                <!-- فلتر حسب التاريخ (للفئات والعلامات) -->
                <?php if (is_category() || is_tag()): ?>
                <div class="date-filter">
                    <label for="archive-date" class="filter-label">
                        <i class="fas fa-calendar"></i> التاريخ:
                    </label>
                    <select id="archive-date" class="filter-select">
                        <option value="">جميع التواريخ</option>
                        <option value="this_month">هذا الشهر</option>
                        <option value="last_month">الشهر الماضي</option>
                        <option value="this_year">هذا العام</option>
                        <option value="last_year">العام الماضي</option>
                    </select>
                </div>
                <?php endif; ?>
                
            </div>
            
            <!-- إحصائيات الأرشيف -->
            <div class="archive-stats-summary">
                <?php
                global $wp_query;
                $paged = max(1, get_query_var('paged'));
                $posts_per_page = get_query_var('posts_per_page');
                $total_posts = $wp_query->found_posts;
                $start = ($paged - 1) * $posts_per_page + 1;
                $end = min($paged * $posts_per_page, $total_posts);
                ?>
                
                <span class="results-info">
                    عرض <?php echo number_format_i18n($start); ?>-<?php echo number_format_i18n($end); ?> 
                    من <?php echo number_format_i18n($total_posts); ?> نتيجة
                </span>
                
                <?php if ($total_posts > $posts_per_page): ?>
                <span class="page-info">
                    (صفحة <?php echo number_format_i18n($paged); ?> من <?php echo number_format_i18n($wp_query->max_num_pages); ?>)
                </span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- محتوى الأرشيف -->
        <div class="archive-content">
            
            <?php if (have_posts()): ?>
                
                <div class="posts-grid view-grid" data-masonry='{"itemSelector": ".post-item", "columnWidth": ".grid-sizer", "percentPosition": true}'>
                    <!-- عنصر حجم الشبكة لـ Masonry -->
                    <div class="grid-sizer"></div>
                    
                    <?php while (have_posts()): the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-item scroll-reveal'); ?>>
                            <div class="post-card">
                                
                                <!-- صورة مميزة -->
                                <?php if (has_post_thumbnail()): ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" class="thumbnail-link">
                                        <?php 
                                        the_post_thumbnail('solution-medium', [
                                            'class' => 'post-image',
                                            'loading' => 'lazy'
                                        ]); 
                                        ?>
                                        <div class="thumbnail-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </a>
                                    
                                    <!-- شارة الفئة -->
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories) && !is_category()):
                                    ?>
                                    <div class="post-category">
                                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="category-badge">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- محتوى البطاقة -->
                                <div class="post-content">
                                    
                                    <!-- العنوان -->
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>" class="post-link">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <!-- المعلومات الوصفية -->
                                    <div class="post-meta">
                                        <span class="post-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                        </span>
                                        
                                        <?php if (!is_author()): ?>
                                        <span class="post-author">
                                            <i class="fas fa-user"></i>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                        <?php endif; ?>
                                        
                                        <span class="post-comments">
                                            <i class="fas fa-comments"></i>
                                            <?php comments_number('0', '1', '%'); ?>
                                        </span>
                                        
                                        <!-- مستوى الصعوبة -->
                                        <?php 
                                        $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
                                        if ($difficulty):
                                        ?>
                                        <span class="post-difficulty difficulty-<?php echo esc_attr($difficulty); ?>">
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
                                    
                                    <!-- المقطع -->
                                    <div class="post-excerpt">
                                        <?php 
                                        if (has_excerpt()) {
                                            the_excerpt();
                                        } else {
                                            echo wp_trim_words(get_the_content(), 20, '...');
                                        }
                                        ?>
                                    </div>
                                    
                                    <!-- العلامات -->
                                    <?php 
                                    $tags = get_the_tags();
                                    if ($tags && !is_tag()):
                                    ?>
                                    <div class="post-tags">
                                        <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                                            #<?php echo esc_html($tag->name); ?>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                                
                                <!-- تذييل البطاقة -->
                                <div class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        اقرأ المزيد
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                    
                                    <!-- أزرار المشاركة السريعة -->
                                    <div class="quick-share">
                                        <button class="share-btn" data-url="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>" title="مشاركة">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                        
                                        <?php if (function_exists('muhtawaa_bookmark_button')): ?>
                                            <?php echo muhtawaa_bookmark_button(get_the_ID()); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <!-- شريط التصفح -->
                <nav class="archive-pagination" role="navigation" aria-label="تصفح المقالات">
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
                
                <!-- رسالة عدم وجود مقالات -->
                <div class="no-posts-found">
                    <div class="no-posts-icon">
                        <i class="fas fa-folder-open fa-4x"></i>
                    </div>
                    <h3 class="no-posts-title">لا توجد مقالات</h3>
                    <p class="no-posts-message">
                        <?php
                        if (is_category()) {
                            echo 'لم يتم نشر أي مقالات في هذه الفئة بعد.';
                        } elseif (is_tag()) {
                            echo 'لم يتم العثور على مقالات تحمل هذه العلامة.';
                        } elseif (is_author()) {
                            echo 'لم ينشر هذا المؤلف أي مقالات بعد.';
                        } elseif (is_date()) {
                            echo 'لم يتم نشر أي مقالات في هذا التاريخ.';
                        } else {
                            echo 'لم يتم العثور على أي مقالات.';
                        }
                        ?>
                    </p>
                    
                    <div class="no-posts-actions">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                        
                        <?php if (!is_search()): ?>
                        <a href="<?php echo esc_url(home_url('/?s=')); ?>" class="btn btn-secondary">
                            <i class="fas fa-search"></i> البحث في الموقع
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
            <?php endif; ?>
            
        </div>
        
        <!-- الشريط الجانبي -->
        <?php if (is_active_sidebar('archive-sidebar')): ?>
        <aside class="archive-sidebar" role="complementary">
            <h3 class="sidebar-title">
                <i class="fas fa-list-ul"></i>
                معلومات إضافية
            </h3>
            <?php dynamic_sidebar('archive-sidebar'); ?>
        </aside>
        <?php endif; ?>
        
    </div>
</main>

<!-- معلومات منظمة للأرشيف (Schema.org) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "<?php echo esc_js(wp_strip_all_tags(get_the_archive_title())); ?>",
    "description": "<?php echo esc_js(wp_strip_all_tags(get_the_archive_description())); ?>",
    "url": "<?php echo esc_url(get_pagenum_link()); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "numberOfItems": <?php echo intval($wp_query->found_posts); ?>,
        "itemListElement": [
            <?php
            global $wp_query;
            $posts_array = $wp_query->posts;
            $schema_items = [];
            
            foreach ($posts_array as $index => $post) {
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
                
                // الحد من عدد العناصر في Schema
                if ($index >= 9) break;
            }
            
            echo implode(',', $schema_items);
            ?>
        ]
    }
}
</script>

<script>
jQuery(document).ready(function($) {
    'use strict';
    
    // تهيئة Masonry للعرض البلاطي
    function initMasonry() {
        const $grid = $('.posts-grid');
        if ($grid.hasClass('view-masonry')) {
            $grid.imagesLoaded(function() {
                $grid.masonry({
                    itemSelector: '.post-item',
                    columnWidth: '.grid-sizer',
                    percentPosition: true,
                    gutter: 20
                });
            });
        }
    }
    
    // تغيير طريقة العرض
    $('.view-btn').on('click', function() {
        const $btn = $(this);
        const view = $btn.data('view');
        const $grid = $('.posts-grid');
        
        // تحديث الأزرار
        $('.view-btn').removeClass('active');
        $btn.addClass('active');
        
        // تحديث العرض
        $grid.removeClass('view-grid view-list view-masonry')
             .addClass('view-' + view);
        
        // تطبيق Masonry إذا لزم الأمر
        if (view === 'masonry') {
            setTimeout(initMasonry, 100);
        } else if ($grid.data('masonry')) {
            $grid.masonry('destroy');
        }
        
        // حفظ التفضيل
        localStorage.setItem('archive_view', view);
    });
    
    // استرجاع التفضيل المحفوظ
    const savedView = localStorage.getItem('archive_view');
    if (savedView) {
        $(`.view-btn[data-view="${savedView}"]`).click();
    }
    
    // فلتر الترتيب
    $('#archive-sort').on('change', function() {
        const sortValue = $(this).val();
        const url = new URL(window.location);
        
        // تحديث معاملات URL
        if (sortValue === 'date_desc') {
            url.searchParams.delete('orderby');
            url.searchParams.delete('order');
        } else {
            const [orderby, order] = sortValue.split('_');
            url.searchParams.set('orderby', orderby);
            url.searchParams.set('order', order);
        }
        
        // إعادة التوجيه
        window.location.href = url.toString();
    });
    
    // فلتر التاريخ
    $('#archive-date').on('change', function() {
        const dateValue = $(this).val();
        const url = new URL(window.location);
        
        // تحديث معاملات URL
        if (dateValue) {
            url.searchParams.set('date_filter', dateValue);
        } else {
            url.searchParams.delete('date_filter');
        }
        
        // إعادة التوجيه
        window.location.href = url.toString();
    });
    
    // مشاركة سريعة
    $('.share-btn').on('click', function() {
        const url = $(this).data('url');
        const title = $(this).data('title');
        
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            });
        } else {
            // نسخ الرابط إلى الحافظة
            navigator.clipboard.writeText(url).then(() => {
                // إظهار إشعار
                if (window.MuhtawaaNotifications) {
                    window.MuhtawaaNotifications.success('تم نسخ الرابط إلى الحافظة');
                }
            });
        }
    });
    
    // تحسين التمرير اللامنتهي (اختياري)
    let isLoadingMore = false;
    
    function loadMorePosts() {
        if (isLoadingMore) return;
        
        const $pagination = $('.archive-pagination');
        const $nextLink = $pagination.find('.next');
        
        if (!$nextLink.length) return;
        
        isLoadingMore = true;
        
        // إظهار مؤشر التحميل
        $pagination.append('<div class="loading-more"><i class="fas fa-spinner fa-spin"></i> جاري التحميل...</div>');
        
        $.get($nextLink.attr('href'), function(data) {
            const $newPosts = $(data).find('.post-item');
            const $newPagination = $(data).find('.archive-pagination');
            
            // إضافة المقالات الجديدة
            $('.posts-grid').append($newPosts);
            
            // تحديث التصفح
            $pagination.replaceWith($newPagination);
            
            // تطبيق الحركات
            $newPosts.addClass('scroll-reveal').addClass('revealed');
            
            // إعادة تطبيق Masonry
            if ($('.posts-grid').hasClass('view-masonry')) {
                setTimeout(initMasonry, 100);
            }
            
            isLoadingMore = false;
        });
    }
    
    // التمرير اللامنتهي عند الوصول لنهاية الصفحة
    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1000) {
            loadMorePosts();
        }
    });
    
    // تهيئة Masonry للعرض الافتراضي
    initMasonry();
});
</script>

<?php get_footer(); ?>