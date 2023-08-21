<?php
session_start();
require_once 'config/db.php';
require_once 'routes.php';

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

// Cargar las vistas correspondientes
/**$viewPath = "app/views/$route.php"; // Ruta a la vista basada en la URL
echo $route;
echo $viewPath;
if (file_exists($viewPath)) {
    require_once $viewPath;
} else {
    echo "Vista no encontrada.";
}**/
?>