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

    def ending(self, questions):
        words_end = grab.segmentList(questions)
        for word_end in words_end:
            if word_end in stop:
                return True
            return False

    def endingMess(self):
        print(endMess)


