"""
 This is the class for searching and matching the key information of the database.
"""

import pymysql
from coreEngine.segmentation import Segment
from coreEngine.coredata import table_list
from coreEngine.similarity import Similarity

grab = Segment()
correct = Similarity()

class Search():
    connected = False
    __db = None

    # connect with the database
    def __init__(self):
        try:
            self.__db = pymysql.connect(host='localhost',
                                        port=3306,
                                        user='root',
                                        password='111',
                                        database='chatterjack',
                                        charset='utf8',
                                        cursorclass=pymysql.cursors.DictCursor)
            self.connected = True
        except pymysql.Error as e:
            print('Database connect fail')

    # detect search which table
    def table(self, questions):
        global searchInf
        searchInf = grab.intention(questions)
        tables = []
        for value in searchInf.values():
            if value in table_list:
                tables.append(value)
        if 'PERSON' and 'CLASS' in tables:
            return 'CLASS'
        if 'PERSON' in tables:
            return 'PERSON'
        if 'CLASS' in tables:
            return 'CLASS'
        if 'ORG' in tables:
            return 'ORG'

    # search the database and return the answer
    def searchKeyInf(self, questions):
        global inter, organName, className, personName, keywords, person, cla, org

        table = self.table(questions)
        # grab the name and searching column from the dictionary
        for key, value in searchInf.items():
            if value == 'PERSON':
                personName = key
                person = correct.nameCheck(personName)
            if value == 'CLASS':
                className = key
                cla = correct.claCheck(className)
            if value == 'ORG':
                organName = key
                org = correct.nameCheck(organName)
            if value == 'INTER':
                inter = key

        # search the PERSON table
        if table == 'PERSON':
            searching = "SELECT " + inter + ", `sex` FROM " + table + " WHERE `person_name` = %s OR `person_spe_name` = %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, [person, person])
                    keywords = cursor.fetchall()
                    return keywords
            except pymysql.Error as e:
                return False

        # search the ORG table
        if table == 'ORG':
            searching = "SELECT " + inter + " FROM " + table + " WHERE `org_name` LIKE %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, [('%' + org + '%')])
                    keywords = cursor.fetchall()
                    return keywords
            except pymysql.Error as e:
                return False

        # search the CLASS table
        if table == 'CLASS':
            searching = "SELECT " + inter + " FROM " + table + " WHERE `class_name` LIKE %s OR `class_section` = %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, [('%' + cla + '%'), cla])
                    keywords = cursor.fetchall()
                    return keywords
            except pymysql.Error as e:
                return False

    # close the cursor and database
    def close(self):
        self.__db.close()

"""
answer = Search()
questions = input("Question: ")
print(answer.searchKeyInf(questions))
"""
