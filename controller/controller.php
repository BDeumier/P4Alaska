<?php
require_once ('model\PostManager.php');
require_once ('model\CommentManager.php');
require_once ('model\UserManager.php');
require_once ('model\AdminManager.php');

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
	$userManager->login($nickname, $password);
	header('Location: index.php?action=listPosts');
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
	header('Location: index.php?action=listPosts');
}

function gopromote()
{
	require('view\promoteView.php');
}


function promote($nickname)
{
	$adminManager = new AdminManager();
	$adminManager->promote($nickname);
	listPosts();
}

function gowrite()
{
	require('view\writeView.php');
}

function write($postTitle, $post)
{
	$adminManager = new AdminManager();
	$adminManager->write($postTitle, $post);
	listPosts();
}

function goeditComment ($commentId)
{
	//chercher commentaire
	$commentManager = new CommentManager();
	$comment = $commentManager->getComment($commentId);
	require('view\moderateView.php');
	header('view\moderateView.php&id=' . $commentId);
}

function editComment($commentId, $newText)
{
	$adminManager = new AdminManager();
	$adminManager->editComment($commentId, $newText);
	listPosts(); //plutôt post avec le bon id
	//header post avec id en url
}

function deleteComment($commentId)
{
	$adminManager = new AdminManager();
	$adminManager->deleteComment($commentId);
	listPosts(); //plutôt post avec le bon id
}

function reportComment($commentId)
{
	$commentManager = new CommentManager();
	$commentManager->reportComment($commentId);
	listPosts(); //plutôt post avec le bon id
}

function deletePost($postId)
{
	$adminManager = new AdminManager();
	$adminManager->deletePost($postId);
	listPosts();
}

function goeditPost($postId)
{
	header('Location: view\editPostView.php&id=' . $postId);
}