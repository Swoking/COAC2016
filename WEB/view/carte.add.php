<?php
use \Coac\Table\Promos;
use \Coac\Table\Eleve;
use \Coac\Table\Lycee;


if ( !empty($_POST) ) {
    var_dump($_POST);

    Carte::add($_POST['eleve'], $_POST['num_carte'], $_POST['etat']); 

?>

<center>

    <h1>&mdash; Ajouter une carte &mdash;</h1>

    <form name='add' action='#' method='POST'>

        <table>
            <tr>
                <td></td>
                <td>

                    <table>

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
                            <td>Eleve :</td>
                            <td>
                                <select name="eleve" id="eleve">
                           <?php if ( !isset($_GET['classe']) ) : ?> 
                                    <?php foreach (Eleve::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom?> <?= $data->Prenom ?></option>
                                    <?php endforeach; ?>

                                    <?php else : ?>
                                    <?php foreach (Eleve::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' > <?= $data->Nom?> <?= $data->Prenom ?></option>
                                    <?php endforeach; ?>
           
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
                <td>
        <br>
    </form>
    
</center>