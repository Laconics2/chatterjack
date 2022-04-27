import pymysql

def populateAllInf():
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
    # grab all person information
    personName = "SELECT `person_name` FROM PERSON"
    cursor.execute(personName)
    all_person = [item['person_name'] for item in cursor.fetchall()]
    # grab all class name
    claName = "SELECT `class_name` FROM CLASS"
    cursor.execute(claName)
    all_cla = [item['class_name'] for item in cursor.fetchall()]
    # grab all class section
    claSelection = "SELECT `class_section` FROM CLASS"
    cursor.execute(claSelection)
    all_claSection = [item['class_section'] for item in cursor.fetchall()]
    # grab all org name
    orgName = "SELECT `org_name` FROM ORG"
    cursor.execute(orgName)
    all_org = [item['org_name'] for item in cursor.fetchall()]
    all = all_person + all_cla + all_claSection + all_org
    return all

interrogatives = ['what', 'where', 'when', 'how', 'which', 'who']

nauInf = ['siccs', 'ceias', 'nau', 'sbs', 'engineering building', 'cline library', 'engineering']

calls = ['dr', 'ms', 'mr', 'miss', 'mrs', 'dr.', 'ms.', 'mr.', 'miss.', 'doctor', 'doctor.']

table_list = ['ORG', 'PERSON', 'CLASS']

multi_section = "Sorry, this is the multiple section classes, you need to provide both class name and section number, like cs122-001"

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
