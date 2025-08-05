<?php
/**
 * الويدجت المخصصة لقالب محتوى
 * Custom Widgets for Muhtawaa Theme
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق محتوى
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * ويدجت الحلول الأخيرة
 */
class Muhtawaa_Recent_Solutions_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_recent_solutions',
            __('محتوى: الحلول الأخيرة', 'muhtawaa'),
            array(
                'description' => __('عرض الحلول الأخيرة مع صور مصغرة', 'muhtawaa'),
                'classname' => 'muhtawaa-recent-solutions-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('الحلول الأخيرة', 'muhtawaa');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $show_thumbnail = isset($instance['show_thumbnail']) ? $instance['show_thumbnail'] : true;
        $show_views = isset($instance['show_views']) ? $instance['show_views'] : false;
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => $number,
            'post_status' => 'publish'
        ));
        
        if (!empty($recent_posts)) {
            echo '<ul class="muhtawaa-recent-solutions">';
            
            foreach ($recent_posts as $post) {
                setup_postdata($post);
                ?>
                <li class="solution-item">
                    <?php if ($show_thumbnail && has_post_thumbnail($post['ID'])) : ?>
                        <div class="solution-thumbnail">
                            <a href="<?php echo get_permalink($post['ID']); ?>">
                                <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="solution-content">
                        <h4 class="solution-title">
                            <a href="<?php echo get_permalink($post['ID']); ?>">
                                <?php echo esc_html($post['post_title']); ?>
                            </a>
                        </h4>
                        
                        <div class="solution-meta">
                            <?php if ($show_date) : ?>
                                <span class="solution-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo muhtawaa_get_arabic_date(strtotime($post['post_date'])); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($show_views && function_exists('muhtawaa_get_post_views')) : ?>
                                <span class="solution-views">
                                    <i class="fas fa-eye"></i>
                                    <?php echo muhtawaa_get_post_views($post['ID']); ?> مشاهدة
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php
            }
            
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __('لا توجد حلول حتى الآن', 'muhtawaa') . '</p>';
        }
        
        echo $args['after_widget'];
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('الحلول الأخيرة', 'muhtawaa');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : false;
        $show_thumbnail = isset($instance['show_thumbnail']) ? (bool) $instance['show_thumbnail'] : true;
        $show_views = isset($instance['show_views']) ? (bool) $instance['show_views'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('عدد الحلول:', 'muhtawaa'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" 
                   name="<?php echo $this->get_field_name('number'); ?>" type="number" 
                   step="1" min="1" value="<?php echo $number; ?>" size="3">
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_thumbnail); ?> 
                   id="<?php echo $this->get_field_id('show_thumbnail'); ?>" 
                   name="<?php echo $this->get_field_name('show_thumbnail'); ?>">
            <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>">
                <?php _e('إظهار الصورة المصغرة', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_date); ?> 
                   id="<?php echo $this->get_field_id('show_date'); ?>" 
                   name="<?php echo $this->get_field_name('show_date'); ?>">
            <label for="<?php echo $this->get_field_id('show_date'); ?>">
                <?php _e('إظهار التاريخ', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_views); ?> 
                   id="<?php echo $this->get_field_id('show_views'); ?>" 
                   name="<?php echo $this->get_field_name('show_views'); ?>">
            <label for="<?php echo $this->get_field_id('show_views'); ?>">
                <?php _e('إظهار عدد المشاهدات', 'muhtawaa'); ?>
            </label>
        </p>
        <?php
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;
        $instance['show_thumbnail'] = isset($new_instance['show_thumbnail']) ? (bool) $new_instance['show_thumbnail'] : true;
        $instance['show_views'] = isset($new_instance['show_views']) ? (bool) $new_instance['show_views'] : false;
        
        return $instance;
    }
}

/**
 * ويدجت إحصائيات الموقع
 */
class Muhtawaa_Site_Stats_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_site_stats',
            __('محتوى: إحصائيات الموقع', 'muhtawaa'),
            array(
                'description' => __('عرض إحصائيات الموقع بشكل جذاب', 'muhtawaa'),
                'classname' => 'muhtawaa-site-stats-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('إحصائيات الموقع', 'muhtawaa');
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        // جمع الإحصائيات
        $stats = array(
            'posts' => wp_count_posts()->publish,
            'comments' => wp_count_comments()->approved,
            'users' => count_users()['total_users'],
            'categories' => wp_count_terms('category')
        );
        
        // إحصائيات إضافية من الإعدادات
        $total_views = get_option('muhtawaa_total_views', 0);
        $total_shares = get_option('muhtawaa_total_shares', 0);
        
        ?>
        <div class="muhtawaa-stats-grid">
            <?php if (isset($instance['show_posts']) && $instance['show_posts']) : ?>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-count="<?php echo $stats['posts']; ?>">0</span>
                        <span class="stat-label"><?php _e('مقالة', 'muhtawaa'); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($instance['show_comments']) && $instance['show_comments']) : ?>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-count="<?php echo $stats['comments']; ?>">0</span>
                        <span class="stat-label"><?php _e('تعليق', 'muhtawaa'); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($instance['show_users']) && $instance['show_users']) : ?>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-count="<?php echo $stats['users']; ?>">0</span>
                        <span class="stat-label"><?php _e('مستخدم', 'muhtawaa'); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($instance['show_views']) && $instance['show_views'] && $total_views > 0) : ?>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-count="<?php echo $total_views; ?>">0</span>
                        <span class="stat-label"><?php _e('مشاهدة', 'muhtawaa'); ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php
        echo $args['after_widget'];
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('إحصائيات الموقع', 'muhtawaa');
        $show_posts = isset($instance['show_posts']) ? (bool) $instance['show_posts'] : true;
        $show_comments = isset($instance['show_comments']) ? (bool) $instance['show_comments'] : true;
        $show_users = isset($instance['show_users']) ? (bool) $instance['show_users'] : true;
        $show_views = isset($instance['show_views']) ? (bool) $instance['show_views'] : true;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p><strong><?php _e('الإحصائيات المعروضة:', 'muhtawaa'); ?></strong></p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_posts); ?> 
                   id="<?php echo $this->get_field_id('show_posts'); ?>" 
                   name="<?php echo $this->get_field_name('show_posts'); ?>">
            <label for="<?php echo $this->get_field_id('show_posts'); ?>">
                <?php _e('عدد المقالات', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_comments); ?> 
                   id="<?php echo $this->get_field_id('show_comments'); ?>" 
                   name="<?php echo $this->get_field_name('show_comments'); ?>">
            <label for="<?php echo $this->get_field_id('show_comments'); ?>">
                <?php _e('عدد التعليقات', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_users); ?> 
                   id="<?php echo $this->get_field_id('show_users'); ?>" 
                   name="<?php echo $this->get_field_name('show_users'); ?>">
            <label for="<?php echo $this->get_field_id('show_users'); ?>">
                <?php _e('عدد المستخدمين', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_views); ?> 
                   id="<?php echo $this->get_field_id('show_views'); ?>" 
                   name="<?php echo $this->get_field_name('show_views'); ?>">
            <label for="<?php echo $this->get_field_id('show_views'); ?>">
                <?php _e('إجمالي المشاهدات', 'muhtawaa'); ?>
            </label>
        </p>
        <?php
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['show_posts'] = isset($new_instance['show_posts']) ? (bool) $new_instance['show_posts'] : false;
        $instance['show_comments'] = isset($new_instance['show_comments']) ? (bool) $new_instance['show_comments'] : false;
        $instance['show_users'] = isset($new_instance['show_users']) ? (bool) $new_instance['show_users'] : false;
        $instance['show_views'] = isset($new_instance['show_views']) ? (bool) $new_instance['show_views'] : false;
        
        return $instance;
    }
}

/**
 * ويدجت الفئات مع عدد المشاهدات
 */
class Muhtawaa_Categories_With_Views_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_categories_views',
            __('محتوى: الفئات مع المشاهدات', 'muhtawaa'),
            array(
                'description' => __('عرض الفئات مع عدد المشاهدات والأيقونات', 'muhtawaa'),
                'classname' => 'muhtawaa-categories-views-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('الفئات', 'muhtawaa');
        $show_count = isset($instance['show_count']) ? $instance['show_count'] : true;
        $show_hierarchy = isset($instance['show_hierarchy']) ? $instance['show_hierarchy'] : false;
        $number = !empty($instance['number']) ? absint($instance['number']) : 0;
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        $cat_args = array(
            'orderby' => 'count',
            'order' => 'DESC',
            'hide_empty' => true,
            'hierarchical' => $show_hierarchy,
            'number' => $number,
            'parent' => 0
        );
        
        $categories = get_categories($cat_args);
        
        if (!empty($categories)) {
            echo '<ul class="muhtawaa-categories-list">';
            
            foreach ($categories as $category) {
                $this->display_category_item($category, $show_count, $show_hierarchy);
            }
            
            echo '</ul>';
        } else {
            echo '<p>' . __('لا توجد فئات', 'muhtawaa') . '</p>';
        }
        
        echo $args['after_widget'];
    }
    
    /**
     * عرض عنصر الفئة
     */
    private function display_category_item($category, $show_count, $show_hierarchy) {
        $icon = get_term_meta($category->term_id, 'category_icon', true);
        if (empty($icon)) {
            $icon = 'fas fa-folder';
        }
        ?>
        <li class="category-item">
            <a href="<?php echo get_category_link($category->term_id); ?>" class="category-link">
                <span class="category-icon">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                </span>
                <span class="category-name"><?php echo esc_html($category->name); ?></span>
                <?php if ($show_count) : ?>
                    <span class="category-count"><?php echo $category->count; ?></span>
                <?php endif; ?>
            </a>
            
            <?php
            if ($show_hierarchy) {
                $children = get_categories(array(
                    'parent' => $category->term_id,
                    'hide_empty' => true
                ));
                
                if (!empty($children)) {
                    echo '<ul class="children">';
                    foreach ($children as $child) {
                        $this->display_category_item($child, $show_count, false);
                    }
                    echo '</ul>';
                }
            }
            ?>
        </li>
        <?php
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('الفئات', 'muhtawaa');
        $show_count = isset($instance['show_count']) ? (bool) $instance['show_count'] : true;
        $show_hierarchy = isset($instance['show_hierarchy']) ? (bool) $instance['show_hierarchy'] : false;
        $number = !empty($instance['number']) ? absint($instance['number']) : 0;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('عدد الفئات المعروضة:', 'muhtawaa'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" 
                   name="<?php echo $this->get_field_name('number'); ?>" type="number" 
                   step="1" min="0" value="<?php echo $number; ?>" size="3">
            <br><small><?php _e('0 لعرض الكل', 'muhtawaa'); ?></small>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_count); ?> 
                   id="<?php echo $this->get_field_id('show_count'); ?>" 
                   name="<?php echo $this->get_field_name('show_count'); ?>">
            <label for="<?php echo $this->get_field_id('show_count'); ?>">
                <?php _e('إظهار عدد المقالات', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_hierarchy); ?> 
                   id="<?php echo $this->get_field_id('show_hierarchy'); ?>" 
                   name="<?php echo $this->get_field_name('show_hierarchy'); ?>">
            <label for="<?php echo $this->get_field_id('show_hierarchy'); ?>">
                <?php _e('إظهار الفئات الفرعية', 'muhtawaa'); ?>
            </label>
        </p>
        <?php
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['show_count'] = isset($new_instance['show_count']) ? (bool) $new_instance['show_count'] : false;
        $instance['show_hierarchy'] = isset($new_instance['show_hierarchy']) ? (bool) $new_instance['show_hierarchy'] : false;
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 0;
        
        return $instance;
    }
}

/**
 * ويدجت البحث المتقدم
 */
class Muhtawaa_Advanced_Search_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_advanced_search',
            __('محتوى: البحث المتقدم', 'muhtawaa'),
            array(
                'description' => __('نموذج بحث متقدم مع خيارات متعددة', 'muhtawaa'),
                'classname' => 'muhtawaa-advanced-search-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : __('ابحث عن حل...', 'muhtawaa');
        $show_categories = isset($instance['show_categories']) ? $instance['show_categories'] : true;
        $show_tags = isset($instance['show_tags']) ? $instance['show_tags'] : false;
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        ?>
        
        <form role="search" method="get" class="muhtawaa-advanced-search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="search-input-wrapper">
                <input type="search" class="search-field" 
                       placeholder="<?php echo esc_attr($placeholder); ?>" 
                       value="<?php echo get_search_query(); ?>" 
                       name="s" />
                <button type="submit" class="search-submit">
                    <i class="fas fa-search"></i>
                    <span class="screen-reader-text"><?php _e('بحث', 'muhtawaa'); ?></span>
                </button>
            </div>
            
            <?php if ($show_categories || $show_tags) : ?>
                <div class="search-filters">
                    <?php if ($show_categories) : ?>
                        <div class="filter-group">
                            <label for="search-category"><?php _e('الفئة:', 'muhtawaa'); ?></label>
                            <?php
                            wp_dropdown_categories(array(
                                'show_option_all' => __('جميع الفئات', 'muhtawaa'),
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true,
                                'id' => 'search-category',
                                'name' => 'cat',
                                'selected' => get_query_var('cat')
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($show_tags) : ?>
                        <div class="filter-group">
                            <label for="search-tag"><?php _e('الوسم:', 'muhtawaa'); ?></label>
                            <select name="tag" id="search-tag">
                                <option value=""><?php _e('جميع الوسوم', 'muhtawaa'); ?></option>
                                <?php
                                $tags = get_tags(array('hide_empty' => true));
                                $current_tag = get_query_var('tag');
                                foreach ($tags as $tag) {
                                    printf(
                                        '<option value="%s" %s>%s</option>',
                                        esc_attr($tag->slug),
                                        selected($current_tag, $tag->slug, false),
                                        esc_html($tag->name)
                                    );
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </form>
        
        <?php
        echo $args['after_widget'];
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : __('ابحث عن حل...', 'muhtawaa');
        $show_categories = isset($instance['show_categories']) ? (bool) $instance['show_categories'] : true;
        $show_tags = isset($instance['show_tags']) ? (bool) $instance['show_tags'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('placeholder'); ?>"><?php _e('نص البحث الافتراضي:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" 
                   name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" 
                   value="<?php echo esc_attr($placeholder); ?>">
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_categories); ?> 
                   id="<?php echo $this->get_field_id('show_categories'); ?>" 
                   name="<?php echo $this->get_field_name('show_categories'); ?>">
            <label for="<?php echo $this->get_field_id('show_categories'); ?>">
                <?php _e('إظهار فلتر الفئات', 'muhtawaa'); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_tags); ?> 
                   id="<?php echo $this->get_field_id('show_tags'); ?>" 
                   name="<?php echo $this->get_field_name('show_tags'); ?>">
            <label for="<?php echo $this->get_field_id('show_tags'); ?>">
                <?php _e('إظهار فلتر الوسوم', 'muhtawaa'); ?>
            </label>
        </p>
        <?php
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['placeholder'] = (!empty($new_instance['placeholder'])) ? strip_tags($new_instance['placeholder']) : '';
        $instance['show_categories'] = isset($new_instance['show_categories']) ? (bool) $new_instance['show_categories'] : false;
        $instance['show_tags'] = isset($new_instance['show_tags']) ? (bool) $new_instance['show_tags'] : false;
        
        return $instance;
    }
}

/**
 * ويدجت التواصل الاجتماعي
 */
class Muhtawaa_Social_Links_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_social_links',
            __('محتوى: روابط التواصل الاجتماعي', 'muhtawaa'),
            array(
                'description' => __('عرض أيقونات وروابط التواصل الاجتماعي', 'muhtawaa'),
                'classname' => 'muhtawaa-social-links-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : '';
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        $social_networks = array(
            'facebook' => array('icon' => 'fab fa-facebook-f', 'label' => 'Facebook'),
            'twitter' => array('icon' => 'fab fa-twitter', 'label' => 'Twitter'),
            'instagram' => array('icon' => 'fab fa-instagram', 'label' => 'Instagram'),
            'linkedin' => array('icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'),
            'youtube' => array('icon' => 'fab fa-youtube', 'label' => 'YouTube'),
            'telegram' => array('icon' => 'fab fa-telegram-plane', 'label' => 'Telegram'),
            'whatsapp' => array('icon' => 'fab fa-whatsapp', 'label' => 'WhatsApp'),
            'snapchat' => array('icon' => 'fab fa-snapchat-ghost', 'label' => 'Snapchat'),
            'tiktok' => array('icon' => 'fab fa-tiktok', 'label' => 'TikTok')
        );
        
        echo '<div class="muhtawaa-social-links">';
        
        foreach ($social_networks as $network => $data) {
            if (!empty($instance[$network])) {
                printf(
                    '<a href="%s" class="social-link social-%s" target="_blank" rel="noopener noreferrer" title="%s">
                        <i class="%s"></i>
                        <span class="screen-reader-text">%s</span>
                    </a>',
                    esc_url($instance[$network]),
                    esc_attr($network),
                    esc_attr($data['label']),
                    esc_attr($data['icon']),
                    esc_html($data['label'])
                );
            }
        }
        
        echo '</div>';
        
        echo $args['after_widget'];
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p><strong><?php _e('روابط الشبكات الاجتماعية:', 'muhtawaa'); ?></strong></p>
        
        <?php
        $social_networks = array(
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'linkedin' => 'LinkedIn',
            'youtube' => 'YouTube',
            'telegram' => 'Telegram',
            'whatsapp' => 'WhatsApp',
            'snapchat' => 'Snapchat',
            'tiktok' => 'TikTok'
        );
        
        foreach ($social_networks as $network => $label) {
            $value = !empty($instance[$network]) ? $instance[$network] : '';
            ?>
            <p>
                <label for="<?php echo $this->get_field_id($network); ?>"><?php echo $label; ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id($network); ?>" 
                       name="<?php echo $this->get_field_name($network); ?>" type="url" 
                       value="<?php echo esc_attr($value); ?>" 
                       placeholder="https://<?php echo $network; ?>.com/username">
            </p>
            <?php
        }
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        
        $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'telegram', 'whatsapp', 'snapchat', 'tiktok');
        
        foreach ($social_networks as $network) {
            $instance[$network] = (!empty($new_instance[$network])) ? esc_url_raw($new_instance[$network]) : '';
        }
        
        return $instance;
    }
}

/**
 * ويدجت النشرة البريدية
 */
class Muhtawaa_Newsletter_Widget extends WP_Widget {
    
    /**
     * إعداد الويدجت
     */
    public function __construct() {
        parent::__construct(
            'muhtawaa_newsletter',
            __('محتوى: النشرة البريدية', 'muhtawaa'),
            array(
                'description' => __('نموذج الاشتراك في النشرة البريدية', 'muhtawaa'),
                'classname' => 'muhtawaa-newsletter-widget'
            )
        );
    }
    
    /**
     * الواجهة الأمامية للويدجت
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('اشترك في نشرتنا البريدية', 'muhtawaa');
        $description = !empty($instance['description']) ? $instance['description'] : __('احصل على أحدث الحلول والنصائح مباشرة في بريدك الإلكتروني', 'muhtawaa');
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : __('اشترك الآن', 'muhtawaa');
        
        if ($title) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        
        if ($description) {
            echo '<p class="newsletter-description">' . esc_html($description) . '</p>';
        }
        ?>
        
        <form class="muhtawaa-newsletter-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
            <div class="newsletter-form-wrapper">
                <input type="email" 
                       name="email" 
                       class="newsletter-email" 
                       placeholder="<?php esc_attr_e('بريدك الإلكتروني', 'muhtawaa'); ?>" 
                       required>
                
                <button type="submit" class="newsletter-submit">
                    <span class="button-text"><?php echo esc_html($button_text); ?></span>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            
            <input type="hidden" name="action" value="muhtawaa_subscribe_newsletter">
            <?php wp_nonce_field('muhtawaa_newsletter_nonce', 'newsletter_nonce'); ?>
            
            <div class="newsletter-message"></div>
        </form>
        
        <?php
        echo $args['after_widget'];
    }
    
    /**
     * الواجهة الخلفية للويدجت
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('اشترك في نشرتنا البريدية', 'muhtawaa');
        $description = !empty($instance['description']) ? $instance['description'] : __('احصل على أحدث الحلول والنصائح مباشرة في بريدك الإلكتروني', 'muhtawaa');
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : __('اشترك الآن', 'muhtawaa');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('الوصف:', 'muhtawaa'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" 
                      name="<?php echo $this->get_field_name('description'); ?>" 
                      rows="3"><?php echo esc_textarea($description); ?></textarea>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('نص الزر:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" 
                   name="<?php echo $this->get_field_name('button_text'); ?>" type="text" 
                   value="<?php echo esc_attr($button_text); ?>">
        </p>
        <?php
    }
    
    /**
     * تحديث إعدادات الويدجت
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
        $instance['button_text'] = (!empty($new_instance['button_text'])) ? strip_tags($new_instance['button_text']) : '';
        
        return $instance;
    }
}

/**
 * تسجيل جميع الويدجت المخصصة
 */
function muhtawaa_register_custom_widgets() {
    register_widget('Muhtawaa_Recent_Solutions_Widget');
    register_widget('Muhtawaa_Site_Stats_Widget');
    register_widget('Muhtawaa_Categories_With_Views_Widget');
    register_widget('Muhtawaa_Advanced_Search_Widget');
    register_widget('Muhtawaa_Social_Links_Widget');
    register_widget('Muhtawaa_Newsletter_Widget');
}
add_action('widgets_init', 'muhtawaa_register_custom_widgets');

/**
 * معالج AJAX للنشرة البريدية
 */
function muhtawaa_handle_newsletter_subscription() {
    // التحقق من nonce
    if (!wp_verify_nonce($_POST['newsletter_nonce'], 'muhtawaa_newsletter_nonce')) {
        wp_send_json_error(array('message' => __('خطأ في الأمان', 'muhtawaa')));
    }
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('البريد الإلكتروني غير صالح', 'muhtawaa')));
    }
    
    // حفظ البريد الإلكتروني في قاعدة البيانات
    $subscribers = get_option('muhtawaa_newsletter_subscribers', array());
    
    if (in_array($email, $subscribers)) {
        wp_send_json_error(array('message' => __('أنت مشترك بالفعل!', 'muhtawaa')));
    }
    
    $subscribers[] = $email;
    update_option('muhtawaa_newsletter_subscribers', $subscribers);
    
    // إرسال بريد ترحيبي (اختياري)
    $subject = get_bloginfo('name') . ' - ' . __('مرحباً بك في نشرتنا البريدية', 'muhtawaa');
    $message = sprintf(
        __('مرحباً!

شكراً لاشتراكك في نشرتنا البريدية. سنرسل لك أحدث الحلول والنصائح المفيدة.

مع تحيات،
فريق %s', 'muhtawaa'),
        get_bloginfo('name')
    );
    
    wp_mail($email, $subject, $message);
    
    wp_send_json_success(array('message' => __('شكراً لاشتراكك! تم تسجيلك بنجاح.', 'muhtawaa')));
}
add_action('wp_ajax_muhtawaa_subscribe_newsletter', 'muhtawaa_handle_newsletter_subscription');
add_action('wp_ajax_nopriv_muhtawaa_subscribe_newsletter', 'muhtawaa_handle_newsletter_subscription');