<?php
use Coac\Table\Lycee;
use \Coac\Table\Log;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

if ( !empty($_POST) ) {
    Lycee::add($_POST['lycee']);
    Log::lycee_add($_POST['lycee']);
}
?>
<center>

    <h1>&mdash; Ajout d'un lycée &mdash;</h1>

    <form name='add' action='?p=lycee.add' method='POST'>
        <table>
            <tr>
                <td>Nom du lycée :</td>
                <td><input type="text" name="lycee"></td>
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