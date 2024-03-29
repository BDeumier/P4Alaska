<?php
//namespaces
namespace BenjaminDeumier\BlogP4\Model;
use \BenjaminDeumier\BlogP4\Model\Manager;
require_once('Manager.php');

//fonctions d'utilisateur

class UserManager extends Manager
{
	//se connecter
	public function login($nickname, $password)
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
    		throw new \Exception('Erreur : l\'identifiant ou le mot de passe est incorrect.');
    	}
	}

	//s'inscrire
	public function signin($nickname, $password, $email)
	{
		
		$db = $this->dbConnect();
		$checkNickname = $db->prepare('SELECT id FROM members WHERE nickname = ?');
		$checkNickname->execute(array($nickname));
		$result = $checkNickname->fetch();

		if ($result['id'] >= 1)
		{
			throw new \Exception('Erreur : le nickname est déja pris.');
		}

		$password_hashed = password_hash($password, PASSWORD_DEFAULT);
		$req = $db->prepare('INSERT INTO members(nickname, password, email, signin_date, group_id)
		VALUES (:nickname, :password, :email, CURDATE(), 0)');
		$req->execute(array(
		'nickname' => $nickname,
		'password' => $password_hashed,
		'email' => $email));

		login($nickname, $password);
	}

	//se déconnecter
	public function logout()
	{
		session_destroy();		
	}
}