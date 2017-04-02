<?php
namespace jorgeandco\hw3\views;
require_once('View.php');
require_once('elements//Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class SubListView extends View {

    private $arrayLists;
    private $arrayNotes;
    private $subListID;
	private $element;
	private $mainDir;
	private $nav;
	

    function __construct($array) {
		parent::__construct();
        $this->arrayLists = $array['lists'];
        $this->arrayNotes = $array['notes'];
		$this->maindir = getcwd()."/index.php?c=ListController&m=direct";
		$this->nav = $array['nav_items'];
		$this->element = new ELE\Navigation($this->maindir);
		if ($array['nav_items']['num_of_elements'] == 2)
		{
			$this->subListID = $this->nav['list_titles'][1]['id'];
		}
		else
		{
			$this->subListID = $this->nav['list_titles'][2]['id'];
		}
	
    }


    function render() {
		$current = $this->nav['list_titles'][0]['id'];
		$timestamp = date("m/d/Y")." - ".date("h:i:s a");
		$this->head->render($timestamp);
		$this->element->renderElement($this->nav);
        ?>
        <div class="lists-list" style="float:left">
            <ul>
				 <h2>Lists</h2>
                <li>[<a href= "index.php?c=FormController&m=show_form&arg1=2&arg2=<?= $this->subListID; ?>" >New List</a>]</li>
                <?php
                foreach ($this->arrayLists as $list) {
                    $name = $list['name'];
                    $id = $list['id'];
                    ?><li><a href="index.php?c=ListController&m=direct&arg1=<?=$id?>"><?=$name?></a></li><?php
                }
                ?>
            </ul>
        </div>
        <div class="notes-list" style="float:left">
            <ul>
				<h2>Notes</h2>
                <li>[<a href="index.php?c=FormController&m=show_form&arg1=note&arg2=<?= $this->subListID; ?>">New Note</a>]</li>
                <?php
                foreach ($this->arrayNotes as $note) {
                    $name = $note['name'];
                    $date = $note['date'];
                    $id = $note['id'];
                    ?>
					<li>
						<a href="index.php?c=NoteController&m=present_note&arg1=<?=$id?>$arg2=<?=$this->subListID?>">
							<?=$name?>
						</a>
						<?=$date?>
					</li>
					<?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
}