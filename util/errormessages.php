<?php

/**
 * Se definen unas constantes con los hash de los errores que posteriormente
 * se describen en el constructor y se pasan al array $errorList
 * para mostrarlos de manera mas ordenada en la view al usuario
 * (implementar esto para mis datos, usuario ya existente,
 *  hora de entrada ya instroducida....)
 *
 */
class ErrorMessages
{
    //ERROR_CONTROLLER_METHOD_ACTION
    public const ERROR_LOGIN_AUTHENTICATE_EMPTY = "124fdb0e8f9e8a662fdd578e77117fed";
    public const ERROR_LOGIN_AUTHENTICATE_FALSE = "8441ad2c45a426a4ddf572ea9fa496db";
    public const ERROR_LOGIN_AUTHENTICATE = "497c188b7a2ead3456ce26c3b5251f99";

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos para poder hacer login',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_FALSE => 'Correo o contraseña incorrectos',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud, ingresa correo y contraseña'
        ];
    }

    public function get($hash)
    {
        return $this->errorList[$hash];
    }

    public function existsKey($key)
    {
        return array_key_exists($key, $this->errorList);
    }
}
