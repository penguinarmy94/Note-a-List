<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views\layouts;

require_once('Layout.php');

/**
* Layout class for writing the doctype, head, and opening body tags for a validating XHTML5 document
*/
class Header extends Layout
{
	/**
    *   Renders the header of the application by writing the doctype, head, and opening body tags of the application's XHTML5 document
    *   @param String $data (the current date to be used as part of the pages title)
    */
	function render($data)
	{
		$styleDir = 'src/styles/styles.css';
		?>
			<!doctype html>
			<html>
				<head>
					<title>Note-A-List: - <?=$data?></title>
					<link rel="stylesheet" type="text/css" href="<?=$styleDir;?>" />
				</head>
				<body>
		<?php
	}
}