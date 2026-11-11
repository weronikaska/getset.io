<div id = "contenu">
	
      <h2>Modification du mots de passe </h2>


	<form method="POST" action="index.php?uc=modificationMDP&action=modificationDuMDP">
   
		<p>
			<label for="ancien_mdp"> Ancien mot de passe  </label>
			<input id="ancien_mdp" type="password" name="ancien_mdp"  size="30" maxlength="45">
		</p>
		<p>
			<label for="nouveau_mdp">Nouveau mot de passe  </label>
			<input id="nouveau_mdp"  type="password"  name="nouveau_mdp" size="30" maxlength="45">
		</p>
         <input type="submit" value="Valider" name="valider">
         <input type="reset" value="Annuler" name="annuler"> 
      </p>
</form>

</div>