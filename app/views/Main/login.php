<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- For the Font -->
	<link href="http://fonts.cdnfonts.com/css/futura-pt" rel="stylesheet">
	<link href="https://allfont.net/allfont.css?fonts=geneva-normal" rel="stylesheet" type="text/css" />

	<!-- For the Boostrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- For the cart icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- For CSS stylesheet -->
	<link rel="stylesheet" href="/app/styles.css">
	<title>Login</title>
</head>
<body id="loginBody" >
	<?php
	if($data != null){
		echo $data;
	}
	?>


	<!-- Div for the logo -->
	<div id="backgroundPSLogo">
		<a href="/Main/index"><img  id="loginPSLogo" style="height: 70px;" src="/app/images/logo.png" alt=""></a>
	</div>
	
	<!-- Div for the loginBox -->
	<div id="loginBox">
	<nav class="navbar navbar-expand-sm navbar-light">
		<div class="container-fluid">
			<ul class="navbar-nav loginNavList">
				<li class="nav-item loginNav ">
					<a class="nav-link h3" href="/Main/register">REGISTER</a>
				</li>
				<li class="nav-item loginNav">
					<a class="nav-link h3 active " href="#">SIGN IN</a>
				</li>
			</ul>
		</div>
	</nav>
		<div id = "loginForm">
			<form id="form"action='' method='post'>
				<p>Username:</p> <input type='text' name='username' /><br>
				<p>Password:	</p> <input type='password' name='password' /><br> <br>
				<input id='loginButton' type='submit' name='action' value='Login' />
			</form>
		</div>
	</div>
</body>
</html>