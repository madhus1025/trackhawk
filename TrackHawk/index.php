<?php
	session_start();
	$_SESSION['login']=0;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/login.css">
		<title>Login Form</title>
	</head>
	<body>
		<form id="login" method="post" action="/internal_pages/login_verify.php">
			<h1>Track Hawk</h1>
			<fieldset id="inputs">
				<input id="username" name="username" placeholder="Username" autofocus="" required="" type="text">   
				<input id="password" name="password" placeholder="Password" required="" type="password">
			</fieldset>
			<fieldset id="actions">
				<input id="submit" value="Log in" type="submit">
			</fieldset>
		</form>
		<p id="copyright">Coprighted by Department of MVGR-IT</p>
		<div>
	</body>
</html>
