<?php
//routeador de controladores
class App {
    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        //borra cualquier / que se ecuentre al final

        $url = rtrim($url, '/');
        //divide url en array de elementos
        $url = explode('/', $url);

        // ------  /user/listar -------
        // cuando se ingresa sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';
        

        if (file_exists($archivoController)) {
            require_once $archivoController;
            
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        $nparam = count($url) - 2;
                        $params = [];

                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i] + 2);
                        }

                        $controller->{$url[1]($params)};
                    } else {
                        //si no tiene parametros, se llamma al 
                        //metodo tal cual
                        $controller->{$url[1]}();
                    }
                } else {
                    //no existe el metodo
                    echo 'No existe el metodo';
                }
            } else {
                //si no hay metodo se carga el metodo default
                $controller->render();
            }
        }
    }
}
