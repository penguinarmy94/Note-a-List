<?php
namespace jorgeandco\hw3\models;

require_once(getcwd().'\src\configs\config.php');

use jorgeandco\hw3 as CFG;

abstract class Model
{
	protected $mID;
	protected $mType;
	protected $db;
	
	public function __construct($id, $type)
	{
		$this->mID = $id;
		$this->mType = $type;
		
		$hostname = CFG\Config::host.(':'.CFG\Config::port);
		$this->connect($hostname, CFG\Config::user, CFG\Config::password, CFG\Config::db);
		
	}
	
	private function connect ($host, $username, $password, $database)
	{
		$this->db = new \mysqli($host, $username, $password, $database);
		
		if ($this->db->connect_error)
		{	
			echo "Could not connect!";
		}
	}
	
    abstract public function data($array);
	
}