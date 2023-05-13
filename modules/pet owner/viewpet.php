<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewpet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img class="image" src="images/petlife.png"></center>
        </div>
        <ul>

        <li>
                <a href="dashboard.php" ><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
            </li>
            <li>
                <a href="../../public/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="inquiry.php"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
    
        <div class="navbar" >
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name"><?php echo $_SESSION['user_name'];?></div>
                </div>
            </div>


           
    
        </div>

        <div class="container">

            <!-- search items-->
            <div class="topbar">
                <div class="bar-content search-bar">
                <form method="GET">
    <label><b>Pet Name</b></label><br>
    <select name="pet_name">
        <option value="">Select a pet</option>
        <?php
          $loggedInUser = $_SESSION['login_user'];
        // Get all pets of the logged-in user
        $sql_pets = "SELECT * FROM pet WHERE owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '$loggedInUser')";
        $result_pets = mysqli_query($conn, $sql_pets);
        while ($row_pets = mysqli_fetch_assoc($result_pets)) {
            // Set the selected attribute if the current pet is selected in the URL
            $selected = ($row_pets['pet_name'] == $_GET['pet_name']) ? 'selected' : '';
            echo '<option value="' . $row_pets['pet_name'] . '" ' . $selected . '>' . $row_pets['pet_name'] . '</option>';
        }
        ?>
    </select>
    <button class="btn-add1" type="submit"><img src="images/search.png"></button>
</form>
                </div>
                <div class="bar-content add-bar">
                    <a href="addpet.php"> <button class="btn-add" type="submit"><img class="add"
                                src="images/add.png">New Pet</button></a>
                </div>

            </div>
            <!--View All Items Code-->
            <div class="tble">
            <table>
            <tr>
                <th>Pet ID</th>
                <th>Pet Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Action</th>
                <th>Availability</th>
            </tr>
            <?php

            $loggedInUser = $_SESSION['login_user'];




            $sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $sql = "SELECT * FROM pet WHERE owner_id ='{$row2['owner_id']}'";
  // Check if pet_name parameter is set in the URL
  if (isset($_GET['pet_name'])) {
    // Sanitize input value to prevent SQL injection
    $pet_name = mysqli_real_escape_string($conn, $_GET['pet_name']);
    // Include pet_name condition in SQL query
    $sql .= " AND pet_name LIKE '%$pet_name%'";
}
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
           

                while ($row = mysqli_fetch_assoc($result)) {
                    $pet_id = $row["pet_id"];
                    $pet_availability = $row["pet_availability"];
                
                    // Skip displaying the row if the pet is deleted
                    if ($pet_availability == 'Deleted') {
                        continue;
                    }
                
                    echo '<tr> 
                        <td>' . $row["pet_id"] . '</td>
                        <td> ' . $row["pet_name"] . '</td>
                        <td>' . $row["pet_gender"] . '</td> 
                        <td>' . $row["pet_dob"] . '</td>
                        <td>' . $row["pet_type"] . '</td>
                        <td>' . $row["pet_breed"] . '</td>
                        <td class="action">';
                
                    // Check if pet is deleted
                    if ($pet_availability != 'Deleted')
                     {
                        // Display delete button and handle delete request
                        echo '<form action="" method="post">
                                <button class="btn-add3" type="submit" name="' . $pet_id . '">Delete</button>
                              </form>';
                    }
                
                    echo '</td>';
                
                    if (isset($_POST[$pet_id])) {
                        // Check if pet is available to delete
                        if ($pet_availability != 'Deleted') {
                            // Delete pet
                            $sql = "UPDATE pet SET pet_availability = 'Deleted' WHERE pet_id = '$pet_id'";
                            if ($conn->query($sql) === TRUE) {
                                // Success message
                                echo '<script>alert("pet deleted successfully.");</script>';
                                $pet_availability = 'Deleted';
                            } else {
                                // Error message
                                echo '<script>alert("Error deleting pet");</script>';
                            }
                        } 
                    }
                
                    // Display the availability status for each pet
                    if ($pet_availability == 'Deleted') {
                        echo '<td class="action1">
                            <p>Deleted</p>
                        </td>';
                    } else {
                        echo '<td class="action1"> 
                            <p>Registered</p>
                        </td>';
                    }
                }
                            
                    
            }
        else{
            echo '<td colspan="8"><center><img style="width:50%;" src="images/no-results.png"></center></td>';
        }
?>            
            </table>    
            </div>
        </div>
        <script src="script.js"></script>
    </div>
</body>

</html>