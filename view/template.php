<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title?></title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
    	<div class="header">
    		<div id="title">
				<h1>Le blog d'un exilé</h1>
				<h2>Retracez l'aventure d'exilés sur Wraeclast</h2>
			</div>
			<div id="idMenu">
			<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['nickname']))
				{
    				echo 'Bonjour ' . $_SESSION['nickname'];
			?>
					<br/><a href="logout.php">Déconnection</a><br/> <!-- action à créer -->
			<?php 
				}
				else
				{
			?>
					<a href="inscription.php">Inscrivez vous !</a><br/> <!-- action à créer -->
					<a href="index.php?action=gologin">Connectez vous</a><br/> 
			<?php
				}
			?>
				<a href="index.php">Retour à l'index</a><br/>
			</div>
			<!-- ajouter menu admin si group_id == 1-->
			<div id="admin">
				<!-- ajouter options admin -->
			</div>
		</div>

    	<?= $content ?>
    </body>
</html>