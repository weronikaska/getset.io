
<h3>Ajouter un nouvelle acheteur : </h3>

<form method="POST" action="index.php?uc=listeAcheteurs&action=ajouterUnAcheteur">
	<table class="listeLegere">
		<tr>
			<td>Foyer : </td>
			<td>
				<select name="idFoyer" required>
					<?php foreach($lesAddresses as $f){ ?>
						<option value="<?php echo $f['id']; ?>">
							<?php echo htmlspecialchars($f['rue']." ".$f['ville']); ?>
						</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Civilité : </td>
			<td>
				<select name="idCivilite" required>
					<?php foreach($lesCivilites as $c){ ?>
						<option value="<?php echo $c['id']; ?>">
							<?php echo htmlspecialchars($c['libelle']); ?>
						</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nom : </td>
			<td><input type="text" name="nom" size="30" maxlength="50" required></td>
		</tr>
		<tr>
			<td>Prénom : </td>
			<td><input type="text" name="prenom" size="30" maxlength="50" required></td>
		</tr>
		<tr>
			<td>Date de naissance : </td>
			<td><input type="date" name="dateNaiss" required></td>
		</tr>
		<tr>
			<td>Mail : </td>
			<td><input type="email" name="mail" size="30" maxlength="100"></td>
		</tr>
		<tr>
			<td>Téléphone portable : </td>
			<td><input type="tel" name="telephone" size="15" maxlength="10"></td>
		</tr>
	</table>
	<br />

	<input type="submit" value="Enregistrer" name="valider">
	
</form>
<p>
