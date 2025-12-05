<?php
require_once("database.php");
require_once("shirt.php");

if (!isset($_GET['ShirtID'])) {
    echo "<h2>Error: No ShirtID provided.</h2>";
    exit();
}

$shirtID = $_GET['ShirtID'];
$shirt = Shirt::getByID($shirtID);

if (!$shirt) {
    echo "<h2>Shirt not found.</h2>";
    echo "<a href='index.php?content=listshirts'>Back to list</a>";
    exit();
}
?>

<h2>Shirt Details</h2>

<table>
    <tr><th>ID:</th><td><?php echo $shirt['ShirtID']; ?></td></tr>
    <tr><th>Code:</th><td><?php echo $shirt['ShirtCode']; ?></td></tr>
    <tr><th>Name:</th><td><?php echo $shirt['ShirtName']; ?></td></tr>
    <tr><th>Description:</th><td><?php echo $shirt['ShirtDescription']; ?></td></tr>
    <tr><th>Material:</th><td><?php echo $shirt['Material']; ?></td></tr>
    <tr><th>Fit:</th><td><?php echo $shirt['Fit']; ?></td></tr>
    <tr><th>Type ID:</th><td><?php echo $shirt['ShirtTypeID']; ?></td></tr>
    <tr><th>Wholesale Price:</th><td>$<?php echo number_format($shirt['ShirtWholesalePrice'], 2); ?></td></tr>
    <tr><th>List Price:</th><td>$<?php echo number_format($shirt['ShirtListPrice'], 2); ?></td></tr>
</table>

<br>
<a href="index.php?content=listshirts">Back to List</a>
