<?php
/**
 * الصفحة الرئيسية لقالب محتوى
 * 
 * @package Muhtawaa
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>🏠 حلول ذكية لحياة أسهل</h1>
        <p>اكتشف آلاف الحلول العملية للمشاكل اليومية في منزلك ومطبخك وحياتك</p>
        
        <div class="stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo wp_count_posts()->publish; ?>+</span>
                <span class="stat-label">حل عملي</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">
                    <?php
                    // حساب إجمالي المشاهدات
                    global $wpdb;
                    $total_views = $wpdb->get_var("
                        SELECT SUM(CAST(meta_value AS UNSIGNED)) 
                        FROM {$wpdb->postmeta} 
                        WHERE meta_key = '_total_views'
                    ");
                    echo $total_views > 1000 ? round($total_views/1000) . 'K' : ($total_views ?: '50K');
                    ?>+
                </span>
                <span class="stat-label">زائر شهرياً</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">95%</span>
                <span class="stat-label">حلول مجربة</span>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories">
    <div class="container">
        <h2 class="section-title">🗂️ تصفح حسب الفئة</h2>
        
        <div class="categories-grid">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'solution_category',
                'hide_empty' => false,
                'orderby' => 'count',
                'order' => 'DESC'
            ));
            
            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    $icon = muhtawaa_get_category_icon($category->name);
                    $post_count = $category->count;
                    $category_link = get_term_link($category);
                    ?>
                    <div class="category-card">
                        <div class="category-icon"><?php echo $icon; ?></div>
                        <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                        <p class="category-count"><?php echo $post_count; ?>+ حل</p>
                        <?php if ($category->description): ?>
                            <p class="category-description" style="color: #888; font-size: 0.9rem; margin-bottom: 1rem;">
                                <?php echo esc_html($category->description); ?>
                            </p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($category_link); ?>" class="category-link">تصفح الحلول</a>
                    </div>
                    <?php
                }
            } else {
                // عرض فئات افتراضية إذا لم توجد فئات
                $default_categories = array(
                    array('name' => 'المنزل والتنظيف', 'icon' => '🏠', 'count' => 0),
                    array('name' => 'المطبخ والطبخ', 'icon' => '🍳', 'count' => 0),
                    array('name' => 'توفير المال', 'icon' => '💰', 'count' => 0),
                    array('name' => 'السيارات', 'icon' => '🚗', 'count' => 0),
                    array('name' => 'التكنولوجيا', 'icon' => '📱', 'count' => 0),
                    array('name' => 'الطقس والمناخ', 'icon' => '🌡️', 'count' => 0),
                );
                
                foreach ($default_categories as $category): ?>
                    <div class="category-card">
                        <div class="category-icon"><?php echo $category['icon']; ?></div>
                        <h3 class="category-title"><?php echo $category['name']; ?></h3>
                        <p class="category-count"><?php echo $category['count']; ?> حل</p>
                        <a href="#" class="category-link">قريباً</a>
                    </div>
                <?php endforeach;
            }
            ?>
        </div>
    </div>
</section>

<!-- Recent Solutions -->
<section class="recent-solutions">
    <div class="container">
        <h2 class="section-title">✨ أحدث الحلول</h2>
        
        <div class="solutions-grid">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 6,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true) ?: 'سهل';
                    $time_needed = get_post_meta(get_the_ID(), '_solution_time', true);
                    $post_views = get_post_meta(get_the_ID(), '_total_views', true) ?: 0;
                    
                    // الحصول على الفئة الأولى
                    $categories = get_the_terms(get_the_ID(), 'solution_category');
                    $category_name = '';
                    if ($categories && !is_wp_error($categories)) {
                        $category_name = $categories[0]->name;
                    }
                    ?>
                    <article class="solution-card">
                        <div class="solution-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('solution-thumbnail', array('alt' => get_the_title())); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" style="color: white; text-decoration: none;">
                                    <?php echo muhtawaa_get_category_icon($category_name); ?>
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
                            
                            <?php if ($post_views > 0): ?>
                                <div class="solution-stats" style="margin-top: 0.5rem; font-size: 0.8rem; color: #888;">
                                    👀 <?php echo $post_views; ?> مشاهدة
                                    <?php
                                    $helpful_count = get_post_meta(get_the_ID(), '_helpful_count', true);
                                    if ($helpful_count > 0):
                                    ?>
                                        | 👍 <?php echo $helpful_count; ?> مفيد
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <div class="no-solutions" style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">📝</div>
                    <h3>لا توجد حلول منشورة بعد</h3>
                    <p>نعمل على إضافة أفضل الحلول العملية قريباً!</p>
                    <?php if (current_user_can('publish_posts')): ?>
                        <a href="<?php echo admin_url('post-new.php'); ?>" class="category-link" style="margin-top: 1rem; display: inline-block;">
                            إضافة حل جديد
                        </a>
                    <?php endif; ?>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <?php if ($recent_posts->found_posts > 6): ?>
            <div class="load-more-container" style="text-align: center; margin-top: 2rem;">
                <button id="load-more-solutions" class="category-link" style="border: none; cursor: pointer;">
                    تحميل المزيد من الحلول
                </button>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Popular Solutions -->
<?php
$popular_posts = new WP_Query(array(
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'meta_key' => '_total_views',
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
));

if ($popular_posts->have_posts() && $popular_posts->found_posts > 0):
?>
<section class="popular-solutions" style="padding: 4rem 0; background: white;">
    <div class="container">
        <h2 class="section-title">🔥 الحلول الأكثر شعبية</h2>
        
        <div class="solutions-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
            <?php
            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true) ?: 'سهل';
                $views = get_post_meta(get_the_ID(), '_total_views', true) ?: 0;
                $helpful = get_post_meta(get_the_ID(), '_helpful_count', true) ?: 0;
                ?>
                <article class="solution-card">
                    <div class="solution-image" style="height: 150px;">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('solution-thumbnail', array('alt' => get_the_title())); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" style="color: white; text-decoration: none;">
                                🌟
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="solution-content">
                        <h3 class="solution-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="solution-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </p>
                        <div class="solution-meta">
                            <span class="difficulty" style="background-color: <?php echo muhtawaa_get_difficulty_color($difficulty); ?>; color: white;">
                                <?php echo $difficulty; ?>
                            </span>
                        </div>
                        <div class="solution-stats" style="margin-top: 0.5rem; font-size: 0.8rem; color: #888;">
                            👀 <?php echo $views; ?> مشاهدة
                            <?php if ($helpful > 0): ?>
                                | 👍 <?php echo $helpful; ?> مفيد
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Tips Section -->
<section class="tips-section" style="padding: 4rem 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
            <h2 class="section-title">💡 نصيحة اليوم</h2>
            <div id="daily-tip" style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                <?php
                // عرض نصيحة عشوائية
                $random_tip = get_posts(array(
                    'posts_per_page' => 1,
                    'orderby' => 'rand',
                    'meta_query' => array(
                        array(
                            'key' => '_solution_difficulty',
                            'value' => array('سهل جداً', 'سهل'),
                            'compare' => 'IN'
                        )
                    )
                ));
                
                if ($random_tip):
                    $tip = $random_tip[0];
                    ?>
                    <h3 style="color: #667eea; margin-bottom: 1rem;"><?php echo $tip->post_title; ?></h3>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        <?php echo wp_trim_words($tip->post_content, 30, '...'); ?>
                    </p>
                    <a href="<?php echo get_permalink($tip->ID); ?>" class="category-link">
                        اقرأ الحل كاملاً
                    </a>
                    <?php
                    wp_reset_postdata();
                else:
                    ?>
                    <h3 style="color: #667eea; margin-bottom: 1rem;">💡 نصيحة سريعة</h3>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!
                    </p>
                    <button class="category-link" onclick="loadRandomTip()" style="border: none; cursor: pointer;">
                        نصيحة أخرى
                    </button>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section" style="padding: 4rem 0; background: white; text-align: center;">
    <div class="container">
        <h2 style="color: #333; margin-bottom: 1rem;">هل لديك حل عملي تود مشاركته؟</h2>
        <p style="color: #666; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
            شاركنا حلولك العملية المجربة وساعد الآلاف من الأشخاص في حل مشاكلهم اليومية
        </p>
        <a href="<?php echo home_url('/contact'); ?>" class="category-link" style="margin-left: 1rem;">
            شارك حلك معنا
        </a>
        <?php if (current_user_can('publish_posts')): ?>
            <a href="<?php echo admin_url('post-new.php'); ?>" class="category-link" style="background: #48bb78;">
                إضافة حل جديد
            </a>
        <?php endif; ?>
    </div>
</section>

<script>
// تحميل نصيحة عشوائية
function loadRandomTip() {
    const tipContainer = document.getElementById('daily-tip');
    const originalContent = tipContainer.innerHTML;
    
    tipContainer.innerHTML = '<div style="text-align: center; padding: 2rem;"><div class="loading-spinner"></div><p>جاري تحميل نصيحة جديدة...</p></div>';
    
    fetch(muhtawaa_ajax.ajax_url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=get_random_tip&nonce=' + muhtawaa_ajax.nonce
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            tipContainer.innerHTML = `
                <h3 style="color: #667eea; margin-bottom: 1rem;">${data.data.title}</h3>
                <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">${data.data.content}</p>
                <a href="${data.data.url}" class="category-link">اقرأ الحل كاملاً</a>
                <button class="category-link" onclick="loadRandomTip()" style="border: none; cursor: pointer; margin-right: 1rem; background: #48bb78;">
                    نصيحة أخرى
                </button>
            `;
        } else {
            tipContainer.innerHTML = originalContent;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        tipContainer.innerHTML = originalContent;
    });
}

// متغير لتتبع الصفحة الحالية
let currentPage = 1;

// تحميل المزيد من الحلول
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-solutions');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            currentPage++;
            const button = this;
            const originalText = button.textContent;
            
            button.innerHTML = '<div class="loading-spinner" style="display: inline-block; margin-left: 10px;"></div> جاري التحميل...';
            button.disabled = true;
            
            fetch(muhtawaa_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=load_more_solutions&page=${currentPage}&nonce=${muhtawaa_ajax.nonce}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data.html) {
                    const solutionsGrid = document.querySelector('.recent-solutions .solutions-grid');
                    solutionsGrid.insertAdjacentHTML('beforeend', data.data.html);
                    
                    if (!data.data.has_more) {
                        button.style.display = 'none';
                        solutionsGrid.insertAdjacentHTML('afterend', '<p class="no-more-solutions" style="text-align: center; margin-top: 2rem; color: #999;">لا توجد حلول أخرى 😊</p>');
                    } else {
                        button.textContent = originalText;
                        button.disabled = false;
                    }
                } else {
                    button.textContent = originalText;
                    button.disabled = false;
                    currentPage--; // إرجاع رقم الصفحة
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.textContent = originalText;
                button.disabled = false;
                currentPage--;
            });
        });
    }
});
</script>

<?php get_footer(); ?>