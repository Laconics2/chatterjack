<?php

//connection to the database for accounts
//the table containing user creds is accounts
//but the database is phplogin
$DATABASE_HOST = 'localhost';

$DATABASE_USER = 'root';

$DATABASE_PASS = '';

$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
