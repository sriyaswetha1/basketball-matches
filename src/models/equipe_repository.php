<?php 

include_once("equipe.php");

class EquipeRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM EQUIPE";
    const FIND_BY_CLUB = "SELECT CLUB.NUMERO_CLUB, CLUB.NOM_CLUB, EQUIPE.* FROM CLUB, EQUIPE, ENTRAINEUR, ANIMATION, ENTRAINE
        WHERE ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
        AND ENTRAINE.NUMERO_EQUIPE = EQUIPE.NUMERO_EQUIPE
        AND ENTRAINE.NUMERO_ENTRAINEUR = ENTRAINEUR.NUMERO_ENTRAINEUR
        AND CLUB.NUMERO_CLUB = ANIMATION.NUMERO_CLUB
        AND CLUB.NUMERO_CLUB =";
    const FIND_BY_ENTRAINEUR_ID = "SELECT * FROM EQUIPE, ENTRAINE
        WHERE EQUIPE.NUMERO_EQUIPE = ENTRAINE.NUMERO_EQUIPE AND ENTRAINE.NUMERO_ENTRAINEUR =";

    public function findByEntraineurId($id) {
        $reponse = $this->db->query(self::FIND_BY_ENTRAINEUR_ID . "'$id'");

        $equipes = array();
        while ($data = $reponse->fetch()) {
            $equipe = new Equipe();
            $equipe->setId($data['NUMERO_EQUIPE']);
            $equipe->setNomCategorie($data['NOM_CATEGORIE']);
            array_push($equipes, $equipe);
        }
        $reponse->closeCursor();

        return $equipes;
    }

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $equipes = array();
        while ($data = $reponse->fetch()) {
            $equipe = new Equipe();
            $equipe->noequipe = $data['NUMERO_EQUIPE'];
            $equipe->nomcategorie = $data['NOM_CATEGORIE'];
            array_push($equipes, $equipe);
        }
        $reponse->closeCursor();

        return $equipes;
    }
}

?>
