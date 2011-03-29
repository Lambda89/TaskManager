<?php

/**
* 
*/
class Utilities
{
	public static function outputHtmlTitle() {
		$title = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		echo str_replace( "/", " | ", str_replace( ".php", "", $title ) );
	}
}


?>