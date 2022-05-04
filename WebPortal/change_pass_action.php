<?php

// I switch between camelcase and underscore too much

//but the database is phplogin
$DATABASE_HOST = 'localhost';

$DATABASE_USER = 'root';

$DATABASE_PASS = '';

$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We need to use sessions, so you should always start sessions using the below code.
// we can also now access session variables that were set in other files
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

//first we need to check that both new password values are the same 
if($_POST['Npassword'] != $_POST['Npasswordtwo']){
	echo "New Passwords Do not match <br>";
	echo '<a href="changePass.php"> Go Back </a>';
	exit;	
}
// first we'll take the new password that they want and has it using the hash function

$newPass = password_hash($_POST['Npassword'], PASSWORD_DEFAULT);

//then we need to take the current password and hash it so that we can match it to the hashed
//password stored into our database
$current_pass = password_hash($_POST['Cpassword'], PASSWORD_DEFAULT);

//since you need to be signed in to access this page we can assume there is an account that exits
//with the username
//we'll change the password that corresponds to the account with the current pass AND the username

// first we're prepare the statement using the database connection 
if($stmt = $con->prepare("UPDATE accounts SET password = ? WHERE username = ?")){

	$stmt->bind_param('ss', $newPass, $_SESSION['name']);
	$stmt->execute();
	$stmt->store_result();
	//alert("Password successfully changed");
	//header('Location: home.php');
	$msg = "Password has been changed successfully!";
}else{
	//alert("Could not change password");
	$msg = "Password could not be changed";
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
		<h1><?php echo $msg ?></h1>
			<form action="home.php">
				<input type="submit" value="Go Back">
			</form>
		</div>
	</body>
</html>
