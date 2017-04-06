<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views\elements;

require_once ("Element.php");

/**
* Element class for drawing the navigation bar of the application
*/
class Navigation extends Element
{
	   /**
    *   Constructor for the Navigation class
    *   @param string $dir (the main directory of the application)
    */
	public function __construct($dir)
	{
		parent::__construct($dir);
	}

	/**
	*	Renders the navigation bar on the web browser
	*	@param array $array (holds the data for the navigation bar to be displayed)
	*/
	public function renderElement($array)
	{
		//start of element html body
		?>
			<div class="nav_bar">
			<h1>
		<?php
			//switch case to determince the type of navigation bar to draw based on the amount of items in the navigation bar data
			switch($array['num_of_elements'])
			{
				//only one item, therefore root of list and is Landing page, just draw Note-A-List
				case 1:
					$this->home_nav($array['list_titles']);
				break;
				//two or three items, draw the whole list path structure
				case 2:
				case 3:
					$this->sub_nav($array['list_titles']);
				break;
				default:
					//if more than three items, draw list path structure with Note-A-List and the parents list by concatenating them with ellipsis
					if ($array['num_of_elements'] > 3)
					{
						$this->deep_sub_nav($array['list_titles']);
					}
			}
		?>
			</h1></div>
		<?php
		//end of element html body
	}

	/**
	*	Helper function to draw the navigation bar path only for the Landing page of the application
	*	@param array $array (the list of titles in the navigation bar)
	*/
	private function home_nav($array)
	{
		$action = $this->mainDir."&arg1=1";
		?>
			<a href="<?= $action ?>"><?= $array[0]['name'] ?></a>
		<?php

	}

	/**
	*	Helper function to draw the navigation bar path for two or three items for the Sub List pages of the application
	*	@param array $array (the list of titles in the navigation bar)
	*/
	private function sub_nav($array)
	{
			$size = sizeof($array);
			for ($i = 0; $i < $size; $i++)
			{
				$action = $this->mainDir;
				$action .= ("&arg1=".$array[$i]['id']);
		?>

				<a href="<?= $action ?>"><?=$array[$i]['name']?></a>
		<?php
				if ($i != $size - 1)
				{
		?>
				<span>/</span>
		<?php
				}

			}

	}

	/**
	*	Helper function to draw the navigation bar path for more than three items for the Sub List pages of the application
	*	@param array $array (the list of titles in the navigation bar)
	*/
	private function deep_sub_nav($array)
	{
		$size = sizeof($array);
			for ($i = 0; $i < $size; $i++)
			{
				$action = $this->mainDir."&arg1=".$array[$i]['id'];
		?>

				<a href="<?= $action ?>"><?=$array[$i]['name']?></a>
		<?php
				if ($i == 0)
				{
		?>
				<span>/..</span>
		<?php
				}
				if ($i != $size - 1)
				{
		?>
				<span>/</span>
		<?php
				}
			}

	}
}