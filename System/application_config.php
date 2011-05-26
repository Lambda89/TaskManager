<?php
	/**
		Authour: Werner Johansson
		Created: 2011-03-08
		Purpose: Central hub of all system wide constants.
		Comment:
			These should be set up once at the beginning of the use on a server
			or development structure. The idea is too keep the basic structure
			here to avoid later problems with different local structures.
			In other words, we'll use this as a base and use these so we can
			compensate for various differences in the servers including what
			kind of database and driver it uses if necessary.

			Basic assumption of PHP5.3+ is being used.

			SHOULD BE UNDER GIT IGNORE!!!
			
		@Package System
		Uses:
			n/a - n/a
	**/

	// SYSTEM PROPERTIES
	date_default_timezone_set( "Europe/Stockholm" ); // Brutal override of the php.ini file.

	// FILE STRUCTURE
	define( "BASE_DIR",  "/srv/www/htdocs/TaskManager/" );

	define( "BASE_EXP", "/srv/www/htdocs/TaskManager/System/Exceptions/" );
	define( "BASE_ENT", BASE_DIR ."System/Entities/" );
	define( "BASE_COMMONS", BASE_DIR ."Business/CommonClasses/" );
	define( "BASE_LOGIC", BASE_DIR ."Business/Logic/" );

?>
