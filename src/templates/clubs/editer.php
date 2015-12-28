<div class="row">
    <h2>Editer<small> Club</small></h2>
    <form action="clubs.php?action=editer" method="POST">
  <div class="row">
    <div class="large-6 columns">
      <label>Nom
        <input type="text" placeholder="Nom du club" name="nom" value="<?php echo $club->getNom() ?>" />
      </label>
    </div>
<div class="large-6 columns">
      <label>Localisation
        <input type="text" name="localisation" value="<?php echo $club->getLocalisation() ?>" />
      </label>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $club->getId() ?>" />
<div class="large-12 columns">
        <input type="submit" class="button right small" placeholder="Nom du club" name="Valider" />
    </div>
</div>
