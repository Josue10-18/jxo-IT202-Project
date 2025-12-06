<?php
// Name: Josue Ortiz
// Date: 12/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 – Delete Shirt Type
// Email: jxo@njit.edu

require('database.php');
require('shirttype.php');

// Get ID
$id = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);

// Validate ID
if ($id === false || $id === null) {
    $message = "<h2>Error: Missing or invalid Shirt Type ID.</h2>";
    $details = "<p><a href='index.php?content=listshirttypes'>Return to Shirt Type List</a></p>";
    $boxClass = "error-box";

    include("type_message_box.inc.php");
    exit();
}

// Attempt delete
$removed = ShirtType::remove($id);

// Success or Failure
if ($removed) {
    $message = "<h2>Shirt Type #" . htmlspecialchars($id) . " successfully deleted.</h2>";
    $details = "<p><a href='index.php?content=listshirttypes'>Back to Shirt Types</a></p>";
    $boxClass = "success-box";
} else {
    $message = "<h2>Error: Could not delete Shirt Type #" . htmlspecialchars($id) . ".</h2>";
    $details = "<p><a href='index.php?content=listshirttypes'>Return to Shirt Types</a></p>";
    $boxClass = "error-box";
}

// Load the styled box template
include("type_message_box.inc.php");
?>
