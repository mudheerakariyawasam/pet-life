<?php
   include("data/dbconnection.php");
   include ("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewitem.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
    
        <div class="navbar">
            <ul>
            <li><a  href="dashboard.php"><img src ="images/nav_home.png" class="nav_icon">Home</a></li>
                <li><a  href="viewallitems.php"><img src ="images/nav_item.png" class="nav_icon">Pet Items</a></li>
                <li><a class="active" href="viewallmedicine.php"><img src ="images/nav_medicine.png" class="nav_icon">Medicine</a></li>
                <li><a href="#"><img src ="images/nav_holiday.png" class="nav_icon">Leave Requests</a></li>
                <li><a href="#"><img src ="images/nav_profile.png" class="nav_icon">My Profile</a></li>
                <li><a href="#"><img src ="images/nav_logout.png" class="nav_icon">Logout</a></li>
            </ul>
        </div>
    
        <div class="container">

        <span class="pet-item">MEDICINE</span>
        <br><br><br>

        <!-- search items-->
        <div class="topbar">
            <div class="bar-content search-bar">
                <form> 
                    <label><b>Medicine ID </b></label><br>
                    <input class ="item-id"type="text" name="medicine_id" placeholder="Enter Medicine ID">
                    <button type="submit"><img src="images/search.png"></button>
                </form>
            </div>
        <div class="bar-content add-bar">
            <a href="addmedicine.php"> <button class="btn-add" type="submit"><img class="add" src="images/add.png">New Medicine</button></a>
            <a href="addbatch.php"> <button class="btn-add" type="submit"><img class="add" src="images/add.png">New Batch</button></a>
        </div>

        </div>
        
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
</body>
</html>