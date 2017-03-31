<?php
require_once('config.php');

$dbname = 'note_a_list';
$host .= (":".$port);

$db = new mysqli($host, $user, $password);

if ($db->connect_error)
{
	die('Could not connect to the database: ');
}

echo "connection success\n";

$dbcreate = 'CREATE DATABASE IF NOT EXISTS '.$dbname;

if ($db->query($dbcreate) === true)
{
	echo $dbname." created\n";
	$db->query('DROP DATABASE '.$dbname);
}
else
{
	echo "Database could not be created: ".$db->error."\n";
}

$dbtables[4]= ["List(id INT(6) UNSIGNED AUTO INCREMENT PRIMARY Key, name VARCHAR(100))",
			   "List Relationship(parent_id INT(6), child_id INT(6)"];


$db->close();

