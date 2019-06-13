<?php
require_once('model\Manager.php');

class AdminManager extends Manager
{
	public function promote($nickname)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE members SET group_id = 1 WHERE nickname = ?');
		$req->execute(array($nickname));
	}

	public function write($title, $content)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO posts(title, content, post_date) VALUES (?, ?, NOW())');
		$post->execute(array($title, $content));

		//return affected line pour les vérifs
	}

	public function deletePost($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM posts WHERE id = ?');
		$req->execute(array($id));
		$reqComment = $db->prepare('DELETE FROM comments WHERE post_id = ?');
		$reqComment->execute(array($id));
	}

	public function editPost($id, $newText)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE posts SET content = ? WHERE id = ?');
		$comment->execute(array($newText, $id));
	}

	public function deleteComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($id));
	}

	public function editComment($id, $newText)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('UPDATE comments SET comment = ?, reported = 0 WHERE id = ?');
		$comment->execute(array($newText, $id));
	}
}