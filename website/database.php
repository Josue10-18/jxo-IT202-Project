<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
$host = 'sql1.njit.edu';
$user = 'jxo';
$pass = 'Xavier#2090!!';
$db   = 'jxo';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
