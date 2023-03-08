<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }


//Get the total no of items in the database

$sql_total = "SELECT COUNT(*) AS total FROM appointment";
$result_total = mysqli_query($conn, $sql_total);
$row = mysqli_fetch_array($result_total);
$total = "";

if (mysqli_num_rows($result_total) > 0) {
    $total = $row['total'];

} else {
    $total = "0";
}

$sql_total1 = "SELECT COUNT(*) AS total FROM pet";
$result_total1 = mysqli_query($conn, $sql_total1);
$row = mysqli_fetch_array($result_total1);
$total1 = "";

if (mysqli_num_rows($result_total1) > 0) {
    $total1 = $row['total'];

} else {
    $total1 = "0";
}

$sql_total2 = "SELECT COUNT(*) AS total FROM treatment";
$result_total2 = mysqli_query($conn, $sql_total2);
$row = mysqli_fetch_array($result_total2);
$total2 = "";

if (mysqli_num_rows($result_total2) > 0) {
    $total2 = $row['total'];

} else {
    $total2 = "0";
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
            <center><img src="images/petlife.png" width= 200px></center>
        </div>
        <ul>
            
        <li>
                <a href="dashboard.php" class="active" ><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php" ><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>VIP Programmes</span></a></a>
            </li>
            <li>
                <a href="../admin/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
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
                <div class="hello">Welcome &nbsp <div class="name"><?php echo $_SESSION['user_name'];?></div>
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
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span id="designation"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">

            <div class="top-container">
                <div class="box">
                    <div class="top-text">
                        <p>Your Upcoming Appointments</p>
                    </div>
                    <div class="count">
                        <p>2</p>
                    </div>
                    <div>
                        <button class="register-btn"><a href="./makeapp.php">Register New</a></button>
                    </div>
                </div>

                <div class="box">
                    <div class="top-text">
                        <p>Your Registered Pets</p>
                    </div>
                    <div class="count">
                        <p>5</p>
                    </div>
                    <div>
                        <button class="register-btn"><a href="./addpet.php">Register New</a></button>
                    </div>
                </div>

                <div class="box">
                    <div class="top-text">
                        <p>Pet Treatment Records</p>
                    </div>
                    <div class="count">
                        <p>1</p>
                    </div>
                    <div>
                        <button class="register-btn"><a href="./treatment.php">View Now</a></button>
                    </div>
                </div>
            </div>

            <div class="bottom-container">
                <div class="left-part">
                    <div class ="app">
                <p> LATEST APPOINTMNETS </P>
                    </div>
                    
                <?php
            $loggedInUser = $_SESSION['login_user'];

           $sql = "SELECT *  FROM appointment a INNER JOIN pet p 
                    ON a.pet_id = p.pet_id INNER JOIN pet_owner o 
                    ON o.owner_id = p.owner_id 
                    WHERE o.owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}')" ;
                $result_getdetails = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result_getdetails) > 0) {

                echo ' 
                <table>
                  <tr>
                      <th>Pet Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Type</th>
                      <th>Actions</th>
                  </tr>';

                while ($row_getdetails = mysqli_fetch_assoc($result_getdetails)) {
                
                    echo '<tr > 
                    <td> ' . $row_getdetails["pet_name"] . '</td>
                    <td>' . $row_getdetails["appointment_date"] . '</td>
                    <td>' . $row_getdetails["appointment_time"] . '</td>
                    <td>' . $row_getdetails["appointment_type"] . '</td>
                    <td class="action"><button type="submit"><img src="images/update.png"></button></td>
                    <td class="action"><button type="submit"><img src="images/delete.png"></button></td>
                </tr>';
                }
                echo '</table>';
            }
            else {
                echo "0 results";
            }
          
            ?>
               
            <div>
                        <button class="register-btn2"><a href="./viewpet.php">View Pets</a></button>
                    </div>
        </div>
        <script src="script.js">
           

        </script>

</body>

</html>

