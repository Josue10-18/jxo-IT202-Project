<?php
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: List Shirts
// Email: jxo@njit.edu

require('database.php'); 
require_once('shirt.php');

// Ensure session is started for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in to view this page.</h2>";
    exit();
}

$shirts = Shirt::getAll();
?>

<h2>List Shirts</h2>

<form action="#" method="get">
    <label for="selectShirt">Select a Shirt:</label>
    <select name="ShirtID" id="selectShirt" required>
        <option value="">-- Select a Shirt --</option>
        <?php foreach ($shirts as $shirt): 
            $priceFormatted = number_format($shirt['ShirtListPrice'], 2);
        ?>
            <option value="<?php echo htmlspecialchars($shirt['ShirtID']); ?>">
                <?php echo htmlspecialchars($shirt['ShirtName']); ?> 
                (Price: $<?php echo $priceFormatted; ?>)
            </option>
        <?php endforeach; ?>
    </select>
</form>

<hr>

<h3>All Shirts</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Material</th>
            <th>Fit</th>
            <th>Type ID</th>
            <th>Wholesale ($)</th>
            <th>List Price ($)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shirts as $shirt): ?>
        <tr>
            <td><?php echo htmlspecialchars($shirt['ShirtID']); ?></td>
            <td><?php echo htmlspecialchars($shirt['ShirtCode']); ?></td>
            <td><?php echo htmlspecialchars($shirt['ShirtName']); ?></td>
            <td><?php echo htmlspecialchars($shirt['ShirtDescription']); ?></td>
            <td><?php echo htmlspecialchars($shirt['Material']); ?></td>
            <td><?php echo htmlspecialchars($shirt['Fit']); ?></td>
            <td><?php echo htmlspecialchars($shirt['ShirtTypeID']); ?></td>
            <td><?php echo number_format($shirt['ShirtWholesalePrice'], 2); ?></td>
            <td><?php echo number_format($shirt['ShirtListPrice'], 2); ?></td>

            <!-- PHASE 5: JavaScript Unit 11 Buttons UCID:jxo, IT202-001, Internet Applications 12/3/2025-->
            <td>
                <button type="button" onclick="viewItem(<?php echo $shirt['ShirtID']; ?>)">View</button>
                <button type="button" onclick="updateItem(<?php echo $shirt['ShirtID']; ?>)">Update</button>
                <button type="button" onclick="deleteItem(<?php echo $shirt['ShirtID']; ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// View Item
function viewItem(id) {
    window.location.href = "displayshirt.inc.php?ShirtID=" + id;
}

// Update Item
function updateItem(id) {
    window.location.href = "updateshirt.inc.php?ShirtID=" + id;
}

// Delete Item
function deleteItem(id) {
    var confirmDelete = confirm("Are you sure you want to delete this shirt?");
    if (confirmDelete) {
        window.location.href = "removeshirt.inc.php?ShirtID=" + id;
    }
}
</script>


<?php if (empty($shirts)): ?>
    <p>No shirts found in the database.</p>
<?php endif; ?>

