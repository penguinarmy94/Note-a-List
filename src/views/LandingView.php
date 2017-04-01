<?php
namespace jorgeandco\hw3\views;
require_once('View.php');

class LandingView extends View {

    private $arrayLists;
    private $arrayNotes;

    function __construct($array) {
        $this->arrayLists = $array['lists'];
        $this->arrayNotes = $array['notes'];
    }


    function render() {
        ?>
        <div class="lists-list">
            <h2>Lists</h2>
            <ul>
                <li>[<a href="index.php?c=NewListView&m=new_list&arg1=1">New List</a>]</li>
                <?php
                foreach ($this->arrayLists as $list) {
                    $name = $list['name'];
                    $id = $list['id'];
                    ?><li><a href=""><?=$name?></a></li><?php
                }
                ?>
            </ul>
        </div>
        <div class="notes-list">
            <h3>Notes</h3>
            <ul>
                <li>[<a href="">New Note</a>]</li>
                <?php
                foreach ($this->arrayNotes as $note) {
                    $name = $note['name'];
                    $date = $note['date'];
                    $id = $note['id'];
                    ?><li><a href=""><?=$name?></a></li><?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
}