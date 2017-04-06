<?php
/**
* @author Jorge Aguiniga, Luis Otero
*	This is a applicationthat allows users to post categorized messages and classified listings.
*/
namespace jorgeandco\hw3;

require_once('src//controllers//ListController.php');
require_once('src//controllers//FormController.php');
require_once('src//controllers//NoteController.php');
require_once('src//configs/Config.php');

use jorgeandco\hw3\controllers as CTR;

date_default_timezone_set(Config::location);

//redirects to landing page if the controller variable is not set
if(!isset($_REQUEST['c']))
{
	header("Location: index.php?c=ListController&m=direct&arg1=1");
}
//checks where to refirect the user
else
{
	//Switch case for directing the user to a page based on variable c
	switch($_REQUEST['c'])
	{
		//ListController, directs the user either to the Landing page or the SubList page based on the method for the controller passed by variable m
		case "ListController":
			$method = $_REQUEST['m'];
			$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
			$object = new $class();
			$object->$method($_REQUEST['arg1']);
		break;
		case "FormController":
		case "NoteController":
			//checks if variable m is "submit_form, if it true then case breaks and no page is drawn"
			if (strcmp($_REQUEST['m'], "submit_form") == 0)
			{
				break;
			}
			//directs the user to either the NewList page, NewNote page, or the ViewNote page based on the controller set by the variable c
			$method = $_REQUEST['m'];
			$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
			$object = new $class();
			//calls the selected controllers method based on the variable m
			$object->$method($_REQUEST['arg1'], $_REQUEST['arg2']);
		break;
	}
}

//checks if there is a new list to be saved into the database
if (isset($_POST['addlist']))
{
	//removes any html tags from the POST
	$filteredData = filter_var($_POST['name'], 513);
	//checks if the name variable is not empty
	if (!empty($filteredData))
	{
		$data['name'] = $_POST['name'];
		$data['id'] = $_POST['id'];
		$method = $_REQUEST['m'];
		$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
		$object = new $class();
		$object->$method($data, $_POST['type']);
	}
	//redirects the user back to the sublist  page based on the parent list that the user created the new list on.
	header("Location: index.php?c=ListController&m=direct&arg1=".$_POST['id']);
}

//checks if there is a new note to be saved into the database
if (isset($_POST['addnote']))
{
	//removes any html tags from the POST
	$filteredTitle = filter_var($_POST['title'], 513);
	$filteredContent = filter_var($_POST['note'], 513);
	//checks if the the title and note variables are not empty
	if (!empty($filteredTitle) && !empty($filteredContent))
	{
		$data['name'] = $_POST['title'];
		$data['content'] = $_POST['note'];
		$data['id'] = $_POST['id'];
		$data['date'] = date("Y-m-d");
		$method = $_REQUEST['m'];
		$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
		$object = new $class();
		$object->$method($data, $_POST['type']);
	}
	//redirects the user to the sublist page where the new note was created in
	header("Location: index.php?c=ListController&m=direct&arg1=".$_POST['id']);
}