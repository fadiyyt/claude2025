<?php
/**
 * Block Patterns Registration - Fixed Version
 * تسجيل أنماط الكتل المصحح
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Block_Patterns_Fixed {

    public function __construct() {
        // استخدام أولوية متأخرة لضمان تسجيل الفئات أولاً
        add_action('init', [$this, 'register_patterns'], 20);
    }

    public function register_patterns() {
        // تسجيل فئات الأنماط
        $this->register_categories();
        
        // تسجيل الأنماط الفردية
        $this->register_individual_patterns();
    }

    private function register_categories() {
        if (!function_exists('register_block_pattern_category')) {
            return;
        }

        $categories = [
            'practical-solutions' => __('الحلول العملية', 'practical-solutions'),
            'ps-heroes'           => __('أقسام البطل', 'practical-solutions'),
            'ps-features'         => __('عرض الميزات', 'practical-solutions'),
            'ps-content'          => __('أقسام المحتوى', 'practical-solutions'),
            'ps-cta'              => __('دعوات العمل', 'practical-solutions'),
        ];

        foreach ($categories as $slug => $label) {
            // التحقق إذا كانت الفئة مسجلة مسبقاً لتجنب الأخطاء
            if (!WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($slug)) {
                register_block_pattern_category($slug, ['label' => $label]);
            }
        }
    }

    private function register_individual_patterns() {
        if (!function_exists('register_block_pattern')) {
            return;
        }
        
        // نمط البحث المحسن
        register_block_pattern(
            'practical-solutions/enhanced-search',
            [
                'title'       => __('بحث محسن مع الصوت', 'practical-solutions'),
                'description' => __('نموذج بحث متقدم مع إمكانية البحث الصوتي', 'practical-solutions'),
                'content'     => $this->get_search_pattern(),
                'categories'  => ['practical-solutions', 'ps-features'],
                'keywords'    => ['search', 'voice', 'بحث', 'صوت'],
            ]
        );
        
        // نمط التقييم
        register_block_pattern(
            'practical-solutions/rating-section',
            [
                'title'       => __('قسم التقييم', 'practical-solutions'),
                'description' => __('قسم تقييم تفاعلي للمقالات', 'practical-solutions'),
                'content'     => $this->get_rating_pattern(),
                'categories'  => ['practical-solutions', 'ps-content'],
                'keywords'    => ['rating', 'stars', 'تقييم', 'نجوم'],
            ]
        );
    }

    private function get_search_pattern() {
        return '<!-- wp:group {"className":"ps-enhanced-search","layout":{"type":"constrained"}} -->
<div class="wp-block-group ps-enhanced-search">
    <!-- wp:heading {"textAlign":"center","className":"is-style-ps-section-title"} -->
    <h2 class="wp-block-heading has-text-align-center is-style-ps-section-title">ابحث في الموقع</h2>
    <!-- /wp:heading -->
    
    <!-- wp:html -->
    <div class="ps-search-container">
        <form class="ps-search-form" role="search" method="get" action="' . esc_url(home_url('/')) . '">
            <input type="search" class="ps-search-input" placeholder="اكتب ما تبحث عنه..." name="s" aria-label="البحث">
            <button type="submit" class="ps-search-btn" aria-label="البحث">🔍</button>
            <button type="button" class="ps-voice-btn" aria-label="البحث الصوتي">🎤</button>
            <div class="ps-search-suggestions" style="display: none;"></div>
        </form>
    </div>
    <!-- /wp:html -->
</div>
<!-- /wp:group -->';
    }

    private function get_rating_pattern() {
        return '<!-- wp:group {"className":"ps-rating-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group ps-rating-section">
    <!-- wp:heading {"textAlign":"center","level":3} -->
    <h3 class="wp-block-heading has-text-align-center">قيم هذا المحتوى</h3>
    <!-- /wp:heading -->
    
    <!-- wp:html -->
    <div class="ps-rating-widget" data-post-id="">
        <div class="ps-rating-stars">
            <button class="ps-rating-btn" data-rating="1" aria-label="نجمة واحدة">★</button>
            <button class="ps-rating-btn" data-rating="2" aria-label="نجمتان">★</button>
            <button class="ps-rating-btn" data-rating="3" aria-label="ثلاث نجوم">★</button>
            <button class="ps-rating-btn" data-rating="4" aria-label="أربع نجوم">★</button>
            <button class="ps-rating-btn" data-rating="5" aria-label="خمس نجوم">★</button>
        </div>
        <div class="ps-rating-display">
            <span class="ps-rating-average">0.0</span>
            <span class="ps-rating-count">(0 تقييمات)</span>
        </div>
    </div>
    <!-- /wp:html -->
</div>
<!-- /wp:group -->';
    }
}

// تفعيل النظام
new PS_Block_Patterns_Fixed();
?>
