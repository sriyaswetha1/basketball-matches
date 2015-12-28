<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));

function getDatabase() {
    global $config;
    try {
        $bdd = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']);
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

?>
