<?php
// Include the database connection file
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');

// Initialize the variables
$itemName = '';
$quantity = 0;
$itemPrice = 0;
$total = 0;
$error = '';
$items = array();

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the item details from the database
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $sql = "SELECT * FROM pet_item WHERE item_name='$itemName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Calculate the total price
    if ($row) {
        $itemPrice = $row['item_price'];
        $total = $quantity * $itemPrice;

        // Add the item to the list of items
        $items[] = array(
            'item_name' => $itemName,
            'quantity' => $quantity,
            'item_price' => $itemPrice,
            'total' => $total
        );
    } else {
        $error = 'Item not found.';
    }

    // Save the order to the database
    if (!$error) {
        $sql = "INSERT INTO order_payment (item_name, quantity, item_price, total) VALUES ('$itemName', $quantity, $itemPrice, $total)";
        if (mysqli_query($conn, $sql)) {
            echo 'Order saved successfully.';
        } else {
            $error = 'Error saving order: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cashier</title>
</head>
<body>
    <h1>Cashier</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="item_name">Item name:</label>
        <select id="item_name" name="item_name">
            <?php
            // Get the list of items from the database
            $sql = "SELECT * FROM pet_item";
            $result = mysqli_query($conn, $sql);

            // Display the list of items in a dropdown menu
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['item_name'] . '">' . $row['item_name'] . '</option>';
            }
            ?>
        </select>

        <br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="<?php echo $quantity; ?>">

        <br>

        <button type="submit">Add to bill</button>
    </form>

    <?php if ($items): ?>
        <h2>Bill</h2>
        <table>
            <thead>
                <tr>
                    <th>Item name</th>
                    <th>Quantity</th>
                    <th>Item price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['item_name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['item_price']; ?></td>
                        <td><?php echo $item['total']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td><?php echo array_sum(array_column($items, 'total')); ?></td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</body>
</html>