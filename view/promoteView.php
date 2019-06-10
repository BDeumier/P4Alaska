<?php $title = 'Le blog de l\'exilé';
//session_start();
?>

<?php ob_start(); ?>
<p>Veuillez renseigner le pseudonyme de la personne à promouvoir :</p>

<!--formulaire pour promouvoir un compte en admin -->
<form action="index.php?action=promote" method="post">
	<label for="nickname">Pseudonyme à promouvoir : </label><input type="text" name="nickname" id="nickname"><br/>
	<label for="nickname2">Confirmez le pseudo : </label><input type="text" name="nickname2" id="nickname2"><br/>
	<input type="submit" value="Promouvoir">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view\template.php'); ?>