<?php
    include("../../../db/dbconnection.php");
    session_start();
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
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
<div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="#" class="active"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="appointment.php"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
<div class="hello">Hello <?php echo $_SESSION['user_name'];?> </div>
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
         
<div class="dashboard-title">
<div class="dash-1"><p>Clients<br><span style="color:white;">230</span><br/><span style="color:green;">10%</span> <span style="color:grey">since last month</span></p></div>
<div class="dash-2"><p>Registered Pets<br><span style="color:white;">412</span><br/><span style="color:red;">13%</span> <span style="color:grey">since last month</span></p></div>
<div class="dash-3"><p>Total Income<br><span style="color:white;">Rs.1,123,234.00</span><br/><span style="color:green;">122%</span> <span style="color:grey">since last month</span></p></div>
<div class="dash-4"><p>Staff Members<br><span style="color:white;">0</span><br/><span style="color:red;">0%</span> <span style="color:grey">since last month</span></p></div>
</div>
<div class="view-1">
<div class="chart">
<img src="../images/chart.png" width=100% height=50%><br/>
<img src="../images/list.png" width=100% height=40%>
</div>

<div class="todo">
<img src="../images/todo.png" width=100% height=40%><br/>
<img src="../images/available.png" width=100% height=50%>
</div>
</div>

 
    </div>
    <script src="script.js"></script>
</body>

</html>