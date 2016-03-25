<?php
use \Coac\Table\Promos;

if ( isset($_GET['id']) | isset($_POST['id']) ) {

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['id'])) $id = $_POST['id'];

    if ( !empty($_POST) ) {
        var_dump($_POST);





        Promos::edit($_POST['id'], $_POST['entree'], $_POST['sortie'], $_POST['name'], $_POST['filiere']);
    }

    $classe = Promos::getFromId($_GET['id']);
    $classe = $classe[0];
} else {
   header("Location: http://" . PUBLIC_DIR . "/?p=promos.list");
}
?>
<center>

    <h1>&mdash; Modification d'une promo &mdash;</h1>

    <form name='add' action='?p=promos.edit' method='POST'>
        <input type="hidden" name="id" value="<?= $id ?>" >
        <table>
            <tr>
                <td>Nom de la promo :</td>
                <td><input type="text" name="name" value="<?= $classe->Nom ?>"></td>
            </tr>
            <tr>
                <td>Nom de la filière :</td>
                <td><input type="text" name="filiere" value="<?= $classe->Filiere ?>"></td>
            </tr>
            <tr>
                <td>Année d'entrée :</td>
                <td><input type="text" name="entree" value="<?= $classe->Entree ?>"></td>
            </tr>
            <tr>
                <td>Année de sortie :</td>
                <td><input type="text" name="sortie" value="<?= $classe->Sortie ?>"></td>
            </tr>
        </table>
        <br>
        <input type="Submit" value="Envoyer" name="btn_envoyer">
    </form>
    
</center>