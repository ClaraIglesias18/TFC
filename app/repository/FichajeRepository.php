<?php
require_once 'app/model/BaseModel.php';
class FichajeRepository extends BaseModel{

    public function getPreviousTimeclockEntriesForToday($idEmpleado) {
        $today = date('Y-m-d');
        $sql = "SELECT idFichaje, idEmpleado, horaEntrada, horaSalida, fecha FROM fichajes WHERE idEmpleado = :idEmpleado AND DATE(fecha) = :today";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':today', $today, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTimeclockExitTime($idEmpleado, $horaSalida) {
        $sql = "UPDATE fichajes SET horaSalida = :horaSalida WHERE idEmpleado = :idEmpleado";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function saveTimeclockEntry($idEmpleado, $horaEntrada, $horaSalida, $fecha) {
        $sql = "INSERT INTO fichajes (idEmpleado, horaEntrada, horaSalida, fecha) VALUES (:idEmpleado, :horaEntrada, :horaSalida, :fecha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(':horaEntrada', $horaEntrada, PDO::PARAM_STR);
        $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function ultimosRegistrosTiempo($idEmpleado) {
        $sql = "SELECT * FROM fichajes WHERE idEmpleado = :idEmpleado ORDER BY fecha DESC LIMIT 7";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarfichaje($idFichaje, $datos) {
        $conexion = $this->conn;
        $sql = "UPDATE fichajes SET horaEntrada = :horaEntrada, horaSalida = :horaSalida, fecha = :fecha WHERE idFichaje = :idFichaje";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':idFichaje', $idFichaje, PDO::PARAM_INT);
        $consulta->bindParam(':horaEntrada', $datos['horaEntrada'], PDO::PARAM_STR);
        $consulta->bindParam(':horaSalida', $datos['horaSalida'], PDO::PARAM_STR);
        $consulta->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $consulta->execute();
    }
}
?>