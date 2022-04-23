import pymysql

def populateAllInf():
    try:
        db = pymysql.connect(host='localhost',
                                    port=3306,
                                    user='root',
                                    password='111',
                                    database='chatterjack',
                                    charset='utf8',
                                    cursorclass=pymysql.cursors.DictCursor)
        connected = True
    except pymysql.Error as e:
        print('Database connect fail')
    cursor = db.cursor()
    searchSelection = "SELECT `person_name` FROM PERSON"
    cursor.execute(searchSelection)
    all = [item['person_name'] for item in cursor.fetchall()]
    return all

interrogatives = ['what', 'where', 'when', 'how', 'which', 'who']

nauInf = ['siccs', 'ceias', 'nau', 'sbs', 'engineering building', 'cline library', 'engineering']

calls = ['dr', 'ms', 'mr', 'miss', 'mrs', 'dr.', 'ms.', 'mr.', 'miss.', 'doctor', 'doctor.']

table_list = ['ORG', 'PERSON', 'CLASS']

allInf = populateAllInf()

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