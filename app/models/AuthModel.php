<?php
class AuthModel {

    //falta sacar repositorio par interactuar con la base de datos

    public function authenticateUser($nombreUsuario, $password) {
        $sql = "SELECT idEmpleado, password, rol FROM empleados WHERE nombreUsuario = :nombreUsuario";
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && $password == $user['password']) {
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
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user && $user['rol'] == 1);
    }

    public function isLoggedIn() {
        return isset($_SESSION['idEmpleado']);
    }
}