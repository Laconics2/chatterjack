CREATE TABLE ORG(
id INT auto_increment PRIMARY KEY,
author MEDIUMTEXT,
org_name MEDIUMTEXT,
_where LONGTEXT,
_what LONGTEXT,
_who MEDIUMTEXT,
_how MEDIUMTEXT
);

CREATE TABLE PERSON(
id INT auto_increment PRIMARY KEY,
author MEDIUMTEXT,
person_name MEDIUMTEXT,
person_spe_name MEDIUMTEXT,
_where MEDIUMTEXT,
_who MEDIUMTEXT,
_when MEDIUMTEXT
);

CREATE TABLE CLASS(
id INT auto_increment PRIMARY KEY,
author MEDIUMTEXT,
class_name MEDIUMTEXT,
_where MEDIUMTEXT,
_who MEDIUMTEXT,
_what MEDIUMTEXT,
_when MEDIUMTEXT
);
