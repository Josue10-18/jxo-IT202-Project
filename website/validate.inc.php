<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();

// REQUIRED: Include database connection
require('database.php');

function redirect($file) {
    header("Location: $file");
    exit();
}

$emailAddress_raw = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$_SESSION['login'] = false;

// Phase 4: Validate email address format
if (empty($emailAddress_raw) || !filter_var($emailAddress_raw, FILTER_VALIDATE_EMAIL)) {
    redirect('sorry.php?reason=email'); 
}
$emailAddress = $emailAddress_raw; // Use the filtered and validated value

// 1. Prepare and execute the query to find the user by email
// Removed the hardcoded $users array
$query = 'SELECT password, firstName, lastName, pronouns FROM ShirtsManagers WHERE emailAddress = :emailAddress';
$statement = $db->prepare($query);
$statement->bindValue(':emailAddress', $emailAddress);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC); // Fetch one row as an associative array
$statement->closeCursor();

// 2. Check if a user was found in the database (i.e., Email Address Not Found)
if (!$user) {
    redirect('sorry.php?reason=email'); 
}

// 3. Check the password
// IMPORTANT: Hash the user's submitted password using SHA2-256 before comparison, 
// because your ShirtsManagersStatements.sql stores the SHA2 hash.
$hashed_input_password = hash('sha256', $password);

if ($hashed_input_password !== $user['password']) {
    redirect('sorry.php?reason=password'); // Incorrect Password
}

// Successful Login
$_SESSION['login'] = true;
$_SESSION['email'] = $emailAddress;
// Use data retrieved from the database
$_SESSION['firstName'] = $user['firstName'];
$_SESSION['lastName'] = $user['lastName'];
$_SESSION['pronouns'] = $user['pronouns'];

redirect('index.php'); // Redirect to the main page
?>