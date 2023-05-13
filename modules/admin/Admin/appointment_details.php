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
    <link rel="stylesheet" href="../css/appointment_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Life</title>

<style>
button {
  border: none;
  background-color: #000D2F;
  cursor: pointer;
  padding: 10px;
  margin: 0;
  font-size: 16px;
  display: flex;
  align-items: center;
  transition: all 0.3s ease-in-out;
  color:white;
  border-radius: 10px;
}

button:hover {
  background-color: #C38D9E;
}

button:focus {
  outline: none;
}

button i {
  font-size: 18px;
  color: white;
  margin-right: 5px;
}

button span {
  font-family: Arial, sans-serif;
  color: white;
}

button:active {
  transform: translateY(1px);
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
                <a href="appointment.php" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
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
                
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>
        </div>

        <div class="container">

<?php

// Check if the holiday ID is set in the URL
if (!isset($_GET['appointment_id'])) {
    die("Error: Appointment ID not specified.");
}

// Retrieve the holiday details from the database based on the holiday ID in the URL
$sql = "SELECT * FROM appointment WHERE appointment_id = '" . $_GET['appointment_id'] . "'";
$result = mysqli_query($conn, $sql);

// Check if the query failed
if (!$result) {
    die("Error retrieving appointment details: " . mysqli_error($conn));
}

// Check if the holiday with the specified ID exists
if (mysqli_num_rows($result) == 0) {
    die("Error: Appointment with ID " . $_GET['appointment_id'] . " not found.");
}

// Fetch the holiday details from the query result
$appointment = mysqli_fetch_assoc($result);

// If the user clicks the "Approve" button
if (isset($_POST['approve'])) {
    // Update the approval_stage to "Approved"
    $sql = "UPDATE appointment SET appointment_status = 'Approved' WHERE appointment_id = '" . $_GET['appointment_id'] . "'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to see the updated appointment details
        header("Refresh:0");
    } else {
        die("Error updating appointment details: " . mysqli_error($conn));
    }
}

// If the user clicks the "Reject" button
if (isset($_POST['reject'])) {
    // Update the approval_stage to "Rejected"
    $sql = "UPDATE appointment SET appointment_status = 'Rejected' WHERE appointment_id = '" . $_GET['appointment_id'] . "'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to see the updated holiday details
        header("Refresh:0");
    } else {
        die("Error updating appointment details: " . mysqli_error($conn));
    }
}

?>

<!-- <!DOCTYPE html>
<html>
<head>
	<title>Appointment Details</title>
	<style>
		.approved {
			background-color: green;
		}
		.rejected {
			background-color: red;
		}
	</style>
</head>
<body> -->
    <br/><br/>
    
    <button style="margin-left:10px;"><a href="appointment.php"><i class="fas fa-arrow-left"></i><span>Back</span></a></button>
	<h1 class="holy-title">Appointment Details</h1><hr/><br/>
	<table>
		<tr><td><strong>Appointment ID:</strong></td><td><?php echo $appointment['appointment_id']; ?></td></tr>
		<tr><td><strong>Appointment Date:</strong></td> <td><?php echo $appointment['appointment_date']; ?></td></tr>
		<tr><td><strong>Appointment Time:</strong></td><td><?php echo $appointment['appointment_time']; ?></td></tr>
                <tr><td><strong>Appointment Slot:</strong></td><td><?php echo $appointment['appointment_slot']; ?></td></tr>
<tr><td><strong>Vet Id:</strong></td><td><?php echo $appointment['vet_id']; ?></td></tr>
                <tr><td><strong>Pet Id:</strong></td><td><?php echo $appointment['pet_id']; ?></td></tr>
		<tr><td><strong>Appointment Status:</strong></td><td class="<?php echo $appointment['appointment_status']; ?>"><?php echo $appointment['appointment_status']; ?></td></tr>
	
	</table>
	<form method="post">
		<input type="submit" name="approve" value="Approve">
		<input type="submit" name="reject" value="Reject">
	</form>
	<?php
	if (isset($_POST['approve'])) {
		$appointment['appointment_status'] = 'approved';
	} else if (isset($_POST['reject'])) {
		$appointment['appointment_status'] = 'rejected';
	}
?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let appointmentStatusTd = document.querySelector(".<?php echo $appointment['appointment_status']; ?>");
		if (appointmentStatusTd) {
			appointmentStatus.classList.remove("<?php echo $appointment['appointment_status'] === 'approved' ? 'rejected' : 'approved'; ?>");
			appointmentStatus.classList.add("<?php echo $appointment['appointment_status']; ?>");
		}
	});
</script>

</body>
</html>





