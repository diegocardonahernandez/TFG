<section class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <h1 class="testimonials-title">Lo que dicen nuestros clientes</h1>
            <p class="testimonials-subtitle">Descubre por qué nuestros clientes confían en nosotros para alcanzar sus
                objetivos fitness</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <span class="testimonial-date">Hace 2 días</span>
                <p class="testimonial-quote">Los suplementos de esta tienda han transformado completamente mi rutina de
                    entrenamiento. La calidad es excepcional y los resultados son increíbles.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/maria.png" alt="María García" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">María García</h3>
                        <p class="author-role">Atleta Amateur</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <span class="testimonial-date">Hace 1 semana</span>
                <p class="testimonial-quote">El servicio al cliente es excepcional. Siempre responden rápidamente a mis
                    dudas y me ayudan a elegir los mejores productos para mis objetivos.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/carlos.png" alt="Carlos Rodríguez" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">Carlos Rodríguez</h3>
                        <p class="author-role">Entrenador Personal</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star-half-alt star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <span class="testimonial-date">Hace 2 semanas</span>
                <p class="testimonial-quote">La calculadora de calorías y el IMC son herramientas fantásticas. Me han
                    ayudado mucho a mantener un seguimiento de mi progreso.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/ana.webp" alt="Ana Martínez" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">Ana Martínez</h3>
                        <p class="author-role">Cliente Premium</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <span class="testimonial-date">Hace 3 semanas</span>
                <p class="testimonial-quote">Los precios son muy competitivos y la calidad de los productos es
                    inmejorable. Además, los envíos son rápidos y seguros.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/david.png" alt="David López" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">David López</h3>
                        <p class="author-role">Deportista Profesional</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <span class="testimonial-date">Hace 1 mes</span>
                <p class="testimonial-quote">La variedad de productos es impresionante. Encuentro todo lo que necesito
                    para mi entrenamiento en un solo lugar.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/laura.png" alt="Laura Sánchez" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">Laura Sánchez</h3>
                        <p class="author-role">Nutricionista Deportiva</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star-half-alt star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <span class="testimonial-date">Hace 1 mes</span>
                <p class="testimonial-quote">El programa premium vale cada céntimo. Las recomendaciones personalizadas
                    han mejorado significativamente mis resultados.</p>
                <div class="testimonial-author">
                    <img src="/imgs/ClientesTestimonios/pablo.png" alt="Pablo Ruiz" class="author-image">
                    <div class="author-info">
                        <h3 class="author-name">Pablo Ruiz</h3>
                        <p class="author-role">Cliente Premium</p>
                        <div class="rating">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.testimonial-card');

    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        observer.observe(card);
    });
});
</script>