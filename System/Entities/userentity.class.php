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
		private $state = "NOUSER";   // ENUM[ACTIVE,INACTIVE,BANNED,REGISTERED].If this user is to be considered in use or deleted. May also symbolise a state of banned.
		private $loggedIn = false;

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

		public function setId( $id ) { }

		/* == Utility == */
		
		/**
			This will either set this userentity to one user found in the database
			or leave the user at default values.
		**/
		public function login( $login, $password ) {
			$this->setLogin( $login );
			$this->setPassword( $passHash );
			
		}

		public function hashPassword( $password ) {
			if( $password == null || $password == "" ) {
				throw new IllegalArgumentException( "No password provided.", 2501, null );
			}
		}

		public function persist( $op=null ) {
			if( $op == "DEL" && $id != null ) {
				$delSQL = "DELETE * FROM `user_entity` WHERE `id` = ". $this->login ." AND ". $this->passwd ." LIMIT 1;";
				return DB::delete( $delSQL );
			} else if( $this->id != null ) {
				$sqlUPD = "UPDATE `user_entity` SET `login` = ". $this->login." AND `passwd` = ". $this->passwd ." WHERE id = ". $this->login .";";
				return DB::update( );
			} else {
				$sql
			}
		}

		/**
			
		*/
		public function retrieve() {
			$user = new UserEntity(); // makes sure we return a new object in case the retrieval goes wrong.
			
			$sqlRet = "SELECT * FROM `userentity` WHERE `login`='".$this->login."' AND `password`='".$this->passwd."';";
			$result = DB::query( $sqlRet );
			if( $result->num_rows != 1 ) {
				if( $result->num_rows == 0 ) {
					return $user;
				} else {
					throw new IllegalArgumentException( "Retrieved several users. Illegal state!", 2510, null, $this->login );
				}
			}
			
			$userData = DB::processQueryResult( $result );

			foreach( $userData as $key => $value ) {
				switch ( $key ) {
					case "id"        : $user->setId( $value ); break;
					case "login"     : $user->setLogin( $value ); break;
					case "passwd"    : $user->setPasswd( $value ); break;
					case "created"   : $user->setCreated( $value ); break;
					case "state"     : $user->setState( $value ); break;
					case "loggedIn"  : $user->setLoggedIn( $value ); break;
					default : break;
				}
			}
			return $user;
		}
	}
?>
