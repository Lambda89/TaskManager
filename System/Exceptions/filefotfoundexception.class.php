<?php
	/**
		Authour: Werner Johansson
		Created: 2011-03-08
		Purpose: To notify the system that a failure occurred trying access a file.
		Comment:

		Uses:
			n/a - n/a
	**/

	class FileNotFoundException extends Exception {
		private $file;
		public function __construct( $message, $code, $previous=null, $file=null ) {
			parent::__construct( $message, $code, $previous );
			$this->file = $file;
		}

		public function getFileSought() {
			return $this->file;
		}
	}
?>
