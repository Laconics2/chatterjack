<?php
// connect with the database
require_once "db.php";

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
        <title>Search</title>
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

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    </head>
    
    <body class="loggedin">

	<nav class="navtop">
		<div>
			<h1>Search</h1>
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
            
            <form action='search.php' method='post' name='tables' class="table_choose">
                <p class='checkp'>
                    Select which table you want to search information:
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
                <p class="checkp">Input the Search Information: &nbsp;
                    <input type='text' class='search' name='search_inf'>
                </p>
                <p>    
                    <input type='submit' name='search' value='SEARCH'>
                    <input type="reset" name='reset' value='RESET'>
                    <a href='search.php'>
                        <input type='button' value="NEW">
                    </a>
                </p>
            </form>
            
            <hr>
            
            <form>
            
            
<?php
// PERSON table header
function person_tableCol() {
    $person_tableCol = array('id', 'person_name', 'person_spe_name', '_where', '_who', '_when', 'sex', 'author');
    echo "<table class='table display'>";
    foreach ($person_tableCol as $value_person) { 
        echo "<th class='th border-display'>$value_person</th>";        
    }
}
// no specfic PERSON searching
if ( !empty($_POST['person']) && $_POST['person'] == 'PERSON' && empty($_POST['search_inf']) ) {
    echo '<h2>PERSON table</h2>';
    person_tableCol();
    
    $person_search = mysqli_query($db, "SELECT * FROM `PERSON`;");
    echo "<tbody>";
    while ( $row_per = mysqli_fetch_array($person_search) ){
        echo "<tr>";
        echo "<td class='td border-display'>$row_per[0]</td>"  // id
                . "<td class='td border-display'>$row_per[1]</td>" // person_name
                . "<td class='td border-display'>$row_per[2]</td>" // person_spe_name
                . "<td class='td border-display'>$row_per[3]</td>" // _where
                . "<td class='td border-display'>$row_per[4]</td>" // _who
                . "<td class='td border-display'>$row_per[5]</td>" // _when
                . "<td class='td border-display'>$row_per[6]</td>" // sex
                . "<td class='td border-display'>$row_per[7]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}
// specfic PERSON searching
if ( !empty($_POST['person']) && $_POST['person'] == 'PERSON' && !empty($_POST['search_inf']) ) {
    echo '<h2>PERSON table</h2>';
    person_tableCol();
    
    $p_inser = $_POST['search_inf'];
    
    $sql = "SELECT * FROM `PERSON` WHERE ";
    $sql = $sql . "person_name LIKE '%$p_inser%' OR ";
    $sql = $sql . "person_spe_name = '$p_inser' OR ";
    $sql = $sql . "_where LIKE '%$p_inser%' OR ";
    $sql = $sql . "_who LIKE '%$p_inser%' OR ";
    $sql = $sql . "_when LIKE '%$p_inser%' OR ";
    $sql = $sql . "sex LIKE '%$p_inser%' OR ";
    $sql = $sql . "author LIKE '%$p_inser%'; ";
             
    $person_search = mysqli_query($db, $sql);
    echo "<tbody>";
    while ( $row_per = mysqli_fetch_array($person_search) ){
        echo "<tr>";
        echo "<td class='td border-display'>$row_per[0]</td>"  // id
                . "<td class='td border-display'>$row_per[1]</td>" // person_name
                . "<td class='td border-display'>$row_per[2]</td>" // person_spe_name
                . "<td class='td border-display'>$row_per[3]</td>" // _where
                . "<td class='td border-display'>$row_per[4]</td>" // _who
                . "<td class='td border-display'>$row_per[5]</td>" // _when
                . "<td class='td border-display'>$row_per[6]</td>" //sex
                . "<td class='td border-display'>$row_per[7]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}

// CLASS table header
function class_tableCol() {
    $class_tableCol = array('id', 'class_name', 'class_section', '_where', '_who', '_what', '_when', 'author');
    echo "<table class='table display'>";
    foreach ($class_tableCol as $value_class) { 
        echo "<th class='td border-display'>$value_class</th>";        
    }
}
// no specfic CLASS searching
if ( !empty($_POST['class']) && $_POST['class'] == 'CLASS' && empty($_POST['search_inf']) ) {
    echo '<h2>CLASS table</h2>';
    class_tableCol();
    
    $org_search = mysqli_query($db, "SELECT * FROM `CLASS`;");
    echo "</tbody>";
    while ( $row_cla = mysqli_fetch_array($org_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_cla[0]</td>"  // id
                . "<td class='td border-display'>$row_cla[1]</td>" // class_name
                . "<td class='td border-display'>$row_cla[2]</td>" // class_section
                . "<td class='td border-display'>$row_cla[3]</td>" // _where
                . "<td class='td border-display'>$row_cla[4]</td>" // _who
                . "<td class='td border-display'>$row_cla[5]</td>" // _what
                . "<td class='td border-display'>$row_cla[6]</td>" // _when
                . "<td class='td border-display'>$row_cla[7]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}
// specfic CLASS searching
if ( !empty($_POST['class']) && $_POST['class'] == 'CLASS' && !empty($_POST['search_inf']) ) {
    echo '<h2>CLASS table</h2>';
    class_tableCol();
    
    $c_inser = $_POST['search_inf'];
    
    $sql = "SELECT * FROM `CLASS` WHERE ";
    $sql = $sql . "class_name LIKE '%$c_inser%' OR ";
    $sql = $sql . "class_section LIKE '%$c_inser%' OR ";
    $sql = $sql . "_where LIKE '%$c_inser%' OR ";
    $sql = $sql . "_who LIKE '%$c_inser%' OR ";
    $sql = $sql . "_what LIKE '%$c_inser%' OR ";
    $sql = $sql . "_when LIKE '%$c_inser%' OR ";
    $sql = $sql . "author LIKE '%$c_inser%'; ";
             
    $org_search = mysqli_query($db, $sql);
    echo "</tbody>";
    while ( $row_cla = mysqli_fetch_array($org_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_cla[0]</td>"  // id
                . "<td class='td border-display'>$row_cla[1]</td>" // class_name
                . "<td class='td border-display'>$row_cla[2]</td>" // class_section
                . "<td class='td border-display'>$row_cla[3]</td>" // _where
                . "<td class='td border-display'>$row_cla[4]</td>" // _who
                . "<td class='td border-display'>$row_cla[5]</td>" // _what
                . "<td class='td border-display'>$row_cla[6]</td>" // _when
                . "<td class='td border-display'>$row_cla[7]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}

// ORG table header
function org_tableCol() {
    $org_tableCol = array('id', 'org_name', '_where', '_what', '_who', '_how', 'author');
    echo "<table class='table display'>";
    foreach ($org_tableCol as $value_class) { 
        echo "<th class='td border-display'>$value_class</th>";        
    }
}
// no specfic ORG searching
if ( !empty($_POST['org']) && $_POST['org'] == 'ORG' && empty($_POST['search_inf']) ) {
    echo '<h2>ORG table</h2>';
    org_tableCol();
    
    $org_search = mysqli_query($db, "SELECT * FROM `ORG`;");
    echo "</tbody>";
    while ( $row_org = mysqli_fetch_array($org_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_org[0]</td>"  // id
                . "<td class='td border-display'>$row_org[1]</td>" // org_name
                . "<td class='td border-display'>$row_org[2]</td>" // _where
                . "<td class='td border-display'>$row_org[3]</td>" // _what
                . "<td class='td border-display'>$row_org[4]</td>" // _who
                . "<td class='td border-display'>$row_org[5]</td>" // _how
                . "<td class='td border-display'>$row_org[6]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}
// specfic ORG searching
if ( !empty($_POST['org']) && $_POST['org'] == 'ORG' && !empty($_POST['search_inf']) ) {
    echo '<h2>ORG table</h2>';
    org_tableCol();
    
    $o_inser = $_POST['search_inf'];
    
    $sql = "SELECT * FROM `ORG` WHERE ";
    $sql = $sql . "org_name LIKE '%$o_inser%' OR ";
    $sql = $sql . "_where LIKE '%$o_inser%' OR ";
    $sql = $sql . "_what LIKE '%$o_inser%' OR ";
    $sql = $sql . "_who LIKE '%$o_inser%' OR ";
    $sql = $sql . "_how LIKE '%$o_inser%' OR ";
    $sql = $sql . "author LIKE '%$o_inser%'; ";
             
    $org_search = mysqli_query($db, $sql);
    echo "</tbody>";
    while ( $row_org = mysqli_fetch_array($org_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_org[0]</td>"  // id
                . "<td class='td border-display'>$row_org[1]</td>" // org_name
                . "<td class='td border-display'>$row_org[2]</td>" // _where
                . "<td class='td border-display'>$row_org[3]</td>" // _what
                . "<td class='td border-display'>$row_org[4]</td>" // _who
                . "<td class='td border-display'>$row_org[5]</td>" // _how
                . "<td class='td border-display'>$row_org[6]</td>"; //author
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
}

mysqli_close($db);
?>
            
            <hr>
         
            </form>
        </div>
    </body>
</html>
