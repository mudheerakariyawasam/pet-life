<?php
   include("dbconnection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {   
      
      $pet_id = mysqli_real_escape_string($conn,$_POST['pet_id']);
      
      $sql = "SELECT *  FROM pet WHERE pet_id = '$pet_id'";
      
      $result = mysqli_query($conn, $sql);;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                    // to output mysql data in HTML table format
                        echo '<tr > 
                            <td>' . $row["pet_id"] . '</td>
                            <td>' . $row["pet_name"] . '</td>
                            <td> ' . $row["pet_gender"] . '</td>
                            <td>' . $row["pet_dob"] . '</td> 
                            <td>' . $row["pet_type"] . '</td>
                            <td>' . $row["pet_breed"] . '</td>
                            <td>' . $row["owner_id"] . '</td>

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
    <link rel="stylesheet" href="css/viewpet.css">
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <input type="text" name="pet_id" />
            <input type="submit" value="Search"/>
        </form>

        <!--View All Items Code-->
        <?php
            $sql = "SELECT * FROM pet";
            //fire query
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                echo '<table>
                <tr>
                    <th >pet ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Owner ID</th>
                </tr>';

                while($row = mysqli_fetch_assoc($result)){
                // to output mysql data in HTML table format
                    echo '<tr > 
                        <td>' . $row["pet_id"] . '</td>
                        <td>' . $row["pet_name"] . '</td>
                        <td> ' . $row["pet_gender"] . '</td>
                        <td> ' . $row["pet_dob"] . '</td>
                        <td>' . $row["pet_type"] . '</td> 
                        <td>' . $row["pet_breed"] . '</td>
                        <td>' . $row["owner_id"] . '</td>
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