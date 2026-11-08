<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

	
switch($action){
	case 'gererHabitants':{
		$lesHabitants = $pdo->getLesHabitants();
		$lesFoyers = $pdo->getLesFoyers();
		include("vues/v_listeHabitants.php");
		include("vues/v_ajoutHabitant.php");
		break;
	}
	case 'ajouterHabitant':{
		$idCivilite = $_REQUEST['idCivilite'];
		$idFoyer = $_REQUEST['idFoyer'];
		$nom = $_REQUEST['nom'];
		$prenom = $_REQUEST['prenom'];
		$dateNaissance = $_REQUEST['dateNaiss'];
		$mail = $_REQUEST['mail'];
		$telephonePort = $_REQUEST['telPortable'];
		$pdo->ajouterHabitant($idCivilite, $idFoyer, $nom, $prenom, $dateNaissance, $mail, $telephonePort);
		$lesHabitants = $pdo->getLesHabitants();
		include("vues/v_listeHabitants.php");
		include("vues/v_ajoutHabitant.php");
		break;
	}
}

?>