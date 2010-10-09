<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM post WHERE id = \'' .$_GET['post']. '\'');
	db_q($db, 'DELETE FROM comment WHERE pid = \'' .$_GET['post']. '\'');
	$data['meta'] = $lang['post'].$lang['deleted'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p><a href = "index.php?post">← ' .$lang['redirect']. ': ' .$lang['post']. '</a></p>';
}


else if(isset($_GET['comment'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM comment WHERE id = \'' .$_GET['comment']. '\'');
	$data['meta'] = $lang['comment'].$lang['deleted'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p><a href = "index.php?comment">← ' .$lang['redirect']. ': ' .$lang['comment']. '</a></p>';
}


else if(isset($_GET['link'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM link WHERE id = \'' .$_GET['link']. '\'');
	$data['meta'] = $lang['link'].$lang['deleted'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p><a href = "index.php?more">← ' .$lang['redirect']. ': ' .$lang['more']. '</a></p>';
}


else if(isset($_GET['category'], $_SESSION['admin']))
{
	db_q($db, 'DELETE FROM category WHERE id = \'' .$_GET['post']. '\'');
	db_q($db, 'UPDATE post SET pid = 1 WHERE pid = \'' .$_GET['post']. '\'');
	$data['meta'] = $lang['category'].$lang['deleted'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p><a href = "index.php?more">← ' .$lang['redirect']. ': ' .$lang['more']. '</a></p>';
}
else
{
	header('Location: index.php');
}

require 'footer.php';
?>
