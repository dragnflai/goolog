<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM post WHERE id = \'' .$_GET['post']. '\'');
	db_q($db, 'DELETE FROM comment WHERE pid = \'' .$_GET['post']. '\'');
	$data['subtitle'] = $lang['post'].$lang['deleted'];
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
	<p><a href = "index.php?post">← ' .$lang['redirect']. '：' .$lang['post']. '</a></p>';
}
else if(isset($_GET['comment'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM comment WHERE id = \'' .$_GET['comment']. '\'');
	$data['subtitle'] = $lang['comment'].$lang['deleted'];
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
	<p><a href = "index.php?comment">← ' .$lang['redirect']. '：' .$lang['comment']. '</a></p>';
}
else if(isset($_GET['link'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM link WHERE id = \'' .$_GET['link']. '\'');
	$data['subtitle'] = $lang['link'].$lang['deleted'];
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
	<p><a href = "index.php?more">← ' .$lang['redirect']. '：' .$lang['more']. '</a></p>';
}
else if(isset($_GET['category'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM category WHERE id = \'' .$_GET['post']. '\'');
	db_q($db, 'UPDATE post SET pid = 1 WHERE pid = \'' .$_GET['post']. '\'');
	$data['subtitle'] = $lang['category'].$lang['deleted'];
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
	<p><a href = "index.php?more">← ' .$lang['redirect']. '：' .$lang['more']. '</a></p>';
}
else
{
	header('Location: index.php');
}

$template = 'main';
require 'footer.php';
?>
