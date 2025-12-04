<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

require('database.php'); 
require('shirttype.php');

$id = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

if ($id === false || $code === null || $name === null || $aisle === false) {
    echo "<h2>Error: Missing or invalid input data.</h2>";
    exit();
}

$existingShirtType = new ShirtType($id, $code, $name, $aisle);
if ($existingShirtType->update()) {
    $successMessage = "<h2>Category #$id successfully updated!</h2>";
    $details = "<h2>New Code: $code, New Name: $name, New Aisle: $aisle</h2>";
} else {
    $successMessage = "<h2>Error: Failed to update Category #$id. It may not exist.</h2>";
    $details = "";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Shirt Type Test</title>
</head>
<body>
    <h1>Change Shirt Type Result</h1>
    <?php echo $successMessage; ?>
    <?php echo $details; ?>
</body>
</html>