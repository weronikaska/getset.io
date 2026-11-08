<h3> Statistiques sur les commerçants : </h3>
</br>

<p>Actuellement, le(s) commerçant(s) qui propose le plus de produits dans Epi'Solidaire sont/est :</p>
 <?php    
	    foreach($lescommercants as $commercant){
			$nom = $commercant['nom'];
			$prenom = $commercant['prenom'];

 			echo $commercant['nom']." ".$commercant['prenom'] .",";
 		} 
 ?>


</br>