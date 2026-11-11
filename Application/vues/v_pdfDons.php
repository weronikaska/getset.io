<?php
require_once("fpdf/fpdf.php");

$txt = function($s) {
    return iconv('UTF-8', 'windows-1252//TRANSLIT', (string)$s);
};

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, $txt("Dons par ville"), 0, 1, 'C');
$pdf->Ln(5);

$villeCourante = null;
$commerceCourant = null;

foreach ($lesDons as $unDon) {

    if ($unDon['ville'] != $villeCourante) {
        $villeCourante = $unDon['ville'];
        $commerceCourant = null;

        $pdf->Ln(4);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetFillColor(200, 220, 240);
        $pdf->Cell(190, 9, $txt("Ville : " . $villeCourante), 1, 1, 'L', true);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 8, 'Commerce', 1);
        $pdf->Cell(55, 8, 'Produit', 1);
        $pdf->Cell(25, 8, 'Prix (EUR)', 1);
        $pdf->Cell(20, 8, 'Qte', 1);
        $pdf->Cell(35, 8, 'Date', 1, 1);
        $pdf->SetFont('Arial', '', 10);
    }

    $nomAffiche = ($unDon['nomCommerce'] != $commerceCourant) ? $unDon['nomCommerce'] : '';
    $commerceCourant = $unDon['nomCommerce'];

    $pdf->Cell(55, 8, $txt($nomAffiche), 1);
    $pdf->Cell(55, 8, $txt($unDon['designation']), 1);
    $pdf->Cell(25, 8, $unDon['prix'], 1);
    $pdf->Cell(20, 8, $unDon['qte'], 1);
    $pdf->Cell(35, 8, dateAnglaisVersFrancais(substr($unDon['dateJour'], 0, 10)), 1, 1);
}

while (ob_get_level()) { ob_end_clean(); }   // jette tout affichage parasite
$pdf->Output('D', 'dons_par_ville.pdf');
?>