<?php

/**
	Authour: Rickard Lund
	Created: 2011-03-30
	Purpose: Generate output of css link
	Comment: 
		
	@package utility
	uses:
		n/a - n/a
**/

class CssOutputUtility
{
	public static function outputCssLink() {
		$default_style = 'default.css';

		if (!$style) {
			$style = $default_style;
		}

		$link
			= '<link rel="stylesheet" href="Styles/'. $style .'" type="text/css" media="screen" charset="utf-8">';

		echo $link;
	}
}


?>