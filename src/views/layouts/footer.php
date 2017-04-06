<?php
/**
* @author Jorge Aguiniga, Luis Otero
*/
namespace jorgeandco\hw3\views\layouts;

require_once('Layout.php');

/**
* Layout class for writing the closing tags for a validating XHTML5 document
*/
class Footer extends Layout
{
    /**
    *   Renders the footer of the application by writing the closing tags of the application's XHTML5 document
    *   @param String $data (not used)
    */
	function render($data)
	{
		?>
			</body>
			</html>
		<?php
	}
}