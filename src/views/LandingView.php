<?php
namespace jorgeandco\hw3\views;
require_once('View.php');
require_once('elements//Navigation.php');

use jorgeandco\hw3\views\elements as ELE;

class LandingView extends View {

    private $arrayLists;
    private $arrayNotes;
	private $element;
	private $maindir;
	private $nav;

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
                <li>[<a href="index.php?c=FormController&m=show_form&arg1=list&arg2=<?=$current?>">New List</a>]</li>
                <?php
				if (!empty($this->arrayLists))
				{
					foreach ($this->arrayLists as $list) {
						$name = $list['name'];
						$id = $list['id'];
						?><li><a href="index.php?c=ListController&m=direct&arg1=<?=$id?>"><?=$name?></a></li><?php
					}
				}
                ?>
            </ul>
        </div>
        <div class="notes-list" style="float:left">
            <ul>
			<h2>Notes</h2>
                <li>[<a href="index.php?c=FormController&m=show_form&arg1=note&arg2=<?=$current?>">New Note</a>]</li>
                <?php
				if(!empty($this->arrayNotes))
				{
					foreach ($this->arrayNotes as $note) {
						$name = $note['name'];
						$date = $note['date'];
						$id = $note['id'];
						?>
						<li>
							<a href="index.php?c=NoteController&m=present_note&arg1=<?=$id?>&arg2=0">
								<?=$name?>
							</a> 
							<?=$date?>
						</li>
						<?php
					}
				}
                ?>
            </ul>
        </div>
        <?php
    }
}