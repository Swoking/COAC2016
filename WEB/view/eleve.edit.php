<?php
use \Coac\Table\Promos;
use \Coac\Table\Lycee;
use \Coac\Table\Eleve;
use \Coac\Table\Carte;



var_dump($id);

if ( isset($_GET['id']) | isset($_POST['id']) ) {

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['id'])) $id = $_POST['id'];



    if ( !empty($_POST) ) {
        var_dump($_POST);

        Eleve::edit($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['classe'], $_POST['lycee'], $_POST['add'],$_POST['ville'], $_POST['cp'], 
                    $_POST['email'], $_POST['sexe'], $_POST['date_naiss']);

        Carte::edit($_POST['id'], $_POST['num_carte'], $_POST['etat']);
    }

    $eleve = Eleve::getFromId($_GET['id']);
    $eleve = $eleve[0];

    $carte = Carte::getFromId($_GET['id']);
    $carte = $carte[0];


} else {
    header("Location: http://" . PUBLIC_DIR . "/?p=eleve.list");
}

?>
<center>

    <h1>&mdash; Modifier les données de l'élève &mdash;</h1>

    <form name='add' action='?p=eleve.edit' method='POST'>
    <input type="hidden" name="id" value="<?= $id ?>" >
        <table>
            <tr>
                <td><img src="image.php?id=<?= $_GET['id'] ?>"></td>
                <td>

                    <table>
                        <tr>
                            <td>Nom :</td>
                            <td><input type="text" name="nom" value="<?= $eleve->Nom ?>"></td>
                        </tr>
                        <tr>
                            <td>Prénom :</td>
                            <td><input type="text" name="prenom" value="<?= $eleve->Prenom ?>"></td>
                        </tr>
                        <tr>
                            <td>Classe :</td>
                            <td>
                                <select name="classe" id="classe">
                                    <?php foreach (Promos::getAll() as $data) : ?>
                                   
                                        <option value='<?= $data->id ?>' <?php if($eleve->id_Promo == $data->id) echo "selected"; ?> > <?= $data->Nom ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Lycee :</td>
                            <td>
                                <select name="lycee" id="lycee">
                                    <?php foreach (Lycee::getAll() as $data) : ?>
                                        <option value='<?= $data->id ?>' <?php if($eleve->id_Lycee == $data->id) echo "selected"; ?> > <?= $data->Lycee ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Adresse :</td>
                            <td><input type="text" name="add" value="<?= $eleve->Adresse ?>"></td>
                        </tr>
                        <tr>
                            <td>Ville :</td>
                            <td><input type="text" name="ville" value="<?= $eleve->Ville ?>"></td>
                        </tr>
                        <tr>
                            <td>Code Postal :</td>
                            <td><input type="number" name="cp" value="<?= $eleve->CP ?>"></td>
                        </tr>
                        <tr>
                            <td>Adresse mail :</td>
                            <td><input type="text" name="email" value="<?= $eleve->Email ?>"></td>
                        </tr>
                        <tr>
                            <td>Sexe :</td>
                            <td>
                                <input type="radio" name="sexe" value="Masculin" <?php if($eleve->Sexe == "Masculin") echo "checked" ?>>Homme</input><br />
                                <input type="radio" name="sexe" value="Feminin" <?php if($eleve->Sexe == "Feminin") echo "checked" ?>>Femme</input>
                            </td>
                        </tr>
                        <tr>
                            <td>Date de naissance :</td>
                            <td><input type="text" name="date_naiss" value="<?= $eleve->Date_Naissance ?>"></td>
                        </tr>
                        <tr>
                            <td>Numéro de carte :</td> 
<?php                       if(!isset($carte->Num_Carte)){
?>                              <td><input type="text" name="num_carte" value=""></td>
<?php                       } else {
?>                              <td><input type="text" name="num_carte" value="<?= $carte->Num_Carte ?>"></td>
<?php                       }
?>
                        </tr>
                        <tr>
                            <td>Etat de la carte :</td>
<?php                            if(!isset($carte->Etat)){
?>                          <td>
                                <input type="radio" name="etat" value="Autorise" >Autorise</input><br />
                                <input type="radio" name="etat" value="Non_autorise" >Non_autorise</input><br />
                                <input type="radio" name="etat" value="Perdu" >Perdu</input>
                            </td>
<?php                        } else {
?>                            <td>
                                <input type="radio" name="etat" value="Autorise" <?php if($carte->Etat == "Autorise") echo "checked" ?>>Autorise</input><br />
                                <input type="radio" name="etat" value="Non_autorise" <?php if($carte->Etat == "Non_autorise") echo "checked" ?>>Non_autorise</input><br />
                                <input type="radio" name="etat" value="Perdu" <?php if($carte->Etat == "Perdu") echo "checked" ?>>Perdu</input>
                            </td> 
<?php                            }
?>
                        </tr>
                    </table>
                    <input type="Submit" value="Envoyer" name="eleve_envoyer">
                <td>
        <br>
    </form>
    
</center>