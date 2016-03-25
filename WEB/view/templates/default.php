<!DOCTYPE html>
<html>
    <head>
        <title>Coac</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style_form.css">
        <link rel="stylesheet" href="css/head.css">
    </head>
    <body>

        <center>
            <!-- HEADER -->
            <div id="header">
                <div class="site_contenu">
                    <div id="logo">
                        <a href="http://192.168.1.200"><img src="img/logo-lycee-la-fayette.png" width="272" height="137" alt="Lycée La Fayette"></a>
                    </div>
                    <div id="droite">
                        <h1>Lycée des métiers de l'Energie, du Numérique<br>
                            et des Industries de production</h1>
                        <div style="float:right;">
				            <br>
				            <br>
				            <br>
				            <br>
			            </div>
			
		            </div>
	            </div>
            <!-- /HEADER -->
            <!-- MENU -->
            <menu id="menu">
                <li><a href="#"><img src="img/exit.png" align="top" width="30px" height="30px" title="Se déconnecter"></a></li>
                <li><p></p></li>
                <li><a href="?p=home">Accueil</a></li>
                <li><a href="?p=eleve.add">Inscription</a></li>
                <li><a href="?p=eleve.list">Liste des élèves</a></li>
                <li><a href="?p=promo.list">Liste des classes</a></li>
                <li><a href="?p=log.list">Liste des logs</a></li>
            </menu>
            <!-- /MENU -->
        </center>
        <div id="container" style="margin-top: 75px;">
            <?= $content; ?>
        </div>
    </body>
</html>
