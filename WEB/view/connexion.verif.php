<?php

use Coac\Table\Connexion;



if ( !empty($_POST) ) {


    if(($_POST['identifiant']) != NULL && ($_POST['mdp']) != NULL){

        $verif = Connexion::verif( $_POST['identifiant'])->fetch();

        if($verif){
            if($verif->Mdp == sha1($_POST['mdp'])){

        session_start ();
        $_SESSION['login'] = $_POST['identifiant'];
        $_SESSION['pwd'] = $_POST['mdp'];

        header ('location: ?p=home');
        exit(); 

            }else{
       ?> <center> <?php   echo "Erreur d'identification"; ?> </center> <?php
            }
        }else{
       ?> <center> <?php   echo "Erreur d'identification"; ?> </center> <?php
        }
    }else{
       ?> <center> <?php   echo "Veuillez remplir les deux champs"; ?> </center> <?php
    }
}

?>

<center>


    <h1>&mdash; Connexion au site &mdash;</h1>


    <form name='add' action='?p=connexion.verif' method='POST'>

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
