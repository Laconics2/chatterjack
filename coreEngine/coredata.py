import pymysql
import os
def populateAllInf():
    try:
        with open("allInf.txt", 'r') as fileObject:
            lastEntrySQL = int(fileObject.readline())

    except:
        lastEntrySQL = 0

    #print("Last:" + str(lastEntrySQL))
    all = []
    try:
        db = pymysql.connect(host='localhost',
                                    port=3306,
                                    user='root',
                                    password='',
                                    database='chatterjack',
                                    charset='utf8',
                                    cursorclass=pymysql.cursors.DictCursor)
        connected = True
    except pymysql.Error as e:
        print('Database connect fail')

    cursor = db.cursor()
    latestEntry = lastEntrySQL
    for entity in ["PERSON", "CLASS", "ORG"]:
        temp = int(cursor.execute(f"SELECT 'id' from {entity} ORDER BY id;"))
        if temp > latestEntry:
            latestEntry = temp

    curEntrySQL = temp

    if lastEntrySQL < latestEntry:
        try:
            os.remove("allInf.txt")
        except:
            pass
        file = open("allInf.txt", "a")
        file.write(str(latestEntry) + "\n")
        for entity in ["person", "class", "org"]:
            names = cursor.execute(f"SELECT `{entity}_name` FROM {entity}")
            results =  cursor.fetchall()
            for name in results:
                file.write( name[f"{entity}_name"] + "\n")
        file.close()

    file = open("allInf.txt", "r")

    lines = file.readlines()
    file.close()

    for element in lines:
        if element is not lines[0]:
            all.append(element.strip())
    return all

interrogatives = ['what', 'where', 'when', 'how', 'which', 'who']

nauInf = ['siccs', 'ceias', 'nau', 'sbs', 'engineering building', 'cline library', 'engineering']

calls = ['dr', 'ms', 'mr', 'miss', 'mrs', 'dr.', 'ms.', 'mr.', 'miss.', 'doctor', 'doctor.']

table_list = ['ORG', 'PERSON', 'CLASS']

multi_section = "Sorry, this is the multiple section classes, you need to provide both class name and section number, like cs122-001"

allInf = populateAllInf()
print(allInf)
# ending the conversation
stop = ['no']
# continuing the conversation
still = ['yes', 'yeah', 'course', 'yep']
# start the conversation
startMess = "Hello, My name is ChatterJack chatbot. You can ask me the information of professors, the location, and anything you want to know about NAU."
# asking if there any questions?
nextMess = "Do you have any other questions?"
# continuing message after typing yes
stillMess = "What else do you want to know?"
# ending the conversation
endMess = "Thanks for asking. Hopefully, the answer will help you. Have a nice day!"

# print(allInf)
