<div class="header">
	<h1>Le blog d'un exilé</h1>
	<h2>Retracez l'aventure d'exilés sur Wraeclast</h2>
	

<?php
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
?>
	<br/><a href="logout.php">Déconnection</a><br/>
<?php 
}
else
{
?>
	<a href="inscription.php">Inscrivez vous !</a><br/>
	<a href="login.php">Connectez vous</a><br/>
<?php
}
?>
	<a href="index.php">Retour à l'index</a><br/>
</div>