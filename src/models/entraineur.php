<?php

require_once("database_connector.php");

class Entraineur extends DatabaseConnector {
    const ADD = "INSERT INTO ENTRAINEUR (NOM_ENTRAINEUR, PRENOM_ENTRAINEUR)  VALUES(:NOM_ENTRAINEUR, :PRENOM_ENTRAINEUR)";

    private $id;
    private $nom;
    private $prenom;
    private $date;

    public function save() {
        try {
            $req = $this->db->prepare(self::ADD);

            $req->execute(array(
                ':NOM_ENTRAINEUR' => $this->nom,
                ':PRENOM_ENTRAINEUR' => $this->prenom,
            ));

            echo "L'ENTRAINEUR a bien été ajouté !";
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

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function toString() {
        echo "Entraineur $this->noentraineur: $this->nom $this->prenom<br>";
    }
}

?>
