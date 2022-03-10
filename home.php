<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

if($_SESSION['type'] == "ADMIN"){
	$YNAdmin = TRUE;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<p> Ah you're a member of <?=$_SESSION['type']?></p>
			
			<form action="admin_page.php" method='get'>
				<input type="submit" value="Are you Admin?">
			</form>
			
			<?php if($YNAdmin) : ?>
			<a href="index.php"> Admin Management </a>

			<?php else: ?>

			<a href="facultyManage.php">Faculty Management Page </a>

			<?php endif; ?>

		</div>
	</body>
</html>
