<?php
$productos_por_pagina = 10;
$usuarios_por_pagina = 10;
$descuentos_por_pagina = 10;

$pagina_productos = isset($_GET['pagina_productos']) ? intval($_GET['pagina_productos']) : 1;
$pagina_usuarios = isset($_GET['pagina_usuarios']) ? intval($_GET['pagina_usuarios']) : 1;
$pagina_descuentos = isset($_GET['pagina_descuentos']) ? intval($_GET['pagina_descuentos']) : 1;

$offset_productos = ($pagina_productos - 1) * $productos_por_pagina;
$offset_usuarios = ($pagina_usuarios - 1) * $usuarios_por_pagina;
$offset_descuentos = ($pagina_descuentos - 1) * $descuentos_por_pagina;

$total_productos = $productoDAO->contarProductos();
$total_usuarios = $usuarioDAO->contarUsuarios();
$total_descuentos = $descuentoDAO->contarDescuentos();

$total_paginas_productos = ceil($total_productos / $productos_por_pagina);
$total_paginas_usuarios = ceil($total_usuarios / $usuarios_por_pagina);
$total_paginas_descuentos = ceil($total_descuentos / $descuentos_por_pagina);

$products = $productoDAO->obtenerProductosPaginados($offset_productos, $productos_por_pagina);
$users = $usuarioDAO->obtenerUsuariosPaginados($offset_usuarios, $usuarios_por_pagina);
$discountedProducts = $descuentoDAO->obtenerDescuentosPaginados($offset_descuentos, $descuentos_por_pagina);

$allProducts = $productoDAO->obtenerTodosProductos();

function generarPaginacion($pagina_actual, $total_paginas, $tipo)
{
    $html = '<nav aria-label="Navegación de ' . $tipo . '">';
    $html .= '<ul class="pagination justify-content-center">';

    if ($pagina_actual <= 1) {
        $html .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a></li>';
    } else {
        $html .= '<li class="page-item"><a class="page-link" href="?pagina_' . $tipo . '=' . ($pagina_actual - 1) . '&tab=' . $tipo . '">Anterior</a></li>';
    }

    $inicio = max(1, $pagina_actual - 2);
    $fin = min($total_paginas, $pagina_actual + 2);

    if ($fin < 5 && $total_paginas >= 5) {
        $fin = 5;
    }
    if ($inicio > ($total_paginas - 4) && $total_paginas >= 5) {
        $inicio = $total_paginas - 4;
    }

    for ($i = $inicio; $i <= $fin; $i++) {
        if ($i == $pagina_actual) {
            $html .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="?pagina_' . $tipo . '=' . $i . '&tab=' . $tipo . '">' . $i . '</a></li>';
        }
    }

    if ($pagina_actual >= $total_paginas) {
        $html .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Siguiente</a></li>';
    } else {
        $html .= '<li class="page-item"><a class="page-link" href="?pagina_' . $tipo . '=' . ($pagina_actual + 1) . '&tab=' . $tipo . '">Siguiente</a></li>';
    }

    $html .= '</ul></nav>';
    return $html;
}

$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'productos';
