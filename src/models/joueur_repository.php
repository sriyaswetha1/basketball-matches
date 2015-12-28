<?php

include_once("joueur.php");

class JoueurRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM JOUEUR";
    const FIND_BY_TEAM = "SELECT * FROM JOUEUR WHERE NUMERO_EQUIPE=";
    const FIND_BY_CLUB_ID = "SELECT JOUEUR.NUMERO_LICENCE, JOUEUR.ADRESSE_JOUEUR, JOUEUR.NOM_JOUEUR, JOUEUR.PRENOM_JOUEUR, JOUEUR.DATE_NAISSANCE_JOUEUR, ENTREE.DATE_ENTREE_JOUEUR
        FROM JOUEUR, ENTREE
        WHERE ENTREE.NUMERO_LICENCE = JOUEUR.NUMERO_LICENCE AND ENTREE.NUMERO_CLUB=";

    public function findByTeam($noequipe) {
        $reponse = $this->db->query(self::FIND_BY_TEAM . "'$noequipe'");

        $joueurs = array();
        while ($data = $reponse->fetch()) {
            $joueur = new Joueur();
            $joueur->setId($data['NUMERO_LICENCE']);
            $joueur->setPrenom($data['PRENOM_JOUEUR']);
            $joueur->setNom($data['NOM_JOUEUR']);
            $joueur->setAdresse($data['ADRESSE_JOUEUR']);
            $joueur->setDob($data['DATE_NAISSANCE_JOUEUR']);
            array_push($joueurs, $joueur);
        }
        $reponse->closeCursor();

        return $joueurs;
    }

    public function findByClubId($id) {
        $reponse = $this->db->query(self::FIND_BY_CLUB_ID . $id);

        $joueurs = array();
        while ($data = $reponse->fetch()) {
            $joueur = new Joueur();
            $joueur->setId($data['NUMERO_LICENCE']);
            $joueur->setPrenom($data['PRENOM_JOUEUR']);
            $joueur->setNom($data['NOM_JOUEUR']);
            $joueur->setAdresse($data['ADRESSE_JOUEUR']);
            $joueur->setDob($data['DATE_NAISSANCE_JOUEUR']);
            $joueur->setDate($data['DATE_ENTREE_JOUEUR']);
            array_push($joueurs, $joueur);
        }
        $reponse->closeCursor();

        return $joueurs;
    }

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $joueurs = array();
        while ($data = $reponse->fetch()) {
            $joueur = new Joueur();
            $joueur->nolicence = $data['NUMERO_LICENCE'];
            $joueur->prenom = $data['PRENOM_JOUEUR'];
            $joueur->nom = $data['NOM_JOUEUR'];
            $joueur->adresse = $data['ADRESSE_JOUEUR'];
            $joueur->dob = $data['DATE_NAISSANCE_JOUEUR'];
            $joueur->noequipe = $data['NUMERO_EQUIPE'];
            array_push($joueurs, $joueur);
        }
        $reponse->closeCursor();

        return $joueurs;
    }
}

?>
