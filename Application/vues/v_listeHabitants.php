<table class="listeLegere">
  	   <caption>Liste des habitants enregistrés </caption>
             <tr>
			    <th>Id Habitants</th>
				<th>Id Foyer</th>
				<th>Id Civilité</th>
                <th>Nom</th>
				<th>Prenom</th> 
				<th>Date Naissance</th>
				<th>Mail</th>
				<th>Telephone Portable</th>
                <th>Civilité Validation</th>  
                <th>Date Validation</th> 
				<th>Id Employé Validation</th>
                <th class="action">Procédure de validation</th>  				
             </tr>
          
    <?php    
	    foreach($lesHabitants as $unHabitant){
			$idHabitant = $unHabitant['idHabitant'];
			$idFoyer = $unHabitant['idFoyer'];
			$idCivilite = $unHabitant['idCivilite'];
			$nom = $unHabitant['Nom'];
			$prenom = $unHabitant['prenom'];
			$dateNaiss = $unHabitant['dateNaiss'];
			$mail = $unHabitant['mail'];
			$telPortable = $unHabitant['telephonePortable'];
			$civiliteValide = $unHabitant['ciValide'];
			$dateValidation = $unHabitant['dateValidation'];
			$idEmployeValide = $unHabitant['idEmployeValidation'];
			$idCiviValidation = $unHabitant['ciValide'];
	?>		
            <tr>
			    <td> <?php echo $idHabitant ?></td>
                <td> <?php echo $idFoyer ?></td>
				<td> <?php echo $idCivilite ?></td>
                <td><?php echo $nom ?></td>
                <td><?php echo $prenom ?></td>
				<td><?php echo $dateNaiss ?></td>
				<td><?php echo $mail ?></td>
				<td><?php echo $telPortable ?></td>
				<td><?php echo $civiliteValide ?></td>
				<td><?php echo $dateValidation ?></td>
				<td><?php echo $idEmployeValide ?></td>
				
                <?php 
					if ($idCiviValidation == 0) {
				?>
						<td><a href="index.php?uc=listeHabitants&action=procedureValidation&id=<?php echo $idHabitant ?>&idFoyer=<?php echo $idFoyer ?>" 
						onclick="return confirm('Confirmez vous que cet habitant <?php echo $nom ?> a bien fait part des pièces requises pour être validé ?');">Validation Habitant</a></td>
				<?php 
					} 
					else { 
				?>
				<td> </td>
				<?php 
					}
				?>
				
				
             </tr>
	<?php		 
        }
	?>  

</table>