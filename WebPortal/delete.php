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
			<h1> Delete </h1>
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
                    <td>Edit Information: </td>
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

            <form action='delete.php' method='post' name='tables' class="table_choose">
                <p class='checkp'>
                    Select which table you want to delete information:
                    &nbsp;
                    <input class="form-check-input" type="radio" name="person" id="person" value="PERSON">
                    <label class="form-check-label" for="person">PERSON</label>
                    &nbsp;
                    <input class="form-check-input" type="radio" name="class" id="class" value="CLASS">
                    <label class="form-check-label" for="class">CLASS</label>
                    &nbsp;
                    <input class="form-check-input" type="radio" name="org" id="org" value="ORG">
                    <label class="form-check-label" for="org">ORG</label>
                </p>
                <p>
                    <input type="submit" name='select' value='SELECT'>
                    <input type="reset" name='reset' value='RESET'>
                    <a href='delete.php'>
                        <input type='button' value="NEW">
                    </a>
                </p>
            </form>

            <hr>

            <form action="confirmDelete.php" method="post">
                <table class="del">
                    <caption style="caption-side:top;">Delete a row: </caption>
                    <tr>
                        <td>
<?php

// select the person that will be delete
if ($result = $_POST['person']) {
	    $sql = 'SELECT `id`, `person_name` FROM `PERSON`' ;
	        $inf_del = mysqli_query($db, $sql);
	        echo "<select name='person_ID' id='person_ID' class='form-select form-select-sm' aria-label='.form-select-sm example'>";
		    echo "<option selected>Select one Person</option>";
		    while ( $row_cla = mysqli_fetch_assoc($inf_del) ) {
			            $person_ID = $row_cla['id'];
				            $person_Name = $row_cla['person_name'];
				            echo "Select one person: <option value='$person_ID'>$person_Name</option>";
					        }
		        echo "</select>";
}
// select the class that will be delete
if ($result = $_POST['class']) {
	    $sql = 'SELECT `id`, `class_name` FROM `CLASS`' ;
	        $inf_del = mysqli_query($db, $sql);
	        echo "<select name='class_ID' id='class_ID' class='form-select form-select-sm' aria-label='.form-select-sm example'>";
		    echo "<option selected>Select one Class</option>";
		    while ( $row_cla = mysqli_fetch_assoc($inf_del) ) {
			            $class_ID = $row_cla['id'];
				            $class_Name = $row_cla['class_name'];
				            echo "Select one person: <option value='$class_ID'>$class_Name</option>";
					        }
		        echo "</select>";
}
// select the org that will be delete
if ($result = $_POST['org']) {
	    $sql = 'SELECT `id`, `org_name` FROM `ORG`' ;
	        $inf_del = mysqli_query($db, $sql);
	        echo "<select name='org_ID' id='org_ID' class='form-select form-select-sm' aria-label='.form-select-sm example'>";
		    echo "<option selected>Select one ORG</option>";
		    while ( $row_org = mysqli_fetch_assoc($inf_del) ) {
			            $org_ID = $row_org['id'];
				            $org_Name = $row_org['org_name'];
				            echo "Select one person: <option value='$org_ID'>$org_Name</option>";
					        }
		        echo "</select>";
}
mysqli_close($db);
?>
                        </td>
                        <td>
                            <button type="submit">Delete</button>
                        </td>
                    </tr>
               </table>
            </form>

        </div>
    </body>
</html>




