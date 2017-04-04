<?php
namespace jorgeandco\hw3\views\helpers;

require_once('Helper.php');

class UnorderedList extends Helper
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function draw($type, $dataArray)
	{
		if(strcmp($type, "list") == 0)
		{
			$this->draw_child_list($dataArray);
		}
		else if (strcmp($type, "note") == 0)
		{
			$this->draw_note_list($dataArray);
		}
		else if (strcmp($type, "ln") == 0)
		{
			$this->draw_child_list($dataArray);
			$this->draw_note_list($dataArray);
		}
		else
		{
			$this->no_list();
		}
	}
	
	private function draw_child_list($data)
	{
		?>
		<ul>
			<li>[<a href= "index.php?c=FormController&m=show_form&arg1=list&arg2=<?= $data['subListID']; ?>" >New List</a>]</li>
			<?php
			if (!empty($data['arrayLists']))
			{
				foreach ($data['arrayLists'] as $list) {
					$name = $list['name'];
					$id = $list['id'];
					?><li><a href="index.php?c=ListController&m=direct&arg1=<?=$id?>"><?=$name?></a></li><?php
				}
			}
			?>
        </ul>
		<?php
	}
	
	private function draw_note_list($data)
	{
		?>
		<ul>
			<li>[<a href="index.php?c=FormController&m=show_form&arg1=note&arg2=<?= $data['subListID']; ?>">New Note</a>]</li>
			<?php
			if (!empty($data['arrayNotes']))
			{
				foreach ($data['arrayNotes'] as $note) {
					$name = $note['name'];
					$date = $note['date'];
					$date = str_replace("-", "&#8209;", $date);
					$id = $note['id'];
					?>
					<li>
						<a href="index.php?c=NoteController&m=present_note&arg1=<?=$id?>&arg2=<?=$data['subListID']?>">
							<?=$name?>
						</a>
						<?=$date?>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php
	}
	
	private function no_list()
	{
		?>
			<ul>
				<li>No List Attribute</li>
			</ul>
		<?php
	}
}