<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];
$action = $_REQUEST['action'];

	
switch($action){

    case 'statListeCommercants':{
		$CommercantPlus = $pdo->statCommercantPlusProduit();
		$lesLignes = $pdo->statListeCommercant();
		include("vues/v_statisticPlusCommMaire.php");
		include("vues/v_statisticListeMaire.php");
		break;
	}
	
    
	
}