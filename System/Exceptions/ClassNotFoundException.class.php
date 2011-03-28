<?php
	/**
		Authour: Werner Johansson
		Created: 2010--
		Purpose:
		Comment:

		Uses:
			n/a - n/a
	**/

	class FileNotFoundException extends Exception {
		public __construct() {
		}
	}

?>
	class DataBaseException extends Exception {
		private $sql = "";
		public function  __construct( $message, $code, $previous=null, $sqlE="" ) {
			parent::__construct( $message, $code, $previous );
			$this->sql = $sqlE;
		}

		public function getSQL() { return $this->sql; }
	}
