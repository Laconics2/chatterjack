<!DOCTYPE html>

<html lang = "en">


        <head>
        
        <title> Home </title>
        

                </head>

        <body>


        <h1> User Landing Page </h1>

      <div>

        <form action="#">

          <select name="groceries" id="grocery" multiple>

            <option value="DB Element">Database element</option>
            <option value="DB Element">Database element</option>
            <option value="DB Element">Database Element</option>
            <option value="DB Element">Database Element</option>
            <option value="DB Element">Database Element</option>

          </select>

        </form>

      </div>

              <div>


        <form action='http://ec2-34-212-5-82.us-west-2.compute.amazonaws.com/addnew.php' method='get'>
                <input type='submit' value='Add New'/>
        </form>


        <form action='http://ec2-34-212-5-82.us-west-2.compute.amazonaws.com/editentry.php' method='get'>
                <input type='submit' value='Edit Entry'/>
        </form>

 <button type="button">Delete Entry</button>

      </div>

                </body>

</html>

