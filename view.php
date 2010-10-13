<?php
require 'header.php';

if(isset($_GET['post']))
{
	require 'include/bbcode.php';
	$post = db_qrs($db, 'SELECT id, pid, date, title, content FROM post WHERE id = \'' .$_GET['post']. '\'');
	$comments = db_qr($db, 'SELECT id, date, author, content FROM comment WHERE pid = ' .$post['id']);
	$category = db_qrs($db, 'SELECT name FROM category WHERE id = ' .$post['pid']);
	$data['subtitle'] = $post['title'];
	$data['content'] .= '<div class = "entry-container">
	<div class = "entry-header"><h1>' .(isset($_SESSION['admin'])? '<a href = "categorize.php?post=' .$post['id']. '">[#]</a><a href = "edit.php?post=' .$post['id']. '">[!]</a><a href = "delete.php?post=' .$post['id']. '">[x]</a>' : '').$data['subtitle']. '</h1></div>
	<div class = "entry-main">
	<p>' .bbcode($post['content']). '</p>
	<p><a href = "add.php?comment=' .$post['id']. '">' .$lang['leave_reply']. '</a></p>
	</div>
	<div class = "entry-footer"><ul>
	<li><a href = "view.php?category=' .$post['pid']. '">' .$category['name']. '</a></li>
	<li>' .$lang['comment']. ' (' .count($comments). ')</li>
	<li>' .strftime('%B %e, %Y, %l:%M %p', $post['date']). '</li>
	</ul></div>
	</div>';
	foreach($comments as &$comment)
	{
		$data['content'] .= '<div class = "entry-container">
		<div class = "entry-header">' .(isset($_SESSION['admin'])? '<a href = "edit.php?comment=' .$comment['id']. '">[!]</a><a href = "delete.php?comment=' .$comment['id']. '">[x]</a>' : '').$comment['author'].$lang['said']. ' ...</div>
		<div class = "entry-main">
		<p>' .bbcode($comment['content']). '</p>
		</div>
		<div class = "entry-footer"><ul><li>' .strftime('%B %e, %Y, %l:%M %p', $comment['date']). '</li></ul></div>
		</div>';
	}
}
else if(isset($_GET['category']))
{
	$category = db_qrs($db, 'SELECT id, name FROM category WHERE id = \'' .$_GET['category']. '\'');
	$posts = db_qr($db, 'SELECT id, title FROM post WHERE pid = ' .$category['id']);
	$data['subtitle'] = $category['name'];
	$data['content'] .= '<h1>' .(isset($_SESSION['admin'])? '<a href = "edit.php?category=' .$category['id']. '">[!]</a><a href = "delete.php?category=' .$category['id']. '">[x]</a>' : '').$data['subtitle']. '</h1>
	<ul>';
	foreach($posts as &$post)
	{
		$data['content'] .= '<li>' .(isset($_SESSION['admin'])? '<a href = "categorize.php?post=' .$post['id']. '">[#]</a><a href = "edit.php?post=' .$post['id']. '">[!]</a><a href = "delete.php?post=' .$post['id']. '">[x]</a>' : ''). '<a href = "view.php?post=' .$post['id']. '">' .$post['title']. '</a></li>';
	}
	$data['content'] .= '</ul>';
}
else if(isset($_GET['archive']))
{
	$data['subtitle'] = strftime('%B %Y', strtotime($_GET['archive']));
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>';
	$posts = db_qr($db, 'SELECT id, title FROM post WHERE strftime(\'%Y-%m\', date, \'unixepoch\') = \'' .$_GET['archive']. '\'');
	$data['content'] .= '<ul>';
	foreach($posts as &$post)
	{
		$data['content'] .= '<li>' .(isset($_SESSION['admin'])? '<a href = "categorize.php?post=' .$post['id']. '">[#]</a><a href = "edit.php?post=' .$post['id']. '">[!]</a><a href = "delete.php?post=' .$post['id']. '">[x]</a>' : ''). '<a href = "view.php?post=' .$post['id']. '">' .$post['title']. '</a></li>';
	}
	$data['content'] .= '</ul>';
}
else
{
	header('Location: index.php?post');
}

$template = 'main';
require 'footer.php';
?>
