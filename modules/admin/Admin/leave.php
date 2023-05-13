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
    <link rel="stylesheet" href="../css/leave.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Life</title>
</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
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
                <a href="#" class="active"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
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
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>
        </div>
        <div class="container">
        <br/>
<div class="leave-title">Leave Management</div><hr>
<br/>

<?php
	// Retrieve all holidays from the database
	$sql = "SELECT holiday_id, emp_id, approval_stage FROM holiday";
	$result = mysqli_query($conn, $sql);

	// Display the holidays in a table
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='holiday-table'>";
		echo "<tr><th class='holiday-table-header'>Holiday ID</th><th class='holiday-table-header'>Employee ID</th><th class='holiday-table-header'>Approval Stage</th><th class='holiday-table-header'>Action</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td class='holiday-table-cell'>" . $row['holiday_id'] . "</td>";
			echo "<td class='holiday-table-cell'>" . $row['emp_id'] . "</td>";
            echo "<td class='holiday-table-cell'>" . $row['approval_stage'] . "</td>";
			echo "<td class='holiday-table-cell'><center><a class='holiday-link' href='holiday_details.php?holiday_id=" . $row['holiday_id'] . "'><i class='fas fa-eye'></i></a></center></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		$image_url = "../images/no-results.png";
        echo '<center><img src="' . $image_url . '" alt="No results" width="440" height="400"></center>';
	}
?>

    </div>
    <script src="script.js"></script>
</body>

</html>