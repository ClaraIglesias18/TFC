<?php
require_once 'app/model/BaseModel.php';
class AuthRepository extends BaseModel{

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

    public function isAdministrator($nombreUsuario) {
        $sql = "SELECT rol FROM empleados WHERE nombreUsuario = :nombreUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && $user['rol'] == 1);
    }

    public function isLoggedIn() {
        return isset($_SESSION['idEmpleado']);
    }
}