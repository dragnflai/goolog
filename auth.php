<?php

require 'header.php';

if(isset($_GET['login']))
{
	if(isset($_POST['password']) && $_POST['password'] === $data['password'])
	{
		$_SESSION['admin'] = true;
		$data['subtitle'] = $lang['logged_in'];
		$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
		<p><a href = "index.php?post">← ' .$lang['redirect']. '：' .$lang['post']. '</a></p>';
	}
	else
	{
		$data['subtitle'] = $lang['login'];
		$data['content'] .= '<form action = "auth.php?login" method = "post">
		<h1>' .$data['subtitle']. '</h1>
		<p>' .$lang['password']. ' <input type = "password" name = "password"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
else if(isset($_GET['logout'], $_SESSION['admin']))
{
	unset($_SESSION['admin']);
	$data['subtitle'] = $lang['logged_out'];
	$data['content'] .= '<h1>' .$data['subtitle']. '</h1>
	<p><a href = "index.php?post">← ' .$lang['redirect']. '：' .$lang['post']. '</a></p>';
}
else
{
	header('Location: index.php?post');
}

$template = 'main';
require 'footer.php';
?>
