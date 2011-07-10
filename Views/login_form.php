<?php

include(dirname(__FILE__) . '/../System/sys.class.php');
if ($_POST['username'] && $_POST['password']) {
	$user = new User();
	try {
		$user->login( $_POST['username'], $_POST['password'] );
		//$_SESSION[ 'user' ] = $user;
		$sys = Sys::getSys();
		$sys->setUser( $user );
		$used = $sys->getUser();
		header('Location: index.php');
	} catch( IllegalArguementException $iae ) {
		echo $iae->getMessage();
		echo $iae;
	} catch( ValidationException $ve ) {
		echo $ve->getMessage() .'<br />';
		echo $ve->getLine() .'<br />';
		echo $ve->getFile() .'<br />';
	} catch( DataBaseException $bde ) {
		echo 'dbe';
	} catch( Exception $ve ) {
		echo '<div style="border:groove 3px #333;padding:10px;color:#F11;background:#333;"> Login Failed </div>'. $ve;
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>login_form</title>
	<!-- tänkte att denna skulle includeras i index-filen. ta bort allt utom bodyn? -->
	
</head>

<body>
	<div>
		<form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<p>
				<label for="username">Användarnamn/email</label>
				<input type="text" name="username" id="username" value=""/>
			</p>
			<p>
				<label for="password">Lösenord</label>
				<input type="password" name="password" id="password" value=""/>
			</p>
			<p><input type="submit" name="submit" value="Log in" id="submit"></p>
		</form>	
	</div>

</body>
</html>
