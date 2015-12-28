<?php

require_once("database_connector.php");

class Joueur extends DatabaseConnector {
    const ADD = "INSERT INTO JOUEUR (ADRESSE_JOUEUR, NOM_JOUEUR, PRENOM_JOUEUR, DATE_NAISSANCE_JOUEUR  )  VALUES(:ADRESSE_JOUEUR, :NOM_JOUEUR, :PRENOM_JOUEUR, :DATE_NAISSANCE_JOUEUR)";
    const LINK = "INSERT INTO ENTREE (NUMERO_CLUB, NUMERO_LICENCE, DATE_ENTREE_JOUEUR)  VALUES(:NUMERO_CLUB, :NUMERO_LICENCE, :DATE_ENTREE_JOUEUR)";

    private $nolicence;
    private $adresse;
    private $nom;
    private $prenom;
    private $date;
    private $dob;

    public function joueurAdd() {
        try {
            $req = $this->db->prepare(self::ADD);

            $req->execute(array(
                ':NOM_JOUEUR' => $this->nom,
                ':PRENOM_JOUEUR' => $this->prenom,
                ':DATE_NAISSANCE_JOUEUR' => $this->dob,
                ':ADRESSE_JOUEUR' => $this->adresse,
            ));

            $nolicence = $this->db->lastInsertId();
            $req = $this->db->prepare(self::LINK);
            $req->execute(array(
                ':NUMERO_CLUB' => $this->noclub,
                ':NUMERO_LICENCE' => $nolicence,
                ':DATE_ENTREE_JOUEUR' => $this->date,
            ));

            echo 'Le JOUEUR a bien été ajouté !';
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getAdresse() {
        return $this->addresse;
    }

    public function setAdresse($adresse) {
        $this->addresse = $adresse;
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
        $this->date = implode("-", array_reverse(explode("/", $date)));
    }

    public function getDob() {
        return $this->dob;
    }

    public function setDob($dob) {
        $this->dob = implode("-", array_reverse(explode("/", $dob)));
    }

    public function toString() {
        echo "Joueur $this->nolicence de l'équipe $this->noequipe: $this->nom $this->prenom né le $this->dob habite $this->adresse<br>";
    }
}

?>
