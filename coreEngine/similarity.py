from coreEngine.coredata import allInf

from sklearn.feature_extraction.text import CountVectorizer
import numpy as np
from scipy.linalg import norm

all_similarity = {}

class Similarity():

    def __init__(self):
        self.stand = allInf

    def add_space(self, str):
        return ' '.join(list(str))

    def tf(self, keyInput, entry):
        input_value = self.add_space(keyInput)
        standard = self.add_space(entry)
        # change it to the TF matrix
        cv = CountVectorizer(tokenizer=lambda s: s.split())
        corpus = [input_value, standard]
        # calculate the TF coefficient
        vectors = cv.fit_transform(corpus).toarray()
        # calculate the similarity
        similarity = np.dot(vectors[0], vectors[1]) / (norm(vectors[0]) * norm(vectors[1]))
        return similarity

    def compare(self, keyInput):
        for i in range(len(self.stand)):
            entry = self.stand[i]
            each_similarity = self.tf(keyInput, entry)
            all_similarity[entry] = each_similarity
        return all_similarity

    def nameCheck(self, keyInput):
        all_similarity = self.compare(keyInput)
        for key, value in all_similarity.items():
            if value > 0.70:
                return key

    def claCheck(self, keyInput):
        all_similarity = self.compare(keyInput)
        for key, value in all_similarity.items():
            if value > 0.96:
                return key


"""
sim = Similarity()
s1 = input('Compare: ')
print('Similarity: ')
print(sim.compare(s1))
print('Return name: ' + sim.nameCheck(s1))
"""