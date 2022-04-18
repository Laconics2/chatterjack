<?php
	session_start();
	if(!isset($_SESSION['loggedin'])){
		header('Location: index.html');
		exit;
	}

	if($_SESSION['type']=='FACULTY'){
		header('Location: home.php');
		exit;
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/regstyle.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
		<div class="register">
			<h1>Register</h1>
			<form action="register_user.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>

				<label for="type">
					<i class="fas fa-university"></i>
				</label>
				<input type="text" name="type" placeholder="Account Type: ADMIN/FACULTY" id="type" required>

				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>
