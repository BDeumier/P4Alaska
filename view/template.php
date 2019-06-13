<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=lr7rf2f10wdo01kg40v6kby2469ko230x7va9h18mrflbuxm"></script>
        <script>tinymce.init({
    			selector: '#postTextarea',
  				});
		</script>
        <title><?= $title?></title>
   		<link rel="stylesheet" href="public/css/bootstrap.css">
        <link rel="stylesheet" href="public/css/style.css" />
    </head>
    <body>
    	<div class="container-fluid">
    		<header class="row justify-content-around">
    			<div class="col-lg-7">
    				<div id="titleBlock">
    					<div id="logo">
    						<a href="index.php"><img src="public/images/logotest1.png" alt="une vue sur un lac de l'Alaska" title="logo blog Alaska"/></a>
    					</div>
    					<div id="title">
							<h1>Billet simple pour l'Alaska</h1>
							<h2>Un polar signé Jean Rochefort</h2>
						</div>
					</div>
    			</div>	
    			<div class="col-lg-2">
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
						if (isset($_SESSION['group_id']) AND $_SESSION['group_id'] == 1)
						{
						?>
						<div class="admin">
							<a href="index.php?action=gowrite">Ecrire un billet</a><br/>
							<a href="index.php?action=gopromote">Promouvoir un compte en admin</a><br/>
						</div>
					<?php
					}
					?>
						<a href="index.php">Retour à l'index</a><br/>
					</div>	
    			</div>	
			</header>
			<div class="row">
				<div class="col-lg-12">
					<?= $content ?>
				</div>
			</div>
			<footer class="row">
				<div class="col-lg-12">
					<p>Mentions légales</p>
				</div>	
			</div>
		</div>
    </body>
</html>