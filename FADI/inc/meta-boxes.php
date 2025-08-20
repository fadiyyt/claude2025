<?php
/**
 * صناديق البيانات الوصفية المخصصة
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إضافة صناديق البيانات الوصفية
 */
function fadi_add_meta_boxes() {
    
    // صندوق بيانات عرض السعر
    add_meta_box(
        'fadi_quote_details',
        __('تفاصيل عرض السعر', 'fadi'),
        'fadi_quote_details_callback',
        'quote',
        'normal',
        'high'
    );
    
    // صندوق بيانات المورد
    add_meta_box(
        'fadi_supplier_details',
        __('تفاصيل المورد', 'fadi'),
        'fadi_supplier_details_callback',
        'supplier',
        'normal',
        'high'
    );
    
    // صندوق بيانات الموظف
    add_meta_box(
        'fadi_employee_details',
        __('تفاصيل الموظف', 'fadi'),
        'fadi_employee_details_callback',
        'employee',
        'normal',
        'high'
    );
    
    // صندوق بيانات المناقصة
    add_meta_box(
        'fadi_tender_details',
        __('تفاصيل المناقصة', 'fadi'),
        'fadi_tender_details_callback',
        'tender',
        'normal',
        'high'
    );
    
    // صندوق بيانات الوثيقة
    add_meta_box(
        'fadi_document_details',
        __('تفاصيل الوثيقة', 'fadi'),
        'fadi_document_details_callback',
        'document',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'fadi_add_meta_boxes');

/**
 * صندوق بيانات عرض السعر
 */
function fadi_quote_details_callback($post) {
    wp_nonce_field('fadi_save_quote_meta', 'fadi_quote_meta_nonce');
    
    $client_name = get_post_meta($post->ID, 'client_name', true);
    $client_email = get_post_meta($post->ID, 'client_email', true);
    $client_phone = get_post_meta($post->ID, 'client_phone', true);
    $quote_date = get_post_meta($post->ID, 'quote_date', true);
    $valid_until = get_post_meta($post->ID, 'valid_until', true);
    $quote_items = get_post_meta($post->ID, 'quote_items', true);
    $subtotal = get_post_meta($post->ID, 'subtotal', true);
    $vat_rate = get_post_meta($post->ID, 'vat_rate', true) ?: 15;
    $vat_amount = get_post_meta($post->ID, 'vat_amount', true);
    $total_amount = get_post_meta($post->ID, 'total_amount', true);
    $notes = get_post_meta($post->ID, 'quote_notes', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="client_name"><?php _e('اسم العميل', 'fadi'); ?></label></th>
            <td><input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" class="regular-text" required /></td>
        </tr>
        <tr>
            <th><label for="client_email"><?php _e('بريد العميل الإلكتروني', 'fadi'); ?></label></th>
            <td><input type="email" id="client_email" name="client_email" value="<?php echo esc_attr($client_email); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="client_phone"><?php _e('هاتف العميل', 'fadi'); ?></label></th>
            <td><input type="tel" id="client_phone" name="client_phone" value="<?php echo esc_attr($client_phone); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="quote_date"><?php _e('تاريخ العرض', 'fadi'); ?></label></th>
            <td><input type="date" id="quote_date" name="quote_date" value="<?php echo esc_attr($quote_date); ?>" required /></td>
        </tr>
        <tr>
            <th><label for="valid_until"><?php _e('صالح حتى', 'fadi'); ?></label></th>
            <td><input type="date" id="valid_until" name="valid_until" value="<?php echo esc_attr($valid_until); ?>" /></td>
        </tr>
    </table>
    
    <h3><?php _e('بنود العرض', 'fadi'); ?></h3>
    <div id="quote-items">
        <?php 
        $items = $quote_items ? json_decode($quote_items, true) : array();
        if (empty($items)) {
            $items = array(array('description' => '', 'unit' => 'piece', 'quantity' => 1, 'price' => 0));
        }
        
        foreach ($items as $index => $item): ?>
        <div class="quote-item" data-index="<?php echo $index; ?>">
            <table class="widefat">
                <tr>
                    <td>
                        <label><?php _e('الوصف', 'fadi'); ?></label>
                        <input type="text" name="quote_items[<?php echo $index; ?>][description]" value="<?php echo esc_attr($item['description']); ?>" class="regular-text" />
                    </td>
                    <td>
                        <label><?php _e('الوحدة', 'fadi'); ?></label>
                        <select name="quote_items[<?php echo $index; ?>][unit]" class="unit-select">
                            <option value="piece" <?php selected($item['unit'], 'piece'); ?>><?php _e('حبة', 'fadi'); ?></option>
                            <option value="m2" <?php selected($item['unit'], 'm2'); ?>><?php _e('متر مربع', 'fadi'); ?></option>
                            <option value="meter" <?php selected($item['unit'], 'meter'); ?>><?php _e('متر طولي', 'fadi'); ?></option>
                            <option value="kg" <?php selected($item['unit'], 'kg'); ?>><?php _e('كيلوجرام', 'fadi'); ?></option>
                            <option value="hour" <?php selected($item['unit'], 'hour'); ?>><?php _e('ساعة', 'fadi'); ?></option>
                        </select>
                    </td>
                    <td class="dimensions-fields" style="<?php echo ($item['unit'] === 'm2') ? '' : 'display:none;'; ?>">
                        <label><?php _e('الطول', 'fadi'); ?></label>
                        <input type="number" name="quote_items[<?php echo $index; ?>][length]" value="<?php echo esc_attr($item['length'] ?? ''); ?>" step="0.01" class="small-text length-input" />
                        <label><?php _e('العرض', 'fadi'); ?></label>
                        <input type="number" name="quote_items[<?php echo $index; ?>][width]" value="<?php echo esc_attr($item['width'] ?? ''); ?>" step="0.01" class="small-text width-input" />
                    </td>
                    <td class="quantity-field" style="<?php echo ($item['unit'] !== 'm2') ? '' : 'display:none;'; ?>">
                        <label><?php _e('الكمية', 'fadi'); ?></label>
                        <input type="number" name="quote_items[<?php echo $index; ?>][quantity]" value="<?php echo esc_attr($item['quantity']); ?>" step="0.01" class="small-text quantity-input" />
                    </td>
                    <td>
                        <label><?php _e('السعر', 'fadi'); ?></label>
                        <input type="number" name="quote_items[<?php echo $index; ?>][price]" value="<?php echo esc_attr($item['price']); ?>" step="0.01" class="regular-text price-input" />
                    </td>
                    <td>
                        <label><?php _e('الإجمالي', 'fadi'); ?></label>
                        <span class="item-total"><?php echo number_format($item['quantity'] * $item['price'], 2); ?></span>
                    </td>
                    <td>
                        <button type="button" class="button remove-item"><?php _e('حذف', 'fadi'); ?></button>
                    </td>
                </tr>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    
    <p>
        <button type="button" id="add-quote-item" class="button"><?php _e('إضافة بند جديد', 'fadi'); ?></button>
    </p>
    
    <h3><?php _e('الإجماليات', 'fadi'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="subtotal"><?php _e('المجموع الفرعي', 'fadi'); ?></label></th>
            <td><input type="number" id="subtotal" name="subtotal" value="<?php echo esc_attr($subtotal); ?>" step="0.01" class="regular-text" readonly /></td>
        </tr>
        <tr>
            <th><label for="vat_rate"><?php _e('نسبة الضريبة المضافة (%)', 'fadi'); ?></label></th>
            <td><input type="number" id="vat_rate" name="vat_rate" value="<?php echo esc_attr($vat_rate); ?>" step="0.01" max="100" class="small-text" /></td>
        </tr>
        <tr>
            <th><label for="vat_amount"><?php _e('مبلغ الضريبة المضافة', 'fadi'); ?></label></th>
            <td><input type="number" id="vat_amount" name="vat_amount" value="<?php echo esc_attr($vat_amount); ?>" step="0.01" class="regular-text" readonly /></td>
        </tr>
        <tr>
            <th><label for="total_amount"><?php _e('الإجمالي الكلي', 'fadi'); ?></label></th>
            <td><input type="number" id="total_amount" name="total_amount" value="<?php echo esc_attr($total_amount); ?>" step="0.01" class="regular-text" readonly /></td>
        </tr>
    </table>
    
    <h3><?php _e('ملاحظات', 'fadi'); ?></h3>
    <p>
        <textarea name="quote_notes" rows="4" class="large-text"><?php echo esc_textarea($notes); ?></textarea>
    </p>
    
    <script>
    jQuery(document).ready(function($) {
        // حساب الإجماليات تلقائياً
        function calculateTotals() {
            var subtotal = 0;
            
            $('.quote-item').each(function() {
                var unit = $(this).find('.unit-select').val();
                var quantity = 0;
                var price = parseFloat($(this).find('.price-input').val()) || 0;
                
                if (unit === 'm2') {
                    var length = parseFloat($(this).find('.length-input').val()) || 0;
                    var width = parseFloat($(this).find('.width-input').val()) || 0;
                    quantity = length * width;
                } else {
                    quantity = parseFloat($(this).find('.quantity-input').val()) || 0;
                }
                
                var itemTotal = quantity * price;
                $(this).find('.item-total').text(itemTotal.toFixed(2));
                subtotal += itemTotal;
            });
            
            $('#subtotal').val(subtotal.toFixed(2));
            
            var vatRate = parseFloat($('#vat_rate').val()) || 0;
            var vatAmount = subtotal * (vatRate / 100);
            var totalAmount = subtotal + vatAmount;
            
            $('#vat_amount').val(vatAmount.toFixed(2));
            $('#total_amount').val(totalAmount.toFixed(2));
        }
        
        // تغيير نوع الوحدة
        $(document).on('change', '.unit-select', function() {
            var $item = $(this).closest('.quote-item');
            var unit = $(this).val();
            
            if (unit === 'm2') {
                $item.find('.dimensions-fields').show();
                $item.find('.quantity-field').hide();
            } else {
                $item.find('.dimensions-fields').hide();
                $item.find('.quantity-field').show();
            }
            
            calculateTotals();
        });
        
        // حساب تلقائي عند تغيير القيم
        $(document).on('input', '.length-input, .width-input, .quantity-input, .price-input, #vat_rate', calculateTotals);
        
        // إضافة بند جديد
        $('#add-quote-item').click(function() {
            var index = $('.quote-item').length;
            var newItem = `
                <div class="quote-item" data-index="${index}">
                    <table class="widefat">
                        <tr>
                            <td>
                                <label><?php _e('الوصف', 'fadi'); ?></label>
                                <input type="text" name="quote_items[${index}][description]" value="" class="regular-text" />
                            </td>
                            <td>
                                <label><?php _e('الوحدة', 'fadi'); ?></label>
                                <select name="quote_items[${index}][unit]" class="unit-select">
                                    <option value="piece"><?php _e('حبة', 'fadi'); ?></option>
                                    <option value="m2"><?php _e('متر مربع', 'fadi'); ?></option>
                                    <option value="meter"><?php _e('متر طولي', 'fadi'); ?></option>
                                    <option value="kg"><?php _e('كيلوجرام', 'fadi'); ?></option>
                                    <option value="hour"><?php _e('ساعة', 'fadi'); ?></option>
                                </select>
                            </td>
                            <td class="dimensions-fields" style="display:none;">
                                <label><?php _e('الطول', 'fadi'); ?></label>
                                <input type="number" name="quote_items[${index}][length]" value="" step="0.01" class="small-text length-input" />
                                <label><?php _e('العرض', 'fadi'); ?></label>
                                <input type="number" name="quote_items[${index}][width]" value="" step="0.01" class="small-text width-input" />
                            </td>
                            <td class="quantity-field">
                                <label><?php _e('الكمية', 'fadi'); ?></label>
                                <input type="number" name="quote_items[${index}][quantity]" value="1" step="0.01" class="small-text quantity-input" />
                            </td>
                            <td>
                                <label><?php _e('السعر', 'fadi'); ?></label>
                                <input type="number" name="quote_items[${index}][price]" value="0" step="0.01" class="regular-text price-input" />
                            </td>
                            <td>
                                <label><?php _e('الإجمالي', 'fadi'); ?></label>
                                <span class="item-total">0.00</span>
                            </td>
                            <td>
                                <button type="button" class="button remove-item"><?php _e('حذف', 'fadi'); ?></button>
                            </td>
                        </tr>
                    </table>
                </div>
            `;
            $('#quote-items').append(newItem);
        });
        
        // حذف بند
        $(document).on('click', '.remove-item', function() {
            if ($('.quote-item').length > 1) {
                $(this).closest('.quote-item').remove();
                calculateTotals();
            } else {
                alert('<?php _e('لا يمكن حذف جميع البنود', 'fadi'); ?>');
            }
        });
        
        // حساب أولي
        calculateTotals();
    });
    </script>
    
    <style>
    .quote-item {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
    }
    .quote-item table {
        margin: 0;
    }
    .quote-item td {
        padding: 5px;
        vertical-align: top;
    }
    .quote-item label {
        display: block;
        font-weight: 600;
        margin-bottom: 3px;
        font-size: 12px;
    }
    .item-total {
        font-weight: bold;
        color: #0073aa;
    }
    .small-text {
        width: 80px;
    }
    </style>
    <?php
}

/**
 * صندوق بيانات المورد
 */
function fadi_supplier_details_callback($post) {
    wp_nonce_field('fadi_save_supplier_meta', 'fadi_supplier_meta_nonce');
    
    $contact_person = get_post_meta($post->ID, 'contact_person', true);
    $contact_email = get_post_meta($post->ID, 'contact_email', true);
    $contact_phone = get_post_meta($post->ID, 'contact_phone', true);
    $company_address = get_post_meta($post->ID, 'company_address', true);
    $tax_number = get_post_meta($post->ID, 'tax_number', true);
    $payment_terms = get_post_meta($post->ID, 'payment_terms', true);
    $rating = get_post_meta($post->ID, 'supplier_rating', true);
    $notes = get_post_meta($post->ID, 'supplier_notes', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="contact_person"><?php _e('جهة الاتصال', 'fadi'); ?></label></th>
            <td><input type="text" id="contact_person" name="contact_person" value="<?php echo esc_attr($contact_person); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="contact_email"><?php _e('البريد الإلكتروني', 'fadi'); ?></label></th>
            <td><input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="contact_phone"><?php _e('رقم الهاتف', 'fadi'); ?></label></th>
            <td><input type="tel" id="contact_phone" name="contact_phone" value="<?php echo esc_attr($contact_phone); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="company_address"><?php _e('عنوان الشركة', 'fadi'); ?></label></th>
            <td><textarea id="company_address" name="company_address" rows="3" class="large-text"><?php echo esc_textarea($company_address); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="tax_number"><?php _e('الرقم الضريبي', 'fadi'); ?></label></th>
            <td><input type="text" id="tax_number" name="tax_number" value="<?php echo esc_attr($tax_number); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="payment_terms"><?php _e('شروط الدفع', 'fadi'); ?></label></th>
            <td>
                <select id="payment_terms" name="payment_terms">
                    <option value="cash" <?php selected($payment_terms, 'cash'); ?>><?php _e('نقدي', 'fadi'); ?></option>
                    <option value="30_days" <?php selected($payment_terms, '30_days'); ?>><?php _e('30 يوم', 'fadi'); ?></option>
                    <option value="60_days" <?php selected($payment_terms, '60_days'); ?>><?php _e('60 يوم', 'fadi'); ?></option>
                    <option value="90_days" <?php selected($payment_terms, '90_days'); ?>><?php _e('90 يوم', 'fadi'); ?></option>
                    <option value="other" <?php selected($payment_terms, 'other'); ?>><?php _e('أخرى', 'fadi'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="supplier_rating"><?php _e('التقييم', 'fadi'); ?></label></th>
            <td>
                <select id="supplier_rating" name="supplier_rating">
                    <option value=""><?php _e('غير مقيم', 'fadi'); ?></option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo str_repeat('⭐', $i); ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="supplier_notes"><?php _e('ملاحظات', 'fadi'); ?></label></th>
            <td><textarea id="supplier_notes" name="supplier_notes" rows="4" class="large-text"><?php echo esc_textarea($notes); ?></textarea></td>
        </tr>
    </table>
    <?php
}

/**
 * صندوق بيانات الموظف
 */
function fadi_employee_details_callback($post) {
    wp_nonce_field('fadi_save_employee_meta', 'fadi_employee_meta_nonce');
    
    $employee_id = get_post_meta($post->ID, 'employee_id', true);
    $position = get_post_meta($post->ID, 'employee_position', true);
    $email = get_post_meta($post->ID, 'employee_email', true);
    $phone = get_post_meta($post->ID, 'employee_phone', true);
    $hire_date = get_post_meta($post->ID, 'hire_date', true);
    $salary = get_post_meta($post->ID, 'employee_salary', true);
    $status = get_post_meta($post->ID, 'employee_status', true);
    $emergency_contact = get_post_meta($post->ID, 'emergency_contact', true);
    $emergency_phone = get_post_meta($post->ID, 'emergency_phone', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="employee_id"><?php _e('رقم الموظف', 'fadi'); ?></label></th>
            <td><input type="text" id="employee_id" name="employee_id" value="<?php echo esc_attr($employee_id); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="employee_position"><?php _e('المنصب', 'fadi'); ?></label></th>
            <td><input type="text" id="employee_position" name="employee_position" value="<?php echo esc_attr($position); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="employee_email"><?php _e('البريد الإلكتروني', 'fadi'); ?></label></th>
            <td><input type="email" id="employee_email" name="employee_email" value="<?php echo esc_attr($email); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="employee_phone"><?php _e('رقم الهاتف', 'fadi'); ?></label></th>
            <td><input type="tel" id="employee_phone" name="employee_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="hire_date"><?php _e('تاريخ التوظيف', 'fadi'); ?></label></th>
            <td><input type="date" id="hire_date" name="hire_date" value="<?php echo esc_attr($hire_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="employee_salary"><?php _e('الراتب', 'fadi'); ?></label></th>
            <td><input type="number" id="employee_salary" name="employee_salary" value="<?php echo esc_attr($salary); ?>" step="0.01" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="employee_status"><?php _e('حالة الموظف', 'fadi'); ?></label></th>
            <td>
                <select id="employee_status" name="employee_status">
                    <option value="active" <?php selected($status, 'active'); ?>><?php _e('نشط', 'fadi'); ?></option>
                    <option value="inactive" <?php selected($status, 'inactive'); ?>><?php _e('غير نشط', 'fadi'); ?></option>
                    <option value="on_leave" <?php selected($status, 'on_leave'); ?>><?php _e('في إجازة', 'fadi'); ?></option>
                    <option value="terminated" <?php selected($status, 'terminated'); ?>><?php _e('منتهي الخدمة', 'fadi'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="emergency_contact"><?php _e('جهة الاتصال في الطوارئ', 'fadi'); ?></label></th>
            <td><input type="text" id="emergency_contact" name="emergency_contact" value="<?php echo esc_attr($emergency_contact); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="emergency_phone"><?php _e('هاتف الطوارئ', 'fadi'); ?></label></th>
            <td><input type="tel" id="emergency_phone" name="emergency_phone" value="<?php echo esc_attr($emergency_phone); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

/**
 * صندوق بيانات المناقصة
 */
function fadi_tender_details_callback($post) {
    wp_nonce_field('fadi_save_tender_meta', 'fadi_tender_meta_nonce');
    
    $organization = get_post_meta($post->ID, 'tender_organization', true);
    $reference_number = get_post_meta($post->ID, 'reference_number', true);
    $deadline = get_post_meta($post->ID, 'tender_deadline', true);
    $budget = get_post_meta($post->ID, 'tender_budget', true);
    $our_bid = get_post_meta($post->ID, 'our_bid', true);
    $documents = get_post_meta($post->ID, 'required_documents', true);
    $contact_person = get_post_meta($post->ID, 'tender_contact', true);
    $notes = get_post_meta($post->ID, 'tender_notes', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="tender_organization"><?php _e('الجهة المناقصة', 'fadi'); ?></label></th>
            <td><input type="text" id="tender_organization" name="tender_organization" value="<?php echo esc_attr($organization); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="reference_number"><?php _e('رقم المرجع', 'fadi'); ?></label></th>
            <td><input type="text" id="reference_number" name="reference_number" value="<?php echo esc_attr($reference_number); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="tender_deadline"><?php _e('الموعد النهائي', 'fadi'); ?></label></th>
            <td><input type="datetime-local" id="tender_deadline" name="tender_deadline" value="<?php echo esc_attr($deadline); ?>" /></td>
        </tr>
        <tr>
            <th><label for="tender_budget"><?php _e('الميزانية المتوقعة', 'fadi'); ?></label></th>
            <td><input type="number" id="tender_budget" name="tender_budget" value="<?php echo esc_attr($budget); ?>" step="0.01" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="our_bid"><?php _e('عرضنا', 'fadi'); ?></label></th>
            <td><input type="number" id="our_bid" name="our_bid" value="<?php echo esc_attr($our_bid); ?>" step="0.01" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="required_documents"><?php _e('الوثائق المطلوبة', 'fadi'); ?></label></th>
            <td><textarea id="required_documents" name="required_documents" rows="4" class="large-text"><?php echo esc_textarea($documents); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="tender_contact"><?php _e('جهة الاتصال', 'fadi'); ?></label></th>
            <td><input type="text" id="tender_contact" name="tender_contact" value="<?php echo esc_attr($contact_person); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="tender_notes"><?php _e('ملاحظات', 'fadi'); ?></label></th>
            <td><textarea id="tender_notes" name="tender_notes" rows="4" class="large-text"><?php echo esc_textarea($notes); ?></textarea></td>
        </tr>
    </table>
    <?php
}

/**
 * صندوق بيانات الوثيقة
 */
function fadi_document_details_callback($post) {
    wp_nonce_field('fadi_save_document_meta', 'fadi_document_meta_nonce');
    
    $document_number = get_post_meta($post->ID, 'document_number', true);
    $issue_date = get_post_meta($post->ID, 'issue_date', true);
    $expiry_date = get_post_meta($post->ID, 'expiry_date', true);
    $issuing_authority = get_post_meta($post->ID, 'issuing_authority', true);
    $renewal_required = get_post_meta($post->ID, 'renewal_required', true);
    $file_attachment = get_post_meta($post->ID, 'file_attachment', true);
    $notes = get_post_meta($post->ID, 'document_notes', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="document_number"><?php _e('رقم الوثيقة', 'fadi'); ?></label></th>
            <td><input type="text" id="document_number" name="document_number" value="<?php echo esc_attr($document_number); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="issue_date"><?php _e('تاريخ الإصدار', 'fadi'); ?></label></th>
            <td><input type="date" id="issue_date" name="issue_date" value="<?php echo esc_attr($issue_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="expiry_date"><?php _e('تاريخ الانتهاء', 'fadi'); ?></label></th>
            <td><input type="date" id="expiry_date" name="expiry_date" value="<?php echo esc_attr($expiry_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="issuing_authority"><?php _e('الجهة المصدرة', 'fadi'); ?></label></th>
            <td><input type="text" id="issuing_authority" name="issuing_authority" value="<?php echo esc_attr($issuing_authority); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="renewal_required"><?php _e('يتطلب تجديد', 'fadi'); ?></label></th>
            <td>
                <input type="checkbox" id="renewal_required" name="renewal_required" value="1" <?php checked($renewal_required, '1'); ?> />
                <label for="renewal_required"><?php _e('نعم، هذه الوثيقة تحتاج تجديد دوري', 'fadi'); ?></label>
            </td>
        </tr>
        <tr>
            <th><label for="file_attachment"><?php _e('ملف الوثيقة', 'fadi'); ?></label></th>
            <td>
                <input type="url" id="file_attachment" name="file_attachment" value="<?php echo esc_attr($file_attachment); ?>" class="regular-text" />
                <button type="button" class="button upload-document"><?php _e('رفع ملف', 'fadi'); ?></button>
                <?php if ($file_attachment): ?>
                    <p><a href="<?php echo esc_url($file_attachment); ?>" target="_blank"><?php _e('عرض الملف', 'fadi'); ?></a></p>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="document_notes"><?php _e('ملاحظات', 'fadi'); ?></label></th>
            <td><textarea id="document_notes" name="document_notes" rows="4" class="large-text"><?php echo esc_textarea($notes); ?></textarea></td>
        </tr>
    </table>
    
    <script>
    jQuery(document).ready(function($) {
        $('.upload-document').click(function(e) {
            e.preventDefault();
            
            var mediaUploader = wp.media({
                title: 'رفع وثيقة',
                button: {
                    text: 'اختر الملف'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#file_attachment').val(attachment.url);
            });
            
            mediaUploader.open();
        });
        
        // تحذير انتهاء الصلاحية
        $('#expiry_date').change(function() {
            var expiryDate = new Date($(this).val());
            var today = new Date();
            var diffTime = expiryDate - today;
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays < 30 && diffDays > 0) {
                alert('تحذير: هذه الوثيقة ستنتهي خلال ' + diffDays + ' يوم');
            } else if (diffDays <= 0) {
                alert('تحذير: هذه الوثيقة منتهية الصلاحية');
            }
        });
    });
    </script>
    <?php
}

/**
 * حفظ البيانات الوصفية
 */
function fadi_save_meta_boxes($post_id) {
    // التحقق من الصلاحيات
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // حفظ بيانات عرض السعر
    if (isset($_POST['fadi_quote_meta_nonce']) && wp_verify_nonce($_POST['fadi_quote_meta_nonce'], 'fadi_save_quote_meta')) {
        $fields = array(
            'client_name', 'client_email', 'client_phone', 'quote_date', 'valid_until',
            'subtotal', 'vat_rate', 'vat_amount', 'total_amount', 'quote_notes'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
        
        // حفظ بنود العرض
        if (isset($_POST['quote_items'])) {
            update_post_meta($post_id, 'quote_items', json_encode($_POST['quote_items']));
        }
    }
    
    // حفظ بيانات المورد
    if (isset($_POST['fadi_supplier_meta_nonce']) && wp_verify_nonce($_POST['fadi_supplier_meta_nonce'], 'fadi_save_supplier_meta')) {
        $fields = array(
            'contact_person', 'contact_email', 'contact_phone', 'company_address',
            'tax_number', 'payment_terms', 'supplier_rating', 'supplier_notes'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    
    // حفظ بيانات الموظف
    if (isset($_POST['fadi_employee_meta_nonce']) && wp_verify_nonce($_POST['fadi_employee_meta_nonce'], 'fadi_save_employee_meta')) {
        $fields = array(
            'employee_id', 'employee_position', 'employee_email', 'employee_phone',
            'hire_date', 'employee_salary', 'employee_status', 'emergency_contact', 'emergency_phone'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    
    // حفظ بيانات المناقصة
    if (isset($_POST['fadi_tender_meta_nonce']) && wp_verify_nonce($_POST['fadi_tender_meta_nonce'], 'fadi_save_tender_meta')) {
        $fields = array(
            'tender_organization', 'reference_number', 'tender_deadline', 'tender_budget',
            'our_bid', 'required_documents', 'tender_contact', 'tender_notes'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    
    // حفظ بيانات الوثيقة
    if (isset($_POST['fadi_document_meta_nonce']) && wp_verify_nonce($_POST['fadi_document_meta_nonce'], 'fadi_save_document_meta')) {
        $fields = array(
            'document_number', 'issue_date', 'expiry_date', 'issuing_authority',
            'renewal_required', 'file_attachment', 'document_notes'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
        
        // إضافة تذكير للوثائق المنتهية الصلاحية
        if (isset($_POST['expiry_date']) && $_POST['expiry_date']) {
            $expiry_date = new DateTime($_POST['expiry_date']);
            $reminder_date = clone $expiry_date;
            $reminder_date->sub(new DateInterval('P30D')); // 30 يوم قبل الانتهاء
            
            wp_schedule_single_event(
                $reminder_date->getTimestamp(),
                'fadi_document_expiry_reminder',
                array($post_id)
            );
        }
    }
}
add_action('save_post', 'fadi_save_meta_boxes');

/**
 * تذكير انتهاء الوثائق
 */
function fadi_document_expiry_reminder($post_id) {
    $post = get_post($post_id);
    $expiry_date = get_post_meta($post_id, 'expiry_date', true);
    
    // إرسال بريد إلكتروني
    $to = get_option('admin_email');
    $subject = sprintf(__('تذكير: انتهاء صلاحية الوثيقة %s', 'fadi'), $post->post_title);
    $message = sprintf(
        __('الوثيقة "%s" ستنتهي صلاحيتها في %s. يرجى اتخاذ الإجراءات اللازمة للتجديد.', 'fadi'),
        $post->post_title,
        $expiry_date
    );
    
    wp_mail($to, $subject, $message);
}
add_action('fadi_document_expiry_reminder', 'fadi_document_expiry_reminder');