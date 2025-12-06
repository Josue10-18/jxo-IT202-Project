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
    echo "<h2>Access Denied! You must be logged in to add a Shirt Type.</h2>";
    exit();
}

// 2. Input Filtering
$id    = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code  = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name  = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

// 3. Validation
$errorMessage = "";

if ($id === false || $id === null || $id < 100 || $id > 99999) {
    $errorMessage .= "<p>Error: ShirtTypeID must be between 100 and 99999.</p>";
}

if (strlen($code) < 3 || strlen($code) > 50) {
    $errorMessage .= "<p>Error: ShirtTypeCode must be between 3 and 50 characters.</p>";
}

if (strlen($name) < 3 || strlen($name) > 100) {
    $errorMessage .= "<p>Error: ShirtTypeName must be between 3 and 100 characters.</p>";
}

if ($aisle === false || $aisle === null || $aisle < 1 || $aisle > 99) {
    $errorMessage .= "<p>Error: AisleNumber must be between 1 and 99.</p>";
}

// 4. Show Styled Error Box (matches Shirt errors)
if ($errorMessage != "") {
    echo "<div style='border:2px solid #E74C3C; background:#FDEDEC; padding:20px; max-width:600px; margin:auto;'>";
    echo "<h2 style='color:#E74C3C;'>Error Adding Shirt Type</h2>";
    echo $errorMessage;
    echo "<p><a href='index.php?content=newshirttype' style='color:#E74C3C;'>Go Back</a></p>";
    echo "</div>";
    exit();
}

// 5. Save Shirt Type
$newType = new ShirtType($id, $code, $name, $aisle);

if ($newType->save()) {

    echo "<div style='border:2px solid #2ECC71; background:#E9F7EF; padding:20px; max-width:600px; margin:auto;'>";
    echo "<h2 style='color:#2ECC71;'>Success! Shirt Type #".htmlspecialchars($id)." Added.</h2>";
    echo "<p>Code: ".htmlspecialchars($code)."<br>
          Name: ".htmlspecialchars($name)."<br>
          Aisle: ".htmlspecialchars($aisle)."</p>";
    echo "<p><a href='index.php?content=listshirttypes' style='color:#2ECC71;'>Back to Shirt Types</a></p>";
    echo "</div>";

} else {

    echo "<div style='border:2px solid #E74C3C; background:#FDEDEC; padding:20px; max-width:600px; margin:auto;'>";
    echo "<h2 style='color:#E74C3C;'>Error: Shirt Type #".htmlspecialchars($id)." could not be added.</h2>";
    echo "<p><a href='index.php?content=newshirttype' style='color:#E74C3C;'>Try Again</a></p>";
    echo "</div>";

}
?>
