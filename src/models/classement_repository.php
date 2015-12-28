<?php 

include_once("models/database_connector.php");
include_once("models/classement.php");

class ClassementRepository extends DatabaseConnector {
    const EXEC= "select VIC.NUMERO_EQUIPE, NOMBRE_VICTOIRES, NOMBRE_NULS, NOMBRE_DEFAITES, PTS_VIC+PTS_NUL as POINTS, ifnull(DIFF_VICTOIRE,0)+ifnull(DIFF_DEFAITE,0) as GOALAVERAGE
		 from(select RTR_L.NUMERO_EQUIPE, ifnull(NB_VICTOIRE_DOMICILE,0)+ifnull(NB_VICTOIRE_EXTERIEUR,0) as NOMBRE_VICTOIRES, (ifnull(NB_VICTOIRE_DOMICILE,0)+ifnull(NB_VICTOIRE_EXTERIEUR,0))*3 as PTS_VIC,  ifnull(DIFF_VICTOIRE_DOMICILE,0)+ifnull(DIFF_VICTOIRE_EXTERIEUR,0) AS DIFF_VICTOIRE
		 from(select NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_VICTOIRE_DOMICILE, SCORE_EQUIPE_DOMICILE-SCORE_EQUIPE_EXTERIEUR AS DIFF_VICTOIRE_DOMICILE
		 from EQUIPE
		 left join RENCONTRE
		     on RENCONTRE.NUMERO_EQUIPE_JOUE_DOMICILE = EQUIPE.NUMERO_EQUIPE
		     and SCORE_EQUIPE_DOMICILE > SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE) as RTR_L
		 left join (
		 select NUMERO_EQUIPE_JOUE_EXTERIEUR AS NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_VICTOIRE_EXTERIEUR, SCORE_EQUIPE_EXTERIEUR-SCORE_EQUIPE_DOMICILE AS DIFF_VICTOIRE_EXTERIEUR
		 from RENCONTRE
		 where SCORE_EQUIPE_DOMICILE < SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE_JOUE_EXTERIEUR) as RTR_R
		     on RTR_L.NUMERO_EQUIPE = RTR_R.NUMERO_EQUIPE
		 group by NUMERO_EQUIPE) as VIC
		     ,
		     (select RTR_L.NUMERO_EQUIPE, ifnull(NB_NUL_DOMICILE,0)+ifnull(NB_NUL_EXTERIEUR,0) as NOMBRE_NULS,  ifnull(NB_NUL_DOMICILE,0)+ifnull(NB_NUL_EXTERIEUR,0) as PTS_NUL
		 from (select NUMERO_EQUIPE, COUNT(RENCONTRE.NUMERO_RENCONTRE) AS NB_NUL_DOMICILE
		 from EQUIPE
		 left join RENCONTRE
		     on RENCONTRE.NUMERO_EQUIPE_JOUE_DOMICILE = EQUIPE.NUMERO_EQUIPE
		     and SCORE_EQUIPE_DOMICILE = SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE) as RTR_L
		 left join (select NUMERO_EQUIPE_JOUE_EXTERIEUR AS NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_NUL_EXTERIEUR
		 from RENCONTRE
		 where SCORE_EQUIPE_DOMICILE = SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE_JOUE_EXTERIEUR) as RTR_R
		     on RTR_L.NUMERO_EQUIPE = RTR_R.NUMERO_EQUIPE
		 group by NUMERO_EQUIPE) as NUL
		     ,
		     (select RTR_L.NUMERO_EQUIPE, ifnull(NB_DEFAITE_DOMICILE,0)+ifnull(NB_DEFAITE_EXTERIEUR,0) as NOMBRE_DEFAITES, ifnull(DIFF_DEFAITE_DOMICILE,0)+ifnull(DIFF_DEFAITE_EXTERIEUR,0) AS DIFF_DEFAITE
		 from (select NUMERO_EQUIPE, COUNT(RENCONTRE.NUMERO_RENCONTRE) AS NB_DEFAITE_DOMICILE, SCORE_EQUIPE_DOMICILE-SCORE_EQUIPE_EXTERIEUR AS DIFF_DEFAITE_DOMICILE
		 from EQUIPE
		 left join RENCONTRE
		     on RENCONTRE.NUMERO_EQUIPE_JOUE_DOMICILE = EQUIPE.NUMERO_EQUIPE
		     and SCORE_EQUIPE_DOMICILE < SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE) as RTR_L
		 left join (select NUMERO_EQUIPE_JOUE_EXTERIEUR AS NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_DEFAITE_EXTERIEUR, SCORE_EQUIPE_EXTERIEUR-SCORE_EQUIPE_DOMICILE AS DIFF_DEFAITE_EXTERIEUR
		 from RENCONTRE
		 where SCORE_EQUIPE_DOMICILE > SCORE_EQUIPE_EXTERIEUR
		 group by NUMERO_EQUIPE_JOUE_EXTERIEUR) as RTR_R
		     on RTR_L.NUMERO_EQUIPE = RTR_R.NUMERO_EQUIPE
		 group by NUMERO_EQUIPE) as DEF
		     
		 where DEF.NUMERO_EQUIPE = VIC.NUMERO_EQUIPE
		     and NUL.NUMERO_EQUIPE = VIC.NUMERO_EQUIPE";
		     
    public function makeClassement($categorie) {
	$reponse = $this->db->query(self::EXEC . "and EQUIPE.NUMERO_EQUIPE = VIC.NUMERO_EQUIPE
		     and EQUIPE.NOM_CATEGORIE =" . $categorie . "order by POINTS desc, GOALAVERAGE desc");

	$classements = array();
	while ($data = $reponse->fetch()) {
            $classement = new Classement();
            $classement->noequipe = $data['NUMERO_EQUIPE'];
	    $classement->nbvictoires = $data['NOMBRE_VICTOIRES'];
            $classement->nbnuls = $data['NOMBRE_NULS'];
            $classement->nbdefaites = $data['NOMBRE_DEFAITES'];
            $classement->points = $data['POINTS'];
            $classement->diff = $data['GOALAVERAGE'];
            array_push($classements, $classement);
        }
        $reponse->closeCursor();

        return $classements;
    }

    public function makeGenClassement() {
	$reponse = $this->db->query(self::EXEC . "order by POINTS desc, GOALAVERAGE desc");

	$classements = array();
	while ($data = $reponse->fetch()) {
            $classement = new Classement();
            $classement->noequipe = $data['NUMERO_EQUIPE'];
	    $classement->nbvictoires = $data['NOMBRE_VICTOIRES'];
            $classement->nbnuls = $data['NOMBRE_NULS'];
            $classement->nbdefaites = $data['NOMBRE_DEFAITES'];
            $classement->points = $data['POINTS'];
            $classement->diff = $data['GOALAVERAGE'];
            array_push($classements, $classement);
        }
        $reponse->closeCursor();

        return $classements;
    }

}

?>
