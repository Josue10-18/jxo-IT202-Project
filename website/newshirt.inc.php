<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

// Requires: shirttype.php (to get available types for the dropdown)
$shirtTypes = ShirtType::getAll(); // Assuming this is defined and working in shirttype.php
?>
<h2>Add New Shirt</h2>

<form action="index.php" method="POST">
    <input type="hidden" name="content" value="addshirt">
    <table border="1">
        <tr>
            <th><label for="ShirtID">ShirtID:</label></th>
            <td><input type="number" id="ShirtID" name="ShirtID" required min="1" max="99999"></td>
        </tr>
        <tr>
            <th><label for="ShirtCode">ShirtCode:</label></th>
            <td><input type="text" id="ShirtCode" name="ShirtCode" maxlength="10" minlength="3" required></td>
        </tr>
        <tr>
            <th><label for="ShirtName">ShirtName:</label></th>
            <td><input type="text" id="ShirtName" name="ShirtName" maxlength="255" minlength="3" required></td>
        </tr>
        <tr>
            <th><label for="ShirtDescription">ShirtDescription (Min 2 sentences):</label></th>
            <td><textarea id="ShirtDescription" name="ShirtDescription" rows="3" required></textarea></td>
        </tr>
        <tr>
            <th><label for="Material">Material:</label></th>
            <td><input type="text" id="Material" name="Material" maxlength="255" minlength="3" required></td>
        </tr>
        <tr>
            <th><label for="Fit">Fit:</label></th>
            <td><input type="text" id="Fit" name="Fit" maxlength="10" required></td>
        </tr>
        <tr>
            <th><label for="ShirtTypeID">ShirtTypeID:</label></th>
            <td>
                <select name="ShirtTypeID" id="ShirtTypeID" required>
                    <option value="">-- Select Type --</option>
                    <?php foreach ($shirtTypes as $type): ?>
                        <option value="<?php echo htmlspecialchars($type['ShirtTypeID']); ?>">
                            <?php echo htmlspecialchars($type['ShirtTypeName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ShirtWholesalePrice">ShirtWholesalePrice:</label></th>
            <td><input type="number" step="0.01" id="ShirtWholesalePrice" name="ShirtWholesalePrice" required min="0"></td>
        </tr>
        <tr>
            <th><label for="ShirtListPrice">ShirtListPrice:</label></th>
            <td><input type="number" step="0.01" id="ShirtListPrice" name="ShirtListPrice" required min="0"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="Add New Shirt">
            </td>
        </tr>
    </table>
</form>

<?php
?>