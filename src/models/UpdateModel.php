<?php
namespace jorgeandco\hw3\models;
/**
* @author Jorge Aguiniga, Luis Otero
*/
require_once('Model.php');

/**
*	UpdateModel class to connect and write to the Note-A-List database
*/
class UpdateModel extends Model
{

	/**
	*	Constructor for the UpdateModel class
	*	@param int $id (the id of the current list location)
	*	@param String $type (the type of action that the Model will perform; value 'list' for writing data about a new list, value 'note' for writing data about a new note)
	*/
	public function __construct($id, $type)
	{
		parent::__construct($id, $type);
	}

	/**
	*	Processes the data that was written based on the UpdateModel's type issued in the constructor
	*	@param array $array (the data to be written to the database)
	*/
	public function data($array)
	{
		switch($this->mType)
		{
			//if type is list, write new list data to List and List_Relationship tables
			case 'list':

				//query to check if the new list already exists in the parent list
				$check = "SELECT list_name, parent_id FROM list, list_relationship where list_id = child_id
							and list_name = '".$array['name']."' and parent_id = ".$this->mID;

				//if query is successfull
				if($list = parent::$db->query($check))
				{
					//if query returns results then exit and don't insert new list
					if(!empty($list) && $list->num_rows != 0)
					{
						echo $check;
						return;
					}
				}

				//query to insert new list to List table
				$query = "INSERT INTO list(list_name) VALUES('".$array['name']."')";
				//query to select new id for newly created list
				$selectid = "SELECT max(list_id) AS list_id FROM list";
				//query to insert newly created list id and its parent id to the list_relationship table
				$query2 = "INSERT INTO list_relationship VALUES(".$this->mID.",";

				//if new list insertion query was not successful then exit
				if(!parent::$db->query($query))
				{
					echo $this->db->error;
					exit(1);
				}
				//if new list ID retrieval query is successful
				if($dbquery = parent::$db->query($selectid))
				{
					//get the new ID
					if($obj = $dbquery->fetch_object())
					{
						$query2 .= ($obj->list_id.")");
					}
					//if fails, exit method
					else
					{
						echo "ID RETRIEVAL ERROR!";
						exit(1);
					}
				}
				//if new list ID retrieval query was not successful, then exit method
				else
				{
					echo "LIST SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
				//if new list relationship query was not successful, then exit method
				if(!parent::$db->query($query2))
				{
					echo "LIST SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
			break;

			//if type is note, write new note data to Note table
			case 'note':
				//query for inserting new note to database
				$query = 'INSERT INTO note(note_name, note_description, note_date) VALUES("'
							.$array['name'].
							'","'
							.$array['content'].
							'",STR_TO_DATE("'
							.$array['date'].'","%Y-%m-%d"))';
				//query for retrieving ID of new note
				$selectid = "SELECT max(note_id) AS note_id FROM note";
				//query for inserting relationship between new note and its parent list
				$query2 = "INSERT INTO note_relationship VALUES(".$this->mID.",";

				//if new note insertion query was not successful then exit
				if(!parent::$db->query($query))
				{
					echo $this->db->error;
					echo '\n'.$query;
					exit(1);
				}
				//if new note ID retrieval query is successful
				if($dbquery = parent::$db->query($selectid))
				{
					//retrieve new ID
					if($obj = $dbquery->fetch_object())
					{
						$query2 .= ($obj->note_id.")");
					}
					//if fails, exit method
					else
					{
						echo "ID RETRIEVAL ERROR!";
						exit(1);
					}
				}
				//if new note ID retrieval query was not successful, then exit method
				else
				{
					echo "NOTE SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
				//if new note relationship query was not successful, then exit method
				if(!parent::$db->query($query2))
				{
					echo "NOTE SAVE ERROR ID RELATIONSHIPS!";
					exit(1);
				}
			break;
			//defualt case with error message if variable $mType is a nonsupported type for UpdateModel
			default:
				echo "error saving";
		}
	}

}