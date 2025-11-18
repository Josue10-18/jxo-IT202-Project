--Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
--jxo@njit.edu 
CREATE TABLE ShirtsManagers (
 ShirtsManagerID  INT(11)        NOT NULL   AUTO_INCREMENT,
 emailAddress        VARCHAR(255)   NOT NULL   UNIQUE,
 password            VARCHAR(64)    NOT NULL,
 pronouns            VARCHAR(60)    NOT NULL,
 firstName           VARCHAR(60)    NOT NULL,
 lastName            VARCHAR(60)    NOT NULL,
 DateTimeCreated     DATETIME DEFAULT CURRENT_TIMESTAMP,
 DateTimeUpdated     DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (ShirtsManagerID)
);
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@tshirts.com', SHA2('Josue123', 256), 'He/Him', 'Josue', 'Ortiz');
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@graphictees.com', SHA2('Juan123', 256), 'He/Him', 'Juan', 'D Placencio');
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@washedtees.com', SHA2('Ceasar123', 256), 'He/Him', 'Ceasar', 'Flores');
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@manager.com', SHA2('FZD10', 256), 'He/Him', 'Joshua', 'Carchi');