
<h2> Ajouter un produit :</h2>


<form method="POST" action="index.php?uc=gererProduit&action=ajouterProduit">
   
	<p>
		<label for="refProduit"> Id du produit : </label>
		<input id="refProduit" type="text" name="refProduit" size="30" maxlength="45">
	</p>
	
	<p>
		<label for="desProduit"> Nom du produit : </label>
		<input id="desProduit" type="text" name="desProduit" size="30" maxlength="45">
	</p>
	
	<p>
		<label for="prixProduit"> Prix du produit (en Euro): </label>
		<input id="prixProduit" type="number" step="0.01" min="0" name="prixProduit" size="30" >
	</p>
	
    <p>
		<label for="qteStock"> Quantité disponible : </label>
		<input id="qteStock" type="number" name="qteStock" size="30" maxlength="45">
	</p>


       
     <input type="submit" value="Ajouter" name="Ajouter"/>
	 <input type='reset' value='Annuler' name='Annuler'>

</form>
