<?php
use \Coac\Table\Carte;
use \Coac\Table\Eleve;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

$find = false; // controle si une carte est trouvé
$carte = NULL;

$id_Carte = $_GET['id'];

$etat = $_GET['etat'];

if($etat == "desactive"){ 		$modif_etat = "Perdu" ;	$affiche = "est désactivée";}
if($etat == "autorise"){ 		$modif_etat = "Autorise" ;	$affiche = "est autorisée";}
if($etat == "non_autorise"){ 	$modif_etat = "Non_autorise" ;	$affiche = "n'est pas autorisée";}



foreach( Carte::getFromIdCarte($id_Carte) as $data ) { 
    $id = $data->id ;
    if ($id == $id_Carte) { // test toutes les cartes 
        $find = true; // si carte trouvé : controle mis sur vrai (trouvé)
        $carte = $data->Num_Carte; // copie de la carte dans une variable
        Carte::modif_etat( $id, $modif_etat ); //désactivation de la carte

        $eleve = Eleve::getFromId($data->id_Etudiant)->fetch();
        $id = $eleve->id;
        $prenom = $eleve->Prenom;
        $nom = $eleve->Nom;
        
        Log::carte_statut($data->Num_Carte, $prenom, $nom);
        break;
    }
}

?>

<center>
    <h1>&mdash; La carte de <?= $prenom." ".$nom." ".$affiche; ?>  &mdash;</h1>
</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
}
?>