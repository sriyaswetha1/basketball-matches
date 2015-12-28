<?php

session_start();

require_once(realpath(dirname(__FILE__) . "/../src/config.php"));
require_once(MODULES_PATH . "/template_helpers.php");

require_once(MODELS_PATH . "/club_repository.php");
require_once(MODELS_PATH . "/entraineur_repository.php");
require_once(MODELS_PATH . "/responsable_repository.php");
require_once(MODELS_PATH . "/joueur_repository.php");

$cr = new ClubRepository();
$er = new EntraineurRepository();
$rr = new ResponsableRepository();
$jr = new JoueurRepository();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
    case "ajouter":
        if (isset($_POST['nom']) && isset($_POST['localisation'])) {
            $club = new Club();
            $club->setNom($_POST['nom']);
            $club->setLocalisation($_POST['localisation']);
            $club->save();
            header('Location: ' . $config['url'] . "/" . basename(__FILE__));
        }
        render("clubs/ajouter", array());
        break;
    case "editer":
        if (isset($_POST['nom']) && isset($_POST['localisation']) && isset($_POST['id'])) {
            $club = new Club();
            $club->setId($_POST['id']);
            $club->setNom($_POST['nom']);
            $club->setLocalisation($_POST['localisation']);
            $club->save();
            header('Location: ' . $config['url'] . "/" . basename(__FILE__));
        }
        if (isset($_GET['id'])) {
            $club_id = intval($_GET['id']);
            render("clubs/editer", array('club' => $cr->findById($club_id)));
        } else {
            header('Location: ' . $config['url'] . "/" . basename(__FILE__));
        }
        break;
    case "supprimer":
        if (isset($_GET['id'])) {
            $club_id = intval($_GET['id']);

            $club = new Club();
            $club->setId($club_id);
            $club->delete();
        }
        header('Location: ' . $config['url'] . "/" . basename(__FILE__));
        break;
    case "voir":
        if (isset($_GET['id'])) {
            $club_id = intval($_GET['id']);

            render("clubs/voir", array(
                'club' => $cr->findById($club_id),
                'entraineur' => $er->findOneByClubId($club_id),
                'responsables' => $rr->findByClubId($club_id),
                'joueurs' => $jr->findByClubId($club_id)
            ));
        } else {
            $_SESSION['flash'] = "Aucun id renseigné";

            goto LOCATION;
        }
        break;
    default:
        goto RENDER;

        LOCATION:
            header('Location: ' . $config['url'] . "/" . basename(__FILE__));
    }
} else {
    RENDER:
        render("clubs/liste", array('clubs' => $cr->findAll()));
}

?>
