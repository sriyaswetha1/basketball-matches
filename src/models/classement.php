<?php

include("models/classement_repository.php");

class Classement {
    private $noequipe;
    private $nbvictoires;
    private $nbnuls;
    private $nbdefaites;
    private $points;
    private $diff;

    public function toString() {
        echo "Equipe $this->noequipe: $this->points Points - $this->nbvictoires Victoires - $this->nbnuls Nuls - $this->nbdefaites Défaites - Différence : $this->diff<br>";
    }
}

?>
