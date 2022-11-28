<?php
    include("data/dbconnection.php");
    include("header.php");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<body>
    <div class="main-container">

    <div class="navbar">
            <ul>
                <li><a class="active" href="dashboard.php"><img src ="images/nav_home.png" class="nav_icon">Home</a></li>
                <li><a href="viewallitems.php"><img src ="images/nav_item.png" class="nav_icon">Pet Items</a></li>
                <li><a href="viewallmedicine.php"><img src ="images/nav_medicine.png" class="nav_icon">Medicine</a></li>
                <li><a href="#"><img src ="images/nav_holiday.png" class="nav_icon">Leave Requests</a></li>
                <li><a href="#"><img src ="images/nav_profile.png" class="nav_icon">My Profile</a></li>
                <li><a href="#"><img src ="images/nav_logout.png" class="nav_icon">Logout</a></li>
            </ul>
        </div>
    
    
    <div class="container">
        <div class="summary">
            <div class="summary-content  total-items">
                <a href="viewallitems.php">
                <span class="tot">Total Items</span><br>
                <span class="number"><?php echo $total;?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div></a>
            </div>

            <div class="summary-content low-stock">
                <span class="tot">Low in Stock</span>
                <span class="number"><?php echo $low; ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
            </div>

            <div class="summary-content out-of-stock">
                <span class="tot">Out of Stock</span>
                <span class="number"><?php echo $outofstock ?></span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
            </div>
        </div>

        <p>
        <div class="best-summary">
            <div class="content best-seller">
                <table>
                    <th>Best Sellers</th>
                    <th><img class ="refresh" src="images/refresh.png"></th>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                </table>
            </div>

            <div class="content best-customer">
                <table>
                    <th>Best Customers</th>
                    <th><img class ="refresh" src="images/refresh.png"></th>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                    <tr>
                        <td colspan="2">Mudheera</td>
                    </tr>
                </table>
            </div>
        </div>
        </p>
    </div>
    </div>
</body>
</html>