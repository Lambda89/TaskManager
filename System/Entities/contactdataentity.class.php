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
		
		public function __construct( $id=-1 ) {
			if( $id != -1 ) {
				retrieve( $id );
			}
		}

		public function setComment( $comment ) {
			if( $comment == null ) {
				throw new IllegalArgumentException( "No comment", 2001 );
			}
			$this->comment = DB::clean( $comment );
		}

		

		/**
			Returns true if the action was successful
		**/
		public function persist( $op=null ) {
			if( $op != null ) {
				if( $op == "DEL" ) {
					if( $id != -1 ) {
						$sqlDEL = "DELETE * FROM `user_contact_data` WHERE `id` = $this->id AND `protocol_user_name` = '$this->userName' LIMIT 1;";
						return DB::delete( $sqlDEL );
					}
				} else {
					// special cases.
				}
			} else {
				if( $this->id != -1 ) {
					$sqlINS = "INSERT INTO `user_contact_data` (`id`,`protocol`,`userName`,`comment`) VALUES ( null, '$this->protocol','$this->userName','$this->comment')";
					$this->id = DB::insert( $sqlINS );
					if( $this->id != 0 && $this->id != -1 ) {
						return true;
					} else {
						return false;
					}
				} else {
					$sqlUPD = "UPDATE `user_contact_data` SET `protocol`='$this->protocol', `userName`='$this->userName', `comment` = '$this->comment' WHERE `id`=$this->id";
					return DB::update( $sqlUPD );
				}
			}
		}
	}
?>
