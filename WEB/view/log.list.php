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

            <?php if ( !isset($_GET['idClasse']) | $_GET['idClasse'] == 'Tous' | $_GET['idClasse'] == NULL) : ?> 
                <?php foreach (Log::select() as $data) : ?>
                 <option value='<?= $data->id ?>'><?= $data->Nom ?> <?= $data->Prenom ?></option>";
                <?php endforeach; ?>


            <?php else : ?>
                <?php foreach (Log::selectEleveWithClasse($_GET['idClasse']) as $data) : ?>
                 <option value='<?= $data->id ?>'><?= $data->Nom ?> <?= $data->Prenom ?></option>";
                <?php endforeach; ?>

            <?php endif; ?>
            </select>

            <input type="hidden" name="idClasse" value="<?= NULL ?>" >

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

            <input type="hidden" name="idEleve" value="<?= NULL ?>" >


        <input type="Submit" value="Selectionner">
    </form>
            
        
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Classe</td>
                <td>Date</td>
                <td>Numero de carte</td>
                <td>Evénement</td>
            </tr>
        </thead>

<?php
        var_dump($_GET['idEleve']);
        var_dump($_GET['idClasse']);
?>

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
                        <td><?= $data->Nom_Etudiant ?></td>
                        <td><?= $data->Prenom ?></td>
                        <td><?= $data->Nom_Promo ?></td>
                        <td><?= $data->Date ?></td>

<?php                   if(!isset($data->Num_Carte)){
?>                          <td><?= '' ?></td>

<?php                   } else {
?> 
                        <td><?= $data->Num_Carte ?></td>
<?php                   }
?>
                        <td><?= $data->Evenement ?></td>
                        
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

</center>
