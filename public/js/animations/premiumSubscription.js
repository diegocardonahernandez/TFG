document.addEventListener('DOMContentLoaded', function() {
    // Animate elements when they come into view
    function animateOnScroll() {
        const elements = document.querySelectorAll('.premium-title, .premium-subtitle, .premium-motivation');
        
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            
            // Check if element is in viewport
            if (elementTop < window.innerHeight && elementBottom > 0) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    }

    // Initial check for elements in view
    animateOnScroll();

    // Check on scroll
    window.addEventListener('scroll', animateOnScroll);

    // Add hover effect to the motivation section
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

    // Add click effect to the subscribe button
    const subscribeButton = document.querySelector('.premium-btn-subscribe');
    if (subscribeButton) {
        subscribeButton.addEventListener('click', function(e) {
            // Add a small scale effect when clicked
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }
}); 