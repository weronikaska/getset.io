<?php
    
    $action = $_REQUEST['action'];
		$idEmploye = $_SESSION['idEmploye']; //reccupere l'id de l'employer
        include("vues/v_sommaire.php");
	    //cree un isset pour verifier si les champs ont tous etaitaient rempli


    switch($action){

        //l'utlisateur a remplie tous les champs
        case 'modificationDuMDP':{
            

            $ancien_mdp = $_REQUEST['ancien_mdp'];
            $nouveau_mdp = $_REQUEST['nouveau_mdp'];


            //fonction qui verfie si l'ancien mdp est bon
                $verif = $pdo->testMdp($idEmploye, $ancien_mdp);

                if($verif == 0){
                    ajouterErreur("Ancien mot de passe incorrect");
                    include("vues/v_erreurs.php");
                    include("vues/v_modificationMDP.php");
                }
            else{
                //fonction qui UPDATE le mot de passe
                $modifier = $pdo->UpdateMdp($idEmploye, $nouveau_mdp);
                ajouterSucces("Votre mot de passe a bien été modifié.");
                include("vues/v_succes.php");
                include("vues/v_modificationMDP.php");
            }
            break;
        }

        default :{
            //include("vues/c_modificationMDP.php");
            break;
	}
}
?>