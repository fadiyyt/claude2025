<?php
/**
 * أنماط CSS مخصصة للصفحة الرئيسية
 * Front Page Custom Styles
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}
?>

<style>
/* ============================================================================
   أنماط الصفحة الرئيسية المخصصة
   ============================================================================ */

/* قسم البطل الرئيسي */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(45, 55, 72, 0.1);
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 100px 100px, 80px 80px, 120px 120px;
    animation: particlesFloat 20s linear infinite;
}

@keyframes particlesFloat {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
    font-size: 1.25rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 2.5rem;
}

.hero-stats .stat-item {
    text-align: center;
}

.hero-stats .stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    display: block;
    line-height: 1;
}

.hero-stats .stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.5rem;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-actions .btn {
    min-width: 200px;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.hero-actions .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* الرسم التوضيحي للبطل */
.hero-illustration {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.floating-card {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    color: white;
    animation: float 3s ease-in-out infinite;
    animation-delay: var(--delay, 0s);
}

.floating-card:nth-child(1) {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-card:nth-child(2) {
    top: 60%;
    right: 20%;
    animation-delay: 1s;
}

.floating-card:nth-child(3) {
    bottom: 20%;
    left: 30%;
    animation-delay: 2s;
}

.floating-card i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* مؤشر التمرير */
.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: white;
    opacity: 0.8;
    animation: bounce 2s infinite;
}

.scroll-mouse {
    width: 24px;
    height: 40px;
    border: 2px solid white;
    border-radius: 12px;
    margin: 0 auto 0.5rem;
    position: relative;
}

.scroll-wheel {
    width: 4px;
    height: 8px;
    background: white;
    border-radius: 2px;
    position: absolute;
    top: 6px;
    left: 50%;
    transform: translateX(-50%);
    animation: scroll 2s infinite;
}

@keyframes scroll {
    0% { transform: translateX(-50%) translateY(0); opacity: 1; }
    50% { transform: translateX(-50%) translateY(10px); opacity: 0.5; }
    100% { transform: translateX(-50%) translateY(0); opacity: 1; }
}

/* أقسام عامة */
.section-padding {
    padding: 5rem 0;
}

.section-header {
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    position: relative;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

.section-divider {
    width: 80px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 2px;
    margin: 2rem auto 0;
}

/* بطاقات الميزات */
.feature-card {
    text-align: center;
    padding: 2.5rem;
    height: 100%;
    border: none;
    transition: all 0.3s ease;
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

.feature-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.feature-description {
    color: var(--text-secondary);
    line-height: 1.6;
}

/* بطاقات المقالات */
.post-card {
    height: 100%;
    overflow: hidden;
    border: none;
    transition: all 0.3s ease;
}

.post-thumbnail {
    position: relative;
    overflow: hidden;
    border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
}

.post-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-card:hover .post-image {
    transform: scale(1.05);
}

.post-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
    font-size: 1.5rem;
}

.post-card:hover .post-overlay {
    opacity: 1;
}

.post-category {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 3;
}

.post-content {
    padding: 1.5rem;
}

.post-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: var(--text-muted);
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.post-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.post-title a {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: var(--primary-color);
}

.post-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid var(--bg-tertiary);
}

.post-author {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.author-avatar {
    border-radius: 50%;
}

.read-more-btn {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    color: var(--primary-dark);
    transform: translateX(-3px);
}

/* قسم نبذة عن الموقع */
.about-features {
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    font-weight: 500;
}

.about-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.about-illustration {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-circle {
    width: 200px;
    height: 200px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

.achievement-badges {
    position: absolute;
    width: 100%;
    height: 100%;
}

.badge-item {
    position: absolute;
    background: white;
    box-shadow: var(--shadow-lg);
    border-radius: 1rem;
    padding: 1rem;
    text-align: center;
    animation: float 3s ease-in-out infinite;
}

.badge-item:nth-child(1) {
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.badge-item:nth-child(2) {
    top: 10%;
    right: 10%;
    animation-delay: 1s;
}

.badge-item:nth-child(3) {
    bottom: 10%;
    left: 50%;
    transform: translateX(-50%);
    animation-delay: 2s;
}

.badge-item i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    display: block;
}

/* بطاقات الفئات */
.category-card {
    text-align: center;
    padding: 2rem;
    height: 100%;
    border: none;
    transition: all 0.3s ease;
}

.category-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

.category-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.category-title a {
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.category-title a:hover {
    color: var(--primary-color);
}

.category-count {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.category-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.category-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.category-link:hover {
    color: var(--primary-dark);
    transform: translateX(-3px);
}

/* بطاقات الشهادات */
.testimonial-card {
    height: 100%;
    padding: 2rem;
    border: none;
    position: relative;
}

.quote-icon {
    position: absolute;
    top: -10px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.testimonial-text {
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    padding-top: 1rem;
}

.testimonial-rating {
    margin-bottom: 1.5rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-name {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.author-position {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: 0;
}

/* قسم النشرة البريدية */
.newsletter-section {
    color: white;
    position: relative;
    overflow: hidden;
}

.newsletter-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="newsletter-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23newsletter-pattern)"/></svg>');
    opacity: 0.5;
}

.newsletter-content {
    position: relative;
    z-index: 2;
}

.newsletter-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.newsletter-subtitle {
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
}

.newsletter-form {
    max-width: 500px;
    margin: 0 auto 2rem;
}

.newsletter-form .input-group {
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.newsletter-form .form-control {
    border: none;
    padding: 1.25rem 1.5rem;
    font-size: 1rem;
}

.newsletter-form .btn {
    border: none;
    padding: 1.25rem 2rem;
    white-space: nowrap;
}

.newsletter-privacy {
    margin-top: 1rem;
    text-align: center;
}

.newsletter-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 3rem;
}

.newsletter-stats .stat-item {
    text-align: center;
}

.newsletter-stats .stat-number {
    font-size: 2rem;
    font-weight: 800;
    display: block;
    line-height: 1;
}

.newsletter-stats .stat-label {
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

/* قسم التواصل السريع */
.contact-card {
    padding: 3rem;
    text-align: center;
    border: none;
}

.contact-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.contact-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
}

.contact-methods {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
}

.contact-method {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.5rem;
    background: var(--bg-secondary);
    border-radius: 1rem;
    text-decoration: none;
    color: var(--text-primary);
    transition: all 0.3s ease;
    min-width: 120px;
}

.contact-method:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.contact-method i {
    font-size: 1.5rem;
}

.contact-social p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-link {
    width: 50px;
    height: 50px;
    background: var(--bg-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.2rem;
}

.social-link:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* تأثيرات التحميل */
.fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease forwards;
}

.fade-in-right {
    opacity: 0;
    transform: translateX(30px);
    animation: fadeInRight 0.8s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInRight {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* تأثير العداد */
.counter {
    display: inline-block;
}

/* تحسينات متجاوبة */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-actions .btn {
        min-width: auto;
        width: 100%;
        max-width: 300px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .newsletter-title {
        font-size: 2rem;
    }
    
    .newsletter-stats {
        gap: 1.5rem;
    }
    
    .contact-methods {
        flex-direction: column;
        align-items: center;
    }
    
    .contact-method {
        width: 100%;
        max-width: 200px;
    }
    
    .section-padding {
        padding: 3rem 0;
    }
    
    .feature-card,
    .post-card,
    .category-card,
    .testimonial-card {
        margin-bottom: 2rem;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-stats .stat-number {
        font-size: 2rem;
    }
    
    .newsletter-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .contact-card {
        padding: 2rem 1rem;
    }
    
    .section-padding {
        padding: 2rem 0;
    }
}

/* تحسينات للشاشات الكبيرة */
@media (min-width: 1200px) {
    .hero-title {
        font-size: 4rem;
    }
    
    .section-title {
        font-size: 3rem;
    }
    
    .newsletter-title {
        font-size: 3rem;
    }
}

/* تحسينات إمكانية الوصول */
@media (prefers-reduced-motion: reduce) {
    .hero-particles,
    .floating-card,
    .badge-item,
    .scroll-indicator,
    .counter {
        animation: none !important;
    }
    
    .post-card:hover .post-image,
    .hero-actions .btn:hover,
    .contact-method:hover,
    .social-link:hover {
        transform: none !important;
    }
}

/* تحسينات للطباعة */
@media print {
    .hero-section,
    .newsletter-section,
    .quick-contact-section {
        display: none !important;
    }
    
    .section-padding {
        padding: 1rem 0 !important;
    }
    
    .post-card,
    .feature-card,
    .category-card {
        break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
    
    .post-overlay,
    .hero-particles,
    .floating-card {
        display: none !important;
    }
}

/* تحسينات للوضع المظلم */
@media (prefers-color-scheme: dark) {
    .muhtawaa-card {
        background-color: #2d3748;
        border-color: #4a5568;
    }
    
    .feature-card,
    .post-card,
    .category-card,
    .testimonial-card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    
    .contact-method {
        background: #4a5568;
        color: #e2e8f0;
    }
    
    .social-link {
        background: #4a5568;
        color: #e2e8f0;
    }
}
</style>