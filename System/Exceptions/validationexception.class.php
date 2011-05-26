<?php
	/**
		Authour: Werner Johansson
		Created: 2011-05-26
		Purpose: Notify the user that an error has occured.
		Comment:
			This is basically related to any data that is not a valid indata
			for a function.
		@package
		uses:
			n/a - n/a

	**/

	class ValidationException extends Exception {
		/* - FIELDS - */
		private $valueOfError = null;

		/* - SYSTEM - */
		public function __construct( $message, $code, $previous=null, $value=null ) {
			parent::__construct( $message, $code, $previous );
			$this->valueOfError = $value;
		}
		
		/* - GET/SET - */
		/* - UTILITY : PUBLIC - */

		public function getValue() {
			return $this->valueOfError;
		}
		
		/* - UTILITY : PRIVATE - */
	}

?>
