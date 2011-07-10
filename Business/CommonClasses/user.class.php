<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-02
		Purpose: Denote and describe a user within the system.
		Comment:
			Will for better or worse be the class we use to describe a user to the rest of the system.
			It will contain all the pertinent data needed to operate over a user within the system.
			For it's own data purposes it will be using various entities from the data base. The reason
			for this class is to avoid having a massiva amounts of entrypoints to the
			
		@package Commons
		uses:
			UserEntity.class.php - basic data such as login, password etc.

	**/

	class User {

		/* == Variables == */

		private $user = null;
		private $contactData = array();

		/* == Standard methods == */
		
		/**
			Basic Constructor, requires
		**/
		public function __construct( UserEntity $userEntity=null, $password=null ) {
			$this->user = $userEntity;
			if( $this->user != null && $password != null ) {
				$this->reconstruct( $password );
			}
		}

		/* == Get/Set internal variables == */

		public function setUserEntity( UserEntity $user ) { $this->user = $user; }
		public function getUserEntity() { return $this->user; }

		public function getContactData() { return $this->contactData; }
		public function setContactData( array $data ) {
			// will need validation
		}
		public function addContactData( ContactDataEntity $conData ) {
			
		}
		

		/* == Peristence methods == */

		/**
		 * Logins in the user if it exists or create a new user if there was
		 * none in the DB to match.
		 */
		public function login( $login, $password ) {
			$this->setUserEntity( new UserEntity( $login, $password ) );
			$this->reconstruct( $password );
		}

		/**
		 * Persists all the entities related to this  
		 */
		public function logout() {
			if( $this->user instanceof UserEntity ) {
				$this->user->logout();
			}
			
			foreach( $this->contactData as $cData ) {
				if( $cData instanceof ContactDataEntity ) {
					$cData->persist();
				}
			}
		}

		/**
		 * It presumes that there is a proper user entity to work with
		 * on this user and from there it will pull in other entities
		 * to fill out the User.
		 */
		public function reconstruct() {
			$this->setContactData( ContactDataEntity::retrieveUserContactData( $this->getUserEntity() ) );
			
		}
		

		/* == Utility methods == */
		
		/**
			Returns the email of the user, the email will be pulled from the UserEntity if there is
			one present inside. Else it's null.
		**/
		public function getEmail() {
			$email = null;
			if( $user != null ) {
				$email = $user->getEmail();
			}
			return $email;
		}
		
		public function __toString() {
			return $this->user->__toString();
		}
	}
?>
