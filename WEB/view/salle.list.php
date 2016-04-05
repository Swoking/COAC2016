<?php
use Coac\Table\Salle;
?>
<center>

    <h1>&mdash; Liste des salles &mdash;</h1>
    
    <button onclick="self.location.href='?p=salle.add'">Nouvelle salle</button>

    <table>
        
            <?php foreach(Salle::getAll() as $data): ?>

                <tr>
                    <td><?= $data->Nom ?></td>
                    <td>
                        <?= Salle::editButton( $data->id ) ?>
                        <?= Salle::deleteButton( $data->id, $data->Nom ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    
    </table>
</center>
