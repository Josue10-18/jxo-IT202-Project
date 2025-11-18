<?php
// Josue Ortiz | 2025-10-03 | IT202-001 | Phase01 Assignment
// jxo@njit.edu 
session_start();

function redirect($file) {
    header("Location: $file");
    exit();
}

$emailAddress_raw = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$_SESSION['login'] = false;

// Phase 4: Validate email address format
if (empty($emailAddress_raw) || !filter_var($emailAddress_raw, FILTER_VALIDATE_EMAIL)) {
    redirect('sorry.php?reason=email'); 
}
$emailAddress = $emailAddress_raw; // Use the filtered and validated value

$users = [
    'jxo@njit.edu' => ['pass' => 'pa$$w0rd', 'first' => 'Josue', 'last' => 'Ortiz', 'pronouns' => 'He/Him'],
    'admin@njit.edu' => ['pass' => 'admin', 'first' => 'Mister', 'last' => 'Admin', 'pronouns' => 'They/Them']
];

if (!array_key_exists($emailAddress, $users)) {
    redirect('sorry.php?reason=email');
}

$user = $users[$emailAddress];

if ($password !== $user['pass']) {
    redirect('sorry.php?reason=password'); 
}

$_SESSION['login'] = true;
$_SESSION['email'] = $emailAddress;
$_SESSION['firstName'] = $user['first'];
$_SESSION['lastName'] = $user['last'];
$_SESSION['pronouns'] = $user['pronouns'];

redirect('index.php');
?>