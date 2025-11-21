<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu
session_start();
require_once("database.php");
require_once("shirttype.php");
require_once("shirt.php");

$content = 'login'; // Default content: login form

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // If logged in, check for content parameter
    $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : 'main';
} 

?>
<!DOCTYPE html>
<html>
<head>
   <title>SHIRT SHOP Inventory Helper</title>
   <link rel="stylesheet" type="text/css" href="style.css"> 
   <link rel="icon" type="image/png" href="images/logo.png">
</head>
<body>
   <header>
       <?php include("header.inc.php"); ?>
   </header>
   <section>
       <nav>
           <?php 
           // Navigation bar is only displayed if logged in
           if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
               include("nav.inc.php"); 
           } else {
               echo "<aside>Please log in to access the navigation.</aside>";
           }
           ?>
       </nav>
       <main>
           <?php
           // Include the content requested
           if ($content == 'login') {
               include("login.inc.php"); // Assuming you have this file for the login form
           } else {
               // Security check: Only allow *.inc.php files from the content parameter
               $file = $content . '.inc.php';
               if (file_exists($file)) {
                   include($file);
               } else {
                   // Fallback for an unknown or invalid content parameter
                   echo "<h2>Error: Page not found.</h2>";
                   echo "<p>The requested file ($file) does not exist.</p>";
               }
           }
           ?>
       </main>
   </section>
   <footer>
       <?php include("footer.inc.php"); ?>
   </footer>
</body>
</html>