<?php
require 'header.php';

if(isset($_GET['post'], $_SESSION['admin']))
{
	$post = db_qrs('SELECT title FROM post WHERE id = \''.$_GET['post'].'\'');
	if(isset($_POST['pid']))
	{
		db_q('UPDATE post SET pid = \''.$_POST['pid'].'\' WHERE id = \''.$_GET['post'].'\'');
		$data['meta'] = $lang['post'].$lang['categorized'];
		$data['body'].= '<h1>'.$data['meta'].'</h1>
		<h4><a href="view.php?post='.$_GET['post'].'">← '.$lang['redirect'].': '.htmlspecialchars($post['title']).'</a></h4>';
	}
	else
	{
		$data['meta'] = $lang['categorize'].$lang['post'].': '.htmlspecialchars($post['title']);
		$data['body'].= '<form action="categorize.php?post='.$_GET['post'].'" method="post">
		<h1>'.$data['meta'].'</h1>';
		$categories = db_qr('SELECT * FROM category');
		foreach($categories as $category)
		{
			$data['body'].= '<h4><input type="radio" name="pid" value="'.$category['id'].'"/>'.htmlspecialchars($category['name']).'</h4>';
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
