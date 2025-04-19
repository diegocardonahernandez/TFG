<?php

echo 'Bienvenido a ' . $category . '<br>';

foreach($products as $product){
    echo $product->getNombre() . '<br>';
}
