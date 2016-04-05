<?php
use Coac\Table\Promos;
use Coac\Table\Eleve;
use Coac\Table\Carte;

if ( isset($_GET['classe']) ) {$id = $_GET['classe']; }
else { $id = null; }
?>
<center>


    <h1>&mdash; Liste des élèves &mdash;</h1>


    <form method='GET' action="">
        <input type="hidden" name="p" value="eleve.list">
        <select name='classe'>
            <?php if ($id == null) echo "<option name='classe' value='0'"; if($id == null) echo 'selected'; if ($id == null) echo ">Choisir une classe</option>";?>
            <?php foreach (Promos::getAll() as $data) : ?>
                <option value='<?= $data->id ?>' <?php if($id == $data->id) echo "selected"; ?> > <?= $data->Nom ?> </option>;
            <?php endforeach; ?>
        </select>
        <input type="Submit" value="Selectionner">
    </form>




    <table>
<?php foreach (Eleve::getAll($id) as $data) : ?>
        <tr>
            <td><?= $data->Nom ?></td>
            <td><?= $data->Prenom ?></td>
            <td>
                        <?= Carte::carteButton( $data->id) ?>
                        <?= Eleve::editButton( $data->id) ?>
                        <?= Eleve::deleteButton( $data->id ) ?>
            </td>
        </tr>
<?php endforeach; ?>  


    </table>



</center>
