<?php

//namespaces
namespace BenjaminDeumier\BlogP4\Model;
use \BenjaminDeumier\BlogP4\Model\Manager;
require_once('Manager.php');

//fonctions des commentaires

class CommentManager extends Manager
{
    //récupérer les commentairezs d'un billet
	public function getComments($postId)
	{
    	$db = $this->dbConnect();
    	$comments = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
    	$comments->execute(array($postId));

    	return $comments;
	}

    //récupérer un commentaire
    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT comment FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

    //ajouter un commentaire
	public function postComment($postId, $author, $comment)
	{
    	$db = $this->dbConnect();
    	$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
    	$affectedLines = $comments->execute(array($postId, $author, $comment));

    	return $affectedLines;
	}

    //signaler un commentaire
    public function reportComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
    }

    //récupérer l'id du billet d'un commentaire
    public function getPostId($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post_id FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $postId = $req->fetch();

        return $postId;
    }
}