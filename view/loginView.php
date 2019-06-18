<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<p>Veuillez rentrer votre identifiant et votre mot de passe :</p>

<!--formulaire pour se connecter -->
<form action="index.php?action=login" method="post">
	<label for="nickname">Votre pseudo : </label><input type="text" name="nickname" id="nickname"><br/>
	<label for="password">Votre mot de passe : </label><input type="password" name="password" id="password"><br/>
	<input type="submit" value="Se connecter">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>