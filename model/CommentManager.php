<?php
require_once('model\Manager.php');

class CommentManager extends Manager
{
	public function getComments($postId)
	{
    	$db = $this->dbConnect();
    	$comments = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
    	$comments->execute(array($postId));

    	return $comments;
	}

	public function postComment($postId, $author, $comment)
	{
    	$db = $this->dbConnect();
    	$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
    	$affectedLines = $comments->execute(array($postId, $author, $comment));

    	return $affectedLines;
	}
}