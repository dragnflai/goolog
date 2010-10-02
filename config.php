<?php

require 'header.php';

if(isset($_SESSION['admin']))
{
	if(isset($_POST['password'][0], $_POST['title'][0], $_POST['theme'][0], $_POST['lang'][0]))
	{
		db_q('UPDATE conf SET value = \''.$_POST['password'].'\' WHERE name = \'password\'');
		db_q('UPDATE conf SET value = \''.$_POST['title'].'\' WHERE name = \'title\'');
		db_q('UPDATE conf SET value = \''.$_POST['theme'].'\' WHERE name = \'theme\'');
		db_q('UPDATE conf SET value = \''.$_POST['lang'].'\' WHERE name = \'lang\'');
		$data['meta'] = $lang['config'].$lang['saved'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="index.php?post">← '.$lang['redirect'].': '.$lang['post'].'</a></h4>';
	}
	else
	{
		$_theme = glob('theme/*.css');
		$_locale = glob('lang/*.php');
		$data['meta'] = $lang['config'];
		$data['body'].= '<form action="config.php" method="post">
		<h1>'.$data['meta'].'</h1>
		<h4>'.$lang['password'].'</h4>
		<h4><input type="password" name="password" value="'.$data['pass'].'"/></h4>
		<h4>'.$lang['blog_name'].'</h4>
		<h4><input name="title" value="'.$data['head'].'"/></h4>
		<h4>'.$lang['theme'].'</h4>
		<h4><select name="theme">';
		foreach($_theme as $theme)
		{
			$value = basename($theme,'.css');
			$data['body'].= '<option value="'.$value.'">'.$value.'</theme>';
		}
		$data['body'].= '</select></h4>
		<h4>'.$lang['lang'].'</h4>
		<h4><select name="lang">';
		foreach($_locale as $locale)
		{
			$value = basename($locale,'.php');
			$data['body'].= '<option value="'.$value.'">'.$value.'</theme>';
		}
		$data['body'].= '</select></h4>
		<h4><input type="submit"/></h4>
		</form>';
	}
}


require 'footer.php';
?>
