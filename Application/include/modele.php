﻿<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GECET
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monModele qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */

class Modele{   		
      	private static $serveur = 'mysql:host=localhost';
      	private static $bdd = 'dbname=getcet';   		
      	private static $user = 'root' ;    		
      	private static $mdp = '' ;	
		private static $monPdo;
		private static $monModele = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	Modele::$monPdo = new PDO(Modele::$serveur.';'.Modele::$bdd, Modele::$user, Modele::$mdp); 
		Modele::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		Modele::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function __destruct(){
		Modele::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 * Appel : $instanceModele = Modele::getModele();
 * @return l'unique objet de la classe Modele
 */
	public  static function getModele(){
		if(Modele::$monModele == null){
			Modele::$monModele = new Modele();
		}
		return Modele::$monModele;
	}
	
/**
 * Teste l'existence d'un employe (version requetes prepares)
 
 * @param $login 
 * @param $mdp
 * @return la liste des employes avec le meme login et mdp sous la forme d'un tableau associatif 
*/
	public function testConnexionEmploye($login, $mdp){
		
		$pst = Modele::$monPdo->prepare("select count(*) as nb from employe where employe.login = ? and employe.mdp =md5(?)");
		$pst->bindParam(1, $login);
		$pst->bindParam(2, $mdp);
		$pst->execute();
		
		$ligne = $pst->fetch();
		$res = $ligne['nb'];
		return $res;
	}
	
	
/**
 * Teste l'existence si le mdp est bon 
 
 * @param $login 
 * @param $mdp
 * @return $verif
*/

//ISSET ICI AUSSI
	public function testMdp($idEmploye, $ancien_mdp){
		$mdp_chiffree = md5($ancien_mdp);
		$req = "SELECT count(*) as nb FROM employe WHERE idEmploye = ? AND mdp = md5(?);"; //si les mdp ne sont pas chiffree il faut mettre $ancien_mdp
		$req->bindParam(1, $idEmploye);
		$req->bindParam(2, $ancien_mdp);
		$rs = Modele::$monPdo->query($req);
		$ligne = $rs->fetch();
		$res = $ligne['nb'];
		return $res;
	}

	public function UpdateMdp($idEmploye, $nouveau_mdp){
		$mdp_chiffree = md5($nouveau_mdp);
		$req = "UPDATE employe SET mdp = ? WHERE idEmploye = ?;";
		$req->bindParam(1, $idEmploye);
		$req->bindParam(2, $nouveau_mdp);
		$rs = Modele::$monPdo->query($req);
		return $rs;
	}
	
/**
 * Retourne les informations d'un employe (version requetes prepares)
 
 * @param $login 
 * @param $mdp
 * @return l'idEmploye, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosEmploye($login, $mdp){
		
		$pst = Modele::$monPdo->prepare("select employe.idEmploye as id, employe.nom as nom, employe.prenom as prenom from employe 
		where employe.login = ? and employe.mdp = md5(?)");
		$pst->bindParam(1, $login);
		$pst->bindParam(2, $mdp);
		$pst->execute();
		
		$ligne = $pst->fetch();
		return $ligne;
	}

/**
 * Retourne les informations d'un employe à partir de son id (version requetes prepares)
 
 * @param $id 
 * @return les infos sous la forme d'un tableau associatif 
*/
	public function getInfosEmployeById($id){
		
		$pst = Modele::$monPdo->prepare("SELECT employe.nom as nom, employe.prenom as prenom, login, dateEmbauche from employe 
		where employe.idEmploye = ?;");
		$pst->bindParam(1, $id);
		$pst->execute();
		
		$ligne = $pst->fetch();
		$ligne['dateEmbauche'] = dateAnglaisVersFrancais($ligne['dateEmbauche']);
		return $ligne;
	}
	
/**
 * Retourne le role de l'employe à partir de son id (requete prepares)
 
 * @param $id
 * @return le role de l'employe sous la frome d'un tableau associatif
 */	
	public function getInfosEmployeRole($id) {
		
		$pst = Modele::$monPdo->prepare("SELECT employe.numRole as idRole FROM employe WHERE employe.login = ?");
		$pst->bindParam(1, $id);
		$pst->execute();
		
		$ligne = $pst->fetch();
		return $ligne;
	}

/**
 * Retourne le role de l'employe à partir de son login (requete prepares)
 
 * @param $login
 * @return le role de l'employe sous la frome d'un tableau associatif
 */	
	public function getNumRole($login) {
		
		$pst = Modele::$monPdo->prepare("SELECT employe.numRole as idRole FROM employe WHERE employe.login = ?");
		$pst->bindParam(1, $login);
		$pst->execute();
		

		//var_dump($ligne['idRole']);
		return $ligne = $pst->fetchColumn();
	}
	
	
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de Acheteurs (version requetes prepares)
 * @return tous les champs sous la forme d'un tableau associatif 
*/
	public function getLesAcheteurs(){

		try{
			$pst = Modele::$monPdo->prepare("select * from acheteur, habitant where habitant.idHabitant = acheteur.idHabitant and habitant.idFoyer = acheteur.idFoyer;");	
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
	    
		
		$lesLignes = $pst->fetchAll();
		return $lesLignes; 
	}


/**
 * Ajouter le produit dont les infos sont passées en arguments
 
 * @param $ref
 * @param $desProduit
 * @param $qteStock
 * @param $prixProduit
*/
//faire isset
	public function ajouterProduit($ref, $desProduit, $qteStock, $prixProduit ){
		$rep = false;
    	if(isset($ref, $desProduit, $qteStock, $prixProduit) && $ref != "" && $desProduit != "" && $qteStock != "" && $prixProduit != ""){

			$pst = Modele::$monPdo->prepare("SELECT COUNT(*) FROM produit WHERE reference = ?");
			$pst->bindValue(1, $ref);
			$pst->execute();
			$nb = $pst->fetchColumn();
			$rep = false;

			if($nb==0){
				$pst = Modele::$monPdo->prepare("Insert into produit (reference, designation, qteStock, prix) values (?, ?, ?, ?)");
				$pst->bindParam(1, $ref);
				$pst->bindParam(2, $desProduit);
				$pst->bindParam(3, $qteStock);
				$pst->bindParam(4, $prixProduit);
				$pst->execute();
				$rep = true;
			}
			$rep = true;
		}
		return $rep;
	}
	
/**
 * Supprimer l'acheteur dont l'id est passé en argument (version requetes prepares)
 
 * @param $idAcheteur 
*/
	public function supprimerAcheteur($idAcheteur){
		
		$pst = Modele::$monPdo->prepare("Delete from acheteur where acheteur.id = ?; ");
		$pst->bindParam(1, $idAcheteur);
		$pst->execute();
		
	}


/**
 *Renvoie les commerçant avec les dons qu'ils ont effectuer 
 
 * 
*/
	public function ListeDons(){ 
		try{
			$pst = Modele::$monPdo->prepare("SELECT commerce.nom AS nom,
											donner.refProduit AS refProduit,
											donner.prixOrigine AS prix,
											donner.qte AS qte,
											commerce.ville AS ville,
											donner.dateJour AS dateJour
										FROM commerce
										LEFT JOIN donner ON commerce.id = donner.idCommerce
										ORDER BY donner.dateJour DESC;"); // renvoie le premier commercant grace au left join moins contraignant que WHERE
												
			
			$pst->execute();
		}catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		$lesLignes = $pst->fetchAll();
		return $lesLignes;
	}



	public function getDonsParVille(){
		try{
			$pst = Modele::$monPdo->prepare("SELECT commerce.ville AS ville,
												commerce.nom AS nomCommerce,
												produit.designation AS designation,
												donner.prixOrigine AS prix,
												donner.qte AS qte,
												donner.dateJour AS dateJour
										FROM donner, commerce, produit
										WHERE commerce.id = donner.idCommerce
										AND produit.reference = donner.refProduit
										ORDER BY commerce.ville ASC, commerce.nom ASC, donner.dateJour DESC;");
			$pst->execute();
		}catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}

		$lesDonsVille= $pst->fetchAll();
		return $lesDonsVille;
		
	}


/**
 * Selection toutes les info de la table commerce qui permet ensuite d'afficher la liste deroulante 
 
 *
*/
	public function afficheComm(){
		try{
			$req = "SELECT * FROM commerce;";
			$stmt= Modele::$monPdo->query($req);
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lesComm = $stmt->fetchAll();
		return $lesComm;
	}



/**
 * Selection toute les info de la table produit
 * permet d'afficher la liste deroulante 
 
 *
*/
	public function afficheProduit(){

		try{
			$req = "SELECT * FROM produit;";
			$stmt= Modele::$monPdo->query($req);
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lesRefComm = $stmt->fetchAll();
		return $lesRefComm;
	}


/**
 * Ajouter le don dont les infos sont passées en arguments
 
 * @param $id
 * @param $reference
 * @param $prixP
 * @param $qteS
*/

	public function ajouterDon($id, $reference, $prixP, $qteS){
		$rep = false;

    	if(isset($id, $reference, $prixP, $qteS) && $id != "" && $reference != "" && $prixP != "" && $qteS != ""){
			$pst = Modele::$monPdo->prepare("INSERT INTO donner (idCommerce, refProduit, dateJour ,prixOrigine, qte) values (?, ?, NOW() ,?, ?)");
			$pst->bindParam(1, $id);
			$pst->bindParam(2, $reference);
			$pst->bindParam(3, $prixP);
			$pst->bindParam(4, $qteS);
			$pst->execute();
		$rep = true;
		}

    return $rep;

	}



public function ajouterAcheteur($idHabitant, $idFoyer){		$rep = false;

    	if(isset($idHabitant, $idFoyer)){
			try{
				$pst = Modele::$monPdo->prepare("INSERT INTO acheteur (idHabitant, idFoyer) VALUES (?, ?)");
				$pst->bindParam(1, $idHabitant);
				$pst->bindParam(2, $idFoyer);
				$pst->execute();

				$rep = true;

			}catch(PDOException $e) {
				echo "Erreur SQL :".htmlspecialchars($e->getMessage());
			}

		}
		return $rep;
	}

	
	/**
 * stat pour le maire
 * revoie le commerçant proposant le plus de produit
 
 *
*/

	public function statCommercantPlusProduit(){
		try{
			$pst = Modele::$monPdo->prepare("SELECT habitant.Nom AS nom, habitant.prenom AS prenom, COUNT(*) AS nbDons
											FROM habitant, commercant, donner
											WHERE habitant.idHabitant = commercant.idHabitant
											AND habitant.idFoyer = commercant.idFoyer
											AND commercant.idCommerce = donner.idCommerce
											GROUP BY commercant.id, habitant.Nom, habitant.prenom
											HAVING nbDons >= ALL (
												SELECT COUNT(*)
												FROM commercant, donner
												WHERE commercant.idCommerce = donner.idCommerce
												GROUP BY commercant.id
											)"); 

		
			$pst->execute();

		}catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lescommercants = $pst->fetchAll();
		return $lescommercants; 
	}
	

/**
 * stat pour le maire
 * revoie la liste des commerçant avec le nombre de produit qu'il propose
 
 *
*/
	public function statListeCommercant(){ //a changer car ne revoie pas les commerçant qui ont mit aucun produit en vente 
		try{
			$pst = Modele::$monPdo->prepare("SELECT habitant.Nom AS nom, habitant.prenom AS prenom, commerce.nom AS nomCommerce, COUNT(DISTINCT vendre.refProduit) AS nbProduit
											FROM habitant, commercant, commerce, vendre
											WHERE habitant.idHabitant = commercant.idHabitant
											AND commerce.id = commercant.idCommerce	
											AND habitant.idFoyer = commercant.idFoyer
											AND commerce.id = vendre.idCommerce
											GROUP BY commercant.id, habitant.Nom, habitant.prenom, commerce.nom");
				
			$pst->execute();
		}catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lesLignes = $pst->fetchAll();
		return $lesLignes; 
	}
	
	
/**
 * Renvoie la liste des produits existant
 *
 *@return tout les produits sous la forme d'un tableau associatif
*/
	public function listeProduits() {

	try{
			$pst = Modele::$monPdo->prepare("SELECT * FROM produit;");
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		
		$lesLignes = $pst->fetchAll();
		return $lesLignes;
		
	}

	/**
 * Renvoie la liste des foyer existant
 *
 *@return tout les foyer sous la forme d'un tableau associatif
*/

	public function listeAdAcheteur() {

		try{
			
			$pst = Modele::$monPdo->prepare("SELECT * FROM foyer;");
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lesAddresses =$pst->fetchAll();
		return $lesAddresses;
		
	}

/**
 * Renvoie la liste des 3 option de civilites existante dans la base de donnée
 *
 *@return toute les civilites sous la forme d'un tableau associatif
*/

	public function listeCivilites() {

		try{
			
			$pst = Modele::$monPdo->prepare("SELECT * FROM civilite;");
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$lesCivillites =$pst->fetchAll();
		return $lesCivillites;
		
	}


/**
 * Renvoie la liste des habitant existant
 *
 *@return tout les habitant sous la forme d'un tableau associatif
*/

	public function listeNomAcheteur() {

		try{
			$pst = Modele::$monPdo->prepare("SELECT * FROM habitant;");
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		
		$nomAcheteur = $pst->fetchAll();
		return $nomAcheteur;
		
	}
	
	
	
	
/**
 * Ajouter le commerce dont les infos sont passées en arguments (version requetes préparés)
 
 * @param $nom
 * @param $rue
 * @param $cp
 * @param $ville
*/
	public function ajouterUnCommerce($nom, $rue, $cp, $ville){

		$rep = false;

    	if(isset($nom, $rue, $cp, $ville) && $nom != "" && $rue != "" && $cp != "" && $ville != ""){
			$pst = Modele::$monPdo->prepare("Insert into commerce (nom, rue, codePostal, ville) values (?, ?, ?, ?)");
			$pst->bindParam(1, $nom);
			$pst->bindParam(2, $rue);
			$pst->bindParam(3, $cp);
			$pst->bindParam(4, $ville);
			$pst->execute();
			
			/*
			$req = "Insert into commerce (nom, rue, codePostal, ville) values ('$nom', '$rue', '$cp', '$ville'); ";
			Modele::$monPdo->exec($req);
			*/
			
			//echo de verfication non fonctionnelle
			//echo "La requete a bien été effectué ".$pst;
			$rep = true;
		}
		return $rep;
		
	}	

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de Commerces (version requetes préparés)
 * @return tous les champs sous la forme d'un tableau associatif 
*/
	public function getLesCommerces(){
		
		try{
			$pst = Modele::$monPdo->prepare("select * from commerce");	
			$pst->execute();
		}
		catch(SQLException $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		$lesLignes = $pst->fetchAll();
		
		return $lesLignes; 
	}
	
	
	
/**
 * Supprimer le commerce et le/les commercants associer avec l'id est passé en argument (version requetes préparés)
 * @param $id 
*/
	public function supprimerCommerce($id){
		
		$rep = false;
		
		//requete de vérification
		try {
			$pst = Modele::$monPdo->prepare("SELECT idCommerce FROM vendre");
			$pst->execute();
		}
		catch(PDOExceptions $e) {
			echo "Erreur SQL :".htmlspecialchars($e->getMessage());
		}
		$resultatVente = $pst->fetchAll();
		
		if(empty($resultatVente)) {
			echo "Aucune données trouvable";
		}
		else{
			foreach($resultatVente as [$res]) {
				if($id == $res) {
					try {
						$req = "SELECT * FROM commerce WHERE commerce.idCommerce = ?; ";
						//$req = "SELECT * FROM commerce WHERE commerce.idCommerce = ".$res."; ";
						$pst = Modele::$monPdo->prepare($req);
						$pst->bindParam(1, $res);
						//echo $req;
						$pst->execute();
						//echo "La requete a bien été executé";
						$resultatCommerce = $pst->fetchAll();
						
						//if($resultatCommerce == $id)
							//$rep = true;
						
					}
					catch(PDOExceptions $e) {
						echo "Erreur SQL :".htmlspecialchars($e->getMessage());
					}
				}
			}
		}
		
		if(isset($resultatCommerce)) {
			
			echo "Erreur, ce commerce ne peut pas etre supprimé !";
			$rep = false;
			
		}
		else {
			$pst = Modele::$monPdo->prepare("Delete from commerce where commerce.id = ?; ");
			$pst->bindParam(1, $id);
			$pst->execute();
		
			$pst = Modele::$monPdo->prepare("DELETE FROM commercant WHERE commercant.idCommerce = ?; ");
			$pst->bindParam(1, $id);
			$pst->execute();
			
			$rep = false;
		}
		//echo "La requete a bien été effectué".$req;
	}
	
/**
 *
 * Retourne sous forme d'un tableau associatif toutes les lignes de habitant
 * @return tous les champs sous la forme d'un tableau associatif 
 *
*/
	public function ajouterHabitant($idCivilite, $idFoyer, $nom, $prenom, $dateNaissance, $mail, $telephonePort) {
		
		
		try{
			$pst = Modele::$monPdo->prepare("SELECT MAX(idHabitant) FROM habitant WHERE idFoyer = ?;");
			$pst->bindValue(1, $idFoyer);
			$pst->execute();
			$max = $pst->fetchColumn();
			
			if ($max == null) { 
				$idHabitant = 1;
			}
			else{
				$idHabitant = $max + 1;
			}
		
			$pst = Modele::$monPdo->prepare("INSERT INTO habitant(idHabitant, idCivilite, idFoyer, Nom, prenom, dateNaiss, mail, telephonePortable) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
			$pst->bindParam(1, $idHabitant);
			$pst->bindParam(2, $idCivilite);
			$pst->bindParam(3, $idFoyer);
			$pst->bindParam(4, $nom);
			$pst->bindParam(5, $prenom);
			$pst->bindParam(6, $dateNaissance);
			$pst->bindParam(7, $mail);
			$pst->bindParam(8, $telephonePort);
			$pst->execute();
		} 
		catch (PDOException $e) {
			throw $e; // permet d'éviter d'appraitre comme succès si fail
		}
		
	}

	/**
 *
 * Retourne sous forme d'un tableau associatif toutes les lignes de habitant
 * @return tous les champs sous la forme d'un tableau associatif 
 *
*/
	public function getLesHabitants() {

		$pst = Modele::$monPdo->prepare("select * from habitant");	
		$pst->execute();
		
		$lesLignes = $pst->fetchAll();
		
		return $lesLignes; 
	}

	/**
 *
 * Retourne sous forme d'un tableau associatif toutes les lignes des foyers
 * @return tous les champs sous la forme d'un tableau associatif 
 *
*/
	public function getLesFoyers() {

		$pst = Modele::$monPdo->prepare("select * from foyer");	
		$pst->execute();
		
		$lesLignes = $pst->fetchAll();
		
		return $lesLignes;
	}

/**
 * Retourne la liste des commerçants qui alimente le FPDF
 *
 *@return 
*/
	public function getListeCommercants() {
		
		//INNER JOIN, permet la jointure et récupère uniquement les commerces avec un habitant correspondant 
		$pst = Modele::$monPdo->prepare("SELECT commercant.id AS idCommercant,
                                        habitant.nom AS nom,
                                        habitant.prenom AS prenom,
                                        commerce.nom AS nomCommerce,
                                        commerce.rue AS rue,
                                        commerce.codePostal AS codePostal,
                                        commerce.ville AS ville
										FROM commercant
										INNER JOIN habitant ON commercant.idHabitant = habitant.idHabitant
                                        AND commercant.idFoyer = habitant.idFoyer
										INNER JOIN commerce ON commercant.idCommerce = commerce.id
										ORDER BY habitant.nom ASC");
		
		$pst->execute();
		$lesLignes = $pst->fetchAll();
		
		return $lesLignes;
	}



/*
 * Modifie le prix d'un produit rentré par l'utilisateur
 *
 * @param String $reference
 * @param float $prix
 * 
 *@return true si la requete réussi
*/
	public function modificationPrixProduit($reference, $prix) {
		
		$pst = Modele::$monPdo->prepare("UPDATE produit SET prix = ? WHERE reference = ?;");
		$pst->bindParam(1, $prix);
		$pst->bindParam(2, $reference);
		
		return $pst->execute();
	
	}
	
	
/*
 * Permet la validation d'un habitant, si la validation est faite, ciValide affiichera 1 et les informations de l'employé ayant effectué la validation  
 *
 * @return $res, elle renvoie true si il a été validé (sinon false si non existant ou déjà validé)
 *
*/

	public function validerHabitant($idHabitant, $idFoyer, $idEmploye) {
		
		$pst = Modele::$monPdo->prepare("UPDATE habitant SET ciValide = 1, dateValidation = CURDATE(), idEmployeValidation = ?
										 WHERE idHabitant = ? AND idFoyer = ? AND ciValide = 0;");
		
		$pst->bindParam(1, $idEmploye);
		$pst->bindParam(2, $idHabitant);
		$pst->bindParam(3, $idFoyer);
		$pst->execute();
		
		if ($pst->rowCount() > 0) {
			$res = true;
		}
		else{
			$res = false;
		}
		
		return $res;
	
	}

/*
 * Permet de renvoyer la liste des 3 produits les plus achetés 
 *
 *
 *@return une liste de 3 produits 
*/
	
	public function statTop3Produits() {
		
		$i = 0;
		
		$pst = Modele::$monPdo->prepare("SELECT refProduit, COUNT(*) AS nbAchats
										 FROM acheter
										 GROUP BY refProduit
										 ORDER BY nbAchats DESC;");
		
		$pst->execute();
		
		$lesLignes = array();
		
		while ($i < 3 && $ligne = $pst->fetch()) {
			$lesLignes[] = $ligne;
			$i++;
		}
		
		return $lesLignes;
	
	}



/*
 * Permet de donné la liste de tout les produits et de leur vente 
 *
 *
 *@return la liste des produits selon leur nombre d'achats en ordre decroissant 
*/
	public function statListeProduitsAchetes() {
    
		$pst = Modele::$monPdo->prepare("SELECT p.reference, COUNT(a.idArticle) AS nbAchats
										 FROM produit p
										 LEFT JOIN acheter a ON p.reference = a.refProduit
										 GROUP BY p.reference
										 ORDER BY nbAchats DESC;");
		
		$pst->execute();
		
		$lesLignes = $pst->fetchAll();
		
		return $lesLignes;
	}


}
?>