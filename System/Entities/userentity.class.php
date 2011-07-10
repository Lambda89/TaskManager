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
		private $status = "NOUSER";   // ENUM[ACTIVE,INACTIVE,BANNED,REGISTERED,NOUSER].If this user is to be considered in use or deleted. May also symbolise a state of banned.
		private $loggedIn = 0;
		
		/* == Basic functions == */
		/**
			Basic constructor, will however do a login if provided to a login and password.
		**/
		public function __construct( $login=null, $password=null ) {
			if( !is_null( $login ) && !is_null( $password ) ) {
				$this->login( $login, $password );
			}
		}

		public function __toString() {
			return
					"	<div style='border:groove 2p #555;padding:5px;color:#222;background:#DDD;width:500px;max-width:500px;'>
						<span style='width:80px;max-width:80px;text-align:right;'> Email: </span>". $this->email ."<br />
						<span style='width:80px;max-width:80px;text-align:right;'>Login: </span>". $this->login ."<br />
						<span style='width:80px;max-width:80px;text-align:right;'>Passwd: </span>". $this->passwd ."<br />
						<span style='width:80px;max-width:80px;text-align:right;'>Created: </span>". $this->created ."<br />
						<span style='width:80px;max-width:80px;text-align:right;'>Status: </span>". $this->status ."<br />
						<span style='width:80px;max-width:80px;text-align:right;'>LoggedIn: </span>". $this->loggedIn ."<br />
						</div>";
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
		public function getLogin() { return $this->login; }
		public function setLogin( $userName ) {
			ValidatorLogic::isNotNull( $userName );
			$this->login = $userName;
		}

		public function setPassword( $password ) { $this->passwd = $this->hashPassword( $password ); }

		public function setStatus( $value ) {
			if( !is_null( $value ) ) {
				switch( $value ){
					case "ACTIVE" : $this->status = $value; break;
					case "INACTIVE" : $this->status = $value; $this->loggedIn = 0; break;
					case "BANNED" : $this->status = $value; $this->loggedIn = 0; break;
					case "REGISTERED" : $this->status = $value; break;
					case "NOUSER" : $this->status = $value; $this->loggedIn = 0; break;
					default: throw new ValidationException( "Not a proper ENUM value for user_entity:status", 7400, null, $value );
				}
			}
		}
		public function getStatus() { return $this->status; }

		public function setCreated( $value ) { $this->created = $value; }
		public function getCreated() { return $this->created; }

		public function setLoggedIn( $value ) {
			if( ValidatorLogic::isBool( $value) ) {
				$this->loggedIn = ValidatorLogic::isBool( $value );
			} else {
				throw new ValidationException( "Indata for user:loggedIn was not a bool", 7510, null, $value );
			}
		}
		public function isLoggedIn() { return $this->loggedIn; }
		
		
		/* == Utility == */
		
		/**
			This will either set this userentity to one user found in the database
			or leave the user at default values.
		**/
		public function login( $login, $password ) {
			if( !is_null( $login ) && !is_null( $password ) ) {
				try {
					ValidatorLogic::isValidEmail( $login );
					$this->email = $login;
				} catch( ValidationException $ve ) {
					$this->setLogin( $login );
				}
				
				$this->setPassword( $password );
				$this->retrieve();
				
				try {
					$this->isCorrect();
					$this->setLoggedIn( true );
					$this->persist();
				} catch( ValidationException $ve ) {
					if( $ve->getcode() == 7310 ) {
						
					} else {
						throw new IllegalArgumentException( "User was not in a legal state", 7001, $ve );
					}
				}
			} else {
				throw new IllegalArgumentException( "Login and/or Password was null.", 7001, null, $login." : ".$password );
			}
		}

		/**
		 * A basic logout function.
		 */
		public function logout() {
			$this->setLoggedIn( false );;
			$this->persist();
		}
		
		/**
			Returns a SHA1 hash of the password passed into it.
		*/
		public function hashPassword( $password ) {
			if( $password == null || $password == "" ) {
				throw new IllegalArgumentException( "No password provided.", 2501, null );
			}
			return sha1( $password );
		}

		/**
			A simple persists 
		*/
		public function persist( $op=null ) {
			if( $op == "DEL" && $this->login != null ) {
				$inactiveSQL = "UPDATE `user_entity` SET `status`='INACTIVE' WHERE `login`='".$this->login."' AND `passwd`='".$this->passwd."' LIMIT 1;";
				return DB::delete( $inactiveSQL );
			} else if( !is_null( $this->created ) ) {
				$sqlUPD = "UPDATE `user_entity` SET `email`='".$this->email."', `login`='". $this->login."', `passwd`='". $this->passwd ."', `status`='".$this->status."', `loggedIn`=".$this->loggedIn." WHERE `email`='". $this->email ."' LIMIT 1;";
				return DB::update( $sqlUPD );
			} else {
				$this->isCorrect();
				$sqlIns = "INSERT INTO `user_entity` (`email`,`login`,`passwd`,`createdAt`,`status`,`loggedIn`) VALUES ('".$this->email."','".$this->login."','".$this->passwd."',CURRENT_TIMESTAMP,'".$this->status."', ".$this->loggedIn." );";
				$returned = DB::insert( $sqlIns, "user_entity", "email" );
				if( $returned === $this->email ) {
					return true;
				} else {
					throw new IllegalArgumentException( "Key returned does not match internal object key.", 2400, null, $returned );
				}
			}
		}

		/**
			A rather simple retrieval from the DB returning a new object if this class.
			It presumes that login and password as set as part of the contract to retrieve
			the data from the DB.
		*/
		public function retrieve() {
			if( $this->email != null ) {
				$sqlRet = "SELECT * FROM user_entity WHERE email='".$this->email."' AND passwd='".$this->passwd."';";
			} else {
				$sqlRet = "SELECT * FROM user_entity WHERE login='".$this->login."' AND passwd='".$this->passwd."';";
			}
			$result = DB::query( $sqlRet );
			
			try {
				if( $result->num_rows != 1 ) {
					if( $result->num_rows == 0 ) {
						return;
					} else {
						throw new IllegalArgumentException( "Retrieved several users. Illegal state in DB!", 2510, null, $this->login );
					}
				}
				
				$rows = DB::processQueryResult( $result );

				foreach( $rows as $userData ) {
					foreach( $userData as $key => $value ) {
						switch ( $key ) {
							case "email"     : $this->setEmail( $value ); break;
							case "login"     : $this->setLogin( $value ); break;
							case "passwd"    : $this->passwd = $value; break; // We don't want to rehash the password once more.
							case "createdAt" : $this->setCreated( $value ); break;
							case "status"    : $this->setStatus( $value ); break;
							case "loggedIn"  : $this->setLoggedIn( $value ); break;
							default : break;
						}
					}
				}
			} catch( ErrorException $ee ) {
				echo $result->info;
			}
		}

		/**
		 * This function is private since it should only be used internally to ensure that
		 * the caller of it uses it to validate it for DB use. Should be used before a
		 * persist request or after a retrieval that the user entity has a correct state
		 * of a user.
		 */
		private function isCorrect() {
			if( $this->status == "NOUSER" ) {
				echo "<div>Status error: ". $this->status ."</div>";
				throw new ValidationException( "User has an illegal status: ". $this->status .". User is disallowed to login.", 7401 );
			}
			if( $this->passwd == null || $this->passwd == "" ) {
				echo "<div>Password error: ". $this->passwd ."</div>";
				throw new ValidationException( "User has no password, clear violation. User is disallowed to login.", 7401 );
			}
			if( $this->login == null || $this->login == "" ) {
				echo "<div>No login: ". $this->login ."</div>";
				throw new ValidationException( "User has no login, clear violation.  User is disallowed to login.", 7401 );
			}

			ValidatorLogic::isValidEmail( $this->email );
		}
	}
?>
