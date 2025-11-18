<?php
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu

   if (isset($_SESSION['login'])) {
   ?>
    <div class="navigation" style="float: left; height: 100%; min-width: 175px; width: auto;">
      <table width="100%" cellpadding="3">
        <tr>
         <td><h3>Welcome, <?php echo $_SESSION['firstName']; ?></h3></td>
        </tr>
        <tr>
          <td><img src="images/logo.png" alt="Home Icon" width="12" height="12" />&nbsp;
            <a href="index.php"><strong>Home</strong></a></td>
        </tr>
        <tr>
          <td style="font-weight: bold;">Shirt Types</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=listshirttypes">
              <strong>List Shirt Types</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=newshirttype">
              <strong>Add New Shirt Type</strong></a></td>
        </tr>
        <tr>
          <td style="font-weight: bold;">Shirts</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=listshirts">
              <strong>List Shirts</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=newshirt">
              <strong>Add New Shirt</strong></a></td>
        </tr>
        <tr>
          <td>
            <hr />
          </td>
        </tr>
        <tr>
          <td><a href="index.php?content=logout">
            <img src="images/logout.png" alt="Logout Icon" width="12" height="12" />&nbsp;  
          <strong>Logout</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <form action="index.php" method="post">
              <label>Search for Shirt (by ID):</label><br>
              <input type="text" name="ShirtID" size="14" required />
              <input type="submit" value="Find" />
              <input type="hidden" name="content" value="updateshirt" />
            </form>
          </td>
        </tr>
        <tr>
          <td>
            <form action="index.php" method="post">
              <label>Search for Shirt Type (by ID):</label><br>
              <input type="text" name="ShirtTypeID" size="14" required />
              <input type="submit" value="Find" />
              <input type="hidden" name="content" value="displayshirttype" />
            </form>
          </td>
        </tr>
      </table>
    </div>
<?php
   } else {
    // If not logged in, display the login form content (Home/Login)
    include("login.inc.php"); 
   }
?>