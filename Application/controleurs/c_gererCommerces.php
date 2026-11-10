<?php
include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

if ($action != "telechargerPDF" ) {
	include("vues/v_sommaire.php");
}

	
switch($action){
	case 'gererCommerces':{
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
		break;
	}
	case 'supprimerCommerce':{
		$idCommerce= $_REQUEST['id'];
		$pdo->supprimerCommerce($idCommerce);
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
	  break;
	}
	case 'ajouterUnCommerce':{
		$nom = $_REQUEST['nom'];
		$rue = $_REQUEST['rue'];
		$cp = $_REQUEST['cp'];
		$ville = $_REQUEST['ville'];
		$pdo->ajouterUnCommerce($nom, $rue, $cp, $ville);
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
		break;
	}
	case 'telechargerPDF': {
		$lesCommercants = $pdo->ListeCommercants();
		
		require_once("fpdf/fpdf.php");
		
		$pdf = new FDPF();
		$pdf->AddPage();
		
		// TITRE DU FPDF
		$pdf->SetFont("Arial", "B", 16);
		$pdf->Cell(190, 10, utf8_decode("Liste des commerçants"), 0, 1, "C");
		
		$pdf->Ln(10);
		
		
		// CREATION ENTETE TABLEAU
		$pdf->Cell(15, 10, 'ID', 1);
		$pdf->Cell(35, 10, 'Nom', 1);
		$pdf->Cell(30, 10, 'Prenom', 1);
		$pdf->Cell(40, 10, 'Commerce', 1);
		$pdf->Cell(25, 10, 'Code postal', 1);
		$pdf->Cell(45, 10, 'Ville', 1);

		$pdf->Ln();
		
		
		// CONTENU DU TABLEAU EN UTILISANT UN FOREACH
		$pdf->SetFont('Arial', '', 10);

		foreach ($lesCommercants as $unCommercant) {
			
			// iconv('UTF-8', 'windows-1252//TRANSLIT', ... -> UTILISER POUR AFFICHAGE ACCENTS ET CARACTERES SPECIAUX
			$pdf->Cell(15, 10, $unCommercant['idCommercant'], 1);
			$pdf->Cell(35, 10, iconv('UTF-8', 'windows-1252//TRANSLIT', $unCommercant['nom']), 1);
			$pdf->Cell(30, 10, iconv('UTF-8', 'windows-1252//TRANSLIT', $unCommercant['prenom']), 1);
			$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252//TRANSLIT', $unCommercant['nomCommerce']), 1);
			$pdf->Cell(25, 10, $unCommercant['codePostal'], 1);
			$pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252//TRANSLIT', $unCommercant['ville']), 1);

			$pdf->Ln();
		}
		
		// TELECHARGE LE FPDF
		$pdf->Output('D', 'liste_commercants.pdf');
		
	}	

}

?>