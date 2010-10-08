<?php

require 'header.php';

if(isset($_GET['login']))
{
	if(isset($_POST['password']) && $_POST['password'] === $data['pass'])
	{
		$_SESSION['admin'] = true;
		$data['meta'] = $lang['logged_in'];
		$data['body'] .= '<h1>' .$data['meta']. '</h1>
		<p><a href = "index.php?post">← ' .$lang['redirect']. ': ' .$lang['post']. '</a></p>';
	}
	else
	{
		$data['meta'] = $lang['login'];
		$data['body'] .= '<form action = "auth.php?login" method = "post">
		<h1>' .$data['meta']. '</h1>
		<p>' .$lang['password']. ' <input type = "password" name = "password"/></p>
		<p><input type = "submit"/></p>
		</form>';
	}
}
elseif(isset($_GET['logout'], $_SESSION['admin']))
{
	unset($_SESSION['admin']);
	$data['meta'] = $lang['logged_out'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p><a href = "index.php?post">← ' .$lang['redirect']. ': ' .$lang['post']. '</a></p>';
}
else
{
	header('Location: index.php');
}

require 'footer.php';

?>
