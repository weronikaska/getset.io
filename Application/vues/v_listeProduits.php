<table class="listeLegere">
	<caption> Liste des produits enregistrés </caption>
		<tr> 
			<th> Id du produit </th>
			<th> Nom </th>
			<th> Prix </th>
			<th> Quantité </th>
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
	</tr>
<?php } ?>
	
</table>