<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

	
switch($action){
	case 'gererAcheteurs':{
		$lesAcheteurs = $pdo->getLesAcheteurs();
		$lesCivilites  = $pdo->listeCivilites();
		$lesAddresses = $pdo->listeAdAcheteur();
		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
		break;
	}
	case 'supprimerAcheteur':{
		$idAcheteur = $_REQUEST['idAcheteur'];
		$pdo->supprimerAcheteur($idAcheteur);
		
		$lesAcheteurs = $pdo->getLesAcheteurs();
		$lesCivilites  = $pdo->listeCivilites();
		$lesAddresses = $pdo->listeAdAcheteur();


		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
	  break;
	}
	case 'listeAcheteurs':{
		
		$nomAcheteur = $pdo->listeNomAcheteur();
		$lesAddresses = $pdo->listeAdAcheteur();
		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
		break;
	}
	case 'ajouterUnAcheteur':{

		 $idFoyer    = $_POST['idFoyer'];
		$idCivilite = $_POST['idCivilite'];
		$nom        = $_POST['nom'];
		$prenom     = $_POST['prenom'];
		$dateNaiss  = $_POST['dateNaiss'];
		$mail       = $_POST['mail'];
		$telephone  = $_POST['telephone'];
        
		$pdo->ajouterAcheteur($idFoyer, $idCivilite, $nom, $prenom, $dateNaiss, $mail, $telephone);
		ajouterSucces("L'acheteur a bien été ajouté");
		include("vues/v_succes.php");

		$lesAcheteurs = $pdo->getLesAcheteurs();
		$lesCivilites  = $pdo->listeCivilites();
		$lesAddresses = $pdo->listeAdAcheteur();


		include("vues/v_listeAcheteurs.php");
		include("vues/v_ajoutAcheteurs.php");
		break;
	}
}

?>