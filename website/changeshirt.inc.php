<?php
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

require('database.php'); 
require('shirt.php');

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to update a Shirt.</h2>";
    exit();
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

// 2. Handle Cancel Button
if ($action === 'Cancel') {
    echo "<h2>Update Canceled</h2>";
    echo "<p>The update operation for the shirt has been canceled.</p>";
    exit();
}

// 3. Input Filtering
$id = filter_input(INPUT_POST, 'ShirtID', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'ShirtCode', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'ShirtName', FILTER_SANITIZE_STRING);
$desc = filter_input(INPUT_POST, 'ShirtDescription', FILTER_SANITIZE_STRING);
$material = filter_input(INPUT_POST, 'Material', FILTER_SANITIZE_STRING);
$fit = filter_input(INPUT_POST, 'Fit', FILTER_SANITIZE_STRING);
$typeId = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$wprice = filter_input(INPUT_POST, 'ShirtWholesalePrice', FILTER_VALIDATE_FLOAT);
$lprice = filter_input(INPUT_POST, 'ShirtListPrice', FILTER_VALIDATE_FLOAT);

$errorMessage = "";

if ($id === false || $id === null || $typeId === false || $typeId === null) {
    $errorMessage .= "<p>Error: ShirtID or ShirtTypeID is missing or invalid.</p>";
}
if ($wprice === false || $lprice === false || $wprice === null || $lprice === null) {
    $errorMessage .= "<p>Error: Price fields are missing or invalid (non-numeric).</p>";
} elseif ($wprice >= $lprice) {
    $errorMessage .= "<p>Error: Wholesale Price must be less than List Price.</p>";
}
if ($errorMessage != "") {
    echo "<h2>Error Updating Shirt</h2>";
    echo $errorMessage;
    exit();
}

// 4. Perform Update Operation
$existingShirt = new Shirt($id, $code, $name, $desc, $material, $fit, $typeId, $wprice, $lprice);

if ($existingShirt->update()) {
    $safeName = htmlspecialchars($name);
    $safeCode = htmlspecialchars($code);
    $successMessage = "<h2>Success! Shirt #$id: $safeName ($safeCode) successfully updated.</h2>";
    $wPriceFmt = number_format($wprice, 2);
    $lPriceFmt = number_format($lprice, 2);
    $details = "<p>New Wholesale Price: $$wPriceFmt, New List Price: $$lPriceFmt.</p>";
    $details .= "<p>Code: $safeCode, Material: " . htmlspecialchars($material) . ", Fit: " . htmlspecialchars($fit) . "</p>";
    
    echo $successMessage;
    echo $details;
    echo "<p><a href=\"index.php?content=listshirts\">Go to the Shirt List</a></p>";

} else {
    echo "<h2>Error: Failed to update Shirt #$id. It may not exist.</h2>";
    echo "<p><a href=\"index.php?content=listshirts\">Go to the Shirt List</a></p>";
}
?>