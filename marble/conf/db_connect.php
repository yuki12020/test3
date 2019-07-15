<?php
	$db_conf = parse_ini_file("database.conf");
	$dsn     = "mysql:host=".$db_conf["host"].";port=".$db_conf["port"].";dbname=".$db_conf["db"];
	$options = array(
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
	);
	
	$db = new PDO($dsn, $db_conf["user"], $db_conf["password"], $options);

?>