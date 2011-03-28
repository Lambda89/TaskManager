<?php
	/**
		Authour: Werner Johansson
		Created: 2011-03-05
		Purpose: Represent a task in the system.
		Comment:

		Uses:
			n/a - n/a
		@package Entities
	**/

	class TaskEntity {
		$id = -1;
		$projectID = -1;
		$interalOrder = 1;

		$titel = null;
		$description = null;

		// History table should have this as well.
		$creatorID = null;
		$creDate = -1; // Get date function here.
		$assignedTo = null;
		$assignDate = null; // Allow for null values?
		$closeriD = null;
		$endDate = -1; // Get date function here.

		/**
			Public constructor. Provide a creatorID as creation. Not pulled on it's
			own since it should be unaware of the system it self.
		**/
		public function __construct( $creatorID, $title=null, $description=null ) {
			
		}
	}
?>
