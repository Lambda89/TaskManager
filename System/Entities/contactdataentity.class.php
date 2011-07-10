<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-03
		Purpose: Contain a set of information on how to contact this user.
		Comment:
			This is an entity set to describe one line of communication of data to
			the one user. The User class is supposed to be controlling agent of this
			data. It shouldn't be accessed from anywhere else except for testing.
			No form of validation of the indata is done. A mere cleaning of it is
			done as a matter of course. 

		@package Entities
		uses:
			[Commons] db.class.php - Allows for the connection to the database.

	**/

	class ContactDataEntity implements EntityInterface {
		private $id = -1;						// database id.
		private $user = null;
		private $protocol = null;		// i.e msn, email, etc
		private $userName = null;		// the screenName/userName they use to be identified.
		
		private $comment = null;


		/**
			Returns a new object. If an id is passed in and works as a 
		**/
		public function __construct( User $user, $id=-1 ) {
			$this->user = $user;
			try {
				if( $id != -1 ) {
					$this->setID( $id );
					$this->retrieve();
				}
			} catch( Exception $e ) {
				// This probably will want to fail silently, not sure if it should here though.
			}
		}

		/* == GET/SET == */

		public function getId() { return $this->id; }
		public function getProtcol() { return $this->protocol; }
		public function getUserName() { return $this->userName; }
		public function getComment() { return $this->comment; }

		public function setId( $indata ) { $this->id = DB::clean( $indata ); }
		public function setProtocol( $indata ) { $this->protocol = DB::clean( $indata ); }
		public function setUserName( $indata ) { $this->userName = DB::clean( $indata ); }
		public function setComment( $indata ) { $this->comment = DB::clean( $indata ); }


		/* == INTERFACE == */

		/**
		 * A statit method that pulls up all the contactData available for
		 * this user and returns them as an array of ContactDataEntities.
		 */
		public static function retrieveUserContactData( UserEntity $user ) {
			$userID = $user->getEmail();
			$sqlSEL = "SELECT * FROM `user_contact_data_entity` WHERE `fk_user_email` = ". $userID .";";
			$reply = DB::query( $sqlSEL );
			$reply = DB::processQueryResult( $reply );
			$toReturn = array();
			
			foreach( $reply as $row ) {
				$tmp = new ContactDataEntity( $user );
				foreach( $row as $key => $value ) {
					if( $key == "id"       ) { $tmp->setId( $value );       }
					if( $key == "protocol" ) { $tmp->setProtocol( $value ); }
					if( $key == "userName" ) { $tmp->setUserName( $value ); }
					if( $key == "comment"  ) { $tmp->setId( $value );       }
				}
				$toReturn[] = $tmp;
			}

			return $toReturn;
		}

		/**
			Forces this entity to retrieve the database.
			This will return true if a successful retrieval was done, else false.
			@throws IllegalArgumentException
		**/
		public function retrieve() {
			if( is_integer( $id ) ) {
				$sqlSEL = "SELECT * FROM `user_contact_data_entity` WHERE `id`='$id';";
				try {
					$reply = DB::retrieve( $sqlSEL );
					if( $reply != null ) {
						foreach( $reply as $key => $value ) {
							if( $key == "protocol" ) { $this->protocol = $value; }
							if( $key == "userName" ) { $this->userName = $value; }
							if( $key == "comment"  ) { $this->comment = $value;  }
						}
						$this->id = $id;
						return true;
					} else {
						return false;
					}
				} catch( DatabaseException $de ) {
					throw new IllegalArgumentException( "The entity was not present in the database.", 2502, $de, $id );
				}
			} else {
				throw new IllegalArgumentException( "The argument passed into this retrieve was not an integer.", 2501, $id );
			}
		}


		/**
			Will save, update or delete this object in the database.
			Returns true if the action was successful, else false.
			@throws DatabaseException
		**/
		public function persist( $op=null ) {
			if( $op != null ) {
				if( $op == "DEL" ) {
					if( $id != -1 ) {
						$sqlDEL = "DELETE * FROM `user_contact_data_entity` WHERE `id` = $this->id AND `protocol_user_name` = '$this->userName' LIMIT 1;";
						return DB::delete( $sqlDEL );
					}
				} else {
					// special cases.
				}
			} else {
				if( $this->id != -1 ) {
					$sqlINS = "INSERT INTO `user_contact_data_entity` (`id`,`userID`,`protocol`,`fk_user_email`,`comment`) VALUES ( null, '". $this->user->getEmail() ."','$this->protocol','$this->userName','$this->comment')";
					$this->id = DB::insert( $sqlINS );

					if( $this->id != 0 && $this->id != -1 ) {
						return true;
					} else {
						return false;
					}
				} else {
					$sqlUPD = "UPDATE `user_contact_data_entity` SET `protocol`='$this->protocol', `fk_user_email`='$this->userName', `comment` = '$this->comment' WHERE `id`=$this->id";
					return DB::update( $sqlUPD );
				}
			}
		}
	}
?>
