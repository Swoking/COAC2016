<?php
/*header('Content-Type: image/jpg');
$id = htmlspecialchars($_GET['id']);

if($req = $db->query("SELECT Images FROM Etudiants WHERE id=$id", 'Coac\Table\Image'))
{
    $image = mysql_fetch_array($req);
    die($image);
    echo $image['Images'];
}*/


require '../app/Database.php';
require '../app/Table/Eleve.php';
header('Content-Type: image/jpg');
$id = htmlspecialchars($_GET['id']);
$db = new \Coac\Database('COAC');
foreach ($req = $db->query("SELECT Image FROM Etudiant WHERE id=$id", 'Coac\Table\Eleve') as $image) {
    echo $image[0]->Image;
}
