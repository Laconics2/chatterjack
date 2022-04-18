<?php
require_once "db.php";
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Confirm Delete QA</title>
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


<?php
// confirm person will be deleted
if ($delID = $_POST['person_ID']) {
    // delete the book that selects from the select the 'delete.php' page
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
    // delete the book that selects from the select the 'delete.php' page
    $sql_del = "DELETE FROM `CLASS` WHERE `id` = '";
    $sql_del = $sql_del . $_POST['class_ID'] . "' ;";
    $class_del = mysqli_query($db, $sql_del);

    if($person_del){
        echo "<p>" . mysqli_affected_rows($db) . " class(es)' information was deleted. </p> ";
    }
    else{
        echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
    }
}

// confirm org will be deleted
if ($delID = $_POST['org_ID']) {
    // delete the book that selects from the select the 'delete.php' page
    $sql_del = "DELETE FROM `ORG` WHERE `id` = '";
    $sql_del = $sql_del . $_POST['org_ID'] . "' ;";
    $class_del = mysqli_query($db, $sql_del);

    if($person_del){
        echo "<p>" . mysqli_affected_rows($db) . " organization(s)' information was deleted. </p> ";
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
