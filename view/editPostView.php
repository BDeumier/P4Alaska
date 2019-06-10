<?php $title = 'Le blog de l\'exilé';
//session_start();
?>

<?php ob_start(); ?>
<h1>Corriger un billet</h1>

<!--formulaire pour corriger un billet -->
<form action="index.php?action=write" method="post">
	<label for="postTitle">Titre du billet : </label><textarea name="postTitle" id="postTitle"></textarea><br/>
	<label for="post">Billet : </label><textarea name="post" id="postTextarea"></textarea><br/>
	<input type="submit" value="Publier">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>