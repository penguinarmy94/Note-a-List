<?php
namespace jorgeandco\hw3\views;
require_once('View.php');
require_once('elements//Navigation.php');
require_once('helpers//UnorderedList.php');

use jorgeandco\hw3\views\elements as ELE;
use jorgeandco\hw3\views\helpers as HELP;

class LandingView extends View {

    private $arrayLists;
    private $arrayNotes;
	private $element;
	private $maindir;
	private $nav;
	private $uList;

    function __construct($array) {
		parent::__construct();
		
		if (!empty($array['lists']))
		{
			$this->arrayLists = $array['lists'];
		}
		if (!empty($array['notes']))
		{
			$this->arrayNotes = $array['notes'];
		}
		$this->maindir = "index.php?c=ListController&m=direct";
		$this->nav = $array['nav_items'];
		$this->element = new ELE\Navigation($this->maindir);
		$this->uList = new HELP\UnorderedList();
    }


    function render() {
		$current = $this->nav['list_titles'][0]['id'];
		$timestamp = date("m/d/Y")." - ".date("h:i:s a"); 
		$this->head->render($timestamp);
		$this->element->renderElement($this->nav);
		$data['subListID'] = $current;
		$data['arrayLists'] = $this->arrayLists;
		$data['arrayNotes'] = $this->arrayNotes;
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
		$this->footer->render("");
    }
}