<?php
	/**
	 * Authour: Werner Johansson
	 * Created: 2011-04-08
	 * Purpose: Simple connection to a database in an easy exchangable way.
   * 
   * DB - the magic lick
   * Using the singelton pattern in non-OO way. Essentially one client may
   * never use more than one coupling to the DB at any given time. It simply
   * locks down things a bit more, securing from overload though not cracking
   * anything by locks.
   *
   * For general use, however note that the config does not allow for more
	 * than one DataBase at a time. Make a new class or implement a switcher
	 * if you need to connect to several different databases. (new class!)
	 *
	 * @package Commons
	 * uses:
	 * 		/System/server_config.php - fixed values for database notation.
	 **/

	class DB {
		static private $DB; // The Singelton

		/**
		 *	Returns an object of DB, effectively a singleton pattern for the
		 *	db connection which also means we will not abuse resources by creating a
		 *	lot of connections.
		 */
		static function getInstance() {
			if( DB::$DB == null ) {
				try {
					DB::$DB = new mysqli(
						DB_SERVER,
						DB_USER,
						DB_PASSWD,
						DB_NAME
					);
				} catch( ErrorException $ee ) {
					$message = "ErrorException in LogDB:getInstance >> ";
					// Just make the line numbers match if you alter anything.
					switch( $ee->getLine() ) {
						case 39:	$message .= "Bad Host provided from configuration.php";
						case 40:	$message .= "Bad User provided from configuration.php";
						case 41:	$message .= "Bad Password provided from configuration.php";
						case 42:	$message .= "Bad DB name provided from configuration.php";
					}
					throw new DataBaseException( $message, 0, $ee );
				} catch( Exception $e ) {
					throw new DataBaseException( "General Exception in DB:getInstance failed.", 0, $e );
				}
			}

			return DB::$DB;
		}

		/**
		 *	Will clean a string from unwanted data.
		 */
		public static function clean( $inData ) {
			$outData = "";

			if( get_magic_quotes_gpc() == 1 ) {
				$inData = stripslashes( $inData );
			}

			if( is_numeric( $inData ) ) {
				$outData = $inData;
			} else {
				$conn = DB::getInstance();
				$outData = $conn->real_escape_string( $inData );
			}

			return $outData;
		}

		/**
		 * The actual SQL function.
		 * This is the one used through out the this class for the actual firing of
		 * SQL statements. The others wrap the results in various manners for an
		 * easier dealing later on with the net results.
		 * This shouldn't be used directly without good cause. The result will not
		 * processed but instead raw data will be returned.
		 */
		public static function query( $sql ) {
			try {
				$result = DB::getInstance()->query( $sql );
				return $result;
			} catch ( ErrorException $ee ) {
				throw new DataBaseException( "Failed to connect to database to execute query", 2100, $ee, $sql );
			}
		}

		public static function processQueryResult( $result ) {
			$returnArray = array();
			$counter = 0;
			if( is_object( $result ) ) {
				while( $row = $result->fetch_assoc() ) {
					$returnArray[] = $row;
				}
			}
			return $returnArray;
		}

		/**
		 * Will run an insert SQL and then return the ID that was created. It will
		 * assume that the primary key is name 'id' if nothing else is provided.
		 * @throws DataBaseException
		 */ 
		public static function insert( $sql, $table, $pk="id" ) {
			try {
				$table = DB::clean( $table );
				$pk = DB::clean( $pk );
				$result = DB::getInstance()->query( $sql );
				if( $result == 1 ) {
					try {
						$id = $result->insert_id;
						if( $id != null && $id != 0 ) {
							return $id;
						} else { // if the above calls failed, this is the fallback.
							$sqlPK = "SELECT `".$pk."` FROM `$table` ORDER BY `$pk` DESC LIMIT 1;";
							$result = DB::getInstance()->query( $sqlPK );
							if( $result->num_rows == 1 ) {
								$result = $result->fetch_assoc();
								return $result[ $pk ];
							} else {
								throw new DataBaseException( "Insert worked but the primary key failed to be retrieved properly. Got ". $result, 2200, null, $sqlPK );
							}
						}
					} catch( ErrorException $ee ) {
						$sqlPK = "SELECT `".$pk."` FROM `$table` ORDER BY `$pk` DESC LIMIT 1;";
						$result = DB::getInstance()->query( $sqlPK );
						if( $result->num_rows == 1 ) {
							$result = $result->fetch_assoc();
							return $result[ $pk ];
						} else {
							throw new DataBaseException( "Insert worked but the primary key failed to be retrieved properly. Got ". $result, 2200, null, $sqlPK );
						}
					}
					
				} else {
					throw new DataBaseException( "Failed to insert the statement.", 2200, null, $sql );
				}
			} catch( ErrorException $ee ) {
				throw new DataBaseException( "Failed to insert the entity properly.", 2200, $ee, $sql );
			}
		}

		/**
		 * Will run an update SQL and process the result. If the request is successful
		 * it will return true, else false.
		 * @throws DataBaseException
		 */
		public static function update( $sql ) {
			try {
				if( DB::getInstance()->query( $sql )== 1 ) { return true; } else { return false; }
			} catch( ErrorException $ee ) {
				throw new DataBaseException( "Failed to update entity.", 2300, $ee, $sql );
			}
		}
		
		/**
		 * Will run an delete SQL and process the result. If the request is successful
		 * it will return true, else false.
		 * @throws DataBaseException
		 */
		public static function delete( $sql ) {
			try {
				if( DB::getInstance()->query( $sql ) == 1 ) { return true; } else { return false; }
			} catch( ErrorException $ee ) {
				throw new DataBaseException( "Failed to delete entity.", 2400, $ee, $sql );
			}
		}

	}
?>