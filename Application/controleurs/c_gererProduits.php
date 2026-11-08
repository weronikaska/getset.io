<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];
$action = $_REQUEST['action'];

switch($action){
    case 'gererProduits':{
        $lesEtats = $pdo->afficheEtat();
		include("vues/v_listeProduits.php");
        include("vues/v_ajoutDeProduit.php");
        break;
    }
    case 'ajouterProduit':{
        $ref = $_POST['refProduit'];
        $dateP =$_POST['datePeremption'];
        $idEtat = $_POST['etatP'];
        $pdo->ajouterProduit($ref, $dateP, $idEtat);
		include("vues/v_ajoutDeProduit.php");
        break;
    }
	case 'modifierProduit' :{
		
	}
}
?>