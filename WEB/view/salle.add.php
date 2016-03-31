<?php
use Coac\Table\Salle;
use \Coac\Table\Log;


if ( !empty($_POST) ) {
    var_dump($_POST);
    Salle::add($_POST['name']);

    Log::salle_add($_POST['name']);
}
?>
<center>

    <h1>&mdash; Ajout d'une salle &mdash;</h1>

    <form name='add' action='?p=salle.add' method='POST'>
        <table>
            <tr>
                <td>Nom de la salle :</td>
                <td><input type="text" name="name"></td>
            </tr>
        </table>
        <br>
        <input type="Submit" value="Envoyer" name="btn_envoyer">
    </form>
    
</center>
