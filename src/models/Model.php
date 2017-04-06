<?php
namespace jorgeandco\hw3\models;

require_once(getcwd().'\src\configs\Config.php');

use jorgeandco\hw3 as CFG;

abstract class Model
{
	protected $mID;
	protected $mType;
	protected static $db;
	
	public function __construct($id, $type)
	{
		$this->mID = $id;
		$this->mType = $type;
		
		$hostname = CFG\Config::host.(':'.CFG\Config::port);
		
		if(empty($db))
		{
			self::connect($hostname, CFG\Config::user, CFG\Config::password, CFG\Config::db);
		}
		
	}
	
	private static function connect ($host, $username, $password, $database)
	{
		self::$db = new \mysqli($host, $username, $password, $database);
		
		if (self::$db->connect_error)
		{	
			echo "Could not connect!";
		}
	}
	
    abstract public function data($array);
	
}