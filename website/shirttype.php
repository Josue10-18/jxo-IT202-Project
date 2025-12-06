<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

/**
 * Class ShirtType
 * Simple Active Record style wrapper for the ShirtTypes table.
 * Database access uses the global `$db` PDO instance from `database.php`.
 */
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
        /** @var PDO $db */
        global $db;

        try {
            // If ShirtTypeID is null, assume the table uses AUTO_INCREMENT
            if ($this->ShirtTypeID === null) {
                $query = 'INSERT INTO ShirtTypes (ShirtTypeCode, ShirtTypeName, AisleNumber) VALUES (:code, :name, :aisle)';
                $statement = $db->prepare($query);
                $statement->bindValue(':code', $this->ShirtTypeCode);
                $statement->bindValue(':name', $this->ShirtTypeName);
                $statement->bindValue(':aisle', $this->AisleNumber);
                $success = $statement->execute();
                $statement->closeCursor();
                if ($success) {
                    // Set the generated ID on this object and return it
                    $this->ShirtTypeID = (int)$db->lastInsertId();
                    return $this->ShirtTypeID;
                }
                return false;
            }

            // Otherwise insert with the provided ID
            $query = 'INSERT INTO ShirtTypes 
                        (ShirtTypeID, ShirtTypeCode, ShirtTypeName, AisleNumber)
                      VALUES 
                        (:id, :code, :name, :aisle)';

            $statement = $db->prepare($query);
            $statement->bindValue(':id', $this->ShirtTypeID);
            $statement->bindValue(':code', $this->ShirtTypeCode);
            $statement->bindValue(':name', $this->ShirtTypeName);
            $statement->bindValue(':aisle', $this->AisleNumber);

            $success = $statement->execute();
            $statement->closeCursor();
            return $success;
        } catch (PDOException $e) {
            // You may want to log $e->getMessage() in real applications
            return false;
        }
    }
    public static function getAll() {
        /** @var PDO $db */
        global $db;

        $query = 'SELECT * FROM ShirtTypes ORDER BY ShirtTypeID';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }
    public static function getByID($id) {
        /** @var PDO $db */
        global $db;

        $query = 'SELECT * FROM ShirtTypes WHERE ShirtTypeID = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    }
    public function update() {
        /** @var PDO $db */
        global $db;

        try {
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

            $success = $statement->execute();
            $statement->closeCursor();
            return $success;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function remove($id) {
        /** @var PDO $db */
        global $db;

        try {
            $query = 'DELETE FROM ShirtTypes WHERE ShirtTypeID = :id';
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $success = $statement->execute();
            $statement->closeCursor();
            return $success;
        } catch (PDOException $e) {
            return false;
        }
    }

/* PHASE 5 – UNIT 12 FUNCTION UCID:jxo, IT202-001, Internet Applications 12/3/2025 */
public static function getTotalCategories() {
    /** @var PDO $db */
    global $db;

    $query = "SELECT COUNT(ShirtTypeID) AS total FROM ShirtTypes";
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

} 
?>

