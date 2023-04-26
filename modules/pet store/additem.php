<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

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
 
         if($item_id>=9){
             $item_id="I0".($item_id+1);
         } else if($item_id>=99){
             $item_id="I".($item_id+1);
         }else{
             $item_id="I00".($item_id+1);
         }
     }
     
    if($_SERVER["REQUEST_METHOD"] == "POST") {
 
         //checking only numbers
 
         if(!(is_numeric($_POST['item_qty']))){
             echo '<script>alert("Please enter only numbers as the qty!")</script>';
         }else if(!(is_numeric($_POST['item_price']))){
             echo '<script>alert("Please enter only numbers as the price!")</script>';
         }else{
             $item_name=$_POST['item_name'];
             $item_brand=$_POST['item_brand'];
             $item_qty=$_POST['item_qty'];
             $item_price=$_POST['item_price'];
             $item_category=$_POST['item_category'];
     
             $sql = "INSERT INTO pet_item VALUES ('$item_id','$item_name','$item_brand','$item_qty','$item_price','$item_category')";
             $result = mysqli_query($conn,$sql);
             
             if($result==TRUE) { 
                 header("location: viewallitems.php");
             }else {
                 $error = "There is an error in adding!";
             } 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="main-container">

    <!-- left side nav bar -->

    <div class="left-container">
        <div class="user-img">
            <center><img src="images/logo_transparent black.png"></center>
        </div>
        <ul>
                <li><a  href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a class="active" href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>        
    </div>
    
    
    <!-- right side container -->

    <div class="right-container">
    
        <div class="top-bar">
            <div class="nav-icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="hello">
                <font class="header-font-1">Welcome </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
        </div>
    
        <div class="content" style="background-size: cover;
            background-position: center;
            height: 100vh;">
        
            <p class="topic">Add New Item</p><hr><br>
        
            <form method="POST">
                <label><b>Item ID : </label> 
                <label class="item-id" name="item_id" ><?php echo $item_id;?></b><br><br>
                <label>Product Name</label><br>
                <input type="text" name="item_name" placeholder="Product Name" required><br>
                <label>Product Brand</label><br>
                <input type="text" name="item_brand" placeholder="Product Brand" required><br>
                <label>Qty</label><br>
                <input type="text" name="item_qty" placeholder="Quantity" required><br>
                <label>Price</label><br>
                <input type="text" name="item_price" placeholder="Price" required><br>
                <label>Category</label><br>
                <div class="dropdown-list" style="width:200px;">
                    <select name="item_category" class="dropdown-list" >
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