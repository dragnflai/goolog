<?php
require 'header.php';

if(isset($_GET['post']))
{
	$_ps = db_qrs('SELECT * FROM post WHERE id = \''.$_GET['post'].'\'');
	$_cm = db_qr('SELECT * FROM comment WHERE pid = '.$_ps['id']);
	$_ct = db_qrs('SELECT name FROM category WHERE id = '.$_ps['pid']);
	$data['meta'] = htmlspecialchars($_ps['title']);
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$_ps['id'].'">[#]</a><a href="edit.php?post='.$_ps['id'].'">[!]</a><a href="delete.php?post='.$_ps['id'].'">[x]</a>' : '').$data['meta'].'</h1>
	<h4>'.nl2br($_ps['content']).'</h4>
	<h4><a href="add.php?comment='.$_ps['id'].'">'.$lang['leave_reply'].'</a></h4>
	<h6><a href="view.php?category='.$_ps['pid'].'">'.htmlspecialchars($_ct['name']).'</a> | '.$lang['comment'].' ('.count($_cm).') | '.strftime('%B %e, %Y, %l:%M %p', $_ps['date']).'</h6>';
	foreach($_cm as $cm)
	{
		$data['body'].= '<h3>'.(isset($_SESSION['admin'])? '<a href="edit.php?comment='.$cm['id'].'">[!]</a><a href="delete.php?comment='.$cm['id'].'">[x]</a>' : '').$cm['author'].$lang['said'].'...</h3>
		<h4>'.nl2br($cm['content']).'</h4>
		<h6>'.strftime('%B %e, %Y, %l:%M %p', $cm['date']).'</h6>';
	}
}
elseif(isset($_GET['category']))
{
	$_ct = db_qrs('SELECT * FROM category WHERE id = \''.$_GET['category'].'\'');
	$_ps = db_qr('SELECT id, title FROM post WHERE pid = '.$_ct['id']);
	$data['meta'] = htmlspecialchars($_ct['name']);
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="edit.php?category='.$_ct['id'].'">[!]</a><a href="delete.php?category='.$_ct['id'].'">[x]</a>' : '').$data['meta'].'</h1>';
	foreach($_ps as $ps)
	{
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$ps['id'].'">[#]</a><a href="edit.php?post='.$ps['id'].'">[!]</a><a href="delete.php?post='.$ps['id'].'">[x]</a>' : '').'<a href="view.php?post='.$ps['id'].'">'.$ps['title'].'</a></h4>';
	}
}
elseif(isset($_GET['archive']))
{
	$data['meta'] = strftime('%B %Y', strtotime($_GET['archive']));
	$data['body'].= '<h1>'.$data['meta'].'</h1>';
	$_ps = db_qr('SELECT id, title FROM post WHERE strftime(\'%Y-%m\', date, \'unixepoch\') = \''.$_GET['archive'].'\'');
	foreach($_ps as $ps)
	{
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$ps['id'].'">[#]</a><a href="edit.php?post='.$ps['id'].'">[!]</a><a href="delete.php?post='.$ps['id'].'">[x]</a>' : '').'<a href="view.php?post='.$ps['id'].'">'.$ps['title'].'</a></h4>';
	}
}

require 'footer.php';

?>
