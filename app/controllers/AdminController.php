<?php
class AdminController {

    private $empleadoRepository;
    private $authRepository;

    public function __construct() {
        $this->empleadoRepository = new EmpleadoRepository();
        $this->authRepository = new AuthRepository();
    }

    // Se recupera la lista de empleados de la base de datos y se miuestra en la vista
    public function administrar() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }

        $empleados = $this->empleadoRepository->getAll();

        require_once 'app/views/admin/administrar.php';
    }

    // Se crea un nuevo empleado
    public function agregarEmpleado() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }

        // Lógica para agregar un nuevo empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario y agregar el empleado a la base de datos
            $this->empleadoRepository->agregarEmpleado($_POST);
            header('Location: index.php?route=administrador/administrar');
        }
        require_once 'app/views/admin/agregarEmpleado.php';
    }

    // Se edita un empleado pasandole los parametros a modificar por POST
    public function editarEmpleado() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }
        // Lógica para editar los detalles de un empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->empleadoRepository->editEmpleado($_POST['idEmpleado'], $_POST);
            header('Location: index.php?route=administrador/administrar');
        }
    }

    // Se elimina un empleado pasandole pos POST el idEmpleado
    public function eliminarEmpleado() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }
        // Lógica para eliminar un empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eliminar el empleado de la base de datos
            $this->empleadoRepository->deleteById($_POST['idEmpleado']);
            header('Location: index.php?route=administrador/administrar');
        }
    }
}
