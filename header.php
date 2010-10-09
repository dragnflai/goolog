<?php

//check if goolog is installed
if(!is_file('data/db.sqlite')) die(header('Location: install.php'));

session_start();
header('Content-Type: text/html; charset=UTF-8'); 

//load config
require 'include/sqlite.php';
$db = db_open();

$config = db_qr($db, 'SELECT value FROM config');
$data['head'] = $config[0]['value'];
$data['pass'] = $config[1]['value'];
$data['theme'] = $config[2]['value'];
$data['lang'] = $config[3]['value'];
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
