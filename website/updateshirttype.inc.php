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

<h2>Update Shirt Type: <?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?> (#<?php echo htmlspecialchars($typeId); ?>)</h2>

<form action="changeshirttype.inc.php" method="POST">
    <table border="1">

        <tr>
            <th><label for="ShirtTypeID">ShirtTypeID:</label></th>
            <td>
                <?php echo htmlspecialchars($typeDetails['ShirtTypeID']); ?>
                <input type="hidden" name="ShirtTypeID"
                       value="<?php echo htmlspecialchars($typeDetails['ShirtTypeID']); ?>">
            </td>
        </tr>

        <tr>
            <th><label for="ShirtTypeCode">ShirtTypeCode:</label></th>
            <td>
                <input type="text" id="ShirtTypeCode" name="ShirtTypeCode"
                       minlength="3" maxlength="50" required
                       value="<?php echo htmlspecialchars($typeDetails['ShirtTypeCode']); ?>">
            </td>
        </tr>

        <tr>
            <th><label for="ShirtTypeName">ShirtTypeName:</label></th>
            <td>
                <input type="text" id="ShirtTypeName" name="ShirtTypeName"
                       minlength="3" maxlength="100" required
                       value="<?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?>">
            </td>
        </tr>

        <tr>
            <th><label for="AisleNumber">AisleNumber:</label></th>
            <td>
                <input type="number" id="AisleNumber" name="AisleNumber"
                       min="1" max="99" required
                       value="<?php echo htmlspecialchars($typeDetails['AisleNumber']); ?>">
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" name="action" value="Cancel" formnovalidate>
                <input type="submit" name="action" value="Update Item">
            </td>
        </tr>

    </table>
</form>
