<?php
require_once "db.php";
error_reporting(0);
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Insert</title>
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
	
	<script type="application/x-javascript"> 
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
        </script>

	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body>

	<nav class="navtop">
		<div>
			<h1> Insert </h1>
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
                            <button type="button" class='btn btn-dark'> Modify </button>
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
                    <td>Search Information: </td>
                    <td>
                        <a href='search.php'>
                            <button type="button" class='btn btn-dark'> Search </button>
                        </a>
                    </td>
                </tr>
            </table>

            <hr>

            <form action='insert.php' method='post' name='tables' class="table_choose">
                <p class='checkp'>
                    Select which table you want to insert information:
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
                    <a href='insert.php'>
                        <input type='button' value="NEW">
                    </a>
                </p>
            </form>

            <hr>

<?php
// display the PERSON inserting table
function person_table(){
	    $person_column = array('person_name', 'person_spe_name', '_where', '_who', '_when', 'author');
	    $prom_person = array('Full name, eg: Kyle Nathan Winfree', 'Special name, eg: D', 
			        'Office, eg: Room 315 in SICCS Building',
				        'Job, eg: associate director for Undergraduate Programs, SICCS',
					        'Office hour, eg: 3pm on every Wednesday',
							        'Author, eg: Winfree'
								        );
	     echo "<form action='confirmInsert.php' method='post' name='insert_person'>";
	     echo "<table class='insert_table'>";
             for ($i=0; $i<6; $i++) {
	       echo "<tr>";
	       echo "<td>$person_column[$i]: </td>";
	       echo "<td><input type='text' class='textbox' value='$prom_person[$i]' name='$person_column[$i]' "
		   . "onfocus=\"this.value = '';\" onblur=\"if (this.value == '') {this.value = '$prom_person[$i]';}\"></td>";
	       echo "</tr>";
					        }
	       echo "</table>";
	       echo "<input type='submit' name='person_submit' value='SUBMIT'>";
	       echo "<input type='reset' name='person_reset' value='RESET'>";
	       echo "</form>";
	       echo "<hr>";
}
// display the ORG inserting table
function org_table(){
    $org_column = array('org_name:', '_what:', '_where:', '_who:', '_how:', 'author:');
    echo "<form action='' method='post'>";
    echo "<table class='insert_table'>";
    foreach ($org_column as $value_org) {
        echo "<tr>";
        echo "<td>$value_org</td>";
        echo "<td><input type='text' class='textbox' name='$value_org'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='submit' name='class_submit' value='SUBMIT'>";
    echo "<input type='reset' name='class_reset' value='RESET'>";
    echo "</form>";
    echo "<hr>";
}
// display the CLASS inserting table
function class_table(){
    $class_column = array('class_name:', '_where:', '_who:', '_what:', '_when:', 'author:');
    echo "<form action='' method='post'>";
    echo "<table class='insert_table'>";
    foreach ($class_column as $value_class) {
        echo "<tr>";
        echo "<td>$value_class</td>";
        echo "<td><input type='text' class='textbox' name='$value_class'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='submit' name='org_submit' value='SUBMIT'>";
    echo "<input type='reset' name='org_submit' value='RESET'>";
    echo "</form>";
    echo "<hr>";
}

// display the choosen table
if ($result = $_POST['person']) {
    person_table();
}
if ($result = $_POST['class']) {
    class_table();
}
if ($result = $_POST['org']) {
    org_table();
}
if ($result = $_POST['reset']){
    echo "";
}

mysqli_close($db);
?>

        </div>
    </body>
</html>


