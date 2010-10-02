<?php


//query that return

function db_qr($sql)
{
	$db = sqlite_open('data/db.sqlite');
	$result = sqlite_array_query($db, $sql, SQLITE_ASSOC);
	sqlite_close($db);
	return $result;
}

//query that only return the first result

function db_qrs($sql)
{
	$result = db_qr($sql);
	return $result[0];
}

//query that does not return

function db_q($sql)
{
	$db = sqlite_open('data/db.sqlite');
	sqlite_exec($db, $sql);
	sqlite_close($db);
}


?>
