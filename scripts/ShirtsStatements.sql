--Josue Ortiz | 2025-10-19 | IT202-001 | Phase02 Assignment
--jxo@njit.edu 

CREATE TABLE Shirts (
    ShirtID                 INT(11)        NOT NULL,
    ShirtCode               VARCHAR(10)    NOT NULL UNIQUE,
    ShirtName               VARCHAR(255)   NOT NULL,
    ShirtDescription        TEXT           NOT NULL,
    Material                VARCHAR(255)   NOT NULL,
    Fit                     VARCHAR(10)    NOT NULL, 
    ShirtTypeID             INT(11)        NOT NULL,
    ShirtWholesalePrice     DECIMAL(10,2)  NOT NULL,
    ShirtListPrice          DECIMAL(10,2)  NOT NULL,
    DateTimeCreated         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    DateTimeUpdated         TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY ( ShirtID ),
    FOREIGN KEY (ShirtTypeID) REFERENCES ShirtTypes(ShirtTypeID)
);

-- Insert example item data
INSERT INTO Shirts (ShirtID, ShirtCode, ShirtName, ShirtDescription, Material, Fit, ShirtTypeID, ShirtWholesalePrice, ShirtListPrice)
VALUES (1000, 'GOD', 'JESUS IS THE TRUTH', 'A classic black t-shirt a cross design. This shirt is comfortable for all-day wear and highly durable.', 'Cotton Blend', 'L', 100, 12.50, 24.99);

INSERT INTO Shirts (ShirtID, ShirtCode, ShirtName, ShirtDescription, Material, Fit, ShirtTypeID, ShirtWholesalePrice, ShirtListPrice)
VALUES (2000, 'CROWN', 'BLUE LONG SLEEVE', 'A heavy-weight, deep navy blue long sleeve shirt. Perfect for layering during cooler months, its reinforced stitching ensures longevity.', 'Heavy Cotton', 'XL', 300, 15.00, 29.99);

INSERT INTO Shirts (ShirtID, ShirtCode, ShirtName, ShirtDescription, Material, Fit, ShirtTypeID, ShirtWholesalePrice, ShirtListPrice)
VALUES (3000, 'CAR', 'GRAPHIC LONG SLEVE', 'A graphic design long sleeve. The knit fabric provides style and comfort.', 'Polyester Blend', 'Slim', 300, 12.00, 28.99);

SELECT * FROM Shirts;