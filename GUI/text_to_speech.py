# Import the required module for text
# to speech conversion
from gtts import gTTS

# This module is imported so that we can
# play the converted audio
from playsound import playsound


def return_str_as_speech(question):
    # Language in which you want to convert
    language = 'en'

    # Passing the text and language to the engine,
    # here we have marked slow=False. Which tells
    # the module that the converted audio should
    # have a high speed
    speech_obj = gTTS(text=question, lang=language, slow=False, tld='co.uk')

    # Saving the converted audio in a mp3 file named
    # welcome
    speech_obj.save("answer.mp3")

    # Playing the converted file
    playsound('answer.mp3')
