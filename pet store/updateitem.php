<?php
   include("dbconnection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $item_id = $_POST['item_id'];
        $item_name=$_POST['item_name'];
        $item_brand=$_POST['item_brand'];
        $item_qty=$_POST['item_qty'];
        $item_price=$_POST['item_price'];
        $item_category=$_POST['item_category'];


        $update_sql = "UPDATE pet_item SET item_name='$item_name', item_brand='$item_brand', item_qty='$item_qty', item_price='$item_price', item_category='$item_category' WHERE item_id='$item_id'";
        
        if (mysqli_query($conn, $update_sql)) {
            header("location: viewitem.php");
        }else {
            $error = "There is an error in adding!";
        }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update item Details</title>
    <link rel="stylesheet" href="css/additem.css">
</head>
<body>
    <div class="container">
        <p>
            <span class="topic">Update Item Details</span>
            <span class="sub-topic">Search from the item ID and update details</span>
        </p>
        <form action="" method="POST">
            <label>Item ID</label><br>
            <input type="text" name="item_id" placeholder="Item ID"><br>
            <label>Product Name</label><br>
            <input type="text" name="item_name" placeholder="Product Name"><br>
            <label>Product Brand</label><br>
            <input type="text" name="item_brand" placeholder="Product Brand"><br>
            <label>Qty</label><br>
            <input type="text" name="item_qty" placeholder="Quantity"><br>
            <label>Price</label><br>
            <input type="text" name="item_price" placeholder="Price"><br>
            <label>Category</label><br>
            <div class="dropdown-list">
                <select name="item_category" id="Category" class="category">
                    <option value="Pet Food">Pet Food</option>
                    <option value="Sleeping Items">Sleeping Items</option>
                    <option value="Collars">Collars</option>
                    <option value="Toys">Toys</option>
                    <option value="Food Bowls">Food Bowls</option>
                    <option value="Other">Other</option>
                </select><br>
            </div>
            <p>
                <button class="btn-add" type="submit">Update </button>
                <button class="btn-exit"type="submit">Exit</button>
            </p>
        </form> 
    </div>
</body>
</html>