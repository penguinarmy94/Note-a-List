<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views;

require_once ('layouts/Header.php');
require_once ('layouts/Footer.php');

use jorgeandco\hw3\views\layouts as LYOT;

/**
*	Abstract View class
*	Holds data for the view's header and footer to be used in all subclasses
*/
abstract class View
{
	protected $head;
	protected $footer;

	/**
	*	Constructor for the abstract Model class
	*/
	public function __construct()
	{
		$this->head = new LYOT\Header();
		$this->footer = new LYOT\Footer();
	}

	/**
	*	Renders the view's specific page
	*/
    abstract public function render();
}