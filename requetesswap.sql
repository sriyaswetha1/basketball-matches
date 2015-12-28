---- club ----
--------------

-- NOM, LOCALISATION ET NUMéRO DE CLUB TOUS LES CLUBS
select *
from club;
 
-- TOUTES LES LOCALISATIONS DES CLUBS
select distinct club.localisation_club
from club;

-- TOUTES LES NOMS DES CLUBS
select distinct club.nom_club
from club;

---- responsables ----
----------------------

-- PRéSIDENT DE CHAQUE CLUB
select club.nom_club, responsable.nom_responsable, responsable.prenom_responsable
from club, responsable
where club.numero_club = responsable.numero_club
and responsable.fonction = 'president';

-- RESPONSABLES DE CHAQUE CLUB
select club.nom_club, responsable.nom_responsable, responsable.prenom_responsable, responsable.fonction
from club, responsable
where club.numero_club = responsable.numero_club

-- RESPONSABLE D'UN CLUB DONNé
select club.nom_club, responsable.nom_responsable, responsable.prenom_responsable, responsable.fonction
from club, responsable
where club.numero_club = responsable.numero_club
and club.numero_club = 1;

---- equipes ----
-----------------

-- SELECTIONNE TOUTES LES éQUIPES D'UNE CATéGORIE DONNéE
select club.nom_club, equipe.numero_equipe, equipe.nom_categorie
from club, entraineur, animation, entraine, equipe
where club.numero_club = animation.numero_club
and entraineur.numero_entraineur = animation.numero_entraineur 
and entraine.numero_equipe = equipe.numero_equipe
and entraine.numero_entraineur = entraineur.numero_entraineur
and equipe.nom_categorie = 'senior'; 

-- SELECTIONNE LES éQUIPES DE CHAQUE CLUB
select club.numero_club, club.nom_club, equipe.numero_equipe from club, equipe, entraineur, animation, entraine
       where club.numero_club = animation.numero_club
       and entraineur.numero_entraineur = animation.numero_entraineur
       and entraine.numero_equipe = equipe.numero_equipe
       and entraine.numero_entraineur = entraineur.numero_entraineur
order by club.numero_club asc


---- joueurs ----
-----------------

-- SéLECTION DE TOUS LES JOUEURS DE LA FéDéRATION
select joueur.*, entree.date_entree_joueur
from joueur, entree
where joueur.numero_licence = entree.numero_licence

-- SéLECTION DE TOUS LES JOUEURS DE LA FéDéRATION à UNE DATE DONNéE
select joueur.*, entree.date_entree_joueur
from joueur, entree
where joueur.numero_licence = entree.numero_licence
and entree.date_entree_joueur < '2012-01-01';
order by joueur.numero_licence

-- SéLECTION DE TOUS LES JOUEURS POUR UNE CATéGORIE DONNéE
select joueur.*, equipe.numero_equipe
from joueur, equipe
where joueur.numero_equipe = equipe.numero_equipe
and equipe.nom_categorie = 'senior'
order by joueur.numero_licence asc;

--SéLECTION DE TOUS LES JOUEURS DANS UN CLUB DONNé
select club.nom_club, joueur.*, entree.date_entree_joueur
from club, joueur, entree
where club.numero_club = entree.numero_club
and joueur.numero_licence = entree.numero_licence
and club.numero_club = 1
order by joueur.numero_licence asc;


-- SELECTION DES JOUEURS QUI PARTICIPENT à UNE RENCONTRE DONNéE
select distinct joueur.nom_joueur, joueur.numero_equipe, rencontre.numero_rencontre,  participation.fautes, participation.points
from joueur, equipe, rencontre, participation
where joueur.numero_licence = participation.numero_licence
and rencontre.numero_rencontre = participation.numero_rencontre
and rencontre.numero_rencontre = 1
order by participation.points desc;

-- SELECTION DES JOUEURS QUI PARTICIPENT à UNE RENCONTRE SELON SA DATE
select distinct joueur.nom_joueur, joueur.numero_equipe, rencontre.numero_rencontre,  participation.fautes, participation.points
from joueur, equipe, rencontre, participation
where joueur.numero_licence = participation.numero_licence
and rencontre.numero_rencontre = participation.numero_rencontre
and rencontre.date_rencontre = '2014-01-10'
order by joueur.numero_equipe asc;


---- sTATISTIQUES ----
----------------------

-- SCORE DES MATCHS JOUéS à UNE DATé DONNéE
select rencontre.date_rencontre, rencontre.numero_rencontre, rencontre.numero_equipe_joue_domicile, rencontre.score_equipe_domicile, rencontre.score_equipe_exterieur, rencontre.numero_equipe_joue_exterieur
from rencontre
where rencontre.date_rencontre = '2014-01-10'
order by rencontre.numero_rencontre asc;

--rEQUETES VICTOIRES EQUIPES
SELECT rtr_l.numero_equipe, IFNULL(nb_victoire_domicile,0)+IFNULL(nb_victoire_exterieur,0) AS nombre_victoires
FROM (SELECT numero_equipe, count(rencontre.numero_rencontre) as nb_victoire_domicile
    FROM equipe
    LEFT JOIN rencontre
    ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
    AND score_equipe_domicile > score_equipe_exterieur
    GROUP BY numero_equipe) AS rtr_l
LEFT JOIN (SELECT numero_equipe_joue_exterieur as numero_equipe, count(numero_rencontre) as nb_victoire_exterieur
    FROM rencontre
    WHERE score_equipe_domicile < score_equipe_exterieur
    GROUP BY numero_equipe_joue_exterieur) AS rtr_r
ON rtr_l.numero_equipe = rtr_r.numero_equipe;

-- rEQUETE MOYENNE POINTS PAR RENCONTRE POUR UNE DATE DONNéE
SELECT sum(points_marques_rencontre)/
       (SELECT count(date_rencontre) FROM rencontre
                   WHERE date_rencontre = '2014-01-10')
AS 'moyenne points marques', date_rencontre FROM
   (SELECT date_rencontre, numero_rencontre, score_equipe_domicile+score_equipe_exterieur as points_marques_rencontre FROM rencontre) AS tab
GROUP BY date_rencontre

--classement general METHODE “FINALE”, SANS TABLES INTERMEDIAIRES

SELECT vic.numero_equipe, nombre_victoires, nombre_nuls, nombre_defaites, pts_vic+pts_nul AS points, IFNULL(diff_victoire,0)+IFNULL(diff_defaite,0) AS goalaverage
FROM(SELECT rtr_l.numero_equipe, IFNULL(nb_victoire_domicile,0)+IFNULL(nb_victoire_exterieur,0) AS nombre_victoires, (IFNULL(nb_victoire_domicile,0)+IFNULL(nb_victoire_exterieur,0))*3 AS pts_vic,  IFNULL(diff_victoire_domicile,0)+IFNULL(diff_victoire_exterieur,0) as diff_victoire
        FROM(SELECT numero_equipe, count(numero_rencontre) as nb_victoire_domicile, score_equipe_domicile-score_equipe_exterieur as diff_victoire_domicile
            FROM equipe
            LEFT JOIN rencontre
            ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
            AND score_equipe_domicile > score_equipe_exterieur
           GROUP BY numero_equipe) AS rtr_l
    LEFT JOIN (
              SELECT numero_equipe_joue_exterieur as numero_equipe, count(numero_rencontre) as nb_victoire_exterieur, score_equipe_exterieur-score_equipe_domicile as diff_victoire_exterieur
          FROM rencontre
        WHERE score_equipe_domicile < score_equipe_exterieur
            GROUP BY numero_equipe_joue_exterieur) AS rtr_r
        ON rtr_l.numero_equipe = rtr_r.numero_equipe
        GROUP BY numero_equipe) AS vic
,
    (SELECT rtr_l.numero_equipe, IFNULL(nb_nul_domicile,0)+IFNULL(nb_nul_exterieur,0) AS nombre_nuls,  IFNULL(nb_nul_domicile,0)+IFNULL(nb_nul_exterieur,0) AS pts_nul
     FROM (SELECT numero_equipe, count(rencontre.numero_rencontre) as nb_nul_domicile
     FROM equipe
     LEFT JOIN rencontre
     ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
     AND score_equipe_domicile = score_equipe_exterieur
     GROUP BY numero_equipe) AS rtr_l
     LEFT JOIN (SELECT numero_equipe_joue_exterieur as numero_equipe, count(numero_rencontre) as nb_nul_exterieur
    FROM rencontre
    WHERE score_equipe_domicile = score_equipe_exterieur
    GROUP BY numero_equipe_joue_exterieur) AS rtr_r
ON rtr_l.numero_equipe = rtr_r.numero_equipe
    GROUP BY numero_equipe) AS nul
,
     (SELECT rtr_l.numero_equipe, IFNULL(nb_defaite_domicile,0)+IFNULL(nb_defaite_exterieur,0) AS nombre_defaites, IFNULL(diff_defaite_domicile,0)+IFNULL(diff_defaite_exterieur,0) as diff_defaite
     FROM (SELECT numero_equipe, count(rencontre.numero_rencontre) as nb_defaite_domicile, score_equipe_domicile-score_equipe_exterieur as diff_defaite_domicile
     FROM equipe
     LEFT JOIN rencontre
     ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
     AND score_equipe_domicile < score_equipe_exterieur
     GROUP BY numero_equipe) AS rtr_l
     LEFT JOIN (SELECT numero_equipe_joue_exterieur as numero_equipe, count(numero_rencontre) as nb_defaite_exterieur, score_equipe_exterieur-score_equipe_domicile as diff_defaite_exterieur
    FROM rencontre
    WHERE score_equipe_domicile > score_equipe_exterieur
    GROUP BY numero_equipe_joue_exterieur) AS rtr_r
ON rtr_l.numero_equipe = rtr_r.numero_equipe
    GROUP BY numero_equipe) AS def

WHERE def.numero_equipe = vic.numero_equipe
AND nul.numero_equipe = vic.numero_equipe
AND equipe.numero_equipe = vic.numero_equipe
AND equipe.nom_categorie = 'senior'
ORDER BY points DESC, goalaverage DESC

--mEILLEURS JOUEURS D'UNE JOURNéE (POUR UNE CATéGORIE)
SELECT DISTINCT nom_joueur, prenom_joueur, participation.numero_licence, MAX(points), fautes
       FROM participation, joueur, rencontre, equipe
               WHERE joueur.numero_licence = participation.numero_licence
        AND rencontre.numero_rencontre = participation.numero_rencontre
        AND (joueur.numero_equipe = numero_equipe_joue_domicile or
            joueur.numero_equipe = numero_equipe_joue_exterieur)
        AND (equipe.numero_equipe = numero_equipe_joue_domicile or
             equipe.numero_equipe = numero_equipe_joue_exterieur)
        AND equipe.nom_categorie = 'senior'
        AND numero_journee = 1
ORDER BY points DESC, fautes ASC

--rEQUETE VICTOIRE EQUIPE DOMICILE AVEC CONTRAINTE CATéGORIE
SELECT vic_dom.numero_equipe, vic_dom.nombre_victoire_domicile, nom_categorie

FROM (SELECT numero_equipe, count(rencontre.numero_rencontre) as nombre_victoire_domicile
    FROM equipe
    LEFT JOIN rencontre
    ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
    AND score_equipe_domicile > score_equipe_exterieur
    GROUP BY numero_equipe) AS vic_dom, equipe

WHERE equipe.nom_categorie = 'senior'
AND vic_dom.numero_equipe = equipe.numero_equipe
ORDER BY nombre_victoire_domicile DESC;

--rEQUETES VICTOIRE EQUIPE AVEC CONTRAINTE DE CATéGORIE
SELECT vic.numero_equipe, vic.nombre_victoires, nom_categorie
FROM(
SELECT rtr_l.numero_equipe, IFNULL(nb_victoire_domicile,0)+IFNULL(nb_victoire_exterieur,0) AS nombre_victoires
FROM (SELECT numero_equipe, count(rencontre.numero_rencontre) as nb_victoire_domicile
    FROM equipe
    LEFT JOIN rencontre
    ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
    AND score_equipe_domicile > score_equipe_exterieur
    GROUP BY numero_equipe) AS rtr_l
LEFT JOIN (SELECT numero_equipe_joue_exterieur as numero_equipe, count(numero_rencontre) as nb_victoire_exterieur
    FROM rencontre
    WHERE score_equipe_domicile < score_equipe_exterieur
    GROUP BY numero_equipe_joue_exterieur) AS rtr_r
ON rtr_l.numero_equipe = rtr_r.numero_equipe)
AS vic, equipe
WHERE equipe.nom_categorie = 'senior'
AND vic.numero_equipe = equipe.numero_equipe
ORDER BY nombre_victoires DESC;

-- goalaverage
--DIFFéRENCE DOMICILE, EXTERIEUR, GéNéRAL
SELECT rtr_l.numero_equipe, IFNULL(diff_domicile,0) AS goalaverage_domicile, IFNULL(diff_exterieur,0) AS goalaverage_exterieur, IFNULL(diff_domicile,0)+IFNULL(diff_exterieur,0) AS goalaverage_general
FROM (SELECT numero_equipe, SUM(score_equipe_domicile-score_equipe_exterieur) as diff_domicile
    FROM equipe
    LEFT JOIN rencontre
    ON rencontre.numero_equipe_joue_domicile = equipe.numero_equipe
    GROUP BY numero_equipe) AS rtr_l
LEFT JOIN    (SELECT numero_equipe, SUM(score_equipe_exterieur-score_equipe_domicile) as diff_exterieur
    FROM equipe
    LEFT JOIN rencontre
    ON rencontre.numero_equipe_joue_exterieur = equipe.numero_equipe
    GROUP BY numero_equipe) rtr_r
ON rtr_l.numero_equipe = rtr_r.numero_equipe
