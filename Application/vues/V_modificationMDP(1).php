<div id = "modification">

      <h2>Modification du mots de passe </h2>


	<form method="POST" action="index.php?uc=connexmodificationMDPion&action=modification">
   
		<p>
			<label for="ancien_nom"> Ancien mot de passe  </label>
			<input id="login" type="text" name="login"  size="30" maxlength="45">
		</p>
		<p>
			<label for="nouveau_mdp">Nouveau mot de passe  </label>
			<input id="mdp"  type="password"  name="mdp" size="30" maxlength="45">
		</p>
         <input type="submit" value="Valider" name="valider">
         <input type="reset" value="Annuler" name="annuler"> 
      </p>
</form>

</div>