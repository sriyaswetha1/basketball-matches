<?php include("models/statsEquipe.php"); ?>
<?php include("header.php"); ?>
<p>
    <?php
        $statsEquipeRepository = new StatsEquipeRepository();
        foreach ($statsEquipeRepository->findAll() as $statsEquipe) {
            $statsEquipe->toString();
        }
    ?>
</p>
<?php include("footer.php"); ?>
