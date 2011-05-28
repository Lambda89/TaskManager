<?php
	/**
		Authour: Werner Johansson
		Created: 2011-05-26
		Purpose: A simple validator class, all functions are static
		Comment:
			The basic premise of this class is get a validator of something. If it fails it will throw
			a ValidationException. The code will signify which error occured. This will relate what kind
			of error we are looking at.
			If it passes it will however return true to make it easier to use the function in an if()
			construction kind of template.
			
		@package
		uses:
			n/a - n/a

	**/
	
	class ValidatorLogic {
		/* - FIELDS - */

		/* - SYSTEM - */
		public function __construct() {}
		public function __toString() {}
		public function __clone() {}

		/* - GET/SET - */
		/* - UTILITY : PUBLIC - */

		public static function isNotNull( $value ) {
			if( is_null( $value ) ) {
				throw new ValidationException( "Indata was null when not expected", 7001, null, $value );
			}
			return true;
		}

		/**
			Checks if the value passed into the function is a valid numeric with it's value
			above 0.
		*/
		public static function isPositiveNumber( $value ) {
			if( is_numeric( $value ) ) {
				if( $value > 0 ) {
					return true;
				} else {
					throw new ValidationException( "Indata was not positive", 7210, null, $value );
				}
			} else {
				throw new ValidationException( "Indata was not numeric.", 7201, null, $value );
			}
		}

		/**
			Checks if the value passed into the function is a valid numeric with it's value
			below 0.
		*/
		public static function  isNegativeNumber( $value ) {
			if( is_numeric( $value ) ) {
				if( $value < 0 ) {
					return true;
				} else {
					throw new ValidationException( "Indata was not negative", 7210, null, $value );
				}
			} else {
				throw new ValidationException( "Indata was not numeric.", 7201, null, $value );
			}
		}

		/**
			This checks whether that this is a proper index id for a table in the DB.
		*/
		public static function isValidID( $value ) {
			if( ValidatorLogic::isNotNull( $value ) ) {
				if(validator::isPositiveNumber( $value ) ) {
					if( is_integer( $value ) ) {
						return true;
					} else {
						throw new ValidationException( "The value was not a positive integer which would indicate a proper DB index ID", 7210, null, $value );
					}
				}
			}
		}

		/**
			Checks if the indata is a proper email via regexp checking.
		*/
		public static function isValidEmail( $value ) {
			if( eregi( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $value ) ) {
				return true;
			}
			throw new ValidationException( "Email was not found valid with the follow regexp: ^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", 7310, null, $value );
		}
		
		
		/* - UTILITY : PRIVATE - */
	}
?>