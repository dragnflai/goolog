<?php

require 'header.php';

if(isset($_SESSION['admin']))
{
	if(isset($_POST['password'][0], $_POST['title'][0], $_POST['theme'][0], $_POST['lang'][0]))
	{
		db_q('UPDATE conf SET value = \'' .$_POST['password']. '\' WHERE name = \'password\'');
		db_q('UPDATE conf SET value = \'' .$_POST['title']. '\' WHERE name = \'title\'');
		db_q('UPDATE conf SET value = \'' .$_POST['theme']. '\' WHERE name = \'theme\'');
		db_q('UPDATE conf SET value = \'' .$_POST['lang']. '\' WHERE name = \'lang\'');
		$data['meta'] = $lang['config'].$lang['saved'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "index.php?post">← ' .$lang['redirect']. ': ' .$lang['post']. '</a></p>';
	}
	else
	{
		$themes = glob('theme/*.css');
		$languages = glob('lang/*.php');
		$data['meta'] = $lang['config'];
		$data['body'] .= '<form action = "config.php" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['password']. ' <input type = "password" name = "password" value = "' .$data['pass']. '"/></p>
		<p>' .$lang['blog_name']. ' <input name = "title" value = "' .$data['head']. '"/></p>
		<p>' .$lang['theme']. ' <select name = "theme">';
		foreach($themes as $theme)
		{
			$value = basename($theme, '.css');
			$data['body'] .= '<option value = "' .$value. '">' .$value. '</option>';
		}
		$data['body'] .= '</select></p>
		<p>' .$lang['lang']. ' <select name = "lang">';
		foreach($languages as $language)
		{
			$value = basename($language, '.php');
			$data['body'] .= '<option value = "' .$value. '">' .$value. '</option>';
		}
		$data['body'] .= '</select></p>
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
