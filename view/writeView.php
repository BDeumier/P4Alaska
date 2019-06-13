<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<h1>Nouveau billet</h1>

<!--formulaire pour écrire un billet -->
<form action="index.php?action=write" method="post">
	<label for="postTitle">Titre du billet : </label><input name="postTitle" id="postTitle" required></input><br/>
	<label for="post">Billet : </label><textarea name="post" id="postTextarea"></textarea><br/>
	<input type="submit" value="Publier">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>