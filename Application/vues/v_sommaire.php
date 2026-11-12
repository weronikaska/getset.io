 <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
    
      </div>  
        <ul id="menuList">
			<li >
			<?php 
				if ($_SESSION['numRole'] == 3) {
					echo "M./Mme. "; //Référence au maire 
				}
				else {
					if ($_SESSION['numRole'] == 2) {
						echo "Secrétaire : ";
					}
					else {
						echo "Employé : ";
					}
				}
				
				echo $_SESSION['prenom']." ".$_SESSION['nom'] 
			?>
			<br/>
               <!--changer employée en variable qui change -->
            </li>
			<li>------------------------------------------</li>
      <!-- menu dispo pour chaque role -->
			<li class="smenu">
              <a href="index.php?uc=profilEmploye&action=profil" title="Mon Profil">Mon Profil</a>
           </li>

      <!-- dispo pour secrétaire et employe lambda -->
           <li class="smenu">
              <a href="index.php?uc=listeCommerces&action=gererCommerces" title="Gestion des commerces">Gestion des commerces</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=listeAcheteurs&action=gererAcheteurs" title="Gestion des acheteurs">Gestion des acheteurs</a>
           </li>
			
   <!--vue sommaire du maire et secrétaire-->
		<?php
			if ($_SESSION['numRole'] == 3 || $_SESSION['numRole'] == 2) {
		?>
			<li class="smenu">
				<a href="index.php?uc=gererProduit&action=consultationProduit" title="Gestion des produits">Gestion des produits</a>
			</li>

			<li class="smenu">
				<a href="index.php?uc=gererDons&action=ListeDesDons" title="Gestion des dons">Gestion des dons</a>
			</li>
		   
			<li class="smenu">
				<a href="index.php?uc=statistic&action=statListeCommercants" title="Statistiques des commerçants">Statistiques des commerçants</a>
			</li>
			
		<?php
				if ($_SESSION['numRole'] == 2) {
		?>
			<li class="smenu">
				<a href="index.php?uc=listeHabitants&action=gererHabitants" title="Gestion des Habitants">Gestion des habitants</a>
			</li>
			
			<li class="smenu">
				<a href="index.php?uc=statistic&action=statProduits" title="Statistiques des produits" >
					Statistiques des produits
				</a>
			</li>
		<?php
				}
			}
		?>
		 
		<!-- deconnexion dispo pour tout les rôles -->
		   <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Se déconnecter</a>
           </li>
		</ul>
        
    </div>
    