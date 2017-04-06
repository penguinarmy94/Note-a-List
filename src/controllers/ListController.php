<?php
namespace jorgeandco\hw3\controllers;
/**
* @author Jorge Aguiniga, Luis Otero
*/

require_once('Controller.php');
require_once(getcwd().'\src\models\ReadModel.php');
require_once(getcwd().'\src\views\LandingView.php');
require_once(getcwd().'\src\views\SubListView.php');

use jorgeandco\hw3\views as VIEW;
use jorgeandco\hw3\models as MODEL;
/**
*	Controller class for handling data passing for list models and views
*/
class ListController extends Controller
{
	/**
	*	Contructor for ListController
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/**
	*	Renders the list view page for either the Landing page or the SubList page based on variables passed.
	*	@param int $listID (the id of the selected list to view)
	*/
	public function direct($listID)
	{
		//creates a ReadModel to hold the data for the navigation bar, lists, and notes for the list based off $listID
		$this->model = new MODEL\ReadModel($listID, "nav");
		//retrieves the navigation bar, lists, and notes data
		$data = $this->model->data("");

		//if the $listID is 1, then its the root Note-A-List page and draws landing page
		if($listID == 1)
		{
			$this->view = new VIEW\LandingView($data);
			$this->view->render();
		}
		//othewise draws subList page based on $listID
		else
		{
			$this->view = new VIEW\SubListView($data);
			$this->view->render();
		}
	}
}