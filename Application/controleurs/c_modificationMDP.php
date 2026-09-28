<?php
    
    $action = $_REQUEST['action'];

    switch($action){
    
        //cree un isset pour verifier si les champs ont tous etaitaient rempli

        //l'utlisateur a remplie tous les champs
        case 'modificationDuMDP':{
            

            $ancien_mdp = $_REQUEST['ancien_nom'];
            $nouveau_mdp = $_REQUEST['nouveau_mdp'];
            //$login = $_REQUEST['login'];


            //fonction qui verfie si l'ancien mdp est bon
                $verif = $pdo->testMdp($ancien_mdp); //methode a reecrire

                if($verif == 0){
                    ajouterErreur("Ancien mot de passe incorrect");
                    include("vues/v_erreurs.php");
                    include("vues/v_modificationMDP.php");
                }
            else{
                //fonction qui UPDATE le mot de passe
                $modifier = $pdo->UpdateMdp($ancien_mdp, $nouveau_mdp);//methode a reecrire
            }
            break;
        }

        default :{
            //include("vues/c_modificationMDP.php");
            break;
	}
}
?>