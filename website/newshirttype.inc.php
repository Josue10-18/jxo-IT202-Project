<?php
// Name: Josue Ortiz
// Date: 11/04/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 3 Assignment: HTML Website Layout
// Email: jxo@njit.edu
?>
<h2>Add New Shirt Type</h2>

<form action="index.php" method="POST">
    <input type="hidden" name="content" value="addshirttype">
    <table border="1">
        <tr>
            <th><label for="ShirtTypeID">ShirtTypeID:</label></th>
            <td>
                <input type="number" id="ShirtTypeID" name="ShirtTypeID">
            </td>
        </tr>

        <tr>
            <th><label for="ShirtTypeCode">ShirtTypeCode:</label></th>
            <td>
                <input type="text" id="ShirtTypeCode" name="ShirtTypeCode">
            </td>
        </tr>

        <tr>
            <th><label for="ShirtTypeName">ShirtTypeName:</label></th>
            <td>
                <input type="text" id="ShirtTypeName" name="ShirtTypeName">
            </td>
        </tr>

        <tr>
            <th><label for="AisleNumber">AisleNumber:</label></th>
            <td>
                <input type="number" id="AisleNumber" name="AisleNumber">
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="Add New Shirt Type">
            </td>
        </tr>
    </table>
</form>
