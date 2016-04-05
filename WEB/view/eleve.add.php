<?php
use \Coac\Table\Promos;
use \Coac\Table\Eleve;
use \Coac\Table\Lycee;
use \Coac\Table\Log;
use \Coac\Table\Carte;



if ( !empty($_POST) ) {
    $test_eleve = Eleve::add($_POST['nom'], $_POST['prenom'], $_POST['classe'], $_POST['lycee'], $_POST['add'], $_POST['ville'], $_POST['cp'],
    $_POST['email'], $_POST['sexe'], $_POST['date_naiss']);

    $id = Eleve::getIdEleve($_POST['nom'], $_POST['prenom'], $_POST['classe'])->fetch();

    $test_carte = Carte::add($id->id, $_POST['num_carte'], $_POST['etat']); 

    Log::eleve_add($id->id, $_POST['nom'], $_POST['prenom'], $_POST['classe'], $_POST['num_carte']);

if($test_eleve == true){ ?> Ajout de l'élève réussi <?php }
else{ ?> L'ajout de l'élève a échoué <?php }

if($test_carte == true){ ?> Ajout de la carte réussi <?php }
else{ ?> L'ajout de la carte a échoué <?php }

}

?>

<center>

    <h1>&mdash; Ajouter un élève &mdash;</h1>

    <form name='add' action='#' method='POST'>

        <table>
            <tr>
                <td></td>
                <td>

                    <table>
                        <tr>
                            <td>Nom :</td>
                            <td><input type="text" name="nom" value=""></td>
                        </tr>
                        <tr>
                            <td>Prénom :</td>
                            <td><input type="text" name="prenom" value=""></td>
                        </tr>
                        <tr>
                            <td>Classe :</td>
                            <td>
                                <select name="classe" id="classe">
                                    <?php foreach (Promos::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Lycee :</td>
                            <td>
                                <select name="lycee" id="lycee">
                                    <?php foreach (Lycee::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Lycee?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Adresse :</td>
                            <td><input type="text" name="add" value=""></td>
                        </tr>
                        <tr>
                            <td>Ville :</td>
                            <td><input type="text" name="ville" value=""></td>
                        </tr>
                        <tr>
                            <td>Code Postal :</td>
                            <td><input type="number" name="cp" value=""></td>
                        </tr>
                        <tr>
                            <td>Adresse mail :</td>
                            <td><input type="text" name="email" value=""></td>
                        </tr>
                        <tr>
                            <td>Sexe :</td>
                            <td>
                                <input type="radio" name="sexe" value="Masculin" >Homme</input><br />
                                <input type="radio" name="sexe" value="Feminin" >Femme</input>
                            </td>
                        </tr>
                        <tr>
                            <td>Date de naissance (aaaa/mm/jj) :</td>
                            <td><input type="text" name="date_naiss" value=""></td>
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
                <td>
        <br>
    </form>
    
</center>