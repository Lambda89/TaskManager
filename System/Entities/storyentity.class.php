<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-02
		Purpose: To contain the necessary data to describe a story within the system.
		Comment:
		
		@package Entities
		uses:
			n/a - n/a
			  
	**/

	class Story {
		
		private $id = -1;
		private $title = null;
		private $description = null;
		private $creator = null;
		private $creDate = null;
		
		
		public function __constructor( User $user ) {
			$creator = $user->getEmail();
			$creDate = getDate();
		}
	}
?>
