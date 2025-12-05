<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

require('database.php'); 
require('shirt.php'); 
require('shirttype.php'); 

// Ensure session is started for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to update a Shirt.</h2>";
    exit();
}

// Get the ShirtID from the search form in nav.inc.php
// Accept ShirtID from POST (normal form) or GET (JavaScript button)
$shirtId = filter_input(INPUT_POST, 'ShirtID', FILTER_VALIDATE_INT);
if ($shirtId === null) {
    $shirtId = filter_input(INPUT_GET, 'ShirtID', FILTER_VALIDATE_INT);
}

// Validation for search input
if ($shirtId === false || $shirtId === null) {
    echo "<h2>Error: Missing or invalid Shirt ID (non-numeric).</h2>";
    exit();
}

$shirt = Shirt::getByID($shirtId);
$shirtTypes = ShirtType::getAll(); 

if (!$shirt) {
    echo "<h2>Error: Shirt with ID #$shirtId was not found.</h2>";
    exit();
}
?>

<h2>Update Shirt: <?php echo htmlspecialchars($shirt['ShirtName']); ?> (#<?php echo htmlspecialchars($shirt['ShirtID']); ?>)</h2>

<form action="index.php" method="POST">
    <input type="hidden" name="content" value="changeshirt">
    <table border="1">
        <tr>
            <th><label for="ShirtID">ShirtID:</label></th>
            <td>
                <?php echo htmlspecialchars($shirt['ShirtID']); ?>
                <input type="hidden" name="ShirtID" value="<?php echo htmlspecialchars($shirt['ShirtID']); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="ShirtCode">ShirtCode:</label></th>
            <td><input type="text" id="ShirtCode" name="ShirtCode" maxlength="10" minlength="3" required
                       value="<?php echo htmlspecialchars($shirt['ShirtCode']); ?>"></td>
        </tr>
        <tr>
            <th><label for="ShirtName">ShirtName:</label></th>
            <td><input type="text" id="ShirtName" name="ShirtName" maxlength="255" minlength="3" required
                       value="<?php echo htmlspecialchars($shirt['ShirtName']); ?>"></td>
        </tr>
        <tr>
            <th><label for="ShirtDescription">ShirtDescription (Min 2 sentences):</label></th>
            <td><textarea id="ShirtDescription" name="ShirtDescription" rows="3" required><?php echo htmlspecialchars($shirt['ShirtDescription']); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="Material">Material:</label></th>
            <td><input type="text" id="Material" name="Material" maxlength="255" minlength="3" required
                       value="<?php echo htmlspecialchars($shirt['Material']); ?>"></td>
        </tr>
        <tr>
            <th><label for="Fit">Fit:</label></th>
            <td><input type="text" id="Fit" name="Fit" maxlength="10" required
                       value="<?php echo htmlspecialchars($shirt['Fit']); ?>"></td>
        </tr>
        <tr>
            <th><label for="ShirtTypeID">ShirtTypeID:</label></th>
            <td>
                <select name="ShirtTypeID" id="ShirtTypeID" required>
                    <?php foreach ($shirtTypes as $type): ?>
                        <option value="<?php echo htmlspecialchars($type['ShirtTypeID']); ?>"
                            <?php if ($type['ShirtTypeID'] == $shirt['ShirtTypeID']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($type['ShirtTypeName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ShirtWholesalePrice">ShirtWholesalePrice:</label></th>
            <td><input type="number" step="0.01" id="ShirtWholesalePrice" name="ShirtWholesalePrice" 
                       value="<?php echo htmlspecialchars($shirt['ShirtWholesalePrice']); ?>" required min="0"></td>
        </tr>
        <tr>
            <th><label for="ShirtListPrice">ShirtListPrice:</label></th>
            <td><input type="number" step="0.01" id="ShirtListPrice" name="ShirtListPrice" 
                       value="<?php echo htmlspecialchars($shirt['ShirtListPrice']); ?>" required min="0"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="action" value="Cancel" formnovalidate>
                <input type="submit" name="action" value="Update Item">
            </td>
        </tr>
    </table>
</form>

<?php
// Summary: Added HTML5 validation attributes to all form inputs in the Update Shirt form, mirroring the logic in newshirt.inc.php.
?>