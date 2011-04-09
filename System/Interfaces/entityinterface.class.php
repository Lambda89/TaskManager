<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-01
		Purpose: Force a certain behavior of the classes using this class.
		Comment:
			The point of this that a a function can take any entity and know
			that they can invoke the persist function on the entity.

		@package Interfaces
		uses:
			n/a - n/a

	**/

	interface EntityInterface {
		/**
			This method is meant to be used to save, update or delete the entity in
			question. It should remove any dependent entities in the process. 
		**/
		public function persist( $op=null );

		/**
			This method is meant to be used to retrieve the entity from the database.
		**/
		public function retrieve();
	    
	}
	
?>
