<div class="titre-ajout">
    <h2> Ajouter un produit </h2>
</div>

<div class="formulaire-ajout">
    <form method="POST" action="index.php?uc=gererProduit&action=ajouterProduit">
   
		<p>
			<label for="refProduit">référence du produit </label>
			<input id="refProduit" type="text" name="refProduit" size="30" maxlength="45">
		</p>
		<p>
			<label for="dateP">Date de péremption  </label>
			<input id="dateP"  type="text"  name="dateP" size="30" maxlength="45">
		</p>

        <p>
			<label for="etatP">Etat du produit </label>
             <select name="etatP" id="etatP">
                <?php 
                    foreach($lesEtats as $etat){
                ?>

                <option value="<?php echo $etat['id']; ?>">
                    <?php echo $etat['libelle']; ?>
                </option>

                <?php 
                    }
                ?>
            </select>
      </p>
     <input type="submit" value="ajouterProduit" name="ajouterProduit"/>

</form>
</div>