<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
</head>
<body>
    <h1>Vendo Machine</h1>
    
    <form method="POST" action="">
        <fieldset>
            <legend>Select Your Products:</legend>
            <input type="checkbox" name="items[]" value="Coke-15"> Coke - ₱15<br>
            <input type="checkbox" name="items[]" value="Sprite-20"> Sprite - ₱20<br>
            <input type="checkbox" name="items[]" value="Royal-20"> Royal - ₱20<br>
            <input type="checkbox" name="items[]" value="Pepsi-15"> Pepsi - ₱15<br>
            <input type="checkbox" name="items[]" value="Mountain Dew-20"> Mountain Dew - ₱20<br>
        </fieldset>
        
        <fieldset>
            <legend>Choose Options:</legend>
            <label for="drinkSize">Size:</label>
            <select name="drinkSize" id="drinkSize">
                <option value="Regular">Regular</option>
                <option value="Up-Size">Up-Size (+₱20)</option>
                <option value="Jumbo">Jumbo (+₱15)</option>
            </select>
            <label for="itemCount">Quantity:</label>
            <input type="number" name="itemCount" id="itemCount" min="1" value="1">
            <button type="submit" name="submitOrder">Submit Order</button>
        </fieldset>
    </form>

    <?php
    if (isset($_POST['submitOrder'])) {
        // Retrieve selected items, size, and quantity
        $selectedItems = $_POST['items'] ?? [];
        $selectedSize = $_POST['drinkSize'];
        $itemCount = intval($_POST['itemCount']);

        $finalAmount = 0;
        $totalProductCount = 0;

        echo "<h2>Purchased Summary:</h2><ul>";

        foreach ($selectedItems as $item) {
            list($productName, $productPrice) = explode("-", $item);
            $productPrice = intval($productPrice);

            // Modify price based on size selection
            if ($selectedSize === "Up-Size") {
                $productPrice += 20;
            } elseif ($selectedSize === "Jumbo") {
                $productPrice += 15;
            }

            $currentTotal = $productPrice * $itemCount;
            $finalAmount += $currentTotal;
            $totalProductCount += $itemCount;

            echo "<li>$itemCount pieces of $selectedSize $productName totaling ₱$currentTotal</li>";
        }

        echo "</ul>";
        echo "<p>Total Items Purchased: $totalProductCount</p>";
        echo "<p>Total Cost: ₱$finalAmount</p>";
    }
    ?>
</body>
</html>