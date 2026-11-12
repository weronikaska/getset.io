<h2>Liste des 3 produits les plus achetés</h2>

<table class="listeLegere">
		<tr>
			<th>Produit</th>
			<th>Nombre d'achats</th>
		</tr>

		<?php 
			foreach ($lesTopProduits as $produit) { 
		?>
			<tr>
				<td><?php echo $produit['refProduit']; ?></td>
				<td><?php echo $produit['nbAchats']; ?></td>
			</tr>
		<?php 
			} 
		?>
</table>


<h2>Liste des produits et de leur nombre de vente </h2>

<table class="listeLegere">
		<tr>
			<th>Produit</th>
			<th>Nombre d'achats</th>
		</tr>

		<?php 
			foreach ($lesProduits as $produit) {
		?>
			<tr>
				<td><?php echo $produit['reference']; ?></td>
				<td><?php echo $produit['nbAchats']; ?></td>
			</tr>
		<?php 
			} 
		?>
</table>