<?php
class Rol {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerRoles() {
        $query = "SELECT * FROM rol";
        $statement = $this->conexion->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRolPorId($id) {
        $query = "SELECT * FROM rol WHERE id_rol = :id";
        $statement = $this->conexion->prepare($query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function crearRol($nombre) {
        $query = "INSERT INTO rol (nombre_rol) VALUES (:nombre)";
        $statement = $this->conexion->prepare($query);
        $statement->bindParam(":nombre", $nombre);
        return $statement->execute();
    }

    public function eliminarRol($id) {
        $query = "DELETE FROM rol WHERE id_rol = :id";
        $statement = $this->conexion->prepare($query);
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }
}

// Ejemplo de uso
try {
    $conexion = new PDO("mysql:host=localhost;dbname=nombre_base_de_datos", "usuario", "contraseña");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $rolModelo = new Rol($conexion);

    // Obtener todos los roles
    $roles = $rolModelo->obtenerRoles();
    print_r($roles);

    // Obtener un rol por su ID
    $rol = $rolModelo->obtenerRolPorId(1);
    print_r($rol);

    // Crear un nuevo rol
    $rolModelo->crearRol("Nuevo Rol");

    // Eliminar un rol
    $rolModelo->eliminarRol(2);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>