<?php
require 'header.php';
require 'include/bbcode.php';

$data['url'] = 'http://' .$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);

if(isset($_GET['post']))
{
	$data['subtitle'] = $lang['post'];
	$posts = db_qr($db, 'SELECT id, date, title, content FROM post ORDER BY id DESC LIMIT 4');
	foreach($posts as &$post)
	{
		$data['content'] .= '<entry>
		<id>' .$data['url']. 'view.php?post=' .$post['id']. '</id>
		<title>' .$post['title']. '</title>
		<updated>' .strftime('%Y-%m-%dT%H:%M:%S%z', $post['date']). '</updated>
		<link href = "' .$data['url']. 'view.php?post=' .$post['id']. '"/>
		<summary type = "html">' .htmlspecialchars(bbcode($post['content'])). '</summary>
		</entry>';
	}
}
else if(isset($_GET['comment']))
{
	$data['subtitle'] = $lang['comment'];
	$comments = db_qr($db, 'SELECT pid, date, author, content FROM comment ORDER BY id DESC LIMIT 4');
	foreach($comments as &$comment)
	{
		$data['content'] .= '<entry>
		<id>' .$data['url']. 'view.php?post=' .$comment['pid']. '</id>
		<title>' .$comment['author']. '</title>
		<updated>' .strftime('%Y-%m-%dT%H:%M:%S%z', $comment['date']). '</updated>
		<link href = "' .$data['url']. 'view.php?post=' .$comment['pid']. '"/>
		<summary type = "html">' .htmlspecialchars(bbcode($comment['content'])). '</summary>
		</entry>';
	}
}
else
{
	header('Location: feed.php?post');
}

$template = 'feed';
require 'footer.php';
?>
