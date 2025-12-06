<?php 
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 Assignment: Remove Shirt
// Email: jxo@njit.edu
require_once("database.php");
require_once("shirt.php");

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in.</h2>";
    exit();
}

// Validate ShirtID
$shirtID = filter_input(INPUT_GET, 'ShirtID', FILTER_VALIDATE_INT);

if ($shirtID === false || $shirtID === null) {
    echo "<h2>Error: Invalid Shirt ID.</h2>";
    exit();
}

// Perform delete
$removed = Shirt::remove($shirtID);

if ($removed) {
    echo "<h2>Shirt #$shirtID deleted successfully.</h2>";
} else {
    echo "<h2>Error: Failed to delete shirt #$shirtID.</h2>";
}

echo "<br><br><a href='index.php?content=listshirts'>Back to Shirt List</a>";
?>
