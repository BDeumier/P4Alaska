<?php $title = 'Le blog de l\'exilé';
session_start();
?>

<?php ob_start(); ?>
<h1>Nouveau billet</h1>

<!--formulaire pour se connecter -->
<form action="index.php?action=write" method="post">
	<label for="postTitle">Titre du billet : </label><input type="text" name="postTitle" id="postTitle"><br/>
	<label for="post">Billet : </label><textarea name="post" id="post"></textarea><br/>
	<input type="submit" value="Publier">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>
<?php include("old\\footer.php"); ?>