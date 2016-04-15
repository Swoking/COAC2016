<?php
use \Coac\Table\Lycee;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

if ( isset($_GET['id']) | isset($_POST['id']) ) {

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_POST['id'])) $id = $_POST['id'];

    if ( !empty($_POST) ) {
        $lycee = Lycee::getFromId($id)->fetch();


        Lycee::edit($id, $_POST['lycee']);
        Log::lycee_edit($lycee->Lycee, $_POST['lycee']);

    }

    $lycee = Lycee::getFromId($id)->fetch();
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
<?php
}else{
    header ('location: ?p=connexion.verif');
    exit();
}
?>