<h3>Ajouter un nouvelle acheteur : </h3>

<form method="POST" action="index.php?uc=listeAcheteurs&action=ajouterUnAcheteur">
	<table  class="listeLegere">
		<p>
			<label for="ach">Nom et prenom des habitants </label>
				<select name="habitant" id="habitant">
			<?php foreach($nomAcheteur as $ach){ ?>
				<option value="<?php echo $ach['idHabitant'] . '-' . $ach['idFoyer']; ?>">
					<?php echo $ach['Nom'] . ' ' . $ach['prenom']; ?>
				</option>
			<?php } ?>
		</select>

		</p>
		<p>
			<label for="uneAdresse">Les foyers </label>
             <select name="idFoyer" id="idFoyer">
                <?php 
                    foreach($lesAddresses as $uneAdresse){
                ?>

                <option value="<?php echo $uneAdresse['id']; ?>">
                    <?php echo $uneAdresse['rue']; ?>
                    <?php echo $uneAdresse['ville']; ?>
                </option>

                <?php 
                    }
                ?>
            </select>
		</p>

	</table>
	<br />
	
	<input type='submit' value='Enregister' name='valider'>

	
</form>
<p>
