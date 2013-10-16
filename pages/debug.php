<?php
include_once 'globals.php';

function print_debug($msg, $error = NULL)
{
	if (DEBUG_MSG == 'On')
	{
		$_sd = "<div class=\"section1\"><div class=\"sectionrule\"></div><div class=\"error\">";
		$_ed = "</div></div>";
		print($_sd);
		print($msg);
		if ($error != NULL)
			print_r($error);
		print($_ed);
	}
}


?>