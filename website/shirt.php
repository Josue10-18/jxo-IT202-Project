<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 Assignment: Shirt Class
// Email: jxo@njit.edu

class Shirt {
    public $ShirtID;
    public $ShirtCode;
    public $ShirtName;
    public $ShirtDescription;
    public $Material;     
    public $Fit;             
    public $ShirtTypeID;
    public $ShirtWholesalePrice;
    public $ShirtListPrice;
    public $DateTimeCreated;
    public $DateTimeUpdated;

    public function __construct(
        $id, $code, $name, $desc, $material, $fit, $typeId, $wholesalePrice, $listPrice
    ) {
        $this->ShirtID = $id;
        $this->ShirtCode = $code;
        $this->ShirtName = $name;
        $this->ShirtDescription = $desc;
        $this->Material = $material;
        $this->Fit = $fit;
        $this->ShirtTypeID = $typeId;
        $this->ShirtWholesalePrice = $wholesalePrice;
        $this->ShirtListPrice = $listPrice;
    }

    public function save() {
        global $db; 

        $query = 'INSERT INTO Shirts 
                    (ShirtID, ShirtCode, ShirtName, ShirtDescription, Material, Fit, ShirtTypeID, ShirtWholesalePrice, ShirtListPrice)
                  VALUES 
                    (:id, :code, :name, :desc, :material, :fit, :typeId, :wprice, :lprice)';

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $this->ShirtID);
        $statement->bindValue(':code', $this->ShirtCode);
        $statement->bindValue(':name', $this->ShirtName);
        $statement->bindValue(':desc', $this->ShirtDescription);
        $statement->bindValue(':material', $this->Material);
        $statement->bindValue(':fit', $this->Fit);
        $statement->bindValue(':typeId', $this->ShirtTypeID);
        $statement->bindValue(':wprice', $this->ShirtWholesalePrice);
        $statement->bindValue(':lprice', $this->ShirtListPrice);

        return $statement->execute(); 
    }

    public static function getAll() {
        global $db;

        $query = 'SELECT * FROM Shirts ORDER BY ShirtID';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }

    public function update() {
        global $db;

        $query = 'UPDATE Shirts
                  SET ShirtCode = :code,
                      ShirtName = :name,
                      ShirtDescription = :desc,
                      Material = :material,
                      Fit = :fit,
                      ShirtTypeID = :typeId,
                      ShirtWholesalePrice = :wprice,
                      ShirtListPrice = :lprice
                  WHERE ShirtID = :id';

        $statement = $db->prepare($query);
        $statement->bindValue(':code', $this->ShirtCode);
        $statement->bindValue(':name', $this->ShirtName);
        $statement->bindValue(':desc', $this->ShirtDescription);
        $statement->bindValue(':material', $this->Material);
        $statement->bindValue(':fit', $this->Fit);
        $statement->bindValue(':typeId', $this->ShirtTypeID);
        $statement->bindValue(':wprice', $this->ShirtWholesalePrice);
        $statement->bindValue(':lprice', $this->ShirtListPrice);
        $statement->bindValue(':id', $this->ShirtID);

        return $statement->execute();
    }

    public static function remove($id) {
        global $db;

        $query = 'DELETE FROM Shirts WHERE ShirtID = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);

        return $statement->execute();
 
 
    }
public static function getByTypeID($typeId) {
    global $db;

    $query = 'SELECT * FROM Shirts WHERE ShirtTypeID = :typeId ORDER BY ShirtName';
    $statement = $db->prepare($query);
    $statement->bindValue(':typeId', $typeId);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $results;
}

public static function getByID($id) {
    global $db;

    $query = 'SELECT * FROM Shirts WHERE ShirtID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}
/* ==========================
   PHASE 5 – UNIT 12 METHODS UCID:jxo, IT202-001, Internet Applications 12/3/2025
   ========================== */
public static function getTotalItems() {
    global $db;

    $query = "SELECT COUNT(ShirtID) AS total FROM Shirts";
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($row && isset($row['total'])) {
        return (int)$row['total'];
    } else {
        return 0;
    }
}

public static function getTotalListPrice() {
    global $db;

    // SUM returns NULL if table is empty, so use IFNULL()
    $query = "SELECT IFNULL(SUM(ShirtListPrice), 0) AS total FROM Shirts";
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($row && isset($row['total'])) {
        return (float)$row['total'];
    } else {
        return 0.0;
    }
}
public static function getTotalWholesalePrice() {
    global $db;

    // SUM returns NULL when table is empty, so wrap with IFNULL()
    $query = "SELECT IFNULL(SUM(ShirtWholesalePrice), 0) AS total FROM Shirts";
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($row && isset($row['total'])) {
        return (float)$row['total'];
    } else {
        return 0.0;
    }
}

}
?>
