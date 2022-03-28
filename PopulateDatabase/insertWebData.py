import mysql.connector
from mysql.connector import errorcode
from webscrapper import WebScrapper

class facultyDatabasePopulation:
    def __init__(self, facFile):
        self.WebScrapper = WebScrapper()
        self.facFile = facFile
        try:
            self.connection = mysql.connector.connect(host='localhost',
                                             database='chatterjack',
                                             port=3306,
                                             user='root',
                                             password='111')
            self.cursor = self.connection.cursor()
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            self.connection = None
            self.cursor = None

    def populateFac(self):
        if self.connection is not None and self.cursor is not None:
            facultyInfo = self.WebScrapper.getFacInfo()
            facultyLName = facultyInfo[0].split()[-1]
            insertData = (facultyInfo[0],
                         facultyLName,
                         facultyInfo[1],
                         facultyInfo[2],
                         "TBD",
                         self.WebScrapper.getFacMember(),
                         "TBD")
            sqlQuery = """INSERT INTO Person (person_name,person_spe_name,
                                              _where,_who, _when,author,sex)
                            VALUES (%s, %s, %s, %s, %s, %s, %s)          """

            self.cursor.execute(sqlQuery, insertData)
            self.connection.commit()
    # populates the class table with information that does not need to be gathered
    # from the administrators, information that needs to be updated has "TBD"
    def populateCourses(self):
        if self.connection is not None and self.cursor is not None:

            courseList = self.WebScrapper.getCoursesTaught()

            sqlQuery = """INSERT INTO class (class_name, _where, _who, _what, _when, author)
                                VALUES (%s, %s, %s, %s, %s, %s)

            """

            for course in courseList:
                # format (classNumber, classDescription, classProf, courseID)
                insertData = (course[0], "TBD", course[2], course[1], "TBD", self.WebScrapper.getFacMember())
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
        if self.connection.is_connected():
            self.connection.close()
            print("MySQL connection is closed")
populator = facultyDatabasePopulation("ceias_fac_nau_ids.txt")
#populator.populateFac("mlv83")
populator.populateDatabase()
populator.closeConnection()
