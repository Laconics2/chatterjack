from coredata import stillMess, startMess, nextMess, stop, still, endMess
from segmentation import Segment

grab = Segment()

class Greetings:

    def __init__(self):
        pass

    def start(self):
        print(startMess)

    def nextQuestion(self):
        print(nextMess)

    def keepMess(self):
        print(stillMess)

    """
    The function is used for judging whether the input message contains 'yes'.
    If the input contains 'yes', then it will judging whether this input contains a question.
    If the input contains both 'yes' and a question, it will return false, then will search a question.
    If the input only contains 'yes', it will return true, 
    then will call function keepMess() to print 'What else do you want to know?' (Notice this flow control is in the 'testchatbot.py'
    """
    def keepAsking(self, questions):
        words_low = grab.segmentList(questions)
        for word_keep in words_low:
            if word_keep in still:
                if grab.keepInterrogative(questions) != None:
                    return False
                else:
                    self.keepMess()
                    return True
            else:
                return False

    """
    This function is used for judging whether the input message contains 'no'.
    """
    def ending(self, questions):
        words_end = grab.segmentList(questions)
        for word_end in words_end:
            if word_end in stop:
                return True
            return False

    def endingMess(self):
        print(endMess)


