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

		return $isPasswordCorrect;
	}
}