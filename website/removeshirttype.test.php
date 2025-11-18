<?php
// Name: [Josue Ortiz]
// Date: [10/18/2024]
// Course/Section: IT-202 Section 001
// Assignment: Phase 2 CRUD Categories and Items
// Email: jxo@njit.edu

require('database.php'); 
require('shirttype.php');

$id = filter_input(INPUT_POST, 'ShirtTypeID', FILTER_VALIDATE_INT);

if ($id === false) {
    echo "<h2>Error: Missing or invalid Category ID.</h2>";
    exit();
}

if (ShirtType::remove($id)) {
    $successMessage = "<h2>Category #$id successfully removed!</h2>";
} else {
    $successMessage = "<h2>Error: Failed to remove Category #$id. It may not exist.</h2>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Remove Shirt Type Test</title>
</head>
<body>
    <h1>Remove Shirt Type Result</h1>
    <?php echo $successMessage; ?>
</body>
</html>