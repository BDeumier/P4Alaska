<?php
require_once('model\Manager.php');

class UserManager extends Manager
{
	public function authentification($nickname, $password)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, nickname, password, group_id FROM members WHERE nickname = ?');
		$req->execute(array($nickname));

		$result = $req->fetch();
		$isPasswordCorrect = password_verify($password, $result['password']);

		if ($isPasswordCorrect)
		{
        	$_SESSION['id'] = $result['id'];
        	$_SESSION['nickname'] = $result['nickname'];
        	$_SESSION['group_id'] = $result['group_id'];
    	}

    	else
    	{
    		throw new Exception('Erreur : l\'identifiant ou le mot de passe est incorrect.');
    	}
	}

	public function signin($nickname, $password, $email)
	{
		// on fait toutes les vérifications sur les données reçues
		// on vérifie que le pseudo est libre
		// on vérifie que les 2 passwords sont identiques
		// on vérifie que l'adresse mail est valide (miam une REGEX)

		$password_hashed = password_hash($password, PASSWORD_DEFAULT);
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO members(nickname, password, email, signin_date, group_id)
		VALUES (:nickname, :password, :email, CURDATE(), 0)');
		$req->execute(array(
		'nickname' => $nickname,
		'password' => $password_hashed,
		'email' => $email));

		authentification($nickname, $password); //on renvoie true si ça marche et on redirige via l'index?
	}

	public function logout()
	{
		//vérifier si la session contient bien quelque chose
		//session_destroy();
	}
}