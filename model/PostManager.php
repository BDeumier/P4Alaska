<?php
require_once('model\Manager.php');

class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
    	$req = $db->query('SELECT * FROM posts ORDER BY id DESC');
    	return $req;
	}

	public function getPost($postId)
	{
    	$db = $this->dbConnect();
    	$req = $db->prepare('SELECT id, title, content, post_date FROM posts WHERE id = ?');
    	$req->execute(array($postId));
    	$post = $req->fetch();

    	return $post;
	}
}