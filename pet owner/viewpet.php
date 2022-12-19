<?php
   include("dbconnection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewpet.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<body>

<div class="topic">
        <span class="welcome">Welcome </span>
        <span class="name">NAME</span>
        <button type="submit" class="notification"><img src="images/bell.png"></button>
        <button type="submit" class="messages"><img src="images/message-square.png"></button>
        <button type="submit" class="logout">logout</button>
    </div>

    <div class="main-container">
    
   
    <div class="navbar">
            <ul>
            <li><a  href="dashboard.php"><img src ="images/nav_home.png" class="nav_icon">Home</a></li>
                <li><a class="active" href="treatments.php"><img src ="images/nav_item.png" class="nav_icon">Treatments</a></li>
                <li><a href="vaccination.php"><img src ="images/nav_medicine.png" class="nav_icon">Vaccinations</a></li>
                <li><a href="profile.php"><img src ="images/nav_holiday.png" class="nav_icon">My Profile</a></li>
                <li><a href="vip.php"><img src ="images/nav_profile.png" class="nav_icon">VIP Programmes</a></li>
                <li><a href="petshop.php"><img src ="images/nav_logout.png" class="nav_icon">Pet Shop</a></li>
                <li><a href="inquiries.php"><img src ="images/nav_logout.png" class="nav_icon">Inquiries</a></li>
            </ul>

          
      
        </div>
    
        <div class="container">

        <!-- search items-->
        <div class="topbar">
            <div class="bar-content search-bar">
                <form> 
                    <label><b>Pet ID </b></label><br>
                    <input class ="item-id"type="text" name="pet_id" placeholder="Enter Pet ID">
                    <button type="submit"><img src="images/search.png"></button>
                </form>
            </div>
        <div class="bar-content add-bar">
            <a href="addpet.php"> <button class="btn-add" type="submit"><img class="add" src="images/add.png">New Pet</button></a>
        </div>

        </div>
        <!--View All Items Code-->
        <?php
                $sql = "SELECT * FROM pet";
                
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    echo '<table>
                    <tr>
                        <th colspan="2">Pet Details</th>
                        <th>Pet Name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Type</th>
                        <th>Breed</th>
                    </tr>';
                   
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo '<tr > 
                            <td>' . $row["pet_id"] . '</td>
                            <td class="details">' . $row["pet_name"] .'</td>
                            <td> ' . $row["pet_name"] . '</td>
                            <td>' . $row["pet_gender"] . '</td> 
                            <td>' . $row["pet_dob"] . '</td>
                            <td>' . $row["pet_type"] . '</td>
                            <td>' . $row["pet_breed"] . '</td>
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