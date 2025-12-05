<?php
ob_start();

// Include database and class files
require_once("database.php");
require_once("shirttype.php");
require_once("shirt.php");

// Fetch values using static methods
$totalCategories = ShirtType::getTotalCategories();
$totalItems = Shirt::getTotalItems();
$totalWholesale = Shirt::getTotalWholesalePrice();   // NEW
$listpricetotal = Shirt::getTotalListPrice();

// Create XML document
$doc = new DOMDocument("1.0");
$doc->formatOutput = true;

// <inventory>
$inventoryElement = $doc->createElement("inventory");
$inventoryElement = $doc->appendChild($inventoryElement);

// <categories>
$categoriesElement = $doc->createElement("categories", $totalCategories);
$inventoryElement->appendChild($categoriesElement);

// <items>
$itemsElement = $doc->createElement("items", $totalItems);
$inventoryElement->appendChild($itemsElement);

// <wholesaletotal>
$wholesaleElement = $doc->createElement("wholesaletotal", number_format($totalWholesale, 2, '.', ''));
$inventoryElement->appendChild($wholesaleElement);

// <listpricetotal>
$listpricetotalElement = $doc->createElement("listpricetotal", number_format($listpricetotal, 2, '.', ''));
$inventoryElement->appendChild($listpricetotalElement);

// Output XML
header("Content-type: application/xml");
ob_end_clean();
echo $doc->saveXML();
?>
