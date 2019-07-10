<?php
//namespaces
use \BenjaminDeumier\BlogP4\Model\PostManager;
use \BenjaminDeumier\BlogP4\Model\CommentManager;
use \BenjaminDeumier\BlogP4\Model\UserManager;
use \BenjaminDeumier\BlogP4\Model\AdminManager;

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');
require_once ('model/UserManager.php');
require_once ('model/AdminManager.php');

//fonctions du controller

//afficher les billets
function listPosts($page = 1)
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    $pageToDisplay = $page;

    require('view/listPostsView.php');
}

//afficher un billet et ses commentaires
function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

//ajouter un commentaire
function addComment($postId, $author, $comment)
{
	$commentManager = new CommentManager();

	$affectedLines = $commentManager->postComment($postId, $author, $comment);

	if ($affectedLines === false)
	{
		throw new Exception('Impossibe d\'ajouter le commentaire.');
	}
	else
	{
		header('Location: index.php?action=post&id=' . $postId);
	}
}

//afficher le formulaire de connexion
function gologin()
{
	require('view/loginView.php');
}

//se connecter
function login($nickname, $password)
{
	$userManager = new UserManager();
	$userManager->login($nickname, $password);

	header('Location: index.php');
}

//afficher le formulaire d'inscription
function gosignin()
{
	require('view/signinView.php');
}

//se connecter
function signin($nickname, $password, $email)
{
	$userManager = new UserManager();
	$userManager->signin($nickname, $password, $email);
	listPosts();
}

//se déconnecter
function logout()
{
	$userManager = new UserManager();
	$userManager->logout();
	listPosts();
}

//afficher le formulaire de promotion
function gopromote()
{
	require('view/promoteView.php');
}

//promouvoir un compte
function promote($nickname)
{
	$adminManager = new AdminManager();
	$adminManager->promote($nickname);
	listPosts();
}

//afficher la page d'écriture de billet
function gowrite()
{
	require('view/writeView.php');
}

//écrire un billet
function write($postTitle, $post)
{
	$adminManager = new AdminManager();
	$adminManager->write($postTitle, $post);
	listPosts();
}

//afficher la page de modération
function goeditComment ($commentId)
{
	$commentManager = new CommentManager();
	$comment = $commentManager->getComment($commentId);

	require('view/moderateView.php');
	header('view/moderateView.php&id=' . $commentId);
}

//éditer un commentaire
function editComment($commentId, $newText)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$adminManager->editComment($commentId, $newText);
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view/postView.php');
}

//supprimer un commentaire
function deleteComment($commentId)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();
	
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$adminManager->deleteComment($commentId);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view/postView.php');
}

//signaler un commentaire
function reportComment($commentId)
{
	$commentManager = new CommentManager();
	$postManager = new PostManager();

	$commentManager->reportComment($commentId);
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view/postView.php');
}

//supprimer un commentaire
function deletePost($postId)
{
	$adminManager = new AdminManager();
	$adminManager->deletePost($postId);
	listPosts();
}

//afficher la page de modification de billet
function goeditPost($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	
	require('view/editPostView.php');
	header('view/editPostView.php&id=' . $postId);
}

//modifier un billet
function editPost($postId, $title, $text)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$adminManager->editPost($postId, $title, $text);
	$post = $postManager->getPost($postId);
	$comments = $commentManager->getComments($postId);

	require('view/postView.php');
}

//afficher les mentions légales
function golegalNotice()
{
	require ('view/legalNoticeView.php');
}