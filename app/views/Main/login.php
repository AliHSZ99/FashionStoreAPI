<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Login</title>
</head>
<body>
	<?php
	if($data != null){
		echo $data;
	}
	?>
	Login
	<form action='' method='post'>
		Username: <input type='text' name='username' /><br>
		Password: <input type='password' name='password' /><br>
		<input type='submit' name='action' value='Login' />
	</form>
</body>
</html>