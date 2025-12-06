<?php
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 Assignment: Remove Shirt Type
// Email: jxo@njit.edu
require_once("database.php");
require_once("shirttype.php");

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in.</h2>";
    exit();
}

// Validate ShirtTypeID
$id = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    echo "<h2>Error: Invalid Shirt Type ID.</h2>";
    echo "<br><br><a href='index.php?content=listshirttypes'>Back to Shirt Type List</a>";
    exit();
}

// Perform delete
$removed = ShirtType::remove($id);

if ($removed) {
    echo "<h2>Shirt Type #$id deleted successfully.</h2>";
} else {
    echo "<h2>Error: Failed to delete Shirt Type #$id.</h2>";
}

echo "<br><br><a href='index.php?content=listshirttypes'>Back to Shirt Type List</a>";
?>
