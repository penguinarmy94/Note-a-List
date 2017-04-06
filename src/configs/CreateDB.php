<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3;

require_once('Config.php');
/**
  Script to create and initialize the database for Note-A-List
*/
$hostname = Config::host.":".Config::port;

//creates a mySQL connection
$db = new \mysqli($hostname, Config::user, Config::password);

//checks if the host cannot connect to the mySQL database and if so stops the script
if ($db->connect_error)
{
	die('Could not connect to the database: ');
}

echo "connection success\n";

//string query to create the database for Note-A-List
$dbcreate = 'CREATE DATABASE IF NOT EXISTS '.Config::db;

//checks if creating the Note-A-List database was successful
if ($db->query($dbcreate) === true)
{
	echo Config::db." created\n";
    $db->select_db(Config::db);
}
//gives a error message if there was an error creating the database and stops the script
else
{
	echo "Database could not be created: ".$db->error."\n";
  die;
}

/**
  array to hold all the queries to create and initalize the database
    1. creates table list(list_id, list_name)
    2. creates table list_relationship(parent_id, list_id)
    3. creates table note(note_id, note_name, note_date, note_description)
    4. inserts Note-A_list as first list to set as list_id = 1 to initiate as root list
*/
$dbtables = ["CREATE TABLE `list` (`list_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `list_name` VARCHAR(100) NOT NULL, PRIMARY KEY (`list_id`));",
  "CREATE TABLE `list_relationship` ( `parent_id` INT UNSIGNED  NOT NULL, `child_id` INT UNSIGNED NOT NULL, CONSTRAINT parent_fk FOREIGN KEY (`parent_id`) REFERENCES `list`(`list_id`) ON UPDATE CASCADE ON DELETE CASCADE, CONSTRAINT child_fk FOREIGN KEY (`child_id`) REFERENCES `list`(`list_id`) ON UPDATE CASCADE ON DELETE CASCADE);",
  "CREATE TABLE `note` ( `note_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `note_name` VARCHAR(100) NOT NULL, `note_date` DATE NOT NULL, `note_description` VARCHAR(500) NOT NULL, PRIMARY KEY (`note_id`));",
  "CREATE TABLE `note_relationship` ( `list_id` INT UNSIGNED NOT NULL, `note_id` INT UNSIGNED NOT NULL, CONSTRAINT list_fk FOREIGN KEY (`list_id`) REFERENCES `list`(`list_id`) ON UPDATE CASCADE ON DELETE CASCADE, CONSTRAINT note_fk FOREIGN KEY (`note_id`) REFERENCES `note`(`note_id`) ON UPDATE CASCADE ON DELETE CASCADE);",
  "INSERT INTO `list`(`list_name`) VALUES ('Note-A-List');"];

//for loop to run each query in the array $dbtables
foreach ($dbtables as $query) {
    // success message if query runs correctly
    if ($db->query($query))
    {
        echo $query." created\n\n";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}
//closes the database connection
$db->close();




