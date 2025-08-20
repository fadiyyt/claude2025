<?php
/**
 * Title: تخطيط لوحة التحكم
 * Slug: fadi/dashboard-layout
 * Categories: fadi-patterns
 * Keywords: dashboard, layout, control panel
 * Description: تخطيط كامل للوحة تحكم بالبطاقات والإحصائيات
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding:var(--wp--preset--spacing--40)">
    
    <!-- عنوان لوحة التحكم -->
    <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
    <h1 class="wp-block-heading has-text-align-center" style="color:#333;margin-bottom:var(--wp--preset--spacing--50);font-size:2.5rem;font-weight:700">لوحة التحكم الرئيسية</h1>
    <!-- /wp:heading -->
    
    <!-- البطاقات الرئيسية -->
    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
    <div class="wp-block-columns">
        
        <!-- بطاقة عروض الأسعار -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">📋</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">عروض الأسعار والعقود</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">إنشاء وإدارة عروض الأسعار مع حساب تلقائي للمبالغ والضرائب</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/quotes/" style="border-radius:5px">إدارة العروض</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- بطاقة إدارة المشتريات -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">🛒</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">إدارة المشتريات</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">قائمة الموردين وإدارة الأسعار والمنتجات</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/purchases/" style="border-radius:5px">إدارة المشتريات</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- بطاقة شؤون الموظفين -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">👥</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">شؤون الموظفين</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">ملفات الموظفين والعهد ومتابعة المهام</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/employees/" style="border-radius:5px">إدارة الموظفين</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->
    
    <!-- الصف الثاني من البطاقات -->
    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|30"}}}} -->
    <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--30)">
        
        <!-- بطاقة المناقصات -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">🏢</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">منصة اعتماد والمناقصات</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">تسجيل ومتابعة المناقصات مع نظام التنبيهات</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/tenders/" style="border-radius:5px">إدارة المناقصات</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- بطاقة الوثائق -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">📄</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">الوثائق الحكومية</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">تخزين الوثائق الرسمية مع تنبيهات التجديد</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/documents/" style="border-radius:5px">إدارة الوثائق</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- بطاقة الإعدادات -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"all":"var:preset|spacing|30"}},"color":{"background":"#ffffff"},"border":{"radius":"10px","right":{"color":"#667eea","width":"4px"}}},"className":"dashboard-card","layout":{"type":"default"}} -->
            <div class="wp-block-group dashboard-card has-background" style="background-color:#ffffff;border-radius:10px;border-right-color:#667eea;border-right-width:4px;padding:var(--wp--preset--spacing--30)">
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--15);font-size:2rem">⚙️</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3rem","fontWeight":"600"},"color":{"text":"#333"},"spacing":{"margin":{"bottom":"var:preset|spacing|15"}}}} -->
                <h3 style="color:#333;margin-bottom:var(--wp--preset--spacing--15);font-size:1.3rem;font-weight:600">إعدادات النظام</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"color":{"text":"#666"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="color:#666;margin-bottom:var(--wp--preset--spacing--20)">تخصيص إعدادات القالب والنظام</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:buttons -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary","textColor":"white","style":{"border":{"radius":"5px"}}} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button" href="/wp-admin/admin.php?page=fadi-settings" style="border-radius:5px">الإعدادات</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
                
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
    </div>
    <!-- /wp:columns -->
    
</div>
<!-- /wp:group -->