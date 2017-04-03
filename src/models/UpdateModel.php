<?php
namespace jorgeandco\hw3\models;

require_once('Model.php');

class UpdateModel extends Model
{
	
	public function __construct($id, $type)
	{
		parent::__construct($id, $type);
	}
	
	public function data($array)
	{
		switch($this->mType)
		{
			case 'list':
				$query = "INSERT INTO list(list_name) VALUES('".$array['name']."')";
				$selectid = "SELECT list_id FROM list WHERE list_name = '".$array['name']."'";
				$query2 = "INSERT INTO list_relationship VALUES(".$this->mID.",".$array['id'].")";
				
				if(!$this->db->query($query))
				{
					echo $this->db->error;
					exit(1);
				}
				if($dbquery = $this->db->query($selectid)
				{
					
				}
				else
				{
					echo "LIST SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
				if(!$this->db->query($query2))
				{
					echo "LIST SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
			break;
			case 'note':
				echo "note saved";
			break;
			default:
				echo "error saving";
		}
	}
	
}