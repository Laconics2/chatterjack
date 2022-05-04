<?php
require_once "db.php";
error_reporting(0);

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Delete</title>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Style CSS -->
        <link rel="stylesheet" href="css/homestyle.css"/>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body class="loggedin">
	<nav class="navtop">
		<div>
			<h1> Delete</h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			<a href="home.php"><i class="fas fa-home"></i>Home</a>
		</div>
	</nav>

        <div>
            <h1>Manage Information Database</h1>
            <hr>
            <!-- table for operations -->
            <table class="table menu">
                <!-- Insert -->
                <tr>
                    <td>Insert Information: </td>
                    <td>
                        <a href='insert.php'>
                            <button type="button" class='btn btn-dark'> Insert </button>
                        </a>
                    </td>
                </tr>
                <!-- Modify -->
                <tr>
                    <td>Edit information: </td>
                    <td>
                        <a href='modify.php'>
                            <button type="button" class='btn btn-dark'> Edit </button>
                        </a>
                    </td>
                </tr>
                <!-- Delete -->
                <tr>
                    <td>Delete Information: </td>
                    <td>
                        <a href='delete.php'>
                            <button type="button" class='btn btn-dark'> Delete </button>
                        </a>
                    </td>
                </tr>
                <!-- Search -->
                <tr>
                    <td>Search for Information: </td>
                    <td>
                        <a href='search.php'>
                            <button type="button" class='btn btn-dark'> Search </button>
                        </a>
                    </td>
                </tr>
            </table>
            
            <hr>


<?php
// confirm person will be deleted
if ($delID = $_POST['person_ID']) {
	 $sql_del = "DELETE FROM `PERSON` WHERE `id` = '";
	     $sql_del = $sql_del . $_POST['person_ID'] . "' ;";
	     $person_del = mysqli_query($db, $sql_del);

	         if($person_del){
			         echo "<p>" . mysqli_affected_rows($db) . ' resume was deleted. </p> ';
				     }
    else{
	            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
		        }
}

// confirm class will be deleted
if ($delID = $_POST['class_ID']) {
	 $sql_del = "DELETE FROM `CLASS` WHERE `id` = '";
	     $sql_del = $sql_del . $_POST['class_ID'] . "' ;";
	     $class_del = mysqli_query($db, $sql_del);

	         if($class_del){
			         echo "<p>" . mysqli_affected_rows($db) . " class information was deleted. </p> ";
				     }
    else{
	            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
		        }
}

// confirm org will be deleted
if ($delID = $_POST['org_ID']) {
	$sql_del = "DELETE FROM `ORG` WHERE `id` = '";
	    $sql_del = $sql_del . $_POST['org_ID'] . "' ;";
	    $org_del = mysqli_query($db, $sql_del);

	        if($org_del){
			        echo "<p>" . mysqli_affected_rows($db) . " organization information was deleted. </p> ";
				    }
    else{
	            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
		        }
}

mysqli_close($db);
?>

            <hr>

        </div>
    </body>
</html>
