<?php
namespace jorgeandco\hw3\views\layouts;

require_once('Layout.php');

class Header extends Layout
{
	function render($title)
	{
		$styleDir = getcwd()."/src/styles/styles.css";
		?>
			<!doctype html>
			<html>
				<head>
					<title><?=$title?></title>
					<link rel="stylesheet" type="text/css" href=<?=$styleDir;?>" />
				</head>
				<body>
		<?php		
	}
}