/**
 * إدارة الأيقونات والصور
 */

class PSIconManager {
  constructor() {
    this.init();
  }
  
  init() {
    this.loadIconsSprite();
    this.handleLazyIcons();
    this.setupIconFallbacks();
  }
  
  /**
   * تحميل ملف الأيقونات SVG
   */
  async loadIconsSprite() {
    try {
      const response = await fetch('/src/images/icons/system-icons.svg');
      const svgText = await response.text();
      
      // إدراج الأيقونات في بداية الصفحة
      const div = document.createElement('div');
      div.innerHTML = svgText;
      div.style.display = 'none';
      document.body.insertBefore(div, document.body.firstChild);
      
      console.log('✅ تم تحميل أيقونات النظام بنجاح');
    } catch (error) {
      console.warn('⚠️ فشل في تحميل أيقونات النظام:', error);
    }
  }
  
  /**
   * التحميل البطيء للأيقونات
   */
  handleLazyIcons() {
    const lazyIcons = document.querySelectorAll('.ps-icon[data-src]');
    
    if ('IntersectionObserver' in window) {
      const iconObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const icon = entry.target;
            this.loadIcon(icon);
            iconObserver.unobserve(icon);
          }
        });
      });
      
      lazyIcons.forEach(icon => iconObserver.observe(icon));
    } else {
      // Fallback للمتصفحات القديمة
      lazyIcons.forEach(icon => this.loadIcon(icon));
    }
  }
  
  /**
   * تحميل أيقونة واحدة
   */
  loadIcon(iconElement) {
    const src = iconElement.getAttribute('data-src');
    if (src) {
      iconElement.innerHTML = `<use href="#${src}"></use>`;
      iconElement.removeAttribute('data-src');
      iconElement.classList.add('loaded');
    }
  }
  
  /**
   * إعداد البدائل للأيقونات
   */
  setupIconFallbacks() {
    // بديل للأيقونات التي لم تُحمل
    const icons = document.querySelectorAll('.ps-icon use');
    
    icons.forEach(use => {
      use.addEventListener('error', () => {
        const icon = use.closest('.ps-icon');
        this.showFallbackIcon(icon);
      });
    });
  }
  
  /**
   * عرض أيقونة بديلة
   */
  showFallbackIcon(iconElement) {
    const fallbackText = iconElement.getAttribute('data-fallback') || '⚙️';
    iconElement.innerHTML = fallbackText;
    iconElement.classList.add('fallback');
  }
  
  /**
   * إنشاء أيقونة برمجياً
   */
  createIcon(iconName, className = '') {
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.className = `ps-icon ${className}`;
    svg.innerHTML = `<use href="#icon-${iconName}"></use>`;
    return svg;
  }
  
  /**
   * تحديث ألوان الأيقونات حسب الوضع
   */
  updateIconTheme(isDark = false) {
    const icons = document.querySelectorAll('.ps-icon');
    
    icons.forEach(icon => {
      if (isDark) {
        icon.style.color = '#ffffff';
      } else {
        icon.style.color = '';
      }
    });
  }
}

// تهيئة مدير الأيقونات
const iconManager = new PSIconManager();

// تصدير للاستخدام الخارجي
export { PSIconManager, iconManager };
