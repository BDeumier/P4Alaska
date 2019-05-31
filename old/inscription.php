<!--formulaire pour s'inscrire' -->
<form action="inscription_traitement.php" method="post">
	<label for="nickname">Pseudo : </label><input type="text" name="nickname" id="nickname" placeholder="votre pseudo unique qui déchire"><br/>
	<label for="passwordA">Mot de passe : </label><input type="password" name="passwordA" id="passwordA"><br/>
	<label for="passwordB">Confirmez le mot de passe : </label><input type="password" name="passwordB" id="passwordB"><br/>
	<label for="email">Adresse e-mail : </label><input type="text" name="email" id="email" placeholder="truc@machin.bidule"><br/>
	<input type="submit" value="S'inscrire">
</form>