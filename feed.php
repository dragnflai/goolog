<?php
require 'header.php';
$data['meta'] = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
$data['body'].= '<feed xmlns="http://www.w3.org/2005/Atom">
<id>'.$data['meta'].'feed.php</id>
<title>'.$data['head'].'</title>
<updated>'.strftime('%Y-%m-%dT%H:%M:%S%z').'</updated>
<link href="'.$data['meta'].'feed.php" rel="self"/>
<author><name>'.$lang['powered_by'].' Goolog</name></author>';
$posts = db_qr('SELECT * FROM post ORDER BY id DESC LIMIT 4');
foreach($posts as $post)
{
	$data['body'].= '<entry>
	<id>'.$data['meta'].'view.php?post='.$post['id'].'</id>
	<title>'.htmlspecialchars($post['title']).'</title>
	<updated>'.strftime('%Y-%m-%dT%H:%M:%S%z', $post['date']).'</updated>
	<link href="'.$data['meta'].'view.php?post='.$post['id'].'"/>
	<summary type="html">'.htmlspecialchars($post['content']).'</summary>
	</entry>';
}
$data['body'].= '</feed>';
echo $data['body'];

?>
