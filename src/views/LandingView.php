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
* View implementation for displaying the home page of the application
*/
class LandingView extends View {
	
    private $arrayLists; 
    private $arrayNotes; 
	private $element; 
	private $maindir;
	private $nav;
	private $uList;

	/**
	* Constructor for the LandingView
	* @param $array (contains an array of arrays of sublists, notes, and navigation items needed
	*			for the home view)
	*/
    function __construct($array) {
		parent::__construct();
		
		// initializes array if there are sublists available
		if (!empty($array['lists']))
		{
			$this->arrayLists = $array['lists'];
		}
		
		//initializes array if there are notes available
		if (!empty($array['notes']))
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
    }

	/**
	* Function that renders the home page on the web browser with the following properties:
	* 	1. Header
	*   2. Navigation
	*	3. Sublists
	*	4. Notes
	*	5. Footer
	*/
    function render() {
		
		//id for the current page
		$current = $this->nav['list_titles'][0]['id'];
		
		//draw head html items (use timestamp for title)
		$timestamp = date("m/d/Y")." - ".date("h:i:s a"); 
		$this->head->render($timestamp);
		
		//draw navbar
		$this->element->renderElement($this->nav);
		
		//temporarily store sublists and notes for drawing with unordered list
		$data['subListID'] = $current;
		$data['arrayLists'] = $this->arrayLists;
		$data['arrayNotes'] = $this->arrayNotes;
		
		//start of html body
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