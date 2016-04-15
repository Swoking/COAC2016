<?php

use Coac\Table\Connexion;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){


if ( !empty($_POST) ) {

    var_dump($_POST);

    foreach (Connexion::getAll() as $data) : ?>
        <?php if($data->Identifiant == $_POST['identifiant']){
                $i = 1;
        } ?> 
    <?php endforeach;

    if($i == 1){

        echo "Identifiant déjà utilisé";

    }else{

        $test_add = Connexion::add( $_POST['identifiant'], sha1($_POST['mdp']));

        if($test_add == true){ ?> Ajout du compte réussi <?php }
        else{ ?> L'ajout du compte a échoué <?php }
    }
}

?>

<center>


    <h1>&mdash; Ajouter un compte &mdash;</h1>


    <form name='add' action='?p=connexion.add' method='POST'>

        <table>

            <tr>

                <td>Identifiant :</td>

                <td><input type="text" name="identifiant"></td>

            </tr>

            <tr>

                <td>Mot de passe :</td>

                <td><input type="password" name="mdp"></td>

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