<?php

//add db if it does not exist
require 'include/sqlite.php';

function create_db()
{	
	db_q('CREATE TABLE post (
	id INTEGER PRIMARY KEY NOT NULL,
	pid INTEGER NOT NULL DEFAULT 1,
	date INTEGER NOT NULL,
	title TEXT NOT NULL,
	content TEXT NOT NULL
	)');
	
	db_q('CREATE TABLE comment (
	id INTEGER PRIMARY KEY NOT NULL,
	pid INTEGER NOT NULL,
	date INTEGER NOT NULL,
	author TEXT NOT NULL,
	content TEXT NOT NULL
	)');
	
	db_q('CREATE TABLE link (
	id INTEGER PRIMARY KEY NOT NULL,
	name TEXT NOT NULL,
	url TEXT NOT NULL
	)');
	
	db_q('CREATE TABLE category (
	id INTEGER PRIMARY KEY NOT NULL,
	name TEXT NOT NULL
	)');
	
	db_q('CREATE TABLE conf (
	name TEXT PRIMARY KEY NOT NULL,
	value TEXT NOT NULL
	)');
	
	db_q('CREATE INDEX post_pid_index ON post (pid)');
	db_q('CREATE INDEX comment_pid_index ON comment (pid)');
	
	db_q('INSERT INTO conf (name, value) VALUES (\'title\', \'Goolog demo\')');
	db_q('INSERT INTO conf (name, value) VALUES (\'password\', \'demo\')');
	db_q('INSERT INTO conf (name, value) VALUES (\'theme\', \'classic\')');
	db_q('INSERT INTO conf (name, value) VALUES (\'lang\', \'en\')');
	
	db_q('INSERT INTO category (name) VALUES ("Uncategorized")');
}
if(!is_file('data/db.sqlite')) create_db();

$conf = db_qr('SELECT value FROM conf');
$data['head'] = $conf[0]['value'];
$data['pass'] = $conf[1]['value'];
$data['theme'] = $conf[2]['value'];
$data['lang'] = $conf[3]['value'];
$data['body'] = '';

require 'lang/' .$data['lang']. ' .php';

$data['meta'] = 'Installation';
$data['body'] .= '<h1>' .$data['meta']. '</h1>
	<p>Goolog is installed!</p>
	<p>The default password is "demo"</p>';

require 'footer.php';


?>
