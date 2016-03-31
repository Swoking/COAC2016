<?php
use \Coac\Table\Salle;
use \Coac\Table\Log;


$find = false; // controle si une salle est trouvée
$salle = NULL;

foreach( Salle::getAll() as $data ) { 
    if ($data->id == $_GET['id']) { // test toutes les salles 
        $find = true; // si salle trouvée : controle mis sur vrai (trouvée)
        $salle = $data; // copie de la salle dans une variable
        Salle::delete( $data->id );// supression de la salle
        Log::salle_delete( $data->id );

        break;
    }
}

if ( !$find ) { // si pas de salle corespondante
    $salle->Nom = "Aucune salle trouvée";
    $salle->Entree = "";
    $salle->Sortie = "";
}

?>

<center>
    <h1>&mdash; Suppression de la salle <?= $salle->Nom; ?> &mdash;</h1>
</center>