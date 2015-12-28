<div class="row">
    <h2><small>Liste des </small>Rencontres</h2>
</div>

<div class="row">
<table width=100%>
    <thead>
        <tr>
            <th width="50">Id</th>
            <th>Journée</th>
            <th>Date</th>
            <th>Score domicile</th>
            <th>Score extérieur</th>
            <th>Équipe domicile</th>
            <th>Équipe extérieure</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($rencontres as $rencontre) {
                echo "
                    <tr>
                        <td>" . $rencontre->norencontre . "</td>
                        <td>" . $rencontre->nojournee . "</td>
                        <td>" . $rencontre->date . "</td>
                        <td>" . $rencontre->scoredomicile . "</td>
                        <td>" . $rencontre->scoreexterieur . "</td>
                        <td>" . $rencontre->equipedomicile . "</td>
                        <td>" . $rencontre->equipeexterieur . "</td>
                    </tr>
                    ";
            }
        ?>
    </tbody>
</table>
</div>
