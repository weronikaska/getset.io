    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
    
      </div>  
        <ul id="menuList">
			<li >
				  Employé : <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?><br/ >
               <!--changer employée en variable qui change -->
            </li>
			<li>------------------------------------------</li>
      <!-- menu dispo pour chaque role -->
			<li class="smenu">
              <a href="index.php?uc=profilEmploye&action=profil" title="Mon Profil">Mon Profil</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Se déconnecter</a>
           </li>

      <!-- dispo pour secrétaire -->
           <li class="smenu">
              <a href="index.php?uc=listeCommerces&action=gererCommerces" title="Gestion des commerces">Gestion des commerces</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=listeAcheteurs&action=gererAcheteurs" title="Gestion des acheteurs">Gestion des acheteurs</a>
           </li>
			
   <!--vue sommaire du maire-->
           <li class="smenu">
              <a href="index.php?uc=gererProduit&action=consultationProduit" title="ajouter un produit">Ajouter un produit</a>
           </li>

           <li class="smenu">
              <a href="index.php?uc=gererDons&action=ListeDesDons" title="enregistrement des dons">Gestion des dons </a>
           </li>
            <li class="smenu">
              <a href="index.php?uc=statistic&action=statListeCommercants" title="Statistiques des commerçants"> Statistiques des commerçants</a>
           </li>
         </ul>
        
    </div>
    