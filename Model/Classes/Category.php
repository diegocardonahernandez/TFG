<?php

require_once __DIR__ .  '/../../Config/Database.php';

class Category implements JsonSerializable
{

    private $id_categoria;
    private $nombre;

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public static function getCategory()
    {

        $db = Database::getInstance();
        $sql = 'SELECT * FROM categorias';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id_categoria' => $this->id_categoria,
            'nombre' => $this->nombre
        ];
    }
}
