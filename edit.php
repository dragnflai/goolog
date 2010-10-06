<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	if(isset($_POST['title'][0], $_POST['content'][0]))
	{
		db_q('UPDATE post SET title = \''.$_POST['title'].'\', content = \''.$_POST['content'].'\' WHERE id = \''.$_GET['post'].'\'');
		$data['meta'] = $lang['post'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="view.php?post='.$_GET['post'].'">← '.$lang['redirect'].': '.htmlspecialchars($_POST['title']).'</a></h4>';
	}
	else
	{
		$post = db_qrs('SELECT title, content FROM post WHERE id = \''.$_GET['post'].'\'');
		$data['meta'] = $lang['edit'].$lang['post'];
		$data['body'].= '<form action="edit.php?post='.$_GET['post'].'" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['title'].'</h4>
		<h4><input name="title" value="'.htmlspecialchars($post['title']).'"/></h4>
		<h4>'.$lang['content'].'</h4>
		<h4><textarea name="content" cols="60" rows="20">'.htmlspecialchars($post['content']).'</textarea></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['comment'], $_SESSION['admin']))
{
	if(isset($_POST['author'][0], $_POST['content'][0]))
	{
		db_q('UPDATE comment SET author =\''.$_POST['author'].'\', content = \''.$_POST['content'].'\' WHERE id = \''.$_GET['comment'].'\'');
		$post = db_qrs('SELECT id, title FROM post WHERE id = ( SELECT pid FROM comment WHERE id = \''.$_GET['comment'].'\')');
		$data['meta'] = $lang['comment'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="view.php?post='.$post['id'].'">← '.$lang['redirect'].': '.htmlspecialchars($post['title']).'</a></h4>';
	}
	else
	{
		$comment = db_qrs('SELECT author, content FROM comment WHERE id = \''.$_GET['comment'].'\'');
		$data['meta'] = $lang['edit'].$lang['comment'];
		$data['body'].= '<form action="edit.php?comment='.$_GET['comment'].'" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['name'].'</h4>
		<h4><input name="author" value="'.htmlspecialchars($comment['author']).'"/></h4>
		<h4>'.$lang['content'].'</h4>
		<h4><textarea name="content" cols="60" rows="20">'.htmlspecialchars($comment['content']).'</textarea></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['link'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0], $_POST['url'][0]))
	{
		db_q('UPDATE link SET name = \''.$_POST['name'].'\', url = \''.$_POST['url'].'\' WHERE id =\''.$_GET['link'].'\'');
		$data['meta'] = $lang['link'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?more">← '.$lang['redirect'].': '.$lang['more'].'</a></h4>';
	}
	else
	{
		$link = db_qrs('SELECT name, url FROM link WHERE id = \''.$_GET['link'].'\'');
		$data['meta'] = $lang['edit'].$lang['link'];
		$data['body'].= '<form action="edit.php?link='.$_GET['link'].'" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['name'].'</h4>
		<h4><input name="name" value="'.htmlspecialchars($link['name']).'"/></h4>
		<h4>'.$lang['url'].'</h4>
		<h4><input name="url" value="'.htmlspecialchars($link['url']).'"/></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['category'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0]))
	{
		db_q('UPDATE category SET name = \''.$_POST['name'].'\' WHERE id =\''.$_GET['category'].'\'');
		$data['meta'] = $lang['category'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?more">← '.$lang['redirect'].': '.$lang['more'].'</a></h4>';
	}
	else
	{
		$category = db_qrs('SELECT name FROM category WHERE id = \''.$_GET['category'].'\'');
		$data['meta'] = $lang['edit'].$lang['category'];
		$data['body'].= '<form action="edit.php?category='.$_GET['category'].'" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4><input name="name" value="'.htmlspecialchars($category['name']).'"/></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}
else
{
	header('Location: index.php');
}

require 'footer.php';
?>
