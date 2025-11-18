--Josue Ortiz | 2025-10-19 | IT202-001 | Phase02 Assignment
--jxo@njit.edu 
CREATE TABLE ShirtTypes (
    ShirtTypeID       INT(11)        NOT NULL, 
    ShirtTypeCode     VARCHAR(255)   NOT NULL  UNIQUE,
    ShirtTypeName     VARCHAR(255)   NOT NULL,
    AisleNumber       INT(11)        NOT NULL, 
    DateTimeCreated   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    DateTimeUpdated   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY ( ShirtTypeID )
);

-- Initial INSERT statements for the 3 categories
INSERT INTO ShirtTypes (ShirtTypeID, ShirtTypeCode, ShirtTypeName, AisleNumber)
VALUES (100, 'GRAPHIC', 'Graphic Tees', 1);

INSERT INTO ShirtTypes (ShirtTypeID, ShirtTypeCode, ShirtTypeName, AisleNumber)
VALUES (200, 'COTTON', 'Cotton Tees', 2);

INSERT INTO ShirtTypes (ShirtTypeID, ShirtTypeCode, ShirtTypeName, AisleNumber)
VALUES (300, 'LONGSLV', 'Long Sleeve', 3);

SELECT * FROM ShirtTypes;