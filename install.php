<?php

//add db if it does not exist

if(!is_file('data/db.sqlite'))
{
	require 'include/sqlite.php';
	$db = db_open();
	db_q($db, 'CREATE TABLE post (
	id INTEGER PRIMARY KEY NOT NULL,
	pid INTEGER NOT NULL DEFAULT 1,
	date INTEGER NOT NULL,
	title TEXT NOT NULL,
	content TEXT NOT NULL
	)');
	
	db_q($db, 'CREATE TABLE comment (
	id INTEGER PRIMARY KEY NOT NULL,
	pid INTEGER NOT NULL,
	date INTEGER NOT NULL,
	author TEXT NOT NULL,
	content TEXT NOT NULL
	)');
	
	db_q($db, 'CREATE TABLE link (
	id INTEGER PRIMARY KEY NOT NULL,
	name TEXT NOT NULL,
	url TEXT NOT NULL
	)');
	
	db_q($db, 'CREATE TABLE category (
	id INTEGER PRIMARY KEY NOT NULL,
	name TEXT NOT NULL
	)');
	
	db_q($db, 'CREATE TABLE config (
	name TEXT PRIMARY KEY NOT NULL,
	value TEXT NOT NULL
	)');
	
	db_q($db, 'CREATE INDEX post_pid_index ON post (pid)');
	db_q($db, 'CREATE INDEX comment_pid_index ON comment (pid)');
	
	db_q($db, 'INSERT INTO config (name, value) VALUES (\'title\', \'Goolog demo\')');
	db_q($db, 'INSERT INTO config (name, value) VALUES (\'password\', \'demo\')');
	db_q($db, 'INSERT INTO config (name, value) VALUES (\'theme\', \'classic\')');
	db_q($db, 'INSERT INTO config (name, value) VALUES (\'lang\', \'en\')');
	
	db_q($db, 'INSERT INTO category (name) VALUES ("Uncategorized")');
	
	db_close($db);
	
	header('Location: index.php');
}

?>
