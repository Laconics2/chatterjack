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
        self.populateAllOrgData()
        with open(self.facFile, 'r') as fileObject:
            lines = fileObject.readlines()
        for id in lines:
            facID = id.strip()
            self.WebScrapper.changeFacMember(facID)
            self.populateFac()
            self.populateCourses()

    def populateOrgInfo(self, orgData):
        if self.connection is not None and self.cursor is not None:
            insertData = orgData
            sqlQuery = """INSERT INTO Org (org_name,
                                              _where,_what, _who, _how, author)
                            VALUES (%s, %s, %s, %s, %s, %s)          """
            self.cursor.execute(sqlQuery, insertData)
            self.connection.commit()

    def populateAllOrgData(self):
        insertData = [("NAU", "S San Francisco St, Flagstaff",
                     "Our academic programs, research, public service, " \
                     "and creative endeavors enrich lives and create opportunities" \
                     " in Arizona and beyond. We develop solutions to challenges and drive " \
                     "innovation in a supportive, inclusive, and diverse environment.",
                     "José Luis Cruz Rivera","NA", "admin"),
                       ("SICCS", "Building 90, 1295 S. Knoles Dr.",
                       "The School of Informatics, Computing, and Cyber Systems (SICCS) integrates a range of " \
                       "educational programs and interdisciplinary research. Our programs integrate computational " \
                       "and data sciences with engineering, natural and social sciences, arts, and business. Our " \
                       "faculty and academic programs combine expertise in environmental and ecological informatics, " \
                       "health and bioinformatics, computer science, cyber-security/cyber-engineering, and " \
                       "electrical engineering.",
                       "Ben Ruddell", "NA", "admin"),
                       ("CEIAS", " Building 69, 2112 S Huffer Lane",
                        "We combine interdisciplinary scholarship and technological innovation with distinctive and " \
                       "forward-looking academic programs to support economic and societal vitality and " \
                       "entrepreneurship while preparing students for professional opportunities of the future.",
                        "Andy Wang","NA", "admin")]
        for orgData in insertData:
            self.populateOrgInfo(orgData)

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
