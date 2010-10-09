<?php

function db_open()
{
	return sqlite_open('data/db.sqlite');
}

function db_qr($db, $sql)
{
	return sqlite_array_query($db, $sql, SQLITE_ASSOC);
}

function db_qrs($db, $sql)
{
	$result = db_qr($db, $sql);
	return $result[0];
}

function db_q($db, $sql)
{
	sqlite_exec($db, $sql);
}

function db_close($db)
{
	sqlite_close($db);
}


?>
