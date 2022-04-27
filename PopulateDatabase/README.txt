required packages: BeautifulSoup
                   json( i think this comes default?)
                   pymysql
run insertAllbData.py to populate the database
  NOTE: insertWebData.py will populate person and class table, but not org table

NOTE: There are duplicates of some classes.
This is due to multiple professors teaching
the same class

running insertAllData.py without arguments will look for default.txt within the same folder, and populate based on nauIDs present within
run insertAllData.py name_of_file.txt to insert data about nauIDs present within name_of_file.txt
