<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 

$host = 'sql1.njit.edu'; 
$user = 'jxo'; 
$pass = 'Xavier#2090!!';
$db = 'jxo'; 
$port = 3306; // Added missing $port definition

// Data Source Name (DSN) for PDO
$dsn = "mysql:host=$host;dbname=$db;port=$port";

try {
    // Using PDO to match your shirt.php and shirttype.php classes
    $conn = new PDO($dsn, $user, $pass);
    
    // Set PDO attributes for error reporting and fetching style
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If connection fails (likely due to network), output the error
    die("Connection failed: " . $e->getMessage());
}

$db = $conn;
?>