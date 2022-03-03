from segmentation import Segment
from greet_mess import Greetings
from search import Search

if __name__ == '__main__':
    grab = Segment()
    answer = Search()
    greet = Greetings()

    global inter, organName, personName, className
    # conversation starts from here
    greet.start()
    questions = input()
    print(answer.searchKeyInf(questions))
    grab.clean()

    while True:
        if greet.ending(questions):
            greet.endingMess()
            break
        else:
            greet.nextQuestion()
            questions = input()
            if greet.keepAsking(questions):
                questions = input()
            print(answer.searchKeyInf(questions))
            grab.clean()
