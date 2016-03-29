<?php
use \Coac\Table\Lycee;
use \Coac\Table\Log;

$find = false; // controle si une classe est trouvée
$lycee = NULL;

foreach( Lycee::getAll() as $data ) { 
    if ($data->id == $_GET['id']) { // test tous les lycees 
        $find = true; // si lycee trouvé : controle mis sur vrai (trouvée)
        $lycee = $data; // copie du lycee dans une variable
        
        Lycee::delete( $data->id );// supression du lycee
        Log::lycee_delete($lycee->Lycee);

        break;
    }
}

if ( !$find ) { // si pas de lycee corespondant
    $lycee->Lycee = "Aucun lycee trouvée";
}

?>

<center>
    <h1>&mdash; Suppression du Lycee <?= $lycee->Lycee; ?> <?php if($find)echo'/'; ?> &mdash;</h1>
</center>