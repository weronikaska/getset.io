<?php
session_start();
require_once("include/fonctions.php");
require_once ("include/modele.php");

$pdo = Modele::getModele();
$estConnecte = estConnecte();


// CETTE PARTIE EST FAITE AVANT INCLUDE/L'AFFICHAGE DU SITE
// ET SERT UNIQUEMENT POUR EVITER DES ERREURS AVEC AFFICHAGE HTML ET LE FPDF
if(!isset($_REQUEST['uc']) || !$estConnecte){
    $_REQUEST['uc'] = 'connexion';
}

$uc = $_REQUEST['uc'];


// PARTIE CONCERNANT LE FPDF
// VERIFICATION TELECHARGEMENT FPDF
if ($uc == 'listeCommerces' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'telechargerPDF') {
	include("controleurs/c_gererCommerces.php");
    exit; // usage de 'exit' et pas 'break' car pas dans un switch
}	

include("vues/v_entete.php");

switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");
		break;
	}
	case 'profilEmploye' :{
		include("controleurs/c_employe.php");
		break; 
	}
	case 'listeCommerces' :{
		include("controleurs/c_gererCommerces.php");
		break;
	}
	case 'listeAcheteurs' :{
		include("controleurs/c_gererAcheteurs.php");
		break;
	}
	case 'modificationMDP' :{
		include("controleurs/c_modificationMDP.php");
		break;
	}
	
	case 'gererProduit' :{
		include("controleurs/c_gererProduits.php");
		break;
	}
	case 'statistic' :{
		include("controleurs/c_statistic.php");
		break;
	}
	case 'gererDons' :{
		include("controleurs/c_gererDons.php");
		break;
	}
	case 'listeHabitants' :{
		include("controleurs/c_gererHabitants.php");
		break;
	}

}
include("vues/v_pied.php") ;
?>