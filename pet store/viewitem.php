<?php
   include("dbconnection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {   
      
      $item_id = mysqli_real_escape_string($conn,$_POST['item_id']);
      
      $sql = "SELECT *  FROM pet_item WHERE item_id = '$item_id'";
      
      $result = mysqli_query($conn, $sql);;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                    // to output mysql data in HTML table format
                        echo '<tr > 
                            <td>' . $row["item_id"] . '</td>
                            <td>' . $row["item_name"] . '</td>
                            <td> ' . $row["item_brand"] . '</td>
                            <td>' . $row["item_qty"] . '</td> 
                            <td>' . $row["item_price"] . '</td>
                            <td>' . $row["item_category"] . '</td>
                        </tr>';
            }
        } else {
            echo "0 results";
        }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Clinic - Item Store</title>
    <link rel="stylesheet" href="css/viewitem.css">
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <input type="text" name="item_id" />
            <input type="submit" value="Search"/>
        </form>

        <!--View All Items Code-->
        <?php
            $sql = "SELECT * FROM pet_item";
            //fire query
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                echo '<table>
                <tr>
                    <th colspan="2">Product Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>';

                while($row = mysqli_fetch_assoc($result)){
                // to output mysql data in HTML table format
                    echo '<tr > 
                        <td>' . $row["item_id"] . '</td>
                        <td>' . $row["item_name"] . '</td>
                        <td> ' . $row["item_brand"] . '</td>
                        <td>' . $row["item_qty"] . '</td> 
                        <td>' . $row["item_price"] . '</td>
                        <td>' . $row["item_category"] . '</td>
                    </tr>';
                }
                echo '</table>';
            }else{
                echo "0 results";
            }
        ?>
    </div>
</body>
</html>