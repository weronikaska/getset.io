<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];
$action = $_REQUEST['action'];

	
switch($action){

    case 'statListeCommercants':{
		$lescommercants = $pdo->statCommercantPlusProduit();
		$lesLignes = $pdo->statListeCommercant();
		include("vues/v_statisticPlusCommMaire.php");
		include("vues/v_statisticListeMaire.php");
		break;
	}
	
	case 'statProduits':{

		if ($_SESSION['idEmploye'] == 2) {

			$lesTopProduits = $pdo->statTop3Produits();
			$lesProduits = $pdo->statListeProduitsAchetes();

			include("vues/v_statisticProduits.php");
		}
		else {
			ajouterErreur("Accès réservé au secrétaire.");
			include("vues/v_erreurs.php");
		}
		break;
	}
	
}