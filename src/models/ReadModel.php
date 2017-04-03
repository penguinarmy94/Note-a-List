<?php
namespace jorgeandco\hw3\models;

require_once('Model.php');

class ReadModel extends Model
{
	
	public function __construct($id, $type)
	{
		parent::__construct($id, $type);
	}
	
	public function data($array)
	{
		
		$list['nav_items'] = $this->navigation();
		
		switch($this->mType)
		{
			case 'nav-only':
				return $list;
			break;
			case 'nav':		
				$listquery = "SELECT list_id,list_name FROM list WHERE list_id IN (
							SELECT child_id FROM list_relationship WHERE parent_id = ".$this->mID.") ORDER BY list_name";
					
				$notequery = "SELECT note_id,note_name, note_date FROM note WHERE note_id IN (
							SELECT note_id FROM note_relationship WHERE list_id = ".$this->mID.") ORDER BY note_date, note_name";
					
				if ($dbquery = $this->db->query($listquery))
				{
					$i = 0;
					while($obj = $dbquery->fetch_object())
					{
						$list['lists'][$i++] = ['name'=>$obj->list_name, 'id'=>$obj->list_id];
					}
					$dbquery->close();
				}
				if ($dbquery = $this->db->query($notequery))
				{
					while($obj = $dbquery->fetch_object())
					{
						$list['notes'][$i++] = ['name'=>$obj->note_name, 'id'=>$obj->note_id, 'date'=>$obj->note_date];
					}
					$dbquery->close();
				}
				$this->db->close();
			break;
			case 'note':
			
				$query = "SELECT note_name, note_description FROM note WHERE note_id = ".$array['id'];
				if ($dbquery = $this->db->query($query))
				{
					if($obj = $dbquery->fetch_obj())
					{
						$list['name'] = $obj->note_name;
						$list['content'] = $obj->note_description;
					}
				}
			break;
			default:
				echo "error! No valid database action selected";
				exit(1);
		}
		
		return $list;		
	}
	
	private function navigation()
	{
		
		$array0['id'] = 1;
		$array0['name'] = "Note-A-List";
		
		if ($this->mID != 1) //sublist 2 or more levels
		{
			$query = "SELECT list_id, list_name FROM list WHERE list_id = 
						(SELECT parent_id FROM list_relationship WHERE child_id = ";
			
			if ($dbquery = $this->db->query($query.$this->mID.")")) //list item exists
			{
				$obj = $dbquery->fetch_object();
				$parentName = $obj->list_name;
				$parentID = $obj->list_id;
				$dbquery->close();
				if($parentID != $array0['id']) //sublist 3 or more levels
				{	
					if($dbquery = $this->db->query($query.$parentID.")"))
					{
						$obj = $dbquery->fetch_object();
						if ($obj->list_id != $array0['id']) //sublist more than 3 levels
						{
							$array['num_of_elements'] = 4;
						}
						else //sublist 3 levels
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
	
	private function get_child_nav_items($dbquery)
	{
		
		$namequery = "SELECT list_name, list_id FROM list WHERE list_Id = ".$this->mID;
		
		if($dbquery = $this->db->query($namequery))
		{
			$obj = $dbquery->fetch_object();
			$array = ['name'=>$obj->list_name, 'id'=>$obj->list_id];
			$dbquery->close();
			return $array;
		}
		
	}
}