<?php
require 'header.php';
$data['meta'] = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
$data['body'].= '<feed xmlns="http://www.w3.org/2005/Atom">
<id>'.$data['meta'].'feed.php</id>
<title>'.$data['head'].'</title>
<updated>'.strftime('%Y-%m-%dT%H:%M:%S%z').'</updated>
<link href="'.$data['meta'].'feed.php" rel="self"/>
<author><name>'.$lang['powered_by'].' Goolog</name></author>';
$_ps = db_qr('SELECT * FROM post ORDER BY id DESC LIMIT 4');
foreach($_ps as $ps)
{
	$data['body'].= '<entry>
	<id>'.$data['meta'].'view.php?post='.$ps['id'].'</id>
	<title>'.htmlspecialchars($ps['title']).'</title>
	<updated>'.strftime('%Y-%m-%dT%H:%M:%S%z', $ps['date']).'</updated>
	<link href="'.$data['meta'].'view.php?post='.$ps['id'].'"/>
	<summary type="html">'.htmlspecialchars($ps['content']).'</summary>
	</entry>';
}
$data['body'].= '</feed>';
echo $data['body'];

?>
