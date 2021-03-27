-- TABLE
CREATE TABLE Users (
    id INT AUTO_INCREMENT,
    userName VARCHAR(50) NOT NULL UNIQUE,
    userPwd VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


INSERT INTO Users (userName, userPwd) VALUE ('group19', 'test12345');
INSERT INTO Users (userName, userPwd) VALUE ('TA', 'otmanesabir');
-- INDEX
 
-- TRIGGER
 
-- VIEW
 
