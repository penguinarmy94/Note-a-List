<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views;

require_once('View.php');
require_once ('elements/Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

/**
*	View class for displaying the note page of the application
*/
class DisplayNoteView extends View
{
	private $maindir;
	private $element;
	private $nav;
	private $title;
	private $content;

	/**
	* Constructor for the DisplayNoteView
	* @param array $array (contains an array of arrays of the navigation bar and note contents needed for the display note view)
	*/
	public function __construct($array)
	{
		parent::__construct();
		//url for directing controller to specific sublist or note
		$this->maindir = "index.php?c=ListController&m=direct";
		//holds all the navigation items
		$this->nav = $array['nav_items'];

		//initializes the title of the note if it exists
		if(!empty($array['name']))
		{
			$this->title = $array['name'];
		}
		else
		{
			$this->title = "No Title";
		}
		//initializes the content of the note if it exists
		if(!empty($array['content']))
		{
			$this->content = $array['content'];
		}
		else
		{
			$this->content = "empty content";
		}
		//Element class initialization
		$this->element = new ELE\Navigation($this->maindir);
	}

	/**
	* 	Renders the display note page on the web browser with the following properties:
	*	1. Header
	*   2. Navigation
	*	3. Note Title
	*	4. Note Contents
	*	5. Footer
	*/
	public function render()
	{
		//draw head html items (use timestamp for title)
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
		//draw navbar
		$this->element->renderElement($this->nav);

		//start of html body
		?>
			<div>
				<h2>Note: <?=$this->title?></h2>
			</div>
			<div class="note_box">
				<?= $this->content ?>
			</div>

		<?php
		//end of html body

		//draw footer items
		$this->footer->render("");
	}
}