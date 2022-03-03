<?php
    error_reporting(E_ALL);
    
    // connect with the database
    $db = mysqli_connect('127.0.0.1', 'root', '111', 'chatterjack', '3306');
    if ($db -> connect_error){
        exit('Database connection fails: '. $db->connect_error);
    }
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Search QA</title>
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
            <form action='' method='post' name='indexForm'>
                
                <!-- table for operations -->
                <table>
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
            
            <!-- PERSON table header -->
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">person_name</th>
                            <th scope="col">person_spe_name</th>
                            <th scope="col">_where</th>
                            <th scope="col">_who</th>
                            <th scope="col">_when</th>
                            <th scope="col">faulty</th>
                        </tr>
                    </thead>
                    <tbody>                     
<?php
    // show PERSON table
    echo '<h2>PERSON table</h2>';
    $person = mysqli_query($db, 'SELECT * FROM `PERSON`');
    while ( $row_org = mysqli_fetch_array($person) ){
        echo '<tr>';
        echo "<td>$row_org[0]</td>"  // id
                . "<td>$row_org[1]</td>" // person_name
                . "<td>$row_org[2]</td>" // person_spe_name
                . "<td>$row_org[3]</td>" // _where
                . "<td>$row_org[4]</td>" // _who
                . "<td>$row_org[5]</td>" // _when
                . "<td>$row_org[6]</td>"; //faculty
        echo '</tr>';
    }
?>
                    </tbody>
                </table>
            
            <hr>
            
            <!-- PERSON table header -->
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">org_name</th>
                            <th scope="col">_when</th>
                            <th scope="col">_where</th>
                            <th scope="col">_who</th>
                            <th scope="col">_how</th>
                            <th scope="col">faulty</th>
                        </tr>
                    </thead>
                    <tbody>                    
<?php
    // show ORG table
    echo '<h2>ORG table</h2>';
    $org = mysqli_query($db, 'SELECT * FROM `ORG`');
    while ( $row_org = mysqli_fetch_array($org) ){
        echo '<tr>';
        echo "<td>$row_org[0]</td>"  // id
                . "<td>$row_org[1]</td>" // org_name
                . "<td>$row_org[2]</td>" // _where
                . "<td>$row_org[3]</td>" // _what
                . "<td>$row_org[4]</td>" // _who
                . "<td>$row_org[5]</td>" // _how
                . "<td>$row_org[6]</td>"; //faculty
        echo '</tr>';
    }
?>
                    </tbody>
                </table>
            
            <hr>
            
            <!-- CLASS table header -->
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">class_name</th>
                            <th scope="col">_where</th>
                            <th scope="col">_who</th>
                            <th scope="col">_what</th>
                            <th scope="col">_when</th>
                            <th scope="col">faulty</th>
                        </tr>
                    </thead>
                    <tbody>                    
<?php
    // show ORG table
    echo '<h2>CLASS table</h2>';
    $org = mysqli_query($db, 'SELECT * FROM `CLASS`');
    while ( $row_org = mysqli_fetch_array($org) ){
        echo '<tr>';
        echo "<td>$row_org[0]</td>"  // id
                . "<td>$row_org[1]</td>" // class_name
                . "<td>$row_org[2]</td>" // _where
                . "<td>$row_org[3]</td>" // _who
                . "<td>$row_org[4]</td>" // _what
                . "<td>$row_org[5]</td>" // _when
                . "<td>$row_org[6]</td>"; //faculty
        echo '</tr>';
    }
?>
                    </tbody>
                </table>
            
            </form>
        </div>
    </body>
</html>

