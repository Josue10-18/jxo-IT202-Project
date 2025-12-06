function getRealTime() {
// Name: Josue Ortiz
// Date: 10/25/2025
// Course/Section: IT-202 Section 001
// Assignment: Phase 5 Assignment: HTML Website Layout
// Email: jxo@njit.edu
    console.log("Fetching real-time inventory...");

    // DOM elements
    var domcategories = document.getElementById("categorycount");
    var domitems = document.getElementById("itemcount");
    var domwholesale = document.getElementById("wholesaletotal");
    var domlistprice = document.getElementById("listpricetotal");

    // AJAX request
    var request = new XMLHttpRequest();
    request.open("GET", "realtime.php", true);

    request.onreadystatechange = function() {

        if (request.readyState === 4 && request.status === 200) {

            var xmldoc = request.responseXML;
            if (!xmldoc) {
                console.log("XML parse error.");
                return;
            }

            // <categories>
            var xmlcategories = xmldoc.getElementsByTagName("categories")[0];
            var categories = xmlcategories?.childNodes[0]?.nodeValue || "0";

            // <items>
            var xmlitems = xmldoc.getElementsByTagName("items")[0];
            var items = xmlitems?.childNodes[0]?.nodeValue || "0";

            // <wholesaletotal>
            var xmlwholesale = xmldoc.getElementsByTagName("wholesaletotal")[0];
            var wholesaletotal = xmlwholesale?.childNodes[0]?.nodeValue || "0.00";

            // <listpricetotal>
            var xmllistpricetotal = xmldoc.getElementsByTagName("listpricetotal")[0];
            var listpricetotal = xmllistpricetotal?.childNodes[0]?.nodeValue || "0.00";

            // Update page
            if (domcategories) domcategories.innerHTML = categories;
            if (domitems) domitems.innerHTML = items;
            if (domwholesale) domwholesale.innerHTML = wholesaletotal;
            if (domlistprice) domlistprice.innerHTML = listpricetotal;
        }
    };

    request.send();
}
