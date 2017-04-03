<?php
namespace jorgeandco\hw3\controllers;

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\models\UpdateModel.php');
require_once(getcwd().'\src\views\NewListView.php');
require_once(getcwd().'\src\views\NewNoteView.php');

use jorgeandco\hw3\views as VIEW;
use jorgeandco\hw3\models as MODEL;

class FormController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function show_form($formName, $locationID)
	{
		$this->model = new MODEL\ReadModel($locationID, 'nav-only');
		$data = $this->model->data('');
		
		switch($formName)
		{
			case 'list':
				$this->view = new VIEW\NewListView($data);
			break;
			case 'note':
				$this->view = new VIEW\NewNoteView($data);
			break;
			default:
				echo "error";
				exit(1);
		}
		
		$this->view->render();
	}
	
	function submit_form($data, $formName)
	{
		$this->model = new MODEL\UpdateModel($data['id'], $formName);
		$this->model->data($data);
	}
}