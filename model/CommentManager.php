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

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT comment FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

	public function postComment($postId, $author, $comment)
	{
    	$db = $this->dbConnect();
    	$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
    	$affectedLines = $comments->execute(array($postId, $author, $comment));

    	return $affectedLines;
	}

    public function reportComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
    }

    public function getPostId($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post_id FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $postId = $req->fetch();

        return $postId;
    }
}