<?php

require_once __DIR__ . '/../../Config/Database.php';

class Product implements JsonSerializable
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $detalles_producto;
    private $precio;
    private $stock;
    private $id_categoria;
    private $imagen;
    private $descuento;
    private $popularidad;
    private $estado;
    private $fecha_creacion;
    private $categoria;

    public function jsonSerialize(): mixed
    {
        return [
            'id_producto' => $this->id_producto,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'detalles_producto' => $this->detalles_producto,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'id_categoria' => $this->id_categoria,
            'imagen' => $this->imagen,
            'descuento' => $this->descuento,
            'popularidad' => $this->popularidad,
            'estado' => $this->estado,
            'fecha_creacion' => $this->fecha_creacion,
            'categoria' => $this->categoria
        ];
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    public function getPopularidad()
    {
        return $this->popularidad;
    }

    public function setPopularidad($popularidad)
    {
        $this->popularidad = $popularidad;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getDetallesProducto()
    {
        return $this->detalles_producto;
    }
    public function setDetallesProducto($detalles_producto)
    {
        $this->detalles_producto = $detalles_producto;
    }

    public static function getAll()
    {

        $db = Database::getInstance();
        $sql = 'SELECT * FROM productos';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }


    public static function getMostViewed()
    {

        $db = Database::getInstance();
        $sql = "SELECT p.*, c.nombre AS categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria WHERE p.estado = 'activo' ORDER BY p.popularidad DESC LIMIT 12";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getProductsCategory($category)

    {
        $db = Database::getInstance();
        $sql = "SELECT p.* , c.nombre AS categoria FROM productos p JOIN categorias c USING(id_categoria) WHERE c.nombre = :category AND p.estado = 'activo' OR p.estado = 'agotado'";
        $stmt = $db->prepare($sql);
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getProductDetails($id)
    {

        $db = Database::getInstance();
        $sql = "SELECT p.* , c.nombre AS categoria FROM productos p JOIN categorias c USING(id_categoria) WHERE p.id_producto = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getProductsForGoal($productGoal)
    {
        $db = Database::getInstance();

        $placeholders = rtrim(str_repeat('?,', count($productGoal)), ',');

        $sql = "SELECT p.*, c.nombre AS categoria 
            FROM productos p 
            JOIN categorias c USING(id_categoria) 
            WHERE p.nombre IN ($placeholders) 
            LIMIT 4";

        $stmt = $db->prepare($sql);
        $stmt->execute($productGoal);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public function save()
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO productos (nombre, descripcion, detalles_producto, precio, stock, id_categoria, imagen, estado) 
                VALUES (:nombre, :descripcion, :detalles_producto, :precio, :stock, :id_categoria, :imagen, :estado)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'detalles_producto' => $this->detalles_producto,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'id_categoria' => $this->id_categoria,
            'imagen' => $this->imagen,
            'estado' => $this->estado
        ]);
    }

    public function update()
    {
        $db = Database::getInstance();
        $sql = "UPDATE productos 
                SET nombre = :nombre, 
                    descripcion = :descripcion, 
                    detalles_producto = :detalles_producto, 
                    precio = :precio, 
                    stock = :stock, 
                    id_categoria = :id_categoria, 
                    descuento = :descuento,
                    estado = :estado";

        $params = [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'detalles_producto' => $this->detalles_producto,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'id_categoria' => $this->id_categoria,
            'descuento' => $this->descuento,
            'estado' => $this->estado,
            'id_producto' => $this->id_producto
        ];

        if ($this->imagen) {
            $sql .= ", imagen = :imagen";
            $params['imagen'] = $this->imagen;
        }

        $sql .= " WHERE id_producto = :id_producto";

        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete($id)
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM productos WHERE id_producto = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function getAllWithCategory()
    {
        $db = Database::getInstance();
        $sql = 'SELECT p.*, c.nombre AS categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria ORDER BY p.nombre';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getDiscountedProducts()
    {
        $db = Database::getInstance();
        $sql = 'SELECT p.*, c.nombre AS categoria 
                FROM productos p 
                JOIN categorias c ON p.id_categoria = c.id_categoria 
                WHERE p.descuento > 0 
                ORDER BY p.descuento DESC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getSearchProducts($search)
    {
        $db = Database::getInstance();
        $sql = "SELECT p.*, c.nombre AS categoria 
                FROM productos p 
                JOIN categorias c ON p.id_categoria = c.id_categoria 
                WHERE p.nombre LIKE :search";
        $stmt = $db->prepare($sql);
        $stmt->execute(['search' => '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }


    public static function decreaseStockAndUpdatePopularidad($id, $quantity)
    {
        $db = Database::getInstance();
        $sql = "UPDATE productos SET stock = stock - :quantity, popularidad = popularidad + :quantity WHERE id_producto = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute(['id' => $id, 'quantity' => $quantity]);
    }
}