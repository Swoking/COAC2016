<?php
use Coac\Table\Log;
use Coac\Table\Eleve;
use Coac\Table\Promos;
use Coac\Table\Html;

?>
<center>

    <h1>&mdash; Liste des logs &mdash;</h1>
    
    <form method='GET' action="">
        <input type="hidden" name="p" value="log.list">
        <select name='idEleve'>
            <option value='Tous'><?= 'Tous' ?></option>";

            <?php if ( !isset($_GET['idClasse']) | $_GET['idClasse'] == 'Tous' ) : ?> 
                <?php foreach (Log::select() as $data) : ?>
                 <option value='<?= $data->id ?>'><?= $data->Nom ?> <?= $data->Prenom ?></option>";
                <?php endforeach; ?>


            <?php else : ?>
                <?php foreach (Log::selectEleveWithClasse($_GET['idClasse']) as $data) : ?>
                 <option value='<?= $data->id ?>'><?= $data->Nom ?> <?= $data->Prenom ?></option>";
                <?php endforeach; ?>

            <?php endif; ?>
            </select>
        <input type="Submit" value="Selectionner">
    </form>



    <form method='GET' action="">
        <input type="hidden" name="p" value="log.list">
        <select name='idClasse'>
            <option value='Tous'><?= 'Toutes' ?></option>";
            <?php foreach (Log::select() as $data) : ?>
                <option value='<?= $data->id_Promo ?>'><?= $data->Nom_Promo ?></option>";
                <?php endforeach; ?>
            </select>
        <input type="Submit" value="Selectionner">
    </form>
            
        
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Classe</td>
                <td>Date</td>
            </tr>
        </thead>
        <tbody>

            <?php if ( !isset($_GET['idEleve']) & !isset($_GET['idClasse']) | $_GET['idEleve'] == 'Tous' | $_GET['idClasse'] == 'Tous') : ?> 
                <?php $logs = Log::getAll(); ?>
            <?php elseif ( ($_GET['idClasse']) != NULL) : ?>
                <?php $logs = Log::getAllWithIdClasse($_GET['idClasse']); ?>
            <?php else : ?>
                <?php $logs = Log::getAllWithId($_GET['idEleve']) ?>
            <?php endif; ?>

                <?php foreach($logs as $data): ?>
                    <tr>
                        <td><?= $data->Nom ?></td>
                        <td><?= $data->Prenom ?></td>
                        <td><?= $data->Classe ?></td>
                        <td><?= $data->Date ?></td>
                        <td><?= $data->Num_Carte ?></td>
                        
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

</center>
