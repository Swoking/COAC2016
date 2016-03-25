<?php
require "../app/Table/Carte.php";

$classe = htmlspecialchars($_GET['classe']);

// on se connecte à MySQL
$db = new \Coac\Database('COAC');

require('../app/fpdf/fpdf.php');

$sql_classe = "SELECT `Etudiant`.`id_Promo`, `Etudiant`.`id` FROM `Etudiant`,`Promo` WHERE `Etudiant`.`id_Promo` = `Promo`.`id` AND `Promo`.`Nom` = '$classe'";


$req_classe = $db->query($sql_classe, 'COAC\Table\Carte');
    $x = 5.5;
    $y = 4;
    $pdf = new FPDF(); //Taille par defaut en mm
    $pdf->SetAutoPageBreak(0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetMargins($x,$y);
   

    while($data_classe = mysql_fetch_assoc($req_classe) )
    {
             
	     if ($data_classe['id'] == 138) {
       $sql = 'SELECT `Etudiant`.`Nom`, `Etudiant`.`Prenom`, `Etudiant`.`id_Promo`, Date_format(`Etudiant`.`Date_Naissance`,"%d/%m/%Y") AS DateNaissance , `Etudiant`.`id`, `Promo`.`Entree`, `Promo`.`Sortie`, `Promo`.`Filiere` FROM `COAC`.`Etudiant` AS `Etudiant`, `COAC`.`Promo` AS `Promo` WHERE `Etudiant`.`id_Promo` = `Promo`.`id_Promo` AND `Etudiant`.`id`='.$data_classe['id'].'';
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
         if($data = mysql_fetch_assoc($req))
         {
             $pdf->AddPage('L', array (74,46));
             $pdf->Image('images/CarteModele.png', null, null, 74, 46, 'PNG');
             $pdf->Image('http://192.168.1.200/includes/image.php?id='.$data['id'].'', $x+47, $y+4.3, 23, 28, 'JPG');
             $pdf->Text($x+13, $y+19.9, ''.$data['Nom'].' '.$data['Prenom'].'');//Abscisse Ordonnée Texte
             $pdf->Text($x+13, $y+24.6, ''.$data['Entree'].' - '.$data['Sortie'].'' );
             $pdf->Text($x+13, $y+29.8, $data['DateNaissance']);
             $pdf->Text($x+13, $y+34.9, $data['Filiere']);
             $pdf->Image('images/llf_tampon_alpha.png', $x+35, $y+23, 21, 12, 'PNG');
         }
	}
       }
 
    $pdf->Output('Carte_'.$classe.'.pdf', 'I');
?>
