<?php

class EmpleadoController {

    private $fichajeRepository;
    private $authRepository;
    private $empleadoRepository;

    public function __construct() {
        $this->fichajeRepository = new FichajeRepository();
        $this->authRepository = new AuthRepository();
        $this->empleadoRepository = new EmpleadoRepository();
    }

    public function fichaje() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }
        
        // Lógica para registrar las horas de entrada/salida del empleado
        $idEmpleado = $_SESSION['idEmpleado'];
        $fichajes = $this->fichajeRepository->getPreviousTimeclockEntriesForToday($idEmpleado);
        $ultimosFichajes = $this->fichajeRepository->ultimosRegistrosTiempo($idEmpleado);
        

        $canRegisterEntryTime = true; // Lógica para determinar si se puede registrar la entrada
        $canRegisterExitTime = true; // Lógica para determinar si se puede registrar la salida

        $hasEntryTime = false;
        $hasExitTime = false;

        if($fichajes == null) {
            $hasEntryTime = false;
            $canRegisterEntryTime = true;
            $hasExitTime = false;
            $canRegisterExitTime = false;
        } elseif($fichajes['horaEntrada'] != null && $fichajes['horaSalida'] == null) {
            $hasEntryTime = true;
            $hasExitTime = false;
            $canRegisterEntryTime = false;
            $canRegisterExitTime = true;
        } else {
            $hasEntryTime = true;
            $hasExitTime = true;
            $canRegisterEntryTime = false;
            $canRegisterExitTime = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'register_entry') {
                    $horaEntrada = date('H:i');
                    $this->fichajeRepository->saveTimeclockEntry($idEmpleado, $horaEntrada, null, date('Y-m-d'));
                    header('Location: index.php?route=empleado/fichaje');
                } elseif ($_POST['action'] === 'register_exit') {
                    $horaSalida = date('H:i');
                    $this->fichajeRepository->updateTimeclockExitTime($idEmpleado, $horaSalida);
                    header('Location: index.php?route=empleado/fichaje');
                }
            }
        }

        require_once 'app/views/empleado/fichaje.php';
    }

    public function perfil() {
        // mostrar los datos del empleado
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authRepository->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }

        // Obtener el ID del usuario desde la sesión
        $idEmpleado = $_SESSION['idEmpleado'];

        // Obtener los datos del empleado desde la base de datos
        $userData = $this->empleadoRepository->getById($idEmpleado);

        // Cargar la vista del perfil del usuario
        require_once 'app/views/empleado/perfil.php';
    }

    public function editarFichaje() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->fichajeRepository->editarFichaje($_POST['idFichaje'], $_POST);
            var_dump($_POST['idFichaje']);
            
            header('Location: index.php?route=empleado/fichaje');
        }
    }
    
}
