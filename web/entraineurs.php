<?php

session_start();

require_once(realpath(dirname(__FILE__) . "/../src/config.php"));
require_once(MODULES_PATH . "/template_helpers.php");

require_once(MODELS_PATH . "/club_repository.php");
require_once(MODELS_PATH . "/entraineur_repository.php");
require_once(MODELS_PATH . "/responsable_repository.php");
require_once(MODELS_PATH . "/joueur_repository.php");
require_once(MODELS_PATH . "/equipe_repository.php");

$cr = new ClubRepository();
$er = new EntraineurRepository();
$rr = new ResponsableRepository();
$jr = new JoueurRepository();
$qr = new EquipeRepository();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
    case "ajouter":
        break;
    case "editer":
        break;
    case "supprimer":
        break;
    case "voir":
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            render("entraineurs/voir", array(
                'entraineur' => $er->findById($id),
                'equipes' => $qr->findByEntraineurId($id)
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
        render("entraineurs/liste", array('entraineurs' => $er->findAll()));
}

?>
