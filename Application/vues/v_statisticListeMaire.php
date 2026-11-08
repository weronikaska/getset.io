<table class="listeLegere">
  	   <caption>Liste des commerçants avec le nombre de produits qu'ils proposent chacun :</caption>
             <tr>
                <th>Nom</th>
				<th>Prenom</th>  
                <th>Nom du commerce</th>  
                <th>Nombre de produits proposés</th>  

             </tr>
          
    <?php    
	    foreach($lesLignes as $ligne){
			$nom = $ligne['nom'];
			$prenom = $ligne['prenom'];
			$nomCommerce=$ligne['nomCommerce'];
			$nbProduit= $ligne['nbProduit'];
		
	?>		
            <tr>
                <td><?php echo $nom ?></td>
                <td><?php echo $prenom ?></td>
                <td><?php echo $nomCommerce ?></td>
				<td><?php echo $nbProduit ?></td>
             </tr>
	<?php		 
		}
	?>	  
</table>