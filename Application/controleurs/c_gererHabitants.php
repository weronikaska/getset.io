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
		$lesFoyers = $pdo->getLesFoyers();
		include("vues/v_listeHabitants.php");
		include("vues/v_ajoutHabitant.php");
		break;
	}
	case 'procedureValidation':{
		
		$idHabitant = $_REQUEST['id'];
		$idFoyer = $_REQUEST['idFoyer'];

		if ($_SESSION['numRole'] != 2) { // empeche n'importe quelle role d'effectuer les validations
			ajouterErreur("Vous n'avez pas les droits pour valider un habitant.");
			include("vues/v_erreurs.php");
		}
		else {
			if ($pdo->validerHabitant($idHabitant, $idFoyer, $idEmploye)) {
				ajouterSucces("L'habitant a bien été validé.");
				include("vues/v_succes.php");
			}
			else {
				ajouterErreur("La validation a échoué : habitant introuvable ou déjà validé.");
				include("vues/v_erreurs.php");
			}
		}

		$lesHabitants = $pdo->getLesHabitants();
		$lesFoyers = $pdo->getLesFoyers();
		include("vues/v_listeHabitants.php");
		include("vues/v_ajoutHabitant.php");
		break;
	}
}

?>