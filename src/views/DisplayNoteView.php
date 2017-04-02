<?php
namespace jorgeandco\hw3\views;

require_once('View.php');
require_once ('elements/Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class DisplayNoteView extends View
{
	private $maindir;
	private $element;
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Los_Angeles");
		$this->maindir = getcwd()."/index.php?c=ListController&m=direct";
	}
	
	public function render($array)
	{
		$nav = $array['nav_items'];
		$title = $array['name'];
		$content = $array['content'];
		
		$this->element = new ELE\Navigation($this->maindir);
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		
		$this->head->render($timestamp);
		$this->element->renderElement($nav);
		?>
			<div>
				<h2>Note: <?=$title?></h2>
			</div>
			<div>
				<?= $content ?>
			</div>
		
		<?php
		$this->footer->render("");
	}
}