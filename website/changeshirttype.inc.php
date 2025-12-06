<?php
require('database.php');
require('shirttype.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to update a Shirt Type.</h2>";
    exit();
}

// Input data
$id     = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code   = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name   = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle  = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

$errorMessage = "";

// Validate
if ($id === false || $id === null) {
    $errorMessage .= "<p>Error: Shirt Type ID is missing or invalid.</p>";
}

if ($code === null || strlen(trim($code)) < 1) {
    $errorMessage .= "<p>Error: Code cannot be empty.</p>";
}

if ($name === null || strlen(trim($name)) < 1) {
    $errorMessage .= "<p>Error: Name cannot be empty.</p>";
}

if ($aisle === false || $aisle <= 0) {
    $errorMessage .= "<p>Error: Aisle Number must be a positive number.</p>";
}

// If errors → show them
if ($errorMessage !== "") {
    echo "<h2>Error Updating Shirt Type</h2>";
    echo $errorMessage;
    echo "<p><a href='index.php?content=updateshirttype&ShirtTypeID=$id'>Try Again</a></p>";
    exit();
}

// Update
$updatedType = new ShirtType($id, $code, $name, $aisle);

if ($updatedType->update()) {
    echo "<h2>Success! Shirt Type #$id updated.</h2>";
    echo "<p>New Code: " . htmlspecialchars($code) . "</p>";
    echo "<p>New Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>New Aisle: " . htmlspecialchars($aisle) . "</p>";
    echo "<p><a href='index.php?content=listshirttypes'>Back to Shirt Types</a></p>";
} else {
    echo "<h2>Error: Failed to update Shirt Type #$id.</h2>";
    echo "<p><a href='index.php?content=updateshirttype&ShirtTypeID=$id'>Try Again</a></p>";
}
?>
