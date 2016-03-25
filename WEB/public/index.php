<?php

define('SERVER_ADD', "192.168.1.200");
define('ROOT_DIR', SERVER_ADD."/COAC2016");
define('VIEW_DIR', ROOT_DIR."/view");
define('PUBLIC_DIR', ROOT_DIR."/public");

ini_set('display_errors','on');
error_reporting(E_ALL);

/**
 * Chargement de l'autoloader
 */
require '../app/Autoloader.php';
Coac\Autoloader::register();


// Test sur la page choisie en paramétre dans l'URL
if ( isset($_GET['p']) ) { // $_GET['p'] = page en paramétre de l'URL
	$p = $_GET['p']; // $p = page
} else {
	$p = 'home';
}

/**
 * Connexion a la BDD
 */
$db = new Coac\Database('COAC2016'); 

/**
 * Route disponible et affichage de la page
 */
ob_start();
if ( $p === 'home' ) {
	require '../view/home.php';
} else if ( $p === 'eleve.list')	{ require '../view/eleve.list.php';
} else if ( $p === 'eleve.edit')	{ require '../view/eleve.edit.php';
} else if ( $p === 'eleve.add')		{ require '../view/eleve.add.php';
} else if ( $p === 'eleve.delete')	{ require '../view/eleve.delete.php';

} else if ( $p === 'promos.list')	{ require '../view/promos.list.php';
} else if ( $p === 'promos.edit')	{ require '../view/promos.edit.php';
} else if ( $p === 'promos.delete')	{ require '../view/promos.delete.php';
} else if ( $p === 'promos.add')	{ require '../view/promos.add.php';

} else if ( $p === 'carte.list')	{ require '../view/carte.list.php';
} else if ( $p === 'carte.statut')	{ require '../view/carte.statut.php';
} else if ( $p === 'carte.add')		{ require '../view/carte.add.php';
} else if ( $p === 'carte.view')	{ require '../view/carte.view.php';

} else if ( $p === 'lycee.list')	{ require '../view/lycee.list.php';
} else if ( $p === 'lycee.delete')	{ require '../view/lycee.delete.php';
} else if ( $p === 'lycee.add')		{ require '../view/lycee.add.php';
} else if ( $p === 'lycee.edit')	{ require '../view/lycee.edit.php';


} else if ( $p === 'pdf.carte')		{ require '../view/pdf.carte.php';

} else if ( $p === 'log.list')		{ require '../view/log.list.php';

} else {
	require '404.php';
}
$content = ob_get_clean();
require '../view/templates/default.php';