import sys
import subprocess


class JJ_setup:
    """ This is a class used for installing and checking most
    recent versions of all used packages, to ensure easy instillation"""
    def __init__(self):
        self.packages = ['wxPython', 'wavio', 'sounddevice',
                         'pydub', 'SpeechRecognition',
                         'pymysql', 'spacy', 'regex', 'sklearn',
                         'numpy', 'scipy', 'requests', 'beautifulsoup4',
                         'pyttsx3', 'scipy']

    def check_packages(self):
        # implement pip as a subprocess:
        try:
            for pack in range(0, len(self.packages)):
                subprocess.check_call([sys.executable, '-m', 'pip', 'install', self.packages[pack]])
        except Exception:
            print("One or more package names do not exist")

    def add_package(self, package_name):
        # This function will only be used when
        # more packages are used in the project
        if package_name != str(package_name):
            print("Not a valid package name")
        else:
            self.packages.append(package_name)
