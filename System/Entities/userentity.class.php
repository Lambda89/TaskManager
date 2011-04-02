<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-02
		Purpose: To describe the user from a data point of view.
		Comment:
			Basic operation of login and such should probably be performed here from
			a the User class that this should be a part of.

		@package Entities
		uses:
			n/a - n/a

	**/

	class UserEntity {

		private $email = null; // unique and primary key in the database for that reason.
		private $login = null; // if we want it to be different from the email, probably will want that, screen name?
		private $passwd = null; // Should be hashed. md5 is a good choice probably.

		/**
			Basic constructor, will however do a login if provided to a login and password.
		**/
		public function __construct( $login=null, $password=null ) {
			if( $login != null & $password != null ) {
				$this->login( $login, $password );
			}
		}

		/**
			Returns the email of this user.
		**/
		public function getEmail() {
			return $this->email;
		}

		/**
			This 
		**/
		public function login( $login, $password ) {

		}
	}

?>
