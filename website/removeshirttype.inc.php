<?php
// Name: Josue Ortiz
// Date: 12/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 – Delete Shirt Type
// Email: jxo@njit.edu

require('database.php');
require('shirttype.php');

// Accept ID from GET (because JS buttons use GET)
$id = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);

// Validate ID
if ($id === false || $id === null) {
    echo "<h2>Error: Missing or invalid Shirt Type ID.</h2>";
    exit();
}

// Attempt delete
$removed = ShirtType::remove($id);

// Build redirect URL
$redirectURL = "index.php?content=listshirttypes";

// Output result message briefly before redirect
echo "<h2>" . 
    ($removed 
        ? "Shirt Type #$id was successfully deleted." 
        : "Error: Failed to delete Shirt Type #$id.") 
    . "</h2>";

echo "<p>Redirecting back to Shirt Type List...</p>";

header("refresh: 2; url=$redirectURL");
exit();
?>
