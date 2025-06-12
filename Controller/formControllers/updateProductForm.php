<?php
require_once __DIR__ . '/../../Model/Classes/Product.php';
require_once __DIR__ . '/../../Config/Database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  http_response_code(403);
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

try {
  $product = new Product();
  $product->setIdProducto($_POST['id_producto']);
  $product->setNombre($_POST['nombre']);
  $product->setDescripcion($_POST['descripcion']);
  $product->setDetallesProducto($_POST['detalles_producto'] ?? '');
  $product->setPrecio($_POST['precio']);
  $product->setDescuento($_POST['descuento'] ?? 0);
  $product->setStock($_POST['stock']);
  $product->setIdCategoria($_POST['id_categoria']);

  $estado = $_POST['estado'] ?? 'inactivo';
  if (!in_array($estado, ['activo', 'inactivo', 'agotado'])) {
    throw new Exception('Estado no válido');
  }
  $product->setEstado($estado);

  if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
    $db = Database::getInstance();
    $sql = "SELECT nombre FROM categorias WHERE id_categoria = :id_categoria";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id_categoria' => $_POST['id_categoria']]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
      throw new Exception('Categoría no encontrada.');
    }

    $categoryFolders = [
      'Ropa' => 'Ropa',
      'Suplementos' => 'Suplementos',
      'Equipamiento' => 'Equipamiento'
    ];

    $folderName = $categoryFolders[$category['nombre']] ?? 'products';
    $targetDir = __DIR__ . '/../../public/imgs/' . $folderName . '/';

    if (!file_exists($targetDir)) {
      if (!mkdir($targetDir, 0777, true)) {
        throw new Exception('Error al crear el directorio de imágenes.');
      }
    }

    $fileName = basename($_FILES['imagen']['name']);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['imagen']['tmp_name']);
    if ($check === false) {
      throw new Exception('El archivo no es una imagen.');
    }

    if ($_FILES['imagen']['size'] > 5000000) {
      throw new Exception('El archivo es demasiado grande.');
    }

    if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
      throw new Exception('Solo se permiten archivos JPG, JPEG y PNG.');
    }

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
      throw new Exception('Error al subir el archivo.');
    }

    $product->setImagen('/imgs/' . $folderName . '/' . $fileName);
  }

  $result = $product->update();

  echo json_encode(['success' => true]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}