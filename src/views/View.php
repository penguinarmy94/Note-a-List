<?php
namespace jorgeandco\hw3\views;

require_once ('layouts/Header.php');
require_once ('layouts/Footer.php');

use jorgeandco\hw3\views\layouts as LYOT;

abstract class View
{	
	protected $head;
	protected $footer;
	
	public function __construct()
	{
		$this->head = new LYOT\Header();
		$this->footer = new LYOT\Footer();
	}
	
    abstract public function render();
}