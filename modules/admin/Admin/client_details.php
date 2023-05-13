<?php
    include("../../../db/dbconnection.php");
    session_start();

    // Check if the holiday ID is set in the URL
    if (!isset($_GET['owner_id'])) {
        die("Error: Holiday ID not specified.");
    }else{
        $owner_id=$_GET['owner_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/employee_details.css">
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
                <a href="client.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php" ><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
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
        <div class="container">

<?php

// Retrieve the holiday details from the database based on the holiday ID in the URL
$sql = "SELECT * FROM pet_owner WHERE owner_id = '$owner_id'";
$result = mysqli_query($conn, $sql);

// Check if the query failed
if (!$result) {
    die("Error retrieving employee details: " . mysqli_error($conn));
}

// Check if the holiday with the specified ID exists
if (mysqli_num_rows($result) == 0) {
    die("Error: Owner with ID " . $_GET['owner_id'] . " not found.");
}

// Fetch the holiday details from the query result
$pet_owner = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Holiday Details</title>

</head>
<body>
	<h1 class="holy-title">Client Details</h1><hr/><br/>
	<table>
		<tr><td><strong>Owner ID:</strong></td><td><?php echo $pet_owner['owner_id']; ?></td></tr>
        <tr><td><strong>Owner First Name:</strong></td><td><?php echo $pet_owner['owner_fname']; ?></td></tr>
        <tr><td><strong>Owner Last Name:</strong></td><td><?php echo $pet_owner['owner_lname']; ?></td></tr>
        <tr><td><strong>Owner Email:</strong></td><td><?php echo $pet_owner['owner_email']; ?></td></tr>
        <tr><td><strong>Owner Contact No:</strong></td><td><?php echo $pet_owner['owner_contactno']; ?></td></tr>
        <tr><td><strong>Owner Address:</strong></td><td><?php echo $pet_owner['owner_address']; ?></td></tr>
        <tr><td><strong>Owner NIC:</strong></td><td><?php echo $pet_owner['owner_nic']; ?></td></tr>
        <tr><td><strong>Active Status:</strong></td><td><?php echo $pet_owner['owner_status']; ?></td></tr>
	</table>
	

<br/><br/>
</body>
</html>





