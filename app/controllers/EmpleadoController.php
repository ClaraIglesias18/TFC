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
        
        $idEmpleado = $_SESSION['idEmpleado'];
        $fichajes = $this->fichajeRepository->obtenerFichajeActual($idEmpleado);
        $ultimosFichajes = $this->fichajeRepository->ultimosRegistrosTiempo($idEmpleado);
        

        $puedeRegistrarEntrada = true; // Determina si se puede registrar la entrada
        $puedeRegistrarSalida = true; // Determina si se puede registrar la salida

        /**
         * 1. Si no tiene fichajes en el dia actual, se permite realizar el fichaje de entrada
         * 2. Si en el fichaje actual hay una hora de entrada registrada y no de salida se 
         *    permite hacer el fichaje de salida
         * 3. Si no no se permite realizar ningun fichaje
         */
        if($fichajes == null) {
            $puedeRegistrarEntrada = true;
            $puedeRegistrarSalida = false;
        } elseif($fichajes['horaEntrada'] != null && $fichajes['horaSalida'] == null) {
            $puedeRegistrarEntrada = false;
            $puedeRegistrarSalida = true;
        } else {
            $puedeRegistrarEntrada = false;
            $puedeRegistrarSalida = false;
        }

        /** 
         * Si se registra una peticion POST, la cual es 'registrarEntrada', se establece
         * la hora de entrada a la hora actual
         * Si se registra una peticion POST, la cual es 'registrarSalida', se establece
         * la hora de salida a la hora actual  
         */ 
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'registrarEntrada') {
                    $horaEntrada = date('H:i');
                    $this->fichajeRepository->crearFichaje($idEmpleado, $horaEntrada, null, date('Y-m-d'));
                    header('Location: index.php?route=empleado/fichaje');
                } elseif ($_POST['action'] === 'registrarSalida') {
                    $horaSalida = date('H:i');
                    $this->fichajeRepository->actualizarHoraSalida($idEmpleado, $horaSalida);
                    header('Location: index.php?route=empleado/fichaje');
                }
            }
        }

        require_once 'app/views/empleado/fichaje.php';
    }

    public function perfil() {
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
