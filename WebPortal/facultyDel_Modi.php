<?php
// connect with the database
require_once "db.php";
session_start();

if(!isset($_SESSION['loggedin'])){
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

    <form action='' method='get' name="choose" class="table_choose">
        <p class='checkp'>
            Select which table you want to modify or delete information:
            &nbsp;
            <input class="form-check-input" type="radio" name="person" id="person" value="PERSON">
            <label class="form-check-label" for="person">PERSON</label>
            &nbsp;
            <input class="form-check-input" type="radio" name="class" id="class" value="CLASS">
            <label class="form-check-label" for="class">CLASS</label>
        </p>
        <p>
            <input type='submit' name='m_d' value='SUBMIT'>
            <input type="reset" name='reset' value='RESET'>
            <a href=''>
                <input type='button' value="NEW">
            </a>
        </p>
    </form>

    <hr>
    
    <form action="" method="post" name="m" id="m">
        <!-- table format -->
        <table class='table display'>
<?php
// PERSON table header
function person_tableCol() {
    $person_tableCol = array('id', 'person_name', 'person_spe_name', '_where', '_who', '_when', 'sex', 'author');
    echo "<table class='table display'>";
    foreach ($person_tableCol as $value_person) { 
        echo "<th class='th border-display'>$value_person</th>";        
    }
    echo "<th class='th border-display'>operation</th>";
}
// no specfic PERSON searching
if ( !empty($_GET['person']) && $_GET['person'] == 'PERSON' && empty($_GET['fa_name']) ) {
    $person_column = array('person_name:', 'person_spe_name:', '_where:', '_who:', '_when:', 'sex:', 'author:');
    $person_show = array('person_name:', 'person_spe_name:', '_where:', '_who:', '_when:', 'sex:');
    $i = 1;
    
    echo "<h2 text-align='center'>PERSON table</h2>";
    person_tableCol();
    
    $faculty = $_SESSION['name'];

    $person_search = mysqli_query($db, "SELECT * FROM `PERSON` WHERE author LIKE '%$faculty%';");
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
                . "<td class='td border-display'>$row_per[7]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='per$row_per[0]' />"
                . "<input type='submit' value='DELETE' name='del$row_per[0]' /></td>";
        echo '</tr>';
        // modify the information
        if( !empty($_POST["per$row_per[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_per[0]</td>";
            foreach ($person_show as $value_person) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_person' value='$row_per[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'>$row_per[7]</td>";
            echo "<td class='td border-display'><button type='submit' value='$row_per[0]' name='id_per'>OK</button></td>";
            echo '<tr>';
        }
        // delete information
        if ( !empty($_POST["del$row_per[0]"]) ) {
            $id = $row_per[0];
            
            $sql_del = "DELETE FROM `PERSON` WHERE `id` = '";
            $sql_del = $sql_del . $id . "' ;";
            
            $person_del = mysqli_query($db, $sql_del);

            if($person_del){
                echo "<p>" . mysqli_affected_rows($db) . " person information was deleted. </p> ";
            }
            else{
                echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
            }
        }
        
    }
    // confirm person will be modified
    if( !empty($_POST["person_name:"]) ) {
        $id = $_POST['id_per'];
        $person_name = $_POST['person_name:'];
        $person_spe_name = $_POST['person_spe_name:'];
        $_where = $_POST['_where:'];
        $_who = $_POST['_who:'];
        $_when = $_POST['_when:'];
        $sex = $_POST['sex:'];
        // $author = $_POST['author:'];
    
        $sql = '';
        $sql .= "UPDATE `PERSON` SET ";
        $sql .= "person_name='$person_name', ";
        $sql .= "person_spe_name='$person_spe_name', ";
        $sql .= "_where='$_where', ";
        $sql .= "_who='$_who', ";
        $sql .= "_when='$_when', ";
        // $sql .= "sex='$sex', ";
        $sql .= "sex='$sex' ";
        // $sql .= "author='$author' ";
        $sql .= "WHERE id='$id';";
        
        if ( $result =  mysqli_query($db, $sql) ) {
            echo "<p>" . mysqli_affected_rows($db) . ' resume was modified. </p> ';
        }else{
            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
        }
    }
    echo '</tbody>';
    echo "</table>";
    // header('location:#');
}

// CLASS table header
function class_tableCol() {
    $class_tableCol = array('id', 'class_name', 'class_section', '_where', '_who', '_what', '_when', 'author');
    echo "<table class='table display'>";
    foreach ($class_tableCol as $value_class) { 
        echo "<th class='td border-display'>$value_class</th>";        
    }
    echo "<th class='th border-display'>operation</th>";
}
// no specfic CLASS searching
if ( !empty($_GET['class']) && $_GET['class'] == 'CLASS' && empty($_GET['fa_name']) ) {
    $class_column = array('class_name', 'class_section', '_where', '_who', '_what', '_when', 'author');
    $class_show = array('class_name', 'class_section', '_where', '_who', '_what', '_when');
    
    $i = 1;
    
    echo '<h2>CLASS table</h2>';
    class_tableCol();
    
    $faculty = $_SESSION['name'];
    $cla_search = mysqli_query($db, "SELECT * FROM `CLASS` WHERE author LIKE '%$faculty%';");
    
    echo "</tbody>";
    while ($row_cla = mysqli_fetch_array($cla_search)) {
        echo "<tr>";
        echo "<td class='td border-display'>$row_cla[0]</td>"  // id
                . "<td class='td border-display'>$row_cla[1]</td>" // class_name
                . "<td class='td border-display'>$row_cla[2]</td>" // class_section
                . "<td class='td border-display'>$row_cla[3]</td>" // _where
                . "<td class='td border-display'>$row_cla[4]</td>" // _who
                . "<td class='td border-display'>$row_cla[5]</td>" // _what
                . "<td class='td border-display'>$row_cla[6]</td>" // _when
                . "<td class='td border-display'>$row_cla[7]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='cla$row_cla[0]' />"  //operation
                . "<input type='submit' value='DELETE' name='del$row_cla[0]' /></td>";
        echo '</tr>';
        // modify information
        if( !empty($_POST["cla$row_cla[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_cla[0]</td>";
            foreach ($class_show as $value_class) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_class' value='$row_cla[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'>$row_cla[7]</td>";
            echo "<td class='td border-display'>"
                . "<button type='submit' value='$row_cla[0]' name='id_cla'>OK</button>"
                . "</td>";
            echo '<tr>';
        }
        // delete information
        if ( !empty($_POST["del$row_cla[0]"]) ) {
            $id = $row_cla[0];
            
            $sql_del = "DELETE FROM `CLASS` WHERE `id` = '";
            $sql_del = $sql_del . $id . "' ;";
            echo $sql_del;
            $class_del = mysqli_query($db, $sql_del);

            if($class_del){
                echo "<p>" . mysqli_affected_rows($db) . " class information was deleted. </p> ";
            }
            else{
                echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
            }
        }
    }
    if ( !empty($_POST["class_name"]) ) {
        $id = $_POST["id_cla"];
        $class_name = $_POST['class_name'];
        $class_section = $_POST['class_section'];
        $_where = $_POST['_where'];
        $_who = $_POST['_who'];
        $_what = $_POST['_what'];
        $_when = $_POST['_when'];
        // $author = $_POST['author'];
        $sql = '';
        $sql .= "UPDATE `CLASS` SET ";
        $sql .= "class_name='$class_name', ";
        $sql .= "class_section='$class_section', ";
        $sql .= "_where='$_where', ";
        $sql .= "_who='$_who', ";
        $sql .= "_what='$_what', ";
        // $sql .= "_when='$_when', ";
        $sql .= "_when='$_when' ";
        // $sql .= "author='$author' ";
        $sql .= "WHERE id='$id';";
        if ( $result =  mysqli_query($db, $sql) ) {
            echo "<p>" . mysqli_affected_rows($db) . ' class(es) information was modified. </p> ';
        }else{
            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
        }
    }
    
    echo '</tbody>';
    echo "</table>";
    // header('location:#');
}


mysqli_close($db);
?>

                </table>
            </form>
        </div>
    </body>
</html>
