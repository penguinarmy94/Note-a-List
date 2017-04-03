<?php
namespace jorgeandco\hw3\controllers;

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\views\DisplayNoteView.php');

use jorgeandco\hw3\models as MODEL;
use jorgeandco\hw3\views as VIEW;

class NoteController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function present_note($noteID, $locationID)
	{
		$this->model = new MODEL\ReadModel($locationID, "note");
		$data = $this->model->data(['id'=>$noteID]);
		$this->view = new VIEW\DisplayNoteView($data);
		$this->view->render();
		
	}
}