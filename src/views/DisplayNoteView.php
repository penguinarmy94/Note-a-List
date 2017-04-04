<?php
namespace jorgeandco\hw3\views;

require_once('View.php');
require_once ('elements/Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class DisplayNoteView extends View
{
	private $maindir;
	private $element;
	private $nav;
	private $title;
	private $content;
	
	public function __construct($array)
	{
		parent::__construct();
		$this->maindir = "index.php?c=ListController&m=direct";
		$this->nav = $array['nav_items'];
		if(!empty($array['name']))
		{
			$this->title = $array['name'];
		}
		else
		{
			$this->title = "No Title";
		}
		if(!empty($array['content']))
		{
			$this->content = $array['content'];
		}
		else
		{
			$this->content = "empty content"; 
		}
		$this->element = new ELE\Navigation($this->maindir);
	}
	
	public function render()
	{
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");		
		$this->head->render($timestamp);
		$this->element->renderElement($this->nav);
		
		?>
			<div>
				<h2>Note: <?=$this->title?></h2>
			</div>
			<div class="note_box">
				<?= $this->content ?>
			</div>
		
		<?php
		$this->footer->render("");
	}
}