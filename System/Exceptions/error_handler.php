<?php
	/**
		Authour: Werner Johansson
		Created: 2010-09-29
		Purpose: Convert error_log()
		Comment:
		This is a php.net thingy to convert errors into exceptions. Goody?

		This is a new thing for me so essentially this will convert php errors to
		exceptions which are handled on the spot with try{}catch(){} like in Java.
		Error becomes ErrorException on transition so checking for them specifically
		is approved. Exception catches all as expected.
		A class extending Exception becomes a new Exception with that name and can
		be caught as such. Remember to implement them. You can add your own methods
		in them but not override the already existing ones.

		Basic assumption of  PHP5.3+ is being used.
		@package error
			uses:
				n/a - n/a
	**/

	/**
		http://www.php.net/manual/en/class.errorexception.php - last remark
		troelskn at gmail dot com
		29-Jul-2008 11:08
	**/

	function exceptions_error_handler( $severity, $message, $filename, $lineno ) {
		if( error_reporting() == 0 ) {
			return;
		}
		if( error_reporting() & $severity ) {
			throw new ErrorException( $message, 0, $severity, $filename, $lineno );
		}
	}

	set_error_handler( 'exceptions_error_handler' );

?>
