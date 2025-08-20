<?php
/**
 * أنواع المحتوى المخصصة
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تسجيل أنواع المحتوى المخصصة
 */
function fadi_register_post_types() {
    
    // نوع المحتوى: عروض الأسعار
    register_post_type('quote', array(
        'labels' => array(
            'name' => __('عروض الأسعار', 'fadi'),
            'singular_name' => __('عرض سعر', 'fadi'),
            'add_new' => __('إضافة عرض جديد', 'fadi'),
            'add_new_item' => __('إضافة عرض سعر جديد', 'fadi'),
            'edit_item' => __('تعديل عرض السعر', 'fadi'),
            'new_item' => __('عرض سعر جديد', 'fadi'),
            'view_item' => __('عرض السعر', 'fadi'),
            'search_items' => __('البحث في عروض الأسعار', 'fadi'),
            'not_found' => __('لا توجد عروض أسعار', 'fadi'),
            'not_found_in_trash' => __('لا توجد عروض أسعار في المهملات', 'fadi'),
            'all_items' => __('جميع عروض الأسعار', 'fadi'),
            'menu_name' => __('عروض الأسعار', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-clipboard',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'quotes'),
        'show_in_rest' => true,
    ));
    
    // نوع المحتوى: الموردين
    register_post_type('supplier', array(
        'labels' => array(
            'name' => __('الموردين', 'fadi'),
            'singular_name' => __('مورد', 'fadi'),
            'add_new' => __('إضافة مورد جديد', 'fadi'),
            'add_new_item' => __('إضافة مورد جديد', 'fadi'),
            'edit_item' => __('تعديل المورد', 'fadi'),
            'new_item' => __('مورد جديد', 'fadi'),
            'view_item' => __('عرض المورد', 'fadi'),
            'search_items' => __('البحث في الموردين', 'fadi'),
            'not_found' => __('لا يوجد موردين', 'fadi'),
            'not_found_in_trash' => __('لا يوجد موردين في المهملات', 'fadi'),
            'all_items' => __('جميع الموردين', 'fadi'),
            'menu_name' => __('الموردين', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 26,
        'menu_icon' => 'dashicons-store',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'suppliers'),
        'show_in_rest' => true,
    ));
    
    // نوع المحتوى: الموظفين
    register_post_type('employee', array(
        'labels' => array(
            'name' => __('الموظفين', 'fadi'),
            'singular_name' => __('موظف', 'fadi'),
            'add_new' => __('إضافة موظف جديد', 'fadi'),
            'add_new_item' => __('إضافة موظف جديد', 'fadi'),
            'edit_item' => __('تعديل الموظف', 'fadi'),
            'new_item' => __('موظف جديد', 'fadi'),
            'view_item' => __('عرض الموظف', 'fadi'),
            'search_items' => __('البحث في الموظفين', 'fadi'),
            'not_found' => __('لا يوجد موظفين', 'fadi'),
            'not_found_in_trash' => __('لا يوجد موظفين في المهملات', 'fadi'),
            'all_items' => __('جميع الموظفين', 'fadi'),
            'menu_name' => __('الموظفين', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 27,
        'menu_icon' => 'dashicons-groups',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'employees'),
        'show_in_rest' => true,
    ));
    
    // نوع المحتوى: المناقصات
    register_post_type('tender', array(
        'labels' => array(
            'name' => __('المناقصات', 'fadi'),
            'singular_name' => __('مناقصة', 'fadi'),
            'add_new' => __('إضافة مناقصة جديدة', 'fadi'),
            'add_new_item' => __('إضافة مناقصة جديدة', 'fadi'),
            'edit_item' => __('تعديل المناقصة', 'fadi'),
            'new_item' => __('مناقصة جديدة', 'fadi'),
            'view_item' => __('عرض المناقصة', 'fadi'),
            'search_items' => __('البحث في المناقصات', 'fadi'),
            'not_found' => __('لا توجد مناقصات', 'fadi'),
            'not_found_in_trash' => __('لا توجد مناقصات في المهملات', 'fadi'),
            'all_items' => __('جميع المناقصات', 'fadi'),
            'menu_name' => __('المناقصات', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 28,
        'menu_icon' => 'dashicons-building',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'tenders'),
        'show_in_rest' => true,
    ));
    
    // نوع المحتوى: الوثائق الحكومية
    register_post_type('document', array(
        'labels' => array(
            'name' => __('الوثائق الحكومية', 'fadi'),
            'singular_name' => __('وثيقة', 'fadi'),
            'add_new' => __('إضافة وثيقة جديدة', 'fadi'),
            'add_new_item' => __('إضافة وثيقة جديدة', 'fadi'),
            'edit_item' => __('تعديل الوثيقة', 'fadi'),
            'new_item' => __('وثيقة جديدة', 'fadi'),
            'view_item' => __('عرض الوثيقة', 'fadi'),
            'search_items' => __('البحث في الوثائق', 'fadi'),
            'not_found' => __('لا توجد وثائق', 'fadi'),
            'not_found_in_trash' => __('لا توجد وثائق في المهملات', 'fadi'),
            'all_items' => __('جميع الوثائق', 'fadi'),
            'menu_name' => __('الوثائق', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 29,
        'menu_icon' => 'dashicons-media-document',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'documents'),
        'show_in_rest' => true,
    ));
    
    // نوع المحتوى: المهام
    register_post_type('task', array(
        'labels' => array(
            'name' => __('المهام', 'fadi'),
            'singular_name' => __('مهمة', 'fadi'),
            'add_new' => __('إضافة مهمة جديدة', 'fadi'),
            'add_new_item' => __('إضافة مهمة جديدة', 'fadi'),
            'edit_item' => __('تعديل المهمة', 'fadi'),
            'new_item' => __('مهمة جديدة', 'fadi'),
            'view_item' => __('عرض المهمة', 'fadi'),
            'search_items' => __('البحث في المهام', 'fadi'),
            'not_found' => __('لا توجد مهام', 'fadi'),
            'not_found_in_trash' => __('لا توجد مهام في المهملات', 'fadi'),
            'all_items' => __('جميع المهام', 'fadi'),
            'menu_name' => __('المهام', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-dashboard',
        'show_in_admin_bar' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-list-view',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'tasks'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'fadi_register_post_types');

/**
 * تسجيل التصنيفات المخصصة
 */
function fadi_register_taxonomies() {
    
    // تصنيف: فئات عروض الأسعار
    register_taxonomy('quote_category', 'quote', array(
        'labels' => array(
            'name' => __('فئات عروض الأسعار', 'fadi'),
            'singular_name' => __('فئة عرض السعر', 'fadi'),
            'search_items' => __('البحث في الفئات', 'fadi'),
            'all_items' => __('جميع الفئات', 'fadi'),
            'edit_item' => __('تعديل الفئة', 'fadi'),
            'update_item' => __('تحديث الفئة', 'fadi'),
            'add_new_item' => __('إضافة فئة جديدة', 'fadi'),
            'new_item_name' => __('اسم الفئة الجديدة', 'fadi'),
            'menu_name' => __('فئات العروض', 'fadi'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'quote-category'),
        'show_in_rest' => true,
    ));
    
    // تصنيف: حالات عروض الأسعار
    register_taxonomy('quote_status', 'quote', array(
        'labels' => array(
            'name' => __('حالات عروض الأسعار', 'fadi'),
            'singular_name' => __('حالة عرض السعر', 'fadi'),
            'menu_name' => __('حالات العروض', 'fadi'),
        ),
        'hierarchical' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'quote-status'),
        'show_in_rest' => true,
    ));
    
    // تصنيف: فئات الموردين
    register_taxonomy('supplier_category', 'supplier', array(
        'labels' => array(
            'name' => __('فئات الموردين', 'fadi'),
            'singular_name' => __('فئة المورد', 'fadi'),
            'menu_name' => __('فئات الموردين', 'fadi'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'supplier-category'),
        'show_in_rest' => true,
    ));
    
    // تصنيف: أقسام الموظفين
    register_taxonomy('employee_department', 'employee', array(
        'labels' => array(
            'name' => __('أقسام الموظفين', 'fadi'),
            'singular_name' => __('قسم الموظف', 'fadi'),
            'menu_name' => __('الأقسام', 'fadi'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'department'),
        'show_in_rest' => true,
    ));
    
    // تصنيف: حالات المناقصات
    register_taxonomy('tender_status', 'tender', array(
        'labels' => array(
            'name' => __('حالات المناقصات', 'fadi'),
            'singular_name' => __('حالة المناقصة', 'fadi'),
            'menu_name' => __('حالات المناقصات', 'fadi'),
        ),
        'hierarchical' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tender-status'),
        'show_in_rest' => true,
    ));
    
    // تصنيف: أنواع الوثائق
    register_taxonomy('document_type', 'document', array(
        'labels' => array(
            'name' => __('أنواع الوثائق', 'fadi'),
            'singular_name' => __('نوع الوثيقة', 'fadi'),
            'menu_name' => __('أنواع الوثائق', 'fadi'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'document-type'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'fadi_register_taxonomies');

/**
 * إضافة التصنيفات الافتراضية
 */
function fadi_add_default_terms() {
    // حالات عروض الأسعار
    $quote_statuses = array(
        'draft' => __('مسودة', 'fadi'),
        'sent' => __('مرسل', 'fadi'),
        'approved' => __('موافق عليه', 'fadi'),
        'rejected' => __('مرفوض', 'fadi'),
        'expired' => __('منتهي الصلاحية', 'fadi'),
    );
    
    foreach ($quote_statuses as $slug => $name) {
        if (!term_exists($slug, 'quote_status')) {
            wp_insert_term($name, 'quote_status', array('slug' => $slug));
        }
    }
    
    // حالات المناقصات
    $tender_statuses = array(
        'new' => __('جديد', 'fadi'),
        'in_progress' => __('قيد المتابعة', 'fadi'),
        'submitted' => __('تم التقديم', 'fadi'),
        'won' => __('فائز', 'fadi'),
        'lost' => __('خاسر', 'fadi'),
        'cancelled' => __('ملغي', 'fadi'),
    );
    
    foreach ($tender_statuses as $slug => $name) {
        if (!term_exists($slug, 'tender_status')) {
            wp_insert_term($name, 'tender_status', array('slug' => $slug));
        }
    }
    
    // أنواع الوثائق
    $document_types = array(
        'license' => __('رخصة', 'fadi'),
        'certificate' => __('شهادة', 'fadi'),
        'tax' => __('ضريبة', 'fadi'),
        'zakat' => __('زكاة', 'fadi'),
        'insurance' => __('تأمين', 'fadi'),
        'contract' => __('عقد', 'fadi'),
    );
    
    foreach ($document_types as $slug => $name) {
        if (!term_exists($slug, 'document_type')) {
            wp_insert_term($name, 'document_type', array('slug' => $slug));
        }
    }
    
    // أقسام الموظفين
    $departments = array(
        'management' => __('الإدارة', 'fadi'),
        'finance' => __('المالية', 'fadi'),
        'operations' => __('العمليات', 'fadi'),
        'marketing' => __('التسويق', 'fadi'),
        'hr' => __('الموارد البشرية', 'fadi'),
        'it' => __('تقنية المعلومات', 'fadi'),
    );
    
    foreach ($departments as $slug => $name) {
        if (!term_exists($slug, 'employee_department')) {
            wp_insert_term($name, 'employee_department', array('slug' => $slug));
        }
    }
}
add_action('after_switch_theme', 'fadi_add_default_terms');

/**
 * إضافة أعمدة مخصصة لجداول الإدارة
 */
function fadi_add_custom_columns($columns) {
    global $post_type;
    
    switch ($post_type) {
        case 'quote':
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns['title'] = $columns['title'];
            $new_columns['client'] = __('العميل', 'fadi');
            $new_columns['total'] = __('الإجمالي', 'fadi');
            $new_columns['status'] = __('الحالة', 'fadi');
            $new_columns['date'] = $columns['date'];
            return $new_columns;
            
        case 'supplier':
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns['title'] = $columns['title'];
            $new_columns['contact'] = __('جهة الاتصال', 'fadi');
            $new_columns['category'] = __('الفئة', 'fadi');
            $new_columns['rating'] = __('التقييم', 'fadi');
            $new_columns['date'] = $columns['date'];
            return $new_columns;
            
        case 'employee':
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns['title'] = $columns['title'];
            $new_columns['position'] = __('المنصب', 'fadi');
            $new_columns['department'] = __('القسم', 'fadi');
            $new_columns['status'] = __('الحالة', 'fadi');
            $new_columns['date'] = $columns['date'];
            return $new_columns;
            
        case 'tender':
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns['title'] = $columns['title'];
            $new_columns['organization'] = __('الجهة', 'fadi');
            $new_columns['deadline'] = __('الموعد النهائي', 'fadi');
            $new_columns['status'] = __('الحالة', 'fadi');
            $new_columns['date'] = $columns['date'];
            return $new_columns;
            
        case 'document':
            $new_columns = array();
            $new_columns['cb'] = $columns['cb'];
            $new_columns['title'] = $columns['title'];
            $new_columns['type'] = __('النوع', 'fadi');
            $new_columns['expiry'] = __('تاريخ الانتهاء', 'fadi');
            $new_columns['status'] = __('الحالة', 'fadi');
            $new_columns['date'] = $columns['date'];
            return $new_columns;
    }
    
    return $columns;
}
add_filter('manage_posts_columns', 'fadi_add_custom_columns');

/**
 * ملء الأعمدة المخصصة بالبيانات
 */
function fadi_custom_column_content($column, $post_id) {
    global $post_type;
    
    switch ($post_type) {
        case 'quote':
            switch ($column) {
                case 'client':
                    echo get_post_meta($post_id, 'client_name', true);
                    break;
                case 'total':
                    $total = get_post_meta($post_id, 'quote_total', true);
                    echo $total ? number_format($total, 2) . ' ر.س' : '-';
                    break;
                case 'status':
                    $terms = get_the_terms($post_id, 'quote_status');
                    echo $terms ? $terms[0]->name : __('غير محدد', 'fadi');
                    break;
            }
            break;
            
        case 'supplier':
            switch ($column) {
                case 'contact':
                    echo get_post_meta($post_id, 'supplier_contact', true);
                    break;
                case 'category':
                    $terms = get_the_terms($post_id, 'supplier_category');
                    echo $terms ? $terms[0]->name : '-';
                    break;
                case 'rating':
                    $rating = get_post_meta($post_id, 'supplier_rating', true);
                    echo $rating ? str_repeat('⭐', $rating) : '-';
                    break;
            }
            break;
            
        case 'employee':
            switch ($column) {
                case 'position':
                    echo get_post_meta($post_id, 'employee_position', true);
                    break;
                case 'department':
                    $terms = get_the_terms($post_id, 'employee_department');
                    echo $terms ? $terms[0]->name : '-';
                    break;
                case 'status':
                    $status = get_post_meta($post_id, 'employee_status', true);
                    echo $status ? ucfirst($status) : __('نشط', 'fadi');
                    break;
            }
            break;
            
        case 'tender':
            switch ($column) {
                case 'organization':
                    echo get_post_meta($post_id, 'tender_organization', true);
                    break;
                case 'deadline':
                    $deadline = get_post_meta($post_id, 'tender_deadline', true);
                    if ($deadline) {
                        $date = new DateTime($deadline);
                        echo $date->format('Y-m-d');
                        
                        // تحذير إذا كان الموعد قريب
                        $days_left = $date->diff(new DateTime())->days;
                        if ($days_left <= 7) {
                            echo ' <span style="color: red;">⚠️</span>';
                        }
                    }
                    break;
                case 'status':
                    $terms = get_the_terms($post_id, 'tender_status');
                    echo $terms ? $terms[0]->name : '-';
                    break;
            }
            break;
            
        case 'document':
            switch ($column) {
                case 'type':
                    $terms = get_the_terms($post_id, 'document_type');
                    echo $terms ? $terms[0]->name : '-';
                    break;
                case 'expiry':
                    $expiry = get_post_meta($post_id, 'document_expiry', true);
                    if ($expiry) {
                        $date = new DateTime($expiry);
                        echo $date->format('Y-m-d');
                        
                        // تحذير إذا كانت الوثيقة ستنتهي قريباً
                        $days_left = $date->diff(new DateTime())->days;
                        if ($days_left <= 30) {
                            echo ' <span style="color: orange;">⚠️</span>';
                        }
                    }
                    break;
                case 'status':
                    $expiry = get_post_meta($post_id, 'document_expiry', true);
                    if ($expiry) {
                        $date = new DateTime($expiry);
                        $now = new DateTime();
                        
                        if ($date < $now) {
                            echo '<span style="color: red;">' . __('منتهي', 'fadi') . '</span>';
                        } else {
                            $days_left = $date->diff($now)->days;
                            if ($days_left <= 30) {
                                echo '<span style="color: orange;">' . sprintf(__('ينتهي خلال %d يوم', 'fadi'), $days_left) . '</span>';
                            } else {
                                echo '<span style="color: green;">' . __('ساري', 'fadi') . '</span>';
                            }
                        }
                    } else {
                        echo '-';
                    }
                    break;
            }
            break;
    }
}
add_action('manage_posts_custom_column', 'fadi_custom_column_content', 10, 2);

/**
 * جعل الأعمدة قابلة للترتيب
 */
function fadi_sortable_columns($columns) {
    global $post_type;
    
    switch ($post_type) {
        case 'quote':
            $columns['total'] = 'quote_total';
            $columns['client'] = 'client_name';
            break;
            
        case 'supplier':
            $columns['rating'] = 'supplier_rating';
            break;
            
        case 'tender':
            $columns['deadline'] = 'tender_deadline';
            break;
            
        case 'document':
            $columns['expiry'] = 'document_expiry';
            break;
    }
    
    return $columns;
}
add_filter('manage_edit-quote_sortable_columns', 'fadi_sortable_columns');
add_filter('manage_edit-supplier_sortable_columns', 'fadi_sortable_columns');
add_filter('manage_edit-tender_sortable_columns', 'fadi_sortable_columns');
add_filter('manage_edit-document_sortable_columns', 'fadi_sortable_columns');

/**
 * معالجة الترتيب للأعمدة المخصصة
 */
function fadi_custom_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    switch ($orderby) {
        case 'quote_total':
        case 'client_name':
        case 'supplier_rating':
        case 'tender_deadline':
        case 'document_expiry':
            $query->set('meta_key', $orderby);
            $query->set('orderby', 'meta_value_num');
            break;
    }
}
add_action('pre_get_posts', 'fadi_custom_orderby');