"""
 This class utilize NPL (spaCy) to segment the input questions and grab key information.
"""

from coredata import interrogatives, nauInf, calls

import spacy
import re
nlp = spacy.load("en_core_web_sm")


searchInf = {}

class Segment():
    def __init__(self):
        self.question = ""

    # segment the input question and store token words in the list
    def segmentSentence(self, questions):
        wordsOrg = []
        doc = nlp(questions)
        for token in doc:
            wordsOrg.append(token.text)
        return wordsOrg

    # store the lower token words in the list
    def segmentList(self, questions):
        wordsLow = []
        doc = nlp(questions)
        for token in doc:
            wordsLow.append(token.lower_)
        return wordsLow

    # grab the interrogative from the list
    def interrogative(self, questions):
        words_low = self.segmentList(questions)
        for inter in words_low:
            if inter in interrogatives:
                inter = '_' + inter
                searchInf[inter] = 'INTER'
        return searchInf

    # grab the interrogative from the list for keep asking
    def keepInterrogative(self, questions):
        words_low = self.segmentList(questions)
        for inter in words_low:
            if inter in interrogatives:
                inter = '_' + inter
                return inter

    # find the common person
    def person(self, questions):
        doc = nlp(questions)
        for entity in doc.ents:
            # only return the person
            if entity.label_ == 'PERSON':
                searchInf[entity.text] = entity.label_
        return searchInf

    # grab the nau entities
    def nau(self, questions):
        words_low = self.segmentList(questions)
        for nauWord in words_low:
            if nauWord in nauInf:
                searchInf[nauWord] = 'ORG'
        return searchInf

    # grab the special person
    def expandPerson(self, questions):
        words_low = self.segmentList(questions)
        words_org = self.segmentSentence(questions)
        searchInf = self.person(questions)
        for named in words_low:
            if named in calls:
                spePerInd = words_low.index(named) + 1
                searchInf[words_org[spePerInd]] = 'PERSON'
                return True
        return searchInf

    # grab the class
    def classes(self, questions):
        doc = nlp(questions)
        # class regular expression
        class_exp = r"[a-zA-Z]{0,4}\S*\d{3,6}"
        for match in re.finditer(class_exp, doc.text):
            start, end = match.span()
            course = doc.char_span(start, end)
            # a course or None if match doesn't map to valid token sequence
            if course is not None:
                searchInf[course.text] = 'CLASS'
        return searchInf

    # package all grab function
    def intention(self, questions):
        self.interrogative(questions)
        self.nau(questions)
        self.person(questions)
        self.expandPerson(questions)
        self.classes(questions)
        return searchInf

    # clean the intention of the last questions
    def clean(self):
        global searchInf
        searchInf = {}
        return searchInf