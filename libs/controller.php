<?php
class Controller {

    public $view;
    public $model;

    public function __construct()
    {
        $this->view = new View();
    }

    public function loadModel($model) {
        $url = 'models/' . $model . 'Model.php';

        if(file_exists($url)) {
            require_once $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    public function redirect($ruta, $mensajes) {
        $data = [];
        $params = "";

        foreach($mensajes as $key =>$mensaje) {
            array_push($data, $key . '=' . $mensaje);
        }

        $params = join('&', $data);
        // ?nombre=Clara$apellido=Iglesias
        if($params != '') {
            $params = '?' . $params;
        }

        header('location: ' . constant('URL') . $ruta . $params);

    }

}