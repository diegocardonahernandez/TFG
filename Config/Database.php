<?php

class Database
{
    private static $instance = null;
    private $db;

    public function __construct()
    {
        $conecction = 'mysql:dbname=purogains;host=localhost';
        $user = 'root';
        $pass = '';

        try {
            $this->db = new PDO($conecction, $user, $pass);
        } catch (Exception $ex) {
            echo 'Ha ocurrido un error al intentar establecer conexión con la base de datos: ' . $ex->getMessage();
        }
    }

    // Método estático que obtiene la única instancia de la clase
    public static function getInstance()
    {
        // Si no existe la instancia, la creamos
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        // Retornamos la instancia existente
        return self::$instance->db;
    }

    // Evitar la clonación de la clase Singleton
    private function __clone() {}

    // Evitar la deserialización de la clase Singleton
    public function __wakeup() {}
}
