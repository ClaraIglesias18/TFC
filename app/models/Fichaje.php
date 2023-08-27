<?php
class Fichaje {

    public function getPreviousTimeclockEntriesForToday($idEmpleado) {
        $today = date('Y-m-d');
        $sql = "SELECT idFichaje, idEmpleado, horaEntrada, horaSalida, fecha FROM fichajes WHERE idEmpleado = :idEmpleado AND DATE(fecha) = :today";
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':today', $today, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTimeclockExitTime($idEmpleado, $horaSalida) {
        $sql = "UPDATE fichajes SET horaSalida = :horaSalida WHERE idEmpleado = :idEmpleado";
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function saveTimeclockEntry($idEmpleado, $horaEntrada, $horaSalida, $fecha) {
        $sql = "INSERT INTO fichajes (idEmpleado, horaEntrada, horaSalida, fecha) VALUES (:idEmpleado, :horaEntrada, :horaSalida, :fecha)";
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':horaEntrada', $horaEntrada, PDO::PARAM_STR);
        $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function ultimosRegistrosTiempo($idEmpleado) {
        $sql = "SELECT * FROM fichajes WHERE idEmpleado = :idEmpleado ORDER BY fecha DESC LIMIT 7";
        $stmt = Conexion::getConexion()->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>