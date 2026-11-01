
<h2> Ajouter un produit :</h2>

<div class="formulaire-ajout">
    <form method="POST" action="index.php?uc=gererProduit&action=ajouterProduit">
   
		<p>
			<label for="refProduit">référence du produit </label>
			<input id="refProduit" type="text" name="refProduit" size="30" maxlength="45">
		</p>
		<p>
			<label for="desProduit">designation du produit </label>
			<input id="desProduit" type="text" name="desProduit" size="30" maxlength="45">
		</p>
        <p>
			<label for="qteStock">quantité en stock du produit </label>
			<input id="qteStock" type="number" name="qteStock" size="30" maxlength="45">
		</p>
        <p>
			<label for="prixProduit">prix du produit </label>
			<input id="prixProduit" type="number" step="0.01" min="0" name="prixProduit" size="30" > <p>€</p>
		</p>

       
     <input type="submit" value="ajouterProduit" name="ajouterProduit"/>

</form>
</div>