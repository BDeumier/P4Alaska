<?php
	session_start();
	//connexion à la base de donnée
	try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=blogP4;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
    	die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('SELECT id, password FROM membres WHERE pseudo = :pseudo');
    $req->execute(array(
    	'pseudo' => $_POST['pseudo']
    ));

    $resultat = $req->fetch();

    //on vérifie si le membre existe, et si le password est correct
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

    if (!$resultat)
	{
    	echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($isPasswordCorrect)
		{
        	echo 'Bienvenue sur le blog, ' . $_POST['pseudo'] . ' !'; // special char
        	$_SESSION['id'] = $resultat['id'];
        	$_SESSION['pseudo'] = $_POST['pseudo'];
    	}
    	else
    	{
        	echo 'Mauvais identifiant ou mot de passe !';
    }

}
?>
<br/><a href="index.php">Retour à l'index</a>