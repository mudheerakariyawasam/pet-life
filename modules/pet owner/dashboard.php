<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}

$loggedInUser = $_SESSION['login_user'];
$currentDate = date('Y-m-d');

// Get the owner ID of the logged-in user
$sql_owner = "SELECT owner_id FROM pet_owner WHERE owner_email = '$loggedInUser'";
$result_owner = mysqli_query($conn, $sql_owner);
$row_owner = mysqli_fetch_assoc($result_owner);
$owner_id = $row_owner['owner_id'];

// Get all the pets owned by the user
$sql_pets = "SELECT * FROM pet WHERE owner_id = '$owner_id'";
$result_pets = mysqli_query($conn, $sql_pets);


// Iterate through the result set and get the total count of appointments for each pet
$total = 0;
while ($row_pet = mysqli_fetch_assoc($result_pets)) {
    $pet_id = $row_pet['pet_id'];
    $sql_total = "SELECT COUNT(*) AS total FROM appointment WHERE pet_id = '$pet_id' AND appointment_status = 'Pending'";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total += $row_total['total'];
}

$sql_total1 = "SELECT COUNT(*) AS total1 FROM pet WHERE  owner_id ='{$row_owner['owner_id']}' AND pet_availability = 'Registered'";
$result_total1 = mysqli_query($conn, $sql_total1);
$row1 = mysqli_fetch_array($result_total1);
$total1 = "";

if (mysqli_num_rows($result_total1) > 0) {
    $total1 = $row1['total1'];

} else {
    $total1 = "0";
}

$loggedInUser = $_SESSION['login_user'];

// Get the owner ID of the logged-in user
$sql_owner = "SELECT owner_id FROM pet_owner WHERE owner_email = '$loggedInUser'";
$result_owner = mysqli_query($conn, $sql_owner);
$row_owner = mysqli_fetch_assoc($result_owner);
$owner_id = $row_owner['owner_id'];

// Get all the pets owned by the user
$sql_pets = "SELECT * FROM pet WHERE owner_id = '$owner_id'";
$result_pets = mysqli_query($conn, $sql_pets);

// Iterate through the result set and get the total count of treatments for each pet
$total2 = 0;
while ($row_pet2 = mysqli_fetch_assoc($result_pets)) {
    $pet_id = $row_pet2['pet_id'];
    $sql_total2 = "SELECT COUNT(*) AS total2 FROM treatment a INNER JOIN treatment_type t ON t.treatment_id =  a.treatment_id WHERE pet_id = '$pet_id'";
    $result_total2 = mysqli_query($conn, $sql_total2);
    $row_total2 = mysqli_fetch_assoc($result_total2);
    $total2 += $row_total2['total2'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard1.css">
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
                <a href="dashboard.php" class="active"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
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



            <div class="top-container">
                <div class="box">
                    <div class="top-text">
                        <p>Upcoming Appointments</p>
                    </div>
                    <div class="count">
                        <?php echo $total; ?>
                    </div>
                    <div>
                        <button class="btn-add"><a href="./viewapp.php">View Now</a></button>
                    </div>
                </div>

                <div class="box">
                    <div class="top-text">
                        <p>Registered Pets</p>
                    </div>
                    <div class="count">
                        <?php echo $total1; ?>
                    </div>
                    <div>
                        <button class="btn-add"><a href="./viewpet.php">View Now</a></button>
                    </div>
                </div>

                <div class="box">
                    <div class="top-text">
                        <p>Pet Treatment Records</p>
                    </div>
                    <div class="count">
                        <?php echo $total2; ?>
                    </div>
                    <div>
                        <button class="btn-add"><a href="./treatment.php">View Now</a></button>
                    </div>
                </div>
            </div>

            <div class="bottom-container">
                <div class="left-part">
                    <div class="app">
                        <p> YOUR NEXT APPOINTMENT </P>
                    </div>
                    <div class="tble">
                        <table>
                            <tr>
                                <th>Pet Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Slot No</th>
                                <th>Doctor</th>
                            </tr>
                            <?php
                            $loggedInUser = $_SESSION['login_user'];
                            $currentDate = date('Y-m-d');

             $sql = "SELECT * FROM appointment a INNER JOIN pet p 
            ON a.pet_id = p.pet_id INNER JOIN pet_owner o 
            ON o.owner_id = p.owner_id 
            INNER JOIN employee e ON e.emp_id = a.vet_id 
            WHERE o.owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}') AND a.appointment_date >= '$currentDate' AND appointment_status = 'Pending'
            ORDER BY a.appointment_date, a.appointment_slot LIMIT 1";
                            $result_getdetails = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result_getdetails) > 0) {
                                while ($row_getdetails = mysqli_fetch_assoc($result_getdetails)) {
                                    echo '<tr > 
            <td> ' . $row_getdetails["pet_name"] . '</td>
            <td>' . $row_getdetails["appointment_date"] . '</td>
            <td>' . $row_getdetails["appointment_time"] . '</td>
            <td>' . $row_getdetails["appointment_slot"] . '</td>
            <td>' . $row_getdetails["emp_name"] . '</td>
            </tr>';
        }
       
    } else {
        echo '<td colspan="7"><center><img style="width:8%;" src="images/no-results.png"></center></td>';
    }
    echo '</table>';
                            ?>

                    </div>
                    <div>

                    </div>

                    <div style="margin-top:10px;"><button class="btn-add2"><a href="makeapp.php">Make An
                                Appointment</a></button></div>
                </div>
                <script src="script.js">


                </script>

</body>

</html>