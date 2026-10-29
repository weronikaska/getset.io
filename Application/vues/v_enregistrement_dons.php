<div class="titre-ajout">
    <h2> Ajouter un don </h2>
</div>

<div class="formulaire-ajout">
    <form method="POST" action="index.php?uc=gererDons&action=ajouterDon">
   
		<p>
			<label for="comme">Commerce qui effectuer le dons </label>
             <select name="comme" id="comme">
                <?php 
                    foreach($lescomm as $comm){
                ?>

                <option value="<?php echo $comm['id']; ?>">
                    <?php echo $comm['nom']; ?>
                </option>

                <?php 
                    }
                ?>
            </select>
		</p>

        <p>
			<label for="refP">reference du produit </label>
             <select name="refP" id="refP">
                <?php 
                    foreach($lesRefComm as $ref){
                ?>

                <option value="<?php echo $ref['reference']; ?>">
                    <?php echo $ref['designation']; ?>
                </option>

                <?php 
                    }
                ?>
            </select>
      </p>

        <p>
			<label for="prixP">prix du produit </label>
			<input id="prixP"  type="text"  name="prixP" size="30" maxlength="45">
		</p>
        <p>
			<label for="qteS">quantité en stock du produit  </label>
			<input id="qteS"  type="text"  name="qteS" size="30" maxlength="45">
		</p>

     <input type="submit" value="ajoute le don" name="ajouterDon"/>

</form>
</div>