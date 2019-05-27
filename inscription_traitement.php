<?php
	// on fait toutes les vérifications sur les données reçues
	// on vérifie que le pseudo est libre
	// on vérifie que les 2 passwords sont identiques
	// on vérifie que l'adresse mail est valide (miam une REGEX)

	// on hache le mot de passe
	$password_hache = password_hash($_POST['passwordA'], PASSWORD_DEFAULT);
	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];

	//on insère le tout dans la base de données

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=blogP4;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
    	die('Erreur : ' . $e->getMessage());
    }

	$req = $bdd->prepare('INSERT INTO membres(pseudo, password, email, date_inscription, id_groupe)
	VALUES (:pseudo, :password, :email, CURDATE(), 1)');
	$req->execute(array(
		'pseudo' => $pseudo,
		'password' => $password_hache,
		'email' => $email
	));


	echo "on test l'inscription";
	var_dump($pseudo, $password_hache, $email)
?>