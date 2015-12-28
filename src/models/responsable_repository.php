<?php

require_once("responsable.php");

class ResponsableRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM RESPONSABLE";
    const FIND_BY_NOCLUB = "SELECT * FROM RESPONSABLE WHERE NUMERO_CLUB=";

    public function findByClubId($id) {
        $reponse = $this->db->query(self::FIND_BY_NOCLUB . "'$id'");

        $responsables = array();
        while ($data = $reponse->fetch()) {
            $responsable = new Responsable();
            $responsable->setId($data['NUMERO_RESPONSABLE']);
            $responsable->setPrenom($data['PRENOM_RESPONSABLE']);
            $responsable->setNom($data['NOM_RESPONSABLE']);
            $responsable->setFonction($data['FONCTION']);
            array_push($responsables, $responsable);
        }
        $reponse->closeCursor();

        return $responsables;
    }

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $responsables = array();
        while ($data = $reponse->fetch()) {
            $responsable = new Responsable();
            $responsable->setId($data['NUMERO_RESPONSABLE']);
            $responsable->setPrenom($data['PRENOM_RESPONSABLE']);
            $responsable->setNom($data['NOM_RESPONSABLE']);
            $responsable->setFonction($data['FONCTION']);
            array_push($responsables, $responsable);
        }
        $reponse->closeCursor();

        return $responsables;
    }
}

?>
