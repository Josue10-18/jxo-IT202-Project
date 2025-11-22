<?php
// Name: [Josue Ortiz]
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

require('database.php'); 
require('shirttype.php');

//login 
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to add a new Shirt Type.</h2>";
    exit();
}

$id = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_STRING);
$aisle = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT); 

// Phase 4: Explicit Data Type Validation
if (!is_int($id) || !is_int($aisle)) {
    echo "<h2>Error: ShirtTypeID and AisleNumber must be valid integers.</h2>";
    exit();
}

if ($id === false || $code === null || $name === null || $aisle === false) {
    echo "<h2>Error: Missing or invalid input data.</h2>";
    exit();
}

$newShirtType = new ShirtType($id, $code, $name, $aisle);
if ($newShirtType->save()) {
    $safeCode = htmlspecialchars($code);
    $safeName = htmlspecialchars($name);
    $successMessage = "<h2>New Category #$id successfully added!</h2>";
    // Used <p> instead of <h2> for details to reduce large font size
    $details = "<p><strong>Category Number:</strong> $id</p><p><strong>Code:</strong> $safeCode, <strong>Name:</strong> $safeName, <strong>Aisle:</strong> $aisle</p>";
} else {
    // This is the error message you were likely receiving
    $successMessage = "<h2>Error: Failed to add Category #$id. It may already exist.</h2>";
    $details = "";
}

// Determine the color for the box based on success or failure
$isSuccess = strpos($successMessage, 'Error') === false;
$boxColor = $isSuccess ? '#2ECC71' : '#E74C3C'; // Green for success, Red for error
?>

<div style="text-align: center; border: 1px solid <?php echo $boxColor; ?>; padding: 10px; margin: 20px 0;">
    <?php echo $successMessage; ?>
    <?php echo $details; ?>
</div>

<p style="text-align: center;">
    <a href="index.php?content=newshirttype">Add another Shirt Type</a> |
    <a href="index.php?content=listshirttypes">View All Shirt Types</a>
</p>