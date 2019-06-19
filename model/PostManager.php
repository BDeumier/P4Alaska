<?php
//namespaces
namespace BenjaminDeumier\BlogP4\Model;
use \BenjaminDeumier\BlogP4\Model\Manager;
require_once('Manager.php');

//fonctions des billets

class PostManager extends Manager
{
	//récupérer les billets
	public function getPosts()
	{
		$db = $this->dbConnect();
    	$req = $db->query('SELECT * FROM posts ORDER BY id DESC');
    	return $req;
	}

	//récupérer un billet
	public function getPost($postId)
	{
    	$db = $this->dbConnect();
    	$req = $db->prepare('SELECT id, title, content, post_date FROM posts WHERE id = ?');
    	$req->execute(array($postId));
    	$post = $req->fetch();

    	return $post;
	}
}