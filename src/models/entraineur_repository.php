<?php

require_once("entraineur.php");

class EntraineurRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM ENTRAINEUR";
    const FIND_BY_ID = "SELECT * FROM ENTRAINEUR WHERE NUMERO_ENTRAINEUR=";
    const FIND_BY_CLUB_ID = "SELECT distinct CLUB.NOM_CLUB, ENTRAINEUR.*, ANIMATION.DATE_ENTREE_ENTRAINEUR
        FROM CLUB, ANIMATION, ENTRAINEUR
        WHERE ANIMATION.NUMERO_CLUB = CLUB.NUMERO_CLUB
        AND ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
        AND CLUB.NUMERO_CLUB =";

    public function findOneByClubId($id) {
        $reponse = $this->db->query(self::FIND_BY_CLUB_ID . "'$id'" . " LIMIT 1");

        $entraineurs = array();
        $data = $reponse->fetch();
        $entraineur = new Entraineur();
        $entraineur->setId($data['NUMERO_ENTRAINEUR']);
        $entraineur->setPrenom($data['PRENOM_ENTRAINEUR']);
        $entraineur->setNom($data['NOM_ENTRAINEUR']);
        $entraineur->setDate($data['DATE_ENTREE_ENTRAINEUR']);

        $reponse->closeCursor();

        return $entraineur;
    }

    public function findById($id) {
        $reponse = $this->db->query(self::FIND_BY_ID . "'$id'" . "LIMIT 1");

        $data = $reponse->fetch();
        $entraineur = new Entraineur();
        $entraineur->setId($data['NUMERO_ENTRAINEUR']);
        $entraineur->setNom($data['NOM_ENTRAINEUR']);
        $entraineur->setPrenom($data['PRENOM_ENTRAINEUR']);

        $reponse->closeCursor();

        return $entraineur;
    }

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $entraineurs = array();
        while ($data = $reponse->fetch()) {
            $entraineur = new Entraineur();
            $entraineur->setId($data['NUMERO_ENTRAINEUR']);
            $entraineur->setPrenom($data['PRENOM_ENTRAINEUR']);
            $entraineur->setNom($data['NOM_ENTRAINEUR']);
            array_push($entraineurs, $entraineur);
        }
        $reponse->closeCursor();

        return $entraineurs;
    }
}

?>
