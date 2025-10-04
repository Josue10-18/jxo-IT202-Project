<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guitar Shop Inventory Login</title>
</head>
<body>
    <h1>Please Login to the Guitar Shop Inventory Website</h1>

    <form method="POST" action="validate.inc.php">
        <label for="emailAddress">Email Address:</label><br>
        <input type="text" id="emailAddress" name="emailAddress" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
