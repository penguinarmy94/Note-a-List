<?php
namespace jorgeandco\hw3\views;
require_once('View.php');

class NewListView extends View {

    private $subList;

    function __construct($array) {
        $this->subList = $array['subList'];
    }

    function render() {
        ?>
        <div>
            <h2>New List</h2>
            <form name="newList" method="get" action="index.php">
                <input type="text" name="arg1" placeholder="Enter a new list name">
                <input type="hidden" name="arg2" value="<?php echo $this->subList; ?>">
                <input type="submit" value="Add">
            </form>
        </div>
        <?php
    }

}