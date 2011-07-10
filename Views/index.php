<?php
	require_once( '../System/sys.class.php' );
	$sys = Sys::getSys();
	if( $_POST[ 'LoggingOut' ] == 'Logout' ) {
		$user = $sys->getUser();
		if( $user instanceof User ) {
			$user->logout();
			header( 'Location: login_form.php' );
		} else {
			if( $user == null || $user == "" ) {
				echo 'was nulled';
			}
			echo ' No joy';
		}
	}
?>

<html>
	<head>
	</head>
	
	<div id="header">
	</div>
	
	<body>
		<?php echo "Welcome ". Sys::getSys()->getUser()->getUserEntity()->getLogin() ." to the system. <br />"; ?>
		<form method="POST" action="index.php">
			<input type="submit" value="Logout" name="LoggingOut"/>
		</form>
	</body>
	
	<div id="footer">
	</div>
</html>