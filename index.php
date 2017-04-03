<?php
namespace jorgeandco\hw3;

require_once('src//controllers//ListController.php');
require_once('src//controllers//FormController.php');
require_once('src//controllers//NoteController.php');

use jorgeandco\hw3\controllers as CTR;

static $i = false;


if(!isset($_REQUEST['c']))
{
	header("Location: index.php?c=ListController&m=direct&arg1=1");
}
else
{
	switch($_REQUEST['c'])
	{
		case "ListController":
			$method = $_REQUEST['m'];
			$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
			$object = new $class();
			$object->$method($_REQUEST['arg1']);
		break;
		case "FormController":
		case "NoteController":
			if (strcmp($_REQUEST['m'], "submit_form") == 0)
			{
				break;
			}
			$method = $_REQUEST['m'];
			$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
			$object = new $class();
			$object->$method($_REQUEST['arg1'], $_REQUEST['arg2']);
		break;
	}
}

if (isset($_POST['addlist']))
{
	if (!empty($_POST['name']))
	{
		$data['name'] = $_POST['name'];
		$data['id'] = $_POST['id']; 
		$method = $_REQUEST['m'];
		$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
		$object = new $class();
		$object->$method($data, $_POST['type']);
	}
	header("Location: index.php?c=ListController&m=direct&arg1=".$_POST['id']);
}
if (isset($_POST['addnote']))
{
	if (!empty($_POST['title']) && !empty($_POST['note']))
	{
		$data['name'] = $_POST['title'];
		$data['content'] = $_POST['note'];
		$data['id'] = $_POST['id']; 
		$method = $_REQUEST['m'];
		$class = 'jorgeandco\\hw3\\controllers\\'.$_REQUEST['c'];
		$object = new $class();
		$object->$method($data, $_POST['type']);
	}
	header("Location: index.php?c=ListController&m=direct&arg1=".$_POST['id']);
}