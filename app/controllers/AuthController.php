<?php
class AuthController {

    private $authRepository;
    private $empleadoRepository;

    public function __construct() {
        $this->authRepository = new AuthRepository();
        $this->empleadoRepository = new EmpleadoRepository;
    }
    
    //Lógica para el inicio de sesion y sus correspondientes validaciones
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $passwordHash = $_POST['password'];
            
            // Validar las credenciales y autenticar al usuario
            $autenticado = $this->authRepository->authenticateUser($username, $passwordHash); // Función hipotética para autenticar al usuario

            if ($autenticado) {
                // Redirigir a la pagina de fichar del empleado o a la de administrador en el caso de serlo
                if ($this->authRepository->isAdministrator($username)) {
                    header('Location: index.php?route=administrador/administrar');
                } else {
                    header('Location: index.php?route=empleado/fichaje');
                }
                exit;
            } else {
                $errorMessage = "Credenciales inválidas. Intente de nuevo.";
            }
        }
        
        require_once 'app/views/auth/login.php';
    }

    //Eliminar la sesion y redirigir a la página de login
    public function logout() {
        session_destroy();
        header('Location: index.php?route=auth/login');
        exit;
    }

    public function registro() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = $_POST;
            $datos['rol'] = 0;

            $this->empleadoRepository->agregarEmpleado($datos);

            header('Location: index.php?route=auth/login');
        }

        require_once 'app/views/auth/registro.php';
    }
}
?>