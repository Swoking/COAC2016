<?php
use Coac\Table\Promos;
use \Coac\Table\Log;


if ( !empty($_POST) ) {
    Promos::add( $_POST['entree'], $_POST['sortie'], $_POST['name'], $_POST['filiere'] );

    Log::promos_add($_POST['name']);
}
?>
<center>

    <h1>&mdash; Ajout d'une promo &mdash;</h1>

    <form name='add' action='?p=promos.add' method='POST'>
        <table>
            <tr>
                <td>Nom de la promo :</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Nom de la filière :</td>
                <td><input type="text" name="filiere"></td>
            </tr>
            <tr>
                <td>Année d'entrée :</td>
                <td><input type="text" name="entree"></td>
            </tr>
            <tr>
                <td>Année de sortie :</td>
                <td><input type="text" name="sortie"></td>
            </tr>
        </table>
        <br>
        <input type="Submit" value="Envoyer" name="btn_envoyer">
    </form>
    
</center>
