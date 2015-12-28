<?php

include("models/statsEquipe_repository.php");

class StatsEquipe {
    private $nbvictoire;
    private $nbdefaite;
    private $nbnul;
    private $moyennepoints;
    private $noequipe;

    public function toString() {
        echo "Equipe $this->noequipe: $this->nbvictoire victoires<br>";
    }
}

?>
