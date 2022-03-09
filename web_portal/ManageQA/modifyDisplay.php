<?php
require_once "db.php";
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Modify Confirm</title>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Style CSS -->
        <link rel="stylesheet" href="style.css"/>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>

    <body>
        <div>
            <h1>Manage QA Database</h1>
            <hr>
            <!-- table for operations -->
            <table class="table menu">
                <!-- Insert -->
                <tr>
                    <td>Insert Question-Answer Pairs: </td>
                    <td>
                        <a href='insert.php'>
                            <button type="button" class='btn btn-dark'> Insert </button>
                        </a>
                    </td>
                </tr>
                <!-- Modify -->
                <tr>
                    <td>Modify Question-Answer Pairs: </td>
                    <td>
                        <a href='modify.php'>
                            <button type="button" class='btn btn-dark'> Modify </button>
                        </a>
                    </td>
                </tr>
                <!-- Delete -->
                <tr>
                    <td>Delete Question-Answer Pairs: </td>
                    <td>
                        <a href='delete.php'>
                            <button type="button" class='btn btn-dark'> Delete </button>
                        </a>
                    </td>
                </tr>
                <!-- Search -->
                <tr>
                    <td>Search Question-Answer Pairs: </td>
                    <td>
                        <a href='search.php'>
                            <button type="button" class='btn btn-dark'> Search </button>
                        </a>
                    </td>
                </tr>
            </table>

            <hr>
            
            <form action='' method='post' name='m'>
                
<?php
// PERSON table header
function person_tableCol() {
    $person_tableCol = array('id', 'person_name', 'person_spe_name', '_where', '_who', '_when', 'author');
    echo "<table class='table display'>";
    foreach ($person_tableCol as $value_person) { 
        echo "<th class='th border-display'>$value_person</th>";        
    }
    echo "<th class='th border-display'>operation</th>";
}
// no specfic PERSON searching
if ( !empty($_GET['person']) && $_GET['person'] == 'PERSON' && empty($_GET['search_inf']) ) {
    $person_column = array('person_name:', 'person_spe_name:', '_where:', '_who:', '_when:', 'author:');
    $i = 1;
    
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
                . "<td class='td border-display'>$row_per[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='per$row_per[0]' /></td>";
        echo '</tr>';
        if( !empty($_POST["per$row_per[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_per[0]</td>";
            foreach ($person_column as $value_person) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_person' value='$row_per[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_per[0]' name='id_per'>OK</button></td>";
            echo '<tr>';
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
        $author = $_POST['author:'];
    
        $sql = '';
        $sql .= "UPDATE `PERSON` SET ";
        $sql .= "person_name='$person_name', ";
        $sql .= "person_spe_name='$person_spe_name', ";
        $sql .= "_where='$_where', ";
        $sql .= "_who='$_who', ";
        $sql .= "_when='$_when', ";
        $sql .= "author='$author' ";
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
// specfic PERSON searching
if ( !empty($_GET['person']) && $_GET['person'] == 'PERSON' && !empty($_GET['search_inf']) ) {
    $person_column = array('person_name:', 'person_spe_name:', '_where:', '_who:', '_when:', 'author:');
    $i = 1;
    
    echo '<h2>PERSON table</h2>';
    person_tableCol();
    
    $p_inser = $_GET['search_inf'];
    
    $sql = "SELECT * FROM `PERSON` WHERE ";
    $sql = $sql . "person_name LIKE '%$p_inser%' OR ";
    $sql = $sql . "person_spe_name = '$p_inser' OR ";
    $sql = $sql . "_where LIKE '%$p_inser%' OR ";
    $sql = $sql . "_who LIKE '%$p_inser%' OR ";
    $sql = $sql . "_when LIKE '%$p_inser%' OR ";
    $sql = $sql . "author LIKE '%$p_inser%'; ";
             
    $person_search = mysqli_query($db, $sql);
    echo "</tbody>";
    while ( $row_per = mysqli_fetch_array($person_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_per[0]</td>"  // id
                . "<td class='td border-display'>$row_per[1]</td>" // person_name
                . "<td class='td border-display'>$row_per[2]</td>" // person_spe_name
                . "<td class='td border-display'>$row_per[3]</td>" // _where
                . "<td class='td border-display'>$row_per[4]</td>" // _who
                . "<td class='td border-display'>$row_per[5]</td>" // _when
                . "<td class='td border-display'>$row_per[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='per$row_per[0]' /></td>";
        echo '</tr>';
        
        if( $_POST["per$row_per[0]"]=='MODIFY' ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_per[0]</td>";
            foreach ($person_column as $value_person) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_person' value='$row_per[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_per[0]' name='id_per'>OK</button></td>";
            echo '<tr>';
        }
        
        // confirm person will be modified
        if( !empty($_POST["person_name:"]) ) {
            $id = $_POST['id_per'];
            $person_name = $_POST['person_name:'];
            $person_spe_name = $_POST['person_spe_name:'];
            $_where = $_POST['_where:'];
            $_who = $_POST['_who:'];
            $_when = $_POST['_when:'];
            $author = $_POST['author:'];
    
            $sql = '';
            $sql .= "UPDATE `PERSON` SET ";
            $sql .= "person_name='$person_name', ";
            $sql .= "person_spe_name='$person_spe_name', ";
            $sql .= "_where='$_where', ";
            $sql .= "_who='$_who', ";
            $sql .= "_when='$_when', ";
            $sql .= "author='$author' ";
            $sql .= "WHERE id='$id';";
    
            if ( $result =  mysqli_query($db, $sql) ) {
                echo "<p>" . mysqli_affected_rows($db) . ' resume was modified. </p> ';
            }else{
                echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
            }
        }
    }
    echo '</tbody>';
    echo "</table>";
}


// CLASS table header
function class_tableCol() {
    $class_tableCol = array('id', 'class_name', '_where', '_who', '_what', '_when', 'author');
    echo "<table class='table display'>";
    foreach ($class_tableCol as $value_class) { 
        echo "<th class='td border-display'>$value_class</th>";        
    }
    echo "<th class='th border-display'>operation</th>";
}
// no specfic CLASS searching
if ( !empty($_GET['class']) && $_GET['class'] == 'CLASS' && empty($_GET['search_inf']) ) {
    $class_column = array('class_name', '_where', '_who', '_what', '_when', 'author');
    $i = 1;
    
    echo '<h2>CLASS table</h2>';
    class_tableCol();
    
    $class_search = mysqli_query($db, "SELECT * FROM `CLASS`;");
    echo "<tbody>";
    while ( $row_cla = mysqli_fetch_array($class_search) ){
        echo "<tr>";
        echo "<td class='td border-display'>$row_cla[0]</td>"  // id
                . "<td class='td border-display'>$row_cla[1]</td>" // class_name
                . "<td class='td border-display'>$row_cla[2]</td>" // _where
                . "<td class='td border-display'>$row_cla[3]</td>" // _who
                . "<td class='td border-display'>$row_cla[4]</td>" // _what
                . "<td class='td border-display'>$row_cla[5]</td>" // _when
                . "<td class='td border-display'>$row_cla[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='cla$row_cla[0]' /></td>";
        echo '</tr>';
        if( !empty($_POST["cla$row_cla[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_cla[0]</td>";
            foreach ($class_column as $value_class) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_class' value='$row_cla[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_cla[0]' name='id_cla'>OK</button></td>";
            echo '<tr>';
        }
    }
    if ( !empty($_POST["class_name"]) ) {
        $id = $_POST["id_cla"];
        $class_name = $_POST['class_name'];
        $_where = $_POST['_where'];
        $_who = $_POST['_who'];
        $_what = $_POST['_what'];
        $_when = $_POST['_when'];
        $author = $_POST['author'];
        $sql = '';
        $sql .= "UPDATE `CLASS` SET ";
        $sql .= "class_name='$class_name', ";
        $sql .= "_where='$_where', ";
        $sql .= "_who='$_who', ";
        $sql .= "_what='$_what', ";
        $sql .= "_when='$_when', ";
        $sql .= "author='$author' ";
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
// specfic CLASS searching
if ( !empty($_GET['class']) && $_GET['class'] == 'CLASS' && !empty($_GET['search_inf']) ) {
    $class_column = array('class_name', '_where', '_who', '_what', '_when', 'author');
    $i = 1;
    
    echo '<h2>CLASS table</h2>';
    class_tableCol();
    
    $c_inser = $_GET['search_inf'];
    
    $sql = "SELECT * FROM `CLASS` WHERE ";
    $sql = $sql . "class_name = '$c_inser' OR ";
    $sql = $sql . "_where LIKE '%$c_inser%' OR ";
    $sql = $sql . "_who LIKE '%$c_inser%' OR ";
    $sql = $sql . "_what LIKE '%$c_inser%' OR ";
    $sql = $sql . "_when LIKE '%$c_inser%' OR ";
    $sql = $sql . "author LIKE '%$c_inser%'; ";
             
    $class_search = mysqli_query($db, $sql);
    echo "</tbody>";
    while ( $row_cla = mysqli_fetch_array($class_search) ){
        echo '<tr>';
        echo "<td class='td border-display'>$row_cla[0]</td>"  // id
                . "<td class='td border-display'>$row_cla[1]</td>" // class_name
                . "<td class='td border-display'>$row_cla[2]</td>" // _where
                . "<td class='td border-display'>$row_cla[3]</td>" // _who
                . "<td class='td border-display'>$row_cla[4]</td>" // _what
                . "<td class='td border-display'>$row_cla[5]</td>" // _when
                . "<td class='td border-display'>$row_cla[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='cla$row_cla[0]' /></td>";
        echo '</tr>';
        
        if( !empty($_POST["cla$row_cla[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_cla[0]</td>";
            foreach ($class_column as $value_class) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_class' value='$row_cla[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_cla[0]' name='id_cla'>OK</button></td>";
            echo '<tr>';
        }
        
        if ( !empty($_POST["class_name"]) ) {
            $id = $_POST["id_cla"];
            $class_name = $_POST['class_name'];
            $_where = $_POST['_where'];
            $_who = $_POST['_who'];
            $_what = $_POST['_what'];
            $_when = $_POST['_when'];
            $author = $_POST['author'];
            $sql = '';
            $sql .= "UPDATE `CLASS` SET ";
            $sql .= "class_name='$class_name', ";
            $sql .= "_where='$_where', ";
            $sql .= "_who='$_who', ";
            $sql .= "_what='$_what', ";
            $sql .= "_when='$_when', ";
            $sql .= "author='$author' ";
            $sql .= "WHERE id='$id';";
            if ( $result =  mysqli_query($db, $sql) ) {
                echo "<p>" . mysqli_affected_rows($db) . ' class(es) information was modified. </p> ';
            }else{
                echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
            }
        }
    }
    echo '</tbody>';
    echo "</table>";
    // header('location:#');
}

// ORG table header
function org_tableCol() {
    $org_tableCol = array('id', 'org_name', '_where', '_what', '_who', '_how', 'author');
    echo "<table class='table display'>";
    foreach ($org_tableCol as $value_class) { 
        echo "<th class='td border-display'>$value_class</th>";        
    }
    echo "<th class='th border-display'>operation</th>";
}
// no specfic ORG searching
if ( !empty($_GET['org']) && $_GET['org'] == 'ORG' && empty($_GET['search_inf']) ) {
    $org_column = array('org_name', '_when', '_where', '_who', '_how', 'author');
    $i = 1;
    
    echo '<h2>ORG table</h2>';
    org_tableCol();
    
    $org_search = mysqli_query($db, "SELECT * FROM `ORG`;");
    echo "<tbody>";
    while ( $row_org = mysqli_fetch_array($org_search) ){
        echo "<tr>";
        echo "<td class='td border-display'>$row_org[0]</td>"  // id
                . "<td class='td border-display'>$row_org[1]</td>" // org_name
                . "<td class='td border-display'>$row_org[2]</td>" // _where
                . "<td class='td border-display'>$row_org[3]</td>" // _what
                . "<td class='td border-display'>$row_org[4]</td>" // _who
                . "<td class='td border-display'>$row_org[5]</td>" // _how
                . "<td class='td border-display'>$row_org[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='org$row_org[0]' /></td>";
        echo '</tr>';
        if( !empty($_POST["org$row_org[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_org[0]</td>";
            foreach ($org_column as $value_org) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_org' value='$row_org[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_org[0]' name='id_org'>OK</button></td>";
            echo '<tr>';
        }
    }
    if ( !empty($_POST["org_name"]) ) {
        $id = $_POST["id_org"];
        $org_name = $_POST['org_name'];
        $_where = $_POST['_where'];
        $_what = $_POST['_what'];
        $_who = $_POST['_who'];
        $_how = $_POST['_how'];
        $author = $_POST['author'];
        $sql = '';
        $sql .= "UPDATE `ORG` SET ";
        $sql .= "org_name='$org_name', ";
        $sql .= "_where='$_where', ";
        $sql .= "_what='$_what', ";
        $sql .= "_who='$_who', ";
        $sql .= "_how='$_how', ";
        $sql .= "author='$author' ";
        $sql .= "WHERE id='$id';";
        if ( $result =  mysqli_query($db, $sql) ) {
            echo "<p>" . mysqli_affected_rows($db) . ' organization(es) information was modified. </p> ';
        }else{
            echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
        }
    }
    echo '</tbody>';
    echo "</table>";
    // header('location:#');
}
// specfic ORG searching
if ( !empty($_GET['org']) && $_GET['org'] == 'ORG' && !empty($_GET['search_inf']) ) {
    $org_column = array('org_name', '_where', '_what', '_who', '_how', 'author');
    $i = 1;
    
    echo '<h2>ORG table</h2>';
    org_tableCol();
    
    $o_inser = $_GET['search_inf'];
    
    $sql = "SELECT * FROM `ORG` WHERE ";
    $sql = $sql . "org_name = '$o_inser' OR ";
    $sql = $sql . "_where LIKE '%$o_inser%' OR ";
    $sql = $sql . "_what LIKE '%$o_inser%' OR ";
    $sql = $sql . "_who LIKE '%$o_inser%' OR ";
    $sql = $sql . "_how LIKE '%$o_inser%' OR ";
    $sql = $sql . "author LIKE '%$o_inser%'; ";
             
    $org_search = mysqli_query($db, $sql);
    echo "</tbody>";
    while ( $row_org = mysqli_fetch_array($org_search) ){
        echo "<tr>";
        echo "<td class='td border-display'>$row_org[0]</td>"  // id
                . "<td class='td border-display'>$row_org[1]</td>" // org_name
                . "<td class='td border-display'>$row_org[2]</td>" // _where
                . "<td class='td border-display'>$row_org[3]</td>" // _what
                . "<td class='td border-display'>$row_org[4]</td>" // _who
                . "<td class='td border-display'>$row_org[5]</td>" // _how
                . "<td class='td border-display'>$row_org[6]</td>" //author
                . "<td class='td border-display'><input type='submit' value='MODIFY' name='org$row_org[0]' /></td>";
        echo '</tr>';
        if( !empty($_POST["org$row_org[0]"] ) ) {
            echo '<tr>';
            echo "<td class='td border-display'>$row_org[0]</td>";
            foreach ($org_column as $value_org) {
                echo "<td class='td border-display'><input type='text' class='modifybox' name='$value_org' value='$row_org[$i]'></td>";
                $i += 1;
            }
            echo "<td class='td border-display'><button type='submit' value='$row_org[0]' name='id_org'>OK</button></td>";
            echo '<tr>';
        }
        if ( !empty($_POST["org_name"]) ) {
            $id = $_POST["id_org"];
            $org_name = $_POST['org_name'];
            $_where = $_POST['_where'];
            $_what = $_POST['_what'];
            $_who = $_POST['_who'];
            $_how = $_POST['_how'];
            $author = $_POST['author'];
            $sql = '';
            $sql .= "UPDATE `ORG` SET ";
            $sql .= "org_name='$org_name', ";
            $sql .= "_where='$_where', ";
            $sql .= "_what='$_what', ";
            $sql .= "_who='$_who', ";
            $sql .= "_how='$_how', ";
            $sql .= "author='$author' ";
            $sql .= "WHERE id='$id';";
            if ( $result =  mysqli_query($db, $sql) ) {
                echo "<p>" . mysqli_affected_rows($db) . ' organization(es) information was modified. </p> ';
            }else{
                echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
            }
        }
    }
    echo '</tbody>';
    echo "</table>";
    // header('location:#');
}

mysqli_close($db);
?>               
                
            </form>
        </div>
    </body>
</html>