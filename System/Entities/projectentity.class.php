<?php
/**
 *		Authour: Werner Johansson
 *		Created: 2011-03-22
 *		Purpose: To be the collective class of a project.
 *		Comment:
 * 
 *		@package Entities
 *		Uses:
 *			n/a - n/a
 **/

	class ProjectEntity {
		private $id							= -1;			// DB generated.
		private $name						= null;
		private $description		= null;

		private $members 				= null;		// users

		function __construct( User $user, $id=-1) {
			if( $id != -1 ) { // numcheck?
				// retrieve from DB
			}
		}

		public function persist( $op=null ) {
		}
		
	} // End of Class

?>
