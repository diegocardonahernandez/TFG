<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once __DIR__ . '/../../Functions/recommendProducts.php';

    $goal = $_POST['goal'];
    $result = recommendProducts($goal);

    // Agregar log para ver qué devuelve la función
    error_log("Productos recomendados para objetivo '$goal': " . print_r($result, true));

    $productsArray = [];
    foreach ($result as $product) {
        if ($product instanceof Product) {
            // Convertir objeto a array asociativo
            $productsArray[] = [
                'id_producto' => $product->getIdProducto(),
                'nombre' => $product->getNombre(),
                'descripcion' => $product->getDescripcion(),
                'imagen' => $product->getImagen(),
                'precio' => $product->getPrecio(),
                'categoria' => $product->getCategoria()
            ];
        } else {
            // Ya es un array o algún otro tipo de datos
            $productsArray[] = $product;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(["productsGoal" => $productsArray]);
}
