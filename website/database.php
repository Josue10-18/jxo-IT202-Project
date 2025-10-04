<?php
$host = 'sql1.njit.edu';
$user = 'jxo';
$pass = 'Xavier#2090!!';
$db   = 'jxo';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
