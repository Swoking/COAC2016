<?php
use Coac\Table\Promos;
use Coac\Table\Eleve;
use Coac\Table\Carte;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

if ( isset($_GET['classe']) ) {$id = $_GET['classe']; }
else { $id = null; }
?>
<center>


    <h1>&mdash; Liste des cartes &mdash;</h1>

    <button onclick="self.location.href='?p=carte.add'">Ajouter une carte</button>

</br></br>


    <form method='GET' action="">
        <input type="hidden" name="p" value="carte.list">
        <select name='classe'>
            <?php if ($id == null) echo "<option name='classe' value='0'"; if($id == null) echo 'selected'; if ($id == null) echo ">Choisir une classe</option>";?>
            <?php foreach (Promos::getAll() as $data) : ?>
                <option value='<?= $data->id ?>' <?php if($id == $data->id) echo "selected"; ?> > <?= $data->Nom ?> </option>;
            <?php endforeach; ?>
        </select>
        <input type="Submit" value="Selectionner">
    </form>


    <table>
<?php foreach (Carte::getAll($id) as $data) : ?>

        <tr>
            <td><?= $data->Nom ?></td>
            <td><?= $data->Prenom ?></td>
            <td><?= $data->Num_Carte ?></td>
            <td><?= $data->Etat ?></td>

            <td>
                <?= Carte::carteButton( $data->id ) ?>
        <?php        if($data->Etat != "Autorise"){ ?>
                    <?= Carte::autoriseButton( $data->id, $data->id_Carte ) ?>
        <?php        }  ?>

        <?php        if($data->Etat != "Non_autorise"){ ?>
                    <?= Carte::deleteButton( $data->id, $data->id_Carte ) ?>
        <?php        }  ?>

        <?php        if($data->Etat != "Perdu"){ ?>
                    <?= Carte::perduButton( $data->id, $data->id_Carte ) ?>
        <?php        }  ?>

            </td>
        </tr>
<?php endforeach; ?>  


    </table>


</center>
<?php
}else{
    header ('location: ?p=connexion.verif');
}
?>