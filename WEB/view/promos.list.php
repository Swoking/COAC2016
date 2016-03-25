<?php
use Coac\Table\Promos;
use Coac\Table\Html;
?>
<center>

    <h1>&mdash; Liste des classes &mdash;</h1>
    
    <button onclick="self.location.href='?p=promos.add'">Nouvelle classe</button>

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
