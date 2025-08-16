<?php
/**
 * Rating System - Enhanced Version
 * نظام التقييمات المحسن
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Rating_System {
    
public function __construct() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_rating_assets']);
    add_action('wp_ajax_ps_rate_post', [$this, 'handle_rating']);
    add_action('wp_ajax_nopriv_ps_rate_post', [$this, 'handle_rating']);
    add_action('wp_ajax_ps_like_post', [$this, 'handle_like']);
    add_action('wp_ajax_nopriv_ps_like_post', [$this, 'handle_like']);
    
    // التعديل هنا: تغيير الخطاف من 'init' إلى 'after_switch_theme'
    add_action('after_switch_theme', [$this, 'create_rating_tables']);
    
    add_action('wp_head', [$this, 'add_rating_schema']);
    add_shortcode('ps_rating', [$this, 'rating_shortcode']);
    add_shortcode('ps_like_button', [$this, 'like_button_shortcode']);
    }
    
    public function enqueue_rating_assets() {
        wp_enqueue_script('ps-rating', PS_THEME_URI . '/assets/js/rating.js', ['jquery'], PS_THEME_VERSION, true);
        wp_enqueue_style('ps-rating-style', PS_THEME_URI . '/assets/css/rating.css', [], PS_THEME_VERSION);
        
        wp_localize_script('ps-rating', 'psRating', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ps_rating_nonce'),
            'strings' => [
                'thanks' => __('شكراً لتقييمك!', 'practical-solutions'),
                'already_rated' => __('لقد قمت بالتقييم مسبقاً', 'practical-solutions'),
                'error' => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'practical-solutions'),
                'rate_this' => __('قيم هذا المقال', 'practical-solutions'),
                'your_rating' => __('تقييمك:', 'practical-solutions')
            ]
        ]);
    }
    
    public function create_rating_tables() {
        global $wpdb;
        
        $ratings_table = $wpdb->prefix . 'ps_ratings';
        $likes_table = $wpdb->prefix . 'ps_likes';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول التقييمات
        $sql1 = "CREATE TABLE $ratings_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_ip varchar(45) NOT NULL,
            rating tinyint(1) NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_rating (post_id, user_ip),
            KEY post_id (post_id)
        ) $charset_collate;";
        
        // جدول الإعجابات
        $sql2 = "CREATE TABLE $likes_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_ip varchar(45) NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_like (post_id, user_ip),
            KEY post_id (post_id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql1);
        dbDelta($sql2);
    }
    
    public function handle_rating() {
        check_ajax_referer('ps_rating_nonce', 'nonce');
        
        $post_id = intval($_POST['post_id']);
        $rating = intval($_POST['rating']);
        $user_ip = $this->get_user_ip();
        
        if (!$post_id || $rating < 1 || $rating > 5) {
            wp_send_json_error(__('بيانات غير صحيحة', 'practical-solutions'));
        }
        
        if ($this->has_user_rated($post_id, $user_ip)) {
            wp_send_json_error(__('لقد قمت بالتقييم مسبقاً', 'practical-solutions'));
        }
        
        $result = $this->save_rating($post_id, $user_ip, $rating);
        
        if ($result) {
            $avg_rating = $this->get_average_rating($post_id);
            $total_ratings = $this->get_total_ratings($post_id);
            
            wp_send_json_success([
                'message' => __('شكراً لتقييمك!', 'practical-solutions'),
                'average' => $avg_rating,
                'total' => $total_ratings
            ]);
        } else {
            wp_send_json_error(__('فشل في حفظ التقييم', 'practical-solutions'));
        }
    }
    
    public function handle_like() {
        check_ajax_referer('ps_rating_nonce', 'nonce');
        
        $post_id = intval($_POST['post_id']);
        $user_ip = $this->get_user_ip();
        
        if (!$post_id) {
            wp_send_json_error(__('بيانات غير صحيحة', 'practical-solutions'));
        }
        
        if ($this->has_user_liked($post_id, $user_ip)) {
            // إلغاء الإعجاب
            $result = $this->remove_like($post_id, $user_ip);
            $action = 'unliked';
        } else {
            // إضافة إعجاب
            $result = $this->add_like($post_id, $user_ip);
            $action = 'liked';
        }
        
        if ($result) {
            $total_likes = $this->get_total_likes($post_id);
            
            wp_send_json_success([
                'action' => $action,
                'total' => $total_likes,
                'message' => $action === 'liked' ? __('تم الإعجاب!', 'practical-solutions') : __('تم إلغاء الإعجاب', 'practical-solutions')
            ]);
        } else {
            wp_send_json_error(__('فشل في العملية', 'practical-solutions'));
        }
    }
    
    private function get_user_ip() {
        $ip_keys = ['HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    private function has_user_rated($post_id, $user_ip) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_ratings';
        
        $count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND user_ip = %s",
            $post_id, $user_ip
        ));
        
        return $count > 0;
    }
    
    private function has_user_liked($post_id, $user_ip) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_likes';
        
        $count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND user_ip = %s",
            $post_id, $user_ip
        ));
        
        return $count > 0;
    }
    
    private function save_rating($post_id, $user_ip, $rating) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_ratings';
        
        $result = $wpdb->insert(
            $table_name,
            [
                'post_id' => $post_id,
                'user_ip' => $user_ip,
                'rating' => $rating
            ],
            ['%d', '%s', '%d']
        );
        
        return $result !== false;
    }
    
    private function add_like($post_id, $user_ip) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_likes';
        
        $result = $wpdb->insert(
            $table_name,
            [
                'post_id' => $post_id,
                'user_ip' => $user_ip
            ],
            ['%d', '%s']
        );
        
        return $result !== false;
    }
    
    private function remove_like($post_id, $user_ip) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_likes';
        
        $result = $wpdb->delete(
            $table_name,
            [
                'post_id' => $post_id,
                'user_ip' => $user_ip
            ],
            ['%d', '%s']
        );
        
        return $result !== false;
    }
    
    public function get_average_rating($post_id) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_ratings';
        
        $average = $wpdb->get_var($wpdb->prepare(
            "SELECT AVG(rating) FROM $table_name WHERE post_id = %d",
            $post_id
        ));
        
        return round($average, 1);
    }
    
    public function get_total_ratings($post_id) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_ratings';
        
        $total = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d",
            $post_id
        ));
        
        return intval($total);
    }
    
    public function get_total_likes($post_id) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_likes';
        
        $total = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d",
            $post_id
        ));
        
        return intval($total);
    }
    
    public function add_rating_schema() {
        if (is_single()) {
            $post_id = get_the_ID();
            $average = $this->get_average_rating($post_id);
            $total = $this->get_total_ratings($post_id);
            
            if ($total > 0) {
                $schema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'aggregateRating' => [
                        '@type' => 'AggregateRating',
                        'ratingValue' => $average,
                        'ratingCount' => $total,
                        'bestRating' => 5,
                        'worstRating' => 1
                    ]
                ];
                
                echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
            }
        }
    }
    
    public function rating_shortcode($atts) {
        global $post;
        
        $atts = shortcode_atts([
            'post_id' => $post->ID ?? 0,
            'show_average' => true,
            'show_total' => true,
            'style' => 'stars'
        ], $atts);
        
        $post_id = intval($atts['post_id']);
        if (!$post_id) return '';
        
        $average = $this->get_average_rating($post_id);
        $total = $this->get_total_ratings($post_id);
        $user_ip = $this->get_user_ip();
        $has_rated = $this->has_user_rated($post_id, $user_ip);
        
        ob_start();
        ?>
        <div class="ps-rating-container" data-post-id="<?php echo $post_id; ?>">
            <div class="ps-rating-display">
                <?php if ($atts['show_average'] && $total > 0): ?>
                <div class="ps-rating-average">
                    <div class="ps-stars ps-stars-display">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="ps-star <?php echo $i <= $average ? 'ps-star-filled' : ''; ?>">★</span>
                        <?php endfor; ?>
                    </div>
                    <span class="ps-rating-number"><?php echo $average; ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($atts['show_total']): ?>
                <div class="ps-rating-total">
                    (<?php printf(_n('تقييم واحد', '%s تقييم', $total, 'practical-solutions'), $total); ?>)
                </div>
                <?php endif; ?>
            </div>
            
            <?php if (!$has_rated): ?>
            <div class="ps-rating-form">
                <p class="ps-rating-label"><?php _e('قيم هذا المقال:', 'practical-solutions'); ?></p>
                <div class="ps-stars ps-stars-input">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="ps-star" data-rating="<?php echo $i; ?>">★</span>
                    <?php endfor; ?>
                </div>
            </div>
            <?php else: ?>
            <p class="ps-rating-thanks"><?php _e('شكراً لتقييمك!', 'practical-solutions'); ?></p>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function like_button_shortcode($atts) {
        global $post;
        
        $atts = shortcode_atts([
            'post_id' => $post->ID ?? 0,
            'show_count' => true,
            'style' => 'button'
        ], $atts);
        
        $post_id = intval($atts['post_id']);
        if (!$post_id) return '';
        
        $total_likes = $this->get_total_likes($post_id);
        $user_ip = $this->get_user_ip();
        $has_liked = $this->has_user_liked($post_id, $user_ip);
        
        ob_start();
        ?>
        <div class="ps-like-container" data-post-id="<?php echo $post_id; ?>">
            <button class="ps-like-button <?php echo $has_liked ? 'ps-liked' : ''; ?>" type="button">
                <span class="ps-like-icon"><?php echo $has_liked ? '❤️' : '🤍'; ?></span>
                <span class="ps-like-text">
                    <?php echo $has_liked ? __('معجب', 'practical-solutions') : __('أعجبني', 'practical-solutions'); ?>
                </span>
                <?php if ($atts['show_count']): ?>
                <span class="ps-like-count"><?php echo $total_likes; ?></span>
                <?php endif; ?>
            </button>
        </div>
        <?php
        return ob_get_clean();
    }
}

// تشغيل نظام التقييمات
new PS_Rating_System();
?>