<?php
class UserModel extends Model implements iModel {

    private $idUser;
    private $nombre;
    private $apellidos;
    private $correo;
    private $rol;
    private $password;

    public function __construct() {
        parent::__construct();
        $this->idUser = "";
        $this->nombre = "";
        $this->apellidos = "";
        $this->correo = "";
        $this->rol = "";
        $this->password = "";
    }

    public function create() {
        try {
            $query = $this->prepare(
                'INSERT INTO user(
                    idUser,
                    nombre, 
                    apellidos, 
                    correo, 
                    rol, 
                    password) 
                VALUES (?, ? , ?, ?, ?, ?)'
            );

            $query->execute([
                $this->idUser,
                $this->nombre,
                $this->apellidos,
                $this->correo,
                $this->rol,
                $this->password
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll() {
        $items = [];
        try {
            $query = $this->query('SELECT * FROM user');

            foreach ($query->fetch(PDO::FETCH_ASSOC) as $p) {
                $item = new UserModel();
                $item->setIdUser($p['idUser']);
                $item->setNombre($p['nombre']);
                $item->setApellidos($p['apellidos']);
                $item->setCorreo($p['correo']);
                $item->setRol($p['rol']);
                $item->setPassword($p['password']);

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getById($id) {
        try {
            $query = $this->prepare('SELECT * FROM user WHERE idUser = ?');
            $query->execute([$id]);

            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdUser($user['idUser']);
            $this->setNombre($user['nombre']);
            $this->setApellidos($user['apellidos']);
            $this->setCorreo($user['correo']);
            $this->setRol($user['rol']);
            $this->setPassword($user['password']);

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = $this->prepare('DELETE FROM user WHERE idUser = ?');
            $query->execute([$id]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function modify() {
        try {
            $query = $this->prepare(
                'UPDATE user SET
                    nombre = ?, 
                    apellidos = ?, 
                    correo = ?, 
                    rol = ?, 
                    password =?
                WHERE id = ?'
            );
            $query->execute([
                $this->nombre,
                $this->apellidos,
                $this->correo,
                $this->rol,
                $this->password,
                $this->idUser
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function from($array) {
        $this->idUser = $array['idUser'];
        $this->nombre = $array['nombre'];
        $this->apellidos = $array['apellidos'];
        $this->correo = $array['correo'];
        $this->rol = $array['rol'];
        $this->password = $array['password'];
    }

    public function exists($correo) {
        try {
            $query = $this->prepare('SELECT correo FROM user WHERE correo = ?');
            $query->execute([$correo]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function comparePasswords($password, $idUser) {
        try {
            $user = $this->getById($idUser);

            return password_verify($password, $user->getPassword());
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser): self {
        $this->idUser = $idUser;

        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre): self {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos): self {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo): self {
        $this->correo = $correo;

        return $this;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol): self {
        $this->rol = $rol;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password): self {

        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }
}
