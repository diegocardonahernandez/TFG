document.addEventListener('DOMContentLoaded', function() {
    // Cambiar vista de productos (grid/lista)
    const viewButtons = document.querySelectorAll('.btn-view-option');
    const productsContainer = document.getElementById('products-container');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            
            // Quitar active de todos los botones
            viewButtons.forEach(btn => btn.classList.remove('active'));
            
            // Añadir active al botón clickeado
            this.classList.add('active');
            
            // Cambiar clase en el contenedor de productos
            if (view === 'grid') {
                productsContainer.classList.remove('products-list');
                productsContainer.classList.add('products-grid');
            } else {
                productsContainer.classList.remove('products-grid');
                productsContainer.classList.add('products-list');
            }
        });
    });
    
    // Ordenar productos
    const sortSelect = document.getElementById('sort-by');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            // Aquí iría la lógica para ordenar los productos
            console.log('Ordenar por:', this.value);
        });
    }
    
    // Paginación
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Quitar active de todos los items
            document.querySelectorAll('.pagination .page-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Añadir active al item clickeado si no es Previous o Next
            if (!this.getAttribute('aria-label')) {
                this.parentElement.classList.add('active');
            }
            
            // Aquí iría la lógica para cargar más productos
            console.log('Página:', this.textContent);
        });
    });
});