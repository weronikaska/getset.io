<h3>Ajouter un nouvel habitant : </h3>

<form method="POST" action="index.php?uc=listeHabitants&action=ajouterHabitant">
	<table  class="listeLegere">
		<!-- Tout les champs sont obligatoires sinon un habitant ne peut pas exister (après tout, une mairie doit connaitre ses habitants)-->
		<tr>
			<td>Civilité : </td>
			<td>
				<select name="idCivilite" required>
					<option value="1">Mr</option>
					<option value="2">Mme</option>
					<option value="3" selected>Non défini</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Adresse connu : </td>
			<td>
				<select name="idFoyer" required>
					<option value="" disabled selected> -- choisir -- </option>
				<?php 
					foreach($lesFoyers as $unFoyer) {
						$idFoyer = $unFoyer['id'];
						$rue = $unFoyer['rue'];
				?>
					<option value="<?php echo $idFoyer ?>" required><?php echo $rue ?></option>
				<?php 
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Nom : </td>
			<td>
				<input  type='text' name ="nom"  size='50' maxlength='50' required>
			</td>
		</tr>
		<tr>
			<td>Prenom : </td>
			<td>
				<input  type='text' name ="prenom"  size='50' maxlength='50' required>
			</td>
		</tr>
		<tr>
			<td>Date de Naissance : </td>
			<td>
				<input  type='text' name ="dateNaiss"  size='5' maxlength='10' required>
			</td>
		</tr>
		<tr>
			<td>Mail : </td>
			<td>
				<input type='text' name ="mail" size='50' maxlength='50' required> 
			</td>
		</tr>
		<tr>
			<td>Téléphone Portable : </td>
			<td>
				<input type='text' name ="telPortable" size='50' maxlength='50' required>
			</td>
		</tr>

	</table>
	<br/>
	
	<input type='submit' value='Enregister' name='valider'>
	<input type='reset' value='Annuler' name='annuler'>

	
</form>
<p>