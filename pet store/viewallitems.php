<?php
   include("dbconnection.php");
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
                <li><a class="active" href="viewitem.php">Home</a></li>
                <li><a  href="additem.php">Pet Items</a></li>
                <li><a href="addmedicine.php">Medicine</a></li>
                <li><a href="#">Leave Requests</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    
        <div class="container">

        <!--View All Items Code-->
        <?php
                $sql = "SELECT * FROM pet_item";
                
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    echo '<table>
                    <tr>
                        <th colspan="2">Product Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th colspan="2">Actions</th>
                    </tr>';

                    while($row = mysqli_fetch_assoc($result)){
                    // to output mysql data in HTML table format
                        echo '<tr > 
                            <td>' . $row["item_id"] . '</td>
                            <td>' . $row["item_name"] . '<br>'. $row["item_category"]. '<br><br>'.$row["item_id"].'</td>
                            <td> ' . $row["item_brand"] . '</td>
                            <td>' . $row["item_price"] . '</td> 
                            <td>' . $row["item_qty"] . '</td>
                            <td><button type="submit"><img src="images/update.png"></button></td>
                            <td><button type="submit"><img src="images/delete.png"></button></td>
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