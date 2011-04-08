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

	class ContactDataEntity implements EntityInterface {
		private $id = -1;						// database id.
		private $protocol = null;		// i.e msn, email, etc
		private $userName = null;		// the screenName/userName they use to be identified.
		
		private $comment = null;
		
		public function __construct( $protocol, $userName, $comment=null ) {
			$this->protocol = $protocol;
			$this->userName = $protocolUserName;
			$this->comment = $comment;
		}

		public function setComment( $comment ) {
			if( $comment == null ) {
				throw new IllegalArgumentException( "No comment", 2001 );
			}
			$this->comment = $comment;
		}

		public function persist($action="INSUPD") {
			if( $action == "DEL" ) {
				if( $id != -1 ) {
					$sqlDEL = "DELETE * FROM `user_contact_data` WHERE `id` = $id AND `protocol_user_name` = '$protocolUserName' LIMIT 1;";
					DB->delete( $sqlDEL );
				}
			} else {
				
			}
		}
	}
?>
