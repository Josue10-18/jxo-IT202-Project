<?php
// Name: Josue Ortiz
// Date: 10/31/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: Display Shirt Type Details
// Email: jxo@njit.edu

require_once('database.php'); 
require_once('shirttype.php');
require_once('shirt.php');

// Ensure session is started for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Login Check
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! You must be logged in to view Shirt Types.</h2>";
    exit();
}

// Get the ShirtTypeID
$typeId = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);
if ($typeId === null) {
    $typeId = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);
}

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

// Fetch associated shirts
$shirts = Shirt::getByTypeID($typeId);
?>

<h2>View Shirt Type: <?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?> (#<?php echo htmlspecialchars($typeId); ?>)</h2>

<table>
    <tr>
        <th>ShirtTypeID</th>
        <td><?php echo htmlspecialchars($typeDetails['ShirtTypeID']); ?></td>
    </tr>
    <tr>
        <th>Code</th>
        <td><?php echo htmlspecialchars($typeDetails['ShirtTypeCode']); ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo htmlspecialchars($typeDetails['ShirtTypeName']); ?></td>
    </tr>
    <tr>
        <th>Aisle Number</th>
        <td><?php echo htmlspecialchars($typeDetails['AisleNumber']); ?></td>
    </tr>
</table>

<h3>Associated Shirts</h3>

<?php if (empty($shirts)): ?>
    <p>No shirts found for this type.</p>
<?php else: ?>
    <table>
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

<p><a href="index.php?content=listshirttypes">Back to Shirt Types</a></p>
