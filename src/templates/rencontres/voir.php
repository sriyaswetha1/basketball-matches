<div class="row">
    <h2>
        <small>Entraineur </small><?php echo $entraineur->getNom() . " " . $entraineur->getPrenom() ?>
    </h2>

    <h3><small>Liste des </small>Équipes</h3>

    <table width=100%>
        <thead>
            <tr>
                <th width="50">Id</th>
                <th>Nom catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($equipes as $equipe) {
                    echo "
                        <tr>
                            <td>" . $equipe->getId() . "</td>
                            <td>" . $equipe->getNomCategorie() . "</td>
                        </tr>
                ";
                }
            ?>
        </tbody>
    </table>
</div>
