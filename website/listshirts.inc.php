<?php
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

// Requires: database.php, shirt.php
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
            // Required: Format price with comma and 2 decimals
            $priceFormatted = number_format($shirt['ShirtListPrice'], 2);
        ?>
            <option value="<?php echo htmlspecialchars($shirt['ShirtID']); ?>">
                <?php echo htmlspecialchars($shirt['ShirtName']); ?> 
                (Price: $<?php echo $priceFormatted; ?>)
            </option>
        <?php endforeach; ?>
    </select>
    </form>

<?php if (empty($shirts)): ?>
    <p>No shirts found in the database.</p>
<?php endif; ?>