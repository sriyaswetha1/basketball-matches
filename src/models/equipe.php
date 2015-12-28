<?php

require_once("database_connector.php");

class Equipe {
    private $nomcategorie;
    private $id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNomCategorie() {
        return $this->nomcategorie;
    }

    public function setNomCategorie($id) {
        $this->nomcategorie = $id;
    }

    public function toString() {
        echo "Equipe $this->noequipe de catégorie $this->nomcategorie<br>";
    }

    public function toStringClub(){
        echo "Equipe $this->noequipe de catégorie $this->nomcategorie du club $this->nomclub<br>";
    }
}

?>
