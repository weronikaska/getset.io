<?php
$action = $_REQUEST['action'];

if ($action != 'telechargerPDF') {
    include("vues/v_sommaire.php");
}
$idEmploye = $_SESSION['idEmploye'];
	
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

        if( $pdo->ajouterDon($id, $reference, $prixP, $qteS)){

            $lesLignes = $pdo->ListeDons();
            $lescomm = $pdo->afficheComm();
            $lesRefComm = $pdo->afficheProduit();
            
            ajouterSucces("Le don a bien été ajouté");

            include("vues/v_consulterDons.php");
            include("vues/v_succes.php");
            include("vues/v_enregistrement_dons.php");
        }else{
            $lesLignes = $pdo->ListeDons();
            $lescomm = $pdo->afficheComm();
            $lesRefComm = $pdo->afficheProduit();

            ajouterErreur("Tous les champs n'ont pas été remplis.");

            include("vues/v_consulterDons.php");
            include("vues/v_erreurs.php");
            include("vues/v_enregistrement_dons.php");
        }
        break; 
	}
	case 'telechargerPDF': {
    if ($_SESSION['numRole'] != 3) {
        exit("Accès refusé");
    }else{
        $lesDons = $pdo->getDonsParVille();
        include("vues/v_pdfDons.php");
    }
    exit;
}

}