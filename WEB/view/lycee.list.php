<?php
use Coac\Table\Lycee;
use Coac\Table\Html;
?>
<center>

    <h1>&mdash; Liste des lycées &mdash;</h1>
    
    <button onclick="self.location.href='?p=lycee.add'">Nouveau lycée</button>

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
                        <?= Lycee::deleteButton( $data->id ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</center>
