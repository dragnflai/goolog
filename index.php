<?php

require 'header.php';

//run goolog

if(isset($_GET['post']))
{
	$data['meta'] = $lang['post'];
	$data['body'] .= '<h1>' .(isset($_SESSION['admin'])? '<a href = "add.php?post">[+]</a>' : '').$data['meta']. '</h1>';
	$count = db_qrs('SELECT count(*) FROM post');
	$total = ceil($count['count(*)']/4);
	if($_GET['post'] < 1 || $_GET['post'] > $total) $_GET['post']=1;
	$offset = 4*($_GET['post']-1);
	$posts = db_qr('SELECT * FROM post ORDER BY id DESC LIMIT 4 OFFSET ' .$offset);
	foreach($posts as $post)
	{
		$count = db_qrs('SELECT count(*) FROM comment WHERE pid = ' .$post['id']);
		$category = db_qrs('SELECT name FROM category WHERE id = ' .$post['pid']);
		$data['body'] .= '<h3>' .(isset($_SESSION['admin'])? '<a href = "categorize.php?post=' .$post['id']. '">[#]</a><a href = "edit.php?post=' .$post['id']. '">[!]</a><a href = "delete.php?post=' .$post['id']. '">[x]</a>' : '').htmlspecialchars($post['title']). '</h3>

		<p>' .nl2br($post['content']). '</p>
		<p><a href = "view.php?post=' .$post['id']. '">' .$lang['read_more']. '</a></p>
		<div class = "meta"><ul>
		<li><a href = "view.php?category=' .$post['pid']. '">' .htmlspecialchars($category['name']). '</a></li>
		<li>' .$lang['comment']. ' (' .$count['count(*)']. ')</li>
		<li>' .strftime('%B %e, %Y, %l:%M %p', $post['date']). '</li>
		</ul></div>';

	}
	$data['body'] .= '<div id = "page"><ul>' .
	($_GET['post'] > 1? '<li><a href = "index.php?post=' .($_GET['post']-1). '">← ' .$lang['prev']. '</a></li>' : '').
	'<li>' .$lang['page'].$_GET['post']. ' of ' .$total. '</li>' .
	($_GET['post'] < $total? '<li><a href = "index.php?post=' .($_GET['post']+1). '">' .$lang['next']. ' →</a></li>' : '').
	'</ul></div>';
}
elseif(isset($_GET['comment']))
{
	$data['meta'] = $lang['comment'];
	$data['body'] .= '<h1>' .$data['meta']. '</h1>';
	$count = db_qrs('SELECT count(*) FROM comment');
	$total = ceil($count['count(*)']/4);
	if($_GET['comment'] < 1 || $_GET['comment'] > $total) $_GET['comment']=1;
	$offset = 4*($_GET['comment']-1);
	$comments = db_qr('SELECT * FROM comment ORDER BY id DESC LIMIT 4 OFFSET ' .$offset);
	foreach($comments as $comment)
	{
		$data['body'] .= '<h3>' .(isset($_SESSION['admin'])? '<a href = "edit.php?comment=' .$comment['id']. '">[!]</a><a href = "delete.php?comment=' .$comment['id']. '">[x]</a>' : '').htmlspecialchars($comment['author']).$lang['said']. ' ...</h3>
		<p>' .$comment['content']. '</p>
		<p><a href = "view.php?post=' .$comment['pid']. '">' .$lang['read_more']. '</a></p>
		<div class = "meta"><ul><li>' .strftime('%B %e, %Y, %l:%M %p', $comment['date']). '</li></ul></div>';
	}
	$data['body'] .= '<div id = "page"><ul>' .
	($_GET['comment'] > 1? '<li><a href = "index.php?comment=' .($_GET['comment']-1). '">← ' .$lang['prev']. '</a></li>' : '').
	'<li>' .$lang['page'].$_GET['comment']. ' of ' .$total. '</li>' .
	($_GET['comment'] < $total? '<li><a href = "index.php?comment=' .($_GET['comment']+1). '">' .$lang['next']. ' →</a></li>' : '').
	'</ul></div>';
}


elseif(isset($_GET['more']))
{
	$data['meta'] = $lang['more'];
	$data['body'] .= '<form action = "index.php?more" method = "post">
	<h1>' .$lang['search']. '</h1>
	<p><input name = "search"/> <input type = "submit"/></p>
	</form>';
	if(isset($_POST['search'][0]))
	{
		$posts = db_qr('SELECT id, title FROM post WHERE title LIKE \'%' .$_POST['search']. '%\' OR content LIKE \'%' .$_POST['search']. '%\'');
		$data['body'] .= '<ul>';
		foreach($posts as $post)
		{
			$data['body'] .= '<li>' .(isset($_SESSION['admin'])? '<a href = "categorize.php?post=' .$post['id']. '">[#]</a><a href = "edit.php?post=' .$post['id']. '">[!]</a><a href = "delete.php?post=' .$post['id']. '">[x]</a>' : ''). '<a href = "view.php?post=' .$post['id']. '">' .htmlspecialchars($post['title']). '</a></li>';
		}
		$data['body'] .= '</ul>';
	}
	$data['body'] .= '<h1>' .(isset($_SESSION['admin'])? '<a href = "add.php?link">[+]</a>' : '').$lang['link']. '</h1>';
	$links = db_qr('SELECT * FROM link');
	$data['body'] .= '<ul>';
	foreach($links as $link)
	{
		$data['body'] .= '<li>' .(isset($_SESSION['admin'])? '<a href = "edit.php?link=' .$link['id']. '">[!]</a><a href = "delete.php?link=' .$link['id']. '">[x]</a>' : ''). '<a href = "' .$link['url']. '">' .$link['name']. '</a></li>';
	}
	$data['body'] .= '</ul>';
	$data['body'] .= '<h1>' .(isset($_SESSION['admin'])? '<a href = "add.php?category">[+]</a>' : '').$lang['category']. '</h1>';
	$categories = db_qr('SELECT * FROM category');
	$data['body'] .= '<ul>';
	foreach($categories as $category)
	{
		$count = db_qrs('SELECT count(*) FROM post WHERE pid = ' .$category['id']);
		$data['body'] .= '<li>' .(isset($_SESSION['admin'])? '<a href = "edit.php?category=' .$category['id']. '">[!]</a><a href = "delete.php?category=' .$category['id']. '">[x]</a>' : ''). '<a href = "view.php?category=' .$category['id']. '">' .htmlspecialchars($category['name']). ' (' .$count['count(*)']. ')</a></li>';
	}
	$data['body'] .= '</ul>';
	$data['body'] .= '<h1>' .$lang['archive']. '</h1>';
	$archives = db_qr('SELECT DISTINCT strftime(\'%Y-%m\', date, \'unixepoch\') FROM post');
	$data['body'] .= '<ul>';
	foreach($archives as $archive)
	{
		$count = db_qrs('SELECT count(*) FROM post WHERE strftime(\'%Y-%m\', date, \'unixepoch\') = \'' .$archive['strftime(\'%Y-%m\', date, \'unixepoch\')']. '\'');
		$data['body'] .= '<li><a href = "view.php?archive=' .$archive['strftime(\'%Y-%m\', date, \'unixepoch\')']. '">' .strftime('%B %Y', strtotime($archive['strftime(\'%Y-%m\', date, \'unixepoch\')'])). ' (' .$count['count(*)']. ')</a></li>';
	}
	$data['body'] .= '</ul>';
}
else
{
	header('Location: index.php?post');
}

require 'footer.php';
?>
