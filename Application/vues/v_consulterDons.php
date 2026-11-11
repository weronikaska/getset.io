

<table class="listeLegere">
  	   <caption>Liste des dons :</caption>
             <tr>
                <th>nom du commerce</th>
                <th>ville du commerce</th> 
				<th>reference du produit</th>  
                <th>prix du produit</th>  
                <th>quantité du produit</th>  
                 
             </tr>
          
    <?php    
	    foreach($lesLignes as $ligne) 
		{
			$nom = $ligne['nom'];
			$ville = $ligne['ville'];
			$refProduit=$ligne['refProduit'];
			$prix= $ligne['prix'];
            $qte= $ligne['qte'];
	?>		
            <tr>
                <td> <?php echo $nom ?></td>
                <td><?php echo $ville ?></td>
                <td><?php echo $refProduit ?></td>
				<td><?php echo $prix ?></td>
                <td><?php echo $qte ?></td>
             </tr>

            
			 
		  
	<?php		 
                
              
          }
	?>	  
                                          
    

  </table>