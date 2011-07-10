<?php
	/**
		Authour: Werner Johansson
		Created: 2011-03-08
		Purpose: Work as a central point for system functionality
		Comment:
			This will be the file all script files will pull in since this loads
			the error handler and makes sure the classes are all autoloaded when
			they are needed.
			This makes for a neater loading process for all scripts.


		@package system
		uses:
			error_handler.php - setups the error handling of this application
			exceptions.class.php - pulls in the custom exceptions defined there.
	**/

	require_once( 'application_config.php' );
	require_once( BASE_EXCEP ."error_handler.php" );

	/**
		Required to be here to autoload classes as they are encountered.
		Basic operation is to make all file names to lowercase in order to better
		handle them.
		All classes that are expected to be autoloaded by default have to be
		prefixed in a certain manner and expected to reside within a certain
		folder in the file structure.

		In order for this to work classes are supposed to named
		'<name>_<type>.class.php' or <name><type>.class.php. It will look into
		the ones name <name><type> first and see if anything matches, short of that
		it will try for files named with the _ in it and try to select a file from
		those kind directories. Needless to say this is to extend the filesystem
		to encompass more classes.
		If the <type> is omitted it will go to a standard library, /Business/CommonClasses
		for classes and try there. Failing all else it will default to a
		FileNotFoundException for the developer to deal with.

		@throws FileNotFoundException
	**/
	function __autoload( $class ) {
		$class = strtolower( $class );
		
		$toLoad = null;

		if( stristr( $class, "exception" ) == "exception" ) {
			$toLoad = BASE_DIR ."System/Exceptions/". $class .".class.php";
		}
		else if( stristr( $class, "entity" ) == "entity" ) {
			$toLoad = BASE_DIR ."System/Entities/". $class .".class.php";
		}
		else if( stristr($class, "interface") == "interface" ) {
			$toLoad = BASE_DIR ."System/Interfaces/". $class .".class.php";
		}
		/** Not optimal, Utilities should be located under Business for general access */
		else if( stristr( $class, "utility") == "utility") {
			$toLoad = BASE_DIR ."System/Utilities/". $class .".class.php";
		}
		else if( stristr( $class, "logic" ) == "logic" ) {
			$toLoad = BASE_DIR ."Business/Logic/". $class .".class.php";
		}
		else {
			try {
				$part = explode( "_", $class );

				switch( $part[ 0 ] )  {
					case "test" :
						$toLoad = BASE_DIR ."Tests/". $class .".class.php";
						break;
					case "view" :
						$toLoad = BASE_DIR ."Views/". $class .".class.php";
						break;
					default:
						$toLoad = BASE_DIR ."Business/CommonClasses/". $class .".class.php";
						break;
				}
			} catch( Exception $e ) {
				// Failed to explode the file into smaller pieces, letting it go the try below.
			}
		}

		// Actual file loading happens here.
		try {
			require_once( $toLoad );
		} catch( ErrorException $e ) {
			echo $e ."</br>";
			$mess = "Did not find the class file requested, '". $class ."'. Please check naming and paths before retrying.";
			throw new FileNotFoundException( $mess, 1000, $e, $toLoad );
		}
	}

	/**
		Was thought to contain system wide functionality for various items.
		May be merged with the error_handler into one system.php instead to
		make for an easier file structure.
	**/
	class Sys {
		/* - FIELDS - */
		private static $system = null;		// Singleton pattern here

		private $sessionActive = FALSE;
		private $user = null;


		/* - SYSTEM - */
		private function __construct() {
		}

		public static function getSys() {
			if( Sys::$system == null ) {
				Sys::$system = new Sys();
			} else {}

			Sys::$system->activate(); // We always want the session when we go here running

			return Sys::$system;
		}

		public function __toString() {}
		public function __clone() {}


		/* - GET/SET - */


		public function getUser() { return $this->user; }
		public function setUser( User $user ) { 
			$this->user = $user;
			$_SESSION[ 'user' ] = $user;
		}

		/* - UTILITY : PUBLIC - */

		/**
			Returns TRUE if considered as such
		**/
		public function isSessionActive() {
			return $this->sessionActive;
		}

		/**
			Activates and restores any currect SESSION state from previous page load.
		**/
		public function activate() {
			try {
				session_start();
				$this->sessionActive = TRUE;

				$this->prepSession();

			} catch( ErrorException $ee ) {
				// No action taken here as we are only out to determine session start
				// And user validity
			}

			return $this->sessionActive;
		}

		/**
			Ends the session in a very final call on every function there is to
			annihilate the data in the session. In short even on a kept session it
			won't do anyone any good as it's as empty as it was the very first time
			it was first called.
		**/
		public function deactivate() {
			if( $this->isSessionActive() ) {
				try {
					foreach( $_SESSION as $key => $value ) {
						$_SESSION[ $key ] = null;
						unset( $_SESSION[ $key ] );
					}
					unset( $_SESSION );
					session_unset();
					session_destroy();
					$this->sessionActive = FALSE;
				} catch( Exception $e ) {}
			} else {}

			return !$this->sessionActive; // flipped with a not
		}

		/* - UTILITY : PRIVATE - */

		/**
			A private function to load any kind of data from a session that is in use.
			Basic user object and such should be loaded here to maintain a quick
			access to the data associated with the session.
			Basically anything that shouldn't be loaded from session but kept under
			a tighter leach should be run from here so we don't make mistakes in
			references. Besides, this is easier than doing and isset() every time we
			need something.
		**/
		private function prepSession() {
			if( $this->sessionActive ) {
				if( isset( $_SESSION[ 'user' ] ) ) {
					$this->user = $_SESSION[ 'user' ];
				} else {
					$this->user = new User();
					$this->user->setUserName( "Unknown User" );
				}
			} else {}
		}
	}

?>
