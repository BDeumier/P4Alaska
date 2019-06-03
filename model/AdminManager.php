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

	public function write($postTitle, $post)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO posts(title, content, post_date) VALUES (?, ?, NOW())');
		$post->execute(array($postTitle, $post)); // ne fonctionne pas, renvoie : Object of class PDOStatement could not be converted to string

		//return affected line pour les vérifs
	}

	public function deleteComment($commentId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($commentId));
	}

	public function editComment($commentId, $newText)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
		$comment->execute(array($newText, $commentId));
	}
}