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

	class UserEntity implements EntityInterface {

		/* == Variables == */
		private $email = null;    // unique and primary key in the database for that reason.
		private $login = null;    // if we want it to be different from the email, probably will want that, screen name?
		private $passwd = null;   // Should be hashed. md5 is a good choice probably.
		private $created = null;  // When this entity was created.

		/* == Basic functions == */
		/**
			Basic constructor, will however do a login if provided to a login and password.
		**/
		public function __construct( $login=null, $password=null ) {
			if( $login != null & $password != null ) {
				$this->login( $login, $password );
			}
		}


		/* == Get/Set == */
		
		/**
			Returns/Sets the email of this user.
		**/
		public function getEmail() { return $this->email; }
		public function setEmail( $email ) { $this->email = $email; }

		/**
			Returns/Sets the login/screen name
		**/
		public function getLogin() { return $this->login(); }
		public function setLogin( $userName ) { $this->login = $userName; }

		public function setPassword( $password ) { $this->passwd = $this->hashPassword( $password ); }



		/* == Utility == */
		
		/**
			This 
		**/
		public function login( $login, $password ) {

		}

		public function hashPassword( $password ) {
			if( $password == null || $password == "" ) { throw new IllegalArgumentException( "No password provided.", 4400, null ); }
		}

		public function persist( $op=null ) {
		}
	}

?>
