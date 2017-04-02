<?php
namespace jorgeandco\hw3;
require_once('src/views/NewNoteView.php');
require_once('src/views/DisplayNoteView.php');

use jorgeandco\hw3\views as VIEW;

$view = new VIEW\DisplayNoteView();

$array0['id'] = 0;
$array0['name'] = "Note-a-List";
$array1['id'] = 55;
$array1['name'] = "Father";
$array2['id'] = 56;
$array2['name'] = "Mother";
$array['num_of_elements'] = 1;
$array['list_titles'] = [$array0];
$list['nav_items'] = $array;
$list['name'] = "Beauty and the Beast";
$list['content'] = "There was once a little red pony that stood beside a little other pony. It gathered around a campfire,
					but unfortunately it ran into a big proble. So the gremlins stole christmas!";

$view->render($list);