<?php
require('database.php');
require('shirttype.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to update a Shirt Type.</h2>";
    exit();
}

// Handle Cancel Button EXACTLY like changeshirt.inc.php
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($action === 'Cancel') {
    echo "<h2>Update Canceled</h2>";
    echo "<p>The update operation for the shirt type has been canceled.</p>";
    exit();
}

// Input Filtering
$id     = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$code   = filter_input(INPUT_POST, 'ShirtTypeCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name   = filter_input(INPUT_POST, 'ShirtTypeName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$aisle  = filter_input(INPUT_POST, 'AisleNumber', FILTER_VALIDATE_INT);

// Validation
$errorMessage = "";

// ID validation
if ($id === false || $id === null || $id <= 0) {
    $errorMessage .= "<p>Error: Shirt Type ID is missing or invalid.</p>";
}

// Code validation (3–50 chars)
if ($code === null || strlen(trim($code)) < 3 || strlen(trim($code)) > 50) {
    $errorMessage .= "<p>Error: Shirt Type Code must be between 3 and 50 characters.</p>";
}

// Name validation (3–100 chars)
if ($name === null || strlen(trim($name)) < 3 || strlen(trim($name)) > 100) {
    $errorMessage .= "<p>Error: Shirt Type Name must be between 3 and 100 characters.</p>";
}

// Aisle validation 1–99
if ($aisle === false || $aisle < 1 || $aisle > 99) {
    $errorMessage .= "<p>Error: Aisle Number must be between 1 and 99.</p>";
}

// If errors → match changeshirt.inc.php STYLE
if ($errorMessage !== "") {
    echo "<h2>Error Updating Shirt Type</h2>";
    echo $errorMessage;
    exit();
}

// Perform update
$updatedType = new ShirtType($id, $code, $name, $aisle);

if ($updatedType->update()) {

    $successMessage = "<h2>Success! Shirt Type #"
        . htmlspecialchars($id)
        . " successfully updated.</h2>";

    $details = "<p>New Code: " . htmlspecialchars($code)
        . " | New Name: " . htmlspecialchars($name)
        . " | New Aisle: " . htmlspecialchars($aisle) . "</p>";

} else {
    $successMessage = "<h2>Error: Failed to update Shirt Type #" . htmlspecialchars($id) . ".</h2>";
    $details = "";
}
?>

<h3>
<?php echo $successMessage; ?>
<?php echo $details; ?>
<p><a href="index.php?content=listshirttypes">Back to Shirt Type List</a></p>
</h3>
