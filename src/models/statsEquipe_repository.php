<?php

include_once("models/database_connector.php");
include_once("models/statsEquipe.php");

class StatsEquipeRepository extends DatabaseConnector {
    const FIND_ALL = "SELECT RTR_L.NUMERO_EQUIPE, IFNULL(NB_VICTOIRE_DOMICILE,0)+IFNULL(NB_VICTOIRE_EXTERIEUR,0) AS NOMBRE_VICTOIRES
        FROM (SELECT NUMERO_EQUIPE, COUNT(RENCONTRE.NUMERO_RENCONTRE) AS NB_VICTOIRE_DOMICILE
        FROM EQUIPE
        LEFT JOIN RENCONTRE
        ON RENCONTRE.NUMERO_EQUIPE_JOUE_DOMICILE = EQUIPE.NUMERO_EQUIPE
        AND SCORE_EQUIPE_DOMICILE > SCORE_EQUIPE_EXTERIEUR
        GROUP BY NUMERO_EQUIPE) AS RTR_L
        LEFT JOIN (SELECT NUMERO_EQUIPE_JOUE_EXTERIEUR AS NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_VICTOIRE_EXTERIEUR
        FROM RENCONTRE
        WHERE SCORE_EQUIPE_DOMICILE < SCORE_EQUIPE_EXTERIEUR
        GROUP BY NUMERO_EQUIPE_JOUE_EXTERIEUR) AS RTR_R
        ON RTR_L.NUMERO_EQUIPE = RTR_R.NUMERO_EQUIPE";

    public function findAll() {
        $reponse = $this->db->query(self::FIND_ALL);

        $statistiquesequipes = array();
        while ($data = $reponse->fetch()) {
            $statistiquesequipe = new StatsEquipe();
            $statistiquesequipe->nbvictoire = $data['NOMBRE_VICTOIRES'];
            $statistiquesequipe->noequipe = $data['NUMERO_EQUIPE'];
            array_push($statistiquesequipes, $statistiquesequipe);
        }
        $reponse->closeCursor();

        return $statistiquesequipes;
    }
}

?>
