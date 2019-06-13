<?php $title = 'Billet simple pour l\'Alaska';?>

<?php ob_start(); ?>
<h1>Modération</h1>
<!--formulaire pour éditer le commentaire -->
<form action="index.php?action=editComment&amp;id=<?= $_GET['id'] ?>" method="post">
	<label for="newText">Nouveau texte : </label><textarea name="newText" id="newText"><?= htmlspecialchars($comment['comment'])?></textarea><br/>
	<input type="submit" value="Editer">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>