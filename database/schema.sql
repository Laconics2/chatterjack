
CREATE TABLE Administator
(
  /*Admin_ID INT IDENTITY(1,1) PRIMARY KEY,*/
  Admin_ID INT PRIMARY KEY,
  Admin_Name varchar(100),
  Email varchar(100)
);
CREATE TABLE General_User
(
 /* User_ID INT IDENTITY(1,1) PRIMARY KEY,*/
  User_ID INT PRIMARY KEY,
  Faculty_Name varchar(100),
  Email varchar(100)
);

CREATE TABLE Question_Concept
(
  /*Question_ID INT IDENTITY(1,1) PRIMARY KEY,*/
  Question_ID INT PRIMARY KEY,
  Question TEXT,
  Admin_ID INT REFERENCES Administator(Admin_ID),
  Owner_ID INT REFERENCES General_User(User_ID)
);

CREATE TABLE Answer_Concept
(
  /*Answer_ID INT IDENTITY(1,1) PRIMARY KEY,*/
  Answer_ID INT PRIMARY KEY,
  Question_ID INT REFERENCES Question_Concept(Question_ID),
  Answer TEXT,
  Admin_ID INT REFERENCES Administator(Admin_ID),
  Owner_ID INT REFERENCES General_User(User_ID)
);
