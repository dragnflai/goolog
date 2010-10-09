<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	if(isset($_POST['title'][0], $_POST['content'][0]))
	{
		db_q($db, 'UPDATE post SET title = \'' .$_POST['title']. '\', content = \'' .$_POST['content']. '\' WHERE id = \'' .$_GET['post']. '\'');
		$data['meta'] = $lang['post'].$lang['saved'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "view.php?post=' .$_GET['post']. '">← ' .$lang['redirect']. ': ' .htmlspecialchars($_POST['title']). '</a></p>';
	}
	else
	{
		$post = db_qrs($db, 'SELECT title, content FROM post WHERE id = \'' .$_GET['post']. '\'');
		$data['meta'] = $lang['edit'].$lang['post'];
		$data['body'] .= '<form action = "edit.php?post=' .$_GET['post']. '" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['title']. ' <input name = "title" value = "' .htmlspecialchars($post['title']). '"/></p>
		<p>' .$lang['content']. '</p>
		<p><textarea name = "content" cols = "60" rows = "20">' .htmlspecialchars($post['content']). '</textarea></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}

else if(isset($_GET['comment'], $_SESSION['admin']))
{
	if(isset($_POST['author'][0], $_POST['content'][0]))
	{
		db_q($db, 'UPDATE comment SET author =\'' .$_POST['author']. '\', content = \'' .$_POST['content']. '\' WHERE id = \'' .$_GET['comment']. '\'');
		$post = db_qrs($db, 'SELECT id, title FROM post WHERE id = ( SELECT pid FROM comment WHERE id = \'' .$_GET['comment']. '\')');
		$data['meta'] = $lang['comment'].$lang['saved'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "view.php?post=' .$post['id']. '">← ' .$lang['redirect']. ': ' .htmlspecialchars($post['title']). '</a></p>';
	}
	else
	{
		$comment = db_qrs($db, 'SELECT author, content FROM comment WHERE id = \'' .$_GET['comment']. '\'');
		$data['meta'] = $lang['edit'].$lang['comment'];
		$data['body'] .= '<form action = "edit.php?comment=' .$_GET['comment']. '" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['name']. ' <input name = "author" value = "' .htmlspecialchars($comment['author']). '"/></p>
		<p>' .$lang['content']. '</p>
		<p><textarea name = "content" cols = "60" rows = "20">' .htmlspecialchars($comment['content']). '</textarea></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}

else if(isset($_GET['link'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0], $_POST['url'][0]))
	{
		db_q($db, 'UPDATE link SET name = \'' .$_POST['name']. '\', url = \'' .$_POST['url']. '\' WHERE id =\'' .$_GET['link']. '\'');
		$data['meta'] = $lang['link'].$lang['saved'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "index.php?more">← ' .$lang['redirect']. ': ' .$lang['more']. '</a></p>';
	}
	else
	{
		$link = db_qrs($db, 'SELECT name, url FROM link WHERE id = \'' .$_GET['link']. '\'');
		$data['meta'] = $lang['edit'].$lang['link'];
		$data['body'] .= '<form action = "edit.php?link=' .$_GET['link']. '" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['name']. ' <input name = "name" value = "' .htmlspecialchars($link['name']). '"/></p>
		<p>' .$lang['url']. ' <input name = "url" value = "' .htmlspecialchars($link['url']). '"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}

else if(isset($_GET['category'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0]))
	{
		db_q($db, 'UPDATE category SET name = \'' .$_POST['name']. '\' WHERE id =\'' .$_GET['category']. '\'');
		$data['meta'] = $lang['category'].$lang['saved'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "index.php?more">← ' .$lang['redirect']. ': ' .$lang['more']. '</a></p>';
	}
	else
	{
		$category = db_qrs($db, 'SELECT name FROM category WHERE id = \'' .$_GET['category']. '\'');
		$data['meta'] = $lang['edit'].$lang['category'];
		$data['body'] .= '<form action = "edit.php?category=' .$_GET['category']. '" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['name']. ' <input name = "name" value = "' .htmlspecialchars($category['name']). '"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else
{
	header('Location: index.php');
}

require 'footer.php';
?>
