<?php
class SuccessMessages {
    //const SUCCESS_ADMIN_NEW_CATEGORY_EXISTS = "9a671157435d665348d11c33c9d8ca70";
    const PRUEBA = "75a1a88b919e76a7640e7ccb984752de";

    private $successList = [];

    public function __construct() {
        $this->successList = [
            //SuccessMessages::SUCCESS_ADMIN_NEW_CATEGORY_EXISTS => 'El nombre de la categoria ya existe, intente otro'
            SuccessMessages::PRUEBA => 'Este es un mensaje de exito'
        ];
    }

    public function get($hash) {
        return $this->successList[$hash];
    }

    public function existsKey($key) {
        return array_key_exists($key, $this->successList);
    }
}
