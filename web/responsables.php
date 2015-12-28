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
    case "supprimer":
        if (isset($_GET['id'])) {
            $responsable = new Responsable();
            $responsable->setId(intval($_GET['id']));
            $responsable->delete();
        }
        header('Location: ' . $config['url'] . "/" . "clubs.php?action=voir&id=" . intval($_GET['club_id']) );
        break;
    default:
    }
}

?>
