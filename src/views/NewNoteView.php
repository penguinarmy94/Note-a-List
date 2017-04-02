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
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Los_Angeles");
		$this->maindir = getcwd()."/index.php?c=ListController&m=direct";
		$this->savedir = getcwd()."/index.php?c=FormController&m=update";
	}
	public function render($array)
	{
		$nav = $array['nav_items'];
		$this->element = new ELE\Navigation($this->maindir);
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
		$this->element->renderElement($nav);
		?>
			<div>
				<h2>New Note</h2>
			</div>
			<div>
				<form action="<?= $this->savedir ?>" method="post">
					Title: <input type="text" name="title"/><br>
					Note<br>
					<textarea rows='8' cols='30' name="note"></textarea><br>
					<input type="submit" name="save" value="save" />
				</form>
			</div>
		
		<?php
		$this->footer->render("");
	}
}