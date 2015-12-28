<?php

require_once("rencontre.php");

class RencontreRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT * FROM RENCONTRE";

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $rencontres = array();
        while ($data = $reponse->fetch()) {
            $rencontre = new Rencontre();
            $rencontre->norencontre = $data['NUMERO_RENCONTRE'];
            $rencontre->nojournee = $data['NUMERO_JOURNEE'];
            $rencontre->date = $data['DATE_RENCONTRE'];
            $rencontre->scoredomicile = $data['SCORE_EQUIPE_DOMICILE'];
            $rencontre->scoreexterieur = $data['SCORE_EQUIPE_EXTERIEUR'];
            $rencontre->equipedomicile = $data['NUMERO_EQUIPE_JOUE_DOMICILE'];
            $rencontre->equipeexterieur = $data['NUMERO_EQUIPE_JOUE_EXTERIEUR'];
            array_push($rencontres, $rencontre);
        }
        $reponse->closeCursor();

        return $rencontres;
    }
}

?>
