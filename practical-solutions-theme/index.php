<?php
/**
 * The main template file
 * ملف القالب الرئيسي
 *
 * هذا هو الملف الاحتياطي الأكثر عمومية في التسلسل الهرمي لقوالب ووردبريس.
 * في قوالب Block Theme، يتم استخدام ملفات HTML في مجلد templates،
 * لكن هذا الملف مطلوب للتوافق مع ووردبريس.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        
        <?php if (have_posts()) : ?>
            
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="page-title screen-reader-text">
                        <?php single_post_title(); ?>
                    </h1>
                </header>
            <?php endif; ?>

            <div class="posts-container">
                <?php
                // بدء حلقة المقالات
                while (have_posts()) :
                    the_post();
                    
                    /*
                     * تضمين قالب محتوى المقال المناسب
                     * للبحث عن post-format، مثلاً: content-video.php
                     * إذا لم يوجد، سيتم استخدام content.php
                     */
                    get_template_part('template-parts/content', get_post_type());
                    
                endwhile;
                ?>
            </div>

            <?php
            // التنقل بين الصفحات
            the_posts_navigation(array(
                'prev_text' => __('&larr; المقالات الأحدث', 'practical-solutions'),
                'next_text' => __('المقالات الأقدم &rarr;', 'practical-solutions'),
            ));
            
        else :
            
            // لا توجد مقالات
            get_template_part('template-parts/content', 'none');
            
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>