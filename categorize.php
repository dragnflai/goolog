<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	$post = db_qrs($db, 'SELECT title FROM post WHERE id = \'' .$_GET['post']. '\'');
	if(isset($_POST['pid']))
	{
		db_q($db, 'UPDATE post SET pid = \'' .$_POST['pid']. '\' WHERE id = \'' .$_GET['post']. '\'');
		$data['subtitle'] = $lang['post'].$lang['categorized'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "view.php?post=' .$_GET['post']. '">← ' .$lang['redirect']. '：' .$post['title']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['categorize'].$lang['post']. '：' .$post['title'];
		$data['content'] .= '<form action = "categorize.php?post=' .$_GET['post']. '" method = "post">
		<h1>' .$data['subtitle']. '</h1>';
		$categories = db_qr($db, 'SELECT id, name FROM category');
		foreach($categories as &$category)
		{
			$data['content'] .= '<p><input type = "radio" name = "pid" value = "' .$category['id']. '"/>' .$category['name']. '</p>';
		}
		$data['content'] .= '<p><input type = "submit"/></p>
		</form>';
	}
}
else
{
	header('Location: index.php?post');
}

$template = 'main';
require 'footer.php';
?>
