import sounddevice as sd
import wavio as wv


def get_user_speech():
    freq = 48000
    duration = 10

    recording = sd.rec(int(duration * freq), samplerate=freq, channels=2)
    sd.wait()

    wv.write("user_speech.wav", recording, freq, sampwidth=2)
