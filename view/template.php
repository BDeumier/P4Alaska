<?php
//session_start();
?>
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
					<br/><a href="index.php?action=logout">Déconnection</a><br/>
			<?php 
				}
				else
				{
			?>
					<a href="index.php?action=gosignin">Inscrivez vous !</a><br/>
					<a href="index.php?action=gologin">Connectez vous</a><br/>
			<?php
				}
			?>
				<a href="index.php">Retour à l'index</a><br/>
			</div>

			<?php
				if (isset($_SESSION['group_id']) AND $_SESSION['group_id'] == 1)
				{
			?>
					<div id="admin">
						<a href="index.php?action=gowrite">Ecrire un billet</a><br/>
						<a href="index.php?action=gopromote">Promouvoir un compte en admin</a><br/>
					</div>
			<?php
				}
			?>		
		</div>

    	<?= $content ?>
    </body>
</html>