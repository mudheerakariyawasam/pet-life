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
    <link rel="stylesheet" href="../css/appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
    
    <style>
    .search-box {
        float: right;
        margin-bottom: 10px;
    }
    .search-box input[type="text"] {
        padding: 5px;
        border: none;
        border-radius: 5px;
        margin-left: 5px;
    }
    .pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {
  background-color: #ddd;
}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
button{
float:right;
padding: 5px 10px;


}



		/* Define a CSS class for coloring dates green */
		.green {
			background-color: green;
		}
	
</style>

</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
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
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
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
        <br/>
<div class="employee-title">Appointment List</div><hr>
<br/>
<center>
<?php
	// Retrieve all holidays from the database
	$sql = "SELECT appointment_id, appointment_date, appointment_time, appointment_slot, appointment_status FROM appointment";
	$result = mysqli_query($conn, $sql);

	// Display the holidays in a table
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='appointment-table'>";
		echo "<tr><th class='appointment-table-header'>Appointment ID</th><th class='appointment-table-header'>Appointment Date</th><th class='appointment-table-header'>Appointment Time</th><th class='appointment-table-header'>Appointment Slot</th><th class='appointment-table-header'>Appointment Status</th><th class='appointment-table-header'>Action</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td class='appointment-table-cell'>" . $row['appointment_id'] . "</td>";
			echo "<td class='appointment-table-cell'>" . $row['appointment_date'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['appointment_time'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['appointment_slot'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['appointment_status'] . "</td>";
			echo "<td class='appointment-table-cell'><a class='appointment-link' href='appointment_details.php?appointment_id=" . $row['appointment_id'] . "'><center><i class='fas fa-eye'></i></center></a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No appointments found.";
	}
?>












</center>

    </div>
    <script src="script.js"></script>
</body>

</html>
