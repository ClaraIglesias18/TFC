<?php
require_once 'app/models/Fichaje.php';
class EmpleadoController {

    private $fichaje;

    public function __construct() {
        $this->fichaje = new Fichaje();
    }

    public function timeclock() {
        // Lógica para registrar las horas de entrada/salida del empleado
        // Lógica para registrar las horas de entrada/salida del empleado
        $idEmpleado = $_SESSION['idEmpleado'];
        $fichajes = $this->fichaje->getPreviousTimeclockEntriesForToday($idEmpleado);
        var_dump($fichajes);

        

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

    private function getPreviousTimeclockEntriesForToday($idEmpleado) {
        return $this->fichaje->getPreviousTimeclockEntriesForToday($idEmpleado);
    }

    private function updateTimeclockExitTime($idFichaje, $horaSalida) {
        $this->fichaje->updateTimeclockExitTime($idFichaje, $horaSalida);
    }

    private function saveTimeclockEntry($horaEntrada, $horaSalida, $fecha) {
        $this->fichaje->saveTimeclockEntry($_SESSION['idEmpleado'], $horaEntrada, $horaSalida, $fecha);
    }

    public function perfil() {
        // mostrar los datos del empleado
        
        require_once 'app/views/empleado/perfil.php';
    }
    
}
