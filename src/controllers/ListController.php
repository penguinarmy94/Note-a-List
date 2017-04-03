<?php
namespace jorgeandco\hw3\controllers;

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\views\LandingView.php');
require_once(getcwd().'\src\views\SubListView.php');

use jorgeandco\hw3\views as VIEW;
use jorgeandco\hw3\models as MODEL;

class ListController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function direct($listID)
	{
		$this->model = new MODEL\ReadModel($listID, "nav");
		$data = $this->model->data("");
		
		if($listID == 1)
		{
			$this->view = new VIEW\LandingView($data);
			$this->view->render();
		}
		else
		{
			$this->view = new VIEW\SubListView($data);
			$this->view->render();
		}
	}
}