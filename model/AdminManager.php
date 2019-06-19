<?php

//namespaces
namespace BenjaminDeumier\BlogP4\Model;
use \BenjaminDeumier\BlogP4\Model\Manager;
require_once('Manager.php');

//fonctions d'administrateur

class AdminManager extends Manager
{
	//promouvoir un compte
	public function promote($nickname)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE members SET group_id = 1 WHERE nickname = ?');
		$req->execute(array($nickname));
	}

	//écrire un billet
	public function write($title, $content)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO posts(title, content, post_date) VALUES (?, ?, NOW())');
		$post->execute(array($title, $content));
	}

	//supprimer un billet
	public function deletePost($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM posts WHERE id = ?');
		$req->execute(array($id));
		$reqComment = $db->prepare('DELETE FROM comments WHERE post_id = ?');
		$reqComment->execute(array($id));
	}

	//modifier un billet
	public function editPost($id, $newTitle, $newText)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
		$post->execute(array($newTitle, $newText, $id));
	}

	//supprimer un commentaire
	public function deleteComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($id));
	}

	//modérer un commentaire
	public function editComment($id, $newText)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('UPDATE comments SET comment = ?, reported = 0 WHERE id = ?');
		$comment->execute(array($newText, $id));
	}
}