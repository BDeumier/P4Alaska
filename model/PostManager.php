<?php
require_once('model\Manager.php');

class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
    	$req = $db->query('SELECT * FROM cours3_billets ORDER BY id DESC LIMIT 0, 5');
    	return $req;
	}

	public function getPost($postId)
	{
    	$db = $this->dbConnect();
    	$req = $db->prepare('SELECT id, title, content, post_date FROM cours3_billets WHERE id = ?');
    	$req->execute(array($postId));
    	$post = $req->fetch();

    	return $post;
	}
}