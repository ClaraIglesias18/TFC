<?php
class FichajeModel extends Model implements iModel {

    private $idFichaje;
    private $idUser;
    private $fecha;
    private $horaInicio;
    private $horaFin;

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        try {
            $query = $this->prepare(
                'INSERT INTO fichaje(
                    idFichaje, 
                    idUser,
                    fecha, 
                    horaInicio) 
                VALUES (?, ?, ?, ?);'
            );
            $query->execute([
                $this->idFichaje,
                $this->idUser,
                $this->fecha,
                $this->horaInicio,
                null
            ]);

            if ($query->rowCount()) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll() {
        $items = [];
        try {
            $query = $this->query('SELECT * FROM fichaje');

            foreach ($query->fetch(PDO::FETCH_ASSOC) as $p) {
                $item = new FichajeModel();
                $item->setIdFichaje($p['idFichaje']);
                $item->setIdUser($p['idUser']);
                $item->setFecha($p['fecha']);
                $item->setHoraInicio($p['horaInicio']);
                $item->setHoraFin($p['horaFin']);

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getById($id) {
        try {
            $query = $this->prepare('SELECT * FROM fichaje WHERE idFichaje = ?');
            $query->execute([$id]);

            $fichaje = $query->fetch(PDO::FETCH_ASSOC);
            $fichaje->setIdFichaje($fichaje['idFichaje']);
            $fichaje->setIdUser($fichaje['idUser']);
            $fichaje->setFecha($fichaje['fecha']);
            $fichaje->setHoraInicio($fichaje['horaInicio']);
            $fichaje->setHoraFin($fichaje['horaFin']);

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function from($array) {
        $this->setIdFichaje($array['idFichaje']);
        $this->setIdUser($array['idUser']);
        $this->setFecha($array['fecha']);
        $this->setHoraInicio($array['horaInicio']);
        $this->setHoraFin($array['horaFin']);
    }

    //no se va a utilizar
    public function delete($id) {
        try {
            $query = $this->prepare('DELETE FROM fichaje WHERE idFichaje = ?');
            $query->execute([$id]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function modify() {
        try {
            $query = $this->prepare(
                'UPDATE fichaje SET
                    horaFIn = ?
                WHERE idFichaje = ?'
            );
            $query->execute([
                $this->horaFin
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllById($idUser) {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM fichaje WHERE idUser = ?');
            $query->execute([$idUser]);
            
            foreach ($query->fetch(PDO::FETCH_ASSOC) as $p) {
                $item = new FichajeModel();
                $item->setIdFichaje($p['idFichaje']);
                $item->setIdUser($p['idUser']);
                $item->setFecha($p['fecha']);
                $item->setHoraInicio($p['horaInicio']);
                $item->setHoraFin($p['horaFin']);

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllByIdLimit($idUser, $n) {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM fichaje WHERE idUser = ? ORDER BY fichaje.fecha DESC LIMIT 0, ? ');
            $query->execute([$idUser, $n]);
            
            foreach ($query->fetch(PDO::FETCH_ASSOC) as $p) {
                $item = new FichajeModel();
                $item->setIdFichaje($p['idFichaje']);
                $item->setIdUser($p['idUser']);
                $item->setFecha($p['fecha']);
                $item->setHoraInicio($p['horaInicio']);
                $item->setHoraFin($p['horaFin']);

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    //TO-DO suma total de horas semanales

    /**
     * Get the value of idFichaje
     */
    public function getIdFichaje() {
        return $this->idFichaje;
    }

    /**
     * Set the value of idFichaje
     */
    public function setIdFichaje($idFichaje): self {
        $this->idFichaje = $idFichaje;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser($idUser): self {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of horaInicio
     */
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    /**
     * Set the value of horaInicio
     */
    public function setHoraInicio($horaInicio): self {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get the value of horaFin
     */
    public function getHoraFin() {
        return $this->horaFin;
    }

    /**
     * Set the value of horaFin
     */
    public function setHoraFin($horaFin): self {
        $this->horaFin = $horaFin;

        return $this;
    }
}
