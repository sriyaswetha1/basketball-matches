<div class="row">
    <h2><small>Liste des </small>Clubs<a href='?action=ajouter' data-tooltip aria-haspopup='true' class='has-tip right' title='Ajouter un club' style='margin-right: .5em'><i class='fa fa-plus'></i></a></h2>
</div>

<div class="row">
<table width=100%>
    <thead>
        <tr>
            <th width="50">Id</th>
            <th>Nom</th>
            <th>Localisation</th>
            <th width=100>Actions <a href="?action=ajouter" data-tooltip aria-haspopup="true" class="has-tip right" title="Ajouter un club"><i class="fa fa-plus"></i></a></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($clubs as $club) {
                echo "
                    <tr>
                        <td>" . $club->getId() . "</td>
                        <td>" . $club->getNom() . "</td>
                        <td>" . $club->getLocalisation() . "</td>
                        <td class='text-center'>
                            <a href='?action=voir&id=" . $club->getId() . "' data-tooltip aria-haspopup='true' class='has-tip' title='Voir ce club' style='margin-right: .5em'><i class='fa fa-search'></i></a>
                            <a href='?action=editer&id=" . $club->getId() . "' data-tooltip aria-haspopup='true' class='has-tip' title='Éditer ce club' style='margin-right: .5em'><i class='fa fa-pencil'></i></a>
                            <a href='?action=supprimer&id=" . $club->getId() . "' data-tooltip aria-haspopup='true' class='has-tip' title='Supprimer ce club'><i class='fa fa-times'></i></a>
                        </td>
                    </tr>
                    ";
            }
        ?>
    </tbody>
</table>
</div>
