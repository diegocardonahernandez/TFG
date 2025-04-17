<?php

require_once __DIR__ . '/../Functions/redirectView.php';

$currentCategory = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

renderLayout('category',['currentCategory' => $currentCategory]);

/*Solo para probar , ahora hay que hacer la funcion en category para que
    según la categoría en la que este (que cogeremos mediante la url ) , se muestren
    los productos de esta (pasaremos en la funcion renderLayout las variables : 
    la categoria que se va a mostrar , y otra variable de sus productos). */