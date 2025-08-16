/**
 * Newsletter Module
 * وحدة النشرة البريدية
 */

export function initNewsletter() {
    console.log('📧 تم تفعيل وحدة النشرة البريدية');
    
    // البحث عن نماذج النشرة البريدية
    const newsletterForms = document.querySelectorAll('.ps-newsletter-form, .newsletter-form');
    
    if (newsletterForms.length === 0) {
        console.log('لا توجد نماذج نشرة بريدية للتفعيل');
        return;
    }
    
    newsletterForms.forEach(form => {
        setupNewsletterForm(form);
    });
    
    // إضافة نموذج نشرة بريدية تلقائياً إذا لم يكن موجوداً
    autoAddNewsletterForm();
}

function setupNewsletterForm(form) {
    const emailInput = form.querySelector('input[type="email"]');
    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
    const statusMessage = form.querySelector('.newsletter-status') || createStatusElement(form);
    
    if (!emailInput || !submitButton) {
        console.warn('نموذج النشرة البريدية غير مكتمل - يجب وجود حقل email وزر إرسال');
        return;
    }
    
    // تحسين تجربة المستخدم
    enhanceNewsletterUX(form, emailInput, submitButton);
    
    // معالجة إرسال النموذج
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        handleNewsletterSubmission(form, emailInput, submitButton, statusMessage);
    });
    
    // تطبيق التحقق الفوري
    emailInput.addEventListener('input', function() {
        validateEmailInput(this, statusMessage);
    });
}

function enhanceNewsletterUX(form, emailInput, submitButton) {
    // إضافة placeholder محسن
    if (!emailInput.placeholder) {
        emailInput.placeholder = 'أدخل بريدك الإلكتروني';
    }
    
    // إضافة aria-labels
    emailInput.setAttribute('aria-label', 'البريد الإلكتروني للاشتراك في النشرة');
    submitButton.setAttribute('aria-label', 'اشتراك في النشرة البريدية');
    
    // إضافة أيقونة في الزر
    if (!submitButton.querySelector('svg')) {
        const icon = document.createElement('span');
        icon.innerHTML = '📧';
        icon.style.marginLeft = '0.5rem';
        submitButton.appendChild(icon);
    }
    
    // تحسين التصميم
    form.classList.add('ps-newsletter-enhanced');
    addNewsletterStyles();
}

function handleNewsletterSubmission(form, emailInput, submitButton, statusMessage) {
    const email = emailInput.value.trim();
    
    // التحقق من صحة البريد الإلكتروني
    if (!isValidEmail(email)) {
        showStatus(statusMessage, 'يرجى إدخال بريد إلكتروني صحيح', 'error');
        return;
    }
    
    // إظهار حالة التحميل
    const originalButtonText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'جاري الاشتراك...';
    
    // إرسال البيانات
    submitNewsletter(email, form)
        .then(response => {
            if (response.success) {
                showStatus(statusMessage, 'تم الاشتراك بنجاح! 🎉', 'success');
                emailInput.value = '';
                trackNewsletterSubscription(email);
                
                // إخفاء النموذج أو عرض رسالة شكر
                showThankYouMessage(form);
            } else {
                throw new Error(response.message || 'فشل في الاشتراك');
            }
        })
        .catch(error => {
            console.error('Newsletter subscription error:', error);
            showStatus(statusMessage, error.message || 'حدث خطأ، يرجى المحاولة مرة أخرى', 'error');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        });
}

async function submitNewsletter(email, form) {
    // إذا كان النموذج يحتوي على action URL، استخدمه
    const actionUrl = form.action || window.psAjax?.ajaxurl || '/wp-admin/admin-ajax.php';
    
    const formData = new FormData();
    formData.append('action', 'ps_newsletter_subscribe');
    formData.append('email', email);
    formData.append('nonce', window.psAjax?.nonce || '');
    
    // إضافة بيانات إضافية من النموذج
    const additionalFields = form.querySelectorAll('input:not([type="email"]):not([type="submit"]), select, textarea');
    additionalFields.forEach(field => {
        if (field.name && field.value) {
            formData.append(field.name, field.value);
        }
    });
    
    try {
        const response = await fetch(actionUrl, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        return data;
    } catch (error) {
        // fallback: محاولة إرسال بطريقة أساسية
        return await fallbackNewsletterSubmission(email);
    }
}

async function fallbackNewsletterSubmission(email) {
    // طريقة احتياطية لحفظ البريد الإلكتروني محلياً
    const subscribers = JSON.parse(localStorage.getItem('ps_newsletter_subscribers') || '[]');
    
    if (subscribers.includes(email)) {
        throw new Error('البريد الإلكتروني مسجل مسبقاً');
    }
    
    subscribers.push(email);
    localStorage.setItem('ps_newsletter_subscribers', JSON.stringify(subscribers));
    
    return { success: true, message: 'تم الاشتراك محلياً' };
}

function validateEmailInput(emailInput, statusMessage) {
    const email = emailInput.value.trim();
    
    if (email.length === 0) {
        clearStatus(statusMessage);
        emailInput.classList.remove('valid', 'invalid');
        return;
    }
    
    if (isValidEmail(email)) {
        emailInput.classList.add('valid');
        emailInput.classList.remove('invalid');
        clearStatus(statusMessage);
    } else {
        emailInput.classList.add('invalid');
        emailInput.classList.remove('valid');
        showStatus(statusMessage, 'تنسيق البريد الإلكتروني غير صحيح', 'warning', true);
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function createStatusElement(form) {
    const status = document.createElement('div');
    status.className = 'newsletter-status';
    status.setAttribute('aria-live', 'polite');
    form.appendChild(status);
    return status;
}

function showStatus(statusElement, message, type = 'info', isTemporary = false) {
    statusElement.textContent = message;
    statusElement.className = `newsletter-status newsletter-status--${type}`;
    statusElement.style.display = 'block';
    
    if (isTemporary) {
        setTimeout(() => clearStatus(statusElement), 3000);
    }
}

function clearStatus(statusElement) {
    statusElement.textContent = '';
    statusElement.className = 'newsletter-status';
    statusElement.style.display = 'none';
}

function showThankYouMessage(form) {
    const thankYou = document.createElement('div');
    thankYou.className = 'newsletter-thanks';
    thankYou.innerHTML = `
        <div class="thanks-icon">✅</div>
        <h3>شكراً لك!</h3>
        <p>تم تسجيلك في النشرة البريدية بنجاح. ستصلك أحدث المقالات والنصائح.</p>
    `;
    
    form.style.display = 'none';
    form.parentNode.insertBefore(thankYou, form.nextSibling);
    
    // إخفاء رسالة الشكر بعد 5 ثوانٍ وإظهار النموذج مرة أخرى
    setTimeout(() => {
        thankYou.remove();
        form.style.display = 'block';
    }, 5000);
}

function trackNewsletterSubscription(email) {
    // تتبع الاشتراك مع Google Analytics إذا كان متاحاً
    if (typeof gtag === 'function') {
        gtag('event', 'newsletter_subscribe', {
            method: 'email',
            value: 1
        });
    }
    
    // إرسال حدث مخصص
    const subscribeEvent = new CustomEvent('ps-newsletter-subscribe', {
        detail: {
            email: email,
            timestamp: Date.now()
        }
    });
    
    document.dispatchEvent(subscribeEvent);
    
    console.log('تم تتبع اشتراك النشرة البريدية');
}

function autoAddNewsletterForm() {
    // البحث عن أماكن محتملة لإضافة نموذج النشرة البريدية
    const potentialLocations = [
        document.querySelector('.wp-block-group.is-style-ps-feature-box'),
        document.querySelector('footer'),
        document.querySelector('.sidebar'),
        document.querySelector('main')
    ];
    
    const targetLocation = potentialLocations.find(el => el !== null);
    
    if (targetLocation && !document.querySelector('.ps-newsletter-form')) {
        const newsletterForm = createNewsletterForm();
        targetLocation.appendChild(newsletterForm);
        setupNewsletterForm(newsletterForm);
    }
}

function createNewsletterForm() {
    const form = document.createElement('form');
    form.className = 'ps-newsletter-form ps-newsletter-enhanced';
    form.innerHTML = `
        <div class="newsletter-header">
            <h3>📧 اشترك في نشرتنا البريدية</h3>
            <p>احصل على أحدث النصائح والحلول العملية مباشرة في بريدك الإلكتروني</p>
        </div>
        
        <div class="newsletter-input-group">
            <input 
                type="email" 
                name="email" 
                placeholder="أدخل بريدك الإلكتروني" 
                required
                aria-label="البريد الإلكتروني للاشتراك في النشرة"
            >
            <button type="submit" aria-label="اشتراك في النشرة البريدية">
                اشتراك 📧
            </button>
        </div>
        
        <div class="newsletter-status" aria-live="polite"></div>
        
        <small class="newsletter-note">
            لن نشارك بريدك الإلكتروني مع أي جهة أخرى. يمكنك إلغاء الاشتراك في أي وقت.
        </small>
    `;
    
    return form;
}

function addNewsletterStyles() {
    if (document.getElementById('ps-newsletter-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'ps-newsletter-styles';
    styles.textContent = `
        .ps-newsletter-enhanced {
            background: var(--ps-bg-light, #f9fafb);
            border: 1px solid var(--ps-border, #e5e7eb);
            border-radius: var(--ps-radius, 8px);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .newsletter-header h3 {
            margin: 0 0 0.5rem 0;
            color: var(--ps-text, #1a1a1a);
            font-size: 1.25rem;
        }
        
        .newsletter-header p {
            margin: 0 0 1.5rem 0;
            color: var(--ps-text-light, #6b7280);
            font-size: 0.95rem;
        }
        
        .newsletter-input-group {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .newsletter-input-group input[type="email"] {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 2px solid var(--ps-border, #e5e7eb);
            border-radius: var(--ps-radius, 8px);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .newsletter-input-group input[type="email"]:focus {
            outline: none;
            border-color: var(--ps-primary, #007cba);
            box-shadow: 0 0 0 3px rgba(0, 124, 186, 0.1);
        }
        
        .newsletter-input-group input.valid {
            border-color: var(--ps-success, #10b981);
        }
        
        .newsletter-input-group input.invalid {
            border-color: var(--ps-error, #ef4444);
        }
        
        .newsletter-input-group button {
            background: var(--ps-primary, #007cba);
            color: white;
            border: none;
            border-radius: var(--ps-radius, 8px);
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .newsletter-input-group button:hover:not(:disabled) {
            background: var(--ps-secondary, #005a87);
            transform: translateY(-1px);
        }
        
        .newsletter-input-group button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .newsletter-status {
            padding: 0.75rem 1rem;
            border-radius: var(--ps-radius, 8px);
            font-size: 0.9rem;
            font-weight: 500;
            display: none;
        }
        
        .newsletter-status--success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .newsletter-status--error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        .newsletter-status--warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        
        .newsletter-note {
            color: var(--ps-text-light, #6b7280);
            font-size: 0.8rem;
            line-height: 1.4;
        }
        
        .newsletter-thanks {
            text-align: center;
            padding: 2rem;
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: var(--ps-radius, 8px);
        }
        
        .thanks-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .newsletter-thanks h3 {
            margin: 0 0 0.5rem 0;
            color: var(--ps-primary, #007cba);
        }
        
        .newsletter-thanks p {
            margin: 0;
            color: var(--ps-text-light, #6b7280);
        }
        
        @media (max-width: 768px) {
            .newsletter-input-group {
                flex-direction: column;
            }
            
            .newsletter-input-group button {
                justify-self: stretch;
            }
        }
    `;
    
    document.head.appendChild(styles);
}

// تصدير الدوال للاستخدام الخارجي
export { 
    setupNewsletterForm, 
    createNewsletterForm, 
    trackNewsletterSubscription 
};

export default { 
    initNewsletter, 
    setupNewsletterForm, 
    createNewsletterForm 
};