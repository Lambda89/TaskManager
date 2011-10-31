<?php>
	require_once( '../System/sys.class.php' );
	echo $_POST["surname"];
	echo $_POST["lastname"];
	echo $_POST["alias"];
	echo $_POST["password"];
	echo $_POST["emailprivate"];
	echo $_POST["emailwork"]; 
<?>

<html>
<head></head>
<body>
	<div id = "register" name ="register">
		<form action="register.php" method="post">
			Förnamn:  <input type="text" name="surename"/></br>
			Efternamn: 	<input type="text" name="lastname"/></br>
			Screenname:	<input type="text" name="alias"/></br>
			Password: <input type="password" name="password"/></br>
			Confirm password: <input type="password" name="confirmPassword" /></br>
			Email (privat): <input type="text" name="emailprivate" /></br>
			Email (arb): <input type"text" name"emailwork"/></br>

			<input type="submit" value="Registrera" />
			<input type="reset" value ="Ångra" />
		</form>

	</div>
</body>
</html>