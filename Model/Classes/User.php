<?php

require_once __DIR__ . '/../../Config/Database.php';

class User
{
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $telefono;
    private $correo;
    private $contrasena;
    private $fecha_nacimiento;
    private $genero;
    private $peso;
    private $altura;
    private $tipo_usuario;
    private $estado;
    private $foto_perfil;


    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario($tipo_usuario)
    {
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }


    public static function insertNewUser(
        $nombre,
        $apellido,
        $telefono,
        $correo,
        $contrasena,
        $fecha_nacimiento,
        $genero,
        $peso,
        $altura,
        $tipo_usuario,
        $estado,
        $foto_perfil
    ) {
        $db = Database::getInstance();
        $query = "INSERT INTO usuarios 
                  (nombre, apellido, telefono, correo, contrasena, fecha_nacimiento, genero, peso, altura, tipo_usuario, estado, foto_perfil) 
                  VALUES 
                  (:nombre, :apellido, :telefono, :correo, :contrasena, :fecha_nacimiento, :genero, :peso, :altura, :tipo_usuario, :estado, :foto_perfil)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':foto_perfil', $foto_perfil);

        return $stmt->execute();
    }

    public static function getUserById($id)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public static function getAllUsers()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM usuarios";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function updateUserData($nombre, $apellido, $telefono, $fechaNacimiento, $genero, $peso, $altura, $fotoPerfil, $tipoUsuario, $estado, $idUsuario)
    {
        $db = Database::getInstance();
        $query =  "UPDATE usuarios 
        SET nombre = :nombre,
            apellido = :apellido,
            telefono = :telefono,
            fecha_nacimiento = :fecha_nacimiento,
            genero = :genero,
            peso = :peso,
            altura = :altura,
            foto_perfil = :foto_perfil,
            tipo_usuario = :tipo_usuario,
            estado = :estado
        WHERE id_usuario = :id_usuario";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':nombre'           => $nombre,
            ':apellido'         => $apellido,
            ':telefono'         => $telefono,
            ':fecha_nacimiento' => $fechaNacimiento,
            ':genero'           => $genero,
            ':peso'             => $peso,
            ':altura'           => $altura,
            ':foto_perfil'      => $fotoPerfil,
            ':tipo_usuario'     => $tipoUsuario,
            ':estado'           => $estado,
            ':id_usuario'       => $idUsuario
        ]);
    }

    public static function updateUserDataAndPassw($nombre, $apellido, $telefono, $fechaNacimiento, $genero, $peso, $altura, $fotoPerfil, $contrasena, $tipoUsuario, $estado, $idUsuario)
    {
        $db = Database::getInstance();
        $query =  "UPDATE usuarios 
    SET nombre = :nombre,
        apellido = :apellido,
        telefono = :telefono,
        fecha_nacimiento = :fecha_nacimiento,
        genero = :genero,
        peso = :peso,
        altura = :altura,
        foto_perfil = :foto_perfil,
        contrasena = :contrasena,
        tipo_usuario = :tipo_usuario,
        estado = :estado
    WHERE id_usuario = :id_usuario";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':nombre'           => $nombre,
            ':apellido'         => $apellido,
            ':telefono'         => $telefono,
            ':fecha_nacimiento' => $fechaNacimiento,
            ':genero'           => $genero,
            ':peso'             => $peso,
            ':altura'           => $altura,
            ':foto_perfil'      => $fotoPerfil,
            ':contrasena'       => $contrasena,
            ':tipo_usuario'     => $tipoUsuario,
            ':estado'           => $estado,
            ':id_usuario'       => $idUsuario
        ]);
    }

    public static function deleteUser($id)
    {
        $db = Database::getInstance();
        $query = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $db->prepare($query);
        $stmt->execute([":id" => $id]);

        return $stmt->rowCount();
    }

    public static function upgradeToPremium($userId)
    {
        $db = Database::getInstance();
        $query = "UPDATE usuarios SET tipo_usuario = 'Premium' WHERE id_usuario = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([":id" => $userId]);
    }
}