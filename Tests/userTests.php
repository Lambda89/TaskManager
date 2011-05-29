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
		private $passed = '<span style="color:green;font-weight:bold">PASSED</span> </br>';
		private $failed = '<span style="color:red;font-weight:bold">FAILED</span> </br>';


		/* - SYSTEM - */
		public function __construct() {}
		public function __toString() {}
		public function __clone() {}

		/* - GET/SET - */
		/* - UTILITY : PUBLIC - */
		public static function runAllTests() {
			echo "<h3> Running tests for User Entities </h3>";
			$tests = new test_users();
			$tests->test_create_empty_user_entity();
		}

		public function test_create_empty_user_entity() {
			echo "Default values are as expected: ";
			$user = new UserEntity();

			if( is_null( $user->getCreated() ) ) {
				if( is_null( $user->getEmail() ) ) {
					if( is_null( $user->getLogin() ) ) {
						if( $user->isLoggedIn() == false ) {
							if( $user->getStatus() == "NOUSER" ) {
								echo $this->passed;
							} else { echo $this->failed ." - Status was not NOUSER"; }
						} else { echo $this->failed ." - Login was not false"; }
					} else { echo $this->failed ." - Login was not null."; }
				} else { echo $this->failed ." - Email was not null."; }
			} else { echo $this->failed ." - Created was not null."; }
		}
		
		/* - UTILITY : PRIVATE - */
	} // EOF CLASS
	
	$sys = sys::getSys();

	try {
		test_users::runAllTests();
	} catch( Exception $e ) {
		echo $e;
	}
	
?>
