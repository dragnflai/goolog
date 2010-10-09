<?php
require 'header.php';
require 'include/bbcode.php';

$data['url'] = 'http://' .$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);

if(isset($_GET['post']))
{
	$data['meta'] = $lang['post'];
	$posts = db_qr($db, 'SELECT * FROM post ORDER BY id DESC LIMIT 4');
	foreach($posts as $post)
	{
		$data['body'] .= '<entry>
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
	$data['meta'] = $lang['comment'];
	$comments = db_qr($db, 'SELECT * FROM comment ORDER BY id DESC LIMIT 4');
	foreach($comments as $comment)
	{
		$data['body'] .= '<entry>
		<id>' .$data['url']. 'view.php?comment=' .$comment['id']. '</id>
		<title>' .$comment['author']. '</title>
		<updated>' .strftime('%Y-%m-%dT%H:%M:%S%z', $comment['date']). '</updated>
		<link href = "' .$data['url']. 'view.php?comment=' .$comment['id']. '"/>
		<summary type = "html">' .htmlspecialchars(bbcode($comment['content'])). '</summary>
		</entry>';
	}
}

else
{
	header('Location: feed.php?post');
}

require 'template/feed.tpl.php';
?>
