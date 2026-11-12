<?php
    include("vues/v_sommaire.php");
    $idEmploye = $_SESSION['idEmploye'];
    $action = $_REQUEST['action'];

    switch($action){

        case'ajouterProduit':{
            $lesProduits = $pdo->listeProduits();

            $ref = $_POST['refProduit'];
            $desProduit = $_POST['desProduit'];
            $qteStock = $_POST['qteStock'];
            $prixProduit = $_POST['prixProduit'];
            
            if($pdo->ajouterProduit($ref, $desProduit, $qteStock, $prixProduit)){
                
                ajouterSucces("Le produit a bien été ajouté");
				include("vues/v_succes.php");
				include("vues/v_listeProduits.php");
                include("vues/v_ajoutDeProduit.php");
            }
			else{//message d'erreur 

                ajouterErreur("Tous les champs n'ont pas été remplis.");
				include("vues/v_listeProduits.php");
                include("vues/v_erreurs.php");
                include("vues/v_ajoutDeProduit.php");
            }
            break;

        }
		
		case 'consultationProduit':{ // affichage TOP3 produits à voir quand table créé 
			$lesProduits = $pdo->listeProduits();
			include("vues/v_listeProduits.php");
			include("vues/v_ajoutDeProduit.php");
			break;
		}
		
		case 'modifierPrix':{
			$ref = $_POST['refProduit'];
			$nouveauPrix = $_POST['nouveauPrix'];

			if (is_numeric($nouveauPrix) && $nouveauPrix >= 0 && $pdo->modificationPrixProduit($ref, $nouveauPrix)) {
				ajouterSucces("Le prix du produit a bien été modifié.");
				$lesProduits = $pdo->listeProduits();
				include("vues/v_succes.php");
			}
			else {
				ajouterErreur("Le prix n'a pas pu être modifié (valeur invalide).");
				$lesProduits = $pdo->listeProduits();
				include("vues/v_erreurs.php");
			}
			include("vues/v_listeProduits.php");
			include("vues/v_ajoutDeProduit.php");
			break;
		}
    }

?>