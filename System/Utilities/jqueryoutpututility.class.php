<?php

/**
	Authour: Rickard Lund
	Created: 2011-03-30
	Purpose: Generate output associated with the jQuery-libraries
	Comment: 
		
	@package utility
	uses:
		n/a - n/a
**/
class JqueryOutputUtility
{
	static protected $JQUERY_DIR = "jquery/";
	
	public static function outputJqueryScripts() {
		$output
			= '<script src="'. self::$JQUERY_DIR .'jquery.js" type="text/javascript" charset="utf-8"></script>'
			. '<script src="'. self::$JQUERY_DIR .'jquery-ui.js" type="text/javascript" charset="utf-8"></script>';
			
		echo $output;
	}
}


?>