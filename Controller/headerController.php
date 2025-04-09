<?php

require_once __DIR__ . '/../Model/Classes/Category.php';

$categoriesNames = Category::getCategory();

require_once __DIR__ . '/../View/Partials/header.php';
