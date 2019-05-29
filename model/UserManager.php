<?php
require_once('model\Manager.php');

class UserManager extends Manager
{
	public function authentification($nickname, $password)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, password FROM members WHERE nickname = ?');
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
    		throw new Exception('Erreur : l\'identifiant ou le mot de passe est incorrect.'); //message d'erreur à tester ou améliorer
    	}
	}
}