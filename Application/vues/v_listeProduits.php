<table class="listeLegere">
	<caption> Liste des produits enregistrés </caption>
		<tr> 
			<th> Id </th>
			<th> Désignation </th>
			<th> Prix </th>
			<th> Quantité </th>
		</tr>
	
	<?php
		foreach($lesProduits as $unProduit) {
			$id = $unProduit['id'];
			$nom = $unProduit['nom'];
			$prix = $unProduit['prix'];
			$quantite = $unProduit['quantité'];
	?>
	
		<tr>
			<td> <?php echo $id ?> </td>
			<td> <?php echo $nom ?> </td>
			<td> <?php echo $prix ?> </td>
			<td> <?php echo $quantité ?> </td>
			<td> <?php echo $datePerem ?> </td>
		</tr>
		
	<?php 
		}
	?>
	
</table>