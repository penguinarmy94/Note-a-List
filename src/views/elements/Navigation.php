<?php
namespace jorgeandco\hw3\views\elements;

require_once ("Element.php");

class Navigation extends Element
{
	public function __construct($dir)
	{
		parent::__construct($dir);
	}
	public function renderElement($array)
	{
		?>
			<div><h1>
		<?php
			switch($array['num_of_elements'])
			{
				case 1:
					$this->home_nav($array['list_titles']);
				break;
				case 2:
				case 3:
					$this->sub_nav($array['list_titles']);
				break;
				default:
					if ($array['num_of_elements'] > 3)
					{
						$this->deep_sub_nav($array['list_titles']);
					}
					else
					{
						
					}
			}
		?>
			</h1></div>
		<?php
	}
	
	private function home_nav($array)
	{
		$action = $this->mainDir."&arg1=0";
		?>			
			<a href="<?= $action ?>"><?= $array[0]['name'] ?></a>
		<?php
	}
	
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