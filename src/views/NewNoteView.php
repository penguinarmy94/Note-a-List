<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views;

require_once ('view.php');
require_once ('elements/Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

/**
* View class for displaying the new note page of the application
*/
class NewNoteView extends View
{
	private $element;
	private $maindir;
	private $savedir;
	private $nav;
	private $curr;

    /**
    * Constructor for the NewNoteView
    * @param array $array (contains an array of an array of navigation items needed for the new note view)
    */
	public function __construct($array)
	{
		parent::__construct();
		//url for directing controller to specific sublist
		$this->maindir = "index.php?c=ListController&m=direct";
		//url for directing controller to specific submit form
		$this->savedir = "index.php?c=FormController&m=submit_form";
		//holds all the navigation items
		$this->nav = $array['nav_items'];
		//Element class initialization
		$this->element = new ELE\Navigation($this->maindir);
		//switch case to retrive the ID of the parent list which the new note will be stored in
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

	/**
    * Renders the new note page on the web browser with the following properties:
    *   1. Header
    *   2. Navigation
    *   3. New note form
    *   4. Footer
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
        //end of html body
        //draw footer items
		$this->footer->render("");
	}
}