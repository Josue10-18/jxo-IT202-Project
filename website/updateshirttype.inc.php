<?php
// Name: Josue Ortiz
// Date: 11/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 – Update Shirt Type Form
// Email: jxo@njit.edu

require_once('database.php');
require_once('shirttype.php');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in.</h2>";
    exit();
}

// Get ShirtTypeID
$typeId = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);
if ($typeId === false || $typeId === null) {
    echo "<h2>Error: Missing or invalid Shirt Type ID.</h2>";
    exit();
}

// Fetch Shirt Type
$typeDetails = ShirtType::getByID($typeId);
if (!$typeDetails) {
    echo "<h2>Error: Shirt Type with ID #$typeId not found.</h2>";
    exit();
}
?>

<h2>Update Shirt Type: <?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?></h2>

<form id="updateTypeForm" method="post" action="changeshirttype.inc.php">

    <input type="hidden" name="ShirtTypeID" 
           value="<?php echo htmlspecialchars($typeDetails['ShirtTypeID']); ?>">

    <table>
        <tr>
            <th><label for="ShirtTypeCode">Code:</label></th>
            <td>
                <input type="text" id="ShirtTypeCode" name="ShirtTypeCode"
                       value="<?php echo htmlspecialchars($typeDetails['ShirtTypeCode']); ?>" required>
            </td>
        </tr>

        <tr>
            <th><label for="ShirtTypeName">Name:</label></th>
            <td>
                <input type="text" id="ShirtTypeName" name="ShirtTypeName"
                       value="<?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?>" required>
            </td>
        </tr>

        <tr>
            <th><label for="AisleNumber">Aisle Number:</label></th>
            <td>
                <input type="number" id="AisleNumber" name="AisleNumber"
                       value="<?php echo htmlspecialchars($typeDetails['AisleNumber']); ?>" required min="1" max="99">
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center;">
                <button type="submit">Update Shirt Type</button>
                <button type="button" onclick="window.history.back();">Cancel</button>
            </td>
        </tr>
    </table>

</form>

<script>
// Phase 5 JavaScript Validation

document.getElementById("ShirtTypeCode").focus();

document.getElementById("updateTypeForm").onsubmit = function(event) {

    let code = document.getElementById("ShirtTypeCode").value.trim();
    let name = document.getElementById("ShirtTypeName").value.trim();
    let aisle = document.getElementById("AisleNumber").value.trim();

    if (code.length === 0) {
        alert("Code cannot be empty.");
        document.getElementById("ShirtTypeCode").focus();
        event.preventDefault();
        return false;
    }

    if (name.length === 0) {
        alert("Name cannot be empty.");
        document.getElementById("ShirtTypeName").focus();
        event.preventDefault();
        return false;
    }

    if (aisle === "" || isNaN(aisle) || aisle <= 0) {
        alert("Aisle Number must be a positive number.");
        document.getElementById("AisleNumber").focus();
        event.preventDefault();
        return false;
    }

    return true;
};
</script>

