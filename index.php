<?php
session_start();
require_once 'routes.php';

require_once 'app/repository/Database.php';
require_once 'app/repository/FichajeRepository.php';
require_once 'app/repository/AuthRepository.php';
require_once 'app/repository/EmpleadoRepository.php';

require_once 'app/model/BaseModel.php';

$baseModel = new BaseModel();

// Autoloader para cargar automáticamente las clases
spl_autoload_register(function ($className) {
    require_once 'app/controllers/' . $className . '.php';
});

// Obtener la ruta actual desde el parámetro 'route' en $_GET
$route = $_GET['route'] ?? 'default';
$routes = include 'routes.php';
$controllerAction = $routes[$route] ?? $routes['default'];

$controller = $controllerAction['controller'];
$action = $controllerAction['action'];

// Crear instancia del controlador y ejecutar la acción
$controllerInstance = new $controller();
$controllerInstance->$action();
?>