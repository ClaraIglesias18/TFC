<?php

require_once 'models/usermodel.php';
class LoginModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    function login($correo, $password) {
        try {
            $query = $this->prepare('SELECT * FROM usuario WHERE correo = ?');
            $query->execute([$correo]);

            if($query->rowcount() == 1) {
                $result = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->from($result);

                if(password_verify($password, $user->getPassword())) {
                    return $user;
                } else {
                    return null;
                }
            }

        } catch(PDOException $e) {
            return null;
        }
    }
    
}
