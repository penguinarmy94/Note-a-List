<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\models;

require_once(getcwd().'\src\configs\Config.php');

use jorgeandco\hw3 as CFG;

/**
*	Abstract Model class
*	Holds data for the models current list location, the type of model, and the database
*/
abstract class Model
{
	protected $mID;
	protected $mType;
	protected static $db;

	/**
	*	Constructor for the abstract Model class
	*	@param int $id (the id of the current list location)
	*	@param String $type (the type of action that the Model will perform)
	*/
	public function __construct($id, $type)
	{
		$this->mID = $id;
		$this->mType = $type;

		//creates the host for connecting to the database
		$hostname = CFG\Config::host.(':'.CFG\Config::port);

		//if the database has not been connected to yet, connect to it
		if(empty($db))
		{
			self::connect($hostname, CFG\Config::user, CFG\Config::password, CFG\Config::db);
		}

	}

	/**
	*	Connects to a database based on the variables passed
	*	@param String $host (the name of the host where the database is hosted)
	*	@param String $username (the username to connect to the host)
	*	@param String $password (the password to connect to the host)
	*	@param String $database (the name of the database to connect to)
	*/
	private static function connect ($host, $username, $password, $database)
	{
		//creates a mySQL connection with the Note-a-List database
		self::$db = new \mysqli($host, $username, $password, $database);

		//checks if the database connection was successfull, if not echo error message
		if (self::$db->connect_error)
		{
			echo "Could not connect!";
		}
	}
	/**
	*	Processes the data that was passed based on the Model's type issued in the constructor
	*	@param array $array (the data to be processed)
	*/
    abstract public function data($array);

}