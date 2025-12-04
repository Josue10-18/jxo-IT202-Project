<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 

$reason = filter_input(INPUT_GET, 'reason', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$message = "Login failed due to an unknown error.";

if ($reason === 'password') {
    $message = "Login failed: **Incorrect Password** was entered.";
} else if ($reason === 'email') {
    $message = "Login failed: **Email Address Not Found** in our records.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Failed</title>
</head>
<body>
    <h1>Login Failed</h1>
    <p><?php echo $message; ?></p>
    <p>Please <a href="index.php">try again</a>.</p>
</body>
</html>