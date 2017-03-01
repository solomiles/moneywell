<?php

function db_connect()	{
$config = parse_ini_file('config.ini');
$connection = mysqli_connect('localhost',$config['dbuser'],$config['dbpass'],$config['dbname']);
	if ($connection === false) {
		# code...
		return mysqli_connect_error();
	}
	return $connection;
}
