<?php
/**
 * صفحة المقال الواحد لقالب محتوى
 * 
 * @package Muhtawaa
 */

get_header(); ?>

<div class="container" style="padding: 2rem 0;">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="single-solution">
        <article id="post-<?php the_ID(); ?>" <?php post_class('solution-full'); ?> itemscope itemtype="https://schema.org/HowTo">
            
            <!-- Solution Header -->
            <header class="solution-header">
                <div class="solution-category" style="margin-bottom: 1rem;">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'solution_category');
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $icon = muhtawaa_get_category_icon($category->name);
                            echo '<a href="' . get_term_link($category) . '" class="category-badge" style="background: #667eea; color: white; padding: 0.5rem 1rem; border-radius: 20px; text-decoration: none; font-size: 0.9rem; display: inline-block; margin-left: 0.5rem;">';
                            echo $icon . ' ' . $category->name;
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
                
                <h1 class="solution-title" style="font-size: 2.5rem; color: #333; margin-bottom: 1rem; line-height: 1.3;" itemprop="name">
                    <?php the_title(); ?>
                </h1>
                
                <!-- Solution Meta Information -->
                <div class="solution-meta-full" style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; align-items: center;">
                    <span class="meta-item" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 20px; font-size: 0.9rem;">
                        <i class="fas fa-calendar" style="color: #667eea;"></i>
                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                            <?php echo get_the_date(); ?>
                        </time>
                    </span>
                    
                    <?php 
                    $time_needed = get_post_meta(get_the_ID(), '_solution_time', true);
                    if ($time_needed): ?>
                        <span class="meta-item" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 20px; font-size: 0.9rem;" itemprop="totalTime" content="<?php echo $time_needed; ?>">
                            <i class="fas fa-clock" style="color: #48bb78;"></i>
                            <?php echo $time_needed; ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php 
                    $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
                    if ($difficulty): ?>
                        <span class="meta-item difficulty-badge" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; background-color: <?php echo muhtawaa_get_difficulty_color($difficulty); ?>; color: white;" itemprop="difficulty">
                            <i class="fas fa-signal" style="transform: rotate(45deg);"></i>
                            <?php echo $difficulty; ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php 
                    $cost = get_post_meta(get_the_ID(), '_solution_cost', true);
                    if ($cost): ?>
                        <span class="meta-item" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-coins" style="color: #ed8936;"></i>
                            <?php echo $cost; ?>
                        </span>
                    <?php endif; ?>
                    
                    <!-- View Count -->
                    <?php 
                    $views = get_post_meta(get_the_ID(), '_total_views', true);
                    if ($views && $views > 0): ?>
                        <span class="meta-item" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-eye" style="color: #6c757d;"></i>
                            <?php echo number_format($views); ?> مشاهدة
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Materials Needed -->
                <?php 
                $materials = get_post_meta(get_the_ID(), '_solution_materials', true);
                if ($materials): ?>
                    <div class="materials-needed" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem; border-right: 4px solid #667eea;">
                        <h3 style="color: #667eea; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-tools"></i>
                            المواد والأدوات المطلوبة:
                        </h3>
                        <div class="materials-list" itemprop="supply">
                            <?php
                            $materials_array = explode("\n", $materials);
                            echo '<ul style="margin: 0; padding-right: 1.5rem; line-height: 1.8;">';
                            foreach ($materials_array as $material) {
                                $material = trim($material);
                                if (!empty($material)) {
                                    echo '<li style="margin-bottom: 0.5rem;">' . esc_html($material) . '</li>';
                                }
                            }
                            echo '</ul>';
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Favorite Button -->
                <div class="solution-actions" style="margin-bottom: 2rem;">
                    <button class="favorite-btn" data-post-id="<?php the_ID(); ?>" onclick="toggleFavorite(<?php the_ID(); ?>)" style="background: #f8f9fa; border: 1px solid #dee2e6; color: #6c757d; padding: 0.75rem 1.5rem; border-radius: 25px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-heart"></i>
                        <span>حفظ في المفضلة</span>
                    </button>
                </div>
            </header>
            
            <!-- Featured Image -->
            <?php if (has_post_thumbnail()): ?>
                <div class="solution-featured-image" style="margin-bottom: 2rem; text-align: center;">
                    <?php the_post_thumbnail('solution-large', array(
                        'style' => 'max-width: 100%; height: auto; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);',
                        'alt' => get_the_title(),
                        'itemprop' => 'image'
                    )); ?>
                </div>
            <?php endif; ?>
            
            <!-- Solution Content -->
            <div class="solution-content" style="font-size: 1.1rem; line-height: 1.8; color: #444; margin-bottom: 3rem;" itemprop="text">
                <?php 
                $content = get_the_content();
                $content = apply_filters('the_content', $content);
                
                // تحسين المحتوى لإضافة خطوات مرقمة تلقائياً
                $steps = explode("\n\n", $content);
                if (count($steps) > 1) {
                    echo '<div class="solution-steps" itemprop="recipeInstructions">';
                    $step_number = 1;
                    foreach ($steps as $step) {
                        $step = trim($step);
                        if (!empty($step) && strlen($step) > 50) { // خطوة حقيقية وليس فقرة قصيرة
                            echo '<div class="solution-step" style="margin-bottom: 2rem; padding: 1.5rem; background: #fff; border: 1px solid #e9ecef; border-radius: 15px; border-right: 4px solid #667eea;" itemscope itemtype="https://schema.org/HowToStep">';
                            echo '<div class="step-number" style="display: inline-flex; align-items: center; justify-content: center; width: 35px; height: 35px; background: #667eea; color: white; border-radius: 50%; font-weight: bold; margin-bottom: 1rem;">' . $step_number . '</div>';
                            echo '<div class="step-content" itemprop="text">' . $step . '</div>';
                            echo '</div>';
                            $step_number++;
                        } else {
                            echo '<div class="solution-paragraph" style="margin-bottom: 1.5rem;">' . $step . '</div>';
                        }
                    }
                    echo '</div>';
                } else {
                    echo $content;
                }
                ?>
            </div>
            
            <!-- Tags -->
            <?php if (has_tag()): ?>
                <div class="solution-tags" style="margin-bottom: 2rem;">
                    <h4 style="color: #667eea; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-tags"></i>
                        كلمات مفتاحية:
                    </h4>
                    <div class="tags-list">
                        <?php
                        $tags = get_the_tags();
                        foreach ($tags as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-link" style="display: inline-block; background: #f8f9fa; color: #6c757d; padding: 0.5rem 1rem; margin: 0 0.5rem 0.5rem 0; border-radius: 20px; text-decoration: none; font-size: 0.9rem; transition: all 0.3s;">';
                            echo '#' . $tag->name;
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Solution Footer -->
            <footer class="solution-footer" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #f8f9fa;">
                
                <!-- Rating Section -->
                <div class="solution-rating" style="text-align: center; margin-bottom: 2rem; padding: 2rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px;">
                    <h4 style="color: #333; margin-bottom: 1rem;">هل كان هذا الحل مفيداً لك؟</h4>
                    <p style="color: #6c757d; margin-bottom: 1.5rem; font-size: 0.9rem;">تقييمك يساعدنا في تحسين المحتوى وتقديم حلول أفضل</p>
                    
                    <div class="rating-buttons" style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <button onclick="rateSolution('helpful')" class="rating-btn helpful" style="background: #28a745; color: white; border: none; padding: 1rem 2rem; border-radius: 25px; cursor: pointer; font-size: 1rem; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;">
                            <i class="fas fa-thumbs-up"></i>
                            <span>مفيد جداً</span>
                        </button>
                        <button onclick="rateSolution('not-helpful')" class="rating-btn not-helpful" style="background: #dc3545; color: white; border: none; padding: 1rem 2rem; border-radius: 25px; cursor: pointer; font-size: 1rem; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s;">
                            <i class="fas fa-thumbs-down"></i>
                            <span>غير مفيد</span>
                        </button>
                    </div>
                    
                    <!-- Rating Stats -->
                    <?php
                    $helpful_count = get_post_meta(get_the_ID(), '_helpful_count', true) ?: 0;
                    $not_helpful_count = get_post_meta(get_the_ID(), '_not_helpful_count', true) ?: 0;
                    $total_votes = $helpful_count + $not_helpful_count;
                    
                    if ($total_votes > 0):
                        $helpful_percentage = round(($helpful_count / $total_votes) * 100);
                        ?>
                        <div class="rating-stats" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; margin-bottom: 1rem;">
                                <span style="color: #28a745; font-weight: bold;">
                                    👍 <?php echo $helpful_count; ?> مفيد
                                </span>
                                <span style="color: #dc3545; font-weight: bold;">
                                    👎 <?php echo $not_helpful_count; ?> غير مفيد
                                </span>
                            </div>
                            <div class="rating-bar" style="background: #e9ecef; height: 10px; border-radius: 5px; overflow: hidden; max-width: 300px; margin: 0 auto;">
                                <div style="background: #28a745; height: 100%; width: <?php echo $helpful_percentage; ?>%; transition: width 0.3s;"></div>
                            </div>
                            <p style="margin-top: 0.5rem; color: #6c757d; font-size: 0.9rem;">
                                <?php echo $helpful_percentage; ?>% من القراء وجدوا هذا الحل مفيداً
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Share Buttons -->
                <div class="share-buttons" style="text-align: center; margin-bottom: 2rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">شارك هذا الحل مع أصدقائك:</h4>
                    <div class="share-links" style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title() . ' - ' . wp_trim_words(get_the_excerpt(), 15)); ?>&url=<?php echo urlencode(get_permalink()); ?>&hashtags=حلول_يومية,نصائح" 
                           target="_blank" rel="noopener" class="share-btn twitter" 
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #1da1f2; color: white; text-decoration: none; border-radius: 25px; transition: all 0.3s;"
                           aria-label="مشاركة على تويتر">
                            <i class="fab fa-twitter"></i>
                            <span>تويتر</span>
                        </a>
                        
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                           target="_blank" rel="noopener" class="share-btn facebook" 
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #4267B2; color: white; text-decoration: none; border-radius: 25px; transition: all 0.3s;"
                           aria-label="مشاركة على فيسبوك">
                            <i class="fab fa-facebook"></i>
                            <span>فيسبوك</span>
                        </a>
                        
                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                           target="_blank" rel="noopener" class="share-btn whatsapp" 
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #25D366; color: white; text-decoration: none; border-radius: 25px; transition: all 0.3s;"
                           aria-label="مشاركة على واتساب">
                            <i class="fab fa-whatsapp"></i>
                            <span>واتساب</span>
                        </a>
                        
                        <button onclick="copyToClipboard()" class="share-btn copy" 
                                style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #6c757d; color: white; border: none; border-radius: 25px; cursor: pointer; transition: all 0.3s;"
                                aria-label="نسخ الرابط">
                            <i class="fas fa-link"></i>
                            <span>نسخ الرابط</span>
                        </button>
                    </div>
                </div>
                
                <!-- Author Info -->
                <div class="author-info" style="background: #f8f9fa; padding: 2rem; border-radius: 15px; margin-bottom: 2rem; text-align: center;">
                    <div class="author-avatar" style="margin-bottom: 1rem;">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80, '', get_the_author(), array('style' => 'border-radius: 50%; border: 3px solid #667eea;')); ?>
                    </div>
                    <h4 style="color: #333; margin-bottom: 0.5rem;">
                        بقلم: <?php the_author(); ?>
                    </h4>
                    <?php if (get_the_author_meta('description')): ?>
                        <p style="color: #6c757d; font-size: 0.9rem; max-width: 400px; margin: 0 auto;">
                            <?php echo get_the_author_meta('description'); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </footer>
        </article>
        
        <!-- Related Solutions -->
        <section class="related-solutions" style="margin-top: 4rem;">
            <h3 style="text-align: center; margin-bottom: 2rem; color: #333; font-size: 2rem;">
                🔗 حلول مشابهة قد تهمك
            </h3>
            
            <div class="solutions-grid">
                <?php
                // البحث عن المقالات المشابهة
                $related_args = array(
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'meta_query' => array(
                        array(
                            'key' => '_solution_difficulty',
                            'value' => $difficulty ?: 'سهل',
                            'compare' => '='
                        )
                    )
                );
                
                // إذا لم توجد مقالات بنفس الصعوبة، ابحث في نفس الفئة
                $related = new WP_Query($related_args);
                
                if (!$related->have_posts() && $categories) {
                    $related_args = array(
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution_category',
                                'field' => 'term_id',
                                'terms' => $categories[0]->term_id,
                            )
                        )
                    );
                    $related = new WP_Query($related_args);
                }
                
                // إذا لم توجد مقالات مشابهة، أحضر أي مقالات حديثة
                if (!$related->have_posts()) {
                    $related_args = array(
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $related = new WP_Query($related_args);
                }
                
                if ($related->have_posts()) {
                    while ($related->have_posts()) {
                        $related->the_post();
                        $related_difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true) ?: 'سهل';
                        ?>
                        <article class="solution-card">
                            <div class="solution-image" style="height: 200px;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('solution-thumbnail', array('alt' => get_the_title())); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" style="color: white; text-decoration: none; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                                        💡
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
                                    <span class="meta-time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> مضت</span>
                                    <span class="difficulty" style="background-color: <?php echo muhtawaa_get_difficulty_color($related_difficulty); ?>; color: white;">
                                        <?php echo $related_difficulty; ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p style="text-align: center; color: #6c757d; grid-column: 1 / -1;">لا توجد حلول مشابهة حالياً</p>';
                }
                ?>
            </div>
        </section>
        
        <!-- Comments Section -->
        <?php
        if (comments_open() || get_comments_number()) {
            echo '<section class="comments-section" style="margin-top: 4rem; padding: 2rem; background: #f8f9fa; border-radius: 15px;">';
            echo '<h3 style="text-align: center; margin-bottom: 2rem; color: #333;">💬 التعليقات والتجارب</h3>';
            comments_template();
            echo '</section>';
        }
        ?>
    </div>
    
    <?php endwhile; endif; ?>
    
</div>

<!-- Navigation between posts -->
<div class="post-navigation" style="background: white; padding: 2rem 0; border-top: 1px solid #e9ecef;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div class="nav-previous">
                <?php 
                $prev_post = get_previous_post();
                if ($prev_post): ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link prev" style="display: flex; align-items: center; gap: 0.5rem; color: #667eea; text-decoration: none; padding: 1rem; border: 1px solid #e9ecef; border-radius: 10px; transition: all 0.3s;">
                        <i class="fas fa-arrow-right"></i>
                        <div>
                            <div style="font-size: 0.8rem; color: #6c757d;">الحل السابق</div>
                            <div style="font-weight: bold;"><?php echo wp_trim_words($prev_post->post_title, 8); ?></div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="nav-home">
                <a href="<?php echo home_url(); ?>" class="nav-link home" style="display: flex; align-items: center; gap: 0.5rem; color: #667eea; text-decoration: none; padding: 1rem; border: 1px solid #e9ecef; border-radius: 10px; transition: all 0.3s;">
                    <i class="fas fa-home"></i>
                    <span>جميع الحلول</span>
                </a>
            </div>
            
            <div class="nav-next">
                <?php 
                $next_post = get_next_post();
                if ($next_post): ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link next" style="display: flex; align-items: center; gap: 0.5rem; color: #667eea; text-decoration: none; padding: 1rem; border: 1px solid #e9ecef; border-radius: 10px; transition: all 0.3s;">
                        <div style="text-align: left;">
                            <div style="font-size: 0.8rem; color: #6c757d;">الحل التالي</div>
                            <div style="font-weight: bold;"><?php echo wp_trim_words($next_post->post_title, 8); ?></div>
                        </div>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
/* تحسينات CSS إضافية لصفحة المقال */
.single-solution {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 2rem;
}

.solution-step {
    position: relative;
}

.solution-step::before {
    content: '';
    position: absolute;
    right: 17px;
    top: 60px;
    bottom: -30px;
    width: 2px;
    background: linear-gradient(to bottom, #667eea, transparent);
}

.solution-step:last-child::before {
    display: none;
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.rating-btn:hover {
    transform: scale(1.05);
}

.rating-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.tag-link:hover {
    background: #667eea;
    color: white;
}

.nav-link:hover {
    border-color: #667eea;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
}

/* تحسينات الموبايل */
@media (max-width: 768px) {
    .single-solution {
        margin: 1rem;
        padding: 1.5rem;
        border-radius: 10px;
    }
    
    .solution-title {
        font-size: 2rem !important;
    }
    
    .solution-meta-full {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .share-links {
        flex-direction: column;
        align-items: center;
    }
    
    .share-btn {
        width: 200px;
        justify-content: center;
    }
    
    .post-navigation > div > div {
        flex-direction: column;
    }
    
    .nav-link {
        width: 100%;
        justify-content: center;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .solution-title {
        font-size: 1.5rem !important;
    }
    
    .solutions-grid {
        grid-template-columns: 1fr;
    }
    
    .rating-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .rating-btn {
        width: 200px;
        justify-content: center;
    }
}
</style>

<script>
// تقييم الحلول
function rateSolution(rating) {
    const helpfulBtn = document.querySelector('.rating-btn.helpful');
    const notHelpfulBtn = document.querySelector('.rating-btn.not-helpful');
    
    // تعطيل الأزرار مؤقتاً
    helpfulBtn.disabled = true;
    notHelpfulBtn.disabled = true;
    
    fetch(muhtawaa_ajax.ajax_url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=rate_solution&post_id=<?php echo get_the_ID(); ?>&rating=${rating}&nonce=${muhtawaa_ajax.nonce}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // إظهار رسالة شكر
            const ratingSection = document.querySelector('.solution-rating');
            ratingSection.innerHTML = `
                <div style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🙏</div>
                    <h4 style="color: #28a745; margin-bottom: 0.5rem;">شكراً لك على التقييم!</h4>
                    <p style="color: #6c757d;">تقييمك يساعدنا في تحسين المحتوى وتقديم حلول أفضل</p>
                </div>
            `;
            
            // حفظ التقييم في localStorage لمنع التقييم المتكرر
            localStorage.setItem('rated_post_<?php echo get_the_ID(); ?>', rating);
            
            showNotification('تم حفظ تقييمك بنجاح! 🎉', 'success');
        } else {
            showNotification(data.data || 'حدث خطأ في التقييم', 'error');
            // إعادة تمكين الأزرار
            helpfulBtn.disabled = false;
            notHelpfulBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Rating error:', error);
        showNotification('حدث خطأ في الاتصال', 'error');
        helpfulBtn.disabled = false;
        notHelpfulBtn.disabled = false;
    });
}

// نسخ الرابط
function copyToClipboard() {
    const url = window.location.href;
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            showNotification('تم نسخ الرابط! 📋', 'success');
            
            // تغيير نص الزر مؤقتاً
            const copyBtn = document.querySelector('.share-btn.copy span');
            const originalText = copyBtn.textContent;
            copyBtn.textContent = 'تم النسخ ✓';
            
            setTimeout(() => {
                copyBtn.textContent = originalText;
            }, 2000);
        }).catch(() => {
            fallbackCopyToClipboard(url);
        });
    } else {
        fallbackCopyToClipboard(url);
    }
}

function fallbackCopyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showNotification('تم نسخ الرابط! 📋', 'success');
    } catch (err) {
        showNotification('فشل في نسخ الرابط، يرجى نسخه يدوياً', 'error');
    }
    
    document.body.removeChild(textArea);
}

// حفظ/إلغاء حفظ المفضلة
function toggleFavorite(postId) {
    let favorites = JSON.parse(localStorage.getItem('muhtawaa_favorites') || '[]');
    const index = favorites.indexOf(postId);
    const favoriteBtn = document.querySelector('.favorite-btn');
    const icon = favoriteBtn.querySelector('i');
    const text = favoriteBtn.querySelector('span');
    
    if (index > -1) {
        // إزالة من المفضلة
        favorites.splice(index, 1);
        favoriteBtn.style.background = '#f8f9fa';
        favoriteBtn.style.color = '#6c757d';
        favoriteBtn.style.borderColor = '#dee2e6';
        icon.className = 'fas fa-heart';
        text.textContent = 'حفظ في المفضلة';
        showNotification('تم إزالة الحل من المفضلة', 'info');
    } else {
        // إضافة للمفضلة
        favorites.push(postId);
        favoriteBtn.style.background = '#dc3545';
        favoriteBtn.style.color = 'white';
        favoriteBtn.style.borderColor = '#dc3545';
        icon.className = 'fas fa-heart';
        text.textContent = 'محفوظ في المفضلة';
        showNotification('تم حفظ الحل في المفضلة ⭐', 'success');
    }
    
    localStorage.setItem('muhtawaa_favorites', JSON.stringify(favorites));
}

// دالة إظهار الإشعارات
function showNotification(message, type = 'info') {
    // إزالة الإشعارات السابقة
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span class="notification-message">${message}</span>
        <button class="notification-close" aria-label="إغلاق الإشعار">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    // إظهار الإشعار
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // إخفاء تلقائي بعد 4 ثوان
    setTimeout(() => {
        hideNotification(notification);
    }, 4000);
    
    // إغلاق عند الضغط على X
    notification.querySelector('.notification-close').addEventListener('click', function() {
        hideNotification(notification);
    });
}

function hideNotification(notification) {
    notification.classList.remove('show');
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 300);
}

// تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // فحص حالة المفضلة
    const postId = <?php echo get_the_ID(); ?>;
    const favorites = JSON.parse(localStorage.getItem('muhtawaa_favorites') || '[]');
    const favoriteBtn = document.querySelector('.favorite-btn');
    
    if (favorites.includes(postId)) {
        const icon = favoriteBtn.querySelector('i');
        const text = favoriteBtn.querySelector('span');
        favoriteBtn.style.background = '#dc3545';
        favoriteBtn.style.color = 'white';
        favoriteBtn.style.borderColor = '#dc3545';
        text.textContent = 'محفوظ في المفضلة';
    }
    
    // فحص إذا كان المستخدم قيّم المقال مسبقاً
    const existingRating = localStorage.getItem('rated_post_<?php echo get_the_ID(); ?>');
    if (existingRating) {
        const ratingSection = document.querySelector('.solution-rating');
        ratingSection.innerHTML = `
            <div style="text-align: center; padding: 2rem;">
                <div style="font-size: 2rem; margin-bottom: 1rem;">✅</div>
                <h4 style="color: #28a745; margin-bottom: 0.5rem;">شكراً لك! لقد قيّمت هذا الحل مسبقاً</h4>
                <p style="color: #6c757d;">تقييمك: ${existingRating === 'helpful' ? '👍 مفيد' : '👎 غير مفيد'}</p>
            </div>
        `;
    }
    
    // تحسين أزرار المشاركة
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // إضافة تأثير النقر
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    // تتبع التفاعل مع المحتوى
    let readingStartTime = Date.now();
    let maxScrollDepth = 0;
    
    function trackScrollDepth() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight;
        const winHeight = window.innerHeight;
        const scrollPercent = Math.round((scrollTop / (docHeight - winHeight)) * 100);
        
        if (scrollPercent > maxScrollDepth) {
            maxScrollDepth = scrollPercent;
        }
    }
    
    window.addEventListener('scroll', trackScrollDepth);
    
    // إرسال إحصائيات القراءة عند مغادرة الصفحة
    window.addEventListener('beforeunload', function() {
        const readingTime = Math.round((Date.now() - readingStartTime) / 1000);
        
        if (readingTime > 15 && maxScrollDepth > 25) {
            navigator.sendBeacon(muhtawaa_ajax.ajax_url, new URLSearchParams({
                action: 'track_reading',
                post_id: postId,
                reading_time: readingTime,
                scroll_depth: maxScrollDepth,
                nonce: muhtawaa_ajax.nonce
            }));
        }
    });
    
    // تحسين تجربة القراءة
    const content = document.querySelector('.solution-content');
    if (content) {
        // إضافة reading progress bar
        const progressBar = document.createElement('div');
        progressBar.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 1000;
            transition: width 0.3s;
        `;
        document.body.appendChild(progressBar);
        
        function updateReadingProgress() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.scrollHeight;
            const winHeight = window.innerHeight;
            const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;
            
            progressBar.style.width = Math.min(scrollPercent, 100) + '%';
        }
        
        window.addEventListener('scroll', updateReadingProgress);
    }
    
    // تحسين الصور
    const images = document.querySelectorAll('.solution-content img, .solution-featured-image img');
    images.forEach(img => {
        img.addEventListener('click', function() {
            // إنشاء lightbox بسيط
            const lightbox = document.createElement('div');
            lightbox.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                cursor: pointer;
            `;
            
            const lightboxImg = document.createElement('img');
            lightboxImg.src = this.src;
            lightboxImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                border-radius: 10px;
            `;
            
            lightbox.appendChild(lightboxImg);
            document.body.appendChild(lightbox);
            
            lightbox.addEventListener('click', () => {
                document.body.removeChild(lightbox);
            });
        });
    });
});
</script>

<?php get_footer(); ?>