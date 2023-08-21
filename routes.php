<?php
return [
    'default' => ['controller' => 'AuthController', 'action' => 'login'],

    'empleado/dashboard' => ['controller' => 'EmpleadoController', 'action' => 'dashboard'],
    'empleado/timeclock' => ['controller' => 'EmpleadoController', 'action' => 'timeclock'],
    'empleado/perfil' => ['controller' => 'EmpleadoController', 'action' => 'perfil'],

    'administrador/getAll' => ['controller' => 'AdminController', 'action' => 'getAll'],
    'administrador/crea' => ['controller' => 'AdminController', 'action' => 'crearEmpleado'],
    'administrador/edita' => ['controller' => 'AdminController', 'action' => 'editarEmpleado'],
    'administrador/elimina' => ['controller' => 'AdminController', 'action' => 'eliminarEmpleado'],
];
?>