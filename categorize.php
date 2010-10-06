<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	$_ps = db_qrs('SELECT title FROM post WHERE id = \''.$_GET['post'].'\'');
	if(isset($_POST['pid']))
	{
		db_q('UPDATE post SET pid = \''.$_POST['pid'].'\' WHERE id = \''.$_GET['post'].'\'');
		$data['meta'] = $lang['post'].$lang['categorized'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="view.php?post='.$_GET['post'].'">← '.$lang['redirect'].': '.htmlspecialchars($_ps['title']).'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['categorize'].$lang['post'].': '.htmlspecialchars($_ps['title']);
		$data['body'].= '<form action="categorize.php?post='.$_GET['post'].'" method="post">
		<h1>'.$data['meta'].'</h1>';
		$_ct = db_qr('SELECT * FROM category');
		foreach($_ct as $ct)
		{
			$data['body'].= '<h4><input type="radio" name="pid" value="'.$ct['id'].'"/>'.htmlspecialchars($ct['name']).'</h4>';
		}
		$data['body'].= '<h4><input type="submit"/></h4>
		</form>';
	}
}
else
{
	header('Location: index.php');
}

require 'footer.php';
?>
