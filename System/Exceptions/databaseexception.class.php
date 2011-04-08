<?php
/**
 *		Authour: Werner Johansson
 *		Created: {$date}
 *		Purpose:
 *		Comment:
 *
 *		@package
 *		Uses:
 *			n/a - n/a
 **/

	/**
	*		To denote a database error in some form.
	**/
	class DataBaseException extends Exception {
		private $sql = "";
		public function  __construct( $message, $code, $previous=null, $sqlE="" ) {
			parent::__construct( $message, $code, $previous );
			$this->sql = $sqlE;
		}

		public function getSQL() { return $this->sql; }
	}

?>
