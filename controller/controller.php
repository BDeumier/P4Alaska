<?php
require_once ('model\PostManager.php');
require_once ('model\CommentManager.php');
require_once ('model\UserManager.php');
require_once ('model\AdminManager.php');

function listPosts($page = 1)
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    $pageToDisplay = $page;

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

	header('Location: index.php');
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
	listPosts();
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
	$commentManager = new CommentManager();
	$comment = $commentManager->getComment($commentId);

	require('view\moderateView.php');
	header('view\moderateView.php&id=' . $commentId);
}

function editComment($commentId, $newText)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$adminManager->editComment($commentId, $newText);
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view\postView.php');
}

function deleteComment($commentId)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();
	
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$adminManager->deleteComment($commentId);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view\postView.php');
}

function reportComment($commentId)
{
	$commentManager = new CommentManager();
	$postManager = new PostManager();

	$commentManager->reportComment($commentId);
	$postId = $commentManager->getPostId($commentId);
	$post = $postManager->getPost($postId['post_id']);
	$comments = $commentManager->getComments($postId['post_id']);

	require('view\postView.php');
}

function deletePost($postId)
{
	$adminManager = new AdminManager();
	$adminManager->deletePost($postId);
	listPosts();
}

function goeditPost($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	
	require('view\editPostView.php');
	header('view\editPostView.php&id=' . $postId);
}

function editPost($postId, $title, $text)
{
	$adminManager = new AdminManager();
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$adminManager->editPost($postId, $title, $text);
	$post = $postManager->getPost($postId);
	$comments = $commentManager->getComments($postId);

	require('view\postView.php');
}