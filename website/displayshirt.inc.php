<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 4 Assignment – Display Shirt Details
// Email: jxo@njit.edu
require_once("database.php");
require_once("shirt.php");

// Get ShirtID from POST (search) or GET (links/buttons)
$shirtID = filter_input(INPUT_POST, 'ShirtID', FILTER_VALIDATE_INT);
if ($shirtID === null) {
    $shirtID = filter_input(INPUT_GET, 'ShirtID', FILTER_VALIDATE_INT);
}

// Validate ShirtID
if ($shirtID === false || $shirtID === null) {
    echo "<h2>Error: No valid ShirtID provided.</h2>";
    echo "<a href='index.php?content=listshirts'>Back to list</a>";
    exit();
}

// Lookup shirt
$shirt = Shirt::getByID($shirtID);

if (!$shirt) {
    echo "<h2>Error: Shirt with ID #$shirtID not found.</h2>";
    echo "<br><a href='index.php?content=listshirts'>Back to list</a>";
    exit();
}
?>

<h2>Shirt Details (ID #<?php echo htmlspecialchars($shirtID); ?>)</h2>

<table>
    <tr><th>ID:</th><td><?php echo htmlspecialchars($shirt['ShirtID']); ?></td></tr>
    <tr><th>Code:</th><td><?php echo htmlspecialchars($shirt['ShirtCode']); ?></td></tr>
    <tr><th>Name:</th><td><?php echo htmlspecialchars($shirt['ShirtName']); ?></td></tr>
    <tr><th>Description:</th><td><?php echo htmlspecialchars($shirt['ShirtDescription']); ?></td></tr>
    <tr><th>Material:</th><td><?php echo htmlspecialchars($shirt['Material']); ?></td></tr>
    <tr><th>Fit:</th><td><?php echo htmlspecialchars($shirt['Fit']); ?></td></tr>
    <tr><th>Type ID:</th><td><?php echo htmlspecialchars($shirt['ShirtTypeID']); ?></td></tr>
    <tr><th>Wholesale Price:</th>
        <td>$<?php echo number_format($shirt['ShirtWholesalePrice'], 2); ?></td></tr>
    <tr><th>List Price:</th>
        <td>$<?php echo number_format($shirt['ShirtListPrice'], 2); ?></td></tr>
</table>

<br>
<a href="index.php?content=listshirts">Back to List</a>
