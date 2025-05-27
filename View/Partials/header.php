<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Puro Gains' ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link rel="stylesheet" href="/css/footerStyle.css">
    <link rel="stylesheet" href="/css/homeStyle.css">
    <link rel="stylesheet" href="/css/categoryStyle.css">
    <link rel="stylesheet" href="/css/productDetailsStyle.css">
    <link rel="stylesheet" href="/css/imcCalcStyle.css">
    <link rel="stylesheet" href="/css/caloriesCalcStyle.css">
    <link rel="stylesheet" href="/css/loginStyle.css">
    <link rel="stylesheet" href="/css/registerStyle.css">
    <link rel="stylesheet" href="/css/userAccountStyle.css">
    <link rel="stylesheet" href="/css/profits.css">
    <link rel="stylesheet" href="/css/processProducts.css">
    <link rel="stylesheet" href="/css/discountsStyle.css">
    <link rel="stylesheet" href="/css/cartStyle.css">
    <link rel="stylesheet" href="/css/searchStyle.css">
    <link rel="stylesheet" href="/css/testimonialsStyle.css">
</head>

<body>
    <div class="shipping-info-bar">
        <p><i class="bi bi-truck"></i> ¡Envío GRATIS en pedidos superiores a 50€!</p>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/imgs/logo.png" id="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($categoriesNames as $categoryName) {
                                echo "<li><a class='dropdown-item' href='/" . $categoryName->getNombre() . "'>" . $categoryName->getNombre() . "</a></li>";
                            } ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php
                            if (isset($_SESSION['userId']) && $_SESSION['userType'] === 'Premium') {
                                echo '<li><a class="dropdown-item" href="/discounts">Descuentos</a></li>';
                            } else if (isset($_SESSION['userId']) && $_SESSION['userType'] === 'Administrador') {
                                echo '<li><a class="dropdown-item" href="/discounts">Descuentos</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item disabled" href="#" title="Requiere cuenta Premium">Descuentos</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tu Desafio
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/calories">Calcula Tus Calorías</a></li>
                            <li><a class="dropdown-item" href="/imc">Calculadora IMC</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php
                            if (isset($_SESSION['userId']) && $_SESSION['userType'] === 'Premium') {
                                echo '<li><a class="dropdown-item" href="#">Tu Rutina Ideal</a></li>';
                            } else if (isset($_SESSION['userId']) && $_SESSION['userType'] === 'Administrador') {
                                echo '<li><a class="dropdown-item" href="#">Tu Rutina Ideal</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item disabled" href="#" title="Requiere cuenta Premium">Tu Rutina Ideal</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    if (!isset($_SESSION['userId'])) {
                        echo '<li class="nav-item">
                                <a href="/login" class="nav-link">
                                    <button class="btn btn-danger">Iniciar Sesión</button>
                                </a>
                              </li>';
                    } else {
                        if ($_SESSION['userType'] == 'Administrador') {
                            echo '<li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            </i>  Administración
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/processProducts">Productos</a></li>
                            <li><a class="dropdown-item" href="/processUsers">Usuarios</a></li>
                        </ul>
                    </li>';
                        }
                        echo '<li class="nav-item">
                                <a href="/accountUser" class="nav-link">
                                    <button class="btn btn-danger"> Mi Cuenta </button>
                                </a>
                              </li>';
                    }
                    ?>
                </ul>
                <form class="d-flex" role="search" id="searchBar" action="/search" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Encuentra tu producto"
                        value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>" aria-label="Search" required>
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
                <div class="cart-icon-container">
                    <a href="/cart" class="cart-icon">
                        <i class="bi bi-cart4"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>