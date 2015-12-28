<div class="row">
    <h2><small>Liste des </small>Entraineurs</h2>
</div>

<div class="row">
<table width=100%>
    <thead>
        <tr>
            <th width="50">Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th width=100>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($entraineurs as $entraineur) {
                echo "
                    <tr>
                        <td>" . $entraineur->getId() . "</td>
                        <td>" . $entraineur->getNom() . "</td>
                        <td>" . $entraineur->getPrenom() . "</td>
                        <td class='text-center'>
                            <a href='?action=voir&id=" . $entraineur->getId() . "' data-tooltip aria-haspopup='true' class='has-tip' title='Voir cet entraineur'><i class='fa fa-search'></i></a>
                        </td>
                    </tr>
                    ";
            }
        ?>
    </tbody>
</table>
</div>
