<?php
use \Coac\Table\Carte;
use \Coac\Table\Eleve;


$find = false; // controle si une carte est trouvé
$carte = NULL;

$id_Carte = $_GET['id'];

var_dump($id_Carte);

$etat = $_GET['etat'];

var_dump($etat);

if($etat == "desactive"){ 		$modif_etat = "Perdu" ;	$affiche = "est désactivée";}
if($etat == "autorise"){ 		$modif_etat = "Autorise" ;	$affiche = "est autorisée";}
if($etat == "non_autorise"){ 	$modif_etat = "Non_autorise" ;	$affiche = "n'est pas désactivée";}


foreach( Carte::getFromIdCarte($id_Carte) as $data ) { 
    if ($data->id == $id_Carte) { // test toutes les cartes 
        $find = true; // si carte trouvé : controle mis sur vrai (trouvé)
        $carte = $data->Num_Carte; // copie de la carte dans une variable
        Carte::modif_etat( $data->id, $modif_etat );// désactivation de la carte
        break;
    }
}

?>

<center>
    <h1>&mdash; La carte <?= $carte; ?> <?= $affiche; ?>  &mdash;</h1>
</center>

