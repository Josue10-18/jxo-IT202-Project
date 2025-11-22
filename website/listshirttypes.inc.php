<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

// --- PHP INCLUDES/SETUP ---
require('database.php'); 
require('shirttype.php');
// session_start() is removed as it's correctly in index.php

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in to view this page.</h2>";
    exit();
}

$shirtTypes = ShirtType::getAll(); // Retrieve data

// --- HTML OUTPUT ---
?>
<h2>List Shirt Types (All Categories)</h2>

<form action="#" method="get">
    <label for="selectShirtType">Select a Shirt Type:</label>
    <select name="ShirtTypeID" id="selectShirtType" required>
        <option value="">-- Select a Shirt Type --</option>
        <?php foreach ($shirtTypes as $type): ?>
            <option value="<?php echo htmlspecialchars($type['ShirtTypeID']); ?>">
                <?php echo htmlspecialchars($type['ShirtTypeName']); ?> 
                (Code: <?php echo htmlspecialchars($type['ShirtTypeCode']); ?>)
            </option>
        <?php endforeach; ?>
    </select>
</form>

<hr>

<h3>All Shirt Categories</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Aisle Number</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shirtTypes as $type): ?>
        <tr>
            <td><?php echo htmlspecialchars($type['ShirtTypeID']); ?></td>
            <td><?php echo htmlspecialchars($type['ShirtTypeCode']); ?></td>
            <td><?php echo htmlspecialchars($type['ShirtTypeName']); ?></td>
            <td><?php echo htmlspecialchars($type['AisleNumber']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($shirtTypes)): ?>
    <p>No shirt categories found in the database.</p>
    
    <div style="border: 2px solid #E74C3C; padding: 10px; margin-top: 20px; color: black; background-color: #FEE;">
        <h3>DEBUG INFO:</h3>
        <?php 
            global $db;
            if (!isset($db) || $db === null) {
                echo "<p style='color: red;'>CRITICAL ERROR: Database connection (\$db) is not defined. Check your <strong>database.php</strong> file.</p>";
            } else {
                echo "<p>Connection seems okay, but the query returned 0 items. **Action Required:** Log into **phpMyAdmin** and verify your <strong>ShirtTypes</strong> table has data.</p>";
            }
        ?>
    </div>
    <?php endif; ?>