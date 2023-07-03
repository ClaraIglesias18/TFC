<?php
class Controller {

    public $view;
    public $model;

    public function __construct() {
        $this->view = new View();
    }

    public function loadModel($model) {
        $url = 'models/' . $model . 'Model.php';

        if (file_exists($url)) {
            require_once $url;

            $modelName = $model . 'Model';
            $this->model = new $modelName();
        }
    }
    
    public function existPOST($params) {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                return false;
            }
        }
        return true;
    }

    public function existGET($params) {
        foreach ($params as $param) {
            if (!isset($_GET[$param])) {
                return false;
            }
        }
        return true;
    }

    public function getGet($name) {
        return $_GET[$name];
    }

    public function getPost($name) {
        return $_POST[$name];
    }

    public function redirect($ruta, $mensajes) {
        $data = [];
        $params = "";

        foreach ($mensajes as $key => $mensaje) {
            array_push($data, $key . '=' . $mensaje);
        }

        $params = join('&', $data);
        // ?nombre=Clara$apellido=Iglesias
        if ($params != '') {
            $params = '?' . $params;
        }
        var_dump($ruta);
        header('location:' . constant('URL') . $ruta . $params);
    }
}
