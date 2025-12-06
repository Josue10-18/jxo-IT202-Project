<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 4 – Shirt Type Validation
// Email: jxo@njit.edu

require('database.php'); 
require_once('shirttype.php');

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to add a new Shirt Type.</h2>";
    exit();
}

// 2. Input Filtering
$id    = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code  = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name  = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

// 3. Server-Side Validation
$errorMessage = "";

if ($id === false || $id === null || $id <= 0 || $id > 99999) {
    $errorMessage .= "<p>Error: ShirtTypeID must be a valid positive number.</p>";
}

if (strlen($code) < 3 || strlen($code) > 50) {
    $errorMessage .= "<p>Error: ShirtTypeCode must be between 3 and 50 characters.</p>";
}

if (strlen($name) < 3 || strlen($name) > 100) {
    $errorMessage .= "<p>Error: ShirtTypeName must be between 3 and 100 characters.</p>";
}

if ($aisle === false || $aisle === null || $aisle < 1 || $aisle > 99) {
    $errorMessage .= "<p>Error: AisleNumber must be 1–99.</p>";
}

// 4. Show errors EXACTLY like addshirt.inc.php
if ($errorMessage != "") {
    echo "<h2>Error Adding Shirt Type</h2>";
    echo $errorMessage;
    echo "<p><a href='index.php?content=newshirttype'>Go Back</a></p>";
    exit();
}

// 5. If no errors → Save
$newType = new ShirtType($id, $code, $name, $aisle);

if ($newType->save()) {
    echo "<h2>Success! Shirt Type #".htmlspecialchars($id)." added.</h2>";
    echo "<p>Code: ".htmlspecialchars($code)." | Name: ".htmlspecialchars($name)." | Aisle: ".htmlspecialchars($aisle)."</p>";
    echo "<p><a href='index.php?content=listshirttypes'>Return to List</a></p>";
} else {
    echo "<h2>Error: Could not add Shirt Type #".htmlspecialchars($id).". It may already exist.</h2>";
    echo "<p><a href='index.php?content=newshirttype'>Try Again</a></p>";
}
?>
