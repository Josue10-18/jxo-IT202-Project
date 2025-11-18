<?php
// Name: Josue Ortiz
// Date: 10/31/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

require('database.php'); 
require('shirttype.php');
require('shirt.php');

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to view Shirt Types.</h2>";
    exit();
}

// Get the ShirtTypeID from the search form in nav.inc.php
$typeId = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);

// Validation
if ($typeId === false || $typeId === null) {
    echo "<h2>Error: Missing or invalid Shirt Type ID (non-numeric).</h2>";
    exit();
}

// Fetch the specific Shirt Type details
$typeDetails = ShirtType::getByID($typeId); // Assuming you have getByID in shirttype.php

if (!$typeDetails) {
    echo "<h2>Error: Shirt Type with ID #$typeId was not found.</h2>";
    exit();
}

// Fetch all associated Shirts
$shirts = Shirt::getByTypeID($typeId); // Uses the method added to shirt.php

?>
<h2>Shirt Type Details: <?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?> (#<?php echo htmlspecialchars($typeDetails['ShirtTypeID']); ?>)</h2>

<p>
    **Code:** <?php echo htmlspecialchars($typeDetails['ShirtTypeCode']); ?> | 
    **Aisle:** <?php echo htmlspecialchars($typeDetails['AisleNumber']); ?>
</p>

<h3>Associated Shirts:</h3>
<?php if (empty($shirts)): ?>
    <p>No shirts found for this type.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>List Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shirts as $shirt): ?>
            <tr>
                <td><?php echo htmlspecialchars($shirt['ShirtID']); ?></td>
                <td><?php echo htmlspecialchars($shirt['ShirtCode']); ?></td>
                <td><?php echo htmlspecialchars($shirt['ShirtName']); ?></td>
                <td>$<?php echo number_format($shirt['ShirtListPrice'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>