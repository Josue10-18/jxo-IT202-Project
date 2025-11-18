<?php
// Name: [Your Name]
// Date: [Current Date]
// Course/Section: IT-202 Section ###
// Assignment: Phase 2 CRUD Categories and Items
// Email: [Your UCID]@njit.edu

// --- PHP INCLUDES/SETUP ---
require('database.php'); 
require('shirttype.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<h2>Access Denied! Please log in to view this page.</h2>";
    exit();
}
$shirtTypes = ShirtType::getAll();

?>
<h2>List Shirt Types</h2>
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

<?php if (empty($shirtTypes)): ?>
    <p>No shirt types found in the database.</p>
<?php endif;
// --- HTML OUTPUT ---
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Shirt Types Test</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
    </style>
</head>
<body>
    <h1>All Shirt Categories</h1>
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
    <?php endif; ?>
</body>
</html>