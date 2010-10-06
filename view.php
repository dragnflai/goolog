<?php
require 'header.php';

if(isset($_GET['post']))
{
	$post = db_qrs('SELECT * FROM post WHERE id = \''.$_GET['post'].'\'');
	$comments = db_qr('SELECT * FROM comment WHERE pid = '.$post['id']);
	$category = db_qrs('SELECT name FROM category WHERE id = '.$post['pid']);
	$data['meta'] = htmlspecialchars($post['title']);
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$post['id'].'">[#]</a><a href="edit.php?post='.$post['id'].'">[!]</a><a href="delete.php?post='.$post['id'].'">[x]</a>' : '').$data['meta'].'</h1>
	<h4>'.nl2br($post['content']).'</h4>
	<h4><a href="add.php?comment='.$post['id'].'">'.$lang['leave_reply'].'</a></h4>
	<h6><a href="view.php?category='.$post['pid'].'">'.htmlspecialchars($category['name']).'</a> | '.$lang['comment'].' ('.count($comments).') | '.strftime('%B %e, %Y, %l:%M %p', $post['date']).'</h6>';
	foreach($comments as $comment)
	{
		$data['body'].= '<h3>'.(isset($_SESSION['admin'])? '<a href="edit.php?comment='.$comment['id'].'">[!]</a><a href="delete.php?comment='.$comment['id'].'">[x]</a>' : '').$comment['author'].$lang['said'].'...</h3>
		<h4>'.nl2br($comment['content']).'</h4>
		<h6>'.strftime('%B %e, %Y, %l:%M %p', $comment['date']).'</h6>';
	}
}
elseif(isset($_GET['category']))
{
	$category = db_qrs('SELECT * FROM category WHERE id = \''.$_GET['category'].'\'');
	$posts = db_qr('SELECT id, title FROM post WHERE pid = '.$category['id']);
	$data['meta'] = htmlspecialchars($category['name']);
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="edit.php?category='.$category['id'].'">[!]</a><a href="delete.php?category='.$category['id'].'">[x]</a>' : '').$data['meta'].'</h1>';
	foreach($posts as $post)
	{
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$post['id'].'">[#]</a><a href="edit.php?post='.$post['id'].'">[!]</a><a href="delete.php?post='.$post['id'].'">[x]</a>' : '').'<a href="view.php?post='.$post['id'].'">'.$post['title'].'</a></h4>';
	}
}
elseif(isset($_GET['archive']))
{
	$data['meta'] = strftime('%B %Y', strtotime($_GET['archive']));
	$data['body'].= '<h1>'.$data['meta'].'</h1>';
	$posts = db_qr('SELECT id, title FROM post WHERE strftime(\'%Y-%m\', date, \'unixepoch\') = \''.$_GET['archive'].'\'');
	foreach($posts as $post)
	{
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$post['id'].'">[#]</a><a href="edit.php?post='.$post['id'].'">[!]</a><a href="delete.php?post='.$post['id'].'">[x]</a>' : '').'<a href="view.php?post='.$post['id'].'">'.$post['title'].'</a></h4>';
	}
}
else
{
	header('Location: index.php');
}

require 'footer.php';

?>
