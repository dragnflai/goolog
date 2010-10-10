<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	if(isset($_POST['title'][0], $_POST['content'][0]))
	{
		db_q($db, 'INSERT INTO post (date, title, content) VALUES (' .time(). ', \'' .$_POST['title']. '\', \'' .$_POST['content']. '\')');
		$data['subtitle'] = $lang['post'].$lang['saved'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "index.php?post">← ' .$lang['redirect']. '：' .$lang['post']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['add'].$lang['post'];
		$data['content'] .= '<form action = "add.php?post" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['title']. ' <input name = "title"/></p>
		<p>' .$lang['content']. '</p>
		<p>[b] [i] [u] [s] [img] [url] [youtube]</p>
		<p><textarea name = "content" cols = "60" rows = "20"></textarea></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else if(isset($_GET['comment']))
{
	$post = db_qrs($db, 'SELECT title FROM post WHERE id = \'' .$_GET['comment']. '\'');
	if(isset($_POST['author'][0], $_POST['content'][0], $_POST['bot']) && !isset($_POST['bot'][0]))
	{
		db_q($db, 'INSERT INTO comment (pid, date, author, content) VALUES (\'' .$_GET['comment']. '\', ' .time(). ', \'' .$_POST['author']. '\', \'' .$_POST['content']. '\')');
		$data['subtitle'] = $lang['comment'].$lang['saved'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "view.php?post=' .$_GET['comment']. '">← ' .$lang['redirect']. '：' .$post['title']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['add'].$lang['comment']. '：' .$post['title'];
		$data['content'] .= '<form action = "add.php?comment=' .$_GET['comment']. '" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['name']. ' <input name = "author"/></p>
		<p>' .$lang['content']. '</p>
		<p>[b] [i] [u] [s] [img] [url] [youtube]</p>
		<p><textarea name = "content" cols = "60" rows = "20"></textarea></p>
		<p>' .$lang['bot']. ' <input name = "bot"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else if(isset($_GET['link'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0], $_POST['url'][0]))
	{
		db_q($db, 'INSERT INTO link (name, url) VALUES (\'' .$_POST['name']. '\', \'' .$_POST['url']. '\')');
		$data['subtitle'] = $lang['link'].$lang['saved'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "index.php?more">← ' .$lang['redirect']. '：' .$lang['more']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['add'].$lang['link'];
		$data['content'] .= '<form action = "add.php?link" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['name']. ' <input name = "name"/></p>
		<p>' .$lang['url']. ' <input name = "url"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else if(isset($_GET['category'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0]))
	{
		db_q($db, 'INSERT INTO category (name) VALUES (\'' .$_POST['name']. '\')');
		$data['subtitle'] = $lang['category'].$lang['saved'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "index.php?more">← ' .$lang['redirect']. '：' .$lang['more']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['add'].$lang['category'];
		$data['content'] .= '<form action = "add.php?category" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['name']. ' <input name = "name"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else
{
	header('Location: index.php');
}

$template = 'main';
require 'footer.php';
?>
