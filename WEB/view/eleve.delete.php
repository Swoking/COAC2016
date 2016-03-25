<?php
use \Coac\Table\Eleve;

$find = false; // controle si un élève est trouvé
$eleve = NULL;
$id = $_GET['id'];

foreach ( Eleve::getFromId($_GET['id']) as $data ) {
	$eleve = $data;
	$find = true ;
    Eleve::delete( $data->id );// supression de l'élève
}        

if ( !$find ) { // si pas d'élève corespondant
    $eleve->Nom = "Impossible, l'élève n'existe pas";
    $eleve->Prenom = "";
}

?>

<center>
    <h1>&mdash; Suppression de l'élève <?= $eleve->Nom; ?> <?= $eleve->Prenom; ?>&mdash;</h1>
</center>