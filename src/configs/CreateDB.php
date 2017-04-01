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
	//$db->query('DROP DATABASE '.$dbname);
    $db->select_db($dbname);
}
else
{
	echo "Database could not be created: ".$db->error."\n";
}

$dbtables = ["CREATE TABLE `list` (`list_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `list_name` VARCHAR(100) NOT NULL, PRIMARY KEY (`list_id`));",
  "CREATE TABLE `list_relationship` ( `parent_id` INT NOT NULL, `child_id` INT NOT NULL);",
  "CREATE TABLE `note_relationship` ( `list_id` INT NOT NULL, `note_id` INT NOT NULL);",
  "CREATE TABLE `note` ( `note_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `note_name` VARCHAR(100) NOT NULL, `note_date` DATE NOT NULL, `note_description` VARCHAR(500) NOT NULL, PRIMARY KEY (`note_id`));"];

foreach ($dbtables as $query) {
    if ($db->query($query) === true)
    {
        echo $query." created\n\n";
    }
    else
    {
        echo "Table could not be created: ".$db->error."\n";
    }
}

$db->close();




