<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

$id = isset($_GET['updateid']) ? mysqli_real_escape_string($conn, $_GET['updateid']) : '';


//Execute a query to retrieve data from the database
$sql = "SELECT owner_id,owner_fname,owner_lname,owner_email,owner_contactno,owner_address,owner_nic FROM pet_owner WHERE owner_id='$id'";

$view_selected_client = mysqli_query($conn, $sql);

//Process the retrieved data
if ($view_selected_client->num_rows > 0) {
    // Fetch the first row of data
    $row = $view_selected_client->fetch_assoc();

    // Retrieve the specific column values
    
    $fname = $row['owner_fname'];
    $lname = $row['owner_lname'];
    $fullName = $fname . " " . $lname;
    $email = $row['owner_email'];
    $tpn = $row['owner_contactno'];
    $address = $row['owner_address'];
    $nic = $row['owner_nic'];
    

} else {
    echo "No data found.";
    $conn->close();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/viewcustomer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="../images/logo_transparent black.png"></center>
        </div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>

            <li>
                <a href="showclients.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                        History</span></a></a>
            </li>
            <li>
                <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>

            <li>
                <a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2">
                        <?php echo $_SESSION['user_name']; ?>
                    </font>
                </div>
            </div>


            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-message"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="container">
            <br /><br /><br />
            <div class="cont">
                <div class="cont1">
                    <!-- <center><img src="../images/buttler.png"><br /> -->
                    <div class="pet-name">
                        <p>Owner Name : <?php echo $fullName; ?></p>
                    </div>
                       
                        <br>

                    
                    <!-- <div class="appoint">
                        <center>Appointments</center>
                        <div class="appointment">

                            <div class="appoint1">
                                <p>5<br />Past</p>
                            </div>
                            <div class="appoint2">
                                <p>2<br />Upcoming</p>
                            </div>
                        </div>
                    </div> -->
                    <div>
                        <p>Email</p>
                        <p>
                            <?php echo $email; ?>
                        </p>
                        <hr />
                        <br>
                        <p>Pet Owner's ID</p>
                        <p>
                            <?php echo $id; ?>
                        </p>
                        <hr />
                        <br />
                        <p>Phone Number</p>
                        <p>
                            <?php echo $tpn; ?>
                        </p>
                        <hr />
                        </br>
                        <p>National ID Number</p>
                        <p>
                            <?php echo $nic; ?>
                        </p>
                        <hr />
                        <br />
                        <p>Address</p>
                        <p>
                            <?php echo $address; ?>
                        </p>
                        <hr />
                        <br />
                        <!-- <p>City</p>
<p>Horana</p>
<hr/>
<br/>
<p>Number Of Pets</p>
<p>2</p>
<hr/> -->
                    </div>
                </div>



                <div class="cont2">
                   
                <div class="data-table">
                <table id="showpets">
                    <tr>
                        <th>pet_id</th>
                        <th>pet_name</th>
                        <th>pet_gender</th>
                        <th>pet_dob</th>
                        <th>pet_type</th>
                        <th>pet_breed</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    
                    $sql = "SELECT * FROM pet WHERE owner_id = '$id' AND pet_availability = 'Current'";
                    
                    $pets = mysqli_query($conn, $sql);
                    // die(mysqli_fetch_assoc($clients));
                    if (mysqli_num_rows($pets) > 0) {
                        // die(mysqli_fetch_assoc($clients));
                        while ($row = mysqli_fetch_assoc($pets)) {
                            $pet_id = $row['pet_id'];
                            $pet_name = $row['pet_name'];
                            $pet_gender = $row['pet_gender'];
                            $pet_dob = $row['pet_dob'];
                            $pet_type = $row['pet_type'];
                            $pet_breed = $row['pet_breed'];
                            echo '<tr>
                            <td>' . $pet_id . '</td>
                            <td>' . $pet_name . '</td>
                            <td>' . $pet_gender . '</td>
                            <td>' . $pet_dob . '</td>
                            <td>' . $pet_type . '</td>
                            <td>' . $pet_breed . '</td>
                            <td>
                            <div class="action all" style="display:flex;">
                            <a href="treatment_history.php? updateid=' . $pet_id . '"><i class="fas fa-eye" style="color:blue;"></i></a>&nbsp;&nbsp;&nbsp;
                            <a href="add_treatment_.php? updateid=' . $pet_id . '"><i class="fas fa-plus-square" style="color:blue;"></i></a>
                            </div>
                            </td>
                            </tr>';
                        }
                    } else {
                        // If there are no pets, display a message
                        echo "No pets found.";
                    }

                    ?>

                </table>

            </div>


                </div>
            </div>




        </div>
        <script src="script.js"></script>
</body>

</html>