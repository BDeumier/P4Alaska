<?php
require_once ('model\PostManager.php');
require_once ('model\CommentManager.php');
require_once ('model\UserManager.php');

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view\listPostsView.php');
}

function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view\postView.php');
}

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

function gologin()
{
	require('view\loginView.php');
}

function login($nickname, $password)
{
	$userManager = new UserManager();
	$userManager->authentification($nickname, $password);
	listPosts(); //rediriger via le routeur
}

function gosignin()
{
	require('view\signinView.php');
}

function signin($nickname, $password, $email)
{
	$userManager = new UserManager();
	$userManager->signin($nickname, $password, $email);
	listPosts();
}

function logout()
{
	$userManager = new UserManager();
	$userManager->logout();
}