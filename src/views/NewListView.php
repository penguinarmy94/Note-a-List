<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/

namespace jorgeandco\hw3\views;
require_once('View.php');
require_once('elements//Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

/**
* View class for displaying the new list page of the application
*/
class NewListView extends View {

	private $nav;
	private $curr;
	private $mainDir;
	private $savedir;

    /**
    * Constructor for the NewListView
    * @param array $array (contains an array of an array of navigation items needed for the new list view)
    */
    function __construct($array) {
		parent::__construct();
        //holds all the navigation items
		$this->nav = $array['nav_items'];
        //url for directing controller to specific sublist
		$this->maindir = "index.php?c=ListController&m=direct";
        //Element class initialization
		$this->element = new ELE\Navigation($this->maindir);
        //url for directing controller to specific submit form
		$this->savedir = "index.php?c=FormController&m=submit_form";
        //switch case to retrive the ID of the parent list which the new list will be stored in
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
    * Renders the new list page on the web browser with the following properties:
    *   1. Header
    *   2. Navigation
    *   3. New list form
    *   4. Footer
    */
    function render() {
        //draw head html items (use timestamp for title)
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
        //draw navbar
		$this->element->renderElement($this->nav);
        //start of html body
        ?>
        <div>
            <h2>New List</h2>
            <form name="newList" method="post" action="<?= $this->savedir ?>">
                <input class="text-box" type="text" name="name" placeholder="Enter a new list name" />
                <input type="hidden" name="id" value="<?= $this->curr; ?>" />
				<input type="hidden" name="type" value="list" />
                <input type="submit" name="addlist" value="Add" />
            </form>
        </div>
        <?php
        //end of html body
        //draw footer items
		$this->footer->render("");
    }

}