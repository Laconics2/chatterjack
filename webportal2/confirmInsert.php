<?php
require_once "db.php";
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Confirm Insert QA</title>
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
// confirm the PERSON information will be inserted
if ( !empty($_POST['person_submit']) ) {
    // insert sql language
    $sql = "INSERT INTO PERSON (person_name, person_spe_name, _where, _who, _when, author) VALUES (" ;
    $sql = $sql . "'" . $_POST["person_name:"] . "' ," ;
    $sql = $sql . "'" . $_POST["person_spe_name:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_where:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_who:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_when:"] . "' ," ;
    $sql = $sql . "'" . $_POST["author:"] . "' );" ;

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
    // insert sql language
    $sql = "INSERT INTO CLASS (class_name, _where, _who, _what, _when, author) VALUES (" ;
    $sql = $sql . "'" . $_POST["_class_name:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_where:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_who:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_what:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_when:"] . "' ," ;
    $sql = $sql . "'" . $_POST["author:"] . "' );" ;

    $person_insert = mysqli_query($db, $sql);
    if($person_insert){
        echo "<p>" . mysqli_affected_rows($db) . ' person information was added. </p>';
    }
    else{
        echo "<p>Error Insert: " . mysqli_error($db) . "</p>";
    }
}

// confirm the ORG information will be inserted
if ( !empty($_POST['org_submit']) ) {
    // insert sql language
    $sql = "INSERT INTO PERSON (org_name, _where, _what, _who, _how, author) VALUES (" ;
    $sql = $sql . "'" . $_POST["org_name:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_where:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_what:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_who:"] . "' ," ;
    $sql = $sql . "'" . $_POST["_how:"] . "' ," ;
    $sql = $sql . "'" . $_POST["author:"] . "' );" ;

    $person_insert = mysqli_query($db, $sql);
    if($person_insert){
        echo "<p>" . mysqli_affected_rows($db) . ' person information was added. </p>';
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



