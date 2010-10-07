<?php

//check if goolog is installed
if(!is_file('data/db.sqlite')) die('Please <a href = "install.php">install</a>');

session_start();

//load config
require 'include/sqlite.php';

header('Content-Type: text/html; charset=UTF-8'); 

$conf = db_qr('SELECT value FROM conf');
$data['head'] = $conf[0]['value'];
$data['pass'] = $conf[1]['value'];
$data['theme'] = $conf[2]['value'];
$data['lang'] = $conf[3]['value'];
$data['body'] = '';

setlocale(LC_ALL, $data['lang']. '.UTF-8');
require 'lang/' .$data['lang']. '.php';

// remove $_POST slash and escape sql

if(isset($_POST))
{
	if(get_magic_quotes_gpc()) $_POST = array_map('stripslashes', $_POST);
	$_POST = array_map('sqlite_escape_string', $_POST);
}

// escape sql

if(isset($_GET)) $_GET = array_map('sqlite_escape_string', $_GET);

?>
