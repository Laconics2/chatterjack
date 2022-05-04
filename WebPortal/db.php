<?php
//error_reporting(E_ALL);

// connect with the database
$db = mysqli_connect('127.0.0.1', 'root', '', 'chatterjack', '3306');
if ($db -> connect_error){
    exit('Database connection fails: '. $db->connect_error);
}
error_reporting(0);
