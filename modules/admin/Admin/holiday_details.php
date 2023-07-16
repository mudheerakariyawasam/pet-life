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
    <link rel="stylesheet" href="../css/holiday_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
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

        <?php

// Check if the holiday ID is set in the URL
if (!isset($_GET['holiday_id'])) {
    die("Error: Holiday ID not specified.");
}

$holiday_id = $_GET['holiday_id'];

// Retrieve the holiday details from the database based on the holiday ID in the URL
$sql = "SELECT * FROM holiday WHERE holiday_id = '$holiday_id'";
$result = mysqli_query($conn, $sql);

// Check if the query failed
if (!$result) {
    die("Error retrieving holiday details: " . mysqli_error($conn));
}

// Check if the holiday with the specified ID exists
if (mysqli_num_rows($result) == 0) {
    die("Error: Holiday with ID " . $_GET['holiday_id'] . " not found.");
}

// Fetch the holiday details from the query result
$holiday = mysqli_fetch_assoc($result);

// If the user clicks the "Approve" button
if (isset($_POST['approve'])) {
    //check whether there are any appointments to the employee on the particular day
    $sql_getapp = "SELECT COUNT(*) AS total_app FROM appointment WHERE vet_id='".$holiday["emp_id"]."' AND appointment_date='".$holiday["from_date"]."'";
    $result_getapp = mysqli_query($conn, $sql_getapp);
    $row_getapp = mysqli_fetch_array($result_getapp);

    if ($row_getapp["total_app"] > 0) {
        echo "<script>
        Swal.fire({
            title: 'Are you sure?',
            text: 'There are appointments booked on the day. Are you sure you want to accept this request?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'holiday_accept.php?holiday_id=" . $holiday_id . "';
            } else {
                window.location.href = 'leave.php';
            }
        });
    </script>";
    } else {
        // If no appointments are booked, redirect to holiday_accept.php
        header("location: holiday_accept.php?holiday_id=$holiday_id");
        exit;
    }
}

// If the user clicks the "Reject" button
if (isset($_POST['reject'])) {
    // Update the approval_stage to "Rejected"
    $sql = "UPDATE holiday SET approval_stage = 'Rejected' WHERE holiday_id = '$holiday_id'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to see the updated holiday details
        header("Refresh:0");
        exit;
    } else {
        die("Error updating holiday details: " . mysqli_error($conn));
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!-- <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script> -->

<!DOCTYPE html>
<html>
<head>
	<title>Holiday Details</title>
 
	<style>
		.approved {
			background-color: green;
		}
		.rejected {
			background-color: red;
		}
	</style>
</head>
<body>
	<h1 class="holy-title">Holiday Details</h1><hr/><br/>
	<table>
		<tr><td><strong>Holiday ID:</strong></td><td><?php echo $holiday['holiday_id']; ?></td></tr>
		<tr><td><strong>From Date:</strong></td> <td><?php echo $holiday['from_date']; ?></td></tr>
		<tr><td><strong>To Date:</strong></td><td><?php echo $holiday['to_date']; ?></td></tr>
		<tr><td><strong>Approval Stage:</strong></td><td class="<?php echo $holiday['approval_stage']; ?>"><?php echo $holiday['approval_stage']; ?></td></tr>
		<tr><td><strong>Employee ID:</strong></td><td><?php echo $holiday['emp_id']; ?></td></tr>
		<tr><td><strong>Holiday Type:</strong></td><td><?php echo $holiday['holiday_type']; ?></td></tr>
		<tr><td><strong>Holiday Reason:</strong></td><td><?php echo $holiday['holiday_reason']; ?></td></tr>
	</table>
	<form method="post">
		<input type="submit" name="approve" value="Approve">
		<input type="submit" name="reject" value="Reject">
	</form>
	<?php
	if (isset($_POST['approve'])) {
		$holiday['approval_stage'] = 'Approved';
	} else if (isset($_POST['reject'])) {
		$holiday['approval_stage'] = 'Rejected';
	}
?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let approvalStageTd = document.querySelector(".<?php echo $holiday['approval_stage']; ?>");
		if (approvalStageTd) {
			approvalStageTd.classList.remove("<?php echo $holiday['approval_stage'] === 'Approved' ? 'Rejected' : 'Approved'; ?>");
			approvalStageTd.classList.add("<?php echo $holiday['approval_stage']; ?>");
		}
	});
</script>

</body>
</html>





