<?php
require_once 'app/models/EmpleadoModel.php';
require_once 'app/models/Conexion.php';
class EmpleadoRepository extends EmpleadoModel {
    public function getAll() {
        $conexion = Conexion::getConexion();
        $sql = "SELECT * FROM empleados";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $empleados = [];
        while ($empleado = $consulta->fetchObject('EmpleadoRepository')) {
            $empleados[] = $empleado;
        }
        return $empleados;
    }

    public function getById($idEmpleado) {
        $conexion = Conexion::getConexion();
        $sql = "SELECT * FROM empleados WHERE idEmpleado = :idEmpleado";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $consulta->execute();
        $empleado = $consulta->fetchObject('EmpleadoRepository');
        return $empleado;
    }

    public function deleteById($idEmpleado) {
        $conexion = Conexion::getConexion();
        $sql = "DELETE FROM empleados WHERE idEmpleado = :idEmpleado";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function editEmpleado($idEmpleado, $datos) {
        if(isset($datos['rol'])) {
            $rol = 1;
        } else {
            $rol = 0;
        }
        $conexion = Conexion::getConexion();
        $sql = "UPDATE empleados SET nombre = :nombre, apellidos = :apellidos, rol = :rol WHERE idEmpleado = :idEmpleado";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $consulta->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
        $consulta->bindParam(':rol', $rol, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function agregarEmpleado($datos) {
        $conexion = Conexion::getConexion();
        $sql = "INSERT INTO empleados (nombreUsuario, password, email, nombre, apellidos, telefono, rol) VALUES (:nombreUsuario, :password, :email, :nombre, :apellidos, :telefono, :rol)";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':nombreUsuario', $datos['nombreUsuario'], PDO::PARAM_STR);
        $consulta->bindParam(':password', $datos['password'], PDO::PARAM_STR);
        $consulta->bindParam(':email', $datos['email'], PDO::PARAM_STR);
        $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $consulta->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
        $consulta->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
        $consulta->bindParam(':rol', $datos['rol'], PDO::PARAM_INT);
        $consulta->execute();
    }

}
