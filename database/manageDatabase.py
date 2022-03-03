import pymysql
from segmentation import Segment
from coredata import table_list

grab = Segment()

class ManageDatabase():
    connected = False
    __db = None

    def __init__(self):
        try:
            self.__db = pymysql.connect(host='localhost',
                                        port=3306,
                                        user='admin',
                                        password='password',
                                        database='chatterjack',
                                        charset='utf8',
                                        cursorclass=pymysql.cursors.DictCursor)
            self.connected = True
        except pymysql.Error as e:
            print('Database connect fail')

    def editEntryByID(self, id, tableName, attribute, modification):
        try:
            modifyStr = f"UPDATE {tableName} SET {attribute} = \'{modification}\' WHERE id = {id};"
            self.__db.execute(modifyStr)
        except:
            print("There was a problem editing that element.")


    def editEntryByName(self, id, tableName, attribute, modification):
        try:
            modifyStr = f"UPDATE {tableName} SET {attribute} = \'{modification}\' WHERE {tableName.lower()}_name = {name};"
            self.__db.execute(modifyStr)
        except:
            print("There was a problem editing that element.")

    def removeEntryByID(self, id, tableName):
        try:
            removalStr = f"DELETE FROM {tableName} WHERE id = {id};"
            self.__db.execute(removalStr)
        except:
            print("There was a problem removing that element.")

    def removeEntryByName(self, name, tableName):
        try:
            removalStr = f"DELETE FROM {tableName} WHERE {tableName.lower()}_name = {name};"
            self.__db.execute(removalStr)
        except:
            print("There was a problem removing that element.")

    def close(self):
        self._db.close()
