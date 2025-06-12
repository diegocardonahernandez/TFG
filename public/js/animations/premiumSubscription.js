document.addEventListener('DOMContentLoaded', function() {
    function animateOnScroll() {
        const elements = document.querySelectorAll('.premium-title, .premium-subtitle, .premium-motivation');
        
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            
            if (elementTop < window.innerHeight && elementBottom > 0) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    }

    animateOnScroll();

    window.addEventListener('scroll', animateOnScroll);

    const motivationSection = document.querySelector('.premium-motivation');
    if (motivationSection) {
        motivationSection.addEventListener('mouseenter', function() {
            const image = this.querySelector('.premium-image');
            if (image) {
                image.style.transform = 'scale(1.05)';
            }
        });

        motivationSection.addEventListener('mouseleave', function() {
            const image = this.querySelector('.premium-image');
            if (image) {
                image.style.transform = 'scale(1)';
            }
        });
    }

    const subscribeButton = document.querySelector('.premium-btn-subscribe');
    if (subscribeButton) {
        subscribeButton.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }
}); 