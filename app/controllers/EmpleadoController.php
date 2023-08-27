<?php
require_once 'app/models/Fichaje.php';
require_once 'app/models/AuthModel.php';
require_once 'app/models/EmpleadoRepository.php';
class EmpleadoController {

    private $fichaje;
    private $authModel;
    private $empleadoRepository;

    public function __construct() {
        $this->fichaje = new Fichaje();
        $this->authModel = new AuthModel();
        $this->empleadoRepository = new EmpleadoRepository();
    }

    public function timeclock() {
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authModel->isLoggedIn()) {
            header('Location: index.php?route=auth/login');
            exit();
        }
        
        // Lógica para registrar las horas de entrada/salida del empleado
        $idEmpleado = $_SESSION['idEmpleado'];
        $fichajes = $this->fichaje->getPreviousTimeclockEntriesForToday($idEmpleado);
        $ultimosFichajes = $this->fichaje->ultimosRegistrosTiempo($idEmpleado);
        

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
                    $horaEntrada = date('H:i:s');
                    $this->fichaje->saveTimeclockEntry($idEmpleado, $horaEntrada, null, date('Y-m-d'));
                    header('Location: index.php?route=empleado/timeclock');
                } elseif ($_POST['action'] === 'register_exit') {
                    $horaSalida = date('H:i:s');
                    $this->fichaje->updateTimeclockExitTime($idEmpleado, $horaSalida);
                    header('Location: index.php?route=empleado/timeclock');
                }
            }
        }

        require_once 'app/views/empleado/timeclock.php';
    }

    public function perfil() {
        // mostrar los datos del empleado
        // Verificar si el usuario ha iniciado sesión
        if (!$this->authModel->isLoggedIn()) {
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
    
}
