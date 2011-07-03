<?php
/**
 *		Authour: Werner Johansson
 *		Created: 2011-07-02
 *		Purpose: Contains the app specific data needed.
 *		Comment:
 *
 * 			This contains the specific data needed to navigate the
 * 			file structure and other logical hurdles.
 *		@package System
 *		uses:
 *			n/a - n/a
 *
 **/
	require 'server_config.php';
	
	define( "BASE_EXCEP",  BASE_DIR."System/Exceptions/" );
	define( "BASE_COMMON", BASE_DIR."Business/CommonClasses/" );
	define( "BASE_LOGIC",  BASE_DIR."Business/Logic/" );
	define( "BASE_ENTITY", BASE_DIR."System/Entities/" );
	define( "BASE_INTER",  BASE_DIR."System/Interfaces/" );

	
?>
