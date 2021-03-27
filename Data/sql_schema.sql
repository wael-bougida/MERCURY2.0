CREATE DATABASE IF NOT EXISTS group19;

USE Housing;

CREATE TABLE Colleges(
    cid INT NOT NULL AUTO_INCREMENT,
    name CHAR(12) UNIQUE,
    address CHAR(30),
    PRIMARY KEY (cid)
);

CREATE TABLE Rooms(
    rid INT NOT NULL AUTO_INCREMENT,
    rnumber CHAR(5) UNIQUE,
    floor INT,
    mailbox CHAR(5),
    availability BIT,
    cid INT NOT NULL,       
    PRIMARY KEY (rid), 
    FOREIGN KEY (cid) REFERENCES Colleges(cid)
);

CREATE TABLE Double_rooms(
    rid INT NOT NULL,
    position BIT,
    PRIMARY KEY (rid),
    FOREIGN KEY (rid) REFERENCES Rooms(rid)
);

CREATE TABLE Students(
    sid INT NOT NULL AUTO_INCREMENT,
    name CHAR(30),
    mat_num CHAR(8) UNIQUE,
    birthday CHAR(8),
    rid INT,
    rsid INT,
    PRIMARY KEY (sid),
    FOREIGN KEY (rsid) REFERENCES Students (sid),
    FOREIGN KEY (rid) REFERENCES Rooms(rid)
);

CREATE TABLE Students_with_special_need(
    sickness CHAR(12),
    special_need CHAR(30),
    sid INT NOT NULL,
    PRIMARY KEY (sid),
    FOREIGN KEY (sid) REFERENCES Students(sid)
);



CREATE TABLE Managers(
    mgid INT NOT NULL AUTO_INCREMENT,
    name CHAR(30) UNIQUE,
    age INT,
    contact_num CHAR(12), 
    cid INT,
    PRIMARY KEY (mgid),
    FOREIGN KEY (cid) REFERENCES Colleges(cid)
);


CREATE TABLE RA(
    availability BIT,
    mgid INT NOT NULL,
    PRIMARY KEY (mgid),
    FOREIGN KEY (mgid) REFERENCES Managers(mgid)   
);

CREATE TABLE RM(
    office_hour CHAR(30),
    mgid INT NOT NULL,
    PRIMARY KEY (mgid),
    FOREIGN KEY (mgid) REFERENCES Managers(mgid)
);
