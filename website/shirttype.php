<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

class ShirtType {
    public $ShirtTypeID;
    public $ShirtTypeCode;
    public $ShirtTypeName;
    public $AisleNumber;
    public $DateTimeCreated;
    public $DateTimeUpdated;

    public function __construct($id, $code, $name, $aisle) {
        $this->ShirtTypeID = $id;
        $this->ShirtTypeCode = $code;
        $this->ShirtTypeName = $name;
        $this->AisleNumber = $aisle;
    }


    public function save() {
        global $db; 

        $query = 'INSERT INTO ShirtTypes 
                    (ShirtTypeID, ShirtTypeCode, ShirtTypeName, AisleNumber)
                  VALUES 
                    (:id, :code, :name, :aisle)';

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $this->ShirtTypeID);
        $statement->bindValue(':code', $this->ShirtTypeCode);
        $statement->bindValue(':name', $this->ShirtTypeName);
        $statement->bindValue(':aisle', $this->AisleNumber);

        return $statement->execute(); 
    }

    public static function getAll() {
        global $db;

        $query = 'SELECT * FROM ShirtTypes ORDER BY ShirtTypeID';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }

    public function update() {
        global $db;

        $query = 'UPDATE ShirtTypes
                  SET ShirtTypeCode = :code,
                      ShirtTypeName = :name,
                      AisleNumber = :aisle
                  WHERE ShirtTypeID = :id';

        $statement = $db->prepare($query);
        $statement->bindValue(':code', $this->ShirtTypeCode);
        $statement->bindValue(':name', $this->ShirtTypeName);
        $statement->bindValue(':aisle', $this->AisleNumber);
        $statement->bindValue(':id', $this->ShirtTypeID);

        return $statement->execute();
    }

    public static function remove($id) {
        global $db;

        $query = 'DELETE FROM ShirtTypes WHERE ShirtTypeID = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }
}
?>