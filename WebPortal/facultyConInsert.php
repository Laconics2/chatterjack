<?php
// connect with the database
require_once "db.php";
session_start();

if(!isset($_SESSION['loggedin'])){
	header('Location: index.html');
    	exit;
}
?>

<html>
<head>
    <title>Faculty Management</title>
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
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
            
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>

	<nav class="navtop">
		<div>
			<h1>ChatterJack Chatbot</h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			<a href="home.php"><i class="fas fa-home"></i>Home</a>
		</div>
	</nav>
<div>
    <h1>Faulty Management System</h1>
    
    <hr>

        <!-- table for operations -->
        <table class="table menu">
            <!-- Insert -->
            <tr>
                <td>Insert Information: </td>
                <td>
                    <a href='facultyInsert.php'>
                        <button type="button" class='btn btn-dark'> Insert </button>
                    </a>
                </td>
            </tr>
            <!-- Modify -->
            <tr>
                <td>Modify Information: </td>
                <td>
                    <a href='facultyDel_Modi.php'>
                       <button type="button" class='btn btn-dark'> Modify </button>
                    </a>
                </td>
            </tr>
            <!-- Delete -->
            <tr>
                <td>Delete Information: </td>
                <td>
                    <a href='facultyDel_Modi.php'>
                        <button type="button" class='btn btn-dark'> Delete </button>
                    </a>
                </td>
            </tr>
        </table>

    <hr>

<?php
// confirm the PERSON information will be inserted
if ( !empty($_POST['person_submit']) ) {
    $faculty = $_SESSION['name'];
    
    // insert sql language
    $sql = "INSERT INTO PERSON (person_name, person_spe_name, _where, _who, _when, sex, author) VALUES (" ;
    $sql = $sql . "'" . $_POST["person_name"] . "' ," ;
    $sql = $sql . "'" . $_POST["person_spe_name"] . "' ," ;
    $sql = $sql . "'" . $_POST["_where"] . "' ," ;
    $sql = $sql . "'" . $_POST["_who"] . "' ," ;
    $sql = $sql . "'" . $_POST["_when"] . "' ," ;
    $sql = $sql . "'" . $_POST["sex"] . "' ," ;
    $sql = $sql . "'" . $faculty . "' );" ;

    $person_insert = mysqli_query($db, $sql);
    if($person_insert){
        echo "<p>" . mysqli_affected_rows($db) . ' person information was added. </p>';
    }
    else{
        echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
    }
}

// confirm the CLASS information will be inserted
if ( !empty($_POST['class_submit']) ) {
    $faculty = $_SESSION['name'];
    
    // insert sql language
    $sql = "INSERT INTO CLASS (class_name, class_section, _where, _who, _what, _when, author) VALUES (" ;
    $sql = $sql . "'" . $_POST["class_name"] . "' ," ;
    $sql = $sql . "'" . $_POST["class_section"] . "' ," ;
    $sql = $sql . "'" . $_POST["_where"] . "' ," ;
    $sql = $sql . "'" . $_POST["_who"] . "' ," ;
    $sql = $sql . "'" . $_POST["_what"] . "' ," ;
    $sql = $sql . "'" . $_POST["_when"] . "' ," ;
    $sql = $sql . "'" . $faculty . "' );" ;

    $class_insert = mysqli_query($db, $sql);
    if($class_insert){
        echo "<p>" . mysqli_affected_rows($db) . ' class information was added. </p>';
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
