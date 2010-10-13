<?php

require 'header.php';

if(isset($_SESSION['admin']))
{
	if(isset($_POST['password'][0], $_POST['title'][0], $_POST['theme'][0], $_POST['lang'][0]))
	{
		db_q($db, 'UPDATE config SET value = \'' .$_POST['password']. '\' WHERE name = \'password\'');
		db_q($db, 'UPDATE config SET value = \'' .$_POST['title']. '\' WHERE name = \'title\'');
		db_q($db, 'UPDATE config SET value = \'' .$_POST['theme']. '\' WHERE name = \'theme\'');
		db_q($db, 'UPDATE config SET value = \'' .$_POST['lang']. '\' WHERE name = \'lang\'');
		$data['subtitle'] = $lang['config'].$lang['saved'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "index.php?post">← ' .$lang['redirect']. '：' .$lang['post']. '</a></p>';
	}
	else
	{
		$themes = glob('theme/*.css');
		$languages = glob('lang/*.php');
		$data['subtitle'] = $lang['config'];
		$data['content'] .= '<form action = "config.php" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['password']. ' <input type = "password" name = "password" value = "' .$data['password']. '"/></p>
		<p>' .$lang['blog_name']. ' <input name = "title" value = "' .$data['title']. '"/></p>
		<p>' .$lang['theme']. ' <select name = "theme">';
		foreach($themes as &$theme)
		{
			$value = basename($theme, '.css');
			$data['content'] .= '<option value = "' .$value. '">' .$value. '</option>';
		}
		$data['content'] .= '</select></p>
		<p>' .$lang['language']. ' <select name = "lang">';
		foreach($languages as &$language)
		{
			$value = basename($language, '.php');
			$data['content'] .= '<option value = "' .$value. '">' .$value. '</option>';
		}
		$data['content'] .= '</select></p>
		<p><input type = "submit"/></p>
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
