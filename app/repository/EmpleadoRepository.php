<?php
require_once 'app/model/BaseModel.php';
class EmpleadoRepository extends BaseModel{

    // Retorna todos los empleados de la base de datos
    public function getAll() {
        $sql = "SELECT * FROM empleados";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna un empleado en funcion de ID que se le pase 
    public function getById($idEmpleado) {
        $sql = "SELECT * FROM empleados WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $empleado;
    }

    // Borra un empleado en función de ID que se le pase
    public function deleteById($idEmpleado) {
        $sql = "DELETE FROM empleados WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Actualiza los datos de un empleado 
    public function editEmpleado($idEmpleado, $datos) {
        if(isset($datos['rol'])) {
            $rol = 1;
        } else {
            $rol = 0;
        }
        $sql = "UPDATE empleados SET nombre = :nombre, apellidos = :apellidos, nombreUsuario = :nombreUsuario, rol = :rol WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
        $stmt->bindParam(':nombreUsuario', $datos['nombreUsuario'], PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Crea un nuevo empleado en con los datos que se le pasan
    public function agregarEmpleado($datos) {
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO empleados (nombreUsuario, password, email, nombre, apellidos, telefono, rol) VALUES (:nombreUsuario, :password, :email, :nombre, :apellidos, :telefono, :rol)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $datos['nombreUsuario'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_INT);
        $stmt->execute();
    }

}
