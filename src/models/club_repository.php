<?php

require_once("club.php");

class ClubRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM CLUB";
    const FIND_BY_ID = "SELECT * FROM CLUB WHERE NUMERO_CLUB =";

    public function findById($id) {
        $reponse = $this->db->query(self::FIND_BY_ID . "'$id'" . "LIMIT 1");

        $data = $reponse->fetch(); // Test avec columnsCount dans le cas où il n'y a pas de résultat et retourner NULL
        $club = new Club();
        $club->setId($data['NUMERO_CLUB']);
        $club->setNom($data['NOM_CLUB']);
        $club->setLocalisation($data['LOCALISATION']);

        $reponse->closeCursor();

        return $club;
    }

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $clubs = array();
        while ($data = $reponse->fetch()) {
            $club = new Club();
            $club->setId($data['NUMERO_CLUB']);
            $club->setNom($data['NOM_CLUB']);
            $club->setLocalisation($data['LOCALISATION']);
            array_push($clubs, $club);
        }
        $reponse->closeCursor();

        return $clubs;
    }
}

?>
