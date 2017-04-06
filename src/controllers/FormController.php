<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\controllers;

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\models\UpdateModel.php');
require_once(getcwd().'\src\views\NewListView.php');
require_once(getcwd().'\src\views\NewNoteView.php');

use jorgeandco\hw3\views as VIEW;
use jorgeandco\hw3\models as MODEL;

/**
*	Controller class for handling data passing for form models and views
*/
class FormController extends Controller
{
	/**
	*	Contructor for FormController
	*/
	function __construct()
	{
		parent::__construct();
	}

	/**
	*	Renders the form for either Newlist or NewNote based on variables passed
	*	@param String $formName (calls NewNList page if value equals list or creates NewNote page if value equals note)
	*	@param int locationID (id of parent list where new list or note will be created in)
	*/
	function show_form($formName, $locationID)
	{
		//creates a ReadModel class to hold the data for the navigation bar
		$this->model = new MODEL\ReadModel($locationID, 'nav-only');
		//retrieves the navigation bar data
		$data = $this->model->data('');

		switch($formName)
		{
			//creates NewListView with the navigation bar data
			case 'list':
				$this->view = new VIEW\NewListView($data);
			break;
			//creates NewNoteView with the navigation bar data
			case 'note':
				$this->view = new VIEW\NewNoteView($data);
			break;
			//exits the function if variable $formName is a nonsupported value
			default:
				exit(1);
		}

		//renders the view
		$this->view->render();
	}

	/**
	*	Saves data that the user submits from the specified form
	*	@param array $data (holds the data to be saved along with the id of the list where the data will belong to)
	*	@param String $formName (the type of form to select the type of data that will be saved, value list for storing new list or value note for storeing new note)
	*/
	function submit_form($data, $formName)
	{
		//creates UpdateModel with id of the parent list along with which type of data
		$this->model = new MODEL\UpdateModel($data['id'], $formName);
		//saves the data to the database
		$this->model->data($data);
	}
}