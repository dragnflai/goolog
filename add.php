<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	if(isset($_POST['title'][0], $_POST['content'][0]))
	{
		db_q('INSERT INTO post (date, title, content) VALUES ('.time().', \''.$_POST['title'].'\', \''.$_POST['content'].'\')');
		$data['meta'] = $lang['post'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?post">← '.$lang['redirect'].': '.$lang['post'].'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['add'].$lang['post'];
		$data['body'].= '<form action="add.php?post" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['title'].'</h4>
		<h4><input name="title"/></h4>
		<h4>'.$lang['content'].'</h4>
		<h4><textarea name="content" cols="60" rows="20"></textarea></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['comment']))
{
	$_ps = db_qrs('SELECT title FROM post WHERE id = \''.$_GET['comment'].'\'');
	if(isset($_POST['author'][0], $_POST['content'][0], $_POST['bot']) && !isset($_POST['bot'][0]))
	{
		db_q('INSERT INTO comment (pid, date, author, content) VALUES (\''.$_GET['comment'].'\', '.time().', \''.$_POST['author'].'\', \''.$_POST['content'].'\')');
		$data['meta'] = $lang['comment'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="view.php?post='.$_GET['comment'].'">← '.$lang['redirect'].': '.$_ps['title'].'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['add'].$lang['comment'].': '.htmlspecialchars($_ps['title']);
		$data['body'].= '<form action="add.php?comment='.$_GET['comment'].'" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['name'].'</h4>
		<h4><input name="author"/></h4>
		<h4>'.$lang['content'].'</h4>
		<h4><textarea name="content" cols="60" rows="20"></textarea></h4>
		<h4>'.$lang['bot'].'</h4>
		<h4><input name="bot"/></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['link'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0], $_POST['url'][0]))
	{
		db_q('INSERT INTO link (name, url) VALUES (\''.$_POST['name'].'\', \''.$_POST['url'].'\')');
		$data['meta'] = $lang['link'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?more">← '.$lang['redirect'].': '.$lang['more'].'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['add'].$lang['link'];
		$data['body'].= '<form action="add.php?link" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['name'].'</h4>
		<h4><input name="name"/></h4>
		<h4>'.$lang['url'].'</h4>
		<h4><input name="url"/></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}

elseif(isset($_GET['category'], $_SESSION['admin']))
{
	if(isset($_POST['name'][0]))
	{
		db_q('INSERT INTO category (name) VALUES (\''.$_POST['name'].'\')');
		$data['meta'] = $lang['category'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?more">← '.$lang['redirect'].': '.$lang['more'].'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['add'].$lang['category'];
		$data['body'].= '<form action="add.php?category" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4><input name="name"/></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}


require 'footer.php';
?>
