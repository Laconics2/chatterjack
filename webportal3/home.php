<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

//Doesn't work properly for some reason; Check moved to inside the html
if($_SESSION['type'] == "ADMIN"){
	$YNAdmin = TRUE;
}
	$YNAdmin = FALSE;

//The home page is mainly here for the future of the project
//Mainly a dashboard for the users
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>ChatterJack Chatbot</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<p> 
			
			<?php if($_SESSION['type'] == 'ADMIN') : ?>
			<a href="index.php"> Admin Management </a><br>
			<a href="register.php">Register New User</a>
			<?php else: ?>

			<a href="facultyManage.php">Faculty Management Page </a>

			<?php endif; ?>
				</p>

		</div>
	</body>
</html>
