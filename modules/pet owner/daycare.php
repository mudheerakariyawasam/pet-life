<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}


$loggedInUser = $_SESSION['login_user'];
$sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$owner_id = $row2["owner_id"];

//generate next day care ID
$sql_get_id = "SELECT daycare_id FROM daycare ORDER BY daycare_id DESC LIMIT 1";
$result_get_id = mysqli_query($conn, $sql_get_id);
$row = mysqli_fetch_array($result_get_id);

$lastid = "";

if (mysqli_num_rows($result_get_id) > 0) {
    $lastid = $row['daycare_id'];
}

if ($lastid == "") {
    $daycare_id = "D001";
} else {
    $daycare_id = substr($lastid, 3);
    $daycare_id = intval($daycare_id);

    if ($daycare_id >= 9) {
        $daycare_id = "D0" . ($daycare_id + 1);
    } else if ($daycare_id >= 99) {
        $daycare_id = "D" . ($daycare_id + 1);
    } else {
        $daycare_id = "D00" . ($daycare_id + 1);
    }
}

//add a new day care request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pet_name = $_POST['pet_name'];
    $daycare_date = date('Y-m-d', strtotime($_POST['daycare_date']));

    //check whether the appointment slots are available - maximum is 5
    $sql_availability = "SELECT COUNT(*) FROM daycare WHERE daycare_date='$daycare_date'";
    $result_availability = mysqli_query($conn, $sql_availability);
    $row_availability = mysqli_fetch_array($result_availability);
    if ($row_availability[0] > 5) {
        echo '<script>alert("There are no available slots for the selected date")</script>';

    } else {

        //get pet ID from database
        $sql_getpid = "SELECT pet_id FROM pet WHERE owner_id='$owner_id' AND pet_name='$pet_name'";
        $result_getpid = mysqli_query($conn, $sql_getpid);
        $row = mysqli_fetch_array($result_getpid);
        $pet_id = $row['pet_id'];

        //duplicate entry
        $sql_duplicate="SELECT * FROM `daycare` WHERE `daycare_date`='$daycare_date' AND `pet_id` = '$pet_id' AND daycare_status != 'Cancelled'";
        $r2=mysqli_query($conn,$sql_duplicate);
        $r_2=mysqli_num_rows($r2); 
        if($r_2>0) {
            echo"<script>alert('Daycare Date already Booked')</script>";
        } else {

        //insert data into the daycare table
        $sql = "INSERT INTO daycare (daycare_id, pet_id, pet_name, daycare_date, owner_id,daycare_status) VALUES ('$daycare_id','$pet_id','$pet_name','$daycare_date','$owner_id','Available')";
        $result = mysqli_query($conn, $sql);

        if ($result == TRUE) {
            echo '<script>alert("Your daycare slot is booked")</script>';
            header("Location: daycare.php");
        } else {
            echo '<script>alert("There is an error in booking")</script>';
        }
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/daycare.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width=200px></center>
        </div>
        <ul>

            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php" class="active"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
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
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                </div>
            </div>

           
        </div>

        <div class="container">

            <div class="left">
                <form method="POST" action="">
                    <p class="welcome">Register Now</p>

                    <div class="form-content">
                        <label class="loging-label1">Pets Name</label>
                        <select id='pet_name' name='pet_name' class='dropdown-list'>
                            <?php

                            //get the pet name from the sql table
                            $sql_mid = "SELECT pet_name FROM pet WHERE owner_id='$owner_id' ";

                            $result_getdata = $conn->query($sql_mid);
                            if ($result_getdata->num_rows > 0) {
                                while ($optionData = $result_getdata->fetch_assoc()) {
                                    $option = $optionData['pet_name'];
                                    ?>
                                    <?php
                                    
                                    //selected option
                                    if (!empty($pet_name) && $pet_name == $option) {
                                        // selected option
                                        ?>
                                        <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                                        <?php
                                        continue;
                                    } ?>
                                    <option value="<?php echo $option; ?>"><?php echo $option; ?> </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-content">
                        <label class="loging-label1">DayCare Date</label>
                        <?php
                            $currentDate = date('Y-m-d');
                            $nextfiveDays = date('Y-m-d', strtotime($currentDate . ' +4 days'));
                        ?>
            <input type="date" name="daycare_date" min="<?= $currentDate ?>" max="<?= $nextfiveDays ?>" required>
                    </div>


                    <p>
                        <button class="btn-add" type="submit">Register</button>

                    </p>
                </form>
            </div>
            <div class="right-side">
                <div class="filter">
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

                <div class="tble">

                    <table>
                        <tr>
                            <th>Pet ID</th>
                            <th>Pet Name</th>
                            <th>DayCare Date</th>
                            <th>Status</th>
                            <th>Cancel</th>
                        </tr>
                        <?php
                     


                    
                        $sql = "SELECT e.pet_id, e.pet_name, e.daycare_date, e.daycare_id, e.daycare_status FROM daycare e
                         INNER JOIN pet_owner o ON o.owner_id = e.owner_id WHERE o.owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}')";
                    
                        // Check if pet_name parameter is set in the URL
                        if (isset($_GET['pet_name'])) {
                            // Sanitize input value to prevent SQL injection
                            $pet_name = mysqli_real_escape_string($conn, $_GET['pet_name']);
                            // Include pet_name condition in SQL query
                            $sql .= " AND e.pet_name LIKE '%$pet_name%'";
                        }
                    
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $currentDate = date('Y-m-d');
                    
                            while ($row = mysqli_fetch_assoc($result)) {
                                $daycare_id = $row['daycare_id'];
                                $daycare_status = $row['daycare_status'];
                    
                                //adding the color according to the approval stage
                                $stage_color = '';
                                switch($row["daycare_status"]) {
                                    case 'Available':
                                        $stage_color = '#f5f56c';
                                        break;
                                    case 'Canceled':
                                        $stage_color = '#c74a4a';
                                        break;
                                }

                    
                                echo '<tr > 
                                        <td>' . $row["pet_id"] . '</td>
                                        <td> ' . $row["pet_name"] . '</td> 
                                        <td>' . $row["daycare_date"] . '</td>
                                        <td>' . $row["daycare_status"] . '</td>
                                        <td class="action" style="background-color: ' . $stage_color . ';">';
                    
                                // Check if appointment is completed
                                if ($daycare_status == 'Canceled' || $daycare_status == 'Completed') {
                                    //echo '<button class="btn-add2" type="reset">Cannot Delete</button>';
                                    echo"<a class='medicine-link' href='#'>Cannot Delete</a></td>";
                                } elseif (strtotime($row['daycare_date']) >= strtotime($currentDate)) {
                                    // Display delete button and handle delete request
                                    //echo '<button class="btn-add3" type="submit" name="daycare_id" value="' . $row["daycare_id"] . '">Cancel</button>';
                                    echo"<a class='medicine-link' href='delete_daycare.php?daycare_id=" . $row['daycare_id'] . "'>Cancel</a></td>";                     
                                } else {
                                    // Display cannot delete button
                                    //echo"<td><a class='medicine-link' href='#'>Cannot Delete</a></td>";
                                }
                            }
                        } else {
                            echo '<td colspan="7"><center><img style="width:40%;" src="images/no-results.png"></center></td>';
                        }
                        ?>
                    </table>
                </div>

            </div>
        </div>

        <script src="script.js"></script>

</body>

</html>