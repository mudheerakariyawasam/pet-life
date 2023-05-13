<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    $vet_id = $_SESSION["emp_id"];

//Get the total no of clients in the database

    $sql_total="SELECT COUNT(*) AS total FROM pet_owner";
    $result_total = mysqli_query($conn, $sql_total);
    $row=mysqli_fetch_array($result_total);
    $total="";
                    
    if(mysqli_num_rows($result_total)>0){
        $total=$row['total'];
        
    }else {
        $total="0";
    }
    //Get the total no of pets in the database

    $sql_pet="SELECT COUNT(*) AS total_pets FROM pet";
    $result_pet = mysqli_query($conn, $sql_pet);
    $row=mysqli_fetch_array($result_pet);
    $total_pets="";
                    
    if(mysqli_num_rows($result_pet)>0){
        $total_pets=$row['total_pets'];
        
    }else {
        $total_pets="0";
    }
     //Get the total no of treatments in the database

     $sql_treatments="SELECT COUNT(*) AS total_treatments FROM treatment";
     $result_treatments = mysqli_query($conn, $sql_treatments);
     $row=mysqli_fetch_array($result_treatments);
     $total_treatments="";
                     
     if(mysqli_num_rows($result_treatments)>0){
        $total_treatments=$row['total_treatments'];
         
     }else {
        $total_treatments="0";
     }
     //Get the total no of appointments in the database

     $sql_appointments="SELECT COUNT(*) AS total_appointments FROM appointment";
     $result_appointments = mysqli_query($conn, $sql_appointments);
     $row=mysqli_fetch_array($result_appointments);
     $total_appointments="";
                     
     if(mysqli_num_rows($result_total)>0){
        $total_appointments=$row['total_appointments'];
         
     }else {
        $total_appointments="0";
     }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="../images/logo_transparent black.png"></center>
        </div>
        <ul>
            <li>
                <a href="#" class="active"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>

            <li>
                <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment History</span></a></a>
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
                    <font class="header-font-2"><?php echo $_SESSION['user_name']; ?></font>
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
        <div class="container" style="background-size: cover;
            background-position: center;
            height: 100vh;">

            <div class="dashboard-title">
                <div class="dash-1">
                    <p>Clients&nbsp;&nbsp;&nbsp;<span style="color:green;"><?php echo $total;?></span></p><img style="padding-left:100px;" src="../images/d1.png">
                </div>
                <div class="dash-2">
                    <p>Pets&nbsp;&nbsp;&nbsp;<span style="color:green;"><?php echo $total_pets;?></span></p><img style="padding-left:100px;" src="../images/d2.png">
                </div>
                <div class="dash-3">
                    <p>Treatments&nbsp;&nbsp;&nbsp;<span style="color:green;"><?php echo $total_treatments;?></span></p><img style="padding-left:100px;" src="../images/d3.png">
                </div>
                <div class="dash-4">
                    <p>Appointments&nbsp;&nbsp;&nbsp;<span style="color:green;"><?php echo $total_appointments;?></span></p><img style="padding-left:100px;" src="../images/d4.png">
                </div>
            </div>
            
                <!-- <div class="heading">Today's Appointments</div> -->
                <p class="topic">Today's Appointments</p>
                <hr>
           
            <br /><br /><br />
            
            <div class="table">
            
    <?php
    $today = date("Y-m-d");
    $sql_appointments="SELECT appointment_id, appointment_date, appointment_slot, pet_id FROM appointment WHERE vet_id = '$vet_id' AND appointment_date = '$today'";
    $result_appointments = mysqli_query($conn, $sql_appointments);
    if(mysqli_num_rows($result_appointments)>0){
    
        echo "<table class='appointment-table'>";
        echo "<thead>
        <tr>
        <th>Date</th>
        <th>Time Slot</th>
        <th>Pet ID</th>
        <th>Owner Name</th>
        <th>Action</th>
        </tr>
        </thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result_appointments)) {
            $pet_id = $row["pet_id"];
            
            //get owner ID
            $sql_pet = "SELECT owner_id FROM pet WHERE pet_id = '$pet_id'";
            $result_pet = mysqli_query($conn, $sql_pet);
            $row_pet = mysqli_fetch_assoc($result_pet);
            $owner_id = $row_pet["owner_id"];

            //get owner name
            $sql_name = "SELECT CONCAT(owner_fname, ' ', owner_lname) as full_name FROM pet_owner WHERE owner_id = '$owner_id'";
            $result_name = mysqli_query($conn, $sql_name);
            $row_name = mysqli_fetch_assoc($result_name);

            echo '<tr>
                <td>' . $row["appointment_date"] . '</td>
                <td>' . $row["appointment_slot"] . '</td>
                <td><a href="viewcustomer.php?owner_id=' . $row_pet["owner_id"] . '">' . $row ["pet_id"] . '</a></td>
                <td>' . $row_name["full_name"] . '</td>
                <td><a href="viewcustomer.php? owner_id=' . $row_pet["owner_id"] . '"><i class="fa-sharp fa-solid fa-eye" style="margin:5px;"></i></a></td>

                </tr>';
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No appointments for today.</p>";
    }
    ?>
            
</div>
          

        </div>
    </div>
  
</body>

</html>