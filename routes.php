<?php
return [
    'default' => ['controller' => 'AuthController', 'action' => 'login'],
    'auth/login' => ['controller' => 'AuthController', 'action' => 'login'],
    'auth/logout' => ['controller' => 'AuthController', 'action' => 'logout'],

    'empleado/dashboard' => ['controller' => 'EmpleadoController', 'action' => 'dashboard'],
    'empleado/fichaje' => ['controller' => 'EmpleadoController', 'action' => 'fichaje'],
    'empleado/perfil' => ['controller' => 'EmpleadoController', 'action' => 'perfil'],
    'empleado/editarFichaje' => ['controller' => 'EmpleadoController', 'action' => 'editarFichaje'],


    'administrador/manage' => ['controller' => 'AdminController', 'action' => 'manage'],
    'administrador/getAll' => ['controller' => 'AdminController', 'action' => 'getAll'],
    'administrador/crear' => ['controller' => 'AdminController', 'action' => 'agregarEmpleado'],
    'administrador/editar' => ['controller' => 'AdminController', 'action' => 'editarEmpleado'],
    'administrador/eliminar' => ['controller' => 'AdminController', 'action' => 'eliminarEmpleado'],
];
?>