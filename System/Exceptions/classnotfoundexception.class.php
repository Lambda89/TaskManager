<?php
	/**
		Authour: Werner Johansson
		Created: 2010--
		Purpose: Denote that a file was not found as expected.
		Comment:
			The fileName should probably contain the filepath as well. Optional 
			however as this a programmers exception and not one for the public to
			view in the end.

		@package Exceptions
		Uses:
			n/a - n/a
	**/

	class FileNotFoundException extends Exception {
		private $filename = null;
		public function __construct( $message, $code, $previous=null, $fileName="" ) {
			parent::__construct( $message, $code, $previous );
			$this->filename = $fileName;
		}
	}

?>
