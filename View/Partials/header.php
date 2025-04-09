<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? "$title - Puro Gains" : 'Puro Gains' ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link rel="stylesheet" href="/css/footerStyle.css">
    <link rel="stylesheet" href="/css/homeStyle.css">
</head>

<body>
    <!-- Añadida barra informativa de envíos -->
    <div class="shipping-info-bar">
        <p><i class="bi bi-truck"></i> ¡Envío GRATIS en pedidos superiores a 50€!</p>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/imgs/logo.png" id="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Nutrición</a></li>
                            <li><a class="dropdown-item" href="#">Equipamiento</a></li>
                            <li><a class="dropdown-item" href="#">Ropa Fit</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item disabled" href="#">Descuentos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tu Desafio
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Calcula Tus Calorías</a></li>
                            <li><a class="dropdown-item" href="#">Calculadora IMC</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item disabled" href="#">Tu Rutina Ideal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"><button class="btn btn-danger">Iniciar Sesión</button></a>
                    </li>
                </ul>
                <form class="d-flex" role="search" id="searchBar">
                    <input class="form-control me-2" type="search" placeholder="Encuentra tu producto" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
                <!-- Añadido icono del carrito -->
                <div class="cart-icon-container">
                    <a href="#" class="cart-icon">
                        <i class="bi bi-cart4"></i>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>



</html>