<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

    //Get the total no of items in the database

    $sql_total="SELECT COUNT(*) AS total FROM pet_item";
    $result_total = mysqli_query($conn, $sql_total);
    $row=mysqli_fetch_array($result_total);
    $total="";
                    
    if(mysqli_num_rows($result_total)>0){
        $total=$row['total'];
        
    }else {
        $total="0";
    }
    
    //get the items which are low in stock (<15)
    $sql_low="SELECT COUNT(*) AS low FROM pet_item WHERE item_qty<15 AND item_qty>0";
    $result_low = mysqli_query($conn, $sql_low);
    $row=mysqli_fetch_array($result_low);
    $low="";
                    
    if(mysqli_num_rows($result_low)>0){
        $low=$row['low'];
        
    }else {
        $low="0";
    } 

    //get the items which are out in stock 
    $sql_out="SELECT COUNT(*) AS outofstock FROM pet_item WHERE item_qty=0";
    $result_out = mysqli_query($conn, $sql_out);
    $row=mysqli_fetch_array($result_out);
    $outofstock="";
                    
    if(mysqli_num_rows($result_out)>0){
        $outofstock=$row['outofstock'];
        
    }else {
        $outofstock="0";
    } 

    //Get the total no of medicine in the database

    $sql_totalmed="SELECT COUNT(*) AS totalmed FROM medicine";
    $result_totalmed = mysqli_query($conn, $sql_totalmed);
    $row=mysqli_fetch_array($result_totalmed);
    $totalmed="";
                    
    if(mysqli_num_rows($result_totalmed)>0){
        $totalmed=$row['totalmed'];
        
    }else {
        $totalmed="0";
    }
    
    //get the medicine which are low in stock (<15)
    $sql_lowmed="SELECT COUNT(*) AS lowmed FROM batch WHERE batch_qty<15 AND batch_qty>0";
    $result_lowmed = mysqli_query($conn, $sql_lowmed);
    $row=mysqli_fetch_array($result_lowmed);
    $lowmed="";
                    
    if(mysqli_num_rows($result_lowmed)>0){
        $lowmed=$row['lowmed'];
        
    }else {
        $low="0";
    } 

    //get the items which are out in stock 
    $sql_outmed="SELECT COUNT(*) AS outofstockmed FROM batch WHERE batch_qty=0";
    $result_outmed = mysqli_query($conn, $sql_outmed);
    $row=mysqli_fetch_array($result_outmed);
    $outofstockmed="";
                    
    if(mysqli_num_rows($result_outmed)>0){
        $outofstockmed=$row['outofstockmed'];
        
    }else {
        $outofstockmed="0";
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
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
                <li><a class="active" href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a href="#"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
        
        <p class="topic">Pet Items Summary</p>
        <div class="summary">
            <div class="summary-content  total-items">
                <a href="viewallitems.php">
                <span class="tot">Total</span><br>
                <span class="number"><?php echo $total;?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div></a>
            </div>

            <div class="summary-content low-stock">
                <a href="viewlowstock.php">
                <span class="tot">Low in Stock</span><br>
                <span class="number"><?php echo $low; ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div></a>
            </div>

            <div class="summary-content out-of-stock">
                <span class="tot">Out of Stock</span>
                <span class="number"><?php echo $outofstock ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
            </div>
        </div>

        <br><hr><br>
        <p class="topic">Pet Medicine Summary</p>
        <div class="summary">
            <div class="summary-content  total-items">
                <a href="viewallitems.php">
                <span class="tot">Total</span><br>
                <span class="number"><?php echo $totalmed;?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div></a>
            </div>

            <div class="summary-content low-stock">
                <a href="viewlowstock.php">
                <span class="tot">Low in Stock</span><br>
                <span class="number"><?php echo $lowmed; ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div></a>
            </div>

            <div class="summary-content out-of-stock">
                <span class="tot">Out of Stock</span>
                <span class="number"><?php echo $outofstockmed ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
            </div>
        </div>
    </div>
    </div>
    
    </div>
</body>
</html>