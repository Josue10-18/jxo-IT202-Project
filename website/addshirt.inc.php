<?php
// Name: Josue Ortiz
// Date: 10/31/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

require('database.php'); 
require('shirt.php');

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to add a new Shirt.</h2>";
    exit();
}

// 2. Input Filtering
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
// Phase 4: Explicit Data Type Validation Checks
if (!is_int($id) || !is_int($typeId)) {
    $errorMessage .= "<p>Error: ShirtID and ShirtTypeID must be valid integers.</p>";
}
if (!is_float($wprice) || !is_float($lprice)) {
    $errorMessage .= "<p>Error: Wholesale and List Prices must be valid floating point numbers.</p>";
}

if ($id === false || $id === null || $typeId === false || $typeId === null) {
    $errorMessage .= "<p>Error: ShirtID or ShirtTypeID is missing or invalid.</p>";
}
if ($wprice === false || $lprice === false || $wprice === null || $lprice === null) {
    $errorMessage .= "<p>Error: Price fields are missing or invalid (non-numeric).</p>";
} elseif ($wprice >= $lprice) {
    $errorMessage .= "<p>Error: Wholesale Price must be less than List Price.</p>";
}
if (empty($code) || empty($name) || empty($desc) || empty($material) || empty($fit)) {
    $errorMessage .= "<p>Error: Missing one or more required text fields.</p>";
}
// Simple check for description sentence length (as required by prompt)
if (substr_count($desc, '.') < 2 && substr_count($desc, '!') < 2 && substr_count($desc, '?') < 2) {
    $errorMessage .= "<p>Error: Shirt Description must contain at least 2 full sentences.</p>";
}


if ($errorMessage != "") {
    echo "<h2>Error Adding New Shirt</h2>";
    echo $errorMessage;
    exit();
}

// 3. Perform Save Operation
$newShirt = new Shirt($id, $code, $name, $desc, $material, $fit, $typeId, $wprice, $lprice);
if ($newShirt->save()) {
    $safeName = htmlspecialchars($name);
    $safeCode = htmlspecialchars($code);
    $successMessage = "<h2>Success! New Shirt #$id: $safeName ($safeCode) successfully added.</h2>";
    $wPriceFmt = number_format($wprice, 2);
    $lPriceFmt = number_format($lprice, 2);
    $details = "<p>Wholesale Price: $$wPriceFmt, List Price: $$lPriceFmt.</p>";
    $details .= "<p>Material: " . htmlspecialchars($material) . ", Fit: " . htmlspecialchars($fit) . "</p>";

    echo $successMessage;
    echo $details;
    echo "<p><a href=\"index.php?content=listshirts\">Go to the Shirt List</a></p>";

} else {
    echo "<h2>Error: Failed to add New Shirt #$id. It may already exist (check ID and Code).</h2>";
    echo "<p><a href=\"index.php?content=listshirts\">Go to the Shirt List</a></p>";
}
?>