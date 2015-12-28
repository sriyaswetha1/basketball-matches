<?php

require_once("database_connector.php");

class Responsable extends DatabaseConnector {
    const DELETE = "DELETE FROM RESPONSABLE WHERE NUMERO_RESPONSABLE = ";

    private $id;
    private $prenom;
    private $nom;
    private $fonction;

    public function delete() {
        try {
            $req = $this->db->prepare(self::DELETE . $this->id);

            $req->execute();
            echo 'Le Responsable a bien été supprimé !';
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getFonction() {
        return $this->fonction;
    }

    public function setFonction($fonction) {
        $this->fonction = $fonction;
    }
    public function toString() {
        echo "Responsable $this->noresponsable: $this->nom $this->prenom en tant que $this->fonction<br>";
    }
}

?>
