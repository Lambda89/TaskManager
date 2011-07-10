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
	class test_validator {
		/* - FIELDS - */
		private $passed = '<span style="color:green;font-weight:bold">PASSED</span> </br>';
		private $failed = '<span style="color:red;font-weight:bold">FAILED</span> </br>';

		public function runAllTests() {
			$this->validateEmailLogic();
		}
		
		/* - UTILITY : PUBLIC - */
		public function validateEmailLogic() {
			echo '<h3> Running tests on email addresses </h3>';
			$valid =  "werner.johansson@good-omens.se";

			$invalids = array(
			      "kalle@@emu.se"
			    , "kalle.anka.se"
			    , "kalle.anka@"
			    , "@ankeborg.se"
			    , "kalle.anke@ankeborg.crappies"
			    , "kalle.anka@ankeborg"
			);

			
			echo 'Valid Email pass test: ';
			if( ValidatorLogic::isValidEmail( $valid ) ) {
				echo $this->passed;
			} else {
				echo $this->failed;
			}

			foreach( $invalids as $invalid ) {
				echo 'InValid Email test( '. $invalid .' ): ';
				try {
					if( ValidatorLogic::isValidEmail( $invalid ) ) {
						echo $this->failed;
					} else {
						echo $this->passed;
					}
				} catch( ValidationException $ve ) {
					if( $ve->getCode() ==  7310 ) {
						echo $this->passed;
					} else {
						echo $this->passed ." - Massive error: ". $ve;
					}
				}
			}
		}
	} // EoF Class

		/* - UTILITY : PRIVATE - */

	$sys = sys::getSys();
	try {
		$tester = new test_validator();
		$tester->runAllTests();
	} catch( Exception $ee ) {
		echo "Failed to load test_validator class";
	}

?>
