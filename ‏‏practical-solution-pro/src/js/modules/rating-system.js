/**
 * Rating System Module
 * وحدة نظام التقييمات
 */

export function initRatingSystem() {
    document.querySelectorAll('.ps-rating-star').forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            const widget = this.closest('.ps-rating-widget');
            const postId = widget.dataset.postId;
            
            if (!postId) return;
            
            submitRating(postId, rating, widget);
        });
        
        // تحسين إمكانية الوصول
        star.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
}

function submitRating(postId, rating, widget) {
    const formData = new FormData();
    formData.append('action', 'ps_submit_rating');
    formData.append('post_id', postId);
    formData.append('rating', rating);
    formData.append('nonce', window.psAjax?.nonce || '');
    
    // إظهار حالة التحميل
    widget.style.opacity = '0.6';
    widget.style.pointerEvents = 'none';
    
    fetch(window.psAjax?.ajaxurl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateRatingDisplay(widget, rating, data.data);
            
            if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
                window.PracticalSolutions.showNotification(
                    'شكراً لك على التقييم!',
                    'success'
                );
            }
        } else {
            if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
                window.PracticalSolutions.showNotification(
                    data.data?.message || 'حدث خطأ في التقييم',
                    'error'
                );
            }
        }
    })
    .catch(error => {
        console.error('Rating submission error:', error);
        
        if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
            window.PracticalSolutions.showNotification(
                'حدث خطأ في الشبكة، حاول مرة أخرى',
                'error'
            );
        }
    })
    .finally(() => {
        widget.style.opacity = '1';
        widget.style.pointerEvents = 'auto';
    });
}

function updateRatingDisplay(widget, userRating, data) {
    const stars = widget.querySelectorAll('.ps-rating-star');
    const countElement = widget.querySelector('.ps-rating-count');
    
    // تحديث النجوم
    stars.forEach((star, index) => {
        if (index < userRating) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
    
    // تحديث العدد والمتوسط
    if (countElement && data.average && data.count) {
        countElement.textContent = `(${data.average}/5 - ${data.count} تقييم)`;
    }
}

export default { initRatingSystem };