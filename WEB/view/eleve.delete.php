<?php
use \Coac\Table\Eleve;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

$find = false; // controle si un élève est trouvé
$eleve = NULL;
$id = $_GET['id'];

foreach ( Eleve::getFromId($_GET['id']) as $data ) {
	$eleve = $data;
	$find = true ;
    Eleve::delete( $data->id );// supression de l'élève
    Log::eleve_delete($data->Nom, $data->Prenom);
}        

if ( !$find ) { // si pas d'élève corespondant
    $eleve->Nom = "Impossible, l'élève n'existe pas";
    $eleve->Prenom = "";
}

?>

<center>
    <h1>&mdash; Suppression de l'élève <?= $eleve->Nom; ?> <?= $eleve->Prenom; ?>&mdash;</h1>
</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
    exit();
}
?>