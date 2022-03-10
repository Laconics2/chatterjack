<?php

session_start();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '111';
$DATABASE_NAME = 'phplogin';

// Try and connect using the info above.

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


//check if there is a user logged in; if not send em to the login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
	
	$stmt = $con->prepare('SELECT type FROM accounts WHERE id = ?');
	
	// In this case we can use the account ID to get the account info.
	
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($type);
	$stmt->fetch();
	$stmt->close();

	$_SESSION['type'] = $type;
	
	if($type == "ADMIN"){
		echo "Ah so you are an ADMIN I see.";
	}else{
		echo "GTF outta here !";
	}

?>
