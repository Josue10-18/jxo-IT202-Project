<?php
require('database.php');
require('shirttype.php');

$id = filter_input(INPUT_GET, 'ShirtTypeID', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    echo "<h2>Error: Missing or invalid Shirt Type ID.</h2>";
    echo "<p><a href='index.php?content=listshirttypes'>Back</a></p>";
    exit();
}

$removed = ShirtType::remove($id);

if ($removed) {
    echo "<h2>Success! Shirt Type #$id deleted.</h2>";
} else {
    echo "<h2>Error: Could not delete Shirt Type #$id.</h2>";
}

echo "<p><a href='index.php?content=listshirttypes'>Back to Shirt Types</a></p>";
?>
