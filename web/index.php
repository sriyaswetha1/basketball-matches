<?php

require_once(realpath(dirname(__FILE__) . "/../src/config.php"));
require_once(MODULES_PATH . "/template_helpers.php");
require_once(MODULES_PATH . "/database.php");

if (isset($_GET['action'])) {
    $db = getDatabase();
    $sql = file_get_contents(realpath(dirname(__FILE__) . "/../base.sql")) . file_get_contents(realpath(dirname(__FILE__) . "/../donnees.sql"));

    $db->exec($sql);
    header('Location: ' . $config['url']);
    }

render("home", array());

?>
