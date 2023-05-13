<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];
        $sql = "SELECT * FROM pet_item WHERE item_id='$item_id'";    
        $result = mysqli_query( $conn,$sql);
        if( $result ){
            while( $row = mysqli_fetch_assoc( $result ) ){
                $item_name=$row["item_name"];
                $item_brand=$row["item_brand"];
                $item_qty=$row["item_qty"];
                $item_price=$row["item_price"];
                $item_category=$row["item_category"];
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
 
         //checking only numbers
         if(!(is_numeric($_POST['item_qty'])) || $_POST['item_qty']<0){
             echo '<script>alert("Please enter a valid  quantity!")</script>';
         }else if(!(is_numeric($_POST['item_price'])) || $_POST['item_qty']<0){
             echo '<script>alert("Please enter a valid price!")</script>';
         }else{
             $item_name=$_POST['item_name'];
             $item_brand=$_POST['item_brand'];
             $item_qty=$_POST['item_qty'];
             $item_price=$_POST['item_price'];
             $item_category=$_POST['item_category'];
     
             $sql = "UPDATE pet_item SET item_name='$item_name',item_brand='$item_brand', item_qty='$item_qty', item_price='$item_price', item_category='$item_category' WHERE item_id='$item_id'";
             $result = mysqli_query($conn,$sql);
             
             if($result==TRUE) { 
                echo "<script>Swal.fire(\"Added Successfully\");</script>";
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
    <title>Pet Life</title>
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
                <li><a href="viewallbatch.php"><i class="fa fa-stethoscope"></i><span>Batches</span></a></li>
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
        
            <p class="topic">Update Item</p><hr><br>
        
            <form method="POST">
                <label><b>Item ID : </label> 
                <label class="item-id" name="item_id" ><?php echo $item_id;?></b><br><br>
                <label>Product Name</label><br>
                <input type="text" name="item_name" placeholder="Product Name" required value="<?php echo isset($item_name) ? $item_name : $row['item_name']; ?>"><br>
                <label>Product Brand</label><br>
                <input type="text" name="item_brand" placeholder="Product Brand" value="<?php echo isset($item_brand) ? $item_brand : $row['item_brand']; ?>" required><br>
                <label>Qty</label><br>
                <input type="text" name="item_qty" placeholder="Quantity" value="<?php echo isset($item_qty) ? $item_qty : $row['item_qty']; ?>" required><br>
                <label>Price</label><br>
                <input type="text" name="item_price" placeholder="Price" value="<?php echo isset($item_price) ? $item_price : $row['item_price']; ?>" required><br>
                <label>Category</label><br>
                <div class="dropdown-list" style="width:200px;">
                    <select name="item_category" class="dropdown-list">
                        <option value="Pet Food" <?php if(isset($item_category) && $item_category == 'Pet Food') echo 'selected'; ?>>Pet Food</option>
                        <option value="Sleeping Items" <?php if(isset($item_category) && $item_category == 'Sleeping Items') echo 'selected'; ?>>Sleeping Items</option>
                        <option value="Collars" <?php if(isset($item_category) && $item_category == 'Collars') echo 'selected'; ?>>Collars</option>
                        <option value="Toys" <?php if(isset($item_category) && $item_category == 'Toys') echo 'selected'; ?>>Toys</option>
                        <option value="Sanitery Items" <?php if(isset($item_category) && $item_category == 'Sanitery Items') echo 'selected'; ?>>Sanitery Items</option>
                        <option value="Food Bowls" <?php if(isset($item_category) && $item_category == 'Food Bowls') echo 'selected'; ?>>Food Bowls</option>
                        <option value="Other" <?php if(isset($item_category) && $item_category == 'Other') echo 'selected'; ?>>Other</option>
                    </select><br><br>
                </div>
                
                <button class="btn-add" type="submit">Update </button>
                <a class="btn-exit" href="viewallitems.php">Exit</a>    
            </form> 
        </div>
    </div>
    
    </div>
</body>
</html>