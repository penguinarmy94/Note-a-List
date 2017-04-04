<?php
namespace jorgeandco\hw3\views;

require_once ('view.php');
require_once ('elements/Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class NewNoteView extends View
{
	private $element;
	private $maindir;
	private $savedir;
	private $nav;
	private $curr;
	
	public function __construct($array)
	{
		parent::__construct();
		$this->maindir = "index.php?c=ListController&m=direct";
		$this->savedir = "index.php?c=FormController&m=submit_form";
		$this->nav = $array['nav_items'];
		$this->element = new ELE\Navigation($this->maindir);
		
		switch($array['nav_items']['num_of_elements'])
		{
			case 1:
				$this->curr = $this->nav['list_titles'][0]['id'];
			break;
			case 2:
				$this->curr = $this->nav['list_titles'][1]['id'];
			break;
			default:
				$this->curr = $this->nav['list_titles'][2]['id'];
		}
	}
	public function render()
	{
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
		$this->element->renderElement($this->nav);
		?>
			<div>
				<h2>New Note</h2>
			</div>
			<div>
				<form name="newNote" action="<?= $this->savedir ?>" method="post">
					Title: <input type="text" name="title"/><br>
					Note<br>
					<textarea rows='8' cols='30' name="note"></textarea><br>
					<input type="submit" name="addnote" value="save" />
					<input type="hidden" name="type" value="note" />
					<input type="hidden" name="id" value=<?=$this->curr?> />
				</form>
			</div>
		
		<?php
		$this->footer->render("");
	}
}