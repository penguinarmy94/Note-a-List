<?php
namespace jorgeandco\hw3\controllers;
/**
* @author Jorge Aguiniga, Luis Otero
*/

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\views\DisplayNoteView.php');

use jorgeandco\hw3\models as MODEL;
use jorgeandco\hw3\views as VIEW;

/**
*	Controller class for handling data passing for note model and view
*/
class NoteController extends Controller
{
	/**
	*	Contructor for NoteController
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	*	Renders the note page based on the its ID and the list ID its stored in
	*	@param int $noteID (id of the note to be drawn)
	*	@param int locationID (id of parent list where note is stored in)
	*/
	public function present_note($noteID, $locationID)
	{
		//creates a ReadModel class to hold the data for the navigation bar and the note
		$this->model = new MODEL\ReadModel($locationID, "note");
		//retrieves the navigation bar and note data
		$data = $this->model->data(['id'=>$noteID]);
		//creates DisplayNoteView with navigation and note data
		$this->view = new VIEW\DisplayNoteView($data);
		//renders the NisplayNote page
		$this->view->render();

	}
}