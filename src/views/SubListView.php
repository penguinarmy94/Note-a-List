<?php
namespace jorgeandco\hw3\views;
require_once('View.php');

class SubListView extends View {

    private $arrayLists;
    private $arrayNotes;
    private $subListID;

    function __construct($array) {
        $this->arrayLists = $array['lists'];
        $this->arrayNotes = $array['notes'];
        $this->subListID = $array['subList'];
    }


    function render() {
        ?>
        <div class="lists-list">
            <h2>Lists</h2>
            <ul>
                <li>[<a href= "index.php?c=NewListView&m=new_list&arg1=<?php echo $this->subListID; ?>" >New List</a>]</li>
                <?php
                foreach ($this->arrayLists as $list) {
                    $name = $list['name'];
                    $id = $list['id'];
                    ?><li><a href="index.php?c=SubListView&m=next_sub&arg1=<?=$id?>"><?=$name?></a></li><?php
                }
                ?>
            </ul>
        </div>
        <div class="notes-list">
            <h3>Notes</h3>
            <ul>
                <li>[<a href="index.php?c=NewNoteView&m=new_note&arg1=<?php echo $this->subListID; ?>">New Note</a>]</li>
                <?php
                foreach ($this->arrayNotes as $note) {
                    $name = $note['name'];
                    $date = $note['date'];
                    $id = $note['id'];
                    ?><li><a href="index.php?c=DisplayNoteView&m=display_note&arg1=<?=$id?>"><?=$name?> <?=$date?></a></li><?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
}