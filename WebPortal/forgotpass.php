<?php
// this file is the function that will generate the temp password randomly
include "gen_temp_pass.php";

//connect to the database for accounts
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// first we'll need to randomly generate the password to send to the user
// We want the strings to be of length 10 this can be changed by changing variable n
$n = 10;
$temp = getRandomString($n);
// use the function to hash the temp pass
// but we need to hold onto the plain english to send to the user
$hash_temp = password_hash($temp, PASSWORD_DEFAULT);

// here we will check to see if the email is in the database
// then send that email the user's password
// First check to see if it exists
	if(isset($_POST['submit'])){

		$email = $_POST['email'];

		$username = $_POST['username'];

		$stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ? AND email = ?');
		$stmt->bind_param('ss', $username, $email);
		$stmt->execute();
		$stmt->store_result();

		// the actual check
		if($stmt->num_rows == 0){
			// maybe we should first check to see if the account exitst
			echo "This account doesn't exist";
		}else{
			// the account must exist so execute the statement
			$stmt = $con->prepare('UPDATE accounts SET password = ? WHERE username = ? AND email = ?');
			$stmt->bind_param('sss', $hash_temp, $username, $email);
			$stmt->execute();
			// now the password should be changed and we should send an email
			$to = $email;
			$subject = "ChatterJack Password";
			$txt = "Your temporary password is: $temp";
			$headers = "From: saraharris2000@gmail.com" . "\r\n";
			$hold = mail($to, $subject, $txt, $headers);
			if($hold){
				echo "Message sent successful.";
			}else{
				echo "message failed to send.";
			}

			

		}
		

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Forgot Password</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/style.css" rel="stylesheet" type="text/css">

		</head>

	<body class="loginPage">
		<div class="login">

		<h1>Forgot Password</h1>

		<form action="" method="post">

			<label for="email">
			<i class="far fa-envelope"></i>
			</label>
			<input type="text" name="email" placeholder="Email" id="email" required>

			<label for="username">
			<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" id="username" required>

			
			<input type="submit" value="Submit">
			

			</form>
	</div>
		</body>
</html>
