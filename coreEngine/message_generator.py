"""
 This file is used for generating the answer according to the database and question.
"""

from coreEngine.segmentation import Segment
from coreEngine.search import Search

grab = Segment()
keywordsAnswer = Search()

class MessageGenerator():

    def generate_answer(self, questions):
        global keywords

        table = keywordsAnswer.table(questions)
        keywords = keywordsAnswer.searchKeyInf(questions)[0]

        # generator the answer according to the gender
        if table == 'PERSON':
            if keywords['sex'] == 'Male':
                if '_where' in keywords.keys():
                    answer = "His office is at " + keywords['_where'] + '.'
                if '_who' in keywords.keys():
                    answer = "He is the " + keywords['_who'] + '.'
                if '_when' in keywords.keys():
                    answer = "His office hour is at " + keywords['_when'] + '.'
            if keywords['sex'] == 'Female':
                if '_where' in keywords.keys():
                    answer = "Her office is at " + keywords['_where'] + '.'
                if '_who' in keywords.keys():
                    answer = "She is the " + keywords['_who'] + '.'
                if '_when' in keywords.keys():
                    answer = "Her office hour is at " + keywords['_when'] + '.'
            return answer

        if table == 'CLASS':
            if '_where' in keywords.keys():
                answer = "It is at " + keywords['_where'] + '.'
            if '_who' in keywords.keys():
                answer = keywords['_who'] + ' is the primary instructor.'
            if '_when' in keywords.keys():
                answer = "It starts at " + keywords['_when'] + '.'
            if '_what' in keywords.keys():
                answer = "It is about the knowledge of " + keywords['_what'] + '.'
            return answer

        if table == 'ORG':
            if '_where' in keywords.keys():
                answer = "It is at " + keywords['_where'] + '.'
            if '_who' in keywords.keys():
                answer = "Its dean is " + keywords['_who'] + '.'
            if '_how' in keywords.keys():
                answer = "You can take " + keywords['_how'] + ' there.'
            if '_what' in keywords.keys():
                answer = "It is " + keywords['_what'] + '.'
            return answer

# answer = MessageGenerator()
# questions = input("Question: ")
# print(answer.generate_answer(questions))






