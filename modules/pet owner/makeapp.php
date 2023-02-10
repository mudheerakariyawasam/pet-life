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
    <link rel="stylesheet" href="css/appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Update My Profile</title>
</head>
<body>

<div class="main-container">

    <!-- left side nav bar -->

    <div class="left-container">
        <div class="user-img">
            <center><img src="images/petlife.png"></center>
        </div>
        <ul>
            
            <li>
                <a href="dashboard.php" ><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li>
            <li>
                <a href="profile.php" class="active"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>VIP Programmes</span></a></a>
            </li>
            <li>
                <a href="petshop.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
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
    
    
    <!-- right side container -->

    <div class="right-container">
    
        <div class="top-bar">
            <div class="nav-icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="hello">
                <font class="header-font-1">Welcome </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
        </div>
    
        <div class="content" style="
            background-position: center;
            height: 100vh;">

            <p class="topic"> Update Profile</p><hr><br>

            <form method="POST">
           
                <p class="welcome">Make an Appointment</p>
                <p>Add the information about the appointment</p>
                <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="pet_name" placeholder="name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="text" name="pet_gender" placeholder="gender" required>
                    
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="date" name="pet_dob" placeholder="dob" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Phone</label>
                    <input type="text" name="pet_type" placeholder="type of pet" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="pet_breed" placeholder="breed" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred Doctor</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred day of appointment</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred time of appointment</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
               
                <p>
                    <button class="btn-login" type="submit">Confirm</button>
                    <!-- <button class="btn-exit" type="submit"><a href="./dashboard.php">Cancel</a></button> -->
                </p>
            </form>
        </div>
</div>
    </div>
</body>
</html>