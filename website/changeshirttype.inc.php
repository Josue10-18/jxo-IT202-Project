<?php
// Name: Josue Ortiz
// Date: 12/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 – Update Shirt Type Processing
// Email: jxo@njit.edu

require('database.php'); 
require('shirttype.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security – must be logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $message = "<h2>Access Denied! You must be logged in.</h2>";
    $details = "<p><a href='index.php'>Return Home</a></p>";
    $boxClass = "error-box";

    include("type_message_box.inc.php");
    exit();
}

// Get POST values
$id     = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code   = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name   = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle  = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

$errorMessage = "";

// Server-side validation (to match front-end)
if ($id === false || $id === null) {
    $errorMessage .= "<p>Error: Missing or invalid Shirt Type ID.</p>";
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

// If validation errors → display them styled
if ($errorMessage !== "") {
    $message = "<h2>Error Updating Shirt Type</h2>" . $errorMessage;
    $details = "<p><a href='index.php?content=updateshirttype&ShirtTypeID=$id'>Try Again</a></p>";
    $boxClass = "error-box";

    include("type_message_box.inc.php");
    exit();
}

// Passed validation → perform update
$updatedType = new ShirtType($id, $code, $name, $aisle);

if ($updatedType->update()) {
    $message = "<h2>Shirt Type #$id Updated Successfully!</h2>";
    $details = "<p>New Code: " . htmlspecialchars($code) . "<br>
                New Name: " . htmlspecialchars($name) . "<br>
                New Aisle: " . htmlspecialchars($aisle) . "</p>
                <p><a href='index.php?content=listshirttypes'>Back to Shirt Types</a></p>";
    $boxClass = "success-box";
} else {
    $message = "<h2>Error: Failed to update Shirt Type #$id.</h2>";
    $details = "<p><a href='index.php?content=updateshirttype&ShirtTypeID=$id'>Try Again</a></p>";
    $boxClass = "error-box";
}

// Load styled message box
include("type_message_box.inc.php");
?>
