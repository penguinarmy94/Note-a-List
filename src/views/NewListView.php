<?php
namespace jorgeandco\hw3\views;
require_once('View.php');
require_once('elements//Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class NewListView extends View {

	private $nav;
	private $curr;
	private $mainDir;
	private $savedir;

    function __construct($array) {
		parent::__construct();
		$this->nav = $array['nav_items'];
		$this->maindir = getcwd()."/index.php?c=ListController&m=direct";
		$this->element = new ELE\Navigation($this->maindir);
		$this->savedir = getcwd()."/index.php?c=FormController&m=update";
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

    function render() {
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
		$this->element->renderElement($this->nav);
        ?>
        <div>
            <h2>New List</h2>
            <form name="newList" method="post" action="<?= $this->savedir ?>">
                <input type="text" name="name" placeholder="Enter a new list name">
                <input type="hidden" name="id" value="<?= $this->curr; ?>">
				<input type="hidden" name="type" value="note" />
                <input type="submit" value="Add">
            </form>
        </div>
        <?php
    }

}