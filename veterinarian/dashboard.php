<?php
    include("dbconnection.php");
    include("header.php");

    //Get the total no of items in the database

    $sql_total="SELECT COUNT(*) AS tot_client FROM pet_owner";
    $result_total = mysqli_query($conn, $sql_total);
    $row=mysqli_fetch_array($result_total);
    $tot_client="";
                    
    if(mysqli_num_rows($result_total)>0){
        $tot_client=$row['tot_client'];
        
    }else {
        $tot_client="0";
    }
    
    //get the items which are low in stock (<15)
    $sql_low="SELECT COUNT(*) AS tot_pet FROM pet ";
    $result_low = mysqli_query($conn, $sql_low);
    $row=mysqli_fetch_array($result_low);
    $tot_pet="";
                    
    if(mysqli_num_rows($result_low)>0){
        $tot_pet=$row['tot_pet'];
        
    }else {
        $tot_pet="0";
    } 

    //get the items which are out in stock 
    $sql_out="SELECT COUNT(*) AS tot_treat FROM treatment";
    $result_out = mysqli_query($conn, $sql_out);
    $row=mysqli_fetch_array($result_out);
    $tot_treat="";
                    
    if(mysqli_num_rows($result_out)>0){
        $tot_treat=$row['tot_treat'];
        
    }else {
        $tot_treat="0";
    } 

    //get the items which are out in stock 
    $sql_out="SELECT COUNT(*) AS tot_app FROM appointment";
    $result_out = mysqli_query($conn, $sql_out);
    $row=mysqli_fetch_array($result_out);
    $tot_app="";
                    
    if(mysqli_num_rows($result_out)>0){
        $tot_app=$row['tot_app'];
        
    }else {
        $tot_app="0";
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
                <li><a class="active" href="#">Home</a></li>
                <li><a  href="#">Clients</a></li>
                <li><a href="#">Leave </a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    
    
    <div class="container">
        <div class="summary">
            <div class="summary-content  total-items">
                <span class="tot">Total Customers</span>
                <span class="number"><?php echo $tot_client;?></span>
                <div><img class="shopping-cart" src="images/user.png"></div>
            </div>

            <div class="summary-content low-stock">
                <span class="tot">Total Pets</span>
                <span class="number"><?php echo $tot_pet; ?></span>
                <div><img class="shopping-cart" src="images/paw.png"></div>
            </div>

            <div class="summary-content out-of-stock">
                <span class="tot">Total Treatments</span>
                <span class="number"><?php echo $tot_treat ?></span>
                <div><img class="shopping-cart" src="images/check-square.png"></div>
            </div>

            <div class="summary-content appointments">
                <span class="tot">Appointments</span>
                <span class="number"><?php echo $tot_app ?></span>
                <div><img class="shopping-cart" src="images/clipboard.png"></div>
            </div>
        </div>

        <p>
        <div class="content best-summary">
            
                <table>
                    <th>Today's Appointments</th>
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
        </p>
    </div>
    </div>
</body>
</html>