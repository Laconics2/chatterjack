from search import Search

answer = Search()

global inter, organName, personName, className


def getAnswer(question):
    """ This a  function used by ChatterJack_GUI.py
    to pass the question to the searching algorithm
    and return the answer. (by passing strings)"""
    return answer.searchKeyInf(question)
