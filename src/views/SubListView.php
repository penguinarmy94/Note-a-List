<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views;

require_once('View.php');
require_once('elements//Navigation.php');
require_once('helpers//UnorderedList.php');

use jorgeandco\hw3\views\elements as ELE;
use jorgeandco\hw3\views\helpers as HELP;

/**
* View class for displaying the sub list page of the application
*/
class SubListView extends View {

    private $arrayLists;
    private $arrayNotes;
    private $subListID;
	private $element;
	private $mainDir;
	private $nav;
	private $uList;

    /**
    * Constructor for the SubListView
    * @param array $array (contains an array of arrays of sublists, notes, and navigation items needed for the sub list view)
    */
    function __construct($array) {
		parent::__construct();

        // initializes array if there are sublists available
		if(!empty($array['lists']))
		{
			$this->arrayLists = $array['lists'];
		}
        //initializes array if there are notes available
		if(!empty($array['notes']))
		{
			$this->arrayNotes = $array['notes'];
		}
        //url for directing controller to specific sublist or note
		$this->maindir = "index.php?c=ListController&m=direct";
        //holds all the navigation items
		$this->nav = $array['nav_items'];
        //Elements and Helper class initialization
		$this->element = new ELE\Navigation($this->maindir);
		$this->uList = new HELP\UnorderedList();
        //switch case to retrive the ID of the current list displayed
		if ($array['nav_items']['num_of_elements'] == 2)
		{
			$this->subListID = $this->nav['list_titles'][1]['id'];
		}
		else
		{
			$this->subListID = $this->nav['list_titles'][2]['id'];
		}

    }

    /**
    * Renders the sub list page on the web browser with the following properties:
    *   1. Header
    *   2. Navigation
    *   3. Sublists
    *   4. Notes
    *   5. Footer
    */
    function render() {
        //draw head html items (use timestamp for title)
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
        //draw navbar
		$this->element->renderElement($this->nav);
        //temporarily store sublists and notes for drawing with unordered list
		$data['subListID'] = $this->subListID;
		$data['arrayLists'] = $this->arrayLists;
		$data['arrayNotes'] = $this->arrayNotes;
        //start of html body, uses Helper class to draw unordered lists
        ?>
        <div class="lists">
			<h2>Lists</h2>
		<?php
		$this->uList->draw("list", $data);
		?>
        </div>
        <div class="lists">
			<h2>Notes</h2>
		<?php
		$this->uList->draw("note", $data);
		?>
        </div>
        <?php
        //end of html body
        //draw footer items
		$this->footer->render("");
    }
}