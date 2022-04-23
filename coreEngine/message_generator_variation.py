"""
 This file is used for generating the answer according to the database and question.
"""
from coreEngine.segmentation import Segment
from coreEngine.search import Search

import random

grab = Segment()
keywordsAnswer = Search()


class MessageGenerator:
    def __init__(self, questions=None):
        self.table = keywordsAnswer.table(questions)
        self.keywords = keywordsAnswer.searchKeyInf(questions)[0]

    def generatePronouns(self):
        # this assumes the format of the pronouns section is "he/him/his"
        if self.keywords["sex"] is not "TBD":
            return self.keywords["sex"].split("/")
        return "They", "Them", "Their"

    def generateTimeString(self, whenString):
        # assumes when string is in the format "MoWeFr 11:10AM - 12:20PM", if the populateDatabase script is used, this
        # will be the format
        possibleStartPhrase = ["This class is held on ",
                               self.keywords["class_name"] + "has these meeting times:",
                               "It's meeting times are"]
        if whenString == "TBA":
            return "I'm sorry, it appears there is no information about meeting times for this class."
        else:
            days, times = whenString.split(" ", 1)
            if "Mo" in days:
                days = days.replace("Mo", "Monday")
            if "Tu" in days:
                days = days.replace("Tu", "Tuesday")
            if "We" in days:
                days = days.replace("We", "Wednesday ")
            if "Th" in days:
                days = days.replace("Th", "Thursday")
            if "Fr" in days:
                days = days.replace("Fr", "Friday")

            startTime, endTime = times.split("-")
            timePart = [f"{days} from {startTime} to {endTime}",
                        f"{days} starting at {startTime}",
                        f"{days} starting at {startTime} and ending at {endTime}"]

            return possibleStartPhrase[random.randint(0, 2)] + timePart[random.randint(0, 2)]

    def generate_answer(self):
        personName = "NULL"
        answer = "NULL"
        # generator the answer according pronouns
        if self.table == 'PERSON':

            # randomly select the person's name, spe_name, or pronouns
            nameType = random.randint(0, 2)
            if nameType:
                speOrFullName = random.randint(0, 2)
                if speOrFullName:
                    if "person_name" in self.keywords.keys():
                        personName = self.keywords["person_name"]
                    else:
                        personName = self.keywords['person_spe_name']
                if '_where' in self.keywords.keys():
                    answer = personName + "'s office is located in  " + self.keywords['_where'] + '.'
                if '_who' in self.keywords.keys():
                    answer = personName + " is the " + self.keywords['_who'] + '.'
                if '_when' in self.keywords.keys():
                    answer = personName + " office hour is at " + self.keywords['_when'] + '.'

            else:
                pronouns = self.generatePronouns()

                if '_where' in self.keywords.keys():
                    answer = pronouns[2] + " office is located in  " + self.keywords['_where'] + '.'
                if '_who' in self.keywords.keys():
                    if pronouns[0].lower() is not "They":
                        answer = pronouns[0] + " is the " + self.keywords['_who'] + '.'
                    else:
                        answer = pronouns[0] + " are the " + self.keywords['_who'] + '.'
                if '_when' in self.keywords.keys():
                    answer = pronouns[2] + " office hour is at " + self.keywords['_when'] + '.'

            return answer

        if self.table == 'CLASS':
            if '_where' in self.keywords.keys():
                answer = "It is at " + self.keywords['_where'] + '.'
            if '_who' in self.keywords.keys():
                answer = self.keywords['_who'] + ' is the primary instructor.'
            if '_when' in self.keywords.keys():
                answer = self.generateTimeString(self.keywords["_when"])
            if '_what' in self.keywords.keys():
                answer = "It is about the knowledge of " + self.keywords['_what'] + '.'
            return answer

        if self.table == 'ORG':
            if '_where' in self.keywords.keys():
                answer = "It is at " + self.keywords['_where'] + '.'
            if '_who' in self.keywords.keys():
                answer = "Its dean is " + self.keywords['_who'] + '.'
            if '_how' in self.keywords.keys():
                answer = "You can take " + self.keywords['_how'] + ' there.'
            if '_what' in self.keywords.keys():
                answer = "It is " + self.keywords['_what'] + '.'
            return answer


"""
answer = MessageGenerator()
questions = input("Question: ")
print(answer.generate_answer(questions))
"""
