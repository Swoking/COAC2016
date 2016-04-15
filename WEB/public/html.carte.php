<?php
include_once '../app/Database.php';
$db = new \Coac\Database();
$info = $db->query("SELECT `Etudiant`.`id`, `Etudiant`.`Nom`, `Etudiant`.`Prenom`, `Promo`.`Entree`, `Promo`.`Sortie`, `Etudiant`.`Date_Naissance`, `Promo`.`Filiere` 
		                    FROM `Etudiant`,`Promo` 
		                    WHERE `Etudiant`.`id_Promo` = `Promo`.`id` AND `Etudiant`.`id` = ?", [$_GET['id']])->fetch();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="carte-body">
			<img class="carte-bg" src="image.php?id=<?= $_GET['id'] ?>">
			<div class="carte-nom"><?= $info->Nom ?> <?= $info->Prenom ?></div>
			<div class="carte-validite"><?= $info->Entree ?> <?= $info->Sortie ?></div>
			<div class="carte-naissanse"><?= $info->Date_Naissance ?></div>
			<div class="carte-filiere"><?= $info->Filiere ?></div>
    		<img class="carte-tempon" src="img/llf_tampon_alpha.png">
		</div>
	</body>
</html>
