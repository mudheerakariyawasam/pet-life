<?php
   include("data/dbconnection.php");
   include("header.php");
   
   session_start();
    $sql_get_id="SELECT item_id FROM pet_item ORDER BY item_id DESC LIMIT 1";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);

    $lastid="";
                    
    if(mysqli_num_rows($result_get_id)>0){
        $lastid=$row['item_id'];
    }

    if($lastid==""){
        $item_id="I001";
    }else {
        $item_id=substr($lastid,3);
        $item_id=intval($item_id);

        if($item_id>='9'){
            $item_id="I0".($item_id+1);
        } else if($item_id>='99'){
            $item_id="I".($item_id+1);
        }else{
            $item_id="I00".($item_id+1);
        }
    }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $item_name=$_POST['item_name'];
        $item_brand=$_POST['item_brand'];
        $item_qty=$_POST['item_qty'];
        $item_price=$_POST['item_price'];
        $item_category=$_POST['item_category'];
        
        $sql = "INSERT INTO pet_item VALUES ('$item_id','$item_name','$item_brand','$item_qty','$item_price','$item_category')";
        $result = mysqli_query($conn,$sql);
        
        if($result==TRUE) { 
            header("location: dashboard.php");
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
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Add New Item</title>
</head>
<body>
    <div class="main-container">
        
    <div class="navbar">
            <ul>
            <li><a  href="dashboard.php"><img src ="images/nav_home.png" class="nav_icon">Home</a></li>
                <li><a class="active" href="viewallitems.php"><img src ="images/nav_item.png" class="nav_icon">Pet Items</a></li>
                <li><a href="viewallmedicine.php"><img src ="images/nav_medicine.png" class="nav_icon">Medicine</a></li>
                <li><a href="#"><img src ="images/nav_holiday.png" class="nav_icon">Leave Requests</a></li>
                <li><a href="#"><img src ="images/nav_profile.png" class="nav_icon">My Profile</a></li>
                <li><a href="#"><img src ="images/nav_logout.png" class="nav_icon">Logout</a></li>
            </ul>
        </div>
             
        <div class="container">
        <div class="content">
            <span class="pet-item">PET ITEMS</span>
            <br>
            <span class="main-topic">Update Item</span>
            <span class="sub-topic">Add the information that need to be updated below</span>
            <br>
            
            <form method="POST">
                <label><b>Item ID : </label> 
                <label class="item-id" name="item_id" ><?php echo $item_id;?></b><br><br>
                <label>Product Name</label><br>
                <input type="text" name="item_name" placeholder="Product Name"><br>
                <label>Product Brand</label><br>
                <input type="text" name="item_brand" placeholder="Product Brand"><br>
                <label>Qty</label><br>
                <input type="text" name="item_qty" placeholder="Quantity"><br>
                <label>Price</label><br>
                <input type="text" name="item_price" placeholder="Price"><br>
                <label>Category</label><br>
                <div class="dropdown-list" style="width:200px;">
                    <select name="item_category" >
                        <option value="Pet Food">Pet Food</option>
                        <option value="Sleeping Items">Sleeping Items</option>
                        <option value="Collars">Collars</option>
                        <option value="Toys">Toys</option>
                        <option value="Combs">Toys</option>
                        <option value="Food Bowls">Food Bowls</option>
                        <option value="Other">Other</option>
                    </select><br><br>
                </div>
                
                <button class="btn-add" type="submit">Add </button>
                <a class="btn-exit" href="viewallitems.php">Exit</a>
                
            </form> 

        </div>
    </div>


    </div>
</body>
</html>