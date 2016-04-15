<?php
session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){
?>

<center>
    <h1>&mdash;&nbsp;Accueil&nbsp;&mdash;</h1>

    <button onclick="self.location.href='?p=connexion.add'">Ajouter un compte</button>

    <pre>
    </pre>
</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
}
?>