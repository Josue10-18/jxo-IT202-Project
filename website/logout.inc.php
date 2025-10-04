<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>
