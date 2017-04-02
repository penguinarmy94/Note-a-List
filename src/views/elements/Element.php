<?php
namespace jorgeandco\hw3\views\elements;

abstract class Element
{	
	protected $mainDir;
		
	public function __construct($dir)
	{
		$this->mainDir = $dir;
	}
	
	abstract public function renderElement($array);

}