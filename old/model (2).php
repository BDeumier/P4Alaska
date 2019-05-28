<?php
function getPosts()
{
	$db = dbConnect();
    $req = $db->query('SELECT * FROM cours3_billets ORDER BY id DESC LIMIT 0, 5');
    return $req;
}

function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, post_date FROM cours3_billets WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT * FROM cours3_commentaires WHERE post_id = ?');
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO cours3_commentaires(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=blogp4;charset=utf8', 'root', '');
    return $db;
}

//requête pour compter les billets

    /*$reponse = $bdd->query('SELECT COUNT(*) AS nombre_billets FROM cours3_billets');
    $donnees = $reponse->fetch();
    //var_dump($donnees['nombre_billets']);

    $nombre_pages = floor($donnees['nombre_billets'] / 5);
    if ($donnees['nombre_billets'] % 5 > 0)
    {
        $nombre_pages++;
    }

    //var_dump($nombre_pages);
    $reponse->closeCursor();*/