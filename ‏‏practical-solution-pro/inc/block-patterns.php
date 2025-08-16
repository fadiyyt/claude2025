<?php
/**
 * Block Patterns Registration - Professional & Safe Version
 * تسجيل أنماط الكتل المخصصة - نسخة احترافية وآمنة
 */

if (!defined('ABSPATH')) {
    exit;
}

// نستخدم كلاس لتنظيم الكود ومنع أي تعارضات مستقبلية
class PS_Block_Patterns_Registry {

    /**
     * ربط جميع الأحداث عند إنشاء الكائن
     */
    public function __construct() {
        // **الإصلاح الرئيسي:** نستخدم 'init' hook لضمان أن ووردبريس جاهز بالكامل
        add_action('init', [$this, 'register_categories_and_patterns']);
    }

    /**
     * دالة واحدة لتسجيل الفئات والأنماط
     */
    public function register_categories_and_patterns() {
        // أولاً: تسجيل الفئات
        $this->register_pattern_categories();
        
        // ثانياً: تسجيل الأنماط الفردية
        $this->register_all_patterns();
    }

    /**
     * تسجيل فئات الأنماط
     */
    private function register_pattern_categories() {
        // التحقق من وجود الدالة كإجراء وقائي إضافي
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
            // لا حاجة للتحقق مع get_block_pattern_category، ووردبريس يتعامل مع هذا داخلياً
            register_block_pattern_category($slug, ['label' => $label]);
        }
    }

    /**
     * تحميل وتسجيل جميع ملفات الأنماط من مجلد /patterns
     */
    private function register_all_patterns() {
        $patterns_dir = get_template_directory() . '/patterns/';
        
        if (!is_dir($patterns_dir)) {
            return; // الخروج إذا كان المجلد غير موجود
        }

        $pattern_files = glob($patterns_dir . '*.php');
        
        foreach ($pattern_files as $file) {
            // كل ملف نمط مسؤول عن تسجيل نفسه باستخدام register_block_pattern
            require_once $file;
        }
    }
}

// تشغيل النظام
new PS_Block_Patterns_Registry();
