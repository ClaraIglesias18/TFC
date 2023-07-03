<?php
class Login extends SessionController {

    public function __construct() {
        parent::__construct();
    }

    public function render() {
        $this->view->render('login/index');
    }

    public function authenticate() {
        if($this->existPOST('correo', 'password')) {
            $correo = $this->getPost('correo');
            $password = $this->getPost('password');

            if($correo == '' || empty($correo) || $password == '' || empty($password)) {
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
            }

            $user = $this->model->login($correo, $password);

            if($user != null) {
                $this->initialize($user);
            } else {
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_FALSE]);
            }
        } else {
            $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
}
