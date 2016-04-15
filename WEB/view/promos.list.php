<?php
use Coac\Table\Promos;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

?>
<center>

    <h1>&mdash; Liste des classes &mdash;</h1>
    
    <button onclick="self.location.href='?p=promos.add'">Ajouter une classe</button>

    </br></br>


    <table>
        <thead>
            <tr>
                <td>Année</td>
                <td>Classe</td>
                <td>Filière</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach(Promos::getAll() as $data): ?>
                <tr>
                    <td><?= $data->Entree ?> / <?= $data->Sortie ?></td>
                    <td><?= $data->Nom ?></td>
                    <td><?= $data->Filiere ?></td>
                    <td>
                        <?= Promos::editButton( $data->id ) ?>
                        <?= Promos::deleteButton( $data->id ) ?>
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