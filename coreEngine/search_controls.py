# Imports the MessageGenerator() Class from message_generator
from coreEngine.message_generator import MessageGenerator

answer = MessageGenerator()

global inter, organName, personName, className, keywords


def getAnswer(question):
    """ This a  function used by ChatterJack_GUI.py
    to pass the question to the searching algorithm
    and return the answer. (by passing strings)"""
    return answer.generate_answer(question)