<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-
		Purpose:
		Comment:

		@package
		uses:
			n/a - n/a

	**/
	include '../System/sys.class.php';

	class test_users {
		/* - FIELDS - */
		private $passed = '<span style="color:green;font-weight:bold">PASSED</span>';
		private $failed = '<span style="color:red;font-weight:bold">FAILED</span>';


		/* - SYSTEM - */
		public function __construct() {}
		public function __toString() {}
		public function __clone() {}

		/* - GET/SET - */
		/* - UTILITY : PUBLIC - */
		public function runAllTests() {
			echo "<h3> Running tests for User Entities </h3>";
			
			try {
				echo "<br/>Default values for UserEntity are as expected: ";
				$this->test_create_empty_user_entity();
			} catch( Exception $e ) {  echo "<span style='color:red;font-weight:bold'>FAILED</span> <br /> ".$e; }
			try {
				echo "<br/>Prepped values for UserEntity are as expected: ";
				$this->test_prep_userentity_and_verify_data();
			} catch( Exception $e ) { echo "<span style='color:red;font-weight:bold'>FAILED</span> <br /> ".$e; }
			try {
				echo "<br/>Insert of UserEntity worked as expected: ";
				$this->test_persist_prepped_userentity();
			} catch( Exception $e ) { echo "<span style='color:red;font-weight:bold'>FAILED</span> <br /> ".$e; }
			
			try {
				echo "<br/>Test of retrieving known entity: ";
				$this->test_retrieving_known_entity();
			} catch( Exception $e ) { echo "<span style='color:red;font-weight:bold'>FAILED</span> <br /> ". $e; }
			
			
		}



		public function test_create_empty_user_entity() {
			// Setup
			$user = new UserEntity();

			// Test
			if( is_null( $user->getCreated() ) ) {
				if( is_null( $user->getEmail() ) ) {
					if( is_null( $user->getLogin() ) ) {
						if( $user->isLoggedIn() == false ) {
							if( $user->getStatus() == "NOUSER" ) {
								echo $this->passed;
							} else { echo $this->failed ." - Status was not NOUSER </br>"; }
						} else { echo $this->failed ." - Login was not false </br>"; }
					} else { echo $this->failed ." - Login was not null. </br>"; }
				} else { echo $this->failed ." - Email was not null. </br>"; }
			} else { echo $this->failed ." - Created was not null. </br>"; }
			
			// Cleanup
		}

		public function test_prep_userentity_and_verify_data() {
			// Setup
			$user = new UserEntity();
			$user->setEmail( "tux@comhem.se" );
			$user->setLoggedIn( true );
			$user->setLogin( "deepak" );
			$user->setPassword( "crabby" );
			$user->setStatus( "ACTIVE" );

			// Test
			if( $user->getEmail() == "tux@comhem.se" ) {
				if( $user->getLogin() == "deepak" ) {
					if( $user->getStatus() == "ACTIVE" ) {
						if( is_null( $user->getCreated() ) ) {
							if( $user->isLoggedIn() == true ) {
								echo $this->passed;
							} else { echo $this->failed ." - isLoggedIn was not true. <br />"; }
						} else { echo $this->failed ." - Creation date was not null. <br />"; }
					} else { echo $this->failed ." - Not the right status. <br />"; }
				} else { echo $this->failed ." - Not the login set. <br />"; }
			} else { echo $this->failed ." - Not the email set. <br />"; }

			// Cleanup
		}

		public function test_persist_prepped_userentity() {

			// Setup
			$email = "tux@comhem.se";
			
			$user = new UserEntity();
			$user->setEmail( "tux@comhem.se" );
			$user->setLogin( "deepak" );
			$user->setPassword( "crabby" );
			$user->setStatus( "ACTIVE" );
			$user->setLoggedIn( 1 );

			// $user->__toString();

			// Test
			try {
				if( $user->persist() ) {
					echo $this->passed;
				} else { $this->failed ." - Failed to insert user into DB with success message. <br />"; }
			} catch( DataBaseException $dbe ) {
				try {
					if( !DB::delete( "DELETE FROM `user_entity` WHERE `email`='$email';" ) ) {
						echo "<p>Failed to remove entity in cleanup</p>";
					} else {
						echo "<p> Cleaned up Entity </p>";
					}
				} catch( DataBaseException $dbe ) {
					echo "<p>Failed to remove entity in cleanup due to exception.</p>". $dbe;
				}
				throw new InvalidArgumentException( "Crapped out on insert.", 1000, $dbe );
			}

			// Clean up
			try {
 				if( !DB::delete( "DELETE FROM `user_entity` WHERE `email`='$email';" ) ) {
					echo "Failed to remove entity in cleanup";
				}
			} catch( DataBaseException $dbe ) {
				echo "Failed to remove entity in cleanup due to exception.<br />". $dbe;
			}
		}

		public function test_retrieving_known_entity() {
			// Setup
			$email = "tux@comhem.se";
			$login = "deepak";
			$passwd = "crabby";

			$user = new UserEntity();
			$user->setEmail( $email );
			$user->setLogin( $login );
			$user->setPassword( $passwd );
			$user->setStatus( "ACTIVE" );
			$user->setLoggedIn( 1 );


			try {
				if( $user->persist() ) {
				} else { $this->failed ." - Failed to insert user into DB with success message. <br />"; }
			} catch( DataBaseException $dbe ) {
				try {
					if( !DB::delete( "DELETE FROM `user_entity` WHERE `email`='$email';" ) ) {
						echo "<p>Failed to remove entity in cleanup</p>";
					} else {
						echo "<p> Cleaned up Entity </p>";
					}
				} catch( DataBaseException $dbe ) {
					echo "<p>Failed to remove entity in cleanup due to exception.</p>". $dbe;
				}
				throw new InvalidArgumentException( "User crapped out somehow.", 1000, $dbe );
			} catch( ValidationException $e ) {
				try {
					if( !DB::delete( "DELETE FROM `user_entity` WHERE `email`='$email';" ) ) {
						echo "<p>Failed to remove entity in cleanup</p>";
					} else {
						echo "<p> Cleaned up Entity </p>";
					}
				} catch( DataBaseException $dbe ) {
					echo "<p>Failed to remove entity in cleanup due to exception.</p>". $dbe;
				}
				throw new InvalidArgumentException( "User crapped out somehow.", 1000, $e );
				
			}

			
			// Test
			try {
				$user = new UserEntity( $login, $passwd );

				if( $user->getEmail() == "tux@comhem.se" ) {
					if( $user->getLogin() == "deepak" ) {
						if( $user->getStatus() == "ACTIVE" ) {
							if( !is_null( $user->getCreated() ) ) {
								if( $user->isLoggedIn() == true ) {
									echo $this->passed;
								} else { echo $this->failed ." - isLoggedIn was not true. <br />"; }
							} else { echo $this->failed ." - Creation date was not null. <br />"; }
						} else { echo $this->failed ." - Not the right status. <br />"; }
					} else { echo $this->failed ." - Not the login set. <br />"; }
				} else { echo $this->failed ." - Not the email set. <br />"; }
			} catch( ValidationException $ve ) {
				throw new IllegalArgumentException( "Failed to login with inserted user.", 1000 );
			}

			// Clean up
			try {
 				if( !DB::delete( "DELETE FROM `user_entity` WHERE `email`='".$email."';" ) ) {
					echo "Failed to remove entity in cleanup";
				}
			} catch( DataBaseException $dbe ) {
				echo "<p>Failed to remove entity in cleanup due to exception.</p>". $dbe;
			}
		}
		
		/* - UTILITY : PRIVATE - */
	} // EOF CLASS
	
	$sys = sys::getSys();

	try {
		$tests = new test_users();
		$tests->runAllTests();
	} catch( Exception $e ) {
		echo "<p> Code: ". $e->__getCode() ."</p>";
		echo $e;
	}
	
?>
