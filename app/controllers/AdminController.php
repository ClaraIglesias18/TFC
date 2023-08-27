<?php
require_once('app/models/EmpleadoRepository.php');
class AdminController {

    private $empleadoRepository;

    public function __construct() {
        $this->empleadoRepository = new EmpleadoRepository();
    }

    public function manage() {
        // Aquí puedes recuperar la lista de empleados desde la base de datos
        // y mostrarla en una vista de administración
        $empleados = $this->empleadoRepository->getAll(); // Función para obtener la lista de empleados

        require_once 'app/views/admin/manage.php';
    }

    public function agregarEmpleado() {
        // Lógica para agregar un nuevo empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario y agregar el empleado a la base de datos
            $this->empleadoRepository->agregarEmpleado($_POST);
            header('Location: index.php?route=administrador/manage');
        }
        require_once 'app/views/admin/agregarEmpleado.php';
    }

    public function editarEmpleado() {
        // Lógica para editar los detalles de un empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->empleadoRepository->editEmpleado($_POST['idEmpleado'], $_POST);
            header('Location: index.php?route=administrador/manage');
        }
    }

    public function eliminarEmpleado() {
        // Lógica para eliminar un empleado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eliminar el empleado de la base de datos
            $this->empleadoRepository->deleteById($_POST['idEmpleado']);
            header('Location: index.php?route=administrador/manage');
        }
    }

}
