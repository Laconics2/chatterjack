<?php
require_once "db.php";
?>

<!DOCTYPE html>
<!--
This is the home page to show all the operation
-->
<html>
    <head>
        <title>Modify QA</title>
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
            
            <form action='modifyDisplay.php' method='get' class="table_choose">
                <p class='checkp'>
                    Select which table you want to modify information:
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
                    <a href='modify.php'>
                        <input type='button' value="NEW">
                    </a>
                </p>
            </form> 
            
            <hr>
        </div>
    </body>
</html>
