<?php
namespace jorgeandco\hw3\models;
/**
* @author Jorge Aguiniga, Luis Otero
*/
require_once('Model.php');

/**
*	ReadModel class to connect and read-only from the Note-A-List database
*/
class ReadModel extends Model
{
	/**
	*	Constructor for the ReadModel class
	*	@param int $id (the id of the current list location)
	*	@param String $type (the type of action that the Model will perform; value 'nav-only' for only retriving the navigation bar, value 'nav' to retrieve the bavigation bar, lists, and notes, value 'note' to retrieve the navigation bar and note data.)
	*/
	public function __construct($id, $type)
	{
		parent::__construct($id, $type);
	}

	/**
	*	Processes the data that was passed based on the ReadModel's type issued in the constructor
	*	@param array $array (the data to be processed)
	*	@return array $list (the data of the view requested based on the ID of the view and the type of data to be retrieved)
	*/
	public function data($array)
	{
		//retrives the data for the navigation bar and stores in into $list
		$list['nav_items'] = $this->navigation();

		switch($this->mType)
		{
			//if type is nav-only, only return navigation bar data
			case 'nav-only':
				return $list;
			break;
			//if type is nav, returns the data for the navigation bar, the lists, and the notes for the current list view
			case 'nav':
				//query for retriving the array of lists in the current list view based on its ID
				$listquery = "SELECT list_id,list_name FROM list join list_relationship ON list_id = child_id
									WHERE parent_id = ". $this->mID." ORDER BY list_name";

				//query for retrieveing the array of notes in the current list view based on its ID
				$notequery = "SELECT N.note_id,note_name,note_date FROM note AS N join note_relationship AS NR ON NR.note_id = N.note_id
									WHERE NR.list_id = ".$this->mID." ORDER BY N.note_id DESC";
				//runs the list retrieval query
				if ($dbquery = parent::$db->query($listquery))
				{
					$i = 0;
					//while loop to store the results of the query into the $list array if the query returned results
					while($obj = $dbquery->fetch_object())
					{
						$list['lists'][$i++] = ['name'=>$obj->list_name, 'id'=>$obj->list_id];
					}
					//closes the query
					$dbquery->close();
				}
				//runs the note retrieval query
				if ($dbquery = parent::$db->query($notequery))
				{
					//while loop to store the results of the query into the $list array if the query returned results
					while($obj = $dbquery->fetch_object())
					{
						$list['notes'][$i++] = ['name'=>$obj->note_name, 'id'=>$obj->note_id, 'date'=>$obj->note_date];
					}
					//closes the query
					$dbquery->close();
				}
			break;
			//if type is note, returns the data for the navigation bar and the note contents
			case 'note':
				//query for retrieveing the array of notes in the note ID
				$query = "SELECT note_name, note_description FROM note WHERE note_id = ".$array['id'];
				//runs the note content retrieval query
				if ($dbquery = parent::$db->query($query))
				{
					//if statment to store the results of the query into the $list array if the query returned results
					if($obj = $dbquery->fetch_object())
					{
						$list['name'] = $obj->note_name;
						$list['content'] = $obj->note_description;
					}
				}
			break;
			//exits the function if variable $mType is a nonsupported type for ReadModel
			default:
				exit(1);
		}
		//returns the data in a array
		return $list;
	}

	/**
	*	Helper function to retreive the data for the navigation bar based on the id of the list
	*/
	private function navigation()
	{
		//defualt values for root
		$array0['id'] = 1;
		$array0['name'] = "Note-A-List";

		//sublist 2 or more levels
		if ($this->mID != 1)
		{
			$query = "SELECT list_id, list_name FROM list WHERE list_id =
						(SELECT parent_id FROM list_relationship WHERE child_id = ";
			//list item(s) exists
			if ($dbquery = parent::$db->query($query.$this->mID.")"))
			{
				$obj = $dbquery->fetch_object();
				$parentName = $obj->list_name;
				$parentID = $obj->list_id;
				$dbquery->close();

				//sublist 3 or more levels
				if($parentID != $array0['id'])
				{
					//list item(s) exists
					if($dbquery = parent::$db->query($query.$parentID.")"))
					{
						$obj = $dbquery->fetch_object();

						//sublist more than 3 levels
						if ($obj->list_id != $array0['id'])
						{
							$array['num_of_elements'] = 4;
						}
						//sublist 3 levels
						else
						{
							$array['num_of_elements'] = 3;
						}
						$dbquery->close();
						$array['list_titles'] = [$array0, ['name'=>$parentName, 'id'=>$parentID], $this->get_child_nav_items($dbquery)];
					}
					else{
						return;
					}

				}
				else //sublist 2 levels
				{
					$array['num_of_elements'] = 2;
					$array['list_titles'] = [$array0, $this->get_child_nav_items($dbquery)];
				}
			}
			else
			{
				return;
			}
		}
		else
		{
			$array['num_of_elements'] = 1;
			$array['list_titles'] = [$array0];
		}
		return $array;

	}

	/**
	*	Helper function to retreive the name of the list being viewed
	*	@param $dbquery (Query object with connected database to run queries with)
	*	@return array $array (array containing the name and ID for the parent list)
	*/
	private function get_child_nav_items($dbquery)
	{

		$namequery = "SELECT list_name, list_id FROM list WHERE list_Id = ".$this->mID;

		//if query was successful
		if($dbquery = parent::$db->query($namequery))
		{
			//store name and ID of the parent list into an array
			$obj = $dbquery->fetch_object();
			$array = ['name'=>$obj->list_name, 'id'=>$obj->list_id];
			$dbquery->close();
			return $array;
		}

	}
}