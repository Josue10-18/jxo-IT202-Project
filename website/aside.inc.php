<style>
    aside.realtime-panel {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 90%;
        padding: 15px;
        border: 1px solid #ccc;
        background-color: #f8f8f8;
        width: 250px;
        float: right;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }

    aside.realtime-panel h2 {
        margin-top: 0;
        color: #333;
        font-size: 1.2em;
        text-align: center;
    }

    aside.realtime-panel h3 {
        margin-bottom: 5px;
        margin-top: 12px;
        color: #555;
        font-size: 1em;
    }

    aside.realtime-panel span.value {
        font-weight: bold;
        color: #000;
        font-size: 1.1em;
    }
</style>

<aside class="realtime-panel">
    <h2>Real-Time Inventory</h2>

    <h3>Category Count:</h3>
    <span id="categorycount" class="value">loading...</span>

    <h3>Item Count:</h3>
    <span id="itemcount" class="value">loading...</span>

    <h3>Wholesale Price Total:</h3>
    <span id="wholesaletotal" class="value">loading...</span>

    <h3>List Price Total:</h3>
    <span id="listpricetotal" class="value">loading...</span>
</aside>
