<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearUsuario($username, $password) {
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id_persona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

// Ejemplo de uso:
$usuarioModelo = new Usuario($conn);
$nuevoUsuarioCreado = $usuarioModelo->crearUsuario("ejemplo_usuario", "ejemplo_contraseña");
if ($nuevoUsuarioCreado) {
    echo "Usuario creado exitosamente.";
} else {
    echo "Error al crear usuario.";
}

$usuarioObtenido = $usuarioModelo->obtenerUsuarioPorId(1);
print_r($usuarioObtenido);
?>