<?php
require_once 'app/models/EmpleadoModel.php';
require_once 'app/models/Conexion.php';
class EmpleadoRepository extends EmpleadoModel {
    public function getAll() {
        $conexion = Conexion::getConexion();
        $sql = "SELECT * FROM empleado";
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
        $sql = "SELECT * FROM empleado WHERE idEmpleado = :idEmpleado";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $consulta->execute();
        $empleado = $consulta->fetchObject('EmpleadoRepository');
        return $empleado;
    }

    public function deleteById($idEmpleado) {
        $conexion = Conexion::getConexion();
        $sql = "DELETE FROM empleado WHERE idEmpleado = :idEmpleado";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $consulta->execute();
    }

}
