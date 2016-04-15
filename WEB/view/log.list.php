<?php
use Coac\Table\Log;
use Coac\Table\Eleve;
use Coac\Table\Promos;
use Coac\Table\Html;

session_start ();
if(isset($_SESSION['pwd']) && isset($_SESSION['pwd'])){

?>
<center>

    <h1>&mdash; Liste des logs &mdash;</h1>
    
    <form method='GET' action="">
        <input type="hidden" name="p" value="log.list">

        <input type="text" name="rechercher" value="">
        <input type="Submit" value="Rechercher">
        
    </form>
  
    </br></br>

    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>Evénement</td>
            </tr>
        </thead>



        <tbody>

            <?php if ( !isset($_GET['rechercher'])) : ?> 
                <?php $logs = Log::getAll(); ?>
            <?php else : ?>
                <?php $logs = Log::getAllWithRechercher($_GET['rechercher']) ?>
            <?php endif; ?>

                <?php foreach($logs as $data): ?>
                    <tr>
                        <td><?= $data->Date ?></td>

<?php /*                  if(!isset($data->Num_Carte)){
?>                          <td><?= '' ?></td>

<?php                   } else {
?> 
                        <td><?= $data->Num_Carte ?></td>
<?php                   }*/
?>
                        <td><?= $data->Evenement ?></td>
                        
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