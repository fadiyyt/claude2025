<?php
/**
 * قالب صفحة فئة الحلول
 * 
 * @package Muhtawaa
 */

get_header(); 

$current_term = get_queried_object();
$category_icon = muhtawaa_get_category_icon($current_term->name);
?>

<div class="category-page">
    <!-- Category Header -->
    <section class="category-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 0; text-align: center;">
        <div class="container">
            <div class="category-icon" style="font-size: 4rem; margin-bottom: 1rem;">
                <?php echo $category_icon; ?>
            </div>
            <h1 style="font-size: 3rem; margin-bottom: 1rem;">
                <?php echo $current_term->name; ?>
            </h1>
            <?php if ($current_term->description): ?>
                <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                    <?php echo $current_term->description; ?>
                </p>
            <?php endif; ?>
            <div style="margin-top: 2rem;">
                <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 25px;">
                    <?php echo $current_term->count; ?> حل متاح
                </span>
            </div>
        </div>
    </section>

    <!-- Category Solutions -->
    <section class="category-solutions" style="padding: 4rem 0; background: #f8f9fa;">
        <div class="container">
            
            <!-- Filters -->
            <div class="category-filters" style="background: white; padding: 2rem; border-radius: 15px; margin-bottom: 3rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom: 1rem; color: #333;">🔍 تصفية النتائج:</h3>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                    <select id="difficulty-filter" style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 25px; background: white;">
                        <option value="">جميع مستويات الصعوبة</option>
                        <option value="سهل جداً">سهل جداً</option>
                        <option value="سهل">سهل</option>
                        <option value="متوسط">متوسط</option>
                        <option value="صعب">صعب</option>
                    </select>
                    
                    <select id="sort-filter" style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 25px; background: white;">
                        <option value="date">الأحدث</option>
                        <option value="popular">الأكثر شعبية</option>
                        <option value="title">الترتيب الأبجدي</option>
                    </select>
                    
                    <button onclick="applyFilters()" style="background: #667eea; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 25px; cursor: pointer;">
                        تطبيق الفلتر
                    </button>
                    
                    <button onclick="clearFilters()" style="background: #6c757d; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 25px; cursor: pointer;">
                        مسح الفلاتر
                    </button>
                </div>
            </div>

            <!-- Solutions Grid -->
            <div class="solutions-grid" id="category-solutions-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true) ?: 'سهل';
                        $time_needed = get_post_meta(get_the_ID(), '_solution_time', true);
                        $post_views = get_post_meta(get_the_ID(), '_total_views', true) ?: 0;
                        $helpful_count = get_post_meta(get_the_ID(), '_helpful_count', true) ?: 0;
                        ?>
                        <article class="solution-card" data-difficulty="<?php echo $difficulty; ?>" data-date="<?php echo get_the_date('Y-m-d'); ?>" data-views="<?php echo $post_views; ?>">
                            <div class="solution-image" style="height: 200px;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('solution-thumbnail', array('alt' => get_the_title())); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" style="color: white; text-decoration: none; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                                        <?php echo $category_icon; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="solution-content">
                                <h3 class="solution-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="solution-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                                <div class="solution-meta">
                                    <div class="meta-left">
                                        <span class="meta-time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> مضت</span>
                                        <?php if ($time_needed): ?>
                                            <span class="meta-duration">⏱️ <?php echo $time_needed; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="meta-right">
                                        <span class="difficulty" style="background-color: <?php echo muhtawaa_get_difficulty_color($difficulty); ?>; color: white;">
                                            <?php echo $difficulty; ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <?php if ($post_views > 0 || $helpful_count > 0): ?>
                                    <div class="solution-stats" style="margin-top: 0.5rem; font-size: 0.8rem; color: #888; display: flex; gap: 1rem;">
                                        <?php if ($post_views > 0): ?>
                                            <span>👀 <?php echo $post_views; ?> مشاهدة</span>
                                        <?php endif; ?>
                                        <?php if ($helpful_count > 0): ?>
                                            <span>👍 <?php echo $helpful_count; ?> مفيد</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    
                    // Pagination
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '← السابق',
                        'next_text' => 'التالي →',
                        'screen_reader_text' => 'التنقل بين الصفحات'
                    ));
                    
                else:
                    ?>
                    <div class="no-solutions" style="text-align: center; padding: 4rem; grid-column: 1 / -1;">
                        <div style="font-size: 4rem; margin-bottom: 2rem; color: #dee2e6;">
                            <?php echo $category_icon; ?>
                        </div>
                        <h3 style="color: #6c757d; margin-bottom: 1rem;">لا توجد حلول في هذه الفئة بعد</h3>
                        <p>نعمل على إضافة حلول جديدة لهذه الفئة قريباً!</p>
                        <a href="<?php echo home_url(); ?>" class="category-link" style="margin-top: 1rem; display: inline-block;">
                            تصفح جميع الحلول
                        </a>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            
            <!-- Back to Categories -->
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo home_url(); ?>" class="category-link" style="margin-left: 1rem;">
                    🏠 العودة للرئيسية
                </a>
                <a href="<?php echo home_url('/?show_categories=1'); ?>" class="category-link">
                    🗂️ جميع الفئات
                </a>
            </div>
        </div>
    </section>

    <!-- Related Categories -->
    <section class="related-categories" style="padding: 3rem 0; background: white;">
        <div class="container">
            <h3 style="text-align: center; margin-bottom: 2rem; color: #333;">فئات أخرى قد تهمك</h3>
            <div class="categories-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <?php
                $related_categories = get_terms(array(
                    'taxonomy' => 'solution_category',
                    'hide_empty' => true,
                    'exclude' => array($current_term->term_id),
                    'number' => 4
                ));
                
                if ($related_categories && !is_wp_error($related_categories)) {
                    foreach ($related_categories as $category) {
                        $icon = muhtawaa_get_category_icon($category->name);
                        ?>
                        <div class="category-card" style="padding: 1.5rem; text-align: center;">
                            <div class="category-icon" style="font-size: 2.5rem; margin-bottom: 1rem;"><?php echo $icon; ?></div>
                            <h4 style="margin-bottom: 0.5rem;"><?php echo $category->name; ?></h4>
                            <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;"><?php echo $category->count; ?> حل</p>
                            <a href="<?php echo get_term_link($category); ?>" class="category-link">تصفح</a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
</div>

<script>
// فلترة الحلول
function applyFilters() {
    const difficulty = document.getElementById('difficulty-filter').value;
    const sort = document.getElementById('sort-filter').value;
    const solutions = document.querySelectorAll('.solution-card');
    const grid = document.getElementById('category-solutions-grid');
    
    // تصفية حسب الصعوبة
    let visibleSolutions = Array.from(solutions);
    
    if (difficulty) {
        visibleSolutions = visibleSolutions.filter(card => {
            return card.dataset.difficulty === difficulty;
        });
    }
    
    // إخفاء/إظهار الحلول
    solutions.forEach(card => {
        if (visibleSolutions.includes(card)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    
    // ترتيب النتائج
    if (sort === 'popular') {
        visibleSolutions.sort((a, b) => {
            return parseInt(b.dataset.views || 0) - parseInt(a.dataset.views || 0);
        });
    } else if (sort === 'title') {
        visibleSolutions.sort((a, b) => {
            const titleA = a.querySelector('.solution-title a').textContent;
            const titleB = b.querySelector('.solution-title a').textContent;
            return titleA.localeCompare(titleB, 'ar');
        });
    } else if (sort === 'date') {
        visibleSolutions.sort((a, b) => {
            return new Date(b.dataset.date) - new Date(a.dataset.date);
        });
    }
    
    // إعادة ترتيب العناصر في DOM
    visibleSolutions.forEach(card => {
        grid.appendChild(card);
    });
    
    // إظهار رسالة إذا لم توجد نتائج
    const visibleCount = visibleSolutions.length;
    const existingMessage = document.querySelector('.no-filtered-results');
    
    if (visibleCount === 0) {
        if (!existingMessage) {
            const message = document.createElement('div');
            message.className = 'no-filtered-results';
            message.style.cssText = 'grid-column: 1 / -1; text-align: center; padding: 2rem; color: #6c757d;';
            message.innerHTML = '<h4>لا توجد حلول تطابق الفلاتر المحددة</h4><p>جرب تغيير الفلاتر أو مسحها</p>';
            grid.appendChild(message);
        }
    } else {
        if (existingMessage) {
            existingMessage.remove();
        }
    }
    
    // إظهار عدد النتائج
    showResultsCount(visibleCount);
}

function clearFilters() {
    document.getElementById('difficulty-filter').value = '';
    document.getElementById('sort-filter').value = 'date';
    
    const solutions = document.querySelectorAll('.solution-card');
    solutions.forEach(card => {
        card.style.display = 'block';
    });
    
    const message = document.querySelector('.no-filtered-results');
    if (message) {
        message.remove();
    }
    
    const resultsCount = document.querySelector('.results-count');
    if (resultsCount) {
        resultsCount.remove();
    }
    
    applyFilters(); // إعادة الترتيب الافتراضي
}

function showResultsCount(count) {
    const existingCount = document.querySelector('.results-count');
    if (existingCount) {
        existingCount.remove();
    }
    
    if (count > 0) {
        const countDiv = document.createElement('div');
        countDiv.className = 'results-count';
        countDiv.style.cssText = 'text-align: center; margin-bottom: 2rem; color: #667eea; font-weight: bold;';
        countDiv.textContent = `تم العثور على ${count} حل`;
        
        const grid = document.getElementById('category-solutions-grid');
        grid.parentNode.insertBefore(countDiv, grid);
    }
}

// تشغيل الفلتر عند تغيير القيم
document.getElementById('difficulty-filter').addEventListener('change', applyFilters);
document.getElementById('sort-filter').addEventListener('change', applyFilters);
</script>

<?php get_footer(); ?>