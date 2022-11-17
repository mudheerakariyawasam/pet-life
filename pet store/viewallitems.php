<?php
   include("dbconnection.php");
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
                <li><a href="dashboard.php">Home</a></li>
                <li><a class="active" href="#">Pet Items</a></li>
                <li><a href="addmedicine.php">Medicine</a></li>
                <li><a href="#">Leave Requests</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    
        <div class="container">

        <span class="pet-item">PET ITEMS</span>
        <br><br><br>

        <!-- search items-->
        <div class="topbar">
            <div class="bar-content search-bar">
                <form> 
                    <label><b>Item ID </b></label><br>
                    <input class ="item-id"type="text" name="item_id" placeholder="Enter Item ID">
                    <button type="submit"><img src="images/search.png"></button>
                </form>
            </div>
        <div class="bar-content add-bar">
            <a href="additem.php"> <button class="btn-add" type="submit"><img class="add" src="images/add.png">New Item</button></a>
        </div>

        </div>
        <!--View All Items Code-->
        <?php
                $sql = "SELECT * FROM pet_item";
                
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    echo '<table>
                    <tr>
                        <th colspan="2">Product Details</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th colspan="2">Actions</th>
                    </tr>';

                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo '<tr > 
                            <td>' . $row["item_id"] . '</td>
                            <td class="details">' . $row["item_name"] . '<br>'. $row["item_category"]. '<br><br>'.$row["item_id"].'</td>
                            <td> ' . $row["item_brand"] . '</td>
                            <td>' . $row["item_price"] . '</td> 
                            <td>' . $row["item_qty"] . '</td>
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