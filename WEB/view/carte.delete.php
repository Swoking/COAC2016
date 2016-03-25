<?php
use \Coac\Table\Carte;

$find = false; // controle si une carte est trouvé
$carte = NULL;

var_dump($id_Carte);

$id = $_GET['id'];

var_dump($id);


foreach( Carte::getFromIdCarte($_GET['id']) as $data ) { 
    if ($data->id == $id) { // test toutes les cartes 
        $find = true; // si carte trouvé : controle mis sur vrai (trouvé)
        $carte = $data; // copie de la carte dans une variable
        Carte::delete( $data->id );// supression de la carte
        break;
    }
}

if ( !$find ) { // si pas de carte correspondante
    $carte->Num_Carte = "Aucune carte trouvé";
}

?>

<center>
    <h1>&mdash; Suppression de la carte : <?= $carte->Num_Carte; ?> &mdash;</h1>
</center>