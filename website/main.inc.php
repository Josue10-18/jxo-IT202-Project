<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shirts Shop Inventory Helper</title>
</head>
<body>
  <h1>Welcome to the Shirts Shop Inventory Helper</h1>
  <p>
    Welcome <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?>
    (<?php echo $_SESSION['pronouns']; ?>)
  </p>
  <a href="logout.inc.php">Logout</a>
</body>
</html>
