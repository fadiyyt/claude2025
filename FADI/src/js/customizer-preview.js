/**
 * FADI Theme - معاينة المخصص المباشرة
 * @version 1.0
 */

(function($) {
    'use strict';

    // معاينة مباشرة لتغييرات الألوان
    wp.customize('fadi_primary_color', function(value) {
        value.bind(function(newval) {
            updateColorProperty('--fadi-primary-color', newval);
            updatePrimaryColorElements(newval);
        });
    });

    wp.customize('fadi_secondary_color', function(value) {
        value.bind(function(newval) {
            updateColorProperty('--fadi-secondary-color', newval);
            updateSecondaryColorElements(newval);
        });
    });

    wp.customize('fadi_background_color', function(value) {
        value.bind(function(newval) {
            updateColorProperty('--fadi-background-color', newval);
            $('body').css('background-color', newval);
        });
    });

    // معاينة مباشرة لتغييرات الخطوط
    wp.customize('fadi_primary_font', function(value) {
        value.bind(function(newval) {
            updateFontFamily(newval);
        });
    });

    wp.customize('fadi_font_size', function(value) {
        value.bind(function(newval) {
            updateFontSize(newval + 'px');
        });
    });

    // معاينة إعدادات لوحة التحكم
    wp.customize('fadi_show_stats', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('.quick-stats').show();
            } else {
                $('.quick-stats').hide();
            }
        });
    });

    // وظائف مساعدة
    function updateColorProperty(property, value) {
        document.documentElement.style.setProperty(property, value);
    }

    function updatePrimaryColorElements(color) {
        $('.btn, .wp-block-button__link, .dashboard-card, .btn-login').css('background-color', color);
        $('.site-header').css('background', `linear-gradient(135deg, ${color} 0%, var(--fadi-secondary-color) 100%)`);
        $('.card-icon, a').css('color', color);
        $('.dashboard-card').css('border-right-color', color);
    }

    function updateSecondaryColorElements(color) {
        $('.btn-secondary').css('background-color', color);
        $('.site-header').css('background', `linear-gradient(135deg, var(--fadi-primary-color) 0%, ${color} 100%)`);
    }

    function updateFontFamily(font) {
        const fontFamily = `'${font}', Arial, sans-serif`;
        updateColorProperty('--fadi-primary-font', fontFamily);
        $('body').css('font-family', fontFamily);
        
        // تحديث رابط خط Google Fonts إذا لزم الأمر
        updateGoogleFont(font);
    }

    function updateFontSize(size) {
        updateColorProperty('--fadi-font-size', size);
        $('body').css('font-size', size);
    }

    function updateGoogleFont(font) {
        const googleFonts = {
            'Tajawal': 'Tajawal:wght@300;400;500;700',
            'Cairo': 'Cairo:wght@300;400;500;700',
            'Amiri': 'Amiri:wght@400;700',
            'Noto Sans Arabic': 'Noto+Sans+Arabic:wght@300;400;500;700',
            'IBM Plex Sans Arabic': 'IBM+Plex+Sans+Arabic:wght@300;400;500;700'
        };

        if (googleFonts[font]) {
            // إزالة الخط القديم
            $('link[href*="fonts.googleapis.com"]').remove();
            
            // إضافة الخط الجديد
            $('head').append(`<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=${googleFonts[font]}&display=swap">`);
        }
    }

    // تحسينات إضافية للمعاينة
    $(document).ready(function() {
        // إضافة تأثيرات انتقالية للمعاينة
        $('*').css('transition', 'all 0.3s ease');
        
        // تحديث المعاينة عند تغيير الإعدادات
        wp.customize.bind('change', function() {
            // تأخير طفيف لضمان تطبيق التغييرات
            setTimeout(function() {
                updatePreviewIndicators();
            }, 100);
        });
    });

    function updatePreviewIndicators() {
        // إضافة مؤشرات بصرية للتغييرات
        $('.site-header, .dashboard-card, .btn').addClass('customizer-changed');
        
        setTimeout(function() {
            $('.customizer-changed').removeClass('customizer-changed');
        }, 1000);
    }

})(jQuery);

// تحسينات CSS للمعاينة
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        .customizer-changed {
            animation: customizer-highlight 1s ease-in-out;
        }
        
        @keyframes customizer-highlight {
            0% { box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.5); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
    `;
    document.head.appendChild(style);
});