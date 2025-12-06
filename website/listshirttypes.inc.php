<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: List Shirt Types
// Email: jxo@njit.edu

require('database.php'); 
require_once('shirttype.php'); 

// Ensure session is started for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in to view this page.</h2>";
    exit();
}

$shirtTypes = ShirtType::getAll(); // Retrieve data
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shirtTypes as $type): ?>
        <tr>
            <td><?php echo htmlspecialchars($type['ShirtTypeID']); ?></td>
            <td><?php echo htmlspecialchars($type['ShirtTypeCode']); ?></td>
            <td><?php echo htmlspecialchars($type['ShirtTypeName']); ?></td>
            <td><?php echo htmlspecialchars($type['AisleNumber']); ?></td>

            <!-- PHASE 5: JavaScript Action Buttons UCID:jxo, IT202-001, Internet Applications 12/3/2025-->
            <td>
                <button type="button" onclick="viewType(<?php echo $type['ShirtTypeID']; ?>)">View</button>
                <button type="button" onclick="updateType(<?php echo $type['ShirtTypeID']; ?>)">Update</button>
                <button type="button" onclick="deleteType(<?php echo $type['ShirtTypeID']; ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// View Type
function viewType(id) {
    window.location.href = "displayshirttype.inc.php?ShirtTypeID=" + id;
}

// Update Type
function updateType(id) {
    window.location.href = "updateshirttype.inc.php?ShirtTypeID=" + id;
}

// Delete Type (with confirmation prompt)
function deleteType(id) {
    var confirmDelete = confirm("Are you sure you want to delete this Shirt Type?");
    if (confirmDelete) {
        window.location.href = "removeshirttype.inc.php?ShirtTypeID=" + id;
    }
}
</script>

<?php if (empty($shirtTypes)): ?>
    <p style="color: red; font-weight: bold;">
        No shirt categories found in the database. 
        This page is now working; you must insert data via phpMyAdmin.
    </p>
<?php endif; ?>
