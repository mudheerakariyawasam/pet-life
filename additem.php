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


        $sql = "INSERT INTO pet_item VALUES ('$item_id','$item_name','$item_brand','$item_qty','$item_price','$item_category')";
        $result = mysqli_query($conn,$sql);
        
        if($result==TRUE) { 
            header("location: welcome.php");
        }else {
            $error = "Your Login Name or Password is invalid";
        }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/additem.css">
    <title>Add New Item</title>
</head>
<body>
    <p>
        <span class="topic">Add New Item</span>
        <span class="sub-topic">Add the information about the item</span>
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
        <input type="text" name="item_category" placeholder="Select Category"><br>
        <p>
            <button class="btn-add" type="submit">Add </button>
            <button class="btn-exit"type="submit">Exit</button>
        </p>
   </form> 
</body>
</html>