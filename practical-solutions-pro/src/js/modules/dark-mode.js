/**
 * Dark Mode Module - Complete Implementation
 * وحدة الوضع المظلم - تنفيذ كامل
 */

export function initDarkMode() {
    console.log('🌙 تفعيل وحدة الوضع المظلم');
    
    const DarkMode = {
        currentTheme: 'light',
        toggleButton: null,
        
        init() {
            this.loadThemePreference();
            this.createToggleButton();
            this.bindEvents();
            this.applyTheme(this.currentTheme);
        },
        
        loadThemePreference() {
            try {
                const saved = localStorage.getItem('ps_theme_preference');
                this.currentTheme = saved || this.getSystemPreference();
            } catch (e) {
                this.currentTheme = this.getSystemPreference();
            }
        },
        
        getSystemPreference() {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                return 'dark';
            }
            return 'light';
        },
        
        createToggleButton() {
            if (document.querySelector('.ps-theme-toggle')) {
                this.toggleButton = document.querySelector('.ps-theme-toggle');
                return;
            }
            
            this.toggleButton = document.createElement('button');
            this.toggleButton.className = 'ps-theme-toggle';
            this.toggleButton.setAttribute('aria-label', 'تبديل الوضع المظلم');
            this.toggleButton.innerHTML = `
                <span class="theme-icon">${this.currentTheme === 'dark' ? '☀️' : '🌙'}</span>
                <span class="theme-text">${this.currentTheme === 'dark' ? 'فاتح' : 'مظلم'}</span>
            `;
            
            // إضافة الزر في مكان مناسب
            const header = document.querySelector('header, .site-header, .wp-block-site-title');
            if (header) {
                header.appendChild(this.toggleButton);
            } else {
                document.body.appendChild(this.toggleButton);
            }
        },
        
        bindEvents() {
            if (this.toggleButton) {
                this.toggleButton.addEventListener('click', () => this.toggle());
            }
            
            // مراقبة تغييرات النظام
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!localStorage.getItem('ps_theme_preference')) {
                        this.currentTheme = e.matches ? 'dark' : 'light';
                        this.applyTheme(this.currentTheme);
                        this.updateButton();
                    }
                });
            }
        },
        
        toggle() {
            this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
            this.applyTheme(this.currentTheme);
            this.saveThemePreference();
            this.updateButton();
            
            // إشعار التغيير
            this.notifyThemeChange();
        },
        
        applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            document.body.classList.remove('light-theme', 'dark-theme');
            document.body.classList.add(`${theme}-theme`);
            
            // تحديث meta theme-color
            let metaThemeColor = document.querySelector('meta[name="theme-color"]');
            if (!metaThemeColor) {
                metaThemeColor = document.createElement('meta');
                metaThemeColor.name = 'theme-color';
                document.head.appendChild(metaThemeColor);
            }
            metaThemeColor.content = theme === 'dark' ? '#1a1a1a' : '#007cba';
        },
        
        updateButton() {
            if (!this.toggleButton) return;
            
            const icon = this.toggleButton.querySelector('.theme-icon');
            const text = this.toggleButton.querySelector('.theme-text');
            
            if (icon) {
                icon.textContent = this.currentTheme === 'dark' ? '☀️' : '🌙';
            }
            if (text) {
                text.textContent = this.currentTheme === 'dark' ? 'فاتح' : 'مظلم';
            }
            
            this.toggleButton.setAttribute('aria-label', 
                `تبديل إلى الوضع ${this.currentTheme === 'dark' ? 'الفاتح' : 'المظلم'}`
            );
        },
        
        saveThemePreference() {
            try {
                localStorage.setItem('ps_theme_preference', this.currentTheme);
            } catch (e) {
                console.warn('تعذر حفظ إعدادات الثيم');
            }
        },
        
        notifyThemeChange() {
            // إطلاق حدث مخصص
            const event = new CustomEvent('themeChanged', {
                detail: { theme: this.currentTheme }
            });
            document.dispatchEvent(event);
            
            // إشعار المستخدم
            if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
                window.PracticalSolutions.showNotification(
                    `تم التبديل إلى الوضع ${this.currentTheme === 'dark' ? 'المظلم' : 'الفاتح'}`,
                    'info'
                );
            }
        }
    };
    
    DarkMode.init();
    
    // تصدير للاستخدام الخارجي
    window.PSDarkMode = DarkMode;
}

export default { initDarkMode };