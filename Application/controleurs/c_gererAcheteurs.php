<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

	
switch($action){
	case 'gererAcheteurs':{
		$lesAcheteurs = $pdo->getLesAcheteurs();
		$lesAddresses = $pdo->listeAdAcheteur();
		$nomAcheteur  = $pdo->listeNomAcheteur();
		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
		break;
	}
	case 'supprimerAcheteur':{
		$idAcheteur = $_REQUEST['idAcheteur'];
		
		if($pdo->supprimerAcheteur($idAcheteur)){
			
			$lesAcheteurs = $pdo->getLesAcheteurs();
			$lesAddresses = $pdo->listeAdAcheteur();
			$nomAcheteur  = $pdo->listeNomAcheteur();
            
           ajouterSucces("L'acheteur a bien été supprimé.");

		
            include("vues/v_listeAcheteurs.php");
            include("vues/v_succes.php");
			include("vues/v_ajoutAcheteurs.php");
        }else{

            $lesAcheteurs = $pdo->getLesAcheteurs();
			$lesAddresses = $pdo->listeAdAcheteur();
			$nomAcheteur  = $pdo->listeNomAcheteur();

            ajouterErreur("Erreur lors de la suppression.");

			include("vues/v_listeAcheteurs.php");
			include("vues/v_erreurs.php");
			include("vues/v_ajoutAcheteurs.php");
            

        }
		break;
	}
	case 'listeAcheteurs':{
		
		$lesAcheteurs = $pdo->getLesAcheteurs();
		$lesAddresses = $pdo->listeAdAcheteur();
		$nomAcheteur  = $pdo->listeNomAcheteur();
		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
		break;
	}
	case 'ajouterUnAcheteur':{
		$idHabitant = null;
		$idFoyer    = null;

		if(!empty($_POST['habitant'])){
			list($idHabitant, $idFoyer) = explode('-', $_POST['habitant']);
		}

		if($pdo->ajouterAcheteur($idHabitant, $idFoyer)){

			$lesAcheteurs = $pdo->getLesAcheteurs();
			$lesAddresses = $pdo->listeAdAcheteur();
			$nomAcheteur  = $pdo->listeNomAcheteur();
            
           ajouterSucces("L'acheteur a bien été ajouté");

		
            include("vues/v_listeAcheteurs.php");
            include("vues/v_succes.php");
			include("vues/v_ajoutAcheteurs.php");
        }else{

            $lesAcheteurs = $pdo->getLesAcheteurs();
			$lesAddresses = $pdo->listeAdAcheteur();
			$nomAcheteur  = $pdo->listeNomAcheteur();

            ajouterErreur("Erreur lors de l'ajout : des champs ne sont pas remplis.");

			include("vues/v_listeAcheteurs.php");
			include("vues/v_erreurs.php");
			include("vues/v_ajoutAcheteurs.php");
            

        }
		break;
	}
}

?>