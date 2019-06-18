<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<h1>Corriger un billet</h1>

<!--formulaire pour corriger un billet -->
<form action="index.php?action=editPost&amp;id=<?= $_GET['id'] ?>" method="post">
	<label for="newTitle">Titre du billet : </label><input name="newTitle" id="newTitle" value="<?= $post['title'] ?>"></input><br/>
	<label for="newText">Billet : </label><textarea name="newText" id="postTextarea"><?= $post['content'] ?></textarea><br/>
	<input type="submit" value="Publier">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>