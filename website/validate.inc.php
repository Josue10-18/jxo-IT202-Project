<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();
require_once 'database.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$sql = "SELECT * FROM ShirtsManagers 
        WHERE emailAddress = ? AND password = SHA2(?, 256)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $_SESSION['login'] = true;
    $_SESSION['emailAddress'] = $row['emailAddress'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['pronouns'] = $row['pronouns'];

    header("Location: main.inc.php");
    exit();
} else {
    header("Location: sorry.php");
    exit();
}
?>
