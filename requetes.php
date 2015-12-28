<?php 

//club

/* retourne les infos sur un club en fonction du numéro club */
function requeteClub($noclub, $reponse, $bdd)
{
    $reponse = $bdd->query("SELECT * FROM CLUB WHERE CLUB.NUMERO_CLUB = '$noclub'");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro '. $donnees['NUMERO_CLUB'] . ' : ' . $donnees['NOM_CLUB'] . ' localisation : '. $donnees['LOCALISATION']. '<br />';
    }
    $reponse->closeCursor();
}

/* retourne les infos sur tous les clubs */
function requeteGenClub($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT * FROM CLUB");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club '. $donnees['NUMERO_CLUB'] . ':' . $donnees['NOM_CLUB'] . ' localisation : '. $donnees['LOCALISATION'] .'<br />';
    }
    $reponse->closeCursor();
}

//Joueurs

/* retourne les infos sur les joueurs en fonctions du numéro de club */
function requeteJoueur($noclub, $reponse, $bdd)
{
    $reponse = $bdd->query("SELECT distinct CLUB.NOM_CLUB, ENTREE.DATE_ENTREE_JOUEUR, CLUB.NUMERO_CLUB, JOUEUR.NOM_JOUEUR, JOUEUR.PRENOM_JOUEUR 
			    FROM CLUB, ENTREE, JOUEUR 
			    WHERE ENTREE.NUMERO_CLUB = CLUB.NUMERO_CLUB
				AND JOUEUR.NUMERO_LICENCE = ENTREE.NUMERO_LICENCE
				AND CLUB.NUMERO_CLUB = '$noclub'");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro '. $noclub . ' : ' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_JOUEUR'].' '. $donnees['PRENOM_JOUEUR'] .' Entrée :' .$donnees['DATE_ENTREE_JOUEUR']. '<br />';
    }
    $reponse->closeCursor();
}

/* retourne les infos sur les joueurs de tous les clubs */
function requeteGenJoueur($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT distinct CLUB.NOM_CLUB, CLUB.NUMERO_CLUB, ENTREE.DATE_ENTREE_JOUEUR , JOUEUR.NOM_JOUEUR, JOUEUR.PRENOM_JOUEUR
			    FROM CLUB, ENTREE, JOUEUR
			    WHERE ENTREE.NUMERO_CLUB = CLUB.NUMERO_CLUB
				AND JOUEUR.NUMERO_LICENCE = ENTREE.NUMERO_LICENCE");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro'. $donnees['NUMERO_CLUB'] . ':' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_JOUEUR'] .' '. $donnees['PRENOM_JOUEUR'] .' Entrée :' .$donnees['DATE_ENTREE_JOUEUR'].'<br />';
    }
    $reponse->closeCursor();
}

//bureau
/* retourne les infos sur le bureau d'un club en fonction du numéro club */
function requeteBureau($noclub, $reponse, $bdd)
{
    $reponse = $bdd->query("SELECT CLUB.NUMERO_CLUB, CLUB.NOM_CLUB , RESPONSABLE.PRENOM_RESPONSABLE, RESPONSABLE.NOM_RESPONSABLE, RESPONSABLE.FONCTION
			    FROM RESPONSABLE, CLUB 
			    WHERE RESPONSABLE.NUMERO_CLUB = CLUB.NUMERO_CLUB
				AND CLUB.NUMERO_CLUB = '$noclub'");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro '. $noclub . ' : ' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_RESPONSABLE'].' '. $donnees['PRENOM_RESPONSABLE'] .' Fonction :' .$donnees['FONCTION']. '<br />';
    }
    $reponse->closeCursor();
}

/* retournes les infos sur le bureau de chaque club */
function requeteGenBureau($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT CLUB.NUMERO_CLUB, CLUB.NOM_CLUB , RESPONSABLE.PRENOM_RESPONSABLE, RESPONSABLE.NOM_RESPONSABLE, RESPONSABLE.FONCTION
			    FROM CLUB, RESPONSABLE
			    WHERE CLUB.NUMERO_CLUB = RESPONSABLE.NUMERO_CLUB");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro'. $donnees['NUMERO_CLUB'] . ':' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_RESPONSABLE'] .' '. $donnees['PRENOM_RESPONSABLE'] .' Fonction :' .$donnees['FONCTION'].'<br />';
    }
    $reponse->closeCursor();
}

//entraineur

/* retourne les infos sur les entraineurs d'un club donné */
function requeteEntraineur($noclub, $reponse, $bdd)
{
    $reponse = $bdd->query("SELECT distinct CLUB.NUMERO_CLUB, CLUB.NOM_CLUB, ENTRAINEUR.NOM_ENTRAINEUR, ENTRAINEUR.PRENOM_ENTRAINEUR, ANIMATION.DATE_ENTREE_ENTRAINEUR
			    FROM CLUB, ANIMATION, ENTRAINEUR 
			    WHERE ANIMATION.NUMERO_CLUB = CLUB.NUMERO_CLUB
				AND ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
				AND CLUB.NUMERO_CLUB = '$noclub'");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro '. $donnees['NUMERO_CLUB'] . ' : ' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_ENTRAINEUR'].' '. $donnees['PRENOM_ENTRAINEUR'] .' Entrée :' .$donnees['DATE_ENTREE_ENTRAINEUR']. '<br />';
    }
    $reponse->closeCursor();


}

/* retourne les infos sur les entraineurs de tous les clubs */
function requeteGenEntraineur($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT distinct CLUB.NUMERO_CLUB, CLUB.NOM_CLUB, ENTRAINEUR.NOM_ENTRAINEUR, ENTRAINEUR.PRENOM_ENTRAINEUR, ANIMATION.DATE_ENTREE_ENTRAINEUR
			    FROM CLUB, ANIMATION, ENTRAINEUR
			    WHERE ANIMATION.NUMERO_CLUB = CLUB.NUMERO_CLUB
				AND ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
				ORDER BY CLUB.NUMERO_CLUB ASC");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro'. $donnees['NUMERO_CLUB'] . ':' . $donnees['NOM_CLUB'] . ' Membre : '. $donnees['NOM_ENTRAINEUR'] .' '. $donnees['PRENOM_ENTRAINEUR'] .' Entrée :' .$donnees['DATE_ENTREE_ENTRAINEUR'].'<br />';
    }
    $reponse->closeCursor();
}

//equipes
function requeteEquipe($noclub, $reponse, $bdd)
{
		$reponse = $bdd->query("SELECT CLUB.NUMERO_CLUB, CLUB.NOM_CLUB, EQUIPE.NUMERO_EQUIPE FROM CLUB, EQUIPE, ENTRAINEUR, ANIMATION, ENTRAINE
					WHERE CLUB.NUMERO_CLUB = ANIMATION.NUMERO_CLUB
					    AND ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
					    AND ENTRAINE.NUMERO_EQUIPE = EQUIPE.NUMERO_EQUIPE
					    AND ENTRAINE.NUMERO_ENTRAINEUR = ENTRAINEUR.NUMERO_ENTRAINEUR
					    AND CLUB.NUMERO_CLUB ='$noclub'");
		while ($donnees = $reponse->fetch())
		{
		    echo 'Club numéro '. $noclub . ' : ' . $donnees['NOM_CLUB'] . ' Equipe Numéro: '. $donnees['NUMERO_EQUIPE']. '<br />';
		}
		$reponse->closeCursor();

}


function requeteGenEquipe($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT CLUB.NUMERO_CLUB, CLUB.NOM_CLUB, EQUIPE.NUMERO_EQUIPE FROM CLUB, EQUIPE, ENTRAINEUR, ANIMATION, ENTRAINE
			    WHERE CLUB.NUMERO_CLUB = ANIMATION.NUMERO_CLUB
				AND ENTRAINEUR.NUMERO_ENTRAINEUR = ANIMATION.NUMERO_ENTRAINEUR
				AND ENTRAINE.NUMERO_EQUIPE = EQUIPE.NUMERO_EQUIPE
				AND ENTRAINE.NUMERO_ENTRAINEUR = ENTRAINEUR.NUMERO_ENTRAINEUR");
    while ($donnees = $reponse->fetch())
    {
	echo 'Club numéro '. $donnees['NUMERO_CLUB'] . ' : ' . $donnees['NOM_CLUB'] . ' Equipe Numéro: '. $donnees['NUMERO_EQUIPE']. '<br />';
    }
    $reponse->closeCursor();
}


//statistiques
function requeteGenVictoireEquipe($reponse, $bdd)
{
    $reponse = $bdd->query("SELECT RTR_L.NUMERO_EQUIPE, IFNULL(NB_VICTOIRE_DOMICILE,0)+IFNULL(NB_VICTOIRE_EXTERIEUR,0) as NOMBRE_VICTOIRES
			    FROM (select NUMERO_EQUIPE, COUNT(RENCONTRE.NUMERO_RENCONTRE) AS NB_VICTOIRE_DOMICILE
			    FROM EQUIPE
			    LEFT JOIN RENCONTRE
				ON RENCONTRE.NUMERO_EQUIPE_JOUE_DOMICILE = EQUIPE.NUMERO_EQUIPE
				AND SCORE_EQUIPE_DOMICILE > SCORE_EQUIPE_EXTERIEUR
			    GROUP BY NUMERO_EQUIPE) as RTR_L
			    LEFT JOIN (SELECT NUMERO_EQUIPE_JOUE_EXTERIEUR AS NUMERO_EQUIPE, COUNT(NUMERO_RENCONTRE) AS NB_VICTOIRE_EXTERIEUR
			    FROM RENCONTRE
			    WHERE SCORE_EQUIPE_DOMICILE < SCORE_EQUIPE_EXTERIEUR
			    GROUP BY NUMERO_EQUIPE_JOUE_EXTERIEUR) as RTR_R
				ON RTR_L.NUMERO_EQUIPE = RTR_R.NUMERO_EQUIPE");
    while ($donnees = $reponse->fetch())
    {
	echo 'EQUIPE '. $donnees['NUMERO_EQUIPE'] . ' : ' . $donnees['NOMBRE_VICTOIRES']. '<br />';
    }
    $reponse->closeCursor();
}
   
	


?>
