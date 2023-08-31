<?php
class AuthController {

    private $authRepository;

    public function __construct() {
        $this->authRepository = new AuthRepository();
    }
    
    public function login() {
        // Lógica para el inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $passwordHash = $_POST['password'];
            
            // Validar las credenciales y autenticar al usuario
            $authenticated = $this->authRepository->authenticateUser($username, $passwordHash); // Función hipotética para autenticar al usuario

            if ($authenticated) {
                // Redirigir a la página de dashboard del empleado o administrador
                if ($this->authRepository->isAdministrator($username)) {
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
}
?>