<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewitem.css">
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
                <li><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a class="active" href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
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
    
        <div class="content" style="
            background-position: center;
            height: 100vh;">

            <p class="topic"> Pet Medicine</p><hr><br>
        <!-- search items-->
        <div class="topbar">
            <div class="bar-content search-bar">
                <form> 
                    <label><b>Medicine ID </b></label>
                    <input class ="item-id"type="text" name="item_id" placeholder="Enter Medicine ID">
                    <button type="submit" class="search-btn"><img src="images/search.png"></button>
                </form>
            </div>
            <div class="bar-content add-bar">
                <a href="addmedicine.php"> <button class="btn-add" type="submit">New Medicine</button></a><br>
                <a href="addbatch.php"> <button class="btn-add" type="submit">New Batch</button></a>
            </div>

        </div>
        <br>
        <!--View All Items Code-->
    
        <?php
                
                $sql = "SELECT * FROM batch";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    echo '<table>
                    <tr>
                        <th colspan="2">Medicine Details</th>
                        <th>Brand</th>
                        <th>Exp Date</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th colspan="2">Actions</th>
                    </tr>';

                    while($row = mysqli_fetch_assoc($result)){
                        
                        //get medicine details of the batch
                        $sql_med = "SELECT * FROM medicine WHERE medicine_id='$row[medicine_id]'";
                        $result_med = mysqli_query($conn, $sql_med);
                        $row_med = mysqli_fetch_assoc($result_med);

                        echo '<tr > 
                            <td>' . $row["batch_id"] . '</td>
                            <td class="details">' . $row_med["medicine_name"] . '<br>'. $row_med["medicine_category"]. '<br><br>'.$row["batch_id"].'</td>
                            <td> ' . $row_med["medicine_brand"] . '</td>
                            <td> ' . $row["batch_expdate"] . '</td>
                            <td>' . $row["batch_price"] . '</td> 
                            <td>' . $row["batch_qty"] . '</td>
                            <td class="action"><button type="submit"><img src="images/update.png"></button></td>
                            <td class="action"><button type="submit"><img src="images/delete.png"></button></td>
                        </tr>';
                    }
                    echo '</table>';
                }else{
                    echo "0 results";
                }
            ?>
        </div>
</div>
    </div>
</body>
</html>