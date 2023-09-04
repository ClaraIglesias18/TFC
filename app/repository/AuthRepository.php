<?php
require_once 'app/model/BaseModel.php';
class AuthRepository extends BaseModel{

    // Lógica para autenticar al usuario por medio de nombre de usuario y el hash de la contraseña
    public function authenticateUser($nombreUsuario, $passwordHash) {
        $sql = "SELECT idEmpleado, password, rol FROM empleados WHERE nombreUsuario = :nombreUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($passwordHash, $user['password'])) {
            // Validación exitosa, inicia sesión
            session_start();
            $_SESSION['idEmpleado'] = $user['idEmpleado'];
            $_SESSION['rol'] = $user['rol'];
            return true;
        }
        
        return false;
    }

    // Lógica para determinar si el usuarioes administrador o no
    public function isAdministrator($nombreUsuario) {
        $sql = "SELECT rol FROM empleados WHERE nombreUsuario = :nombreUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && $user['rol'] == 1);
    }

    // Lógica para determinar si el usuario esta logeado comprobando
    // si hay una sesión con su ID creada
    public function isLoggedIn() {
        return isset($_SESSION['idEmpleado']);
    }
}