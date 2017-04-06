<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\controllers;

/**
*   Controller base class
*   Holds data for the controllers corresponding model and view to act as thier mediator
*/
class Controller
{
	protected $model;
	protected $view;

    /**
    *   Constructor for Controller class
    */
	public function __construct()
	{
		$this->model = 0;
		$this->view = 0;
	}

}