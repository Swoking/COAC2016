<?php
use \Coac\Table\Promos;
use \Coac\Table\Eleve;
use \Coac\Table\Lycee;
use \Coac\Table\Carte;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

if ( !empty($_POST) ) {


    $test_carte = Carte::add($_POST['eleve_id'], $_POST['num_carte'], $_POST['etat']);
    Log::carte_add($_POST['eleve_id'], $_POST['num_carte']);
?>
<center>
<?php

if($test_carte == true){ ?> Ajout de la carte réussi <?php }
else{ ?> L'ajout de la carte a échoué <?php }

?>
</center>
<?php

}

?>

<center>

    <h1>&mdash; Ajouter une carte &mdash;</h1>

    <form action='' method='GET'>
                <input type="hidden" name="p" value="carte.add">


    <table>

                        <tr>
                            <td>Choisir un élève parmi une classe :</td>
                            <td>
                                <select name="classe" id="classe">
                                    <?php foreach (Promos::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
    </table>

              <input type="Submit" value="Sélectionner" >              

    </form>
    <br/>
    <br/>


    <table>

    <form name='add' action='#' method='POST'>

  
                        <tr>
                            <td>Eleve :</td>
                            <td>
                                <select name="eleve_id" id="eleve_id">
                           <?php if ( !isset($_GET['classe']) ) : ?> 
                                    <?php foreach (Eleve::getAllNoId() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom ?> <?= $data->Prenom ?></option>
                                    <?php endforeach; ?>

                                    <?php else : ?>
                                    <?php foreach (Eleve::getAll($_GET['classe']) as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom ?> <?= $data->Prenom ?></option>
                                    <?php endforeach; ?>
                            <?php endif; ?>           
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Numéro de carte :</td>
                            <td><input type="text" name="num_carte" value=""></td>
                        </tr>
                        <tr>
                            <td>Etat de la carte :</td>
                            <td>
                                <input type="radio" name="etat" value="Autorise" >Autorise</input><br />
                                <input type="radio" name="etat" value="Non_autorise" >Non autorise</input><br />
                                <input type="radio" name="etat" value="Perdu" >Perdu</input>
                            </td>
                        </tr>
                    </table>
                    <input type="Submit" value="Envoyer" name="eleve_envoyer">
               
    </form>
    
</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
}
?>