<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
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
    $details = "<h2>Category Number: $id</h2><h2>Code: $safeCode, Name: $safeName, Aisle: $aisle</h2>";
} else {
    $successMessage = "<h2>Error: Failed to add Category #$id. It may already exist.</h2>";
    $details = "";
}
?>
<h3>
<?php echo $successMessage; ?>
<?php echo $details; ?>
<p><a href="index.php?content=listshirttypes">Go to the Shirt Types List</a></p>
</h3>