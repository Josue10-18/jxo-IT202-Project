CREATE TABLE jxo.ShirtsManagers (
 ShirtsManagerID  INT(11)        NOT NULL   AUTO_INCREMENT,
 emailAddress        VARCHAR(255)   NOT NULL   UNIQUE,
 password            VARCHAR(64)    NOT NULL,
 pronouns            VARCHAR(60)    NOT NULL,
 firstName           VARCHAR(60)    NOT NULL,
 lastName            VARCHAR(60)    NOT NULL,
 DateTimeCreated     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 DateTimeUpdated     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (ShirtsManagerID)
);
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@tshirts.com', SHA2('Xavier#2090', 256), 'He/Him', 'Josue', 'Ortiz');
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@graphictees.com', SHA2('Juan#2090', 256), 'He/Him', 'Juan', 'D Placencio');
INSERT INTO ShirtsManagers
(emailAddress, password, pronouns, firstName, lastName)
VALUES
('josue@washedtees.com', SHA2('Ceasar#2090', 256), 'He/Him', 'Ceasar', 'Flores');