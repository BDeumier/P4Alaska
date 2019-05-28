<?php $title = 'Le blog de l\'exilé'; ?>

<?php ob_start(); ?>

<a href="index.php">Retourner au blog</a></br>
<p>Veuillez rentrer votre identifiant et votre mot de passe :</p>

<!--formulaire pour se connecter -->
<form action="login_traitement.php" method="post"> <!--à changer -->
	<label for="pseudo">Votre pseudo : </label><input type="text" name="pseudo" id="pseudo"><br/>
	<label for="pseudo">Votre mot de passe : </label><input type="password" name="password" id="password"><br/>
	<input type="submit" value="Se connecter">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>
<?php include("old\\footer.php"); ?>