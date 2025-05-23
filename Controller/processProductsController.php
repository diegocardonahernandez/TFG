<?php

require_once __DIR__ . '/../Functions/redirectView.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  header('Location: /');
  exit();
}

renderLayout('processProducts');
