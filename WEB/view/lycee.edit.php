<?php
use \Coac\Table\Lycee;

if ( isset($_GET['id']) | isset($_POST['id']) ) {

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['id'])) $id = $_POST['id'];

    if ( !empty($_POST) ) {
        var_dump($_POST);





        Lycee::edit($_POST['id'], $_POST['lycee']);
    }

    $lycee = $db->query('SELECT * FROM Lycee WHERE id = ' . $_GET['id'], '\Coac\Table\Lycee');
    $lycee = $lycee[0];
} else {
   header("Location: http://" . PUBLIC_DIR . "/?p=lycee.list");
}
?>
<center>

    <h1>&mdash; Modification d'un lycee &mdash;</h1>

    <form name='add' action='?p=lycee.edit' method='POST'>
        <input type="hidden" name="id" value="<?= $id ?>" >
        <table>
            <tr>
                <td>Nom du lycee :</td>
                <td><input type="text" name="lycee" value="<?= $lycee->Lycee ?>"></td>
            </tr>
        </table>
        <br>
        <input type="Submit" value="Envoyer" name="btn_envoyer">
    </form>
    
</center>