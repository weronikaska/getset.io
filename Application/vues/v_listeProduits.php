<table class="listeLegere">
	<caption> Liste des produits enregistrés </caption>
		<tr> 
			<th> Id du produit </th>
			<th> Nom </th>
			<th> Prix </th>
			<th> Quantité </th>
			<th class="action"> Modification prix </th>
		</tr>
	
	<?php
		foreach($lesProduits as $unProduit) {
			$ref = $unProduit['reference'];     
			$des = $unProduit['designation'];   
			$prix = $unProduit['prix'];
			$quantite = $unProduit['qteStock'];      
	?>
		<tr>
			<td> <?php echo $ref ?> </td>
			<td> <?php echo $des ?> </td>
			<td> <?php echo $prix ?> </td>
			<td> <?php echo $quantite ?> </td>
			<td>
				<form method="POST" action="index.php?uc=gererProduit&action=modifierPrix"
					onsubmit="return confirm('Voulez-vous vraiment modifier le prix de ce produit ?');">
					
					<input type="hidden" name="refProduit" value="<?php echo $ref; ?>">
					
					<input type="number" step="0.01" min="0" name="nouveauPrix" value="<?php echo $prix; ?>" required>
					
					<input type="submit" value="Modifier">
				</form>
			</td>
		</tr>
	<?php 
		} 
	?>
	
</table>