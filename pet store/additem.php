<?php
   include("dbconnection.php");
   include("header.php");
   
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
    
    <title>Add New Item</title>
</head>
<body>
    <div class="main-container">
        
    <div class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a class="active" href="#">Pet Items</a></li>
                <li><a href="#">Medicine</a></li>
                <li><a href="#">Leave Requests</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        

        
        <div class="container">
        <div class="content">
            <span class="pet-item">PET ITEMS</span>
            <br>
            <span class="main-topic">Add New Item</span>
            <span class="sub-topic">Add the information about the item</span>
            <link rel="stylesheet" href="css/add.css">
            <br>
            
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
                        <option value="Combs">Toys</option>
                        <option value="Food Bowls">Food Bowls</option>
                        <option value="Other">Other</option>
                    </select><br>
                </div>
            </form> 
            <button class="btn-add" type="submit">Add </button>
            <button class="btn-exit"type="submit">Exit</button>
        </div>
    </div>


    </div>
</body>
</html>