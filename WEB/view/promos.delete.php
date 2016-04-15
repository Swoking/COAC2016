<?php
use \Coac\Table\Promos;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

$find = false; // controle si une classe est trouvée
$promos = NULL;

foreach( Promos::getAll() as $data ) { 
    if ($data->id == $_GET['id']) { // test toutes les classes 
        $find = true; // si classe trouvée : controle mis sur vrai (trouvée)
        $promos = $data; // copie de la classe dans une variable
        Promos::delete( $data->id );// supression de la classe
        Log::promos_delete( $data->id );
        Log::carte_rendue( $data->id );

        break;
    }
}

if ( !$find ) { // si pas de classe corespondante
    $promos->Nom = "Aucune classe trouvée";
    $promos->Entree = "";
    $promos->Sortie = "";
}

?>

<center>
    <h1>&mdash; Suppression de la Promos <?= $promos->Nom; ?> <?= $promos->Entree; ?> <?php if($find)echo'/'; ?><?= $promos->Sortie; ?> &mdash;</h1>
</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
    exit();
}
?>