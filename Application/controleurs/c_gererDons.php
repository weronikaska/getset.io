<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];
$action = $_REQUEST['action'];

	
switch($action){

    case'ListeDesDons':{
		$lesLignes = $pdo->ListeDons();
        $lescomm = $pdo->afficheComm();
        $lesRefComm = $pdo->afficheProduit();
		include("vues/v_consulterDons.php");
		include("vues/v_enregistrement_dons.php");
		break;
	}
    
    case'ajouterDon':{
        $id = $_POST['comme'];
        $reference = $_POST['refP'];
        $prixP = $_POST['prixP'];
        $qteS = $_POST['qteS'];

        $pdo->ajouterDon($id, $reference, $prixP, $qteS);
        ajouterSucces("Le don a bien été ajouté");
        include("vues/v_succes.php");
        include("vues/v_enregistrement_dons.php");
        break;
	}
	
}