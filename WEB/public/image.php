<?php
require '../app/Database.php';

$id_files=$_GET["id"];

$db = new \Coac\Database();

$res = $db->query("SELECT image, id FROM Etudiant WHERE id = ?", [$id_files])->fetch();

header('Content-type: image/jpg');
echo $res->image;
?>
