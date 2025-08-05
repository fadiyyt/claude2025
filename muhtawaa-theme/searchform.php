<?php
/**
 * نموذج البحث الافتراضي للقالب
 * Default Search Form Template
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// استخدام نظام البحث المتقدم إذا كان متوفراً
if (class_exists('MuhtawaaAdvancedSearch')) {
    // عرض البحث المتقدم بدون الفلاتر الإضافية في الأماكن الضيقة
    echo MuhtawaaAdvancedSearch::render_search_form(array(
        'show_filters' => false,  // إخفاء الفلاتر في النموذج الصغير
        'placeholder' => __('ابحث في الموقع...', 'muhtawaa')
    ));
} else {
    // نموذج البحث الأساسي كبديل
    ?>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="search-wrapper">
            <label>
                <span class="screen-reader-text"><?php echo _x('البحث عن:', 'label', 'muhtawaa'); ?></span>
                <input type="search" 
                       class="search-field" 
                       placeholder="<?php echo esc_attr_x('ابحث في الموقع...', 'placeholder', 'muhtawaa'); ?>" 
                       value="<?php echo get_search_query(); ?>" 
                       name="s" />
            </label>
            <button type="submit" class="search-submit">
                <i class="fas fa-search"></i>
                <span class="screen-reader-text"><?php echo _x('بحث', 'submit button', 'muhtawaa'); ?></span>
            </button>
        </div>
    </form>
    <?php
}
?>