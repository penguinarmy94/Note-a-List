<?php
namespace jorgeandco\hw3\controllers;

class Controller
{
	protected $model;
	protected $view;
	
	public __construct($view, $model)
	{
		this->$model = $model;
		this->$view = $view;
	}
	
}