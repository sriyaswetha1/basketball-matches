<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));

require_once(MODULES_PATH . "/database.php");

class DatabaseConnector {
    public $db;

    function __construct() {
        $this->db = getDatabase();
    }
}

?>
