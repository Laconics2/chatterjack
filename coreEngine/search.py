"""
 This is the class for searching and matching the key information of the database.
"""

import spacy
import pymysql
from segmentation import Segment
from coredata import table_list

grab = Segment()


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
        global inter, organName, className, personName, answer

        table = self.table(questions)
        # grab the name and searching column from the dictionary
        for key, value in searchInf.items():
            if value == 'PERSON':
                personName = key
            if value == 'CLASS':
                className = key
            if value == 'ORG':
                organName = key
            if value == 'INTER':
                inter = key

        # search the PERSON table
        if table == 'PERSON':
            searching = "SELECT " + inter + " FROM " + table + " WHERE `person_name` LIKE %s OR `person_spe_name` = %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, [('%' + personName + '%'), personName])
                    answers = cursor.fetchone()
                    for v_a in answers.values():
                        answer = v_a
                    return answer
            except pymysql.Error as e:
                return False

        # search the ORG table
        if table == 'ORG':
            searching = "SELECT " + inter + " FROM " + table + " WHERE `org_name` LIKE %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, [('%' + organName + '%')])
                    answers = cursor.fetchone()
                    for v_a in answers.values():
                        answer = v_a
                    return answer
            except pymysql.Error as e:
                return False

        # search the CLASS table
        if table == 'CLASS':
            searching = "SELECT " + inter + " FROM " + table + " WHERE `class_name` LIKE %s;"
            try:
                with self.__db.cursor() as cursor:
                    cursor.execute(searching, ('%' + className + '%'))
                    answers = cursor.fetchone()
                    for v_a in answers.values():
                        answer = v_a
                    return answer
            except pymysql.Error as e:
                return False

    # close the cursor and database
    def close(self):
        self.__db.close()

