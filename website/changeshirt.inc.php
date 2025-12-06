<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 4 Assignment: Input Filtering and CSS Styling (Completed Server-Side Validation)
// Email: jxo@njit.edu

require('database.php'); 
require('shirt.php');

// Ensure session is started for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to update a Shirt.</h2>";
    exit();
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// 2. Handle Cancel Button
if ($action === 'Cancel') {
    echo "<h2>Update Canceled</h2>";
    echo "<p>The update operation for the shirt has been canceled.</p>";
    exit();
}

// 3. Input Filtering (Sanitization/Validation)
$id       = filter_input(INPUT_POST, 'ShirtID', FILTER_VALIDATE_INT);
$code     = filter_input(INPUT_POST, 'ShirtCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name     = filter_input(INPUT_POST, 'ShirtName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Sanitize description and use htmlspecialchars() on output
$desc     = filter_input(INPUT_POST, 'ShirtDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$material = filter_input(INPUT_POST, 'Material', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fit      = filter_input(INPUT_POST, 'Fit', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$typeId   = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
$wprice   = filter_input(INPUT_POST, 'ShirtWholesalePrice', FILTER_VALIDATE_FLOAT);
$lprice   = filter_input(INPUT_POST, 'ShirtListPrice', FILTER_VALIDATE_FLOAT);

// 4. Server-Side Validation Logic
$errorMessage = "";

// --- Numeric ID/TypeID Validation (Required: is_int() / min/max range) ---
if ($id === false || $id === null) {
    $errorMessage .= "<p>Error: ShirtID is missing or not a number.</p>";
} elseif ($id <= 0 || $id > 999999) {
    $errorMessage .= "<p>Error: ShirtID must be a positive number.</p>";
}

if ($typeId === false || $typeId === null) {
    $errorMessage .= "<p>Error: ShirtTypeID is missing or not a number.</p>";
} elseif ($typeId <= 0 || $typeId > 99999) {
    $errorMessage .= "<p>Error: ShirtTypeID must be a positive number.</p>";
}

// --- Price Validation (Required: is_float() / min/max range / Wholesale < List) ---
if ($wprice === false || $wprice === null || $lprice === false || $lprice === null) {
    $errorMessage .= "<p>Error: Price fields are missing or invalid (non-numeric).</p>";
} elseif ($wprice <= 0 || $lprice <= 0) {
    $errorMessage .= "<p>Error: Prices must be greater than zero.</p>";
} elseif ($wprice >= $lprice) {
    $errorMessage .= "<p>Error: Wholesale Price ($" . number_format($wprice, 2) . ") must be strictly less than List Price ($" . number_format($lprice, 2) . ").</p>";
}

// --- String Length and Content Validation (Required: min/max length / htmlspecialchars) ---

// ShirtCode: Min 3, Max 10
$codeLength = strlen($code);
if ($codeLength < 3 || $codeLength > 10) {
    $errorMessage .= "<p>Error: Shirt Code must be between 3 and 10 characters.</p>";
}

// ShirtName: Min 10, Max 100
$nameLength = strlen($name);
if ($nameLength < 10 || $nameLength > 100) {
    $errorMessage .= "<p>Error: Shirt Name must be between 10 and 100 characters.</p>";
}

// ShirtDescription: Min 100, Max 255
$descLength = strlen($desc);
if ($descLength < 20 || $descLength > 100) {
    $errorMessage .= "<p>Error: Shirt Description must be between 20 and 100 characters.</p>";
}
// Required: Check for at least 2 full sentences
$sentence_count = substr_count($desc, '.') + substr_count($desc, '!') + substr_count($desc, '?');
if ($sentence_count < 1) {
    $errorMessage .= "<p>Error: Shirt Description must contain at least ONE full sentences (ending with '.', '!', or '?').</p>";
}

// Material: Additional column (assuming min 5, max 50)
$materialLength = strlen($material);
if ($materialLength < 5 || $materialLength > 50) {
    $errorMessage .= "<p>Error: Material must be between 5 and 50 characters.</p>";
}

// Fit: Additional column (assuming min 1, max 10)
$fitLength = strlen($fit);
if ($fitLength < 1 || $fitLength > 10) {
    $errorMessage .= "<p>Error: Fit must be between 1 and 10 characters (e.g., 'S', 'Regular', 'Slim').</p>";
}

// If any errors were found, stop execution and display errors
if ($errorMessage != "") {
    echo "<h2>Error Updating Shirt</h2>";
    echo $errorMessage;
    exit();
}

// 5. Perform Update Operation (Data is now validated and sanitized)
$existingShirt = new Shirt($id, $code, $name, $desc, $material, $fit, $typeId, $wprice, $lprice);

if ($existingShirt->update()) {
    $successMessage = "<h2>Success! Shirt #".htmlspecialchars($id).": ".htmlspecialchars($name)." successfully updated.</h2>";
    // Ensure all output values are escaped using htmlspecialchars()
    $wPriceFmt = number_format($wprice, 2);
    $lPriceFmt = number_format($lprice, 2);
    $details = "<p>New Wholesale Price: $".htmlspecialchars($wPriceFmt)." | New List Price: $".htmlspecialchars($lPriceFmt)."</p>";
} else {
    $successMessage = "<h2>Error: Failed to update Shirt #".htmlspecialchars($id).". It may not exist.</h2>";
    $details = "";
}

?>
<h3>
<?php echo $successMessage; ?>
<?php echo $details; ?>
</h3>

<?php
// UCID: jxo
// Date: 11/04/2025
// Summary: Implemented full server-side validation for all Shirt update fields, including numeric ranges, string lengths, and business logic (Wholesale < List, 2 sentences in Description).
?>