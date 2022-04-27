import pymysql
import sys
from mysql.connector import errorcode
from webscrapper import WebScrapper

class DatabasePopulation:
    def __init__(self, facFile):
        self.WebScrapper = WebScrapper()
        self.facFile = facFile
        connected = False

        try:
            __db = None
            # connect with the database
            self.connection = pymysql.connect(host='localhost',
                                            port=3306,
                                            user='root',
                                            password='111',
                                            database='chatterjack',
                                            charset='utf8',
                                            cursorclass=pymysql.cursors.DictCursor)
            self.connected = True
            self.cursor = self.connection.cursor()
        except pymysql.Error as e:
            print('Database connect fail')

    def populateFac(self):
        if self.connection is not None and self.cursor is not None:
            insertData = self.WebScrapper.getFacInfo()
            sqlQuery = """INSERT INTO Person (person_name,person_spe_name,
                                              _where,_who, _when, sex, author)
                            VALUES (%s, %s, %s, %s, %s, %s, %s)          """

            self.cursor.execute(sqlQuery, insertData)
            self.connection.commit()
    # populates the class table with information that does not need to be gathered
    # from the administrators, information that needs to be updated has "TBD"
    def populateCourses(self):
        if self.connection is not None and self.cursor is not None:

            courseList = self.WebScrapper.getCoursesTaught()

            sqlQuery = """INSERT INTO class (class_name, class_section, _where, _who, _what, _when, author)
                                VALUES (%s, %s, %s, %s, %s, %s, %s)

            """

            for course in range(len(courseList)):
                insertData = courseList[course]
                self.cursor.execute(sqlQuery, insertData)
                self.connection.commit()
    def populateDatabase(self):

        with open(self.facFile, 'r') as fileObject:
            lines = fileObject.readlines()
        for id in lines:
            facID = id.strip()
            self.WebScrapper.changeFacMember(facID)
            self.populateFac()
            self.populateCourses()

    def closeConnection(self):
        if self.connected:
            self.connection.close()
            print("MySQL connection is closed")


sysArgLen = len(sys.argv)
if sysArgLen > 1:
    populator = DatabasePopulation(sys.argv[1])
else:
    populator = DatabasePopulation("default.txt")
populator.populateDatabase()
populator.closeConnection()
