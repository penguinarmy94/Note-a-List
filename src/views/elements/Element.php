<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views\elements;

/**
*   Abstract View class
*   Holds data for the elements main directory
*/
abstract class Element
{
	protected $mainDir;

    /**
    *   Constructor for the abstract Element class
    *   @param string $dir (the main directory of the application)
    */
	public function __construct($dir)
	{
		$this->mainDir = $dir;
	}

    /**
    *   Renders the specific element
    */
	abstract public function renderElement($array);

}