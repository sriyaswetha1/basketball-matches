<?php

require_once("database_connector.php");

class Rencontre {
    public $norencontre;
    public $nojournee;
    public $date;
    public $scoredomicile;
    public $scoreexterieur;
    public $equipedomicile;
    public $equipeexterieur;

    public function toString() {
        echo "Rencontre $this->norencontre journée $this->nojournee date: $this->date [équipe $this->equipedomicile] $this->scoredomicile - $this->scoreexterieur [équipe $this->equipeexterieur]<br>";
    }
}

?>
