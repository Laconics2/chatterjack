import requests
import json
from bs4 import BeautifulSoup


class WebScrapper:
    def __init__(self):
        self.titles = ("instructor", "professor", 'lecturer')
        #by iteself will return an error, it needs the facultyID appended to it
        self.baseURL= "https://directory.nau.edu/api/elastic/directory/"
        self.facJson = None
        self.facID = None

    # returns a json file object corresponding to the facID
    def getJson(self, facID):
        url = self.baseURL + facID
        print(url)
        #print(requests.get(url).json())
        return requests.get(url).json()
    # returns a tuple of name, office building, and rank
    def getFacInfo(self):
        if "rank" not in self.facJson or self.facJson["rank"] == "None":
            for element in self.facJson["edupersonaffiliation"]:
                if element.lower() in self.titles:
                    who = element
            else:
                who =self.facJson["edupersonaffiliation"][-1]
        else:
            who = self.facJson["rank"]
        if "building" not in self.facJson or self.facJson["building"] == None:
            where = "unknown"
        else:
            where = self.facJson["building"]
        return (self.facJson["fn"], where, who)

    # returns all courses this faculty teachs, if they dont teach will return
    # empty set
    # format (classNumber, classDescription, classProf, courseID)
    def getCoursesTaught(self):
        uniqueIDs = []
        uniqueCourses = []
        courseList = []
        # look through the courses and only grab unique ones
        # in the json file courses are repeated when the fac has taught it
        # multiple semesters
        for course in self.facJson["courses"]:
            courseID = course["crse_id"]

            if courseID not in uniqueIDs:
                uniqueIDs.append(courseID)
                uniqueCourses.append(course)

        for course in uniqueCourses:
            courseID = course["crse_id"]
            classNumber = course["subject"] + course["catalog_nbr"]
            classDescription = self.getCourseDescription(courseID)
            classProf = self.getFacInfo()[0]
            element = (classNumber, classDescription, classProf, courseID)
            courseList.append(element)
        return courseList
    def getCourseDescription(self, courseNbr):

        courseURL = "https://catalog.nau.edu/Courses/course?courseId=" + courseNbr
        page = requests.get(courseURL)
        soup = BeautifulSoup(page.content, "html.parser")
        try:
            results = soup.find(id="courseResults").text
            description = results.split("Description:", 1)[1]
            description = description.split("Units", 1)[0].strip()
            return description
        except:
            return "Error in grabbing information, please update manually"
    # MUST BE CALLED FIRST
    def changeFacMember(self, facID):
        self.facJson = self.getJson(facID)
        self.facID = facID
    def getFacMember(self):
        return self.facID
