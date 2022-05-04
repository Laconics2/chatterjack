<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Change Password</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/regstyle.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Change Password</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
			</div>
		</nav>
	
		<div class="register">
			<h1>Change Password</h1>
			<form action="change_pass_action.php" method="post" autocomplete="off">

				<label for="Cpassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="Cpassword" placeholder="Current Password" id="Cpassword" required>

				<label for="Npassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="Npassword" placeholder="New Password" id="Npassword" required>
				
				
				<label for="Npasswordtwo">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="Npasswordtwo" placeholder="New Password" id="Npasswordtwo" required>

				<input type="submit" value="Change Password">
			</form>
		</div>
	</body>
</html>
