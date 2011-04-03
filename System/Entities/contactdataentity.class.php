<?php
	/**
		Authour: Werner Johansson
		Created: 2011-04-03
		Purpose: Contain a set of information on how to contact this user.
		Comment:

		@package Entities
		uses:
			n/a - n/a

	**/

	class ContactDataEntity {

		private $protocol = null;
		private $userName = null;
		
		private $comment = null;
		
		public function __construct( $protocol, $userName, $comment=null ) {
			$this->protocol = $protocol;
			$this->userName = $userName;
			$this->comment = $comment;
		}

		public function setComment( $comment ) {
			if( $comment == null ) {
				throw new IllegalArgumentException( "No comment", 1001 );
			}
			$this->comment = $comment;
		}
	}
?>
