<?php

function renderLayout($view, $data = [])
{
    extract($data);

    require_once __DIR__ . '/../Controller/headerController.php';
    require_once __DIR__ . "/../View/$view.php";
    require_once __DIR__ . '/../View/Partials/footer.php';
}
