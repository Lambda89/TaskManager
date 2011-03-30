<?php

/**
	Authour: Rickard Lund
	Created: 2011-03-29
	Purpose: Format output of certain strings needed in application
	Comment: 
		
	@package utility
	uses:
		n/a - n/a
**/
class FormatOutputUtility
{
	/**
		Format text for the title-tag in view-files
	**/
	
	public static function outputHtmlTitle() {
		$title = str_replace( "/", " | ", str_replace( ".php", "", $title ) );
		echo ucwords($formatted_title);
	}
}


?>