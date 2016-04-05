<?php

require '../app/Database.php';

$id = htmlspecialchars($_GET['id']);
require "../app/Table/Carte.php";
// on se connecte à MySQL
$db = new \Coac\Database();
require('../app/fpdf/fpdf.php');
$sql_carte_info = "SELECT `Etudiant`.`id`, `Etudiant`.`Nom`, `Etudiant`.`Prenom`, `Promo`.`Entree`, `Promo`.`Sortie`, `Etudiant`.`Date_Naissance`, `Promo`.`Filiere` 
                    FROM `Etudiant`,`Promo` 
                    WHERE `Etudiant`.`id_Promo` = `Promo`.`id` AND `Etudiant`.`id` = ?";
$test = $db->query($sql_carte_info, [$id])->fetch();



    $x = 5.5;
    $y = 4;
    $pdf = new FPDF(); //Taille par defaut en mm
    $pdf->SetAutoPageBreak(0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetMargins($x,$y);


    $pdf->AddPage('L', array (85,54));
    $pdf->Image('../../images/CarteModele.png', null, null, 74, 46, 'PNG');
    //$pdf->Image('../public/image.php?id='.$test->id.'', $x+47, $y+4.3, 23, 28, 'JPEG');
    $pdf->Text($x+13, $y+19.9, ''.$test->Nom.' '.$test->Prenom.'');//Abscisse Ordonnée Texte
    $pdf->Text($x+13, $y+24.6, ''.$test->Entree.' - '.$test->Sortie.'' );
    $pdf->Text($x+13, $y+29.8, $test->Date_Naissance);
    $pdf->Text($x+13, $y+34.9, $test->Filiere);
    $pdf->Image('../../images/llf_tampon_alpha.png', $x+35, $y+23, 21, 12, 'PNG');


$pdf->Output('Carte_'.$id.'.pdf', 'I');
?>
