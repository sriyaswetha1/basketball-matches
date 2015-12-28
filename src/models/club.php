<?php

require_once("database_connector.php");

class Club extends DatabaseConnector {
    const INSERT = "INSERT INTO CLUB (NOM_CLUB, LOCALISATION)  VALUES(:NOM_CLUB, :LOCALISATION)";
    const UPDATE = "UPDATE CLUB SET NOM_CLUB=:NOM_CLUB, LOCALISATION=:LOCALISATION WHERE NUMERO_CLUB=";
    const DELETE = "DELETE FROM CLUB WHERE NUMERO_CLUB = ";

    private $id;
    private $nom;
    private $localisation;

    public function save() {
        if (isset($this->id)) {
            try {
                $req = $this->db->prepare(self::UPDATE . $this->id);

                $req->execute(array(
                ':NOM_CLUB' => $this->nom,
                ':LOCALISATION' => $this->localisation
            ));
                echo 'Le CLUB a bien été ajouté !';
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        } else {
            try {
                $req = $this->db->prepare(self::INSERT);

                $req->execute(array(
                    ':NOM_CLUB' => $this->nom,
                    ':LOCALISATION' => $this->localisation
                ));
                echo 'Le CLUB a bien été ajouté !';
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }

    public function delete() {
        try {
            $req = $this->db->prepare(self::DELETE . $this->id);

            $req->execute();
            echo 'Le CLUB a bien été supprimé !';
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = intval($id);
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getLocalisation() {
        return $this->localisation;
    }

    public function setLocalisation($localisation) {
        $this->localisation = $localisation;
    }

    public function toString() {
        echo "club $this->id: $this->name de $this->localisation<br>";
    }
}

?>
