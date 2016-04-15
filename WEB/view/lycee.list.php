<?php
use Coac\Table\Lycee;
use Coac\Table\Html;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

?>
<center>

    <h1>&mdash; Liste des lycées &mdash;</h1>
    
    <button onclick="self.location.href='?p=lycee.add'">Ajouter un lycée</button>

    </br></br>

    <table>
        <thead>
            <tr>
                <td>Lycée</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach(Lycee::getAll() as $data): ?>
                <tr>
                    <td><?= $data->Lycee ?></td>
                    <td>
                        <?= Lycee::editButton( $data->id ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
    exit();
}
?>