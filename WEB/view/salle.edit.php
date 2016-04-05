<?php
use \Coac\Table\Salle;
use \Coac\Table\Log;


if ( isset($_GET['id']) | isset($_POST['id']) ) {

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['id'])) $id = $_POST['id'];

    if ( !empty($_POST) ) {

        $salle = Salle::getFromId($id)->fetch();


        Salle::edit($id, $_POST['name']);

        Log::promos_edit($salle->Nom, $_POST['name']);
    }

    $salle = Salle::getFromId($id)->fetch();
} else {
   header("Location: http://" . PUBLIC_DIR . "/?p=salle.list");
}
?>
<center>

    <h1>&mdash; Modification d'une salle &mdash;</h1>

    <form name='add' action='?p=salle.edit' method='POST'>
        <input type="hidden" name="id" value="<?= $id ?>" >
        <table>
            <tr>
                <td>Nom de la salle :</td>
                <td><input type="text" name="name" value="<?= $salle->Nom ?>"></td>
            </tr>
        </table>
        <br>
        <input type="Submit" value="Envoyer" name="btn_envoyer">
    </form>
    
</center>