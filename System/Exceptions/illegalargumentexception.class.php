<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-03
		Purpose: Denotes an illegal argument passed to a function.
		Comment:

		@package Exception
		uses:
			n/a - n/a

	**/

	class IllegalArgumentException extends Exception {
	
		private $argument = "Argument Not Provided";
		
		public function __construct( $message, $code, $previous=null, $argument=null ) {
			parent::__construct( $message, $code, $previous );
			if( $argument != null ) { $this->argument = $argument; }
		}

		public function getArgument() {
			return $this->argument;
		}
	}
?>
