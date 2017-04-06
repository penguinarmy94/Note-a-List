<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views\layouts;

/**
*   Abstract Layout class
*/
abstract class Layout {
    /**
    *   Renders the specific layout
    *   @param String $data (A String to be used for the layout to use)
    */
	abstract function render($data);
}