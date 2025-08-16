/**
 * Practical Solutions Pro - Main JavaScript (Final Corrected Version)
 * الإصدار: 2.2.3
 */

// استيراد جميع الوحدات
import { initVoiceSearch } from './modules/voice-search.js';
import { initSearchSuggestions } from './modules/search-suggestions.js';
import { initRatingSystem } from './modules/rating-system.js';
import { initPerformanceFeatures } from './modules/performance-features.js';
import { initAccessibility } from './modules/accessibility.js';
import { initPWAFeatures } from './modules/pwa-features.js';
import { initSocialSharing } from './modules/social-sharing.js';
import { initNewsletter } from './modules/newsletter.js';

(function($) {
    'use strict';

    // تهيئة جميع الميزات عند تحميل الصفحة
    $(document).ready(function() {
        console.log('🚀 Practical Solutions Pro v2.2.3 Initializing...');
        
        // تهيئة الميزات الأساسية
        initSearchSuggestions();
        initVoiceSearch();
        initRatingSystem();
        initPerformanceFeatures();
        initAccessibility();
        initPWAFeatures();
        initSocialSharing();
        initNewsletter();
        
        console.log('✅ All modules initialized.');
    });

})(jQuery);
