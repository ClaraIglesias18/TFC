<?php
require_once 'app/models/AuthModel.php';
class AuthController {

    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }
    
    public function login() {
        // Lógica para el inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Validar las credenciales y autenticar al usuario
            $authenticated = $this->authenticateUser($username, $password); // Función hipotética para autenticar al usuario

            if ($authenticated) {
                // Redirigir a la página de dashboard del empleado o administrador
                if ($this->isAdministrator($username)) {
                    header('Location: index.php?route=administrador/manage');
                } else {
                    header('Location: index.php?route=empleado/timeclock');
                }
                exit;
            } else {
                $errorMessage = "Credenciales inválidas. Intente de nuevo.";
            }
        }
        
        require_once 'app/views/auth/login.php';
    }

    public function logout() {
        // Lógica para cerrar sesión
        // Eliminar las variables de sesión y redirigir al inicio de sesión
        session_destroy();
        header('Location: index.php?route=auth/login');
        exit;
    }

    // Métodos hipotéticos para interactuar con la autenticación y la base de datos
    private function authenticateUser($username, $password) {
        return $this->authModel->authenticateUser($username, $password);
    }

    private function isAdministrator($username) {
        return $this->authModel->isAdministrator($username);
    }
}
?>