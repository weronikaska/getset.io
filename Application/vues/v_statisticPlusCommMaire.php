<div class="stats">
    <h1>Statistiques sur les commerçants</h1>
    <h2>Le(s) commerçant(s) qui propose(nt) le plus de produits :</h2>
    <h3>
        <strong>
        <?php
            $noms = [];
            foreach($lescommercants as $commercant){
                $noms[] = $commercant['prenom'] . ' ' . $commercant['nom'];
            }
            echo implode(', ', $noms);
        ?>
        </strong>
    </h3>
</div>