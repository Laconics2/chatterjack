import sounddevice as sd
from scipy.io.wavfile import write
import wavio as wv


def get_user_speech():
    fs = 44100
    duration = 6  # seconds
    sd.default.samplerate = fs
    sd.default.channels = 2
    user_speech = sd.rec(int(duration * fs), samplerate=fs, channels=2)
    sd.wait()
    write("user_speech_array.wav", fs, user_speech)
    # Convert the NumPy array to audio file
    wv.write("user_speech.wav", user_speech, fs, sampwidth=2)
