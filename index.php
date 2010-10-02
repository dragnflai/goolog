<?php

require 'header.php';

//run goolog

if(isset($_GET['comment']))
{
	$data['meta'] = $lang['comment'];
	$data['body'].= '<h1>'.$data['meta'].'</h1>';
	$count = db_qrs('SELECT count(*) FROM comment');
	$total = ceil($count['count(*)']/4);
	if($_GET['comment'] < 1 || $_GET['comment'] > $total) $_GET['comment']=1;
	$offset = 4*($_GET['comment']-1);
	$_cm = db_qr('SELECT * FROM comment ORDER BY id DESC LIMIT 4 OFFSET '.$offset);
	foreach($_cm as $cm)
	{
		$data['body'].= '<h3>'.(isset($_SESSION['admin'])? '<a href="edit.php?comment='.$cm['id'].'">[!]</a><a href="delete.php?comment='.$cm['id'].'">[x]</a>' : '').htmlspecialchars($cm['author']).$lang['said'].'...</h3>
		<h4>'.$cm['content'].'</h4>
		<h4><a href="view.php?post='.$cm['pid'].'">'.$lang['read_more'].'</a></h4>
		<h6>'.strftime('%B %e, %Y, %l:%M %p', $cm['date']).'</h6>';
	}
	$data['body'].= '<h4>'.($_GET['comment'] > 1? '<a href="index.php?comment='.($_GET['comment']-1).'">← '.$lang['prev'].'</a> | ' : '').$lang['page'].$_GET['comment'].' of '.$total.($_GET['comment'] < $total? ' | <a href="index.php?comment='.($_GET['comment']+1).'">'.$lang['next'].' →</a>' : '').'</h4>';
}
elseif(isset($_GET['more']))
{
	$data['meta'] = $lang['more'];
	$data['body'].= '<form action="index.php?more" method="post">
	<h1>'.$lang['search'].'</h1>
	<h4><input name="search"/></h4>
	<h4><input type="submit"/></h4>
	</form>';
	if(isset($_POST['search'][0]))
	{
		$_ps = db_qr('SELECT id, title FROM post WHERE title LIKE \'%'.$_POST['search'].'%\' OR content LIKE \'%'.$_POST['search'].'%\'');
		foreach($_ps as $ps)
		{
			$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$ps['id'].'">[#]</a><a href="edit.php?post='.$ps['id'].'">[!]</a><a href="delete.php?post='.$ps['id'].'">[x]</a>' : '').'<a href="view.php?post='.$ps['id'].'">'.htmlspecialchars($ps['title']).'</a></h4>';
		}
	}
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="add.php?link">[+]</a>' : '').$lang['link'].'</h1>';
	$_ln = db_qr('SELECT * FROM link');
	foreach($_ln as $ln)
	{
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="edit.php?link='.$ln['id'].'">[!]</a><a href="delete.php?link='.$ln['id'].'">[x]</a>' : '').'<a href="'.$ln['url'].'">'.$ln['name'].'</a></h4>';
	}
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="add.php?category">[+]</a>' : '').$lang['category'].'</h1>';
	$_ct = db_qr('SELECT * FROM category');
	foreach($_ct as $ct)
	{
		$count = db_qrs('SELECT count(*) FROM post WHERE pid = '.$ct['id']);
		$data['body'].= '<h4>'.(isset($_SESSION['admin'])? '<a href="edit.php?category='.$ct['id'].'">[!]</a><a href="delete.php?category='.$ct['id'].'">[x]</a>' : '').'<a href="view.php?category='.$ct['id'].'">'.htmlspecialchars($ct['name']).' ('.$count['count(*)'].')</a></h4>';
	}
	$data['body'].= '<h1>'.$lang['archive'].'</h1>';
	$_ar = db_qr('SELECT DISTINCT strftime(\'%Y-%m\', date, \'unixepoch\') FROM post');
	foreach($_ar as $ar)
	{
		$count = db_qrs('SELECT count(*) FROM post WHERE strftime(\'%Y-%m\', date, \'unixepoch\') = \''.$ar['strftime(\'%Y-%m\', date, \'unixepoch\')'].'\'');
		$data['body'].= '<h4><a href="view.php?archive='.$ar['strftime(\'%Y-%m\', date, \'unixepoch\')'].'">'.strftime('%B %Y', strtotime($ar['strftime(\'%Y-%m\', date, \'unixepoch\')'])).' ('.$count['count(*)'].')</a></h4>';
	}
}
else
{
	$data['meta'] = $lang['post'];
	$data['body'].= '<h1>'.(isset($_SESSION['admin'])? '<a href="add.php?post">[+]</a>' : '').$data['meta'].'</h1>';
	$count = db_qrs('SELECT count(*) FROM post');
	$total = ceil($count['count(*)']/4);
	if($_GET['post'] < 1 || $_GET['post'] > $total) $_GET['post']=1;
	$offset = 4*($_GET['post']-1);
	$_ps = db_qr('SELECT * FROM post ORDER BY id DESC LIMIT 4 OFFSET '.$offset);
	foreach($_ps as $ps)
	{
		$count = db_qrs('SELECT count(*) FROM comment WHERE pid = '.$ps['id']);
		$_ct = db_qrs('SELECT name FROM category WHERE id = '.$ps['pid']);
		$data['body'].= '<h3>'.(isset($_SESSION['admin'])? '<a href="categorize.php?post='.$ps['id'].'">[#]</a><a href="edit.php?post='.$ps['id'].'">[!]</a><a href="delete.php?post='.$ps['id'].'">[x]</a>' : '').htmlspecialchars($ps['title']).'</h3>
		<h4>'.nl2br($ps['content']).'</h4>
		<h4><a href="view.php?post='.$ps['id'].'">'.$lang['read_more'].'</a></h4>
		<h6><a href="view.php?category='.$ps['pid'].'">'.htmlspecialchars($_ct['name']).'</a> | '.$lang['comment'].' ('.$count['count(*)'].') | '.strftime('%B %e, %Y, %l:%M %p', $ps['date']).'</h6>';
	}
	$data['body'].= '<h4>'.($_GET['post'] > 1? '<a href="index.php?post='.($_GET['post']-1).'">← '.$lang['prev'].'</a> | ' : '').$lang['page'].$_GET['post'].' of '.$total.($_GET['post'] < $total? ' | <a href="index.php?post='.($_GET['post']+1).'">'.$lang['next'].' →</a>' : '').'</h4>';
}

require 'footer.php';
?>
