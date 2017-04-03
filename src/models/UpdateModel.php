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
				$selectid = "SELECT max(list_id) AS list_id FROM list";
				$query2 = "INSERT INTO list_relationship VALUES(".$this->mID.",";
				
				if(!$this->db->query($query))
				{
					echo $this->db->error;
					exit(1);
				}
				if($dbquery = $this->db->query($selectid))
				{
					if($obj = $dbquery->fetch_object())
					{
						$query2 .= ($obj->list_id.")");
					}
					else
					{
						echo "ID RETRIEVAL ERROR!";
						exit(1);
					}
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
				$query = "INSERT INTO note(note_name, note_description, note_date) 
							VALUES('".$array['name']."','".$array['content']."','".$array['date']."')";
				$selectid = "SELECT max(note_id) AS note_id FROM note";
				$query2 = "INSERT INTO note_relationship VALUES(".$this->mID.",";
				
				if(!$this->db->query($query))
				{
					echo $this->db->error;
					exit(1);
				}
				if($dbquery = $this->db->query($selectid))
				{
					if($obj = $dbquery->fetch_object())
					{
						$query2 .= ($obj->note_id.")");
					}
					else
					{
						echo "ID RETRIEVAL ERROR!";
						exit(1);
					}
				}
				else
				{
					echo "NOTE SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
				if(!$this->db->query($query2))
				{
					echo "NOTE SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
			break;
			default:
				echo "error saving";
		}
	}
	
}