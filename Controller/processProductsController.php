<?php

require_once __DIR__ . '/../Functions/redirectView.php';

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  header('Location: /');
  exit();
}

renderLayout('processProducts');
